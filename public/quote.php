<?php
// public/quote.php
declare(strict_types=1);

// === DEBUG (puedes quitarlo en prod) ===
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require __DIR__ . '/../app/bootstrap.php';

// Helpers del proyecto (si alguno falta, no rompemos)
$zonesHelper     = __DIR__ . '/../app/helpers/zones.php';
$pricingHelper   = __DIR__ . '/../app/helpers/pricing.php';
$distanceHelper  = __DIR__ . '/../app/helpers/distance.php';
if (file_exists($zonesHelper))    require_once $zonesHelper;
if (file_exists($pricingHelper))  require_once $pricingHelper;
if (file_exists($distanceHelper)) require_once $distanceHelper;

// Solo aceptamos POST desde el formulario del home
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /'); exit; }

// ---------- Utilidades ----------
function clean(string $k): string { return isset($_POST[$k]) ? trim((string)$_POST[$k]) : ''; }

/**
 * Tablas mínimas (no rompe si ya existen)
 */
function ensure_min_tables(PDO $db): void {
  // vehicles
  $db->exec("
    CREATE TABLE IF NOT EXISTS vehicles (
      code        VARCHAR(32) PRIMARY KEY,
      name        VARCHAR(100) NOT NULL,
      img         VARCHAR(255) NULL,
      pax         VARCHAR(32)  NULL,
      luggage     VARCHAR(32)  NULL,
      base        DECIMAL(10,2) NOT NULL DEFAULT 0,
      per_km      DECIMAL(10,2) NOT NULL DEFAULT 0,
      per_min     DECIMAL(10,2) NOT NULL DEFAULT 0,
      min_fare    DECIMAL(10,2) NOT NULL DEFAULT 0,
      active      TINYINT(1) NOT NULL DEFAULT 1
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  ");

  // zones (POLYGON sin SRID para compatibilidad amplia)
  $db->exec("
    CREATE TABLE IF NOT EXISTS zones (
      id     INT AUTO_INCREMENT PRIMARY KEY,
      name   VARCHAR(100) NOT NULL UNIQUE,
      geom   POLYGON NOT NULL,
      active TINYINT(1) NOT NULL DEFAULT 1
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  ");

  // zone_prices
  $db->exec("
    CREATE TABLE IF NOT EXISTS zone_prices (
      id            INT AUTO_INCREMENT PRIMARY KEY,
      zone_from_id  INT NOT NULL,
      zone_to_id    INT NOT NULL,
      vehicle_code  VARCHAR(32) NOT NULL,
      price         DECIMAL(10,2) NOT NULL,
      currency      CHAR(3) NOT NULL DEFAULT 'EUR',
      UNIQUE KEY uq_zone_vehicle (zone_from_id, zone_to_id, vehicle_code),
      FOREIGN KEY (zone_from_id) REFERENCES zones(id) ON DELETE CASCADE,
      FOREIGN KEY (zone_to_id)   REFERENCES zones(id) ON DELETE CASCADE,
      FOREIGN KEY (vehicle_code) REFERENCES vehicles(code) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  ");
}

/**
 * Nombre de zona seguro (o null)
 */
function zone_name(PDO $db, ?int $id): ?string {
  if (!$id) return null;
  $st = $db->prepare("SELECT name FROM zones WHERE id=:id");
  $st->execute([':id'=>$id]);
  $r = $st->fetch(PDO::FETCH_ASSOC);
  return $r ? (string)$r['name'] : null;
}

/**
 * Recalcular distancia/tiempo con blindaje:
 * - Si existe recalc_distance_duration(), la usamos.
 * - Si falla o no existe, usamos los valores recibidos en POST.
 */
function safe_recalc_distance_duration(float $oLat, float $oLng, float $dLat, float $dLng, int $dm, int $ds): array {
  try {
    if (function_exists('recalc_distance_duration')) {
      $re = recalc_distance_duration($oLat, $oLng, $dLat, $dLng);
      $distance_m = isset($re['distance_m']) && is_numeric($re['distance_m']) ? (int)$re['distance_m'] : 0;
      $duration_s = isset($re['duration_s']) && is_numeric($re['duration_s']) ? (int)$re['duration_s'] : 0;
      return [
        'distance_m' => $distance_m ?: $dm,
        'duration_s' => $duration_s ?: $ds,
      ];
    }
  } catch (Throwable $e) {
    // Si la API falla o allow_url_fopen está desactivado, caemos al POST
  }
  return ['distance_m' => $dm, 'duration_s' => $ds];
}

/**
 * Buscar zona (no romper si el helper usa funciones GIS no disponibles)
 */
function safe_find_zone_id(PDO $db, float $lat, float $lng): ?int {
  try {
    if (function_exists('find_zone_id_by_point')) {
      return find_zone_id_by_point($db, $lat, $lng);
    }
  } catch (Throwable $e) {
    // Si hay error GIS, devolvemos null
  }
  return null;
}

/**
 * Precio por zonas o fallback por distancia
 */
function compute_vehicle_price(PDO $db, array $veh, ?int $oZone, ?int $dZone, float $km, float $minutes, float $airportFee): float {
  // Intentar tarifa fija por zonas si tenemos ambas
  $zonePrice = null;
  if ($oZone && $dZone && function_exists('zone_price')) {
    try {
      $zonePrice = zone_price($db, $oZone, $dZone, (string)$veh['code']);
    } catch (Throwable $e) {
      $zonePrice = null;
    }
  }
  if ($zonePrice !== null) return (float)$zonePrice;

  // Fallback por distancia (usa helper si existe; si no, cálculalo aquí)
  if (function_exists('distance_fallback_price')) {
    return (float)distance_fallback_price($veh, $km, $minutes, $airportFee);
  }

  // Fallback minimalista si no existe el helper (no romper)
  $base    = (float)($veh['base'] ?? 0);
  $per_km  = (float)($veh['per_km'] ?? 1.0);
  $per_min = (float)($veh['per_min'] ?? 0.25);
  $minFare = (float)($veh['min_fare'] ?? 20);
  $calc = $base + ($km*$per_km) + ($minutes*$per_min) + $airportFee;
  return max($minFare, round($calc, 2));
}

// ---------- Entradas del POST ----------
$oAddr = clean('origin_address');
$dAddr = clean('destination_address');
$oLat  = (float)clean('origin_lat');
$oLng  = (float)clean('origin_lng');
$dLat  = (float)clean('destination_lat');
$dLng  = (float)clean('destination_lng');

$dm = (int)clean('distance_m');
$ds = (int)clean('duration_s');

// Validación básica: si falta algo crítico, vuelve al inicio
if ($oAddr === '' || $dAddr === '') {
  header('Location: /'); exit;
}

// ---------- Recalcular server-side con blindaje ----------
$recalc = safe_recalc_distance_duration($oLat, $oLng, $dLat, $dLng, $dm, $ds);
$distance_m = max(0, (int)$recalc['distance_m']);
$duration_s = max(0, (int)$recalc['duration_s']);

$km      = $distance_m > 0 ? ($distance_m / 1000) : 0.0;
$minutes = $duration_s > 0 ? ($duration_s / 60)  : 0.0;

// ---------- BD y zonas ----------
try {
  $db = db(); // PDO del bootstrap
} catch (Throwable $e) {
  // Si tu bootstrap no define db() o falla la conexión
  http_response_code(500);
  echo "<pre>DB error: " . htmlspecialchars($e->getMessage()) . "</pre>";
  exit;
}

// (opcional) asegurar tablas mínimas sin romper si ya existen
try { ensure_min_tables($db); } catch (Throwable $e) { /* no romper */ }

$oZone = safe_find_zone_id($db, $oLat, $oLng);
$dZone = safe_find_zone_id($db, $dLat, $dLng);
$oZoneName = null;
$dZoneName = null;
try { $oZoneName = zone_name($db, $oZone); } catch (Throwable $e) { $oZoneName = null; }
try { $dZoneName = zone_name($db, $dZone); } catch (Throwable $e) { $dZoneName = null; }

// ---------- Catálogo de vehículos ----------
try {
  $vehRows = $db->query("SELECT * FROM vehicles WHERE active=1")->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
  $vehRows = [];
}

// Si no hay vehículos, no rompemos: mostramos vista con aviso
// ---------- Reglas y recargos ----------
$isAirport   = (stripos($oAddr, 'airport') !== false) || (stripos($dAddr, 'airport') !== false);
$airportFee  = $isAirport ? 5.00 : 0.00;
$currency    = 'EUR';

// ---------- Cálculo de precios ----------
$quotes = [];
foreach ($vehRows as $veh) {
  // Asegurar campos clave para evitar notices
  $veh += ['code'=>'', 'name'=>'', 'img'=>'', 'pax'=>'', 'luggage'=>'', 'base'=>0, 'per_km'=>0, 'per_min'=>0, 'min_fare'=>0];

  $final = compute_vehicle_price($db, $veh, $oZone, $dZone, (float)$km, (float)$minutes, (float)$airportFee);

  $capacity = trim(($veh['pax'] ?? '') . ((isset($veh['luggage']) && $veh['luggage']!=='') ? " • {$veh['luggage']} maletas" : ''));

  // Si hay precio por zonas, compute_vehicle_price lo habrá devuelto.
  // Para que la vista sepa si fue zona→zona, intentamos consultarlo aquí también (no obligatorio).
  $zonePrice = null;
  if ($oZone && $dZone && function_exists('zone_price')) {
    try { $zonePrice = zone_price($db, $oZone, $dZone, (string)$veh['code']); } catch (Throwable $e) { $zonePrice = null; }
  }

  $quotes[] = [
    'code'       => (string)$veh['code'],
    'name'       => (string)$veh['name'],
    'img'        => (string)$veh['img'],
    'capacity'   => $capacity,
    'price'      => (float)$final,
    'currency'   => $currency,
    'zone_price' => $zonePrice,   // null si no hay tarifa fija
  ];
}

// ---------- quote_id en sesión (para continuar en booking.php) ----------
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
try {
  $quote_id = bin2hex(random_bytes(8));
} catch (Throwable $e) {
  // Fallback si random_bytes no está disponible
  $quote_id = substr(sha1(uniqid('', true)), 0, 16);
}

$_SESSION['quote'] = [
  'id'          => $quote_id,
  'origin'      => ['address'=>$oAddr,'lat'=>$oLat,'lng'=>$oLng,'zone_id'=>$oZone,'zone_name'=>$oZoneName],
  'destination' => ['address'=>$dAddr,'lat'=>$dLat,'lng'=>$dLng,'zone_id'=>$dZone,'zone_name'=>$dZoneName],
  'distance_m'  => $distance_m,
  'duration_s'  => $duration_s,
  'km'          => $km,
  'minutes'     => $minutes,
  'airport_fee' => $airportFee,
  'currency'    => $currency,
  'quotes'      => $quotes,
];

// ---------- Render ----------
$__view = __DIR__ . '/../views/quote.php';
extract([
  'oAddr'       => $oAddr,
  'dAddr'       => $dAddr,
  'km'          => $km,
  'minutes'     => $minutes,
  'quotes'      => $quotes,
  'distance_m'  => $distance_m,
  'duration_s'  => $duration_s,
  'oZoneName'   => $oZoneName,
  'dZoneName'   => $dZoneName,
  'airportFee'  => $airportFee,
  'currency'    => $currency,
  'quote_id'    => $quote_id,
], EXTR_SKIP);

ob_start();
try {
  include $__view;
} catch (Throwable $e) {
  // Si la vista falla, mostramos error legible (evitar 500 en blanco)
  ob_end_clean();
  http_response_code(500);
  echo "<pre>View error: " . htmlspecialchars($e->getMessage()) . "</pre>";
  exit;
}
$__content = ob_get_clean();

try {
  require __DIR__ . '/../views/layout.php';
} catch (Throwable $e) {
  http_response_code(500);
  echo "<pre>Layout error: " . htmlspecialchars($e->getMessage()) . "</pre>";
  exit;
}

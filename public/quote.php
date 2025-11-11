<?php
// public/quote.php
declare(strict_types=1);

require __DIR__ . '/../app/bootstrap.php';
require __DIR__ . '/../app/helpers/zones.php';
require __DIR__ . '/../app/helpers/pricing.php';
require __DIR__ . '/../app/helpers/distance.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /'); exit; }

/* ---------- Utilidades opcionales (no rompen si ya existen tablas) ---------- */
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

function clean($k){ return isset($_POST[$k]) ? trim((string)$_POST[$k]) : ''; }
function zone_name(PDO $db, ?int $id): ?string {
  if (!$id) return null;
  $st = $db->prepare("SELECT name FROM zones WHERE id=:id");
  $st->execute([':id'=>$id]);
  $r = $st->fetch(PDO::FETCH_ASSOC);
  return $r ? $r['name'] : null;
}

/* ---------- Entradas del POST ---------- */
$oAddr = clean('origin_address');
$dAddr = clean('destination_address');
$oLat  = (float)clean('origin_lat');
$oLng  = (float)clean('origin_lng');
$dLat  = (float)clean('destination_lat');
$dLng  = (float)clean('destination_lng');

$dm = (int)clean('distance_m');
$ds = (int)clean('duration_s');

/* ---------- Re-cálculo server-side (blindaje) ---------- */
$re = recalc_distance_duration($oLat,$oLng,$dLat,$dLng);
$distance_m = $re['distance_m'] ?: $dm;
$duration_s = $re['duration_s'] ?: $ds;

$km      = max(0, $distance_m / 1000);
$minutes = max(0, $duration_s / 60);

/* ---------- BD y zonas ---------- */
$db = db(); // PDO del bootstrap

// (opcional) asegurar tablas mínimas sin romper si ya existen
ensure_min_tables($db);

$oZone = find_zone_id_by_point($db, $oLat, $oLng);
$dZone = find_zone_id_by_point($db, $dLat, $dLng);
$oZoneName = zone_name($db, $oZone);
$dZoneName = zone_name($db, $dZone);

/* ---------- Catálogo de vehículos ---------- */
$vehRows = $db->query("SELECT * FROM vehicles WHERE active=1")->fetchAll(PDO::FETCH_ASSOC);

/* ---------- Reglas y recargos ---------- */
$isAirport   = stripos($oAddr,'airport')!==false || stripos($dAddr,'airport')!==false;
$airportFee  = $isAirport ? 5.00 : 0.00;
$currency    = 'EUR';

/* ---------- Cálculo de precios ---------- */
$quotes = [];
foreach ($vehRows as $veh) {
  // Precio fijo por zonas si existe
  $zonePrice = ($oZone && $dZone) ? zone_price($db, $oZone, $dZone, $veh['code']) : null;

  // Fallback por km/min + mínimos + recargos
  $final = $zonePrice ?? distance_fallback_price($veh, $km, $minutes, $airportFee);

  $quotes[] = [
    'code'      => $veh['code'],
    'name'      => $veh['name'],
    'img'       => $veh['img'],
    'capacity'  => trim(($veh['pax'] ?? '') . ((isset($veh['luggage']) && $veh['luggage']!=='') ? " • {$veh['luggage']} maletas" : '')),
    'price'     => $final,
    'currency'  => $currency,
    'zone_price'=> $zonePrice,   // null si no hay tarifa fija
  ];
}

/* ---------- quote_id sencillo en sesión (para booking.php) ---------- */
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
$quote_id = bin2hex(random_bytes(8));
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

/* ---------- Render ---------- */
$__view = __DIR__ . '/../views/quote.php';
extract([
  'oAddr'=>$oAddr,
  'dAddr'=>$dAddr,
  'km'=>$km,
  'minutes'=>$minutes,
  'quotes'=>$quotes,
  'distance_m'=>$distance_m,
  'duration_s'=>$duration_s,
  'oZoneName'=>$oZoneName,
  'dZoneName'=>$dZoneName,
  'airportFee'=>$airportFee,
  'currency'=>$currency,
  'quote_id'=>$quote_id,
], EXTR_SKIP);

ob_start(); include $__view; $__content = ob_get_clean();
require __DIR__ . '/../views/layout.php';

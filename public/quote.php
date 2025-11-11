<?php
// public/quote.php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require __DIR__ . '/../app/bootstrap.php';

// Helpers
require_once __DIR__ . '/../app/helpers/zones.php';
require_once __DIR__ . '/../app/helpers/pricing.php';
require_once __DIR__ . '/../app/helpers/distance.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /'); exit; }

/* ---------- Utilidades ---------- */
function clean(string $k): string { return isset($_POST[$k]) ? trim((string)$_POST[$k]) : ''; }

function ensure_min_tables(PDO $db): void {
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

  $db->exec("
    CREATE TABLE IF NOT EXISTS zones (
      id     INT AUTO_INCREMENT PRIMARY KEY,
      name   VARCHAR(100) NOT NULL UNIQUE,
      geom   POLYGON NOT NULL,
      active TINYINT(1) NOT NULL DEFAULT 1
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  ");

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

function zone_name(PDO $db, ?int $id): ?string {
  if (!$id) return null;
  $st = $db->prepare("SELECT name FROM zones WHERE id=:id");
  $st->execute([':id'=>$id]);
  $r = $st->fetch(PDO::FETCH_ASSOC);
  return $r ? (string)$r['name'] : null;
}

/* ---------- Datos del POST ---------- */
$oAddr = clean('origin_address');
$dAddr = clean('destination_address');
$oLat  = (float)clean('origin_lat');
$oLng  = (float)clean('origin_lng');
$dLat  = (float)clean('destination_lat');
$dLng  = (float)clean('destination_lng');

$dm = (int)clean('distance_m');
$ds = (int)clean('duration_s');

if ($oAddr === '' || $dAddr === '') { header('Location: /'); exit; }

/* ---------- Recalcular distancia/tiempo (solo para mostrar, no precio) ---------- */
$distance_m = $dm;
$duration_s = $ds;
try {
  $re = recalc_distance_duration($oLat,$oLng,$dLat,$dLng);
  if (!empty($re['distance_m'])) $distance_m = (int)$re['distance_m'];
  if (!empty($re['duration_s'])) $duration_s = (int)$re['duration_s'];
} catch (Throwable $e) {
  // si falla, usamos los del POST sin romper
}
$km      = max(0, $distance_m / 1000);
$minutes = max(0, $duration_s / 60);

/* ---------- BD, tablas y zonas ---------- */
try { $db = db(); } catch (Throwable $e) { http_response_code(500); echo "<pre>DB error: ".htmlspecialchars($e->getMessage())."</pre>"; exit; }
ensure_min_tables($db);

$oZone = null; $dZone = null;
try { $oZone = find_zone_id_by_point($db, $oLat, $oLng); } catch (Throwable $e) {}
try { $dZone = find_zone_id_by_point($db, $dLat, $dLng); } catch (Throwable $e) {}

$oZoneName = zone_name($db, $oZone);
$dZoneName = zone_name($db, $dZone);

/* ---------- Vehículos ---------- */
$vehRows = [];
try {
  $vehRows = $db->query("SELECT * FROM vehicles WHERE active=1")->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {}

/* ---------- PRECIOS: SOLO tarifa de ZONAS (sin sumar nada más) ---------- */
$currency = 'EUR';
$quotes = [];

foreach ($vehRows as $veh) {
  $veh += ['code'=>'', 'name'=>'', 'img'=>'', 'pax'=>'', 'luggage'=>''];
  $zonePrice = null;

  if ($oZone && $dZone) {
    try { $zonePrice = zone_price($db, (int)$oZone, (int)$dZone, (string)$veh['code']); }
    catch (Throwable $e) { $zonePrice = null; }
  }

  // Si no hay precio definido para la combinación, lo marcamos como no disponible
  $quotes[] = [
    'code'       => (string)$veh['code'],
    'name'       => (string)$veh['name'],
    'img'        => (string)$veh['img'],
    'capacity'   => trim(($veh['pax'] ?? '') . ((isset($veh['luggage']) && $veh['luggage']!=='') ? " • {$veh['luggage']} maletas" : '')),
    'price'      => ($zonePrice !== null) ? (float)$zonePrice : null, // << SOLO zona
    'currency'   => $currency,
    'zone_price' => $zonePrice, // para la vista
  ];
}

/* ---------- Guardar en sesión para continuar reserva ---------- */
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
  'currency'    => $currency,
  'quotes'      => $quotes,
];

/* ---------- Render ---------- */
$__view = __DIR__ . '/../views/quote.php';

// variables para la vista (incluimos las que espera: origin_address/destination_address)
extract([
  'origin_address' => $oAddr,
  'destination_address' => $dAddr,
  'oAddr'       => $oAddr,
  'dAddr'       => $dAddr,
  'oZoneName'   => $oZoneName,
  'dZoneName'   => $dZoneName,
  'distance_m'  => $distance_m,
  'duration_s'  => $duration_s,
  'km'          => $km,
  'minutes'     => $minutes,
  'currency'    => $currency,
  'quotes'      => $quotes,
  'quote_id'    => $quote_id,
], EXTR_SKIP);

ob_start();
include $__view;
$__content = ob_get_clean();

require __DIR__ . '/../views/layout.php';

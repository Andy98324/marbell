<?php
require __DIR__.'/../app/bootstrap.php';
require __DIR__.'/../app/helpers/zones.php';
require __DIR__.'/../app/helpers/pricing.php';
require __DIR__.'/../app/helpers/distance.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /'); exit; }

function clean($k){ return isset($_POST[$k]) ? trim((string)$_POST[$k]) : ''; }

$oAddr = clean('origin_address');
$dAddr = clean('destination_address');
$oLat  = (float)clean('origin_lat');
$oLng  = (float)clean('origin_lng');
$dLat  = (float)clean('destination_lat');
$dLng  = (float)clean('destination_lng');

$dm = (int)clean('distance_m');  $ds = (int)clean('duration_s');
// Recalculo server-side para blindaje
$re = recalc_distance_duration($oLat,$oLng,$dLat,$dLng);
$distance_m = $re['distance_m'] ?: $dm;
$duration_s = $re['duration_s'] ?: $ds;
$km = max(0, $distance_m/1000);
$minutes = max(0, $duration_s/60);

$db = db(); // tu PDO del bootstrap
$oZone = find_zone_id_by_point($db, $oLat,$oLng);
$dZone = find_zone_id_by_point($db, $dLat,$dLng);

// catálogo vehículos
$vehRows = $db->query("SELECT * FROM vehicles WHERE active=1")->fetchAll(PDO::FETCH_ASSOC);

// reglas (ejemplo)
$isAirport = stripos($oAddr,'airport')!==false || stripos($dAddr,'airport')!==false;
$airportFee = $isAirport ? 5.00 : 0.00;

$quotes = [];
foreach ($vehRows as $veh) {
  $zonePrice = ($oZone && $dZone) ? zone_price($db, $oZone, $dZone, $veh['code']) : null;
  $final = $zonePrice ?? distance_fallback_price($veh, $km, $minutes, $airportFee);
  $quotes[] = [
    'code'     => $veh['code'],
    'name'     => $veh['name'],
    'img'      => $veh['img'],
    'capacity' => ($veh['pax'] ?? '') . (isset($veh['luggage']) ? " • {$veh['luggage']} maletas" : ''),
    'price'    => $final
  ];
}

$__view = __DIR__.'/../views/quote.php';
extract(compact('oAddr','dAddr','km','minutes','quotes','distance_m','duration_s'), EXTR_SKIP);
ob_start(); include $__view; $__content = ob_get_clean();
require __DIR__.'/../views/layout.php';

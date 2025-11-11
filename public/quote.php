<?php
// public/quote.php

declare(strict_types=1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 🔹 MUY IMPORTANTE: carga tu entorno real
require __DIR__ . '/../app/bootstrap.php';

// Solo por POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /'); exit; }

// Entradas
function clean($k){ return isset($_POST[$k]) ? trim((string)$_POST[$k]) : ''; }
$origin_address      = clean('origin_address');
$destination_address = clean('destination_address');
$distance_m          = (int) (clean('distance_m') ?: 0);
$duration_s          = (int) (clean('duration_s') ?: 0);

$km      = max(0, $distance_m / 1000);
$minutes = max(0, $duration_s / 60);

// Precios demo (mueve a BD si quieres)
$fleetPricing = [
  'sedan'   => ['name'=>t('fleet.sedan'),   'img'=>'/assets/images/Skoda.index.png',        'capacity'=>'1-3 pax • 2 maletas','base'=>12,'per_km'=>1.10,'per_min'=>0.15,'min_fare'=>25],
  'premium' => ['name'=>t('fleet.premium'), 'img'=>'/assets/images/sedan_premium.index.png', 'capacity'=>'1-3 pax • 2 maletas','base'=>18,'per_km'=>1.50,'per_min'=>0.20,'min_fare'=>40],
  'minivan' => ['name'=>t('fleet.minivan'), 'img'=>'/assets/images/minivan.index.png',       'capacity'=>'1-7 pax • 6 maletas','base'=>20,'per_km'=>1.35,'per_min'=>0.18,'min_fare'=>45],
  'minibus' => ['name'=>t('fleet.minibus'), 'img'=>'/assets/images/microbus.index.png',      'capacity'=>'1-16 pax','base'=>40,'per_km'=>2.00,'per_min'=>0.00,'min_fare'=>90],
];

$isAirport   = stripos($origin_address,'airport')!==false || stripos($destination_address,'airport')!==false;
$airport_fee = $isAirport ? 5.00 : 0.00;

$quotes = [];
foreach ($fleetPricing as $code=>$cfg){
  $raw = $cfg['base'] + $km*$cfg['per_km'] + $minutes*$cfg['per_min'] + $airport_fee;
  $price = ceil(max($raw, $cfg['min_fare']));
  $quotes[] = ['code'=>$code,'name'=>$cfg['name'],'img'=>$cfg['img'],'capacity'=>$cfg['capacity'],'price'=>$price];
}

// Render: pintamos la vista a buffer y la inyectamos en el layout
$__view = __DIR__ . '/../views/quote.php';
extract(compact('origin_address','destination_address','km','minutes','quotes','distance_m','duration_s'), EXTR_SKIP);
ob_start(); include $__view; $__content = ob_get_clean();
require __DIR__ . '/../views/layout.php';

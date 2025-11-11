<?php
// public/quote.php

// DEBUG (quitar en prod si ya gestionas errores)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Solo por POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /'); exit; }

// --- Fallbacks mínimos para funcionar aunque no esté el bootstrap ---
if (!function_exists('t')) {
  function t($key) {
    $map = [
      // básicos
      'brand'=>'TransferMarbell',
      'action.back'=>'Volver',
      'home.h1'=>'Transfer Marbella',
      'home.fleet_title'=>'Nuestra flota',
      'home.from'=>'Origen', 'home.to'=>'Destino',
      'home.distance'=>'Distancia', 'home.duration'=>'Duración',
      'home.select'=>'Seleccionar',
      'home.quote_disclaimer'=>'Precio estimado. Puede variar según tráfico u horarios.',
      'home.badge_247'=>'Servicio 24/7',
      'home.badge_fixed'=>'Precios fijos',
      'home.badge_drivers'=>'Conductores profesionales',
      // navegación (para que no veas NAV.HOME)
      'nav.home'=>'Inicio', 'nav.about'=>'Sobre nosotros',
      'nav.services'=>'Servicios', 'nav.fleet'=>'Flota',
      'nav.language'=>'Idioma',
      // flota
      'fleet.sedan'=>'Sedán', 'fleet.premium'=>'Sedán Premium',
      'fleet.minivan'=>'Minivan', 'fleet.minibus'=>'Minibús',
    ];
    return $map[$key] ?? $key;
  }
}
if (!function_exists('current_lang')) {
  function current_lang() { return 'es'; }
}

// --- Datos de la ruta ---
function clean($k){ return isset($_POST[$k]) ? trim((string)$_POST[$k]) : ''; }
$origin_address      = clean('origin_address');
$origin_lat          = (float) clean('origin_lat');
$origin_lng          = (float) clean('origin_lng');
$destination_address = clean('destination_address');
$destination_lat     = (float) clean('destination_lat');
$destination_lng     = (float) clean('destination_lng');
$distance_m          = (int)   clean('distance_m'); // m
$duration_s          = (int)   clean('duration_s'); // s

$km      = max(0, $distance_m / 1000);
$minutes = max(0, $duration_s / 60);

// --- Tarifas demo (migrará a BD) ---
$fleetPricing = [
  'sedan'   => ['name'=>t('fleet.sedan'),   'img'=>'/assets/images/Skoda.index.png',            'capacity'=>'1-3 pax • 2 maletas','base'=>12,'per_km'=>1.10,'per_min'=>0.15,'min_fare'=>25],
  'premium' => ['name'=>t('fleet.premium'), 'img'=>'/assets/images/sedan_premium.index.png',     'capacity'=>'1-3 pax • 2 maletas','base'=>18,'per_km'=>1.50,'per_min'=>0.20,'min_fare'=>40],
  'minivan' => ['name'=>t('fleet.minivan'), 'img'=>'/assets/images/minivan.index.png',           'capacity'=>'1-7 pax • 6 maletas','base'=>20,'per_km'=>1.35,'per_min'=>0.18,'min_fare'=>45],
  'minibus' => ['name'=>t('fleet.minibus'), 'img'=>'/assets/images/microbus.index.png',          'capacity'=>'1-16 pax','base'=>40,'per_km'=>2.00,'per_min'=>0.00,'min_fare'=>90],
];

$isAirport = stripos($origin_address,'airport')!==false || stripos($destination_address,'airport')!==false;
$airport_fee = $isAirport ? 5.00 : 0.00;

$quotes = [];
foreach ($fleetPricing as $code=>$cfg){
  $raw = $cfg['base'] + $km*$cfg['per_km'] + $minutes*$cfg['per_min'] + $airport_fee;
  $price = ceil(max($raw, $cfg['min_fare']));
  $quotes[] = ['code'=>$code,'name'=>$cfg['name'],'img'=>$cfg['img'],'capacity'=>$cfg['capacity'],'price'=>$price];
}

// --- Render de la vista a buffer ---
$__view = __DIR__ . '/../views/quote.php';
$__vars = compact('origin_address','destination_address','km','minutes','quotes','distance_m','duration_s');

// 1) variables disponibles en la vista
extract($__vars, EXTR_SKIP);

// 2) pintar vista a buffer
ob_start();
include $__view;
$__content = ob_get_clean();

// 3) compatibilidad con distintos layouts
$content = $__content;           // común
$yield   = $__content;           // algunos layouts usan $yield
$body    = $__content;           // otros usan $body
$page_content = $__content;      // por si acaso

// 4) incluir layout (ya mete header y footer)
include __DIR__ . '/../views/layout.php';

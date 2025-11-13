<?php
// public/review-booking.php
declare(strict_types=1);

ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);

require __DIR__ . '/../app/bootstrap.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function clean_post(string $k, $default='') {
    return isset($_POST[$k]) ? trim((string)$_POST[$k]) : $default;
}

/** Devuelve true si la hora está entre 23:00 y 07:59 */
function is_night_time(string $time): bool {
    if ($time === '') return false;
    $parts = explode(':', $time);
    if (count($parts) < 1) return false;
    $h = (int)$parts[0];
    return ($h >= 23 || $h < 8);
}

/** Detecta si el TRAYECTO ES DESDE AEROPUERTO (origen = aeropuerto) */
function is_airport_origin(string $origin): bool {
    $s = function_exists('mb_strtolower') ? mb_strtolower($origin, 'UTF-8') : strtolower($origin);
    return (
        strpos($s, 'aeropuerto') !== false ||
        strpos($s, 'airport')    !== false ||
        strpos($s, 'agp')        !== false
    );
}

if (empty($_SESSION['quote']) || empty($_SESSION['booking'])) {
    header('Location: /'); exit;
}

$quote   = $_SESSION['quote'];
$booking = $_SESSION['booking'];

$base_out_price    = (float)($booking['price'] ?? 0);                      // precio zona ida
$base_return_price = $booking['return_price'] !== null
                        ? (float)$booking['return_price']
                        : null;                                            // precio zona vuelta (si hay)
$vehicle           = $booking['vehicle'] ?? [];
$vehicle_code      = $booking['vehicle_code'] ?? '';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /booking.php'); exit;
}

// Datos del formulario
$data = [
    'vehicle_code'     => clean_post('vehicle_code', $vehicle_code),
    'first_name'       => clean_post('first_name'),
    'last_name'        => clean_post('last_name'),
    'email'            => clean_post('email'),
    'phone'            => clean_post('phone'),
    'service_date'     => clean_post('service_date'),
    'service_time'     => clean_post('service_time'),
    'passengers'       => (int)clean_post('passengers', '1'),
    'luggage'          => (int)clean_post('luggage', '0'),
    'flight_number'    => clean_post('flight_number'),
    'train_number'     => clean_post('train_number'),
    'return_trip'      => clean_post('return_trip','no') === 'yes',
    'return_date'      => clean_post('return_date'),
    'return_time'      => clean_post('return_time'),
    'extra_child_seat' => (int)clean_post('extra_child_seat','0'),
    'extra_booster'    => (int)clean_post('extra_booster','0'),
    'extra_bike'       => (int)clean_post('extra_bike','0'),
    'extra_golf'       => (int)clean_post('extra_golf','0'),
    'notes'            => clean_post('notes'),
];

// Extras: 10 € por unidad y trayecto
$EXTRA_UNIT = 10.0;

$extras_out  = (
    $data['extra_child_seat'] +
    $data['extra_booster'] +
    $data['extra_bike'] +
    $data['extra_golf']
) * $EXTRA_UNIT;

$extras_return = 0.0;
if ($data['return_trip']) {
    // mismas unidades también en la vuelta
    $extras_return = $extras_out;
}

// Nocturnidad: +10% del precio de zona (no de los extras) por trayecto
$night_surcharge_out = 0.0;
$night_surcharge_ret = 0.0;

if (is_night_time($data['service_time'] ?? '')) {
    $night_surcharge_out = $base_out_price * 0.10;
}

if ($data['return_trip'] && $base_return_price !== null && is_night_time($data['return_time'] ?? '')) {
    $night_surcharge_ret = $base_return_price * 0.10;
}

// Totales
$total_out    = $base_out_price + $extras_out + $night_surcharge_out;
$total_return = 0.0;

if ($data['return_trip'] && $base_return_price !== null) {
    $total_return = $base_return_price + $extras_return + $night_surcharge_ret;
}

$grand_total = $total_out + $total_return;

// Info ruta
$origin_address      = $quote['origin']['address']      ?? '';
$destination_address = $quote['destination']['address'] ?? '';
$km                  = $quote['km'] ?? 0;
$minutes             = $quote['minutes'] ?? 0;
$currency            = $quote['currency'] ?? 'EUR';

// Info suplemento aeropuerto: solo si origen es aeropuerto
$airport_fee = (float)($quote['airport_fee'] ?? 0);
$from_airport = is_airport_origin($origin_address);

// Guardar en sesión por si luego quieres confirmar definitivamente
$_SESSION['review'] = [
    'data'               => $data,
    'base_out_price'     => $base_out_price,
    'base_return_price'  => $base_return_price,
    'extras_out'         => $extras_out,
    'extras_return'      => $extras_return,
    'night_out'          => $night_surcharge_out,
    'night_return'       => $night_surcharge_ret,
    'total_out'          => $total_out,
    'total_return'       => $total_return,
    'grand_total'        => $grand_total,
];

// Render
$__view = __DIR__ . '/../views/review-booking.php';
extract([
    'origin_address'      => $origin_address,
    'destination_address' => $destination_address,
    'km'                  => $km,
    'minutes'             => $minutes,
    'vehicle'             => $vehicle,
    'base_out_price'      => $base_out_price,
    'base_return_price'   => $base_return_price,
    'data'                => $data,
    'extras_out'          => $extras_out,
    'extras_return'       => $extras_return,
    'night_surcharge_out' => $night_surcharge_out,
    'night_surcharge_ret' => $night_surcharge_ret,
    'total_out'           => $total_out,
    'total_return'        => $total_return,
    'grand_total'         => $grand_total,
    'airport_fee'         => $airport_fee,
    'from_airport'        => $from_airport,
], EXTR_SKIP);

ob_start(); include $__view; $__content = ob_get_clean();
require __DIR__ . '/../views/layout.php';

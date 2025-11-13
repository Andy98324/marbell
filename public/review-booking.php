<?php
// public/review-booking.php
declare(strict_types=1);

ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(EALL);

require __DIR__ . '/../app/bootstrap.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function clean_post(string $k, $default='') {
    return isset($_POST[$k]) ? trim((string)$_POST[$k]) : $default;
}

if (empty($_SESSION['quote']) || empty($_SESSION['booking'])) {
    header('Location: /'); exit;
}

$quote   = $_SESSION['quote'];
$booking = $_SESSION['booking'];

$base_out_price    = (float)($booking['price'] ?? 0);
$base_return_price = $booking['return_price'] !== null ? (float)$booking['return_price'] : null;
$vehicle           = $booking['vehicle'] ?? [];
$vehicle_code      = $booking['vehicle_code'] ?? '';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /booking.php'); exit;
}

// Datos del formulario
$data = [
    'vehicle_code'   => clean_post('vehicle_code', $vehicle_code),
    'first_name'     => clean_post('first_name'),
    'last_name'      => clean_post('last_name'),
    'email'          => clean_post('email'),
    'phone'          => clean_post('phone'),
    'service_date'   => clean_post('service_date'),
    'service_time'   => clean_post('service_time'),
    'passengers'     => (int)clean_post('passengers', '1'),
    'luggage'        => (int)clean_post('luggage', '0'),
    'flight_number'  => clean_post('flight_number'),
    'train_number'   => clean_post('train_number'),
    'return_trip'    => clean_post('return_trip','no') === 'yes',
    'return_date'    => clean_post('return_date'),
    'return_time'    => clean_post('return_time'),
    'extra_child_seat' => (int)clean_post('extra_child_seat','0'),
    'extra_booster'    => (int)clean_post('extra_booster','0'),
    'extra_bike'       => (int)clean_post('extra_bike','0'),
    'extra_golf'       => (int)clean_post('extra_golf','0'),
    'notes'          => clean_post('notes'),
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
    $extras_return = $extras_out; // mismas unidades en la vuelta
}

// Totales
$total_out    = $base_out_price + $extras_out;
$total_return = 0.0;
if ($data['return_trip'] && $base_return_price !== null) {
    $total_return = $base_return_price + $extras_return;
}

$grand_total = $total_out + $total_return;

// Guardar en sesión por si luego quieres confirmar definitivamente
$_SESSION['review'] = [
    'data'             => $data,
    'base_out_price'   => $base_out_price,
    'base_return_price'=> $base_return_price,
    'extras_out'       => $extras_out,
    'extras_return'    => $extras_return,
    'total_out'        => $total_out,
    'total_return'     => $total_return,
    'grand_total'      => $grand_total,
];

// Datos para vista
$origin_address      = $quote['origin']['address']      ?? '';
$destination_address = $quote['destination']['address'] ?? '';
$km                  = $quote['km'] ?? 0;
$minutes             = $quote['minutes'] ?? 0;
$currency            = $quote['currency'] ?? 'EUR';

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
    'total_out'           => $total_out,
    'total_return'        => $total_return,
    'grand_total'         => $grand_total,
], EXTR_SKIP);

ob_start(); include $__view; $__content = ob_get_clean();
require __DIR__ . '/../views/layout.php';

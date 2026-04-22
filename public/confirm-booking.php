<?php
// public/confirm-booking.php
declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/helpers/voucher.php';

// Solo POST
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Location: /');
    exit;
}

$payloadB64 = $_POST['payload'] ?? '';
$payloadB64 = is_string($payloadB64) ? trim($payloadB64) : '';

if ($payloadB64 === '' || strlen($payloadB64) > 20000) {
    header('Location: /');
    exit;
}

$json = base64_decode($payloadB64, true);
if ($json === false) {
    header('Location: /');
    exit;
}

$data = json_decode($json, true);
if (!is_array($data)) {
    header('Location: /');
    exit;
}

function make_ref(string $suffix): string
{
    $date = date('Ymd-His');
    $rnd  = bin2hex(random_bytes(4));
    return "WEB-{$date}-{$rnd}-{$suffix}";
}

// Datos base
$origin_address      = (string)($data['origin_address'] ?? '');
$destination_address = (string)($data['destination_address'] ?? '');

$first = (string)($data['first_name'] ?? '');
$last  = (string)($data['last_name'] ?? '');
$fullName = trim($first . ' ' . $last);

$email = (string)($data['email'] ?? '');
$phone = (string)($data['phone'] ?? '');
$notes = (string)($data['notes'] ?? '');

$passengers = (int)($data['passengers'] ?? 1);

// Vehículo
$vehicle_name     = (string)($data['vehicle_name'] ?? '');
$vehicle_capacity = (string)($data['vehicle_capacity'] ?? '');
$vehicle_code     = (string)($data['vehicle_code'] ?? '');

// Extras
$extra_child_seat = (int)($data['extra_child_seat'] ?? 0);
$extra_booster    = (int)($data['extra_booster'] ?? 0);
$extra_bike       = (int)($data['extra_bike'] ?? 0);
$extra_golf       = (int)($data['extra_golf'] ?? 0);

$extras_arr = [
    'Sillita infantil' => $extra_child_seat,
    'Alzador'          => $extra_booster,
    'Bicicleta'        => $extra_bike,
    'Palos de golf'    => $extra_golf,
];

// Precios ida
$total_out           = (float)($data['total_out'] ?? 0);
$base_out_price      = (float)($data['base_out_price'] ?? 0);
$extras_out          = (float)($data['extras_out'] ?? 0);
$night_surcharge_out = (float)($data['night_surcharge_out'] ?? 0);
$airport_fee_out     = (float)($data['airport_fee_out'] ?? 0);

// Detectar vuelta
$return_trip = (string)($data['return_trip'] ?? 'no');
$return_yes =
    ($return_trip === 'yes')
    || !empty($data['return_date'])
    || !empty($data['return_time']);

// Precios vuelta
$base_return_price = $data['base_return_price'] ?? null;
if ($base_return_price !== null) {
    $base_return_price = (float)$base_return_price;
}

$total_return        = (float)($data['total_return'] ?? 0);
$extras_return       = (float)($data['extras_return'] ?? 0);
$night_surcharge_ret = (float)($data['night_surcharge_ret'] ?? 0);

// ===== OUT =====
$ref_out = make_ref('OUT');

$reserva_out = [
    'ref'               => $ref_out,
    'fecha'             => (string)($data['service_date'] ?? ''),
    'hora'              => (string)($data['service_time'] ?? ''),
    'origen'            => $origin_address,
    'destino'           => $destination_address,
    'pax'               => $passengers,
    'nombre'            => $fullName,
    'telefono'          => $phone,
    'email'             => $email,
    'notas'             => $notes,
    'tipo'              => 'OUT',
    'issued_at'         => date('Y-m-d H:i'),
    'vehicle_name'      => $vehicle_name,
    'vehicle_capacity'  => $vehicle_capacity,
    'vehicle_code'      => $vehicle_code,
    'extras'            => $extras_arr,
    'precio'            => $total_out,
    'price_base'        => $base_out_price,
    'price_extras'      => $extras_out,
    'price_night'       => $night_surcharge_out,
    'price_airport_fee' => $airport_fee_out,
];

$files_out = save_voucher_files($reserva_out);

// ===== RET =====
$ref_ret = null;
$files_ret = null;

if ($return_yes) {
    $ref_ret = make_ref('RET');

    $reserva_ret = [
        'ref'               => $ref_ret,
        'fecha'             => (string)($data['return_date'] ?? ''),
        'hora'              => (string)($data['return_time'] ?? ''),
        'origen'            => $destination_address,
        'destino'           => $origin_address,
        'pax'               => $passengers,
        'nombre'            => $fullName,
        'telefono'          => $phone,
        'email'             => $email,
        'notas'             => $notes,
        'tipo'              => 'RET',
        'issued_at'         => date('Y-m-d H:i'),
        'vehicle_name'      => $vehicle_name,
        'vehicle_capacity'  => $vehicle_capacity,
        'vehicle_code'      => $vehicle_code,
        'extras'            => $extras_arr,
        'precio'            => $total_return,
        'price_base'        => (float)($base_return_price ?? 0),
        'price_extras'      => $extras_return,
        'price_night'       => $night_surcharge_ret,
        'price_airport_fee' => 0.0,
    ];

    $files_ret = save_voucher_files($reserva_ret);
}

// Cargar solo la vista
require __DIR__ . '/../views/confirm-booking.php';
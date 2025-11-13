<?php
// public/booking.php
declare(strict_types=1);

ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);

require __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/helpers/pricing.php';
require_once __DIR__ . '/../app/helpers/zones.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// pequeña ayuda
function clean_post(string $k): string {
    return isset($_POST[$k]) ? trim((string)$_POST[$k]) : '';
}

// Necesitamos una cotización previa en sesión
if (empty($_SESSION['quote'])) {
    header('Location: /'); exit;
}

$quote = $_SESSION['quote'];

// MODO POST: usuario acaba de elegir vehículo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $vehicle_code = clean_post('vehicle_code');
    if ($vehicle_code === '') {
        header('Location: /quote.php'); exit;
    }

    // Conexión BD
    try {
        $db = db();
    } catch (Throwable $e) {
        http_response_code(500);
        echo "<pre>DB error: ".htmlspecialchars($e->getMessage())."</pre>";
        exit;
    }

    // Recuperar vehículo de la tabla vehicles
    $st = $db->prepare("SELECT * FROM vehicles WHERE code = :c AND active = 1");
    $st->execute([':c' => $vehicle_code]);
    $vehicle = $st->fetch(PDO::FETCH_ASSOC);

    if (!$vehicle) {
        // Código inválido o vehículo inactivo → volver a resultados
        header('Location: /quote.php'); exit;
    }

    // Zonas origen/destino ya calculadas en la cotización
    $oZoneId = $quote['origin']['zone_id']      ?? null;
    $dZoneId = $quote['destination']['zone_id'] ?? null;

    $price = null;
    if ($oZoneId && $dZoneId) {
        try {
            $price = zone_price($db, (int)$oZoneId, (int)$dZoneId, $vehicle_code);
        } catch (Throwable $e) {
            $price = null;
        }
    }

    // Si no hubiera precio de zona (no debería ocurrir si solo mostramos con precio),
    // podemos buscarlo en la lista de quotes como fallback:
    if ($price === null && !empty($quote['quotes']) && is_array($quote['quotes'])) {
        foreach ($quote['quotes'] as $q) {
            if (($q['code'] ?? '') === $vehicle_code && $q['price'] !== null) {
                $price = (float)$q['price'];
                break;
            }
        }
    }

    // Guardamos la selección en sesión para poder recargar/cambiar idioma luego
    $_SESSION['booking'] = [
        'vehicle_code' => $vehicle_code,
        'vehicle'      => $vehicle,
        'price'        => $price,
    ];

} else {
    // MODO GET: recarga / cambio de idioma
    if (empty($_SESSION['booking'])) {
        header('Location: /'); exit;
    }
}

// Datos comunes (desde sesión siempre)
$origin_address      = $quote['origin']['address']      ?? '';
$destination_address = $quote['destination']['address'] ?? '';
$distance_m          = $quote['distance_m'] ?? 0;
$duration_s          = $quote['duration_s'] ?? 0;
$km                  = $quote['km'] ?? 0;
$minutes             = $quote['minutes'] ?? 0;
$currency            = $quote['currency'] ?? 'EUR';

$booking = $_SESSION['booking'] ?? null;
$vehicle = $booking['vehicle'] ?? null;
$price   = $booking['price'] ?? null;
$vehicle_code = $booking['vehicle_code'] ?? '';

if (!$vehicle) {
    header('Location: /quote.php'); exit;
}

// Preparar datos para la vista
$__view = __DIR__ . '/../views/booking.php';
extract([
    'origin_address'      => $origin_address,
    'destination_address' => $destination_address,
    'km'                  => $km,
    'minutes'             => $minutes,
    'vehicle'             => $vehicle,
    'price'               => $price,
    'currency'            => $currency,
    'vehicle_code'        => $vehicle_code,
], EXTR_SKIP);

ob_start(); include $__view; $__content = ob_get_clean();
require __DIR__ . '/../views/layout.php';

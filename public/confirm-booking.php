<?php
// public/confirm-booking.php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/helpers/mail.php';
require_once __DIR__ . '/../app/helpers/voucher.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (
    empty($_SESSION['quote']) ||
    empty($_SESSION['booking']) ||
    empty($_SESSION['review'])
) {
    header('Location: /');
    exit;
}

if (!function_exists('save_voucher_html') && !function_exists('save_voucher_files')) {
    throw new RuntimeException('No existe ninguna función de voucher en app/helpers/voucher.php');
}

$quote   = $_SESSION['quote'];
$booking = $_SESSION['booking'];
$review  = $_SESSION['review'];

$data = is_array($review['data'] ?? null) ? $review['data'] : [];

$base_out_price    = (float)($review['base_out_price'] ?? 0);
$base_return_price = array_key_exists('base_return_price', $review) && $review['base_return_price'] !== null
    ? (float)$review['base_return_price']
    : null;

$extras_out    = (float)($review['extras_out'] ?? 0);
$extras_return = (float)($review['extras_return'] ?? 0);
$night_out     = (float)($review['night_out'] ?? 0);
$night_ret     = (float)($review['night_return'] ?? 0);
$total_out     = (float)($review['total_out'] ?? 0);
$total_return  = (float)($review['total_return'] ?? 0);
$grand_total   = (float)($review['grand_total'] ?? 0);

$origin_address      = (string)($quote['origin']['address'] ?? '');
$destination_address = (string)($quote['destination']['address'] ?? '');

try {
    $db = db();
} catch (Throwable $e) {
    http_response_code(500);
    echo '<pre>DB error: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</pre>';
    exit;
}

function ensure_reservas_table(PDO $db): void
{
    $db->exec("
        CREATE TABLE IF NOT EXISTS reservas (
          id                       INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          ref_interna              VARCHAR(100) NOT NULL,

          canal                    ENUM('web','agencia','manual') NOT NULL DEFAULT 'web',
          agencia                  VARCHAR(150) NULL,
          agencia_id               INT NULL,
          localizador_agencia      VARCHAR(100) NULL,

          fecha                    DATE NOT NULL,
          hora_presentacion        TIME NOT NULL,
          origen                   VARCHAR(255) NOT NULL,
          destino                  VARCHAR(255) NOT NULL,
          pax                      SMALLINT UNSIGNED NOT NULL DEFAULT 1,

          cliente_nombre           VARCHAR(100) NOT NULL,
          cliente_telefono         VARCHAR(50) NULL,
          cliente_apellidos        VARCHAR(150) NULL,
          cliente_email            VARCHAR(150) NULL,
          cliente_movil            VARCHAR(50) NULL,

          pendiente_confirmar      TINYINT(1) NOT NULL DEFAULT 1,
          vuelo                    VARCHAR(50) NULL,

          extras_json              LONGTEXT NULL,
          notas                    TEXT NULL,

          precio_venta             DECIMAL(10,2) NOT NULL DEFAULT 0,
          precio_chofer            DECIMAL(10,2) NOT NULL DEFAULT 0,

          fs_invoice_id            VARCHAR(100) NULL,
          fs_invoice_pdf_url       TEXT NULL,

          proveedor_id             INT NULL,
          conductor_id             INT NULL,
          vehiculo_id              INT NULL,
          vehiculo_tipo_id         INT NULL,
          servicio_tipo_id         INT NULL,

          telefono_conductor_cache VARCHAR(50) NULL,

          estado                   ENUM('pendiente','confirmado','en_curso','completado','cancelado')
                                   NOT NULL DEFAULT 'pendiente',
          cancel_tipo              ENUM('cliente','proveedor','no_show','otro') NULL,

          created_at               TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
          updated_at               TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

          motivo_cancelacion       VARCHAR(255) NULL,
          cancelada_at             DATETIME NULL,

          rvtc_cgprovcontrato      CHAR(10) NULL,
          rvtc_cgmunicontrato      CHAR(10) NULL,
          rvtc_cgprovinicio        CHAR(10) NULL,
          rvtc_cgmuniinicio        CHAR(10) NULL,
          rvtc_direccioninicio     VARCHAR(255) NULL,
          rvtc_cgprovfin           CHAR(10) NULL,
          rvtc_cgmunifin           CHAR(10) NULL,
          rvtc_direccionfin        VARCHAR(255) NULL,
          rvtc_cgprovlejano        CHAR(10) NULL,
          rvtc_cgmunilejano        CHAR(10) NULL,
          rvtc_direccionlejano     VARCHAR(255) NULL,
          rvtc_fcontrato           DATETIME NULL,
          rvtc_fprevistainicio     DATETIME NULL,
          rvtc_ffin                DATETIME NULL,

          KEY idx_fecha  (fecha),
          KEY idx_canal  (canal),
          KEY idx_estado (estado)
        ) ENGINE=InnoDB
          DEFAULT CHARSET=utf8mb4
          COLLATE=utf8mb4_unicode_ci;
    ");
}

function insert_reserva(PDO $db, array $args): int
{
    $sql = "INSERT INTO reservas (
                canal,
                fecha,
                hora_presentacion,
                origen,
                destino,
                pax,
                cliente_nombre,
                cliente_apellidos,
                cliente_email,
                cliente_movil,
                cliente_telefono,
                vuelo,
                extras_json,
                notas,
                precio_venta,
                created_at,
                updated_at,
                ref_interna
            ) VALUES (
                :canal,
                :fecha,
                :hora_presentacion,
                :origen,
                :destino,
                :pax,
                :cliente_nombre,
                :cliente_apellidos,
                :cliente_email,
                :cliente_movil,
                :cliente_telefono,
                :vuelo,
                :extras_json,
                :notas,
                :precio_venta,
                NOW(),
                NOW(),
                :ref_interna
            )";

    $st = $db->prepare($sql);
    $st->execute($args);

    return (int)$db->lastInsertId();
}

function voucher_pick_path_from_array(array $source, array $keys): ?string
{
    foreach ($keys as $key) {
        if (!empty($source[$key]) && is_string($source[$key]) && is_file($source[$key])) {
            return $source[$key];
        }
    }
    return null;
}

function voucher_pick_nested_path(array $source, array $parents): ?string
{
    foreach ($parents as $parent) {
        if (!isset($source[$parent])) {
            continue;
        }

        if (is_string($source[$parent]) && is_file($source[$parent])) {
            return $source[$parent];
        }

        if (is_array($source[$parent])) {
            $path = voucher_pick_path_from_array(
                $source[$parent],
                ['path', 'file', 'filepath', 'full_path']
            );
            if ($path !== null) {
                return $path;
            }
        }
    }

    return null;
}

function normalize_voucher_attachment($result, string $fallbackRef): ?array
{
    $path = null;

    if (is_string($result) && is_file($result)) {
        $path = $result;
    } elseif (is_array($result)) {
        $path = voucher_pick_path_from_array(
            $result,
            ['pdf_path', 'pdf_file', 'html_path', 'html_file', 'path', 'file', 'filepath', 'full_path']
        );

        if ($path === null) {
            $path = voucher_pick_nested_path($result, ['pdf', 'html']);
        }
    }

    if ($path === null || !is_file($path)) {
        return null;
    }

    $ext  = strtolower((string)pathinfo($path, PATHINFO_EXTENSION));
    $type = 'application/octet-stream';
    $name = 'Voucher-' . $fallbackRef;

    if ($ext === 'pdf') {
        $type = 'application/pdf';
        $name .= '.pdf';
    } elseif ($ext === 'html' || $ext === 'htm') {
        $type = 'text/html';
        $name .= '.html';
    } else {
        $name .= '.' . $ext;
    }

    return [
        'path' => $path,
        'name' => $name,
        'type' => $type,
    ];
}

ensure_reservas_table($db);

$extras_payload = [
    'child_seat' => (int)($data['extra_child_seat'] ?? 0),
    'booster'    => (int)($data['extra_booster'] ?? 0),
    'bike'       => (int)($data['extra_bike'] ?? 0),
    'golf'       => (int)($data['extra_golf'] ?? 0),
    'night_out'  => $night_out,
    'night_ret'  => $night_ret,
];

$extras_json = json_encode($extras_payload, JSON_UNESCAPED_UNICODE);
if ($extras_json === false) {
    $extras_json = '{}';
}

$extras_arr = [
    'Sillita infantil' => (int)($data['extra_child_seat'] ?? 0),
    'Alzador'          => (int)($data['extra_booster'] ?? 0),
    'Bicicleta'        => (int)($data['extra_bike'] ?? 0),
    'Palos de golf'    => (int)($data['extra_golf'] ?? 0),
];

$ref_interna_base = 'WEB-' . date('Ymd-His') . '-' . substr(bin2hex(random_bytes(4)), 0, 8);

// ----------------- INSERTAR IDA -----------------
$ref_interna_ida = $ref_interna_base . '-OUT';

$args_out = [
    ':canal'             => 'web',
    ':fecha'             => !empty($data['service_date']) ? (string)$data['service_date'] : date('Y-m-d'),
    ':hora_presentacion' => !empty($data['service_time']) ? (string)$data['service_time'] : '00:00:00',
    ':origen'            => $origin_address,
    ':destino'           => $destination_address,
    ':pax'               => (int)($data['passengers'] ?? 1),
    ':cliente_nombre'    => (string)($data['first_name'] ?? ''),
    ':cliente_apellidos' => (string)($data['last_name'] ?? ''),
    ':cliente_email'     => (string)($data['email'] ?? ''),
    ':cliente_movil'     => (string)($data['phone'] ?? ''),
    ':cliente_telefono'  => (string)($data['phone'] ?? ''),
    ':vuelo'             => (string)($data['flight_number'] ?? ($data['train_number'] ?? '')),
    ':extras_json'       => $extras_json,
    ':notas'             => (string)($data['notes'] ?? ''),
    ':precio_venta'      => $total_out,
    ':ref_interna'       => $ref_interna_ida,
];

$reserva_id_out = insert_reserva($db, $args_out);

$v_out = [
    'ref'               => $ref_interna_ida,
    'fecha'             => $args_out[':fecha'],
    'hora'              => $args_out[':hora_presentacion'],
    'origen'            => $origin_address,
    'destino'           => $destination_address,
    'pax'               => $args_out[':pax'],
    'nombre'            => trim(((string)($data['first_name'] ?? '')) . ' ' . ((string)($data['last_name'] ?? ''))),
    'telefono'          => (string)($data['phone'] ?? ''),
    'email'             => (string)($data['email'] ?? ''),
    'notas'             => (string)($data['notes'] ?? ''),
    'tipo'              => 'OUT',
    'issued_at'         => date('Y-m-d H:i'),
    'vehicle_name'      => (string)($data['vehicle_name'] ?? ''),
    'vehicle_capacity'  => (string)($data['vehicle_capacity'] ?? ''),
    'vehicle_code'      => (string)($data['vehicle_code'] ?? ''),
    'extras'            => $extras_arr,
    'precio'            => $total_out,
    'price_base'        => $base_out_price,
    'price_extras'      => $extras_out,
    'price_night'       => $night_out,
    'price_airport_fee' => (float)($review['airport_fee_out'] ?? 0),
];

$voucher_out_result = function_exists('save_voucher_files')
    ? save_voucher_files($v_out)
    : save_voucher_html($v_out);

$voucher_out_meta = normalize_voucher_attachment($voucher_out_result, $ref_interna_ida);

// ----------------- INSERTAR VUELTA -----------------
$reserva_id_ret   = null;
$ref_interna_ret  = null;
$voucher_ret_meta = null;

$return_yes = !empty($data['return_trip']) && $base_return_price !== null && $total_return > 0;

if ($return_yes) {
    $ref_interna_ret = $ref_interna_base . '-RET';

    $vuelo_ret = (string)($data['return_flight_number'] ?? ($data['return_train_number'] ?? ''));

    $args_ret = [
        ':canal'             => 'web',
        ':fecha'             => !empty($data['return_date'])
            ? (string)$data['return_date']
            : (!empty($data['service_date']) ? (string)$data['service_date'] : date('Y-m-d')),
        ':hora_presentacion' => !empty($data['return_time'])
            ? (string)$data['return_time']
            : (!empty($data['service_time']) ? (string)$data['service_time'] : '00:00:00'),
        ':origen'            => $destination_address,
        ':destino'           => $origin_address,
        ':pax'               => (int)($data['passengers'] ?? 1),
        ':cliente_nombre'    => (string)($data['first_name'] ?? ''),
        ':cliente_apellidos' => (string)($data['last_name'] ?? ''),
        ':cliente_email'     => (string)($data['email'] ?? ''),
        ':cliente_movil'     => (string)($data['phone'] ?? ''),
        ':cliente_telefono'  => (string)($data['phone'] ?? ''),
        ':vuelo'             => $vuelo_ret,
        ':extras_json'       => $extras_json,
        ':notas'             => (string)($data['notes'] ?? ''),
        ':precio_venta'      => $total_return,
        ':ref_interna'       => $ref_interna_ret,
    ];

    $reserva_id_ret = insert_reserva($db, $args_ret);

    $v_ret = [
        'ref'               => $ref_interna_ret,
        'fecha'             => $args_ret[':fecha'],
        'hora'              => $args_ret[':hora_presentacion'],
        'origen'            => $destination_address,
        'destino'           => $origin_address,
        'pax'               => $args_ret[':pax'],
        'nombre'            => trim(((string)($data['first_name'] ?? '')) . ' ' . ((string)($data['last_name'] ?? ''))),
        'telefono'          => (string)($data['phone'] ?? ''),
        'email'             => (string)($data['email'] ?? ''),
        'notas'             => (string)($data['notes'] ?? ''),
        'tipo'              => 'RET',
        'issued_at'         => date('Y-m-d H:i'),
        'vehicle_name'      => (string)($data['vehicle_name'] ?? ''),
        'vehicle_capacity'  => (string)($data['vehicle_capacity'] ?? ''),
        'vehicle_code'      => (string)($data['vehicle_code'] ?? ''),
        'extras'            => $extras_arr,
        'precio'            => $total_return,
        'price_base'        => (float)$base_return_price,
        'price_extras'      => $extras_return,
        'price_night'       => $night_ret,
        'price_airport_fee' => 0.0,
    ];

    $voucher_ret_result = function_exists('save_voucher_files')
        ? save_voucher_files($v_ret)
        : save_voucher_html($v_ret);

    $voucher_ret_meta = normalize_voucher_attachment($voucher_ret_result, $ref_interna_ret);
}

// ----------------- EMAILS -----------------
$subjectBase   = 'Transfer Marbell - Reserva ' . $ref_interna_base;
$clienteNombre = trim(((string)($data['first_name'] ?? '')) . ' ' . ((string)($data['last_name'] ?? '')));

$attachmentsCliente = [];
if ($voucher_out_meta !== null) {
    $attachmentsCliente[] = $voucher_out_meta;
}
if ($voucher_ret_meta !== null) {
    $attachmentsCliente[] = $voucher_ret_meta;
}

if (!empty($data['email'])) {
    ob_start();
    ?>
    <h2>Gracias por reservar con Transfer Marbell</h2>
    <p>Hola <?= htmlspecialchars($clienteNombre, ENT_QUOTES, 'UTF-8') ?>,</p>
    <p>Hemos recibido tu solicitud de traslado. Estos son los datos principales:</p>

    <ul>
      <li><strong>Referencia ida:</strong> <?= htmlspecialchars($ref_interna_ida, ENT_QUOTES, 'UTF-8') ?></li>
      <?php if ($ref_interna_ret): ?>
        <li><strong>Referencia vuelta:</strong> <?= htmlspecialchars($ref_interna_ret, ENT_QUOTES, 'UTF-8') ?></li>
      <?php endif; ?>
      <li><strong>Origen:</strong> <?= htmlspecialchars($origin_address, ENT_QUOTES, 'UTF-8') ?></li>
      <li><strong>Destino:</strong> <?= htmlspecialchars($destination_address, ENT_QUOTES, 'UTF-8') ?></li>
      <li><strong>Fecha / hora ida:</strong> <?= htmlspecialchars(((string)($data['service_date'] ?? '')) . ' ' . ((string)($data['service_time'] ?? '')), ENT_QUOTES, 'UTF-8') ?></li>
      <?php if ($ref_interna_ret): ?>
        <li><strong>Fecha / hora vuelta:</strong> <?= htmlspecialchars(((string)($data['return_date'] ?? '')) . ' ' . ((string)($data['return_time'] ?? '')), ENT_QUOTES, 'UTF-8') ?></li>
      <?php endif; ?>
      <li><strong>Pasajeros:</strong> <?= (int)($data['passengers'] ?? 1) ?></li>
    </ul>

    <p><strong>Importe total:</strong> <?= number_format($grand_total, 2, ',', '.') ?> €</p>
    <p>Adjuntamos tus vouchers de reserva.</p>
    <p>Gracias por confiar en Transfer Marbell.</p>
    <?php
    $htmlCliente = (string)ob_get_clean();

    send_app_mail(
        (string)$data['email'],
        $subjectBase,
        $htmlCliente,
        $clienteNombre,
        $attachmentsCliente
    );
}

ob_start();
?>
<h2>Nueva reserva web</h2>
<p>Se ha creado una nueva reserva desde la web.</p>

<ul>
  <li><strong>Ref ida:</strong> <?= htmlspecialchars($ref_interna_ida, ENT_QUOTES, 'UTF-8') ?> (ID <?= (int)$reserva_id_out ?>)</li>
  <?php if ($ref_interna_ret): ?>
    <li><strong>Ref vuelta:</strong> <?= htmlspecialchars($ref_interna_ret, ENT_QUOTES, 'UTF-8') ?> (ID <?= (int)$reserva_id_ret ?>)</li>
  <?php endif; ?>
  <li><strong>Cliente:</strong> <?= htmlspecialchars($clienteNombre, ENT_QUOTES, 'UTF-8') ?></li>
  <li><strong>Email:</strong> <?= htmlspecialchars((string)($data['email'] ?? ''), ENT_QUOTES, 'UTF-8') ?></li>
  <li><strong>Teléfono:</strong> <?= htmlspecialchars((string)($data['phone'] ?? ''), ENT_QUOTES, 'UTF-8') ?></li>
  <li><strong>Origen:</strong> <?= htmlspecialchars($origin_address, ENT_QUOTES, 'UTF-8') ?></li>
  <li><strong>Destino:</strong> <?= htmlspecialchars($destination_address, ENT_QUOTES, 'UTF-8') ?></li>
  <li><strong>Total:</strong> <?= number_format($grand_total, 2, ',', '.') ?> €</li>
</ul>
<?php
$htmlAdmin = (string)ob_get_clean();

send_app_mail(
    'reservas@transfermarbell.com',
    'Nueva reserva web - ' . $ref_interna_base,
    $htmlAdmin,
    'Reservas',
    $attachmentsCliente
);

$_SESSION['last_booking_refs'] = [
    'out_id'  => $reserva_id_out,
    'out_ref' => $ref_interna_ida,
    'ret_id'  => $reserva_id_ret,
    'ret_ref' => $ref_interna_ret,
    'email'   => (string)($data['email'] ?? ''),
];

unset($_SESSION['booking'], $_SESSION['review']);

$__view = __DIR__ . '/../views/confirm-booking.php';
if (!is_file($__view)) {
    throw new RuntimeException('No existe la vista: ' . $__view);
}

extract([
    'reserva_id_out' => $reserva_id_out,
    'reserva_id_ret' => $reserva_id_ret,
    'ref_out'        => $ref_interna_ida,
    'ref_ret'        => $ref_interna_ret,
    'email'          => (string)($data['email'] ?? ''),
], EXTR_SKIP);

ob_start();
include $__view;
$__content = (string)ob_get_clean();

require __DIR__ . '/../views/layout.php';
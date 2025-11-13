<?php
// public/confirm-booking.php
declare(strict_types=1);

ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);

require __DIR__ . '/../app/bootstrap.php';
require __DIR__ . '/../app/helpers/mail.php';
require __DIR__ . '/../app/helpers/voucher.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (empty($_SESSION['quote']) || empty($_SESSION['booking']) || empty($_SESSION['review'])) {
    header('Location: /'); exit;
}

$quote   = $_SESSION['quote'];
$booking = $_SESSION['booking'];
$review  = $_SESSION['review'];

$data               = $review['data'];
$base_out_price     = (float)$review['base_out_price'];
$base_return_price  = $review['base_return_price'] !== null ? (float)$review['base_return_price'] : null;
$extras_out         = (float)$review['extras_out'];
$extras_return      = (float)$review['extras_return'];
$night_out          = (float)$review['night_out'];
$night_ret          = (float)$review['night_return'];
$total_out          = (float)$review['total_out'];
$total_return       = (float)$review['total_return'];
$grand_total        = (float)$review['grand_total'];

$origin_address      = $quote['origin']['address']      ?? '';
$destination_address = $quote['destination']['address'] ?? '';

try {
    $db = db();
} catch (Throwable $e) {
    http_response_code(500);
    echo "<pre>DB error: ".htmlspecialchars($e->getMessage())."</pre>";
    exit;
}

/**
 * Crea tabla reservas si no existe.
 */
function ensure_reservas_table(PDO $db): void {
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

ensure_reservas_table($db);

// Extras como JSON para la BD
$extras_payload = [
    'child_seat' => (int)($data['extra_child_seat'] ?? 0),
    'booster'    => (int)($data['extra_booster'] ?? 0),
    'bike'       => (int)($data['extra_bike'] ?? 0),
    'golf'       => (int)($data['extra_golf'] ?? 0),
    'night_out'  => $night_out,
    'night_ret'  => $night_ret,
];
$extras_json = json_encode($extras_payload, JSON_UNESCAPED_UNICODE);

// ref_interna base (común a ida/vuelta)
$ref_interna_base = 'WEB-' . date('Ymd-His') . '-' . substr(bin2hex(random_bytes(4)),0,8);

/**
 * Inserta una fila en reservas y devuelve el id.
 */
function insert_reserva(PDO $db, array $args): int {
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

// ----------------- INSERTAR IDA -----------------
$ref_interna_ida = $ref_interna_base . '-OUT';

$args_out = [
    ':canal'             => 'web',
    ':fecha'             => $data['service_date'] ?: date('Y-m-d'),
    ':hora_presentacion' => $data['service_time'] ?: '00:00:00',
    ':origen'            => $origin_address,
    ':destino'           => $destination_address,
    ':pax'               => (int)($data['passengers'] ?? 1),
    ':cliente_nombre'    => $data['first_name'] ?? '',
    ':cliente_apellidos' => $data['last_name'] ?? '',
    ':cliente_email'     => $data['email'] ?? '',
    ':cliente_movil'     => $data['phone'] ?? '',
    ':cliente_telefono'  => $data['phone'] ?? '',
    ':vuelo'             => $data['flight_number'] ?? $data['train_number'] ?? '',
    ':extras_json'       => $extras_json,
    ':notas'             => $data['notes'] ?? '',
    ':precio_venta'      => $total_out,
    ':ref_interna'       => $ref_interna_ida,
];

$reserva_id_out = insert_reserva($db, $args_out);

// Datos para voucher ida
$v_out = [
    'ref'     => $ref_interna_ida,
    'fecha'   => $args_out[':fecha'],
    'hora'    => $args_out[':hora_presentacion'],
    'origen'  => $origin_address,
    'destino' => $destination_address,
    'pax'     => $args_out[':pax'],
    'nombre'  => trim(($data['first_name'] ?? '').' '.($data['last_name'] ?? '')),
    'precio'  => $total_out,
];
$voucher_out_path = save_voucher_html($v_out);

// ----------------- INSERTAR VUELTA (si aplica) -----------------
$reserva_id_ret  = null;
$ref_interna_ret = null;
$voucher_ret_path = null;

if (!empty($data['return_trip']) && $base_return_price !== null && $total_return > 0) {
    $ref_interna_ret = $ref_interna_base . '-RET';

    $vuelo_ret = $data['return_flight_number'] ?? $data['return_train_number'] ?? '';

    $args_ret = [
        ':canal'             => 'web',
        ':fecha'             => $data['return_date'] ?: ($data['service_date'] ?? date('Y-m-d')),
        ':hora_presentacion' => $data['return_time'] ?: ($data['service_time'] ?? '00:00:00'),
        ':origen'            => $destination_address,   // invertimos
        ':destino'           => $origin_address,
        ':pax'               => (int)($data['passengers'] ?? 1),
        ':cliente_nombre'    => $data['first_name'] ?? '',
        ':cliente_apellidos' => $data['last_name'] ?? '',
        ':cliente_email'     => $data['email'] ?? '',
        ':cliente_movil'     => $data['phone'] ?? '',
        ':cliente_telefono'  => $data['phone'] ?? '',
        ':vuelo'             => $vuelo_ret,
        ':extras_json'       => $extras_json,
        ':notas'             => $data['notes'] ?? '',
        ':precio_venta'      => $total_return,
        ':ref_interna'       => $ref_interna_ret,
    ];

    $reserva_id_ret = insert_reserva($db, $args_ret);

    // Datos para voucher vuelta
    $v_ret = [
        'ref'     => $ref_interna_ret,
        'fecha'   => $args_ret[':fecha'],
        'hora'    => $args_ret[':hora_presentacion'],
        'origen'  => $destination_address,
        'destino' => $origin_address,
        'pax'     => $args_ret[':pax'],
        'nombre'  => trim(($data['first_name'] ?? '').' '.($data['last_name'] ?? '')),
        'precio'  => $total_return,
    ];
    $voucher_ret_path = save_voucher_html($v_ret);
}

// ----------------- EMAILS + ADJUNTOS -----------------

$subjectBase = 'Transfer Marbell - Reserva ' . $ref_interna_base;
$clienteNombre = trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? ''));

// Adjuntos cliente
$attachmentsCliente = [];
if ($voucher_out_path && is_file($voucher_out_path)) {
    $attachmentsCliente[] = [
        'path' => $voucher_out_path,
        'name' => 'Voucher-' . $ref_interna_ida . '.html',
        'type' => 'text/html',
    ];
}
if ($voucher_ret_path && is_file($voucher_ret_path)) {
    $attachmentsCliente[] = [
        'path' => $voucher_ret_path,
        'name' => 'Voucher-' . $ref_interna_ret . '.html',
        'type' => 'text/html',
    ];
}

// 1) Email al cliente
if (!empty($data['email'])) {
    ob_start();
    ?>
    <h2>Gracias por reservar con Transfer Marbell</h2>
    <p>Hola <?= htmlspecialchars($clienteNombre) ?>,</p>
    <p>Hemos recibido tu solicitud de traslado. Estos son los datos principales:</p>

    <ul>
      <li><strong>Referencia ida:</strong> <?= htmlspecialchars($ref_interna_ida) ?></li>
      <?php if ($ref_interna_ret): ?>
        <li><strong>Referencia vuelta:</strong> <?= htmlspecialchars($ref_interna_ret) ?></li>
      <?php endif; ?>
      <li><strong>Origen:</strong> <?= htmlspecialchars($origin_address) ?></li>
      <li><strong>Destino:</strong> <?= htmlspecialchars($destination_address) ?></li>
      <li><strong>Fecha / hora ida:</strong> <?= htmlspecialchars(($data['service_date'] ?? '') . ' ' . ($data['service_time'] ?? '')) ?></li>
      <?php if (!empty($data['return_trip']) && $ref_interna_ret): ?>
        <li><strong>Fecha / hora vuelta:</strong> <?= htmlspecialchars(($data['return_date'] ?? '') . ' ' . ($data['return_time'] ?? '')) ?></li>
      <?php endif; ?>
      <li><strong>Pasajeros:</strong> <?= (int)($data['passengers'] ?? 1) ?></li>
    </ul>

    <p><strong>Importe total:</strong> <?= number_format($grand_total, 2, ',', '.') ?> €</p>

    <p>Adjuntamos tus vouchers de reserva. Si no los ves, revisa la carpeta de correo no deseado.</p>
    <p>Gracias por confiar en Transfer Marbell.</p>
    <?php
    $htmlCliente = ob_get_clean();

    send_app_mail(
        (string)$data['email'],
        $subjectBase,
        $htmlCliente,
        $clienteNombre,
        $attachmentsCliente
    );
}

// 2) Email interno a reservas@transfermarbell.com
ob_start();
?>
<h2>Nueva reserva web</h2>
<p>Se ha creado una nueva reserva desde la web.</p>

<ul>
  <li><strong>Ref ida:</strong> <?= htmlspecialchars($ref_interna_ida) ?> (ID <?= (int)$reserva_id_out ?>)</li>
  <?php if ($ref_interna_ret): ?>
    <li><strong>Ref vuelta:</strong> <?= htmlspecialchars($ref_interna_ret) ?> (ID <?= (int)$reserva_id_ret ?>)</li>
  <?php endif; ?>
  <li><strong>Cliente:</strong> <?= htmlspecialchars($clienteNombre) ?></li>
  <li><strong>Email:</strong> <?= htmlspecialchars($data['email'] ?? '') ?></li>
  <li><strong>Teléfono:</strong> <?= htmlspecialchars($data['phone'] ?? '') ?></li>
  <li><strong>Origen:</strong> <?= htmlspecialchars($origin_address) ?></li>
  <li><strong>Destino:</strong> <?= htmlspecialchars($destination_address) ?></li>
  <li><strong>Total:</strong> <?= number_format($grand_total, 2, ',', '.') ?> €</li>
</ul>
<?php
$htmlAdmin = ob_get_clean();

$attachmentsAdmin = $attachmentsCliente; // mismo set de vouchers

send_app_mail(
    'reservas@transfermarbell.com',
    'Nueva reserva web - ' . $ref_interna_base,
    $htmlAdmin,
    'Reservas',
    $attachmentsAdmin
);

// Guardamos refs en sesión por si queremos mostrar algo
$_SESSION['last_booking_refs'] = [
    'out_id'        => $reserva_id_out,
    'out_ref'       => $ref_interna_ida,
    'ret_id'        => $reserva_id_ret,
    'ret_ref'       => $ref_interna_ret,
    'email'         => $data['email'] ?? '',
];

// Limpiamos booking + review
unset($_SESSION['booking'], $_SESSION['review']);

// Render vista de confirmación
$__view = __DIR__ . '/../views/confirm-booking.php';
extract([
    'reserva_id_out' => $reserva_id_out,
    'reserva_id_ret' => $reserva_id_ret,
    'ref_out'        => $ref_interna_ida,
    'ref_ret'        => $ref_interna_ret,
    'email'          => $data['email'] ?? '',
], EXTR_SKIP);

ob_start(); include $__view; $__content = ob_get_clean();
require __DIR__ . '/../views/layout.php';

<?php
// app/helpers/voucher.php
declare(strict_types=1);

/**
 * Devuelve el directorio donde se guardan los vouchers.
 */
if (!function_exists('vouchers_storage_dir')) {
    function vouchers_storage_dir(): string {
        // /app/helpers/.. → /app
        $base = realpath(__DIR__ . '/..');
        $dir  = $base . '/storage/vouchers';

        if (!is_dir($dir)) {
            @mkdir($dir, 0775, true);
        }
        return $dir;
    }
}

/**
 * Genera HTML sencillo para un voucher.
 *
 * $reserva debe contener al menos:
 *  - ref
 *  - fecha
 *  - hora
 *  - origen
 *  - destino
 *  - pax
 *  - nombre
 *  - precio
 */
if (!function_exists('generate_voucher_html')) {
    function generate_voucher_html(array $reserva): string {
        $ref     = htmlspecialchars($reserva['ref']     ?? '');
        $fecha   = htmlspecialchars($reserva['fecha']   ?? '');
        $hora    = htmlspecialchars($reserva['hora']    ?? '');
        $origen  = htmlspecialchars($reserva['origen']  ?? '');
        $destino = htmlspecialchars($reserva['destino'] ?? '');
        $pax     = (int)($reserva['pax'] ?? 1);
        $nombre  = htmlspecialchars($reserva['nombre']  ?? '');
        $precio  = number_format((float)($reserva['precio'] ?? 0), 2, ',', '.') . ' €';

        $now = date('Y-m-d H:i');

        return <<<HTML
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Voucher $ref</title>
  <style>
    body{font-family:system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Arial,sans-serif;background:#f3f4f6;margin:0;padding:24px}
    .card{max-width:700px;margin:0 auto;background:#fff;border-radius:18px;padding:24px 28px;box-shadow:0 20px 40px rgba(15,23,42,.15);}
    h1{font-size:22px;margin:0 0 8px;color:#0f172a}
    h2{font-size:16px;margin:18px 0 8px;color:#0f172a}
    p,li{font-size:14px;color:#374151;margin:4px 0}
    .muted{color:#6b7280;font-size:12px}
    .row{display:flex;flex-wrap:wrap;gap:16px}
    .col{flex:1 1 220px}
    .tag{display:inline-block;border-radius:999px;background:#eff6ff;color:#1d4ed8;font-size:12px;padding:2px 10px}
    .box{border-radius:14px;border:1px solid #e5e7eb;padding:10px 14px;margin-top:6px}
  </style>
</head>
<body>
  <div class="card">
    <h1>Voucher de servicio · $ref</h1>
    <p class="muted">Emitido: $now</p>
    <p><span class="tag">Transfer Marbell</span></p>

    <h2>Datos del servicio</h2>
    <div class="row">
      <div class="col">
        <div class="box">
          <p><strong>Fecha:</strong> $fecha</p>
          <p><strong>Hora de recogida:</strong> $hora</p>
          <p><strong>Pasajeros:</strong> $pax</p>
        </div>
      </div>
      <div class="col">
        <div class="box">
          <p><strong>Origen:</strong><br>$origen</p>
          <p><strong>Destino:</strong><br>$destino</p>
        </div>
      </div>
    </div>

    <h2>Pasajero principal</h2>
    <div class="box">
      <p><strong>Nombre:</strong> $nombre</p>
    </div>

    <h2>Importe</h2>
    <div class="box">
      <p><strong>Total servicio:</strong> $precio</p>
      <p class="muted">Importe a pagar según condiciones acordadas con Transfer Marbell.</p>
    </div>

    <p class="muted" style="margin-top:18px;">
      Por favor, muestra este voucher al conductor a la recogida. Si tienes cualquier duda,
      contacta con reservas@transfermarbell.com.
    </p>
  </div>
</body>
</html>
HTML;
    }
}

/**
 * Guarda el voucher como HTML en /app/storage/vouchers/voucher-REF.html
 * y devuelve la ruta completa al fichero.
 */
if (!function_exists('save_voucher_html')) {
    function save_voucher_html(array $reserva): string {
        $ref = preg_replace('/[^A-Za-z0-9_\-]/','_', (string)($reserva['ref'] ?? 'SINREF'));
        $dir  = vouchers_storage_dir();
        $file = $dir . '/voucher-' . $ref . '.html';

        $html = generate_voucher_html($reserva);
        file_put_contents($file, $html);

        return $file;
    }
}

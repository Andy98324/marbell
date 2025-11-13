<?php
// app/helpers/voucher.php

/**
 * Genera un voucher HTML simple y lo guarda en /storage/vouchers/{ref}.html
 *
 * @param array $data  Datos de la reserva (origen, destino, fecha, etc.)
 * @param string $ref  Referencia interna única
 * @return string      Ruta absoluta del fichero generado
 */
function generate_voucher_html(array $data, string $ref): string
{
    $baseDir = __DIR__ . '/../storage/vouchers';
    if (!is_dir($baseDir)) {
        mkdir($baseDir, 0775, true);
    }

    $filePath = $baseDir . '/' . preg_replace('/[^A-Za-z0-9_\-]/', '_', $ref) . '.html';

    $origen  = htmlspecialchars($data['origen']  ?? '', ENT_QUOTES, 'UTF-8');
    $destino = htmlspecialchars($data['destino'] ?? '', ENT_QUOTES, 'UTF-8');
    $fecha   = htmlspecialchars($data['fecha']   ?? '', ENT_QUOTES, 'UTF-8');
    $hora    = htmlspecialchars($data['hora']    ?? '', ENT_QUOTES, 'UTF-8');
    $pax     = (int)($data['pax'] ?? 0);
    $precio  = number_format((float)($data['precio_venta'] ?? 0), 2, ',', '.');

    $html = <<<HTML
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Voucher {$ref}</title>
  <style>
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:#f3f4f6;margin:0;padding:20px}
    .card{max-width:600px;margin:0 auto;background:#fff;border-radius:16px;padding:20px;box-shadow:0 10px 30px rgba(15,23,42,.1)}
    h1{font-size:20px;margin-top:0;margin-bottom:10px}
    .muted{color:#6b7280;font-size:13px}
    .row{margin-bottom:6px}
    .label{font-weight:600}
  </style>
</head>
<body>
  <div class="card">
    <h1>Voucher de reserva</h1>
    <p class="muted">Referencia: {$ref}</p>

    <p class="row"><span class="label">Origen:</span> {$origen}</p>
    <p class="row"><span class="label">Destino:</span> {$destino}</p>
    <p class="row"><span class="label">Fecha:</span> {$fecha}</p>
    <p class="row"><span class="label">Hora de presentación:</span> {$hora}</p>
    <p class="row"><span class="label">Pasajeros:</span> {$pax}</p>
    <p class="row"><span class="label">Precio:</span> € {$precio}</p>

    <p class="muted" style="margin-top:20px">
      La imagen del vehículo es orientativa. El bono debe presentarse al conductor en el inicio del servicio.
    </p>
  </div>
</body>
</html>
HTML;

    file_put_contents($filePath, $html);

    return $filePath;
}

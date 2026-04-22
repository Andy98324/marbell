<?php
// app/helpers/voucher.php
declare(strict_types=1);

if (!function_exists('vouchers_storage_dir')) {
    function vouchers_storage_dir(): string
    {
        $base = realpath(__DIR__ . '/..'); // /app
        if ($base === false) {
            throw new RuntimeException('No se pudo resolver la ruta base de /app');
        }

        $dir = $base . '/storage/vouchers';

        if (!is_dir($dir) && !@mkdir($dir, 0775, true) && !is_dir($dir)) {
            throw new RuntimeException('No se pudo crear el directorio de vouchers: ' . $dir);
        }

        return $dir;
    }
}

if (!function_exists('voucher_safe_ref')) {
    function voucher_safe_ref(string $ref): string
    {
        $ref = trim($ref);
        $ref = preg_replace('/\s+/', '-', $ref) ?? $ref;
        $safe = preg_replace('/[^A-Za-z0-9_\-]/', '_', $ref ?: 'SINREF');

        return is_string($safe) ? $safe : 'SINREF';
    }
}

if (!function_exists('wkhtmltopdf_bin')) {
    function wkhtmltopdf_bin(): ?string
    {
        $bin = trim((string)@shell_exec('command -v wkhtmltopdf 2>/dev/null'));
        if ($bin !== '' && is_file($bin) && is_executable($bin)) {
            return $bin;
        }

        $common = '/usr/bin/wkhtmltopdf';
        if (is_file($common) && is_executable($common)) {
            return $common;
        }

        return null;
    }
}

if (!function_exists('generate_voucher_html')) {
    function generate_voucher_html(array $reserva): string
    {
        $ref     = htmlspecialchars((string)($reserva['ref'] ?? ''), ENT_QUOTES, 'UTF-8');
        $fecha   = htmlspecialchars((string)($reserva['fecha'] ?? ''), ENT_QUOTES, 'UTF-8');
        $hora    = htmlspecialchars((string)($reserva['hora'] ?? ''), ENT_QUOTES, 'UTF-8');
        $origen  = nl2br(htmlspecialchars((string)($reserva['origen'] ?? ''), ENT_QUOTES, 'UTF-8'), false);
        $destino = nl2br(htmlspecialchars((string)($reserva['destino'] ?? ''), ENT_QUOTES, 'UTF-8'), false);
        $pax     = (int)($reserva['pax'] ?? 1);
        $nombre  = htmlspecialchars((string)($reserva['nombre'] ?? ''), ENT_QUOTES, 'UTF-8');
        $tel     = trim((string)($reserva['telefono'] ?? ''));
        $email   = trim((string)($reserva['email'] ?? ''));
        $notas   = trim((string)($reserva['notas'] ?? ''));
        $company = htmlspecialchars((string)($reserva['company'] ?? 'Transfer Marbell'), ENT_QUOTES, 'UTF-8');
        $tipo    = htmlspecialchars((string)($reserva['tipo'] ?? ''), ENT_QUOTES, 'UTF-8');

        $vehName = htmlspecialchars((string)($reserva['vehicle_name'] ?? ''), ENT_QUOTES, 'UTF-8');
        $vehCap  = htmlspecialchars((string)($reserva['vehicle_capacity'] ?? ''), ENT_QUOTES, 'UTF-8');
        $vehCode = htmlspecialchars((string)($reserva['vehicle_code'] ?? ''), ENT_QUOTES, 'UTF-8');

        $price_total  = (float)($reserva['precio'] ?? 0);
        $price_base   = (float)($reserva['price_base'] ?? 0);
        $price_extras = (float)($reserva['price_extras'] ?? 0);
        $price_night  = (float)($reserva['price_night'] ?? 0);
        $price_air    = (float)($reserva['price_airport_fee'] ?? 0);

        $fmt = static fn($v): string => number_format((float)$v, 2, ',', '.') . ' €';
        $precio = $fmt($price_total);

        $issuedAt = (string)($reserva['issued_at'] ?? '');
        if ($issuedAt === '') {
            $issuedAt = date('Y-m-d H:i');
        }

        $sub = $tipo !== '' ? ' · ' . $tipo : '';

        $telRow   = $tel !== '' ? '<p class="kv"><strong>Teléfono:</strong> ' . htmlspecialchars($tel, ENT_QUOTES, 'UTF-8') . '</p>' : '';
        $emailRow = $email !== '' ? '<p class="kv"><strong>Email:</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</p>' : '';

        $extras = $reserva['extras'] ?? [];
        $extrasHtml = '';

        if (is_array($extras)) {
            $items = [];

            foreach ($extras as $label => $qty) {
                $q = (int)$qty;
                $lab = trim((string)$label);

                if ($q > 0 && $lab !== '') {
                    $items[] = '<li><span class="dot"></span><span><strong>' . $q . '×</strong> ' . htmlspecialchars($lab, ENT_QUOTES, 'UTF-8') . '</span></li>';
                }
            }

            $extrasHtml = !empty($items)
                ? '<ul class="list">' . implode('', $items) . '</ul>'
                : '<p class="muted">Sin extras.</p>';
        } else {
            $extrasHtml = '<p class="muted">Sin extras.</p>';
        }

        $notesBlock = '';
        if ($notas !== '') {
            $notesBlock = '<h2>Notas</h2><div class="box"><p class="kv">' . nl2br(htmlspecialchars($notas, ENT_QUOTES, 'UTF-8'), false) . '</p></div>';
        }

        $vehicleBlock = '';
        if ($vehName !== '') {
            $capLine  = $vehCap !== '' ? '<p class="kv"><strong>Capacidad:</strong> ' . $vehCap . '</p>' : '';
            $codeLine = $vehCode !== '' ? '<p class="kv"><strong>Código:</strong> ' . $vehCode . '</p>' : '';

            $vehicleBlock = <<<HTML
<h2>Vehículo</h2>
<div class="box">
  <p class="kv"><strong>Modelo:</strong> {$vehName}</p>
  {$capLine}
  {$codeLine}
</div>
HTML;
        }

        $hasBreakdown = ($price_base > 0) || ($price_extras > 0) || ($price_night > 0) || ($price_air > 0);
        $breakdownHtml = '';

        if ($hasBreakdown) {
            $rows = '';
            if ($price_base > 0) {
                $rows .= '<div class="rowp"><span>Tarifa base</span><span>' . $fmt($price_base) . '</span></div>';
            }
            if ($price_extras > 0) {
                $rows .= '<div class="rowp"><span>Extras</span><span>' . $fmt($price_extras) . '</span></div>';
            }
            if ($price_night > 0) {
                $rows .= '<div class="rowp"><span>Recargo nocturno</span><span>' . $fmt($price_night) . '</span></div>';
            }
            if ($price_air > 0) {
                $rows .= '<div class="rowp"><span>Suplemento aeropuerto</span><span>' . $fmt($price_air) . '</span></div>';
            }

            $breakdownHtml = <<<HTML
<div class="box" style="margin-top:10px">
  {$rows}
  <div class="rowp total"><span>Total</span><span>{$precio}</span></div>
</div>
HTML;
        }

        return <<<HTML
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Voucher {$ref}</title>
  <style>
    :root{--bg:#f6f7fb;--card:#fff;--ink:#0f172a;--muted:#64748b;--line:#e5e7eb;}
    *{box-sizing:border-box}
    body{font-family:DejaVu Sans, Arial, sans-serif;background:var(--bg);margin:0;padding:26px;color:var(--ink)}
    .wrap{max-width:780px;margin:0 auto}
    .card{background:var(--card);border:1px solid rgba(15,23,42,.10);border-radius:18px;overflow:hidden;box-shadow:0 18px 45px rgba(15,23,42,.10)}
    .top{padding:18px 22px;border-bottom:1px solid var(--line);overflow:hidden}
    .left{float:left;width:72%}
    .right{float:right;width:28%;text-align:right}
    .title{margin:0;font-size:18px;font-weight:800;letter-spacing:-.2px}
    .meta{margin-top:6px;font-size:12px;color:var(--muted)}
    .pill{display:inline-block;padding:7px 12px;border-radius:999px;border:1px solid rgba(14,165,233,.25);background:rgba(14,165,233,.10);color:#0369a1;font-size:12px;font-weight:700}
    .body{padding:18px 22px 14px}
    h2{font-size:12px;text-transform:uppercase;letter-spacing:.08em;margin:16px 0 10px;color:#0b1220}
    .grid{width:100%;overflow:hidden}
    .col{float:left;width:48%;margin-right:4%}
    .col.last{margin-right:0}
    .box{border:1px solid var(--line);border-radius:14px;padding:12px;background:#fff}
    .kv{margin:0 0 6px 0;font-size:13px;color:#111827;line-height:1.5}
    .kv strong{color:#0f172a}
    .muted{color:var(--muted);font-size:12px;margin:0}
    .foot{border-top:1px solid var(--line);padding:12px 22px;font-size:12px;color:var(--muted);overflow:hidden}
    .foot .fleft{float:left;width:70%}
    .foot .fright{float:right;width:30%;text-align:right}
    .clearfix{clear:both}
    .list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:6px}
    .list li{display:flex;gap:10px;align-items:flex-start;font-size:13px;color:#111827}
    .dot{margin-top:6px;width:6px;height:6px;border-radius:999px;background:#0ea5e9;display:inline-block}
    .rowp{display:flex;justify-content:space-between;gap:12px;font-size:13px;color:#111827;margin:0 0 6px 0}
    .rowp.total{margin-top:10px;padding-top:10px;border-top:1px solid var(--line);font-weight:900;color:#0f172a}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card">
      <div class="top">
        <div class="left">
          <h1 class="title">Voucher de servicio · {$ref}{$sub}</h1>
          <div class="meta">Emitido: {$issuedAt}</div>
        </div>
        <div class="right">
          <span class="pill">{$company}</span>
        </div>
        <div class="clearfix"></div>
      </div>

      <div class="body">
        <h2>Datos del servicio</h2>
        <div class="grid">
          <div class="col">
            <div class="box">
              <p class="kv"><strong>Fecha:</strong> {$fecha}</p>
              <p class="kv"><strong>Hora de recogida:</strong> {$hora}</p>
              <p class="kv"><strong>Pasajeros:</strong> {$pax}</p>
            </div>
          </div>
          <div class="col last">
            <div class="box">
              <p class="kv"><strong>Origen:</strong><br>{$origen}</p>
              <p class="kv"><strong>Destino:</strong><br>{$destino}</p>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>

        {$vehicleBlock}

        <h2>Pasajero principal</h2>
        <div class="box">
          <p class="kv"><strong>Nombre:</strong> {$nombre}</p>
          {$telRow}
          {$emailRow}
        </div>

        <h2>Extras</h2>
        <div class="box">
          {$extrasHtml}
        </div>

        <h2>Importe</h2>
        <div class="box">
          <div class="rowp total" style="border-top:none;padding-top:0;margin-top:0">
            <span>Total servicio</span>
            <span>{$precio}</span>
          </div>
          <p class="muted" style="margin-top:8px">Importe a pagar según condiciones acordadas con {$company}.</p>
        </div>

        {$breakdownHtml}

        {$notesBlock}
      </div>

      <div class="foot">
        <div class="fleft">
          Muestra este voucher al conductor en la recogida. Si detectas algún dato incorrecto, contacta indicando tu referencia.
        </div>
        <div class="fright">reservas@transfermarbell.com</div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</body>
</html>
HTML;
    }
}

if (!function_exists('voucher_html_path')) {
    function voucher_html_path(string $ref): string
    {
        return vouchers_storage_dir() . '/' . voucher_safe_ref($ref) . '.html';
    }
}

if (!function_exists('voucher_pdf_path')) {
    function voucher_pdf_path(string $ref): string
    {
        return vouchers_storage_dir() . '/' . voucher_safe_ref($ref) . '.pdf';
    }
}

if (!function_exists('save_voucher_html')) {
    function save_voucher_html(array $reserva): string
    {
        $ref = (string)($reserva['ref'] ?? '');
        if ($ref === '') {
            throw new RuntimeException('No se puede guardar el voucher: falta la referencia.');
        }

        $html = generate_voucher_html($reserva);
        $path = voucher_html_path($ref);

        if (@file_put_contents($path, $html) === false) {
            throw new RuntimeException('No se pudo guardar el voucher HTML en: ' . $path);
        }

        return $path;
    }
}

if (!function_exists('save_voucher_files')) {
    function save_voucher_files(array $reserva): array
    {
        $ref = (string)($reserva['ref'] ?? '');
        if ($ref === '') {
            throw new RuntimeException('No se puede guardar el voucher: falta la referencia.');
        }

        $htmlPath = save_voucher_html($reserva);
        $pdfPath  = voucher_pdf_path($ref);
        $wkhtml   = wkhtmltopdf_bin();

        $result = [
            'ref'       => $ref,
            'html_path' => $htmlPath,
            'pdf_path'  => null,
            'path'      => $htmlPath,
        ];

        if ($wkhtml !== null) {
            $cmd = escapeshellarg($wkhtml)
                . ' --encoding utf-8'
                . ' --enable-local-file-access'
                . ' --margin-top 10'
                . ' --margin-right 10'
                . ' --margin-bottom 10'
                . ' --margin-left 10'
                . ' ' . escapeshellarg($htmlPath)
                . ' ' . escapeshellarg($pdfPath)
                . ' 2>&1';

            @shell_exec($cmd);

            if (is_file($pdfPath) && filesize($pdfPath) > 0) {
                $result['pdf_path'] = $pdfPath;
                $result['path'] = $pdfPath;
            }
        }

        return $result;
    }
}
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
 * Sanitiza ref para nombres de archivo.
 */
if (!function_exists('voucher_safe_ref')) {
    function voucher_safe_ref(string $ref): string {
        $ref = trim($ref);
        $ref = preg_replace('/\s+/', '-', $ref);
        return preg_replace('/[^A-Za-z0-9_\-]/', '_', $ref ?: 'SINREF');
    }
}

/**
 * Localiza wkhtmltopdf en el sistema.
 * Puedes fijar una ruta exacta si quieres.
 */
if (!function_exists('wkhtmltopdf_bin')) {
    function wkhtmltopdf_bin(): ?string {
        // Si lo tienes fijo, ponlo aquí:
        // $fixed = '/usr/bin/wkhtmltopdf';
        // if (is_file($fixed) && is_executable($fixed)) return $fixed;

        $bin = trim((string)@shell_exec('command -v wkhtmltopdf 2>/dev/null'));
        if ($bin && is_file($bin) && is_executable($bin)) return $bin;

        // fallback típico
        $common = '/usr/bin/wkhtmltopdf';
        if (is_file($common) && is_executable($common)) return $common;

        return null;
    }
}

/**
 * Genera HTML elegante para voucher (sin logo).
 *
 * $reserva:
 *  - ref (string)
 *  - fecha (YYYY-MM-DD)
 *  - hora (HH:MM)
 *  - origen (string)
 *  - destino (string)
 *  - pax (int)
 *  - nombre (string)
 *  - precio (float)
 * Opcionales:
 *  - telefono, email, notas
 *  - issued_at (string)
 *  - company (string)
 *  - tipo (OUT/RET)
 *  - qr_url (url)
 */
if (!function_exists('generate_voucher_html')) {
    function generate_voucher_html(array $reserva): string {
        $ref     = htmlspecialchars((string)($reserva['ref'] ?? ''));
        $fecha   = htmlspecialchars((string)($reserva['fecha'] ?? ''));
        $hora    = htmlspecialchars((string)($reserva['hora'] ?? ''));
        $origen  = nl2br(htmlspecialchars((string)($reserva['origen'] ?? '')), false);
        $destino = nl2br(htmlspecialchars((string)($reserva['destino'] ?? '')), false);
        $pax     = (int)($reserva['pax'] ?? 1);
        $nombre  = htmlspecialchars((string)($reserva['nombre'] ?? ''));
        $tel     = trim((string)($reserva['telefono'] ?? ''));
        $email   = trim((string)($reserva['email'] ?? ''));
        $notas   = trim((string)($reserva['notas'] ?? ''));
        $company = htmlspecialchars((string)($reserva['company'] ?? 'Transfer Marbell'));
        $tipo    = htmlspecialchars((string)($reserva['tipo'] ?? '')); // OUT / RET
        $qrUrl   = trim((string)($reserva['qr_url'] ?? ''));

        $precio  = number_format((float)($reserva['precio'] ?? 0), 2, ',', '.') . ' €';

        $issuedAt = (string)($reserva['issued_at'] ?? '');
        if ($issuedAt === '') $issuedAt = date('Y-m-d H:i');

        $sub = $tipo ? " · {$tipo}" : "";

        $telRow   = $tel   !== '' ? "<p class=\"kv\"><strong>Teléfono:</strong> " . htmlspecialchars($tel) . "</p>" : "";
        $emailRow = $email !== '' ? "<p class=\"kv\"><strong>Email:</strong> " . htmlspecialchars($email) . "</p>" : "";

        $notesBlock = '';
        if ($notas !== '') {
            $notesBlock = '<h2>Notas</h2><div class="box"><p class="kv">'. nl2br(htmlspecialchars($notas), false) .'</p></div>';
        }

        // QR opcional (si no hay url, no se muestra)
        $qrHtml = '';
        if ($qrUrl !== '') {
            $qrSafe = htmlspecialchars($qrUrl);
            // usando servicio externo para generar imagen QR (opcional)
            // si no quieres externo, lo quitamos.
            $qrImg = "https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=" . rawurlencode($qrUrl);
            $qrHtml = <<<HTML
              <div class="qr">
                <div class="qrbox">
                  <div class="qrtitle">QR</div>
                  <img src="$qrImg" alt="QR" width="120" height="120">
                  <div class="qrmuted">Abrir voucher</div>
                </div>
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
    /* wkhtmltopdf friendly styles */
    :root{
      --bg:#f6f7fb;
      --card:#ffffff;
      --ink:#0f172a;
      --muted:#64748b;
      --line:#e5e7eb;
      --accent:#0ea5e9;
    }
    *{box-sizing:border-box}
    body{
      font-family: DejaVu Sans, Arial, sans-serif;
      background: var(--bg);
      margin:0;
      padding:26px;
      color:var(--ink);
    }
    .wrap{max-width:780px;margin:0 auto}
    .card{
      background:var(--card);
      border:1px solid rgba(15,23,42,.10);
      border-radius:18px;
      overflow:hidden;
      box-shadow: 0 18px 45px rgba(15,23,42,.10);
    }
    .top{
      padding:18px 22px;
      border-bottom:1px solid var(--line);
      overflow:hidden;
    }
    .headrow{
      width:100%;
    }
    .left{float:left; width:72%;}
    .right{float:right; width:28%; text-align:right;}
    .title{
      margin:0;
      font-size:18px;
      font-weight:800;
      letter-spacing:-.2px;
    }
    .meta{margin-top:6px; font-size:12px; color:var(--muted)}
    .pill{
      display:inline-block;
      padding:7px 12px;
      border-radius:999px;
      border:1px solid rgba(14,165,233,.25);
      background: rgba(14,165,233,.10);
      color: #0369a1;
      font-size:12px;
      font-weight:700;
    }
    .body{padding:18px 22px 14px}
    h2{
      font-size:12px;
      text-transform:uppercase;
      letter-spacing:.08em;
      margin:16px 0 10px;
      color:#0b1220;
    }
    .grid{
      width:100%;
      overflow:hidden;
    }
    .col{
      float:left;
      width:48%;
      margin-right:4%;
    }
    .col.last{
      margin-right:0;
    }
    .box{
      border:1px solid var(--line);
      border-radius:14px;
      padding:12px 12px;
      background:#fff;
    }
    .kv{
      margin:0 0 6px 0;
      font-size:13px;
      color:#111827;
      line-height:1.5;
    }
    .kv strong{color:#0f172a}
    .muted{color:var(--muted); font-size:12px; margin:0}
    .bigrow{
      overflow:hidden;
    }
    .bigleft{float:left}
    .bigright{float:right; font-weight:900; font-size:18px}
    .foot{
      border-top:1px solid var(--line);
      padding:12px 22px;
      font-size:12px;
      color:var(--muted);
      overflow:hidden;
    }
    .foot .fleft{float:left; width:70%;}
    .foot .fright{float:right; width:30%; text-align:right;}
    .qr{
      margin-top:12px;
      text-align:right;
    }
    .qrbox{
      display:inline-block;
      border:1px solid var(--line);
      border-radius:14px;
      padding:10px 10px;
      background:#fff;
    }
    .qrtitle{font-size:11px; font-weight:800; color:#0f172a; margin-bottom:6px;}
    .qrmuted{font-size:11px; color:var(--muted); margin-top:6px;}
    .clearfix{clear:both}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card">

      <div class="top">
        <div class="headrow">
          <div class="left">
            <h1 class="title">Voucher de servicio · {$ref}{$sub}</h1>
            <div class="meta">Emitido: {$issuedAt}</div>
          </div>
          <div class="right">
            <span class="pill">{$company}</span>
          </div>
          <div class="clearfix"></div>
        </div>
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

        {$qrHtml}

        <h2>Pasajero principal</h2>
        <div class="box">
          <p class="kv"><strong>Nombre:</strong> {$nombre}</p>
          {$telRow}
          {$emailRow}
        </div>

        <h2>Importe</h2>
        <div class="box">
          <div class="bigrow">
            <div class="bigleft"><p class="kv" style="margin:0"><strong>Total servicio</strong></p></div>
            <div class="bigright">{$precio}</div>
            <div class="clearfix"></div>
          </div>
          <p class="muted" style="margin-top:8px">Importe a pagar según condiciones acordadas con {$company}.</p>
        </div>

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

/**
 * Guarda el voucher como HTML en /app/storage/vouchers/voucher-REF.html
 * y devuelve la ruta completa al fichero.
 */
if (!function_exists('save_voucher_html')) {
    function save_voucher_html(array $reserva): string {
        $safeRef = voucher_safe_ref((string)($reserva['ref'] ?? 'SINREF'));
        $dir  = vouchers_storage_dir();
        $file = $dir . '/voucher-' . $safeRef . '.html';

        $html = generate_voucher_html($reserva);
        file_put_contents($file, $html);

        return $file;
    }
}

/**
 * Convierte un HTML a PDF usando wkhtmltopdf.
 * Devuelve ruta al PDF o null si falla/no está instalado.
 */
if (!function_exists('voucher_html_to_pdf')) {
    function voucher_html_to_pdf(string $htmlFile, string $pdfFile): ?string {
        $bin = wkhtmltopdf_bin();
        if ($bin === null) return null;

        // Opciones seguras para layouts (A4 + márgenes)
        $cmd = escapeshellarg($bin)
             . ' --quiet'
             . ' --page-size A4'
             . ' --margin-top 12 --margin-right 12 --margin-bottom 12 --margin-left 12'
             . ' ' . escapeshellarg($htmlFile)
             . ' ' . escapeshellarg($pdfFile);

        @exec($cmd, $out, $code);

        if ($code === 0 && is_file($pdfFile) && filesize($pdfFile) > 1000) {
            return $pdfFile;
        }
        return null;
    }
}

/**
 * Guarda el voucher como PDF en /app/storage/vouchers/voucher-REF.pdf
 * (primero guarda HTML y luego convierte a PDF).
 */
if (!function_exists('save_voucher_pdf')) {
    function save_voucher_pdf(array $reserva): ?string {
        $safeRef = voucher_safe_ref((string)($reserva['ref'] ?? 'SINREF'));
        $dir  = vouchers_storage_dir();

        $htmlFile = $dir . '/voucher-' . $safeRef . '.html';
        $pdfFile  = $dir . '/voucher-' . $safeRef . '.pdf';

        // guardar html (si no existe)
        $html = generate_voucher_html($reserva);
        file_put_contents($htmlFile, $html);

        return voucher_html_to_pdf($htmlFile, $pdfFile);
    }
}

/**
 * Crea ambos: HTML + PDF (si wkhtmltopdf está disponible).
 * Devuelve array con rutas.
 */
if (!function_exists('save_voucher_files')) {
    function save_voucher_files(array $reserva): array {
        $html = save_voucher_html($reserva);
        $pdf  = save_voucher_pdf($reserva); // puede ser null
        return ['html' => $html, 'pdf' => $pdf];
    }
}

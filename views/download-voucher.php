<?php
// /download-voucher.php

// 1) Leer ref
$ref = $_GET['ref'] ?? '';
$ref = trim($ref);

// 2) Validación estricta (evita path traversal)
if ($ref === '' || !preg_match('/^[A-Za-z0-9_-]{6,64}$/', $ref)) {
  http_response_code(400);
  echo 'Bad request';
  exit;
}

// 3) Ruta del archivo (AJUSTA esta carpeta)
$baseDir = __DIR__ . '/vouchers';           // ejemplo: /public/vouchers
$file    = $baseDir . '/' . $ref . '.pdf';

// 4) Existe?
if (!is_file($file)) {
  http_response_code(404);
  // Si quieres traducir aquí: carga tu i18n y usa t('confirm.no_voucher')
  echo 'Voucher not found';
  exit;
}

// 5) Forzar descarga
$filename = 'voucher_' . $ref . '.pdf';

header('Content-Description: File Transfer');
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Length: ' . filesize($file));
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');

readfile($file);
exit;

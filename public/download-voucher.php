<?php
// public/download-voucher.php

$ref = isset($_GET['ref']) ? trim((string)$_GET['ref']) : '';
if ($ref === '' || !preg_match('/^[A-Za-z0-9_-]{6,140}$/', $ref)) {
  http_response_code(400);
  exit('Bad request');
}

$voucherDir = realpath(__DIR__ . '/../app/storage/vouchers');
if (!$voucherDir || !is_dir($voucherDir)) {
  http_response_code(500);
  exit('Voucher storage missing');
}

$refSafe = preg_replace('/[^A-Za-z0-9_-]/', '_', $ref);

$pdf  = $voucherDir . DIRECTORY_SEPARATOR . 'voucher-' . $refSafe . '.pdf';
$html = $voucherDir . DIRECTORY_SEPARATOR . 'voucher-' . $refSafe . '.html';

$file = null;
$mime = null;

if (is_file($pdf)) {
  $file = $pdf;
  $mime = 'application/pdf';
} elseif (is_file($html)) {
  $file = $html;
  $mime = 'text/html; charset=UTF-8';
} else {
  http_response_code(404);
  exit('Voucher not found');
}

$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
$downloadName = 'voucher_' . $refSafe . '.' . $ext;

header('Content-Type: ' . $mime);
header('Content-Disposition: attachment; filename="' . $downloadName . '"');
header('Content-Length: ' . filesize($file));
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');

readfile($file);
exit;

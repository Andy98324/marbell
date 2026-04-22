<?php
declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/helpers/voucher.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$ref = $_GET['ref'] ?? '';
$ref = is_string($ref) ? trim($ref) : '';

if ($ref === '') {
    http_response_code(400);
    exit('Referencia no válida.');
}

$safeRef  = voucher_safe_ref($ref);
$pdfPath  = voucher_pdf_path($safeRef);
$htmlPath = voucher_html_path($safeRef);

$filePath = null;
$downloadName = null;
$contentType = null;

if (is_file($pdfPath) && filesize($pdfPath) > 0) {
    $filePath = $pdfPath;
    $downloadName = 'Voucher-' . $safeRef . '.pdf';
    $contentType = 'application/pdf';
} elseif (is_file($htmlPath) && filesize($htmlPath) > 0) {
    $filePath = $htmlPath;
    $downloadName = 'Voucher-' . $safeRef . '.html';
    $contentType = 'text/html; charset=UTF-8';
}

if ($filePath === null) {
    http_response_code(404);
    exit('Voucher no encontrado.');
}

if (ob_get_level()) {
    ob_end_clean();
}

header('Content-Description: File Transfer');
header('Content-Type: ' . $contentType);
header('Content-Disposition: attachment; filename="' . $downloadName . '"');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . (string)filesize($filePath));

readfile($filePath);
exit;
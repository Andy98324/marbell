<?php
require_once __DIR__.'/../config/config.php';
function signed_link(string $path, array $params=[], int $ttlMinutes=120): string {
  $exp = time() + $ttlMinutes*60; $params['exp'] = $exp; ksort($params);
  $q = http_build_query($params);
  $sig = hash_hmac('sha256', $path.'?'.$q, APP_KEY);
  return BASE_URL.$path.'?'.$q.'&sig='.$sig;
}
function verify_signed_request(): void {
  $sig = $_GET['sig'] ?? '';
  $exp = (int)($_GET['exp'] ?? 0);
  if (!$sig || !$exp || $exp < time()) die('Enlace expirado');
  $params = $_GET; unset($params['sig']); ksort($params);
  $q = http_build_query($params);
  $calc = hash_hmac('sha256', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH).'?'.$q, APP_KEY);
  if (!hash_equals($calc, $sig)) die('Firma inválida');
}

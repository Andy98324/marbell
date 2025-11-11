<?php
// app/i18n.php
if (session_status() === PHP_SESSION_NONE) session_start();

$available = ['es','en'];
// prioridad: ?lang= → sesión → 'es'
if (isset($_GET['lang']) && in_array($_GET['lang'], $available, true)) {
  $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'es';

$__t = [];
$path = __DIR__ . "/lang/{$lang}.php";
if (is_file($path)) {
  $__t = require $path;
} else {
  $__t = require __DIR__ . "/lang/es.php";
  $lang = 'es';
}
// helper
function t(string $key, array $vars = []): string {
  global $__t;
  $txt = $__t[$key] ?? $key;
  foreach ($vars as $k => $v) { $txt = str_replace("{".$k."}", (string)$v, $txt); }
  return $txt;
}
function current_lang(): string {
  return $_SESSION['lang'] ?? 'es';
}
function switch_lang_url(string $to): string {
  $qs = $_GET; $qs['lang'] = $to;
  return strtok($_SERVER['REQUEST_URI'], '?') . '?' . http_build_query($qs);
}

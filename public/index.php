<?php
declare(strict_types=1);

require __DIR__ . '/../app/bootstrap.php'; // aquí dentro cargas i18n.php y seo.php

$routes = require __DIR__ . '/../app/routes.php';

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$key = $method . ' ' . (rtrim($path, '/') ?: '/');

if (!isset($routes[$key])) {
  http_response_code(404);
  $title = '404';
  ob_start();
  echo '<section class="py-20 text-center"><h1 class="text-3xl font-bold">404</h1><p>Página no encontrada</p></section>';
  $__content = ob_get_clean();
  require __DIR__ . '/../views/layout.php';
  exit;
}

ob_start();              // Capturamos la vista que incluya la ruta
$routes[$key]();         // La ruta hará "require .../views/lo-que-sea.php"
$__content = ob_get_clean();

// $title y $seoData deberían ya venir de la ruta
$title = $title ?? 'Transfer Marbell';

require __DIR__ . '/../views/layout.php';

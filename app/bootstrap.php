<?php
// app/bootstrap.php
declare(strict_types=1);

// i18n
require_once __DIR__ . '/i18n.php';

// .env utilidades
function env_load($file){ $e=[]; if(is_readable($file)){
  foreach(file($file, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES) as $l){
    if($l[0]==='#') continue; [$k,$v]=array_pad(explode('=',$l,2),2,null); $e[trim($k)] = trim((string)$v);
  }} return $e;
}
$ENV = env_load(__DIR__ . '/../.env');
function envv($k,$d=null){ global $ENV; return $ENV[$k] ?? $d; }

// DB (opcional)
function db(): PDO {
  static $pdo; if ($pdo) return $pdo;
  $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=%s',
    envv('DB_HOST','127.0.0.1'), envv('DB_PORT','3306'),
    envv('DB_NAME',''), envv('DB_CHARSET','utf8mb4'));
  $pdo = new PDO($dsn, envv('DB_USER',''), envv('DB_PASS',''),
    [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);
  return $pdo;
}

// ---- RENDER de vistas con layout ----
function render(string $view, array $vars = []): void {
  $viewFile = __DIR__ . "/../views/partials/{$view}.php";
  if (!is_readable($viewFile)) { http_response_code(404); echo "View not found"; return; }
  extract($vars, EXTR_SKIP);
  $lang = current_lang();
  include __DIR__ . '/../views/layout/header.php';   // <html> + head + topnav abre <main>
  include $viewFile;                                 // tu contenido (solo secciones)
  include __DIR__ . '/../views/layout/footer.php';   // cierra </main> + footer + </html>
}

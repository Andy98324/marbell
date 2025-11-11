<?php
declare(strict_types=1);

// Carga .env robusta (sin depender de parse_ini_file)
function load_env(string $path): array {
  $real = realpath($path);
  if ($real === false) return [];
  $raw = @file_get_contents($real);
  if ($raw === false) return [];
  // quitar BOM si lo hubiera
  $raw = preg_replace('/^\xEF\xBB\xBF/', '', $raw);
  $env = [];
  foreach (preg_split('/\r\n|\r|\n/', $raw) as $line) {
    $line = trim($line);
    if ($line === '' || $line[0] === '#') continue;
    $parts = explode('=', $line, 2);
    if (count($parts) === 2) {
      $env[trim($parts[0])] = trim($parts[1]);
    }
  }
  return $env;
}

$ENV = load_env(__DIR__ . '/../.env');
function envv(string $k, $d=null) {
  global $ENV;
  return array_key_exists($k, $ENV) ? $ENV[$k] : $d;
}

function db(): PDO {
  $dsn = sprintf(
    'mysql:host=%s;port=%s;dbname=%s;charset=%s',
    envv('DB_HOST','127.0.0.1'),
    envv('DB_PORT','3306'),
    envv('DB_NAME',''),
    envv('DB_CHARSET','utf8mb4')
  );
  $user = (string)envv('DB_USER','');
  $pass = (string)envv('DB_PASS','');

  if ($user === '') {
    throw new RuntimeException('DB_USER vacío: revisa la carga de .env');
  }

  $pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
  // Session charset/collation
  $pdo->exec("SET NAMES " . envv('DB_CHARSET','utf8mb4') . " COLLATE utf8mb4_unicode_ci");
  return $pdo;
}

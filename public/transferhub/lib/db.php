<?php
// lib/db.php
// Carga la config con las constantes DB_HOST, DB_NAME, DB_USER, DB_PASS
// AJUSTA la ruta si tu config está en otro sitio.
$cfgLoaded = false;
foreach ([
    __DIR__ . '/../config/config.php',
    __DIR__ . '/../config.php',
    __DIR__ . '/../owner/config.php',
] as $cfg) {
    if (is_file($cfg)) { require_once $cfg; $cfgLoaded = true; break; }
}
if (!$cfgLoaded) {
    // Evita que nadie termine conectando con root por defecto
    http_response_code(500);
    die('No se encontró el archivo de configuración con las constantes DB_*');
}

/**
 * Retorna un PDO conectado usando las constantes.
 */
function db(): PDO {
    static $pdo = null;
    if ($pdo instanceof PDO) return $pdo;

    if (!defined('DB_HOST') || !defined('DB_NAME') || !defined('DB_USER') || !defined('DB_PASS')) {
        throw new RuntimeException('Faltan constantes DB_* en la configuración');
    }

    $dsn  = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4';
    $opts = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $opts);
    return $pdo;
}

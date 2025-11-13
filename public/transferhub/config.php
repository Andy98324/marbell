<?php
/**
 * Configuración principal de TransferHub
 * 
 * Esta config se usa por lib/db.php y por el resto del backend.
 * BD OFICIAL: marbell
 */

/* ========= BASE DE DATOS ========= */

// Host de MySQL (normalmente 127.0.0.1 o localhost)
if (!defined('DB_HOST')) {
    define('DB_HOST', '127.0.0.1');
}

// Nombre de la base de datos oficial
if (!defined('DB_NAME')) {
    define('DB_NAME', 'marbell');
}

// Usuario de la BD
if (!defined('DB_USER')) {
    define('DB_USER', 'root'); // ⚠️ cámbialo si usas otro usuario
}

// Contraseña del usuario de la BD
if (!defined('DB_PASS')) {
    define('DB_PASS', 'TU_PASSWORD_MYSQL_AQUI'); // ⚠️ CAMBIAR
}

/* ========= URL BASE DEL PROYECTO ========= */

// Mientras estés en el servidor por IP:
if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://157.180.74.170:8081/transferhub');
    // Cuando tengas dominio/subdominio, cambia a:
    // define('BASE_URL', 'https://hub.transfermarbell.com');
}

/* ========= CLAVE DE APP / CSRF ========= */

// Usa una cadena larga y difícil de adivinar
if (!defined('APP_KEY')) {
    define('APP_KEY', 'cambia_esta_clave_por_una_larga_y_unica_TransferHub_2025');
}

/* ========= OPCIONES FACTURACIÓN / FS (PLACEHOLDER) =========
   De momento dejamos solo placeholders para no romper nada.
   Más adelante, cuando integremos la parte de facturación,
   rellenamos estos valores con los de tu instalación antigua.
*/

if (!defined('FS_BASE_URL')) {
    define('FS_BASE_URL', '');
}

if (!defined('FS_USER')) {
    define('FS_USER', '');
}

if (!defined('FS_PASS')) {
    define('FS_PASS', '');
}

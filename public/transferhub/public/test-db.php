<?php
// test-db.php – Test conexión PDO a marbell desde TransferHub

// Ruta base del proyecto TransferHub
$root = dirname(__DIR__);

// Cargamos lib/db.php (que a su vez carga config/config.php)
require_once $root . '/lib/db.php';

header('Content-Type: text/plain; charset=utf-8');

try {
    $pdo = db();

    echo "✅ Conexión OK a la base de datos 'marbell'".PHP_EOL;

    // Intentamos una consulta sencilla: contar las tablas
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_NUM);

    echo "Número de tablas: ".count($tables).PHP_EOL;

    // Si tienes una tabla 'usuarios' o 'conductores', probamos algo rápido:
    try {
        $stmt2 = $pdo->query("SELECT COUNT(*) AS total FROM usuarios");
        $row2  = $stmt2->fetch();
        echo "Usuarios totales (tabla usuarios): ".$row2['total'].PHP_EOL;
    } catch (Throwable $e) {
        echo "Aviso: no se pudo consultar la tabla 'usuarios' (quizá no existe todavía).".PHP_EOL;
    }

} catch (Throwable $e) {
    echo "❌ ERROR de conexión: ".$e->getMessage().PHP_EOL;
}

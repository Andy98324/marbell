<?php
require __DIR__.'/../../app/bootstrap.php';
$pdo = db();
echo "<pre>";
echo "DB: ok\n";
$rows = $pdo->query("SHOW DATABASES")->fetchAll(PDO::FETCH_COLUMN);
echo "Databases: ".implode(", ", $rows)."\n";
$pdo->query("CREATE TABLE IF NOT EXISTS users (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50) UNIQUE NOT NULL, password_hash VARCHAR(255) NOT NULL, role ENUM('admin','colaborador','conductor') DEFAULT 'admin', active TINYINT(1) DEFAULT 1) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
$row = $pdo->query("SELECT id,username,role,active FROM users")->fetchAll(PDO::FETCH_ASSOC);
echo "Users:\n";
print_r($row);

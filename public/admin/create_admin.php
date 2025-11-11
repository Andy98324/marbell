<?php
require __DIR__.'/../../app/bootstrap.php';
$u = 'andy';
$p = '53366795xA'; // tu contraseña
$h = password_hash($p, PASSWORD_DEFAULT);

$pdo = db();
$pdo->exec("CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin','colaborador','conductor') DEFAULT 'admin',
  active TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

$st = $pdo->prepare("INSERT INTO users (username,password_hash,role,active)
VALUES (:u,:h,'admin',1)
ON DUPLICATE KEY UPDATE password_hash=VALUES(password_hash), active=1, role='admin'");
$st->execute([':u'=>$u, ':h'=>$h]);
echo "OK";

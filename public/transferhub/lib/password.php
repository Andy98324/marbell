<?php
// lib/password.php
require_once __DIR__.'/db.php';

/** Crea y guarda un token de reset en usuarios, con caducidad (horas). Devuelve token hex. */
function create_reset_token(int $user_id, int $hours_valid = 24): string {
  $token = bin2hex(random_bytes(32)); // 64 chars
  $exp   = (new DateTime("+{$hours_valid} hours"))->format('Y-m-d H:i:s');
  $sql = "UPDATE usuarios SET reset_token=:t, reset_expires=:e WHERE id=:id";
  db()->prepare($sql)->execute([':t'=>$token, ':e'=>$exp, ':id'=>$user_id]);
  return $token;
}

/** Devuelve el usuario por token si es válido (no caducado); si no, null. */
function get_user_by_token(string $token): ?array {
  $sql = "SELECT * FROM usuarios WHERE reset_token=:t AND reset_expires IS NOT NULL AND reset_expires > NOW() LIMIT 1";
  $st = db()->prepare($sql); $st->execute([':t'=>$token]);
  $u = $st->fetch();
  return $u ?: null;
}

/** Consume el token y fija la contraseña. */
function set_password_with_token(string $token, string $new_password): bool {
  $u = get_user_by_token($token);
  if (!$u) return false;
  $ph = password_hash($new_password, PASSWORD_BCRYPT);
  $sql = "UPDATE usuarios SET password_hash=:ph, reset_token=NULL, reset_expires=NULL, activo=1 WHERE id=:id";
  return db()->prepare($sql)->execute([':ph'=>$ph, ':id'=>$u['id']]);
}

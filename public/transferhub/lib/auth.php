<?php
require_once __DIR__.'/db.php';

/* ==== CONFIG ===== */
const REMEMBER_COOKIE_NAME = 'remember_token';
const REMEMBER_DAYS        = 30; // duración cookie

/* ==== CORE ===== */
function auth_start(): void {
  if (session_status() !== PHP_SESSION_ACTIVE) session_start();

  // ya autenticado
  if (!empty($_SESSION['user'])) return;

  // intentar autologin por cookie
  if (!empty($_COOKIE[REMEMBER_COOKIE_NAME])) {
    $parts = explode(':', $_COOKIE[REMEMBER_COOKIE_NAME], 2);
    if (count($parts) === 2) {
      [$uid, $token] = $parts;
      $uid = (int)$uid;

      $st = db()->prepare('SELECT id,email,rol,proveedor_id,conductor_id,remember_token_hash,remember_token_expires,activo
                           FROM usuarios WHERE id=? LIMIT 1');
      $st->execute([$uid]);
      $u = $st->fetch();

      if ($u && (int)$u['activo'] === 1 && $u['remember_token_hash'] && $u['remember_token_expires']) {
        $validDate = (strtotime($u['remember_token_expires']) > time());
        $validHash = hash_equals($u['remember_token_hash'], hash('sha256', $token));

        if ($validDate && $validHash) {
          $_SESSION['user'] = [
            'id'           => (int)$u['id'],
            'email'        => $u['email'],
            'rol'          => $u['rol'],
            'proveedor_id' => $u['proveedor_id'],
            'conductor_id' => $u['conductor_id'],
          ];
          _auth_issue_remember_token((int)$u['id']); // rotamos token
          return;
        }
      }
    }
    _auth_clear_remember_cookie();
  }
}

function auth_login(string $email, string $password, bool $remember = false): bool {
  auth_start();
  $st = db()->prepare('SELECT * FROM usuarios WHERE email=? AND activo=1 LIMIT 1');
  $st->execute([$email]);
  $u = $st->fetch();

  if ($u && password_verify($password, $u['password_hash'])) {
    $_SESSION['user'] = [
      'id'           => (int)$u['id'],
      'email'        => $u['email'],
      'rol'          => $u['rol'],
      'proveedor_id' => $u['proveedor_id'],
      'conductor_id' => $u['conductor_id'],
    ];

    if ($remember) _auth_issue_remember_token((int)$u['id']);

    return true;
  }
  return false;
}

function auth_user(): ?array { auth_start(); return $_SESSION['user'] ?? null; }

function auth_check(): void {
  if (!auth_user()) {
    header('Location: '.BASE_URL.'/public/login.php');
    exit;
  }
}

function auth_logout(): void {
  auth_start();

  if (!empty($_SESSION['user']['id'])) {
    $uid = (int)$_SESSION['user']['id'];
    $st = db()->prepare('UPDATE usuarios SET remember_token_hash=NULL, remember_token_expires=NULL WHERE id=?');
    $st->execute([$uid]);
  }

  _auth_clear_remember_cookie();

  $_SESSION = [];
  if (session_status() === PHP_SESSION_ACTIVE) session_destroy();
}

/* ==== helpers privados ==== */

function _auth_issue_remember_token(int $userId): void {
  $token   = bin2hex(random_bytes(32));
  $hash    = hash('sha256', $token);
  $expires = time() + REMEMBER_DAYS * 86400;

  $st = db()->prepare('UPDATE usuarios SET remember_token_hash=?, remember_token_expires=FROM_UNIXTIME(?) WHERE id=?');
  $st->execute([$hash, $expires, $userId]);

  $cookieValue = $userId.':'.$token;
  _auth_setcookie(REMEMBER_COOKIE_NAME, $cookieValue, $expires);
}

function _auth_clear_remember_cookie(): void {
  _auth_setcookie(REMEMBER_COOKIE_NAME, '', time() - 3600);
}

/**
 * setcookie robusto: usa array (PHP>=7.3). Si el hosting no lo soporta, cae al modo legacy.
 */
function _auth_setcookie(string $name, string $value, int $expires): void {
  $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
  $opts = [
    'expires'  => $expires,
    'path'     => '/',
    'secure'   => $secure,
    'httponly' => true,
    'samesite' => 'Lax',
  ];

  $ok = @setcookie($name, $value, $opts);
  if (!$ok) {
    // Fallback legacy (algunos hostings antiguos)
    @setcookie($name, $value, $expires, '/; samesite=Lax', '', $secure, true);
  }
}

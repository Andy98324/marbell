<?php
function start_session_once(): void {
  if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params([
      'lifetime' => 0,
      'path'     => '/',
      'httponly' => true,
      'samesite' => 'Lax',
      'secure'   => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
    ]);
    session_start();
  }
}

function is_admin_logged(): bool {
  start_session_once();
  return !empty($_SESSION['admin']) && !empty($_SESSION['admin']['id']);
}

function require_admin(): void {
  if (!is_admin_logged()) { header('Location: /admin/login.php'); exit; }
}

function admin_login(array $row): void {
  start_session_once();
  $_SESSION['admin'] = [
    'id'       => (int)$row['id'],
    'username' => $row['username'],
    'role'     => $row['role'] ?? 'admin',
  ];
}

function admin_logout(): void {
  start_session_once();
  $_SESSION = [];
  if (ini_get('session.use_cookies')) {
    $p = session_get_cookie_params();
    setcookie(session_name(), '', time()-42000, $p['path'], $p['domain']??'', $p['secure']??false, $p['httponly']??true);
  }
  session_destroy();
}

<?php
// app/helpers/auth.php

function start_session_once(): void {
  if (session_status() !== PHP_SESSION_ACTIVE) {
    // Cookies seguras y con ruta /
    session_set_cookie_params([
      'lifetime' => 0,
      'path'     => '/',
      'httponly' => true,
      'samesite' => 'Lax',
      'secure'   => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'), // true en https
    ]);
    session_start();
  }
}

function is_admin_logged(): bool {
  start_session_once();
  return !empty($_SESSION['admin']) && !empty($_SESSION['admin']['id']);
}

function require_admin(): void {
  start_session_once();
  if (!is_admin_logged()) {
    header('Location: /admin/login.php');
    exit;
  }
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
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'] ?? '', $params['secure'], $params['httponly']);
  }
  session_destroy();
}

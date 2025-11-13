<?php
require_once __DIR__.'/../config/config.php';

function csrf_token(): string {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return hash_hmac('sha256', $_SESSION['csrf'], APP_KEY);
}

function csrf_field(): string {
    return '<input type="hidden" name="_token" value="'.htmlspecialchars(csrf_token(), ENT_QUOTES).'">';
}

function csrf_verify(): void {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $t = $_POST['_token'] ?? '';
        if (!hash_equals(csrf_token(), $t)) {
            http_response_code(419);
            die('CSRF token inválido');
        }
    }
}

function csrf_check(): void {
    csrf_verify();
}

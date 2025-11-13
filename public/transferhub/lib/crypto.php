<?php
// lib/crypto.php
require_once __DIR__ . '/../config/secret.php';

/**
 * Devuelve key binaria de 32 bytes a partir de APP_SECRET.
 */
function _crypto_key(): string {
  // Hash estable a 32 bytes (AES-256)
  return hash('sha256', APP_SECRET, true);
}

/**
 * Cifra texto plano con AES-256-GCM (devuelve base64 iv:tag:cipher)
 */
function encrypt_secret(string $plain): string {
  if ($plain === '') return '';
  $key = _crypto_key();
  $iv  = random_bytes(12); // GCM recomienda 12 bytes
  $tag = '';
  $cipher = openssl_encrypt($plain, 'aes-256-gcm', $key, OPENSSL_RAW_DATA, $iv, $tag);
  if ($cipher === false) {
    throw new RuntimeException('No se pudo cifrar el secreto');
  }
  // Guardamos iv:tag:cipher en base64 para portabilidad
  return base64_encode($iv) . ':' . base64_encode($tag) . ':' . base64_encode($cipher);
}

/**
 * Descifra el formato base64 iv:tag:cipher
 */
function decrypt_secret(?string $blob): string {
  if (empty($blob)) return '';
  $parts = explode(':', $blob);
  if (count($parts) !== 3) return '';
  [$b64iv, $b64tag, $b64cipher] = $parts;
  $iv     = base64_decode($b64iv, true);
  $tag    = base64_decode($b64tag, true);
  $cipher = base64_decode($b64cipher, true);
  if ($iv===false || $tag===false || $cipher===false) return '';
  $key = _crypto_key();
  $plain = openssl_decrypt($cipher, 'aes-256-gcm', $key, OPENSSL_RAW_DATA, $iv, $tag);
  return $plain === false ? '' : $plain;
}

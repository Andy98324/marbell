<?php
require_once __DIR__.'/db.php'; // para usar db() en log_historial

function e($v){ return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function money($n){ return number_format((float)$n, 2, ',', '.'); }

function log_historial(
  int $reserva_id,
  int $quien_id,
  string $accion,
  ?string $desde,
  ?string $hasta,
  array $payload=[]
): void {
  $json = json_encode($payload, JSON_UNESCAPED_UNICODE);
  $sql = 'INSERT INTO historial_reserva (reserva_id, quien_id, accion, desde_estado, a_estado, payload_json)
          VALUES (?,?,?,?,?,?)';
  db()->prepare($sql)->execute([$reserva_id, $quien_id, $accion, $desde, $hasta, $json]);
}

function next_ref(): string {
  return 'R'.date('YmdHis').rand(100,999);
}

/** Regla por defecto: 95% del precio de venta (puedes editar el factor) */
function calcular_precio_chofer_default($precioVenta){
  return (float)round((float)$precioVenta * 0.95);
}
if (!function_exists('ensure_agencia_id')) {
  function ensure_agencia_id(string $nombre): ?int {
    if ($nombre === '') return null;
    // Requiere índice único: ALTER TABLE agencias ADD UNIQUE KEY uq_agencias_nombre (nombre);
    $sql = "INSERT INTO agencias (nombre) VALUES (?)
            ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)";
    db()->prepare($sql)->execute([$nombre]);
    return (int)db()->lastInsertId();
  }
}
function absolute_url(string $path): string {
  // BASE_URL de config define el prefijo del proyecto (p.ej. /volcano_andy)
  require_once __DIR__.'/../config/config.php';
  $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
  $host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
  // Normaliza BASE_URL
  $base = rtrim(BASE_URL, '/');
  $path = '/'.ltrim($path, '/');
  return "{$scheme}://{$host}{$base}{$path}";
}

/** Normaliza un teléfono para wa.me (sólo dígitos, elimina + y espacios). */
function phone_for_wa(?string $tel): ?string {
  if (!$tel) return null;
  $d = preg_replace('/\D+/', '', $tel);
  return $d ?: null;
}

/* ---------- EXTRAS ---------- */

/** Catálogo fijo de extras (clave => [label, unidad]) */
function extras_catalog(): array {
  return [
    'silla_bebe'   => ['Sillita de bebé', 'ud'],
    'alzador'      => ['Alzador', 'ud'],
    'silla_ruedas' => ['Silla de ruedas plegada', 'ud'],
    'bolsas_golf'  => ['Bolsas de golf', 'ud'],
    'bicicleta'  => ['Bicicleta', 'ud'],
  ];
}

/** Normaliza array POST a objeto limpio {clave:int>0} */
function extras_sanitize_from_post(array $post): array {
  $cat = extras_catalog(); $res = [];
  foreach ($post as $k=>$v) {
    if (!isset($cat[$k])) continue;
    $qty = (int)$v;
    if ($qty > 0) $res[$k] = $qty;
  }
  return $res;
}

/** Convierte JSON/array a badges HTML “Legibles” */
// ---------- Extras helpers (ocultan los 0) ----------

/** Acepta array o JSON (o null/"", "null") y devuelve array seguro */
function extras_parse($value): array {
    if (is_array($value)) return $value;

    if (is_string($value)) {
        $t = trim($value);
        if ($t === '' || strtolower($t) === 'null') return [];
        $arr = json_decode($t, true);
        return is_array($arr) ? $arr : [];
    }

    if (is_object($value)) {
        $arr = json_decode(json_encode($value), true);
        return is_array($arr) ? $arr : [];
    }

    return [];
}

/**
 * Texto simple: "Sillita × 2, Alzador × 1"
 * Omite cualquier extra con cantidad <= 0.
 */
function extras_text($jsonOrArray): string {
    $extras = extras_parse($jsonOrArray);
    if (!$extras) return '';

    $cat   = extras_catalog(); // ['clave'=>['Etiqueta','unidad'], ...]
    $parts = [];

    foreach ($extras as $k => $n) {
        $n = (int)$n;
        if ($n <= 0 || !isset($cat[$k])) continue;
        [$label, $_u] = $cat[$k];
        $parts[] = "{$label} × {$n}";
    }

    return implode(', ', $parts);
}

/**
 * Badges HTML para la UI (omite los que tienen 0).
 * Ejemplo: <span class="badge bg-info text-dark me-1 mb-1">Sillita × 2</span>
 */
function extras_badges($jsonOrArray): string {
    $extras = extras_parse($jsonOrArray);
    if (!$extras) return '';

    $cat = extras_catalog();
    $out = [];

    foreach ($extras as $k => $n) {
        $n = (int)$n;
        if ($n <= 0 || !isset($cat[$k])) continue;
        [$label, $_u] = $cat[$k];

        $out[] = '<span class="badge bg-info text-dark me-1 mb-1">'
               . e($label) . ' × ' . $n
               . '</span>';
    }

    return implode(' ', $out);
}


<?php
// /public/admin/zone-prices.php — CRUD precios zona→zona por vehículo
declare(strict_types=1);
require __DIR__ . '/../../app/bootstrap.php';
require_admin();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

/* ------------- Utils & Ensure ------------- */

function dbx(): PDO { return db(); }

function ensure_tables(): void {
  // Zonas (por si alguien entra aquí antes de crear zonas)
  dbx()->exec("
    CREATE TABLE IF NOT EXISTS zones (
      id     INT AUTO_INCREMENT PRIMARY KEY,
      name   VARCHAR(100) NOT NULL UNIQUE,
      geom   POLYGON NOT NULL,
      active TINYINT(1) NOT NULL DEFAULT 1
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  ");

  // Vehículos (catálogo)
  dbx()->exec("
    CREATE TABLE IF NOT EXISTS vehicles (
      code        VARCHAR(32) PRIMARY KEY,
      name        VARCHAR(100) NOT NULL,
      img         VARCHAR(255) NULL,
      pax         VARCHAR(32)  NULL,
      luggage     VARCHAR(32)  NULL,
      base        DECIMAL(10,2) NOT NULL DEFAULT 0,
      per_km      DECIMAL(10,2) NOT NULL DEFAULT 0,
      per_min     DECIMAL(10,2) NOT NULL DEFAULT 0,
      min_fare    DECIMAL(10,2) NOT NULL DEFAULT 0,
      active      TINYINT(1) NOT NULL DEFAULT 1
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  ");

  // Precios zona→zona por vehículo
  dbx()->exec("
    CREATE TABLE IF NOT EXISTS zone_prices (
      id            INT AUTO_INCREMENT PRIMARY KEY,
      zone_from_id  INT NOT NULL,
      zone_to_id    INT NOT NULL,
      vehicle_code  VARCHAR(32) NOT NULL,
      price         DECIMAL(10,2) NOT NULL,
      currency      CHAR(3) NOT NULL DEFAULT 'EUR',
      UNIQUE KEY uq_zone_vehicle (zone_from_id, zone_to_id, vehicle_code),
      FOREIGN KEY (zone_from_id) REFERENCES zones(id) ON DELETE CASCADE,
      FOREIGN KEY (zone_to_id)   REFERENCES zones(id) ON DELETE CASCADE,
      FOREIGN KEY (vehicle_code) REFERENCES vehicles(code) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  ");
}

function fetch_zones(): array {
  return dbx()->query("SELECT id, name FROM zones WHERE active=1 ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
}
function fetch_vehicles(): array {
  return dbx()->query("SELECT code, name FROM vehicles WHERE active=1 ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
}
function fetch_prices(): array {
  $sql = "SELECT zp.id, zf.name AS from_name, zt.name AS to_name, zp.vehicle_code, v.name AS vehicle_name, zp.price, zp.currency,
                 zp.zone_from_id, zp.zone_to_id
          FROM zone_prices zp
          JOIN zones zf ON zf.id = zp.zone_from_id
          JOIN zones zt ON zt.id = zp.zone_to_id
          JOIN vehicles v ON v.code = zp.vehicle_code
          ORDER BY zf.name, zt.name, v.name";
  return dbx()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
function find_price(int $id): ?array {
  $st = dbx()->prepare("SELECT * FROM zone_prices WHERE id=:id");
  $st->execute([':id'=>$id]);
  $row = $st->fetch(PDO::FETCH_ASSOC);
  return $row ?: null;
}
function upsert_price(?int $id, int $fromId, int $toId, string $vehicle, float $price, string $currency='EUR'): void {
  if ($id) {
    $st = dbx()->prepare("UPDATE zone_prices SET zone_from_id=:f, zone_to_id=:t, vehicle_code=:v, price=:p, currency=:c WHERE id=:id");
    $st->execute([':f'=>$fromId, ':t'=>$toId, ':v'=>$vehicle, ':p'=>$price, ':c'=>$currency, ':id'=>$id]);
  } else {
    // insert con upsert por si existe la combinación
    $st = dbx()->prepare("
      INSERT INTO zone_prices (zone_from_id, zone_to_id, vehicle_code, price, currency)
      VALUES (:f,:t,:v,:p,:c)
      ON DUPLICATE KEY UPDATE price=VALUES(price), currency=VALUES(currency)
    ");
    $st->execute([':f'=>$fromId, ':t'=>$toId, ':v'=>$vehicle, ':p'=>$price, ':c'=>$currency]);
  }
}
function delete_price(int $id): void {
  $st = dbx()->prepare("DELETE FROM zone_prices WHERE id=:id");
  $st->execute([':id'=>$id]);
}

/* ------------- Bootstrap ------------- */

ensure_tables();

$zones    = fetch_zones();
$vehicles = fetch_vehicles();
$prices   = fetch_prices();

$mode   = $_GET['mode']   ?? 'list';  // list | edit
$editId = isset($_GET['id']) ? (int)$_GET['id'] : null;
$editRow = null;

/* ------------- POST actions ------------- */

if ($_SERVER['REQUEST_METHOD']==='POST') {
  $action = $_POST['action'] ?? '';
  if ($action === 'save') {
    $id      = isset($_POST['id']) && $_POST['id'] !== '' ? (int)$_POST['id'] : null;
    $fromId  = (int)($_POST['zone_from_id'] ?? 0);
    $toId    = (int)($_POST['zone_to_id'] ?? 0);
    $vehicle = trim($_POST['vehicle_code'] ?? '');
    $price   = (float)($_POST['price'] ?? 0);
    $curr    = strtoupper(trim($_POST['currency'] ?? 'EUR'));
    if (!$fromId || !$toId || !$vehicle || $price <= 0) {
      $err = "Campos obligatorios inválidos.";
    } else {
      upsert_price($id, $fromId, $toId, $vehicle, $price, $curr ?: 'EUR');
      header('Location: /admin/zone-prices.php?saved=1'); exit;
    }
  }
  if ($action === 'delete') {
    $id = (int)($_POST['id'] ?? 0);
    if ($id) delete_price($id);
    header('Location: /admin/zone-prices.php?deleted=1'); exit;
  }
}

/* ------------- Edit mode ------------- */
if ($mode === 'edit' && $editId) {
  $editRow = find_price($editId);
  if (!$editRow) { header('Location: /admin/zone-prices.php?nf=1'); exit; }
}

/* ------------- HTML ------------- */
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Precios por zona</title>
  <style>
    body{font-family:system-ui,Segoe UI,Roboto,Arial,sans-serif;margin:0;background:#f6f7fb;color:#111827}
    header{background:#0b1220;color:#fff;padding:12px 16px;display:flex;justify-content:space-between;align-items:center}
    a,h1,h2,h3{color:inherit;text-decoration:none}
    .wrap{max-width:1100px;margin:18px auto;padding:0 16px}
    .bar{display:flex;gap:10px;align-items:center;margin:12px 0}
    .card{background:#fff;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,.08);padding:14px;margin:12px 0}
    .grid{display:grid;gap:10px}
    .grid-3{grid-template-columns:1fr 1fr 1fr}
    .grid-4{grid-template-columns:1fr 1fr 1fr 1fr}
    label{font-size:12px;color:#6b7280}
    select,input[type=text],input[type=number]{width:100%;padding:10px 12px;border:1px solid #e5e7eb;border-radius:10px;font-size:14px}
    button{background:#0b1220;color:#fff;border:0;border-radius:10px;padding:10px 14px;font-weight:600;cursor:pointer}
    table{width:100%;border-collapse:collapse}
    th,td{padding:10px;border-bottom:1px solid #e5e7eb;text-align:left}
    .muted{color:#6b7280;font-size:12px}
    .tag{display:inline-block;background:#eef2ff;border:1px solid #c7d2fe;color:#3730a3;border-radius:999px;padding:2px 8px;font-size:12px}
    .ok{color:#065f46;background:#d1fae5;border:1px solid #10b981;padding:8px 10px;border-radius:8px;margin:8px 0;display:inline-block}
    .err{color:#991b1b;background:#fee2e2;border:1px solid #fecaca;padding:8px 10px;border-radius:8px;margin:8px 0;display:inline-block}
    .actions{display:flex;gap:8px}
  </style>
</head>
<body>
<header>
  <strong>Panel · Precios por zona</strong>
  <nav class="muted">
    <a href="/admin/zones.php" style="color:#fff;opacity:.9">Zonas</a> ·
    <a href="/admin/zone-prices.php" style="color:#fff;opacity:1;font-weight:700">Precios</a> ·
    <a href="/admin/logout.php" style="color:#fff;opacity:.9">Salir</a>
  </nav>
</header>

<div class="wrap">

  <?php if (!empty($err)): ?><div class="err"><?= htmlspecialchars($err) ?></div><?php endif; ?>
  <?php if (!empty($_GET['saved'])): ?><div class="ok">Precio guardado.</div><?php endif; ?>
  <?php if (!empty($_GET['deleted'])): ?><div class="ok">Precio eliminado.</div><?php endif; ?>
  <?php if (!empty($_GET['nf'])): ?><div class="err">Registro no encontrado.</div><?php endif; ?>

  <div class="card">
    <h3 style="margin:0 0 10px"><?= $editRow ? 'Editar precio' : 'Nuevo precio' ?></h3>
    <form method="post" class="grid grid-4" style="align-items:end;gap:12px">
      <input type="hidden" name="action" value="save">
      <?php if ($editRow): ?>
        <input type="hidden" name="id" value="<?= (int)$editRow['id'] ?>">
      <?php endif; ?>

      <div>
        <label>Zona origen</label>
        <select name="zone_from_id" required>
          <option value="">—</option>
          <?php foreach ($zones as $z): ?>
            <option value="<?= (int)$z['id'] ?>" <?= $editRow && (int)$editRow['zone_from_id']===(int)$z['id'] ? 'selected':'' ?>>
              <?= htmlspecialchars($z['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div>
        <label>Zona destino</label>
        <select name="zone_to_id" required>
          <option value="">—</option>
          <?php foreach ($zones as $z): ?>
            <option value="<?= (int)$z['id'] ?>" <?= $editRow && (int)$editRow['zone_to_id']===(int)$z['id'] ? 'selected':'' ?>>
              <?= htmlspecialchars($z['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div>
        <label>Vehículo</label>
        <select name="vehicle_code" required>
          <option value="">—</option>
          <?php foreach ($vehicles as $v): ?>
            <option value="<?= htmlspecialchars($v['code']) ?>" <?= $editRow && $editRow['vehicle_code']===$v['code'] ? 'selected':'' ?>>
              <?= htmlspecialchars($v['name']) ?> (<?= htmlspecialchars($v['code']) ?>)
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div>
        <label>Precio (EUR)</label>
        <input type="number" name="price" step="0.01" min="0" required
               value="<?= $editRow ? htmlspecialchars($editRow['price']) : '' ?>">
      </div>

      <div>
        <label>Moneda</label>
        <input type="text" name="currency" maxlength="3" value="<?= $editRow ? htmlspecialchars($editRow['currency']) : 'EUR' ?>">
      </div>

      <div>
        <button type="submit">Guardar</button>
        <?php if ($editRow): ?>
          <a href="/admin/zone-prices.php" class="muted" style="margin-left:8px">Cancelar</a>
        <?php endif; ?>
      </div>
    </form>
  </div>

  <div class="card">
    <h3 style="margin:0 0 10px">Lista de precios</h3>
    <?php if (!$prices): ?>
      <p class="muted">Aún no hay precios definidos.</p>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>Origen</th><th>Destino</th><th>Vehículo</th><th>Precio</th><th></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($prices as $row): ?>
          <tr>
            <td><span class="tag"><?= htmlspecialchars($row['from_name']) ?></span></td>
            <td><span class="tag"><?= htmlspecialchars($row['to_name']) ?></span></td>
            <td><?= htmlspecialchars($row['vehicle_name']) ?> <small class="muted">(<?= htmlspecialchars($row['vehicle_code']) ?>)</small></td>
            <td>€<?= number_format((float)$row['price'], 2) ?> <small class="muted"><?= htmlspecialchars($row['currency']) ?></small></td>
            <td class="actions">
              <a href="/admin/zone-prices.php?mode=edit&id=<?= (int)$row['id'] ?>"><button type="button">Editar</button></a>
              <form method="post" onsubmit="return confirm('¿Eliminar este precio?')">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?= (int)$row['id'] ?>">
                <button type="submit" style="background:#991b1b">Eliminar</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>

</div>
</body>
</html>

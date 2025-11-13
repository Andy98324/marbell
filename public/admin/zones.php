<?php
// /public/admin/zones.php — versión robusta y compatible MySQL/MariaDB
require __DIR__ . '/../../app/bootstrap.php';
require_admin();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* ---------- Utilidades ---------- */

function dbx(): PDO { return db(); }

/** Crea la tabla si no existe (sin SRID para máxima compatibilidad) */
function ensure_zones_table(): void {
  $sql = <<<SQL
CREATE TABLE IF NOT EXISTS zones (
  id     INT AUTO_INCREMENT PRIMARY KEY,
  name   VARCHAR(100) NOT NULL UNIQUE,
  geom   POLYGON NOT NULL,
  active TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SQL;
  dbx()->exec($sql);
}

/** Convierte GeoJSON Polygon (geometry) a WKT POLYGON((lng lat,...)) */
function geojson_polygon_to_wkt(array $geom): string {
  if (($geom['type'] ?? '') !== 'Polygon') {
    throw new InvalidArgumentException('Solo se admite geometry de tipo Polygon');
  }
  $ring = $geom['coordinates'][0] ?? null; // primer anillo
  if (!$ring || count($ring) < 4) {
    throw new InvalidArgumentException('Polígono inválido: necesita al menos 4 puntos');
  }

  $pairs = [];
  foreach ($ring as $pt) {
    if (!is_array($pt) || count($pt) < 2) {
      throw new InvalidArgumentException('Coordenada inválida en el polígono');
    }
    // OJO: GeoJSON es [lng, lat]
    $lng = (float)$pt[0];
    $lat = (float)$pt[1];
    $pairs[] = $lng . ' ' . $lat;
  }

  // Asegurar cierre (primer punto = último punto)
  $first = $ring[0];
  $last  = $ring[count($ring)-1];
  if ($first[0] !== $last[0] || $first[1] !== $last[1]) {
    $pairs[] = $pairs[0];
  }

  return 'POLYGON((' . implode(',', $pairs) . '))';
}

/** Inserta/actualiza zona usando ST_GeomFromText sin SRID (compatibilidad amplia) */
function upsert_zone_from_wkt(string $name, string $wkt): void {
  $sql = "INSERT INTO zones (name, geom, active)
          VALUES (:n, ST_GeomFromText(:wkt), 1)
          ON DUPLICATE KEY UPDATE geom = VALUES(geom), active = 1";
  $st = dbx()->prepare($sql);
  $st->execute([':n' => $name, ':wkt' => $wkt]);
}

/** Carga zonas para el mapa; usa ST_AsGeoJSON si existe, si no hace fallback con ST_AsText */
function load_zones_for_map(): array {
  $pdo = dbx();
  try {
    // Intento con ST_AsGeoJSON
    $rows = $pdo->query("SELECT id, name, ST_AsGeoJSON(geom) AS gj, active FROM zones ORDER BY name")
                ->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as &$r) {
      if (!empty($r['gj'])) {
        $r['geometry'] = json_decode($r['gj'], true);
      } else {
        $r['geometry'] = null;
      }
    }
    return $rows;
  } catch (Throwable $e) {
    // Fallback con ST_AsText → convertir WKT a GeoJSON básico
    $rows = $pdo->query("SELECT id, name, ST_AsText(geom) AS wkt, active FROM zones ORDER BY name")
                ->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as &$r) {
      $r['geometry'] = wkt_to_geojson_polygon($r['wkt'] ?? '');
    }
    return $rows;
  }
}

/** Conversor simple WKT POLYGON((lng lat,...)) → GeoJSON geometry */
function wkt_to_geojson_polygon(string $wkt): ?array {
  if (stripos($wkt, 'POLYGON') !== 0) return null;
  $inside = preg_replace('/^POLYGON\s*\(\(/i', '', $wkt);
  $inside = preg_replace('/\)\)\s*$/', '', $inside);
  $parts  = array_map('trim', explode(',', trim($inside)));
  $coords = [];
  foreach ($parts as $p) {
    $nums = preg_split('/\s+/', $p);
    if (count($nums) < 2) continue;
    $lng = (float)$nums[0];
    $lat = (float)$nums[1];
    $coords[] = [$lng, $lat];
  }
  if (count($coords) < 4) return null;
  return ['type' => 'Polygon', 'coordinates' => [ $coords ]];
}

/* ---------- Boot ---------- */

try {
  ensure_zones_table();
} catch (Throwable $e) {
  http_response_code(500);
  echo "<pre>ERROR creando/verificando tabla ZONES:\n".$e->getMessage()."</pre>";
  exit;
}

/* ---------- Eliminar zona ---------- */
if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  if ($id > 0) {
    try {
      $st = dbx()->prepare("DELETE FROM zones WHERE id = :id");
      $st->execute([':id' => $id]);
      // si tienes FKs ON DELETE CASCADE en zone_prices, se borran también sus tarifas
      header('Location: /admin/zones.php?deleted=1');
      exit;
    } catch (Throwable $e) {
      header('Location: /admin/zones.php?delerror=1');
      exit;
    }
  } else {
    header('Location: /admin/zones.php?delerror=1');
    exit;
  }
}

/* ---------- Guardar zona ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['geojson'])) {
    $name = trim($_POST['name'] ?? '');
    $geo  = json_decode($_POST['geojson'], true);

    // convierte GeoJSON -> WKT con cierre de anillo y orden correcto
    $wkt = geojson_polygon_to_wkt($geo);

    $st = db()->prepare("
        INSERT INTO zones(name, geom, active)
        VALUES(:n, ST_GeomFromText(:wkt), 1)
        ON DUPLICATE KEY UPDATE geom=VALUES(geom), active=1
    ");
    $st->execute([':n'=>$name, ':wkt'=>$wkt]);

    header('Location: /admin/zones.php?ok=1'); exit;
}

/* ---------- Listado ---------- */
try {
  $zones = load_zones_for_map();
} catch (Throwable $e) {
  http_response_code(500);
  echo "<pre>ERROR cargando zonas:\n".$e->getMessage()."</pre>";
  exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Zonas</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css">
  <style>
    body{font-family:system-ui,Segoe UI,Roboto,Arial,sans-serif;margin:0;background:#f7f7fb}
    .wrap{max-width:1100px;margin:18px auto;padding:0 16px}
    #map{height:70vh;border-radius:16px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.08)}
    form.zf{background:#fff;border-radius:12px;padding:12px;margin:12px 0;box-shadow:0 6px 20px rgba(0,0,0,.05);display:flex;gap:8px;align-items:center}
    form.zf input[type=text]{flex:1;padding:10px 12px;border:1px solid #e5e7eb;border-radius:10px}
    form.zf button{background:#0b1220;color:#fff;border:0;border-radius:10px;padding:10px 16px;font-weight:600}
    .msg{color:#065f46;background:#d1fae5;border:1px solid #10b981;padding:8px 10px;border-radius:8px;margin:8px 0;display:inline-block}
    .err{color:#991b1b;background:#fee2e2;border:1px solid #fecaca;padding:8px 10px;border-radius:8px;margin:8px 0;display:inline-block}
    ul{padding-left:0;list-style:none}
    header{background:#0b1220;color:#fff;padding:12px 16px;display:flex;justify-content:space-between;align-items:center}
    a,h1,h2,h3{color:inherit;text-decoration:none}
    .zone-row{display:flex;align-items:center;justify-content:space-between;background:#fff;border-radius:10px;padding:8px 10px;margin-bottom:6px;box-shadow:0 4px 12px rgba(0,0,0,.04)}
    .zone-name{font-size:14px;color:#111827}
    .zone-meta{font-size:12px;color:#6b7280}
    .btn-del{background:#fee2e2;color:#b91c1c;border:1px solid #fecaca;border-radius:999px;padding:4px 10px;font-size:12px;cursor:pointer}
    .btn-del:hover{background:#fecaca}
  </style>
</head>
<body>
<header>
  <strong>Panel · Zonas</strong>
  <nav class="muted">
    <a href="/admin/zones.php" style="color:#fff;opacity:1;font-weight:700">Zonas</a> ·
    <a href="/admin/zone-prices.php" style="color:#fff;opacity:.9">Precios</a> ·
    <a href="/admin/logout.php" style="color:#fff;opacity:.9">Salir</a>
  </nav>
</header>
<div class="wrap">
  <?php if (!empty($_GET['ok'])): ?>
    <div class="msg">Zona guardada correctamente.</div>
  <?php endif; ?>

  <?php if (!empty($_GET['deleted'])): ?>
    <div class="msg">Zona eliminada correctamente.</div>
  <?php endif; ?>

  <?php if (!empty($_GET['delerror'])): ?>
    <div class="err">No se pudo eliminar la zona. Revisa dependencias o vuelve a intentarlo.</div>
  <?php endif; ?>

  <form class="zf" method="post" id="zoneForm" onsubmit="return submitZone()">
    <input type="text" name="name" id="zoneName" placeholder="Nombre de la zona (p. ej., Málaga Centro)" required>
    <input type="hidden" name="geojson" id="geojson">
    <button type="submit">Guardar zona</button>
  </form>

  <div id="map"></div>

  <h3>Zonas existentes</h3>
  <?php if (empty($zones)): ?>
    <p class="zone-meta">Todavía no hay zonas definidas.</p>
  <?php else: ?>
    <?php foreach ($zones as $z): ?>
      <div class="zone-row">
        <div>
          <div class="zone-name">
            #<?= (int)$z['id'] ?> — <?= htmlspecialchars($z['name']) ?>
            <?php if ((int)$z['active'] !== 1): ?>
              <span class="zone-meta">(inactiva)</span>
            <?php endif; ?>
          </div>
        </div>
        <div>
          <a href="/admin/zones.php?delete=<?= (int)$z['id'] ?>"
             class="btn-del"
             onclick="return confirm('¿Eliminar esta zona? Esta acción no se puede deshacer.');">
            Eliminar
          </a>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>
<script>
const map = L.map('map').setView([36.72,-4.42], 9);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{maxZoom:19}).addTo(map);

const drawn = new L.FeatureGroup().addTo(map);
map.addControl(new L.Control.Draw({
  edit: { featureGroup: drawn },
  draw: { polygon:true, polyline:false, rectangle:false, circle:false, marker:false, circlemarker:false }
}));

// Pintar existentes
<?php foreach ($zones as $z): if (!empty($z['geometry'])): ?>
(function(){
  const gj = <?= json_encode($z['geometry']) ?>;
  const layer = L.geoJSON(gj).addTo(drawn);
  try { map.fitBounds(layer.getBounds()); } catch(e){}
})();
<?php endif; endforeach; ?>

let lastDrawn = null;
map.on(L.Draw.Event.CREATED, function (e) {
  if (lastDrawn) { drawn.removeLayer(lastDrawn); }
  lastDrawn = e.layer;
  drawn.addLayer(lastDrawn);
  const gj = lastDrawn.toGeoJSON().geometry; // solo geometry
  document.getElementById('geojson').value = JSON.stringify(gj);
});

function submitZone(){
  if (!lastDrawn) { alert('Dibuja un polígono antes de guardar.'); return false; }
  if (!document.getElementById('zoneName').value.trim()) { return false; }
  return true;
}
</script>
</body>
</html>

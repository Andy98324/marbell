<?php
require __DIR__.'/../../app/bootstrap.php';
require_login(); // tu guardia de admin

// Guardar zona
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['geojson'])) {
  $name = trim($_POST['name'] ?? '');
  $geo  = json_decode($_POST['geojson'], true);
  // Convert GeoJSON Polygon -> WKT
  $coords = $geo['coordinates'][0]; // primera anilla
  // OJO: vienen como [lng,lat]
  $pairs = array_map(fn($c)=> $c[0].' '.$c[1], $coords);
  $wkt = 'POLYGON((' . implode(',', $pairs) . '))';

  $st = db()->prepare("INSERT INTO zones(name, geom, active) VALUES(:n, ST_SRID(ST_GeomFromText(:wkt),4326), 1)
                       ON DUPLICATE KEY UPDATE geom=VALUES(geom), active=1");
  $st->execute([':n'=>$name, ':wkt'=>$wkt]);
  header('Location: /admin/zones.php?ok=1'); exit;
}

// Listado
$zones = db()->query("SELECT id,name, ST_AsGeoJSON(geom) geojson, active FROM zones ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html><html><head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Zonas</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css">
  <style> #map{height:70vh;border-radius:16px;overflow:hidden} </style>
</head><body>
  <h1>Gestión de zonas</h1>

  <form method="post" id="zoneForm">
    <input type="text" name="name" placeholder="Nombre de la zona" required>
    <input type="hidden" name="geojson" id="geojson">
    <button type="submit">Guardar zona</button>
  </form>

  <div id="map"></div>

  <h2>Existentes</h2>
  <ul>
    <?php foreach($zones as $z): ?>
      <li>#<?= $z['id'] ?> <?= htmlspecialchars($z['name']) ?></li>
    <?php endforeach; ?>
  </ul>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>
<script>
const map = L.map('map').setView([36.72,-4.42], 9);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{maxZoom:19}).addTo(map);

const drawn = new L.FeatureGroup().addTo(map);
const drawControl = new L.Control.Draw({
  edit: { featureGroup: drawn },
  draw: { polygon: true, polyline:false, rectangle:false, circle:false, marker:false, circlemarker:false }
});
map.addControl(drawControl);

// cargar existentes
<?php foreach($zones as $z): ?>
  (function(){
    const gj = <?= $z['geojson'] ?: 'null' ?>;
    if(!gj) return;
    const layer = L.geoJSON(gj).addTo(drawn);
    map.fitBounds(layer.getBounds());
  })();
<?php endforeach; ?>

map.on(L.Draw.Event.CREATED, function (e) {
  drawn.addLayer(e.layer);
  const gj = e.layer.toGeoJSON();
  document.getElementById('geojson').value = JSON.stringify(gj.geometry);
});
</script>
</body></html>

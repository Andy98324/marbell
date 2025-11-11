<?php

// app/helpers/zones.php
function find_zone_id_by_point(PDO $db, float $lat, float $lng): ?int {
  // OJO: POINT(lng lat)
  $sql = "SELECT id
          FROM zones
          WHERE active=1
            AND ST_Contains(geom, ST_SRID(POINT(:lng, :lat), 4326))
          LIMIT 1";
  $st = $db->prepare($sql);
  $st->execute([':lng'=>$lng, ':lat'=>$lat]);
  $row = $st->fetch(PDO::FETCH_ASSOC);
  return $row ? (int)$row['id'] : null;
}

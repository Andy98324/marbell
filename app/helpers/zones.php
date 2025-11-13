<?php
// app/helpers/zones.php

/**
 * Devuelve el id de la zona que contiene el punto (lat,lng).
 * Ojo: en WKT el orden es LON LAT => POINT(lng lat)
 * Hacemos un pequeño buffer para puntos justo en el borde.
 */
function find_zone_id_by_point(PDO $db, float $lat, float $lng): ?int
{
    // Punto en WKT con ORDEN CORRECTO: lng lat
    $pt = sprintf('POINT(%F %F)', $lng, $lat);

    // 1) intento exacto
    $sql = "SELECT id
            FROM zones
            WHERE ST_Contains(geom, ST_GeomFromText(:pt))
            LIMIT 1";
    $st = $db->prepare($sql);
    $st->execute([':pt' => $pt]);
    $row = $st->fetch(PDO::FETCH_ASSOC);
    if ($row) return (int)$row['id'];

    // 2) si cae justo en borde, intenta con un pequeño buffer
    //    (aprox ~50 metros según latitud; ajusta si quieres)
    $sql2 = "SELECT id
             FROM zones
             WHERE ST_Contains(ST_Buffer(geom, 0.0005), ST_GeomFromText(:pt))
             LIMIT 1";
    $st2 = $db->prepare($sql2);
    $st2->execute([':pt' => $pt]);
    $row2 = $st2->fetch(PDO::FETCH_ASSOC);
    return $row2 ? (int)$row2['id'] : null;
}

/**
 * Para guardar/actualizar una zona desde GeoJSON Polygon
 * (anillo exterior), asegurando cierre y orden correcto.
 * Úsalo en tu /admin/zones.php al INSERT/UPDATE.
 */
function geojson_polygon_to_wkt(array $geojsonPolygon): string
{
    // $geojsonPolygon = ["type"=>"Polygon","coordinates"=>[[[lng,lat], ...]]]
    $ring = $geojsonPolygon['coordinates'][0] ?? [];
    if (empty($ring)) return 'POLYGON(())';

    // Asegurar que el anillo esté cerrado
    $first = $ring[0];
    $last  = end($ring);
    if ($first[0] != $last[0] || $first[1] != $last[1]) {
        $ring[] = $first;
    }

    // Construir WKT (lng lat)
    $pairs = array_map(function($c){
        return $c[0] . ' ' . $c[1];
    }, $ring);

    return 'POLYGON((' . implode(',', $pairs) . '))';
}

<?php
// app/helpers/pricing.php

/**
 * Devuelve el precio fijo por zona si existe
 */
function zone_price(PDO $db, int $zoneFrom, int $zoneTo, string $vehicleCode): ?float {
    $st = $db->prepare("SELECT price FROM zone_prices 
                        WHERE zone_from_id=:f AND zone_to_id=:t AND vehicle_code=:v");
    $st->execute([':f'=>$zoneFrom, ':t'=>$zoneTo, ':v'=>$vehicleCode]);
    $r = $st->fetch(PDO::FETCH_ASSOC);
    return $r ? (float)$r['price'] : null;
}

/**
 * Cálculo por distancia (fallback)
 * Usa los campos base, per_km, per_min, min_fare, más posibles recargos
 */
function distance_fallback_price(array $veh, float $km, float $minutes, float $extra=0): float {
    $base = (float)($veh['base'] ?? 0);
    $perKm = (float)($veh['per_km'] ?? 1);
    $perMin = (float)($veh['per_min'] ?? 0.25);
    $minFare = (float)($veh['min_fare'] ?? 20);

    $calc = $base + ($km * $perKm) + ($minutes * $perMin) + $extra;
    return max($minFare, round($calc, 2));
}

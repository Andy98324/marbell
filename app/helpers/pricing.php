<?php
// app/helpers/pricing.php
function zone_price(PDO $db, int $fromId=null, int $toId=null, string $vehicle): ?float {
  if (!$fromId || !$toId) return null;
  $st = $db->prepare("SELECT price FROM zone_prices
                      WHERE zone_from_id=:f AND zone_to_id=:t AND vehicle_code=:v
                      LIMIT 1");
  $st->execute([':f'=>$fromId, ':t'=>$toId, ':v'=>$vehicle]);
  $row = $st->fetch(PDO::FETCH_ASSOC);
  return $row ? (float)$row['price'] : null;
}

function distance_fallback_price(array $veh, float $km, float $minutes, float $airportFee=0.0): float {
  $raw = $veh['base'] + $km*$veh['per_km'] + $minutes*$veh['per_min'] + $airportFee;
  return ceil(max($raw, $veh['min_fare']));
}

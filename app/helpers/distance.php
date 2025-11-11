<?php
// app/helpers/distance.php
function recalc_distance_duration(float $oLat, float $oLng, float $dLat, float $dLng): array {
  $key = getenv('GMAPS_KEY') ?: envv('GMAPS_KEY'); // tu helper envv()
  $params = http_build_query([
    'origins'      => $oLat.','.$oLng,
    'destinations' => $dLat.','.$dLng,
    'mode'         => 'driving',
    'units'        => 'metric',
    'key'          => $key,
  ]);
  $url = "https://maps.googleapis.com/maps/api/distancematrix/json?".$params;

  $ctx = stream_context_create(['http'=>['timeout'=>5]]);
  $json = @file_get_contents($url, false, $ctx);
  if (!$json) return ['distance_m'=>0, 'duration_s'=>0];

  $data = json_decode($json, true);
  $elem = $data['rows'][0]['elements'][0] ?? null;
  if (!$elem || $elem['status']!=='OK') return ['distance_m'=>0, 'duration_s'=>0];

  return [
    'distance_m' => (int)$elem['distance']['value'],
    'duration_s' => (int)$elem['duration']['value'],
  ];
}

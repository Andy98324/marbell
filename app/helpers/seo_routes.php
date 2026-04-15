<?php

function seo_routes_data(): array {
  static $data;
  if ($data === null) {
    $data = require __DIR__ . '/../data/seo_routes.php';
  }
  return $data;
}

function seo_destinations_map(): array {
  static $map;
  if ($map === null) {
    $map = [];
    foreach (seo_routes_data()['destinations'] as $d) {
      $map[$d['slug']] = $d;
    }
  }
  return $map;
}

function seo_destination(string $slug): ?array {
  $map = seo_destinations_map();
  return $map[$slug] ?? null;
}

function seo_hub(string $slug): ?array {
  foreach (seo_routes_data()['hubs'] as $hub) {
    if ($hub['slug'] === $slug) return $hub;
  }
  return null;
}

function route_path(string $slug): string {
  return '/traslados/aeropuerto-malaga-' . $slug;
}

function seo_label(array $item, string $key): string {
  return current_lang() === 'en'
    ? ($item[$key . '_en'] ?? $item[$key . '_es'] ?? '')
    : ($item[$key . '_es'] ?? $item[$key . '_en'] ?? '');
}

function route_segment(array $d): string {
  return $d['segment'] ?? 'coast';
}

function route_title(array $d): string {
  $destination = seo_label($d, 'name');
  return current_lang() === 'en'
    ? 'Malaga Airport to ' . $destination . ' Private Transfer'
    : 'Traslado privado Aeropuerto de Málaga a ' . $destination;
}

function route_description(array $d): string {
  $destination = seo_label($d, 'name');
  $region = seo_label($d, 'region');
  $segment = route_segment($d);

  if (current_lang() === 'en') {
    $extra = match ($segment) {
      'luxury' => ' Ideal for hotels, villas, golf clubs and premium addresses.',
      'hub'    => ' Useful for station, port and airport connections with luggage assistance.',
      'long'   => ' Suitable for long-distance city-to-city travel with fixed pricing and direct pickup.',
      'golf'   => ' Perfect for resorts, golf clubs, holiday rentals and premium residential areas.',
      default  => ' Suitable for hotels, holiday rentals, homes and business pickups.',
    };
    return 'Private transfer from or to Málaga Airport and ' . $destination . '. Door-to-door service in ' . $region . ', fixed price, flight monitoring and professional drivers.' . $extra;
  }

  $extra = match ($segment) {
    'luxury' => ' Ideal para hoteles, villas, campos de golf y direcciones premium.',
    'hub'    => ' Muy útil para conexiones con estación, puerto o aeropuerto y ayuda con equipaje.',
    'long'   => ' Pensado para viajes largos entre ciudades, con precio fijo y recogida directa.',
    'golf'   => ' Perfecto para resorts, campos de golf, alquileres vacacionales y zonas residenciales premium.',
    default  => ' Adecuado para hoteles, viviendas vacacionales, domicilios y recogidas de empresa.',
  };
  return 'Traslado privado desde o hasta el Aeropuerto de Málaga y ' . $destination . '. Servicio puerta a puerta en ' . $region . ', precio fijo, seguimiento de vuelo y conductores profesionales.' . $extra;
}

function route_intro(array $d): string {
  $destination = seo_label($d, 'name');
  $region = seo_label($d, 'region');
  $segment = route_segment($d);

  if (current_lang() === 'en') {
    return match ($segment) {
      'luxury' => 'Transfer Marbell operates private airport transfers between Málaga Airport and ' . $destination . ' for travellers who need a premium, discreet and direct service to hotels, villas, golf clubs and residential developments in ' . $region . '.',
      'hub'    => 'Transfer Marbell provides direct private transfers between Málaga Airport and ' . $destination . ', a useful option for travellers connecting with train stations, cruise terminals or other airports with luggage and a fixed pre-booked service.',
      'long'   => 'Transfer Marbell also covers long-distance private transfers from Málaga Airport to ' . $destination . ', giving travellers a direct alternative to train changes, car hire or last-minute taxis for longer Andalusian routes.',
      'golf'   => 'Transfer Marbell covers private transfers from Málaga Airport to ' . $destination . ' for golfers, families and guests staying in resorts, villas and premium developments in ' . $region . '.',
      default  => 'Transfer Marbell offers private transfers between Málaga Airport and ' . $destination . ' for holidaymakers, business travellers and families looking for a reliable door-to-door service in ' . $region . '.',
    };
  }

  return match ($segment) {
    'luxury' => 'Transfer Marbell opera traslados privados entre el Aeropuerto de Málaga y ' . $destination . ' para viajeros que buscan un servicio premium, discreto y directo hacia hoteles, villas, campos de golf y urbanizaciones de ' . $region . '.',
    'hub'    => 'Transfer Marbell ofrece traslados privados directos entre el Aeropuerto de Málaga y ' . $destination . ', una opción muy útil para viajeros que enlazan con estación, puerto o aeropuerto, con equipaje y servicio reservado con antelación.',
    'long'   => 'Transfer Marbell también cubre viajes largos privados desde el Aeropuerto de Málaga a ' . $destination . ', dando una alternativa directa al tren con cambios, al alquiler de coche o al taxi de última hora en rutas largas por Andalucía.',
    'golf'   => 'Transfer Marbell cubre traslados privados desde el Aeropuerto de Málaga a ' . $destination . ' para golfistas, familias y huéspedes que se alojan en resorts, villas y urbanizaciones premium de ' . $region . '.',
    default  => 'Transfer Marbell ofrece traslados privados entre el Aeropuerto de Málaga y ' . $destination . ' para turistas, viajeros de negocio y familias que buscan un servicio puerta a puerta fiable en ' . $region . '.',
  };
}

function route_feature_items(array $d): array {
  if (current_lang() === 'en') {
    return [
      ['title' => 'Fixed price', 'text' => 'Clear private transfer pricing before travel.'],
      ['title' => 'Flight monitoring', 'text' => 'Pickup adapted when your flight lands early or late.'],
      ['title' => 'Door-to-door service', 'text' => 'Direct service to hotels, villas, homes or offices.'],
      ['title' => 'Brand you can remember', 'text' => 'Book directly with Transfer Marbell.'],
    ];
  }
  return [
    ['title' => 'Precio fijo', 'text' => 'Tarifa clara de traslado privado antes del viaje.'],
    ['title' => 'Seguimiento de vuelo', 'text' => 'Recogida adaptada si tu vuelo aterriza antes o después.'],
    ['title' => 'Puerta a puerta', 'text' => 'Servicio directo a hoteles, villas, domicilios u oficinas.'],
    ['title' => 'Marca reconocible', 'text' => 'Reserva directamente con Transfer Marbell.'],
  ];
}

function route_use_cases(array $d): array {
  $segment = route_segment($d);
  if (current_lang() === 'en') {
    return match ($segment) {
      'luxury' => ['Hotel pickups', 'Private villas', 'Golf resorts', 'Premium residential areas'],
      'hub'    => ['Train connections', 'Cruise terminal pickups', 'Airport-to-airport transfers', 'Luggage-friendly service'],
      'long'   => ['Long-distance city transfers', 'Families with luggage', 'Business travel', 'Direct door-to-door journeys'],
      'golf'   => ['Golf bags and luggage', 'Resorts and clubs', 'Family stays', 'Holiday rentals'],
      default  => ['Hotels and apartments', 'Holiday rentals', 'Family travel', 'Business pickups'],
    };
  }
  return match ($segment) {
    'luxury' => ['Recogidas en hoteles', 'Villas privadas', 'Campos de golf', 'Urbanizaciones premium'],
    'hub'    => ['Conexiones con tren', 'Recogidas en crucero', 'Traslados entre aeropuertos', 'Servicio cómodo con equipaje'],
    'long'   => ['Viajes largos entre ciudades', 'Familias con equipaje', 'Desplazamientos de empresa', 'Trayectos directos puerta a puerta'],
    'golf'   => ['Bolsas de golf y equipaje', 'Resorts y clubs', 'Estancias familiares', 'Alquiler vacacional'],
    default  => ['Hoteles y apartamentos', 'Viviendas vacacionales', 'Viajes en familia', 'Recogidas de empresa'],
  };
}

function route_related_destinations(array $d): array {
  $map = seo_destinations_map();
  $out = [];
  foreach (($d['nearby'] ?? []) as $slug) {
    if (isset($map[$slug])) $out[] = $map[$slug];
  }
  return $out;
}

function route_hub_links(): array {
  return seo_routes_data()['hubs'];
}

function route_hub_destinations(array $hub): array {
  $map = seo_destinations_map();
  $out = [];
  foreach (($hub['destinations'] ?? []) as $slug) {
    if (isset($map[$slug])) $out[] = $map[$slug];
  }
  return $out;
}

function route_faq_items(array $d): array {
  $destination = seo_label($d, 'name');
  if (current_lang() === 'en') {
    return [
      ['q' => 'Do you offer a fixed price from Málaga Airport to ' . $destination . '?', 'a' => 'Yes. Transfer Marbell works with pre-booked private transfers and clear pricing before travel.'],
      ['q' => 'Do you monitor flight arrivals?', 'a' => 'Yes. Flight monitoring helps adapt the pickup time when your flight lands early or late.'],
      ['q' => 'Can I book a return transfer too?', 'a' => 'Yes. You can request both arrival and departure transfers.'],
      ['q' => 'Do you provide child seats or extra luggage options?', 'a' => 'You can request child seats and let us know about special luggage requirements in advance.'],
      ['q' => 'Is the service private?', 'a' => 'Yes. This is a private transfer service operated under the Transfer Marbell brand.'],
    ];
  }
  return [
    ['q' => '¿Ofrecéis precio fijo desde el Aeropuerto de Málaga a ' . $destination . '?', 'a' => 'Sí. Transfer Marbell trabaja con traslados privados reservados con antelación y precio claro antes del viaje.'],
    ['q' => '¿Hacéis seguimiento de vuelos?', 'a' => 'Sí. El seguimiento del vuelo permite adaptar la recogida si tu vuelo aterriza antes o después.'],
    ['q' => '¿Puedo reservar también la vuelta?', 'a' => 'Sí. Puedes solicitar tanto la llegada como la salida.'],
    ['q' => '¿Podéis llevar sillita o gestionar equipaje especial?', 'a' => 'Sí. Puedes pedir sillita y avisar con antelación si viajas con equipaje especial.'],
    ['q' => '¿Es un servicio privado?', 'a' => 'Sí. Es un servicio de traslado privado operado bajo la marca Transfer Marbell.'],
  ];
}

function route_faq_schema(array $d): array {
  $qas = route_faq_items($d);
  return [
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(fn($qa) => [
      '@type' => 'Question',
      'name' => $qa['q'],
      'acceptedAnswer' => ['@type' => 'Answer', 'text' => $qa['a']],
    ], $qas),
  ];
}

function hub_intro(array $hub): string {
  return current_lang() === 'en' ? ($hub['intro_en'] ?? '') : ($hub['intro_es'] ?? '');
}


function destinations_grouped_a_to_z(): array {
  $groups = [];
  foreach (seo_routes_data()['destinations'] as $d) {
    $name = seo_label($d, 'name');
    $letter = mb_strtoupper(mb_substr($name, 0, 1));
    if (!preg_match('/[A-ZÁÉÍÓÚÜÑ]/u', $letter)) $letter = '#';
    $groups[$letter][] = $d;
  }
  ksort($groups, SORT_NATURAL);
  return $groups;
}

function route_popular_slugs(): array {
  return [
    'marbella', 'puerto-banus', 'fuengirola', 'benalmadena', 'mijas-costa', 'estepona', 'nerja', 'torrox',
    'granada-city-all-areas', 'seville', 'cordoba', 'cadiz', 'gibraltar-airport', 'sotogrande'
  ];
}

function route_popular_destinations(): array {
  $map = seo_destinations_map();
  $out = [];
  foreach (route_popular_slugs() as $slug) {
    if (isset($map[$slug])) $out[] = $map[$slug];
  }
  return $out;
}

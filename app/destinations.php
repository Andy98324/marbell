<?php

$make = static function (
    string $name,
    string $group,
    string $image,
    string $lead,
    string $intro,
    string $travelTime,
    array $highlights,
    array $nearby = []
): array {
    $nameLower = mb_strtolower($name, 'UTF-8');

    return [
        'name' => $name,
        'group' => $group,
        'image' => $image,
        'short_title' => "Traslado privado Aeropuerto de Málaga a {$name}",
        'title' => "Traslado privado del Aeropuerto de Málaga a {$name}",
        'meta_description' => "Reserva tu traslado privado desde o hasta el Aeropuerto de Málaga a {$name} con Transfer Marbell. Precio fijo, seguimiento de vuelo y servicio puerta a puerta.",
        'keywords' => "transfer malaga {$nameLower}, traslado aeropuerto malaga a {$nameLower}, private transfer {$nameLower}",
        'lead' => $lead,
        'intro' => $intro,
        'travel_time' => $travelTime,
        'highlights' => $highlights,
        'nearby' => $nearby,
    ];
};

return [

    /*
    |--------------------------------------------------------------------------
    | COSTA DEL SOL
    |--------------------------------------------------------------------------
    */
    'malaga' => $make(
        'Málaga',
        'Ciudades de Andalucía',
        '/assets/images/transfers/Malaga.jpeg',
        'Málaga ciudad es una de las rutas más frecuentes desde el aeropuerto por turismo urbano, cruceros, negocios y estancias en hoteles.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Málaga ciudad para hoteles, apartamentos, puerto, estación y viajes corporativos. Es una ruta muy cómoda para quienes buscan un servicio directo y puntual.',
        'Aprox. 15-25 minutos según tráfico.',
        ['Ideal para centro, puerto y estación', 'Servicio directo y puntual', 'Perfecto para turismo y negocios', 'Precio fijo desde la reserva'],
        ['torremolinos', 'rincon-de-la-victoria', 'antequera']
    ),

    'torremolinos' => $make(
        'Torremolinos',
        'Costa del Sol',
        '/assets/images/transfers/Torremolinos.jpeg',
        'Torremolinos es uno de los destinos más cercanos y reservados desde el Aeropuerto de Málaga por turismo vacacional y escapadas cortas.',
        'Realizamos traslados privados desde o hasta el Aeropuerto de Málaga a Torremolinos con servicio rápido, cómodo y puerta a puerta para hoteles, apartamentos y viajeros internacionales.',
        'Aprox. 10-20 minutos según tráfico.',
        ['Ruta rápida y cómoda', 'Ideal para hoteles y apartamentos', 'Precio fijo desde la reserva', 'Servicio puerta a puerta'],
        ['malaga', 'benalmadena', 'fuengirola']
    ),

    'benalmadena' => $make(
        'Benalmádena',
        'Costa del Sol',
        '/assets/images/transfers/Benalmadena.jpeg',
        'Benalmádena es uno de los destinos más visitados de la Costa del Sol por familias, parejas y turismo internacional.',
        'Gestionamos traslados privados desde o hasta el Aeropuerto de Málaga a Benalmádena con servicio directo a hoteles, apartamentos, puerto deportivo y urbanizaciones.',
        'Aprox. 20-30 minutos según tráfico.',
        ['Recogida rápida en aeropuerto', 'Ideal para hoteles y resorts', 'Precio fijo y servicio profesional', 'Atención para llegadas tardías'],
        ['torremolinos', 'fuengirola', 'mijas']
    ),

    'fuengirola' => $make(
        'Fuengirola',
        'Costa del Sol',
        '/assets/images/transfers/Fuengirola.jpeg',
        'Fuengirola es una de las rutas más reservadas desde el Aeropuerto de Málaga por turismo, playa y estancias largas.',
        'Con Transfer Marbell realizamos traslados privados desde o hasta el Aeropuerto de Málaga a Fuengirola con recogida puntual, seguimiento de vuelo y servicio cómodo para parejas, familias y grupos pequeños.',
        'Aprox. 25-35 minutos según tráfico.',
        ['Ruta muy rápida y cómoda', 'Perfecta para hoteles y apartamentos', 'Servicio en sedán, minivan o minibus', 'Seguimiento de vuelo incluido'],
        ['benalmadena', 'la-cala-de-mijas', 'marbella']
    ),

    'la-cala-de-mijas' => $make(
        'La Cala de Mijas',
        'Costa del Sol',
        '/assets/images/transfers/La-Cala-de-Mijas.jpeg',
        'La Cala de Mijas es una de las zonas más demandadas por turismo residencial, vacaciones familiares y golf.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a La Cala de Mijas para hoteles, villas, resorts y apartamentos turísticos con servicio puerta a puerta.',
        'Aprox. 30-40 minutos según tráfico.',
        ['Muy demandado por turismo residencial', 'Ideal para golf y vacaciones familiares', 'Servicio directo sin transbordos', 'Precio cerrado antes de viajar'],
        ['fuengirola', 'mijas', 'marbella']
    ),

    'mijas' => $make(
        'Mijas',
        'Costa del Sol',
        '/assets/images/transfers/Mijas.jpeg',
        'Mijas, Mijas Costa, La Cala de Mijas y sus urbanizaciones son rutas muy frecuentes por turismo residencial y golf.',
        'Realizamos traslados privados desde o hasta el Aeropuerto de Málaga a Mijas para hoteles, villas, apartamentos y complejos de golf.',
        'Aprox. 25-40 minutos según la zona.',
        ['Cobertura Mijas Pueblo, Mijas Costa y golf resorts', 'Vehículos adaptados al equipaje', 'Servicio puerta a puerta', 'Atención multilingüe'],
        ['fuengirola', 'la-cala-de-mijas', 'marbella']
    ),

    'marbella' => $make(
        'Marbella',
        'Costa del Sol',
        '/assets/images/transfers/Marbella.jpeg',
        'Marbella es uno de los destinos más demandados de la Costa del Sol para vacaciones, congresos, golf y estancias de lujo.',
        'Con Transfer Marbell ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Marbella con precio fijo, conductor profesional y servicio puerta a puerta.',
        'Aprox. 40-50 minutos según tráfico.',
        ['Precio fijo sin sorpresas', 'Seguimiento de vuelo para recogidas en AGP', 'Servicio directo a hotel, villa o apartamento', 'Atención en español e inglés'],
        ['puerto-banus', 'san-pedro-de-alcantara', 'estepona']
    ),

    'puerto-banus' => $make(
        'Puerto Banús',
        'Costa del Sol',
        '/assets/images/transfers/Puerto-Banus.jpeg',
        'Puerto Banús es una de las zonas más exclusivas y solicitadas para traslados premium en la Costa del Sol.',
        'Gestionamos traslados privados desde o hasta el Aeropuerto de Málaga a Puerto Banús para hoteles, villas, restaurantes, beach clubs y eventos.',
        'Aprox. 40-50 minutos según tráfico.',
        ['Servicio premium y discreto', 'Recogida con cartel en llegadas si lo necesitas', 'Ideal para hoteles, villas y eventos', 'Precio cerrado antes de reservar'],
        ['marbella', 'san-pedro-de-alcantara', 'estepona']
    ),

    'san-pedro-de-alcantara' => $make(
        'San Pedro de Alcántara',
        'Costa del Sol',
        '/assets/images/transfers/San-Pedro-de-Alcantara.jpeg',
        'San Pedro de Alcántara es una zona muy demandada por clientes de villas, urbanizaciones y estancias de larga duración.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a San Pedro de Alcántara para hoteles, viviendas vacacionales, resorts y viajes familiares.',
        'Aprox. 45-55 minutos según tráfico.',
        ['Muy solicitado por villas y urbanizaciones', 'Servicio puerta a puerta', 'Ideal para familias y estancias largas', 'Precio fijo y atención 24/7'],
        ['puerto-banus', 'marbella', 'estepona']
    ),

    'estepona' => $make(
        'Estepona',
        'Costa del Sol',
        '/assets/images/transfers/Estepona.jpeg',
        'Estepona combina playa, resorts, golf y turismo familiar durante todo el año.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Estepona para hoteles, apartamentos, campos de golf y viviendas vacacionales.',
        'Aprox. 55-70 minutos según tráfico.',
        ['Traslado directo sin paradas innecesarias', 'Ideal para familias y golfistas', 'Opción de silla infantil bajo petición', 'Atención 24/7'],
        ['marbella', 'puerto-banus', 'sotogrande']
    ),

    'rincon-de-la-victoria' => $make(
        'Rincón de la Victoria',
        'Costa del Sol',
        '/assets/images/transfers/Rincon-de-la-Victoria.jpeg',
        'Rincón de la Victoria es una de las zonas costeras más cómodas para estancias vacacionales cerca de Málaga ciudad.',
        'Realizamos traslados privados desde o hasta el Aeropuerto de Málaga a Rincón de la Victoria con servicio puerta a puerta para hoteles, apartamentos y urbanizaciones.',
        'Aprox. 25-35 minutos según tráfico.',
        ['Ideal para vacaciones cerca de Málaga', 'Buena opción para apartamentos y urbanizaciones', 'Sin transbordos', 'Servicio profesional y puntual'],
        ['malaga', 'velez-malaga', 'nerja']
    ),

    'velez-malaga' => $make(
        'Vélez-Málaga',
        'Axarquía',
        '/assets/images/transfers/Velez-Malaga.jpeg',
        'Vélez-Málaga es una de las principales puertas de entrada a la Axarquía para turismo residencial y estancias largas.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Vélez-Málaga para hoteles, viviendas vacacionales y viajes familiares con equipaje.',
        'Aprox. 35-45 minutos según tráfico.',
        ['Puerta de entrada a la Axarquía', 'Servicio cómodo con equipaje', 'Ideal para estancias largas', 'Precio cerrado'],
        ['rincon-de-la-victoria', 'torrox', 'nerja']
    ),

    'torrox' => $make(
        'Torrox',
        'Axarquía',
        '/assets/images/transfers/Torrox.jpeg',
        'Torrox y Torrox Costa son destinos muy solicitados por estancias vacacionales y residenciales de larga duración.',
        'Con Transfer Marbell realizamos traslados privados desde o hasta el Aeropuerto de Málaga a Torrox y Torrox Costa con servicio puerta a puerta y atención 24/7.',
        'Aprox. 45-60 minutos según tráfico.',
        ['Cobertura Torrox pueblo y Torrox Costa', 'Buena opción para familias y estancias largas', 'Sin transbordos', 'Precio cerrado'],
        ['velez-malaga', 'nerja', 'frigiliana']
    ),

    'nerja' => $make(
        'Nerja',
        'Axarquía',
        '/assets/images/transfers/Nerja.jpeg',
        'Nerja es uno de los destinos más demandados para vacaciones en la parte oriental de la Costa del Sol.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Nerja con servicio directo a hoteles, apartamentos y villas.',
        'Aprox. 50-65 minutos según tráfico.',
        ['Ideal para vacaciones familiares', 'Sin esperas ni transbordos', 'Precio fijo desde la reserva', 'Servicio puerta a puerta'],
        ['frigiliana', 'torrox', 'granada']
    ),

    'frigiliana' => $make(
        'Frigiliana',
        'Axarquía',
        '/assets/images/transfers/Frigiliana.jpeg',
        'Frigiliana es uno de los pueblos blancos más visitados de Andalucía y una ruta muy habitual desde Málaga.',
        'Realizamos traslados privados desde o hasta el Aeropuerto de Málaga a Frigiliana para casas rurales, villas y alojamientos turísticos.',
        'Aprox. 55-70 minutos según tráfico.',
        ['Perfecto para villas y casas rurales', 'Traslado directo y cómodo con equipaje', 'Recogida puntual en aeropuerto', 'Ideal para escapadas y turismo rural'],
        ['nerja', 'torrox', 'granada']
    ),

    'ronda' => $make(
        'Ronda',
        'Interior de Andalucía',
        '/assets/images/transfers/Ronda.jpeg',
        'Ronda es uno de los destinos monumentales más visitados del interior andaluz y una ruta muy atractiva desde Málaga.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Ronda para hoteles, casas rurales y escapadas culturales con servicio directo y sin complicaciones.',
        'Aprox. 1 h 30 min a 1 h 50 min.',
        ['Ideal para escapadas culturales', 'Servicio puerta a puerta', 'Sin transbordos', 'Precio acordado antes del viaje'],
        ['marbella', 'antequera', 'sevilla']
    ),

    'antequera' => $make(
        'Antequera',
        'Interior de Andalucía',
        '/assets/images/transfers/Antequera.jpeg',
        'Antequera es uno de los grandes enclaves históricos y geográficos de Andalucía, muy práctico para escapadas y viajes culturales.',
        'Realizamos traslados privados desde o hasta el Aeropuerto de Málaga a Antequera para hoteles, eventos, turismo cultural y viajes de trabajo.',
        'Aprox. 45-60 minutos según tráfico.',
        ['Muy buena conexión desde Málaga', 'Ideal para turismo cultural y rural', 'Servicio directo', 'Precio fijo y conductor profesional'],
        ['malaga', 'ronda', 'cordoba']
    ),

    /*
    |--------------------------------------------------------------------------
    | GRANADA, COSTA TROPICAL Y SIERRA NEVADA
    |--------------------------------------------------------------------------
    */
    'granada' => $make(
        'Granada',
        'Ciudades de Andalucía',
        '/assets/images/transfers/Granada.jpeg',
        'Granada ciudad es uno de los grandes destinos andaluces para viajes culturales, universitarios y de negocios.',
        'Realizamos traslados privados desde o hasta el Aeropuerto de Málaga a Granada ciudad para hoteles, centros históricos, estaciones y alojamientos.',
        'Aprox. 1 h 40 min a 2 h.',
        ['Servicio directo al centro o hotel', 'Ideal para viajes culturales y escapadas', 'Conductor profesional y atención personalizada', 'Posible conexión con Sierra Nevada'],
        ['sierra-nevada', 'almunecar', 'cordoba']
    ),

    'sierra-nevada' => $make(
        'Sierra Nevada',
        'Sierra Nevada',
        '/assets/images/transfers/Sierra-Nevada.jpeg',
        'Sierra Nevada es una de las rutas más demandadas en temporada de nieve para familias, grupos y deportistas.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Sierra Nevada para hoteles, apartamentos y viajes de esquí.',
        'Aprox. 2 h 15 min a 2 h 45 min según condiciones y destino.',
        ['Ideal para viajes con equipaje o material de esquí', 'Servicio directo y cómodo', 'Precio acordado de antemano', 'Conexión fácil con Granada ciudad'],
        ['granada', 'jaen', 'nerja']
    ),

    'almunecar' => $make(
        'Almuñécar',
        'Costa Tropical',
        '/assets/images/transfers/Almunecar.jpeg',
        'Almuñécar es uno de los destinos costeros más visitados de la provincia de Granada por vacaciones familiares y estancias largas.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Almuñécar con servicio cómodo para hoteles, apartamentos y villas.',
        'Aprox. 1 h 05 min a 1 h 25 min.',
        ['Muy demandado en Costa Tropical', 'Ideal para familias y largas estancias', 'Servicio puerta a puerta', 'Sin cambios de transporte'],
        ['la-herradura', 'salobrena', 'granada']
    ),

    'la-herradura' => $make(
        'La Herradura',
        'Costa Tropical',
        '/assets/images/transfers/La-Herradura.jpeg',
        'La Herradura es una de las zonas costeras más apreciadas por viajeros que buscan tranquilidad, mar y villas con encanto.',
        'Gestionamos traslados privados desde o hasta el Aeropuerto de Málaga a La Herradura con servicio directo para urbanizaciones, villas y apartamentos.',
        'Aprox. 1 h a 1 h 20 min.',
        ['Ideal para villas y escapadas tranquilas', 'Servicio cómodo con equipaje', 'Recogida puntual', 'Precio cerrado'],
        ['almunecar', 'nerja', 'salobrena']
    ),

    'salobrena' => $make(
        'Salobreña',
        'Costa Tropical',
        '/assets/images/transfers/Salobrena.jpeg',
        'Salobreña es un destino muy atractivo de la Costa Tropical por sus playas, su casco histórico y sus estancias vacacionales.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Salobreña para hoteles, apartamentos y alojamientos vacacionales.',
        'Aprox. 1 h 20 min a 1 h 40 min.',
        ['Ideal para vacaciones junto al mar', 'Servicio puerta a puerta', 'Perfecto para familias y parejas', 'Precio acordado de antemano'],
        ['motril', 'almunecar', 'granada']
    ),

    'motril' => $make(
        'Motril',
        'Costa Tropical',
        '/assets/images/transfers/Motril.jpeg',
        'Motril es una de las principales entradas a la Costa Tropical y una ruta frecuente desde Málaga por vacaciones y viajes profesionales.',
        'Realizamos traslados privados desde o hasta el Aeropuerto de Málaga a Motril para hoteles, apartamentos, puerto y viajes corporativos.',
        'Aprox. 1 h 20 min a 1 h 40 min.',
        ['Conexión con puerto y costa', 'Ideal para vacaciones y negocios', 'Servicio directo', 'Vehículos adaptados al equipaje'],
        ['salobrena', 'almunecar', 'granada']
    ),

    /*
    |--------------------------------------------------------------------------
    | SEVILLA, CÓRDOBA Y JAÉN
    |--------------------------------------------------------------------------
    */
    'sevilla' => $make(
        'Sevilla',
        'Ciudades de Andalucía',
        '/assets/images/transfers/Sevilla.jpeg',
        'Sevilla es una de las rutas largas más solicitadas desde el Aeropuerto de Málaga por turismo y viajes corporativos.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Sevilla ciudad para viajeros que prefieren un servicio directo, cómodo y sin cambios de transporte.',
        'Aprox. 2 h 20 min a 2 h 45 min.',
        ['Viaje directo de larga distancia', 'Ideal para grupos, eventos y congresos', 'Precio acordado antes del servicio', 'Posibilidad de paradas bajo petición'],
        ['cordoba', 'jerez-de-la-frontera', 'cadiz']
    ),

    'cordoba' => $make(
        'Córdoba',
        'Ciudades de Andalucía',
        '/assets/images/transfers/Cordoba.jpeg',
        'Córdoba es una ruta larga muy demandada por turismo monumental, viajes de empresa y eventos.',
        'Con Transfer Marbell ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Córdoba con un servicio directo, cómodo y sin complicaciones.',
        'Aprox. 1 h 45 min a 2 h 15 min.',
        ['Traslado directo y cómodo', 'Perfecto para viajes culturales o de empresa', 'Sin cambios de transporte', 'Precio cerrado antes del viaje'],
        ['sevilla', 'granada', 'antequera']
    ),

    'jaen' => $make(
        'Jaén',
        'Ciudades de Andalucía',
        '/assets/images/transfers/Jaen.jpeg',
        'Jaén ciudad es una ruta interesante para turismo cultural, viajes de trabajo y conexión con el interior de Andalucía oriental.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Jaén con servicio directo para hoteles, negocios y viajeros que buscan comodidad.',
        'Aprox. 2 h 15 min a 2 h 40 min.',
        ['Ruta directa de larga distancia', 'Ideal para viajes profesionales y culturales', 'Servicio puerta a puerta', 'Precio fijo bajo reserva'],
        ['ubeda', 'baeza', 'cazorla']
    ),

    'ubeda' => $make(
        'Úbeda',
        'Jaén y renacimiento',
        '/assets/images/transfers/Ubeda.jpeg',
        'Úbeda es uno de los grandes destinos patrimoniales del Renacimiento andaluz y una parada cultural muy valorada.',
        'Gestionamos traslados privados desde o hasta el Aeropuerto de Málaga a Úbeda para hoteles, escapadas culturales y rutas monumentales.',
        'Aprox. 2 h 45 min a 3 h 10 min.',
        ['Destino patrimonial de gran valor', 'Ideal para turismo cultural', 'Servicio directo y cómodo', 'Precio acordado antes del viaje'],
        ['baeza', 'jaen', 'cazorla']
    ),

    'baeza' => $make(
        'Baeza',
        'Jaén y renacimiento',
        '/assets/images/transfers/Baeza.jpeg',
        'Baeza es uno de los destinos históricos más emblemáticos de Jaén y una ruta muy interesante para viajeros culturales.',
        'Realizamos traslados privados desde o hasta el Aeropuerto de Málaga a Baeza para hoteles, apartamentos y escapadas patrimoniales.',
        'Aprox. 2 h 40 min a 3 h.',
        ['Ideal para viajes culturales', 'Servicio puerta a puerta', 'Sin cambios de transporte', 'Atención personalizada'],
        ['ubeda', 'jaen', 'cazorla']
    ),

    'cazorla' => $make(
        'Cazorla',
        'Jaén y renacimiento',
        '/assets/images/transfers/Cazorla.jpeg',
        'Cazorla es uno de los grandes destinos de naturaleza y turismo rural de Andalucía.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Cazorla para hoteles, casas rurales y escapadas de naturaleza.',
        'Aprox. 3 h a 3 h 30 min.',
        ['Ideal para turismo rural y naturaleza', 'Perfecto para casas rurales y escapadas', 'Servicio directo', 'Precio fijo bajo reserva'],
        ['ubeda', 'baeza', 'jaen']
    ),

    /*
    |--------------------------------------------------------------------------
    | CÁDIZ Y COSTA DE LA LUZ
    |--------------------------------------------------------------------------
    */
    'cadiz' => $make(
        'Cádiz',
        'Costa de la Luz - Cádiz',
        '/assets/images/transfers/Cadiz.jpeg',
        'Cádiz y su provincia son destinos habituales para viajes largos desde Málaga, sobre todo en temporada alta y rutas costeras.',
        'Gestionamos traslados privados desde o hasta el Aeropuerto de Málaga a Cádiz ciudad y otras zonas de la provincia con servicio puerta a puerta y atención personalizada.',
        'Aprox. 2 h 30 min a 3 h 15 min según destino.',
        ['Cobertura de Cádiz ciudad y provincia', 'Ideal para hoteles, apartamentos y puertos', 'Viaje directo con conductor profesional', 'Posibilidad de servicios a medida'],
        ['jerez-de-la-frontera', 'el-puerto-de-santa-maria', 'chiclana-de-la-frontera']
    ),

    'jerez-de-la-frontera' => $make(
        'Jerez de la Frontera',
        'Costa de la Luz - Cádiz',
        '/assets/images/transfers/Jerez-de-la-Frontera.jpeg',
        'Jerez de la Frontera es una de las ciudades más visitadas de Cádiz por enoturismo, negocios, motos y escapadas culturales.',
        'Realizamos traslados privados desde o hasta el Aeropuerto de Málaga a Jerez de la Frontera para hoteles, bodegas, eventos y viajes corporativos.',
        'Aprox. 2 h 20 min a 2 h 50 min.',
        ['Muy demandado por enoturismo y eventos', 'Servicio directo y cómodo', 'Ideal para hoteles y bodegas', 'Precio acordado de antemano'],
        ['cadiz', 'el-puerto-de-santa-maria', 'sanlucar-de-barrameda']
    ),

    'el-puerto-de-santa-maria' => $make(
        'El Puerto de Santa María',
        'Costa de la Luz - Cádiz',
        '/assets/images/transfers/El-Puerto-de-Santa-Maria.jpeg',
        'El Puerto de Santa María es una de las localidades costeras más atractivas de la Bahía de Cádiz para vacaciones y escapadas gastronómicas.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a El Puerto de Santa María para hoteles, apartamentos y casas vacacionales.',
        'Aprox. 2 h 30 min a 3 h.',
        ['Ideal para playa y gastronomía', 'Perfecto para hoteles y apartamentos', 'Servicio puerta a puerta', 'Sin transbordos'],
        ['cadiz', 'jerez-de-la-frontera', 'chiclana-de-la-frontera']
    ),

    'sanlucar-de-barrameda' => $make(
        'Sanlúcar de Barrameda',
        'Costa de la Luz - Cádiz',
        '/assets/images/transfers/Sanlucar-de-Barrameda.jpeg',
        'Sanlúcar de Barrameda es un destino muy atractivo por gastronomía, playa, vino y estancias vacacionales.',
        'Gestionamos traslados privados desde o hasta el Aeropuerto de Málaga a Sanlúcar de Barrameda con servicio directo para hoteles y alojamientos turísticos.',
        'Aprox. 2 h 45 min a 3 h 15 min.',
        ['Ideal para escapadas gastronómicas y de playa', 'Servicio directo y cómodo', 'Recogida puntual', 'Precio fijo'],
        ['jerez-de-la-frontera', 'cadiz', 'el-rocio']
    ),

    'chiclana-de-la-frontera' => $make(
        'Chiclana de la Frontera',
        'Costa de la Luz - Cádiz',
        '/assets/images/transfers/Chiclana-de-la-Frontera.jpeg',
        'Chiclana es una de las grandes zonas vacacionales de la provincia de Cádiz por playa, resorts y turismo familiar.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Chiclana de la Frontera y Novo Sancti Petri con servicio puerta a puerta.',
        'Aprox. 2 h 35 min a 3 h 10 min.',
        ['Muy demandado en verano', 'Ideal para resorts y hoteles', 'Servicio directo', 'Precio cerrado'],
        ['conil-de-la-frontera', 'cadiz', 'el-puerto-de-santa-maria']
    ),

    'conil-de-la-frontera' => $make(
        'Conil de la Frontera',
        'Costa de la Luz - Cádiz',
        '/assets/images/transfers/Conil-de-la-Frontera.jpeg',
        'Conil de la Frontera es uno de los destinos de playa más populares de Andalucía por ambiente, gastronomía y vacaciones de verano.',
        'Realizamos traslados privados desde o hasta el Aeropuerto de Málaga a Conil de la Frontera para hoteles, apartamentos y casas vacacionales.',
        'Aprox. 2 h 45 min a 3 h 20 min.',
        ['Uno de los grandes destinos de playa de Cádiz', 'Ideal para turismo nacional e internacional', 'Sin esperas ni transbordos', 'Servicio puerta a puerta'],
        ['chiclana-de-la-frontera', 'vejer-de-la-frontera', 'tarifa']
    ),

    'vejer-de-la-frontera' => $make(
        'Vejer de la Frontera',
        'Costa de la Luz - Cádiz',
        '/assets/images/transfers/Vejer-de-la-Frontera.jpeg',
        'Vejer de la Frontera es uno de los pueblos blancos más famosos de Andalucía y una escapada muy apreciada por viajeros internacionales.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Vejer de la Frontera para hoteles boutique, casas rurales y alojamientos vacacionales.',
        'Aprox. 2 h 40 min a 3 h 15 min.',
        ['Pueblo blanco muy demandado', 'Ideal para escapadas con encanto', 'Servicio directo y cómodo', 'Perfecto para casas rurales y hoteles boutique'],
        ['conil-de-la-frontera', 'tarifa', 'zahara-de-los-atunes']
    ),

    'tarifa' => $make(
        'Tarifa',
        'Costa de la Luz - Cádiz',
        '/assets/images/transfers/Tarifa.jpeg',
        'Tarifa es uno de los destinos más conocidos del sur por playas, windsurf, kitesurf y escapadas de naturaleza.',
        'Gestionamos traslados privados desde o hasta el Aeropuerto de Málaga a Tarifa para hoteles, campamentos, villas y viajeros deportivos.',
        'Aprox. 2 h a 2 h 30 min.',
        ['Muy demandado por kitesurf y playa', 'Ideal para escapadas activas', 'Servicio directo sin cambios', 'Perfecto para equipaje deportivo'],
        ['vejer-de-la-frontera', 'zahara-de-los-atunes', 'sotogrande']
    ),

    'zahara-de-los-atunes' => $make(
        'Zahara de los Atunes',
        'Costa de la Luz - Cádiz',
        '/assets/images/transfers/Zahara-de-los-Atunes.jpeg',
        'Zahara de los Atunes es uno de los destinos de playa más exclusivos y demandados de la costa gaditana.',
        'Realizamos traslados privados desde o hasta el Aeropuerto de Málaga a Zahara de los Atunes para hoteles, villas y apartamentos vacacionales.',
        'Aprox. 2 h 20 min a 2 h 50 min.',
        ['Destino de playa premium', 'Ideal para villas y hoteles', 'Servicio puerta a puerta', 'Atención personalizada'],
        ['tarifa', 'vejer-de-la-frontera', 'cadiz']
    ),

    'sotogrande' => $make(
        'Sotogrande',
        'Costa de la Luz - Cádiz',
        '/assets/images/transfers/Sotogrande.jpeg',
        'Sotogrande es una de las zonas más exclusivas del sur para golf, puertos deportivos, villas y turismo premium.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Sotogrande para hoteles, urbanizaciones, campos de golf y viajes corporativos.',
        'Aprox. 1 h 20 min a 1 h 40 min.',
        ['Ruta premium muy demandada', 'Ideal para golf y villas', 'Servicio discreto y profesional', 'Precio fijo y reserva anticipada'],
        ['estepona', 'tarifa', 'marbella']
    ),

    /*
    |--------------------------------------------------------------------------
    | HUELVA Y COSTA DE LA LUZ
    |--------------------------------------------------------------------------
    */
    'huelva' => $make(
        'Huelva',
        'Ciudades de Andalucía',
        '/assets/images/transfers/Huelva.jpeg',
        'Huelva ciudad es una ruta larga interesante por trabajo, turismo provincial y conexión con la costa onubense.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Huelva para hoteles, negocios y viajes de larga distancia.',
        'Aprox. 3 h a 3 h 30 min.',
        ['Servicio directo y cómodo', 'Ideal para viajes profesionales y turísticos', 'Sin depender de horarios', 'Precio acordado antes del servicio'],
        ['punta-umbria', 'el-rompido', 'aracena']
    ),

    'punta-umbria' => $make(
        'Punta Umbría',
        'Costa de la Luz - Huelva',
        '/assets/images/transfers/Punta-Umbria.jpeg',
        'Punta Umbría es uno de los destinos de playa más conocidos de Huelva para vacaciones de verano y estancias familiares.',
        'Realizamos traslados privados desde o hasta el Aeropuerto de Málaga a Punta Umbría para hoteles, apartamentos y alojamientos vacacionales.',
        'Aprox. 3 h 10 min a 3 h 40 min.',
        ['Muy demandado en temporada alta', 'Ideal para vacaciones familiares', 'Servicio directo puerta a puerta', 'Precio fijo'],
        ['huelva', 'el-rompido', 'islantilla']
    ),

    'el-rompido' => $make(
        'El Rompido',
        'Costa de la Luz - Huelva',
        '/assets/images/transfers/El-Rompido.jpeg',
        'El Rompido es una zona muy valorada por golf, naturaleza, resorts y vacaciones tranquilas junto al mar.',
        'Gestionamos traslados privados desde o hasta el Aeropuerto de Málaga a El Rompido para resorts, hoteles, golfistas y familias.',
        'Aprox. 3 h 5 min a 3 h 35 min.',
        ['Ideal para golf y resorts', 'Perfecto para vacaciones tranquilas', 'Servicio cómodo y directo', 'Vehículos adaptados al equipaje'],
        ['punta-umbria', 'islantilla', 'huelva']
    ),

    'islantilla' => $make(
        'Islantilla',
        'Costa de la Luz - Huelva',
        '/assets/images/transfers/Islantilla.jpeg',
        'Islantilla es una de las grandes zonas turísticas de playa y golf en Huelva, muy demandada en verano.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Islantilla para resorts, hoteles, apartamentos y vacaciones familiares.',
        'Aprox. 3 h 20 min a 3 h 50 min.',
        ['Ideal para resorts y golf', 'Servicio puerta a puerta', 'Perfecto para familias', 'Precio fijo y reserva previa'],
        ['el-rompido', 'ayamonte', 'punta-umbria']
    ),

    'ayamonte' => $make(
        'Ayamonte',
        'Costa de la Luz - Huelva',
        '/assets/images/transfers/Ayamonte.jpeg',
        'Ayamonte es una de las localidades más conocidas del extremo occidental andaluz por playa, golf y turismo fronterizo.',
        'Realizamos traslados privados desde o hasta el Aeropuerto de Málaga a Ayamonte para hoteles, resorts y estancias vacacionales.',
        'Aprox. 3 h 30 min a 4 h.',
        ['Ruta de larga distancia bien resuelta', 'Ideal para resorts y vacaciones', 'Servicio directo', 'Precio acordado de antemano'],
        ['islantilla', 'el-rompido', 'huelva']
    ),

    'aracena' => $make(
        'Aracena',
        'Interior de Andalucía',
        '/assets/images/transfers/Aracena.jpeg',
        'Aracena es uno de los grandes destinos de interior de Huelva por naturaleza, gastronomía y turismo rural.',
        'Gestionamos traslados privados desde o hasta el Aeropuerto de Málaga a Aracena para hoteles rurales, escapadas gastronómicas y turismo de naturaleza.',
        'Aprox. 3 h 15 min a 3 h 45 min.',
        ['Ideal para turismo rural y gastronómico', 'Servicio cómodo con equipaje', 'Perfecto para escapadas', 'Precio cerrado'],
        ['huelva', 'sevilla', 'el-rocio']
    ),

    'el-rocio' => $make(
        'El Rocío',
        'Interior de Andalucía',
        '/assets/images/transfers/El-Rocio.jpeg',
        'El Rocío es uno de los destinos más singulares de Andalucía por tradición, naturaleza y peregrinación.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a El Rocío para visitas religiosas, eventos y escapadas a Doñana.',
        'Aprox. 3 h a 3 h 30 min.',
        ['Destino singular y muy reconocido', 'Ideal para eventos y peregrinaciones', 'Servicio directo', 'Conexión práctica con Doñana'],
        ['huelva', 'sevilla', 'sanlucar-de-barrameda']
    ),

    /*
    |--------------------------------------------------------------------------
    | ALMERÍA
    |--------------------------------------------------------------------------
    */
    'almeria' => $make(
        'Almería',
        'Ciudades de Andalucía',
        '/assets/images/transfers/Almeria.jpeg',
        'Almería ciudad es una ruta larga de interés por viajes corporativos, escapadas urbanas y conexión con la costa almeriense.',
        'Realizamos traslados privados desde o hasta el Aeropuerto de Málaga a Almería ciudad con servicio directo, cómodo y puerta a puerta.',
        'Aprox. 2 h 30 min a 3 h.',
        ['Ruta directa de larga distancia', 'Ideal para negocios y escapadas', 'Precio acordado antes del servicio', 'Servicio puerta a puerta'],
        ['roquetas-de-mar', 'cabo-de-gata', 'mojacar']
    ),

    'roquetas-de-mar' => $make(
        'Roquetas de Mar',
        'Costa de Almería',
        '/assets/images/transfers/Roquetas-de-Mar.jpeg',
        'Roquetas de Mar es uno de los grandes destinos vacacionales de la costa almeriense para familias y turismo de verano.',
        'Ofrecemos traslados privados desde o hasta el Aeropuerto de Málaga a Roquetas de Mar para hoteles, resorts y apartamentos vacacionales.',
        'Aprox. 2 h 25 min a 2 h 55 min.',
        ['Muy demandado en temporada alta', 'Ideal para resorts y familias', 'Servicio directo y cómodo', 'Precio fijo'],
        ['almeria', 'cabo-de-gata', 'mojacar']
    ),

    'cabo-de-gata' => $make(
        'Cabo de Gata',
        'Costa de Almería',
        '/assets/images/transfers/Cabo-de-Gata.jpeg',
        'Cabo de Gata es uno de los paisajes costeros más emblemáticos de Andalucía y una referencia clara de turismo de naturaleza.',
        'Gestionamos traslados privados desde o hasta el Aeropuerto de Málaga a Cabo de Gata para hoteles, alojamientos rurales y escapadas de naturaleza.',
        'Aprox. 2 h 40 min a 3 h 10 min según zona.',
        ['Destino icónico de naturaleza y playas', 'Ideal para escapadas tranquilas', 'Servicio directo', 'Perfecto para equipaje y estancias largas'],
        ['almeria', 'roquetas-de-mar', 'mojacar']
    ),

    'mojacar' => $make(
        'Mojácar',
        'Costa de Almería',
        '/assets/images/transfers/Mojacar.jpeg',
        'Mojácar es uno de los destinos turísticos más conocidos de la costa almeriense por playa, pueblo y estancias largas.',
        'Realizamos traslados privados desde o hasta el Aeropuerto de Málaga a Mojácar para hoteles, apartamentos y viviendas vacacionales.',
        'Aprox. 3 h 10 min a 3 h 40 min.',
        ['Muy demandado en verano y largas estancias', 'Ideal para playa y turismo residencial', 'Servicio puerta a puerta', 'Precio acordado'],
        ['almeria', 'cabo-de-gata', 'roquetas-de-mar']
    ),
];
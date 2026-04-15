<?php
return [
  'destinations' => [
    [
      'slug' => 'malaga-city',
      'name_es' => 'Málaga ciudad',
      'name_en' => 'Málaga city',
      'region_es' => 'Málaga y Costa del Sol',
      'region_en' => 'Málaga and Costa del Sol',
      'segment' => 'city',
      'nearby' => [
        'malaga-train-station',
        'malaga-cruise-port',
        'torremolinos'
      ]
    ],
    [
      'slug' => 'malaga-train-station',
      'name_es' => 'Estación María Zambrano',
      'name_en' => 'Málaga train station',
      'region_es' => 'Málaga',
      'region_en' => 'Málaga',
      'segment' => 'hub',
      'nearby' => [
        'malaga-city',
        'torremolinos',
        'benalmadena'
      ]
    ],
    [
      'slug' => 'malaga-cruise-port',
      'name_es' => 'Puerto de Málaga',
      'name_en' => 'Málaga cruise port',
      'region_es' => 'Málaga',
      'region_en' => 'Málaga',
      'segment' => 'hub',
      'nearby' => [
        'malaga-city',
        'torremolinos',
        'benalmadena'
      ]
    ],
    [
      'slug' => 'torremolinos',
      'name_es' => 'Torremolinos',
      'name_en' => 'Torremolinos',
      'region_es' => 'Costa del Sol',
      'region_en' => 'Costa del Sol',
      'segment' => 'coast',
      'nearby' => [
        'benalmadena',
        'malaga-city',
        'fuengirola'
      ]
    ],
    [
      'slug' => 'benalmadena',
      'name_es' => 'Benalmádena',
      'name_en' => 'Benalmádena',
      'region_es' => 'Costa del Sol',
      'region_en' => 'Costa del Sol',
      'segment' => 'coast',
      'nearby' => [
        'torremolinos',
        'arroyo-de-la-miel',
        'fuengirola'
      ]
    ],
    [
      'slug' => 'arroyo-de-la-miel',
      'name_es' => 'Arroyo de la Miel',
      'name_en' => 'Arroyo de la Miel',
      'region_es' => 'Benalmádena',
      'region_en' => 'Benalmádena',
      'segment' => 'coast',
      'nearby' => [
        'benalmadena',
        'torrequebrada',
        'torremolinos'
      ]
    ],
    [
      'slug' => 'torrequebrada',
      'name_es' => 'Torrequebrada',
      'name_en' => 'Torrequebrada',
      'region_es' => 'Benalmádena',
      'region_en' => 'Benalmádena',
      'segment' => 'coast',
      'nearby' => [
        'benalmadena',
        'torremuelle',
        'fuengirola'
      ]
    ],
    [
      'slug' => 'torremuelle',
      'name_es' => 'Torremuelle',
      'name_en' => 'Torremuelle',
      'region_es' => 'Benalmádena',
      'region_en' => 'Benalmádena',
      'segment' => 'coast',
      'nearby' => [
        'torrequebrada',
        'fuengirola',
        'torremolinos'
      ]
    ],
    [
      'slug' => 'fuengirola',
      'name_es' => 'Fuengirola',
      'name_en' => 'Fuengirola',
      'region_es' => 'Costa del Sol',
      'region_en' => 'Costa del Sol',
      'segment' => 'coast',
      'nearby' => [
        'torreblanca',
        'los-boliches',
        'mijas'
      ]
    ],
    [
      'slug' => 'torreblanca',
      'name_es' => 'Torreblanca',
      'name_en' => 'Torreblanca',
      'region_es' => 'Fuengirola',
      'region_en' => 'Fuengirola',
      'segment' => 'coast',
      'nearby' => [
        'fuengirola',
        'los-boliches',
        'mijas-costa'
      ]
    ],
    [
      'slug' => 'los-boliches',
      'name_es' => 'Los Boliches',
      'name_en' => 'Los Boliches',
      'region_es' => 'Fuengirola',
      'region_en' => 'Fuengirola',
      'segment' => 'coast',
      'nearby' => [
        'fuengirola',
        'torreblanca',
        'mijas-costa'
      ]
    ],
    [
      'slug' => 'mijas',
      'name_es' => 'Mijas',
      'name_en' => 'Mijas',
      'region_es' => 'Costa del Sol',
      'region_en' => 'Costa del Sol',
      'segment' => 'coast',
      'nearby' => [
        'fuengirola',
        'mijas-costa',
        'la-cala-de-mijas'
      ]
    ],
    [
      'slug' => 'mijas-costa',
      'name_es' => 'Mijas Costa',
      'name_en' => 'Mijas Costa',
      'region_es' => 'Costa del Sol',
      'region_en' => 'Costa del Sol',
      'segment' => 'coast',
      'nearby' => [
        'fuengirola',
        'la-cala-de-mijas',
        'riviera-del-sol'
      ]
    ],
    [
      'slug' => 'la-cala-de-mijas',
      'name_es' => 'La Cala de Mijas',
      'name_en' => 'La Cala de Mijas',
      'region_es' => 'Mijas Costa',
      'region_en' => 'Mijas Costa',
      'segment' => 'coast',
      'nearby' => [
        'mijas-costa',
        'riviera-del-sol',
        'calahonda-mijas'
      ]
    ],
    [
      'slug' => 'riviera-del-sol',
      'name_es' => 'Riviera del Sol',
      'name_en' => 'Riviera del Sol',
      'region_es' => 'Mijas Costa',
      'region_en' => 'Mijas Costa',
      'segment' => 'coast',
      'nearby' => [
        'la-cala-de-mijas',
        'calahonda-mijas',
        'miraflores-golf'
      ]
    ],
    [
      'slug' => 'calahonda-mijas',
      'name_es' => 'Calahonda (Mijas)',
      'name_en' => 'Calahonda (Mijas)',
      'region_es' => 'Mijas Costa',
      'region_en' => 'Mijas Costa',
      'segment' => 'coast',
      'nearby' => [
        'riviera-del-sol',
        'cabopino',
        'la-cala-de-mijas'
      ]
    ],
    [
      'slug' => 'miraflores-golf',
      'name_es' => 'Miraflores Golf Resort',
      'name_en' => 'Miraflores Golf Resort',
      'region_es' => 'Mijas Costa',
      'region_en' => 'Mijas Costa',
      'segment' => 'golf',
      'nearby' => [
        'riviera-del-sol',
        'calahonda-mijas',
        'cabopino'
      ]
    ],
    [
      'slug' => 'cabopino',
      'name_es' => 'Cabopino',
      'name_en' => 'Cabopino',
      'region_es' => 'Marbella este',
      'region_en' => 'East Marbella',
      'segment' => 'coast',
      'nearby' => [
        'calahonda-mijas',
        'las-chapas',
        'marbesa'
      ]
    ],
    [
      'slug' => 'marbesa',
      'name_es' => 'Marbesa',
      'name_en' => 'Marbesa',
      'region_es' => 'Marbella este',
      'region_en' => 'East Marbella',
      'segment' => 'coast',
      'nearby' => [
        'cabopino',
        'las-chapas',
        'elviria'
      ]
    ],
    [
      'slug' => 'las-chapas',
      'name_es' => 'Las Chapas',
      'name_en' => 'Las Chapas',
      'region_es' => 'Marbella este',
      'region_en' => 'East Marbella',
      'segment' => 'coast',
      'nearby' => [
        'cabopino',
        'marbesa',
        'elviria'
      ]
    ],
    [
      'slug' => 'elviria',
      'name_es' => 'Elviria',
      'name_en' => 'Elviria',
      'region_es' => 'Marbella este',
      'region_en' => 'East Marbella',
      'segment' => 'coast',
      'nearby' => [
        'las-chapas',
        'marbella',
        'cabopino'
      ]
    ],
    [
      'slug' => 'marbella',
      'name_es' => 'Marbella',
      'name_en' => 'Marbella',
      'region_es' => 'Costa del Sol',
      'region_en' => 'Costa del Sol',
      'segment' => 'luxury',
      'nearby' => [
        'puerto-banus',
        'nueva-andalucia',
        'san-pedro-de-alcantara'
      ]
    ],
    [
      'slug' => 'nueva-andalucia',
      'name_es' => 'Nueva Andalucía',
      'name_en' => 'Nueva Andalucía',
      'region_es' => 'Marbella / Puerto Banús',
      'region_en' => 'Marbella / Puerto Banús',
      'segment' => 'luxury',
      'nearby' => [
        'marbella',
        'puerto-banus',
        'san-pedro-de-alcantara'
      ]
    ],
    [
      'slug' => 'puerto-banus',
      'name_es' => 'Puerto Banús',
      'name_en' => 'Puerto Banús',
      'region_es' => 'Marbella',
      'region_en' => 'Marbella',
      'segment' => 'luxury',
      'nearby' => [
        'marbella',
        'nueva-andalucia',
        'san-pedro-de-alcantara'
      ]
    ],
    [
      'slug' => 'san-pedro-de-alcantara',
      'name_es' => 'San Pedro de Alcántara',
      'name_en' => 'San Pedro de Alcántara',
      'region_es' => 'Marbella oeste',
      'region_en' => 'West Marbella',
      'segment' => 'luxury',
      'nearby' => [
        'puerto-banus',
        'marbella',
        'benahavis'
      ]
    ],
    [
      'slug' => 'benahavis',
      'name_es' => 'Benahavís',
      'name_en' => 'Benahavís',
      'region_es' => 'Marbella / Benahavís',
      'region_en' => 'Marbella / Benahavís',
      'segment' => 'golf',
      'nearby' => [
        'san-pedro-de-alcantara',
        'marbella',
        'cancelada'
      ]
    ],
    [
      'slug' => 'estepona',
      'name_es' => 'Estepona',
      'name_en' => 'Estepona',
      'region_es' => 'Costa del Sol',
      'region_en' => 'Costa del Sol',
      'segment' => 'coast',
      'nearby' => [
        'cancelada',
        'manilva',
        'marbella'
      ]
    ],
    [
      'slug' => 'cancelada',
      'name_es' => 'Cancelada',
      'name_en' => 'Cancelada',
      'region_es' => 'Estepona / New Golden Mile',
      'region_en' => 'Estepona / New Golden Mile',
      'segment' => 'coast',
      'nearby' => [
        'estepona',
        'benahavis',
        'san-pedro-de-alcantara'
      ]
    ],
    [
      'slug' => 'manilva',
      'name_es' => 'Manilva',
      'name_en' => 'Manilva',
      'region_es' => 'Costa del Sol occidental',
      'region_en' => 'Western Costa del Sol',
      'segment' => 'coast',
      'nearby' => [
        'estepona',
        'sotogrande',
        'gibraltar-airport'
      ]
    ],
    [
      'slug' => 'sotogrande',
      'name_es' => 'Sotogrande',
      'name_en' => 'Sotogrande',
      'region_es' => 'Cádiz / Costa del Sol',
      'region_en' => 'Cádiz / Costa del Sol',
      'segment' => 'luxury',
      'nearby' => [
        'manilva',
        'gibraltar-airport',
        'tarifa'
      ]
    ],
    [
      'slug' => 'gibraltar-airport',
      'name_es' => 'Aeropuerto de Gibraltar',
      'name_en' => 'Gibraltar Airport',
      'region_es' => 'Campo de Gibraltar',
      'region_en' => 'Campo de Gibraltar',
      'segment' => 'hub',
      'nearby' => [
        'sotogrande',
        'tarifa',
        'manilva'
      ]
    ],
    [
      'slug' => 'rincon-de-la-victoria',
      'name_es' => 'Rincón de la Victoria',
      'name_en' => 'Rincón de la Victoria',
      'region_es' => 'Costa del Sol oriental',
      'region_en' => 'Eastern Costa del Sol',
      'segment' => 'coast',
      'nearby' => [
        'velez-malaga',
        'torrox',
        'malaga-city'
      ]
    ],
    [
      'slug' => 'velez-malaga',
      'name_es' => 'Vélez-Málaga',
      'name_en' => 'Vélez-Málaga',
      'region_es' => 'Axarquía',
      'region_en' => 'Axarquía',
      'segment' => 'coast',
      'nearby' => [
        'rincon-de-la-victoria',
        'torrox',
        'nerja'
      ]
    ],
    [
      'slug' => 'torrox',
      'name_es' => 'Torrox',
      'name_en' => 'Torrox',
      'region_es' => 'Costa del Sol oriental',
      'region_en' => 'Eastern Costa del Sol',
      'segment' => 'coast',
      'nearby' => [
        'torrox-costa',
        'nerja',
        'frigiliana'
      ]
    ],
    [
      'slug' => 'torrox-costa',
      'name_es' => 'Torrox Costa',
      'name_en' => 'Torrox Costa',
      'region_es' => 'Costa del Sol oriental',
      'region_en' => 'Eastern Costa del Sol',
      'segment' => 'coast',
      'nearby' => [
        'torrox',
        'nerja',
        'frigiliana'
      ]
    ],
    [
      'slug' => 'nerja',
      'name_es' => 'Nerja',
      'name_en' => 'Nerja',
      'region_es' => 'Costa del Sol oriental',
      'region_en' => 'Eastern Costa del Sol',
      'segment' => 'coast',
      'nearby' => [
        'frigiliana',
        'torrox',
        'granada-city'
      ]
    ],
    [
      'slug' => 'frigiliana',
      'name_es' => 'Frigiliana',
      'name_en' => 'Frigiliana',
      'region_es' => 'Costa del Sol oriental',
      'region_en' => 'Eastern Costa del Sol',
      'segment' => 'coast',
      'nearby' => [
        'nerja',
        'torrox',
        'granada-city'
      ]
    ],
    [
      'slug' => 'ronda',
      'name_es' => 'Ronda',
      'name_en' => 'Ronda',
      'region_es' => 'Interior de Málaga',
      'region_en' => 'Inland Málaga',
      'segment' => 'city',
      'nearby' => [
        'marbella',
        'cadiz-city',
        'granada-city'
      ]
    ],
    [
      'slug' => 'granada-city',
      'name_es' => 'Granada ciudad',
      'name_en' => 'Granada city',
      'region_es' => 'Provincia de Granada',
      'region_en' => 'Granada province',
      'segment' => 'long',
      'nearby' => [
        'sierra-nevada',
        'nerja',
        'frigiliana'
      ]
    ],
    [
      'slug' => 'sierra-nevada',
      'name_es' => 'Sierra Nevada',
      'name_en' => 'Sierra Nevada',
      'region_es' => 'Provincia de Granada',
      'region_en' => 'Granada province',
      'segment' => 'long',
      'nearby' => [
        'granada-city',
        'nerja',
        'frigiliana'
      ]
    ],
    [
      'slug' => 'cordoba-city',
      'name_es' => 'Córdoba ciudad',
      'name_en' => 'Córdoba city',
      'region_es' => 'Provincia de Córdoba',
      'region_en' => 'Córdoba province',
      'segment' => 'long',
      'nearby' => [
        'granada-city',
        'seville-city',
        'malaga-city'
      ]
    ],
    [
      'slug' => 'seville-city',
      'name_es' => 'Sevilla ciudad',
      'name_en' => 'Seville city',
      'region_es' => 'Provincia de Sevilla',
      'region_en' => 'Seville province',
      'segment' => 'long',
      'nearby' => [
        'seville-airport',
        'cordoba-city',
        'cadiz-city'
      ]
    ],
    [
      'slug' => 'seville-airport',
      'name_es' => 'Aeropuerto de Sevilla',
      'name_en' => 'Seville Airport',
      'region_es' => 'Provincia de Sevilla',
      'region_en' => 'Seville province',
      'segment' => 'hub',
      'nearby' => [
        'seville-city',
        'cordoba-city',
        'cadiz-city'
      ]
    ],
    [
      'slug' => 'cadiz-city',
      'name_es' => 'Cádiz ciudad',
      'name_en' => 'Cádiz city',
      'region_es' => 'Provincia de Cádiz',
      'region_en' => 'Cádiz province',
      'segment' => 'long',
      'nearby' => [
        'jerez-de-la-frontera',
        'conil-de-la-frontera',
        'tarifa'
      ]
    ],
    [
      'slug' => 'jerez-de-la-frontera',
      'name_es' => 'Jerez de la Frontera',
      'name_en' => 'Jerez de la Frontera',
      'region_es' => 'Provincia de Cádiz',
      'region_en' => 'Cádiz province',
      'segment' => 'long',
      'nearby' => [
        'cadiz-city',
        'conil-de-la-frontera',
        'tarifa'
      ]
    ],
    [
      'slug' => 'conil-de-la-frontera',
      'name_es' => 'Conil de la Frontera',
      'name_en' => 'Conil de la Frontera',
      'region_es' => 'Provincia de Cádiz',
      'region_en' => 'Cádiz province',
      'segment' => 'long',
      'nearby' => [
        'cadiz-city',
        'jerez-de-la-frontera',
        'tarifa'
      ]
    ],
    [
      'slug' => 'tarifa',
      'name_es' => 'Tarifa',
      'name_en' => 'Tarifa',
      'region_es' => 'Provincia de Cádiz',
      'region_en' => 'Cádiz province',
      'segment' => 'long',
      'nearby' => [
        'cadiz-city',
        'gibraltar-airport',
        'sotogrande'
      ]
    ],
    [
      'slug' => 'adra',
      'name_es' => 'Adra',
      'name_en' => 'Adra',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'alameda',
        'albox',
        'albunol'
      ]
    ],
    [
      'slug' => 'aguadulce',
      'name_es' => 'Aguadulce (Almeria)',
      'name_en' => 'Aguadulce (Almeria)',
      'region_es' => 'Andalucía y viajes largos',
      'region_en' => 'Andalucía y viajes largos',
      'segment' => 'long',
      'nearby' => [
        'alhama-de-granada',
        'cartagena',
        'jaen'
      ]
    ],
    [
      'slug' => 'alameda',
      'name_es' => 'Alameda (Málaga)',
      'name_en' => 'Alameda (Málaga)',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'albox',
        'albunol'
      ]
    ],
    [
      'slug' => 'albox',
      'name_es' => 'Albox',
      'name_en' => 'Albox',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albunol'
      ]
    ],
    [
      'slug' => 'albunol',
      'name_es' => 'Albuñol',
      'name_en' => 'Albuñol',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'alcaidesa',
      'name_es' => 'Alcaidesa',
      'name_en' => 'Alcaidesa',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'alcala-de-guadaira',
      'name_es' => 'Alcalá de Guadaíra',
      'name_en' => 'Alcalá de Guadaíra',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'alcala-de-los-gazules',
      'name_es' => 'Alcalá de los Gazules',
      'name_en' => 'Alcalá de los Gazules',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'alcala-del-rio',
      'name_es' => 'Alcala del Rio',
      'name_en' => 'Alcala del Rio',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'alcala-la-real',
      'name_es' => 'Alcalá la Real',
      'name_en' => 'Alcalá la Real',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'alcaucin',
      'name_es' => 'Alcaucín',
      'name_en' => 'Alcaucín',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'alcaudete',
      'name_es' => 'Alcaudete',
      'name_en' => 'Alcaudete',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'alcudia-de-guadix',
      'name_es' => 'Alcudia de Guadix',
      'name_en' => 'Alcudia de Guadix',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'alfacar',
      'name_es' => 'Alfacar',
      'name_en' => 'Alfacar',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'alfaix',
      'name_es' => 'Alfaix',
      'name_en' => 'Alfaix',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'algarrobo',
      'name_es' => 'Algarrobo',
      'name_en' => 'Algarrobo',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'algeciras',
      'name_es' => 'Algeciras',
      'name_en' => 'Algeciras',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'algodonales',
      'name_es' => 'Algodonales',
      'name_en' => 'Algodonales',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'alhama-de-granada',
      'name_es' => 'Alhama de Granada',
      'name_en' => 'Alhama de Granada',
      'region_es' => 'Andalucía y viajes largos',
      'region_en' => 'Andalucía y viajes largos',
      'segment' => 'long',
      'nearby' => [
        'aguadulce',
        'cartagena',
        'jaen'
      ]
    ],
    [
      'slug' => 'alhaurin-de-la-torre',
      'name_es' => 'Alhaurín de la Torre',
      'name_en' => 'Alhaurín de la Torre',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'alhaurin-el-grande',
      'name_es' => 'Alhaurín el Grande',
      'name_en' => 'Alhaurín el Grande',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'alhaurin-golf-resort',
      'name_es' => 'Alhaurín Golf Resort',
      'name_en' => 'Alhaurín Golf Resort',
      'region_es' => 'Costa del Sol golf',
      'region_en' => 'Costa del Sol golf',
      'segment' => 'golf',
      'nearby' => [
        'almenara-golf-club',
        'club-la-costa-world',
        'desert-springs-golf-resort'
      ]
    ],
    [
      'slug' => 'almayate',
      'name_es' => 'Almayate',
      'name_en' => 'Almayate',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'almedinilla',
      'name_es' => 'Almedinilla',
      'name_en' => 'Almedinilla',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'almenara-golf-club',
      'name_es' => 'Almenara Golf Club',
      'name_en' => 'Almenara Golf Club',
      'region_es' => 'Costa del Sol golf',
      'region_en' => 'Costa del Sol golf',
      'segment' => 'golf',
      'nearby' => [
        'alhaurin-golf-resort',
        'club-la-costa-world',
        'desert-springs-golf-resort'
      ]
    ],
    [
      'slug' => 'almendralejo',
      'name_es' => 'Almendralejo',
      'name_en' => 'Almendralejo',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'almeria-city',
      'name_es' => 'Almeria city (all areas)',
      'name_en' => 'Almeria city (all areas)',
      'region_es' => 'Almería',
      'region_en' => 'Almería',
      'segment' => 'long',
      'nearby' => [
        'almerimar',
        'bahia-serena',
        'roquetas-de-mar'
      ]
    ],
    [
      'slug' => 'almerimar',
      'name_es' => 'Almerimar',
      'name_en' => 'Almerimar',
      'region_es' => 'Almería',
      'region_en' => 'Almería',
      'segment' => 'long',
      'nearby' => [
        'almeria-city',
        'bahia-serena',
        'roquetas-de-mar'
      ]
    ],
    [
      'slug' => 'almogia',
      'name_es' => 'Almogia',
      'name_en' => 'Almogia',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'almunecar',
      'name_es' => 'Almuñécar',
      'name_en' => 'Almuñécar',
      'region_es' => 'Costa Tropical',
      'region_en' => 'Costa Tropical',
      'segment' => 'coast',
      'nearby' => [
        'la-herradura',
        'motril',
        'salobrena'
      ]
    ],
    [
      'slug' => 'alora',
      'name_es' => 'Alora',
      'name_en' => 'Alora',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'alozaina',
      'name_es' => 'Alozaina',
      'name_en' => 'Alozaina',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'antequera',
      'name_es' => 'Antequera',
      'name_en' => 'Antequera',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'archez',
      'name_es' => 'Árchez',
      'name_en' => 'Árchez',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'archidona',
      'name_es' => 'Archidona',
      'name_en' => 'Archidona',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'arcos-de-la-frontera',
      'name_es' => 'Arcos de la Frontera',
      'name_en' => 'Arcos de la Frontera',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'ardales',
      'name_es' => 'Ardales',
      'name_en' => 'Ardales',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'arenas',
      'name_es' => 'Arenas',
      'name_en' => 'Arenas',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'arriate',
      'name_es' => 'Arriate',
      'name_en' => 'Arriate',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'atalaya-isdabe',
      'name_es' => 'Atalaya Isdabe',
      'name_en' => 'Atalaya Isdabe',
      'region_es' => 'Estepona/Marbella',
      'region_en' => 'Estepona/Marbella',
      'segment' => 'city',
      'nearby' => [
        'atalaya-park',
        'malaga-city',
        'ronda'
      ]
    ],
    [
      'slug' => 'atalaya-park',
      'name_es' => 'Atalaya Park',
      'name_en' => 'Atalaya Park',
      'region_es' => 'Estepona/Marbella',
      'region_en' => 'Estepona/Marbella',
      'segment' => 'city',
      'nearby' => [
        'atalaya-isdabe',
        'malaga-city',
        'ronda'
      ]
    ],
    [
      'slug' => 'atlanterra',
      'name_es' => 'Atlanterra (Urb.)',
      'name_en' => 'Atlanterra (Urb.)',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'bahia-serena',
      'name_es' => 'Bahia Serena (Roquetas de Mar)',
      'name_en' => 'Bahia Serena (Roquetas de Mar)',
      'region_es' => 'Almería',
      'region_en' => 'Almería',
      'segment' => 'city',
      'nearby' => [
        'almeria-city',
        'almerimar',
        'roquetas-de-mar'
      ]
    ],
    [
      'slug' => 'barranco-del-sol',
      'name_es' => 'Barranco del Sol (Almogia)',
      'name_en' => 'Barranco del Sol (Almogia)',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'baza',
      'name_es' => 'Baza',
      'name_en' => 'Baza',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'benagalbon',
      'name_es' => 'Benagalbón',
      'name_en' => 'Benagalbón',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'benajarafe',
      'name_es' => 'Benajarafe',
      'name_en' => 'Benajarafe',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'benalmadena-costa',
      'name_es' => 'Benalmádena costa',
      'name_en' => 'Benalmádena costa',
      'region_es' => 'Costa del Sol',
      'region_en' => 'Costa del Sol',
      'segment' => 'coast',
      'nearby' => [
        'benalmadena',
        'estepona',
        'fuengirola'
      ]
    ],
    [
      'slug' => 'benalup-casas-viejas',
      'name_es' => 'Benalup - Casas Viejas',
      'name_en' => 'Benalup - Casas Viejas',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'benamargosa',
      'name_es' => 'Benamargosa',
      'name_en' => 'Benamargosa',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'benaojan',
      'name_es' => 'Benaoján',
      'name_en' => 'Benaoján',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'benarraba',
      'name_es' => 'Benarrabá',
      'name_en' => 'Benarrabá',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'benidorm',
      'name_es' => 'Benidorm',
      'name_en' => 'Benidorm',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'bermejo',
      'name_es' => 'Bermejo',
      'name_en' => 'Bermejo',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'bubion',
      'name_es' => 'Bubión',
      'name_en' => 'Bubión',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'buenas-noches',
      'name_es' => 'Buenas Noches',
      'name_en' => 'Buenas Noches',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'cabopino-2',
      'name_es' => 'Cabopino (Torre Ladrones)',
      'name_en' => 'Cabopino (Torre Ladrones)',
      'region_es' => 'Marbella este',
      'region_en' => 'Marbella este',
      'segment' => 'coast',
      'nearby' => [
        'cabopino',
        'elviria',
        'las-chapas'
      ]
    ],
    [
      'slug' => 'cabra',
      'name_es' => 'Cabra',
      'name_en' => 'Cabra',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'cadiar',
      'name_es' => 'Cádiar',
      'name_en' => 'Cádiar',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'cadiz',
      'name_es' => 'Cádiz',
      'name_en' => 'Cádiz',
      'region_es' => 'Cádiz',
      'region_en' => 'Cádiz',
      'segment' => 'long',
      'nearby' => [
        'puerto-real',
        'granada-city',
        'sierra-nevada'
      ]
    ],
    [
      'slug' => 'cajar',
      'name_es' => 'Cajar',
      'name_en' => 'Cajar',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'cala-del-moral',
      'name_es' => 'Cala del Moral',
      'name_en' => 'Cala del Moral',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'calahonda',
      'name_es' => 'Calahonda (Motril)',
      'name_en' => 'Calahonda (Motril)',
      'region_es' => 'Mijas Costa',
      'region_en' => 'Mijas Costa',
      'segment' => 'coast',
      'nearby' => [
        'calahonda-mijas',
        'la-cala-de-mijas',
        'miraflores-golf'
      ]
    ],
    [
      'slug' => 'caleta-de-velez',
      'name_es' => 'Caleta de Vélez',
      'name_en' => 'Caleta de Vélez',
      'region_es' => 'Axarquía',
      'region_en' => 'Axarquía',
      'segment' => 'coast',
      'nearby' => [
        'el-morche',
        'velez-malaga',
        'torremolinos'
      ]
    ],
    [
      'slug' => 'campanillas',
      'name_es' => 'Campanillas',
      'name_en' => 'Campanillas',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'campillos',
      'name_es' => 'Campillos',
      'name_en' => 'Campillos',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'camping-and-bungalows-suspiro-del-moro',
      'name_es' => 'Camping & Bungalows Suspiro del Moro',
      'name_en' => 'Camping & Bungalows Suspiro del Moro',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'canada-del-real-tesoro',
      'name_es' => 'Cañada del Real Tesoro',
      'name_en' => 'Cañada del Real Tesoro',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'canar',
      'name_es' => 'Cáñar',
      'name_en' => 'Cáñar',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'canillas-de-aceituno',
      'name_es' => 'Canillas de Aceituno',
      'name_en' => 'Canillas de Aceituno',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'canillas-de-albaida',
      'name_es' => 'Canillas de Albaida',
      'name_en' => 'Canillas de Albaida',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'capileira',
      'name_es' => 'Capileira',
      'name_en' => 'Capileira',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'caracuel',
      'name_es' => 'Caracuel',
      'name_en' => 'Caracuel',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'carchuna',
      'name_es' => 'Carchuna',
      'name_en' => 'Carchuna',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'carmona',
      'name_es' => 'Carmona',
      'name_en' => 'Carmona',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'carratraca',
      'name_es' => 'Carratraca',
      'name_en' => 'Carratraca',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'cartagena',
      'name_es' => 'Cartagena',
      'name_en' => 'Cartagena',
      'region_es' => 'Andalucía y viajes largos',
      'region_en' => 'Andalucía y viajes largos',
      'segment' => 'long',
      'nearby' => [
        'aguadulce',
        'alhama-de-granada',
        'jaen'
      ]
    ],
    [
      'slug' => 'cartajima',
      'name_es' => 'Cartajima',
      'name_en' => 'Cartajima',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'cartama',
      'name_es' => 'Cártama',
      'name_en' => 'Cártama',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'casabermeja',
      'name_es' => 'Casabermeja',
      'name_en' => 'Casabermeja',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'casablanquilla',
      'name_es' => 'Casablanquilla',
      'name_en' => 'Casablanquilla',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'casarabonela',
      'name_es' => 'Casarabonela',
      'name_en' => 'Casarabonela',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'casares',
      'name_es' => 'Casares',
      'name_en' => 'Casares',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'castell-de-ferro',
      'name_es' => 'Castell de Ferro',
      'name_en' => 'Castell de Ferro',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'castellar-de-la-frontera',
      'name_es' => 'Castellar de la Frontera',
      'name_en' => 'Castellar de la Frontera',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'castillo-de-castellar',
      'name_es' => 'Castillo de Castellar',
      'name_en' => 'Castillo de Castellar',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'castillo-de-locubin',
      'name_es' => 'Castillo de Locubín',
      'name_en' => 'Castillo de Locubín',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'cenes-de-la-vega',
      'name_es' => 'Cenes de la Vega',
      'name_en' => 'Cenes de la Vega',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'cerros-del-aguila',
      'name_es' => 'Cerros del Águila (Urb.)',
      'name_en' => 'Cerros del Águila (Urb.)',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'chiclana-de-la-frontera',
      'name_es' => 'Chiclana de la Frontera',
      'name_en' => 'Chiclana de la Frontera',
      'region_es' => 'Cádiz provincia',
      'region_en' => 'Cádiz provincia',
      'segment' => 'city',
      'nearby' => [
        'sanlucar-de-barrameda',
        'vejer-de-la-frontera',
        'zahara-de-los-atunes'
      ]
    ],
    [
      'slug' => 'chipiona',
      'name_es' => 'Chipiona',
      'name_en' => 'Chipiona',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'churriana',
      'name_es' => 'Churriana',
      'name_en' => 'Churriana',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'club-la-costa-world',
      'name_es' => 'Club la Costa World',
      'name_en' => 'Club la Costa World',
      'region_es' => 'Costa del Sol golf',
      'region_en' => 'Costa del Sol golf',
      'segment' => 'golf',
      'nearby' => [
        'alhaurin-golf-resort',
        'almenara-golf-club',
        'desert-springs-golf-resort'
      ]
    ],
    [
      'slug' => 'coin',
      'name_es' => 'Coín',
      'name_en' => 'Coín',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'colmenar',
      'name_es' => 'Colmenar',
      'name_en' => 'Colmenar',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'colomera',
      'name_es' => 'Colomera',
      'name_en' => 'Colomera',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'comares',
      'name_es' => 'Comares',
      'name_en' => 'Comares',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'competa',
      'name_es' => 'Cómpeta',
      'name_en' => 'Cómpeta',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'cordoba',
      'name_es' => 'Córdoba',
      'name_en' => 'Córdoba',
      'region_es' => 'Córdoba',
      'region_en' => 'Córdoba',
      'segment' => 'long',
      'nearby' => [
        'priego-de-cordoba',
        'granada-city',
        'sierra-nevada'
      ]
    ],
    [
      'slug' => 'cortes-de-la-frontera',
      'name_es' => 'Cortes de la Frontera',
      'name_en' => 'Cortes de la Frontera',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'costa-ballena',
      'name_es' => 'Costa Ballena',
      'name_en' => 'Costa Ballena',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'cuevas-del-amanzora',
      'name_es' => 'Cuevas Del Amanzora',
      'name_en' => 'Cuevas Del Amanzora',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'cuevas-del-becerro',
      'name_es' => 'Cuevas del Becerro',
      'name_en' => 'Cuevas del Becerro',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'cuevas-del-cipres',
      'name_es' => 'Cuevas del cipres',
      'name_en' => 'Cuevas del cipres',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'cumbres-verdes',
      'name_es' => 'Cumbres Verdes',
      'name_en' => 'Cumbres Verdes',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'desert-springs-golf-resort',
      'name_es' => 'Desert Springs Golf Resort',
      'name_en' => 'Desert Springs Golf Resort',
      'region_es' => 'Costa del Sol golf',
      'region_en' => 'Costa del Sol golf',
      'segment' => 'golf',
      'nearby' => [
        'alhaurin-golf-resort',
        'almenara-golf-club',
        'club-la-costa-world'
      ]
    ],
    [
      'slug' => 'durcal',
      'name_es' => 'Dúrcal',
      'name_en' => 'Dúrcal',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'ecija',
      'name_es' => 'Écija',
      'name_en' => 'Écija',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'el-burgo',
      'name_es' => 'El Burgo',
      'name_en' => 'El Burgo',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'el-chorro',
      'name_es' => 'El Chorro',
      'name_en' => 'El Chorro',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'el-cuarton',
      'name_es' => 'El Cuartón',
      'name_en' => 'El Cuartón',
      'region_es' => 'Tarifa',
      'region_en' => 'Tarifa',
      'segment' => 'city',
      'nearby' => [
        'valdevaqueros',
        'malaga-city',
        'ronda'
      ]
    ],
    [
      'slug' => 'el-faro',
      'name_es' => 'El Faro',
      'name_en' => 'El Faro',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'el-gastor',
      'name_es' => 'El Gastor',
      'name_en' => 'El Gastor',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'el-madronal',
      'name_es' => 'El Madroñal',
      'name_en' => 'El Madroñal',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'el-morche',
      'name_es' => 'El Morche',
      'name_en' => 'El Morche',
      'region_es' => 'Axarquía',
      'region_en' => 'Axarquía',
      'segment' => 'city',
      'nearby' => [
        'caleta-de-velez',
        'velez-malaga',
        'malaga-city'
      ]
    ],
    [
      'slug' => 'el-palo',
      'name_es' => 'El Palo',
      'name_en' => 'El Palo',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'el-paraiso',
      'name_es' => 'El Paraiso',
      'name_en' => 'El Paraiso',
      'region_es' => 'Benahavís/Estepona',
      'region_en' => 'Benahavís/Estepona',
      'segment' => 'city',
      'nearby' => [
        'malaga-city',
        'ronda',
        'adra'
      ]
    ],
    [
      'slug' => 'fort-ingles',
      'name_es' => 'Fort Ingles',
      'name_en' => 'Fort Ingles',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'fuente-de-piedra',
      'name_es' => 'Fuente de Piedra',
      'name_en' => 'Fuente de Piedra',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'fuente-del-conde',
      'name_es' => 'Fuente del Conde',
      'name_en' => 'Fuente del Conde',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'fuentes-de-cesna',
      'name_es' => 'Fuentes de Cesna',
      'name_en' => 'Fuentes de Cesna',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'gaucin',
      'name_es' => 'Gaucin',
      'name_en' => 'Gaucin',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'gibralfaro',
      'name_es' => 'Gibralfaro',
      'name_en' => 'Gibralfaro',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'gibraltar-airport-2',
      'name_es' => 'Gibraltar airport',
      'name_en' => 'Gibraltar airport',
      'region_es' => 'Campo de Gibraltar',
      'region_en' => 'Campo de Gibraltar',
      'segment' => 'hub',
      'nearby' => [
        'gibraltar-airport',
        'gibraltar-frontier-la-linea-de-la-concepcion',
        'san-roque'
      ]
    ],
    [
      'slug' => 'gibraltar-frontier-la-linea-de-la-concepcion',
      'name_es' => 'Gibraltar frontier - La Línea de la Concepción',
      'name_en' => 'Gibraltar frontier - La Línea de la Concepción',
      'region_es' => 'Campo de Gibraltar',
      'region_en' => 'Campo de Gibraltar',
      'segment' => 'coast',
      'nearby' => [
        'gibraltar-airport',
        'gibraltar-airport-2',
        'san-roque'
      ]
    ],
    [
      'slug' => 'granada',
      'name_es' => 'Granada (Sierra Nevada area)',
      'name_en' => 'Granada (Sierra Nevada area)',
      'region_es' => 'Granada',
      'region_en' => 'Granada',
      'segment' => 'long',
      'nearby' => [
        'granada-city-2',
        'granada-city',
        'sierra-nevada'
      ]
    ],
    [
      'slug' => 'granada-city-2',
      'name_es' => 'Granada city (all areas)',
      'name_en' => 'Granada city (all areas)',
      'region_es' => 'Granada',
      'region_en' => 'Granada',
      'segment' => 'long',
      'nearby' => [
        'granada',
        'granada-city',
        'sierra-nevada'
      ]
    ],
    [
      'slug' => 'grazalema',
      'name_es' => 'Grazalema',
      'name_en' => 'Grazalema',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'guadalmansa',
      'name_es' => 'Guadalmansa',
      'name_en' => 'Guadalmansa',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'guadalmar',
      'name_es' => 'Guadalmar',
      'name_en' => 'Guadalmar',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'guadalmina',
      'name_es' => 'Guadalmina',
      'name_en' => 'Guadalmina',
      'region_es' => 'Marbella',
      'region_en' => 'Marbella',
      'segment' => 'city',
      'nearby' => [
        'hotel-vime-la-reserva-de-marbella',
        'las-torres-del-marbella-club',
        'marbella-hotel-guadalapin-suites'
      ]
    ],
    [
      'slug' => 'guadiaro',
      'name_es' => 'Guadiaro',
      'name_en' => 'Guadiaro',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'gualchos',
      'name_es' => 'Gualchos',
      'name_en' => 'Gualchos',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'guaro',
      'name_es' => 'Guaro',
      'name_en' => 'Guaro',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'guejar-sierra',
      'name_es' => 'Güejar Sierra',
      'name_en' => 'Güejar Sierra',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'hotel-cortijo-del-marques',
      'name_es' => 'Hotel Cortijo del Marqués',
      'name_en' => 'Hotel Cortijo del Marqués',
      'region_es' => 'Costa del Sol premium',
      'region_en' => 'Costa del Sol premium',
      'segment' => 'luxury',
      'nearby' => [
        'villafranco-de-guadalhorce',
        'villalobos',
        'villanueva-de-tapia'
      ]
    ],
    [
      'slug' => 'hotel-vime-la-reserva-de-marbella',
      'name_es' => 'Hotel Vime La Reserva de Marbella',
      'name_en' => 'Hotel Vime La Reserva de Marbella',
      'region_es' => 'Marbella',
      'region_en' => 'Marbella',
      'segment' => 'luxury',
      'nearby' => [
        'guadalmina',
        'las-torres-del-marbella-club',
        'marbella-hotel-guadalapin-suites'
      ]
    ],
    [
      'slug' => 'huelva',
      'name_es' => 'Huelva',
      'name_en' => 'Huelva',
      'region_es' => 'Huelva',
      'region_en' => 'Huelva',
      'segment' => 'long',
      'nearby' => [
        'granada-city',
        'sierra-nevada',
        'cordoba-city'
      ]
    ],
    [
      'slug' => 'huercal-overa',
      'name_es' => 'Huércal-Overa',
      'name_en' => 'Huércal-Overa',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'humilladero',
      'name_es' => 'Humilladero',
      'name_en' => 'Humilladero',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'isla-canela',
      'name_es' => 'Isla Canela',
      'name_en' => 'Isla Canela',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'istan',
      'name_es' => 'Istán',
      'name_en' => 'Istán',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'iznajar',
      'name_es' => 'Iznájar',
      'name_en' => 'Iznájar',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'iznate',
      'name_es' => 'Iznate',
      'name_en' => 'Iznate',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'jaen',
      'name_es' => 'Jaen',
      'name_en' => 'Jaen',
      'region_es' => 'Andalucía y viajes largos',
      'region_en' => 'Andalucía y viajes largos',
      'segment' => 'long',
      'nearby' => [
        'aguadulce',
        'alhama-de-granada',
        'cartagena'
      ]
    ],
    [
      'slug' => 'jatar',
      'name_es' => 'Játar',
      'name_en' => 'Játar',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'jimena-de-la-frontera',
      'name_es' => 'Jimena de la Frontera',
      'name_en' => 'Jimena de la Frontera',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'jubrique',
      'name_es' => 'Jubrique',
      'name_en' => 'Jubrique',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'la-alqueria',
      'name_es' => 'La Alquería',
      'name_en' => 'La Alquería',
      'region_es' => 'Benahavís',
      'region_en' => 'Benahavís',
      'segment' => 'city',
      'nearby' => [
        'la-quinta-golf-resort-and-spa',
        'malaga-city',
        'ronda'
      ]
    ],
    [
      'slug' => 'la-bobadilla',
      'name_es' => 'La Bobadilla',
      'name_en' => 'La Bobadilla',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'la-cala-golf-resort',
      'name_es' => 'La Cala Golf Resort (Mijas)',
      'name_en' => 'La Cala Golf Resort (Mijas)',
      'region_es' => 'Costa del Sol',
      'region_en' => 'Costa del Sol',
      'segment' => 'golf',
      'nearby' => [
        'benalmadena',
        'benalmadena-costa',
        'estepona'
      ]
    ],
    [
      'slug' => 'la-capellania',
      'name_es' => 'La Capellania',
      'name_en' => 'La Capellania',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'la-chullera',
      'name_es' => 'La Chullera',
      'name_en' => 'La Chullera',
      'region_es' => 'Manilva',
      'region_en' => 'Manilva',
      'segment' => 'city',
      'nearby' => [
        'puerto-de-la-duquesa',
        'san-luis-de-sabinillas',
        'malaga-city'
      ]
    ],
    [
      'slug' => 'la-herradura',
      'name_es' => 'La Herradura',
      'name_en' => 'La Herradura',
      'region_es' => 'Costa Tropical',
      'region_en' => 'Costa Tropical',
      'segment' => 'coast',
      'nearby' => [
        'almunecar',
        'motril',
        'salobrena'
      ]
    ],
    [
      'slug' => 'la-higuera',
      'name_es' => 'La Higuera',
      'name_en' => 'La Higuera',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'la-joya',
      'name_es' => 'La Joya',
      'name_en' => 'La Joya',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'la-mairena',
      'name_es' => 'La Mairena',
      'name_en' => 'La Mairena',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'la-mamola',
      'name_es' => 'La Mamola',
      'name_en' => 'La Mamola',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'la-manga-golf-resort',
      'name_es' => 'La Manga Golf Resort',
      'name_en' => 'La Manga Golf Resort',
      'region_es' => 'Costa del Sol golf',
      'region_en' => 'Costa del Sol golf',
      'segment' => 'golf',
      'nearby' => [
        'alhaurin-golf-resort',
        'almenara-golf-club',
        'club-la-costa-world'
      ]
    ],
    [
      'slug' => 'la-quinta-golf-resort-and-spa',
      'name_es' => 'La Quinta Golf Resort & Spa',
      'name_en' => 'La Quinta Golf Resort & Spa',
      'region_es' => 'Benahavís',
      'region_en' => 'Benahavís',
      'segment' => 'golf',
      'nearby' => [
        'la-alqueria',
        'miraflores-golf',
        'benahavis'
      ]
    ],
    [
      'slug' => 'la-sierrezuela',
      'name_es' => 'La Sierrezuela (Urb.)',
      'name_en' => 'La Sierrezuela (Urb.)',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'la-zubia',
      'name_es' => 'La Zubia',
      'name_en' => 'La Zubia',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'lanjaron',
      'name_es' => 'Lanjarón',
      'name_en' => 'Lanjarón',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'las-gabias',
      'name_es' => 'Las Gabias',
      'name_en' => 'Las Gabias',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'las-lomas-de-cabopino',
      'name_es' => 'Las Lomas de Cabopino',
      'name_en' => 'Las Lomas de Cabopino',
      'region_es' => 'Marbella este',
      'region_en' => 'Marbella este',
      'segment' => 'coast',
      'nearby' => [
        'cabopino',
        'cabopino-2',
        'elviria'
      ]
    ],
    [
      'slug' => 'las-torres-del-marbella-club',
      'name_es' => 'Las Torres del Marbella Club',
      'name_en' => 'Las Torres del Marbella Club',
      'region_es' => 'Marbella',
      'region_en' => 'Marbella',
      'segment' => 'golf',
      'nearby' => [
        'guadalmina',
        'hotel-vime-la-reserva-de-marbella',
        'marbella-hotel-guadalapin-suites'
      ]
    ],
    [
      'slug' => 'lauro-golf-resort',
      'name_es' => 'Lauro Golf Resort',
      'name_en' => 'Lauro Golf Resort',
      'region_es' => 'Costa del Sol golf',
      'region_en' => 'Costa del Sol golf',
      'segment' => 'golf',
      'nearby' => [
        'alhaurin-golf-resort',
        'almenara-golf-club',
        'club-la-costa-world'
      ]
    ],
    [
      'slug' => 'loja',
      'name_es' => 'Loja',
      'name_en' => 'Loja',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'los-alcazares',
      'name_es' => 'Los Alcazares',
      'name_en' => 'Los Alcazares',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'los-barrios',
      'name_es' => 'Los Barrios',
      'name_en' => 'Los Barrios',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'los-canos-de-meca',
      'name_es' => 'Los Caños de Meca',
      'name_en' => 'Los Caños de Meca',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'los-cortijos-romero',
      'name_es' => 'Los Cortijos Romero (Alcaucin)',
      'name_en' => 'Los Cortijos Romero (Alcaucin)',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'los-monteros-spa-and-golf-resort',
      'name_es' => 'Los Monteros Spa & Golf Resort',
      'name_en' => 'Los Monteros Spa & Golf Resort',
      'region_es' => 'Costa del Sol golf',
      'region_en' => 'Costa del Sol golf',
      'segment' => 'golf',
      'nearby' => [
        'alhaurin-golf-resort',
        'almenara-golf-club',
        'club-la-costa-world'
      ]
    ],
    [
      'slug' => 'los-perez',
      'name_es' => 'Los Pérez (Montes de Malaga)',
      'name_en' => 'Los Pérez (Montes de Malaga)',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'los-romanes',
      'name_es' => 'Los Romanes',
      'name_en' => 'Los Romanes',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'malaga-city-2',
      'name_es' => 'Málaga city (all areas)',
      'name_en' => 'Málaga city (all areas)',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'malaga-cruise-port-2',
      'name_es' => 'Malaga cruise port (G)',
      'name_en' => 'Malaga cruise port (G)',
      'region_es' => 'Málaga y conexiones',
      'region_en' => 'Málaga y conexiones',
      'segment' => 'hub',
      'nearby' => [
        'malaga-train-station-2',
        'malaga-train-station',
        'malaga-cruise-port'
      ]
    ],
    [
      'slug' => 'malaga-train-station-2',
      'name_es' => 'Malaga train station (G)',
      'name_en' => 'Malaga train station (G)',
      'region_es' => 'Málaga y conexiones',
      'region_en' => 'Málaga y conexiones',
      'segment' => 'hub',
      'nearby' => [
        'malaga-cruise-port-2',
        'malaga-train-station',
        'malaga-cruise-port'
      ]
    ],
    [
      'slug' => 'marbella-hotel-guadalapin-suites',
      'name_es' => 'Marbella - Hotel Guadalapin Suites',
      'name_en' => 'Marbella - Hotel Guadalapin Suites',
      'region_es' => 'Marbella',
      'region_en' => 'Marbella',
      'segment' => 'luxury',
      'nearby' => [
        'guadalmina',
        'hotel-vime-la-reserva-de-marbella',
        'las-torres-del-marbella-club'
      ]
    ],
    [
      'slug' => 'marbella-hotel-puente-romano',
      'name_es' => 'Marbella - Hotel Puente Romano',
      'name_en' => 'Marbella - Hotel Puente Romano',
      'region_es' => 'Marbella',
      'region_en' => 'Marbella',
      'segment' => 'luxury',
      'nearby' => [
        'guadalmina',
        'hotel-vime-la-reserva-de-marbella',
        'las-torres-del-marbella-club'
      ]
    ],
    [
      'slug' => 'marbella-city-centre',
      'name_es' => 'Marbella city centre',
      'name_en' => 'Marbella city centre',
      'region_es' => 'Marbella',
      'region_en' => 'Marbella',
      'segment' => 'coast',
      'nearby' => [
        'guadalmina',
        'hotel-vime-la-reserva-de-marbella',
        'las-torres-del-marbella-club'
      ]
    ],
    [
      'slug' => 'marbesa-2',
      'name_es' => 'Marbesa (Urb.)',
      'name_en' => 'Marbesa (Urb.)',
      'region_es' => 'Marbella este',
      'region_en' => 'Marbella este',
      'segment' => 'coast',
      'nearby' => [
        'cabopino',
        'cabopino-2',
        'elviria'
      ]
    ],
    [
      'slug' => 'maro',
      'name_es' => 'Maro',
      'name_en' => 'Maro',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'martos',
      'name_es' => 'Martos',
      'name_en' => 'Martos',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'medina-sidonia',
      'name_es' => 'Medina-Sidonia',
      'name_en' => 'Medina-Sidonia',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'mijas-costa-2',
      'name_es' => 'Mijas Costa (La Cala de Mijas)',
      'name_en' => 'Mijas Costa (La Cala de Mijas)',
      'region_es' => 'Costa del Sol',
      'region_en' => 'Costa del Sol',
      'segment' => 'coast',
      'nearby' => [
        'benalmadena',
        'benalmadena-costa',
        'estepona'
      ]
    ],
    [
      'slug' => 'mijas-golf-international-sau',
      'name_es' => 'Mijas Golf International SAU',
      'name_en' => 'Mijas Golf International SAU',
      'region_es' => 'Costa del Sol',
      'region_en' => 'Costa del Sol',
      'segment' => 'golf',
      'nearby' => [
        'benalmadena',
        'benalmadena-costa',
        'estepona'
      ]
    ],
    [
      'slug' => 'moclinejo',
      'name_es' => 'Moclinejo',
      'name_en' => 'Moclinejo',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'mojacar',
      'name_es' => 'Mojácar',
      'name_en' => 'Mojácar',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'mollina',
      'name_es' => 'Mollina',
      'name_en' => 'Mollina',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'molvizar',
      'name_es' => 'Molvizar',
      'name_en' => 'Molvizar',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'monachil',
      'name_es' => 'Monachil',
      'name_en' => 'Monachil',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'monda',
      'name_es' => 'Monda',
      'name_en' => 'Monda',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'monte-gordo',
      'name_es' => 'Monte Gordo',
      'name_en' => 'Monte Gordo',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'montecastillo-resort',
      'name_es' => 'Montecastillo Resort',
      'name_en' => 'Montecastillo Resort',
      'region_es' => 'Costa del Sol golf',
      'region_en' => 'Costa del Sol golf',
      'segment' => 'golf',
      'nearby' => [
        'alhaurin-golf-resort',
        'almenara-golf-club',
        'club-la-costa-world'
      ]
    ],
    [
      'slug' => 'montecorto',
      'name_es' => 'Montecorto',
      'name_en' => 'Montecorto',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'montejaque',
      'name_es' => 'Montejaque',
      'name_en' => 'Montejaque',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'montenegral',
      'name_es' => 'Montenegral',
      'name_en' => 'Montenegral',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'montes-de-malaga',
      'name_es' => 'Montes de Málaga',
      'name_en' => 'Montes de Málaga',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'montilla',
      'name_es' => 'Montilla',
      'name_en' => 'Montilla',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'moraleda-de-zafayona',
      'name_es' => 'Moraleda de Zafayona',
      'name_en' => 'Moraleda de Zafayona',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'motril',
      'name_es' => 'Motril',
      'name_en' => 'Motril',
      'region_es' => 'Costa Tropical',
      'region_en' => 'Costa Tropical',
      'segment' => 'coast',
      'nearby' => [
        'almunecar',
        'la-herradura',
        'salobrena'
      ]
    ],
    [
      'slug' => 'novo-sancti-petri',
      'name_es' => 'Novo Sancti Petri',
      'name_en' => 'Novo Sancti Petri',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'nueva-andalucia-2',
      'name_es' => 'Nueva Andalucia',
      'name_en' => 'Nueva Andalucia',
      'region_es' => 'Marbella',
      'region_en' => 'Marbella',
      'segment' => 'city',
      'nearby' => [
        'guadalmina',
        'hotel-vime-la-reserva-de-marbella',
        'las-torres-del-marbella-club'
      ]
    ],
    [
      'slug' => 'ogijares',
      'name_es' => 'Ogíjares',
      'name_en' => 'Ogíjares',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'ojen',
      'name_es' => 'Ojen',
      'name_en' => 'Ojen',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'olias',
      'name_es' => 'Olías',
      'name_en' => 'Olías',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'orgiva',
      'name_es' => 'Órgiva',
      'name_en' => 'Órgiva',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'orihuela-costa',
      'name_es' => 'Orihuela Costa',
      'name_en' => 'Orihuela Costa',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'osuna',
      'name_es' => 'Osuna',
      'name_en' => 'Osuna',
      'region_es' => 'Andalucía y viajes largos',
      'region_en' => 'Andalucía y viajes largos',
      'segment' => 'long',
      'nearby' => [
        'aguadulce',
        'alhama-de-granada',
        'cartagena'
      ]
    ],
    [
      'slug' => 'otivar',
      'name_es' => 'Otivar',
      'name_en' => 'Otivar',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'otura',
      'name_es' => 'Otura',
      'name_en' => 'Otura',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'pedregalejo',
      'name_es' => 'Pedregalejo',
      'name_en' => 'Pedregalejo',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'periana',
      'name_es' => 'Periana',
      'name_en' => 'Periana',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'pinares-de-san-anton',
      'name_es' => 'Pinares de San Antón',
      'name_en' => 'Pinares de San Antón',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'pinos-genil',
      'name_es' => 'Pinos Genil',
      'name_en' => 'Pinos Genil',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'pitres',
      'name_es' => 'Pitres',
      'name_en' => 'Pitres',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'pizarra',
      'name_es' => 'Pizarra',
      'name_en' => 'Pizarra',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'playa-de-los-boliches',
      'name_es' => 'Playa de los Boliches',
      'name_en' => 'Playa de los Boliches',
      'region_es' => 'Fuengirola',
      'region_en' => 'Fuengirola',
      'segment' => 'city',
      'nearby' => [
        'los-boliches',
        'torreblanca',
        'malaga-city'
      ]
    ],
    [
      'slug' => 'playa-granada',
      'name_es' => 'Playa Granada',
      'name_en' => 'Playa Granada',
      'region_es' => 'Andalucía y viajes largos',
      'region_en' => 'Andalucía y viajes largos',
      'segment' => 'long',
      'nearby' => [
        'aguadulce',
        'alhama-de-granada',
        'cartagena'
      ]
    ],
    [
      'slug' => 'pozo-alcon',
      'name_es' => 'Pozo Alcón',
      'name_en' => 'Pozo Alcón',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'pradollano',
      'name_es' => 'Pradollano (Sierra Nevada)',
      'name_en' => 'Pradollano (Sierra Nevada)',
      'region_es' => 'Sierra Nevada',
      'region_en' => 'Sierra Nevada',
      'segment' => 'city',
      'nearby' => [
        'sol-y-nieve',
        'malaga-city',
        'ronda'
      ]
    ],
    [
      'slug' => 'priego-de-cordoba',
      'name_es' => 'Priego de Córdoba',
      'name_en' => 'Priego de Córdoba',
      'region_es' => 'Córdoba',
      'region_en' => 'Córdoba',
      'segment' => 'long',
      'nearby' => [
        'cordoba',
        'granada-city',
        'sierra-nevada'
      ]
    ],
    [
      'slug' => 'puebla-aida',
      'name_es' => 'Puebla Aida',
      'name_en' => 'Puebla Aida',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'puente-de-salia',
      'name_es' => 'Puente de Salia',
      'name_en' => 'Puente de Salia',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'puente-genil',
      'name_es' => 'Puente Genil',
      'name_en' => 'Puente Genil',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'puerto-de-la-duquesa',
      'name_es' => 'Puerto de la Duquesa',
      'name_en' => 'Puerto de la Duquesa',
      'region_es' => 'Manilva',
      'region_en' => 'Manilva',
      'segment' => 'coast',
      'nearby' => [
        'la-chullera',
        'san-luis-de-sabinillas',
        'torremolinos'
      ]
    ],
    [
      'slug' => 'puerto-de-la-torre',
      'name_es' => 'Puerto de la Torre',
      'name_en' => 'Puerto de la Torre',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'puerto-de-santa-maria',
      'name_es' => 'Puerto de Santa Maria',
      'name_en' => 'Puerto de Santa Maria',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'puerto-real',
      'name_es' => 'Puerto Real (Cádiz)',
      'name_en' => 'Puerto Real (Cádiz)',
      'region_es' => 'Cádiz',
      'region_en' => 'Cádiz',
      'segment' => 'long',
      'nearby' => [
        'cadiz',
        'granada-city',
        'sierra-nevada'
      ]
    ],
    [
      'slug' => 'puerto-serrano',
      'name_es' => 'Puerto Serrano',
      'name_en' => 'Puerto Serrano',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'rancho-domingo',
      'name_es' => 'Rancho Domingo',
      'name_en' => 'Rancho Domingo',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'resinera-voladilla',
      'name_es' => 'Resinera Voladilla',
      'name_en' => 'Resinera Voladilla',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'retamar',
      'name_es' => 'Retamar',
      'name_en' => 'Retamar',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'riogordo',
      'name_es' => 'Riogordo',
      'name_en' => 'Riogordo',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'rodalquilar',
      'name_es' => 'Rodalquilar',
      'name_en' => 'Rodalquilar',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'roquetas-de-mar',
      'name_es' => 'Roquetas de Mar',
      'name_en' => 'Roquetas de Mar',
      'region_es' => 'Almería',
      'region_en' => 'Almería',
      'segment' => 'city',
      'nearby' => [
        'almeria-city',
        'almerimar',
        'bahia-serena'
      ]
    ],
    [
      'slug' => 'rota',
      'name_es' => 'Rota',
      'name_en' => 'Rota',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'rute',
      'name_es' => 'Rute',
      'name_en' => 'Rute',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'sabariego',
      'name_es' => 'Sabariego',
      'name_en' => 'Sabariego',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'saleres',
      'name_es' => 'Saleres',
      'name_en' => 'Saleres',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'salinas',
      'name_es' => 'Salinas (Archidona)',
      'name_en' => 'Salinas (Archidona)',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'salobrena',
      'name_es' => 'Salobreña',
      'name_en' => 'Salobreña',
      'region_es' => 'Costa Tropical',
      'region_en' => 'Costa Tropical',
      'segment' => 'coast',
      'nearby' => [
        'almunecar',
        'la-herradura',
        'motril'
      ]
    ],
    [
      'slug' => 'san-jose',
      'name_es' => 'San José (Níjar)',
      'name_en' => 'San José (Níjar)',
      'region_es' => 'Almería',
      'region_en' => 'Almería',
      'segment' => 'city',
      'nearby' => [
        'almeria-city',
        'almerimar',
        'bahia-serena'
      ]
    ],
    [
      'slug' => 'san-luis-de-sabinillas',
      'name_es' => 'San Luis de Sabinillas',
      'name_en' => 'San Luis de Sabinillas',
      'region_es' => 'Manilva',
      'region_en' => 'Manilva',
      'segment' => 'coast',
      'nearby' => [
        'la-chullera',
        'puerto-de-la-duquesa',
        'torremolinos'
      ]
    ],
    [
      'slug' => 'san-martin-del-tesorillo',
      'name_es' => 'San Martin del Tesorillo',
      'name_en' => 'San Martin del Tesorillo',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'san-pablo-de-buceite',
      'name_es' => 'San Pablo de Buceite',
      'name_en' => 'San Pablo de Buceite',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'san-pedro-de-alcantara-2',
      'name_es' => 'San Pedro de Alcantara',
      'name_en' => 'San Pedro de Alcantara',
      'region_es' => 'Marbella',
      'region_en' => 'Marbella',
      'segment' => 'city',
      'nearby' => [
        'guadalmina',
        'hotel-vime-la-reserva-de-marbella',
        'las-torres-del-marbella-club'
      ]
    ],
    [
      'slug' => 'san-roque',
      'name_es' => 'San Roque',
      'name_en' => 'San Roque',
      'region_es' => 'Campo de Gibraltar',
      'region_en' => 'Campo de Gibraltar',
      'segment' => 'city',
      'nearby' => [
        'gibraltar-airport',
        'gibraltar-airport-2',
        'gibraltar-frontier-la-linea-de-la-concepcion'
      ]
    ],
    [
      'slug' => 'sanlucar-de-barrameda',
      'name_es' => 'Sanlucar de Barrameda',
      'name_en' => 'Sanlucar de Barrameda',
      'region_es' => 'Cádiz provincia',
      'region_en' => 'Cádiz provincia',
      'segment' => 'city',
      'nearby' => [
        'chiclana-de-la-frontera',
        'vejer-de-la-frontera',
        'zahara-de-los-atunes'
      ]
    ],
    [
      'slug' => 'sanlucar-la-mayor',
      'name_es' => 'Sanlúcar La Mayor',
      'name_en' => 'Sanlúcar La Mayor',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'santa-cruz-del-comercio',
      'name_es' => 'Santa Cruz del Comercio',
      'name_en' => 'Santa Cruz del Comercio',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'santa-fe',
      'name_es' => 'Santa Fe',
      'name_en' => 'Santa Fe',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'santa-margarita',
      'name_es' => 'Santa Margarita',
      'name_en' => 'Santa Margarita',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'sayolonga',
      'name_es' => 'Sayolonga',
      'name_en' => 'Sayolonga',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'sedella',
      'name_es' => 'Sedella',
      'name_en' => 'Sedella',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'seville',
      'name_es' => 'Seville',
      'name_en' => 'Seville',
      'region_es' => 'Sevilla',
      'region_en' => 'Sevilla',
      'segment' => 'long',
      'nearby' => [
        'seville-santa-justa-train-station',
        'seville-airport-2',
        'granada-city'
      ]
    ],
    [
      'slug' => 'seville-airport-2',
      'name_es' => 'Seville airport',
      'name_en' => 'Seville airport',
      'region_es' => 'Sevilla',
      'region_en' => 'Sevilla',
      'segment' => 'hub',
      'nearby' => [
        'seville',
        'seville-santa-justa-train-station',
        'malaga-train-station'
      ]
    ],
    [
      'slug' => 'seville-santa-justa-train-station',
      'name_es' => 'Seville Santa Justa train station (G)',
      'name_en' => 'Seville Santa Justa train station (G)',
      'region_es' => 'Sevilla',
      'region_en' => 'Sevilla',
      'segment' => 'hub',
      'nearby' => [
        'seville',
        'seville-airport-2',
        'malaga-train-station'
      ]
    ],
    [
      'slug' => 'sierra-de-yeguas',
      'name_es' => 'Sierra de Yeguas',
      'name_en' => 'Sierra de Yeguas',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'sitio-de-calahonda',
      'name_es' => 'Sitio de Calahonda (Mijas)',
      'name_en' => 'Sitio de Calahonda (Mijas)',
      'region_es' => 'Costa del Sol',
      'region_en' => 'Costa del Sol',
      'segment' => 'coast',
      'nearby' => [
        'benalmadena',
        'benalmadena-costa',
        'estepona'
      ]
    ],
    [
      'slug' => 'sol-y-nieve',
      'name_es' => 'Sol y Nieve (Sierra Nevada)',
      'name_en' => 'Sol y Nieve (Sierra Nevada)',
      'region_es' => 'Sierra Nevada',
      'region_en' => 'Sierra Nevada',
      'segment' => 'city',
      'nearby' => [
        'pradollano',
        'malaga-city',
        'ronda'
      ]
    ],
    [
      'slug' => 'tabernas',
      'name_es' => 'Tabernas',
      'name_en' => 'Tabernas',
      'region_es' => 'Almería',
      'region_en' => 'Almería',
      'segment' => 'city',
      'nearby' => [
        'almeria-city',
        'almerimar',
        'bahia-serena'
      ]
    ],
    [
      'slug' => 'tolox',
      'name_es' => 'Tolox',
      'name_en' => 'Tolox',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'torre-de-la-reina',
      'name_es' => 'Torre de la Reina',
      'name_en' => 'Torre de la Reina',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'torre-del-mar',
      'name_es' => 'Torre del Mar',
      'name_en' => 'Torre del Mar',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'torre-melgarejo',
      'name_es' => 'Torre Melgarejo',
      'name_en' => 'Torre Melgarejo',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'torrealqueria',
      'name_es' => 'Torrealquería',
      'name_en' => 'Torrealquería',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'torreguadiaro',
      'name_es' => 'Torreguadiaro',
      'name_en' => 'Torreguadiaro',
      'region_es' => 'Sotogrande',
      'region_en' => 'Sotogrande',
      'segment' => 'city',
      'nearby' => [
        'malaga-city',
        'ronda',
        'adra'
      ]
    ],
    [
      'slug' => 'torrenueva',
      'name_es' => 'Torrenueva (Mijas)',
      'name_en' => 'Torrenueva (Mijas)',
      'region_es' => 'Costa del Sol',
      'region_en' => 'Costa del Sol',
      'segment' => 'coast',
      'nearby' => [
        'benalmadena',
        'benalmadena-costa',
        'estepona'
      ]
    ],
    [
      'slug' => 'torrenueva-2',
      'name_es' => 'Torrenueva (Motril)',
      'name_en' => 'Torrenueva (Motril)',
      'region_es' => 'Costa Tropical',
      'region_en' => 'Costa Tropical',
      'segment' => 'coast',
      'nearby' => [
        'almunecar',
        'la-herradura',
        'motril'
      ]
    ],
    [
      'slug' => 'trevelez',
      'name_es' => 'Trevélez (Sierra Nevada)',
      'name_en' => 'Trevélez (Sierra Nevada)',
      'region_es' => 'Costa del Sol',
      'region_en' => 'Costa del Sol',
      'segment' => 'coast',
      'nearby' => [
        'benalmadena',
        'benalmadena-costa',
        'estepona'
      ]
    ],
    [
      'slug' => 'triana',
      'name_es' => 'Triana',
      'name_en' => 'Triana',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'ubeda',
      'name_es' => 'Ubeda',
      'name_en' => 'Ubeda',
      'region_es' => 'Andalucía y viajes largos',
      'region_en' => 'Andalucía y viajes largos',
      'segment' => 'long',
      'nearby' => [
        'aguadulce',
        'alhama-de-granada',
        'cartagena'
      ]
    ],
    [
      'slug' => 'ubrique',
      'name_es' => 'Ubrique',
      'name_en' => 'Ubrique',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'urb-el-rosario',
      'name_es' => 'Urb. El Rosario',
      'name_en' => 'Urb. El Rosario',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'urb-mijas-golf',
      'name_es' => 'Urb. Mijas Golf',
      'name_en' => 'Urb. Mijas Golf',
      'region_es' => 'Costa del Sol',
      'region_en' => 'Costa del Sol',
      'segment' => 'golf',
      'nearby' => [
        'benalmadena',
        'benalmadena-costa',
        'estepona'
      ]
    ],
    [
      'slug' => 'urb-monte-mayor',
      'name_es' => 'Urb. Monte Mayor',
      'name_en' => 'Urb. Monte Mayor',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'urb-pueblo-valtocado',
      'name_es' => 'Urb. Pueblo Valtocado',
      'name_en' => 'Urb. Pueblo Valtocado',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'valdevaqueros',
      'name_es' => 'Valdevaqueros',
      'name_en' => 'Valdevaqueros',
      'region_es' => 'Tarifa',
      'region_en' => 'Tarifa',
      'segment' => 'city',
      'nearby' => [
        'el-cuarton',
        'malaga-city',
        'ronda'
      ]
    ],
    [
      'slug' => 'valencia-city',
      'name_es' => 'Valencia city (all areas)',
      'name_en' => 'Valencia city (all areas)',
      'region_es' => 'Valencia',
      'region_en' => 'Valencia',
      'segment' => 'long',
      'nearby' => [
        'granada-city',
        'sierra-nevada',
        'cordoba-city'
      ]
    ],
    [
      'slug' => 'vejer-de-la-frontera',
      'name_es' => 'Vejer de la Frontera',
      'name_en' => 'Vejer de la Frontera',
      'region_es' => 'Cádiz provincia',
      'region_en' => 'Cádiz provincia',
      'segment' => 'long',
      'nearby' => [
        'chiclana-de-la-frontera',
        'sanlucar-de-barrameda',
        'zahara-de-los-atunes'
      ]
    ],
    [
      'slug' => 'velez-de-benaudalla',
      'name_es' => 'Vélez de Benaudalla',
      'name_en' => 'Vélez de Benaudalla',
      'region_es' => 'Costa Tropical',
      'region_en' => 'Costa Tropical',
      'segment' => 'coast',
      'nearby' => [
        'almunecar',
        'la-herradura',
        'motril'
      ]
    ],
    [
      'slug' => 'vera-playa',
      'name_es' => 'Vera Playa',
      'name_en' => 'Vera Playa',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'villafranco-de-guadalhorce',
      'name_es' => 'Villafranco de Guadalhorce',
      'name_en' => 'Villafranco de Guadalhorce',
      'region_es' => 'Costa del Sol premium',
      'region_en' => 'Costa del Sol premium',
      'segment' => 'luxury',
      'nearby' => [
        'hotel-cortijo-del-marques',
        'villalobos',
        'villanueva-de-tapia'
      ]
    ],
    [
      'slug' => 'villalobos',
      'name_es' => 'Villalobos',
      'name_en' => 'Villalobos',
      'region_es' => 'Costa del Sol premium',
      'region_en' => 'Costa del Sol premium',
      'segment' => 'luxury',
      'nearby' => [
        'hotel-cortijo-del-marques',
        'villafranco-de-guadalhorce',
        'villanueva-de-tapia'
      ]
    ],
    [
      'slug' => 'villanueva-de-la-concepcion',
      'name_es' => 'Villanueva de la Concepción',
      'name_en' => 'Villanueva de la Concepción',
      'region_es' => 'Costa del Sol premium',
      'region_en' => 'Costa del Sol premium',
      'segment' => 'luxury',
      'nearby' => [
        'hotel-cortijo-del-marques',
        'villafranco-de-guadalhorce',
        'villalobos'
      ]
    ],
    [
      'slug' => 'villanueva-de-tapia',
      'name_es' => 'Villanueva de Tapia',
      'name_en' => 'Villanueva de Tapia',
      'region_es' => 'Costa del Sol premium',
      'region_en' => 'Costa del Sol premium',
      'segment' => 'luxury',
      'nearby' => [
        'hotel-cortijo-del-marques',
        'villafranco-de-guadalhorce',
        'villalobos'
      ]
    ],
    [
      'slug' => 'villanueva-del-rosario',
      'name_es' => 'Villanueva del Rosario',
      'name_en' => 'Villanueva del Rosario',
      'region_es' => 'Costa del Sol premium',
      'region_en' => 'Costa del Sol premium',
      'segment' => 'luxury',
      'nearby' => [
        'hotel-cortijo-del-marques',
        'villafranco-de-guadalhorce',
        'villalobos'
      ]
    ],
    [
      'slug' => 'villanueva-del-trabuco',
      'name_es' => 'Villanueva del Trabuco',
      'name_en' => 'Villanueva del Trabuco',
      'region_es' => 'Costa del Sol premium',
      'region_en' => 'Costa del Sol premium',
      'segment' => 'luxury',
      'nearby' => [
        'hotel-cortijo-del-marques',
        'villafranco-de-guadalhorce',
        'villalobos'
      ]
    ],
    [
      'slug' => 'vinuela',
      'name_es' => 'Viñuela',
      'name_en' => 'Viñuela',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'wyndham-costa-del-sol',
      'name_es' => 'Wyndham Costa del Sol',
      'name_en' => 'Wyndham Costa del Sol',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'yegen',
      'name_es' => 'Yegen',
      'name_en' => 'Yegen',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'zafarraya',
      'name_es' => 'Zafarraya',
      'name_en' => 'Zafarraya',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'zagra',
      'name_es' => 'Zagra',
      'name_en' => 'Zagra',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'zahara',
      'name_es' => 'Zahara',
      'name_en' => 'Zahara',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'zahara-de-los-atunes',
      'name_es' => 'Zahara de los Atunes',
      'name_en' => 'Zahara de los Atunes',
      'region_es' => 'Cádiz provincia',
      'region_en' => 'Cádiz provincia',
      'segment' => 'city',
      'nearby' => [
        'chiclana-de-la-frontera',
        'sanlucar-de-barrameda',
        'vejer-de-la-frontera'
      ]
    ],
    [
      'slug' => 'zalea',
      'name_es' => 'Zalea',
      'name_en' => 'Zalea',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ],
    [
      'slug' => 'zuheros',
      'name_es' => 'Zuheros',
      'name_en' => 'Zuheros',
      'region_es' => 'Andalucía',
      'region_en' => 'Andalucía',
      'segment' => 'city',
      'nearby' => [
        'adra',
        'alameda',
        'albox'
      ]
    ]
  ],
  'hubs' => [
    [
      'slug' => 'destinos-desde-aeropuerto-malaga',
      'title_es' => 'Destinos desde el Aeropuerto de Málaga',
      'title_en' => 'Destinations from Málaga Airport',
      'intro_es' => 'Directorio de traslados privados de Transfer Marbell desde o hasta el Aeropuerto de Málaga, con enlaces a rutas por la Costa del Sol, ciudades andaluzas y viajes largos.',
      'intro_en' => 'Transfer Marbell directory of private transfers from or to Málaga Airport, linking to Costa del Sol routes, Andalusian cities and long-distance journeys.',
      'destinations' => [
        'malaga-city',
        'malaga-train-station',
        'malaga-cruise-port',
        'torremolinos',
        'benalmadena',
        'arroyo-de-la-miel',
        'torrequebrada',
        'torremuelle',
        'fuengirola',
        'torreblanca',
        'los-boliches',
        'mijas',
        'mijas-costa',
        'la-cala-de-mijas',
        'riviera-del-sol',
        'calahonda-mijas',
        'miraflores-golf',
        'cabopino',
        'marbesa',
        'las-chapas',
        'elviria',
        'marbella',
        'nueva-andalucia',
        'puerto-banus'
      ]
    ],
    [
      'slug' => 'traslados-costa-del-sol',
      'title_es' => 'Traslados Costa del Sol desde el Aeropuerto de Málaga',
      'title_en' => 'Costa del Sol transfers from Málaga Airport',
      'intro_es' => 'Rutas de Transfer Marbell a Marbella, Puerto Banús, Fuengirola, Benalmádena, Mijas, Estepona, Nerja, Torrox y más destinos de la Costa del Sol.',
      'intro_en' => 'Transfer Marbell routes to Marbella, Puerto Banús, Fuengirola, Benalmádena, Mijas, Estepona, Nerja, Torrox and more Costa del Sol destinations.',
      'destinations' => [
        'torremolinos',
        'benalmadena',
        'arroyo-de-la-miel',
        'torrequebrada',
        'torremuelle',
        'fuengirola',
        'torreblanca',
        'los-boliches',
        'mijas',
        'mijas-costa',
        'la-cala-de-mijas',
        'riviera-del-sol',
        'calahonda-mijas',
        'miraflores-golf',
        'cabopino',
        'marbesa',
        'las-chapas',
        'elviria',
        'marbella',
        'nueva-andalucia',
        'puerto-banus',
        'san-pedro-de-alcantara',
        'benahavis',
        'estepona',
        'cancelada',
        'manilva',
        'sotogrande',
        'rincon-de-la-victoria',
        'velez-malaga',
        'torrox',
        'torrox-costa',
        'nerja',
        'frigiliana',
        'alhaurin-golf-resort',
        'almenara-golf-club',
        'almunecar',
        'benalmadena-costa',
        'cabopino-2',
        'calahonda',
        'caleta-de-velez'
      ]
    ],
    [
      'slug' => 'traslados-largos-desde-aeropuerto-malaga',
      'title_es' => 'Viajes largos desde el Aeropuerto de Málaga',
      'title_en' => 'Long-distance private transfers from Málaga Airport',
      'intro_es' => 'Traslados privados de larga distancia de Transfer Marbell desde el Aeropuerto de Málaga a Sevilla, Granada, Córdoba, Cádiz, Huelva, Almería y otros destinos.',
      'intro_en' => 'Transfer Marbell long-distance private transfers from Málaga Airport to Seville, Granada, Córdoba, Cádiz, Huelva, Almería and other destinations.',
      'destinations' => [
        'granada-city',
        'sierra-nevada',
        'cordoba-city',
        'seville-city',
        'cadiz-city',
        'jerez-de-la-frontera',
        'conil-de-la-frontera',
        'tarifa',
        'aguadulce',
        'alhama-de-granada',
        'almeria-city',
        'almerimar',
        'cadiz',
        'cartagena',
        'cordoba',
        'granada',
        'granada-city-2',
        'huelva',
        'jaen',
        'osuna',
        'playa-granada',
        'priego-de-cordoba',
        'puerto-real',
        'seville',
        'ubeda',
        'valencia-city',
        'vejer-de-la-frontera'
      ]
    ],
    [
      'slug' => 'traslados-marbella-puerto-banus',
      'title_es' => 'Traslados a Marbella y Puerto Banús',
      'title_en' => 'Private transfers to Marbella and Puerto Banús',
      'intro_es' => 'Páginas de Transfer Marbell para Marbella, Puerto Banús, Nueva Andalucía, Guadalmina, San Pedro y zonas premium del entorno.',
      'intro_en' => 'Transfer Marbell pages for Marbella, Puerto Banús, Nueva Andalucía, Guadalmina, San Pedro and surrounding premium areas.',
      'destinations' => [
        'cabopino',
        'marbesa',
        'las-chapas',
        'elviria',
        'marbella',
        'nueva-andalucia',
        'puerto-banus',
        'san-pedro-de-alcantara',
        'cabopino-2',
        'guadalmina',
        'hotel-vime-la-reserva-de-marbella',
        'las-lomas-de-cabopino',
        'las-torres-del-marbella-club',
        'marbella-hotel-guadalapin-suites',
        'marbella-hotel-puente-romano',
        'marbella-city-centre',
        'marbesa-2',
        'nueva-andalucia-2',
        'san-pedro-de-alcantara-2'
      ]
    ],
    [
      'slug' => 'traslados-fuengirola-benalmadena-mijas',
      'title_es' => 'Traslados a Fuengirola, Benalmádena y Mijas',
      'title_en' => 'Transfers to Fuengirola, Benalmádena and Mijas',
      'intro_es' => 'Rutas de aeropuerto a Fuengirola, Los Boliches, Torreblanca, Benalmádena, Arroyo de la Miel, Mijas Costa y La Cala de Mijas.',
      'intro_en' => 'Airport routes to Fuengirola, Los Boliches, Torreblanca, Benalmádena, Arroyo de la Miel, Mijas Costa and La Cala de Mijas.',
      'destinations' => [
        'benalmadena',
        'arroyo-de-la-miel',
        'fuengirola',
        'torreblanca',
        'los-boliches',
        'mijas',
        'mijas-costa',
        'la-cala-de-mijas',
        'riviera-del-sol',
        'calahonda-mijas',
        'benalmadena-costa',
        'calahonda',
        'mijas-costa-2',
        'mijas-golf-international-sau',
        'playa-de-los-boliches',
        'sitio-de-calahonda',
        'urb-mijas-golf'
      ]
    ],
    [
      'slug' => 'traslados-nerja-frigiliana-torrox',
      'title_es' => 'Traslados a Nerja, Frigiliana y Torrox',
      'title_en' => 'Transfers to Nerja, Frigiliana and Torrox',
      'intro_es' => 'Transfer Marbell cubre Nerja, Frigiliana, Torrox, Torrox Costa, El Morche y otros destinos de la Axarquía y Costa Tropical.',
      'intro_en' => 'Transfer Marbell covers Nerja, Frigiliana, Torrox, Torrox Costa, El Morche and nearby Axarquía and Costa Tropical destinations.',
      'destinations' => [
        'velez-malaga',
        'torrox',
        'torrox-costa',
        'nerja',
        'frigiliana',
        'almunecar',
        'caleta-de-velez',
        'el-morche',
        'la-herradura',
        'motril',
        'salobrena',
        'trevelez',
        'velez-de-benaudalla'
      ]
    ],
    [
      'slug' => 'destinos-a-z',
      'title_es' => 'Destinos A-Z desde el Aeropuerto de Málaga',
      'title_en' => 'A-Z destinations from Málaga Airport',
      'intro_es' => 'Listado alfabético de rutas de Transfer Marbell desde o hasta el Aeropuerto de Málaga para facilitar el rastreo y la navegación por todos los destinos operativos.',
      'intro_en' => 'Alphabetical directory of Transfer Marbell routes from or to Málaga Airport to improve crawling and navigation across all operational destinations.',
      'destinations' => [
        'malaga-city',
        'malaga-train-station',
        'malaga-cruise-port',
        'torremolinos',
        'benalmadena',
        'arroyo-de-la-miel',
        'torrequebrada',
        'torremuelle',
        'fuengirola',
        'torreblanca',
        'los-boliches',
        'mijas',
        'mijas-costa',
        'la-cala-de-mijas',
        'riviera-del-sol',
        'calahonda-mijas',
        'miraflores-golf',
        'cabopino',
        'marbesa',
        'las-chapas',
        'elviria',
        'marbella',
        'nueva-andalucia',
        'puerto-banus',
        'san-pedro-de-alcantara',
        'benahavis',
        'estepona',
        'cancelada',
        'manilva',
        'sotogrande',
        'gibraltar-airport',
        'rincon-de-la-victoria',
        'velez-malaga',
        'torrox',
        'torrox-costa',
        'nerja',
        'frigiliana',
        'ronda',
        'granada-city',
        'sierra-nevada',
        'cordoba-city',
        'seville-city',
        'seville-airport',
        'cadiz-city',
        'jerez-de-la-frontera',
        'conil-de-la-frontera',
        'tarifa',
        'adra',
        'aguadulce',
        'alameda',
        'albox',
        'albunol',
        'alcaidesa',
        'alcala-de-guadaira',
        'alcala-de-los-gazules',
        'alcala-del-rio',
        'alcala-la-real',
        'alcaucin',
        'alcaudete',
        'alcudia-de-guadix'
      ]
    ]
  ]
];

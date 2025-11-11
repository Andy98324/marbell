<?php
return [
  'GET /' => function () {
    $title   = t('home.title_short');
    $seoData = [
      'title'       => t('home.seo.title'),
      'description' => t('home.seo.desc'),
      'image'       => '/assets/logo-og.png',
      'keywords'    => t('home.seo.keywords'),
    ];
    require __DIR__ . '/../views/home.php';
  },

   'GET /nosotros' => function () {
    $title   = t('about.title_short');
    $seoData = [
      'title'       => t('about.seo.title'),
      'description' => t('about.seo.desc'),
      'keywords'    => t('about.seo.keywords'),
      'image'       => '/assets/logo-og.png',
      'breadcrumbs' => [
        ['@id'=>'/',          'name'=>t('nav.home')],
        ['@id'=>'/nosotros',  'name'=>t('about.h1')],
      ],
    ];
    require __DIR__ . '/../views/about.php';

  },

 'GET /servicios/traslados' => function () {
  $title   = t('transfers.title_short');
  $seoData = [
    'title'       => t('transfers.seo.title'),
    'description' => t('transfers.seo.desc'),
    'keywords'    => t('transfers.seo.keywords'),
    'image'       => '/assets/logo-og.png',
    'breadcrumbs' => [
      ['@id'=>'/',                    'name'=>t('nav.home')],
      ['@id'=>'/servicios',           'name'=>t('nav.services')],
      ['@id'=>'/servicios/traslados', 'name'=>t('transfers.h1')],
    ],
  ];
  require __DIR__ . '/../views/servicios/transfers.php';
},
'GET /flota' => function () {
  $title   = t('transfers.title_short');
  $seoData = [
    'title'       => t('flota.seo.title'),
    'description' => t('flota.seo.desc'),
    'keywords'    => t('flota.seo.keywords'),
    'image'       => '/assets/logo-og.png',
    'breadcrumbs' => [
      ['@id'=>'/',                    'name'=>t('nav.home')],
      ['@id'=>'/servicios',           'name'=>t('nav.services')],
      ['@id'=>'/traslados', 'name'=>t('flota.h1')],
    ],
  ];
  require __DIR__ . '/../views/flota.php';
},
'GET /servicios/excursiones' => function () {
  $title   = t('excursions.title_short');
  $seoData = [
    'title'       => t('excursions.seo.title'),
    'description' => t('excursions.seo.desc'),
    'keywords'    => t('excursions.seo.keywords'),
    'image'       => '/assets/logo-og.png',
    'breadcrumbs' => [
      ['@id'=>'/',                      'name'=>t('nav.home')],
      ['@id'=>'/servicios',             'name'=>t('nav.services')],
      ['@id'=>'/servicios/excursiones', 'name'=>t('excursions.h1')],
    ],
  ];
  require __DIR__ . '/../views/servicios/excursiones.php';
},

'GET /servicios/excursiones/nerja-frigiliana' => function () {
  $title   = t('excursions.nerja.title_short');
  $seoData = [
    'title'       => t('excursions.nerja.seo.title'),
    'description' => t('excursions.nerja.seo.desc'),
    'keywords'    => t('excursions.nerja.seo.keywords'),
    'image'       => '//assets/logo-og.png',
    'canonical'   => '/servicios/excursiones/nerja-frigiliana',
    'breadcrumbs' => [
      ['@id'=>'/', 'name'=>t('nav.home')],
      ['@id'=>'/servicios', 'name'=>t('nav.services')],
      ['@id'=>'/servicios/excursiones', 'name'=>t('excursions.h1')],
      ['@id'=>'/servicios/excursiones/nerja-frigiliana', 'name'=>t('excursions.nerja.h1')],
    ],
  ];
  require __DIR__ . '/../views/servicios/excursiones/nerja-frigiliana.php';
},

'GET /servicios/excursiones/ronda-setenil' => function () {
  $seoData = [
    'title'       => t('excursions.ronda.seo.title'),
    'description' => t('excursions.ronda.seo.desc'),
    'keywords'    => t('excursions.ronda.seo.keywords'),
    'image'       => '/assets/images/excursiones/ronda-setenil-og.jpg',
    'canonical'   => '/servicios/excursiones/ronda-setenil',
    'breadcrumbs' => [
      ['@id'=>'/',                      'name'=>t('nav.home')],
      ['@id'=>'/servicios',             'name'=>t('nav.services')],
      ['@id'=>'/servicios/excursiones', 'name'=>t('excursions.h1')],
      ['@id'=>'/servicios/excursiones/ronda-setenil', 'name'=>t('excursions.ronda.h1')],
    ],
  ];
  require __DIR__ . '/../views/servicios/excursiones/ronda-setenil.php';
},

'GET /servicios/excursiones/granada-albaicin' => function () {
  $seoData = [
    'title'       => t('excursions.granada.seo.title'),
    'description' => t('excursions.granada.seo.desc'),
    'keywords'    => t('excursions.granada.seo.keywords'),
    'image'       => '/assets/images/excursiones/granada-albaicin-og.jpg',
    'canonical'   => '/servicios/excursiones/granada-albaicin',
    'breadcrumbs' => [
      ['@id'=>'/',                      'name'=>t('nav.home')],
      ['@id'=>'/servicios',             'name'=>t('nav.services')],
      ['@id'=>'/servicios/excursiones', 'name'=>t('excursions.h1')],
      ['@id'=>'/servicios/excursiones/granada-albaicin', 'name'=>t('excursions.granada.h1')],
    ],
  ];
  require __DIR__ . '/../views/servicios/excursiones/granada-albaicin.php';
},

// CÓRDOBA
'GET /servicios/excursiones/cordoba' => function () {
  $seoData = [
    'title'       => t('excursions.cordoba.seo.title'),
    'description' => t('excursions.cordoba.seo.desc'),
    'keywords'    => t('excursions.cordoba.seo.keywords'),
    'image'       => '/assets/images/excursiones/cordoba-og.jpg',
    'canonical'   => '/servicios/excursiones/cordoba',
    'breadcrumbs' => [
      ['@id'=>'/',                      'name'=>t('nav.home')],
      ['@id'=>'/servicios',             'name'=>t('nav.services')],
      ['@id'=>'/servicios/excursiones', 'name'=>t('excursions.h1')],
      ['@id'=>'/servicios/excursiones/cordoba', 'name'=>t('excursions.cordoba.h1')],
    ],
  ];
  require __DIR__ . '/../views/servicios/excursiones/cordoba.php';
},

// SEVILLA
'GET /servicios/excursiones/sevilla' => function () {
  $seoData = [
    'title'       => t('excursions.sevilla.seo.title'),
    'description' => t('excursions.sevilla.seo.desc'),
    'keywords'    => t('excursions.sevilla.seo.keywords'),
    'image'       => '/assets/images/excursiones/sevilla-og.jpg',
    'canonical'   => '/servicios/excursiones/sevilla',
    'breadcrumbs' => [
      ['@id'=>'/',                      'name'=>t('nav.home')],
      ['@id'=>'/servicios',             'name'=>t('nav.services')],
      ['@id'=>'/servicios/excursiones', 'name'=>t('excursions.h1')],
      ['@id'=>'/servicios/excursiones/sevilla', 'name'=>t('excursions.sevilla.h1')],
    ],
  ];
  require __DIR__ . '/../views/servicios/excursiones/sevilla.php';
},

// CÁDIZ
'GET /servicios/excursiones/cadiz' => function () {
  $seoData = [
    'title'       => t('excursions.cadiz.seo.title'),
    'description' => t('excursions.cadiz.seo.desc'),
    'keywords'    => t('excursions.cadiz.seo.keywords'),
    'image'       => '/assets/images/excursiones/cadiz-og.jpg',
    'canonical'   => '/servicios/excursiones/cadiz',
    'breadcrumbs' => [
      ['@id'=>'/',                      'name'=>t('nav.home')],
      ['@id'=>'/servicios',             'name'=>t('nav.services')],
      ['@id'=>'/servicios/excursiones', 'name'=>t('excursions.h1')],
      ['@id'=>'/servicios/excursiones/cadiz', 'name'=>t('excursions.cadiz.h1')],
    ],
  ];
  require __DIR__ . '/../views/servicios/excursiones/cadiz.php';
},
// router.php (o donde declares las rutas)
'GET /servicios/visitas-guiadas' => function () {
  $title   = t('guided.title_short');
  $seoData = [
    'title'       => t('guided.seo.title'),
    'description' => t('guided.seo.desc'),
    'keywords'    => t('guided.seo.keywords'),
    'image'       => '/assets/logo-og.png',
    'breadcrumbs' => [
      ['@id'=>'/',                       'name'=>t('nav.home')],
      ['@id'=>'/servicios',              'name'=>t('nav.services')],
      ['@id'=>'/servicios/visitas-guiadas','name'=>t('guided.h1')],
    ],
  ];
  require __DIR__ . '/../views/servicios/visitas-guiadas.php';
},
// routes.php
'GET /servicios/visitas-guiadas/cordoba' => function () {
  $title = t('guided.cordoba.title_short'); // “Córdoba · Mezquita + Judería”
  $seoData = [
    'title'       => t('guided.cordoba.seo.title'),
    'description' => t('guided.cordoba.seo.desc'),
    'keywords'    => t('guided.cordoba.seo.keywords'),
    'image'       => '/assets/images/excursiones/cordoba/og-cordoba.jpg',
    'breadcrumbs' => [
      ['@id'=>'/',                        'name'=>t('nav.home')],
      ['@id'=>'/servicios',               'name'=>t('nav.services')],
      ['@id'=>'/servicios/visitas-guiadas','name'=>t('nav.services.guided')],
      ['@id'=>'/servicios/visitas-guiadas/cordoba','name'=>t('guided.cordoba.h1')],
    ],
  ];
  require __DIR__ . '/../views/servicios/visitas-guiadas/cordoba.php';
},

'GET /servicios/visitas-guiadas/gibraltar' => function () {
  $title = t('guided.gibraltar.title_short'); // “Córdoba · Mezquita + Judería”
  $seoData = [
    'title'       => t('guided.gibraltar.seo.title'),
    'description' => t('guided.gibraltar.seo.desc'),
    'keywords'    => t('guided.gibraltgar.seo.keywords'),
    'image'       => '/assets/images/excursiones/gibraltar/og-cgibraltar.jpg',
    'breadcrumbs' => [
      ['@id'=>'/',                        'name'=>t('nav.home')],
      ['@id'=>'/servicios',               'name'=>t('nav.services')],
      ['@id'=>'/servicios/visitas-guiadas','name'=>t('nav.services.guided')],
      ['@id'=>'/servicios/visitas-guiadas/gibraltar','name'=>t('guided.gibraltar.h1')],
    ],
  ];
  require __DIR__ . '/../views/servicios/visitas-guiadas/gibraltar.php';
},

'GET /servicios/visitas-guiadas/granada-alhambra' => function () {
  $title = t('guided.alhambra.title_short'); // “Córdoba · Mezquita + Judería”
  $seoData = [
    'title'       => t('guided.alhambra.seo.title'),
    'description' => t('guided.alhambra.seo.desc'),
    'keywords'    => t('guided.alhambra.seo.keywords'),
    'image'       => '/assets/images/excursiones/alhambra/og-calhambra.jpg',
    'breadcrumbs' => [
      ['@id'=>'/',                        'name'=>t('nav.home')],
      ['@id'=>'/servicios',               'name'=>t('nav.services')],
      ['@id'=>'/servicios/visitas-guiadas','name'=>t('nav.services.guided')],
      ['@id'=>'/servicios/visitas-guiadas/alhambra','name'=>t('guided.alhambra.h1')],
    ],
  ];
  require __DIR__ . '/../views/servicios/visitas-guiadas/granada-alhambra.php';
},
'GET /servicios/visitas-guiadas/granada-city' => function () {
  $title = t('guided.granada-city.title_short'); // “Córdoba · Mezquita + Judería”
  $seoData = [
    'title'       => t('guided.granada-city.seo.title'),
    'description' => t('guided.granada-city.seo.desc'),
    'keywords'    => t('guided.granada-city.seo.keywords'),
    'image'       => '/assets/images/excursiones/granada/og-cgranada-city.jpg',
    'breadcrumbs' => [
      ['@id'=>'/',                        'name'=>t('nav.home')],
      ['@id'=>'/servicios',               'name'=>t('nav.services')],
      ['@id'=>'/servicios/visitas-guiadas','name'=>t('nav.services.guided')],
      ['@id'=>'/servicios/visitas-guiadas/granada-city','name'=>t('guided.granada-city.h1')],
    ],
  ];
  require __DIR__ . '/../views/servicios/visitas-guiadas/granada-city.php';
},

'GET /servicios/visitas-guiadas/malaga' => function () {
  $title = t('guided.malaga.title_short'); // “Córdoba · Mezquita + Judería”
  $seoData = [
    'title'       => t('guided.malaga.seo.title'),
    'description' => t('guided.malaga.seo.desc'),
    'keywords'    => t('guided.malaga.seo.keywords'),
    'image'       => '/assets/images/excursiones/malaga/og-cmalaga-city.jpg',
    'breadcrumbs' => [
      ['@id'=>'/',                        'name'=>t('nav.home')],
      ['@id'=>'/servicios',               'name'=>t('nav.services')],
      ['@id'=>'/servicios/visitas-guiadas','name'=>t('nav.services.guided')],
      ['@id'=>'/servicios/visitas-guiadas/malaga','name'=>t('guided.malaga.h1')],
    ],
  ];
  require __DIR__ . '/../views/servicios/visitas-guiadas/malaga.php';
},

'GET /servicios/visitas-guiadas/ronda' => function () {
  $title = t('guided.ronda.title_short'); // “Córdoba · Mezquita + Judería”
  $seoData = [
    'title'       => t('guided.ronda.seo.title'),
    'description' => t('guided.ronda.seo.desc'),
    'keywords'    => t('guided.ronda.seo.keywords'),
    'image'       => '/assets/images/excursiones/ronda/og-cronda.jpg',
    'breadcrumbs' => [
      ['@id'=>'/',                        'name'=>t('nav.home')],
      ['@id'=>'/servicios',               'name'=>t('nav.services')],
      ['@id'=>'/servicios/visitas-guiadas','name'=>t('nav.services.guided')],
      ['@id'=>'/servicios/visitas-guiadas/ronda','name'=>t('guided.ronda.h1')],
    ],
  ];
  require __DIR__ . '/../views/servicios/visitas-guiadas/ronda.php';
},

'GET /servicios/visitas-guiadas/sevilla-alcazar-catedral' => function () {
  $title = t('guided.sevilla-alcazar-catedral.title_short'); // “Córdoba · Mezquita + Judería”
  $seoData = [
    'title'       => t('guided.sevilla-alcazar-catedral.seo.title'),
    'description' => t('guided.sevilla-alcazar-catedral.seo.desc'),
    'keywords'    => t('guided.sevilla-alcazar-catedral.seo.keywords'),
    'image'       => '/assets/images/excursiones/sevilla-essential/og-csevilla-alcazar-catedral.jpg',
    'breadcrumbs' => [
      ['@id'=>'/',                        'name'=>t('nav.home')],
      ['@id'=>'/servicios',               'name'=>t('nav.services')],
      ['@id'=>'/servicios/visitas-guiadas','name'=>t('nav.services.guided')],
      ['@id'=>'/servicios/visitas-guiadas/sevilla-alcazar-catedral','name'=>t('guided.sevilla-alcazar-catedral.h1')],
    ],
  ];
  require __DIR__ . '/../views/servicios/visitas-guiadas/sevilla-alcazar-catedral.php';
},

'GET /servicios/visitas-guiadas/sevilla-essential' => function () {
  $title = t('guided.sevilla-essential.title_short'); // “Córdoba · Mezquita + Judería”
  $seoData = [
    'title'       => t('guided.sevilla-essential.seo.title'),
    'description' => t('guided.sevilla-essential.seo.desc'),
    'keywords'    => t('guided.sevilla-essential.seo.keywords'),
    'image'       => '/assets/images/excursiones/sevilla-essential/og-csevilla-essential.jpg',
    'breadcrumbs' => [
      ['@id'=>'/',                        'name'=>t('nav.home')],
      ['@id'=>'/servicios',               'name'=>t('nav.services')],
      ['@id'=>'/servicios/visitas-guiadas','name'=>t('nav.services.guided')],
      ['@id'=>'/servicios/visitas-guiadas/sevilla-essential','name'=>t('guided.sevilla-essential.h1')],
    ],
  ];
  require __DIR__ . '/../views/servicios/visitas-guiadas/sevilla-essential.php';
},

// Sedans
'GET /fleet-sedans' => function () {
  $title = t('fleet.sedans.h1');
  $seoData = [
    'title'       => t('fleet.sedans.seo.title'),
    'description' => t('fleet.sedans.seo.desc'),
    'keywords'    => t('fleet.sedans.seo.keywords'),
    'image'       => '/assets/images/fleet/sedans/og-sedans.jpg',
    'breadcrumbs' => [
      ['@id'=>'/',        'name'=>t('nav.home')],
      ['@id'=>'/flota',   'name'=>t('nav.fleet')],
      ['@id'=>'/fleet-sedans','name'=>t('fleet.sedans.h1')],
    ],
  ];
  require __DIR__ . '/../views/fleet-sedans.php';
  exit;
},
'GET /sedanes' => function () {  // alias ES
  $title = t('fleet.sedans.h1');
  $seoData = [
    'title'       => t('fleet.sedans.seo.title'),
    'description' => t('fleet.sedans.seo.desc'),
    'keywords'    => t('fleet.sedans.seo.keywords'),
    'image'       => '/assets/images/fleet/sedans/og-sedans.jpg',
    'breadcrumbs' => [
      ['@id'=>'/',        'name'=>t('nav.home')],
      ['@id'=>'/flota',   'name'=>t('nav.fleet')],
      ['@id'=>'/sedanes', 'name'=>t('fleet.sedans.h1')],
    ],
  ];
  require __DIR__ . '/../views/fleet-sedans.php';
},

// Premium Sedans
'GET /fleet-sedans-premium' => function () {
  $title = t('fleet.sedans_p.h1');
  $seoData = [
    'title'       => t('fleet.sedans_p.seo.title'),
    'description' => t('fleet.sedans_p.seo.desc'),
    'keywords'    => t('fleet.sedans_p.seo.keywords'),
    'image'       => '/assets/images/fleet/sedans-premium/og-sedans-premium.jpg',
    'breadcrumbs' => [
      ['@id'=>'/', 'name'=>t('nav.home')],
      ['@id'=>'/flota','name'=>t('nav.fleet')],
      ['@id'=>'/fleet-sedans-premium','name'=>t('fleet.sedans_p.h1')],
    ],
  ];
  require __DIR__ . '/../views/fleet-sedans-premium.php';
},
'GET /sedanes-premium' => function () { // alias ES
  $title = t('fleet.sedans_p.h1');
  $seoData = [
    'title'       => t('fleet.sedans_p.seo.title'),
    'description' => t('fleet.sedans_p.seo.desc'),
    'keywords'    => t('fleet.sedans_p.seo.keywords'),
    'image'       => '/assets/images/fleet/sedans-premium/og-sedans-premium.jpg',
    'breadcrumbs' => [
      ['@id'=>'/', 'name'=>t('nav.home')],
      ['@id'=>'/flota','name'=>t('nav.fleet')],
      ['@id'=>'/sedanes-premium','name'=>t('fleet.sedans_p.h1')],
    ],
  ];
  require __DIR__ . '/../views/fleet-sedans-premium.php';
},

// Minivans
'GET /fleet-minivans' => function () {
  $title = t('fleet.minivans.h1');
  $seoData = [
    'title'       => t('fleet.minivans.seo.title'),
    'description' => t('fleet.minivans.seo.desc'),
    'keywords'    => t('fleet.minivans.seo.keywords'),
    'image'       => '/assets/images/fleet/minivans/og-minivans.jpg',
    'breadcrumbs' => [
      ['@id'=>'/', 'name'=>t('nav.home')],
      ['@id'=>'/flota','name'=>t('nav.fleet')],
      ['@id'=>'/fleet-minivans','name'=>t('fleet.minivans.h1')],
    ],
  ];
  require __DIR__ . '/../views/fleet-minivans.php';
},
'GET /minivans' => function () { // alias ES
  $title = t('fleet.minivans.h1');
  $seoData = [
    'title'       => t('fleet.minivans.seo.title'),
    'description' => t('fleet.minivans.seo.desc'),
    'keywords'    => t('fleet.minivans.seo.keywords'),
    'image'       => '/assets/images/fleet/minivans/og-minivans.jpg',
    'breadcrumbs' => [
      ['@id'=>'/', 'name'=>t('nav.home')],
      ['@id'=>'/flota','name'=>t('nav.fleet')],
      ['@id'=>'/minivans','name'=>t('fleet.minivans.h1')],
    ],
  ];
  require __DIR__ . '/../views/fleet-minivans.php';
},

// Premium Minivans
'GET /fleet-minivans-premium' => function () {
  $title = t('fleet.minivans_p.h1');
  $seoData = [
    'title'       => t('fleet.minivans_p.seo.title'),
    'description' => t('fleet.minivans_p.seo.desc'),
    'keywords'    => t('fleet.minivans_p.seo.keywords'),
    'image'       => '/assets/images/fleet/minivans-premium/og-minivans-premium.jpg',
    'breadcrumbs' => [
      ['@id'=>'/', 'name'=>t('nav.home')],
      ['@id'=>'/flota','name'=>t('nav.fleet')],
      ['@id'=>'/fleet-minivans-premium','name'=>t('fleet.minivans_p.h1')],
    ],
  ];
  require __DIR__ . '/../views/fleet-minivans-premium.php';
},
'GET /minivans-premium' => function () { // alias ES
  $title = t('fleet.minivans_p.h1');
  $seoData = [
    'title'       => t('fleet.minivans_p.seo.title'),
    'description' => t('fleet.minivans_p.seo.desc'),
    'keywords'    => t('fleet.minivans_p.seo.keywords'),
    'image'       => '/assets/images/fleet/minivans-premium/og-minivans-premium.jpg',
    'breadcrumbs' => [
      ['@id'=>'/', 'name'=>t('nav.home')],
      ['@id'=>'/flota','name'=>t('nav.fleet')],
      ['@id'=>'/minivans-premium','name'=>t('fleet.minivans_p.h1')],
    ],
  ];
  require __DIR__ . '/../views/fleet-minivans-premium.php';
},

// Minibuses
'GET /fleet-minibuses' => function () {
  $title = t('fleet.minibuses.h1');
  $seoData = [
    'title'       => t('fleet.minibuses.seo.title'),
    'description' => t('fleet.minibuses.seo.desc'),
    'keywords'    => t('fleet.minibuses.seo.keywords'),
    'image'       => '/assets/images/fleet/minibuses/og-minibuses.jpg',
    'breadcrumbs' => [
      ['@id'=>'/', 'name'=>t('nav.home')],
      ['@id'=>'/flota','name'=>t('nav.fleet')],
      ['@id'=>'/fleet-minibuses','name'=>t('fleet.minibuses.h1')],
    ],
  ];
  require __DIR__ . '/../views/fleet-minibuses.php';
},
'GET /microbuses' => function () { // alias ES
  $title = t('fleet.minibuses.h1');
  $seoData = [
    'title'       => t('fleet.minibuses.seo.title'),
    'description' => t('fleet.minibuses.seo.desc'),
    'keywords'    => t('fleet.minibuses.seo.keywords'),
    'image'       => '/assets/images/fleet/minibuses/og-minibuses.jpg',
    'breadcrumbs' => [
      ['@id'=>'/', 'name'=>t('nav.home')],
      ['@id'=>'/flota','name'=>t('nav.fleet')],
      ['@id'=>'/microbuses','name'=>t('fleet.minibuses.h1')],
    ],
  ];
  require __DIR__ . '/../views/fleet-minibuses.php';
},

// Coaches
'GET /fleet-coaches' => function () {
  $title = t('fleet.coaches.h1');
  $seoData = [
    'title'       => t('fleet.coaches.seo.title'),
    'description' => t('fleet.coaches.seo.desc'),
    'keywords'    => t('fleet.coaches.seo.keywords'),
    'image'       => '/assets/images/fleet/coaches/og-coaches.jpg',
    'breadcrumbs' => [
      ['@id'=>'/', 'name'=>t('nav.home')],
      ['@id'=>'/flota','name'=>t('nav.fleet')],
      ['@id'=>'/fleet-coaches','name'=>t('fleet.coaches.h1')],
    ],
  ];
  require __DIR__ . '/../views/fleet-coaches.php';
},
'GET /autocares' => function () { // alias ES
  $title = t('fleet.coaches.h1');
  $seoData = [
    'title'       => t('fleet.coaches.seo.title'),
    'description' => t('fleet.coaches.seo.desc'),
    'keywords'    => t('fleet.coaches.seo.keywords'),
    'image'       => '/assets/images/fleet/coaches/og-coaches.jpg',
    'breadcrumbs' => [
      ['@id'=>'/', 'name'=>t('nav.home')],
      ['@id'=>'/flota','name'=>t('nav.fleet')],
      ['@id'=>'/autocares','name'=>t('fleet.coaches.h1')],
    ],
  ];
  require __DIR__ . '/../views/fleet-coaches.php';
},

// Adapted (1–4)
'GET /fleet-adapted-4' => function () {
  $title = t('fleet.adapted4.h1');
  $seoData = [
    'title'       => t('fleet.adapted4.seo.title'),
    'description' => t('fleet.adapted4.seo.desc'),
    'keywords'    => t('fleet.adapted4.seo.keywords'),
    'image'       => '/assets/images/fleet/adapted-4/og-adapted-4.jpg',
    'breadcrumbs' => [
      ['@id'=>'/', 'name'=>t('nav.home')],
      ['@id'=>'/flota','name'=>t('nav.fleet')],
      ['@id'=>'/fleet-adapted-4','name'=>t('fleet.adapted4.h1')],
    ],
  ];
  require __DIR__ . '/../views/fleet-adapted-4.php';
},
'GET /adaptados-4' => function () { // alias ES
  $title = t('fleet.adapted4.h1');
  $seoData = [
    'title'       => t('fleet.adapted4.seo.title'),
    'description' => t('fleet.adapted4.seo.desc'),
    'keywords'    => t('fleet.adapted4.seo.keywords'),
    'image'       => '/assets/images/fleet/adapted-4/og-adapted-4.jpg',
    'breadcrumbs' => [
      ['@id'=>'/', 'name'=>t('nav.home')],
      ['@id'=>'/flota','name'=>t('nav.fleet')],
      ['@id'=>'/adaptados-4','name'=>t('fleet.adapted4.h1')],
    ],
  ];
  require __DIR__ . '/../views/fleet-adapted-4.php';
},

// Adapted (up to 8)
'GET /fleet-adapted-8' => function () {
  $title = t('fleet.adapted8.h1');
  $seoData = [
    'title'       => t('fleet.adapted8.seo.title'),
    'description' => t('fleet.adapted8.seo.desc'),
    'keywords'    => t('fleet.adapted8.seo.keywords'),
    'image'       => '/assets/images/fleet/adapted-8/og-adapted-8.jpg',
    'breadcrumbs' => [
      ['@id'=>'/', 'name'=>t('nav.home')],
      ['@id'=>'/flota','name'=>t('nav.fleet')],
      ['@id'=>'/fleet-adapted-8','name'=>t('fleet.adapted8.h1')],
    ],
  ];
  require __DIR__ . '/../views/fleet-adapted-8.php';
},
'GET /adaptados-8' => function () { // alias ES
  $title = t('fleet.adapted8.h1');
  $seoData = [
    'title'       => t('fleet.adapted8.seo.title'),
    'description' => t('fleet.adapted8.seo.desc'),
    'keywords'    => t('fleet.adapted8.seo.keywords'),
    'image'       => '/assets/images/fleet/adapted-8/og-adapted-8.jpg',
    'breadcrumbs' => [
      ['@id'=>'/', 'name'=>t('nav.home')],
      ['@id'=>'/flota','name'=>t('nav.fleet')],
      ['@id'=>'/adaptados-8','name'=>t('fleet.adapted8.h1')],
    ],
  ];
  require __DIR__ . '/../views/fleet-adapted-8.php';
},
'POST /quote' => function () {
  $origin_address      = $_POST['origin_address'] ?? '';
  $destination_address = $_POST['destination_address'] ?? '';
  $distance_m          = (int)($_POST['distance_m'] ?? 0);
  $duration_s          = (int)($_POST['duration_s'] ?? 0);

  $km      = max(0, $distance_m / 1000);
  $minutes = max(0, $duration_s / 60);

  // calcula $quotes igual que en public/quote.php (o saca a helper)

  require __DIR__ . '/../views/quote.php';
},

];

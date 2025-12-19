<?php
/**
 * routes.php
 * - Añade $redirect301 (antes no existía y te podía romper)
 * - Añade $require_view para evitar 500 “a ciegas” cuando falte una vista
 */

$redirect301 = function (string $to) {
  header('Location: ' . $to, true, 301);
  exit;
};

$require_view = function (string $relativePathFromViews) {
  $full = __DIR__ . '/../views/' . ltrim($relativePathFromViews, '/');

  // Si la vista no existe, en vez de un 500 sin info, te lo mostramos claro.
  if (!is_file($full)) {
    http_response_code(500);
    echo "VIEW NOT FOUND: " . htmlspecialchars($full);
    exit;
  }

  require $full;
};

return [

  'GET /' => function () use ($require_view) {
    $title   = t('home.title_short');
    $seoData = [
      'title'       => t('home.seo.title'),
      'description' => t('home.seo.desc'),
      'image'       => '/assets/logo-og.png',
      'keywords'    => t('home.seo.keywords'),
    ];
    $require_view('home.php');
  },

  'GET /nosotros' => function () use ($require_view) {
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
    $require_view('about.php');
  },

  'GET /panel' => function () {
    $title   = t('panel.title_short');
    $seoData = [
      'title'       => t('panel.seo.title'),
      'description' => t('panel.seo.desc'),
      'keywords'    => t('panel.seo.keywords'),
      'image'       => '/assets/logo-og.png',
      'breadcrumbs' => [
        ['@id'=>'/',             'name'=>t('nav.home')],
        ['@id'=>'/admin',        'name'=>t('nav.home')],
        ['@id'=>'/admin/login',  'name'=>t('panel.h1')],
      ],
    ];
    // Lo dejo tal cual lo tenías
    require __DIR__ . '/admin/login.php';
  },

  'GET /servicios' => function () {
    header('Location: /servicios/traslados', true, 301);
    exit;
  },

  /* =========================
     LEGAL (URLs limpias)
  ========================= */

  'GET /privacy-policy' => function () use ($require_view) {
    $title   = t('footer.legal.privacy');
    $seoData = [
      'title'       => $title,
      'description' => $title,
      'image'       => '/assets/logo-og.png',
      'breadcrumbs' => [
        ['@id'=>'/',               'name'=>t('nav.home')],
        ['@id'=>'/privacy-policy', 'name'=>t('footer.legal.privacy')],
      ],
    ];
    $require_view('legal/privacy-policy.php');
  },

  'GET /terms-and-conditions' => function () use ($require_view) {
    $title   = t('footer.legal.terms');
    $seoData = [
      'title'       => $title,
      'description' => $title,
      'image'       => '/assets/logo-og.png',
      'breadcrumbs' => [
        ['@id'=>'/',                     'name'=>t('nav.home')],
        ['@id'=>'/terms-and-conditions', 'name'=>t('footer.legal.terms')],
      ],
    ];
    $require_view('legal/terms-and-conditions.php');
  },

  'GET /cookies-policy' => function () use ($require_view) {
    $title   = t('footer.legal.cookies');
    $seoData = [
      'title'       => $title,
      'description' => $title,
      'image'       => '/assets/logo-og.png',
      'breadcrumbs' => [
        ['@id'=>'/',               'name'=>t('nav.home')],
        ['@id'=>'/cookies-policy', 'name'=>t('footer.legal.cookies')],
      ],
    ];
    $require_view('legal/cookies-policy.php');
  },

  'GET /security-policy' => function () use ($require_view) {
    $title   = t('footer.legal.security');
    $seoData = [
      'title'       => $title,
      'description' => $title,
      'image'       => '/assets/logo-og.png',
      'breadcrumbs' => [
        ['@id'=>'/',                'name'=>t('nav.home')],
        ['@id'=>'/security-policy', 'name'=>t('footer.legal.security')],
      ],
    ];
    $require_view('legal/security-policy.php');
  },

  'GET /payment-policy' => function () use ($require_view) {
    $title   = t('footer.legal.payment');
    $seoData = [
      'title'       => $title,
      'description' => $title,
      'image'       => '/assets/logo-og.png',
      'breadcrumbs' => [
        ['@id'=>'/',               'name'=>t('nav.home')],
        ['@id'=>'/payment-policy', 'name'=>t('footer.legal.payment')],
      ],
    ];
    $require_view('legal/payment-policy.php');
  },

  'GET /anti-fraud-policy' => function () use ($require_view) {
    $title   = t('footer.legal.antifraud');
    $seoData = [
      'title'       => $title,
      'description' => $title,
      'image'       => '/assets/logo-og.png',
      'breadcrumbs' => [
        ['@id'=>'/',                  'name'=>t('nav.home')],
        ['@id'=>'/anti-fraud-policy', 'name'=>t('footer.legal.antifraud')],
      ],
    ];
    $require_view('legal/anti-fraud-policy.php');
  },

  'GET /regulatory-compliance' => function () use ($require_view) {
    $title   = t('footer.legal.compliance');
    $seoData = [
      'title'       => $title,
      'description' => $title,
      'image'       => '/assets/logo-og.png',
      'breadcrumbs' => [
        ['@id'=>'/',                      'name'=>t('nav.home')],
        ['@id'=>'/regulatory-compliance', 'name'=>t('footer.legal.compliance')],
      ],
    ];
    $require_view('legal/regulatory-compliance.php');
  },

  'GET /communication-policy' => function () use ($require_view) {
    $title   = t('footer.legal.communication');
    $seoData = [
      'title'       => $title,
      'description' => $title,
      'image'       => '/assets/logo-og.png',
      'breadcrumbs' => [
        ['@id'=>'/',                    'name'=>t('nav.home')],
        ['@id'=>'/communication-policy','name'=>t('footer.legal.communication')],
      ],
    ];
    $require_view('legal/communication-policy.php');
  },

  'GET /data-retention-policy' => function () use ($require_view) {
    $title   = t('footer.legal.retention');
    $seoData = [
      'title'       => $title,
      'description' => $title,
      'image'       => '/assets/logo-og.png',
      'breadcrumbs' => [
        ['@id'=>'/',                     'name'=>t('nav.home')],
        ['@id'=>'/data-retention-policy','name'=>t('footer.legal.retention')],
      ],
    ];
    $require_view('legal/data-retention-policy.php');
  },

  'GET /acceptable-use-policy' => function () use ($require_view) {
    $title   = t('footer.legal.acceptable');
    $seoData = [
      'title'       => $title,
      'description' => $title,
      'image'       => '/assets/logo-og.png',
      'breadcrumbs' => [
        ['@id'=>'/',                     'name'=>t('nav.home')],
        ['@id'=>'/acceptable-use-policy','name'=>t('footer.legal.acceptable')],
      ],
    ];
    $require_view('legal/acceptable-use-policy.php');
  },

  /* =========================
     LEGAL (compatibilidad .php antiguos -> 301)
  ========================= */

  'GET /Privacy-policy.php' => function () use ($redirect301) { $redirect301('/privacy-policy'); },
  'GET /Terms&conditions.php' => function () use ($redirect301) { $redirect301('/terms-and-conditions'); },
  'GET /Cookies-Policy.php' => function () use ($redirect301) { $redirect301('/cookies-policy'); },
  'GET /Security-policy.php' => function () use ($redirect301) { $redirect301('/security-policy'); },
  'GET /Payment-policy.php' => function () use ($redirect301) { $redirect301('/payment-policy'); },
  'GET /Anti-fraud-policy.php' => function () use ($redirect301) { $redirect301('/anti-fraud-policy'); },
  'GET /Regulatory-compliance.php' => function () use ($redirect301) { $redirect301('/regulatory-compliance'); },
  'GET /Communication-Policy.php' => function () use ($redirect301) { $redirect301('/communication-policy'); },
  'GET /Data-Retention-Policy.php' => function () use ($redirect301) { $redirect301('/data-retention-policy'); },
  'GET /Acceptable-Use-Policy.php' => function () use ($redirect301) { $redirect301('/acceptable-use-policy'); },

  /* =========================
     SERVICIOS
  ========================= */

  'GET /servicios/traslados' => function () use ($require_view) {
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
    $require_view('servicios/transfers.php');
  },

  'GET /flota' => function () use ($require_view) {
    $title   = t('flota.title_short');
    $seoData = [
      'title'       => t('flota.seo.title'),
      'description' => t('flota.seo.desc'),
      'keywords'    => t('flota.seo.keywords'),
      'image'       => '/assets/logo-og.png',
      'breadcrumbs' => [
        ['@id'=>'/',         'name'=>t('nav.home')],
        ['@id'=>'/flota',    'name'=>t('flota.h1')],
      ],
    ];
    $require_view('flota.php');
  },

  'GET /servicios/excursiones' => function () use ($require_view) {
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
    $require_view('servicios/excursiones.php');
  },

  'GET /servicios/excursiones/nerja-frigiliana' => function () use ($require_view) {
    $title   = t('excursions.nerja.title_short');
    $seoData = [
      'title'       => t('excursions.nerja.seo.title'),
      'description' => t('excursions.nerja.seo.desc'),
      'keywords'    => t('excursions.nerja.seo.keywords'),
      'image'       => '/assets/logo-og.png', // (tenías //assets..., lo normal es /assets)
      'canonical'   => '/servicios/excursiones/nerja-frigiliana',
      'breadcrumbs' => [
        ['@id'=>'/', 'name'=>t('nav.home')],
        ['@id'=>'/servicios', 'name'=>t('nav.services')],
        ['@id'=>'/servicios/excursiones', 'name'=>t('excursions.h1')],
        ['@id'=>'/servicios/excursiones/nerja-frigiliana', 'name'=>t('excursions.nerja.h1')],
      ],
    ];
    $require_view('servicios/excursiones/nerja-frigiliana.php');
  },

  'GET /servicios/excursiones/ronda-setenil' => function () use ($require_view) {
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
    $require_view('servicios/excursiones/ronda-setenil.php');
  },

  'GET /servicios/excursiones/granada-albaicin' => function () use ($require_view) {
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
    $require_view('servicios/excursiones/granada-albaicin.php');
  },

  'GET /servicios/excursiones/cordoba' => function () use ($require_view) {
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
    $require_view('servicios/excursiones/cordoba.php');
  },

  'GET /servicios/excursiones/sevilla' => function () use ($require_view) {
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
    $require_view('servicios/excursiones/sevilla.php');
  },

  'GET /servicios/excursiones/cadiz' => function () use ($require_view) {
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
    $require_view('servicios/excursiones/cadiz.php');
  },

  'GET /servicios/visitas-guiadas' => function () use ($require_view) {
    $title   = t('guided.title_short');
    $seoData = [
      'title'       => t('guided.seo.title'),
      'description' => t('guided.seo.desc'),
      'keywords'    => t('guided.seo.keywords'),
      'image'       => '/assets/logo-og.png',
      'breadcrumbs' => [
        ['@id'=>'/',                        'name'=>t('nav.home')],
        ['@id'=>'/servicios',               'name'=>t('nav.services')],
        ['@id'=>'/servicios/visitas-guiadas','name'=>t('guided.h1')],
      ],
    ];
    $require_view('servicios/visitas-guiadas.php');
  },

  'GET /servicios/visitas-guiadas/cordoba' => function () use ($require_view) {
    $title = t('guided.cordoba.title_short');
    $seoData = [
      'title'       => t('guided.cordoba.seo.title'),
      'description' => t('guided.cordoba.seo.desc'),
      'keywords'    => t('guided.cordoba.seo.keywords'),
      'image'       => '/assets/images/excursiones/cordoba/og-cordoba.jpg',
      'breadcrumbs' => [
        ['@id'=>'/',                         'name'=>t('nav.home')],
        ['@id'=>'/servicios',                'name'=>t('nav.services')],
        ['@id'=>'/servicios/visitas-guiadas','name'=>t('nav.services.guided')],
        ['@id'=>'/servicios/visitas-guiadas/cordoba','name'=>t('guided.cordoba.h1')],
      ],
    ];
    $require_view('servicios/visitas-guiadas/cordoba.php');
  },

  'GET /servicios/visitas-guiadas/gibraltar' => function () use ($require_view) {
    $title = t('guided.gibraltar.title_short');
    $seoData = [
      'title'       => t('guided.gibraltar.seo.title'),
      'description' => t('guided.gibraltar.seo.desc'),
      'keywords'    => t('guided.gibraltar.seo.keywords'), // (tenías gibraltgar)
      'image'       => '/assets/images/excursiones/gibraltar/og-cgibraltar.jpg',
      'breadcrumbs' => [
        ['@id'=>'/',                         'name'=>t('nav.home')],
        ['@id'=>'/servicios',                'name'=>t('nav.services')],
        ['@id'=>'/servicios/visitas-guiadas','name'=>t('nav.services.guided')],
        ['@id'=>'/servicios/visitas-guiadas/gibraltar','name'=>t('guided.gibraltar.h1')],
      ],
    ];
    $require_view('servicios/visitas-guiadas/gibraltar.php');
  },

  'GET /servicios/visitas-guiadas/granada-alhambra' => function () use ($require_view) {
    $title = t('guided.alhambra.title_short');
    $seoData = [
      'title'       => t('guided.alhambra.seo.title'),
      'description' => t('guided.alhambra.seo.desc'),
      'keywords'    => t('guided.alhambra.seo.keywords'),
      'image'       => '/assets/images/excursiones/alhambra/og-calhambra.jpg',
      'breadcrumbs' => [
        ['@id'=>'/',                         'name'=>t('nav.home')],
        ['@id'=>'/servicios',                'name'=>t('nav.services')],
        ['@id'=>'/servicios/visitas-guiadas','name'=>t('nav.services.guided')],
        ['@id'=>'/servicios/visitas-guiadas/alhambra','name'=>t('guided.alhambra.h1')],
      ],
    ];
    $require_view('servicios/visitas-guiadas/granada-alhambra.php');
  },

  'GET /servicios/visitas-guiadas/granada-city' => function () use ($require_view) {
    $title = t('guided.granada-city.title_short');
    $seoData = [
      'title'       => t('guided.granada-city.seo.title'),
      'description' => t('guided.granada-city.seo.desc'),
      'keywords'    => t('guided.granada-city.seo.keywords'),
      'image'       => '/assets/images/excursiones/granada/og-cgranada-city.jpg',
      'breadcrumbs' => [
        ['@id'=>'/',                         'name'=>t('nav.home')],
        ['@id'=>'/servicios',                'name'=>t('nav.services')],
        ['@id'=>'/servicios/visitas-guiadas','name'=>t('nav.services.guided')],
        ['@id'=>'/servicios/visitas-guiadas/granada-city','name'=>t('guided.granada-city.h1')],
      ],
    ];
    $require_view('servicios/visitas-guiadas/granada-city.php');
  },

  'GET /servicios/visitas-guiadas/malaga' => function () use ($require_view) {
    $title = t('guided.malaga.title_short');
    $seoData = [
      'title'       => t('guided.malaga.seo.title'),
      'description' => t('guided.malaga.seo.desc'),
      'keywords'    => t('guided.malaga.seo.keywords'),
      'image'       => '/assets/images/excursiones/malaga/og-cmalaga-city.jpg',
      'breadcrumbs' => [
        ['@id'=>'/',                         'name'=>t('nav.home')],
        ['@id'=>'/servicios',                'name'=>t('nav.services')],
        ['@id'=>'/servicios/visitas-guiadas','name'=>t('nav.services.guided')],
        ['@id'=>'/servicios/visitas-guiadas/malaga','name'=>t('guided.malaga.h1')],
      ],
    ];
    $require_view('servicios/visitas-guiadas/malaga.php');
  },

  'GET /servicios/visitas-guiadas/ronda' => function () use ($require_view) {
    $title = t('guided.ronda.title_short');
    $seoData = [
      'title'       => t('guided.ronda.seo.title'),
      'description' => t('guided.ronda.seo.desc'),
      'keywords'    => t('guided.ronda.seo.keywords'),
      'image'       => '/assets/images/excursiones/ronda/og-cronda.jpg',
      'breadcrumbs' => [
        ['@id'=>'/',                         'name'=>t('nav.home')],
        ['@id'=>'/servicios',                'name'=>t('nav.services')],
        ['@id'=>'/servicios/visitas-guiadas','name'=>t('nav.services.guided')],
        ['@id'=>'/servicios/visitas-guiadas/ronda','name'=>t('guided.ronda.h1')],
      ],
    ];
    $require_view('servicios/visitas-guiadas/ronda.php');
  },

  'GET /servicios/visitas-guiadas/sevilla-alcazar-catedral' => function () use ($require_view) {
    $title = t('guided.sevilla-alcazar-catedral.title_short');
    $seoData = [
      'title'       => t('guided.sevilla-alcazar-catedral.seo.title'),
      'description' => t('guided.sevilla-alcazar-catedral.seo.desc'),
      'keywords'    => t('guided.sevilla-alcazar-catedral.seo.keywords'),
      'image'       => '/assets/images/excursiones/sevilla-essential/og-csevilla-alcazar-catedral.jpg',
      'breadcrumbs' => [
        ['@id'=>'/',                         'name'=>t('nav.home')],
        ['@id'=>'/servicios',                'name'=>t('nav.services')],
        ['@id'=>'/servicios/visitas-guiadas','name'=>t('nav.services.guided')],
        ['@id'=>'/servicios/visitas-guiadas/sevilla-alcazar-catedral','name'=>t('guided.sevilla-alcazar-catedral.h1')],
      ],
    ];
    $require_view('servicios/visitas-guiadas/sevilla-alcazar-catedral.php');
  },

  'GET /servicios/visitas-guiadas/sevilla-essential' => function () use ($require_view) {
    $title = t('guided.sevilla-essential.title_short');
    $seoData = [
      'title'       => t('guided.sevilla-essential.seo.title'),
      'description' => t('guided.sevilla-essential.seo.desc'),
      'keywords'    => t('guided.sevilla-essential.seo.keywords'),
      'image'       => '/assets/images/excursiones/sevilla-essential/og-csevilla-essential.jpg',
      'breadcrumbs' => [
        ['@id'=>'/',                         'name'=>t('nav.home')],
        ['@id'=>'/servicios',                'name'=>t('nav.services')],
        ['@id'=>'/servicios/visitas-guiadas','name'=>t('nav.services.guided')],
        ['@id'=>'/servicios/visitas-guiadas/sevilla-essential','name'=>t('guided.sevilla-essential.h1')],
      ],
    ];
    $require_view('servicios/visitas-guiadas/sevilla-essential.php');
  },

  /* =========================
     FLEET (tu bloque tal cual, pero pasando por $require_view)
  ========================= */

  'GET /fleet-sedans' => function () use ($require_view) { $require_view('fleet-sedans.php'); },

  'GET /sedanes' => function () use ($require_view) {
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
    $require_view('fleet-sedans.php');
  },

  'GET /fleet-sedans-premium' => function () use ($require_view) { $require_view('fleet-sedans-premium.php'); },

  'GET /sedanes-premium' => function () use ($require_view) {
    $title = t('fleet.sedans_p.h1');
    $seoData = [
      'title'       => t('fleet.sedans_p.seo.title'),
      'description' => t('fleet.sedans_p.seo.desc'),
      'keywords'    => t('fleet.sedans_p.seo.keywords'),
      'image'       => '/assets/images/fleet/sedans-premium/og-sedans-premium.jpg',
      'breadcrumbs' => [
        ['@id'=>'/',                'name'=>t('nav.home')],
        ['@id'=>'/flota',           'name'=>t('nav.fleet')],
        ['@id'=>'/sedanes-premium', 'name'=>t('fleet.sedans_p.h1')],
      ],
    ];
    $require_view('fleet-sedans-premium.php');
  },

  'GET /fleet-minivans' => function () use ($require_view) { $require_view('fleet-minivans.php'); },

  'GET /minivans' => function () use ($require_view) {
    $title = t('fleet.minivans.h1');
    $seoData = [
      'title'       => t('fleet.minivans.seo.title'),
      'description' => t('fleet.minivans.seo.desc'),
      'keywords'    => t('fleet.minivans.seo.keywords'),
      'image'       => '/assets/images/fleet/minivans/og-minivans.jpg',
      'breadcrumbs' => [
        ['@id'=>'/',        'name'=>t('nav.home')],
        ['@id'=>'/flota',   'name'=>t('nav.fleet')],
        ['@id'=>'/minivans','name'=>t('fleet.minivans.h1')],
      ],
    ];
    $require_view('fleet-minivans.php');
  },

  'GET /fleet-minivans-premium' => function () use ($require_view) { $require_view('fleet-minivans-premium.php'); },

  'GET /minivans-premium' => function () use ($require_view) {
    $title = t('fleet.minivans_p.h1');
    $seoData = [
      'title'       => t('fleet.minivans_p.seo.title'),
      'description' => t('fleet.minivans_p.seo.desc'),
      'keywords'    => t('fleet.minivans_p.seo.keywords'),
      'image'       => '/assets/images/fleet/minivans-premium/og-minivans-premium.jpg',
      'breadcrumbs' => [
        ['@id'=>'/',                'name'=>t('nav.home')],
        ['@id'=>'/flota',           'name'=>t('nav.fleet')],
        ['@id'=>'/minivans-premium','name'=>t('fleet.minivans_p.h1')],
      ],
    ];
    $require_view('fleet-minivans-premium.php');
  },

  'GET /fleet-minibuses' => function () use ($require_view) { $require_view('fleet-minibuses.php'); },

  'GET /microbuses' => function () use ($require_view) {
    $title = t('fleet.minibuses.h1');
    $seoData = [
      'title'       => t('fleet.minibuses.seo.title'),
      'description' => t('fleet.minibuses.seo.desc'),
      'keywords'    => t('fleet.minibuses.seo.keywords'),
      'image'       => '/assets/images/fleet/minibuses/og-minibuses.jpg',
      'breadcrumbs' => [
        ['@id'=>'/',           'name'=>t('nav.home')],
        ['@id'=>'/flota',      'name'=>t('nav.fleet')],
        ['@id'=>'/microbuses', 'name'=>t('fleet.minibuses.h1')],
      ],
    ];
    $require_view('fleet-minibuses.php');
  },

  'GET /fleet-coaches' => function () use ($require_view) { $require_view('fleet-coaches.php'); },

  'GET /autocares' => function () use ($require_view) {
    $title = t('fleet.coaches.h1');
    $seoData = [
      'title'       => t('fleet.coaches.seo.title'),
      'description' => t('fleet.coaches.seo.desc'),
      'keywords'    => t('fleet.coaches.seo.keywords'),
      'image'       => '/assets/images/fleet/coaches/og-coaches.jpg',
      'breadcrumbs' => [
        ['@id'=>'/',         'name'=>t('nav.home')],
        ['@id'=>'/flota',    'name'=>t('nav.fleet')],
        ['@id'=>'/autocares','name'=>t('fleet.coaches.h1')],
      ],
    ];
    $require_view('fleet-coaches.php');
  },

  'GET /fleet-adapted-4' => function () use ($require_view) { $require_view('fleet-adapted-4.php'); },

  'GET /adaptados-4' => function () use ($require_view) {
    $title = t('fleet.adapted4.h1');
    $seoData = [
      'title'       => t('fleet.adapted4.seo.title'),
      'description' => t('fleet.adapted4.seo.desc'),
      'keywords'    => t('fleet.adapted4.seo.keywords'),
      'image'       => '/assets/images/fleet/adapted-4/og-adapted-4.jpg',
      'breadcrumbs' => [
        ['@id'=>'/',            'name'=>t('nav.home')],
        ['@id'=>'/flota',       'name'=>t('nav.fleet')],
        ['@id'=>'/adaptados-4', 'name'=>t('fleet.adapted4.h1')],
      ],
    ];
    $require_view('fleet-adapted-4.php');
  },

  'GET /fleet-adapted-8' => function () use ($require_view) { $require_view('fleet-adapted-8.php'); },

  'GET /adaptados-8' => function () use ($require_view) {
    $title = t('fleet.adapted8.h1');
    $seoData = [
      'title'       => t('fleet.adapted8.seo.title'),
      'description' => t('fleet.adapted8.seo.desc'),
      'keywords'    => t('fleet.adapted8.seo.keywords'),
      'image'       => '/assets/images/fleet/adapted-8/og-adapted-8.jpg',
      'breadcrumbs' => [
        ['@id'=>'/',            'name'=>t('nav.home')],
        ['@id'=>'/flota',       'name'=>t('nav.fleet')],
        ['@id'=>'/adaptados-8', 'name'=>t('fleet.adapted8.h1')],
      ],
    ];
    $require_view('fleet-adapted-8.php');
  },

  'POST /quote' => function () use ($require_view) {
    $origin_address      = $_POST['origin_address'] ?? '';
    $destination_address = $_POST['destination_address'] ?? '';
    $distance_m          = (int)($_POST['distance_m'] ?? 0);
    $duration_s          = (int)($_POST['duration_s'] ?? 0);

    $km      = max(0, $distance_m / 1000);
    $minutes = max(0, $duration_s / 60);

    // calcula $quotes igual que en public/quote.php (o saca a helper)
    $require_view('quote.php');
  },

];

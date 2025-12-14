<?php
// Helper para SEO + Social + JSON-LD
function seo_defaults(): array {
  // Ajusta estos defaults a tu marca
  return [
  'site_name'      => 'Transfer Marbell',
  'brand'          => 'Transfer Marbell',
  'locale'         => 'es_ES',
  'base_url'       => 'https://transfermarbell.com',
  'title'          => 'Traslados privados en la Costa del Sol',
  'description'    => 'Reserva tu traslado con conductores profesionales. Puntualidad y confort garantizados.',
  'keywords'       => 'transfer, taxi privado, marbella, aeropuerto, costa del sol',
  'image'          => '/assets/logo.png',         // OG por defecto
  'theme_color'    => '#0ea5e9',
  'twitter'        => '@transfermarbell',
  'favicon_path'   => '/assets/icons',
];

}

function seo_build(array $overrides = []): array {
  $d = array_merge(seo_defaults(), $overrides);
  // título <title> — Brand al final
  $d['full_title'] = isset($d['title']) ? "{$d['title']} | {$d['brand']}" : $d['brand'];
  // URL canónica
  $uri = $_SERVER['REQUEST_URI'] ?? '/';
  $d['canonical'] = rtrim($d['base_url'], '/') . $uri;
  // imagen absoluta para OG/Twitter
  $d['abs_image'] = str_starts_with($d['image'], 'http') ? $d['image'] : rtrim($d['base_url'], '/') . $d['image'];
  return $d;
}

function seo_render_head(array $seo): string {
  $fp = rtrim($seo['favicon_path'], '/');
  ob_start(); ?>
  <title><?= htmlspecialchars($seo['full_title']) ?></title>
  <meta name="description" content="<?= htmlspecialchars($seo['description']) ?>">
  <meta name="keywords" content="<?= htmlspecialchars($seo['keywords']) ?>">
  <link rel="canonical" href="<?= htmlspecialchars($seo['canonical']) ?>">
  <meta name="robots" content="index,follow">
  <meta name="theme-color" content="<?= htmlspecialchars($seo['theme_color']) ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= $fp ?>/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= $fp ?>/favicon-16x16.png">
  <link rel="apple-touch-icon" href="<?= $fp ?>/apple-touch-icon.png">
  <link rel="manifest" href="<?= $fp ?>/site.webmanifest">
  <link rel="mask-icon" href="<?= $fp ?>/safari-pinned-tab.svg" color="<?= htmlspecialchars($seo['theme_color']) ?>">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?= htmlspecialchars($seo['site_name']) ?>">
  <meta property="og:locale" content="<?= htmlspecialchars($seo['locale']) ?>">
  <meta property="og:title" content="<?= htmlspecialchars($seo['full_title']) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($seo['description']) ?>">
  <meta property="og:url" content="<?= htmlspecialchars($seo['canonical']) ?>">
  <meta property="og:image" content="<?= htmlspecialchars($seo['abs_image']) ?>">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="<?= htmlspecialchars($seo['twitter']) ?>">
  <meta name="twitter:title" content="<?= htmlspecialchars($seo['full_title']) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($seo['description']) ?>">
  <meta name="twitter:image" content="<?= htmlspecialchars($seo['abs_image']) ?>">

  <?php
  // JSON-LD: Organization + WebSite + (opcional) BreadcrumbList según ruta
  $org = [
    '@context'=>'https://schema.org', '@type'=>'Organization',
    'name'=>$seo['brand'],
    'url'=>$seo['base_url'],
    'logo'=> rtrim($seo['base_url'],'/') . '/assets/logo.svg',
  ];
  $website = [
    '@context'=>'https://schema.org','@type'=>'WebSite',
    'name'=>$seo['site_name'], 'url'=>$seo['base_url'],
    'potentialAction'=>[
      '@type'=>'SearchAction',
      'target'=>$seo['base_url'].'/buscar?q={search_term_string}',
      'query-input'=>'required name=search_term_string'
    ]
  ];
  ?>
  <script type="application/ld+json"><?= json_encode($org, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script>
  <script type="application/ld+json"><?= json_encode($website, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script>
  <?php return trim(ob_get_clean());
}
if (!empty($seo['breadcrumbs'])):
  $base = rtrim($seo['base_url'], '/');
  $items = [];
  $pos = 1;
  foreach ($seo['breadcrumbs'] as $b) {
    $items[] = ['@type'=>'ListItem','position'=>$pos++,'name'=>$b['name'],'item'=>$base.$b['@id']];
  }
  $bread = ['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>$items];
?>
<script type="application/ld+json"><?= json_encode($bread, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script>
<?php endif; ?>

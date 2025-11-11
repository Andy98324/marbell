<?php
// Tarjetas principales (ajusta paths de imágenes a tu estructura)
$cards = [
  [
    'img'   => '/assets/images/guided/cordoba.jpg',
    'badge' => 'Córdoba',
    'title' => t('guided.cordoba.title'),
    'bullets' => [ t('guided.bullets.pickup'), t('guided.bullets.vehicle'), t('guided.bullets.return'), t('guided.bullets.water') ],
    'cta_href'  => '/servicios/visitas-guiadas/cordoba',
    'cta_label' => t('cta.see_details'),
  ],
  [
    'img'   => '/assets/images/guided/gibraltar.jpg',
    'badge' => 'Gibraltar',
    'title' => t('guided.gibraltar.title'),
    'bullets' => [ t('guided.bullets.pickup'), t('guided.bullets.vehicle'), t('guided.bullets.return'), t('guided.bullets.water') ],
    'cta_href'  => '/servicios/visitas-guiadas/gibraltar',
    'cta_label' => t('cta.see_details'),
  ],
  [
    'img'   => '/assets/images/guided/alhambra.jpg',
    'badge' => 'Granada',
    'title' => t('guided.alhambra.title'),
    'bullets' => [ t('guided.bullets.pickup'), t('guided.bullets.vehicle'), t('guided.bullets.return'), t('guided.bullets.water') ],
    'cta_href'  => '/servicios/visitas-guiadas/granada-alhambra',
    'cta_label' => t('cta.see_details'),
  ],
  [
    'img'   => '/assets/images/guided/granada-city.jpg',
    'badge' => 'Granada',
    'title' => t('guided.granada.title'),
    'bullets' => [ t('guided.bullets.pickup'), t('guided.bullets.vehicle'), t('guided.bullets.return'), t('guided.bullets.water') ],
    'cta_href'  => '/servicios/visitas-guiadas/granada-city',
    'cta_label' => t('cta.see_details'),
  ],
  [
    'img'   => '/assets/images/guided/malaga.jpg',
    'badge' => 'Málaga',
    'title' => t('guided.malaga.title'),
    'bullets' => [ t('guided.bullets.pickup'), t('guided.bullets.vehicle'), t('guided.bullets.return'), t('guided.bullets.water') ],
    'cta_href'  => '/servicios/visitas-guiadas/malaga',
    'cta_label' => t('cta.see_details'),
  ],
  [
    'img'   => '/assets/images/guided/ronda.jpg',
    'badge' => 'Ronda',
    'title' => t('guided.ronda.title'),
    'bullets' => [ t('guided.bullets.pickup'), t('guided.bullets.vehicle'), t('guided.bullets.return'), t('guided.bullets.water') ],
    'cta_href'  => '/servicios/visitas-guiadas/ronda',
    'cta_label' => t('cta.see_details'),
  ],
  [
    'img'   => '/assets/images/guided/sevilla.jpg',
    'badge' => 'Sevilla',
    'title' => t('guided.sevilla.essential'),
    'bullets' => [ t('guided.bullets.pickup'), t('guided.bullets.vehicle'), t('guided.bullets.return'), t('guided.bullets.water') ],
    'cta_href'  => '/servicios/visitas-guiadas/sevilla-essential',
    'cta_label' => t('cta.see_details'),
  ],
  [
    'img'   => '/assets/images/guided/sevilla-alcazar.jpg',
    'badge' => 'Sevilla',
    'title' => t('guided.sevilla.alcazar'),
    'bullets' => [ t('guided.bullets.pickup'), t('guided.bullets.vehicle'), t('guided.bullets.return'), t('guided.bullets.water') ],
    'cta_href'  => '/servicios/visitas-guiadas/sevilla-alcazar-catedral',
    'cta_label' => t('cta.see_details'),
  ],
];

// Helper: marca “Popular” si el slug hace referencia a alhambra/alcazar
function is_popular_tour(array $c): bool {
  $u = strtolower($c['cta_href'] ?? '');
  return str_contains($u, 'alhambra') || str_contains($u, 'alcazar');
}
?>

<!-- HERO -->
<section class="relative overflow-hidden bg-[#0b1220] text-white">
  <div class="absolute inset-0 opacity-20 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>
  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 md:py-20">
    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight"><?= t('guided.h1') ?></h1>
    <p class="mt-3 text-white/80 text-lg leading-relaxed max-w-3xl"><?= t('guided.lead') ?></p>
  </div>
</section>

<!-- GRID -->
<section class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($cards as $i => $c): $popular = is_popular_tour($c); $titleId = 'tour-'.($i+1); ?>
        <article class="group rounded-2xl bg-white ring-1 ring-black/10 shadow-xl overflow-hidden transition hover:-translate-y-0.5 hover:shadow-2xl">
          <!-- media -->
          <a href="<?= htmlspecialchars($c['cta_href']) ?>" class="relative block">
            <img src="<?= htmlspecialchars($c['img']) ?>" alt="<?= htmlspecialchars($c['title']) ?>" class="w-full aspect-[16/9] object-cover transition duration-500 group-hover:scale-[1.03]" loading="lazy">
            <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent"></div>
            <span class="absolute left-4 bottom-4 inline-flex items-center rounded-full bg-white/95 px-3 py-1 text-xs font-semibold text-sky-700 shadow">
              <?= htmlspecialchars($c['badge']) ?>
            </span>
            <?php if ($popular): ?>
              <span class="absolute right-4 top-4 rounded-full bg-amber-400/90 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-zinc-900 shadow">Popular</span>
            <?php endif; ?>
          </a>

          <!-- body -->
          <div class="p-5">
            <h2 id="<?= $titleId ?>" class="text-lg font-bold text-zinc-900"><?= htmlspecialchars($c['title']) ?></h2>
            <ul class="mt-3 space-y-1.5 text-sm text-zinc-700">
              <?php foreach ($c['bullets'] as $b): ?>
                <li class="flex items-start gap-2">
                  <span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-500"></span>
                  <span><?= htmlspecialchars($b) ?></span>
                </li>
              <?php endforeach; ?>
            </ul>

            <a href="<?= htmlspecialchars($c['cta_href']) ?>"
               aria-labelledby="<?= $titleId ?>"
               class="mt-5 inline-flex items-center gap-2 rounded-xl bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500">
              <?= htmlspecialchars($c['cta_label']) ?>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block ml-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
  </svg>
            </a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- JSON-LD ItemList (SEO) -->
<?php
$base = function_exists('seo_defaults') ? (seo_defaults()['base_url'] ?? '') : '';
$itemList = ['@context'=>'https://schema.org','@type'=>'ItemList','itemListElement'=>[]];
foreach ($cards as $i=>$c){
  $url = $base ? $base.$c['cta_href'] : $c['cta_href'];
  $img = $base ? $base.$c['img']      : $c['img'];
  $itemList['itemListElement'][] = [
    '@type'=>'ListItem',
    'position'=>$i+1,
    'url'=>$url,
    'name'=> strip_tags($c['title']),
    'image'=>$img
  ];
}
?>
<script type="application/ld+json"><?= json_encode($itemList, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) ?></script>

<?php


$cards = [
  [
    'img' => '/assets/images/excursiones/nerja-frigiliana.jpg',
    'href'=> '/servicios/excursiones/nerja-frigiliana',
    'badge'=>'Nerja · Frigiliana',
    'title'=> t('excursions.cards.nerja.title'),
    'bullets'=>[
      t('excursions.bullets.pickup'),
      t('excursions.bullets.disposal'),
      t('excursions.bullets.return'),
      t('excursions.bullets.map'),
      t('excursions.bullets.pois'),
      t('excursions.bullets.water'),
    ],
  ],
  [
    'img' => '/assets/images/excursiones/ronda-setenil.jpg',
    'href'=> '/servicios/excurciones/ronda-setenil',
    'badge'=> t('excursions.badges.ronda'),
    'title'=> t('excursions.cards.ronda.title'),
    'bullets'=>[
      t('excursions.bullets.pickup'),
      t('excursions.bullets.disposal'),
      t('excursions.bullets.return'),
      t('excursions.bullets.map'),
      t('excursions.bullets.pois'),
      t('excursions.bullets.water'),
    ],
  ],
  [
    'img' => '/assets/images/excursiones/sevilla.jpg',
    'href'=> '/servicios/excurciones/sevilla',
    'badge'=>'Sevilla',
    'title'=> t('excursions.cards.sevilla.title'),
    'bullets'=>[
      t('excursions.bullets.pickup'),
      t('excursions.bullets.disposal'),
      t('excursions.bullets.return'),
      t('excursions.bullets.map'),
      t('excursions.bullets.pois'),
      t('excursions.bullets.water'),
    ],
  ],
  [
    'img' => '/assets/images/excursiones/granada-albaicin.jpg',
    'href'=> '/servicios/excurciones/granada-albaicin',
    'badge'=> t('excursions.badges.granada'),
    'title'=> t('excursions.cards.granada.title'),
    'bullets'=>[
      t('excursions.bullets.pickup'),
      t('excursions.bullets.disposal'),
      t('excursions.bullets.return'),
      t('excursions.bullets.map'),
      t('excursions.bullets.pois'),
      t('excursions.bullets.water'),
    ],
  ],
  [
    'img' => '/assets/images/excursiones/cadiz.jpg',
    'href'=> '/servicios/excurciones/cadiz',
    'badge'=>'Cádiz',
    'title'=> t('excursions.cards.cadiz.title'),
    'bullets'=>[
      t('excursions.bullets.pickup'),
      t('excursions.bullets.disposal'),
      t('excursions.bullets.return'),
      t('excursions.bullets.map'),
      t('excursions.bullets.pois'),
      t('excursions.bullets.water'),
    ],
  ],
  [
    'img' => '/assets/images/excursiones/cordoba.jpg',
    'href'=> '/servicios/excurciones/cordoba',
    'badge'=>'Córdoba',
    'title'=> t('excursions.cards.cordoba.title'),
    'bullets'=>[
      t('excursions.bullets.pickup'),
      t('excursions.bullets.disposal'),
      t('excursions.bullets.return'),
      t('excursions.bullets.map'),
      t('excursions.bullets.pois'),
      t('excursions.bullets.water'),
    ],
  ],
];
function fix_exc_url(string $href): string {
  return str_replace('/excurciones/', '/excursiones/', $href);
}
?>
<!-- HERO -->
<section class="relative overflow-hidden bg-[#0b1220] text-white">
  <div class="absolute inset-0 opacity-20 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>
  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 md:py-20">
    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight"><?= t('excursions.h1') ?></h1>
    <p class="mt-3 text-white/80 text-lg leading-relaxed max-w-3xl"><?= t('excursions.lead') ?></p>
  </div>
</section>

<!-- TRES BENEFICIOS -->
<section class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-6 md:grid-cols-3">
    <article class="rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6">
      <h2 class="text-xl font-semibold mb-2"><?= t('excursions.box1.title') ?></h2>
      <p class="text-zinc-700 leading-7"><?= t('excursions.box1.text') ?></p>
    </article>
    <article class="rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6">
      <h2 class="text-xl font-semibold mb-2"><?= t('excursions.box2.title') ?></h2>
      <ul class="text-zinc-700 space-y-1">
        <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= t('excursions.box2.flex') ?></span></li>
        <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= t('excursions.box2.personal') ?></span></li>
        <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= t('excursions.box2.comfort') ?></span></li>
      </ul>
    </article>
    <article class="rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6">
      <h2 class="text-xl font-semibold mb-2"><?= t('excursions.box3.title') ?></h2>
      <ul class="text-zinc-700 space-y-1">
        <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= t('excursions.box3.check') ?></span></li>
        <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= t('excursions.box3.design') ?></span></li>
        <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= t('excursions.box3.enjoy') ?></span></li>
      </ul>
    </article>
  </div>
</section>

<!-- GRID DE EXCURSIONES -->
<section class="py-16 bg-zinc-50">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10">
      <h2 class="text-3xl font-bold"><?= t('excursions.main_title') ?></h2>
      <p class="text-zinc-600"><?= t('excursions.main_sub') ?></p>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($cards as $i => $c): 
        $href = fix_exc_url($c['href']); 
      ?>
        <article class="group rounded-2xl bg-white ring-1 ring-black/10 shadow-xl overflow-hidden transition hover:-translate-y-0.5 hover:shadow-2xl">
          <a href="<?= htmlspecialchars($href) ?>" class="relative block">
            <img src="<?= htmlspecialchars($c['img']) ?>" alt="<?= htmlspecialchars($c['title']) ?>" class="w-full aspect-[16/9] object-cover transition duration-500 group-hover:scale-[1.03]" loading="lazy">
            <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent"></div>
            <span class="absolute left-4 bottom-4 inline-flex items-center rounded-full bg-white/95 px-3 py-1 text-xs font-semibold text-sky-700 shadow">
              <?= htmlspecialchars($c['badge']) ?>
            </span>
          </a>

          <div class="p-5">
            <h3 class="text-lg font-bold text-zinc-900">
              <a href="<?= htmlspecialchars($href) ?>" class="hover:underline"><?= htmlspecialchars($c['title']) ?></a>
            </h3>
            <ul class="mt-3 space-y-1.5 text-sm text-zinc-700">
              <?php foreach ($c['bullets'] as $b): ?>
                <li class="flex gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= htmlspecialchars($b) ?></span></li>
              <?php endforeach; ?>
            </ul>
            <a href="<?= htmlspecialchars($href) ?>" class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-sky-700 hover:underline">
              <?= t('cta.see_more') ?>
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
$itemList = ['@context'=>'https://schema.org','@type'=>'ItemList','itemListElement'=>[]];
foreach ($cards as $i=>$c){
  $itemList['itemListElement'][] = [
    '@type'=>'ListItem',
    'position'=>$i+1,
    'url'=> fix_exc_url($c['href']),
    'name'=> strip_tags($c['title']),
    'image'=> $c['img']
  ];
}
?>
<script type="application/ld+json"><?= json_encode($itemList, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) ?></script>
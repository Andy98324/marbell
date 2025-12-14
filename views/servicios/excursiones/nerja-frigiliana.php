
<!-- HERO (Excursión Nerja) -->
<section class="relative overflow-hidden bg-[#0b1220] text-white rounded-3xl">
  <div class="absolute inset-0 opacity-25 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2
                bg-gradient-to-br from-sky-500/30 via-transparent to-transparent
                rounded-full blur-3xl"></div>
  </div>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-14 md:py-18">
    <div class="rounded-3xl border border-white/15 bg-white/10 backdrop-blur-md shadow-2xl overflow-hidden">
      <div class="absolute inset-0 pointer-events-none opacity-25
                  bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.20)_0%,rgba(255,255,255,0.00)_55%)]"></div>

      <div class="relative p-7 md:p-10">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">
          <?= t('excursions.nerja.h1') ?>
        </h1>
        <p class="mt-4 text-white/80 text-lg leading-relaxed max-w-3xl">
          <?= t('excursions.nerja.lead') ?>
        </p>
      </div>
    </div>
  </div>
</section>


<!-- CONTENIDO -->
<section class="py-16 bg-white">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <p class="text-zinc-700 text-lg leading-relaxed mb-12 text-center max-w-3xl mx-auto">
      <?= t('excursions.nerja.text') ?>
    </p>

    <!-- columnas de lugares -->
    <div class="grid gap-10 md:grid-cols-2">
      <div class="rounded-2xl bg-zinc-50 ring-1 ring-black/10 shadow-sm p-6">
        <h2 class="text-2xl font-bold mb-4 text-zinc-900"><?= t('excursions.nerja.nerja.title') ?></h2>
        <ul class="space-y-3 text-zinc-700">
          <li class="flex items-center gap-2"><span>🏖</span><span>Balcón de Europa</span></li>
          <li class="flex items-center gap-2"><span>⛪</span><span>Iglesia del Salvador</span></li>
          <li class="flex items-center gap-2"><span>🌅</span><span>Playa de Burriana</span></li>
          <li class="flex items-center gap-2"><span>🌴</span><span>Parque Verano Azul</span></li>
        </ul>
      </div>

      <div class="rounded-2xl bg-zinc-50 ring-1 ring-black/10 shadow-sm p-6">
        <h2 class="text-2xl font-bold mb-4 text-zinc-900"><?= t('excursions.nerja.frigiliana.title') ?></h2>
        <ul class="space-y-3 text-zinc-700">
          <li class="flex items-center gap-2"><span>🏛</span><span>Calle Real</span></li>
          <li class="flex items-center gap-2"><span>🕍</span><span>Iglesia de San Antonio de Padua</span></li>
          <li class="flex items-center gap-2"><span>💧</span><span>Fuente de las Tres Culturas</span></li>
          <li class="flex items-center gap-2"><span>🏘</span><span>Calle Hernando el Darra</span></li>
        </ul>
      </div>
    </div>

    <!-- CTA -->
    <div class="mt-16 text-center">
      <a href="https://wa.me/34951748494" target="_blank"
         class="relative inline-flex items-center justify-center overflow-hidden rounded-xl bg-sky-600 px-8 py-3 text-lg font-semibold text-white shadow-lg transition hover:bg-sky-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500">
        <span class="relative z-10"><?= t('excursions.nerja.button') ?></span>
        <span class="absolute inset-0 bg-gradient-to-r from-sky-400 via-sky-600 to-sky-400 opacity-0 group-hover:opacity-100 transition-opacity"></span>
      </a>
    </div>

    <!-- Incluye -->
    <div class="mt-12 mx-auto max-w-md">
      <div class="rounded-2xl bg-white ring-1 ring-black/10 shadow-md p-6">
        <h3 class="text-lg font-semibold text-zinc-900 mb-3"><?= t('excursions.nerja.includes.title') ?? 'Incluye:' ?></h3>
        <ul class="text-zinc-700 text-sm space-y-2">
          <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span><?= t('excursions.nerja.includes.map') ?></li>
          <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span><?= t('excursions.nerja.includes.audio') ?></li>
          <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span><?= t('excursions.nerja.includes.transfer') ?></li>
          <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span><?= t('excursions.nerja.includes.assistance') ?></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- JSON-LD -->
<script type="application/ld+json">
<?= json_encode([
  '@context'=>'https://schema.org',
  '@type'=>'TouristTrip',
  'name'=>'Nerja y Frigiliana Excursion',
  'description'=>'Private transfer and self-guided tour from Málaga to Nerja and Frigiliana with Transfer Marbell.',
  'provider'=>[
    '@type'=>'TravelAgency',
    'name'=>'Transfer Marbell',
    'url'=>'https://www.transfermarbell.com'
  ],
  'offers'=>[
    '@type'=>'Offer',
    'priceCurrency'=>'EUR',
    'availability'=>'https://schema.org/InStock',
    'url'=>'https://www.transfermarbell.com/servicios/excursiones/nerja-frigiliana'
  ],
  'image'=>'https://www.transfermarbell.com/assets/images/excursiones/nerja-frigiliana-hero.jpg'
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?>
</script>

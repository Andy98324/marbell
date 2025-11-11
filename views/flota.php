<!-- HERO -->
<section class="relative overflow-hidden bg-[#0b1220] text-white">
  <div class="absolute inset-0 opacity-20 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>
  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 md:py-20">
    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight"><?= t('fleet.h1') ?></h1>
    <p class="mt-3 text-white/80 text-lg leading-relaxed max-w-3xl"><?= t('fleet.lead') ?></p>
  </div>
</section>

<!-- CONTENIDO -->
<section class="py-16 bg-white">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <!-- Grid de tarjetas -->
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">

      <!-- Card helper (reutilizable) -->
      <?php
        $cards = [
          [
            'href' => '/fleet-sedans',
            'img'  => '/assets/images/Skoda.index.png',
            'title'=> t('fleet.cards.sedans.title'),
            'text' => t('fleet.cards.sedans.text'),
            'alt'  => t('fleet.cards.sedans.alt'),
          ],
          [
            'href' => 'fleet-sedans-premium',
            'img'  => '/assets/images/sedan_premium.index.png',
            'title'=> t('fleet.cards.sedans_p.title'),
            'text' => t('fleet.cards.sedans_p.text'),
            'alt'  => t('fleet.cards.sedans_p.alt'),
          ],
          [
            'href' => 'fleet-minivans',
            'img'  => '/assets/images/minivan.index.png',
            'title'=> t('fleet.cards.minivans.title'),
            'text' => t('fleet.cards.minivans.text'),
            'alt'  => t('fleet.cards.minivans.alt'),
          ],
          [
            'href' => 'fleet-minivans-premium',
            'img'  => '/assets/images/minivanP.index.png',
            'title'=> t('fleet.cards.minivans_p.title'),
            'text' => t('fleet.cards.minivans_p.text'),
            'alt'  => t('fleet.cards.minivans_p.alt'),
          ],
          [
            'href' => 'fleet-minibuses',
            'img'  => '/assets/images/microbus.index.png',
            'title'=> t('fleet.cards.minibuses.title'),
            'text' => t('fleet.cards.minibuses.text'),
            'alt'  => t('fleet.cards.minibuses.alt'),
          ],
          [
            'href' => 'fleet-coaches',
            'img'  => '/assets/images/autocar.index.png',
            'title'=> t('fleet.cards.coaches.title'),
            'text' => t('fleet.cards.coaches.text'),
            'alt'  => t('fleet.cards.coaches.alt'),
          ],
          [
            'href' => 'fleet-adapted-4',
            'img'  => '/assets/images/adaptada.index.png',
            'title'=> t('fleet.cards.adapted4.title'),
            'text' => t('fleet.cards.adapted4.text'),
            'alt'  => t('fleet.cards.adapted4.alt'),
          ],
          [
            'href' => 'fleet-adapted-8',
            'img'  => '/assets/images/adaptada.index.png',
            'title'=> t('fleet.cards.adapted8.title'),
            'text' => t('fleet.cards.adapted8.text'),
            'alt'  => t('fleet.cards.adapted8.alt'),
          ],
        ];
        foreach ($cards as $c): ?>
        <a href="<?= htmlspecialchars($c['href']) ?>" class="group block rounded-2xl ring-1 ring-black/10 shadow-xl overflow-hidden bg-white hover:shadow-2xl transition">
          <figure class="relative">
            <img loading="lazy" src="<?= htmlspecialchars($c['img']) ?>" alt="<?= htmlspecialchars($c['alt']) ?>"
                 class="w-full h-44 object-contain bg-zinc-50 transition duration-500 group-hover:scale-[1.02]">
          </figure>
          <div class="p-5">
            <h3 class="text-lg font-semibold text-zinc-900"><?= $c['title'] ?></h3>
            <p class="text-sm text-zinc-600 mt-1"><?= $c['text'] ?></p>
            <div class="mt-4 inline-flex items-center gap-2 text-sky-700 font-medium">
              <span><?= t('fleet.card.cta') ?></span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>

    <!-- Notas + CTA -->
    <div class="mt-12 text-center">
      <p class="text-sm text-zinc-600 mb-6"><?= t('fleet.notes') ?></p>
      <a href="reservas.php" class="relative inline-flex items-center justify-center overflow-hidden rounded-xl bg-sky-600 px-8 py-3 text-lg font-semibold text-white shadow-lg transition hover:bg-sky-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500">
        <span class="relative z-10"><?= t('fleet.cta') ?></span>
      </a>
    </div>

  </div>
</section>

<!-- JSON-LD (opcional) -->
<script type="application/ld+json">
<?= json_encode([
  '@context'=>'https://schema.org',
  '@type'=>'OfferCatalog',
  'name'=> t('fleet.h1'),
  'itemListElement'=>[
    ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>t('fleet.cards.sedans.title')]],
    ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>t('fleet.cards.sedans_p.title')]],
    ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>t('fleet.cards.minivans.title')]],
    ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>t('fleet.cards.minivans_p.title')]],
    ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>t('fleet.cards.minibuses.title')]],
    ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>t('fleet.cards.coaches.title')]],
    ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>t('fleet.cards.adapted4.title')]],
    ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>t('fleet.cards.adapted8.title')]],
  ]
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?>
</script>

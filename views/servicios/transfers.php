<?php
// Ajusta rutas de imágenes según tu estructura
$cards = [
  [
    'img' => '/assets/images/transfers/aeropuerto.jpg',
    'badge' => t('transfers.badge.airport'),
    'title' => t('transfers.airport.title'),
    'bullets' => [
      t('transfers.bullets.pro'),
      t('transfers.bullets.flight_track'),
      t('transfers.bullets.wait60'),
      t('transfers.bullets.fixed'),
    ],
    'cta_href' => '/#goToQuote',
    'cta_label' => t('cta.book_now'),
  ],
  [
    'img' => '/assets/images/transfers/tren.jpg',
    'badge' => t('transfers.badge.train'),
    'title' => t('transfers.train.title'),
    'bullets' => [
      t('transfers.bullets.pro'),
      t('transfers.bullets.train_track'),
      t('transfers.bullets.wait15'),
      t('transfers.bullets.fixed'),
    ],
    'cta_href' => '/#goToQuote',
    'cta_label' => t('cta.book_now'),
  ],
  [
    'img' => '/assets/images/transfers/punto-a-punto.jpg',
    'badge' => t('transfers.badge.p2p'),
    'title' => t('transfers.p2p.title'),
    'bullets' => [
      t('transfers.bullets.pro'),
      t('transfers.bullets.wait15'),
      t('transfers.bullets.fixed'),
    ],
    'cta_href' => '/#goToQuote',
    'cta_label' => t('cta.book_now'),
  ],
  [
    'img' => '/assets/images/transfers/puerto.jpg',
    'badge' => t('transfers.badge.port'),
    'title' => t('transfers.port.title'),
    'bullets' => [
      t('transfers.bullets.pro'),
      t('transfers.bullets.ship_track'),
      t('transfers.bullets.wait15'),
      t('transfers.bullets.fixed'),
    ],
    'cta_href' => '/#goToQuote',
    'cta_label' => t('cta.book_now'),
  ],
  [
    'img' => '/assets/images/transfers/corporativos.jpg',
    'badge' => t('transfers.badge.corporate'),
    'title' => t('transfers.corporate.title'),
    'text' => t('transfers.corporate.text'),
    'cta_href' => '/contacto?asunto=corporativo',
    'cta_label' => t('cta.request_quote'),
  ],
  [
    'img' => '/assets/images/transfers/excursiones.jpg',
    'badge' => t('transfers.badge.excursions'),
    'title' => t('transfers.excursions.title'),
    'bullets' => [
      t('transfers.bullets.pro'),
      t('transfers.bullets.advice'),
      t('transfers.bullets.map'),
      t('transfers.bullets.pois'),
    ],
    'cta_href' => '/#goToQuote',
    'cta_label' => t('cta.see_more'),
  ],
];
?>
<!-- HERO (estilo TransferMarbell) -->
<section class="relative overflow-hidden bg-[#0b1220] text-white rounded-3xl">
  <!-- Glow de fondo -->
  <div class="absolute inset-0 opacity-25 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2
                bg-gradient-to-br from-sky-500/30 via-transparent to-transparent
                rounded-full blur-3xl"></div>
  </div>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-14 md:py-18">
    <!-- Card glass -->
    <div class="rounded-3xl border border-white/15 bg-white/10 backdrop-blur-md shadow-2xl overflow-hidden">
      <div class="absolute inset-0 pointer-events-none opacity-25
                  bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.20)_0%,rgba(255,255,255,0.00)_55%)]"></div>

      <div class="relative p-7 md:p-10">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">
          <?= t('transfers.h1') ?>
        </h1>
        <p class="mt-4 text-white/80 text-lg leading-relaxed max-w-3xl">
          <?= t('transfers.lead') ?>
        </p>
      </div>
    </div>
  </div>
</section>


<!-- GRID DE SERVICIOS -->
<section class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($cards as $idx => $c): 
        $cardId = 'card-'.($idx+1);
        $isPopular = isset($c['cta_href']) && (str_contains($c['cta_href'], 'aeropuerto') || str_contains($c['badge'] ?? '', 'Airport') || str_contains($c['badge'] ?? '', 'Aeropuerto'));
      ?>
        <article class="group rounded-2xl bg-white ring-1 ring-black/10 shadow-xl overflow-hidden transition hover:-translate-y-0.5 hover:shadow-2xl">
          <!-- media -->
          <div class="relative">
            <img src="<?= htmlspecialchars($c['img']) ?>"
                 alt="<?= htmlspecialchars($c['title']) ?>"
                 class="w-full aspect-[16/9] object-cover transition duration-500 group-hover:scale-[1.03]" loading="lazy">
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-black/0 to-transparent"></div>

            <!-- badge principal -->
            <span class="absolute left-4 bottom-4 inline-flex items-center rounded-full bg-white/95 px-3 py-1 text-xs font-semibold text-sky-700 shadow">
              <?= htmlspecialchars($c['badge']) ?>
            </span>

            <!-- popular (auto) -->
            <?php if ($isPopular): ?>
              <span class="absolute right-4 top-4 rounded-full bg-amber-400/90 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-zinc-900 shadow">Popular</span>
            <?php endif; ?>
          </div>

          <!-- body -->
          <div class="p-5">
            <h2 id="<?= $cardId ?>" class="text-lg font-bold text-zinc-900"><?= htmlspecialchars($c['title']) ?></h2>

            <?php if (!empty($c['text'])): ?>
              <p class="mt-2 text-sm text-zinc-700 leading-6"><?= htmlspecialchars($c['text']) ?></p>
            <?php endif; ?>

            <?php if (!empty($c['bullets'])): ?>
              <ul class="mt-3 space-y-1.5 text-sm text-zinc-700">
                <?php foreach ($c['bullets'] as $b): ?>
                  <li class="flex items-start gap-2">
                    <span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-500"></span>
                    <span><?= htmlspecialchars($b) ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>

            <a href="<?= htmlspecialchars($c['cta_href']) ?>"
               aria-labelledby="<?= $cardId ?>"
               class="mt-5 inline-flex items-center gap-2 rounded-xl bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500">
              <?= htmlspecialchars($c['cta_label']) ?>
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13 5l7 7-7 7M5 19V5h8"/></svg>
            </a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php
// Nada aquí arriba
?>


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
          <?= t('fleet.sedans_p.h1') ?>
        </h1>
        <p class="mt-4 text-white/80 text-lg leading-relaxed max-w-3xl">
          <?= t('fleet.sedans_p.lead') ?>
        </p>
      </div>
    </div>
  </div>
</section>
<section class="py-16 bg-white">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="row align-items-center g-4">
      <div class="col-md-6">
        <img src="/assets/images/sedan_premium.index.png" alt="<?= t('fleet.sedans_p.alt') ?>" class="w-100 object-contain bg-light rounded-2xl border shadow">
      </div>
      <div class="col-md-6">
        <h2 class="h4 text-dark mb-3"><?= t('fleet.sedans_p.specs.title') ?></h2>
        <ul class="list-unstyled text-muted">
          <li>• <?= t('fleet.sedans_p.specs.pax') ?></li>
          <li>• <?= t('fleet.sedans_p.specs.lux') ?></li>
          <li>• <?= t('fleet.sedans_p.specs.luggage') ?></li>
        </ul>
        <p class="mt-2 small text-muted"><?= t('fleet.common.disclaimer') ?></p>
      </div>
    </div>

    <div class="mt-5 row g-4">
      <?php foreach (['f1','f2','f3'] as $k): ?>
      <div class="col-md-4">
        <div class="rounded-2xl bg-white border shadow-sm p-4 h-100">
          <h3 class="h6 text-dark mb-1"><?= t("fleet.sedans_p.features.$k.title") ?></h3>
          <p class="text-muted mb-0"><?= t("fleet.sedans_p.features.$k.text") ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="mt-5 row g-4">
      <?php $gallery = [
        ['/assets/images/fleet/sedans_p/01.jpg', t('fleet.sedans_p.gallery.1')],
        ['/assets/images/fleet/sedans_p/02.jpg', t('fleet.sedans_p.gallery.2')],
        ['/assets/images/fleet/sedans_p/03.jpg', t('fleet.sedans_p.gallery.3')],
      ];
      foreach ($gallery as [$src,$alt]): ?>
      <div class="col-md-4">
        <figure class="overflow-hidden rounded-2xl border shadow-sm">
          <img loading="lazy" src="<?= $src ?>" alt="<?= htmlspecialchars($alt) ?>" class="w-100" style="height:220px;object-fit:cover">
        </figure>
      </div>
      <?php endforeach; ?>
    </div>

         <!-- CTA -->
    <div class="mt-5 text-center">
      <a href="/#goToQuote"
         class="inline-flex items-center rounded-full px-6 py-3 text-sm font-semibold text-white bg-sky-600 hover:bg-sky-700 shadow-sm">
        <?= t('fleet.common.cta') ?>
      </a>
    </div>

  </div>
</section>
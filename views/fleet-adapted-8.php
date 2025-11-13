<?php require __DIR__ . '/partials/header.php'; ?>

<!-- HERO -->
<section class="relative overflow-hidden bg-[#0b1220] text-white">
  <div class="absolute inset-0 opacity-20 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>
  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 md:py-20">
    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight"><?= t('fleet.adapted8.h1') ?></h1>
    <p class="mt-3 text-white/80 text-lg leading-relaxed max-w-3xl"><?= t('fleet.adapted8.lead') ?></p>
  </div>
</section>

<!-- CONTENIDO -->
<section class="py-16 bg-white">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <!-- Specs -->
    <div class="row align-items-center g-4">
      <div class="col-md-6">
        <img src="/assets/images/adaptada.index.png"
             alt="<?= t('fleet.adapted8.alt') ?>"
             class="w-100 object-contain bg-light rounded-2xl border shadow">
      </div>
      <div class="col-md-6">
        <h2 class="h4 text-dark mb-3"><?= t('fleet.adapted8.specs.title') ?></h2>
        <ul class="list-unstyled text-muted">
          <li>• <?= t('fleet.adapted8.specs.pax') ?></li>
          <li>• <?= t('fleet.adapted8.specs.luggage') ?></li>
          <li>• <?= t('fleet.adapted8.specs.features') ?></li>
        </ul>
        <p class="mt-2 small text-muted"><?= t('fleet.common.disclaimer') ?></p>
      </div>
    </div>

    <!-- Bloques -->
    <div class="mt-5 row g-4">
      <?php foreach (['f1','f2','f3'] as $k): ?>
        <div class="col-md-4">
          <div class="rounded-2xl bg-white border shadow-sm p-4 h-100">
            <h3 class="h6 text-dark mb-1"><?= t("fleet.adapted8.features.$k.title") ?></h3>
            <p class="text-muted mb-0"><?= t("fleet.adapted8.features.$k.text") ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Galería -->
    <div class="mt-5 row g-4">
      <?php
        $gallery = [
          ['/assets/images/fleet/adapted8/01.jpg', t('fleet.adapted8.gallery.1')],
          ['/assets/images/fleet/adapted8/02.jpg', t('fleet.adapted8.gallery.2')],
          ['/assets/images/fleet/adapted8/03.jpg', t('fleet.adapted8.gallery.3')],
        ];
        foreach ($gallery as [$src,$alt]): ?>
        <div class="col-md-4">
          <figure class="overflow-hidden rounded-2xl border shadow-sm">
            <img loading="lazy" src="<?= $src ?>" alt="<?= htmlspecialchars($alt) ?>"
                 class="w-100" style="height:220px;object-fit:cover">
          </figure>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- CTA -->
    <div class="mt-5 text-center">
      <a href="/#goToQuote" class="btn btn-primary btn-lg px-4">
  <?= t('fleet.common.cta') ?>
</a>

        <?= t('fleet.common.cta') ?>
      </a>
    </div>

  </div>
</section>
<?php require __DIR__ . '/partials/footer.php'; ?>
<?php require __DIR__ . '/layout.php';?>

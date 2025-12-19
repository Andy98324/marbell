<?php
// views/legal/privacy-policy.php

require __DIR__ . '/../partials/header.php';
?>

<!-- HERO -->
<section class="relative overflow-hidden bg-[#0b1220] text-white">
  <div class="absolute inset-0 opacity-20 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 md:py-20">
    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">
      <?= t('legal.privacy.h1') ?>
    </h1>
    <p class="mt-3 text-white/80 text-lg leading-relaxed max-w-3xl">
      <?= t('legal.privacy.lead') ?>
    </p>
  </div>
</section>

<!-- CONTENIDO -->
<section class="py-16 bg-white">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 prose prose-zinc max-w-none">
    <?= t('legal.privacy.content') ?>
  </div>
</section>

<?php
require __DIR__ . '/../partials/footer.php';
?>

<?php // views/quote.php ?>
<section class="relative overflow-hidden bg-[#0b1220] text-white">
  <div class="absolute inset-0 opacity-20 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 md:py-20 text-center">
    <a href="/" class="inline-flex items-center gap-2 text-white/80 hover:text-white transition text-sm mb-4">
      <i class="uil uil-arrow-left"></i> <?= t('action.back') ?>
    </a>

    <img src="/assets/logo.png" alt="<?= t('brand') ?>" class="mx-auto h-24 md:h-28 w-auto mb-5" loading="eager">
    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-3"><?= t('home.fleet_title') ?></h1>

    <p class="text-white/80 text-lg leading-relaxed mb-6">
      <strong><?= t('home.from') ?>:</strong> <?= htmlspecialchars($origin_address) ?> ·
      <strong><?= t('home.to') ?>:</strong> <?= htmlspecialchars($destination_address) ?> ·
      <strong><?= t('home.distance') ?>:</strong> <?= number_format($km, 1) ?> km ·
      <strong><?= t('home.duration') ?>:</strong> <?= round($minutes) ?> min
    </p>
  </div>
</section>

<section class="py-16 bg-zinc-50 text-zinc-900">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold text-center mb-10"><?= t('home.fleet_title') ?></h2>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($quotes as $q): ?>
        <article class="group rounded-2xl bg-white shadow-xl ring-1 ring-black/5 p-5 text-center transition hover:-translate-y-0.5 hover:shadow-2xl">
          <img src="<?= htmlspecialchars($q['img']) ?>" alt="<?= strip_tags($q['name']) ?>" class="mx-auto h-28 object-contain">
          <h3 class="mt-3 font-semibold text-zinc-900"><?= htmlspecialchars($q['name']) ?></h3>
          <p class="text-sm text-zinc-600"><?= htmlspecialchars($q['capacity']) ?></p>
          <div class="mt-4 text-3xl font-extrabold tracking-tight">€<?= number_format($q['price'],0) ?></div>
          <span class="mx-auto mt-3 block h-px w-0 bg-sky-500 group-hover:w-12 transition-all"></span>

          <form action="/booking.php" method="post" class="mt-5 text-left">
            <input type="hidden" name="vehicle_code" value="<?= htmlspecialchars($q['code']) ?>">
            <input type="hidden" name="price" value="<?= htmlspecialchars($q['price']) ?>">
            <input type="hidden" name="origin_address" value="<?= htmlspecialchars($origin_address) ?>">
            <input type="hidden" name="destination_address" value="<?= htmlspecialchars($destination_address) ?>">
            <input type="hidden" name="distance_m" value="<?= htmlspecialchars($distance_m) ?>">
            <input type="hidden" name="duration_s" value="<?= htmlspecialchars($duration_s) ?>">

            <button type="submit"
              class="w-full rounded-xl bg-amber-400 text-zinc-900 font-semibold px-6 py-3 shadow hover:-translate-y-0.5 transition">
              <?= t('home.select') ?>
            </button>
          </form>
        </article>
      <?php endforeach; ?>
    </div>

    <p class="text-xs text-zinc-500 mt-6 text-center">
      * <?= t('home.quote_disclaimer') ?>
    </p>
  </div>
</section>

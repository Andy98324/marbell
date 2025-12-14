<?php
$stats_years = 7;
$team = [
  ['img'=>'/assets/images/team/andres.png',   'name'=>'Andrés Felipe López', 'role'=>t('about.role.ceo')],
  ['img'=>'/assets/images/team/rebeca.png',   'name'=>'Rebeca Martín',       'role'=>t('about.role.sales')],
  ['img'=>'/assets/images/team/cristina.png', 'name'=>'Cristina Bellisco',   'role'=>t('about.role.ops')],
  ['img'=>'/assets/images/team/alejandro.png','name'=>'Alejandro Martínez',  'role'=>t('about.role.dev')],
];
?>

<!-- HERO / ENCABEZADO -->
<section class="relative overflow-hidden bg-[#0b1220] text-white rounded-3xl">
  <!-- Glow de fondo (queda recortado por el radio) -->
  <div class="absolute inset-0 opacity-25 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1100px] h-[1100px] -translate-x-1/2
                bg-gradient-to-br from-sky-500/30 via-transparent to-transparent
                rounded-full blur-3xl"></div>
  </div>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-14 md:py-18">
    <!-- Card principal -->
    <div class="rounded-3xl border border-white/15 bg-white/10 backdrop-blur-md shadow-2xl overflow-hidden">
      <div class="absolute inset-0 pointer-events-none opacity-25
                  bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.20)_0%,rgba(255,255,255,0.00)_55%)]"></div>

      <div class="relative p-7 md:p-10">
        <div class="max-w-3xl">
          <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">
            <?= t('about.h1') ?>
          </h1>
          <p class="mt-4 text-white/80 text-lg leading-relaxed">
            <?= t('about.lead') ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- QUIÉNES SOMOS / MISIÓN -->
<section class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-10 md:grid-cols-2 items-center">
    <div class="order-2 md:order-1">
      <div class="flex items-end gap-3 mb-5">
        <span class="text-5xl md:text-6xl font-black text-sky-600"><?= (int)$stats_years ?></span>
        <span class="text-zinc-600 font-medium leading-tight"><?= t('about.years') ?></span>
      </div>
      <h2 class="text-2xl md:text-3xl font-bold mb-2"><?= t('about.who_title') ?></h2>
      <p class="text-zinc-700 leading-7 mb-6"><?= t('about.who_text') ?></p>

      <div class="rounded-2xl bg-white shadow-xl ring-1 ring-black/10 p-6">
        <h3 class="text-xl font-semibold mb-2"><?= t('about.mission_title') ?></h3>
        <p class="text-zinc-700 leading-7"><?= t('about.mission_text') ?></p>
        <ul class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm text-zinc-600">
          <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= t('about.values.safety') ?></span></li>
          <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= t('about.values.customer') ?></span></li>
          <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= t('about.values.pro') ?></span></li>
          <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= t('about.why.punctual') ?></span></li>
        </ul>
      </div>
    </div>

    <div class="order-1 md:order-2">
      <figure class="rounded-2xl overflow-hidden shadow-2xl ring-1 ring-black/10">
        <img src="/assets/images/about/taxis-malaga.jpg" alt="Transfer en Málaga" class="w-full h-auto object-cover" loading="lazy">
      </figure>
    </div>
  </div>
</section>

<!-- VALORES / DIFERENCIADORES (tarjetas en línea con mega-menu/footer) -->
<section class="py-16 bg-zinc-50">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-6 md:grid-cols-3">
    <article class="rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6">
      <div class="mb-3 flex items-center gap-2">
        <div class="h-8 w-8 rounded-lg bg-zinc-100 grid place-items-center">
          <svg class="h-4 w-4 text-zinc-600" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l4 8 8 1-6 6 2 9-8-4-8 4 2-9-6-6 8-1z"/></svg>
        </div>
        <h4 class="font-semibold"><?= t('about.values_title') ?></h4>
      </div>
      <ul class="text-sm text-zinc-600 space-y-1">
        <li>• <?= t('about.values.safety') ?></li>
        <li>• <?= t('about.values.customer') ?></li>
        <li>• <?= t('about.values.pro') ?></li>
      </ul>
    </article>

    <article class="rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6">
      <div class="mb-3 flex items-center gap-2">
        <div class="h-8 w-8 rounded-lg bg-zinc-100 grid place-items-center">
          <svg class="h-4 w-4 text-zinc-600" viewBox="0 0 24 24" fill="currentColor"><path d="M4 6h16v2H4zM4 12h16v2H4zM4 18h10v2H4z"/></svg>
        </div>
        <h4 class="font-semibold"><?= t('about.why_title') ?></h4>
      </div>
      <ul class="text-sm text-zinc-600 space-y-1">
        <li>• <?= t('about.why.drivers') ?></li>
        <li>• <?= t('about.why.fleet') ?></li>
        <li>• <?= t('about.why.punctual') ?></li>
      </ul>
    </article>

    <article class="rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6">
      <div class="mb-3 flex items-center gap-2">
        <div class="h-8 w-8 rounded-lg bg-zinc-100 grid place-items-center">
          <svg class="h-4 w-4 text-zinc-600" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
        </div>
        <h4 class="font-semibold"><?= t('nav.services') ?></h4>
      </div>
      <p class="text-sm text-zinc-600">Airport · By the hour · Events · Point-to-point</p>
      <a href="/servicios/traslados" class="mt-3 inline-block text-sm text-sky-700 hover:underline">
  <?= t('nav.services') ?>
</a>

    </article>
  </div>
</section>

<!-- EQUIPO -->
<section class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl md:text-3xl font-bold text-center mb-10"><?= t('about.team_title') ?></h2>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
      <?php foreach ($team as $m): ?>
        <article class="text-center rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6 transition hover:-translate-y-0.5 hover:shadow-2xl">
          <img src="<?= $m['img'] ?>" alt="<?= htmlspecialchars($m['name']) ?>" class="mx-auto h-36 w-36 rounded-full object-cover">
          <h3 class="mt-4 font-semibold text-zinc-900"><?= htmlspecialchars($m['name']) ?></h3>
          <p class="text-sm text-zinc-600"><?= htmlspecialchars($m['role']) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

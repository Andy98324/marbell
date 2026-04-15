<?php
/** @var array $seoHub */
$hubTitle = current_lang() === 'en' ? $seoHub['title_en'] : $seoHub['title_es'];
$hubIntro = hub_intro($seoHub);
$destinations = route_hub_destinations($seoHub);
?>
<section class="relative overflow-hidden rounded-3xl bg-[#0b1220] text-white">
  <div class="absolute inset-0 opacity-25 pointer-events-none">
    <div class="absolute -top-32 left-1/2 h-[900px] w-[900px] -translate-x-1/2 rounded-full bg-gradient-to-br from-sky-500/30 via-transparent to-transparent blur-3xl"></div>
  </div>
  <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-18">
    <div class="max-w-4xl rounded-3xl border border-white/15 bg-white/10 p-7 shadow-2xl backdrop-blur-md md:p-10">
      <span class="inline-flex rounded-full border border-white/15 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.16em] text-sky-200">Transfer Marbell</span>
      <h1 class="mt-4 text-4xl font-extrabold tracking-tight md:text-5xl"><?= htmlspecialchars($hubTitle) ?></h1>
      <p class="mt-4 max-w-3xl text-lg leading-8 text-white/85"><?= htmlspecialchars($hubIntro) ?></p>
    </div>
  </div>
</section>

<section class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
      <?php foreach ($destinations as $item): ?>
        <article class="rounded-2xl bg-white p-6 shadow-xl ring-1 ring-black/5">
          <span class="inline-flex rounded-full bg-sky-50 px-2.5 py-1 text-xs font-semibold text-sky-700"><?= htmlspecialchars(seo_label($item, 'region')) ?></span>
          <h2 class="mt-3 text-xl font-bold text-zinc-900"><?= htmlspecialchars(seo_label($item, 'name')) ?></h2>
          <p class="mt-2 text-sm leading-6 text-zinc-700"><?= htmlspecialchars(route_description($item)) ?></p>
          <a class="mt-4 inline-flex rounded-xl bg-sky-600 px-4 py-2 text-sm font-bold text-white hover:bg-sky-500" href="<?= htmlspecialchars(route_path($item['slug']) . (current_lang()==='en' ? '?lang=en' : '')) ?>">
            <?= current_lang()==='en' ? 'View route page' : 'Ver página de ruta' ?>
          </a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

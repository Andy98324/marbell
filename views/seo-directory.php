<?php
$groups = destinations_grouped_a_to_z();
?>
<section class="relative overflow-hidden rounded-3xl bg-[#0b1220] text-white">
  <div class="absolute inset-0 opacity-25 pointer-events-none">
    <div class="absolute -top-32 left-1/2 h-[900px] w-[900px] -translate-x-1/2 rounded-full bg-gradient-to-br from-sky-500/30 via-transparent to-transparent blur-3xl"></div>
  </div>
  <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-18">
    <div class="max-w-4xl rounded-3xl border border-white/15 bg-white/10 p-7 shadow-2xl backdrop-blur-md md:p-10">
      <span class="inline-flex rounded-full border border-white/15 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.16em] text-sky-200">Transfer Marbell</span>
      <h1 class="mt-4 text-4xl font-extrabold tracking-tight md:text-5xl"><?= current_lang()==='en' ? 'A-Z destinations from Málaga Airport' : 'Destinos A-Z desde el Aeropuerto de Málaga' ?></h1>
      <p class="mt-4 max-w-3xl text-lg leading-8 text-white/85"><?= current_lang()==='en' ? 'Alphabetical private transfer directory covering the Costa del Sol, Andalusian cities and long-distance journeys operated by Transfer Marbell.' : 'Directorio alfabético de traslados privados que cubre la Costa del Sol, ciudades andaluzas y viajes largos operados por Transfer Marbell.' ?></p>
    </div>
  </div>
</section>
<section class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="mb-8 flex flex-wrap gap-2">
      <?php foreach ($groups as $letter => $items): ?>
        <a href="#grp-<?= htmlspecialchars($letter) ?>" class="rounded-xl bg-zinc-100 px-3 py-2 text-sm font-semibold text-zinc-800 hover:bg-zinc-200"><?= htmlspecialchars($letter) ?></a>
      <?php endforeach; ?>
    </div>
    <div class="space-y-10">
      <?php foreach ($groups as $letter => $items): ?>
        <section id="grp-<?= htmlspecialchars($letter) ?>" class="rounded-3xl bg-white p-6 shadow-xl ring-1 ring-black/5">
          <h2 class="text-2xl font-bold text-zinc-900"><?= htmlspecialchars($letter) ?></h2>
          <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            <?php foreach ($items as $item): ?>
              <a href="<?= htmlspecialchars(route_path($item['slug']) . (current_lang()==='en' ? '?lang=en' : '')) ?>" class="rounded-2xl border border-zinc-200 p-4 hover:border-sky-300 hover:shadow-lg">
                <div class="text-xs font-semibold uppercase tracking-[0.14em] text-sky-700"><?= htmlspecialchars(seo_label($item, 'region')) ?></div>
                <div class="mt-2 text-lg font-bold text-zinc-900"><?= current_lang()==='en' ? 'Málaga Airport to ' : 'Aeropuerto de Málaga a ' ?><?= htmlspecialchars(seo_label($item, 'name')) ?></div>
                <div class="mt-1 text-sm text-zinc-600">Transfer Marbell</div>
              </a>
            <?php endforeach; ?>
          </div>
        </section>
      <?php endforeach; ?>
    </div>
  </div>
</section>

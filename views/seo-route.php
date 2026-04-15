<?php
/** @var array $routeLanding */
$destinationName = seo_label($routeLanding, 'name');
$regionName = seo_label($routeLanding, 'region');
$featureItems = route_feature_items($routeLanding);
$useCases = route_use_cases($routeLanding);
$faqItems = route_faq_items($routeLanding);
$related = route_related_destinations($routeLanding);
$hubLinks = route_hub_links();
?>
<section class="relative overflow-hidden rounded-3xl bg-[#0b1220] text-white">
  <div class="absolute inset-0 opacity-25 pointer-events-none">
    <div class="absolute -top-32 left-1/2 h-[900px] w-[900px] -translate-x-1/2 rounded-full bg-gradient-to-br from-sky-500/30 via-transparent to-transparent blur-3xl"></div>
  </div>
  <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-18">
    <div class="max-w-4xl rounded-3xl border border-white/15 bg-white/10 p-7 shadow-2xl backdrop-blur-md md:p-10">
      <span class="inline-flex rounded-full border border-white/15 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.16em] text-sky-200">
        <?= current_lang()==='en' ? 'Transfer Marbell route page' : 'Ruta Transfer Marbell' ?>
      </span>
      <h1 class="mt-4 text-4xl font-extrabold tracking-tight md:text-5xl"><?= htmlspecialchars(route_title($routeLanding)) ?></h1>
      <p class="mt-4 max-w-3xl text-lg leading-8 text-white/85"><?= htmlspecialchars(route_intro($routeLanding)) ?></p>
      <div class="mt-6 flex flex-wrap gap-3 text-sm text-white/80">
        <span class="rounded-full border border-white/15 bg-white/10 px-3 py-1"><?= htmlspecialchars($regionName) ?></span>
        <span class="rounded-full border border-white/15 bg-white/10 px-3 py-1">Málaga Airport</span>
        <span class="rounded-full border border-white/15 bg-white/10 px-3 py-1">Transfer Marbell</span>
      </div>
      <div class="mt-8 flex flex-wrap gap-3">
        <a href="/#goToQuote" class="rounded-xl bg-sky-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-sky-600/25 hover:bg-sky-500">
          <?= current_lang()==='en' ? 'Book this transfer' : 'Reservar este traslado' ?>
        </a>
        <a href="/servicios/traslados<?= current_lang()==='en' ? '?lang=en' : '' ?>" class="rounded-xl border border-white/15 bg-white/10 px-5 py-3 text-sm font-semibold text-white hover:bg-white/15">
          <?= current_lang()==='en' ? 'See transfer service' : 'Ver servicio de traslados' ?>
        </a>
      </div>
    </div>
  </div>
</section>

<section class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
      <?php foreach ($featureItems as $item): ?>
        <article class="rounded-2xl bg-white p-6 shadow-xl ring-1 ring-black/5">
          <h2 class="text-lg font-bold text-zinc-900"><?= htmlspecialchars($item['title']) ?></h2>
          <p class="mt-2 text-sm leading-6 text-zinc-700"><?= htmlspecialchars($item['text']) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="pb-16">
  <div class="mx-auto grid max-w-7xl gap-8 px-4 sm:px-6 lg:grid-cols-[1.25fr_0.75fr] lg:px-8">
    <article class="rounded-3xl bg-white p-7 shadow-xl ring-1 ring-black/5 md:p-9">
      <h2 class="text-2xl font-bold text-zinc-900">
        <?= current_lang()==='en' ? 'Private transfer from or to Málaga Airport and ' . htmlspecialchars($destinationName) : 'Traslado privado desde o hasta el Aeropuerto de Málaga y ' . htmlspecialchars($destinationName) ?>
      </h2>
      <p class="mt-4 text-zinc-700 leading-7"><?= htmlspecialchars(route_description($routeLanding)) ?></p>
      <p class="mt-4 text-zinc-700 leading-7">
        <?= current_lang()==='en'
          ? 'People searching for ' . htmlspecialchars($destinationName) . ' transfers usually want a service that is easy to identify, on time and booked directly with the operating brand. That is why these pages reinforce the Transfer Marbell brand and link to nearby routes and service hubs instead of hiding the important pages.'
          : 'Quien busca traslados hacia ' . htmlspecialchars($destinationName) . ' normalmente quiere un servicio fácil de identificar, puntual y reservado directamente con la marca operadora. Por eso estas páginas refuerzan la marca Transfer Marbell y enlazan con rutas cercanas y páginas hub en lugar de esconder las páginas importantes.' ?>
      </p>

      <div class="mt-8 grid gap-6 md:grid-cols-2">
        <div>
          <h3 class="text-lg font-semibold text-zinc-900"><?= current_lang()==='en' ? 'Common uses for this route' : 'Usos habituales de esta ruta' ?></h3>
          <ul class="mt-3 space-y-2 text-sm text-zinc-700">
            <?php foreach ($useCases as $use): ?>
              <li class="flex items-start gap-2"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= htmlspecialchars($use) ?></span></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php if (!empty($related)): ?>
        <div>
          <h3 class="text-lg font-semibold text-zinc-900"><?= current_lang()==='en' ? 'Nearby destinations we also cover' : 'Destinos cercanos que también cubrimos' ?></h3>
          <ul class="mt-3 space-y-2 text-sm text-zinc-700">
            <?php foreach ($related as $item): ?>
              <li>
                <a class="font-medium text-sky-700 hover:text-sky-800 hover:underline" href="<?= htmlspecialchars(route_path($item['slug']) . (current_lang()==='en' ? '?lang=en' : '')) ?>">
                  <?= current_lang()==='en' ? 'Málaga Airport to ' : 'Aeropuerto de Málaga a ' ?><?= htmlspecialchars(seo_label($item, 'name')) ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>
      </div>
    </article>

    <aside class="space-y-6">
      <div class="rounded-3xl bg-zinc-50 p-6 shadow-xl ring-1 ring-black/5">
        <h3 class="text-lg font-bold text-zinc-900"><?= current_lang()==='en' ? 'Transfer Marbell hubs' : 'Hubs de Transfer Marbell' ?></h3>
        <p class="mt-2 text-sm leading-6 text-zinc-700">
          <?= current_lang()==='en' ? 'These internal pages help search engines understand your main operating areas and help users jump to the route they need.' : 'Estas páginas internas ayudan a los buscadores a entender tus principales áreas operativas y ayudan al usuario a saltar a la ruta que necesita.' ?>
        </p>
        <ul class="mt-4 space-y-2 text-sm text-zinc-700">
          <?php foreach (array_slice($hubLinks, 0, 6) as $hub): ?>
            <li>
              <a class="font-medium text-sky-700 hover:text-sky-800 hover:underline" href="/<?= htmlspecialchars($hub['slug']) ?><?= current_lang()==='en' ? '?lang=en' : '' ?>">
                <?= htmlspecialchars(current_lang()==='en' ? $hub['title_en'] : $hub['title_es']) ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="rounded-3xl bg-[#0b1220] p-6 text-white shadow-xl">
        <h3 class="text-lg font-bold"><?= current_lang()==='en' ? 'Need a quick quote?' : '¿Necesitas presupuesto rápido?' ?></h3>
        <p class="mt-2 text-sm leading-6 text-white/80">
          <?= current_lang()==='en' ? 'Use the Transfer Marbell quote form to request a private airport transfer for this route.' : 'Usa el formulario de Transfer Marbell para pedir un traslado privado para esta ruta.' ?>
        </p>
        <a href="/#goToQuote" class="mt-4 inline-flex rounded-xl bg-sky-500 px-4 py-3 text-sm font-bold text-white hover:bg-sky-400">
          <?= current_lang()==='en' ? 'Go to quote form' : 'Ir al formulario' ?>
        </a>
      </div>
    </aside>
  </div>
</section>

<section class="pb-16">
  <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
    <div class="rounded-3xl bg-white p-7 shadow-xl ring-1 ring-black/5 md:p-9">
      <h2 class="text-2xl font-bold text-zinc-900"><?= current_lang()==='en' ? 'Frequently asked questions' : 'Preguntas frecuentes' ?></h2>
      <div class="mt-6 space-y-4">
        <?php foreach ($faqItems as $faq): ?>
          <details class="rounded-2xl border border-zinc-200 bg-zinc-50 p-4">
            <summary class="cursor-pointer list-none font-semibold text-zinc-900"><?= htmlspecialchars($faq['q']) ?></summary>
            <p class="mt-2 text-sm leading-6 text-zinc-700"><?= htmlspecialchars($faq['a']) ?></p>
          </details>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

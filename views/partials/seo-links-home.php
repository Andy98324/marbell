<?php $routeData = seo_routes_data(); $popularRoutes = route_popular_destinations(); ?>
<section class="py-16 bg-zinc-50 rounded-3xl">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl">
      <h2 class="text-3xl font-bold tracking-tight text-zinc-900">
        <?= current_lang()==='en' ? 'Popular private transfers from Málaga Airport' : 'Traslados privados populares desde el Aeropuerto de Málaga' ?>
      </h2>
      <p class="mt-3 text-zinc-700 leading-7">
        <?= current_lang()==='en' ? 'These pages help users and search engines identify the core routes operated by Transfer Marbell across the Costa del Sol and longer Andalusian destinations.' : 'Estas páginas ayudan a usuarios y buscadores a identificar las rutas principales que opera Transfer Marbell por la Costa del Sol y los destinos largos de Andalucía.' ?>
      </p>
    </div>

    <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
      <?php foreach ($popularRoutes as $item): ?>
        <a href="<?= htmlspecialchars(route_path($item['slug']) . (current_lang()==='en' ? '?lang=en' : '')) ?>" class="rounded-2xl bg-white p-4 shadow-lg ring-1 ring-black/5 transition hover:-translate-y-0.5 hover:shadow-xl">
          <span class="text-xs font-semibold uppercase tracking-[0.14em] text-sky-700"><?= htmlspecialchars(seo_label($item, 'region')) ?></span>
          <div class="mt-2 text-lg font-bold text-zinc-900"><?= current_lang()==='en' ? 'Málaga Airport to ' : 'Aeropuerto de Málaga a ' ?><?= htmlspecialchars(seo_label($item, 'name')) ?></div>
          <div class="mt-1 text-sm text-zinc-600">Transfer Marbell</div>
        </a>
      <?php endforeach; ?>
    </div>

    <div class="mt-8 flex justify-center">
      <a href="/destinos-a-z<?= current_lang()==='en' ? '?lang=en' : '' }" class="rounded-xl bg-sky-600 px-5 py-3 text-sm font-bold text-white hover:bg-sky-500">
        <?= current_lang()==='en' ? 'Browse all destinations A-Z' : 'Ver todos los destinos A-Z' ?>
      </a>
    </div>

    <div class="mt-10 grid gap-4 lg:grid-cols-3"> 
      <?php foreach ($routeData['hubs'] as $hub): ?>
        <a href="/<?= htmlspecialchars($hub['slug']) ?><?= current_lang()==='en' ? '?lang=en' : '' ?>" class="rounded-2xl border border-zinc-200 bg-white p-5 shadow-lg hover:border-sky-300 hover:shadow-xl">
          <h3 class="text-lg font-bold text-zinc-900"><?= htmlspecialchars(current_lang()==='en' ? $hub['title_en'] : $hub['title_es']) ?></h3>
          <p class="mt-2 text-sm leading-6 text-zinc-700"><?= htmlspecialchars(current_lang()==='en' ? $hub['intro_en'] : $hub['intro_es']) ?></p>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
$destinations = require __DIR__ . '/../../app/destinations.php';
$groups = [];
foreach ($destinations as $slug => $item) {
  $item['slug'] = $slug;
  $groups[$item['group']][] = $item;
}
?>
<section class="relative overflow-hidden bg-[#0b1220] text-white rounded-3xl">
  <div class="absolute inset-0 opacity-25 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>
  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-14 md:py-18">
    <div class="rounded-3xl border border-white/15 bg-white/10 backdrop-blur-md shadow-2xl overflow-hidden">
      <div class="relative p-7 md:p-10">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">Principales destinos desde o hasta el Aeropuerto de Málaga</h1>
        <p class="mt-4 text-white/80 text-lg leading-relaxed max-w-3xl">Descubre nuestros destinos más solicitados de la Costa del Sol, las ciudades de Andalucía y Sierra Nevada. Cada página está optimizada para que los clientes encuentren la ruta que necesitan y puedan reservar su traslado privado con más facilidad.</p>
      </div>
    </div>
  </div>
</section>

<section class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-12">
    <?php foreach ($groups as $group => $items): ?>
      <div>
        <div class="flex items-end justify-between gap-4 mb-6">
          <div>
            <h2 class="text-3xl font-bold tracking-tight"><?= htmlspecialchars($group) ?></h2>
            <p class="text-zinc-600 mt-2">Rutas destacadas con servicio puerta a puerta, precio fijo y conductor profesional.</p>
          </div>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
          <?php foreach ($items as $item): ?>
            <article class="group rounded-2xl bg-white shadow-xl ring-1 ring-black/5 overflow-hidden hover:-translate-y-0.5 hover:shadow-2xl transition">
              <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-full aspect-[16/10] object-cover" loading="lazy">
              <div class="p-5">
                <div class="text-xs font-semibold uppercase tracking-wide text-sky-700"><?= htmlspecialchars($group) ?></div>
                <h3 class="mt-1 text-lg font-bold text-zinc-900"><?= htmlspecialchars($item['name']) ?></h3>
                <p class="mt-2 text-sm text-zinc-600"><?= htmlspecialchars($item['lead']) ?></p>
                <a href="/destinos/<?= htmlspecialchars($item['slug']) ?>" class="mt-4 inline-flex items-center gap-2 rounded-xl bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">Ver destino</a>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

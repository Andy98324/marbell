<?php
$destination = $destination ?? ($GLOBALS['destination'] ?? null);
$destinations = require __DIR__ . '/../../app/destinations.php';
if (!$destination) { echo '<p>Destino no encontrado.</p>'; return; }
$related = [];
foreach (($destination['nearby'] ?? []) as $slug) {
  if (isset($destinations[$slug])) {
    $item = $destinations[$slug];
    $item['slug'] = $slug;
    $related[] = $item;
  }
}
?>
<section class="relative overflow-hidden bg-[#0b1220] text-white rounded-3xl">
  <div class="absolute inset-0 opacity-25 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>
  <div class="relative grid lg:grid-cols-2 gap-0 items-stretch">
    <div class="p-8 md:p-12 lg:p-14">
      <div class="inline-flex rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-white/90 border border-white/15"><?= htmlspecialchars($destination['group']) ?></div>
      <h1 class="mt-4 text-4xl md:text-5xl font-extrabold tracking-tight"><?= htmlspecialchars($destination['title']) ?></h1>
      <p class="mt-4 text-white/80 text-lg leading-relaxed"><?= htmlspecialchars($destination['lead']) ?></p>
      <div class="mt-6 flex flex-wrap gap-3 text-sm text-white/90">
        <span class="rounded-full bg-white/10 px-3 py-2 border border-white/10">Precio fijo</span>
        <span class="rounded-full bg-white/10 px-3 py-2 border border-white/10">Seguimiento de vuelo</span>
        <span class="rounded-full bg-white/10 px-3 py-2 border border-white/10"><?= htmlspecialchars($destination['travel_time']) ?></span>
      </div>
      <div class="mt-8 flex flex-wrap gap-3">
        <a href="/#goToQuote" class="inline-flex items-center gap-2 rounded-xl bg-amber-400 px-5 py-3 text-sm font-semibold text-zinc-900 shadow hover:-translate-y-0.5 transition">Reservar ahora</a>
        <a href="/destinos" class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-5 py-3 text-sm font-semibold text-white border border-white/15">Ver más destinos</a>
      </div>
    </div>
    <div class="min-h-[260px] lg:min-h-full">
      <img src="<?= htmlspecialchars($destination['image']) ?>" alt="<?= htmlspecialchars($destination['name']) ?>" class="w-full h-full object-cover" loading="lazy">
    </div>
  </div>
</section>

<section class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-8 lg:grid-cols-[1.3fr_.9fr]">
    <div>
      <h2 class="text-3xl font-bold tracking-tight mb-4">Transfer privado desde o hasta Málaga Airport</h2>
      <p class="text-zinc-700 leading-7 mb-5"><?= htmlspecialchars($destination['intro']) ?></p>
      <p class="text-zinc-700 leading-7">En Transfer Marbell trabajamos rutas de la Costa del Sol y viajes largos por Andalucía con servicio puerta a puerta, conductor profesional y vehículos adecuados para parejas, familias, grupos y clientes de negocios.</p>

      <div class="mt-8 rounded-2xl bg-zinc-50 ring-1 ring-zinc-200 p-6">
        <h3 class="text-xl font-bold text-zinc-900 mb-3">Qué incluye este servicio</h3>
        <ul class="space-y-2 text-zinc-700">
          <?php foreach ($destination['highlights'] as $point): ?>
            <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= htmlspecialchars($point) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <aside class="space-y-6">
      <div class="rounded-2xl bg-white shadow-xl ring-1 ring-black/5 p-6">
        <h3 class="text-xl font-bold text-zinc-900">Ruta optimizada para Google</h3>
        <p class="mt-3 text-zinc-700">Esta página está orientada a búsquedas del tipo <strong>traslado privado Aeropuerto de Málaga a <?= htmlspecialchars($destination['name']) ?></strong> y <strong>transfer Málaga Airport to <?= htmlspecialchars($destination['name']) ?></strong>.</p>
        <p class="mt-3 text-zinc-700">Tiempo estimado: <strong><?= htmlspecialchars($destination['travel_time']) ?></strong></p>
      </div>

      <div class="rounded-2xl bg-white shadow-xl ring-1 ring-black/5 p-6">
        <h3 class="text-xl font-bold text-zinc-900">Reservas</h3>
        <p class="mt-3 text-zinc-700">Puedes solicitar este traslado desde la home o pedir presupuesto para grupos, minivan, minibus o servicios premium.</p>
        <a href="/#goToQuote" class="mt-4 inline-flex items-center gap-2 rounded-xl bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">Ir al motor de reservas</a>
      </div>
    </aside>
  </div>
</section>

<?php if ($related): ?>
<section class="pb-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold tracking-tight mb-6">Destinos relacionados</h2>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($related as $item): ?>
        <article class="rounded-2xl bg-white shadow-xl ring-1 ring-black/5 overflow-hidden">
          <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-full aspect-[16/10] object-cover" loading="lazy">
          <div class="p-5">
            <h3 class="text-lg font-bold text-zinc-900"><?= htmlspecialchars($item['name']) ?></h3>
            <p class="mt-2 text-sm text-zinc-600"><?= htmlspecialchars($item['lead']) ?></p>
            <a href="/destinos/<?= htmlspecialchars($item['slug']) ?>" class="mt-4 inline-flex items-center gap-2 rounded-xl bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">Ver destino</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

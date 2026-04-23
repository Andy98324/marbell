<?php
$destinations = require __DIR__ . '/../../app/destinations.php';

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function groupId(string $group): string
{
    $map = [
        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n',
        'Á' => 'a', 'É' => 'e', 'Í' => 'i', 'Ó' => 'o', 'Ú' => 'u', 'Ñ' => 'n',
    ];

    $group = strtr($group, $map);
    $group = strtolower($group);
    $group = preg_replace('/[^a-z0-9]+/', '-', $group);
    return trim($group, '-');
}

function groupBadgeClass(string $group): string
{
    return match ($group) {
        'Costa del Sol' => 'bg-sky-100 text-sky-700',
        'Axarquía' => 'bg-cyan-100 text-cyan-700',
        'Costa Tropical' => 'bg-emerald-100 text-emerald-700',
        'Ciudades de Andalucía' => 'bg-violet-100 text-violet-700',
        'Interior de Andalucía' => 'bg-amber-100 text-amber-700',
        'Sierra Nevada' => 'bg-indigo-100 text-indigo-700',
        'Costa de la Luz - Cádiz' => 'bg-blue-100 text-blue-700',
        'Costa de la Luz - Huelva' => 'bg-teal-100 text-teal-700',
        'Costa de Almería' => 'bg-lime-100 text-lime-700',
        'Jaén y renacimiento' => 'bg-orange-100 text-orange-700',
        default => 'bg-zinc-100 text-zinc-700',
    };
}

$groupOrder = [
    'Costa del Sol',
    'Axarquía',
    'Costa Tropical',
    'Ciudades de Andalucía',
    'Interior de Andalucía',
    'Sierra Nevada',
    'Costa de la Luz - Cádiz',
    'Costa de la Luz - Huelva',
    'Costa de Almería',
    'Jaén y renacimiento',
];

$groups = [];

foreach ($groupOrder as $group) {
    $groups[$group] = [];
}

foreach ($destinations as $slug => $item) {
    $item['slug'] = $slug;
    $group = $item['group'] ?? 'Otros destinos';

    if (!isset($groups[$group])) {
        $groups[$group] = [];
    }

    $groups[$group][] = $item;
}

foreach ($groups as $group => &$items) {
    usort($items, fn($a, $b) => strcmp($a['name'], $b['name']));
}
unset($items);
?>

<section class="relative overflow-hidden bg-[#0b1220] text-white rounded-3xl">
  <div class="absolute inset-0 opacity-25 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-14 md:py-18">
    <div class="rounded-3xl border border-white/15 bg-white/10 backdrop-blur-md shadow-2xl overflow-hidden">
      <div class="relative p-7 md:p-10">
        <span class="inline-flex rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-white/90 border border-white/15">
          Todos los destinos
        </span>

        <h1 class="mt-4 text-4xl md:text-5xl font-extrabold tracking-tight">
          Principales destinos desde o hasta el Aeropuerto de Málaga
        </h1>

        <p class="mt-4 text-white/80 text-lg leading-relaxed max-w-4xl">
          Descubre nuestros destinos más solicitados de la Costa del Sol, Axarquía, Costa Tropical, ciudades de Andalucía,
          Sierra Nevada y otras rutas turísticas clave. Cada página está optimizada para que los clientes encuentren la ruta
          que necesitan y puedan reservar su traslado privado con más facilidad.
        </p>

        <div class="mt-6 flex flex-wrap gap-3">
          <a href="#destination-search" class="inline-flex items-center rounded-xl bg-sky-500 px-5 py-3 text-sm font-semibold text-white hover:bg-sky-600">
            Buscar destino
          </a>
          <a href="#all-destinations" class="inline-flex items-center rounded-xl border border-white/20 bg-white/10 px-5 py-3 text-sm font-semibold text-white hover:bg-white/15">
            Ver listado completo
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="destination-search" class="py-10 bg-slate-50 border-b border-slate-200">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
      <div>
        <h2 class="text-2xl md:text-3xl font-extrabold text-zinc-900">
          Encuentra tu destino
        </h2>
        <p class="mt-2 text-zinc-600">
          Busca por nombre del destino o por grupo turístico.
        </p>
      </div>

      <div class="w-full lg:max-w-md">
        <input
          id="destinationSearchInput"
          type="text"
          placeholder="Ej.: Marbella, Granada, Nerja..."
          class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-zinc-900 shadow-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
        >
      </div>
    </div>

    <div class="mt-6 flex flex-wrap gap-3">
      <?php foreach ($groups as $group => $items): ?>
        <?php if (!$items) continue; ?>
        <a
          href="#<?= e(groupId($group)) ?>"
          class="inline-flex items-center rounded-full border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-zinc-700 hover:border-sky-400 hover:text-sky-700"
        >
          <?= e($group) ?> (<?= count($items) ?>)
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section id="all-destinations" class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-14">

    <?php foreach ($groups as $group => $items): ?>
      <?php if (!$items) continue; ?>

      <div id="<?= e(groupId($group)) ?>" class="destination-group">
        <div class="flex items-end justify-between gap-4 mb-6">
          <div>
            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold <?= e(groupBadgeClass($group)) ?>">
              <?= e($group) ?>
            </span>
            <h2 class="mt-3 text-3xl font-bold tracking-tight text-zinc-900">
              <?= e($group) ?>
            </h2>
            <p class="text-zinc-600 mt-2">
              Rutas destacadas con servicio puerta a puerta, precio fijo y conductor profesional.
            </p>
          </div>

          <div class="hidden sm:block text-sm font-medium text-zinc-500">
            <?= count($items) ?> destinos
          </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
          <?php foreach ($items as $item): ?>
            <article
              class="destination-card group rounded-2xl bg-white shadow-xl ring-1 ring-black/5 overflow-hidden hover:-translate-y-0.5 hover:shadow-2xl transition"
              data-name="<?= e(mb_strtolower($item['name'], 'UTF-8')) ?>"
              data-group="<?= e(mb_strtolower($group, 'UTF-8')) ?>"
            >
              <div class="relative">
                <img
                  src="<?= e($item['image']) ?>"
                  alt="<?= e($item['name']) ?>"
                  class="w-full aspect-[16/10] object-cover"
                  loading="lazy"
                  onerror="this.onerror=null;this.src='/assets/images/transfers/default.jpg';"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-black/0 to-transparent"></div>

                <span class="absolute left-4 bottom-4 inline-flex items-center rounded-full bg-white/95 px-3 py-1 text-xs font-semibold text-sky-700 shadow">
                  <?= e($group) ?>
                </span>
              </div>

              <div class="p-5">
                <h3 class="text-lg font-bold text-zinc-900">
                  <?= e($item['name']) ?>
                </h3>

                <p class="mt-2 text-sm text-zinc-600 line-clamp-3">
                  <?= e($item['lead']) ?>
                </p>

                <?php if (!empty($item['travel_time'])): ?>
                  <p class="mt-3 inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                    <?= e($item['travel_time']) ?>
                  </p>
                <?php endif; ?>

                <a
                  href="/destinos/<?= e($item['slug']) ?>"
                  class="mt-4 inline-flex items-center gap-2 rounded-xl bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700"
                >
                  Ver destino
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M10 17l6-5-6-5v10z" />
                  </svg>
                </a>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const input = document.getElementById('destinationSearchInput');
  const cards = document.querySelectorAll('.destination-card');
  const groups = document.querySelectorAll('.destination-group');

  if (!input) return;

  input.addEventListener('input', function () {
    const term = this.value.trim().toLowerCase();

    cards.forEach(card => {
      const name = card.dataset.name || '';
      const group = card.dataset.group || '';
      const match = term === '' || name.includes(term) || group.includes(term);
      card.style.display = match ? '' : 'none';
    });

    groups.forEach(group => {
      const visibleCards = group.querySelectorAll('.destination-card[style=""], .destination-card:not([style])');
      const hasVisible = Array.from(group.querySelectorAll('.destination-card')).some(card => card.style.display !== 'none');
      group.style.display = hasVisible ? '' : 'none';
    });
  });
});
</script>
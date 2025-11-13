<?php
// views/quote.php — contenido central, lo envuelve views/layout.php

// Helper precio con símbolo a la DERECHA
if (!function_exists('eur')) {
  function eur($v): string {
    return number_format((float)$v, 2, ',', '.') . ' €';
  }
}

$origin_address      = $origin_address ?? ($oAddr ?? '');
$destination_address = $destination_address ?? ($dAddr ?? '');
$km      = isset($km) ? (float)$km : 0;
$minutes = isset($minutes) ? (float)$minutes : 0;
$quotes  = $quotes ?? [];
$noZoneMatch = $noZoneMatch ?? false;
?>

<!-- HERO -->
<section class="relative overflow-hidden bg-[#0b1220] text-white">
  <div class="absolute inset-0 opacity-20 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    <div class="text-center max-w-3xl mx-auto">
      <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">
        <?= function_exists('t') ? t('fleet.title') : 'Nuestra flota' ?>
      </h1>

      <div class="mt-4 grid gap-2 text-white/90 text-sm">
        <p><strong><?= function_exists('t') ? t('home.from') : 'Origen' ?>:</strong>
          <span class="text-white/80"><?= htmlspecialchars($origin_address) ?></span></p>
        <p><strong><?= function_exists('t') ? t('home.to') : 'Destino' ?>:</strong>
          <span class="text-white/80"><?= htmlspecialchars($destination_address) ?></span></p>
        <p class="text-white/70">
          • <strong><?= function_exists('t') ? t('home.distance') : 'Distancia' ?>:</strong>
          <?= number_format($km, 1, ',', '.') ?> km
          · <strong><?= function_exists('t') ? t('home.duration') : 'Duración estimada' ?>:</strong>
          <?= round($minutes) ?> min
        </p>
      </div>
    </div>
  </div>
</section>

<section class="py-12 bg-zinc-50">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <?php if ($noZoneMatch): ?>
      <!-- AVISO cuando origen o destino no pertenecen a ninguna zona -->
      <div class="max-w-3xl mx-auto rounded-2xl bg-white ring-1 ring-amber-300 shadow p-6 text-center mb-8">
        <h3 class="text-xl font-semibold text-zinc-900 mb-2">
          <?= function_exists('t') ? t('quote.out_of_zone_title') : 'Ruta fuera de zonas' ?>
        </h3>
        <p class="text-zinc-700">
          <?= function_exists('t')
                ? t('quote.out_of_zone_text1')
                : 'No tenemos tarifas definidas para esta combinación porque el origen o el destino no están dentro de ninguna zona configurada.' ?>
        </p>
        <p class="text-zinc-700 mt-1">
          <?= function_exists('t')
                ? t('quote.out_of_zone_text2')
                : 'Por favor, contáctanos y te daremos precio al momento.' ?>
        </p>
        <div class="mt-4 flex items-center justify-center gap-3">
          <a href="tel:+34XXXXXXXXX"
             class="rounded-xl bg-amber-400 text-zinc-900 font-semibold px-5 py-2 shadow">
            <?= function_exists('t') ? t('quote.call') : 'Llamar' ?>
          </a>
          <a href="mailto:info@tudominio.com"
             class="rounded-xl bg-white/10 border border-zinc-200 text-zinc-800 font-semibold px-5 py-2">
            <?= function_exists('t') ? t('quote.write') : 'Escribir' ?>
          </a>
        </div>
      </div>
    <?php endif; ?>

    <?php if (!$noZoneMatch && empty($quotes)): ?>
      <div class="text-center text-zinc-600">
        <?= function_exists('t')
              ? t('quote.no_vehicles') ?? 'No se encontraron vehículos disponibles.'
              : 'No se encontraron vehículos disponibles.' ?>
      </div>
    <?php else: ?>

      <!-- Barra de ordenación -->
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <h2 class="text-lg font-semibold text-zinc-900">
          <?= function_exists('t') ? t('home.select') : 'Selecciona tu vehículo' ?>
        </h2>
        <label class="flex items-center gap-2 text-sm text-zinc-700">
          <?= function_exists('t') ? t('quote.sort_by') : 'Ordenar por' ?>:
          <select id="sortSelect"
                  class="rounded-lg border border-zinc-300 bg-white px-3 py-1 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            <option value="price_asc">
              <?= function_exists('t') ? t('quote.sort.price_asc') : 'Precio (menor a mayor)' ?>
            </option>
            <option value="price_desc">
              <?= function_exists('t') ? t('quote.sort.price_desc') : 'Precio (mayor a menor)' ?>
            </option>
            <option value="pax_desc">
              <?= function_exists('t') ? t('quote.sort.pax_desc') : 'Pasajeros (mayor a menor)' ?>
            </option>
            <option value="pax_asc">
              <?= function_exists('t') ? t('quote.sort.pax_asc') : 'Pasajeros (menor a mayor)' ?>
            </option>
            <option value="lug_desc">
              <?= function_exists('t') ? t('quote.sort.lug_desc') : 'Equipaje (mayor a menor)' ?>
            </option>
            <option value="lug_asc">
              <?= function_exists('t') ? t('quote.sort.lug_asc') : 'Equipaje (menor a mayor)' ?>
            </option>
          </select>
        </label>
      </div>

      <div id="vehiclesGrid" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        <?php foreach ($quotes as $q): ?>
          <?php
            $name     = (string)($q['name'] ?? '');
            $img      = (string)($q['img'] ?? '');
            $capacity = trim((string)($q['capacity'] ?? ''));
            $price    = $q['price'] ?? null;          // null = sin tarifa de zona
            $hasPrice = $price !== null && $price !== '';

            // Extraer pax y maletas desde string "4 pax • 3 maletas"
            $paxNum = 0;
            $lugNum = 0;
            if ($capacity) {
              if (preg_match_all('/(\d+)/', $capacity, $m) && !empty($m[1])) {
                $paxNum = (int)$m[1][0];
                if (isset($m[1][1])) $lugNum = (int)$m[1][1];
              }
            }
          ?>
          <article
            class="group rounded-2xl bg-white shadow-xl ring-1 ring-black/5 p-5 text-center transition hover:-translate-y-0.5 hover:shadow-2xl"
            data-vehicle-card
            data-price="<?= $hasPrice ? htmlspecialchars((string)$price) : '' ?>"
            data-pax="<?= $paxNum ?>"
            data-luggage="<?= $lugNum ?>"
            data-has-price="<?= $hasPrice ? '1' : '0' ?>"
          >
            <?php if ($img): ?>
              <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($name) ?>" class="mx-auto h-28 object-contain" loading="lazy">
            <?php endif; ?>

            <h3 class="mt-3 font-semibold text-zinc-900"><?= htmlspecialchars($name) ?></h3>
            <?php if ($capacity): ?>
              <p class="text-sm text-zinc-600"><?= htmlspecialchars($capacity) ?></p>
            <?php endif; ?>

            <div class="mt-4 text-3xl font-extrabold">
              <?php if ($hasPrice): ?>
                <span class="text-zinc-900"><?= eur($price) ?></span>
              <?php else: ?>
                <span class="text-zinc-400">
                  <?= function_exists('t') ? t('quote.not_available') : 'No disponible' ?>
                </span>
              <?php endif; ?>
            </div>
            <div class="mt-1 text-sm <?= $hasPrice ? 'text-green-600' : 'text-amber-600' ?>">
              <?= $hasPrice
                    ? (function_exists('t') ? t('quote.zone_price') : 'Tarifa fija por zona')
                    : (function_exists('t') ? t('quote.no_zone_price') ?? 'Sin tarifa definida' : 'Sin tarifa definida') ?>
            </div>

            <form method="post" action="/booking.php" class="mt-4">
  <input type="hidden" name="vehicle_code" value="<?= htmlspecialchars($q['code']) ?>">
  <button
    class="w-full rounded-xl px-6 py-3 font-semibold shadow <?= $hasPrice ? 'bg-amber-400 text-zinc-900 hover:-translate-y-0.5 transition' : 'bg-zinc-200 text-zinc-500 cursor-not-allowed' ?>"
    <?= $hasPrice ? '' : 'disabled' ?>
    type="submit">
    <?= function_exists('t') ? t('home.select') : 'Seleccionar vehículo' ?>
  </button>
</form>

          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <p class="text-center text-zinc-500 mt-8 text-sm">
      <?= function_exists('t')
            ? t('home.quote_disclaimer')
            : 'El precio mostrado es orientativo y puede variar ligeramente según el tráfico y la disponibilidad.' ?>
    </p>
  </div>
</section>

<script>
(function() {
  const select = document.getElementById('sortSelect');
  const grid   = document.getElementById('vehiclesGrid');
  if (!select || !grid) return;

  function sortCards() {
    const mode  = select.value;
    const cards = Array.from(grid.querySelectorAll('[data-vehicle-card]'));

    const getPrice = c => {
      const hp = c.dataset.hasPrice === '1';
      if (!hp) return null;
      const v = parseFloat(c.dataset.price || '0');
      return isNaN(v) ? null : v;
    };
    const getPax = c => parseInt(c.dataset.pax || '0', 10) || 0;
    const getLug = c => parseInt(c.dataset.luggage || '0', 10) || 0;

    cards.sort((a,b) => {
      let av, bv;

      switch (mode) {
        case 'price_asc':
          av = getPrice(a); bv = getPrice(b);
          if (av === null && bv === null) return 0;
          if (av === null) return 1;
          if (bv === null) return -1;
          return av - bv;

        case 'price_desc':
          av = getPrice(a); bv = getPrice(b);
          if (av === null && bv === null) return 0;
          if (av === null) return 1;
          if (bv === null) return -1;
          return bv - av;

        case 'pax_desc':
          return getPax(b) - getPax(a);

        case 'pax_asc':
          return getPax(a) - getPax(b);

        case 'lug_desc':
          return getLug(b) - getLug(a);

        case 'lug_asc':
          return getLug(a) - getLug(b);

        default:
          return 0;
      }
    });

    cards.forEach(c => grid.appendChild(c));
  }

  select.addEventListener('change', sortCards);
  sortCards(); // orden inicial: precio menor a mayor
})();
</script>

<?php
// views/quote.php
// Este archivo muestra los resultados del cálculo de cotización
// y utiliza exclusivamente precios de zona definidos en la BD.

if (!isset($quotes)) $quotes = [];

// Helper seguro para mostrar precios en euros
function eur($v): string {
  return '€' . number_format((float)$v, 2, ',', '.');
}
if (!function_exists('eur')) {
  function eur($v): string { return '€' . number_format((float)$v, 2, ',', '.'); }
}

$origin_address      = $origin_address ?? ($oAddr ?? '');
$destination_address = $destination_address ?? ($dAddr ?? '');
$km      = isset($km) ? (float)$km : 0;
$minutes = isset($minutes) ? (float)$minutes : 0;
$quotes  = $quotes ?? [];
?>

<!-- HERO / encabezado de resultados -->
<!-- HERO / encabezado de resultados -->
<section class="relative overflow-hidden bg-[#0b1220] text-white">
  <div class="absolute inset-0 opacity-20 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    <div class="text-center max-w-3xl mx-auto">
      <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">
        <?= function_exists('t') ? t('home.fleet_title') : 'Nuestra flota' ?>
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

<!-- LISTA DE VEHÍCULOS -->
<section class="py-12 bg-zinc-50">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <?php if (empty($quotes)): ?>
      <div class="text-center text-zinc-600">
        <?= 'No se encontraron vehículos disponibles.' ?>
      </div>
    <?php else: ?>
      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        <?php foreach ($quotes as $q): ?>
          <?php
            $name     = (string)($q['name'] ?? '');
            $img      = (string)($q['img'] ?? '');
            $capacity = trim((string)($q['capacity'] ?? ''));
            $price    = $q['price'] ?? null;         // null = sin tarifa de zona definida
            $hasPrice = $price !== null && $price !== '';
          ?>
          <article class="group rounded-2xl bg-white shadow-xl ring-1 ring-black/5 p-5 text-center transition hover:-translate-y-0.5 hover:shadow-2xl">
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
                <span class="text-zinc-400">No disponible</span>
              <?php endif; ?>
            </div>
            <div class="mt-1 text-sm <?= $hasPrice ? 'text-green-600' : 'text-amber-600' ?>">
              <?= $hasPrice ? 'Tarifa fija por zona' : 'Sin tarifa definida' ?>
            </div>

            <button
              class="mt-4 rounded-xl px-6 py-3 font-semibold shadow <?= $hasPrice ? 'bg-amber-400 text-zinc-900 hover:-translate-y-0.5 transition' : 'bg-zinc-200 text-zinc-500 cursor-not-allowed' ?>"
              <?= $hasPrice ? '' : 'disabled' ?>
              type="button">
              <?= function_exists('t') ? t('home.select') : 'Seleccionar vehículo' ?>
            </button>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <p class="text-center text-zinc-500 mt-8 text-sm">
      <?= function_exists('t') ? t('home.quote_disclaimer') : 'El precio mostrado es orientativo y puede variar según disponibilidad.' ?>
    </p>
  </div>
</section>
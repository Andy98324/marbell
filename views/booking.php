<?php
// views/booking.php — resumen + formulario de reserva

if (!function_exists('eur')) {
  function eur($v): string {
    return number_format((float)$v, 2, ',', '.') . ' €';
  }
}

$origin_address      = $origin_address ?? '';
$destination_address = $destination_address ?? '';
$km      = isset($km) ? (float)$km : 0;
$minutes = isset($minutes) ? (float)$minutes : 0;
$vehicle = $vehicle ?? [];
$price   = $price ?? null;

$vehName  = $vehicle['name'] ?? '';
$vehImg   = $vehicle['img'] ?? '';
$vehPax   = $vehicle['pax'] ?? '';
$vehLugg  = $vehicle['luggage'] ?? '';
?>

<section class="relative overflow-hidden bg-[#0b1220] text-white">
  <div class="absolute inset-0 opacity-20 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    <div class="text-center max-w-3xl mx-auto">
      <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-4">
        <?= function_exists('t') ? t('booking.title') : 'Completa tu reserva' ?>
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

<section class="py-10 bg-zinc-50">
  <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 grid gap-8 lg:grid-cols-[1.2fr,1fr]">

    <!-- Formulario de datos del pasajero -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-black/5 p-6 md:p-8">
      <h2 class="text-xl font-semibold text-zinc-900 mb-4">
        <?= function_exists('t') ? t('booking.passenger_details') : 'Datos del pasajero' ?>
      </h2>

      <!--
        Más adelante ajustamos campos exactos (nombre, email, teléfono, fecha, vuelo, etc.)
        Por ahora dejamos un esqueleto estándar.
      -->
      <form method="post" action="/confirm-booking.php" class="space-y-4">
        <input type="hidden" name="vehicle_code" value="<?= htmlspecialchars($vehicle_code ?? '') ?>">

        <div class="grid gap-4 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
              <?= function_exists('t') ? t('booking.first_name') : 'Nombre' ?>
            </label>
            <input type="text" name="first_name" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
              <?= function_exists('t') ? t('booking.last_name') : 'Apellidos' ?>
            </label>
            <input type="text" name="last_name" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
              <?= function_exists('t') ? t('booking.email') : 'Correo electrónico' ?>
            </label>
            <input type="email" name="email" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
              <?= function_exists('t') ? t('booking.phone') : 'Teléfono' ?>
            </label>
            <input type="tel" name="phone" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
              <?= function_exists('t') ? t('booking.date') : 'Fecha del servicio' ?>
            </label>
            <input type="date" name="service_date" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
              <?= function_exists('t') ? t('booking.time') : 'Hora de recogida' ?>
            </label>
            <input type="time" name="service_time" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
              <?= function_exists('t') ? t('booking.passengers') : 'Nº de pasajeros' ?>
            </label>
            <input type="number" name="passengers" min="1" value="1" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
              <?= function_exists('t') ? t('booking.luggage') : 'Nº de maletas' ?>
            </label>
            <input type="number" name="luggage" min="0" value="0"
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-zinc-700 mb-1">
            <?= function_exists('t') ? t('booking.flight') : 'Número de vuelo (opcional)' ?>
          </label>
          <input type="text" name="flight_number"
                 class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
        </div>

        <div>
          <label class="block text-sm font-medium text-zinc-700 mb-1">
            <?= function_exists('t') ? t('booking.notes') : 'Observaciones' ?>
          </label>
          <textarea name="notes" rows="3"
                    class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500"></textarea>
        </div>

        <div class="pt-2">
          <button type="submit"
                  class="w-full md:w-auto rounded-xl bg-amber-400 text-zinc-900 font-semibold px-8 py-3 shadow hover:-translate-y-0.5 transition">
            <?= function_exists('t') ? t('booking.confirm_cta') : 'Confirmar reserva' ?>
          </button>
        </div>
      </form>
    </div>

    <!-- Columna derecha: resumen vehículo + precio -->
    <aside class="bg-white rounded-2xl shadow-xl ring-1 ring-black/5 p-6 md:p-8">
      <h2 class="text-xl font-semibold text-zinc-900 mb-4">
        <?= function_exists('t') ? t('booking.summary_title') : 'Resumen de tu servicio' ?>
      </h2>

      <div class="flex flex-col items-center text-center">
        <?php if ($vehImg): ?>
          <img src="<?= htmlspecialchars($vehImg) ?>" alt="<?= htmlspecialchars($vehName) ?>"
               class="h-24 object-contain mb-3">
        <?php endif; ?>
        <p class="font-semibold text-zinc-900"><?= htmlspecialchars($vehName) ?></p>
        <p class="text-sm text-zinc-600">
          <?= htmlspecialchars(trim($vehPax . ($vehLugg !== '' ? " • {$vehLugg} maletas" : ''))) ?>
        </p>

        <div class="mt-4 text-3xl font-extrabold text-zinc-900">
          <?php if ($price !== null): ?>
            <?= eur($price) ?>
          <?php else: ?>
            <span class="text-zinc-400">
              <?= function_exists('t') ? t('quote.not_available') : 'No disponible' ?>
            </span>
          <?php endif; ?>
        </div>

        <p class="mt-1 text-xs text-zinc-500 text-center">
          <?= function_exists('t') ? t('home.quote_disclaimer') : 'El precio mostrado es orientativo y puede variar ligeramente según el tráfico y la disponibilidad.' ?>
        </p>
      </div>
    </aside>
  </div>
</section>

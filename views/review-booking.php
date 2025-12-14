<?php
if (!function_exists('eur')) {
  function eur($v): string {
    return number_format((float)$v, 2, ',', '.') . ' €';
  }
}

$vehicle = $vehicle ?? [];
$vehName = $vehicle['name'] ?? '';
$vehImg  = $vehicle['img'] ?? '';
$vehPax  = $vehicle['pax'] ?? '';
$vehLugg = $vehicle['luggage'] ?? '';
$data    = $data ?? [];

$night_surcharge_out = $night_surcharge_out ?? 0.0;
$night_surcharge_ret = $night_surcharge_ret ?? 0.0;
$airport_fee         = $airport_fee ?? 0.0;
$from_airport        = !empty($from_airport);
?>

<section class="relative overflow-hidden bg-[#0b1220] text-white rounded-3xl">
  <div class="absolute inset-0 opacity-25 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2
                bg-gradient-to-br from-sky-500/30 via-transparent to-transparent
                rounded-full blur-3xl"></div>
  </div>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    <div class="rounded-3xl border border-white/15 bg-white/10 backdrop-blur-md shadow-2xl overflow-hidden">
      <div class="absolute inset-0 pointer-events-none opacity-25
                  bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.20)_0%,rgba(255,255,255,0.00)_55%)]"></div>

      <div class="relative p-7 md:p-10">
        <div class="text-center max-w-3xl mx-auto">
          <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-3">
            <?= function_exists('t') ? t('review.title') : 'Revisa tu reserva' ?>
          </h1>

          <p class="text-sm md:text-base text-white/80">
            <?= function_exists('t') ? t('review.subtitle') : 'Comprueba que todos los datos son correctos antes de confirmar.' ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="py-10 bg-zinc-50">
  <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 grid gap-8 lg:grid-cols-[1.2fr,1fr]">

    <!-- Datos -->
    <div class="space-y-6">

      <div class="bg-white rounded-2xl shadow-xl ring-1 ring-black/5 p-6">
        <h2 class="text-lg font-semibold text-zinc-900 mb-3">
          <?= function_exists('t') ? t('review.route_title') : 'Trayecto' ?>
        </h2>
        <p class="text-sm text-zinc-700">
          <strong><?= function_exists('t') ? t('home.from') : 'Origen' ?>:</strong>
          <?= htmlspecialchars($origin_address ?? '') ?>
        </p>
        <p class="text-sm text-zinc-700">
          <strong><?= function_exists('t') ? t('home.to') : 'Destino' ?>:</strong>
          <?= htmlspecialchars($destination_address ?? '') ?>
        </p>
        <p class="mt-1 text-sm text-zinc-600">
          <?= number_format($km, 1, ',', '.') ?> km · <?= round($minutes) ?> min
        </p>
      </div>

      <div class="bg-white rounded-2xl shadow-xl ring-1 ring-black/5 p-6">
        <h2 class="text-lg font-semibold text-zinc-900 mb-3">
          <?= function_exists('t') ? t('review.passenger_title') : 'Pasajero' ?>
        </h2>
        <p class="text-sm text-zinc-700">
          <strong><?= htmlspecialchars(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '')) ?></strong>
        </p>
        <p class="text-sm text-zinc-700">
          <?= htmlspecialchars($data['email'] ?? '') ?> · <?= htmlspecialchars($data['phone'] ?? '') ?>
        </p>
        <p class="mt-2 text-sm text-zinc-700">
          <strong><?= function_exists('t') ? t('booking.date') : 'Fecha del servicio' ?>:</strong>
          <?= htmlspecialchars($data['service_date'] ?? '') ?>
          · <strong><?= function_exists('t') ? t('booking.time') : 'Hora' ?>:</strong>
          <?= htmlspecialchars($data['service_time'] ?? '') ?>
        </p>

        <?php if (!empty($data['flight_number'])): ?>
          <p class="text-sm text-zinc-700 mt-1">
            <strong><?= function_exists('t') ? t('booking.flight') : 'Vuelo' ?>:</strong>
            <?= htmlspecialchars($data['flight_number']) ?>
          </p>
        <?php endif; ?>

        <?php if (!empty($data['train_number'])): ?>
          <p class="text-sm text-zinc-700 mt-1">
            <strong><?= function_exists('t') ? t('booking.train') : 'Tren' ?>:</strong>
            <?= htmlspecialchars($data['train_number']) ?>
          </p>
        <?php endif; ?>

        <p class="mt-2 text-sm text-zinc-700">
          <strong><?= function_exists('t') ? t('booking.passengers') : 'Pasajeros' ?>:</strong>
          <?= (int)($data['passengers'] ?? 0) ?>
          · <strong><?= function_exists('t') ? t('booking.luggage') : 'Maletas' ?>:</strong>
          <?= (int)($data['luggage'] ?? 0) ?>
        </p>

        <?php if (!empty($data['notes'])): ?>
          <p class="mt-2 text-sm text-zinc-700">
            <strong><?= function_exists('t') ? t('booking.notes') : 'Observaciones' ?>:</strong><br>
            <?= nl2br(htmlspecialchars($data['notes'])) ?>
          </p>
        <?php endif; ?>
      </div>

      <div class="bg-white rounded-2xl shadow-xl ring-1 ring-black/5 p-6">
        <h2 class="text-lg font-semibold text-zinc-900 mb-3">
          <?= function_exists('t') ? t('booking.extras_title') : 'Extras' ?>
        </h2>
        <ul class="text-sm text-zinc-700 list-disc pl-5 space-y-1">
          <?php if (($data['extra_child_seat'] ?? 0) > 0): ?>
            <li><?= (int)$data['extra_child_seat'] ?> × <?= function_exists('t') ? t('booking.extra.child_seat') : 'Sillita infantil' ?></li>
          <?php endif; ?>
          <?php if (($data['extra_booster'] ?? 0) > 0): ?>
            <li><?= (int)$data['extra_booster'] ?> × <?= function_exists('t') ? t('booking.extra.booster') : 'Alzador' ?></li>
          <?php endif; ?>
          <?php if (($data['extra_bike'] ?? 0) > 0): ?>
            <li><?= (int)$data['extra_bike'] ?> × <?= function_exists('t') ? t('booking.extra.bike') : 'Bicicleta' ?></li>
          <?php endif; ?>
          <?php if (($data['extra_golf'] ?? 0) > 0): ?>
            <li><?= (int)$data['extra_golf'] ?> × <?= function_exists('t') ? t('booking.extra.golf') : 'Palos de golf' ?></li>
          <?php endif; ?>

          <?php if (
            ($data['extra_child_seat'] ?? 0) +
            ($data['extra_booster'] ?? 0) +
            ($data['extra_bike'] ?? 0) +
            ($data['extra_golf'] ?? 0) === 0
          ): ?>
            <li><?= function_exists('t') ? t('review.no_extras') : 'Sin extras.' ?></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>

    <!-- Precio -->
    <aside class="bg-white rounded-2xl shadow-xl ring-1 ring-black/5 p-6 md:p-8">
      <h2 class="text-xl font-semibold text-zinc-900 mb-4">
        <?= function_exists('t') ? t('review.price_title') : 'Resumen de precios' ?>
      </h2>

      <div class="flex flex-col items-center text-center mb-4">
        <?php if ($vehImg): ?>
          <img src="<?= htmlspecialchars($vehImg) ?>" alt="<?= htmlspecialchars($vehName) ?>"
               class="h-24 object-contain mb-3">
        <?php endif; ?>
        <p class="font-semibold text-zinc-900"><?= htmlspecialchars($vehName) ?></p>
        <p class="text-sm text-zinc-600">
          <?= htmlspecialchars(trim($vehPax . ($vehLugg !== '' ? " • {$vehLugg} maletas" : ''))) ?>
        </p>
        <p class="mt-1 text-xs text-zinc-500">
          <?= function_exists('t') ? t('review.vehicle_images_note') : 'Las imágenes de los vehículos son orientativas.' ?>
        </p>
      </div>

      <div class="space-y-3 text-sm text-zinc-800">
        <!-- Ida -->
        <div class="flex justify-between">
          <span><?= function_exists('t') ? t('review.outbound_base') : 'Ida: tarifa base' ?></span>
          <span><?= eur($base_out_price) ?></span>
        </div>
        <?php if ($extras_out > 0): ?>
          <div class="flex justify-between">
            <span><?= function_exists('t') ? t('review.outbound_extras') : 'Ida: extras' ?></span>
            <span><?= eur($extras_out) ?></span>
          </div>
        <?php endif; ?>
        <?php if ($night_surcharge_out > 0): ?>
          <div class="flex justify-between">
            <span><?= function_exists('t') ? t('review.outbound_night') : 'Ida: recargo nocturno (10 %)' ?></span>
            <span><?= eur($night_surcharge_out) ?></span>
          </div>
        <?php endif; ?>
        <div class="flex justify-between font-semibold">
          <span><?= function_exists('t') ? t('review.outbound_total') : 'Ida: total' ?></span>
          <span><?= eur($total_out) ?></span>
        </div>

        <!-- Vuelta -->
        <?php if (!empty($data['return_trip']) && $base_return_price !== null): ?>
          <hr class="my-2">
          <div class="flex justify-between">
            <span><?= function_exists('t') ? t('review.return_base') : 'Vuelta: tarifa base' ?></span>
            <span><?= eur($base_return_price) ?></span>
          </div>
          <?php if ($extras_return > 0): ?>
            <div class="flex justify-between">
              <span><?= function_exists('t') ? t('review.return_extras') : 'Vuelta: extras' ?></span>
              <span><?= eur($extras_return) ?></span>
            </div>
          <?php endif; ?>
          <?php if ($night_surcharge_ret > 0): ?>
            <div class="flex justify-between">
              <span><?= function_exists('t') ? t('review.return_night') : 'Vuelta: recargo nocturno (10 %)' ?></span>
              <span><?= eur($night_surcharge_ret) ?></span>
            </div>
          <?php endif; ?>
          <div class="flex justify-between font-semibold">
            <span><?= function_exists('t') ? t('review.return_total') : 'Vuelta: total' ?></span>
            <span><?= eur($total_return) ?></span>
          </div>
        <?php elseif (!empty($data['return_trip']) && $base_return_price === null): ?>
          <hr class="my-2">
          <p class="text-xs text-amber-700">
            <?= function_exists('t') ? t('booking.return_price_na') : 'No hay tarifa de zona definida para la vuelta. Contacta con nosotros para confirmar el precio.' ?>
          </p>
        <?php endif; ?>

        <hr class="my-2">
        <div class="flex justify-between text-base font-bold">
          <span><?= function_exists('t') ? t('review.grand_total') : 'Total a pagar' ?></span>
          <span><?= eur($grand_total) ?></span>
        </div>
      </div>

      <?php if ($from_airport && $airport_fee > 0): ?>
        <p class="mt-3 text-xs text-sky-700 text-center">
          <?= function_exists('t') ? t('review.airport_wait_info') : 'Este precio incluye ya un suplemento de 5,00 € por la espera de 1 hora en el aeropuerto.' ?>
        </p>
      <?php endif; ?>

      <p class="mt-3 text-xs text-zinc-500 text-center">
        <?= function_exists('t') ? t('home.quote_disclaimer') : 'El precio mostrado es orientativo y puede variar ligeramente según el tráfico y la disponibilidad.' ?>
      </p>

      <!-- Botón confirmar reserva -->
      <form method="post" action="/confirm-booking.php" class="mt-5 text-center">
        <button type="submit"
                class="rounded-xl bg-amber-400 text-zinc-900 font-semibold px-8 py-3 shadow hover:-translate-y-0.5 transition">
          <?= function_exists('t') ? t('review.confirm_cta') : 'Confirmar reserva' ?>
        </button>
      </form>
    </aside>
  </div>
</section>

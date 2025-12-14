<?php
// views/booking.php — formulario + resumen dinámico (con traducciones via t())

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
$price   = $price ?? null;            // ida
$return_price = $return_price ?? null; // vuelta

$vehName  = $vehicle['name'] ?? '';
$vehImg   = $vehicle['img'] ?? '';
$vehPax   = $vehicle['pax'] ?? '';
$vehLugg  = $vehicle['luggage'] ?? '';

$ask_flight = !empty($ask_flight);
$ask_train  = !empty($ask_train);

// 👉 Para la vuelta, el ORIGEN de la vuelta es el destino de la ida
$return_origin_is_airport =
    stripos($destination_address, 'AGP') !== false
 || stripos($destination_address, 'Aeropuerto de Málaga') !== false
 || stripos($destination_address, 'airport') !== false;

$return_origin_is_train =
    stripos($destination_address, 'estación') !== false
 || stripos($destination_address, 'train') !== false
 || stripos($destination_address, 'María Zambrano') !== false
 || stripos($destination_address, 'Estación de Málaga') !== false;

// Textos para JS (traducibles)
$i18n = [
  'yes'           => function_exists('t') ? t('common.yes') : 'Sí',
  'no'            => function_exists('t') ? t('common.no') : 'No',
  'na'            => function_exists('t') ? t('common.na') : '—',
  'not_available' => function_exists('t') ? t('quote.not_available') : 'No disponible',
  'rt_na'         => function_exists('t') ? t('booking.roundtrip_na') : 'No disponible para ida + vuelta (consulta por WhatsApp).',
];
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
          <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-4">
            <?= function_exists('t') ? t('booking.title') : 'Completa tu reserva' ?>
          </h1>

          <div class="mt-5 inline-block text-left rounded-2xl bg-white/5 border border-white/10 px-5 py-4">
            <div class="grid gap-2 text-white/90 text-sm">
              <p>
                <strong><?= function_exists('t') ? t('home.from') : 'Origen' ?>:</strong>
                <span class="text-white/80"><?= htmlspecialchars($origin_address) ?></span>
              </p>
              <p>
                <strong><?= function_exists('t') ? t('home.to') : 'Destino' ?>:</strong>
                <span class="text-white/80"><?= htmlspecialchars($destination_address) ?></span>
              </p>
              <p class="text-white/70">
                • <strong><?= function_exists('t') ? t('home.distance') : 'Distancia' ?>:</strong>
                <?= number_format($km, 1, ',', '.') ?> km
                · <strong><?= function_exists('t') ? t('home.duration') : 'Duración estimada' ?>:</strong>
                <?= round($minutes) ?> min
              </p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-10 bg-zinc-50">
  <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 grid gap-8 lg:grid-cols-[1.2fr,1fr]">

    <!-- Formulario -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-black/5 p-6 md:p-8">
      <h2 class="text-xl font-semibold text-zinc-900 mb-4">
        <?= function_exists('t') ? t('booking.passenger_details') : 'Datos del pasajero' ?>
      </h2>

      <form method="post" action="/review-booking.php" class="space-y-4" id="bookingForm">
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

        <!-- Vuelo / Tren según ORIGEN (ida) -->
        <?php if ($ask_flight): ?>
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
              <?= function_exists('t') ? t('booking.flight') : 'Número de vuelo' ?>
            </label>
            <input type="text" name="flight_number" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
        <?php elseif ($ask_train): ?>
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
              <?= function_exists('t') ? t('booking.train') : 'Número de tren' ?>
            </label>
            <input type="text" name="train_number" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
        <?php endif; ?>

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

        <!-- ¿Traslado de vuelta? -->
        <div class="pt-2">
          <label class="block text-sm font-medium text-zinc-700 mb-1">
            <?= function_exists('t') ? t('booking.return_trip') : '¿Quieres traslado de vuelta?' ?>
          </label>
          <div class="mt-1 flex gap-4 text-sm text-zinc-700">
            <label class="inline-flex items-center gap-1">
              <input type="radio" name="return_trip" value="no" checked>
              <span><?= function_exists('t') ? t('booking.return_no') : 'No' ?></span>
            </label>
            <label class="inline-flex items-center gap-1">
              <input type="radio" name="return_trip" value="yes" id="returnYes">
              <span><?= function_exists('t') ? t('booking.return_yes') : 'Sí' ?></span>
            </label>
          </div>
        </div>

        <div id="returnFields" class="mt-3 hidden border border-dashed border-zinc-300 rounded-xl p-3">
          <div class="grid gap-4 sm:grid-cols-2">
            <div>
              <label class="block text-sm font-medium text-zinc-700 mb-1">
                <?= function_exists('t') ? t('booking.return_date') : 'Fecha de vuelta' ?>
              </label>
              <input type="date" name="return_date"
                     class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
            <div>
              <label class="block text-sm font-medium text-zinc-700 mb-1">
                <?= function_exists('t') ? t('booking.return_time') : 'Hora de recogida (vuelta)' ?>
              </label>
              <input type="time" name="return_time"
                     class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
          </div>

          <?php if ($return_origin_is_airport): ?>
            <div class="mt-3">
              <label class="block text-sm font-medium text-zinc-700 mb-1">
                <?= function_exists('t') ? t('booking.return_flight') : 'Número de vuelo (vuelta)' ?>
              </label>
              <input type="text" name="return_flight_number"
                     class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
          <?php endif; ?>

          <?php if ($return_origin_is_train): ?>
            <div class="mt-3">
              <label class="block text-sm font-medium text-zinc-700 mb-1">
                <?= function_exists('t') ? t('booking.return_train') : 'Número de tren (vuelta)' ?>
              </label>
              <input type="text" name="return_train_number"
                     class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
          <?php endif; ?>

          <p class="mt-2 text-sm text-zinc-600">
            <?= function_exists('t') ? t('booking.return_price_hint') : 'El precio de la vuelta se calcula según la tarifa de zona del trayecto de regreso.' ?>
          </p>

          <p class="mt-1 text-sm font-semibold text-zinc-900">
            <?= function_exists('t') ? t('booking.return_price_label') : 'Precio trayecto de vuelta:' ?>
            <?php if ($return_price !== null): ?>
              <?= eur($return_price) ?>
            <?php else: ?>
              <span class="text-amber-600">
                <?= function_exists('t') ? t('booking.return_price_na') : 'No disponible para esta combinación, consúltanos.' ?>
              </span>
            <?php endif; ?>
          </p>
        </div>

        <!-- Extras -->
        <div class="pt-4 border-t border-zinc-200 mt-4">
          <h3 class="text-sm font-semibold text-zinc-900 mb-1">
            <?= function_exists('t') ? t('booking.extras_title') : 'Extras' ?>
          </h3>
          <p class="text-xs text-zinc-500 mb-3">
            <?= function_exists('t')
                  ? t('booking.extras_hint')
                  : 'Cada extra suma 10 € por unidad y trayecto (ida y, si aplica, vuelta).' ?>
          </p>

          <div class="grid gap-3 sm:grid-cols-2">
            <div>
              <label class="block text-xs font-medium text-zinc-700 mb-1">
                <?= function_exists('t') ? t('booking.extra.child_seat') : 'Sillita infantil' ?>
              </label>
              <input type="number" name="extra_child_seat" min="0" value="0"
                     class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
            <div>
              <label class="block text-xs font-medium text-zinc-700 mb-1">
                <?= function_exists('t') ? t('booking.extra.booster') : 'Alzador' ?>
              </label>
              <input type="number" name="extra_booster" min="0" value="0"
                     class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
            <div>
              <label class="block text-xs font-medium text-zinc-700 mb-1">
                <?= function_exists('t') ? t('booking.extra.bike') : 'Bicicleta' ?>
              </label>
              <input type="number" name="extra_bike" min="0" value="0"
                     class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
            <div>
              <label class="block text-xs font-medium text-zinc-700 mb-1">
                <?= function_exists('t') ? t('booking.extra.golf') : 'Palos de golf' ?>
              </label>
              <input type="number" name="extra_golf" min="0" value="0"
                     class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
          </div>
        </div>

        <div class="pt-2">
          <label class="block text-sm font-medium text-zinc-700 mb-1">
            <?= function_exists('t') ? t('booking.notes') : 'Observaciones' ?>
          </label>
          <textarea name="notes" rows="3"
                    class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500"></textarea>
        </div>

        <div class="pt-2">
          <button type="submit"
                  class="w-full md:w-auto rounded-xl bg-amber-400 text-zinc-900 font-semibold px-8 py-3 shadow hover:-translate-y-0.5 transition">
            <?= function_exists('t') ? t('booking.review_cta') : 'Ver resumen' ?>
          </button>
        </div>
      </form>
    </div>

    <!-- Resumen -->
    <aside class="bg-white rounded-2xl shadow-xl ring-1 ring-black/5 p-6 md:p-8">
      <h2 class="text-xl font-semibold text-zinc-900 mb-4">
        <?= function_exists('t') ? t('booking.summary_title') : 'Resumen de tu servicio' ?>
      </h2>

      <div class="flex flex-col items-center text-center">
        <?php if ($vehImg): ?>
          <img src="<?= htmlspecialchars($vehImg) ?>" alt="<?= htmlspecialchars($vehName) ?>" class="h-24 object-contain mb-3">
        <?php endif; ?>

        <p class="font-semibold text-zinc-900"><?= htmlspecialchars($vehName) ?></p>
        <p class="text-sm text-zinc-600">
          <?= htmlspecialchars(trim($vehPax . ($vehLugg !== '' ? " • {$vehLugg} Maletas medianas" : ''))) ?>
        </p>

        <!-- Precio principal (JS lo cambia a total cuando hay vuelta/extras) -->
        <div class="mt-4 text-3xl font-extrabold text-zinc-900">
          <span id="priceMain">
            <?php if ($price !== null): ?>
              <?= eur($price) ?>
            <?php else: ?>
              <span class="text-zinc-400"><?= htmlspecialchars($i18n['not_available']) ?></span>
            <?php endif; ?>
          </span>
        </div>

        <p class="mt-1 text-xs text-zinc-500 text-center">
          <?= function_exists('t') ? t('home.quote_disclaimer') : 'El precio mostrado es orientativo y puede variar ligeramente según el tráfico y la disponibilidad.' ?>
        </p>

        <!-- Desglose (traducible) -->
        <div class="mt-4 w-full text-left">
          <div class="rounded-xl border border-zinc-200 p-4 text-sm text-zinc-700 space-y-2">
            <div class="flex justify-between gap-3">
              <span class="text-zinc-500"><?= function_exists('t') ? t('booking.outbound') : 'Ida' ?></span>
              <span id="bdOut"><?= $price !== null ? eur($price) : htmlspecialchars($i18n['na']) ?></span>
            </div>

            <div class="flex justify-between gap-3" id="bdReturnRow" style="display:none;">
              <span class="text-zinc-500"><?= function_exists('t') ? t('booking.return') : 'Vuelta' ?></span>
              <span id="bdReturn"><?= $return_price !== null ? eur($return_price) : htmlspecialchars($i18n['na']) ?></span>
            </div>

            <div class="flex justify-between gap-3">
              <span class="text-zinc-500"><?= function_exists('t') ? t('booking.extras') : 'Extras' ?></span>
              <span id="bdExtras">0 €</span>
            </div>

            <div class="pt-2 border-t border-zinc-200"></div>

            <div class="flex justify-between gap-3 font-semibold">
              <span><?= function_exists('t') ? t('booking.total') : 'Total' ?></span>
              <span id="bdTotal"><?= $price !== null ? eur($price) : htmlspecialchars($i18n['na']) ?></span>
            </div>

            <div id="bdTotalNote" class="text-xs text-amber-700" style="display:none;"></div>
          </div>
        </div>

        <!-- Resumen dinámico (traducible) -->
        <div class="mt-5 w-full text-left">
          <div class="rounded-xl border border-zinc-200 p-4 text-sm text-zinc-700 space-y-2">
            <div class="flex justify-between gap-3"><span class="text-zinc-500"><?= function_exists('t') ? t('booking.first_name') : 'Nombre' ?></span><span data-sum="full_name"><?= htmlspecialchars($i18n['na']) ?></span></div>
            <div class="flex justify-between gap-3"><span class="text-zinc-500"><?= function_exists('t') ? t('booking.email') : 'Email' ?></span><span data-sum="email"><?= htmlspecialchars($i18n['na']) ?></span></div>
            <div class="flex justify-between gap-3"><span class="text-zinc-500"><?= function_exists('t') ? t('booking.phone') : 'Teléfono' ?></span><span data-sum="phone"><?= htmlspecialchars($i18n['na']) ?></span></div>

            <div class="pt-2 border-t border-zinc-200"></div>

            <div class="flex justify-between gap-3"><span class="text-zinc-500"><?= function_exists('t') ? t('booking.date') : 'Fecha' ?></span><span data-sum="service_date"><?= htmlspecialchars($i18n['na']) ?></span></div>
            <div class="flex justify-between gap-3"><span class="text-zinc-500"><?= function_exists('t') ? t('booking.time') : 'Hora' ?></span><span data-sum="service_time"><?= htmlspecialchars($i18n['na']) ?></span></div>

            <div class="flex justify-between gap-3" data-sum-row="flight" style="display:none;">
              <span class="text-zinc-500"><?= function_exists('t') ? t('booking.flight') : 'Vuelo' ?></span><span data-sum="flight_number"><?= htmlspecialchars($i18n['na']) ?></span>
            </div>
            <div class="flex justify-between gap-3" data-sum-row="train" style="display:none;">
              <span class="text-zinc-500"><?= function_exists('t') ? t('booking.train') : 'Tren' ?></span><span data-sum="train_number"><?= htmlspecialchars($i18n['na']) ?></span>
            </div>

            <div class="pt-2 border-t border-zinc-200"></div>

            <div class="flex justify-between gap-3"><span class="text-zinc-500"><?= function_exists('t') ? t('booking.passengers') : 'Pasajeros' ?></span><span data-sum="passengers">1</span></div>
            <div class="flex justify-between gap-3"><span class="text-zinc-500"><?= function_exists('t') ? t('booking.luggage') : 'Maletas' ?></span><span data-sum="luggage">0</span></div>

            <div class="pt-2 border-t border-zinc-200"></div>

            <div class="flex justify-between gap-3">
              <span class="text-zinc-500"><?= function_exists('t') ? t('booking.return_trip') : 'Vuelta' ?></span>
              <span data-sum="return_trip"><?= htmlspecialchars($i18n['no']) ?></span>
            </div>

            <div data-sum-block="return" class="space-y-2" style="display:none;">
              <div class="flex justify-between gap-3"><span class="text-zinc-500"><?= function_exists('t') ? t('booking.return_date') : 'Fecha vuelta' ?></span><span data-sum="return_date"><?= htmlspecialchars($i18n['na']) ?></span></div>
              <div class="flex justify-between gap-3"><span class="text-zinc-500"><?= function_exists('t') ? t('booking.return_time') : 'Hora vuelta' ?></span><span data-sum="return_time"><?= htmlspecialchars($i18n['na']) ?></span></div>
            </div>
          </div>
        </div>

      </div>
    </aside>

  </div>
</section>

<script>
// Precios (desde PHP) + traducciones (desde t())
window.__BOOKING_PRICES__ = {
  out: <?= $price !== null ? json_encode((float)$price) : 'null' ?>,
  ret: <?= $return_price !== null ? json_encode((float)$return_price) : 'null' ?>
};

window.__I18N__ = <?= json_encode($i18n, JSON_UNESCAPED_UNICODE) ?>;

(function(){
  const form   = document.getElementById('bookingForm');
  const box    = document.getElementById('returnFields');
  const radios = document.querySelectorAll('input[name="return_trip"]');

  if (!form) return;

  const prices = window.__BOOKING_PRICES__ || { out:null, ret:null };
  const i18n   = window.__I18N__ || { yes:'Sí', no:'No', na:'—', not_available:'No disponible', rt_na:'' };

  // Usa el idioma del <html lang="..."> si existe
  const locale = (document.documentElement && document.documentElement.lang)
    ? document.documentElement.lang
    : 'es-ES';

  const eur = (n) => {
    const val = Number(n || 0);
    return new Intl.NumberFormat(locale, { style:'currency', currency:'EUR' }).format(val);
  };

  const get = (name) => form.querySelector(`[name="${name}"]`);
  const txt = (name) => (get(name)?.value || '').trim();

  const setSum = (key, value) => {
    const el = document.querySelector(`[data-sum="${key}"]`);
    if (el) el.textContent = value;
  };

  const show = (selector, on) => {
    const el = document.querySelector(selector);
    if (el) el.style.display = on ? '' : 'none';
  };

  function isReturnYes(){
    let val = 'no';
    radios.forEach(r => { if (r.checked) val = r.value; });
    return val === 'yes';
  }

  function updateReturnVisibility(){
    if (!box) return;
    box.classList.toggle('hidden', !isReturnYes());
  }

  function calcExtrasTotal(){
    const child = parseInt(txt('extra_child_seat') || '0', 10) || 0;
    const boost = parseInt(txt('extra_booster') || '0', 10) || 0;
    const bike  = parseInt(txt('extra_bike') || '0', 10) || 0;
    const golf  = parseInt(txt('extra_golf') || '0', 10) || 0;

    const extrasCount = child + boost + bike + golf;
    const extrasPerTrip = extrasCount * 10;
    const trips = isReturnYes() ? 2 : 1;
    return extrasPerTrip * trips;
  }

  function updatePriceTotals(){
    const main = document.getElementById('priceMain');
    const bdOut = document.getElementById('bdOut');
    const bdReturnRow = document.getElementById('bdReturnRow');
    const bdReturn = document.getElementById('bdReturn');
    const bdExtras = document.getElementById('bdExtras');
    const bdTotal = document.getElementById('bdTotal');
    const bdNote = document.getElementById('bdTotalNote');

    const extrasTotal = calcExtrasTotal();
    const rYes = isReturnYes();

    if (bdOut) bdOut.textContent = (prices.out != null) ? eur(prices.out) : i18n.na;
    if (bdExtras) bdExtras.textContent = eur(extrasTotal);

    if (rYes) {
      if (bdReturnRow) bdReturnRow.style.display = '';
      if (bdReturn) bdReturn.textContent = (prices.ret != null) ? eur(prices.ret) : i18n.na;
    } else {
      if (bdReturnRow) bdReturnRow.style.display = 'none';
    }

    let total = null;

    if (!rYes) {
      if (prices.out != null) total = prices.out + extrasTotal;
    } else {
      if (prices.out != null && prices.ret != null) total = prices.out + prices.ret + extrasTotal;
    }

    if (bdTotal) bdTotal.textContent = (total != null) ? eur(total) : i18n.na;

    const showNote = rYes && (prices.out == null || prices.ret == null);
    if (bdNote) {
      bdNote.textContent = i18n.rt_na;
      bdNote.style.display = showNote ? '' : 'none';
    }

    if (!main) return;

    // Precio principal: total si existe, si no -> ida si existe, si no -> not_available
    if (total != null) {
      main.textContent = eur(total);
    } else if (prices.out != null) {
      main.textContent = eur(prices.out);
    } else {
      main.textContent = i18n.not_available;
      main.classList.add('text-zinc-400');
    }
  }

  function updateSummary(){
    const fullName = [txt('first_name'), txt('last_name')].filter(Boolean).join(' ');
    setSum('full_name', fullName || i18n.na);
    setSum('email', txt('email') || i18n.na);
    setSum('phone', txt('phone') || i18n.na);

    setSum('service_date', txt('service_date') || i18n.na);
    setSum('service_time', txt('service_time') || i18n.na);

    const flightInput = get('flight_number');
    const trainInput  = get('train_number');

    if (flightInput) {
      show('[data-sum-row="flight"]', true);
      setSum('flight_number', txt('flight_number') || i18n.na);
    } else {
      show('[data-sum-row="flight"]', false);
    }

    if (trainInput) {
      show('[data-sum-row="train"]', true);
      setSum('train_number', txt('train_number') || i18n.na);
    } else {
      show('[data-sum-row="train"]', false);
    }

    setSum('passengers', txt('passengers') || '1');
    setSum('luggage', txt('luggage') || '0');

    const rYes = isReturnYes();
    setSum('return_trip', rYes ? i18n.yes : i18n.no);
    show('[data-sum-block="return"]', rYes);

    if (rYes) {
      setSum('return_date', txt('return_date') || i18n.na);
      setSum('return_time', txt('return_time') || i18n.na);
    }

    updatePriceTotals();
  }

  form.addEventListener('input', updateSummary);
  form.addEventListener('change', () => {
    updateReturnVisibility();
    updateSummary();
  });

  updateReturnVisibility();
  updateSummary();
})();
</script>

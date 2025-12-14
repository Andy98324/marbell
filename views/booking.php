<?php
// views/booking.php — formulario + resumen dinámico (todo traducible, sin mostrar claves)

// Helper € (si no existe)
if (!function_exists('eur')) {
  function eur($v): string {
    return number_format((float)$v, 2, ',', '.') . ' €';
  }
}

// ✅ Helper traducción seguro: si falta la clave NO imprime "booking.xxx"
if (!function_exists('tt')) {
  function tt(string $key, string $fallback = ''): string {
    if (!function_exists('t')) return $fallback;
    $v = (string)t($key);
    return ($v === $key) ? $fallback : $v;
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
  'yes'           => tt('common.yes', 'Yes'),
  'no'            => tt('common.no', 'No'),
  'not_available' => tt('quote.not_available', 'Price not available'),
  'rt_na'         => tt('booking.roundtrip_na', 'Not available for outbound + return (ask us on WhatsApp).'),
];
?>

<!-- HERO -->
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
            <?= tt('booking.title', 'Complete your booking') ?>
          </h1>

          <div class="mt-5 inline-block text-left rounded-2xl bg-white/5 border border-white/10 px-5 py-4">
            <div class="grid gap-2 text-white/90 text-sm">
              <p>
                <strong><?= tt('home.from', 'From') ?>:</strong>
                <span class="text-white/80"><?= htmlspecialchars($origin_address) ?></span>
              </p>
              <p>
                <strong><?= tt('home.to', 'To') ?>:</strong>
                <span class="text-white/80"><?= htmlspecialchars($destination_address) ?></span>
              </p>
              <p class="text-white/70">
                • <strong><?= tt('home.distance', 'Distance') ?>:</strong>
                <?= number_format($km, 1, ',', '.') ?> km
                · <strong><?= tt('home.duration', 'Estimated duration') ?>:</strong>
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

    <!-- FORMULARIO -->
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-black/5 p-6 md:p-8">
      <h2 class="text-xl font-semibold text-zinc-900 mb-4">
        <?= tt('booking.passenger_details', 'Passenger details') ?>
      </h2>

      <form method="post" action="/review-booking.php" class="space-y-4" id="bookingForm">
        <input type="hidden" name="vehicle_code" value="<?= htmlspecialchars($vehicle_code ?? '') ?>">

        <div class="grid gap-4 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1"><?= tt('booking.first_name', 'First name') ?></label>
            <input type="text" name="first_name" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1"><?= tt('booking.last_name', 'Last name') ?></label>
            <input type="text" name="last_name" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1"><?= tt('booking.email', 'Email') ?></label>
            <input type="email" name="email" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1"><?= tt('booking.phone', 'Phone') ?></label>
            <input type="tel" name="phone" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1"><?= tt('booking.date', 'Service date') ?></label>
            <input type="date" name="service_date" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1"><?= tt('booking.time', 'Pickup time') ?></label>
            <input type="time" name="service_time" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
        </div>

        <!-- Vuelo / Tren -->
        <?php if ($ask_flight): ?>
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1"><?= tt('booking.flight', 'Flight number') ?></label>
            <input type="text" name="flight_number" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
        <?php elseif ($ask_train): ?>
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1"><?= tt('booking.train', 'Train number') ?></label>
            <input type="text" name="train_number" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
        <?php endif; ?>

        <div class="grid gap-4 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1"><?= tt('booking.passengers', 'Number of passengers') ?></label>
            <input type="number" name="passengers" min="1" value="1" required
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1"><?= tt('booking.luggage', 'Number of suitcases') ?></label>
            <input type="number" name="luggage" min="0" value="0"
                   class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
          </div>
        </div>

        <!-- VUELTA -->
        <div class="pt-2">
          <label class="block text-sm font-medium text-zinc-700 mb-1"><?= tt('booking.return_trip', 'Do you need a return transfer?') ?></label>
          <div class="mt-1 flex gap-4 text-sm text-zinc-700">
            <label class="inline-flex items-center gap-1">
              <input type="radio" name="return_trip" value="no" checked>
              <span><?= tt('booking.return_no', 'No') ?></span>
            </label>
            <label class="inline-flex items-center gap-1">
              <input type="radio" name="return_trip" value="yes" id="returnYes">
              <span><?= tt('booking.return_yes', 'Yes') ?></span>
            </label>
          </div>
        </div>

        <div id="returnFields" class="mt-3 hidden border border-dashed border-zinc-300 rounded-xl p-3">
          <div class="grid gap-4 sm:grid-cols-2">
            <div>
              <label class="block text-sm font-medium text-zinc-700 mb-1"><?= tt('booking.return_date', 'Return date') ?></label>
              <input type="date" name="return_date"
                     class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
            <div>
              <label class="block text-sm font-medium text-zinc-700 mb-1"><?= tt('booking.return_time', 'Return pickup time') ?></label>
              <input type="time" name="return_time"
                     class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
          </div>

          <?php if ($return_origin_is_airport): ?>
            <div class="mt-3">
              <label class="block text-sm font-medium text-zinc-700 mb-1"><?= tt('booking.return_flight', 'Return flight number') ?></label>
              <input type="text" name="return_flight_number"
                     class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
          <?php endif; ?>

          <?php if ($return_origin_is_train): ?>
            <div class="mt-3">
              <label class="block text-sm font-medium text-zinc-700 mb-1"><?= tt('booking.return_train', 'Return train number') ?></label>
              <input type="text" name="return_train_number"
                     class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
          <?php endif; ?>

          <p class="mt-2 text-sm text-zinc-600">
            <?= tt('booking.return_price_hint', 'Return price is calculated based on the zone fare for the return route.') ?>
          </p>

          <p class="mt-1 text-sm font-semibold text-zinc-900">
            <?= tt('booking.return_price_label', 'Return trip price:') ?>
            <?php if ($return_price !== null): ?>
              <?= eur($return_price) ?>
            <?php else: ?>
              <span class="text-amber-600">
                <?= tt('booking.return_price_na', 'Not available for this combination, ask us.') ?>
              </span>
            <?php endif; ?>
          </p>
        </div>

        <!-- EXTRAS -->
        <div class="pt-4 border-t border-zinc-200 mt-4">
          <h3 class="text-sm font-semibold text-zinc-900 mb-1"><?= tt('booking.extras_title', 'Extras') ?></h3>
          <p class="text-xs text-zinc-500 mb-3">
            <?= tt('booking.extras_hint', 'Each extra adds €10 per unit and per journey (outbound and, if applicable, return).') ?>
          </p>

          <div class="grid gap-3 sm:grid-cols-2">
            <div>
              <label class="block text-xs font-medium text-zinc-700 mb-1"><?= tt('booking.extra.child_seat', 'Child seat') ?></label>
              <input type="number" name="extra_child_seat" min="0" value="0"
                     class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
            <div>
              <label class="block text-xs font-medium text-zinc-700 mb-1"><?= tt('booking.extra.booster', 'Booster seat') ?></label>
              <input type="number" name="extra_booster" min="0" value="0"
                     class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
            <div>
              <label class="block text-xs font-medium text-zinc-700 mb-1"><?= tt('booking.extra.bike', 'Bicycle') ?></label>
              <input type="number" name="extra_bike" min="0" value="0"
                     class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
            <div>
              <label class="block text-xs font-medium text-zinc-700 mb-1"><?= tt('booking.extra.golf', 'Golf clubs') ?></label>
              <input type="number" name="extra_golf" min="0" value="0"
                     class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
          </div>
        </div>

        <div class="pt-2">
          <label class="block text-sm font-medium text-zinc-700 mb-1"><?= tt('booking.notes', 'Notes') ?></label>
          <textarea name="notes" rows="3"
                    class="w-full rounded-xl border border-zinc-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500"></textarea>
        </div>

        <div class="pt-2">
          <button type="submit"
                  class="w-full md:w-auto rounded-xl bg-amber-400 text-zinc-900 font-semibold px-8 py-3 shadow hover:-translate-y-0.5 transition">
            <?= tt('booking.review_cta', 'Review summary') ?>
          </button>
        </div>
      </form>
    </div>

    <!-- RESUMEN -->
    <aside class="bg-white rounded-2xl shadow-xl ring-1 ring-black/5 p-6 md:p-8">
      <h2 class="text-xl font-semibold text-zinc-900 mb-4">
        <?= tt('booking.summary_title', 'Your service summary') ?>
      </h2>

      <div class="flex flex-col items-center text-center">
        <?php if ($vehImg): ?>
          <img src="<?= htmlspecialchars($vehImg) ?>" alt="<?= htmlspecialchars($vehName) ?>" class="h-24 object-contain mb-3">
        <?php endif; ?>

        <p class="font-semibold text-zinc-900"><?= htmlspecialchars($vehName) ?></p>
        <p class="text-sm text-zinc-600">
          <?= htmlspecialchars(trim($vehPax . ($vehLugg !== '' ? " • {$vehLugg} " . tt('booking.medium_suitcases','Medium suitcases') : ''))) ?>
        </p>

        <!-- Precio principal -->
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
          <?= tt('home.quote_disclaimer', 'Displayed price is an approximation and may vary slightly depending on traffic and availability.') ?>
        </p>

        <!-- Desglose (sin claves visibles nunca) -->
        <div class="mt-4 w-full text-left">
          <div class="rounded-xl border border-zinc-200 p-4 text-sm text-zinc-700 space-y-2">
            <div class="flex justify-between gap-3">
              <span class="text-zinc-500"><?= tt('booking.outbound', 'Outbound') ?></span>
              <span id="bdOut"><?= $price !== null ? eur($price) : '' ?></span>
            </div>

            <div class="flex justify-between gap-3" id="bdReturnRow" style="display:none;">
              <span class="text-zinc-500"><?= tt('booking.return', 'Return') ?></span>
              <span id="bdReturn"><?= $return_price !== null ? eur($return_price) : '' ?></span>
            </div>

            <div class="flex justify-between gap-3">
              <span class="text-zinc-500"><?= tt('booking.extras', 'Extras') ?></span>
              <span id="bdExtras">0 €</span>
            </div>

            <div class="pt-2 border-t border-zinc-200"></div>

            <div class="flex justify-between gap-3 font-semibold">
              <span><?= tt('booking.total', 'Total') ?></span>
              <span id="bdTotal"><?= $price !== null ? eur($price) : '' ?></span>
            </div>

            <div id="bdTotalNote" class="text-xs text-amber-700" style="display:none;"></div>
          </div>
        </div>

        <!-- Resumen datos (si está vacío, NO se muestra nada) -->
        <div class="mt-5 w-full text-left">
          <div class="rounded-xl border border-zinc-200 p-4 text-sm text-zinc-700 space-y-2">
            <div class="flex justify-between gap-3">
              <span class="text-zinc-500"><?= tt('booking.first_name', 'First name') ?></span>
              <span data-sum="full_name"></span>
            </div>
            <div class="flex justify-between gap-3">
              <span class="text-zinc-500"><?= tt('booking.email', 'Email') ?></span>
              <span data-sum="email"></span>
            </div>
            <div class="flex justify-between gap-3">
              <span class="text-zinc-500"><?= tt('booking.phone', 'Phone') ?></span>
              <span data-sum="phone"></span>
            </div>

            <div class="pt-2 border-t border-zinc-200"></div>

            <div class="flex justify-between gap-3">
              <span class="text-zinc-500"><?= tt('booking.date', 'Service date') ?></span>
              <span data-sum="service_date"></span>
            </div>
            <div class="flex justify-between gap-3">
              <span class="text-zinc-500"><?= tt('booking.time', 'Pickup time') ?></span>
              <span data-sum="service_time"></span>
            </div>

            <div class="flex justify-between gap-3" data-sum-row="flight" style="display:none;">
              <span class="text-zinc-500"><?= tt('booking.flight', 'Flight number') ?></span>
              <span data-sum="flight_number"></span>
            </div>
            <div class="flex justify-between gap-3" data-sum-row="train" style="display:none;">
              <span class="text-zinc-500"><?= tt('booking.train', 'Train number') ?></span>
              <span data-sum="train_number"></span>
            </div>

            <div class="pt-2 border-t border-zinc-200"></div>

            <div class="flex justify-between gap-3">
              <span class="text-zinc-500"><?= tt('booking.passengers', 'Number of passengers') ?></span>
              <span data-sum="passengers">1</span>
            </div>
            <div class="flex justify-between gap-3">
              <span class="text-zinc-500"><?= tt('booking.luggage', 'Number of suitcases') ?></span>
              <span data-sum="luggage">0</span>
            </div>

            <div class="pt-2 border-t border-zinc-200"></div>

            <div class="flex justify-between gap-3">
              <span class="text-zinc-500"><?= tt('booking.return_trip', 'Do you need a return transfer?') ?></span>
              <span data-sum="return_trip"></span>
            </div>

            <div data-sum-block="return" class="space-y-2" style="display:none;">
              <div class="flex justify-between gap-3">
                <span class="text-zinc-500"><?= tt('booking.return_date', 'Return date') ?></span>
                <span data-sum="return_date"></span>
              </div>
              <div class="flex justify-between gap-3">
                <span class="text-zinc-500"><?= tt('booking.return_time', 'Return pickup time') ?></span>
                <span data-sum="return_time"></span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </aside>

  </div>
</section>

<script>
// Precios + textos traducibles (sin mostrar claves)
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
  const i18n   = window.__I18N__ || { yes:'Yes', no:'No', not_available:'Price not available', rt_na:'' };

  const locale = document.documentElement?.lang || 'en-GB';
  const eur = (n) => new Intl.NumberFormat(locale, { style:'currency', currency:'EUR' }).format(Number(n||0));

  const get = (name) => form.querySelector(`[name="${name}"]`);
  const txt = (name) => (get(name)?.value || '').trim();

  const setSum = (key, value) => {
    const el = document.querySelector(`[data-sum="${key}"]`);
    if (!el) return;
    el.textContent = value ? value : ''; // ✅ vacío si no hay texto
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

    if (bdOut) bdOut.textContent = (prices.out != null) ? eur(prices.out) : '';
    if (bdExtras) bdExtras.textContent = eur(extrasTotal);

    if (rYes) {
      if (bdReturnRow) bdReturnRow.style.display = '';
      if (bdReturn) bdReturn.textContent = (prices.ret != null) ? eur(prices.ret) : '';
    } else {
      if (bdReturnRow) bdReturnRow.style.display = 'none';
    }

    let total = null;
    if (!rYes) {
      if (prices.out != null) total = prices.out + extrasTotal;
    } else {
      if (prices.out != null && prices.ret != null) total = prices.out + prices.ret + extrasTotal;
    }

    if (bdTotal) bdTotal.textContent = (total != null) ? eur(total) : '';

    const showNote = rYes && (prices.out == null || prices.ret == null);
    if (bdNote) {
      bdNote.textContent = i18n.rt_na;
      bdNote.style.display = showNote ? '' : 'none';
    }

    if (!main) return;

    if (total != null) {
      main.textContent = eur(total);
      main.classList.remove('text-zinc-400');
    } else if (prices.out != null) {
      main.textContent = eur(prices.out);
      main.classList.remove('text-zinc-400');
    } else {
      main.textContent = i18n.not_available;
      main.classList.add('text-zinc-400');
    }
  }

  function updateSummary(){
    const fullName = [txt('first_name'), txt('last_name')].filter(Boolean).join(' ');
    setSum('full_name', fullName);
    setSum('email', txt('email'));
    setSum('phone', txt('phone'));

    setSum('service_date', txt('service_date'));
    setSum('service_time', txt('service_time'));

    const flightInput = get('flight_number');
    const trainInput  = get('train_number');

    if (flightInput) {
      const v = txt('flight_number');
      show('[data-sum-row="flight"]', !!v);
      setSum('flight_number', v);
    } else {
      show('[data-sum-row="flight"]', false);
    }

    if (trainInput) {
      const v = txt('train_number');
      show('[data-sum-row="train"]', !!v);
      setSum('train_number', v);
    } else {
      show('[data-sum-row="train"]', false);
    }

    setSum('passengers', txt('passengers') || '1');
    setSum('luggage', txt('luggage') || '0');

    const rYes = isReturnYes();
    setSum('return_trip', rYes ? i18n.yes : i18n.no);

    show('[data-sum-block="return"]', rYes);
    if (rYes) {
      setSum('return_date', txt('return_date'));
      setSum('return_time', txt('return_time'));
    } else {
      setSum('return_date', '');
      setSum('return_time', '');
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

<?php
// public/confirm-booking.php
declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/helpers/voucher.php';

// Solo POST
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
  header('Location: /');
  exit;
}

$payloadB64 = $_POST['payload'] ?? '';
$payloadB64 = is_string($payloadB64) ? trim($payloadB64) : '';

if ($payloadB64 === '' || strlen($payloadB64) > 20000) { // límite básico
  header('Location: /');
  exit;
}

$json = base64_decode($payloadB64, true);
if ($json === false) {
  header('Location: /');
  exit;
}

$data = json_decode($json, true);
if (!is_array($data)) {
  header('Location: /');
  exit;
}

// Helper refs
function make_ref(string $suffix): string {
  $date = date('Ymd-His');
  $rnd  = bin2hex(random_bytes(4));
  return "WEB-{$date}-{$rnd}-{$suffix}";
}

// Datos base
$origin_address      = (string)($data['origin_address'] ?? '');
$destination_address = (string)($data['destination_address'] ?? '');

$first = (string)($data['first_name'] ?? '');
$last  = (string)($data['last_name'] ?? '');
$fullName = trim($first . ' ' . $last);

$email = (string)($data['email'] ?? '');
$phone = (string)($data['phone'] ?? '');
$notes = (string)($data['notes'] ?? '');

$passengers = (int)($data['passengers'] ?? 1);

// Vehículo
$vehicle_name     = (string)($data['vehicle_name'] ?? '');
$vehicle_capacity = (string)($data['vehicle_capacity'] ?? '');
$vehicle_code     = (string)($data['vehicle_code'] ?? '');

// Extras (cantidades)
$extra_child_seat = (int)($data['extra_child_seat'] ?? 0);
$extra_booster    = (int)($data['extra_booster'] ?? 0);
$extra_bike       = (int)($data['extra_bike'] ?? 0);
$extra_golf       = (int)($data['extra_golf'] ?? 0);

$extras_arr = [
  'Sillita infantil' => $extra_child_seat,
  'Alzador'          => $extra_booster,
  'Bicicleta'        => $extra_bike,
  'Palos de golf'    => $extra_golf,
];

// Precios ida
$total_out = (float)($data['total_out'] ?? 0);
$base_out_price      = (float)($data['base_out_price'] ?? 0);
$extras_out          = (float)($data['extras_out'] ?? 0);
$night_surcharge_out = (float)($data['night_surcharge_out'] ?? 0);
$airport_fee_out     = (float)($data['airport_fee_out'] ?? 0);

// Vuelta: detección robusta
$return_trip = (string)($data['return_trip'] ?? 'no');
$return_yes =
  ($return_trip === 'yes')
  || !empty($data['return_date'])
  || !empty($data['return_time']);

// Precios vuelta
$base_return_price   = $data['base_return_price'] ?? null; // puede ser null
if ($base_return_price !== null) $base_return_price = (float)$base_return_price;

$total_return        = (float)($data['total_return'] ?? 0);
$extras_return       = (float)($data['extras_return'] ?? 0);
$night_surcharge_ret = (float)($data['night_surcharge_ret'] ?? 0);

// ===== OUT =====
$ref_out = make_ref('OUT');

$reserva_out = [
  'ref'      => $ref_out,
  'fecha'    => (string)($data['service_date'] ?? ''),
  'hora'     => (string)($data['service_time'] ?? ''),
  'origen'   => $origin_address,
  'destino'  => $destination_address,
  'pax'      => $passengers,
  'nombre'   => $fullName,
  'telefono' => $phone,
  'email'    => $email,
  'notas'    => $notes,
  'tipo'     => 'OUT',
  'issued_at'=> date('Y-m-d H:i'),

  // Voucher: vehículo + extras
  'vehicle_name'     => $vehicle_name,
  'vehicle_capacity' => $vehicle_capacity,
  'vehicle_code'     => $vehicle_code,
  'extras'           => $extras_arr,

  // Total + desglose (para que lo pinte el voucher)
  'precio'           => $total_out,
  'price_base'       => $base_out_price,
  'price_extras'     => $extras_out,
  'price_night'      => $night_surcharge_out,
  'price_airport_fee'=> $airport_fee_out,
];

$files_out = save_voucher_files($reserva_out);

// ===== RET (si aplica) =====
$ref_ret = null;
$files_ret = null;

if ($return_yes) {
  $ref_ret = make_ref('RET');

  $reserva_ret = [
    'ref'      => $ref_ret,
    'fecha'    => (string)($data['return_date'] ?? ''),
    'hora'     => (string)($data['return_time'] ?? ''),
    'origen'   => $destination_address, // vuelta: origen = destino ida
    'destino'  => $origin_address,      // vuelta: destino = origen ida
    'pax'      => $passengers,
    'nombre'   => $fullName,
    'telefono' => $phone,
    'email'    => $email,
    'notas'    => $notes,
    'tipo'     => 'RET',
    'issued_at'=> date('Y-m-d H:i'),

    'vehicle_name'     => $vehicle_name,
    'vehicle_capacity' => $vehicle_capacity,
    'vehicle_code'     => $vehicle_code,
    'extras'           => $extras_arr,

    // si no hay tarifa definida, total_return probablemente será 0
    'precio'           => $total_return,
    'price_base'       => (float)($base_return_price ?? 0),
    'price_extras'     => $extras_return,
    'price_night'      => $night_surcharge_ret,
    'price_airport_fee'=> 0.0,
  ];

  $files_ret = save_voucher_files($reserva_ret);
}

// Render vista confirmación (SOLO vista)
include __DIR__ . '/../views/confirm-booking.php';
exit;
?>

<section class="relative overflow-hidden bg-[#0b1220] text-white rounded-3xl">
  <div class="absolute inset-0 opacity-25 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2
                bg-gradient-to-br from-emerald-500/30 via-transparent to-transparent
                rounded-full blur-3xl"></div>
  </div>

  <div class="relative mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-16 md:py-20 text-center">
    <div class="rounded-3xl border border-white/15 bg-white/10 backdrop-blur-md shadow-2xl overflow-hidden">
      <div class="absolute inset-0 pointer-events-none opacity-25
                  bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.20)_0%,rgba(255,255,255,0.00)_55%)]"></div>

      <div class="relative p-7 md:p-10">
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-4">
          <?= function_exists('t') ? t('confirm.title') : 'Reserva confirmada' ?>
        </h1>

        <p class="text-sm md:text-base text-white/80 mb-3">
          <?= function_exists('t') ? t('confirm.subtitle') : 'Hemos recibido tu solicitud de traslado.' ?>
        </p>

        <p class="text-xs md:text-sm text-white/70 mb-5">
          <?= function_exists('t') ? t('confirm.voucher_ready') : 'Tu voucher está listo para descargar.' ?>
        </p>

        <!-- Referencias -->
        <div class="mt-2 inline-flex flex-col items-center rounded-2xl bg-white/5 border border-white/10 px-6 py-4 text-sm">
          <?php if ($ref_out): ?>
            <p class="text-white mb-1">
              <strong><?= function_exists('t') ? t('confirm.ref_out') : 'Referencia de ida' ?>:</strong>
              <span class="ml-1"><?= htmlspecialchars($ref_out) ?></span>
            </p>
          <?php endif; ?>
          <?php if ($ref_ret): ?>
            <p class="text-white">
              <strong><?= function_exists('t') ? t('confirm.ref_ret') : 'Referencia de vuelta' ?>:</strong>
              <span class="ml-1"><?= htmlspecialchars($ref_ret) ?></span>
            </p>
          <?php endif; ?>
        </div>

        <!-- DESCARGAS -->
        <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center">
          <?php if ($ref_out): ?>
            <a
              href="/download-voucher.php?ref=<?= urlencode($ref_out) ?>"
              class="inline-flex items-center justify-center rounded-xl bg-white/90 hover:bg-white
                     text-zinc-900 font-semibold px-6 py-3 shadow hover:-translate-y-0.5 transition text-sm"
            >
              <?= function_exists('t') ? t('confirm.download_out') : 'Descargar voucher (ida)' ?>
            </a>
          <?php endif; ?>

          <?php if ($ref_ret): ?>
            <a
              href="/download-voucher.php?ref=<?= urlencode($ref_ret) ?>"
              class="inline-flex items-center justify-center rounded-xl bg-white/90 hover:bg-white
                     text-zinc-900 font-semibold px-6 py-3 shadow hover:-translate-y-0.5 transition text-sm"
            >
              <?= function_exists('t') ? t('confirm.download_ret') : 'Descargar voucher (vuelta)' ?>
            </a>
          <?php endif; ?>
        </div>

        <p class="mt-5 text-xs text-white/60">
          <?= function_exists('t') ? t('confirm.help_text') : 'Si detectas algún dato incorrecto, por favor contacta con nosotros lo antes posible indicando tu referencia.' ?>
        </p>

        <!-- CTA -->
        <a href="/"
           class="mt-7 inline-flex items-center justify-center rounded-xl
                  bg-emerald-500 hover:bg-emerald-400
                  text-zinc-900 font-semibold px-6 py-3
                  shadow-lg shadow-emerald-500/20
                  hover:-translate-y-0.5 transition text-sm">
          <?= function_exists('t') ? t('confirm.back_home') : 'Volver al inicio' ?>
        </a>
      </div>
    </div>
  </div>
</section>

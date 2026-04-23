<?php
// Datos de testimonios (puedes cargarlos de BD más tarde)
$reviews = [
  ['img'=>'/assets/images/reviews/slawomir.webp','name'=>'Slawomir Lukuc','date'=>'2024-03-27','stars'=>5,'text'=>'Always on time, clean car, very helpful. Thank you!'],
  ['img'=>'/assets/images/reviews/foncey.webp','name'=>'Foncey Hume','date'=>'2024-06-19','stars'=>4.5,'text'=>'Fantastic service, professional and fair price. We will use it again.'],
  ['img'=>'/assets/images/reviews/estibaliz.webp','name'=>'Estíbaliz Amurrio','date'=>'2024-06-21','stars'=>5,'text'=>'Muy puntuales y amables. Coche limpio y cómodo. Repetiré.'],
  ['img'=>'/assets/images/reviews/loli.webp','name'=>'Loli Bellisco','date'=>'2024-06-23','stars'=>5,'text'=>'Conductor y atención telefónica excelentes.'],
  ['img'=>'/assets/images/reviews/barry.webp','name'=>'Barry Murphy','date'=>'2025-06-02','stars'=>5,'text'=>'I was very happy with your service.'],
];

// Tarjetas de flota
$fleet = [
  ['img'=>'/assets/images/Skoda.index.png',        'h'=>t('fleet.sedan'),    'p'=>t('fleet.sedan_desc')],
  ['img'=>'/assets/images/sedan_premium.index.png','h'=>t('fleet.premium'),  'p'=>t('fleet.premium_desc')],
  ['img'=>'/assets/images/minivan.index.png',      'h'=>t('fleet.minivan'),  'p'=>t('fleet.minivan_desc')],
  ['img'=>'/assets/images/minivanP.index.png',     'h'=>t('fleet.minivan_p'),'p'=>t('fleet.minivan_p_desc')],
  ['img'=>'/assets/images/microbus.index.png',     'h'=>t('fleet.minibus'),  'p'=>t('fleet.minibus_desc')],
  ['img'=>'/assets/images/autocar.index.png',      'h'=>t('fleet.coach'),    'p'=>t('fleet.coach_desc')],
  ['img'=>'/assets/images/adaptada.index.png',     'h'=>t('fleet.adapted4'), 'p'=>t('fleet.adapted4_desc')],
  ['img'=>'/assets/images/adaptada.index.png',     'h'=>t('fleet.adapted8'), 'p'=>t('fleet.adapted8_desc')],
];

$langHome = function_exists('current_lang') ? current_lang() : 'es';
$reputation = [
  'title' => $langHome === 'en' ? 'Verified reviews' : 'Opiniones verificadas',
  'intro' => $langHome === 'en'
    ? 'Real ratings and selected comments from Google and Trustpilot.'
    : 'Valoraciones reales y comentarios destacados de Google y Trustpilot.',
  'google' => [
    'label' => 'Google Reviews',
    'score' => '5.0',
    'count' => $langHome === 'en' ? '13 reviews' : '13 reseñas',
    'url'   => 'https://share.google/ED22tp1aKmTxe11UY',
    'cta'   => $langHome === 'en' ? 'View on Google' : 'Ver en Google',
    'items' => [
      [
        'name' => 'Ana Cardona',
        'date' => $langHome === 'en' ? '3 months ago' : 'Hace 3 meses',
        'score' => 5,
        'text' => $langHome === 'en'
          ? 'Excellent service, Rebeca’s management was super efficient. Driver 10/10: kind, helpful and attentive. We will definitely use the service again.'
          : 'Excelente servicio, la gestión de Rebeca súper eficiente. El conductor 10 de 10, amable, servicial y atento; sin duda volveremos a usar el servicio.',
      ],
      [
        'name' => 'Estíbaliz Amurrio',
        'date' => $langHome === 'en' ? '1 year ago' : 'Hace un año',
        'score' => 5,
        'text' => $langHome === 'en'
          ? 'Totally recommendable service: punctual, very friendly and easy to book. We will use this service again.'
          : 'Servicio totalmente recomendable, puntuales, trato muy amable y fácil de contratar; volveremos a usar este servicio.',
      ],
    ],
  ],
  'trustpilot' => [
    'label' => 'Trustpilot',
    'score' => '4.3',
    'count' => $langHome === 'en' ? '8 reviews' : '8 opiniones',
    'url'   => 'https://www.trustpilot.com/review/www.transfermarbell.com',
    'cta'   => $langHome === 'en' ? 'View on Trustpilot' : 'Ver en Trustpilot',
    'items' => [
      [
        'name' => 'Gareth Johnson',
        'date' => '17 Mar 2026',
        'score' => 5,
        'text' => $langHome === 'en'
          ? 'I’d 100% recommend Transfer Marbell for all your transfer needs along the Costa del Sol. Everything was perfect and every driver was very professional and friendly.'
          : 'Recomendaría Transfer Marbell al 100% para cualquier traslado por la Costa del Sol. Todo fue perfecto y cada conductor fue muy profesional y amable.',
      ],
    ],
  ],
];

$hero = $langHome === 'en'
  ? [
      'badge' => 'Private airport transfers · Costa del Sol',
      'title' => 'Private transfers from and to Málaga Airport',
      'subtitle' => 'Book your transfer online in Marbella, Estepona, Nerja, Fuengirola and across Andalusia.',
      'benefits' => ['Fixed price', 'Professional drivers', 'Service 24/7'],
      'origin_placeholder' => 'Origin (e.g. Málaga Airport)',
      'destination_placeholder' => 'Destination (e.g. Marbella)',
      'primary_cta' => 'View price and book',
      'secondary_cta' => 'Continue to vehicles and prices',
      'route_title' => 'Trip summary',
      'label_origin' => 'Origin',
      'label_destination' => 'Destination',
      'label_distance' => 'Distance',
      'label_duration' => 'Estimated duration',
      'summary_title' => 'Ready to book your transfer?',
      'summary_copy' => 'Check route details, choose your vehicle and continue your booking in less than a minute.',
      'price_hint' => 'Airport transfers with online booking and professional service.',
      'alert_missing_fields' => 'Please enter origin and destination.',
      'alert_route_error' => 'Route could not be calculated:',
      'alert_recalculate' => 'Please calculate the route again before continuing.',
      'route_button_aria' => 'View vehicles and prices',
    ]
  : [
      'badge' => 'Traslados privados · Costa del Sol',
      'title' => 'Traslados privados desde y hasta el Aeropuerto de Málaga',
      'subtitle' => 'Reserva online tu transfer en Marbella, Estepona, Nerja, Fuengirola y toda Andalucía.',
      'benefits' => ['Precio cerrado', 'Conductores profesionales', 'Servicio 24/7'],
      'origin_placeholder' => 'Origen (ej. Aeropuerto de Málaga)',
      'destination_placeholder' => 'Destino (ej. Marbella)',
      'primary_cta' => 'Ver precio y reservar',
      'secondary_cta' => 'Continuar con vehículos y precios',
      'route_title' => 'Resumen del trayecto',
      'label_origin' => 'Origen',
      'label_destination' => 'Destino',
      'label_distance' => 'Distancia',
      'label_duration' => 'Duración estimada',
      'summary_title' => '¿Listo para reservar tu traslado?',
      'summary_copy' => 'Consulta los datos de la ruta, elige vehículo y continúa tu reserva en menos de un minuto.',
      'price_hint' => 'Traslados al aeropuerto con reserva online y servicio profesional.',
      'alert_missing_fields' => 'Por favor introduce origen y destino.',
      'alert_route_error' => 'No se pudo calcular la ruta:',
      'alert_recalculate' => 'Vuelve a calcular la ruta antes de continuar.',
      'route_button_aria' => 'Ver vehículos y precios',
    ];

// Si tienes una URL real de WhatsApp en config o entorno, aparecerá el botón.
$whatsAppUrl = defined('WHATSAPP_URL') ? WHATSAPP_URL : (getenv('WHATSAPP_URL') ?: '');

function render_stars($score){
  // admite 4.5, 5, etc.
  $full = floor($score);
  $half = ($score - $full) >= 0.5 ? 1 : 0;
  $empty = 5 - $full - $half;
  $out = '';
  for($i=0;$i<$full;$i++)  $out .= '<svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.3l-6.2 3.4 1.2-6.9L1 8.7l7-1 3-6.1 3 6.1 7 1-5 5.1 1.2 6.9z"/></svg>';
  if($half)               $out .= '<svg class="h-4 w-4" viewBox="0 0 24 24"><defs><linearGradient id="g"><stop offset="50%" stop-color="currentColor"/><stop offset="50%" stop-color="transparent"/></linearGradient></defs><path d="M12 17.3l-6.2 3.4 1.2-6.9L1 8.7l7-1 3-6.1 3 6.1 7 1-5 5.1 1.2 6.9z" fill="url(#g)"/></svg>';
  for($i=0;$i<$empty;$i++) $out .= '<svg class="h-4 w-4 text-zinc-300" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.3l-6.2 3.4 1.2-6.9L1 8.7l7-1 3-6.1 3 6.1 7 1-5 5.1 1.2 6.9z"/></svg>';
  return $out;
}
?>

<!-- HERO -->
<section class="relative overflow-hidden bg-[#0b1220] text-white rounded-2xl">
  <div class="absolute inset-0 opacity-20 pointer-events-none rounded-2xl bg-white/10 border border-white/20 backdrop-blur-md"></div>
  <div class="absolute -top-32 left-1/2 h-[900px] w-[900px] -translate-x-1/2 rounded-full bg-gradient-to-br from-sky-500/25 via-transparent to-transparent blur-3xl"></div>

  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-14 md:py-18">
    <div class="rounded-2xl border border-white/15 bg-white/10 p-6 shadow-lg backdrop-blur-md md:p-10">
      <div class="mx-auto max-w-5xl text-center">
        <div class="mb-5 inline-flex items-center rounded-full border border-sky-400/20 bg-sky-500/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-sky-200">
          <?= htmlspecialchars($hero['badge']) ?>
        </div>

        <h1 class="mx-auto max-w-4xl text-4xl font-extrabold tracking-tight md:text-5xl">
          <?= htmlspecialchars($hero['title']) ?>
        </h1>

        <p class="mx-auto mt-4 max-w-3xl text-base leading-7 text-slate-200 md:text-lg">
          <?= htmlspecialchars($hero['subtitle']) ?>
        </p>

        <div class="mt-5 flex flex-wrap items-center justify-center gap-3 text-sm font-medium text-white/90">
          <?php foreach ($hero['benefits'] as $benefit): ?>
            <span class="rounded-full border border-white/15 bg-white/10 px-4 py-2">
              <?= htmlspecialchars($benefit) ?>
            </span>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- FORMULARIO DE RUTAS -->
      <div class="mx-auto mt-8 max-w-5xl rounded-2xl border border-white/15 bg-slate-800/75 p-5 shadow-2xl md:p-6">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <input id="origin" type="text" placeholder="<?= htmlspecialchars($hero['origin_placeholder']) ?>"
                class="w-full rounded-xl border border-white/10 bg-white px-4 py-3 text-black shadow-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20"
                autocomplete="off">
          <input id="destination" type="text" placeholder="<?= htmlspecialchars($hero['destination_placeholder']) ?>"
                class="w-full rounded-xl border border-white/10 bg-white px-4 py-3 text-black shadow-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20"
                autocomplete="off">
        </div>

        <div class="mt-4 flex flex-col items-center justify-center gap-3 sm:flex-row">
          <button id="calculateRoute"
                  class="inline-flex items-center justify-center rounded-xl bg-sky-500 px-6 py-3 text-base font-semibold text-white shadow-lg transition hover:-translate-y-0.5 hover:bg-sky-600"
                  type="button">
            <i class="uil uil-map-marker mr-2"></i><?= htmlspecialchars($hero['primary_cta']) ?>
          </button>

          <?php if (!empty($whatsAppUrl)): ?>
            <a href="<?= htmlspecialchars($whatsAppUrl) ?>" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center justify-center rounded-xl border border-emerald-400/20 bg-emerald-500/15 px-6 py-3 text-base font-semibold text-emerald-100 transition hover:-translate-y-0.5 hover:bg-emerald-500/25">
              WhatsApp
            </a>
          <?php endif; ?>
        </div>

        <p class="mt-3 text-center text-sm text-slate-300">
          <?= htmlspecialchars($hero['price_hint']) ?>
        </p>

        <!-- MAPA -->
        <div id="map" class="mt-5 h-72 w-full overflow-hidden rounded-2xl border border-white/10 md:h-80"></div>

        <!-- RESULTADOS -->
        <div id="routeInfo" class="mt-6 hidden rounded-2xl border border-white/10 bg-white/5 p-5 text-left text-white">
          <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
              <h3 class="text-xl font-semibold"><?= htmlspecialchars($hero['route_title']) ?></h3>
              <p class="mt-1 text-sm text-slate-300"><?= htmlspecialchars($hero['summary_copy']) ?></p>
            </div>
            <button id="goToQuote"
                    class="hidden rounded-xl bg-white px-6 py-3 text-sm font-semibold text-zinc-900 shadow transition hover:-translate-y-0.5"
                    type="button"
                    aria-label="<?= htmlspecialchars($hero['route_button_aria']) ?>">
              <?= htmlspecialchars($hero['secondary_cta']) ?>
            </button>
          </div>

          <div class="mt-5 grid gap-3 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-xl bg-white/10 p-4">
              <div class="text-xs font-semibold uppercase tracking-wide text-slate-300"><?= htmlspecialchars($hero['label_origin']) ?></div>
              <div id="infoOrigin" class="mt-2 text-sm font-medium leading-6 text-white"></div>
            </div>
            <div class="rounded-xl bg-white/10 p-4">
              <div class="text-xs font-semibold uppercase tracking-wide text-slate-300"><?= htmlspecialchars($hero['label_destination']) ?></div>
              <div id="infoDestination" class="mt-2 text-sm font-medium leading-6 text-white"></div>
            </div>
            <div class="rounded-xl bg-white/10 p-4">
              <div class="text-xs font-semibold uppercase tracking-wide text-slate-300"><?= htmlspecialchars($hero['label_distance']) ?></div>
              <div id="infoDistance" class="mt-2 text-base font-semibold text-white"></div>
            </div>
            <div class="rounded-xl bg-white/10 p-4">
              <div class="text-xs font-semibold uppercase tracking-wide text-slate-300"><?= htmlspecialchars($hero['label_duration']) ?></div>
              <div id="infoDuration" class="mt-2 text-base font-semibold text-white"></div>
            </div>
          </div>
        </div>

        <!-- FORM oculto para enviar datos a quote.php -->
        <form id="quoteForm" action="/quote.php" method="post" class="hidden">
          <input type="hidden" name="origin_address" id="f_origin_address">
          <input type="hidden" name="origin_lat" id="f_origin_lat">
          <input type="hidden" name="origin_lng" id="f_origin_lng">
          <input type="hidden" name="destination_address" id="f_destination_address">
          <input type="hidden" name="destination_lat" id="f_destination_lat">
          <input type="hidden" name="destination_lng" id="f_destination_lng">
          <input type="hidden" name="distance_m" id="f_distance_m">
          <input type="hidden" name="duration_s" id="f_duration_s">
        </form>
      </div>
    </div>
  </div>
</section>

<!-- POR QUÉ ELEGIRNOS -->
<section class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto text-center">
      <h2 class="text-3xl font-bold tracking-tight mb-2"><?= t('home.why_title') ?></h2>
      <p class="text-zinc-600 mb-10"><?= t('home.why_intro') ?></p>
    </div>

    <div class="grid sm:grid-cols-2 gap-6 mb-10">
      <img src="/assets/images/travel-comfort.webp" alt="<?= t('home.img_comfort_alt') ?>" class="rounded-2xl w-full h-auto" loading="lazy">
      <img src="/assets/images/travel-style.webp"   alt="<?= t('home.img_style_alt')   ?>" class="rounded-2xl w-full h-auto" loading="lazy">
    </div>

    <ul class="max-w-3xl mx-auto grid grid-cols-1 sm:grid-cols-2 gap-3 text-zinc-700">
      <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= t('home.why_punctual') ?></span></li>
      <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= t('home.why_comfort') ?></span></li>
      <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= t('home.why_drivers') ?></span></li>
      <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= t('home.why_prices') ?></span></li>
      <li class="flex items-start gap-2 sm:col-span-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-500"></span><span><?= t('home.why_247') ?></span></li>
    </ul>
  </div>
</section>

<!-- FLOTA -->
<section class="py-16 bg-zinc-50">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold text-center mb-10"><?= t('home.fleet_title') ?></h2>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
      <?php foreach ($fleet as $c): ?>
        <article class="group rounded-2xl bg-white shadow-xl ring-1 ring-black/5 p-5 text-center transition hover:-translate-y-0.5 hover:shadow-2xl">
          <img src="<?= $c['img'] ?>" alt="<?= strip_tags($c['h']) ?>" class="mx-auto h-28 object-contain" loading="lazy">
          <h3 class="mt-3 font-semibold text-zinc-900"><?= $c['h'] ?></h3>
          <p class="text-sm text-zinc-600"><?= $c['p'] ?></p>
          <span class="mx-auto mt-3 block h-px w-0 bg-sky-500 group-hover:w-12 transition-all"></span>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php $destinationPages = require __DIR__ . '/../app/destinations.php'; ?>
<!-- PRINCIPALES DESTINOS -->
<section class="py-16 bg-zinc-50">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto text-center mb-10">
      <h2 class="text-3xl font-bold tracking-tight mb-2">Principales destinos</h2>
      <p class="text-zinc-600">Los destinos más visitados de la Costa del Sol, ciudades de Andalucía y Sierra Nevada, con páginas específicas para que Google indexe mejor cada ruta.</p>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
      <?php foreach (['marbella','puerto-banus','fuengirola','benalmadena','nerja','sevilla','granada','sierra-nevada'] as $slug): 
        $d = $destinationPages[$slug]; ?>
        <article class="group rounded-2xl bg-white shadow-xl ring-1 ring-black/5 overflow-hidden hover:-translate-y-0.5 hover:shadow-2xl transition">
          <img src="<?= htmlspecialchars($d['image']) ?>" alt="<?= htmlspecialchars($d['name']) ?>" class="w-full aspect-[16/10] object-cover" loading="lazy">
          <div class="p-5">
            <div class="text-xs font-semibold uppercase tracking-wide text-sky-700"><?= htmlspecialchars($d['group']) ?></div>
            <h3 class="mt-1 text-lg font-bold text-zinc-900"><?= htmlspecialchars($d['name']) ?></h3>
            <p class="mt-2 text-sm text-zinc-600"><?= htmlspecialchars($d['lead']) ?></p>
            <a href="/destinos/<?= htmlspecialchars($slug) ?>" class="mt-4 inline-flex items-center gap-2 rounded-xl bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">Ver destino</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <div class="mt-8 text-center">
      <a href="/destinos" class="inline-flex items-center gap-2 rounded-xl bg-[#0b1220] px-5 py-3 text-sm font-semibold text-white hover:opacity-95">Ver todos los destinos</a>
    </div>
  </div>
</section>

<!-- OPINIONES VERIFICADAS -->
<section class="py-16 bg-white">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto text-center">
      <h2 class="text-3xl font-bold tracking-tight mb-2"><?= htmlspecialchars($reputation['title']) ?></h2>
      <p class="text-zinc-600 mb-10"><?= htmlspecialchars($reputation['intro']) ?></p>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
      <?php foreach (['google','trustpilot'] as $sourceKey): $source = $reputation[$sourceKey]; ?>
        <article class="overflow-hidden rounded-3xl border border-zinc-200 bg-zinc-50 shadow-sm">
          <div class="border-b border-zinc-200 bg-white p-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
              <div>
                <div class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide <?= $sourceKey === 'google' ? 'bg-blue-50 text-blue-700' : 'bg-emerald-50 text-emerald-700' ?>">
                  <?= htmlspecialchars($source['label']) ?>
                </div>
                <div class="mt-3 flex items-end gap-3">
                  <div class="text-4xl font-extrabold text-zinc-900"><?= htmlspecialchars($source['score']) ?><span class="text-lg font-semibold text-zinc-500">/5</span></div>
                  <div>
                    <div class="flex items-center gap-1 text-amber-500"><?= render_stars((float) $source['score']) ?></div>
                    <p class="mt-1 text-sm text-zinc-600"><?= htmlspecialchars($source['count']) ?></p>
                  </div>
                </div>
              </div>
              <a href="<?= htmlspecialchars($source['url']) ?>" target="_blank" rel="noopener noreferrer nofollow" class="inline-flex items-center justify-center rounded-xl px-4 py-3 text-sm font-semibold text-white <?= $sourceKey === 'google' ? 'bg-blue-600 hover:bg-blue-700' : 'bg-emerald-600 hover:bg-emerald-700' ?>">
                <?= htmlspecialchars($source['cta']) ?>
              </a>
            </div>
          </div>

          <div class="space-y-4 p-6">
            <?php foreach ($source['items'] as $item): ?>
              <div class="rounded-2xl bg-white p-5 ring-1 ring-zinc-200">
                <div class="flex items-start justify-between gap-3">
                  <div>
                    <h3 class="text-base font-semibold text-zinc-900"><?= htmlspecialchars($item['name']) ?></h3>
                    <p class="text-xs text-zinc-500"><?= htmlspecialchars($item['date']) ?></p>
                  </div>
                  <div class="flex items-center gap-1 text-amber-500 shrink-0"><?= render_stars((float) $item['score']) ?></div>
                </div>
                <p class="mt-3 text-sm leading-6 text-zinc-700">“<?= htmlspecialchars($item['text']) ?>”</p>
              </div>
            <?php endforeach; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- TESTIMONIOS (Glide.js) -->
<section class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto text-center">
      <h2 class="text-3xl font-bold tracking-tight mb-2"><?= t('home.reviews_title') ?></h2>
      <p class="text-zinc-600 mb-8"><?= t('home.reviews_intro') ?></p>
    </div>

    <div class="glide" id="reviews">
      <div class="glide__track" data-glide-el="track">
        <ul class="glide__slides">
          <?php foreach ($reviews as $r): ?>
            <li class="glide__slide">
              <article class="rounded-2xl bg-white ring-1 ring-black/5 shadow-xl p-5 mx-2">
                <div class="flex items-start gap-4">
                  <img src="<?= $r['img'] ?>" class="h-14 w-14 rounded-full object-cover" alt="<?= htmlspecialchars($r['name']) ?>" loading="lazy">
                  <div class="min-w-0">
                    <div class="flex items-center gap-2">
                      <strong class="text-zinc-900"><?= htmlspecialchars($r['name']) ?></strong>
                      <span class="text-xs text-zinc-500"><?= htmlspecialchars($r['date']) ?></span>
                    </div>
                    <div class="mt-1 flex items-center gap-1 text-amber-500">
                      <?= render_stars($r['stars']) ?>
                      <span class="ml-1 text-xs text-zinc-500"><?= number_format($r['stars'],1) ?>/5</span>
                    </div>
                    <p class="mt-2 text-sm text-zinc-700 leading-6">“<?= htmlspecialchars($r['text']) ?>”</p>
                  </div>
                </div>
              </article>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="flex justify-center gap-4 mt-5" data-glide-el="controls">
        <button class="px-3 py-1 rounded-lg ring-1 ring-zinc-200" data-glide-dir="<">‹</button>
        <button class="px-3 py-1 rounded-lg ring-1 ring-zinc-200" data-glide-dir=">">›</button>
      </div>
    </div>
  </div>
</section>

<!-- Glide.js -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/glide.min.js"></script>

<script>
  const HOME_UI = <?= json_encode($hero, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;

  // TESTIMONIOS
  document.addEventListener('DOMContentLoaded', () => {
    new Glide('#reviews', {
      type: 'carousel',
      autoplay: 6000,
      hoverpause: true,
      gap: 24,
      perView: 3,
      breakpoints: { 1024:{ perView:2 }, 640:{ perView:1 } }
    }).mount();
  });

  // GOOGLE MAPS
  let map, directionsService, directionsRenderer, autocompleteOrigin, autocompleteDestination;

  // Declarar la función como global (callback del script)
  window.initMap = function() {
    const elMap = document.getElementById('map');
    if (!elMap) return;

    map = new google.maps.Map(elMap, {
      center: { lat: 36.7213, lng: -4.4214 }, // Málaga
      zoom: 9,
      mapTypeControl: false,
      streetViewControl: false,
      fullscreenControl: true,
    });

    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer({ map, suppressMarkers: false });

    // Autocompletado
    const options = { componentRestrictions: { country: 'es' } };
    autocompleteOrigin = new google.maps.places.Autocomplete(document.getElementById('origin'), options);
    autocompleteDestination = new google.maps.places.Autocomplete(document.getElementById('destination'), options);

    document.getElementById('calculateRoute').addEventListener('click', calcRoute);
  };

  function calcRoute() {
    const origin = document.getElementById('origin').value.trim();
    const destination = document.getElementById('destination').value.trim();

    if (!origin || !destination) {
      alert(HOME_UI.alert_missing_fields);
      return;
    }

    directionsService.route({
      origin,
      destination,
      travelMode: google.maps.TravelMode.DRIVING,
    }).then((response) => {
      directionsRenderer.setDirections(response);

      const leg = response.routes[0].legs[0];
      document.getElementById('infoOrigin').textContent = leg.start_address;
      document.getElementById('infoDestination').textContent = leg.end_address;
      document.getElementById('infoDistance').textContent = leg.distance.text;
      document.getElementById('infoDuration').textContent = leg.duration.text;

      document.getElementById('f_origin_address').value      = leg.start_address;
      document.getElementById('f_origin_lat').value          = leg.start_location.lat();
      document.getElementById('f_origin_lng').value          = leg.start_location.lng();
      document.getElementById('f_destination_address').value = leg.end_address;
      document.getElementById('f_destination_lat').value     = leg.end_location.lat();
      document.getElementById('f_destination_lng').value     = leg.end_location.lng();
      document.getElementById('f_distance_m').value          = leg.distance.value;
      document.getElementById('f_duration_s').value          = leg.duration.value;

      document.getElementById('routeInfo').classList.remove('hidden');
      document.getElementById('goToQuote').classList.remove('hidden');
      document.getElementById('routeInfo').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }).catch((error) => {
      console.error(error);
      alert(HOME_UI.alert_route_error + ' ' + error.message);
    });
  }

  document.getElementById('goToQuote')?.addEventListener('click', () => {
    const dm = document.getElementById('f_distance_m').value;
    const ds = document.getElementById('f_duration_s').value;

    if (!dm || !ds) {
      alert(HOME_UI.alert_recalculate);
      return;
    }

    document.getElementById('quoteForm').submit();
  });
</script>

<!-- Carga de la API de Google Maps -->
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5t9kRS9NRSPbMNN6gl8XD5TPNuFLpBC8&libraries=places&callback=initMap">
</script>

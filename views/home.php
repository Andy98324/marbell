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
<section class="relative overflow-hidden bg-[#0b1220] text-white">
  <!-- glow sutil como en header/footer -->
  <div class="absolute inset-0 opacity-20 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 md:py-20">
  <div class="text-center max-w-4xl mx-auto">
    <img src="/assets/logo.png" alt="<?= t('brand') ?>" class="mx-auto h-24 md:h-28 w-auto mb-5" loading="eager" fetchpriority="high">

    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-6">
      <?= t('home.h1') ?> – Motor de reservas
    </h1>

    <!-- FORMULARIO DE RUTAS -->
    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 shadow-lg border border-white/20">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <input id="origin" type="text" placeholder="Origen (ej. Málaga Airport)" 
               class="px-4 py-3 rounded-xl text-black w-full" autocomplete="off">
        <input id="destination" type="text" placeholder="Destino (ej. Marbella)" 
               class="px-4 py-3 rounded-xl text-black w-full" autocomplete="off">
      </div>

      <button id="calculateRoute" 
              class="bg-amber-400 text-zinc-900 font-semibold px-6 py-3 rounded-xl shadow hover:-translate-y-0.5 transition">
        <i class="uil uil-map-marker"></i> Calcular ruta
      </button>

      <!-- MAPA -->
      <div id="map" class="mt-6 rounded-2xl overflow-hidden h-96 w-full"></div>

      <!-- RESULTADOS -->
      <!-- RESULTADOS -->
<div id="routeInfo" class="mt-6 text-left text-white hidden">
  <h3 class="text-xl font-semibold mb-2">Resumen del trayecto</h3>
  <p><strong>Origen:</strong> <span id="infoOrigin"></span></p>
  <p><strong>Destino:</strong> <span id="infoDestination"></span></p>
  <p><strong>Distancia:</strong> <span id="infoDistance"></span></p>
  <p><strong>Duración estimada:</strong> <span id="infoDuration"></span></p>

  <button id="goToQuote"
          class="mt-4 bg-white text-zinc-900 font-semibold px-6 py-3 rounded-xl shadow hover:-translate-y-0.5 transition hidden"
          type="button" aria-label="Ver vehículos y precios">
    Ver vehículos y precios
  </button>
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





<!-- Glide.js (CDN) -->
<!-- Glide.js -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/glide.min.js"></script>

<script>
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
    const elMap = document.getElementById("map");
    if (!elMap) return;

    map = new google.maps.Map(elMap, {
      center: { lat: 36.7213, lng: -4.4214 }, // Málaga
      zoom: 9,
      mapTypeControl: false,
    });

    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer({ map });

    // Autocompletado
    const options = { componentRestrictions: { country: "es" } };
    autocompleteOrigin = new google.maps.places.Autocomplete(document.getElementById("origin"), options);
    autocompleteDestination = new google.maps.places.Autocomplete(document.getElementById("destination"), options);

    document.getElementById("calculateRoute").addEventListener("click", calcRoute);
  };

  function calcRoute() {
  const origin = document.getElementById("origin").value.trim();
  const destination = document.getElementById("destination").value.trim();
  if (!origin || !destination) { alert("Por favor introduce origen y destino."); return; }

  directionsService.route({
    origin, destination, travelMode: google.maps.TravelMode.DRIVING,
  }).then((response) => {
    const leg = response.routes[0].legs[0];
    // Mostrar resumen
    document.getElementById("infoOrigin").textContent = leg.start_address;
    document.getElementById("infoDestination").textContent = leg.end_address;
    document.getElementById("infoDistance").textContent = leg.distance.text; // "52.4 km"
    document.getElementById("infoDuration").textContent = leg.duration.text; // "46 min"

    // ⬇️ ⬇️ DATOS CRUDOS (OBLIGATORIO) ⬇️ ⬇️
    document.getElementById("f_origin_address").value      = leg.start_address;
    document.getElementById("f_origin_lat").value          = leg.start_location.lat();
    document.getElementById("f_origin_lng").value          = leg.start_location.lng();
    document.getElementById("f_destination_address").value = leg.end_address;
    document.getElementById("f_destination_lat").value     = leg.end_location.lat();
    document.getElementById("f_destination_lng").value     = leg.end_location.lng();

    // IMPORTANTÍSIMO: en crudo, **números**:
    document.getElementById("f_distance_m").value          = leg.distance.value; // ej: 52432
    document.getElementById("f_duration_s").value          = leg.duration.value; // ej: 2760

    // habilita botón
    document.getElementById("routeInfo").classList.remove("hidden");
    document.getElementById("goToQuote").classList.remove("hidden");
  }).catch((error) => {
    console.error(error);
    alert("No se pudo calcular la ruta: " + error.message);
  });
}

// No dejes enviar si los campos están vacíos por cualquier motivo
document.getElementById("goToQuote")?.addEventListener("click", () => {
  const dm = document.getElementById("f_distance_m").value;
  const ds = document.getElementById("f_duration_s").value;
  if (!dm || !ds) { alert("Vuelve a calcular la ruta antes de continuar."); return; }
  document.getElementById("quoteForm").submit();
});


</script>

<!-- Carga de la API de Google Maps -->
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdejLAhodEvEQoLM8bDGpElU6xKFk12SQ&libraries=places&callback=initMap">
</script>

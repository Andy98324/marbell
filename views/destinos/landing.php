<?php
$destination  = $destination ?? ($GLOBALS['destination'] ?? null);
$destinations = require __DIR__ . '/../../app/destinations.php';

if (!$destination) {
    echo '<section class="py-16"><div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8"><div class="rounded-2xl bg-red-50 text-red-700 ring-1 ring-red-200 p-6">Destino no encontrado.</div></div></section>';
    return;
}

if (!function_exists('e')) {
    function e($value): string
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

$related = [];
foreach (($destination['nearby'] ?? []) as $slug) {
    if (isset($destinations[$slug])) {
        $item = $destinations[$slug];
        $item['slug'] = $slug;
        $related[] = $item;
    }
}

$highlights = $destination['highlights'] ?? [];
$travelTime = $destination['travel_time'] ?? 'Consultar según ruta';
$name       = $destination['name'] ?? 'Destino';
$title      = $destination['title'] ?? ('Traslado privado del Aeropuerto de Málaga a ' . $name);
$lead       = $destination['lead'] ?? '';
$intro      = $destination['intro'] ?? '';
$group      = $destination['group'] ?? 'Destino';
$image      = $destination['image'] ?? '/assets/images/transfers/default.jpg';

$faqItems = [
    [
        'q' => "¿El precio del traslado a {$name} es fijo?",
        'a' => "Sí. Trabajamos con precio cerrado antes de confirmar la reserva, para que el cliente sepa el coste de su traslado desde o hasta el Aeropuerto de Málaga sin sorpresas."
    ],
    [
        'q' => "¿Qué ocurre si mi vuelo llega con retraso?",
        'a' => "Incluimos seguimiento de vuelo en las recogidas del aeropuerto, por lo que adaptamos la recogida a la hora real de llegada siempre que los datos del vuelo se hayan facilitado correctamente."
    ],
    [
        'q' => "¿Puedo reservar traslado privado con equipaje, niños o grupo?",
        'a' => "Sí. Podemos organizar el servicio según el número de pasajeros, equipaje y necesidades especiales. También se pueden solicitar sillas infantiles bajo petición."
    ],
    [
        'q' => "¿Dónde se solicita la reserva para {$name}?",
        'a' => "Puedes pedir tu traslado desde el motor de reservas de la web o solicitar presupuesto si necesitas minivan, minibus, servicio premium o un trayecto a medida."
    ],
];
?>

<section class="relative overflow-hidden bg-[#0b1220] text-white rounded-3xl">
    <div class="absolute inset-0 opacity-30 pointer-events-none">
        <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="relative">
        <div class="grid lg:grid-cols-2 items-stretch">
            <div class="p-8 md:p-12 lg:p-14 flex flex-col justify-center">
                <nav class="text-sm text-white/70 mb-4">
                    <a href="/" class="hover:text-white">Inicio</a>
                    <span class="mx-2">/</span>
                    <a href="/destinos" class="hover:text-white">Destinos</a>
                    <span class="mx-2">/</span>
                    <span class="text-white"><?= e($name) ?></span>
                </nav>

                <div class="inline-flex w-fit rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-white/90 border border-white/15">
                    <?= e($group) ?>
                </div>

                <h1 class="mt-4 text-4xl md:text-5xl font-extrabold tracking-tight leading-tight">
                    <?= e($title) ?>
                </h1>

                <?php if ($lead): ?>
                    <p class="mt-4 text-white/80 text-lg leading-relaxed max-w-2xl">
                        <?= e($lead) ?>
                    </p>
                <?php endif; ?>

                <div class="mt-6 flex flex-wrap gap-3 text-sm text-white/90">
                    <span class="rounded-full bg-white/10 px-3 py-2 border border-white/10">Precio fijo</span>
                    <span class="rounded-full bg-white/10 px-3 py-2 border border-white/10">Seguimiento de vuelo</span>
                    <span class="rounded-full bg-white/10 px-3 py-2 border border-white/10">Servicio puerta a puerta</span>
                    <span class="rounded-full bg-white/10 px-3 py-2 border border-white/10"><?= e($travelTime) ?></span>
                </div>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="/#goToQuote" class="inline-flex items-center gap-2 rounded-xl bg-amber-400 px-5 py-3 text-sm font-semibold text-zinc-900 shadow hover:-translate-y-0.5 transition">
                        Reservar ahora
                    </a>

                    <a href="/destinos" class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-5 py-3 text-sm font-semibold text-white border border-white/15 hover:bg-white/15 transition">
                        Ver más destinos
                    </a>
                </div>
            </div>

            <div class="min-h-[320px] lg:min-h-full relative">
                <img
                    src="<?= e($image) ?>"
                    alt="<?= e($name) ?>"
                    class="w-full h-full object-cover"
                    loading="lazy"
                    onerror="this.onerror=null;this.src='/assets/images/transfers/default.jpg';"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-black/0 to-transparent"></div>
            </div>
        </div>
    </div>
</section>

<section class="py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-8 lg:grid-cols-[1.35fr_.85fr]">
        <div class="space-y-8">
            <div class="rounded-2xl bg-white shadow-xl ring-1 ring-black/5 p-6 md:p-8">
                <h2 class="text-3xl font-bold tracking-tight text-zinc-900">
                    Transfer privado desde o hasta el Aeropuerto de Málaga a <?= e($name) ?>
                </h2>

                <?php if ($intro): ?>
                    <p class="mt-4 text-zinc-700 leading-7">
                        <?= e($intro) ?>
                    </p>
                <?php endif; ?>

                <p class="mt-4 text-zinc-700 leading-7">
                    En Transfer Marbell ofrecemos un servicio profesional, cómodo y puntual para viajeros que desean llegar a su destino sin esperas, sin transbordos y con la tranquilidad de contar con un conductor profesional. Es una solución ideal para parejas, familias, grupos pequeños, clientes de hotel, villas, apartamentos turísticos y viajes de negocios.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="rounded-2xl bg-zinc-50 ring-1 ring-zinc-200 p-6">
                    <h3 class="text-xl font-bold text-zinc-900 mb-4">Qué incluye este servicio</h3>

                    <?php if (!empty($highlights)): ?>
                        <ul class="space-y-3 text-zinc-700">
                            <?php foreach ($highlights as $point): ?>
                                <li class="flex items-start gap-3">
                                    <span class="mt-2 h-2 w-2 rounded-full bg-sky-500"></span>
                                    <span><?= e($point) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <ul class="space-y-3 text-zinc-700">
                            <li class="flex items-start gap-3"><span class="mt-2 h-2 w-2 rounded-full bg-sky-500"></span><span>Servicio puerta a puerta</span></li>
                            <li class="flex items-start gap-3"><span class="mt-2 h-2 w-2 rounded-full bg-sky-500"></span><span>Precio cerrado antes de reservar</span></li>
                            <li class="flex items-start gap-3"><span class="mt-2 h-2 w-2 rounded-full bg-sky-500"></span><span>Conductores profesionales</span></li>
                            <li class="flex items-start gap-3"><span class="mt-2 h-2 w-2 rounded-full bg-sky-500"></span><span>Seguimiento de vuelo en recogidas de aeropuerto</span></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <div class="rounded-2xl bg-zinc-50 ring-1 ring-zinc-200 p-6">
                    <h3 class="text-xl font-bold text-zinc-900 mb-4">Por qué elegir Transfer Marbell</h3>
                    <ul class="space-y-3 text-zinc-700">
                        <li class="flex items-start gap-3">
                            <span class="mt-2 h-2 w-2 rounded-full bg-amber-400"></span>
                            <span>Recogida puntual y atención personalizada.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-2 h-2 w-2 rounded-full bg-amber-400"></span>
                            <span>Servicio directo desde o hasta hoteles, villas, apartamentos y estaciones.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-2 h-2 w-2 rounded-full bg-amber-400"></span>
                            <span>Vehículos adaptados al tipo de viaje y al volumen de equipaje.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-2 h-2 w-2 rounded-full bg-amber-400"></span>
                            <span>Reserva sencilla y confirmación clara del servicio.</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="rounded-2xl bg-[#0f172a] text-white shadow-xl overflow-hidden">
                <div class="p-6 md:p-8">
                    <h3 class="text-2xl font-bold">Un traslado cómodo, claro y profesional</h3>
                    <p class="mt-3 text-white/80 leading-7">
                        Si estás buscando un <strong>traslado privado desde o hasta el Aeropuerto de Málaga a <?= e($name) ?></strong>, esta página está pensada para ayudarte a encontrar una opción directa y fiable. Nuestro objetivo es ofrecer un servicio cómodo desde la llegada, con asistencia profesional y sin complicaciones.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="/#goToQuote" class="inline-flex items-center rounded-xl bg-sky-500 px-5 py-3 text-sm font-semibold text-white hover:bg-sky-600">
                            Solicitar traslado
                        </a>
                        <a href="/destinos" class="inline-flex items-center rounded-xl border border-white/15 bg-white/10 px-5 py-3 text-sm font-semibold text-white hover:bg-white/15">
                            Explorar más destinos
                        </a>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl bg-white shadow-xl ring-1 ring-black/5 p-6 md:p-8">
                <h2 class="text-2xl font-bold tracking-tight text-zinc-900 mb-6">
                    Preguntas frecuentes sobre el traslado a <?= e($name) ?>
                </h2>

                <div class="space-y-4">
                    <?php foreach ($faqItems as $faq): ?>
                        <details class="group rounded-2xl border border-zinc-200 bg-zinc-50 p-5">
                            <summary class="flex cursor-pointer list-none items-center justify-between gap-4 font-semibold text-zinc-900">
                                <span><?= e($faq['q']) ?></span>
                                <span class="text-sky-600 transition group-open:rotate-45">+</span>
                            </summary>
                            <p class="mt-4 text-zinc-700 leading-7">
                                <?= e($faq['a']) ?>
                            </p>
                        </details>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="rounded-2xl bg-white shadow-xl ring-1 ring-black/5 p-6">
                <h3 class="text-xl font-bold text-zinc-900">Resumen de la ruta</h3>

                <div class="mt-5 space-y-4">
                    <div class="flex items-start justify-between gap-4 border-b border-zinc-100 pb-4">
                        <span class="text-zinc-500">Destino</span>
                        <span class="font-semibold text-zinc-900 text-right"><?= e($name) ?></span>
                    </div>

                    <div class="flex items-start justify-between gap-4 border-b border-zinc-100 pb-4">
                        <span class="text-zinc-500">Trayecto</span>
                        <span class="font-semibold text-zinc-900 text-right">Aeropuerto de Málaga ↔ <?= e($name) ?></span>
                    </div>

                    <div class="flex items-start justify-between gap-4 border-b border-zinc-100 pb-4">
                        <span class="text-zinc-500">Tiempo estimado</span>
                        <span class="font-semibold text-zinc-900 text-right"><?= e($travelTime) ?></span>
                    </div>

                    <div class="flex items-start justify-between gap-4 border-b border-zinc-100 pb-4">
                        <span class="text-zinc-500">Servicio</span>
                        <span class="font-semibold text-zinc-900 text-right">Privado</span>
                    </div>

                    <div class="flex items-start justify-between gap-4">
                        <span class="text-zinc-500">Reserva</span>
                        <span class="font-semibold text-zinc-900 text-right">Bajo solicitud</span>
                    </div>
                </div>

                <a href="/#goToQuote" class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-sky-600 px-4 py-3 text-sm font-semibold text-white hover:bg-sky-700">
                    Ir al motor de reservas
                </a>
            </div>

            <div class="rounded-2xl bg-white shadow-xl ring-1 ring-black/5 p-6">
                <h3 class="text-xl font-bold text-zinc-900">Ideal para</h3>
                <ul class="mt-4 space-y-3 text-zinc-700">
                    <li class="flex items-start gap-3"><span class="mt-2 h-2 w-2 rounded-full bg-sky-500"></span><span>Hoteles y apartamentos</span></li>
                    <li class="flex items-start gap-3"><span class="mt-2 h-2 w-2 rounded-full bg-sky-500"></span><span>Villas y alquiler vacacional</span></li>
                    <li class="flex items-start gap-3"><span class="mt-2 h-2 w-2 rounded-full bg-sky-500"></span><span>Familias y grupos pequeños</span></li>
                    <li class="flex items-start gap-3"><span class="mt-2 h-2 w-2 rounded-full bg-sky-500"></span><span>Viajes de empresa y clientes premium</span></li>
                </ul>
            </div>

            <div class="rounded-2xl bg-slate-50 ring-1 ring-slate-200 p-6">
                <h3 class="text-xl font-bold text-zinc-900">Reserva con antelación</h3>
                <p class="mt-3 text-zinc-700 leading-7">
                    Para asegurar disponibilidad, especialmente en temporada alta, festivos o servicios de madrugada, recomendamos solicitar el traslado con antelación.
                </p>
            </div>
        </aside>
    </div>
</section>

<?php if (!empty($related)): ?>
<section class="pb-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-zinc-900">Destinos relacionados</h2>
                <p class="mt-2 text-zinc-600">
                    Otros trayectos que suelen interesar a los viajeros que buscan traslados en esta zona.
                </p>
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($related as $item): ?>
                <article class="group rounded-2xl bg-white shadow-xl ring-1 ring-black/5 overflow-hidden hover:-translate-y-0.5 hover:shadow-2xl transition">
                    <div class="relative">
                        <img
                            src="<?= e($item['image']) ?>"
                            alt="<?= e($item['name']) ?>"
                            class="w-full aspect-[16/10] object-cover"
                            loading="lazy"
                            onerror="this.onerror=null;this.src='/assets/images/transfers/default.jpg';"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-black/0 to-transparent"></div>
                    </div>

                    <div class="p-5">
                        <div class="text-xs font-semibold uppercase tracking-wide text-sky-700">
                            <?= e($item['group']) ?>
                        </div>

                        <h3 class="mt-1 text-lg font-bold text-zinc-900">
                            <?= e($item['name']) ?>
                        </h3>

                        <p class="mt-2 text-sm text-zinc-600 leading-6">
                            <?= e($item['lead']) ?>
                        </p>

                        <a href="/destinos/<?= e($item['slug']) ?>" class="mt-4 inline-flex items-center gap-2 rounded-xl bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">
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
</section>
<?php endif; ?>
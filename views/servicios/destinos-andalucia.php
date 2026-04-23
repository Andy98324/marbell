<?php
$transfers = require __DIR__ . '/transfers.php';

/*
|--------------------------------------------------------------------------
| AJUSTES
|--------------------------------------------------------------------------
| Cambia esta base si tus páginas de destino cuelgan de otra ruta.
| Ejemplo: /traslados, /transfer, /destinos, etc.
*/
$routeBase = '/traslados';

/*
|--------------------------------------------------------------------------
| DESTINOS DESTACADOS
|--------------------------------------------------------------------------
| He priorizado:
| - Costa del Sol / Axarquía
| - Ciudades andaluzas muy demandadas
| - Sierra Nevada como ruta estacional muy fuerte
*/
$featuredGroups = [
    'Costa del Sol y Axarquía' => [
        'marbella',
        'puerto-banus',
        'estepona',
        'fuengirola',
        'benalmadena',
        'mijas',
        'nerja',
        'frigiliana',
        'torrox',
    ],
    'Ciudades imprescindibles de Andalucía' => [
        'granada',
        'cordoba',
        'sevilla',
        'cadiz',
    ],
    'Rutas especiales' => [
        'sierra-nevada',
    ],
];

$pageTitle = 'Destinos más visitados de Andalucía desde el Aeropuerto de Málaga | Transfer Marbell';
$metaDescription = 'Explora los destinos más visitados de Andalucía para viajar desde o hasta el Aeropuerto de Málaga con Transfer Marbell. Rutas privadas a Marbella, Fuengirola, Benalmádena, Nerja, Granada, Córdoba, Sevilla, Cádiz y más.';
$canonical = 'https://transfermarbell.com/destinos-mas-visitados-andalucia-desde-aeropuerto-malaga';

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function routeUrl(string $base, string $slug): string
{
    return rtrim($base, '/') . '/' . $slug . '/';
}

function routeBadge(string $slug): array
{
    $map = [
        'marbella'      => ['Muy demandado', 'badge-hot'],
        'puerto-banus'  => ['Premium', 'badge-premium'],
        'estepona'      => ['Ruta popular', 'badge-hot'],
        'fuengirola'    => ['Ruta rápida', 'badge-fast'],
        'benalmadena'   => ['Ruta rápida', 'badge-fast'],
        'mijas'         => ['Golf y vacaciones', 'badge-golf'],
        'nerja'         => ['Costa oriental', 'badge-coast'],
        'frigiliana'    => ['Pueblo blanco', 'badge-charming'],
        'torrox'        => ['Estancias largas', 'badge-coast'],
        'granada'       => ['Ciudad cultural', 'badge-city'],
        'cordoba'       => ['Ciudad monumental', 'badge-city'],
        'sevilla'       => ['Ciudad imprescindible', 'badge-city'],
        'cadiz'         => ['Ruta larga', 'badge-long'],
        'sierra-nevada' => ['Temporada de nieve', 'badge-snow'],
    ];

    return $map[$slug] ?? ['Destino recomendado', 'badge-default'];
}

function nearbyLinks(array $nearby, array $transfers, string $routeBase): string
{
    $items = [];

    foreach ($nearby as $slug) {
        if (!isset($transfers[$slug])) {
            continue;
        }

        $items[] = '<a href="' . e(routeUrl($routeBase, $slug)) . '">' . e($transfers[$slug]['name']) . '</a>';
    }

    return implode(' · ', $items);
}

function highlightsHtml(array $highlights): string
{
    $html = '';

    foreach (array_slice($highlights, 0, 3) as $item) {
        $html .= '<li>' . e($item) . '</li>';
    }

    return $html;
}

?><!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="<?= e($metaDescription) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="<?= e($canonical) ?>">
    <meta property="og:title" content="<?= e($pageTitle) ?>">
    <meta property="og:description" content="<?= e($metaDescription) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= e($canonical) ?>">
    <meta property="og:image" content="https://transfermarbell.com/assets/images/transfers/Marbella.jpeg">

    <style>
        :root{
            --bg:#0f172a;
            --card:#ffffff;
            --muted:#64748b;
            --text:#0f172a;
            --line:#e2e8f0;
            --brand:#0ea5e9;
            --brand-dark:#0369a1;
            --soft:#f8fafc;
            --shadow:0 10px 30px rgba(15,23,42,.08);
            --radius:20px;
        }
        *{box-sizing:border-box}
        html,body{margin:0;padding:0}
        body{
            font-family:Arial,Helvetica,sans-serif;
            color:var(--text);
            background:#fff;
            line-height:1.6;
        }
        a{color:var(--brand-dark);text-decoration:none}
        a:hover{text-decoration:underline}
        .wrap{
            width:min(1200px, calc(100% - 32px));
            margin:0 auto;
        }
        .hero{
            background:linear-gradient(135deg,#e0f2fe 0%, #f8fafc 55%, #ffffff 100%);
            padding:72px 0 42px;
            border-bottom:1px solid var(--line);
        }
        .hero-grid{
            display:grid;
            grid-template-columns:1.25fr .95fr;
            gap:28px;
            align-items:center;
        }
        .eyebrow{
            display:inline-block;
            padding:8px 14px;
            border-radius:999px;
            background:#e0f2fe;
            color:#075985;
            font-size:13px;
            font-weight:700;
            margin-bottom:16px;
        }
        h1{
            font-size:clamp(34px,5vw,56px);
            line-height:1.08;
            margin:0 0 18px;
            letter-spacing:-.03em;
        }
        .hero p{
            margin:0 0 14px;
            color:#334155;
            font-size:18px;
        }
        .hero-card{
            background:#fff;
            border:1px solid var(--line);
            border-radius:24px;
            padding:24px;
            box-shadow:var(--shadow);
        }
        .hero-list{
            margin:0;
            padding-left:18px;
            color:#334155;
        }
        .hero-list li{margin:8px 0}
        .section{
            padding:56px 0;
        }
        .section h2{
            font-size:32px;
            margin:0 0 10px;
            line-height:1.15;
        }
        .section-intro{
            color:var(--muted);
            max-width:840px;
            margin-bottom:28px;
        }
        .group-title{
            font-size:24px;
            margin:0 0 18px;
            padding-bottom:10px;
            border-bottom:1px solid var(--line);
        }
        .cards{
            display:grid;
            grid-template-columns:repeat(3,minmax(0,1fr));
            gap:22px;
            margin-bottom:40px;
        }
        .card{
            background:var(--card);
            border:1px solid var(--line);
            border-radius:var(--radius);
            overflow:hidden;
            box-shadow:var(--shadow);
            display:flex;
            flex-direction:column;
            min-height:100%;
        }
        .card-media{
            aspect-ratio:16/10;
            background:#cbd5e1;
            overflow:hidden;
        }
        .card-media img{
            width:100%;
            height:100%;
            object-fit:cover;
            display:block;
        }
        .card-body{
            padding:22px;
            display:flex;
            flex-direction:column;
            gap:12px;
            flex:1;
        }
        .meta-row{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:12px;
            flex-wrap:wrap;
        }
        .group-chip{
            font-size:12px;
            font-weight:700;
            color:#475569;
            background:#f1f5f9;
            border-radius:999px;
            padding:6px 10px;
        }
        .badge{
            font-size:12px;
            font-weight:700;
            border-radius:999px;
            padding:6px 10px;
        }
        .badge-hot{background:#fee2e2;color:#991b1b}
        .badge-fast{background:#dcfce7;color:#166534}
        .badge-premium{background:#ede9fe;color:#5b21b6}
        .badge-golf{background:#fef3c7;color:#92400e}
        .badge-coast{background:#e0f2fe;color:#075985}
        .badge-city{background:#e2e8f0;color:#334155}
        .badge-charming{background:#fae8ff;color:#86198f}
        .badge-long{background:#ffedd5;color:#9a3412}
        .badge-snow{background:#ecfeff;color:#155e75}
        .badge-default{background:#f1f5f9;color:#334155}
        .card h3{
            margin:0;
            font-size:24px;
            line-height:1.15;
        }
        .lead{
            margin:0;
            color:#334155;
            font-size:15px;
        }
        .time{
            font-size:14px;
            font-weight:700;
            color:#0f172a;
            background:#f8fafc;
            border:1px solid var(--line);
            padding:10px 12px;
            border-radius:12px;
        }
        .highlights{
            margin:0;
            padding-left:18px;
            color:#475569;
            font-size:14px;
        }
        .highlights li{margin:6px 0}
        .nearby{
            font-size:14px;
            color:var(--muted);
        }
        .card-actions{
            margin-top:auto;
            padding-top:8px;
        }
        .btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            min-height:46px;
            padding:0 18px;
            border-radius:12px;
            background:var(--brand);
            color:#fff;
            font-weight:700;
            text-decoration:none;
            transition:.2s ease;
        }
        .btn:hover{
            background:var(--brand-dark);
            text-decoration:none;
        }
        .seo-box{
            background:var(--soft);
            border:1px solid var(--line);
            border-radius:24px;
            padding:28px;
        }
        .seo-box p:last-child{margin-bottom:0}
        .faq{
            display:grid;
            gap:14px;
        }
        .faq-item{
            border:1px solid var(--line);
            border-radius:18px;
            padding:20px;
            background:#fff;
        }
        .faq-item h3{
            margin:0 0 8px;
            font-size:18px;
        }
        .cta{
            padding:64px 0 80px;
        }
        .cta-box{
            background:linear-gradient(135deg,#0f172a 0%, #1e293b 100%);
            color:#fff;
            border-radius:28px;
            padding:32px;
            box-shadow:var(--shadow);
        }
        .cta-box h2{
            margin:0 0 10px;
            font-size:32px;
        }
        .cta-box p{
            margin:0 0 18px;
            color:#cbd5e1;
            max-width:760px;
        }
        .cta-box .btn{
            background:#38bdf8;
            color:#082f49;
        }
        @media (max-width: 1024px){
            .cards{grid-template-columns:repeat(2,minmax(0,1fr))}
            .hero-grid{grid-template-columns:1fr}
        }
        @media (max-width: 640px){
            .cards{grid-template-columns:1fr}
            .hero{padding-top:54px}
            .section{padding:42px 0}
            .card-body{padding:18px}
            .cta{padding:42px 0 56px}
        }
    </style>

    <?php
    $itemListElements = [];
    $position = 1;

    foreach ($featuredGroups as $group => $slugs) {
        foreach ($slugs as $slug) {
            if (!isset($transfers[$slug])) {
                continue;
            }

            $itemListElements[] = [
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $transfers[$slug]['name'],
                'url' => 'https://transfermarbell.com' . routeUrl($routeBase, $slug),
            ];
        }
    }

    $jsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'name' => 'Destinos más visitados de Andalucía desde el Aeropuerto de Málaga',
        'itemListElement' => $itemListElements,
    ];
    ?>
    <script type="application/ld+json"><?= json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?></script>
</head>
<body>

<?php /* include __DIR__ . '/partials/header.php'; */ ?>

<section class="hero">
    <div class="wrap hero-grid">
        <div>
            <span class="eyebrow">Traslados privados desde / hasta AGP</span>
            <h1>Destinos más visitados de Andalucía desde el Aeropuerto de Málaga</h1>
            <p>
                Descubre las rutas más demandadas para viajar desde o hasta el Aeropuerto de Málaga con
                <strong>Transfer Marbell</strong>, incluyendo la Costa del Sol, la Axarquía y grandes ciudades
                andaluzas como Sevilla, Granada, Córdoba y Cádiz.
            </p>
            <p>
                Todos los trayectos de esta página son destinos viables para un <strong>traslado privado directo</strong>,
                con precio acordado, recogida puntual y servicio puerta a puerta.
            </p>
        </div>

        <div class="hero-card">
            <h2 style="margin-top:0;">¿Qué encontrarás en esta página?</h2>
            <ul class="hero-list">
                <li>Rutas turísticas con alta demanda real desde el Aeropuerto de Málaga.</li>
                <li>Destinos costeros, ciudades monumentales y escapadas de montaña.</li>
                <li>Tiempos aproximados de viaje para ayudar al usuario a decidir.</li>
                <li>Enlaces internos a páginas de destino para reforzar SEO y conversiones.</li>
            </ul>
        </div>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <h2>Rutas recomendadas para viajar por Andalucía</h2>
        <p class="section-intro">
            Hemos reunido aquí los destinos más atractivos y reservados para moverse desde o hasta el Aeropuerto
            de Málaga, priorizando zonas turísticas con gran demanda y trayectos razonables para transfer privado.
        </p>

        <?php foreach ($featuredGroups as $groupTitle => $slugs): ?>
            <h3 class="group-title"><?= e($groupTitle) ?></h3>

            <div class="cards">
                <?php foreach ($slugs as $slug): ?>
                    <?php if (!isset($transfers[$slug])) continue; ?>
                    <?php
                        $item = $transfers[$slug];
                        [$badgeText, $badgeClass] = routeBadge($slug);
                    ?>
                    <article class="card">
                        <div class="card-media">
                            <a href="<?= e(routeUrl($routeBase, $slug)) ?>">
                                <img
                                    src="<?= e($item['image']) ?>"
                                    alt="<?= e($item['short_title']) ?>"
                                    loading="lazy"
                                    width="800"
                                    height="500"
                                >
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="meta-row">
                                <span class="group-chip"><?= e($item['group']) ?></span>
                                <span class="badge <?= e($badgeClass) ?>"><?= e($badgeText) ?></span>
                            </div>

                            <h3>
                                <a href="<?= e(routeUrl($routeBase, $slug)) ?>">
                                    <?= e($item['name']) ?>
                                </a>
                            </h3>

                            <p class="lead"><?= e($item['lead']) ?></p>

                            <div class="time"><?= e($item['travel_time']) ?></div>

                            <ul class="highlights">
                                <?= highlightsHtml($item['highlights']) ?>
                            </ul>

                            <?php if (!empty($item['nearby'])): ?>
                                <div class="nearby">
                                    <strong>También te puede interesar:</strong>
                                    <?= nearbyLinks($item['nearby'], $transfers, $routeBase) ?>
                                </div>
                            <?php endif; ?>

                            <div class="card-actions">
                                <a class="btn" href="<?= e(routeUrl($routeBase, $slug)) ?>">
                                    Ver traslado a <?= e($item['name']) ?>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="section">
    <div class="wrap seo-box">
        <h2>Traslados privados viables desde el Aeropuerto de Málaga</h2>
        <p>
            El Aeropuerto de Málaga es uno de los grandes puntos de entrada a Andalucía para turismo vacacional,
            escapadas urbanas, golf, nieve, alquiler vacacional y viajes de empresa. Por eso, una página como esta
            te ayuda a trabajar búsquedas amplias del tipo <strong>“destinos de Andalucía desde el aeropuerto de Málaga”</strong>,
            <strong>“transfer privado por Andalucía”</strong> o <strong>“viajar desde Málaga a Sevilla, Granada o Marbella”</strong>.
        </p>
        <p>
            Además de captar tráfico SEO, esta landing sirve como hub interno para repartir autoridad hacia tus páginas
            de destino más rentables y mejorar la navegación del usuario entre rutas cercanas como Marbella, Puerto Banús,
            Estepona, Fuengirola, Benalmádena, Mijas, Nerja, Frigiliana o Torrox.
        </p>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <h2>Preguntas frecuentes</h2>

        <div class="faq">
            <div class="faq-item">
                <h3>¿Se puede viajar en traslado privado desde Málaga a otras ciudades de Andalucía?</h3>
                <p>
                    Sí. Además de la Costa del Sol, también ofrecemos rutas privadas desde o hasta el Aeropuerto de Málaga
                    a ciudades como Granada, Córdoba, Sevilla o Cádiz, así como trayectos estacionales a Sierra Nevada.
                </p>
            </div>

            <div class="faq-item">
                <h3>¿Qué destinos son más cómodos para evitar trenes, autobuses o transbordos?</h3>
                <p>
                    Nerja, Frigiliana, Torrox, Estepona, Puerto Banús o Sierra Nevada son rutas especialmente cómodas
                    en transfer privado, porque permiten llegar de forma directa al hotel, villa o apartamento.
                </p>
            </div>

            <div class="faq-item">
                <h3>¿Puedo reservar tanto ida como vuelta?</h3>
                <p>
                    Sí. Puedes reservar traslados desde o hasta el Aeropuerto de Málaga, así como servicios de regreso
                    desde cualquiera de los destinos incluidos en esta página.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="cta">
    <div class="wrap">
        <div class="cta-box">
            <h2>Reserva tu traslado privado por Andalucía</h2>
            <p>
                Viaja con comodidad, puntualidad y atención personalizada desde o hasta el Aeropuerto de Málaga.
                Elige tu destino y accede a la página específica de cada ruta para ver más información y solicitar reserva.
            </p>
            <a class="btn" href="/contacto">Solicitar traslado</a>
        </div>
    </div>
</section>

<?php /* include __DIR__ . '/partials/footer.php'; */ ?>

</body>
</html>
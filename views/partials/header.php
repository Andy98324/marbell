<?php
// === NAV (con descripciones para el mega-menu) ===
$nav = [
  ['label'=>t('nav.home'),  'href'=>'/'],

  ['label'=>t('nav.about'), 'href'=>'#', 'items'=>[
    [
      'label'=>t('nav.about.team'),
      'href'=>'/nosotros',
      'title'=>t('title.about'),
    ],
  ]],

  ['label'=>t('nav.services'), 'href'=>'/servicios', 'items'=>[
    [
      'label'=>t('nav.services.transfers'),
      'href'=>'/servicios/traslados',
      'title'=>t('title.services'),
    ],
    [
      'label'=>t('nav.services.excursions'), 
      'href'=>'/servicios/excursiones',
      'title'=>t('title.excursions'),
    ],
    [
      'label' => t('nav.services.guided'),
      'href'  => '/servicios/visitas-guiadas',
      'title'=>t('title.guided'),
    ],

  ]],

  ['label'=>t('nav.fleet'), 'href'=>'#', 'items'=>[
    [
      'label'=>t('nav.fleet.sedan'),
      'href'=>'/flota',
      'title'=>t('title.fleet'),
    ],
  ]],
  
];


// === Utils: path actual y clases activas ===
$currentPath = rtrim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/', '/');
if ($currentPath === '') $currentPath = '/';

function is_active(string $href, string $current): bool {
  // activa exacto o si es prefijo (para secciones)
  if ($href === '#') return false;
  if ($href === '/') return $current === '/';
  return $current === rtrim($href, '/') || str_starts_with($current, rtrim($href, '/').'/');
}

// Altura del logo (ajústalo aquí): móvil 40px / desktop 48px
$logoH_mobile = 'h-10';
$logoH_desktop = 'md:h-12';

// Idioma actual
$lang = current_lang();
?>

<style>[x-cloak]{display:none!important}</style>

<header x-data="{mobile:false, open:null}" class="sticky top-0 z-50 backdrop-blur supports-[backdrop-filter]:bg-[#1f2a44]/70 bg-[#1f2a44]">
  <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-white" role="navigation" aria-label="Main">
    <div class="flex items-center justify-between h-16">
      <!-- Logo -->
      <a href="/" class="flex items-center gap-3" aria-label="<?= htmlspecialchars(t('brand')) ?>">
        <img src="/assets/logo.png" alt="<?= htmlspecialchars(t('brand')) ?>" class="h-10 md:h-12 w-auto object-contain" width="160" height="48" loading="eager" fetchpriority="high">
        <span class="sr-only"><?= t('brand') ?></span>
      </a>

      <!-- Desktop -->
      <ul class="hidden md:flex items-center gap-6 lg:gap-8 text-sm font-medium">
        <?php $i=0; foreach ($nav as $item): $i++; $active = is_active($item['href'] ?? '#', $currentPath); ?>
          <li class="relative" @keydown.escape.window="open=null">
            <?php if (!empty($item['items'])): ?>
              <button
                @click="open === <?= $i ?> ? open=null : open=<?= $i ?>"
                :aria-expanded="open === <?= $i ?> ? 'true' : 'false'"
                class="inline-flex items-center gap-1 uppercase focus:outline-none focus-visible:ring-2 focus-visible:ring-white/60 <?= $active ? 'text-white' : 'text-white/80 hover:text-white' ?>">
                <?= htmlspecialchars($item['label']) ?>
                <svg class="h-4 w-4 opacity-70" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
              </button>

              <!-- Mega -->
              <div
                x-cloak x-show="open === <?= $i ?>" x-transition
                @click.outside="open=null"
                class="absolute left-1/2 -translate-x-1/2 mt-3 w-[min(88vw,760px)] rounded-2xl bg-white text-zinc-800 shadow-2xl ring-1 ring-black/10">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 p-3">
                  <?php foreach ($item['items'] as $sub): ?>
                    <a href="<?= htmlspecialchars($sub['href']) ?>"
                       class="group flex items-start gap-3 rounded-xl p-3 hover:bg-zinc-50 focus:bg-zinc-50 focus:outline-none">
                      <div class="mt-0.5 h-8 w-8 rounded-lg bg-zinc-100 grid place-items-center">
                        <!-- Icono placeholder; cámbialo si quieres -->
                        <svg class="h-4 w-4 text-zinc-600" viewBox="0 0 24 24" fill="currentColor"><path d="M4 6h16v2H4zM4 11h16v2H4zM4 16h10v2H4z"/></svg>
                      </div>
                      <div class="min-w-0">
                        <div class="flex items-center gap-2">
                          <span class="truncate font-semibold text-zinc-900"><?= htmlspecialchars($sub['label']) ?></span>
                          <?php if (str_contains(($sub['href'] ?? ''), '/servicios/traslados')): ?>
                            <span class="text-[10px] uppercase tracking-wide rounded bg-sky-100 text-sky-700 px-1.5 py-0.5">Popular</span>
                          <?php endif; ?>
                        </div>
                        <p class="text-xs text-zinc-500 line-clamp-2">
                          <?= htmlspecialchars($sub['title'] ?? '') ?: 'Ver detalles, tarifas y disponibilidad' ?>
                        </p>
                      </div>
                      <svg class="ml-auto h-4 w-4 text-zinc-400 opacity-0 group-hover:opacity-100 transition" viewBox="0 0 24 24" fill="currentColor"><path d="M9 6l6 6-6 6"/></svg>
                    </a>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php else: ?>
              <a href="<?= htmlspecialchars($item['href']) ?>"
                 class="uppercase relative after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-0 after:bg-current after:transition-[width] hover:after:w-full <?= $active ? 'text-white after:w-full' : 'text-white/80 hover:text-white' ?>">
                <?= htmlspecialchars($item['label']) ?>
              </a>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>

      <!-- Acciones -->
      <div class="hidden md:flex items-center gap-3">
        <div class="relative group">
          <div class="hidden md:flex items-center gap-3">
            <span class="text-sm text-white/60 mr-2"><?= t('nav.language') ?>:</span>
            <a href="<?= switch_lang_url('es') ?>" class="rounded bg-white/10 px-2 py-1 text-xs <?= current_lang()=='es'?'bg-sky-600':'' ?>">ES</a>
            <a href="<?= switch_lang_url('en') ?>" class="rounded bg-white/10 px-2 py-1 text-xs <?= current_lang()=='en'?'bg-sky-600':'' ?>">EN</a>
          </div>
        </div>
        <a href="/reservar" class="inline-flex items-center rounded-xl bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700"><?= t('nav.book') ?></a>
      </div>

      <!-- Burger -->
      <button @click="mobile=!mobile; open=null" class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-lg bg-white/10" aria-controls="mobile-menu" :aria-expanded="mobile ? 'true' : 'false'">
        <svg x-show="!mobile" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        <svg x-show="mobile" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>

    <!-- Mobile -->
    <div id="mobile-menu" x-cloak x-show="mobile" x-transition class="md:hidden pb-3">
      <ul class="space-y-2">
        <?php foreach ($nav as $item): ?>
          <?php if (empty($item['items'])): ?>
            <li><a href="<?= htmlspecialchars($item['href']) ?>" class="block rounded-lg px-3 py-2 text-white/90 hover:bg-white/10 <?= is_active($item['href'], $currentPath) ? 'bg-white/15 text-white' : '' ?>"><?= htmlspecialchars($item['label']) ?></a></li>
          <?php else: ?>
            <li x-data="{dd:false}">
              <button @click="dd=!dd" class="w-full rounded-lg px-3 py-2 flex items-center justify-between text-white/90 hover:bg-white/10">
                <span><?= htmlspecialchars($item['label']) ?></span>
                <svg class="h-4 w-4 transition" :class="dd ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
              </button>
              <ul x-show="dd" x-transition class="mt-1 ml-2 space-y-1">
                <?php foreach ($item['items'] as $sub): ?>
                  <li><a href="<?= htmlspecialchars($sub['href']) ?>" class="block rounded px-3 py-1.5 text-white/80 hover:bg-white/10"><?= htmlspecialchars($sub['label']) ?></a></li>
                <?php endforeach; ?>
              </ul>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
        <li class="flex items-center gap-2 px-3 pt-2">
          <span class="text-white/70 text-sm"><?= t('nav.language') ?>:</span>
          <a href="<?= htmlspecialchars(switch_lang_url('es')) ?>" class="rounded bg-white/10 px-2 py-1 text-xs <?= $lang==='es' ? 'ring-1 ring-white/60' : '' ?>">ES</a>
          <a href="<?= htmlspecialchars(switch_lang_url('en')) ?>" class="rounded bg-white/10 px-2 py-1 text-xs <?= $lang==='en' ? 'ring-1 ring-white/60' : '' ?>">EN</a>
          <a href="/reservar" class="ml-auto rounded-lg bg-sky-600 px-3 py-2 text-sm font-semibold"><?= t('nav.book') ?></a>
        </li>
      </ul>
    </div>
  </nav>
</header>

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

  ['label'=>t('nav.services'), 'href'=>'#', 'items'=>[

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

   ['label'=>t('nav.panel'),  'href'=>'/admin/login.php'],
  
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

<header
  x-data="{mobile:false, open:null}"
  class="sticky top-0 z-50
         bg-[#1f2a44]/95 supports-[backdrop-filter]:bg-[#1f2a44]/80
         backdrop-blur-md
         border-b border-white/10
         shadow-[0_10px_30px_rgba(0,0,0,0.25)]">

  <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-white" role="navigation" aria-label="Main">
    <div class="flex items-center justify-between h-16">

      <!-- Logo (más grande + brillo suave) -->
<a href="/" class="flex items-center gap-3" aria-label="<?= htmlspecialchars(t('brand')) ?>">
  

  <!-- Wordmark con halo blanco detrás -->
<!-- Wordmark: halo más marcado + letras más juntas -->
<span class="relative flex items-center gap-1">
  <!-- Halo blanco MÁS marcado -->
  <span class="absolute -inset-x-4 -inset-y-2 rounded-2xl
               bg-[radial-gradient(circle,rgba(255,255,255,0.55)_0%,rgba(255,255,255,0.22)_38%,rgba(255,255,255,0.00)_72%)]
               blur-2xl opacity-100 -z-10"></span>

  <span class="text-[#18c6c8] font-bold uppercase tracking-[0.08em] md:tracking-[0.10em]
               [text-shadow:0_1px_0_rgba(255,255,255,0.20)]">
    Transfer
  </span>

  <span class="text-[#0b2a3a] font-semibold uppercase tracking-[0.06em] md:tracking-[0.08em]
               [text-shadow:0_1px_0_rgba(255,255,255,0.18)]">
    Mar
  </span>

  <!-- check más pegado -->
  <svg viewBox="0 0 24 24" class="h-[14px] w-[14px] opacity-95 mx-0.5">
    <circle cx="12" cy="12" r="9"
            fill="rgba(24,198,200,0.14)"
            stroke="rgba(24,198,200,0.95)"
            stroke-width="1.8"/>
    <path d="M8.2 12.4l2.4 2.5 5.6-6.1"
          fill="none"
          stroke="rgba(24,198,200,0.95)"
          stroke-width="2.2"
          stroke-linecap="round"
          stroke-linejoin="round"/>
  </svg>

  <span class="text-[#0b2a3a] font-semibold uppercase tracking-[0.06em] md:tracking-[0.08em]
               [text-shadow:0_1px_0_rgba(255,255,255,0.18)]">
    Bell
  </span>
</span>


</a>





      <!-- Desktop -->
      <ul class="hidden md:flex items-center gap-2 lg:gap-3 text-[13px] lg:text-sm font-semibold tracking-wide">
        <?php $i=0; foreach ($nav as $item): $i++; $active = is_active($item['href'] ?? '#', $currentPath); ?>
          <li class="relative" @keydown.escape.window="open=null">

            <?php if (!empty($item['items'])): ?>
              <button
                @click="open === <?= $i ?> ? open=null : open=<?= $i ?>"
                :aria-expanded="open === <?= $i ?> ? 'true' : 'false'"
                class="inline-flex items-center gap-1 uppercase
                       px-3 py-2 rounded-xl
                       transition
                       <?= $active ? 'bg-white/15 text-white ring-1 ring-white/15' : 'text-white/90 hover:text-white hover:bg-white/10' ?>
                       focus:outline-none focus-visible:ring-2 focus-visible:ring-white/60">
                <?= htmlspecialchars($item['label']) ?>
                <svg class="h-4 w-4 opacity-80" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
              </button>

              <!-- Mega (más “premium” y legible) -->
              <div
                x-cloak x-show="open === <?= $i ?>" x-transition
                @click.outside="open=null"
                class="absolute left-1/2 -translate-x-1/2 mt-3 w-[min(90vw,820px)]
                       rounded-2xl bg-white text-zinc-900
                       shadow-2xl ring-1 ring-black/10 overflow-hidden">

                <div class="px-5 py-3 bg-zinc-50 border-b border-zinc-200">
                  <div class="text-xs font-semibold tracking-wide text-zinc-500 uppercase">
                    <?= htmlspecialchars($item['label']) ?>
                  </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 p-4">
                  <?php foreach ($item['items'] as $sub): ?>
                    <a href="<?= htmlspecialchars($sub['href']) ?>"
                       class="group flex items-start gap-3 rounded-xl p-3
                              hover:bg-zinc-50 focus:bg-zinc-50 focus:outline-none
                              ring-1 ring-transparent hover:ring-zinc-200 transition">
                      <div class="mt-0.5 h-9 w-9 rounded-lg bg-zinc-100 grid place-items-center">
                        <svg class="h-4 w-4 text-zinc-700" viewBox="0 0 24 24" fill="currentColor"><path d="M4 6h16v2H4zM4 11h16v2H4zM4 16h10v2H4z"/></svg>
                      </div>
                      <div class="min-w-0">
                        <div class="flex items-center gap-2">
                          <span class="truncate font-bold text-zinc-900"><?= htmlspecialchars($sub['label']) ?></span>
                          <?php if (str_contains(($sub['href'] ?? ''), '/servicios/traslados')): ?>
                            <span class="text-[10px] uppercase tracking-wide rounded bg-sky-100 text-sky-700 px-1.5 py-0.5">Popular</span>
                          <?php endif; ?>
                        </div>
                        <p class="text-xs text-zinc-600 line-clamp-2">
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
                 class="uppercase px-3 py-2 rounded-xl transition
                        <?= $active ? 'bg-white/15 text-white ring-1 ring-white/15' : 'text-white/90 hover:text-white hover:bg-white/10' ?>">
                <?= htmlspecialchars($item['label']) ?>
              </a>
            <?php endif; ?>

          </li>
        <?php endforeach; ?>
      </ul>

      <!-- Acciones -->
      <div class="hidden md:flex items-center gap-3">
        <!-- Idiomas (más visibles) -->
        <div class="hidden md:flex items-center gap-2">
          <span class="text-sm text-white/70 mr-2"><?= t('nav.language') ?>:</span>

          <a href="<?= switch_lang_url('es') ?>"
             class="rounded-lg px-2.5 py-1 text-xs font-semibold
                    border border-white/15
                    <?= current_lang()=='es' ? 'bg-white/20 text-white' : 'bg-white/10 text-white/85 hover:bg-white/15' ?>">
            ES
          </a>

          <a href="<?= switch_lang_url('en') ?>"
             class="rounded-lg px-2.5 py-1 text-xs font-semibold
                    border border-white/15
                    <?= current_lang()=='en' ? 'bg-white/20 text-white' : 'bg-white/10 text-white/85 hover:bg-white/15' ?>">
            EN
          </a>
        </div>

        <!-- CTA Reservar (ahora sí destaca) -->
        <a href="/#goToQuote"
           class="inline-flex items-center rounded-full px-5 py-2 text-sm font-extrabold
                  bg-sky-600 hover:bg-sky-500
                  shadow-lg shadow-sky-600/25
                  ring-1 ring-white/15
                  transition">
          <?= t('nav.book') ?>
        </a>
      </div>

      <!-- Burger -->
      <button
        @click="mobile=!mobile; open=null"
        class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-xl
               bg-white/10 hover:bg-white/15 border border-white/10"
        aria-controls="mobile-menu" :aria-expanded="mobile ? 'true' : 'false'">
        <svg x-show="!mobile" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        <svg x-show="mobile" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>

    <!-- Mobile -->
    <div id="mobile-menu" x-cloak x-show="mobile" x-transition class="md:hidden pb-4">
      <div class="mt-3 rounded-2xl bg-white/10 border border-white/10 backdrop-blur-md p-2">
        <ul class="space-y-1">
          <?php foreach ($nav as $item): ?>
            <?php if (empty($item['items'])): ?>
              <li>
                <a href="<?= htmlspecialchars($item['href']) ?>"
                   class="block rounded-xl px-3 py-2 font-semibold
                          <?= is_active($item['href'], $currentPath) ? 'bg-white/15 text-white' : 'text-white/90 hover:bg-white/10' ?>">
                  <?= htmlspecialchars($item['label']) ?>
                </a>
              </li>
            <?php else: ?>
              <li x-data="{dd:false}">
                <button @click="dd=!dd"
                        class="w-full rounded-xl px-3 py-2 flex items-center justify-between font-semibold
                               text-white/90 hover:bg-white/10">
                  <span><?= htmlspecialchars($item['label']) ?></span>
                  <svg class="h-4 w-4 transition" :class="dd ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
                </button>
                <ul x-show="dd" x-transition class="mt-1 ml-2 space-y-1">
                  <?php foreach ($item['items'] as $sub): ?>
                    <li>
                      <a href="<?= htmlspecialchars($sub['href']) ?>"
                         class="block rounded-lg px-3 py-2 text-white/85 hover:bg-white/10">
                        <?= htmlspecialchars($sub['label']) ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </li>
            <?php endif; ?>
          <?php endforeach; ?>

          <li class="flex items-center gap-2 px-3 pt-2 mt-2 border-t border-white/10">
            <span class="text-white/80 text-sm"><?= t('nav.language') ?>:</span>
            <a href="<?= htmlspecialchars(switch_lang_url('es')) ?>"
               class="rounded-lg bg-white/10 border border-white/15 px-2.5 py-1 text-xs font-semibold <?= $lang==='es' ? 'bg-white/20 text-white' : 'text-white/85' ?>">
              ES
            </a>
            <a href="<?= htmlspecialchars(switch_lang_url('en')) ?>"
               class="rounded-lg bg-white/10 border border-white/15 px-2.5 py-1 text-xs font-semibold <?= $lang==='en' ? 'bg-white/20 text-white' : 'text-white/85' ?>">
              EN
            </a>

            <a href="/#goToQuote"
               class="ml-auto rounded-xl bg-sky-600 px-4 py-2 text-sm font-extrabold text-white hover:bg-sky-500 transition shadow-lg shadow-sky-600/25">
              <?= t('nav.book') ?>
            </a>
          </li>
        </ul>
      </div>
    </div>

  </nav>
</header>

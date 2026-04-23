<?php
$nav = [
  ['label' => t('nav.home'), 'href' => '/'],

  ['label' => t('nav.about'), 'href' => '#', 'items' => [
    [
      'label' => t('nav.about.team'),
      'href'  => '/nosotros',
      'title' => t('title.about'),
    ],
  ]],

  ['label' => t('nav.services'), 'href' => '#', 'items' => [
    [
      'label' => t('nav.services.transfers'),
      'href'  => '/servicios/traslados',
      'title' => t('title.services'),
      'badge' => 'Popular',
    ],
    [
      'label' => t('nav.services.excursions'),
      'href'  => '/servicios/excursiones',
      'title' => t('title.excursions'),
    ],
    [
      'label' => t('nav.services.guided'),
      'href'  => '/servicios/visitas-guiadas',
      'title' => t('title.guided'),
    ],
  ]],

  ['label' => t('nav.fleet'), 'href' => '#', 'items' => [
    [
      'label' => t('nav.fleet.sedan'),
      'href'  => '/flota',
      'title' => t('title.fleet'),
    ],
  ]],
];

$currentPath = rtrim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/', '/');
if ($currentPath === '') $currentPath = '/';

function is_active(string $href, string $current): bool {
  if ($href === '#') return false;
  if ($href === '/') return $current === '/';
  return $current === rtrim($href, '/') || str_starts_with($current, rtrim($href, '/') . '/');
}

$lang = current_lang();
$bookHref = '/#origin';
$logoSrc = '/assets/logo.png';
?>

<style>[x-cloak]{display:none!important}</style>

<header
  x-data="{ mobile:false, open:null }"
  class="sticky top-0 z-50 border-b border-white/10 bg-[#0f172a]/95 shadow-[0_10px_30px_rgba(0,0,0,0.25)] backdrop-blur-md supports-[backdrop-filter]:bg-[#0f172a]/80">

  <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-white" role="navigation" aria-label="Main">
    <div class="flex h-16 items-center justify-between lg:h-[74px]">
      <a href="/" class="flex items-center gap-3" aria-label="<?= htmlspecialchars(t('brand')) ?>">
        <span class="flex h-11 w-11 items-center justify-center rounded-2xl border border-white/10 bg-white/10 p-2 shadow-lg shadow-sky-900/20 backdrop-blur-sm lg:h-12 lg:w-12">
          <img src="<?= htmlspecialchars($logoSrc) ?>" alt="<?= htmlspecialchars(t('brand')) ?>" class="h-full w-full object-contain" loading="eager" fetchpriority="high">
        </span>

        <span class="leading-tight">
          <span class="block text-sm font-extrabold uppercase tracking-[0.18em] text-white">Transfer Marbell</span>
          <span class="block text-[11px] font-medium uppercase tracking-[0.16em] text-sky-200/90">Private transfers · Costa del Sol</span>
        </span>
      </a>

      <ul class="hidden items-center gap-1 lg:flex lg:gap-2 text-[13px] font-semibold tracking-wide">
        <?php $i = 0; foreach ($nav as $item): $i++; $active = is_active($item['href'] ?? '#', $currentPath); ?>
          <li class="relative" @keydown.escape.window="open=null">
            <?php if (!empty($item['items'])): ?>
              <button
                @click="open === <?= $i ?> ? open = null : open = <?= $i ?>"
                :aria-expanded="open === <?= $i ?> ? 'true' : 'false'"
                class="inline-flex items-center gap-1 rounded-xl px-3 py-2 uppercase transition focus:outline-none focus-visible:ring-2 focus-visible:ring-white/60 <?= $active ? 'bg-white/15 text-white ring-1 ring-white/15' : 'text-white/90 hover:bg-white/10 hover:text-white' ?>">
                <?= htmlspecialchars($item['label']) ?>
                <svg class="h-4 w-4 opacity-80" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
              </button>

              <div
                x-cloak x-show="open === <?= $i ?>" x-transition
                @click.outside="open = null"
                class="absolute left-1/2 mt-3 w-[min(90vw,820px)] -translate-x-1/2 overflow-hidden rounded-2xl bg-white text-zinc-900 shadow-2xl ring-1 ring-black/10">

                <div class="border-b border-zinc-200 bg-zinc-50 px-5 py-3">
                  <div class="text-xs font-semibold uppercase tracking-wide text-zinc-500">
                    <?= htmlspecialchars($item['label']) ?>
                  </div>
                </div>

                <div class="grid grid-cols-1 gap-2 p-4 sm:grid-cols-2 lg:grid-cols-3">
                  <?php foreach ($item['items'] as $sub): ?>
                    <a href="<?= htmlspecialchars($sub['href']) ?>"
                       class="group flex items-start gap-3 rounded-xl p-3 ring-1 ring-transparent transition hover:bg-zinc-50 hover:ring-zinc-200 focus:bg-zinc-50 focus:outline-none">
                      <div class="mt-0.5 grid h-10 w-10 place-items-center rounded-xl bg-zinc-100">
                        <svg class="h-4 w-4 text-zinc-700" viewBox="0 0 24 24" fill="currentColor"><path d="M4 6h16v2H4zM4 11h16v2H4zM4 16h10v2H4z"/></svg>
                      </div>

                      <div class="min-w-0">
                        <div class="flex items-center gap-2">
                          <span class="truncate font-bold text-zinc-900"><?= htmlspecialchars($sub['label']) ?></span>
                          <?php if (!empty($sub['badge'])): ?>
                            <span class="rounded bg-sky-100 px-1.5 py-0.5 text-[10px] uppercase tracking-wide text-sky-700">
                              <?= htmlspecialchars($sub['badge']) ?>
                            </span>
                          <?php endif; ?>
                        </div>
                        <p class="line-clamp-2 text-xs text-zinc-600">
                          <?= htmlspecialchars($sub['title'] ?? '') ?: 'Ver detalles, tarifas y disponibilidad' ?>
                        </p>
                      </div>

                      <svg class="ml-auto h-4 w-4 text-zinc-400 opacity-0 transition group-hover:opacity-100" viewBox="0 0 24 24" fill="currentColor"><path d="M9 6l6 6-6 6"/></svg>
                    </a>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php else: ?>
              <a href="<?= htmlspecialchars($item['href']) ?>"
                 class="rounded-xl px-3 py-2 uppercase transition <?= $active ? 'bg-white/15 text-white ring-1 ring-white/15' : 'text-white/90 hover:bg-white/10 hover:text-white' ?>">
                <?= htmlspecialchars($item['label']) ?>
              </a>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>

      <div class="hidden items-center gap-3 lg:flex">
        <a href="/admin/login.php"
           class="inline-flex items-center rounded-xl border border-white/15 bg-white/5 px-3 py-2 text-sm font-semibold text-white/85 transition hover:bg-white/10 hover:text-white">
          <?= htmlspecialchars(t('nav.panel')) ?>
        </a>

        <div class="flex items-center gap-2">
          <span class="mr-1 text-sm text-white/70"><?= t('nav.language') ?>:</span>

          <a href="<?= htmlspecialchars(switch_lang_url('es')) ?>"
             class="rounded-lg border border-white/15 px-2.5 py-1 text-xs font-semibold <?= $lang === 'es' ? 'bg-white/20 text-white' : 'bg-white/10 text-white/85 hover:bg-white/15' ?>">
            ES
          </a>

          <a href="<?= htmlspecialchars(switch_lang_url('en')) ?>"
             class="rounded-lg border border-white/15 px-2.5 py-1 text-xs font-semibold <?= $lang === 'en' ? 'bg-white/20 text-white' : 'bg-white/10 text-white/85 hover:bg-white/15' ?>">
            EN
          </a>
        </div>

        <a href="<?= htmlspecialchars($bookHref) ?>"
           class="inline-flex items-center rounded-full bg-sky-500 px-5 py-2.5 text-sm font-extrabold text-white shadow-lg shadow-sky-600/25 ring-1 ring-white/15 transition hover:bg-sky-600">
          <?= t('nav.book') ?>
        </a>
      </div>

      <button
        @click="mobile = !mobile; open = null"
        class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-white/10 bg-white/10 hover:bg-white/15 lg:hidden"
        aria-controls="mobile-menu" :aria-expanded="mobile ? 'true' : 'false'">
        <svg x-show="!mobile" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        <svg x-show="mobile" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>

    <div id="mobile-menu" x-cloak x-show="mobile" x-transition class="pb-4 lg:hidden">
      <div class="mt-3 rounded-2xl border border-white/10 bg-white/10 p-2 backdrop-blur-md">
        <ul class="space-y-1">
          <?php foreach ($nav as $item): ?>
            <?php if (empty($item['items'])): ?>
              <li>
                <a href="<?= htmlspecialchars($item['href']) ?>"
                   class="block rounded-xl px-3 py-2 font-semibold <?= is_active($item['href'], $currentPath) ? 'bg-white/15 text-white' : 'text-white/90 hover:bg-white/10' ?>">
                  <?= htmlspecialchars($item['label']) ?>
                </a>
              </li>
            <?php else: ?>
              <li x-data="{ dd:false }">
                <button @click="dd = !dd"
                        class="flex w-full items-center justify-between rounded-xl px-3 py-2 font-semibold text-white/90 hover:bg-white/10">
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

          <li class="mt-2 border-t border-white/10 px-3 pt-3">
            <a href="/admin/login.php"
               class="block rounded-xl bg-white/5 px-3 py-2 font-semibold text-white/90 hover:bg-white/10">
              <?= htmlspecialchars(t('nav.panel')) ?>
            </a>
          </li>

          <li class="flex items-center gap-2 px-3 pt-2">
            <span class="text-sm text-white/80"><?= t('nav.language') ?>:</span>

            <a href="<?= htmlspecialchars(switch_lang_url('es')) ?>"
               class="rounded-lg border border-white/15 px-2.5 py-1 text-xs font-semibold <?= $lang === 'es' ? 'bg-white/20 text-white' : 'bg-white/10 text-white/85' ?>">
              ES
            </a>

            <a href="<?= htmlspecialchars(switch_lang_url('en')) ?>"
               class="rounded-lg border border-white/15 px-2.5 py-1 text-xs font-semibold <?= $lang === 'en' ? 'bg-white/20 text-white' : 'bg-white/10 text-white/85' ?>">
              EN
            </a>

            <a href="<?= htmlspecialchars($bookHref) ?>"
               class="ml-auto rounded-xl bg-sky-500 px-4 py-2 text-sm font-extrabold text-white shadow-lg shadow-sky-600/25 transition hover:bg-sky-600">
              <?= t('nav.book') ?>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

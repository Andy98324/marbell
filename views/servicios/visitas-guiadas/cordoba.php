<?php
// ===== DATOS (tal cual los tienes) =====
$prices_guided_only = [
  ['pax'=>2, 'eur'=>171],
  ['pax'=>3, 'eur'=>182],
  ['pax'=>4, 'eur'=>193],
  ['pax'=>5, 'eur'=>209],
  ['pax'=>6, 'eur'=>220],
  ['pax'=>7, 'eur'=>242],
  ['pax'=>'8+', 'eur'=>null],
];
$wa = 'https://wa.me/34951748494';
$tg = 'https://t.me/34692926919';
$imgs = [
  '/assets/images/guided/cordoba/mezquita-night.jpg',
  '/assets/images/guided/cordoba/jewish-quarter.jpg',
  '/assets/images/guided/cordoba/mezquita-interior.jpg',
];

// ===== Helpers mínimos =====
function money_eur(?int $n): string {
  return is_null($n) ? t('guided.common.consult') : '€ '.number_format($n, 0);
}
function msg_encode(string $s): string {
  return rawurlencode($s);
}
?>

<!-- HERO (Excursión Nerja) -->
<section class="relative overflow-hidden bg-[#0b1220] text-white rounded-3xl">
  <div class="absolute inset-0 opacity-25 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2
                bg-gradient-to-br from-sky-500/30 via-transparent to-transparent
                rounded-full blur-3xl"></div>
  </div>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-14 md:py-18">
    <div class="rounded-3xl border border-white/15 bg-white/10 backdrop-blur-md shadow-2xl overflow-hidden">
      <div class="absolute inset-0 pointer-events-none opacity-25
                  bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.20)_0%,rgba(255,255,255,0.00)_55%)]"></div>

      <div class="relative p-7 md:p-10">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">
          <?= t('guided.cordoba.h1') ?>
        </h1>
        <p class="mt-4 text-white/80 text-lg leading-relaxed max-w-3xl">
          <?= t('guided.cordoba.lead') ?>
        </p>
      </div>
    </div>
  </div>
</section>
<!-- INTRO + GALERÍA -->
<section class="py-16 bg-white">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <p class="text-zinc-700 text-lg leading-relaxed"><?= t('guided.cordoba.text') ?></p>

    <div class="mt-8 grid gap-6 md:grid-cols-3">
      <?php foreach ($imgs as $src): ?>
        <figure class="group rounded-2xl overflow-hidden ring-1 ring-black/10 shadow-xl">
          <img
            src="<?= htmlspecialchars($src) ?>"
            alt="Córdoba tour"
            loading="lazy"
            class="w-full h-52 object-cover transition duration-500 group-hover:scale-[1.03]">
        </figure>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- INCLUYE + PRECIOS + CON TRANSFER -->
<section class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-8 md:grid-cols-12">

    <!-- Incluye -->
    <article class="md:col-span-3 rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6">
      <h4 class="text-lg font-semibold mb-4 text-zinc-900"><?= t('guided.cordoba.includes.title') ?></h4>
      <ul class="text-sm text-zinc-700 space-y-3">
        <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-500"></span><?= t('guided.cordoba.includes.guide') ?></li>
        <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-500"></span><?= t('guided.cordoba.includes.water') ?></li>
        <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-500"></span><?= t('guided.cordoba.includes.flex') ?></li>
      </ul>
    </article>

    <!-- Precios (solo guía) -->
    <article class="md:col-span-5 rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6">
      <h4 class="text-lg font-semibold mb-1 text-zinc-900">
        <?= t('guided.common.guided_only') ?>
        <span class="text-zinc-500">(<?= t('guided.common.per_group') ?>)</span>
      </h4>
      <p class="text-xs text-zinc-500 mb-4"><?= t('guided.common.taxes_note') ?? '' ?></p>

      <div class="overflow-hidden rounded-xl ring-1 ring-black/5">
        <div class="max-h-[420px] overflow-auto">
          <table class="w-full text-sm">
            <thead class="bg-zinc-50 sticky top-0 z-10">
              <tr class="text-left text-zinc-600">
                <th class="py-2 px-3"><?= t('guided.common.pax') ?></th>
                <th class="py-2 px-3"><?= t('guided.common.price') ?></th>
                <th class="py-2 px-3"><?= t('guided.common.contact') ?></th>
              </tr>
            </thead>
            <tbody class="text-zinc-800">
              <?php foreach ($prices_guided_only as $i=>$row):
                $pax = (string)$row['pax'];
                $isConsult = is_null($row['eur']);
                $priceTxt = $isConsult ? t('guided.common.consult') : '€ ' .number_format($row['eur'],0);
                $plain = $isConsult ? '' : ' (€'.$row['eur'].')';
                $msg = "I want to book the Córdoba guided tour (no transfer) for {$pax} pax{$plain}";
              ?>
              <tr class="<?= $i % 2 ? 'bg-zinc-50' : 'bg-white' ?> border-t border-zinc-100">
                <td class="py-3 px-3 font-medium"><?= htmlspecialchars($pax) ?></td>
                <td class="py-3 px-3"><?= htmlspecialchars($priceTxt) ?></td>
                <td class="py-3 px-3">
                  <div class="flex items-center gap-2">
                    <a href="<?= $wa.'?text='.rawurlencode($msg) ?>" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-1 rounded-full bg-green-50 text-green-700 ring-1 ring-green-200 px-3 py-1 hover:bg-green-100">
                      <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 3.5A4.5 4.5 0 0015.5 8c0 .7.2 1.4.5 2l-6 6-3 1 1-3 6-6c.6.3 1.3.5 2 .5A4.5 4.5 0 0020 3.5z"/></svg>
                      WhatsApp
                    </a>
                    <a href="<?= $tg.'?text='.rawurlencode($msg) ?>" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-1 rounded-full bg-sky-50 text-sky-700 ring-1 ring-sky-200 px-3 py-1 hover:bg-sky-100">
                      <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21 3L3 11l6 2 2 6 10-16z"/></svg>
                      Telegram
                    </a>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </article>

    <!-- Con transfer -->
    <article class="md:col-span-4 rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6">
      <h4 class="text-lg font-semibold mb-2 text-zinc-900"><?= t('guided.common.with_transfer') ?></h4>
      <p class="text-sm text-zinc-700 mb-5">
        <?= t('guided.common.consult') ?> — Málaga / Costa del Sol pickup &amp; return. Sedans, vans or minibuses available.
      </p>
      <div class="flex flex-wrap gap-2">
        <a class="inline-flex items-center gap-1 rounded-xl bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700"
           target="_blank" rel="noopener"
           href="<?= $wa.'?text='.rawurlencode('I want a quote for the Córdoba guided tour with private transfer') ?>">WhatsApp</a>
        <a class="inline-flex items-center gap-1 rounded-xl bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700"
           target="_blank" rel="noopener"
           href="<?= $tg.'?text='.rawurlencode('I want a quote for the Córdoba guided tour with private transfer') ?>">Telegram</a>
      </div>

      <hr class="my-6 border-zinc-200">
      <p class="text-xs text-zinc-500"><?= t('guided.common.notes') ?></p>
    </article>

  </div>

  <!-- CTA final -->
  <div class="mt-10 text-center">
    <a href="<?= $wa.'?text='.rawurlencode("Hello! I'd like more info about the Córdoba guided tour.") ?>"
       target="_blank" rel="noopener"
       class="inline-flex items-center gap-2 rounded-xl bg-sky-600 px-6 py-3 text-white font-semibold hover:bg-sky-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500">
      <?= t('guided.cordoba.cta.info') ?>
      <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    </a>
  </div>
</section>

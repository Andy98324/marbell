<!-- HERO -->
<section class="relative overflow-hidden bg-[#0b1220] text-white">
  <div class="absolute inset-0 opacity-20 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>
  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 md:py-20">
    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight"><?= t('guided.malaga_city.h1') ?></h1>
    <p class="mt-3 text-white/80 text-lg leading-relaxed max-w-3xl"><?= t('guided.malaga_city.lead') ?></p>
  </div>
</section>

<!-- CONTENIDO -->
<section class="py-16 bg-white">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <p class="text-zinc-700 text-lg leading-relaxed mb-12 text-center max-w-3xl mx-auto">
      <?= t('guided.malaga_city.text') ?>
    </p>

    <!-- Galería -->
    <div class="grid gap-6 md:grid-cols-3">
      <?php
        $gallery = [
          ['/assets/images/guided/malaga/malaga_plaza.jpg','Plaza / Málaga'],
          ['/assets/images/guided/malaga/malaga_patios.jpg','Patios / Málaga'],
          ['/assets/images/guided/malaga/malaga_catedral.jpg','Cathedral / Málaga'],
        ];
        foreach ($gallery as [$src,$alt]): ?>
        <figure class="group overflow-hidden rounded-2xl ring-1 ring-black/10 shadow-xl">
          <img loading="lazy" src="<?= $src ?>" alt="<?= htmlspecialchars($alt) ?>"
               class="w-full h-56 object-cover transition duration-500 group-hover:scale-[1.03]">
        </figure>
      <?php endforeach; ?>
    </div>

    <!-- Tablas de precios -->
    <div class="mt-14 grid gap-10 lg:grid-cols-2">

      <!-- SOLO GUÍA -->
      <div class="rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6">
        <h3 class="text-xl font-semibold text-zinc-900"><?= t('guided.common.guided_only') ?></h3>
        <p class="text-sm text-zinc-600 mb-4"><?= t('guided.common.per_group') ?></p>

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
                <?php
                $rows = [
                  ['2','154'],
                  ['3','165'],
                  ['4','176'],
                  ['5','187'],
                  ['6','198'],
                  ['7','231'],
                ];
                foreach ($rows as $i => [$pax,$price]):
                  $msg = "I want to book a guided tour in Málaga for {$pax} people for {$price}€";
                ?>
                <tr class="<?= $i % 2 ? 'bg-zinc-50' : 'bg-white' ?> border-t border-zinc-100">
                  <td class="py-3 px-3"><?= htmlspecialchars($pax) ?> pax</td>
                  <td class="py-3 px-3">€ <?= htmlspecialchars($price) ?> <span aria-hidden="true">✅</span></td>
                  <td class="py-3 px-3">
                    <div class="flex flex-wrap gap-2">
                      <a class="inline-flex items-center gap-1 rounded-full bg-green-50 text-green-700 ring-1 ring-green-200 px-3 py-1 hover:bg-green-100"
                         target="_blank" rel="noopener"
                         href="https://wa.me/34692926919?text=<?= rawurlencode($msg) ?>">WhatsApp</a>
                      <a class="inline-flex items-center gap-1 rounded-full bg-sky-50 text-sky-700 ring-1 ring-sky-200 px-3 py-1 hover:bg-sky-100"
                         target="_blank" rel="noopener"
                         href="https://t.me/34692926919?text=<?= rawurlencode($msg) ?>">Telegram</a>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>

                <!-- 8+ -->
                <?php $msg8 = "I want to consult a reservation for 8 or more people for the Málaga tour"; ?>
                <tr class="bg-white border-t border-zinc-100">
                  <td class="py-3 px-3">8+</td>
                  <td class="py-3 px-3"><?= t('guided.common.consult') ?></td>
                  <td class="py-3 px-3">
                    <div class="flex flex-wrap gap-2">
                      <a class="inline-flex items-center gap-1 rounded-full bg-green-50 text-green-700 ring-1 ring-green-200 px-3 py-1 hover:bg-green-100"
                         target="_blank" rel="noopener"
                         href="https://wa.me/34692926919?text=<?= rawurlencode($msg8) ?>">WhatsApp</a>
                      <a class="inline-flex items-center gap-1 rounded-full bg-sky-50 text-sky-700 ring-1 ring-sky-200 px-3 py-1 hover:bg-sky-100"
                         target="_blank" rel="noopener"
                         href="https://t.me/34692926919?text=<?= rawurlencode($msg8) ?>">Telegram</a>
                    </div>
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- GUÍA + TRASLADO -->
      <div class="rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6">
        <h3 class="text-xl font-semibold text-zinc-900"><?= t('guided.common.with_transfer') ?></h3>
        <p class="text-sm text-zinc-600 mb-4"><?= t('guided.common.per_group') ?></p>

        <div class="overflow-hidden rounded-xl ring-1 ring-black/5">
          <table class="w-full text-sm">
            <thead class="bg-zinc-50">
              <tr class="text-left text-zinc-600">
                <th class="py-2 px-3"><?= t('guided.common.pax') ?></th>
                <th class="py-2 px-3"><?= t('guided.common.contact') ?></th>
              </tr>
            </thead>
            <tbody class="text-zinc-800 divide-y divide-zinc-100">
              <?php foreach (['2','3','4','5','6','7','8+'] as $pax):
                $msgT = "I want information for a guided Málaga tour with transfer for {$pax} passengers";
              ?>
              <tr>
                <td class="py-3 px-3"><?= htmlspecialchars($pax) ?> pax</td>
                <td class="py-3 px-3">
                  <div class="flex flex-wrap gap-2">
                    <a class="inline-flex items-center gap-1 rounded-full bg-green-50 text-green-700 ring-1 ring-green-200 px-3 py-1 hover:bg-green-100"
                       target="_blank" rel="noopener"
                       href="https://wa.me/34692926919?text=<?= rawurlencode($msgT) ?>">WhatsApp</a>
                    <a class="inline-flex items-center gap-1 rounded-full bg-sky-50 text-sky-700 ring-1 ring-sky-200 px-3 py-1 hover:bg-sky-100"
                       target="_blank" rel="noopener"
                       href="https://t.me/34692926919?text=<?= rawurlencode($msgT) ?>">Telegram</a>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Notas -->
    <div class="mt-12 text-sm text-zinc-600 text-center space-y-2">
      <p>ℹ️ <?= t('guided.malaga_city.notes.extend') ?></p>
      <p><?= t('guided.malaga_city.notes.access') ?></p>
      <p><?= t('guided.common.notes') ?></p>
    </div>

    <!-- CTA -->
    <div class="mt-10 text-center">
      <a href="https://wa.me/34692926919" target="_blank" rel="noopener"
         class="relative inline-flex items-center justify-center overflow-hidden rounded-xl bg-sky-600 px-8 py-3 text-lg font-semibold text-white shadow-lg transition hover:bg-sky-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500">
        <span class="relative z-10"><?= t('guided.malaga_city.cta.info') ?></span>
        <span class="absolute inset-0 bg-gradient-to-r from-sky-400 via-sky-600 to-sky-400 opacity-0 group-hover:opacity-100 transition-opacity"></span>
      </a>
    </div>

  </div>
</section>

<!-- JSON-LD -->
<script type="application/ld+json">
<?= json_encode([
  '@context'=>'https://schema.org',
  '@type'=>'TouristTrip',
  'name'=> t('guided.malaga_city.title_short'),
  'description'=> strip_tags(t('guided.malaga_city.lead')),
  'provider'=>[
    '@type'=>'TravelAgency',
    'name'=>'Transfer Marbell',
    'url'=>'https://www.transfermarbell.com'
  ],
  'offers'=>[
    '@type'=>'Offer',
    'priceCurrency'=>'EUR',
    'availability'=>'https://schema.org/InStock',
    'url'=>'https://www.transfermarbell.com/servicios/visitas-guiadas/malaga'
  ],
  'image'=>[
    'https://www.transfermarbell.com/assets/images/guided/malaga/malaga_plaza.jpg',
    'https://www.transfermarbell.com/assets/images/guided/malaga/malaga_patios.jpg',
    'https://www.transfermarbell.com/assets/images/guided/malaga/malaga_catedral.jpg'
  ]
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?>
</script>



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
          <?= t('excursions.granada.h1') ?>
        </h1>
        <p class="mt-4 text-white/80 text-lg leading-relaxed max-w-3xl">
          <?= t('excursions.granada.lead') ?>
        </p>
      </div>
    </div>
  </div>
</section>

<!-- INTRO -->
<section class="py-16 bg-white">
  <div class="mx-auto max-w-3xl px-4 text-center">
    <p class="text-zinc-700 text-lg leading-relaxed"><?= t('excursions.granada.text') ?></p>
  </div>
</section>

<!-- LUGARES DESTACADOS -->
<section class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-12 md:grid-cols-2">

    <!-- Granada ciudad -->
    <div>
      <div class="rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6">
        <h2 class="text-2xl font-bold text-center mb-6 text-zinc-900"><?= t('excursions.granada.granada.title') ?></h2>
        <div class="grid grid-cols-2 gap-5">
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/granada/alhambra.jpg" alt="Alhambra (exteriores)" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Alhambra (exteriores)</figcaption>
          </figure>
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/granada/generalife.jpg" alt="Generalife (exteriores)" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Generalife (exteriores)</figcaption>
          </figure>
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/granada/catedral.jpg" alt="Catedral y Capilla Real" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Catedral y Capilla Real</figcaption>
          </figure>
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/granada/paseo-tristes.jpg" alt="Paseo de los Tristes" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Paseo de los Tristes</figcaption>
          </figure>
        </div>

        <div class="rounded-2xl bg-zinc-50 ring-1 ring-black/10 shadow-sm p-6 mt-8">
          <h3 class="text-xl font-semibold mb-3 text-center text-zinc-900"><?= t('excursions.granada.where_eat') ?></h3>
          <ul class="space-y-2 text-center">
            <li><a class="text-sky-700 hover:underline" target="_blank" rel="noopener" href="https://www.bodegascastaneda.com/">Bodegas Castañeda</a></li>
            <li><a class="text-sky-700 hover:underline" target="_blank" rel="noopener" href="https://www.miradordemorayma.es/">Mirador de Morayma</a></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Albaicín & Sacromonte -->
    <div>
      <div class="rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6">
        <h2 class="text-2xl font-bold text-center mb-6 text-zinc-900">Albaicín &amp; Sacromonte</h2>
        <div class="grid grid-cols-2 gap-5">
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/granada/mirador-san-nicolas.jpg" alt="Mirador de San Nicolás" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Mirador de San Nicolás</figcaption>
          </figure>
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/granada/albaicin-calles.jpg" alt="Calles del Albaicín" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Calles del Albaicín</figcaption>
          </figure>
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/granada/sacromonte.jpg" alt="Sacromonte" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Sacromonte</figcaption>
          </figure>
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/granada/carmen-vistas.jpg" alt="Cármenes con vistas" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Cármenes con vistas</figcaption>
          </figure>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- CTA + INCLUYE -->
<section class="py-16 bg-zinc-50">
  <div class="mx-auto max-w-3xl px-4 text-center">
    <a href="https://wa.me/34951748494" target="_blank" rel="noopener"
       class="relative inline-flex items-center justify-center overflow-hidden rounded-xl bg-sky-600 px-8 py-3 text-lg font-semibold text-white shadow-lg transition hover:bg-sky-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500">
      <span class="relative z-10"><?= t('excursions.cta.whatsapp') ?></span>
    </a>

    <div class="mt-10 mx-auto max-w-md text-left">
      <div class="rounded-2xl bg-white ring-1 ring-black/10 shadow-md p-6">
        <h3 class="text-lg font-semibold text-zinc-900 mb-3"><?= t('excursions.h1') ?? 'Incluye:' ?></h3>
        <ul class="text-zinc-700 text-sm space-y-2">
          <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span><?= t('excursions.includes.map') ?></li>
          <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span><?= t('excursions.includes.audio') ?></li>
          <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span><?= t('excursions.includes.transfer') ?></li>
          <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span><?= t('excursions.includes.assistance') ?></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- JSON-LD (el $schema que ya generas) -->
<script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) ?></script>

<!-- HERO -->
<section class="relative overflow-hidden bg-[#0b1220] text-white">
  <div class="absolute inset-0 opacity-20 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>
  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 md:py-20">
    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight"><?= t('excursions.granada.h1') ?></h1>
    <p class="mt-3 text-white/80 text-lg leading-relaxed max-w-3xl"><?= t('excursions.granada.lead') ?></p>
  </div>
</section>

<!-- HERO IMAGE -->
<section class="relative">
  <div class="relative">
    <img src="/assets/images/excursiones/granada/alhambra-panorama.jpg" alt="Granada - Alhambra" class="w-full h-[420px] md:h-[520px] object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-black/10 to-transparent"></div>
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

<?php include __DIR__ . '/_cta_includes.php'; ?>

<!-- JSON-LD (el $schema que ya generas) -->
<script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) ?></script>

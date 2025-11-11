<!-- HERO -->
<section class="relative overflow-hidden bg-[#0b1220] text-white">
  <div class="absolute inset-0 opacity-20 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>
  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 md:py-20">
    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight"><?= t('excursions.cadiz.h1') ?></h1>
    <p class="mt-3 text-white/80 text-lg leading-relaxed max-w-3xl"><?= t('excursions.cadiz.lead') ?></p>
  </div>
</section>

<!-- HERO IMAGE -->
<section class="relative">
  <div class="relative">
    <img src="/assets/images/excursiones/cadiz/catedral-playa.jpg" alt="Cádiz - Catedral y playa" class="w-full h-[420px] md:h-[520px] object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-black/10 to-transparent"></div>
  </div>
</section>

<!-- CONTENIDO -->
<section class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-12 md:grid-cols-2">

    <!-- Qué ver -->
    <div>
      <div class="rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6">
        <h2 class="text-2xl font-bold text-center mb-6 text-zinc-900"><?= t('excursions.cadiz.see') ?></h2>
        <div class="grid grid-cols-2 gap-5">
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/cadiz/catedral.jpg" alt="Catedral de Cádiz" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Catedral</figcaption>
          </figure>
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/cadiz/playa-caleta.jpg" alt="Playa de La Caleta" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">La Caleta</figcaption>
          </figure>
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/cadiz/torre-tavira.jpg" alt="Torre Tavira" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Torre Tavira</figcaption>
          </figure>
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/cadiz/castillo-san-sebastian.jpg" alt="Castillo de San Sebastián" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Castillo de San Sebastián</figcaption>
          </figure>
        </div>
      </div>
    </div>

    <!-- Dónde comer -->
    <div>
      <div class="rounded-2xl bg-zinc-50 ring-1 ring-black/10 shadow-sm p-6">
        <h2 class="text-2xl font-bold text-center mb-6 text-zinc-900"><?= t('excursions.cadiz.eat') ?></h2>
        <ul class="space-y-2 text-center">
          <li><a class="text-sky-700 hover:underline" target="_blank" rel="noopener" href="https://www.freiduriolasflores.com/">Freiduría Las Flores</a></li>
          <li><a class="text-sky-700 hover:underline" target="_blank" rel="noopener" href="https://www.casabalbino.es/">Casa Balbino (Sanlúcar)</a></li>
        </ul>
      </div>
    </div>

  </div>
</section>

<?php include __DIR__ . '/_cta_includes.php'; ?>

<!-- JSON-LD (tu $schema existente) -->
<script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) ?></script>

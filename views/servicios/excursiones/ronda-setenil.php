
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
          <?= t('excursions.ronda.h1') ?>
        </h1>
        <p class="mt-4 text-white/80 text-lg leading-relaxed max-w-3xl">
          <?= t('excursions.ronda.lead') ?>
        </p>
      </div>
    </div>
  </div>
</section>


<!-- HERO IMAGE -->
<section class="relative">
  <div class="relative">
    
    <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-black/10 to-transparent"></div>
  </div>
</section>

<!-- INTRO -->
<section class="py-16 bg-white">
  <div class="mx-auto max-w-3xl px-4 text-center">
    <p class="text-zinc-700 text-lg leading-relaxed"><?= t('excursions.ronda.text') ?></p>
  </div>
</section>

<!-- LUGARES DESTACADOS -->
<section class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-12 md:grid-cols-2">

    <!-- Ronda -->
    <div>
      <div class="rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6">
        <h2 class="text-2xl font-bold text-center mb-6 text-zinc-900"><?= t('excursions.ronda.ronda.title') ?></h2>
        <div class="grid grid-cols-2 gap-5">
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/ronda/puente-nuevo.jpg" alt="Puente Nuevo" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Puente Nuevo</figcaption>
          </figure>
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/ronda/plaza-de-toros.jpg" alt="Plaza de Toros" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Plaza de Toros</figcaption>
          </figure>
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/ronda/ciudad-vieja.jpg" alt="Ciudad Vieja" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Ciudad Vieja</figcaption>
          </figure>
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/ronda/banos-arabes.jpg" alt="Baños Árabes" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Baños Árabes</figcaption>
          </figure>
        </div>
      </div>

      <div class="rounded-2xl bg-zinc-50 ring-1 ring-black/10 shadow-sm p-6 mt-8">
        <h3 class="text-xl font-semibold mb-3 text-center text-zinc-900"><?= t('excursions.ronda.where_eat_ronda') ?></h3>
        <ul class="space-y-2 text-center">
          <li><a class="text-sky-700 hover:underline" target="_blank" rel="noopener" href="https://www.carmela.es/">Restaurante Casa Carmen</a></li>
          <li><a class="text-sky-700 hover:underline" target="_blank" rel="noopener" href="https://www.restaurantetragata.com/">Tragatá</a></li>
        </ul>
      </div>
    </div>

    <!-- Setenil -->
    <div>
      <div class="rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6">
        <h2 class="text-2xl font-bold text-center mb-6 text-zinc-900"><?= t('excursions.ronda.setenil.title') ?></h2>
        <div class="grid grid-cols-2 gap-5">
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/setenil/cuevas-del-sol.jpg" alt="Cuevas del Sol" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Cuevas del Sol</figcaption>
          </figure>
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/setenil/cuevas-de-la-sombra.jpg" alt="Cuevas de la Sombra" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Cuevas de la Sombra</figcaption>
          </figure>
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/setenil/castillo.jpg" alt="Castillo" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Castillo</figcaption>
          </figure>
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/setenil/miradores.jpg" alt="Miradores" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Miradores</figcaption>
          </figure>
        </div>
      </div>

      <div class="rounded-2xl bg-zinc-50 ring-1 ring-black/10 shadow-sm p-6 mt-8">
        <h3 class="text-xl font-semibold mb-3 text-center text-zinc-900"><?= t('excursions.ronda.where_eat_setenil') ?></h3>
        <ul class="space-y-2 text-center">
          <li><a class="text-sky-700 hover:underline" target="_blank" rel="noopener" href="https://www.tripadvisor.es/Restaurant_Review-g677776-d1196882-Reviews-Bar_Francisco-Setenil_de_las_Bodegas_Province_of_Cadiz_Andalucia.html">Bar Francisco</a></li>
          <li><a class="text-sky-700 hover:underline" target="_blank" rel="noopener" href="https://www.tripadvisor.es/Restaurant_Review-g677776-d8707316-Reviews-La_Cueva_del_Abuelo-Setenil_de_las_Bodegas_Province_of_Cadiz_Andalucia.html">La Cueva del Abuelo</a></li>
        </ul>
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

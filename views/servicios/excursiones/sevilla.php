<?php
// helper de imagen por si el archivo está como "trianna.jpg"
function fix_sevilla_img($src){
  return str_replace('/trianna.jpg', '/triana.jpg', $src);
}
?>

<!-- HERO -->
<section class="relative overflow-hidden bg-[#0b1220] text-white">
  <div class="absolute inset-0 opacity-20 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-sky-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>
  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 md:py-20">
    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight"><?= t('excursions.sevilla.h1') ?></h1>
    <p class="mt-3 text-white/80 text-lg leading-relaxed max-w-3xl"><?= t('excursions.sevilla.lead') ?></p>
  </div>
</section>

<!-- CONTENIDO -->
<section class="py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-12 md:grid-cols-2">

    <!-- Qué ver -->
    <div>
      <div class="rounded-2xl bg-white ring-1 ring-black/10 shadow-xl p-6">
        <h2 class="text-2xl font-bold text-center mb-6 text-zinc-900"><?= t('excursions.sevilla.see') ?></h2>
        <div class="grid grid-cols-2 gap-5">
          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/sevilla/catedral-giralda.jpg" alt="Catedral y Giralda (exteriores)" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Catedral y Giralda (exteriores)</figcaption>
          </figure>

          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/sevilla/alcazar.jpg" alt="Real Alcázar (exteriores)" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Real Alcázar (exteriores)</figcaption>
          </figure>

          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="<?= fix_sevilla_img('/assets/images/excursiones/sevilla/trianna.jpg') ?>" alt="Barrio de Triana" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Triana</figcaption>
          </figure>

          <figure class="rounded-xl overflow-hidden ring-1 ring-black/10 shadow-sm">
            <img src="/assets/images/excursiones/sevilla/metropol-parasol.jpg" alt="Setas de Sevilla" class="w-full h-44 object-cover" loading="lazy">
            <figcaption class="text-center py-2 text-sm text-zinc-700">Setas de Sevilla</figcaption>
          </figure>
        </div>
      </div>
    </div>

    <!-- Dónde comer -->
    <div>
      <div class="rounded-2xl bg-zinc-50 ring-1 ring-black/10 shadow-sm p-6">
        <h2 class="text-2xl font-bold text-center mb-6 text-zinc-900"><?= t('excursions.sevilla.eat') ?></h2>
        <ul class="space-y-2 text-center">
          <li><a class="text-sky-700 hover:underline" target="_blank" rel="noopener" href="https://www.elrinconcillo.es/">El Rinconcillo</a></li>
          <li><a class="text-sky-700 hover:underline" target="_blank" rel="noopener" href="https://www.eslavasevilla.com/">Eslava</a></li>
        </ul>
      </div>
    </div>

  </div>
</section>

<?php include __DIR__ . '/_cta_includes.php'; ?>

<!-- JSON-LD (lo imprimes como ya lo tienes) -->
<script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) ?></script>

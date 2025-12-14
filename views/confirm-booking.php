<?php
$ref_out = $ref_out ?? null;
$ref_ret = $ref_ret ?? null;
// $email   = $email   ?? ''; // ya no lo necesitamos aquí si no enviamos email
?>

<section class="relative overflow-hidden bg-[#0b1220] text-white rounded-3xl">
  <div class="absolute inset-0 opacity-25 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2
                bg-gradient-to-br from-emerald-500/30 via-transparent to-transparent
                rounded-full blur-3xl"></div>
  </div>

  <div class="relative mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-16 md:py-20 text-center">
    <div class="rounded-3xl border border-white/15 bg-white/10 backdrop-blur-md shadow-2xl overflow-hidden">
      <div class="absolute inset-0 pointer-events-none opacity-25
                  bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.20)_0%,rgba(255,255,255,0.00)_55%)]"></div>

      <div class="relative p-7 md:p-10">
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-4">
          <?= function_exists('t') ? t('confirm.title') : 'Reserva confirmada' ?>
        </h1>

        <p class="text-sm md:text-base text-white/80 mb-3">
          <?= function_exists('t') ? t('confirm.subtitle') : 'Hemos recibido tu solicitud de traslado.' ?>
        </p>

        <p class="text-xs md:text-sm text-white/70 mb-5">
          <?= function_exists('t') ? t('confirm.voucher_ready') : 'Tu voucher está listo para descargar.' ?>
        </p>

        <!-- Referencias -->
        <div class="mt-2 inline-flex flex-col items-center rounded-2xl bg-white/5 border border-white/10 px-6 py-4 text-sm">
          <?php if ($ref_out): ?>
            <p class="text-white mb-1">
              <strong><?= function_exists('t') ? t('confirm.ref_out') : 'Referencia de ida' ?>:</strong>
              <span class="ml-1"><?= htmlspecialchars($ref_out) ?></span>
            </p>
          <?php endif; ?>
          <?php if ($ref_ret): ?>
            <p class="text-white">
              <strong><?= function_exists('t') ? t('confirm.ref_ret') : 'Referencia de vuelta' ?>:</strong>
              <span class="ml-1"><?= htmlspecialchars($ref_ret) ?></span>
            </p>
          <?php endif; ?>
        </div>

        <!-- DESCARGAS -->
        <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center">
          <?php if ($ref_out): ?>
            <a
              href="/download-voucher.php?ref=<?= urlencode($ref_out) ?>"
              class="inline-flex items-center justify-center rounded-xl bg-white/90 hover:bg-white
                     text-zinc-900 font-semibold px-6 py-3 shadow hover:-translate-y-0.5 transition text-sm"
            >
              <?= function_exists('t') ? t('confirm.download_out') : 'Descargar voucher (ida)' ?>
            </a>
          <?php endif; ?>

          <?php if ($ref_ret): ?>
            <a
              href="/download-voucher.php?ref=<?= urlencode($ref_ret) ?>"
              class="inline-flex items-center justify-center rounded-xl bg-white/90 hover:bg-white
                     text-zinc-900 font-semibold px-6 py-3 shadow hover:-translate-y-0.5 transition text-sm"
            >
              <?= function_exists('t') ? t('confirm.download_ret') : 'Descargar voucher (vuelta)' ?>
            </a>
          <?php endif; ?>
        </div>

        <p class="mt-5 text-xs text-white/60">
          <?= function_exists('t') ? t('confirm.help_text') : 'Si detectas algún dato incorrecto, por favor contacta con nosotros lo antes posible indicando tu referencia.' ?>
        </p>

        <!-- CTA -->
        <a href="/"
           class="mt-7 inline-flex items-center justify-center rounded-xl
                  bg-emerald-500 hover:bg-emerald-400
                  text-zinc-900 font-semibold px-6 py-3
                  shadow-lg shadow-emerald-500/20
                  hover:-translate-y-0.5 transition text-sm">
          <?= function_exists('t') ? t('confirm.back_home') : 'Volver al inicio' ?>
        </a>
      </div>
    </div>
  </div>
</section>

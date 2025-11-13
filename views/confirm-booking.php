<?php
$ref_out = $ref_out ?? null;
$ref_ret = $ref_ret ?? null;
$email   = $email   ?? '';
?>

<section class="relative overflow-hidden bg-[#0b1220] text-white">
  <div class="absolute inset-0 opacity-20 pointer-events-none">
    <div class="absolute -top-32 left-1/2 w-[1200px] h-[1200px] -translate-x-1/2 bg-gradient-to-br from-emerald-500/30 via-transparent to-transparent rounded-full blur-3xl"></div>
  </div>

  <div class="relative mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-16 md:py-20 text-center">
    <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-4">
      <?= function_exists('t') ? t('confirm.title') : 'Reserva confirmada' ?>
    </h1>
    <p class="text-sm md:text-base text-white/80 mb-3">
      <?= function_exists('t') ? t('confirm.subtitle') : 'Hemos recibido tu solicitud de traslado.' ?>
    </p>
    <?php if ($email): ?>
      <p class="text-xs md:text-sm text-white/70 mb-4">
        <?= function_exists('t') ? t('confirm.email_info') : 'Te hemos enviado un correo con todos los detalles de tu reserva y tu voucher adjunto.' ?>
        <br>
        <strong><?= htmlspecialchars($email) ?></strong>
      </p>
    <?php endif; ?>

    <div class="mt-4 inline-flex flex-col items-center bg-white/10 border border-white/20 rounded-2xl px-6 py-4 text-sm">
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

    <p class="mt-5 text-xs text-white/60">
      <?= function_exists('t') ? t('confirm.help_text') : 'Si detectas algún dato incorrecto, por favor contacta con nosotros lo antes posible indicando tu referencia.' ?>
    </p>

    <a href="/"
       class="mt-6 inline-flex items-center justify-center rounded-xl bg-white text-zinc-900 font-semibold px-6 py-3 shadow hover:-translate-y-0.5 transition text-sm">
      <?= function_exists('t') ? t('confirm.back_home') : 'Volver al inicio' ?>
    </a>
  </div>
</section>

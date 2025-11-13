<footer class="bg-[#1f2a44] text-white mt-16 border-t border-white/10">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 grid gap-10 md:grid-cols-4">

    <!-- Columna 1: Marca + redes + pagos -->
    <div>
      <a href="/" class="flex items-center gap-3 mb-4">
        <img src="/assets/logo.png" alt="<?= t('brand') ?>" class="h-10 w-auto object-contain" loading="lazy">
        <span class="sr-only"><?= t('brand') ?></span>
      </a>
      <p class="text-sm text-white/80 leading-relaxed">
        <?= t('brand') ?> — <?= t('footer.services.long') ?>
      </p>

      <div class="flex gap-4 mt-4" aria-label="<?= t('footer.follow_us') ?>">
        <a href="https://www.facebook.com/TransferMarbell/" target="_blank" rel="noopener" class="hover:text-sky-400" aria-label="Facebook">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12.07C22 6.48 17.52 2 11.93 2S2 6.48 2 12.07c0 5.02 3.66 9.18 8.44 9.93v-7.03H8.1v-2.9h2.34V9.41c0-2.33 1.38-3.62 3.49-3.62.99 0 2.03.18 2.03.18v2.24h-1.15c-1.14 0-1.49.71-1.49 1.44v1.73h2.54l-.41 2.9h-2.13v7.03C18.34 21.25 22 17.09 22 12.07z"/></svg>
        </a>
        <a href="https://www.instagram.com/transfermarbell/" target="_blank" rel="noopener" class="hover:text-sky-400" aria-label="Instagram">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 1.5A4.25 4.25 0 003.5 7.75v8.5A4.25 4.25 0 007.75 20.5h8.5a4.25 4.25 0 004.25-4.25v-8.5A4.25 4.25 0 0016.25 3.5h-8.5zM12 7a5 5 0 110 10 5 5 0 010-10zm0 1.5a3.5 3.5 0 100 7 3.5 3.5 0 000-7zm4.75-.88a.88.88 0 110 1.76.88.88 0 010-1.76z"/></svg>
        </a>
        <a href="https://twitter.com/TransferMarbell" target="_blank" rel="noopener" class="hover:text-sky-400" aria-label="X">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 2L14.9 10.34 22.5 22h-4.9l-4.7-7.7L8.1 22H2l7.56-9.28L2.4 2H7.3l4.17 6.84L15.3 2H22z"/></svg>
        </a>
      </div>

      <div class="flex gap-3 mt-6 items-center" aria-label="<?= t('footer.payments') ?>">
        <img src="/assets/images/payments/visa.png" class="h-6 w-auto" alt="Visa" loading="lazy">
        <img src="/assets/images/payments/master-card.png" class="h-6 w-auto" alt="MasterCard" loading="lazy">
        <img src="/assets/images/payments/american-ex.png" class="h-6 w-auto" alt="American Express" loading="lazy">
        <img src="/assets/images/payments/paypal.png" class="h-6 w-auto" alt="PayPal" loading="lazy">
        <img src="/assets/images/payments/discover.png" class="h-6 w-auto" alt="Discover" loading="lazy">
      </div>
    </div>

    <!-- Columna 2: Sobre nosotros -->
    <div>
      <h3 class="text-base font-semibold mb-3"><?= t('footer.about') ?></h3>
      <ul class="space-y-2 text-sm text-white/80">
        <li><a href="/nosotros" class="hover:text-white"><?= t('footer.about.us') ?></a></li>
        <li><a href="/nosotros" class="hover:text-white"><?= t('footer.about.partner') ?></a></li>
        <li><a href="https://hub.transfermarbell.com" class="hover:text-white" target="_blank" rel="noopener">
            <?= t('footer.services.transferhub') ?></a></li>
      </ul>
    </div>

    <!-- Columna 3: Servicios (añado TransferHub) -->
    <div>
      <h3 class="text-base font-semibold mb-3"><?= t('footer.services') ?></h3>
      <ul class="space-y-2 text-sm text-white/80">
          <li><a href="/#goToQuote" class="hover:text-white"><?= t('footer.cta.book_now') ?></a></li>
          <li><a href="/servicios/traslados" class="hover:text-white"><?= t('footer.links.transfers') ?></a></li>
          <li><a href="/servicios/excursiones" class="hover:text-white"><?= t('footer.links.excursions') ?></a></li>
          <li><a href="/servicios/visitas-guiadas" class="hover:text-white"><?= t('footer.links.guided_tours') ?></a></li>
          <li><a href="/flota" class="hover:text-white"><?= t('footer.links.our_fleet') ?></a></li>
          <li><a href="/#reviews" class="hover:text-white"><?= t('footer.links.reviews') ?></a></li>
          <li><a href="/nosotros" class="hover:text-white"><?= t('footer.links.partner') ?></a></li>
      </ul>
    </div>

    <!-- Columna 4: Newsletter + idioma + contacto -->
    <div>
      <h3 class="text-base font-semibold mb-3"><?= t('footer.newsletter') ?></h3>
      <form class="mt-2 flex gap-2" action="/newsletter/subscribe" method="post" aria-label="<?= t('footer.newsletter') ?>">
        <input type="email" name="email" placeholder="<?= t('footer.subscribe.placeholder') ?>" class="w-full rounded-lg px-3 py-2 text-sm text-zinc-900 placeholder-zinc-500" required>
        <button type="submit" class="bg-sky-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-sky-700">
          <?= t('footer.subscribe.button') ?>
        </button>
      </form>
      <p class="mt-2 text-[12px] text-white/60"><?= t('footer.subscribe.disclaimer') ?></p>

      <div class="mt-6">
        <span class="text-sm text-white/70 mr-2"><?= t('nav.language') ?>:</span>
        <a href="<?= switch_lang_url('es') ?>" class="rounded px-2 py-1 text-xs border border-white/20 <?= current_lang()=='es'?'bg-sky-600 text-white':'bg-white/10' ?>">ES</a>
        <a href="<?= switch_lang_url('en') ?>" class="rounded px-2 py-1 text-xs border border-white/20 <?= current_lang()=='en'?'bg-sky-600 text-white':'bg-white/10' ?>">EN</a>
      </div>

      <div class="mt-6 space-y-2 text-sm text-white/80">
        <a href="https://wa.me/34692926919" target="_blank" rel="noopener" class="hover:text-white flex items-center gap-2">
          <img src="/assets/images/wht.png" alt="WhatsApp" class="h-5 w-5">(+34) 692 926 919
        </a>
        <a href="tel:+34692926919" class="hover:text-white flex items-center gap-2">
          <img src="/assets/images/tlf.png" alt="Phone" class="h-5 w-5"> (+34) 692 926 919
        </a>
        <a href="mailto:info@transfermarbell.com" class="hover:text-white">info@transfermarbell.com</a>
        <div class="text-white/60"><?= t('footer.247') ?></div>
      </div>
    </div>
  </div>
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 border-t border-white/10 pt-4 text-sm text-white/70">
      
      <ul class="flex flex-wrap gap-x-6 gap-y-2">
        <li><a href="/Privacy-policy.php" class="hover:text-white"><?= t('footer.legal.privacy') ?></a></li>
        <li><a href="/Terms&conditions.php" class="hover:text-white"><?= t('footer.legal.terms') ?></a></li>
        <li><a href="/Cookies-Policy.php" class="hover:text-white"><?= t('footer.legal.cookies') ?></a></li>
        <li><a href="/Security-policy.php" class="hover:text-white"><?= t('footer.legal.security') ?></a></li>
        <li><a href="/Payment-policy.php" class="hover:text-white"><?= t('footer.legal.payment') ?></a></li>
        <li><a href="/Anti-fraud-policy.php" class="hover:text-white"><?= t('footer.legal.antifraud') ?></a></li>
        <li><a href="/Regulatory-compliance.php" class="hover:text-white"><?= t('footer.legal.compliance') ?></a></li>
        <li><a href="/Communication-Policy.php" class="hover:text-white"><?= t('footer.legal.communication') ?></a></li>
        <li><a href="/Data-Retention-Policy.php" class="hover:text-white"><?= t('footer.legal.retention') ?></a></li>
        <li><a href="/Acceptable-Use-Policy.php" class="hover:text-white"><?= t('footer.legal.acceptable') ?></a></li>
      </ul>
    </div>
  </div>
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 border-t border-white/10 pt-4 text-sm text-white/70">
      <div>© <?= date('Y') ?> <?= t('brand') ?>. <?= t('footer.rights') ?></div>
    </div>
  </div>
</footer>

<footer class="mt-16">
  <!-- Fondo oscuro + glow sutil -->
  <div class="relative overflow-hidden bg-[#1f2a44]">
    <div class="absolute inset-0 opacity-25 pointer-events-none">
      <div class="absolute -top-40 left-1/2 w-[900px] h-[900px] -translate-x-1/2
                  bg-gradient-to-br from-sky-500/25 via-transparent to-transparent
                  rounded-full blur-3xl"></div>
    </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
      <!-- CARD PRINCIPAL (redondeada, acorde a tus cajas) -->
      <div class="relative rounded-3xl border border-white/15 bg-white/10 backdrop-blur-md shadow-2xl overflow-hidden">
        <!-- brillo interior muy suave -->
        <div class="absolute inset-0 pointer-events-none opacity-20
                    bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.25)_0%,rgba(255,255,255,0.00)_55%)]"></div>

        <div class="relative p-6 md:p-10 grid gap-10 md:grid-cols-4 text-white">
          <!-- Columna 1 -->
          <div>
            <a href="/" class="inline-flex items-center gap-3" aria-label="<?= htmlspecialchars(t('brand')) ?>">
              <!-- Icono más discreto para footer -->
              

              <!-- Wordmark con halo (más controlado para footer) -->
              <span class="relative flex items-center gap-1">
  <!-- Halo blanco MÁS marcado -->
  <span class="absolute -inset-x-4 -inset-y-2 rounded-2xl
               bg-[radial-gradient(circle,rgba(255,255,255,0.55)_0%,rgba(255,255,255,0.22)_38%,rgba(255,255,255,0.00)_72%)]
               blur-2xl opacity-100 -z-10"></span>

  <span class="text-[#18c6c8] font-bold uppercase tracking-[0.08em] md:tracking-[0.10em]
               [text-shadow:0_1px_0_rgba(255,255,255,0.20)]">
    Transfer
  </span>

  <span class="text-[#0b2a3a] font-semibold uppercase tracking-[0.06em] md:tracking-[0.08em]
               [text-shadow:0_1px_0_rgba(255,255,255,0.18)]">
    Mar
  </span>

  <!-- check más pegado -->
  <svg viewBox="0 0 24 24" class="h-[14px] w-[14px] opacity-95 mx-0.5">
    <circle cx="12" cy="12" r="9"
            fill="rgba(24,198,200,0.14)"
            stroke="rgba(24,198,200,0.95)"
            stroke-width="1.8"/>
    <path d="M8.2 12.4l2.4 2.5 5.6-6.1"
          fill="none"
          stroke="rgba(24,198,200,0.95)"
          stroke-width="2.2"
          stroke-linecap="round"
          stroke-linejoin="round"/>
  </svg>

  <span class="text-[#0b2a3a] font-semibold uppercase tracking-[0.06em] md:tracking-[0.08em]
               [text-shadow:0_1px_0_rgba(255,255,255,0.18)]">
    Bell
  </span>
</span>
            </a>

            <p class="mt-3 text-sm text-white/80 leading-relaxed">
              <?= t('brand') ?> — <?= t('footer.services.long') ?>
            </p>

            <div class="flex gap-4 mt-5" aria-label="<?= t('footer.follow_us') ?>">
              <a href="https://www.facebook.com/TransferMarbell/" target="_blank" rel="noopener" class="text-white/75 hover:text-white" aria-label="Facebook">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12.07C22 6.48 17.52 2 11.93 2S2 6.48 2 12.07c0 5.02 3.66 9.18 8.44 9.93v-7.03H8.1v-2.9h2.34V9.41c0-2.33 1.38-3.62 3.49-3.62.99 0 2.03.18 2.03.18v2.24h-1.15c-1.14 0-1.49.71-1.49 1.44v1.73h2.54l-.41 2.9h-2.13v7.03C18.34 21.25 22 17.09 22 12.07z"/></svg>
              </a>
              <a href="https://www.instagram.com/transfermarbell/" target="_blank" rel="noopener" class="text-white/75 hover:text-white" aria-label="Instagram">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 1.5A4.25 4.25 0 003.5 7.75v8.5A4.25 4.25 0 007.75 20.5h8.5a4.25 4.25 0 004.25-4.25v-8.5A4.25 4.25 0 0016.25 3.5h-8.5zM12 7a5 5 0 110 10 5 5 0 010-10zm0 1.5a3.5 3.5 0 100 7 3.5 3.5 0 000-7zm4.75-.88a.88.88 0 110 1.76.88.88 0 010-1.76z"/></svg>
              </a>
              <a href="https://twitter.com/TransferMarbell" target="_blank" rel="noopener" class="text-white/75 hover:text-white" aria-label="X">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 2L14.9 10.34 22.5 22h-4.9l-4.7-7.7L8.1 22H2l7.56-9.28L2.4 2H7.3l4.17 6.84L15.3 2H22z"/></svg>
              </a>
            </div>

            <div class="flex flex-wrap gap-3 mt-6 items-center" aria-label="<?= t('footer.payments') ?>">
              <img src="/assets/images/payments/visa.png" class="h-6 w-auto opacity-90" alt="Visa" loading="lazy">
              <img src="/assets/images/payments/master-card.png" class="h-6 w-auto opacity-90" alt="MasterCard" loading="lazy">
              <img src="/assets/images/payments/american-ex.png" class="h-6 w-auto opacity-90" alt="American Express" loading="lazy">
              <img src="/assets/images/payments/paypal.png" class="h-6 w-auto opacity-90" alt="PayPal" loading="lazy">
              <img src="/assets/images/payments/discover.png" class="h-6 w-auto opacity-90" alt="Discover" loading="lazy">
            </div>
          </div>

          <!-- Columna 2 -->
          <div>
            <h3 class="text-base font-semibold mb-3"> <?= t('footer.about') ?> </h3>
            <ul class="space-y-2 text-sm text-white/80">
              <li><a href="/nosotros" class="hover:text-white"><?= t('footer.about.us') ?></a></li>
              <li><a href="/nosotros" class="hover:text-white"><?= t('footer.about.partner') ?></a></li>
              <li>
                <a href="https://hub.transfermarbell.com/transferhub/auth/login.php"
                   class="hover:text-white" target="_blank" rel="noopener">
                  <?= t('footer.services.transferhub') ?>
                </a>
              </li>
            </ul>
          </div>

          <!-- Columna 3 -->
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

          <!-- Columna 4 -->
          <div>
            <h3 class="text-base font-semibold mb-3"><?= t('footer.newsletter') ?></h3>

            <form class="mt-2 flex gap-2" action="/newsletter/subscribe" method="post" aria-label="<?= t('footer.newsletter') ?>">
              <input type="email" name="email"
                     placeholder="<?= t('footer.subscribe.placeholder') ?>"
                     class="w-full rounded-xl px-3 py-2 text-sm bg-white/90 text-zinc-900 placeholder-zinc-500 border border-black/10"
                     required>
              <button type="submit"
                      class="bg-sky-600 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-sky-700 shadow-lg shadow-sky-600/20">
                <?= t('footer.subscribe.button') ?>
              </button>
            </form>

            <p class="mt-2 text-[12px] text-white/60"><?= t('footer.subscribe.disclaimer') ?></p>

            <div class="mt-6 flex items-center gap-2">
              <span class="text-sm text-white/70 mr-1"><?= t('nav.language') ?>:</span>
              <a href="<?= switch_lang_url('es') ?>" class="rounded-lg px-2.5 py-1 text-xs font-semibold border border-white/15 <?= current_lang()=='es'?'bg-white/20 text-white':'bg-white/10 text-white/85 hover:bg-white/15' ?>">ES</a>
              <a href="<?= switch_lang_url('en') ?>" class="rounded-lg px-2.5 py-1 text-xs font-semibold border border-white/15 <?= current_lang()=='en'?'bg-white/20 text-white':'bg-white/10 text-white/85 hover:bg-white/15' ?>">EN</a>
            </div>

            <div class="mt-6 space-y-2 text-sm text-white/80">
              <a href="https://wa.me/34951748494" target="_blank" rel="noopener" class="hover:text-white flex items-center gap-2">
                <img src="/assets/images/wht.png" alt="WhatsApp" class="h-5 w-5">(+34) 951 748 494
              </a>
              <a href="tel:+34692926919" class="hover:text-white flex items-center gap-2">
                <img src="/assets/images/tlf.png" alt="Phone" class="h-5 w-5"> (+34) 951 748 494
              </a>
              <a href="mailto:info@transfermarbell.com" class="hover:text-white">info@transfermarbell.com</a>
              <div class="text-white/60"><?= t('footer.247') ?></div>
            </div>
          </div>
        </div>

        <!-- Zona legal + copyright (integrada dentro de la misma card) -->
        <div class="relative border-t border-white/10 px-6 md:px-10 py-5">
          <div class="flex flex-col gap-4">

            <ul class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-white/70">
              <li>
                <a href="/legal" class="hover:text-white">
                  <?= t('footer.legal.center') ?>
                </a>
              </li>
            </ul>


            <div class="text-sm text-white/70">
              © <?= date('Y') ?> <?= t('brand') ?>. <?= t('footer.rights') ?>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</footer>

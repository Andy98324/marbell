<?php
$hasOut = !empty($ref_out);
$hasRet = !empty($ref_ret);
?>

<style>
  .confirm-page {
    min-height: 100vh;
    background:
      radial-gradient(circle at top, rgba(16, 185, 129, 0.16), transparent 28%),
      linear-gradient(180deg, #0f172a 0%, #111827 100%);
    padding: 40px 16px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .confirm-card {
    width: 100%;
    max-width: 760px;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.14);
    border-radius: 28px;
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.30);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    overflow: hidden;
    position: relative;
  }

  .confirm-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background:
      radial-gradient(circle at top, rgba(255,255,255,0.16) 0%, rgba(255,255,255,0) 45%);
    pointer-events: none;
  }

  .confirm-inner {
    position: relative;
    padding: 34px 28px;
    text-align: center;
    color: #ffffff;
  }

  .confirm-icon {
    width: 74px;
    height: 74px;
    margin: 0 auto 18px;
    border-radius: 999px;
    background: linear-gradient(135deg, #34d399, #10b981);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 18px 40px rgba(16, 185, 129, 0.35);
  }

  .confirm-icon svg {
    width: 36px;
    height: 36px;
    fill: #052e16;
  }

  .confirm-title {
    margin: 0 0 10px;
    font-size: 38px;
    line-height: 1.1;
    font-weight: 800;
    letter-spacing: -0.03em;
    color: #ffffff;
  }

  .confirm-subtitle {
    margin: 0 0 8px;
    font-size: 17px;
    color: rgba(255,255,255,0.88);
  }

  .confirm-note {
    margin: 0 0 24px;
    font-size: 14px;
    color: rgba(255,255,255,0.68);
  }

  .confirm-refs {
    display: inline-flex;
    flex-direction: column;
    gap: 10px;
    align-items: flex-start;
    text-align: left;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.10);
    border-radius: 20px;
    padding: 18px 20px;
    max-width: 100%;
    margin-bottom: 24px;
  }

  .confirm-ref-row {
    font-size: 15px;
    line-height: 1.5;
    color: #ffffff;
    word-break: break-word;
  }

  .confirm-ref-row strong {
    color: #d1fae5;
  }

  .confirm-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    justify-content: center;
    margin-bottom: 22px;
  }

  .confirm-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    border-radius: 14px;
    padding: 14px 22px;
    font-size: 15px;
    font-weight: 700;
    transition: transform .18s ease, box-shadow .18s ease, background .18s ease, color .18s ease;
    cursor: pointer;
  }

  .confirm-btn:hover {
    transform: translateY(-2px);
  }

  .confirm-btn-download {
    background: #ffffff;
    color: #111827;
    box-shadow: 0 12px 28px rgba(0,0,0,0.18);
  }

  .confirm-btn-download:hover {
    background: #f3f4f6;
    color: #0f172a;
  }

  .confirm-btn-home {
    background: linear-gradient(135deg, #34d399, #10b981);
    color: #052e16;
    box-shadow: 0 14px 30px rgba(16, 185, 129, 0.28);
  }

  .confirm-btn-home:hover {
    background: linear-gradient(135deg, #6ee7b7, #34d399);
    color: #052e16;
  }

  .confirm-help {
    margin: 0 0 24px;
    font-size: 13px;
    line-height: 1.6;
    color: rgba(255,255,255,0.72);
  }

  @media (max-width: 640px) {
    .confirm-page {
      padding: 22px 12px;
    }

    .confirm-inner {
      padding: 26px 18px;
    }

    .confirm-title {
      font-size: 30px;
    }

    .confirm-subtitle {
      font-size: 15px;
    }

    .confirm-btn {
      width: 100%;
    }

    .confirm-actions {
      flex-direction: column;
    }

    .confirm-refs {
      width: 100%;
    }
  }
</style>

<section class="confirm-page">
  <div class="confirm-card">
    <div class="confirm-inner">

      <div class="confirm-icon" aria-hidden="true">
        <svg viewBox="0 0 24 24">
          <path d="M9.55 18.3 3.9 12.65l1.4-1.4 4.25 4.25 9.15-9.15 1.4 1.4Z"/>
        </svg>
      </div>

      <h1 class="confirm-title">
        <?= function_exists('t') ? t('confirm.title') : 'Reserva confirmada' ?>
      </h1>

      <p class="confirm-subtitle">
        <?= function_exists('t') ? t('confirm.subtitle') : 'Hemos recibido tu solicitud de traslado.' ?>
      </p>

      <p class="confirm-note">
        <?= function_exists('t') ? t('confirm.voucher_ready') : 'Tu voucher está listo para descargar.' ?>
      </p>

      <div class="confirm-refs">
        <?php if ($hasOut): ?>
          <div class="confirm-ref-row">
            <strong><?= function_exists('t') ? t('confirm.ref_out') : 'Referencia de ida' ?>:</strong>
            <?= htmlspecialchars((string)$ref_out, ENT_QUOTES, 'UTF-8') ?>
          </div>
        <?php endif; ?>

        <?php if ($hasRet): ?>
          <div class="confirm-ref-row">
            <strong><?= function_exists('t') ? t('confirm.ref_ret') : 'Referencia de vuelta' ?>:</strong>
            <?= htmlspecialchars((string)$ref_ret, ENT_QUOTES, 'UTF-8') ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="confirm-actions">
        <?php if ($hasOut): ?>
          <a
            href="/download-voucher.php?ref=<?= urlencode((string)$ref_out) ?>"
            target="_blank"
            rel="noopener noreferrer"
            class="confirm-btn confirm-btn-download"
          >
            <?= function_exists('t') ? t('confirm.download_out') : 'Descargar voucher (ida)' ?>
          </a>
        <?php endif; ?>

        <?php if ($hasRet): ?>
          <a
            href="/download-voucher.php?ref=<?= urlencode((string)$ref_ret) ?>"
            target="_blank"
            rel="noopener noreferrer"
            class="confirm-btn confirm-btn-download"
          >
            <?= function_exists('t') ? t('confirm.download_ret') : 'Descargar voucher (vuelta)' ?>
          </a>
        <?php endif; ?>
      </div>

      <p class="confirm-help">
        <?= function_exists('t') ? t('confirm.help_text') : 'Si detectas algún dato incorrecto, por favor contacta con nosotros lo antes posible indicando tu referencia.' ?>
      </p>

      <a href="/" class="confirm-btn confirm-btn-home">
        <?= function_exists('t') ? t('confirm.back_home') : 'Volver al inicio' ?>
      </a>

    </div>
  </div>
</section>
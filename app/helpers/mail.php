<?php
// app/helpers/mail.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * Envía un email usando SMTP One.com
 *
 * IMPORTANTE: ahora mismo está en "modo seguro":
 * - intenta enviar
 * - si algo va mal, NO revienta la página y devuelve false
 * - puedes cambiar $USE_REAL_SMTP a false para desactivar el envío real
 *
 * @param string $toEmail      Email destinatario
 * @param string $subject      Asunto
 * @param string $htmlBody     Cuerpo HTML
 * @param string $toName       Nombre destinatario
 * @param array  $attachments  [ ['path' => '', 'name' => ''], ... ]
 *
 * @return bool
 */
function send_app_mail(
    string $toEmail,
    string $subject,
    string $htmlBody,
    string $toName = '',
    array $attachments = []
): bool {

    // ─────────────────────────────────────────
    // 1) Cambia esto a TRUE cuando quieras usar SMTP real
    // ─────────────────────────────────────────
    $USE_REAL_SMTP = true;

    // Si no queremos enviar de verdad, solo registramos en log y salimos
    if (!$USE_REAL_SMTP) {
        error_log('[MAIL MOCK] To: ' . $toEmail . ' | Subj: ' . $subject);
        return true;
    }

    $mail = new PHPMailer(true);

    try {
        // ─────────────────────────────────────────
        // CONFIG SMTP
        // ─────────────────────────────────────────
        $mail->isSMTP();
        $mail->Host       = 'send.one.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'reservas@transfermarbell.com';
        $mail->Password   = '5$3%3&6/6(7)9=5?'; // cámbiala si la modificas
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    // SSL
        $mail->Port       = 465;

        // Timeouts muy cortos para que JAMÁS cuelgue la web
        $mail->Timeout     = 5;   // segundos por operación SMTP
        $mail->SMTPDebug   = 0;   // nada en pantalla
        $mail->Debugoutput = 'error_log';

        // ─────────────────────────────────────────
        // REMITENTE / DESTINATARIO
        // ─────────────────────────────────────────
        $mail->setFrom('reservas@transfermarbell.com', 'Transfer Marbell');
        $mail->addReplyTo('reservas@transfermarbell.com', 'Transfer Marbell');

        $mail->addAddress($toEmail, $toName ?: $toEmail);

        // ─────────────────────────────────────────
        // ADJUNTOS (vouchers, etc.)
        // ─────────────────────────────────────────
        foreach ($attachments as $att) {
            if (!empty($att['path']) && is_file($att['path'])) {
                $mail->addAttachment(
                    $att['path'],
                    $att['name'] ?? basename($att['path'])
                );
            }
        }

        // ─────────────────────────────────────────
        // CONTENIDO
        // ─────────────────────────────────────────
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $htmlBody;
        $mail->AltBody = strip_tags($htmlBody);

        if (!$mail->send()) {
            error_log('MAIL ERROR (send returned false): ' . $mail->ErrorInfo);
            return false;
        }

        return true;

    } catch (Exception $e) {
        // NUNCA rompemos la web por culpa del correo
        error_log('MAIL EXCEPTION: ' . $e->getMessage());
        return false;
    }
}

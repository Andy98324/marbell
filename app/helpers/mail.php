<?php
// app/helpers/mail.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * Envía un email usando SMTP One.com
 *
 * @param string $toEmail      Email destinatario
 * @param string $subject      Asunto
 * @param string $htmlBody     Cuerpo HTML
 * @param string $toName       Nombre destinatario (opcional)
 * @param array  $attachments  Archivos adjuntos: [ ['path' => '', 'name' => ''], ... ]
 *
 * @return bool true si “parece” enviado, false si hay error
 */
function send_app_mail(
    string $toEmail,
    string $subject,
    string $htmlBody,
    string $toName = '',
    array $attachments = []
): bool {
    $mail = new PHPMailer(true);

    try {
        /* ------------- CONFIG SMTP ------------- */
        $mail->isSMTP();
        $mail->Host       = 'send.one.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'reservas@transfermarbell.com';
        $mail->Password   = '5$3%3&6/6(7)9=5?'; // <-- cámbiala cuando quieras
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    // SSL
        $mail->Port       = 465;

        // Evitar cuelgues largos
        $mail->Timeout     = 10;   // segundos
        $mail->SMTPDebug   = 0;    // 0 = silencioso
        $mail->Debugoutput = 'error_log';

        /* ------------- REMITENTE ------------- */
        $mail->setFrom('reservas@transfermarbell.com', 'Transfer Marbell');
        $mail->addReplyTo('reservas@transfermarbell.com', 'Transfer Marbell');

        /* ------------- DESTINATARIO ------------- */
        $toName = $toName ?: $toEmail;
        $mail->addAddress($toEmail, $toName);

        /* ------------- CONTENIDO ------------- */
        $mail->isHTML(true);
        $mail->CharSet  = 'UTF-8';
        $mail->Subject  = $subject;
        $mail->Body     = $htmlBody;
        $mail->AltBody  = strip_tags($htmlBody);

        /* ------------- ADJUNTOS (opcional) ------------- */
        foreach ($attachments as $att) {
            if (empty($att['path']) || !is_file($att['path'])) {
                continue;
            }
            $name = $att['name'] ?? basename($att['path']);
            $mail->addAttachment($att['path'], $name);
        }

        /* ------------- ENVIAR ------------- */
        if (!$mail->send()) {
            error_log('MAIL ERROR (send returned false): ' . $mail->ErrorInfo);
            return false;
        }

        return true;

    } catch (Exception $e) {
        // Nunca reventar la página, solo loguear
        error_log('MAIL EXCEPTION: ' . $e->getMessage());
        return false;
    }
}

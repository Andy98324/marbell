<?php
// app/helpers/mail.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar PHPMailer si no está cargado
require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * Envía un email usando SMTP One.com
 *
 * @param string $toEmail   Email destinatario
 * @param string $subject   Asunto
 * @param string $htmlBody  Cuerpo HTML
 * @param string $toName    Nombre destinatario
 * @param array  $attachments  Archivos adjuntos [ ['path' => '', 'name' => ''], ... ]
 *
 * @return bool
 */
function send_app_mail(string $toEmail, string $subject, string $htmlBody, string $toName = '', array $attachments = []): bool
{
    $mail = new PHPMailer(true);

    try {
        /* ---------------------------------------------------
         *  CONFIGURACIÓN SMTP ONE.COM
         * --------------------------------------------------- */
        $mail->isSMTP();
        $mail->Host       = 'send.one.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'reservas@transfermarbell.com';   // TU CORREO
        $mail->Password   = '5$3%3&6/6(7)9=5?';         // TU CONTRASEÑA SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      // SSL
        $mail->Port       = 465;

        /* ---------------------------------------------------
         *  DATOS DEL REMITENTE
         * --------------------------------------------------- */
        $mail->setFrom('reservas@transfermarbell.com', 'Transfer Marbell');
        $mail->addReplyTo('reservas@transfermarbell.com', 'Transfer Marbell');

        /* ---------------------------------------------------
         *  DESTINATARIO
         * --------------------------------------------------- */
        $mail->addAddress($toEmail, $toName);

        /* ---------------------------------------------------
         *  ADJUNTOS
         * --------------------------------------------------- */
        foreach ($attachments as $att) {
            if (!empty($att['path'])) {
                $mail->addAttachment($att['path'], $att['name'] ?? basename($att['path']));
            }
        }

        /* ---------------------------------------------------
         *  CONTENIDO
         * --------------------------------------------------- */
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $htmlBody;
        $mail->AltBody = strip_tags($htmlBody);

        return $mail->send();
    } catch (Exception $e) {
        error_log("MAIL ERROR: " . $mail->ErrorInfo);
        return false;
    }
}

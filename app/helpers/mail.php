<?php
// app/helpers/mail.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// OJO: NO hace falta require del autoload si ya lo hace bootstrap.php
// composer.json debe tener "phpmailer/phpmailer" instalado.

if (!function_exists('send_app_mail')) {
    /**
     * Envía un email HTML usando la configuración de .env
     *
     * @param string $to
     * @param string $subject
     * @param string $html
     * @param array<int,array{path:string,name?:string}> $attachments
     */
    function send_app_mail(string $to, string $subject, string $html, array $attachments = []): bool
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = env('MAIL_HOST', 'send.one.com');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME');
            $mail->Password   = env('MAIL_PASSWORD');
            $mail->Port       = (int)env('MAIL_PORT', 465);

            $enc = strtolower((string)env('MAIL_ENCRYPTION', 'ssl'));
            if ($enc === 'ssl') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } elseif ($enc === 'tls') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            }

            // Debug a error_log para ver fallos si algo sale mal
            $mail->SMTPDebug  = 2;
            $mail->Debugoutput = static function ($str, $level) {
                error_log("MAIL[$level]: $str");
            };

            $fromAddress = env('MAIL_FROM_ADDRESS', env('MAIL_USERNAME'));
            $fromName    = env('MAIL_FROM_NAME', 'Transfer Marbell');

            $mail->setFrom($fromAddress, $fromName);
            $mail->addAddress($to);

            foreach ($attachments as $att) {
                if (!empty($att['path']) && is_file($att['path'])) {
                    $mail->addAttachment($att['path'], $att['name'] ?? basename($att['path']));
                }
            }

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $subject;
            $mail->Body    = $html;

            $ok = $mail->send();
            if (!$ok) {
                error_log('MAIL ERROR: ' . $mail->ErrorInfo);
            }
            return $ok;
        } catch (Exception $e) {
            error_log('MAIL EXCEPTION: ' . $e->getMessage());
            return false;
        }
    }
}

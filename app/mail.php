<?php
// app/mail.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function app_env(string $key, $default = null) {
    // Usa getenv o $_ENV, según tengas definido
    $val = getenv($key);
    if ($val === false && isset($_ENV[$key])) {
        $val = $_ENV[$key];
    }
    return $val !== false ? $val : $default;
}

/**
 * Enviar un email HTML usando SMTP (one.com).
 *
 * @param string      $to         email destino
 * @param string      $subject    asunto
 * @param string      $htmlBody   cuerpo HTML
 * @param string|null $toName     nombre del destinatario
 * @param array       $attachments [ [ 'path' => '/ruta/file.pdf', 'name' => 'Voucher.pdf' ], ... ]
 */
function send_app_mail(string $to, string $subject, string $htmlBody, ?string $toName = null, array $attachments = []): bool
{
    $mail = new PHPMailer(true);

    try {
        // Config SMTP
        $mail->isSMTP();
        $mail->Host       = app_env('MAIL_HOST', 'send.one.com');
        $mail->SMTPAuth   = true;
        $mail->Username   = app_env('MAIL_USERNAME');
        $mail->Password   = app_env('MAIL_PASSWORD');
        $mail->Port       = (int)app_env('MAIL_PORT', 465);

        $enc = strtolower((string)app_env('MAIL_ENCRYPTION', 'ssl'));
        if ($enc === 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // puerto 465
        } elseif ($enc === 'tls') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // normalmente 587
        }

        // From
        $from      = app_env('MAIL_FROM_ADDRESS', app_env('MAIL_USERNAME'));
        $fromName  = app_env('MAIL_FROM_NAME', 'Transfer Marbell');

        $mail->setFrom($from, $fromName ?: $from);
        $mail->addAddress($to, $toName ?: $to);

        // Adjuntos (para futuros vouchers)
        foreach ($attachments as $att) {
            if (!empty($att['path']) && is_file($att['path'])) {
                $mail->addAttachment($att['path'], $att['name'] ?? basename($att['path']));
            }
        }

        // Contenido
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body    = $htmlBody;

        // Texto plano simple por si el cliente no ve HTML
        $mail->AltBody = strip_tags(
            str_replace(['<br>', '<br/>', '<br />', '</p>'], "\n", $htmlBody)
        );

        return $mail->send();
    } catch (Exception $e) {
        // En desarrollo puedes loguear el error:
        error_log('MAIL ERROR: ' . $e->getMessage());
        return false;
    }
}

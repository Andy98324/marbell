<?php
// app/helpers/mail.php
declare(strict_types=1);

/**
 * Pequeño wrapper para variables de entorno.
 * Si en el futuro usas env(), esto no rompe nada.
 */
if (!function_exists('app_env')) {
    function app_env(string $key, ?string $default = null): ?string {
        if (function_exists('env')) {
            return env($key, $default);
        }
        $v = getenv($key);
        return $v === false ? $default : $v;
    }
}

/**
 * Envía un email HTML con o sin adjuntos usando mail()
 *
 * @param string $to         Email destino
 * @param string $subject    Asunto
 * @param string $htmlBody   Cuerpo HTML
 * @param string $toName     Nombre del destinatario (opcional)
 * @param array  $attachments Cada adjunto: ['path'=>..., 'name'=>..., 'type'=>...]
 */
if (!function_exists('send_app_mail')) {
    function send_app_mail(
        string $to,
        string $subject,
        string $htmlBody,
        string $toName = '',
        array $attachments = []
    ): bool {
        $from     = app_env('APP_MAIL_FROM', 'reservas@transfermarbell.com');
        $fromName = app_env('APP_MAIL_FROM_NAME', 'Transfer Marbell');

        $toHeader   = $toName ? sprintf('"%s" <%s>', addslashes($toName), $to) : $to;
        $fromHeader = sprintf('"%s" <%s>', addslashes($fromName), $from);

        $headers  = "From: $fromHeader\r\n";
        $headers .= "Reply-To: $fromHeader\r\n";
        $headers .= "MIME-Version: 1.0\r\n";

        // Sin adjuntos → email HTML simple
        if (empty($attachments)) {
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            $body = $htmlBody;
        } else {
            // Con adjuntos → multipart/mixed
            $boundary = 'b' . md5(uniqid((string)mt_rand(), true));
            $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";

            $body  = "--$boundary\r\n";
            $body .= "Content-Type: text/html; charset=UTF-8\r\n";
            $body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
            $body .= $htmlBody . "\r\n";

            foreach ($attachments as $att) {
                if (empty($att['path']) || !is_file($att['path'])) {
                    continue;
                }
                $name = $att['name'] ?? basename($att['path']);
                $type = $att['type'] ?? 'application/octet-stream';
                $data = chunk_split(base64_encode((string)file_get_contents($att['path'])));

                $body .= "--$boundary\r\n";
                $body .= "Content-Type: $type; name=\"$name\"\r\n";
                $body .= "Content-Transfer-Encoding: base64\r\n";
                $body .= "Content-Disposition: attachment; filename=\"$name\"\r\n\r\n";
                $body .= $data . "\r\n";
            }

            $body .= "--$boundary--";
        }

        // Forzamos asunto en UTF-8
        $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

        return mail($toHeader, $encodedSubject, $body, $headers);
    }
}

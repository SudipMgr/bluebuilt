<?php
// ============================================================
//  mail-config.php — Shared SMTP mail sender
//  Elwood Blues Construction (bluesbuilt.com)
//
//  Sends via authenticated SMTP (not PHP's mail()), which has
//  proven unreliable / silently non-functional on some shared
//  hosting accounts. Update the 4 constants below once you've
//  created the mailbox in cPanel.
// ============================================================

require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// -------------------------------------------------------
//  SMTP account credentials (mailbox created in cPanel)
//  !! FILL THESE IN before going live !!
// -------------------------------------------------------
define('SMTP_HOST',     'mail.bluesbuilt.com');             // confirmed via cPanel Connect Devices
define('SMTP_PORT',     465);                               // 465 = SSL, confirmed
define('SMTP_SECURE',   PHPMailer::ENCRYPTION_SMTPS);        // matches port 465 (implicit SSL)
define('SMTP_USERNAME', 'noreply@bluesbuilt.com');           // mailbox created in cPanel
define('SMTP_PASSWORD', 'q))58%I4B.rsD__%');                 // mailbox password

/**
 * Send an email via authenticated SMTP.
 *
 * @param string $to           Destination address
 * @param string $subject      Email subject
 * @param string $body         Email body (plain text or HTML)
 * @param bool   $isHtml       Whether $body is HTML
 * @param string $replyToEmail Reply-To address (e.g. the visitor's email)
 * @param string $replyToName  Reply-To display name
 * @return array ['success' => bool, 'error' => string|null]
 */
function send_form_email($to, $subject, $body, $isHtml = false, $replyToEmail = '', $replyToName = '')
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USERNAME;
        $mail->Password   = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_SECURE;
        $mail->Port       = SMTP_PORT;

        $mail->setFrom(SMTP_USERNAME, 'Elwood Blues Construction — Website');
        $mail->addAddress($to);

        if (!empty($replyToEmail)) {
            $mail->addReplyTo($replyToEmail, $replyToName ?: $replyToEmail);
        }

        $mail->isHTML($isHtml);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return ['success' => true, 'error' => null];
    } catch (Exception $e) {
        error_log('send_form_email() failed: ' . $mail->ErrorInfo);
        return ['success' => false, 'error' => $mail->ErrorInfo];
    }
}

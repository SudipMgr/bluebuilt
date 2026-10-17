<?php
// ============================================================
//  send-mail.php — Elwood Blues Construction
//  Handles form submissions from both the Home page and
//  the Contact page. Sends via authenticated SMTP (PHPMailer),
//  not PHP's mail() — see mail-config.php.
// ============================================================

require_once __DIR__ . '/mail-config.php';

// ---- CONFIGURATION -----------------------------------------
$recipient = 'elwoodbluesco@gmail.com';
$site_name = 'Elwood Blues Construction';
// ------------------------------------------------------------

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// ---- COLLECT & SANITIZE INPUT ------------------------------
function clean($val) {
    return htmlspecialchars(strip_tags(trim($val ?? '')));
}

$first_name  = clean($_POST['firstName']  ?? '');
$last_name   = clean($_POST['lastName']   ?? '');
$email       = clean($_POST['email']      ?? '');
$phone       = clean($_POST['phone']      ?? 'Not provided');
$address     = clean($_POST['address']    ?? 'Not provided');
$service     = clean($_POST['service']    ?? 'Not specified');
$budget      = clean($_POST['budget']     ?? 'Not specified');
$timeline    = clean($_POST['timeline']   ?? 'Not specified');
$message     = clean($_POST['message']    ?? 'No message provided');
$form_source = clean($_POST['form_source'] ?? 'Website');

$full_name   = trim("$first_name $last_name");

// ---- VALIDATE REQUIRED FIELDS ------------------------------
$errors = [];

if (empty($first_name)) {
    $errors[] = 'First name is required.';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'A valid email address is required.';
}

// Basic spam honeypot check (optional field named "website" in form)
$honeypot = clean($_POST['website'] ?? '');
if (!empty($honeypot)) {
    // Silently succeed to fool bots
    echo json_encode(['success' => true]);
    exit;
}

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

// ---- BUILD EMAIL (HTML, matching site theme) ----------------
$subject = "New Project Inquiry from $full_name — $site_name";

$eventRows = '';
$rows = [
    'Name'              => $full_name,
    'Email'             => $email,
    'Phone'             => $phone,
    'Property Address'  => $address,
    'Service'           => $service,
    'Budget'            => $budget,
    'Timeline'          => $timeline,
];
foreach ($rows as $label => $value) {
    $eventRows .= '
      <tr>
        <td style="padding:12px 20px; font-size:13px; font-weight:600; letter-spacing:0.04em; text-transform:uppercase; color:#7a7a7a; background:#f5f5f5; border-bottom:1px solid #e6e6e6; width:38%; white-space:nowrap; vertical-align:top;">' . $label . '</td>
        <td style="padding:12px 20px; font-size:15px; color:#0a0a0a; border-bottom:1px solid #e6e6e6; vertical-align:top;">' . nl2br($value) . '</td>
      </tr>';
}

$body = '<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"></head>
<body style="margin:0; padding:0; background:#f0f0f0; font-family:\'DM Sans\', Arial, sans-serif; color:#0a0a0a;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f0f0f0; padding:32px 16px;">
<tr><td align="center">
<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; max-width:600px; width:100%;">

  <!-- Header -->
  <tr>
    <td style="background:#0a0a0a; padding:32px 32px 28px;">
      <div style="font-family:Georgia, \'Cormorant Garamond\', serif; font-size:24px; font-weight:300; color:#ffffff; letter-spacing:0.02em;">
        Elwood Blues <span style="color:#3a52ff; font-style:italic;">Construction</span>
      </div>
      <div style="font-size:11px; letter-spacing:0.15em; text-transform:uppercase; color:#b0b0b0; margin-top:8px;">
        New Project Inquiry
      </div>
    </td>
  </tr>

  <!-- Accent bar -->
  <tr><td style="height:4px; background:#0220f4;"></td></tr>

  <!-- Intro -->
  <tr>
    <td style="padding:28px 32px 8px;">
      <p style="margin:0; font-size:15px; line-height:1.6; color:#0a0a0a;">
        You have received a new consultation request from your website.
      </p>
    </td>
  </tr>

  <!-- Details table -->
  <tr>
    <td style="padding:16px 32px 8px;">
      <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #e6e6e6; border-collapse:collapse;">
        ' . $eventRows . '
      </table>
    </td>
  </tr>

  <!-- Message -->
  <tr>
    <td style="padding:24px 32px 8px;">
      <div style="font-size:11px; letter-spacing:0.12em; text-transform:uppercase; color:#7a7a7a; margin-bottom:10px;">Message</div>
      <div style="background:#f5f5f5; border-left:3px solid #0220f4; padding:16px 20px; font-size:14px; line-height:1.75; color:#0a0a0a;">
        ' . nl2br($message) . '
      </div>
    </td>
  </tr>

  <!-- Footer -->
  <tr>
    <td style="padding:28px 32px 32px;">
      <p style="margin:0 0 4px; font-size:13px; color:#7a7a7a; line-height:1.6;">
        Reply directly to this email to respond to ' . $first_name . '.
      </p>
      <p style="margin:0; font-size:12px; color:#b0b0b0;">
        Sent from: ' . $_SERVER['HTTP_HOST'] . '
      </p>
    </td>
  </tr>

</table>
</td></tr>
</table>
</body>
</html>';

// ---- SEND ----------------------------------------------------
$result = send_form_email($recipient, $subject, $body, true, $email, $full_name);
$sent = $result['success'];

if (!$sent) {
    error_log('send-mail.php: SMTP send failed for ' . $email . ': ' . $result['error']);
}

// ---- AUTO-REPLY TO CUSTOMER --------------------------------
if ($sent) {
    $reply_subject = "We received your inquiry — $site_name";

    $summaryRows = '';
    $summary = [
        'Service'  => $service,
        'Budget'   => $budget,
        'Timeline' => $timeline,
    ];
    foreach ($summary as $label => $value) {
        $summaryRows .= '
      <tr>
        <td style="padding:12px 20px; font-size:13px; font-weight:600; letter-spacing:0.04em; text-transform:uppercase; color:#7a7a7a; background:#f5f5f5; border-bottom:1px solid #e6e6e6; width:38%; white-space:nowrap;">' . $label . '</td>
        <td style="padding:12px 20px; font-size:15px; color:#0a0a0a; border-bottom:1px solid #e6e6e6;">' . $value . '</td>
      </tr>';
    }

    $reply_body = '<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"></head>
<body style="margin:0; padding:0; background:#f0f0f0; font-family:\'DM Sans\', Arial, sans-serif; color:#0a0a0a;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f0f0f0; padding:32px 16px;">
<tr><td align="center">
<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; max-width:600px; width:100%;">

  <!-- Header -->
  <tr>
    <td style="background:#0a0a0a; padding:32px 32px 28px;">
      <div style="font-family:Georgia, \'Cormorant Garamond\', serif; font-size:24px; font-weight:300; color:#ffffff; letter-spacing:0.02em;">
        Elwood Blues <span style="color:#3a52ff; font-style:italic;">Construction</span>
      </div>
    </td>
  </tr>

  <!-- Accent bar -->
  <tr><td style="height:4px; background:#0220f4;"></td></tr>

  <!-- Body -->
  <tr>
    <td style="padding:32px;">
      <div style="font-family:Georgia, \'Cormorant Garamond\', serif; font-size:26px; font-weight:300; color:#0a0a0a; margin-bottom:16px;">
        Thank you, ' . $first_name . '.
      </div>
      <p style="margin:0 0 20px; font-size:15px; line-height:1.7; color:#0a0a0a;">
        Harris has received your inquiry and will get back to you personally within one business day.
      </p>

      <div style="font-size:11px; letter-spacing:0.12em; text-transform:uppercase; color:#7a7a7a; margin-bottom:10px;">Your Request Summary</div>
      <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #e6e6e6; border-collapse:collapse; margin-bottom:24px;">
        ' . $summaryRows . '
      </table>

      <p style="margin:0 0 4px; font-size:15px; line-height:1.7; color:#0a0a0a;">
        Need to reach us sooner? Call directly:
      </p>
      <p style="margin:0 0 24px; font-size:17px; color:#0220f4; font-weight:500;">
        (623) 262-6579 <span style="font-size:13px; color:#7a7a7a; font-weight:400;">· Mon–Fri 7am–6pm</span>
      </p>

      <p style="margin:0; font-size:14px; line-height:1.7; color:#7a7a7a;">
        — Harris Lyons<br>
        Elwood Blues Construction<br>
        Phoenix, AZ 85022
      </p>
    </td>
  </tr>

</table>
</td></tr>
</table>
</body>
</html>';

    $reply_result = send_form_email($email, $reply_subject, $reply_body, true, $recipient, $site_name);
    if (!$reply_result['success']) {
        error_log('send-mail.php: auto-reply SMTP send failed for ' . $email . ': ' . $reply_result['error']);
    }
}

// ---- RESPOND TO BROWSER ------------------------------------
header('Content-Type: application/json');
if ($sent) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Mail could not be sent. Please call us directly at (623) 262-6579.'
    ]);
}
exit;

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Capture and sanitize form inputs
$name      = htmlspecialchars($_POST['name']);
$email     = htmlspecialchars($_POST['email']);
$recipient = htmlspecialchars($_POST['recipient']);
$subject   = htmlspecialchars($_POST['subject']);
$message   = nl2br(htmlspecialchars($_POST['message']));

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->isSMTP();
    $mail->Host       = 'za-smtp-outbound-1.mimecast.co.za';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'noreply@22onsloane.co';
    $mail->Password   = 'qGs7YK#w';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Sender & recipient settings
    $mail->setFrom('noreply@22onsloane.co', $name);
    $mail->addAddress($recipient);
    $mail->addReplyTo($email, $name);

    // Email content
    $mail->isHTML(true);
    $mail->Subject = $subject;

    // HTML email body
    $mail->Body = "
    <!DOCTYPE html>
    <html>
    <head>
      <style>
        body {
          background-color: #2e2f30;
          font-family: Arial, sans-serif;
          color: #ffffff;
          margin: 0;
          padding: 0;
        }
        .container {
          max-width: 600px;
          margin: 0 auto;
        }
        .header {
          background-color: #d63a1c;
          padding: 20px;
          text-align: center;
        }
        .header h1 {
          margin: 0;
          color: #fff;
          font-size: 20px;
        }
        .header-links {
          margin-top: 5px;
          font-size: 13px;
        }
        .header-links a {
          color: #ffffff;
          margin: 0 10px;
          text-decoration: none;
        }
        .card {
          background-color: #1e1e1e;
          padding: 20px;
        }
        .card p {
          color: #ccc;
          font-size: 14px;
        }
        .details {
          margin-top: 20px;
        }
        .details p {
          margin: 5px 0;
        }
        .details strong {
          display: inline-block;
          width: 80px;
          color: #ffffff;
        }
        .footer {
          background-color: #3c3c3c;
          color: #bbb;
          font-size: 13px;
          text-align: center;
          padding: 15px;
        }
        .footer a {
          color: #ffffff;
          text-decoration: underline;
          margin: 0 5px;
        }
      </style>
    </head>
    <body>
      <div class='container'>
        <div class='header'>
          <h1>22 ON SLOANE</h1>
          <div class='header-links'>
            <a href='#'>SCHEDULE</a> · <a href='#'>MY BOOKINGS</a>
          </div>
        </div>

        <div class='card'>
          <h2 style='color: #fff; font-size: 20px;'>{$subject}</h2>
          <p style='color: #ffdbdb; margin-bottom: 20px;'>
            {$message}
          </p>

          <p>Please find the details of your message below, and contact us if you have any questions.</p>

          <div class='details'>
            <p><strong>From</strong> {$name}</p>
            <p><strong>Email</strong> <a href='mailto:{$email}' style='color: #ffc107;'>{$email}</a></p>
          </div>
        </div>

        <div class='footer'>
          22 On Sloane · <a href='mailto:njabulo@22onsloane.co'>njabulo@22onsloane.co</a> · 011 463 7602<br><br>
          <a href='#'>Unsubscribe</a>
        </div>
      </div>
    </body>
    </html>
    ";

    $mail->send();
    echo '<div style="padding:20px;font-family:Arial;color:#fff;background-color:#28a745;">Email successfully sent!</div>';
} catch (Exception $e) {
    echo '<div style="padding:20px;font-family:Arial;color:#fff;background-color:#dc3545;">';
    echo "Email failed: {$mail->ErrorInfo}";
    echo '</div>';
}
?>

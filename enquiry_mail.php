<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/plain');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mail/php/src/Exception.php';
require 'mail/php/src/PHPMailer.php';
require 'mail/php/src/SMTP.php';

$name    = $_POST['name'] ?? '';
$email   = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

if (!$name || !$email || !$message) {
    exit("Missing required fields.");
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'articnineweb@gmail.com';
    $mail->Password   = 'xxwymvczjwhhquun';  // Use Gmail App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('articnineweb@gmail.com', 'Artic9 Website');
    $mail->addAddress('gayathri@artic9.com', 'HomeFiber');
    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);
    $mail->Subject = 'New Enquiry Submission';
    $mail->Body = "
        <strong>Name:</strong> $name<br>
        <strong>Email:</strong> $email<br>
        <strong>Message:</strong><br>" . nl2br(htmlspecialchars($message));

    $mail->send();
    echo "success";
} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}
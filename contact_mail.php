<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mail/php/src/Exception.php';
require 'mail/php/src/PHPMailer.php';
require 'mail/php/src/SMTP.php';

$name    = $_POST['name']    ?? '';
$email   = $_POST['email']   ?? '';
// $phone   = $_POST['phone']   ?? '';
$message = $_POST['message'] ?? '';

if (!$name || !$email || !$message) {
    exit("<p style='color:red;'>Please fill in all required fields.</p>");
}

$mail = new PHPMailer(true);

try {
   
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'bluemoonconstruction4u@gmail.com';                     //
    $mail->Password   = 'kqbedrjuoshjrhqu';       
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    
    $mail->setFrom('sales@homefiber.in', 'Artic9 Website');
    $mail->addAddress('sales@homefiber.in', 'HomeFiber');
    // $mail->addAddress('gayathri@artic9.com', 'HomeFiber');
    $mail->addReplyTo($email, $name);

    
    $mail->isHTML(true);
    $mail->Subject = 'New Contact Form Submission';
    $mail->Body    = "<strong>Name:</strong> $name<br>
                      <strong>Email:</strong> $email<br>
                      <strong>Phone:</strong> $phone<br>
                      <strong>Message:</strong><br>" . nl2br(htmlspecialchars($message));

    $mail->send();
    echo "success";

} catch (Exception $e) {
    echo "<p style='color:red;'>Mailer Error: {$mail->ErrorInfo}</p>";
}
?>

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'mail/php/src/Exception.php';
// require 'mail/php/src/PHPMailer.php';
// require 'mail/php/src/SMTP.php';

// $name    = $_POST['name']    ?? '';
// $email   = $_POST['email']   ?? '';
// $phone   = $_POST['phone']   ?? '';
// $message = $_POST['message'] ?? '';

// try {
//     $mail = new PHPMailer(true);

   
//     $mail->SMTPDebug   = 2; 
//     $mail->Debugoutput = 'html';

//     $mail->isSMTP();
//     $mail->Host       = 'smtp.gmail.com';
//     $mail->SMTPAuth   = true;
//     $mail->Username   ='bluemoonconstruction4u@gmail.com';
//     $mail->Password   = 'xxwymvczjwhhquun'; 
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//     $mail->Port       = 587;

//     $mail->setFrom('articnineweb@gmail.com', 'Artic9 Website');
//     $mail->addReplyTo($email, $name);
//     $mail->addAddress('gayathri@artic9.com', 'Gayathri');

//     $mail->Subject = 'New Contact Form Submission';
//     $mail->Body    = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message";

//     $mail->send();
//     echo "<p style='color:green;'>Message has been sent successfully.</p>";
// } catch (Exception $e) {
//     echo "<p style='color:red;'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</p>";
// }

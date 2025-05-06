<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Composer autoloader

header('Content-Type: application/json');

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'mail.unlitech.works'; // Correct SMTP host from cPanel
    $mail->SMTPAuth   = true;
    $mail->Username   = 'davechoco19@unlitech.works'; // Your full email
    $mail->Password   = 'jrpjf6hgb.'; // Your email password
    $mail->SMTPSecure = 'ssl'; // or 'tls' if using port 587
    $mail->Port       = 465; // or 587 if using TLS

    // Recipients
    $mail->setFrom('davechoco19@unlitech.works', 'Website Contact Form');
    $mail->addAddress('davemonces19@gmail.com'); // Destination email

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'New Contact Form Message';

    $first_name = $_POST['first_name'] ?? '';
    $last_name  = $_POST['last_name'] ?? '';
    $email      = $_POST['email'] ?? '';
    $message    = $_POST['message'] ?? '';

    $mail->Body = "
        <h3>New Contact Submission</h3>
        <p><strong>Name:</strong> $first_name $last_name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Message:</strong><br>$message</p>
    ";

    $mail->send();
    echo json_encode(['status' => 'success', 'message' => 'Message sent successfully!']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => "Mailer Error: {$mail->ErrorInfo}"]);
}

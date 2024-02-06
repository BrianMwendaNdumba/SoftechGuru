<?php
session_start();

require 'vendor/autoload.php';
require 'config.php';

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];

$subject = $_POST['subject'];
$message = $_POST['message'];

// Create a new PHPMailer instance
$mail = new PHPMailer\PHPMailer\PHPMailer();

// Configure the mailer settings
$mail->isSMTP();
$mail->Host = 'mail.softechguru.com';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Username = $emailUsername;
$mail->Password = $emailPassword;

// Set the sender and recipient information
$mail->setFrom($email, $name);
$mail->addAddress($recepient);

// Set email subject and body
$mail->Subject = $subject;
$mail->Body = "Name: $name\nEmail: $email\nMessage: $message";
$mail->AddReplyTo($email, $name);

// Attempt to send the email
if ($mail->send()) {
    $_SESSION['message'] = 'Your message was sent successfully!';
} else {
    $_SESSION['message'] = 'Error: ' . $mail->ErrorInfo;
}

// Redirect to the /contact page
echo "<script>alert('Message sent successfully!')</script>";
header('Location: https://www.softechguru.com/writting/contact.php');
exit();

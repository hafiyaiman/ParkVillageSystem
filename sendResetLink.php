<?php
// send_reset_link.php

session_start();
require('config.php');
require('functions.php');

// Include Composer's autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Generate a unique token
    $token = bin2hex(random_bytes(32));

    // Update the user's reset_token in the database
    $updateTokenQuery = "UPDATE users SET reset_token = ? WHERE email = ?";
    $stmt = $conn->prepare($updateTokenQuery);
    $stmt->bind_param("ss", $token, $email);
    $stmt->execute();
    $stmt->close();

    // Send an email with the reset link using PHPMailer
    try {
        $mail = new PHPMailer(true);

        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Specify your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'dparkvillagee@gmail.com'; // SMTP username
        $mail->Password = 'qdnc phzf pehi gobn'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to

        //Recipients
        $mail->setFrom('dparvillagee@gmail.com', 'D Park Village @ KLIA');
        $mail->addAddress($email);

        //resetLink
        $resetLink = "http://localhost/parkvillagesystem/reset_password.php?token=$token";

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Link';
        $mail->Body = 'Click the following link to reset your password: <a href="' . $resetLink . '">' . $resetLink . '</a>';

        $mail->send();
        $_SESSION['notification'] = "A password reset link has been sent to your email address.";
    } catch (Exception $e) {
        $_SESSION['notification'] = "Error sending email. Please try again later.";
    }

    header("Location: login.php");
    exit();
}

<?php
// Show errors for debugging (disable in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

// Create PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Get form data
    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? 'Website Contact';
    $phone   = $_POST['Phone'] ?? '';
    $message = $_POST['message'] ?? '';

    // Validate essential fields
    if (empty($email) || empty($message)) {
        throw new Exception("Email and message are required.");
    }

    // SMTP Configuration for Zoho
    $mail->isSMTP();
    $mail->Host       = 'smtp.zoho.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'hamza@chawlatravels.pk';       // Your Zoho email
    $mail->Password   = 'YOUR_APP_PASSWORD';            // 🔁 REPLACE this with actual Zoho app password
    $mail->SMTPSecure = 'ssl';                          // Use 'tls' if using port 587
    $mail->Port       = 465;                            // Or 587 for TLS

    // Email metadata
    $mail->setFrom('hamza@chawlatravels.pk', 'Chawla Travels');
    $mail->addAddress('hamza@chawlatravels.pk');        // Receiver (your own inbox)
    $mail->addReplyTo($email, $name);                   // User's email for reply

    // Email content
    $mail->isHTML(false);
    $mail->Subject = "New message from website: $subject";
    $mail->Body    = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";

    // Send the mail
    $mail->send();

    // Redirect to thank-you page
    header('Location: thankyou.html');
    exit();
} catch (Exception $e) {
    echo "<h3 style='color:red;'>Mail Error: " . $mail->ErrorInfo . "</h3>";
    file_put_contents('mail_error_log.txt', date('Y-m-d H:i:s') . " - Error: " . $mail->ErrorInfo . "\n", FILE_APPEND);
}
?>

<?php
// Display errors (for debugging — disable on live server)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer files
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

// Create PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Collect form data safely
    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? 'Website Contact';
    $phone   = $_POST['Phone'] ?? '';
    $message = $_POST['message'] ?? '';

    // Validate required fields
    if (empty($email) || empty($message)) {
        throw new Exception("Email and message are required.");
    }

    // SMTP Configuration (Zoho)
    $mail->isSMTP();
    $mail->Host       = 'smtp.zoho.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'hamza@chawlatravels.pk';       // Your Zoho email
    $mail->Password   = 'YOUR_APP_PASSWORD';            // Replace with your app password
    $mail->SMTPSecure = 'ssl';                          // Use 'tls' if you use port 587
    $mail->Port       = 465;                            // Or 587 if using TLS

    // Email headers
    $mail->setFrom('hamza@chawlatravels.pk', 'Chawla Travels Contact Form');
    $mail->addAddress('hamza@chawlatravels.pk');        // Recipient address (can add more)
    $mail->addReplyTo($email, $name);                   // So you can reply to user directly

    // Content
    $mail->isHTML(false);
    $mail->Subject = "New message from website: $subject";
    $mail->Body    =
        "Name: $name\n" .
        "Email: $email\n" .
        "Phone: $phone\n\n" .
        "Message:\n$message";

    // Send email
    $mail->send();

    // Redirect on success
    header('Location: thankyou.html');
    exit();
} catch (Exception $e) {
    // Show error message
    echo "<h3 style='color:red;'>Mail Error: {$mail->ErrorInfo}</h3>";
    // Optional: log to file
    file_put_contents('mail_error_log.txt', date('Y-m-d H:i:s') . " - Error: {$mail->ErrorInfo}\n", FILE_APPEND);
}
?>

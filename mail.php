<?php
// Disable error reporting on live
error_reporting(0);
ini_set('display_errors', 0);

// Get data from form
$name    = isset($_POST['name']) ? trim($_POST['name']) : '';
$email   = isset($_POST['email']) ? trim($_POST['email']) : '';
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$phone   = isset($_POST['Phone']) ? trim($_POST['Phone']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

if (!empty($email)) {
    $to = "roshaan@suretrust.com.pk"; // ✅ make sure this is correct
    $email_subject = "Mail From Website: " . $subject;

    // Email body
    $txt = "Name: $name\r\n";
    $txt .= "Email: $email\r\n";
    $txt .= "Phone: $phone\r\n";
    $txt .= "Message:\r\n$message";

    // Headers
    $headers = "From: noreply@chawlatravels.pk\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send email
    mail($to, $email_subject, $txt, $headers);
}

// Redirect to thank you page
header("Location: thankyou.html");
exit();
?>

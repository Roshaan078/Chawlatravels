<?php
// Get data from form
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$phone = $_POST['Phone'];
$message = $_POST['message'];

$to = "roshaan@suretrust.com.pk"; // ✅ fixed double .com
$email_subject = "Mail From Website: " . $subject;

// Email body text
$txt = "Name: $name\r\n";
$txt .= "Email: $email\r\n";
$txt .= "Phone: $phone\r\n";
$txt .= "Message:\r\n$message";

// Email headers
$headers = "From: noreply@yoursite.com" . "\r\n" .
           "Reply-To: $email" . "\r\n" .
           "X-Mailer: PHP/" . phpversion();

// Send email only if email is not null
if (!empty($email)) {
    mail($to, $email_subject, $txt, $headers);
}

// Redirect after sending
header("Location: thankyou.html");
exit();
?>

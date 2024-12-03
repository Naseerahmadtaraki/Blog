<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Database connection settings
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'project';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth = true;
    $mail->Username = 'naseerwakman11@gmail.com'; // SMTP username
    $mail->Password = 'wtniejyphgruqhrv'; // SMTP App password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('demowebsite@gmail.com', 'Your Name');
    $mail->addAddress('khalilahmadtarakia@gmail.com'); // Add a recipient

    $mail->SMTPDebug = 2; // Set to 2 for verbose debugging
    $mail->Debugoutput = 'html'; // You can also use 'echo' to output the logs directly

    // Content
    $mail->isHTML(true);
    $mail->Subject = $_POST['subject'];
    $mail->Body    = '<strong>Name:</strong> ' . $_POST['name'] . '<br>' .
                     '<strong>Email:</strong> ' . $_POST['email'] . '<br>' .
                     '<strong>Message:</strong><br>' . nl2br($_POST['message']);

    // Send email
    $mail->send();

    // Save to database
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Prepare and bind statement to avoid SQL injection
    $stmt = $conn->prepare('INSERT INTO contact_form_submissions (name, email, subject, message, submitted_at) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('sssss', $_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'], $submitted_at);
    $submitted_at = date('Y-m-d H:i:s');
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Redirect after successful submission
    header("Location: index.php");
    exit();

} catch (Exception $e) {
    // Capture error and display message
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

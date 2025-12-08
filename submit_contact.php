<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php?status=error');
    exit;
}

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    header('Location: contact.php?status=error&msg=missing_fields');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: contact.php?status=error&msg=invalid_email');
    exit;
}

if (strlen($message) > MAX_MESSAGE_LENGTH) {
    header('Location: contact.php?status=error&msg=message_too_long');
    exit;
}

$your_email = ADMIN_EMAIL;
$timestamp = date('Y-m-d H:i:s');
$messageData = "
================================================================================
New Contact Form Submission
================================================================================
Date/Time: $timestamp
Name: $name
Email: $email
Subject: $subject

Message:
$message

================================================================================

";

$messagesFile = MESSAGES_FILE;
$fileSaved = false;

try {
    if (file_put_contents($messagesFile, $messageData, FILE_APPEND | LOCK_EX) !== false) {
        $fileSaved = true;
    }
} catch (Exception $e) {
    error_log("Failed to save message to file: " . $e->getMessage());
}

$emailSent = false;
$emailSubject = "New Contact Form: $subject";
$emailBody = "You have received a new message from your portfolio website.\n\n";
$emailBody .= "Name: $name\n";
$emailBody .= "Email: $email\n";
$emailBody .= "Subject: $subject\n";
$emailBody .= "Date/Time: $timestamp\n\n";
$emailBody .= "Message:\n";
$emailBody .= "----------------------------------------\n";
$emailBody .= "$message\n";
$emailBody .= "----------------------------------------\n\n";
$emailBody .= "You can reply directly to: $email\n";

$headers = array();
$headers[] = "From: " . SITE_NAME . " <" . FROM_EMAIL . ">";
$headers[] = "Reply-To: $name <$email>";
$headers[] = "X-Mailer: PHP/" . phpversion();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-Type: text/plain; charset=UTF-8";

if (ENABLE_EMAIL && mail($your_email, $emailSubject, $emailBody, implode("\r\n", $headers))) {
    $emailSent = true;
}

if ($fileSaved && $emailSent) {
    header('Location: contact.php?status=success');
} elseif ($fileSaved) {
    header('Location: contact.php?status=success&msg=email_pending');
} else {
    header('Location: contact.php?status=error&msg=save_failed');
}

exit;
?>

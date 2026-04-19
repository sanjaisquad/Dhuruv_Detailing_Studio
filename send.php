<?php
/**
 * Dhuruv Detailing Studio - Contact Form Backend
 * Required: PHPMailer (Place in 'PHPMailer' folder on your Hostinger server)
 */

session_start();
header('Content-Type: application/json');

// --- Basic Rate Limiting ---
// Prevent multiple submissions within 60 seconds
$timeNow = time();
if (isset($_SESSION['last_submit_time']) && ($timeNow - $_SESSION['last_submit_time']) < 60) {
    echo json_encode(["status" => "error", "message" => "Please wait a minute before sending another inquiry."]);
    exit;
}

// --- Honeypot Spam Protection ---
if (!empty($_POST['cf-bot'])) {
    // If the hidden field is filled out, it's likely a bot. Pretend it worked.
    echo json_encode(["status" => "success", "message" => "Message sent successfully!"]);
    exit;
}

// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
    exit;
}

// Ensure PHPMailer classes are available
// If installing PHPMailer manually (standard for Hostinger shared hosting):
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// --- Sanitize & Validate Input ---
$name = htmlspecialchars(strip_tags(trim($_POST['cf-name'] ?? '')));
$phone = htmlspecialchars(strip_tags(trim($_POST['cf-phone'] ?? '')));
$email = filter_var(trim($_POST['cf-email'] ?? ''), FILTER_SANITIZE_EMAIL);
$car = htmlspecialchars(strip_tags(trim($_POST['cf-car'] ?? 'Not provided')));
$service = htmlspecialchars(strip_tags(trim($_POST['cf-service'] ?? '')));
$message = htmlspecialchars(strip_tags(trim($_POST['cf-message'] ?? 'None')));

if (empty($name) || empty($phone) || empty($service)) {
    echo json_encode(["status" => "error", "message" => "Please fill in all required fields."]);
    exit;
}

if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "Invalid email address format."]);
    exit;
}

// --- Load Credentials ---
require_once 'config.php';

// --- SMTP Settings ---
$smtpHost     = SMTP_HOST;
$smtpUsername = SMTP_USER;
$smtpPassword = SMTP_PASS;
$smtpPort     = SMTP_PORT;
$smtpSecure   = PHPMailer::ENCRYPTION_SMTPS;

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUsername;
    $mail->Password = $smtpPassword;
    $mail->SMTPSecure = $smtpSecure;
    $mail->Port = $smtpPort;

    // --- 1. SEND EMAIL TO DHURUV TEAM ---
    $mail->setFrom($smtpUsername, 'Dhuruv Detailing Studio Website');
    $mail->addAddress('sales@dhuruvcaraccessories.in', 'Dhuruv Sales Team');
    if (!empty($email)) {
        $mail->addReplyTo($email, $name);
    }

    $mail->isHTML(true);
    $mail->Subject = 'New Inquiry - Dhuruv Detailing Studio';

    $adminBody = "
    <div style='font-family: Arial, sans-serif; color: #333; max-width: 600px; margin: 0 auto; border: 1px solid #ddd; border-radius: 8px; overflow: hidden;'>
        <div style='background-color: #0d0d0d; padding: 20px; text-align: center; border-bottom: 3px solid #ff4500;'>
            <h2 style='color: #fff; margin: 0;'>New Website Inquiry</h2>
        </div>
        <div style='padding: 20px;'>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Email:</strong> " . ($email ?: "Not provided") . "</p>
            <p><strong>Car Model:</strong> {$car}</p>
            <p><strong>Service Requested:</strong> {$service}</p>
            <p><strong>Message:</strong></p>
            <blockquote style='background: #f9f9f9; border-left: 4px solid #ff4500; padding: 10px; margin: 10px 0;'>{$message}</blockquote>
            <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
            <p style='font-size: 12px; color: #888;'>Date: " . date("Y-m-d H:i:s") . "<br>IP Address: " . $_SERVER['REMOTE_ADDR'] . "</p>
        </div>
    </div>";

    $mail->Body = $adminBody;
    $mail->send();

    // --- 2. SEND AUTO-REPLY TO CUSTOMER (IF EMAIL PROVIDED) ---
    if (!empty($email)) {
        $mail->clearAddresses();
        $mail->clearReplyTos();

        $mail->addAddress($email, $name);
        $mail->Subject = 'We received your inquiry - Dhuruv Detailing Studio';

        $userBody = "
        <div style='font-family: Arial, sans-serif; color: #333; max-width: 600px; margin: 0 auto; border: 1px solid #ddd; border-radius: 8px; overflow: hidden;'>
            <div style='background-color: #0d0d0d; padding: 20px; text-align: center; border-bottom: 3px solid #ff4500;'>
                <img src='https://dhuruvcaraccessories.in/images/logo.jpg' alt='Dhuruv Detailing Studio' style='max-height: 60px;'>
            </div>
            <div style='padding: 30px 20px;'>
                <h3 style='color: #0d0d0d; margin-top: 0;'>Hello {$name},</h3>
                <p>Thank you for reaching out to <strong>Dhuruv Detailing Studio</strong>!</p>
                <p>We have successfully received your inquiry regarding <strong>{$service}</strong>. Our detailing experts are reviewing your request and will get back to you shortly at <strong>{$phone}</strong> to discuss your car and provide a quote.</p>
                <p>In the meantime, feel free to browse our <a href='https://dhuruvcaraccessories.in/gallery.php' style='color: #ff4500; text-decoration: none;'>recent work gallery</a>.</p>
                <br>
                <p>Best Regards,<br><strong>The Dhuruv Team</strong></p>
            </div>
            <div style='background-color: #f4f4f4; padding: 15px; text-align: center; font-size: 12px; color: #666;'>
                No.56A, Tharamani 100 ft Road, Velachery Link Road, Chennai<br>
                Call us: +91 97908 06404
            </div>
        </div>";

        $mail->Body = $userBody;
        try {
            $mail->send();
        } catch (Exception $e) {
            error_log("Auto-reply failed: {$mail->ErrorInfo}");
        }
    }

    // Success! Update session to rate-limit
    $_SESSION['last_submit_time'] = $timeNow;

    echo json_encode(["status" => "success", "message" => "Inquiry sent successfully!"]);

} catch (Exception $e) {
    error_log("Mailer Error: {$mail->ErrorInfo}");
    echo json_encode(["status" => "error", "message" => "Sorry, our email server is currently unavailable. Please try WhatsApp."]);
}
?>
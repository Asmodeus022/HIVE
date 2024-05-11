<?php
session_start();
// Establish database connection
require_once('database.php');
// Include required PHPMailer files
use PHPMailer\PHPMailer\PHPMailer;
require 'phpmailer/includes/PHPMailer.php';
require 'phpmailer/includes/SMTP.php';
require 'phpmailer/includes/Exception.php';

// Function to generate OTP
function generateOTP()
{
    return rand(100000, 999999);
}

// Function to send email using PHPMailer
function sendEmail($recipient, $subject, $message)
{
    // Create instance of PHPMailer
    $mail = new PHPMailer();

    // Set mailer to use SMTP
    $mail->isSMTP();

    // Define SMTP host
    $mail->Host = "smtp.gmail.com";

    // Enable SMTP authentication
    $mail->SMTPAuth = true;

    // Set SMTP encryption type (ssl/tls)
    $mail->SMTPSecure = "tls";

    // Port to connect SMTP
    $mail->Port = "587";

    // Set Gmail username
    $mail->Username = "hive.inquiry@gmail.com";

    // Set Gmail password
    $mail->Password = "ocmayppfisgztnds";

    //Attachment
	$mail->addAttachment('img/hivelogo.png');

    // Email subject
    $mail->Subject = $subject;

    // Set sender email
    $mail->setFrom('hive.inquiry@gmail.com');

    // Enable HTML
    $mail->isHTML(true);

    // Email body
    $mail->Body = $message;

    // Add recipient
    $mail->addAddress($recipient);

    // Finally send email
    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $email = $_POST["email"];
    $_SESSION['email'] = $email;

    // Generate OTP
    $otp = generateOTP();

    // Save OTP in the database
    $sql = "UPDATE managers SET OTP = $otp WHERE email = '$email'";
    mysqli_query($conn, $sql);

    // Send OTP via email using PHPMailer
    $subject = "OTP Verification";
    $message = "Your OTP for verification is: $otp";
    $success = sendEmail($email, $subject, $message);

    if ($success) {
        // Redirect to OTP verification page
        echo "<script>alert('The OTP has been sent successfully')</script>";
        header("Location: ../page/code_verification_page.php");
        exit;
    } else {
        echo "Failed to send OTP. Please try again.";
    }
}

mysqli_close($conn);
// Closing SMTP connection
$mail->smtpClose();
?>
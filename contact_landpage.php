<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the PHPMailer files
require './vendor/phpmailer/phpmailer/src/Exception.php';
require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './vendor/phpmailer/phpmailer/src/SMTP.php';


// Define recipient (doctor's) email admin email hnaya
$adminEmail = 'docmeetplatform@gmail.com';;



// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];



// Create a new PHPMailer instance
$mail = new PHPMailer;


// Set PHPMailer to use SMTP
$mail->isSMTP();


// Specify the SMTP host
$mail->Host = 'smtp.gmail.com';


// Enable SMTP authentication
$mail->SMTPAuth = true;


// SMTP username and password
$mail->Username = 'docmeetplatform@gmail.com';
$mail->Password = 'xlhvhfogitpmagsv';


// Enable TLS encryption
$mail->SMTPSecure = 'tls';


// Specify the SMTP port
$mail->Port = 587;


// Set the email subject
$mail->Subject = "New message from " . $name;


// Set the email body
$mail->Body = "Name: $name\nEmail: $email\n\n$message";


// Set who the message is to be sent from
$mail->setFrom($email, $name);


// Set who the message is to be sent to
$mail->addAddress($adminEmail);


// Send the email
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>


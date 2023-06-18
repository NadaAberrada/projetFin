<?php

//PHPMailer classes (Exception, PHPMailer, and SMTP) are available for use.
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
//use the methods and properties 
$mail = new PHPMailer;

//SMTP is responsible for the transmission and delivery of email messages over the internet.
// Set PHPMailer to use SMTP
$mail->isSMTP();


// Specify the SMTP host
// IP address of the SMTP server that you want to use for sending emails
$mail->Host = 'smtp.gmail.com';


// Enable SMTP authentication
// PHPMailer will authenticate with the SMTP server using the provided credentials (username and password) before sending the email.
$mail->SMTPAuth = true;


// SMTP username and password
//sender
$mail->Username = 'docmeetplatform@gmail.com';
$mail->Password = 'xlhvhfogitpmagsv';


// Enable TLS encryption
//In this case, it is set to 'tls', which stands for Transport Layer Security. TLS is a protocol that provides secure 
//communication over the internet. By using TLS encryption, the data transmitted between the PHPMailer instance and the 
//SMTP server will be encrypted, enhancing the security of the email communication.

$mail->SMTPSecure = 'tls';


// Specify the SMTP port
//the port number
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


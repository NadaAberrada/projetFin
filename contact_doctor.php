<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the PHPMailer files
require './vendor/phpmailer/phpmailer/src/Exception.php';
require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './vendor/phpmailer/phpmailer/src/SMTP.php';

// Connect to the database
try {
    $pdo = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$doctorId = $_POST['doctorId'];

// Fetch doctor's email from the database
$stmt = $pdo->prepare("SELECT emailD FROM doctors WHERE doctorId = :id");
$stmt->execute([':id' => $doctorId]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Define recipient (doctor's) email
$doctorEmail = $result['emailD'];

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Create a new PHPMailer instance
$mail = new PHPMailer;

// Set PHPMailer to use SMTP
$mail->isSMTP();

// Specify the SMTP host
$mail->Host = 'smtp-relay.sendinblue.com';  // replace with your SMTP server

// Enable SMTP authentication
$mail->SMTPAuth = true;

// SMTP username and password
$mail->Username = 'aberrada.nada.solicode@gmail.com';  // replace with your SMTP username
$mail->Password = 'T3JfWdPknEcMgA16';  // replace with your SMTP password

// Enable TLS encryption
$mail->SMTPSecure = 'tls';

// Specify the SMTP port
$mail->Port = 587;  // replace with your SMTP port

// Set the email subject
$mail->Subject = "New message from " . $name;

// Set the email body
$mail->Body = "Name: $name\nEmail: $email\n\n$message";

// Set who the message is to be sent from
$mail->setFrom($email, $name);

// Set who the message is to be sent to
$mail->addAddress($doctorEmail);

// Send the email
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>

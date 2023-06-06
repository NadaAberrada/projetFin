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
    echo "Connected to database successfully.<br>";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$doctorId = $_POST['doctorId'];

// Fetch doctor's email from the database
$stmt = $pdo->prepare("SELECT emailD FROM doctors WHERE doctorId = :id");
$stmt->execute([':id' => $doctorId]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    die("No doctor found with ID: " . $doctorId);
}

// Define recipient (doctor's) email
$doctorEmail = $result['emailD'];

echo "Doctor's email: " . $doctorEmail . "<br>";

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

echo "Form data retrieved successfully.<br>";

// Create a new PHPMailer instance
$mail = new PHPMailer;
echo "PHPMailer instance created.<br>";

// Set PHPMailer to use SMTP
$mail->isSMTP();
echo "SMTP set.<br>";

// Specify the SMTP host
$mail->Host = 'smtp.gmail.com';
echo "SMTP host set.<br>";

// Enable SMTP authentication
$mail->SMTPAuth = true;
echo "SMTP authentication enabled.<br>";

// SMTP username and password
$mail->Username = 'aberrada.nada.solicode@gmail.com';
$mail->Password = 'nwsitixpgfiwlity';
echo "SMTP username and password set.<br>";

// Enable TLS encryption
$mail->SMTPSecure = 'tls';
echo "TLS encryption enabled.<br>";

// Specify the SMTP port
$mail->Port = 587;
echo "SMTP port set.<br>";

// Set the email subject
$mail->Subject = "New message from " . $name;
echo "Email subject set.<br>";

// Set the email body
$mail->Body = "Name: $name\nEmail: $email\n\n$message";
echo "Email body set.<br>";

// Set who the message is to be sent from
$mail->setFrom($email, $name);
echo "Sender set.<br>";

// Set who the message is to be sent to
$mail->addAddress($doctorEmail);
echo "Recipient set.<br>";

// Send the email
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>

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

if (!$result) {
    die("No doctor found with ID: " . $doctorId);
}

// Define recipient (doctor's) email
$doctorEmail = $result['emailD'];

// Define your name and email
$name = 'Doc meet'; // replace with your name
$email = 'aberrada.nada.solicode@gmail.com'; // replace with your email

// Define the email content
$subject = "Confirmation notice";
$message = "Dear Doctor, \n\nThis is a confirmation notice regarding..."; // replace with your message

// Create a new PHPMailer instance
$mail = new PHPMailer;

// Set PHPMailer to use SMTP
$mail->isSMTP();

// Specify the SMTP host
$mail->Host = 'smtp.gmail.com';

// Enable SMTP authentication
$mail->SMTPAuth = true;

// SMTP username and password
$mail->Username = 'aberrada.nada.solicode@gmail.com';
$mail->Password = 'nwsitixpgfiwlity';

// Enable TLS encryption
$mail->SMTPSecure = 'tls';

// Specify the SMTP port
$mail->Port = 587;

// Set the email subject
$mail->Subject = $subject;

// Set the email body
$mail->Body = $message;

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

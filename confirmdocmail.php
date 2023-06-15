<!-- <?php
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
$subject = "Notification de confirmation";
$message = "
    <html>
    <head>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet' />

        <style>
            .email-content {
              
                margin: 0 auto;
                padding: 20px;
                background-color: #f6f6f6;
                max-width: 600px;
                border-radius: 5px;
            }
            .email-content h1 {
                color: #333;
            }
            .email-content p {
                color: #666;
            }
            .btn {
                display: inline-block;
                background-color: #a61057;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <div class='email-content'>
            <h1>Cher Docteur,</h1>
            <p>Nous vous remercions de votre inscription en tant que médecin sur notre plateforme. Nous avons bien reçu et confirmé vos informations.</br> Pour accéder à votre profil et commencer à fournir des services, veuillez vous connecter en utilisant les informations de votre compte.</p>
         <a href='http://localhost:88/projetFin/ConnexionM%c3%a9dcine.php' class='btn'>Connexion</a>
        </div>
    </body>
    </html>";




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
?> -->

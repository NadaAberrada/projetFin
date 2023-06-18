<?php
session_start(); // Start the session if it's not already started

// Check if patientID is set in session
if(isset($_SESSION['patientID'])) {
    $patientID = $_SESSION['patientID']; // Assign it to $patientID variable
    error_log("Patient ID found in session: $patientID");
} else {
    error_log('Patient ID not set in session');
    die('Patient ID not set in session'); // Or handle this situation as needed
}

if(isset($_GET['patientID'])) {
    $patienrId = $_GET['patientID'];
    error_log("Doctor ID from GET request: $patienrId");
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT imageP, gender,nameP,lastnameP FROM patients WHERE patientID = :id");
      

        $stmt->execute([':id' => $patienrId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // $_SESSION['patientName'] = $result['nameP']."".$result['lastnameP'];
        if($result['imageP']) {
            error_log("Image found for patient: $patienrId");
            header("Content-Type: image/jpeg");
          

            echo $result['imageP'];
            exit;
        } else {
            error_log("No image found for patient: $patienrId");
        }
    } catch (PDOException $e) {
        error_log("Connection failed: " . $e->getMessage());
        die("Connection failed: " . $e->getMessage());
    }
} else {
    error_log("No patientID provided in GET request");
}

// If no image or unable to connect to database, show default image
$gender = $result['gender'] ?? 'Femme'; // Default to female if gender is not set
error_log("Gender from database result or default: $gender");
$image = $gender === 'Homme' ? './img/defaultHomme.jpg' : './img/defaultFemme.jpg';
error_log("Image file path: $image");
header("Content-Type: image/png");
readfile($image);
?>
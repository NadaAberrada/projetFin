<?php

ob_start(); 
session_start();

$db = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
$patientId = $_SESSION['patientID'];
$query = $db->prepare('SELECT enregDocteur FROM patients WHERE patientID = ?');
$query->execute([$patientId]);
$result = $query->fetch(PDO::FETCH_ASSOC);

// Get the doctor IDs
$doctorIds = isset($result['enregDocteur']) ? json_decode($result['enregDocteur'], true) : [];

// Prepare an array to hold the doctor details
$doctors = [];

// Fetch the details of each doctor
foreach($doctorIds as $doctorId) {
    $query = $db->prepare('SELECT * FROM doctors WHERE doctorID = ?');
    $query->execute([$doctorId]);
    $doctor = $query->fetch(PDO::FETCH_ASSOC);

    if ($doctor) {
        // Apply mb_convert_encoding to each string field in $doctor
        foreach ($doctor as $key => $value) {
            if (is_string($value)) {
                $doctor[$key] = mb_convert_encoding($value, 'UTF-8', 'auto');
            }
        }
       
    if ($doctor) {
        // Convert the image data to base64
        if ($doctor['imageD']) {
            $imageData = base64_encode($doctor['imageD']);
            $doctor['imageD'] = $imageData;
        }}
        
        $doctors[] = $doctor;
    }
}

// Return the doctors array as a JSON string
$json = json_encode($doctors);
if($json) {
    ob_end_clean(); 
    echo $json;
} else {
    echo 'json_encode failed: ' . json_last_error_msg();
}

?>

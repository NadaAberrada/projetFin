<?php
session_start();

// Make sure to sanitize the input to prevent SQL injection
$doctorId = intval($_POST['id']);

// Connect to your database. Replace the following with your actual database connection details
$conn = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');

// Fetch patientID from the session
$patientID = $_SESSION['patientID'];

// Check if the doctor ID is already saved for the patient
$query = $conn->prepare('SELECT enregDocteur FROM patients WHERE patientID = ?');
$query->execute([$patientID]);
$result = $query->fetch(PDO::FETCH_ASSOC);

// Now we need to decode the JSON array from the database
$savedDoctors = isset($result['enregDocteur']) ? json_decode($result['enregDocteur'], true) : [];

if ($savedDoctors !== null && in_array($doctorId, $savedDoctors)) {
    // Doctor ID already exists, no need to save again
    echo 'Doctor with ID ' . $doctorId . ' is already saved.';
} else {
    // Add the new doctor id to the array
    $savedDoctors[] = $doctorId;

    // Now we need to encode the array back to JSON and save it in the database
    $jsonSavedDoctors = json_encode($savedDoctors);
    $query = $conn->prepare('UPDATE patients SET enregDocteur = ? WHERE patientID = ?');
    $query->execute([$jsonSavedDoctors, $patientID]);

    // Send a response back to the JavaScript
    echo 'Saved doctor with ID ' . $doctorId;
}

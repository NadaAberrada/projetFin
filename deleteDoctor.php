<?php
session_start();

// Make sure to sanitize the input to prevent SQL injection
$doctorID = intval($_POST['doctorID']);

// Connect to your database. Replace the following with your actual database connection details
$db = new PDO('mysql:host=localhost;dbname=docmeet;charset=utf8', 'root', '');

// Check if the doctor ID is saved for the user
$userId = $patientId = $_SESSION['patientID'];
$query = $db->prepare('SELECT enregDocteur FROM patients WHERE patientID = ?');
$query->execute([$patientId]);
$result = $query->fetch(PDO::FETCH_ASSOC);


// Now we need to decode the JSON array from the database
$doctors = isset($result['enregDocteur']) ? json_decode($result['enregDocteur'], true) : [];

if ($doctors !== null && in_array($doctorID, $doctors)) {
  // Doctor ID exists, remove it from the array
  $updatedDoctors = array_diff($doctors, [$doctorID]);

  // Now we need to reindex the array to ensure it starts from 0
  $updatedDoctors = array_values($updatedDoctors);

  // Now we need to encode the updated array back to JSON and save it in the database
  $jsonDoctors = json_encode($updatedDoctors);
  $query = $db->prepare('UPDATE patients SET enregDocteur = ? WHERE patientID = ?');
  $query->execute([$jsonDoctors, $patientId]);

  // Send a response back to the JavaScript
  echo 'Deleted doctor with ID ' . $doctorID;
} else {
  // Doctor ID not found in the saved doctors
  echo 'Doctor with ID ' . $doctorID . ' is not saved.';
}
?>

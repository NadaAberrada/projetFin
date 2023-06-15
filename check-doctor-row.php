<?php
// Assuming you have established the database connection
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
$doctorId = $_SESSION['DoctorID'];

$sql = "SELECT COUNT(*) AS count FROM time WHERE doctor_id = :doctorId";
$stmt = $pdo->prepare($sql);
$stmt->execute([':doctorId' => $doctorId]);
$rowCount = $stmt->fetchColumn();

if ($rowCount > 0) {
  echo "exists";
} else {
  echo "not_exists";
}
?>

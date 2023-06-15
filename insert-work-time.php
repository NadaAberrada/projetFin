<?php
// Assuming you have established the database connection
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $doctorId = $_SESSION['DoctorID'];
  $mondayStart = $_POST['monday_start'];
  $mondayEnd = $_POST['monday_end'];
  $tuesdayStart = $_POST['tuesday_start'];
  $tuesdayEnd = $_POST['tuesday_end'];
  $wednesdayStart = $_POST['wednesday_start'];
  $wednesdayEnd = $_POST['wednesday_end'];
  $thursdayStart = $_POST['thursday_start'];
  $thursdayEnd = $_POST['thursday_end'];
  $fridayStart = $_POST['friday_start'];
  $fridayEnd = $_POST['friday_end'];
  $saturdayStart = $_POST['saturday_start'];
  $saturdayEnd = $_POST['saturday_end'];

  $sql = "INSERT INTO time (doctor_id, monday_start, monday_end, tuesday_start, tuesday_end, 
            wednesday_start, wednesday_end, thursday_start, thursday_end, friday_start, friday_end, 
            saturday_start, saturday_end) 
            VALUES (:doctorId, :mondayStart, :mondayEnd, :tuesdayStart, :tuesdayEnd, :wednesdayStart, 
            :wednesdayEnd, :thursdayStart, :thursdayEnd, :fridayStart, :fridayEnd, :saturdayStart, 
            :saturdayEnd)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    ':doctorId' => $doctorId,
    ':mondayStart' => $mondayStart,
    ':mondayEnd' => $mondayEnd,
    ':tuesdayStart' => $tuesdayStart,
    ':tuesdayEnd' => $tuesdayEnd,
    ':wednesdayStart' => $wednesdayStart,
    ':wednesdayEnd' => $wednesdayEnd,
    ':thursdayStart' => $thursdayStart,
    ':thursdayEnd' => $thursdayEnd,
    ':fridayStart' => $fridayStart,
    ':fridayEnd' => $fridayEnd,
    ':saturdayStart' => $saturdayStart,
    ':saturdayEnd' => $saturdayEnd,
  ]);

  if ($stmt->rowCount() > 0) {
    echo "Work time saved successfully.";
  } else {
    echo "Failed to save work time.";
  }
}
?>

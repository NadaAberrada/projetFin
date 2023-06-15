<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');

$doctorId = $_SESSION['DoctorID'];

// Prepared statement to update work times
$sql = "UPDATE time 
        SET monday_start = :monday_start, monday_end = :monday_end,
            tuesday_start = :tuesday_start, tuesday_end = :tuesday_end,
            wednesday_start = :wednesday_start, wednesday_end = :wednesday_end,
            thursday_start = :thursday_start, thursday_end = :thursday_end,
            friday_start = :friday_start, friday_end = :friday_end,
            saturday_start = :saturday_start, saturday_end = :saturday_end
        WHERE doctor_id = :doctorId";

$stmt = $pdo->prepare($sql);

$params = [
    ':monday_start' => $_POST['monday_start'],
    ':monday_end' => $_POST['monday_end'],
    ':tuesday_start' => $_POST['tuesday_start'],
    ':tuesday_end' => $_POST['tuesday_end'],
    ':wednesday_start' => $_POST['wednesday_start'],
    ':wednesday_end' => $_POST['wednesday_end'],
    ':thursday_start' => $_POST['thursday_start'],
    ':thursday_end' => $_POST['thursday_end'],
    ':friday_start' => $_POST['friday_start'],
    ':friday_end' => $_POST['friday_end'],
    ':saturday_start' => $_POST['saturday_start'],
    ':saturday_end' => $_POST['saturday_end'],
    ':doctorId' => $doctorId
];

if ($stmt->execute($params)) {
    echo "success";
} else {
    echo "failure";
}
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "docmeet";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $doctorId = $_GET['doctor_id'];  // Assuming you're passing the doctor's ID as a GET parameter

    $stmt = $conn->prepare("SELECT * FROM time WHERE doctor_id = :doctor_id");
    $stmt->bindParam(':doctor_id', $doctorId);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $workTimes = $stmt->fetchAll();

    if(count($workTimes) > 0) {
        $workTime = $workTimes[0]; // get the first result
        echo "monday_start=".$workTime["monday_start"]."&monday_end=".$workTime["monday_end"]."&tuesday_start=".$workTime["tuesday_start"]."&tuesday_end=".$workTime["tuesday_end"]."&wednesday_start=".$workTime["wednesday_start"]."&wednesday_end=".$workTime["wednesday_end"]."&thursday_start=".$workTime["thursday_start"]."&thursday_end=".$workTime["thursday_end"]."&friday_start=".$workTime["friday_start"]."&friday_end=".$workTime["friday_end"]."&saturday_start=".$workTime["saturday_start"]."&saturday_end=".$workTime["saturday_end"];
    } else {
        echo "No results";
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

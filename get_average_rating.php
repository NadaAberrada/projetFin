<?php
// Establish a new PDO connection to the MySQL database
try {
    $pdo = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if the doctorId is set in the POST data
if (isset($_POST['doctorId'])) {
    $doctorId = $_POST['doctorId'];

    // Prepare the SQL statement and bind the doctorId parameter
    $stmt = $pdo->prepare("SELECT AVG(rating) as average_rating FROM ratings WHERE doctor_id = :doctorId");
    $stmt->bindParam(':doctorId', $doctorId, PDO::PARAM_INT);

    // Execute the SQL statement
    $stmt->execute();

    // Fetch the result and get the average_rating column
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $average_rating = round($result['average_rating'], 1);

    // Echo the average rating
    echo $average_rating;
} else {
    echo "No doctor ID provided.";
}
?>

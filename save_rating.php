<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['rating']) && isset($_POST['doctorId']) && isset($_POST['userId'])) {
        $rating = (double)$_POST['rating'];
        $doctorId = $_POST['doctorId'];
        $userId = $_POST['userId'];

        // Connect to your database
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

        // Check if user has already submitted a rating
        $stmt = $pdo->prepare("SELECT * FROM ratings WHERE doctor_id = :doctorId AND user_id = :userId");
        $stmt->execute([':doctorId' => $doctorId, ':userId' => $userId]);
        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            echo 'You have already rated this doctor.';
            exit();
        }

        // Save rating into your database
        $stmt = $pdo->prepare("INSERT INTO ratings (doctor_id, user_id, rating) VALUES (:doctorId, :userId, :rating)");
        $stmt->execute([':doctorId' => $doctorId, ':userId' => $userId, ':rating' => $rating]);

        echo 'Rating saved successfully.';
    } else {
        echo 'Invalid data.';
    }
} else {
    echo 'Invalid request method.';
}
?>

<?php
session_start();
try {
    $pdo = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['patientID'])) {
        throw new Exception('No session patientID');
    }

    $patientID = $_SESSION['patientID'];
    $name = $_POST['name'] ?? null;
    $lastname = $_POST['lastname'] ?? null;
    $email = $_POST['email'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $citynameP = $_POST['citynameP'] ?? null;

    if (!$name || !$lastname || !$email || !$phone || !$citynameDP) {
        throw new Exception('Missing post data');
    }

    $image = null;
    if (isset($_FILES['profile_img']) && $_FILES['profile_img']['tmp_name']) {
        // Get image data from file
        $image = file_get_contents($_FILES['profile_img']['tmp_name']);
    }

    $sql = "UPDATE patients SET nameP = ?, lastnameP = ?, emailP = ?, phoneP = ?, citynameP = ?, imageP = ? WHERE patientID = ?";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $lastname, $email, $phone, $citynameP, $image, $patientID]);
    
        echo "Profile updated successfully";
    } catch(PDOException $e) {
        echo "Error updating profile: " . $e->getMessage();
    }
    
}
?>

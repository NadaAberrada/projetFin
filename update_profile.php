<?php
session_start();
try {
    $pdo = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $DoctorId = $_SESSION['DoctorID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $citynameD = $_POST['citynameD'];
    $websiteLink = $_POST['websiteLink'];
    $description = $_POST['description'];
    $localisation = $_POST['localisation'];

    $sql = "UPDATE doctors SET fullname = ?, emailD = ?, phoneD = ?, citynameD = ?, websiteLink = ?, description = ?, localisation = ? WHERE doctorID = ?";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $phone, $citynameD, $websiteLink, $description, $localisation, $DoctorId]); 

        echo "Profile updated successfully";
    } catch(PDOException $e) {
        echo "Error updating profile: " . $e->getMessage();
    }
}
?>

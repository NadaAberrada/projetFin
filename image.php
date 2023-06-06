<?php
if(isset($_GET['doctorId'])) {
    $doctorId = $_GET['doctorId'];
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT imageD, gender FROM doctors WHERE doctorId = :id");
        $stmt->execute([':id' => $doctorId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result['imageD']) {
            header("Content-Type: image/jpeg");
            echo $result['imageD'];
            exit;
        } 
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

// If no image or unable to connect to database, show default image
$gender = $result['gender'] ?? 'Femme'; // Default to female if gender is not set
$image = $gender === 'Homme' ? './img/defaultHomme.jpg' : './img/defaultFemme.jpg';
header("Content-Type: image/png");
readfile($image);
?>
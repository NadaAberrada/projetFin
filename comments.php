<?php
session_start();

include_once("db_connect.php");

// Step 1: Check Database Connection
if (!$conn) {
    die("Connection failed: " . $conn->errorInfo());
}

$patientID = $_SESSION['patientID'];
$doctorId = $_SESSION["iddoctor"];

$sender = $_SESSION['commentsenderID'];
$idPatient=$_SESSION["patientReply"];
if (!empty($_POST["comment"])) {

    $parent_id = $_POST["commentId"];
    $comment = $_POST["comment"];

    // Step 4: Check Input Values
    // Uncomment the following lines to inspect the values
    // var_dump($parent_id, $comment, $idPatient, $senderID, $writer);

    if ($parent_id == 0) {
        $writer = "1";

        $patientQuery = "SELECT patientID FROM patients WHERE patientID = :patientID";
        $patientStatement = $conn->prepare($patientQuery);
        $patientStatement->execute(['patientID' => $patientID]);
        $patient = $patientStatement->fetch(PDO::FETCH_ASSOC);
        if ($patient) {
            $senderID = $patient['patientID'];
        }
        $insertComments = "INSERT INTO commentaire (parent_id, comment, patientID, doctorID, writer) VALUES (:parent_id, :comment, :sender, :doctorid, :writer)";
        $stmt = $conn->prepare($insertComments);
        $stmt->bindParam(':parent_id', $parent_id);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':sender', $senderID);
        $stmt->bindParam(':doctorid', $doctorId);
        $stmt->bindParam(':writer', $writer);
    } else {
        if ($sender == "patient") {
            $writer = "1";

            $patientQuery = "SELECT patientID FROM patients WHERE patientID = :patientID";
            $patientStatement = $conn->prepare($patientQuery);
            $patientStatement->execute(['patientID' => $patientID]);
            $patient = $patientStatement->fetch(PDO::FETCH_ASSOC);
            if ($patient) {
                $senderID = $patient['patientID'];
            }
            $insertComments = "INSERT INTO commentaire (parent_id, comment, patientID,doctorID,writer) VALUES (:parent_id, :comment, :sender,:doctorid,:writer)";
            $stmt = $conn->prepare($insertComments);
            $stmt->bindParam(':parent_id', $parent_id);
            $stmt->bindParam(':comment', $comment);
            $stmt->bindParam(':sender', $senderID);
            $stmt->bindParam(':doctorid', $doctorId);
            $stmt->bindParam(':writer', $writer);
        } 
    }

    // Step 2: Verify Query Execution
    try {
        $stmt->execute();
        $message = '<label class="text-success">Commentaire posté avec succès.</label>';
        $status = array(
            'error' => 0,
            'message' => $message
        );
        // echo "<script>window.location.href = './DoctorDash.php'</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        $message = '<label class="text-danger">Erreur : commentaire non publié.</label>';
        $status = array(
            'error' => 1,
            'message' => $message
        );
    }
} else {
    $message = '<label class="text-danger">Erreur : commentaire non publié.</label>';
    $status = array(
        'error' => 1,
        'message' => $message
    );
}

echo json_encode($status);

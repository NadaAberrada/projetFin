<?php
session_start();

include_once("db_connect.php");
$patientID =  $_SESSION['patientID'];
$doctorId =  $_SESSION["iddoctor"];
$sender = $_SESSION['commentsenderID'];

if (!empty($_POST["comment"])) {

    $parent_id = $_POST["commentId"];
    $comment = $_POST["comment"];
    // $sender = $_POST["name"];
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
           
           else{
            $writer="0";
        
            $doctorQuery = "SELECT nameP FROM doctors WHERE doctorID = :doctorID";
            $doctorStatement = $conn->prepare($doctorQuery);
            $doctorStatement->execute(['doctorID' => $comment['doctorID']]);
            $doctor = $doctorStatement->fetch(PDO::FETCH_ASSOC);
            if ($doctor) {
                $senderID  = $doctor['doctorID'];
            }
    
            if (isset($_POST['idPatient'])) {
                $idPatient = $_POST['idPatient'];
    
            }
    
    
           
            $insertComments = "INSERT INTO comment (parent_id, comment, patientID,doctorID,writer) VALUES (:parent_id, :comment, :idpatient,:sender,:writer)";
            $stmt = $conn->prepare($insertComments);
            $stmt->bindParam(':parent_id', $parent_id);
            $stmt->bindParam(':comment', $comment);
            $stmt->bindParam(':idpatient', $idPatient);
            $stmt->bindParam(':sender', $senderID);
            $stmt->bindParam(':writer', $writer);
    
           }
    }


    try {
        $stmt->execute();
        $message = '<label class="text-success">Comment posted Successfully.</label>';
        $status = array(
            'error' => 0,
            'message' => $message
        );
    } catch (PDOException $e) {
        $message = '<label class="text-danger">Error: Comment not posted.</label>';
        $status = array(
            'error' => 1,
            'message' => $message
        );
    }
} else {
    $message = '<label class="text-danger">Error: Comment not posted.</label>';
    $status = array(
        'error' => 1,
        'message' => $message
    );
}
echo json_encode($status);

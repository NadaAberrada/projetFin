<?php
session_start();



include_once("db_connect.php");
$doctorId =  $_SESSION["iddoctor"];


$commentQuery = "SELECT comID, parent_id, comment, patientID, doctorID, writer, date FROM commentaire WHERE parent_id = '0' AND doctorID=" . $doctorId . " ORDER BY comID DESC";
$commentsResult = $conn->query($commentQuery);
$commentHTML = '';

while ($comment = $commentsResult->fetch(PDO::FETCH_ASSOC)) {
    $senderName = 'Unknown';

    if ($comment['writer'] == 1) {
        $patientQuery = "SELECT * FROM patients WHERE patientID = :patientID";
        $patientStatement = $conn->prepare($patientQuery);
        $patientStatement->execute(['patientID' => $comment['patientID']]);
        $patient = $patientStatement->fetch(PDO::FETCH_ASSOC);
        if ($patient) {
            $idPatient = 'test';
            $senderName = $patient['nameP']." ". $patient['lastnameP'];
           $idPatient = $patient['patientID'];
           $_SESSION["patientReply"]=$idPatient;
        }
    } 
   

    $commentHTML .= '
    <div class="card" style="margin-top:20px; border:none; border-radius:15px; box-shadow:0 4px 8px 0 rgba(0,0,0,0.2); transition:0.3s;">
        <div class="card-header" style="background-color: #2f9ba6; color:white; border:none; border-top-left-radius:15px; border-top-right-radius:15px; padding:15px;">
            <span style="font-weight:bold; font-size:1.1em;">' . $senderName . '</span> <span style="font-size:0.9em; opacity:0.8;">' . $comment["date"] . '</span>
        </div>
        <div class="card-body" style="padding:15px; font-size:1.1em;">
            ' . $comment["comment"] . '
        </div>
        <div class="card-footer text-end" style="background-color: #f1f1f1; border:none; border-bottom-left-radius:15px; border-bottom-right-radius:15px; padding:15px;">
            <button type="submit" class="btn reply" id="' . $comment["comID"] . '" style="background-color: #a61057; border:none; color:white; padding:10px 20px; border-radius:20px;">Reponde</button>
        </div>
    </div>
';




    $commentHTML .= getCommentReply($conn, $comment["comID"]);
}

echo $commentHTML;
function getCommentReply($conn, $parentId = 0, $marginLeft = 0)
{
    try {

        $doctorId =  $_SESSION["iddoctor"];

        $commentHTML = '';
        $commentQuery = "SELECT comID, parent_id, comment, patientID, doctorID, writer,date FROM commentaire WHERE parent_id = '" . $parentId . "' AND doctorID='" . $doctorId . "'";
        $commentsResult = $conn->query($commentQuery);
        $commentsCount = $commentsResult->rowCount();



        if ($parentId == 0) {
            $marginLeft = 0;
        } else {
            $marginLeft = $marginLeft + 48;
        }

        if ($commentsCount > 0) {
            while ($comment = $commentsResult->fetch(PDO::FETCH_ASSOC)) {
                $senderName = 'Unknown';
                $idPatient = 'test';
                if ($comment['writer'] == 1) {
                    $patientQuery = "SELECT * FROM patients WHERE patientID = :patientID";
                    $patientStatement = $conn->prepare($patientQuery);
                    $patientStatement->execute(['patientID' => $comment['patientID']]);
                    $patient = $patientStatement->fetch(PDO::FETCH_ASSOC);
                    if ($patient) {

                        $senderName = $patient['nameP']." ". $patient['lastnameP'];
                      
                        $idPatient = $patient['patientID'];
                    }
                } elseif ($comment['writer'] == 0) {
                    $doctorQuery = "SELECT fullname FROM doctors WHERE doctorID = :doctorID";
                    $doctorStatement = $conn->prepare($doctorQuery);
                    $doctorStatement->execute(['doctorID' => $comment['doctorID']]);
                    $doctor = $doctorStatement->fetch(PDO::FETCH_ASSOC);
                    if ($doctor) {
                        $senderName = "Dr" ." ".$doctor['fullname'];
                    }
                }


                $commentHTML .= '
                <div class="card " style="margin-left:' . $marginLeft . 'px; margin-top:20px; border:none; border-radius:15px; box-shadow:0 4px 8px 0 rgba(0,0,0,0.2); transition:0.3s;">
                    <div class="card-header" style="background-color: #2f9ba6; color:white; border:none; border-top-left-radius:15px; border-top-right-radius:15px; padding:15px;">
                        <span style="font-weight:bold; font-size:1.1em;">' . $senderName . '</span> <span style="font-size:0.9em; opacity:0.8;">' . $comment["date"] . '</span>
                    </div>
                    <div class="card-body" style="padding:15px; font-size:1.1em;">' . $comment["comment"] . '</div>
                    <div class="card-footer text-end" style="background-color: #f1f1f1; border:none; border-bottom-left-radius:15px; border-bottom-right-radius:15px; padding:15px;">
                        <form action="comments.php" method="post">
                            <input type="hidden" name="idPatient" value="' . $idPatient . '">
                            <button type="button" class="btn reply" id="' . $comment["comID"] . '"style="background-color: #a61057; border:none; color:white; padding:10px 20px; border-radius:20px;">Reponde</button>
                        </form>
                    </div>
                </div>
            ';
            

                $commentHTML .= getCommentReply($conn, $comment["comID"], $marginLeft);
            }
        }

        return $commentHTML;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
        return '';
    }
}

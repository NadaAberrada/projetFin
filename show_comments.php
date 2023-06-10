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
            $senderName = $patient['nameP'];
            $idPatient = $patient['patientID'];
        }
    } elseif ($comment['writer'] == 0) {
        $doctorQuery = "SELECT fullname FROM doctors WHERE doctorID = :doctorID";
        $doctorStatement = $conn->prepare($doctorQuery);
        $doctorStatement->execute(['doctorID' => $comment['doctorID']]);
        $doctor = $doctorStatement->fetch(PDO::FETCH_ASSOC);
        if ($doctor) {
            $senderName = $doctor['fullname'];
        }
    }

    $commentHTML .= '

<div class="card" style="border: 1px solid #2f9ba6;margin-top:20px">
    <div class="card-header text-white" style="background-color: #2f9ba6; border: 1px solid #2f9ba6;">
        Par <b>' . $senderName . '</b> sur <i>' . $comment["date"] . '</i>
    </div>
    <div class="card-body">
    ' . $comment["comment"] . '
    </div>
    <div class="card-footer text-end">
    <form action="comment.php" method="post">
        <input type="hidden" name="idPatient" value="' . $idPatient . '">
        <button type="button" class="btn  reply" id="' . $comment["comID"] . '"style="background-color: #a61057; border: 1px solid #a61057; color:white">Reply</button></div>
        </form>
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

        echo "Number of comments fetched: $commentsCount\n";

        if ($parentId == 0) {
            $marginLeft = 0;
        } else {
            $marginLeft = $marginLeft + 48;
        }

        if ($commentsCount > 0) {
            while ($comment = $commentsResult->fetch(PDO::FETCH_ASSOC)) {
                $senderName = 'Unknown';
                if ($comment['writer'] == 1) {
                    $patientQuery = "SELECT * FROM patients WHERE patientID = :patientID";
                    $patientStatement = $conn->prepare($patientQuery);
                    $patientStatement->execute(['patientID' => $comment['patientID']]);
                    $patient = $patientStatement->fetch(PDO::FETCH_ASSOC);
                    if ($patient) {
                        $senderName = $patient['nameP'];
                        $idPatient = $patient['patientID'];
                    }
                } elseif ($comment['writer'] == 0) {
                    $doctorQuery = "SELECT fullname FROM doctors WHERE doctorID = :doctorID";
                    $doctorStatement = $conn->prepare($doctorQuery);
                    $doctorStatement->execute(['doctorID' => $comment['doctorID']]);
                    $doctor = $doctorStatement->fetch(PDO::FETCH_ASSOC);
                    if ($doctor) {
                        $senderName = $doctor['fullname'];
                    }
                }
                echo "Sender Name: $senderName\n";

                $commentHTML .= '
                <div class="card " style="margin-left:' . $marginLeft . 'px;border: 1px solid #2f9ba6;margin-top:20px;">
                <div class="card-header" style="background-color: #2f9ba6; border: 1px solid #2f9ba6; color:white">Par <b>' . $senderName . '</b> sur <i>' . $comment["date"] . '</i></div>
                <div class="card-body">' . $comment["comment"] . '</div>
                <div class="card-footer text-end">
                <form action="comment.php" method="post">
                <input type="hidden" name="idPatient" value="' . $idPatient . '">
                <button type="button" class="btn btn-primary reply" id="' . $comment["comID"] . '"style="background-color: #a61057; border: 1px solid #a61057; color:white">Reply</button>
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

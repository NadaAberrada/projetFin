<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <style>
            html, body {
    height: 100%;
    background-image: url('./img/doctorHeader.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

/* .overlay {
    background-color: rgba(255, 255, 255, 0.7);
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
} */

.form-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.form-wrapper {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

.logo {
    font-size: 36px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #4a4a4a;
}

    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container form-container">
        <div class="form-wrapper">
            <h2 class="logo">YourBrand</h2>
            <p class="mb-4">Please enter your email address, and we will send you a link to reset your password.</p>
            <form>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <button type="submit" class="btn btn-primary mb-3 w-100">Reset Password</button>
                <p class="text-center">Remembered your password? <a href="#">Sign in</a></p>
            </form>
        </div>
    </div>
</body>
</html>
// } else {
    //    $sender= $_SESSION['commentsenderID'];



    //    if( $sender=="patient") {
    //     $writer="1";
    //     $patientID =  $_SESSION['patientID'];
    //     $patientQuery = "SELECT patientID FROM patients WHERE patientID = :patientID";
    //     $patientStatement = $conn->prepare($patientQuery);
    //     $patientStatement->execute(['patientID' => $patientID]);
    //     $patient = $patientStatement->fetch(PDO::FETCH_ASSOC);
    //     if ($patient) {
    //         $senderID = $patient['patientID'];
    //     }

    //     $doctorId =  $_SESSION["iddoctor"];

        
    //     $insertComments = "INSERT INTO comment (parent_id, comment, patientID,doctorID) VALUES (:parent_id, :comment, :sender,:doctorid,:writer)";
    //     $stmt = $conn->prepare($insertComments);
    //     $stmt->bindParam(':parent_id', $parent_id);
    //     $stmt->bindParam(':comment', $comment);
    //     $stmt->bindParam(':sender', $senderID);
    //     $stmt->bindParam(':doctorid', $doctorId);
    //     $stmt->bindParam(':writer', $writer);}









    //    }
    //    else{
    //     $writer="0";
    //     $doctorId =  $_SESSION["iddoctor"];
    //     $doctorQuery = "SELECT nameP FROM doctors WHERE doctorID = :doctorID";
    //     $doctorStatement = $conn->prepare($doctorQuery);
    //     $doctorStatement->execute(['doctorID' => $comment['doctorID']]);
    //     $doctor = $doctorStatement->fetch(PDO::FETCH_ASSOC);
    //     if ($doctor) {
    //         $senderID  = $doctor['doctorID'];
    //     }

    //     if (isset($_POST['idPatient'])) {
    //         $idPatient = $_POST['idPatient'];

    //     }


       
    //     $insertComments = "INSERT INTO comment (parent_id, comment, patientID,doctorID) VALUES (:parent_id, :comment, :idpatient,:sender,:writer)";
    //     $stmt = $conn->prepare($insertComments);
    //     $stmt->bindParam(':parent_id', $parent_id);
    //     $stmt->bindParam(':comment', $comment);
    //     $stmt->bindParam(':idpatient', $idPatient);
    //     $stmt->bindParam(':sender', $doctorId);
    //     $stmt->bindParam(':writer', $writer);

    //    }

        // $insertComments = "INSERT INTO comment (parent_id, comment, sender) VALUES (:parent_id, :comment, :sender)";
        // $stmt = $conn->prepare($insertComments);
        // $stmt->bindParam(':parent_id', $parent_id);
        // $stmt->bindParam(':comment', $comment);
        // $stmt->bindParam(':sender', $sender); }
   
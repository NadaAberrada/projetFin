<?php
$error='';
// Database connection
try {
    $conn = new PDO("mysql:host=localhost;dbname=projetfin;port=3306;charset=UTF8", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $tele = $_POST['tele'];
    $ville = $_POST['ville'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    try {
        $stmt = $conn->prepare("INSERT INTO patients (name, lastname , email, password_hash,phone, citynameP) VALUES (:prenom, :nom, :email, :password, :tele, :ville)");
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':tele', $tele);
        $stmt->bindParam(':ville', $ville);


        $stmt->execute();

        // Store email and password in cookies
        setcookie('patient_email', $email, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('patient_password', $password, time() + (86400 * 30), "/");

        // Redirect to the desired page
        header("Location: Incription-Médecin.php");
        exit();
    } catch (PDOException $e) {
        $error = "Error inserting user data: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<style>
    @keyframes gradientBackground {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    html,
    body {
        height: 100%;
    }

    body {
        background: linear-gradient(135deg, #83a4d4, #b6fbff);
        background-size: 400% 400%;
        animation: gradientBackground 15s ease infinite;
    }

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

    .logo img {
        max-width: 100%;
        height: auto;
    }

    .btn-primary {
        background-color: #2f9ba7;
        font-size: 20px;
        width: 30%;
    }

    .btn-primary:hover {
        background-color: #287d8c;
    }
</style>

<body>
    <?php if (isset($error)) : ?>
        <div class="modal" tabindex="-1" id="errorModal" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo $error; ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Your form goes here -->
    <div class="overlay"></div>
    <div class="container form-container">
        <div class="form-wrapper">
            <h2 class="logo"> <img src="./img/logoOfMySiteWeb.png" alt="" srcset="">
            </h2>
            <form method="post" action="Inscription-patient.php">
                <div class="row mb-3">
                    <div class="col"><label for="Prénom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="Prénom" name="prenom" required>
                    </div>

                    <div class="col"><label for="Nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="Nom" name="nom" required>
                    </div>



                </div>
                <div class="row mb-3">
                    <div class="col"><label for="tele" class="form-label">tele</label>
                        <input type="text" class="form-control" id="tele" name="tele" required>
                    </div>
                    <div class="col"><label for="ville" class="form-label">ville</label>
                        <select class="form-select" id="ville" name="ville" required>
                            <option selected disabled>Choisissez une ville</option>
                            <option value="Casablanca">Casablanca</option>
                            <option value="Rabat">Rabat</option>
                            <option value="Fès">Fès</option>
                            <option value="Marrakech">Marrakech</option>
                            <option value="Agadir">Agadir</option>
                            <option value="Tangier">Tanger</option>
                            <option value="Meknes">Meknès</option>
                            <option value="Oujda">Oujda</option>
                            <option value="Kenitra">Kénitra</option>
                            <option value="Tétouan">Tétouan</option>
                            <option value="Safi">Safi</option>
                            <option value="Khouribga">Khouribga</option>
                            <option value="Beni Mellal">Beni Mellal</option>
                            <option value="Mohammedia">Mohammedia</option>
                            <option value="El Jadida">El Jadida</option>
                            <option value="Nador">Nador</option>
                            <option value="Ksar El Kebir">Ksar El Kébir</option>
                            <option value="Settat">Settat</option>
                            <option value="Larache">Larache</option>
                            <option value="Taza">Taza</option>
                            <option value="Sale">Salé</option>
                            <option value="autre">autre</option>
                        </select>
                    </div>

                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary mb-3 w-100">S'inscrire</button>
                <p class="text-center">Vous avez déjà un compte? <a href="./S'inscrire-patient.php">S'inscrire</a></p>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (isset($error)) : ?>
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            <?php endif; ?>
        });
    </script>
</body>

</html>
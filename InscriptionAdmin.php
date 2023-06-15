<?php
session_start();
$error = '';
try {
    $conn = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur lors de la connexion à la base de données : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];

    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Check if user with the same email already exists
        $stmt = $conn->prepare("SELECT * FROM admins WHERE emailA = :email");
        $stmt->bindParam(':email', $email);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $error = "admin avec le même e-mail, CIN ou numéro de téléphone existe déjà.";
        } else {
            // Insert new admin
            $stmt = $conn->prepare("INSERT INTO admins (firstNameA, lastNameA, emailA, passwordA) VALUES (:prenom, :nom, :email, :password)");
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);

            $stmt->execute();
            $_SESSION['adminID'] = $conn->lastInsertId();

            // Redirection
            header("Location: dashboardAdmin.php");
            exit();
        }
    } catch (PDOException $e) {
        $error = "Erreur lors de l'insertion des données de l'utilisateur : " . $e->getMessage();
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DocMeet</title>
    <link rel="icon" type="image/x-icon" href="./img/logoDocMeet.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsEhcYf-NZNlL6-FVHfT1GT3XAth8EJk4&callback=initMap" async defer></script> -->
    <style>
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration .select-arrowx {
            top: 13px;
        }

        body {
            background-color: #aeb2b5;

            font-family: 'Poppins', sans-serif;
        }

        .btn-primary {
            background-color: #a61057;

        }

        .btn-primary:hover {
            background-color: #287d8c;
        }

        #map {
            width: 100%;
            height: 300px;
        }
    </style>
</head>

<body>


    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo $error; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




    <form class="h-100" method="POST" action="" enctype="multipart/form-data">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">
                                <img src="./img/HealthAdmin.jpg" alt="Sample photo" class="img-fluid W-100" style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-black">
                                    <a href="./landingpage.php" class="navbar-brand d-flex align-items-center ">
                                        <img src="./img/logoDocMeet.png" alt="" srcset="" width="18%" class="position-relative top-0 start-50 translate-middle mt-5">
                                    </a>
                                    <h4 class="mb-3 text-center">Gérer la santé avec confiance</br> Accès au portail administrateur</h4>


                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <input type="text" name="prenom" class="form-control form-control-lg" id="Prénom" required>
                                            <label class="form-label" for="Prénom">Prénom</label>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="form-outline">
                                            <input type="text" class="form-control form-control-lg" id="Nom" name="nom" required>
                                            <label class="form-label" for="Nom">Nom</label>
                                        </div>
                                    </div>


                                    <div class="mb-4">

                                        <div class="form-outline">
                                            <input type="email" id="email" name="email" class="form-control form-control-lg" style=" height: 38px;" required />
                                            <label class="form-label" for="email">Email</label>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="form-outline">
                                            <input type="password" id="password" name="password" class="form-control form-control-lg" style=" height: 38px;" required />
                                            <label class="form-label" for="password">Mot de passe</label>
                                        </div>


                                    </div>

                                    <div class="d-flex mb-2 justify-content-end pt-3">
                                        <button type="submit" name="submit" class="btn btn-primary btn-block">Inscrivez-vous</button>
                                    </div>

                                    <div class="text-center  small">
                                        <p class="">Vous avez déjà un compte? <a href="./ConnexionAdmin.php">Connecter </a></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="locationModalLabel">Choose your location</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <input type="hidden" id="location" name="location">
                    </div>
                    <div class="modal-body">
                        <div id="map"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveLocationBtn" data-bs-dismiss="modal">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>




    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const error = <?php echo isset($error) ? json_encode($error) : 'null'; ?>;
            if (error) {
                const errorModal = new bootstrap.Modal(document.getElementById("errorModal"));
                errorModal.show();
            }
        });
    </script>
</body>

</html>
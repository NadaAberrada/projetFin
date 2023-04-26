<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
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
</head>

<body>
    <div class="overlay"></div>
    <div class="container form-container">
        <div class="form-wrapper">
            <h2 class="logo"> <img src="./img/logoOfMySiteWeb.png" alt="" srcset="">
            </h2>
            <form method="post" action="">
                <div class="row mb-3">
                    <div class="col">
                        <label for="fullName" class="form-label">Nom complet</label>
                        <input type="text" name="fullname" class="form-control" id="fullName" required>
                    </div>
                    <div class="col">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="phone" class="form-label">Numéro de téléphone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="col">
                        <label for="city" class="form-label">Ville</label>
                        <select class="form-select" id="city" name="citynameD" required>
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
                <div class="row mb-3">
                    <div class="col">
                        <label for="specialty" class="form-label">Spécialité</label>
                        <select class="form-select" id="specialty" name="specialty" required>
                            <option selected disabled>Choisissez une spécialité</option>
                            <option value="Allergologie">Allergologie</option>
                            <option value="Anesthésiologie">Anesthésiologie</option>
                            <option value="Cardiologie">Cardiologie</option>
                            <option value="Chirurgie générale">Chirurgie générale</option>
                            <option value="Chirurgie plastique">Chirurgie plastique</option>
                            <option value="Dermatologie">Dermatologie</option>
                            <option value="Endocrinologie">Endocrinologie</option>
                            <option value="Gastroentérologie">Gastroentérologie</option>
                            <option value="Gériatrie">Gériatrie</option>
                            <option value="Gynécologie">Gynécologie</option>
                            <option value="Hématologie">Hématologie</option>
                            <option value="Immunologie">Immunologie</option>
                            <option value="Infectiologie">Infectiologie</option>
                            <option value="Médecine du sport">Médecine du sport</option>
                            <option value="Médecine interne">Médecine interne</option>
                            <option value="Néphrologie">Néphrologie</option>
                            <option value="Neurologie">Neurologie</option>
                            <option value="Obstétrique">Obstétrique</option>
                            <option value="Oncologie">Oncologie</option>
                            <option value="Ophtalmologie">Ophtalmologie</option>
                            <option value="Orthopédie">Orthopédie</option>
                            <option value="Oto-rhino-laryngologie">Oto-rhino-laryngologie</option>
                            <option value="Pédiatrie">Pédiatrie</option>
                            <option value="Pneumologie">Pneumologie</option>
                            <option value="Psychiatrie">Psychiatrie</option>
                            <option value="Radiologie">Radiologie</option>
                            <option value="Rhumatologie">Rhumatologie</option>
                            <option value="Urologie">Urologie</option>
                        </select>

                    </div>
                    <div class="col">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="doctorType" id="generalist" value="generalist" required>
                        <label class="form-check-label" for="generalist">En cochant cette case, vous déclarez accepter
                            <span style="color: #2f9ba7;"> Conditions Générales</span> de BookMyDoctor.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="doctorTypee" id="specialist" value="specialist" required>
                        <label class="form-check-label" for="specialist">J'accepte <span style="color: #2f9ba7;">politique de confidentialité</span> </label>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary mb-3 w-100">S'inscrire</button>
                <p class="text-center">Vous avez déjà un compte? <a href="./sign-in-D.php">Se connecter</a></p>
            </form>
        </div>
    </div>
    <?php
    // Database connection
    $conn = new PDO("mysql:host=localhost;dbname=projetfin;port=3306;charset=UTF8", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $specialty = $_POST['specialty'];
        $citynameD = $_POST['citynameD'];

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Check for duplicate email
        $check_email = "SELECT * FROM doctors WHERE email = ?";
        $check_stmt = $conn->prepare($check_email);
        $check_stmt->execute([$email]);
        if ($check_stmt->rowCount() > 0) {
            echo "Email already exists!";
        } else {
            $sql = "INSERT INTO doctors (fullname, email, phone, password, specialty, cabinet, citynameD, imageD, schedule) VALUES (?, ?, ?, ?, ?, NULL, ?, NULL, NULL)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fullname, $email, $phone, $password_hash, $specialty, $citynameD]);
            echo "Inscription réussie!";
        }
    }
    ?>

</body>

</html>
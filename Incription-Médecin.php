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
            <form>
                <div class="row mb-3">
                    <div class="col">
                        <label for="fullName" class="form-label">Nom complet</label>
                        <input type="text" class="form-control" id="fullName" required>
                    </div>
                    <div class="col">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="phone" class="form-label">Numéro de téléphone</label>
                        <input type="tel" class="form-control" id="phone" required>
                    </div>
                    <div class="col">
                        <label for="city" class="form-label">Ville</label>
                        <select class="form-select" id="city" required>
                            <option selected disabled>Choisissez une ville</option>
                            <!-- Add more cities as needed -->
                            <option>Casablanca</option>
                            <option>Rabat</option>
                            <option>Fès</option>
                            <option>Marrakech</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="specialty" class="form-label">Spécialité</label>
                        <select class="form-select" id="specialty" required>
                            <option selected disabled>Choisissez une spécialité</option>
                            <!-- Add more specialties as needed -->
                            <option>Cardiologie</option>
                            <option>Chirurgie générale</option>
                            <option>Dermatologie</option>
                            <option>Gynécologie</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" required>
                    </div>
                </div>


                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm ez le mot de passe</label>
                    <input type="password" class="form-control" id="confirmPassword" required>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="doctorType" id="generalist" value="generalist" required>
                        <label class="form-check-label" for="generalist">En cochant cette case, vous déclarez accepter
                            les Conditions Générales de Doctori.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="doctorType" id="specialist" value="specialist" required>
                        <label class="form-check-label" for="specialist">J'accepte la politique de confidentialité</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-3 w-100">S'inscrire</button>
                <p class="text-center">Vous avez déjà un compte? <a href="#">Se connecter</a></p>
            </form>
        </div>
    </div>
    <!-- Add the existing CSS from the previous answer -->
</body>

</html>
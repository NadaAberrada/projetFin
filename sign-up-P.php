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

        html, body {
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
            <h2 class="logo">                    <img src="./img/logoOfMySiteWeb.png" alt="" srcset="">
</h2>
            <form>
                <div class="mb-3">
                    <label for="Prénom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="Prénom" required>
                </div>
                <div class="mb-3">
                    <label for="Nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="Nom" required>
                </div>
                <div class="mb-3">
                    <label for="tele" class="form-label">tele</label>
                    <input type="text" class="form-control" id="tele" required>
                </div>
                <div class="mb-3">
                    <label for="ville" class="form-label">ville</label>
                    <input type="text" class="form-control" id="ville" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" required>
                </div>
                <button type="submit" class="btn btn-primary mb-3 w-100">Sign Up</button>
                <p class="text-center">Already have an account? <a href="#">Sign in</a></p>
            </form>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire Médcine</title>
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
<?php
$error = '';
// Database connection
try {
    $conn = new PDO("mysql:host=localhost;dbname=projetfin;port=3306;charset=UTF8", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['rememberMe']) ? $_POST['rememberMe'] : '';

    // Check if email is already registered
    // Get the user record based on the email address
    $stmt = $conn->prepare("SELECT * FROM doctors WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Fetch the user record
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the password against the stored hash
        if (password_verify($password, $user['password'])) {
            // Login successful, redirect to a protected page or set the session
            $error = "Logged in successfully!";
            // 3mel li bghiti hnaya
        } else {
            $error = "Incorrect email or password.";
        }
    } else {
        $error = "Email not registred";
    }

    // If rememberMe checkbox is checked, store email and password in cookies
    if ($rememberMe) {
        setcookie('doctor_email', $email, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('doctor_password', $password, time() + (86400 * 30), "/");
    } else {
        // Clear cookies if rememberMe is not checked
        setcookie('doctor_email', '', time() - 3600, "/");
        setcookie('doctor_password', '', time() - 3600, "/");
    }
}
?>

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
    <div class="container form-container">
        <div class="form-wrapper">
            <h2 class="logo">
                <img src="./img/logoOfMySiteWeb.png" alt="" srcset="">

            </h2>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary mb-3 w-100">Sign In</button>
                <p class="text-center">Vous n'avez pas de compte ?<a href="./Incription-Médecin.php">Incription</a></p>
            </form>
        </div>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const error = <?php echo isset($error) ? json_encode($error) : 'null'; ?>;
        if (error) {
            const errorModal = new bootstrap.Modal(document.getElementById("errorModal"));
            errorModal.show();
        }
    });
</script>

</html>
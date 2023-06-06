



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Site</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js" defer></script>

  <style>
    .card-registration .select-input.form-control[readonly]:not([disabled]) {
      font-size: 1rem;
      line-height: 2.15;
      padding-left: .75em;
      padding-right: .75em;
    }

    .card-registration .select-arrow {
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
  </style>
</head>
<?php
$error = '';
// Database connection
try {
    $conn = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
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
    $stmt = $conn->prepare("SELECT * FROM doctors WHERE emailD = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Fetch the user record
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the password against the stored hash
        if (password_verify($password, $user['passwordD'])) {
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
  <form class="h-100" action="" method="post">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card card-registration my-4">
            <div class="row g-0">
              <div class="col-xl-6 d-none d-xl-block">
                <img src="./img/medcinPic.jpg" alt="Sample photo" class="img-fluid" style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem; " />
              </div>
              <div class="col-xl-6">
                <div class="card-body p-md-5 text-black mt-5">
                  <a href="../Page Visiteure/Guest.php" class="navbar-brand d-flex align-items-center">
                    <img src="./img/logoDocMeet.png" alt="" srcset="" width="30%" class="position-relative top-0 start-50 translate-middle mt-5">
                  </a>
                  <h4 class="mb-5 text-center">Découvrez de nouvelles perspectives médicales <br> Connectez-vous !</h4>


                  <div class="form-outline mb-4">
                    <input type="email" id="email"  class="form-control form-control-lg" name="email" required>
                    <label class="form-label" for="email">Email address</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="password" class="form-control form-control-lg" name="password" required>
                    <label class="form-label" for="password">Mot De Passe</label>
                  </div>
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
                </div>
                  <div class="d-flex justify-content-end pt-3">
                    <button type="submit" class="btn btn-primary btn-block">Connecter</button>
                  </div>


                  <div class="text-center mt-3 small">
                  Vous n'avez pas de compte ? <a href="./Incription-Médecin.php">Inscrivez-Vous</a>
                  </div>
                </div>
              </div>
            </div>
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
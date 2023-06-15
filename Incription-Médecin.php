<?php
session_start();
$error = '';
try {
  // Database connection
  $conn = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $specialty = $_POST['specialty'];
    $citynameD = $_POST['citynameD'];
    $genre = $_POST['genre'];
    $cin = $_POST['cin'];

    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $location = str_replace(['{', '}', 'lat', 'lng', ':', '"', ' '], '', $location);
    $location = str_replace(',', ', ', $location);

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $cpemData = null;
    if (isset($_FILES['cpem']) && $_FILES['cpem']['error'] == UPLOAD_ERR_OK) {
      $cpemData = fopen($_FILES['cpem']['tmp_name'], 'rb');
    }

    $profilimgData = null;
    if (isset($_FILES['profilimg']) && $_FILES['profilimg']['error'] == UPLOAD_ERR_OK) {
      $profilimgData = fopen($_FILES['profilimg']['tmp_name'], 'rb');
    }
    if (!preg_match("/^((\+|00)212|0)[567]\d{8}$/", $phone)) {
      $error = 'Numéro de téléphone invalide. Veuillez saisir un numéro de téléphone marocain valide.';
    } else {
      $check_query = "SELECT * FROM doctors WHERE emailD = :email OR cin = :cin OR phoneD = :phone";
      $check_stmt = $conn->prepare($check_query);
      $check_stmt->bindParam(':email', $email);
      $check_stmt->bindParam(':cin', $cin);
      $check_stmt->bindParam(':phone', $phone);
      $check_stmt->execute();
      if ($check_stmt->rowCount() > 0) {
        // Check if doctor with the same email, CIN, or phone number already exists

        $error = "Un médecin avec le même e-mail, CIN ou numéro de téléphone existe déjà.";
      } else {
        $sql = "INSERT INTO doctors (fullname, emailD, phoneD, passwordD, specialty, citynameD, imageD, rating, localisation, websiteLink, cpemimg,gender,cin ,confirm) VALUES (?, ?, ?, ?, ?, ?, ?, NULL, ?, NULL, ?,?,?,NULL)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $fullname);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $phone);
        $stmt->bindParam(4, $password_hash);
        $stmt->bindParam(5, $specialty);
        $stmt->bindParam(6, $citynameD);
        $stmt->bindParam(7, $profilimgData, PDO::PARAM_LOB);
        $stmt->bindParam(8, $location);
        $stmt->bindParam(9, $cpemData, PDO::PARAM_LOB);
        $stmt->bindParam(10, $genre);
        $stmt->bindParam(11, $cin);
        $stmt->execute();
        $last_id = $conn->lastInsertId();
        $_SESSION['DoctorID'] = $last_id;
        $_SESSION['iddoctor'] = $last_id;
         $_SESSION['commentsenderID'] = "doctor";

        // setcookie('medcine_email', $email, time() + (86400 * 30), "/"); // 86400 = 1 day
        // setcookie('medcine_password', $password, time() + (86400 * 30), "/");
        header("Location:apresInscription.php");

        exit();
      }
    }
  }
} catch (PDOException $e) {
  $error = 'Connection failed: ' . $e->getMessage();
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

  <script>
    // Code for saving location and submitting the form
    function saveLocationAndSubmit() {
      const location = JSON.stringify(savedPosition);
      document.getElementById('location').value = location;
      document.getElementById('registrationForm').submit();
    }
  </script>

  <form class="h-100" method="POST" action="" enctype="multipart/form-data">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card card-registration my-4">
            <div class="row g-0">
              <div class="col-xl-6 d-none d-xl-block">
                <img src="./img/doctorPics.jpg" alt="Sample photo" class="img-fluid" style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem; height:100%" />
              </div>
              <div class="col-xl-6">
                <div class="card-body p-md-5 text-black">
                  <a href="./landingpage.php" class="navbar-brand d-flex align-items-center mt-3">
                    <img src="./img/logoDocMeet.png" alt="" srcset="" width="30%" class="position-relative top-0 start-50 translate-middle mt-5">
                  </a>
                  <h4 class="mb-5 text-center">Libérez le plein potentiel de votre carrière médicale <br> Inscrivez-vous maintenant !</h4>

                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" name="fullname" class="form-control form-control-lg" id="fullName" required>
                        <label class="form-label" for="fullname">Nom complet</label>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                        <label class="form-label" for="email">Adresse e-mail</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="tel" class="form-control form-control-lg" id="phone" name="phone" required>
                        <label for="phone" class="form-label">Numéro de téléphone</label>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
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
                        </select>

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div iv class="col-md-6 mb-4">
                      <div class="form-outline">

                        <select class="form-select" id="genre" name="genre" required>
                          <option selected disabled>Choisissez le genre</option>
                          <option value="Femme">Femme</option>
                          <option value="Homme">Homme</option>
                        </select>
                      </div>


                    </div>

                    <div iv class="col-md-6 mb-4">
                      <div class="form-outline">

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
                    </div>

                    <div class="col-md-6 mb-4">
                      <label class="form-control" for="inputGroupFile01">CPEM </label>
                      <input type="file" id="inputGroupFile01" name="cpem" style="display: none;">
                    </div>


                    <div class="col-md-6 mb-4">
                      <input type="Text" id="cin" placeholder="CIN" name="cin" class="form-control form-control-lg" style=" height: 38px;" required />


                    </div>

                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <label class="form-control" for="inputGroupFile02">Profil image </label>
                      <input type="file" id="inputGroupFile02" name="profilimg" style="display: none; ">
                    </div>

                    <div class=" col-6 mb-4">

                      <input type="password" id="Password_Confirm_Inp" placeholder="Password" name="password" class="form-control form-control-lg" style=" height: 38px;" required />

                    </div>
                  </div>
                  <div class="mb-4">

                    <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#locationModal" style=" border: 1px solid #C0C0C0; width: 100%;">
                      Choisissez votre emplacement
                    </button>



                  </div>


                  <!-- In your HTML file -->



                  <div class="d-flex justify-content-end pt-3">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Inscrivez-vous</button>
                  </div>

                  <div class="text-center mt-3 small">
                    <p class="">Vous avez déjà un compte? <a href="./ConnexionMédcine.php">Connecter </a></p>
                  </div>
                  <!-- <div class="text-center mt-3 small">
                   <a href="./resetpasswrord.php" style="color: black;" >Mot de passe oublié ?</a>
                  </div> -->
                  <div class="text-center mt-3 small small-and-smaller" style="font-size: 0.8em;">
                    <p class="">CPEM : CARTE PROFESSIONNELLE ELECTRONIQUE DU MEDECIN</p>
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
    let map, marker;
    let savedPosition = {
      lat: 31.7917,
      lng: -7.0926
    };

    function initMap() {
      const initialPosition = savedPosition;
      map = new google.maps.Map(document.getElementById("map"), {
        center: initialPosition,
        zoom: 6,
      });
      marker = new google.maps.Marker({
        position: initialPosition,
        map: map,
        draggable: true,
      });

      marker.addListener("dragend", function(event) {
        savedPosition = {
          lat: event.latLng.lat(),
          lng: event.latLng.lng()
        };
        console.log(savedPosition);
      });
    }

    document.getElementById('saveLocationBtn').addEventListener('click', function() {
      console.log(savedPosition);
      this.textContent = "Update Location";
      document.getElementById('location').value = JSON.stringify(savedPosition);
    });

    document.getElementById('locationModal').addEventListener('hide.bs.modal', function() {
      document.getElementById('locationBtn').textContent = "Update Location";
    });
  </script>

  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsEhcYf-NZNlL6-FVHfT1GT3XAth8EJk4&callback=initMap"></script>
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
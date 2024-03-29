  <?php
  try {
    $conn = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
  }

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  // Include the PHPMailer files
  require './vendor/phpmailer/phpmailer/src/Exception.php';
  require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
  require './vendor/phpmailer/phpmailer/src/SMTP.php';

  // Handle Confirm button click
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmBtn'])) {
    $doctorID = $_POST['doctorID'];

    try {
      // Update confirmation status
      $stmt = $conn->prepare("UPDATE doctors SET confirm = 'oui' WHERE doctorID = :doctorID");
      $stmt->bindValue(':doctorID', $doctorID, PDO::PARAM_INT);
      $stmt->execute();

      // Fetch doctor's email and name from the database
      $stmt = $conn->prepare("SELECT emailD, fullname FROM doctors WHERE doctorID = :doctorID");
      $stmt->bindValue(':doctorID', $doctorID, PDO::PARAM_INT);
      $stmt->execute();

      $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
      $doctorEmail = $doctor['emailD'];
      $doctorName = $doctor['fullname'];

      // Create a new PHPMailer instance
      $mail = new PHPMailer;

      // Set PHPMailer to use SMTP
      $mail->isSMTP();

      // Specify the SMTP host
      $mail->Host = 'smtp.gmail.com';

      // Enable SMTP authentication
      $mail->SMTPAuth = true;

      // SMTP username and password
      $mail->Username = 'docmeetplatform@gmail.com';
      $mail->Password = 'xlhvhfogitpmagsv';

      // Enable TLS encryption
      $mail->SMTPSecure = 'tls';

      // Specify the SMTP port
      $mail->Port = 587;

      // Set the email subject
      $mail->Subject = "Docteur Profile Confirmation";

      // Set HTML email
      $mail->isHTML(true);

      // Set the email body
      $mail->Body = "
            <html>
            <head>
            <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet' />
        
                <style>
                    .email-content {
                      
                        margin: 0 auto;
                        padding: 20px;
                        background-color: #f6f6f6;
                        max-width: 600px;
                        border-radius: 5px;
                    }
                    .email-content h1 {
                        color: #333;
                    }
                    .email-content p {
                        color: #666;
                    }
                    .btn {
                        display: inline-block;
                        background-color: #a61057;
                        color: white;
                        padding: 10px 20px;
                        text-decoration: none;
                        border-radius: 5px;
                        margin-top: 10px;
                    }
                </style>
            </head>
            <body>
                <div class='email-content'>
                    <h1>Cher Docteur,  $doctorName</h1>
                    <p>Nous vous remercions de votre inscription en tant que médecin sur notre plateforme. Nous avons bien reçu et confirmé vos informations.</br> Pour accéder à votre profil et commencer à fournir des services, veuillez vous connecter en utilisant les informations de votre compte.</p>
                 <a href='http://localhost:88/projetFin/ConnexionM%c3%a9dcine.php' class='btn text-white'style='color: white;'>Connexion</a>
                </div>
            </body>
            </html>
        ";

      // Set who the message is to be sent from
      $mail->setFrom($mail->Username, 'DocMeet');

      // Set who the message is to be sent to
      $mail->addAddress($doctorEmail);

      // Send the email
      if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
      } else {
        echo "Message sent!";
      }

      // Redirect back to the same page after processing the form
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
    } catch (PDOException $e) {
      die("Error updating confirm status: " . $e->getMessage());
    } catch (Exception $e) {
      die("Error sending email: " . $e->getMessage());
    }
  }


  // Handle Decline button click
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['declineBtn'])) {
    $doctorID = $_POST['doctorID'];

    try {
      $stmt = $conn->prepare("DELETE FROM doctors WHERE doctorID = :doctorID");
      $stmt->bindValue(':doctorID', $doctorID, PDO::PARAM_INT);
      $stmt->execute();

      // Redirect back to the same page after processing the form
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
    } catch (PDOException $e) {
      die("Error deleting doctor: " . $e->getMessage());
    }
  }

  try {
    $limit = 10; // number of results per page
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
      $page = $_GET['page'];
    } else {
      $page = 1;
    }
    
    $offset = ($page - 1) * $limit;

    // select doctors with limit and offset
    $stmt = $conn->prepare("SELECT * FROM doctors WHERE confirm = 'non' LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // get total number of doctors for calculating total pages
    $stmt = $conn->prepare("SELECT COUNT(*) FROM doctors WHERE confirm = 'non'");
    $stmt->execute();
    $totalDoctors = $stmt->fetchColumn();
  } catch (PDOException $e) {
    die("Error retrieving doctors: " . $e->getMessage());
  }


  ?>

  <!DOCTYPE html>
  <html>

  <head>
    <title>DocMeet</title>
    <link rel="icon" type="image/x-icon" href="./img/logoDocMeet.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
      body {

        font-family: 'Poppins', sans-serif;

      }

      .card {
        border: none;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      }

      .card-img-top {
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
      }

      .card-body {
        padding: 20px;
      }



      .card-text {
        margin-bottom: 5px;
      }
    </style>
  </head>

  <body>
    <header class="navbar navbar-dark sticky-top  flex-md-nowrap p-0 shadow" style="background-color: #f8f8f8;">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="./landingpage.php"> <img src="./img/logoDocMeet.png" alt="" srcset="" width="30%">
      </a>
      <button class="navbar-toggler position-absolute  d-md-none collapsed" type="button" data-bs-toggle="collapse" style=" background-color: #267f89; right: 0; margin-right:1.5rem;" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-nav  ">
        <div class="nav-item text-nowrap">
          <a class="nav-link px-3 text-secondary " href="SignOutAdmin.php">se déconnecter</a>
        </div>
      </div>
    </header>


    <div class="container-fluid ">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light  sidebar collapse">
          <div class="position-sticky pt-3 sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">

                <a class="nav-link active" aria-current="page" href="./dashboardAdmin.php">
                  <span data-feather="home" class="align-text-bottom"></span>
                  Statistique
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./searchpatientDash.php">
                  <span data-feather="file" class="align-text-bottom"></span>
                  Liste des patients
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./DoctorSearchDash.php">
                  <span data-feather="shopping-cart" class="align-text-bottom"></span>
                  Liste des Docteurs
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./confirmMedine.php">
                  <span data-feather="users" class="align-text-bottom"></span>
                  Confirmer les médecins
                </a>
              </li>

            </ul>

          </div>
        </nav>

        <div class="container col-md-9 ms-sm-auto col-lg-10 px-md-4 text-center">
          <h4 class="card-title mb-5 mt-5" style="text-align: left; border-bottom: 1px solid  #267f89;margin-top:15%">Confirmé Docteurs</h4>

          <div class="row">
            <div class="col-7 mb-4  mt-5 position-relative top-50 start-50 translate-middle">
              <form action="" method="GET" class=" d-flex">
                <input class="form-control me-2 " type="search" name="search" placeholder="Search by email or CIN" aria-label="Search">
                <button class="btn" style="background-color: #267f89;color:white" type="submit">Chercher</button>
              </form>
            </div>
            <div class="row">
              <?php

              if (isset($_GET['search'])) {
                $searchQuery = $_GET['search'];
              } else {
                $searchQuery = '';
              }


              $filteredDoctors = [];
              foreach ($doctors as $doctor) {
                $email = $doctor['emailD'];
                $cin = $doctor['cin'];
                if (strpos($email, $searchQuery) !== false || strpos($cin, $searchQuery) !== false) {
                  $filteredDoctors[] = $doctor;
                }
              }

              if ($searchQuery) {
                $displayDoctors = $filteredDoctors;
              } else {
                $displayDoctors = $doctors;
              }



              foreach ($displayDoctors as $doctor) :
              ?>
                <div class="col-md-6 col-lg-4  ">
                  <div class="card mb-3 shadow  " style="max-width: 540px;">
                    <div class="row g-0">
                      <div class="col-md-12 ">
                        <?php
                        $imageData = $doctor['cpemimg'];
                        if ($imageData !== null) {
                          //binary data to string 
                          //make the image jpeg
                          $imageSrc = 'data:image/jpeg;base64,' . base64_encode($imageData);
                        }
                        ?>
                        <img src="<?php echo $imageSrc; ?>" class="img-fluid rounded-start " alt="Doctor Image">
                      </div>
                      <div class="col-md-12 mb-4 ">
                        <div class="card-body ">
                          <p class="card-title"> <strong>Nom et prénom: </strong><?php echo "Dr" . " " . $doctor['fullname']; ?></p>
                          <p class="card-text"><strong>Email: </strong><?php echo $doctor['emailD']; ?></p>
                          <p class="card-text"> <strong>Tele: </strong><?php echo $doctor['phoneD']; ?></p>
                          <p class="card-text"><strong>CIN: </strong><?php echo $doctor['cin']; ?></p>
                        </div>
                        <form action="" method="POST">

                          <input type="hidden" name="doctorID" value="<?php echo $doctor['doctorID']; ?>">
                          <div class="row"></div>
                          <?php if ($doctor['confirm'] === 'non') : ?>
                            <button type="button" class="btn mt-2" style="background-color: #267f89;color:white" data-bs-toggle="modal" data-bs-target="#confirmModal<?php echo $doctor['doctorID']; ?>">
                              Confirmer
                            </button>

                          <?php endif; ?>
                          <button type="button" class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#declineModal<?php echo $doctor['doctorID']; ?>">
                            Refuser
                          </button>
                          <button type="button" class="btn btn-secondary mt-2" data-bs-toggle="modal" data-bs-target="#doctorInfoModal<?php echo $doctor['doctorID']; ?>">
                            Details
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="modal fade" id="doctorInfoModal<?php echo $doctor['doctorID']; ?>" tabindex="-1" role="dialog" aria-labelledby="doctorInfoModalTitle<?php echo $doctor['doctorID']; ?>" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="doctorInfoModalTitle<?php echo $doctor['doctorID']; ?>">Docteur Informations</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                            <?php
                            $profileImage = $doctor['imageD'];
                            if ($profileImage === null) {
                              if ($doctor['gender'] === 'Femme') {
                                echo '<img src="./img/defaultFemme.jpg" alt="Profile Image" class="img-fluid" style="max-height: 200px;">';
                              } elseif ($doctor['gender'] === 'Homme') {
                                echo '<img src="./img/defaultHomme.jpg" alt="Profile Image" class="img-fluid" style="max-height: 200px;">';
                              } else {
                                echo '<img src="default-image.jpg" alt="Profile Image" class="img-fluid" style="max-height: 200px;">';
                              }
                            } else {
                              echo '<img src="data:image/jpeg;base64,' . base64_encode($profileImage) . '" alt="Profile Image" class="img-fluid" style="max-height: 200px;">';
                            }
                            ?>
                          </div>


                        </div>
                        <p><strong>Nom et prénom: </strong><?php echo  "Dr." . $doctor['fullname']; ?></p>
                        <p><strong>Email: </strong><?php echo $doctor['emailD']; ?></p>
                        <p><strong>Phone: </strong><?php echo $doctor['phoneD']; ?></p>
                        <p><strong>Specialty: </strong><?php echo $doctor['specialty']; ?></p>
                        <p><strong>Ville: </strong><?php echo $doctor['citynameD']; ?></p>
                        <p><strong>genre: </strong><?php echo $doctor['gender']; ?></p>

                        <?php if ($doctor['websiteLink'] !== null) : ?>
                          <p><strong>Website Link: </strong><?php echo $doctor['websiteLink']; ?></p>
                        <?php endif; ?>
                        <div style="width: 100%; height: 400px;">
                          <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo $doctor['localisation']; ?>&z=15&output=embed" aria-label="Embedded Google Map"></iframe>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Confirm Modal -->
                <div class="modal fade" id="confirmModal<?php echo $doctor['doctorID']; ?>" tabindex="-1" role="dialog" aria-labelledby="confirmModalTitle<?php echo $doctor['doctorID']; ?>" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalTitle<?php echo $doctor['doctorID']; ?>">Confirm Docteur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p>Voulez-vous vraiment confirmer ce médecin ?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <form action="" method="POST">
                          <input type="hidden" name="doctorID" value="<?php echo $doctor['doctorID']; ?>">
                          <button type="submit" class="btn btn-primary" name="confirmBtn">Confirmer</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Decline Modal -->
                <div class="modal fade" id="declineModal<?php echo $doctor['doctorID']; ?>" tabindex="-1" role="dialog" aria-labelledby="declineModalTitle<?php echo $doctor['doctorID']; ?>" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="declineModalTitle<?php echo $doctor['doctorID']; ?>">Refuser le médecin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure you want to decline this doctor?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <form action="" method="POST">
                          <input type="hidden" name="doctorID" value="<?php echo $doctor['doctorID']; ?>">
                          <button type="submit" class="btn btn-danger" name="declineBtn">refuser</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>


              <?php
              endforeach;

              // Displaying the pagination
              $pages = ceil($totalDoctors / $limit);
              echo '<nav aria-label="Page navigation">';
              echo '<ul class="pagination justify-content-center">';
              for ($i = 1; $i <= $pages; $i++) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
              }
              echo '</ul>';
              echo '</nav>';
              ?>
            </div>
          </div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


          <!-- Optional: Place to the bottom of scripts -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>

  </html>
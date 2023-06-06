<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.108.0">
  <title>Dashboard Template Â· Bootstrap v5.3</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>


  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .card {
      background-color: #f8f9fa;
      border: none;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-title {
      font-size: 1.2rem;
      font-weight: bold;
      margin-bottom: 0.5rem;
    }

    .card-text {
      font-size: 1.5rem;
      font-weight: bold;
      color: #007bff;
    }




    .input-group {
      margin-bottom: 1.5rem;
    }

    .form-control {
      border-radius: 0.5rem;
    }

    .btn-primary {
      border-radius: 0.5rem;
      background-color: #267f89;
    }

    body {

      font-family: 'Poppins', sans-serif;

    }

    

  </style>


  <!-- Custom styles for this template -->
  <link href="dashboard.css" rel="stylesheet">
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
        <a class="nav-link px-3 text-secondary " href="SignOut.php">se déconnecter</a>
      </div>
    </div>
  </header>


  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3 sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active"  aria-current="page" href="./dashboardAdmin.php">
                <span data-feather="home" class="align-text-bottom"></span>
                Statistique
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link"  href="./searchpatientDash.php">
                <span data-feather="file" class="align-text-bottom"></span>
                Liste des patients
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link"  href="./DoctorSearchDash.php">
                <span data-feather="shopping-cart" class="align-text-bottom"></span>
                Liste des Docteurs
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link"  href="./confirmMedine.php">
                <span data-feather="users" class="align-text-bottom"></span>
                confirmer les médecins
              </a>
            </li>

          </ul>




        </div>
      </nav>


      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 text-center ">
        <?php
        // Database connection
        try {
          $conn = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
          die("Error connecting to the database: " . $e->getMessage());
        }

        // Count total patients
        $stmtPatients = $conn->query("SELECT COUNT(*) FROM patients");
        $totalPatients = $stmtPatients->fetchColumn();

        // Count total doctors
        $stmtDoctors = $conn->query("SELECT COUNT(*) FROM doctors");
        $totalDoctors = $stmtDoctors->fetchColumn();
        // Count confirmed doctors
        $stmtConfirmedDoctors = $conn->query("SELECT COUNT(*) FROM doctors WHERE confirm = 'oui'");
        $totalConfirmedDoctors = $stmtConfirmedDoctors->fetchColumn();

        // Count unconfirmed doctors
        $stmtUnconfirmedDoctors = $conn->query("SELECT COUNT(*) FROM doctors WHERE confirm = 'non'");
        $totalUnconfirmedDoctors = $stmtUnconfirmedDoctors->fetchColumn();
        ?>

        <div class="row mt-5 justify-content-center">
          <div class="col-md-3">
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title">Total Patients</h5>
                <p class="card-text" style="color:  #267f89;"><?php echo $totalPatients; ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title">Total Doctuers</h5>
                <p class="card-text" style="color:  #267f89;"><?php echo $totalDoctors; ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title">Confirmé Doctuers</h5>
                <p class="card-text" style="color:  #267f89;"><?php echo $totalConfirmedDoctors; ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title">Non confirmé Docteurs</h5>
                <p class="card-text" style="color:  #267f89;"><?php echo $totalUnconfirmedDoctors; ?></p>
              </div>
            </div>
          </div>

        </div>


        <?php
        // Database connection
        try {
          $conn = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
          die("Error connecting to the database: " . $e->getMessage());
        }

        // Get the search input value
        $searchCity = isset($_GET['searchCity']) ? $_GET['searchCity'] : '';

        // Query to retrieve the count of doctors in each city
        $stmt = $conn->prepare("
    SELECT citynameD, COUNT(*) AS doctor_count
    FROM doctors
    WHERE citynameD LIKE :searchCity
    GROUP BY citynameD
");
        $stmt->bindValue(':searchCity', '%' . $searchCity . '%');
        $stmt->execute();
        $doctorsByCity = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $stmt = $conn->prepare("
        SELECT citynameD, COUNT(*) AS confirmed_doctor_count
        FROM doctors
        WHERE citynameD LIKE :searchCity AND confirm = 'oui'
        GROUP BY citynameD
      ");
        $stmt->bindValue(':searchCity', '%' . $searchCity . '%');
        $stmt->execute();
        $confirmedDoctorsByCity = $stmt->fetchAll(PDO::FETCH_ASSOC);




        $stmt = $conn->prepare("
      SELECT citynameD, COUNT(*) AS nonconfirmed_doctor_count
      FROM doctors
      WHERE citynameD LIKE :searchCity AND confirm = 'non'
      GROUP BY citynameD
    ");
        $stmt->bindValue(':searchCity', '%' . $searchCity . '%');
        $stmt->execute();
        $nonConfirmedDoctorsByCity = $stmt->fetchAll(PDO::FETCH_ASSOC);






        // Query to retrieve the count of patients in each city
        $stmt = $conn->prepare("
    SELECT citynameP, COUNT(*) AS patient_count
    FROM patients
    WHERE citynameP LIKE :searchCity
    GROUP BY citynameP
");
        $stmt->bindValue(':searchCity', '%' . $searchCity . '%');
        $stmt->execute();
        $patientsByCity = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Combine the city data from doctors and patients
        $cities = array_merge(array_column($doctorsByCity, 'citynameD'), array_column($patientsByCity, 'citynameP'));
        $cities = array_unique($cities);

        ?>


        <h4 class="card-title mb-5 mt-5" style="text-align: left; border-bottom: 1px solid  #267f89;margin-top:15%">Statistiques de la Ville</h4>
        <div class="row justify-content-center mb-5 mt-5">
          <div class="col-md-7">
            <div class="card-body">
              <!-- <h2 class="card-title mb-5" style="text-align: left; border-bottom: 1px solid #3498db;">Statistiques de la Ville</h2> -->
              <form action="" method="GET" class="input-group">
                <input type="text" class="form-control" placeholder="Entrer une ville" name="searchCity" value="<?php echo htmlspecialchars($searchCity); ?>">
                <button class="btn btn-primary" type="submit">Chercher</button>
              </form>
            </div>
          </div>
        </div>

        <div class="row justify-content-center mt-5">
          <div class="col-md-10">
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">Ville</th>
                    <th scope="col">Docteurs Confirmé</th>
                    <th scope="col">Docteurs non Confirmé</th>
                    <th scope="col">Patients</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($cities as $city) {
                    $confirmedDoctorCount = 0;
                    $nonConfirmedDoctorCount = 0;
                    $patientCount = 0;

                    foreach ($confirmedDoctorsByCity as $doctorRow) {
                      if ($doctorRow['citynameD'] === $city) {
                        $confirmedDoctorCount = $doctorRow['confirmed_doctor_count'];
                        break;
                      }
                    }

                    foreach ($nonConfirmedDoctorsByCity as $doctorRow) {
                      if ($doctorRow['citynameD'] === $city) {
                        $nonConfirmedDoctorCount = $doctorRow['nonconfirmed_doctor_count'];
                        break;
                      }
                    }

                    foreach ($patientsByCity as $patientRow) {
                      if ($patientRow['citynameP'] === $city) {
                        $patientCount = $patientRow['patient_count'];
                        break;
                      }
                    }
                    echo "
                  <tr>
                    <td>$city</td>
                    <td>$confirmedDoctorCount</td>
                    <td>$nonConfirmedDoctorCount</td>
                    <td>$patientCount</td>
                  </tr>
              ";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        </tbody>
        </table>
    </div>
  </div>
  </div>

  </tbody>
  </table>
  </div>
  </div>
  </div>





  </main>



  </main>
  </div>
  </div>


  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  <script src="dashboard.js"></script>
</body>

</html>
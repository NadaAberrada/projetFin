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

body {
 
 font-family: 'Poppins', sans-serif;

}
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
        <a class="nav-link px-3 text-secondary " href="#"><a class="nav-link px-3 text-secondary " href="SignOut.php">se déconnecter</a></a>
      </div>
    </div>
  </header>


  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
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
                confirmer les médecins
              </a>
            </li>

          </ul>

        </div>
      </nav>



      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 text-center">
        <?php
        try {
          $conn = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
          die("Error connecting to the database: " . $e->getMessage());
        }

        // Search functionality
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searchEmail'])) {
          $searchEmail = $_POST['searchEmail'];
          $stmt = $conn->prepare("SELECT * FROM patients WHERE emailP LIKE :searchEmail OR cin LIKE :searchCIN");
          $stmt->bindValue(':searchEmail', "%$searchEmail%", PDO::PARAM_STR);
          $stmt->bindValue(':searchCIN', "%$searchEmail%", PDO::PARAM_STR);
          $stmt->execute();
        } else {
          // Fetch all patients
          $stmt = $conn->prepare("SELECT * FROM patients");
          $stmt->execute();
        }


        $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Pagination
        $perPage = 10; // Number of rows per page
        $totalRows = count($patients);
        $totalPages = ceil($totalRows / $perPage);
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($currentPage - 1) * $perPage;
        $paginatedPatients = array_slice($patients, $offset, $perPage);
        ?>

        <div class="row justify-content-center mb-5 mt-5">
          <div class="col-md-7">
            <div class="card-body">
              <h1 class=" mb-5 dashboard-1">Chercher Patient</h1>
              <form action="" method="POST" class="input-group">
                <input type="text" class="form-control" placeholder="Entrer Email ou CIN" name="searchEmail">
                <button class="btn btn-primary" type="submit">chercher</button>
              </form>
            </div>
          </div>
        </div>

        <div class="row justify-content-center mt-5">
          <div class="col-md-10">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Prénom</th>
                      <th scope="col">Nome</th>
                      <th scope="col">Email</th>
                      <th scope="col">CIN</th>
                      <th scope="col">Tele</th>
                      <th scope="col">Ville</th>
                      <th scope="col">Gender</th>
                      <th scope="col">ImageProfil</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($paginatedPatients as $patient) : ?>
                      <tr>
                        <td><?php echo $patient['nameP']; ?></td>
                        <td><?php echo $patient['lastnameP']; ?></td>
                        <td><?php echo $patient['emailP']; ?></td>
                        <td><?php echo $patient['cin']; ?></td>
                        <td><?php echo $patient['phoneP']; ?></td>
                        <td><?php echo $patient['citynameP']; ?></td>
                        <td><?php echo $patient['gender']; ?></td>
                        <td>
                          <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#patientModal<?php echo $patient['patientID']; ?>">View Image</button>
                        </td>
                      </tr>
                      <!-- Patient Modal -->
                      <div class="modal fade " id="patientModal<?php echo $patient['patientID']; ?>" tabindex="-1" aria-labelledby="patientModalLabel<?php echo $patient['patientID']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="patientModalLabel<?php echo $patient['patientID']; ?>">Patient Details</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <?php
                                $profileImage = $patient['imageP'];
                                if ($profileImage === null) {
                                  if ($patient['gender'] === 'Femme') {
                                    echo '<div class="col-md-12 d-flex justify-content-center">
                <img src="./img/patientFemmeImg.jpg" alt="Profile Image" class="img-fluid" style=" max-height:30vh; ">
              </div>';
                                  } elseif ($patient['gender'] === 'Homme') {
                                    echo '<div class="col-md-12 d-flex justify-content-center">
                <img src="./img/patientHommeImg.jpg" alt="Profile Image" class="img-fluid" style=" max-height:30vh; ">
              </div>';
                                  }
                                } else {
                                  echo '<div class="col-md-12 d-flex justify-content-center">
              <img src="data:image/jpeg;base64,' . base64_encode($profileImage) . '" alt="Profile Image" class="img-fluid" style=" max-height:30vh; ">
            </div>';
                                }
                                ?>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Patient Modal -->
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- Pagination -->
              <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mt-4">
                  <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                  <?php endfor; ?>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </main>


      <canvas class="my-4 w-100" id="myChart" width="900" height="380">



      </canvas>


      </main>
    </div>
  </div>


  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  <script src="dashboard.js"></script>
</body>

</html>
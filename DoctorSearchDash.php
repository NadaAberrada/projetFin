<?php
try {
  $conn = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Error connecting to the database: " . $e->getMessage());
}

// Search functionality
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $searchEmail = $_POST['searchEmail'];
  $stmt = $conn->prepare("SELECT * FROM doctors WHERE emailD LIKE :searchEmail OR cin LIKE :searchCIN");
  $stmt->bindValue(':searchEmail', "%$searchEmail%", PDO::PARAM_STR);
  $stmt->bindValue(':searchCIN', "%$searchEmail%", PDO::PARAM_STR);
  $stmt->execute();
} else {
  // Fetch all doctors
  $stmt = $conn->prepare("SELECT * FROM doctors");
  $stmt->execute();
}

$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Specialty filter
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['specialty'])) {
  $specialtyFilter = $_GET['specialty'];
  $filteredDoctors = array_filter($doctors, function ($doctor) use ($specialtyFilter) {
    return $doctor['specialty'] == $specialtyFilter;
  });
  $doctors = array_values($filteredDoctors); // Reset array keys
}

// Pagination
$perPage = 10; // Number of rows per page
$totalRows = count($doctors);
$totalPages = ceil($totalRows / $perPage);
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentPage - 1) * $perPage;
$paginatedDoctors = array_slice($doctors, $offset, $perPage);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
  $id = $_POST['delete_id'];

  // Prepare and execute the delete statement
  $stmt = $conn->prepare("DELETE FROM doctors WHERE doctorID = :id");
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);

  try {
    $stmt->execute();
    header("Location: ./DoctorSearchDash.php"); // Redirect to the doctors page
    exit();
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.108.0">
  <title>Dashboard Template · Bootstrap v5.3</title>

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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $searchEmail = $_POST['searchEmail'];
          $stmt = $conn->prepare("SELECT * FROM doctors WHERE emailD LIKE :searchEmail OR cin LIKE :searchCIN");
          $stmt->bindValue(':searchEmail', "%$searchEmail%", PDO::PARAM_STR);
          $stmt->bindValue(':searchCIN', "%$searchEmail%", PDO::PARAM_STR);
          $stmt->execute();
        } else {
          // Fetch all doctors
          $stmt = $conn->prepare("SELECT * FROM doctors");
          $stmt->execute();
        }

        $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Specialty filter
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['specialty'])) {
          $specialtyFilter = $_GET['specialty'];
          $filteredDoctors = array_filter($doctors, function ($doctor) use ($specialtyFilter) {
            return $doctor['specialty'] == $specialtyFilter;
          });
          $doctors = array_values($filteredDoctors); // Reset array keys
        }

        // Pagination
        $perPage = 10; // Number of rows per page
        $totalRows = count($doctors);
        $totalPages = ceil($totalRows / $perPage);
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($currentPage - 1) * $perPage;
        $paginatedDoctors = array_slice($doctors, $offset, $perPage);
        ?>
        <h4 class="card-title mb-5 mt-5" style="text-align: left; border-bottom: 1px solid  #267f89;margin-top:15%">Statistiques de la Ville</h4>

        <div class="row justify-content-center mb-5 mt-5">
          <div class="col-md-8">
            <div class="card-body">
              <div class="d-flex">
                <form action="" method="POST" class="input-group">
                  <input type="text" class="form-control" placeholder="Entrer Email ou CIN" name="searchEmail">
                  <button class="btn btn-primary" type="submit" style="background-color:  #267f89;">chercher</button>
                </form>
                <form action="" method="GET" class="input-group ms-3">
                  <select class="form-control" id="specialtyFilter" name="specialty" onchange="this.form.submit()">
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
                        <th scope="col">Nome Complète</th>
                        <th scope="col">Email</th>
                        <th scope="col">CIN</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Specialty</th>
                        <th scope="col">Confirmer</th>
                        <th scope="col">Details</th>
                        <th scope="col">Supprimer</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($paginatedDoctors as $doctor) : ?>
                        <tr>
                          <td><?php echo "Dr"." ".$doctor['fullname']; ?></td>
                          <td><?php echo $doctor['emailD']; ?></td>
                          <td><?php echo $doctor['cin']; ?></td>
                          <td><?php echo $doctor['phoneD']; ?></td>
                          <td><?php echo $doctor['specialty']; ?></td>
                          <td><?php echo $doctor['confirm']; ?></td>
                          <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#doctorModal<?php echo $doctor['doctorID']; ?>">Details</button>
                          </td>
                          <td>
                            <form action="" method="POST">
                              <input type="hidden" name="delete_id" value="<?php echo $doctor['doctorID']; ?>">
                              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                          </td>


                        </tr>

                        <!-- Doctor Modal -->
                        <div class="modal fade modal-lg" id="doctorModal<?php echo $doctor['doctorID']; ?>" tabindex="-1" aria-labelledby="doctorModalLabel<?php echo $doctor['doctorID']; ?>" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="doctorModalLabel<?php echo $doctor['doctorID']; ?>">Doctor Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    <?php
                                    $profileImage = $doctor['imageD'];
                                    if ($profileImage === null) {
                                      if ($doctor['gender'] === 'Femme') {
                                        echo '<img src="./img/defaultFemme.jpg" alt="Profile Image" class="img-fluid" style=" max-height:30vh; ">';
                                      } elseif ($doctor['gender'] === 'Homme') {
                                        echo '<img src="./img/defaultHomme.jpg" alt="Profile Image" class="img-fluid"  style=" max-height:5vh; ">';
                                      } else {
                                        echo '<img src="default-image.jpg" alt="Profile Image" class="img-fluid">';
                                      }
                                    } else {
                                      echo '<img src="data:image/jpeg;base64,' . base64_encode($profileImage) . '" alt="Profile Image" class="img-fluid"  style=" max-height:30vh; max-width:20vh; ">';
                                    }
                                    ?>
                                  </div>
                                  <div class="col-md-6 mb-5">
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($doctor['cpemimg']); ?>" alt="CPEM Image" class="img-fluid">
                                  </div>
                                </div>
                                <p><strong>Full Name: </strong><?php echo "Dr." . $doctor['fullname']; ?></p>
                                <p><strong>Email: </strong><?php echo $doctor['emailD']; ?></p>
                                <p><strong>Phone: </strong><?php echo $doctor['phoneD']; ?></p>
                                <p><strong>Specialty: </strong><?php echo $doctor['specialty']; ?></p>
                                <p><strong>Ville: </strong><?php echo $doctor['citynameD']; ?></p>
                                <p><strong>genre: </strong><?php echo $doctor['gender']; ?></p>
                                <!-- <p><strong>Email: </strong><?php echo $doctor['emailD']; ?></p> -->
                                <?php if ($doctor['websiteLink'] !== null) : ?>
                                  <p><strong>Website Link: </strong><?php echo $doctor['websiteLink']; ?></p>
                                <?php endif; ?>
                                <p><strong>Rating: </strong>
                                  <?php
                                  $rating = $doctor['rating'];

                                  if ($rating !== null && $rating !== 0) {
                                    $wholeStars = floor($rating);
                                    $halfStar = $rating - $wholeStars;

                                    // Display whole stars
                                    for ($i = 1; $i <= $wholeStars; $i++) {
                                      echo '<span class="text-warning">&#9733;</span>';
                                    }

                                    // Display half star if applicable
                                    if ($halfStar >= 0.5) {
                                      echo '<span class="text-warning">&#9733;</span>';
                                    } elseif ($halfStar > 0) {
                                      echo '<span class="text-warning">&#189;</span>'; // Half-star representation
                                    }

                                    // Display the first decimal place
                                    echo ' ' . number_format($rating, 1);
                                  } else {
                                    echo '0'; // Display 0 stars
                                  }
                                  ?>
                                </p>

                                <div style="width: 100%; height: 400px;">
                                  <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo $doctor['localisation']; ?>&z=15&output=embed" aria-label="Embedded Google Map"></iframe>
                                </div>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- End Doctor Modal -->
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

      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
    </div>
  </div>

  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  <script src="dashboard.js"></script>
</body>

</html>
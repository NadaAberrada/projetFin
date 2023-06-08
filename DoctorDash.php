<?php
session_start();
try {
  $pdo = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}

if (isset($_SESSION['DoctorID']) && !empty($_SESSION['DoctorID'])) {
  $DoctorId = $_SESSION['DoctorID'];
  $stmt = $pdo->prepare("SELECT * FROM doctors WHERE doctorId = :id");
  $stmt->execute([':id' => $DoctorId]);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
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
  <title>Dashboard Template Â· Bootstrap v5.3</title>



  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsEhcYf-NZNlL6-FVHfT1GT3XAth8EJk4&callback=initMap" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

  

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
      border: 0px;
    }

    body {

      font-family: 'Poppins', sans-serif;

    }
    #map {
      width: 100%;
      height: 300px;
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





      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 text-center ">

        <div class="container rounded bg-white ">
          <div class="row">
            <div class="col-md-4 border-right">
              <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" src="image.php?doctorId=<?php echo $DoctorId; ?>" width="200">
              </div>
            </div>

            <div class="col-md-8">
              <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                <button class="btn btn-secondary ms-auto d-none" id="cancel-edit-btn">Cancel</button>

                  <button class="btn btn-primary ms-auto" id="edit-profile-btn">Edit Profile</button>

                </div>
                <div class="row mt-2">
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $result['fullname']; ?>" disabled>
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $result['emailD']; ?>" disabled>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-6">
                    <input type="text" class="form-control" value="<?php echo $result['cin']; ?>" disabled>
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $result['phoneD']; ?>" disabled>
                  </div>
                </div>    
                <div class="row mt-3">
                  <div class="col-md-6"><input type="text" id="city-input" class="form-control" value="<?php echo $result['citynameD']; ?>" disabled>

                    <!-- City name as select -->
                    <select class="form-select d-none" id="city-select" name="citynameD">
                      <option selected disabled value="">Choisissez une ville</option>
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
                  <div class="col-md-6">
                    <input type="text" class="form-control" value="<?php echo $result['specialty']; ?>" disabled>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="websiteLink" placeholder="si vous avez un siteWeb,mettez le lien ici" value="<?php echo $result['websiteLink']; ?>" disabled>
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" value="<?php echo $result['gender']; ?>" disabled>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-6">
                  <div style="width: 100%; height: 125px;">
    <div id="map" class="d-none"></div>
    <iframe id="map-iframe" width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo  $result['localisation']; ?>&z=15&output=embed" aria-label="Embedded Google Map"></iframe>
</div>

                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="description" placeholder="Rédigez une description de vous-même" value="<?php echo $result['description']; ?>" style="height: 20vh;" disabled>
                  </div>
                </div>


                <!-- <div class="mt-5 text-right"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div> -->
              </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
let map, marker;

let savedPosition = {
    lat: parseFloat('<?php echo explode(",", $result["localisation"])[0]; ?>'),
    lng: parseFloat('<?php echo explode(",", $result["localisation"])[1]; ?>')
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
    });
} 

              $(document).ready(function() {
    $("#edit-profile-btn").click(function() {
        var isEdit = $(this).text() === "Edit Profile"; 

        if (isEdit) {
            // if the button is in "Edit" mode, enable the fields and change the button text to "Save"
            $("input[name='name'], input[name='email'], input[name='phone'], select[name='citynameD'], input[name='websiteLink'], input[name='description']").prop("disabled", false);
            $("#city-input").addClass('d-none');
            $("#city-select").removeClass('d-none').val($("#city-input").val());
            $("#map").removeClass('d-none');
            $("#map-iframe").addClass('d-none');

            $(this).text("Save");
        } else {
            // if the button is in "Save" mode, disable the fields, save the changes (if necessary), and change the button text back to "Edit"
            $("input[name='name'], input[name='email'], input[name='phone'], select[name='citynameD'], input[name='websiteLink'], input[name='description']").prop("disabled", true);
            $("#city-input").val($("#city-select").val()).removeClass('d-none');
            $("#city-select").addClass('d-none');
            $("#map").addClass('d-none');
            $("#map-iframe").removeClass('d-none');
            
            $(this).text("Edit Profile");

            // gather all data
            let data = {
                name: $("input[name='name']").val(),
                email: $("input[name='email']").val(),
                phone: $("input[name='phone']").val(),
                websiteLink: $("input[name='websiteLink']").val(),
                description: $("input[name='description']").val(),
                citynameD: isEdit ? $("#city").val() : $("#city-select").val(),
                localisation: savedPosition.lat + ',' + savedPosition.lng,
            };

            // send AJAX POST request to update profile
            $.ajax({
                url: './update_profile.php',
                type: 'POST',
                data: data,
                success: function(response) {
                    // handle success
                    console.log(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // handle error
                    console.log(textStatus, errorThrown);
                }
            });
        }
    });
});

            </script>



          </div>
        </div>
        <section>
          <div class="container py-5">
            <div class="row">
              <div class="col-lg-4">
                <div class="card mb-4 mb-lg-0">
                  <div class="card-body p-0">
                    <ul class="list-group list-group-flush rounded-3">
                      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <i class="fas fa-globe fa-lg text-warning"></i>
                        <p class="mb-0">https://mdbootstrap.com</p>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                        <p class="mb-0">mdbootstrap</p>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                        <p class="mb-0">@mdbootstrap</p>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                        <p class="mb-0">mdbootstrap</p>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                        <p class="mb-0">mdbootstrap</p>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="row">
                  <div class="col-md-6">
                    <div class="card mb-4 mb-md-0">
                      <div class="card-body">
                        <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                        </p>
                        <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                        <div class="progress rounded" style="height: 5px;">
                          <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                        <div class="progress rounded" style="height: 5px;">
                          <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                        <div class="progress rounded" style="height: 5px;">
                          <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                        <div class="progress rounded" style="height: 5px;">
                          <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                        <div class="progress rounded mb-2" style="height: 5px;">
                          <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card mb-4 mb-md-0">
                      <div class="card-body">
                        <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                        </p>
                        <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                        <div class="progress rounded" style="height: 5px;">
                          <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                        <div class="progress rounded" style="height: 5px;">
                          <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                        <div class="progress rounded" style="height: 5px;">
                          <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                        <div class="progress rounded" style="height: 5px;">
                          <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                        <div class="progress rounded mb-2" style="height: 5px;">
                          <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

      </main>





      </table>
    </div>
  </div>
</body>

</html>
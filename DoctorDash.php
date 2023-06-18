<?php
session_start();
$_SESSION['commentsenderID'] = "doctor";
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
<?php
//boostrab
include('header.php');
?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>DocMeet</title>
  <link rel="icon" type="image/x-icon" href="./img/logoDocMeet.png">



  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsEhcYf-NZNlL6-FVHfT1GT3XAth8EJk4&callback=initMap" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>



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
        <a class="nav-link px-3 text-secondary " href="./SignOut.php">se déconnecter</a>
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
                Modifier Profile
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./searchpatientDash.php">
                <span data-feather="file" class="align-text-bottom"></span>
                Temps de travail
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./DoctorSearchDash.php">
                <span data-feather="shopping-cart" class="align-text-bottom"></span>
                Répondez à vos patients
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
                <img class="rounded-circle mt-5" src="image.php?doctorId=<?php echo $DoctorId; ?>" width="200" id="profile-img">
                <input type="file" id="img-upload" style="display: none;" accept="image/*">

              </div>
            </div>

            <div class="col-md-8">
              <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <button class="btn btn-secondary ms-auto d-none" id="cancel-edit-btn">Annuler</button>

                  <button class="btn  ms-auto" id="edit-profile-btn" style="background-color: #a61057;color:white">Modifier Profile</button>

                </div>
                <div class="row mt-2">
                  <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" name="name" value="<?php echo $result['fullname']; ?>" disabled>
                  </div>
                  <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" name="email" value="<?php echo $result['emailD']; ?>" disabled>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" value="<?php echo $result['cin']; ?>" disabled>
                  </div>
                  <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" name="phone" value="<?php echo $result['phoneD']; ?>" disabled>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-6 mb-3"><input type="text" id="city-input" class="form-control" value="<?php echo $result['citynameD']; ?>" disabled>

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
                  <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" value="<?php echo $result['specialty']; ?>" disabled>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" name="websiteLink" placeholder="si vous avez un siteWeb,mettez le lien ici" value="<?php echo $result['websiteLink']; ?>" disabled>
                  </div>
                  <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" value="<?php echo $result['gender']; ?>" disabled>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-6 mb-3">
                    <div style="width: 100%; height: 125px;">
                      <div id="map" class="d-none"></div>
                      <iframe id="map-iframe" width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo  $result['localisation']; ?>&z=15&output=embed" aria-label="Embedded Google Map"></iframe>
                    </div>

                  </div>
                  <div class="col-md-6 mb-3">
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
                let originalData = {
                  name: $("input[name='name']").val(),
                  email: $("input[name='email']").val(),
                  phone: $("input[name='phone']").val(),
                  websiteLink: $("input[name='websiteLink']").val(),
                  description: $("input[name='description']").val(),
                  citynameD: $("#city-input").val(),
                  localisation: savedPosition,
                  image: $("#profile-img").attr("src") // Added: Save the original image URL
                };
                let originalImg = originalData.image;

                $("#edit-profile-btn").click(function() {
                  var isEdit = $(this).text() === "Modifier Profile";

                  if (isEdit) {
                    // if the button is in "Edit" mode, enable the fields and change the button text to "Save"
                    $("input[name='name'], input[name='email'], input[name='phone'], select[name='citynameD'], input[name='websiteLink'], input[name='description']").prop("disabled", false);
                    $("#city-input").addClass('d-none');
                    $("#city-select").removeClass('d-none').val($("#city-input").val());
                    $("#map").removeClass('d-none');
                    $("#map-iframe").addClass('d-none');
                    $("#profile-img").css('cursor', 'pointer');

                    $(this).text("Sauvgarder");
                    $("#cancel-edit-btn").removeClass('d-none'); // Show the Cancel button
                  } else {
                    // if the button is in "Save" mode, disable the fields, save the changes (if necessary), and change the button text back to "Edit"
                    $("input[name='name'], input[name='email'], input[name='phone'], select[name='citynameD'], input[name='websiteLink'], input[name='description']").prop("disabled", true);
                    $("#city-input").val($("#city-select").val()).removeClass('d-none');
                    $("#city-select").addClass('d-none');
                    $("#map").addClass('d-none');
                    $("#map-iframe").removeClass('d-none');
                    $("#profile-img").css('cursor', 'default');

                    $(this).text("Edit Profile");
                    $("#cancel-edit-btn").addClass('d-none'); // Hide the Cancel button

                    let formData = new FormData();
                    let fileData = $("#img-upload")[0].files[0];
                    //$("#img-upload")[0].files[0] is a way to access the first selected file
                    // from the file input element with the ID "img-upload" using plain JavaScript syntax on the DOM element.
                    if (fileData) {
                      formData.append('profile_img', fileData);
                    }

                    // Append the rest of the data to formData
                    formData.append('name', $("input[name='name']").val());
                    formData.append('email', $("input[name='email']").val());
                    formData.append('phone', $("input[name='phone']").val());
                    formData.append('websiteLink', $("input[name='websiteLink']").val());
                    formData.append('description', $("input[name='description']").val());
                    formData.append('citynameD', isEdit ? $("#city").val() : $("#city-select").val());
                    formData.append('localisation', savedPosition.lat + ',' + savedPosition.lng);

                    // send AJAX POST request to update profile
                    $.ajax({
                      url: './update_profile.php',
                      type: 'POST',
                      data: formData,
                      contentType: false,
                      processData: false,
                      success: function(response) {
                        // handle success
                        console.log(response);
                        location.reload(); // Reload the page to show the new image
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                        // handle error
                        console.log(textStatus, errorThrown);
                      }
                    });
                  }
                });
                $("#cancel-edit-btn").click(function() {
                  console.log(originalImg); // log the original image url
                  $("input[name='name']").val(originalData.name);
                  $("input[name='email']").val(originalData.email);
                  $("input[name='phone']").val(originalData.phone);
                  $("input[name='websiteLink']").val(originalData.websiteLink);
                  $("input[name='description']").val(originalData.description);
                  $("#city-input").val(originalData.citynameD);
                  $("#city-select").val(originalData.citynameD);

                  $("#city-input").removeClass('d-none');
                  $("#city-select").addClass('d-none');
                  $("#map").addClass('d-none');
                  $("#map-iframe").removeClass('d-none');

                  $("input[name='name'], input[name='email'], input[name='phone'], select[name='citynameD'], input[name='websiteLink'], input[name='description']").prop("disabled", true);

                  savedPosition = originalData.localisation;
                  marker.setPosition(savedPosition);

                  $("#edit-profile-btn").text("Modifier Profile");
                  $(this).addClass('d-none'); // Hide the Cancel button

                  // Remove the selected image
                  $("#img-upload").val('');
                  // Request the original image from the server
                  $("#profile-img").attr("src", "image.php?doctorId=" + <?php echo $_SESSION['DoctorID']; ?>);
                });

                $("#profile-img").click(function() {
                  if ($("#edit-profile-btn").text() === "Sauvgarder") {
                    $("#img-upload").click();
                  }
                });

                $("#img-upload").change(function() {
                  if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                      $('#profile-img').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(this.files[0]);
                  }
                });
              });
            </script>



          </div>
        </div>
        <section>
          <div class="container">
            <h4 class="card-title mb-5 mt-5" style="text-align: left; border-bottom: 1px solid  #267f89;margin-top:15%">Horaires de travail</h4>

            <p class="mb-5">S'il vous plaît insérer votre temps de travail si vous ne l'avez pas fait avant,</br> vous avez également le droit de mettre à jour votre temps de travail.</p>
            <?php
            // Assuming you have established the database connection
            $pdo = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
            $doctorId = $_SESSION['DoctorID'];

            // Retrieve the doctor's work time from the database
            $sql = "SELECT * FROM time WHERE doctor_id = :doctorId";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':doctorId' => $doctorId]);
            $workTime = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if the doctor's work time exists
            $workTimeExists = ($stmt->rowCount() > 0);
            ?>
            <form id="work-time-form" method="POST">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Jour</th>
                    <th>Heure de début</th>
                    <th>Heure de fin</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Lundi</td>
                    <td><input type="time" name="monday_start" class="form-control" value="<?php echo $workTimeExists ? $workTime['monday_start'] : ''; ?>" required></td>
                    <td><input type="time" name="monday_end" class="form-control" value="<?php echo $workTimeExists ? $workTime['monday_end'] : ''; ?>" required></td>
                  </tr>
                  <tr>
                    <td>Mardi</td>
                    <td><input type="time" name="tuesday_start" class="form-control" value="<?php echo $workTimeExists ? $workTime['tuesday_start'] : ''; ?>" required></td>
                    <td><input type="time" name="tuesday_end" class="form-control" value="<?php echo $workTimeExists ? $workTime['tuesday_end'] : ''; ?>" required></td>
                  </tr>
                  <tr>
                    <td>Mercredi</td>
                    <td><input type="time" name="wednesday_start" class="form-control" value="<?php echo $workTimeExists ? $workTime['wednesday_start'] : ''; ?>" required></td>
                    <td><input type="time" name="wednesday_end" class="form-control" value="<?php echo $workTimeExists ? $workTime['wednesday_end'] : ''; ?>" required></td>
                  </tr>
                  <tr>
                    <td>Jeudi</td>
                    <td><input type="time" name="thursday_start" class="form-control" value="<?php echo $workTimeExists ? $workTime['thursday_start'] : ''; ?>" required></td>
                    <td><input type="time" name="thursday_end" class="form-control" value="<?php echo $workTimeExists ? $workTime['thursday_end'] : ''; ?>" required></td>
                  </tr>
                  <tr>
                    <td>Vendredi</td>
                    <td><input type="time" name="friday_start" class="form-control" value="<?php echo $workTimeExists ? $workTime['friday_start'] : ''; ?>" required></td>
                    <td><input type="time" name="friday_end" class="form-control" value="<?php echo $workTimeExists ? $workTime['friday_end'] : ''; ?>" required></td>
                  </tr>
                  <tr>
                    <td>Samedi</td>
                    <td><input type="time" name="saturday_start" class="form-control" value="<?php echo $workTimeExists ? $workTime['saturday_start'] : ''; ?>" required></td>
                    <td><input type="time" name="saturday_end" class="form-control" value="<?php echo $workTimeExists ? $workTime['saturday_end'] : ''; ?>" required></td>
                  </tr>
                </tbody>
              </table>
              <div class="d-grid gap-2 col-6 mx-auto mt-5">
                <button type="submit" id="save-btn" class="btn " style="background-color: #a61057;color:white" <?php echo $workTimeExists ? ' style="display: none;"' : ''; ?>>sauvegarder</button>
                <button type="submit" id="update-btn" class="btn " style="background-color: #a61057;color:white" <?php echo $workTimeExists ? '' : ' style="display: none;"'; ?>>Modifier</button>
              </div>

            </form>
          </div>
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <script>
            $(document).ready(function() {
              $.ajax({
                url: "check-doctor-row.php",
                method: "POST",
                success: function(response) {
                  if (response === "exists") {
                    // Doctor's row exists, show the Update button
                    $("#save-btn").hide();
                    $("#update-btn").show();
                    var workTimes = response.workTimes;

                    $.each(workTimes, function(day, times) {
                      $("input[name='" + day + "_start']").val(times.start);
                      $("input[name='" + day + "_end']").val(times.end);



                    });

                  } else {
                    // Doctor's row does not exist, show the Save button
                    $("#save-btn").show();
                    $("#update-btn").hide();
                  }
                },
                error: function() {
                  console.log("An error occurred while checking doctor's row.");
                }
              });


              $("#work-time-form").submit(function(e) {
                e.preventDefault(); // Prevent form submission

                // Serialize the form data
                var formData = $(this).serialize();

                // Send an AJAX request to the PHP script
                $.ajax({
                  url: "insert-work-time.php",
                  method: "POST",
                  data: formData,
                  success: function(response) {
                    if (response === "success") {
                      console.log("Horraire de travail économisé avec succès.");
                      // After successful submission, hide Save button and show Update button
                      $("#save-btn").hide();
                      $("#update-btn").show();
                    } else {
                      console.log("Horriare de travail économisé avec succès.");
                      $("#save-btn").hide();
                      $("#update-btn").show();
                    }
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                    alert("An error occurred while saving the work time.");
                  }
                });
              });
              $("#update-btn").click(function(e) {
                e.preventDefault(); // Prevent form submission

                // Serialize the form data
                var formData = $("#work-time-form").serialize();

                // Send an AJAX request to the PHP script
                $.ajax({
                  url: "update-work-time.php", // Make sure to create this PHP file
                  method: "POST",
                  data: formData,
                  success: function(response) {
                    if (response === "success") {
                      alert("Horraire de travail économisé avec succès.");
                    } else {
                      alert("Failed to update work time.");
                    }
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                    alert("An error occurred while updating the work time.");
                  }
                });
              });

            });
          </script>



    </div>
    </section>
    <?php include('container.php'); ?>
    <div class="container" style="width:80%;margin-right:1%;margin-top:8%">
      <h4 class="card-title mb-5 mt-5" style="text-align: left; border-bottom: 1px solid  #267f89;margin-top:15%">Répondez à vos patients</h4>

      <form method="POST" id="commentForm">

        <div class="form-group">
          <textarea name="comment" id="comment" class="form-control" placeholder="Entrez un commentaire" rows="5" required></textarea>
        </div>
        <span id="message"></span>
        <br>
        <div class="form-group">
          <input type="hidden" name="commentId" id="commentId" value="0" />
          <input type="submit" name="submit" id="submit" style="background-color: #a61057;color:white" class="btn btn-primary" value="Répondre" />
        </div>
      </form>
      <div id="showComments"></div>
    </div>
    </main>





    <script>
      $(document).ready(function() {
        console.log('Document ready');
        showComments();
        console.log('Show comments function called');
        $('#commentForm').on('submit', function(event) {
          console.log('Submit event triggered');
          event.preventDefault();
          console.log('Event default prevented');
          var formData = $(this).serialize();
          console.log('Form data serialized: ', formData);
          $.ajax({
            url: "./comments2.php",
            method: "POST",
            data: formData,
            dataType: "JSON",
            success: function(response) {
              console.log('AJAX success callback triggered with response: ', response);
              if (!response.error) {
                console.log('No error in response');
                $('#commentForm')[0].reset();
                console.log('Form reset');
                $('#commentId').val('0');
                console.log('CommentId reset');
                $('#message').html(response.message);
                console.log('Message updated');
                showComments();
                console.log('Show comments function called');
              } else {
                console.log('Error in response');
                $('#message').html(response.message);
                console.log('Message updated with error');
              }
            }
          });
          console.log('AJAX request sent');
        });
        
        $(document).on('click', '.reply', function() {
          console.log('Reply event triggered');
          var commentId = $(this).attr("id");
          console.log('CommentId retrieved: ', commentId);
          $('#commentId').val(commentId);
          console.log('CommentId set');
          $('#comment').focus();
          console.log('Focus set on comment');
        });
      });


      // function to show comments
      function showComments() {
        console.log('Show comments function triggered');
        $.ajax({
          url: "./show_comments.php",
          method: "GET",
          success: function(response) {
            console.log('AJAX success callback triggered with response: ', response);
            $('#showComments').html(response);
            console.log('Comments updated');
          }

        });
        console.log('AJAX request sent');
      }
    </script>
  </div>
  </div>
</body>

</html>
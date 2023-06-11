<?php
session_start();
$patientID = $_SESSION['patientID'];
try {
    $pdo = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (isset($patientID) && !empty($patientID)) {

    $stmt = $pdo->prepare("SELECT * FROM patients WHERE patientID = :id");
    $stmt->execute([':id' => $patientID]);
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
    <title>DocMeet</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-DdP8jZiJpZ1n6UzA6U1krxrLW/rKvCmAFQaXYw+RX8bT1T19TSPzgXU6fb1UJ8WU/Lj98vFJ79QwYdBBb8WJ0A==" crossorigin="anonymous" referrerpolicy="no-referrer">


    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" /> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" /> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous" defer></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script> -->

    <link rel="stylesheet" href="./PatientCSS.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./formPatientRe.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./landingpage.css?php echo time(); ?>">


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


            <div class="modal fade" id="deleteDoctor" tabindex="-1" aria-labelledby="SavenoticeModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content  ">
                <div class="modal-header">

                </div>
                <div class="modal-body">
                    <!--  data will be dynamically inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom  text" data-bs-dismiss="modal" style="background-color:#a61057 ;color:white;">Close</button>
                </div>
            </div>
        </div>
    </div>


            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 text-center ">

                <div class="container rounded bg-white ">
                    <div class="row">
                        <div class="col-md-4 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                <img class="rounded-circle mt-5" src="imagePatient.php?patientID=<?php echo $_SESSION['patientID']; ?>" width="150" id="profile-img">


                                <input type="file" id="img-upload" style="display: none;" accept="image/*">

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
                                        <input type="text" class="form-control" name="name" value="<?php echo $result['nameP']; ?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="lastname" value="<?php echo $result['lastnameP']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="email" value="<?php echo $result['emailP']; ?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="<?php echo $result['cin']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="phone" value="<?php echo $result['phoneP']; ?>" disabled>
                                    </div>
                                    <div class="col-md-6"><input type="text" id="city-input" class="form-control" value="<?php echo $result['citynameP']; ?>" disabled>

                                        <!-- City name as select -->
                                        <select class="form-select d-none" id="city-select" name="citynameP">
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

                                </div>




                                <!-- <div class="mt-5 text-right"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div> -->
                            </div>



                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                            <script>
                                $(document).ready(function() {
                                    let originalData = {
                                        name: $("input[name='name']").val(),
                                        lastname: $("input[name='lastname']").val(),
                                        email: $("input[name='email']").val(),
                                        phone: $("input[name='phone']").val(),

                                        citynameP: $("#city-input").val(),

                                        image: $("#profile-img").attr("src") // Added: Save the original image URL
                                    };
                                    let originalImg = originalData.image;

                                    $("#edit-profile-btn").click(function() {
                                        console.log('Edit profile button clicked');
                                        var isEdit = $(this).text() === "Edit Profile";
                                        console.log('Is edit mode:', isEdit);

                                        if (isEdit) {

                                            // if the button is in "Edit" mode, enable the fields and change the button text to "Save"
                                            $("input[name='name'],input[name='lastname'], input[name='email'], input[name='phone'], select[name='citynameP']").prop("disabled", false);
                                            $("#city-input").addClass('d-none');
                                            $("#city-select").removeClass('d-none').val($("#city-input").val());


                                            $(this).text("Save");
                                            $("#cancel-edit-btn").removeClass('d-none'); // Show the Cancel button

                                        } else {
                                            // if the button is in "Save" mode, disable the fields, save the changes (if necessary), and change the button text back to "Edit"
                                            $("input[name='name'], input[name='lastname'],input[name='email'], input[name='phone'], select[name='citynameP']").prop("disabled", true);
                                            $("#city-input").val($("#city-select").val()).removeClass('d-none');
                                            $("#city-select").addClass('d-none');

                                            $("#profile-img").css('cursor', 'default');

                                            $(this).text("Edit Profile");
                                            $("#cancel-edit-btn").addClass('d-none'); // Hide the Cancel button

                                            let formData = new FormData();
                                            let fileData = $("#img-upload")[0].files[0];

                                            if (fileData) {
                                                formData.append('profile_img', fileData);
                                            }

                                            // Append the rest of the data to formData
                                            formData.append('name', $("input[name='name']").val());
                                            formData.append('lastname', $("input[name='lastname']").val());
                                            formData.append('email', $("input[name='email']").val());
                                            formData.append('phone', $("input[name='phone']").val());

                                            formData.append('citynameP', isEdit ? $("#city").val() : $("#city-select").val());
                                            console.log('Form data:', formData);

                                            // send AJAX POST request to update profile
                                            $.ajax({
                                                url: './update_profilePatient.php',
                                                type: 'POST',
                                                data: formData,
                                                contentType: false,
                                                processData: false,
                                                success: function(response) {
                                                    // handle success
                                                    console.log('Response:', response);
                                                    location.reload();; // Reload the page to show the new image
                                                },
                                                error: function(jqXHR, textStatus, errorThrown) {
                                                    // handle error
                                                    console.log('Error:', textStatus, errorThrown);
                                                }
                                            });
                                        }
                                    });
                                    $("#cancel-edit-btn").click(function() {
                                        console.log(originalImg); // log the original image url
                                        $("input[name='name']").val(originalData.name);
                                        $("input[name='lastname']").val(originalData.lastname);
                                        $("input[name='email']").val(originalData.email);
                                        $("input[name='phone']").val(originalData.phone);

                                        $("#city-input").val(originalData.citynameP);
                                        $("#city-select").val(originalData.citynameP);

                                        $("#city-input").removeClass('d-none');
                                        $("#city-select").addClass('d-none');


                                        $("input[name='name'],input[name='lastname'], input[name='email'], input[name='phone'], select[name='citynameP']").prop("disabled", true);



                                        $("#edit-profile-btn").text("Edit Profile");
                                        $(this).addClass('d-none'); // Hide the Cancel button

                                        // Remove the selected image
                                        $("#img-upload").val('');
                                        // Request the original image from the server

                                        $("#profile-img").attr("src", "imagePatient.php?patientID=" + <?php echo $_SESSION['patientID']; ?>);

                                    });
                                    $("#profile-img").click(function() {
                                        if ($("#edit-profile-btn").text() === "Save") {
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

                                function generateHtml(doctor) {
                                    return `
                    <div class="col-sm-6 col-md-6">
                    <div class="card mb-3 shadow" style="max-width: 560px;">
                        <div class="row g-0">
                        <div class="col-md-4">
                            <img src="image.php?doctorId=${doctor.doctorID}" class="profile-img img-fluid rounded-start" alt="Doctor's Picture">
                        </div>
                        <div class="col-md-7 text-center" style="padding-left: 7%;">
                            <div class="card-body">
                            <h65 class="card-title">Dr.${doctor.fullname}</h65>
                            <p class="card-text" style="color: black; font-size: 12px;">${doctor.specialty}</p>
                            <p class="card-text" style="color: black;font-size: 12px;">${doctor.citynameD}</p>
                            <form method="POST" action="PageDetailDoctor.php">
                                <input type="hidden" name="doctorId" value="${doctor.doctorID}">
                                <button type="submit" class="btn Detail">Details</button>
                                <button type="button" class="btn  Detail delete-btn" onclick="deleteDoctor(${doctor.doctorID})" style="margin-left:10px">Delete</button> <!-- Add this delete button -->

                            </form>

                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                `;
                                }


                               
                               

                                async function loadSavedDoctors() {
                                    // Fetch the saved doctor details from the PHP script
                                    fetch('./getSavedDoctors.php')
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                            }
                                            return response.json();
                                        })
                                        .then(doctors => {
                                            let html = '';
                                            doctors.forEach(doctor => {
                                                html += generateHtml(doctor);
                                            });
                                            // Append the generated HTML to the card container
                                            document.getElementById('cardContainer').innerHTML = html;
                                        })
                                        .catch(error => {
                                            console.error('There has been a problem with your fetch operation:', error);
                                        });
                                }

                                window.onload = function() {
                                    loadSavedDoctors();
                                };
                                function deleteDoctor(doctorID) {
                                    $.ajax({
                                        url: './deleteDoctor.php',
                                        type: 'POST',
                                        data: {
                                            doctorID: doctorID
                                        },
                                        success: function(response) {
                                            // Handle the response from the PHP script here
                                            var modalTitle = 'Delete Notice';
                                            var modalDescription = 'Doctor deleted successfully!';

                                            // Update the modal title and description
                                            $('#deleteDoctor .modal-title').text(modalTitle);
                                            $('#deleteDoctor .modal-body').html(modalDescription + '<br>' + response);

                                            // Show the modal
                                            $('#deleteDoctor').modal('show');

                                            // Automatically hide the modal after 10 seconds
                                            setTimeout(function() {
                                                $('#deleteDoctor').modal('hide');
                                            }, 10000);

                                            // Fade out and remove the doctor card from the UI
                                            $('#doctorCard_' + doctorID).parent().fadeOut(400, function() {
                                                $(this).remove();
                                            });
                                            loadSavedDoctors();
                                          
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                            console.error('An error occurred: ' + textStatus);
                                        }
                                      
                                    });
                                } 
                            </script>



                        </div>
                    </div>
                    <div class="container" id="searchResults" style="margin-top: 5%;">
                        <div class="row" id="cardContainer">
                            <!-- Doctor cards will be dynamically inserted here -->
                        </div>

                        <div id="paginationContainer" class="text-center d-flex justify-content-center mt-4">
                            <!-- Pagination links will be dynamically generated here -->
                        </div>
                    </div>



            </main>







        </div>
    </div>

</body>

</html>
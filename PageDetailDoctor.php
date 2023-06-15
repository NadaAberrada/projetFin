<?php
session_start();
$patientname = "Null";
$patientname = $_SESSION['patientName'];

$patientlastname =$_SESSION['patientlastName'] ;
try {
    $pdo = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
if (isset($_POST['doctorId'])) {
    $doctorId = $_POST['doctorId'];
    $_SESSION["iddoctor"] = $doctorId;
    $stmt = $pdo->prepare("SELECT * FROM doctors WHERE doctorId = :id");
    $stmt->execute([':id' => $doctorId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $patientID = $_SESSION['patientID'];

   
} else {
    echo "No doctor ID provided.";
}



?>
<?php
//boostrab
include('header.php');
?>
<script src="./js/comments.js"></script>










<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DocMeet</title>
    <link rel="icon" type="image/x-icon" href="./img/logoDocMeet.png">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./PatientCSS.css?v=<?php echo time(); ?>">
    
    <link rel="stylesheet" href="./landingpage.css?v=<?php echo time(); ?>">
    <style>
         body {
 

      font-family: 'Poppins', sans-serif;
    }

         @media (max-width: 991px) { /* 992px is the breakpoint for 'lg' in Bootstrap 4 and 5 */
        .responsive-row {
            justify-content: center !important;
            align-items: center !important;
            text-align: center;
        }
        .responsive-buttons {
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
        }
        .btn-container {
            width: 100%;
            margin-bottom: 10px;
        }
    }
        
        .profile-img {
            width: 15rem;
            height: 15rem;
            border-radius: 50%;
        }

        .bg-custom {
            background-color: #007bff;
            color: white;
        }

        .header {
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .bg-image {
            background-position: bottom;
            background-repeat: no-repeat;
            background-size: cover;
            height: 82vh;
            width: 100%;
        }

        .stars-rating .star {
            color: gray;
            cursor: pointer;
            font-size: 2em;
            margin-right: 0.5em;
            transition: color 0.2s ease-in-out;
        }

        .stars-rating .star.on {
            color: gold;
        }

        .stars-rating .star.half::after {
            content: '★';
            color: gold;
            position: absolute;
            margin-left: -1em;
            width: 0.5em;
            overflow: hidden;
        }
    </style>

</head>

<body>
   <header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #f8f8f8;height: 13vh;">
            <div class="container-fluid">

                <img src="./img/logoDocMeet.png" alt="" srcset="" style="width: 7vw; " />
                <button class="navbar-toggler " style="background-color: #2f9ba6" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon  "></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup" style="margin-right:6%;">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link navbar-text active me-5 " aria-current="page" href="./HomepagePatient.php" style="color:#1b2856">Trouver médecin</a>
                        <a class="nav-link navbar-text active me-5 " aria-current="page" href="./HomepagePatient.php" style="color:#1b2856">Listes des médecins</a>
                        <a class="nav-link navbar-text active me-5 " aria-current="page" href="./landingpage.php" style="color:#1b2856">Contact nos</a>


                        <!-- Profile picture section -->
                        <div class="nav-item dropdown me-5 ">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="imagePatient.php?patientID=<?php echo $_SESSION['patientID']; ?>" alt="Profile picture" style="width: 2vw; height: 2vw; border-radius: 50%;">
                                <span class="ps-2" style="color: black;"><?php echo  $patientname." ".$patientlastname; ?></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="./patientProfil.php">Profile</a></li>
                                <li><a class="dropdown-item" href="./patientProfil.php">Médecins préférés</a></li>
                                <!-- <li><a class="dropdown-item" href="#">Settings</a></li> -->
                                <li><a class="dropdown-item" href="./SignOutPatient.php">Déconnecter</a></li>
                            </ul>
                        </div>

                        <!-- End profile picture section -->
                    </div>
                </div>
            </div>
        </nav>
 </header>

    <div class="container py-5">
                <div class="row responsive-row" id="info">
                    <div class="col-lg-4 d-flex justify-content-center justify-content-lg-start">
                        <img src="image.php?doctorId=<?php echo $doctorId; ?>" class="profile-img " alt="Doctor's Picture">
                    </div>
                    <div class="col-lg-8">
                        <h2 class="display-4 mb-3" > <?php echo $result['fullname']; ?></h2>
                        <p class="lead"><?php echo $result['specialty']; ?></p>
                        <div class="mb-3">
                            <div class="stars-rating" data-doctor-id="<?php echo $result['doctorID']; ?>">
                                <span class="star" data-value="1">★</span>
                                <span class="star" data-value="2">★</span>
                                <span class="star" data-value="3">★</span>
                                <span class="star" data-value="4">★</span>
                                <span class="star" data-value="5">★</span>
                            </div>
                        </div>
                        <p><strong>Phone: </strong> <?php echo $result['phoneD']; ?></p>
                        <p><strong>Email: </strong><?php echo $result['emailD']; ?></p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start  responsive-buttons">
                            <a href="#myForm" class="btn-container">
                            <button class="btn btn-primary me-md-2"style="background-color: #a61057;color:white" type="button">Contacter le médecin </button>

                            </a>
                            <a href="#messagesss" class="btn-container">
                            <button class="btn btn-secondary" type="button">Laisser un commentaire</button>

                            </a>
                        </div>
                    </div>
                </div>

                <div class="row  text-center p-4"style="margin-top:13%">
                    <div class="col-lg-6 border">
                        <h3 class="border-bottom">sur moi</h3>
                        <p><?php echo $result['description']; ?></p>
                    </div>
                    <div class="col-lg-6">
                    
                        <div style="width: 100%; height: 300px;">
                            <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo  $result['localisation']; ?>&z=15&output=embed" aria-label="Embedded Google Map"></iframe>
                        </div>
                    </div>
                </div>

                <div class="row mb-5 text-center p-4">
                    <div class="col-lg-6 mt-5  ">
                        <h3 class="text-center mb-5">Contacter le médecin</h3>
                        <form id="myForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                            </div>
                            <input type="hidden" name="doctorId" value="<?php echo $result['doctorID']; ?>" />
                            <button type="submit" class="btn btn-primary  text-center mx-auto" style="background-color: #a61057;color:white" >Envoyer</button>
                        </form>
                    </div>
            

                        <div class="col-lg-6 text-center mt-5 ">
                            <h3 class="mb-5">Horaires de travail</h3>
                            <table class="table ">
                                <tbody>
                                    <tr>
                                        <th>jour</th>
                                        <th>Horaires de travail</th>
                                    </tr>
                                    <?php
                                    // Assuming you have the doctor's ID available in a variable called $doctorId
                                    $sql = "SELECT * FROM time WHERE doctor_id = $doctorId";
                                    $stmt = $pdo->query($sql);
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $workingHours = array(
                                            'Lundi' => array($row['monday_start'], $row['monday_end']),
                                            'Mardi' => array($row['tuesday_start'], $row['tuesday_end']),
                                            'Mercredi' => array($row['wednesday_start'], $row['wednesday_end']),
                                            'Jeudi' => array($row['thursday_start'], $row['thursday_end']),
                                            'Vendredi' => array($row['friday_start'], $row['friday_end']),
                                            'Samedi' => array($row['saturday_start'], $row['saturday_end']),

                                            
                                        );

                                        foreach ($workingHours as $day => $hours) {
                                            $start = $hours[0];
                                            $end = $hours[1];
                                            
                                            // Extract hours and minutes from the start and end times
                                            $startHour = substr($start, 0, 2);
                                            $startMinute = substr($start, 3, 2);
                                            $endHour = substr($end, 0, 2);
                                            $endMinute = substr($end, 3, 2);
                                            
                                            // Format the working hours with minutes
                                            $formattedStart = $startHour . ':' . $startMinute;
                                            $formattedEnd = $endHour . ':' . $endMinute;

                                            echo "<tr>";
                                            echo "<td>$day</td>";
                                            echo "<td>$formattedStart - $formattedEnd</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                </div>

 </div>
        

            <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="myModalLabel">État des messages</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <?php include('container.php'); ?>
                            <div class="container">
                                <h2>Les commentaires</h2>
                                <br>
                                <form method="POST" id="commentForm">

                                    <div class="form-group">
                                        <textarea name="comment" id="comment" class="form-control" placeholder="Enter Comment" rows="5" required></textarea>
                                    </div>
                                    <span id="messagesss"></span>
                                    <br>
                                    <div class="form-group">
                                        <input type="hidden" name="commentId" id="commentId" value="0" />
                                        <input type="submit" name="submit" id="submit" style="background-color: #a61057;color:white" class="btn btn-primary" value="commenter" />
                                    </div>
                                </form>
                                <br>
                                <div id="showComments" ></div>
                            </div>   </div>

    


    
            <script>
                $(document).ready(function() {
                    $("#myForm").on('submit', function(e) {
                        e.preventDefault();
                        var name = $("#name").val();
                        var email = $("#email").val();
                        var message = $("#message").val();
                        var doctorId = $("input[name=doctorId]").val();

                        // Simple email format validation
                        var emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
                        if (!email.match(emailRegex)) {
                            alert("Please enter a valid email address.");
                            return;
                        }

                        $.ajax({
                            url: 'contact_doctor.php',
                            method: 'post',
                            data: {
                                name: name,
                                email: email,
                                message: message,
                                doctorId: doctorId
                            },
                            success: function(data) {
                                $('.modal-body').html(data);
                                $('#myModal').modal('show');
                            },
                            error: function(err) {
                                $('.modal-body').html("An error occurred.");
                                $('#myModal').modal('show');
                            }
                        });
                    });
                });



                //show the code
                $(document).ready(function() {
                    var doctorId = $('.stars-rating').data('doctor-id');
                    var average_rating = 0;

                    // Fetch average rating from the server and display it
                    var displayRating = function() {
                        $.ajax({
                            url: 'get_average_rating.php',
                            method: 'POST',
                            data: {
                                doctorId: doctorId
                            },
                            success: function(data) {
                                average_rating = parseFloat(data);
                                var stars = $('.stars-rating .star');
                                stars.removeClass('on').removeClass('half');
                                stars.each(function() {
                                    if ($(this).data('value') <= Math.floor(average_rating)) {
                                        $(this).addClass('on');
                                    } else if ($(this).data('value') <= average_rating) {
                                        $(this).addClass('half');
                                    }
                                });
                            }
                        });
                    }
                    displayRating();
                   
                    //insert the code
                    // Handle star click to submit a rating
                    $('.stars-rating .star').on('click', function() {
                        var rating = $(this).data('value');
                        $.ajax({
                            url: 'save_rating.php',
                            method: 'POST',
                            data: {
                                rating: rating,
                                doctorId: doctorId,
                                userId:  <?php echo $patientID; ?>,
                            
                            },
                        });
                    });
                    //for design 
                    // Handle star hover to show interactive rating
                    $('.stars-rating .star').on('mouseenter', function() {
                        var hoverVal = $(this).data('value');
                        $('.stars-rating .star').each(function() {
                            if ($(this).data('value') <= hoverVal) {
                                $(this).addClass('on');
                            } else {
                                $(this).removeClass('on').removeClass('half');
                            }
                        });
                    }).on('mouseleave', function() {
                        // Restore average rating display
                        displayRating();
                    });
                });
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
   
    <footer class=" container-fluid mt-5" style="background-color: #f8f8f8;" >
        <div class="container-fluid py-3 text-center"> <!-- Add 'text-center' class here -->
            <div class="row mx-md-5 mt-5">
                <div class="col-12 col-lg-4 mb-5">
                    <h4 class="mb-4">DocMeet</h4>
                    <p>
                        <span class="">Phone : +212 625063853</span> </br></br>
                        <span class="">Email : docmeetweb@email.com</span>
                    </p>
                    <h4 class=" mt-4 " style="padding-bottom:3%">Follow Us</h4>
                    <a href="#" class="me-2 mb-2 mb-lg-0 "><i class="fab fa-facebook-square fa-2x" style="color:#a61057;"></i></a>
                    <a href="#" class="me-2 mb-2 mb-lg-0"><i class="fab fa-twitter-square fa-2x" style="color:#a61057;"></i></a>
                    <a href="#" class="me-2 mb-2 mb-lg-0"><i class="fab fa-instagram-square fa-2x" style="color:#a61057;"></i></a>
                </div>
                <div class="col-12 col-lg-4 ">
                    <div class="footer-column">
                        <h4 class="mb-4">Liens utiles</h4>
                        <ul class="footer-links">
                            <li><a href="#info">Doteur Informations</a></li>
                            <li><a href="#myForm">Contact Docteur</a></li>
                            <li><a href="./HomepagePatient.php">Trouver médecin</a></li>
                            <li><a href="./landingpage.php">Contact nos</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-4 ">
                    <div class="footer-column mt-5">

                        <ul class="footer-links">
                            <li><a href="./landingpage.php">Landing Page</a></li>
                            <li><a href="./HomepagePatient.php">Rechercher Médecine</a></li>
                            <li><a href="./HomepagePatient.php">Listes des médecins</a></li>
                            <!-- <li><a href="#Contact">Contact nos</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>




        <div class="container-fluid mt-5  py-4" style="background-color: gray;"> <!-- Add 'container-fluid' class here -->
            <p class="text-white text-center mb-0">© Copyright DocMeet 2023 - Tous droits réservés.</p>
      </div>
    </footer>
</body>
</html>
<?php
session_start();
try {
    $pdo = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
if (isset($_POST['doctorId'])) {
    $doctorId = $_POST['doctorId'];
   $_SESSION["iddoctor"]= $doctorId;
    $stmt = $pdo->prepare("SELECT * FROM doctors WHERE doctorId = :id");
    $stmt->execute([':id' => $doctorId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Now you can display the doctor's details in your HTML
    // echo "Doctor's name: " . $result['fullname'];
    // Continue for other details...
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
    <title>Doctor's Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
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
                        <a class="nav-link navbar-text active me-5 " aria-current="page" href="./HomepagePatient.php" style="color:#1b2856">page d'accueil</a>
                        <a class="nav-link navbar-text active me-5 " aria-current="page" href="#" style="color:#1b2856">Landing Page</a>
                        <a class="nav-link navbar-text active me-5 " aria-current="page" href="#" style="color:#1b2856">Contact nos</a>


                        <!-- Profile picture section -->
                        <div class="nav-item dropdown me-5 ">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="./img/ali.jpg" alt="Profile picture" style="width: 2vw; border-radius: 50%;">
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </div>
                        <!-- End profile picture section -->
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4 d-flex justify-content-center justify-content-lg-start">            
                <img src="image.php?doctorId=<?php echo $doctorId; ?>" class="profile-img " alt="Doctor's Picture">
            </div>
            <div class="col-lg-8">
                <h2 class="display-4 mb-3"><?php echo $result['fullname']; ?></h2>
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
                <p><strong>Phone:</strong> <?php echo $result['phoneD']; ?></p>
                <p><strong>Email:</strong><?php echo $result['emailD']; ?></p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <button class="btn btn-primary me-md-2" type="button">Demandez au médecin</button>
                    <button class="btn btn-secondary" type="button">Laisser un commentaire</button>
                </div>
            </div>
        </div>

        <div class="row mt-5  p-4">
            <div class="col-lg-6 border">
                <h3 class="border-bottom">sur moi</h3>
                <p>Doctor's description goes here...</p>
            </div>
            <div class="col-lg-6">
                <h3>Location</h3>
                <div style="width: 100%; height: 400px;">
                    <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo  $result['localisation']; ?>&z=15&output=embed" aria-label="Embedded Google Map"></iframe>
                </div>
            </div>
        </div>

        <div class="row mt-5  p-4">
            <div class="col-lg-6 border">
                <h3 class="border-bottom">Contact Doctor</h3>
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-lg-6  text-center ">
                <!-- <h3 class="">Working Hours</h3> -->
                <table class="table border">
                    <tbody>
                        <tr>
                            <th colspan="4">Working Hours</th>

                        </tr>
                        <tr>
                            <td>Monday</td>
                            <td>8 AM - 5 PM</td>
                        </tr>
                        <tr>
                            <td>Tuesday</td>
                            <td>8 AM - 5 PM</td>
                        </tr>
                        <tr>
                            <td>Wednesday</td>
                            <td>8 AM - 5 PM</td>
                        </tr>
                        <tr>
                            <td>Thursday</td>
                            <td>8 AM - 5 PM</td>
                        </tr>
                        <tr>
                            <td>Friday</td>
                            <td>8 AM - 5 PM</td>
                        </tr>
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
        <h1 class="modal-title fs-5" id="myModalLabel">Message Status</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php include('container.php');?>
	<div class="container">		
		<h2>Example: Comment System with Ajax, PHP & MySQL</h2>		
		<br>		
		<form method="POST" id="commentForm">
			
			<div class="form-group">
				<textarea name="comment" id="comment" class="form-control" placeholder="Enter Comment" rows="5" required></textarea>
			</div>
			<span id="message"></span>
			<br>
			<div class="form-group">
				<input type="hidden" name="commentId" id="commentId" value="0" />
				<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Post Comment" />
			</div>
		</form>		
		<br>
		<div id="showComments"></div>   
</div>	




    <!-- <footer class="py-3 bg-custom text-center">
        <p class="mb-0">© 2023 HealthCare Corp. All rights reserved.</p>
    </footer> -->
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
                        userId: '2'
                        // dik sa3a zidla userId: ?php echo $_SESSION['userId']; ?>
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

</html>
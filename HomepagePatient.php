<?php
session_start();
$patientID = $_SESSION['patientID'];


$patientnam = $_SESSION['patientName'];

$patientlastname =$_SESSION['patientlastName'] ;

try {
    $pdo = new PDO("mysql:host=localhost;dbname=docmeet;port=3306;charset=UTF8", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch all doctors if no search criteria provided
if (empty($_POST["searchName"]) && empty($_POST["searchSpecialty"]) && empty($_POST["searchCity"])) {
    $stmt = $pdo->query("SELECT * FROM doctors WHERE confirm='oui'");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Perform search query based on provided search criteria
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $searchName = $_POST["searchName"] ?? "";
        $searchSpecialty = $_POST["searchSpecialty"] ?? "";
        $searchCity = $_POST["searchCity"] ?? "";

        $sql = "SELECT * FROM doctors WHERE 1=1";

        $params = array();

        if (!empty($searchName)) {
            $sql .= " AND fullname LIKE :fullname";
            $params[":fullname"] = "%$searchName%";
        }

        if (!empty($searchSpecialty)) {
            $sql .= " AND specialty = :specialty";
            $params[":specialty"] = $searchSpecialty;
        }

        if (!empty($searchCity)) {
            $sql .= " AND citynameD = :citynameD";
            $params[":citynameD"] = $searchCity;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-DdP8jZiJpZ1n6UzA6U1krxrLW/rKvCmAFQaXYw+RX8bT1T19TSPzgXU6fb1UJ8WU/Lj98vFJ79QwYdBBb8WJ0A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="./PatientCSS.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./formPatientRe.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./landingpage.css?v=<?php echo time(); ?>">


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
                        <a class="nav-link navbar-text active me-5 " aria-current="page" href="#search" style="color:#1b2856">Trouver médecin</a>
                        <a class="nav-link navbar-text active me-5 " aria-current="page" href="#searchResults" style="color:#1b2856">Listes des médecins</a>
                        <a class="nav-link navbar-text active me-5 " aria-current="page" href="./landingpage.php" style="color:#1b2856">Contact nos</a>


                        <!-- Profile picture section -->
                        <div class="nav-item dropdown me-5 ">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="imagePatient.php?patientID=<?php echo $_SESSION['patientID']; ?>" alt="Profile picture" style="width: 2vw; height: 2vw; border-radius: 50%;">
                                <span class="ps-2" style="color: black;"><?php echo  $patientnam." ".$patientlastname; ?></span>
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

    <div class="modal fade" id="SaveDoctor" tabindex="-1" aria-labelledby="SavenoticeModalLabel" aria-hidden="true">
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

    <div class="bg-image d-flex align-items-center flex-column bd-highlight text-center " style="background-image: url('./img/bg_search.jpg');color:white">
        <h1 class="display-5 fw-bold pt-5 bd-highlight mt-5 text-capitalize">
            <span class="fw-lighter" id="form">Découvrez votre médecin idéal</span>
            <br>
            en un seul clic
        </h1>

        <p class="sousTitre fw-lighter text-capitalize "  style=" font-size: 35px;"></p>

        <div class="s01">
            <form method="post">

                <div class="inner-form">
                    <div class="input-field first-wrap">
                        <input id="search" name="searchName" type="text" placeholder="Nomou/etprénom" />
                    </div>
                    <div class="input-field second-wrap me-2">

                        <select id="location" name="searchSpecialty" class="select-field">
                            <option selected disabled>Spécialité</option>
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
                    <div class="input-field second-wrap">

                        <select id="location" name="searchCity" class="select-field" placeholder="location">
                            <option selected disabled>Ville</option>
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

                    <div class="input-field third-wrap">
                        <button class="btn-search" type="submit"><i class="fas fa-search"></i> Rechercher</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Display search results -->

    <div class="container" id="searchResults" style="margin-top: 5%;">
        <?php if (!empty($results)) : ?>
            <div class="row" id="cardContainer">
                <?php foreach ($results as $result) : ?>
                    <div class="col-sm-6 col-md-6">
                        <div class="card mb-3 shadow" style="max-width: 540px;">
                            <div class="row g-0">
                            <div class="col-md-4   ">
                                    <?php if (!empty($result['imageD'])) : ?>
                                        <?php
                                        $imageData = base64_encode($result['imageD']);
                                        $src = 'data:image/jpeg;base64,' . $imageData;
                                        ?>
                                        <img src="<?php echo $src; ?>" class="img-fluid rounded-start" alt="...">
                                    <?php else : ?>
                                        <?php if ($result['gender'] === 'Femme') : ?>
                                            <img src="./img/patientFemmeImg.jpg" class="img-fluid rounded-start" alt="Default Female Image">
                                        <?php elseif ($result['gender'] === 'Homme') : ?>
                                            <img src="./img/patientHommeImg.jpg" class="img-fluid rounded-start" alt="Default Male Image">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-7 text-center" style="padding-left:7%;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $result['fullname']; ?></h5>
                                        <p class="card-text"><?php echo $result['specialty']; ?></p>
                                        <p class="card-text"><?php echo $result['citynameD']; ?></p>
                                        <form method="POST" action="PageDetailDoctor.php">
                                            <input type="hidden" name="doctorId" value="<?php echo $result['doctorID']; ?>">
                                            <button type="submit" class="btn  Detail">Details</button>
                                            <button type="button" class="btn btn-custom" style="margin-left:10px;" onclick="SaveDoctor('<?php echo $result['doctorID']; ?>')">favori</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div id="paginationContainer" class="text-center d-flex justify-content-center mt-4">
                <!-- Pagination links will be dynamically generated here -->
            </div>
        <?php else : ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>
    <script>
        function SaveDoctor(id) {
            // Functionality for saving the exercise
            $.ajax({
                url: './SavedDoctor.php', // Replace this with the actual URL of your PHP page
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    // Handle the response from the PHP page here
                    var modalTitle = 'Favori Docteur'; // Set the title of the modal
                    var modalDescription = 'favori Docteur Sauvegardé avec succès !'; // Set the description

                    // Update the modal title and description
                    $('#SaveDoctor .modal-title').text(modalTitle);
                    $('#SaveDoctor .modal-body').html(modalDescription );

                    // Show the modal
                    $('#SaveDoctor').modal('show');

                    // Automatically hide the modal after 10 seconds
                    setTimeout(function() {
                        $('#SaveDoctor').modal('hide');
                    }, 10000);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('An error occurred: ' + textStatus);
                }
            });
        }
    </script>

    <div class="mt-5 section_block_5 py-3" style="background-color: #2f9ba6;">
        <p class="text-white text-center mb-0">Vous avez un problème ou une question ? Contactez-nous par E-mail</p>
    </div>

    <footer style="background-color: #f8f8f8;">
        <div class="py-3 text-center"> <!-- Add 'text-center' class here -->
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
                            <li><a href="./landingpage.php">Services aux patients</a></li>
                            <li><a href="./landingpage.php">Services aux médecins</a></li>
                            <li><a href="#search">Trouver médecin</a></li>
                            <li><a href="./landingpage.php">Contact nos</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-4 ">
                    <div class="footer-column mt-5">

                        <ul class="footer-links">
                            <li><a href="./landingpage.php">Landing Page</a></li>
                            <li><a href="#form">Rechercher Médecine</a></li>
                            <li><a href="#searchResults">Listes des médecins</a></li>
                            <!-- <li><a href="#Contact">Contact nos</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>




        <div class="mt-5  py-4" style="background-color: gray;">
            <p class="text-white text-center mb-0">© Copyright DocMeet 2023 - Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        // Number of cards to display per page
        const cardsPerPage = 4;

        // Get the card container element
        const cardContainer = document.getElementById('cardContainer');

        // Get the pagination container element
        const paginationContainer = document.getElementById('paginationContainer');

        // Get the array of card elements
        const cards = Array.from(cardContainer.getElementsByClassName('card'));

        // Function to show the specified range of cards
        function showCards(startIndex, endIndex) {
            // Hide all cards
            cards.forEach(card => card.style.display = 'none');

            // Show the cards within the specified range
            for (let i = startIndex; i <= endIndex; i++) {
                if (cards[i]) {
                    cards[i].style.display = 'block';
                }
            }
        }

        // Function to generate the pagination links
        function generatePagination() {
            // Calculate the total number of pages
            const totalPages = Math.ceil(cards.length / cardsPerPage);

            // Clear the pagination container
            paginationContainer.innerHTML = '';

            // Create the pagination element structure
            const nav = document.createElement('nav');
            nav.setAttribute('aria-label', 'Page navigation example');

            const ul = document.createElement('ul');
            ul.classList.add('pagination');

            // Create the numbered page buttons
            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.classList.add('page-item');
                const link = document.createElement('a');
                link.classList.add('page-link');
                link.href = '#';
                link.innerText = i;
                li.appendChild(link);
                ul.appendChild(li);
            }

            // Append the pagination elements to the container
            nav.appendChild(ul);
            paginationContainer.appendChild(nav);

            // Add event listeners to the page buttons
            const pageLinks = ul.getElementsByClassName('page-link');
            for (let i = 0; i < pageLinks.length; i++) {
                const link = pageLinks[i];
                const pageNumber = i + 1;
                link.addEventListener('click', function() {
                    const startIndex = (pageNumber - 1) * cardsPerPage;
                    const endIndex = startIndex + cardsPerPage - 1;
                    showCards(startIndex, endIndex);
                });
            }

            // Show the first page of cards by default
            showCards(0, cardsPerPage - 1);
        }

        // Generate the initial pagination
        generatePagination();
    </script>
</body>


</html>
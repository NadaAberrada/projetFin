<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link href="./DoctorCSS.css" rel="stylesheet" />
   
</head>

<body>
    <header class="header">
        <a href="#" class="logo">
            <img src="./img/logoOfMySiteWeb.png" alt="YourBrand Logo" class="logo-img">
        </a>
        <button type="button" class="btn custom-btn col-5 col-lg-2 ">Sign In</button>
    </header>

    <main class="container-fluid">
        <section class="section">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./img/bg_search.jpg" class="d-block w-100" alt="Image 1">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Title 1</h3>
                            <button class="btn btn-primary">Button 1</button>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="./img/doctorHeader.jpg" class="d-block w-100" alt="Image 2">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Title 2</h3>
                            <button class="btn btn-primary">Button 2</button>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="./img/famelProfil.png" class="d-block w-100" alt="Image 3">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Title 3</h3>
                            <button class="btn btn-primary">Button 3</button>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>


        <section class="section d-flex flex-column align-items-center">
            <h1 class="text-center" style="color: #2f9ba6; font-size: 2rem;">Ce que vous pouvez faire avec BooKMYDoctor</h1>
            <a href="#marketing" id="marketing" class="icon-scroll"></a>
        </section>

        <section class="section">
            <div class="row">
                <!-- Repeat the following card structure for each card -->
                <div class="col-md-4">
                    <div class="card custom-card">
                        <div class="card-body text-center">
                            <div class="icon-circle">
                                <i class="fas fa-calendar-alt" style="font-size: 70px;"></i>
                            </div>
                            <h3 class="card-title">Agenda</h3>
                            <p class="card-text" style=" font-size: 20px;">Optimiser la gestion de votre emploi du temps et de vos rendez-vous en temps réel 
                            avec notre outil facile à utiliser.</br>  </br> </p>
                        </div>
                    </div>
                </div>
                <!-- End of card structure -->
                <div class="col-md-4">
                    <div class="card custom-card">
                        <div class="card-body text-center">
                            <div class="icon-circle">
                                <i class="far fa-folder-open" style="font-size: 70px;"></i>
                            </div>
                            <h3 class="card-title">Dossier patient digitalisé</h3>

                            <p class="card-text" style=" font-size: 20px;">Accéder aux dossiers de vos patients en toute sécurité et confidentialité 24h/24 et 7j/7 avec notre plateforme de dossier patient digital.</p>
                        </div>
                    </div>
                </div>
                <!-- End of card structure -->
                <div class="col-md-4">
                    <div class="card custom-card">
                        <div class="card-body text-center">
                            <div class="icon-circle">
                                <i class="fa-solid fa-cog" style="font-size: 70px;"></i>
                            </div>
                            <h3 class="card-title">Gestion des rendez-vous</h3>

                            <p class="card-text" style=" font-size: 20px;">Organiser votre emploi du temps en ligne et permettez à vos patients de prendre rendez-vous en ligne depuis leur ordinateur ou leur portable.</p>
                        </div>
                    </div>
                </div>
                <!-- End of card structure -->

                <!-- End of card structure -->
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <img src="./img/agenda.png" alt="Image description">
                    </div>
                    <div class="col-md-7">
                        <h3>Un agenda personnalisé adapté à votre activité</h3>
                        <ul>
                            <li>Gestion simplifié des rendez-vous médicaux en ligne</li>
                            <li>Gérer vos horaires et motifs de consultation en un seul click</li>
                            <li>Consulter en un clic à vos prochaines rendez-vous</li>
                            <li>Gérez votre agenda depuis votre ordinateur, tablette ou smartphone</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <hr style="width:60%;text-align:center; margin:auto;">
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h3>Une forte présence sur internet grâce à votre page web</h3>
                        <ul>
                            <li>Publiez les informations clés avec vos patients : Spécialité,<br> domaines d’expertise, tarifs, horaires, informations d’accès</li>
                            <li>Soignez votre e-réputation avec des outils innovants</li>
                            <li>Faire connaitre votre cabinet à une clientèle salifiées</li>
                            <li>Suivre les statistiques de votre activité en ligne</li>
                        </ul>
                    </div>
                    <div class="col-md-5">
                        <img src="./img/forte-présence.png" alt="Image description" style=" width: 90%;">
                    </div>

                </div>
            </div>
        </section>
        <hr style="width:60%;text-align:center; margin:auto;">
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <img src="./img/section3.jpg" alt="Image description" style=" width: 85%;">
                    </div>
                    <div class="col-md-7">
                        <h3>Dossier Patient Numérique : Sécurité & Accessibilité pour les Pros de Santé</h3>
                        <ul>
                            <li>Accès sécurisé et crypté pour protéger les données sensibles.</li>
                            <li>Disponibilité 24/7 pour consulter les dossiers à tout moment.</li>
                            <li>Confidentialité garantie conformément aux régulations.</li>
                            <li>Gestion simplifiée grâce à une interface intuitive.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-primary btn-lg">Inscrivez-vous gratuitement !</button>
                    </div>
                </div>
            </div>
        </section>
        <section class="section d-flex flex-column align-items-center">
            <h1 class="text-center" style="color: #2f9ba6; font-size: 2rem;">Ils sont les ambassadeurs de DabaDoc</h1>



        </section>
        <section class="section">
            <div class="row">
                <!-- Repeat the following card structure for each card -->
                <div class="col-md-4">
                    <div class="card custom-card">
                        <div class="card-body text-center">
                            <div class="icon-circle">
                                <img src="./img/nzha.jpg" alt="Image description" style="border-radius: 50%; width: 100%;">
                            </div>
                            <h3 class="card-title">Dr. Nezha El Hattab El Ibrahimi
                                Pédiatre</h3>
                            <p class="card-text" style=" font-size: 20px;">Ça fait plus de 4 ans que nous utilisons DabaDoc dans notre cabinet et mes patients sont très satisfaits.</br>  </br> </p>
                        </div>
                    </div>
                </div>
                <!-- End of card structure -->
                <div class="col-md-4">
                    <div class="card custom-card">
                        <div class="card-body text-center">
                            <div class="icon-circle">
                                <img src="./img/leila.jpg" alt="Image description" style="border-radius: 50%; width: 100%;">
                            </div>
                            <h3 class="card-title">Dr. Leila Tazi Daoudi<br>
                                Allergologue</h3>

                            <p class="card-text" style=" font-size: 20px;">DabaDoc est un véritable avantage pour s'organiser et pouvoir consulter son planning sans être au cabinet.</br>  </br></p>
                        </div>
                    </div>
                </div>
                <!-- End of card structure -->
                <div class="col-md-4">
                    <div class="card custom-card">
                        <div class="card-body text-center">
                            <div class="icon-circle">
                                <img src="./img/ali.jpg" alt="Image description" style="border-radius: 50%; width: 100%;">
                            </div>
                            <h3 class="card-title">Dr.Ali El Kohen
                                Traumatologue,Orthopédiste</h3>

                            <p class="card-text" style=" font-size: 20px;">C’est une équipe efficace et compétente. Les rendez-vous sont très bien gérés, (...) C’est un outil indispensable pour la gestion d’un cabinet médical.</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="section">
            <div class="mt-5 section_block_5 py-3" style="background-color: #2f9ba6;">
                <p class="text-white text-center mb-3" style="font-size: 30px;">
                    <i class="fas fa-phone-alt"></i>
                    05 28 28 47 37
                </p>
                <p class="text-white text-center mb-0" style="font-size: 28px;">
                    Une question ? Appelez-nous ou contactez-nous par mail
                </p>
            </div>
        </section>



    </main>

    <footer style="background-color: #f8f8f8;">
        <div class="container py-3  text-start">
            <div class="row mx-md-5 mt-5 ">
                <div class="col-12 col-lg-4 ">

                    <h4 class="mb-4">DocMeet</h4>
                    <p class="">
                        <span class="">Phone:</span> +234 23 9873237<br>
                        <span class="">Email:</span> DocMeetWeb@email.com
                    </p>
                    <h4 class="mb-3 mt-5" style="padding-bottom:3%">Follow Us</h4>
                    <a href="#" class="me-5"><i class="fab fa-facebook-square fa-3x" style="color:#2f9ba6; "></i></a>
                    <a href="#" class="me-5"><i class="fab fa-twitter-square fa-3x" style="color:#2f9ba6;"></i></a>
                    <a href="#" class="me-5"><i class="fab fa-instagram-square fa-3x" style="color:#2f9ba6;"></i></a>


                </div>
                <div class="col-12 col-lg-4">
                    <div class="other_doc_item">Useful Links</div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="other_doc_item"> what ever</div>
                </div>
            </div>

        </div>

    </footer>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center mb-4" style="color: #2f9ba7;">Difficile de trouver un RDV de médecin ?</h2>
                    <p class="lead text-center mb-5">BooKMYDoctor est un outil innovant qui vous permet de trouver rapidement un médecin en ligne et de prendre RDV en temps réel. Retrouvez les praticiens de votre ville et prenez rendez-vous gratuitement et en un seul clic. Sur BooKMYDoctor, repérez un médecin à proximité de chez vous, trouvez toutes les informations utiles : spécialités, informations d’accès, tarifs de consultation, choisissez le créneau qui vous convient et prenez RDV en ligne gratuitement et immédiatement. Dentistes, généralistes, ophtalmologues… : Plus besoin d’appels et d’attente. Votre prise de RDV est à présent simple, rapide et efficace.</p>
                </div>
            </div>
        </div>
    </section>
    <div class="mt-5  py-4" style="background-color: gray;">
        <p class="text-white text-center mb-0 fs-5">© Copyright BooKMYDoctor 2023 - Tous droits réservés.</p>
    </div>

</body>

</html>
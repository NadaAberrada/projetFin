<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-DdP8jZiJpZ1n6UzA6U1krxrLW/rKvCmAFQaXYw+RX8bT1T19TSPzgXU6fb1UJ8WU/Lj98vFJ79QwYdBBb8WJ0A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="./formPatientRe.css" rel="stylesheet" />
    <link href="./PatientCSS.css" rel="stylesheet" />

    <!-- <style>
        .header {
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .bg-image {

            background-position: bottom;
            background-repeat: no-repeat;
            background-size: cover;
            height: 66vh;
            width: 100%;

        }

        @media screen and (max-width: 1335px) {
            .bg-image {
                background-size: cover;
                background-position: center;
            }
        }

        @media screen and (max-width: 600px) {
            .bg-image {
                background-size: cover;
                background-position: center;
            }
        }

        @media screen and (max-width: 991.25px) {
            .navbar-nav {
                background-color: white;

                border-radius: 10px;

            }

            .navbar-nav .me-5 {
                 padding-left: 40%;
            }

            .navbar-nav .question {
                  padding-left: 40%;
            }
        }

        .sousTitre {

            word-spacing: 1.2px;
            font-family: bentonsans_extralight;

        }

        .fa-stack:hover .fa-square {
            border-color: #a61057 !important;
        }

        .fa-stack:hover .fa-dollar-sign {
            color: #a61057 !important;
        }


        .fa-stack:hover .fa-user {
            color: #a61057 !important;
        }


        .fa-stack:hover .fa-calendar-alt {
            color: #a61057 !important;
        }


        .fa-stack:hover .fa-stethoscope {
            color: #a61057 !important;
        }

        .fa-stack {
            font-size: 2.5em;
        }

        .icon-title {
            margin-top: 5px;
            font-weight: thin;
        }

        .medecin_box {
            background-color: #2f9ba6;
            background-image: url(./img/doc.png);
            background-position: 100% 100%;
            background-repeat: no-repeat;
            border-radius: 8px;
            color: #fff;
            font-family: bentonsansregular;
            font-size: 20px;
            padding: 30px;
            width: 100%;
            max-width: 536px;
            margin: auto;
        }

        .md_title {
            color: #2f9ba6;
            /* font-family: terminal_dosissemibold; */
            font-size: 4vw;
            margin-bottom: 20px;
            text-align: center;
        }

        .md_title span {
            color: #6d6e71;
            font-family: bentonsans_extralight;
            font-size: 3vw;
        }

        .rejoin-link {
            border: 2px solid #fff;
            border-radius: 2px;
            color: #fff;
          
            margin-bottom: 30px;
            margin-top: 32px;
            padding: 18px 85px;
            text-decoration: none !important;
            display: block;
            max-width: 272px;
        }
        .rejoin-link:hover {
            color: #fff;
            background: #084147;
           
        }

        .title-home {
            color: #2f9ba6;
            display: inline-block;
            font-family: terminal_dosissemibold, sans-serif;
            font-size: 30px;
            font-weight: 600;
        }

        .other_doc_item {
            border: 1px solid #c7c8ca;
            border-radius: 4px;

            margin-bottom: 15px;
            padding: 15px;
            max-width: 421px;

        }

        .od_img {
            background-color: #eee;
            border-radius: 4px;
            display: block;
            height: 77px;
            margin-left: 8%;
            overflow: hidden;
            width: 77px;
        }
    </style> -->
</head>

<body>

    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #f8f8f8;height: 13vh;border-bottom: 1Px solid grey;">
            <div class="container-fluid">
                <img src="./img/logoOfMySiteWeb.png" alt="" srcset="" style="width: 20%; " />
                <button class="navbar-toggler " style="background-color: #2f9ba6" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon  "></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup" style="margin-right:6%;">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link navbar-text active me-5 " aria-current="page" href="#" style="color:#1b2856">Compte patient</a>
                        <a class="nav-link navbar-text active me-5" aria-current="page" href="#" style="color:#1b2856">Compte médecin</a>
                        <a class="nav-link navbar-text active question" aria-current="page" href="#" style="background-color: #2f9ba6;color:fff;border-radius: 5px; ">Vous êtes médecin ?</a>
                    </div>
                </div>
            </div>
        </nav>

    </header>

    <div class="bg-image d-flex align-items-center flex-column bd-highlight " style="background-image: url('./img/bg_search.jpg');color:white">
        <h1 class="display-3 fw-bold pt-5 bd-highlight mt-5">
            <span class="fw-lighter">Trouvez</span>
            un médecin
        </h1>

        <p class="sousTitre fw-lighter " style=" font-size: 35px;">Près de chez vous et prenez rendez-vous en ligne</p>

        <div class="s01">
            <form>

                <div class="inner-form">
                    <div class="input-field first-wrap">
                        <input id="search" type="text" placeholder="What are you looking for?" />
                    </div>
                    <div class="input-field second-wrap ">

                        <input id="location" type="text" placeholder="location" />
                    </div>

                    <div class="input-field third-wrap">
                        <button class="btn-search" type="button"><i class="fas fa-search"></i>Rechercher</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="section_block_2 d-flex flex-wrap justify-content-center justify-content-lg-around mt-4 text-center" style="box-shadow: 0px 8px 10px rgba(0, 0, 0, 0.25); padding-bottom: 5%; padding-top: 2%">
        <div class="icon-container  mb-3 mb-lg-0 col-6 col-lg-3">
            <span class="fa-stack fa-lg">
                <i class="fas fa-square fa-stack-2x" style="color: white; border: 3px solid #2f9ba6; border-radius: 15px;"></i>
                <i class="fas fa-dollar-sign fa-stack-1x" style="color: #2f9ba6;"></i>
            </span>
            <div class="icon-title mt-2">Un service <br>100% Gratuit</div>
        </div>

        <div class="icon-container mb-3  mb-3 mb-lg-0 col-6 col-lg-3">
            <span class="fa-stack fa-lg">
                <i class="fas fa-square fa-stack-2x" style="color: white; border: 3px solid #2f9ba6; border-radius: 15px;"></i>
                <i class="fas fa-user fa-stack-1x" style="color: #2f9ba6;"></i>
            </span>
            <div class="icon-title mt-2">Obtenez <br>votre espace<br> patient dédié</div>
        </div>

        <div class="icon-container  mb-3 mb-lg-0 col-6 col-lg-3">
            <span class="fa-stack fa-lg">
                <i class="fas fa-square fa-stack-2x" style="color: white; border: 3px solid #2f9ba6; border-radius: 15px;"></i>
                <i class="far fa-calendar-alt fa-stack-1x" style="color: #2f9ba6;"></i>
            </span>
            <div class="icon-title mt-2">Prenez <br>rendez-vous en<br> ligne 24h/24</div>
        </div>

        <div class="icon-container  mb-3 mb-lg-0 col-6 col-lg-3">
            <span class="fa-stack fa-lg">
                <i class="fas fa-square fa-stack-2x" style="color: white; border: 3px solid #2f9ba6; border-radius: 15px;"></i>
                <i class="fas fa-stethoscope fa-stack-1x" style="color: #2f9ba6;"></i>
            </span>
            <div class="icon-title mt-2">Choisissez votre<br> médecin</div>
        </div>
    </div>



    <div class="section_block_3  mt-5" style="padding-bottom: 4%; padding-top: 2% ">
        <div class="row mx-md-5">
            <div class="col-12 col-md-6" mx-auto>
                <div class="div_medecin">
                    <h2 class="md_title">
                        <span>Vous êtes</span>
                        Médecin ?
                    </h2>
                    <div class="medecin_box">
                        <p class="mt-4" style="margin-bottom: 8%;">S'inscrire sur BooKMYDoctor<br>
                            est la meilleure façon de développer<br>
                            l'activité de votre cabinet
                        </p>
                        <a href="#" class="rejoin-link">Rejoindre </a>
                    </div>
                </div>

            </div>




            <div class="col-12 col-md-6">
                <h2 class="md_title t" style="color:#a61057">
                    Difficile
                    <span> de trouver un RDV de médecin ?</span>

                </h2>

                <p class="fs-5 mt-4"> BooKMYDoctor est un outil innovant qui vous permet de trouver rapidement un médecin en ligne et de prendre RDV en temps réel.
                    Retrouvez les praticiens de votre ville et prenez rendez-vous gratuitement et en un seul clic.
                    Sur BooKMYDoctor, repérez un médecin à proximité de chez vous, trouvez toutes les informations utiles : spécialités,
                    informations d’accès, tarifs de consultation, choisissez le créneau qui vous convient et prenez RDV en ligne gratuitement et immédiatement.
                    Dentistes, généralistes, ophtalmologues… : Plus besoin d’appels et d’attente. Votre prise de RDV est à présent simple, rapide et efficace.</p>
            </div>

        </div>
    </div>
    </div>



    <div class="section_block_4  text-center" style=" box-shadow: 0px -5px 10px rgba(0, 0, 0, 0.25); ">
        <h2 class="title-home mt-5">
            Prenez rendez-vous immédiatement
        </h2>
        <div class="container-fluid mt-5">
            <div class="row mx-md-5 mt-5">
                <div class="col-12 col-lg-4">
                    <div class="other_doc_item">
                        <div class="profil ">
                            <img alt="Dr. Kamal RAFIQI" class="od_img" src="./img/maleProfil.png">


                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="other_doc_item"></div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="other_doc_item"></div>
                </div>
            </div>
            <div class="row mx-md-5 mt-5">
                <div class="col-12 col-lg-4">
                    <div class="other_doc_item"></div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="other_doc_item"></div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="other_doc_item"></div>
                </div>
            </div>
        </div>


        <div class="mt-5 section_block_5 py-3" style="background-color: #2f9ba6;">
            <p class="text-white text-center mb-0">Vous avez un problème ou une question ? Contactez-nous par E-mail</p>
        </div>




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

            <div class="mt-5  py-4" style="background-color: gray;">
                <p class="text-white text-center mb-0">© Copyright BooKMYDoctor 2023 - Tous droits réservés.</p>
            </div>
        </footer>







</body>


</html>
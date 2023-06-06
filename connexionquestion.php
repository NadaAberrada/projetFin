<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienvenue</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js" defer></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />
  <style>
    body{
      font-family: 'Poppins', sans-serif;
    }
    .card-registration .select-input.form-control[readonly]:not([disabled]) {
      font-size: 1rem;
      line-height: 2.15;
      padding-left: .75em;
      padding-right: .75em;
    }

    .card-registration .select-arrow {
      top: 13px;
    }

    body {
      background-color:#aeb2b5;
    }
    .grow {
  transition: all .2s ease-in-out;
}

.grow:hover {
  transform: scale(1.1);
}

  </style>
</head>

<body>
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card card-registration my-4">
          <div class="row g-0">
            <div class="col-xl-6 mx-auto"> <!-- Added 'mx-auto' class -->
              <div class="card-body p-md-5 text-black text-center">

                <img src="./img/logoDocMeet.png" alt="" srcset="" width="35%" class="mb-4">

                <h1 class="mb-4">Bienvenue sur DocMeet</h1>
                <h3 class="mb-5">Êtes-vous docteur ou patient ?</h3>
                <div class="d-flex justify-content-between">
                  <a href="./ConnexionMédcine.php" class="me-4 col-md-4 col-sm-4 grow">
                    <i class="fas fa-user-md fa-7x " style="color: #a61057;"></i>
                    <p class="mt-3"  style="color: #a61057;">Docteur</p>
                  </a>

                  <a href="./ConnexionPatient.php" class="col-md-5 col-sm-2 grow" >
                    <i class="fas fa-user fa-7x" style="color:#a61057;"></i>
                    <p class="mt-3"  style="color: #a61057;">Patient</p>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
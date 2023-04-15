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
    <style>
       html, body {
    height: 100%;
    background-image: url('your-image-url-here');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    margin: 0;
}

.header {
    position: sticky;
    top: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #ffffff;
    padding: 15px 30px;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
    z-index: 100;
}

.header .logo {
    font-size: 24px;
    font-weight: bold;
    color: #4a4a4a;
    text-decoration: none;
}

.container {

    margin: 0 auto;
}

.section {
    background-color: white;
    padding: 30px;
    /* margin-bottom: 30px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); */
}

.footer {
    background-color: #ffffff;
    padding: 30px;
    box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.1);
}
.custom-card {
    background-color: white;
    color: black;
    transition: background-color 0.3s ease, color 0.3s ease;
    position: relative;
    overflow: hidden;
}

.custom-card:hover {
    color: white;
}

.custom-card:hover::after {
    transform: scale(50);
}

.custom-card::after {
    content: "";
    display: block;
    position: absolute;
    width: 20px;
    height: 20px;
    background-color: #1b6f61;
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    transition: transform 0.3s ease;
}


.icon-circle {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f8f9fa;
    margin: 0 auto;
}

.icon-circle i {
    font-size: 2rem;
  
}
.carousel-caption {
    left: 20%; /* Adjust this value to change the horizontal position of the title and button */
    right: auto;
    transform: translateY(-50%);
}

.carousel-caption h3,
.carousel-caption .btn {
    font-size: 1.5rem; /* Adjust this value to change the size of the title and button */
}
.logo-img {
    width: 45%;
    height: auto;
}
.icon-scroll {
    border-radius: 25px;
    box-shadow: inset 0 0 0 2px #2f9ba7;
    display: block;
    height: 44px;
    left: 50%;
    left: auto;
    margin: 10px auto 0;
    position: absolute;
    position: relative;
    width: 29px;
}

.icon-scroll::before {
    animation-duration: 2s;
    animation-iteration-count: infinite;
    animation-name: scroll;
    background: #2f9ba7;
    border-radius: 4px;
    content: "";
    height: 5px;
    left: 50%;
    margin-left: -3px;
    position: absolute;
    top: 4px;
    width: 5px;
}

a {
    background-color: transparent;
    color: #2f9ba7;
}

a {
    text-decoration: none;
}
@keyframes scroll {
    0% {
        opacity: 1;
        transform: translateY(0);
    }
    100% {
        opacity: 0;
        transform: translateY(15px);
    }
}







    </style>
</head>
<body>
<header class="header">
    <a href="#" class="logo">
        <img src="./img/logoOfMySiteWeb.png" alt="YourBrand Logo" class="logo-img">
    </a>
    <button type="button" class="btn btn-primary">Sign In</button>
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
    <h1 class="text-center" style="color: #2f9ba6; font-size: 2rem;">Ce que vous pouvez faire avec Doctori</h1>
    <a href="#marketing" id="marketing" class="icon-scroll"></a>


</section>

<section class="section">
    <div class="row">
        <!-- Repeat the following card structure for each card -->
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <div class="icon-circle">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <!-- End of card structure -->
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <div class="icon-circle">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <!-- End of card structure -->
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <div class="icon-circle">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <!-- End of card structure -->
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <div class="icon-circle">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <!-- End of card structure -->
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <div class="icon-circle">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <!-- End of card structure -->
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <div class="icon-circle">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <!-- End of card structure -->
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <div class="icon-circle">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <!-- End of card structure -->
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <div class="icon-circle">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <!-- End of card structure -->
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <div class="icon-circle">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <!-- End of card structure -->
    </div>
</section>

        <section class="section">
            <h2>Section 4</h2>
            <p>Content for section 4.</p>
        </section>
      <section class="section">
            <h2>Section 5</h2>
            <p>Content for section 5.</p>
        </section>
        <section class="section">
            <h2>Section 6</h2>
            <p>Content for section 6.</p>
        </section>
        <section class="section">
            <h2>Section 7</h2>
            <p>Content for section 7.</p>
        </section>
    </main>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>Column 1</h4>
                    <p>Content for footer column 1.</p>
                </div>
                <div class="col-md-4">
                    <h4>Column 2</h4>
                    <p>Content for footer column 2.</p>
                </div>
                <div class="col-md-4">
                    <h4>Column 3</h4>
                    <p>Content for footer column 3.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
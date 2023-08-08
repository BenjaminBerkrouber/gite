<?php
$pageActive = "acceuil";
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Le Gite du marais</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/view/css/style_index.css" >
    <link rel="stylesheet" href="/view/css/style_header.css">
    <link rel="stylesheet" href="/view/css/style_footer.css">
</head>
<body>
<?php include('view/include/header.view.php');?>


<div class="slider-container">
    <!-- Carousel Slider -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>

        <!-- Carousel Items -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="public/images/gites/gite-1/slide-gite-1-0.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="public/images/gites/gite-1/slide-gite-1-1.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="public/images/gites/gite-1/slide-gite-1-2.jpg" alt="Third slide">
            </div>
        </div>

        <!-- Carousel Controls -->
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Quick Booking Section -->
    <div class="reservation-overlay">
        <form action="reservation.php" method="post" class="reservation-form">
            <div class="form-row">
                <div class="col">
                    <label for="checkin_date">Date d'arrivée</label>
                    <input type="date" class="form-control" id="checkin_date" name="checkin_date" value="<?php echo date('Y-d-m'); ?>" required>
                </div>
                <div class="col">
                    <label for="checkout_date">Date de retour</label>
                    <input type="date" class="form-control" id="checkout_date" name="checkout_date" value="<?php echo date('Y-d-m', strtotime('+1 day')); ?>" required>
                </div>
                <div class="col">
                    <label for="num_people">Adultes</label>
                    <select class="form-control" id="num_people" name="num_people">
                        <?php for($i = 1; $i <= 8; $i++) : ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col d-flex align-items-end">
                    <button type="submit" class="btn btn-primary btn-block btn-reserve"><i class="fas fa-search"></i> Réserver</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Owner Presentation Section -->
<div class="owner-presentation">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-md-6 text-center">
                <div class="svg-container">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs>
                            <pattern id="image" x="0" y="0" patternUnits="userSpaceOnUse" height="200" width="200">
                                <image x="0" y="0" xlink:href="owner.jpg" height="200" width="200" />
                            </pattern>
                        </defs>
                        <path fill="url(#image)" d="M58.9,-53.9C73.8,-44,81.7,-22,80.2,-1.4C78.8,19.1,68.1,38.2,53.1,53C38.2,67.7,19.1,78.1,1.4,76.8C-16.3,75.4,-32.7,62.2,-45.9,47.5C-59.2,32.7,-69.3,16.3,-69.9,-0.5C-70.4,-17.4,-61.3,-34.7,-48,-44.7C-34.7,-54.6,-17.4,-57,2.3,-59.3C22,-61.6,44,-63.8,58.9,-53.9Z" transform="translate(100 100)" />                    </svg>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="presentation-text">
                    <h2>Présentation</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec orci eget nisl convallis venenatis. Integer malesuada lorem sem, eu interdum dolor interdum non. Maecenas at nisl tincidunt, tempus quam sed, vestibulum mi.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Separator Section -->
<section class="separator-section">
    <div class="separator-image">
        <img src="public/images/back.jpg" alt="Separator Image">
    </div>
</section>


<!-- Gite Section -->
<section class="gite-section">
    <h2>Découvrez nos gîtes</h2> <!-- Titre de la section -->

    <div class="describ">
        <p class="gite-describ" id="a">
            Bienvenue aux Gîtes du Marais <span class="gite-describ-more">, votre escapade conviviale et chaleureuse au cœur de la nature. Nos gîtes, accessibles aux personnes à mobilité réduite, offrent une parfaite déconnexion du quotidien. Rejoignez-nous pour une expérience authentique, où le confort rencontre la simplicité pour une véritable pause hors du temps</span>
        </p>
    </div>
    <div class="gites-row">

        <!-- Gite 5 places -->
        <div class="gite">
            <h3>Grand Gîte</h3> <!-- Nom du gîte -->
            <div class="gite-image ">

                <!-- Begin Carousel Slider -->
                <div id="carouselExampleIndicatorsGiteG" class="carousel slide" data-ride="carousel">
                    <!-- Carousel Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicatorsGiteG" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicatorsGiteG" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicatorsGiteG" data-slide-to="2"></li>
                    </ol>

                    <!-- Carousel Items -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="public/images/gites/gite-1/slide-gite-1-0.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="public/images/gites/gite-1/slide-gite-1-1.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="public/images/gites/gite-1/slide-gite-1-2.jpg" alt="Third slide">
                        </div>
                    </div>

                    <!-- Carousel Controls -->
                    <a class="carousel-control-prev" href="#carouselExampleIndicatorsGiteG" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicatorsGiteG" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- End Carousel Slider -->
                <i class="fas fa-arrow-up arrow-icon"></i>
                <span class="hover-text">En savoir plus</span>
            </div>
            <div class="gite-info">
                <h3>Gîte 5 places</h3>
                <p>Ce magnifique gîte peut accueillir jusqu'à 5 personnes.</p>
                <a class="btn" href="en_savoir_plus.php">En savoir plus</a>
            </div>
        </div>

        <!-- Gite 2 places -->
        <div class="gite">
            <h3>Petit Gîte</h3> <!-- Nom du gîte -->
            <div class="gite-image">
                <!-- Begin Carousel Slider -->
                <div id="carouselExampleIndicatorsGiteG" class="carousel slide" data-ride="carousel">
                    <!-- Carousel Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicatorsGiteG" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicatorsGiteG" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicatorsGiteG" data-slide-to="2"></li>
                    </ol>

                    <!-- Carousel Items -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="public/images/gites/gite-1/slide-gite-1-0.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="public/images/gites/gite-1/slide-gite-1-1.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="public/images/gites/gite-1/slide-gite-1-2.jpg" alt="Third slide">
                        </div>
                    </div>

                    <!-- Carousel Controls -->
                    <a class="carousel-control-prev" href="#carouselExampleIndicatorsGiteG" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicatorsGiteG" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- End Carousel Slider -->
                <i class="fas fa-arrow-up arrow-icon"></i>
                <span class="hover-text">En savoir plus</span>
            </div>
            <div class="gite-info">
                <h3>Gîte 2 places</h3>
                <p>Un gîte plus cosy, parfait pour 2 personnes.</p>
                <a class="btn" href="en_savoir_plus.php">En savoir plus</a>
            </div>
        </div>
    </div>
</section>


<!-- map and contact form section -->
<section id="content-section">
    <section id="map-section">
        <div id="map"></div>
    </section>
    <section id="contact-section">
        <h2 id="contact-title">Contact</h2>
        <!-- votre formulaire de contact va ici -->
        <form id="contact-form" action="sendMail" method="POST">
            <div id="name-fields">
                <input type="text" id="name" name="name" placeholder="Votre nom">
                <input type="text" id="prenom" name="prenom" placeholder="Votre prénom">
            </div>
            <input type="email" id="email" name="email" placeholder="Votre email">
            <textarea id="message" name="message" placeholder="Votre message"></textarea>
            <input type="submit" value="Envoyer">
        </form>
    </section>
</section>



<!-- Commentaire Section -->

<section class="testimonial-section">
    <div class="container">
        <div class="testimonial-carousel">
            <?php include('view/include/comment.php'); ?>
            <?php include('view/include/comment.php'); ?>
            <?php include('view/include/comment.php'); ?>
            <?php include('view/include/comment.php'); ?>
            <?php include('view/include/comment.php'); ?>
            <?php include('view/include/comment.php'); ?>
            <?php include('view/include/comment.php'); ?>
        </div>
    </div>
</section>

<?php require('view/include/footer.view.php');?>


<!-- Bootstrap JS and jQuery -->
<script src="/app/app.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>

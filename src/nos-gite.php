<?php
    $pageActive = "nosgit";
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maison d'hôte</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.css" />

    <!-- Custom CSS -->
    <link href="view/css/nos-gites.css" rel="stylesheet">
    <link rel="stylesheet" href="view/css/style_header.css">
    <link rel="stylesheet" href="view/css/style_footer.css">


</head>
<body>

<?php require('view/include/header.view.php');?>

<!-- Image de titre -->
<header>
    <div class="header-img">
        <h1 class="title" style="text-align: center; line-height: 500px;">Nos Gîtes</h1>
    </div>
</header>

<section class="gite-presentation">
    <div class="gite">
        <div class="gite-image">
            <img src="public/images/pres.jpg" alt="Image Gîte 1">
        </div>
        <div class="gite-info">
            <h3 class="gite-title">Gîte 1</h3>
            <div class="gite-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vulputate convallis purus vitae consectetur.</p>
                <p>Nulla facilisi. Sed eget tempor ex, auctor iaculis est. Vestibulum facilisis ligula neque, sed dignissim lectus maximus vel.</p>
                <p>Phasellus ultricies lacinia libero ac efficitur. Curabitur iaculis lectus massa, id consequat dui vulputate ac.</p>
            </div>
        </div>
    </div>
    <div class="gite">
        <div class="gite-image">
            <img src="public/images/gites/gite-1/illustrator.jpg" alt="Image Gîte 2">
        </div>
        <div class="gite-info">
            <h3 class="gite-title">Gîte 2</h3>
            <div class="gite-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vulputate convallis purus vitae consectetur.</p>
                <p>Nulla facilisi. Sed eget tempor ex, auctor iaculis est. Vestibulum facilisis ligula neque, sed dignissim lectus maximus vel.</p>
                <p>Phasellus ultricies lacinia libero ac efficitur. Curabitur iaculis lectus massa, id consequat dui vulputate ac.</p>
            </div>
        </div>
    </div>
</section>



<?php require('view/include/footer.view.php');?>

</body>
</html>

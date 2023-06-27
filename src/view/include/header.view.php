<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Le Gite du Marais</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php echo $pageActive === 'acceuil' ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php">Acceuil</a>
            </li>
            <li class="nav-item <?php echo $pageActive === 'propriété' ? 'active' : ''; ?>">
                <a class="nav-link" href="les_chambres.php">La Propriété</a>
            </li>
            <li class="nav-item <?php echo $pageActive === 'nosgit' ? 'active' : ''; ?>">
                <a class="nav-link" href="nos-gite.php">Nos Gîtes</a>
            </li>
            <li class="nav-item <?php echo $pageActive === 'activité' ? 'active' : ''; ?>">
                <a class="nav-link" href="restauration.php">Les Activités</a>
            </li>
            <li class="nav-item <?php echo $pageActive === 'contacte' ? 'active' : ''; ?>">
                <a class="nav-link" href="contacte.php">Contacte</a>
            </li>
            <li class="nav-item <?php echo $pageActive === 'reservation' ? 'active' : ''; ?>">
                <button type="button" class="btn btn-success">Réservation</button>
            </li>
        </ul>
    </div>
</nav>
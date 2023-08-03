<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Reservation</title>
    <!-- Liens CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/view/admin/css/style_admin_reservation.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script>
        var users = <?php echo json_encode($users); ?>;
        var gites = <?php echo json_encode($gites); ?>;
        var lock_time = <?php echo json_encode($lock_time); ?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>

<div class="container mt-4">
    <h1>Mettre à jour la réservation</h1>
    <hr>
    <form action="/admin/reservation/update" method="POST">
        <input type="hidden" name="id_reservation" value="<?= $reservation['id_reservation'] ?>">
        <input type="hidden" name="id_gite" value="<?= $reservation['id_gite'] ?>">
        <input type="hidden" name="id_user" value="<?= $reservation['id_user'] ?>">
        <div class="row">
            <div class="col-4">
                <div class="d-flex flex-column align-items-center">
                    <h4><?= $reservation['nomGite'] ?></h4>
                    <div class="image-upload">
                        <img id="preview" src="<?= $reservation['chemin'] ?>" alt="Gîte Image" style="width: 100%;">
                        <div class="overlay">
                            <i class="fas fa-image"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="form-row">
                    <div class="col-6">
                        <label for="nom">Nom du Client</label>
                        <p class="styled-info"><?= $reservation['nom'] ?></p>
                    </div>
                    <div class="col-6">
                        <label for="prenom">Prénom du Client</label>
                        <p class="styled-info"><?= $reservation['prenom'] ?></p>
                    </div>
                    <div class="col-6">
                        <label for="num">Numéro Client</label>
                        <p class="styled-info"><?= $reservation['numero'] ?></p>
                    </div>
                    <div class="col-6">
                        <label for="num">Mail Client</label>
                        <p class="styled-info"><?= $reservation['mail'] ?></p>
                    </div>
                </div>
                <hr> <!-- Line separator -->
                <div class="form-row mt-3">
                    <div class="col-6">
                        <label for="date_debut">Date de début</label>
                        <input type="text" class="form-control" id="date_debut" name="date_debut" value="<?= $reservation['date_debut'] ?>" required>
                    </div>
                    <div class="col-6">
                        <label for="date_fin">Date de fin</label>
                        <input type="text" class="form-control" id="date_fin" name="date_fin" value="<?= $reservation['date_fin'] ?>" required>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="nb_personnes">Nombre de personnes</label>
                    <input type="number" class="form-control" id="nb_personnes" name="nb_personnes" value="<?= $reservation['nb_personnes'] ?>" required>
                </div>
                <div class="form-group mt-3">
                    <label for="commentaire">Commentaire</label>
                    <input type="text" class="form-control" id="commentaire" name="commentaire" value="<?= $reservation['commentaire'] ?>" required>
                </div>
            </div>
        </div>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger mt-4" id="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
            <a href="/admin/reservation/delete?id_reservation=<?= $reservation['id_reservation'] ?>" class="btn btn-danger mt-3 ml-3">Supprimer</a>
        </div>
    </form>
</div>

<!-- Scripts JavaScript Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/app/admin/reservation/update_reservation.js"></script>

</body>
</html>

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

    <script>
        var users = <?php echo json_encode($users); ?>;
        var gites = <?php echo json_encode($gites); ?>;
    </script>
</head>
<body>

<div class="container">
    <h1>Create Reservation</h1>

    <hr>
    <!-- Formulaire pour ajouter une nouvelle réservation -->
    <form action="/admin/reservation/create" method="POST">
        <div class="row">
            <div class="col-lg-6 mb-3">
                <input type="text" class="form-control" id="userId" name="id_user" readonly hidden>
                <label for="userSearch">Search User</label>
                <input type="text" class="form-control" id="userSearch" autocomplete="off">
                <div class="mt-2" id="userResults"></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label for="giteSelect">Gîte</label>
                <select class="form-control" id="giteSelect" name="id_gite" required>
                    <?php foreach ($gites as $gite) : ?>
                        <option value="<?php echo $gite['id_gite']; ?>">
                            <?php echo $gite['nom']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 mb-3">
                <label for="date_debut">Date de début</label>
                <input type="datetime-local" class="form-control" id="date_debut" name="date_debut" required>
            </div>
            <div class="col-lg-4 mb-3">
                <label for="date_fin">Date de fin</label>
                <input type="datetime-local" class="form-control" id="date_fin" name="date_fin" required>
            </div>
            <div class="col-lg-4 mb-3">
                <label for="nb_personnes">Nombre de personnes</label>
                <select class="form-control" id="nb_personnes" name="nb_personnes" required></select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-3">
                <label for="commentaire">Commentaire</label>
                <textarea class="form-control" id="commentaire" name="commentaire"></textarea>
            </div>
        </div>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger mt-4" id="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-primary">Add Reservation</button>
        </div>
    </form>
</div>

<!-- Scripts JavaScript Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/app/admin/reservation/create_reservation.js"></script>

</body>

</html>
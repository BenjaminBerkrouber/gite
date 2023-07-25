<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour la réservation</title>
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        body {
            font-family: 'Poppins';
            background-color: #EEE2DF;
        }
        h1 {
            color: #CA7C5C;
            margin-bottom: 2rem;
        }

        h4{
            color: #CA7C5C;
        }

        .container {
            background-color: #EED7C5;
            padding: 2rem;
            border-radius: 10px;
        }
        hr {
            border-top: 1px solid #CA7C5C;
        }
        .image-upload {
            position: relative;
            cursor: pointer;
        }
        .image-upload .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        #preview {
            max-height: 300px; /* Ajustez cette valeur pour changer la hauteur maximale de l'image d'illustration */
        }
        .btn-update-reservation {
            width: 100%;
            background-color: #CA7C5C;
            color: white;
            border-color: #CA7C5C;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .btn-update-reservation:hover {
            background-color: #B36A5E;
            border-color: #B36A5E;
        }
        .mt-4 {
            margin-top: 4rem;
        }


         p.styled-info {
             background-color: #e7e8e8;  /* Plus gris que blanc */
             border: 1px solid #ced4da;
             border-radius: .25rem;
             padding: .375rem .75rem;
             font-size: 1rem;
             line-height: 1.5;
             transition: background-color 0.3s ease;  /* Ajouté pour l'animation de surbrillance */
         }

        p.styled-info:hover {
            background-color: #e2e6ea;  /* Gris plus foncé lorsqu'il est survolé */
            cursor: not-allowed;  /* Change le curseur en une croix */
        }

        .btn-primary {
            background-color: #B36A5E;
            border-color: #B36A5E;
        }

        .btn-primary:hover {
            background-color: #CA7C5C;
            border-color: #CA7C5C;
        }

    </style>
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
                        <input type="date" class="form-control" id="date_debut" name="date_debut" value="<?= $reservation['date_debut'] ?>" required>
                    </div>
                    <div class="col-6">
                        <label for="date_fin">Date de fin</label>
                        <input type="date" class="form-control" id="date_fin" name="date_fin" value="<?= $reservation['date_fin'] ?>" required>
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
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
        </div>
    </form>
</div>
<!-- JS Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

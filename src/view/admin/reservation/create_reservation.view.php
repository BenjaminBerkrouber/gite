<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Reservation</title>
    <!-- Liens CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #EEE2DF;
        }

        .container {
            background-color: #EED7C5;
            padding: 20px;
            border-radius: 15px;
            margin-top: 50px;
            width: 50%;
        }

        .btn-primary {
            background-color: #B36A5E;
            border-color: #B36A5E;
        }

        .btn-primary:hover {
            background-color: #CA7C5C;
            border-color: #CA7C5C;
        }

        h1 {
            color: #CA7C5C;
            margin-bottom: 30px;
        }

        label {
            color: #C89F9C;
        }

        #userList {
            border: 1px solid #ddd;
            padding: 10px;
            display: none;
            position: absolute;
            background-color: #ffffff;
            z-index: 9999;
        }

        #userResults {
            display: none;
        }
        #userResults button {
            margin: 0.2rem;
            background-color: #B36A5E;
            border-color: #B36A5E;
        }
        #userResults button:hover {
            background-color: #CA7C5C;
            border-color: #CA7C5C;
        }
    </style>
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
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        $('#userSearch').on('keyup', function(){
            var searchText = $(this).val().toLowerCase();

            if (searchText.length > 0) {
                var filteredUsers = users.filter(function(user) {
                    return user.nom.toLowerCase().includes(searchText) || user.prenom.toLowerCase().includes(searchText);
                });

                var html = '';
                if (filteredUsers.length > 0) {
                    filteredUsers.forEach(function(user) {
                        html += '<button type="button" class="btn btn-secondary btn-sm mr-2 mb-2" data-id="' + user.id_user + '">' + user.nom + ' ' + user.prenom + '</button>';
                    });
                } else {
                    html += '<a href="/admin/user/create" class="btn btn-primary btn-sm">User not find, create this user</a>';
                }

                $('#userResults').html(html);
                $('#userResults').fadeIn();
            } else {
                $('#userResults').fadeOut();
            }
        });

        $(document).on('click', '#userResults button', function() {
            $('#userSearch').val($(this).text());
            $('#userId').val($(this).data('id'));
            $('#userResults').fadeOut();
        });
    });

    function updatePersonnesSelect() {
        var selectedGiteId = $('#giteSelect').val();
        var maxPlaces = gites.find(gite => gite.id_gite === parseInt(selectedGiteId)).places;
        var html = '';
        for (var i = 1; i <= maxPlaces; i++) {
            html += '<option value="' + i + '">' + i + '</option>';
        }
        $('#nb_personnes').html(html);
    }

    $('#giteSelect').on('change', function() {
        updatePersonnesSelect();
    });

    // Mise à jour initiale du select "nb_personnes"
    updatePersonnesSelect();

</script>

</body>

</html>


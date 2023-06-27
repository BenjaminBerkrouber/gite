<?php
include_once('view/admin/include/header.view.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/css/bootstrap.min.css">
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
        }

        .btn-primary {
            background-color: #B36A5E;
            border-color: #B36A5E;
        }

        .btn-primary:hover {
            background-color: #CA7C5C;
            border-color: #CA7C5C;
        }

        h1, h2 {
            color: #CA7C5C;
        }

        .table {
            color: #C89F9C;
        }

        a {
            color: #B36A5E;
        }

        a:hover {
            color: #CA7C5C;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>Gîtes Management</h1>
    <hr>

    <div class="d-flex justify-content-end mb-4">
        <a href="/admin/gite/create" class="btn btn-primary">Create Gîte</a>
    </div>

    <!-- Tableau affichant tous les gîtes -->
    <h2>Gîtes List</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Places</th>
            <th>Prix</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($gites as $gite) {
            echo '<tr>';
            echo '<td>' . $gite['id_gite'] . '</td>';
            echo '<td>' . $gite['nom'] . '</td>';
            echo '<td>' . $gite['places'] . '</td>';
            echo '<td>' . $gite['description'] . '</td>';
            echo '<td>' . $gite['prix'] . '</td>';
            echo '<td><img src="/'.$gite['path'] . '" alt="Gite Illustration" width="100"></td>'; // Display image
            echo '<td><a href="/admin/gite/update?id=' . $gite['id_gite'] . '">Edit</a> | <a href="/admin/gite/delete?id=' . $gite['id_gite'] . '">Delete</a></td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>

<!-- JS Bootstrap (jQuery requis) -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>

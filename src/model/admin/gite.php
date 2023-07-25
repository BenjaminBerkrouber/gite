<?php
include_once('view/admin/include/header.view.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/view/admin/css/style_admin_gite.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>

<br>
<br>

<div class="container">
    <h1>Gîtes Management</h1>
    <hr>
    <a href="/admin/gite/create" class="btn btn-primary">Create Gîte</a>
    <hr>
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
            echo '<td><img src="'.$gite['path'] . '" alt="Gite Illustration" width="100"></td>'; // Display image
            echo '<td><a href="/admin/gite/update?id=' . $gite['id_gite'] .'" class="btn btn-primary btn-sm">Edit</a> <a href="/admin/gite/delete?id=' . $gite['id_gite'] . '" class="btn btn-danger btn-sm">Delete</a></td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>
</body>

</html>

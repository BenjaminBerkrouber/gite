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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #EEE2DF;
        }
        h1, h2 {
            color: #CA7C5C;
        }
        .btn-primary {
            background-color: #B36A5E;
            border-color: #B36A5E;
        }
        .btn-primary:hover {
            background-color: #C89F9C;
            border-color: #C89F9C;
        }
        .table {
            background-color: #EED7C5;
        }
        .table thead {
            background-color: #B36A5E;
            color: #EEE2DF;
        }
        .table tbody tr {
            background-color: #EED7C5;
        }
        .table tbody tr:nth-child(even) {
            background-color: #C89F9C;
        }
    </style>
</head>
<body>


<div class="container">
    <h1>Users Management</h1>
    <hr>

    <a href="/admin/user/create" class="btn btn-primary">Create User</a>

    <hr>

    <!-- Tableau affichant tous les utilisateurs -->
    <h2>Users List</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>prenom</th>
            <th>nom</th>
            <th>numero</th>
            <th>adresse</th>
            <th>mail</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($users as $user) {
            $rowClass = ($user['role'] == 1) ? 'background-color: #f8d7da;' : '';

            echo sprintf(
                '<tr style="%s">',
                $rowClass
            );

            echo '<td>' . $user['id_user'] . '</td>';
            echo '<td>' . $user['prenom'] . '</td>';
            echo '<td>' . $user['nom'] . '</td>';
            echo '<td>' . $user['numero'] . '</td>';
            echo '<td>' . $user['adresse'] . '</td>';
            echo '<td>' . $user['mail'] . '</td>';
            echo '<td>' . $user['role'] . '</td>';
            echo '<td><a href="/admin/user/update?id=' . $user['id_user'] . '" class="btn btn-primary btn-sm">Edit</a> <a href="/admin/user/delete?id=' . $user['id_user'] . '" class="btn btn-danger btn-sm">Delete</a></td>';
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

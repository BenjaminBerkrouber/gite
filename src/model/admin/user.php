<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/view/admin/css/style_admin_user.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<br>
<br>

<div class="container">
    <h1>Users Management</h1>
    <hr>
    <a href="/admin/user/create" class="btn btn-primary">Create User</a>
    <hr>
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

</body>

</html>

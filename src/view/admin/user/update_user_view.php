<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <!-- Liens CSS Bootstrap -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/view/admin/css/style_admin_user.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="container" id="update">
    <h1>Update User</h1>

    <!-- Formulaire pour mettre à jour un utilisateur -->
    <form action="/admin/user/update?id_user=<?php echo $user['id_user']; ?>" method="POST">
        <div class="row">
            <div class="col-lg-6 mb-3">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required value="<?php echo $user['nom']; ?>">
            </div>
            <div class="col-lg-6 mb-3">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required value="<?php echo $user['prenom']; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 mb-3">
                <label for="numero">Numéro</label>
                <input type="text" class="form-control" id="numero" name="numero" required value="<?php echo $user['numero']; ?>">
            </div>
            <div class="col-lg-9 mb-3">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" required value="<?php echo $user['adresse']; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 mb-3">
                <label for="mail">Email</label>
                <input type="email" class="form-control" id="mail" name="mail" required value="<?php echo $user['mail']; ?>">
            </div>
            <div class="col-lg-3 mb-3">
                <label for="role">Rôle</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="1" <?php if ($user['role'] == 1) echo 'selected'; ?>>Administrateur</option>
                    <option value="2" <?php if ($user['role'] == 2) echo 'selected'; ?>>Utilisateur</option>
                </select>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $user['id_user']; ?>">
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger mt-4" id="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-primary">Update User</button>
        </div>
    </form>
</div>
</body>

</html>

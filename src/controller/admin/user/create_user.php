<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = '';

    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['numero']) && isset($_POST['adresse']) && isset($_POST['mail']) && isset($_POST['role'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $numero = htmlspecialchars($_POST['numero']);
        $adresse = htmlspecialchars($_POST['adresse']);
        $mail = htmlspecialchars($_POST['mail']);
        $role = htmlspecialchars($_POST['role']);

        include_once('controller/admin/validator/user/create_user_validator.php');

        if (empty($error)) {
            add_user($nom,$prenom,$numero,$adresse,$mail,$role);
            header("Location: /admin/user");
            exit();
        }
    } else {
        $error = "Erreur : Veuillez remplir tous les champs requis.";
    }
}

include_once('view/admin/include/header.view.php');
include_once('view/admin/user/create_user_view.php');

?>

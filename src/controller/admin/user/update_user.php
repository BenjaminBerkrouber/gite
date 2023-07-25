<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification des données soumises
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['numero']) && isset($_POST['adresse']) && isset($_POST['mail']) && isset($_POST['role'])) {

        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $numero = htmlspecialchars($_POST['numero']);
        $adresse = htmlspecialchars($_POST['adresse']);
        $mail = htmlspecialchars($_POST['mail']);
        $role = htmlspecialchars($_POST['role']);
        $id_user = htmlspecialchars($_POST['id']);
        $user = get_user_by_id($id_user);
        $error = '';

        include_once('controller/admin/validator/user/update_user_validator.php');

        if (empty($error)) {
            update_user($id_user, $nom, $prenom, $numero, $adresse, $mail, $role);
            header("Location: /admin/user");
            exit();
        }
    } else {
        $error = "Erreur : Veuillez remplir tous les champs requis.";
    }

} else {
    if (isset($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);
        $user = get_user_by_id($id);
        if (!$user) {
            echo "Erreur : Utilisateur introuvable.";
            exit();
        }
    } else {
        echo "Erreur : ID de l'utilisateur non spécifié.";
        exit();
    }
}

include_once('view/admin/include/header.view.php');

include_once('view/admin/user/update_user_view.php');


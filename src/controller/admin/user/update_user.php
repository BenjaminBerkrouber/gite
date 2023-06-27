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

        if ($mail != $user['mail'] && checkDuplicateEmail($mail)) {
            echo "Erreur : Cette adresse e-mail existe déjà.";
            exit();
        }

        if ($numero != $user['numero'] && checkDuplicateNumero($numero)) {
            echo "Erreur : Ce numéro de téléphone existe déjà.";
            exit();
        }

        // Vérification supplémentaire des données
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            echo "Erreur : Adresse e-mail invalide.";
            exit();
        }

        if (!preg_match('/^[0-9]{10}$/', $numero)) {
            echo "Erreur : Numéro de téléphone invalide. Veuillez saisir un numéro à 10 chiffres.";
            exit();
        }

        // Vérification supplémentaire de l'adresse
        if (strlen($adresse) < 5) {
            echo "Erreur : L'adresse doit contenir au moins 5 caractères.";
            exit();
        }

        if (strlen($adresse) > 30) {
            echo "Erreur : L'adresse ne doit pas contenir plus de 30 caractères.";
            exit();
        }

        // Vérification supplémentaire du nom et du prénom
        if (!preg_match('/^[a-zA-Z\s]+$/', $nom)) {
            echo "Erreur : Le nom ne doit contenir que des lettres et des espaces.";
            exit();
        }

        if (!preg_match('/^[a-zA-Z\s]+$/', $prenom)) {
            echo "Erreur : Le prénom ne doit contenir que des lettres et des espaces.";
            exit();
        }

        update_user($id_user, $nom, $prenom, $numero, $adresse, $mail, $role);

        header("Location: /admin/user");
    exit();
    } else {
        echo "Erreur : Veuillez remplir tous les champs requis.";
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


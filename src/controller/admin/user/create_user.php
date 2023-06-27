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

        if (checkDuplicateEmail($mail)) {
            echo "Erreur : Cette adresse e-mail existe déjà.";
            exit();
        }

        if (checkDuplicateNumero($numero)) {
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

        if (strlen($adresse) > 60) {
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

        add_user($nom,$prenom,$numero,$adresse,$mail,$role);

        // Redirection vers le menu après l'ajout de l'utilisateur
        header("Location: /admin/user");
        exit();
    } else {
        // Données manquantes, affichage d'un message d'erreur
        echo "Erreur : Veuillez remplir tous les champs requis.";
        exit();
    }
}
include_once('view/admin/include/header.view.php');

include_once('view/admin/user/create_user_view.php');

?>

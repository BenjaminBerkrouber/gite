<?php
    if ($mail != $user['mail'] && checkDuplicateEmail($mail)) {
        $error = "Erreur : Cette adresse e-mail existe déjà.";
    }

    if ($numero != $user['numero'] && checkDuplicateNumero($numero)) {
        $error = "Erreur : Ce numéro de téléphone existe déjà.";
    }

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $error = "Erreur : Adresse e-mail invalide.";
    }

    if (!preg_match('/^[0-9]{10}$/', $numero)) {
        $error = "Erreur : Numéro de téléphone invalide. Veuillez saisir un numéro à 10 chiffres.";
    }

    if (strlen($adresse) < 5) {
        $error = "Erreur : L'adresse doit contenir au moins 5 caractères.";
    }

    if (strlen($adresse) > 40) {
        $error = "Erreur : L'adresse ne doit pas contenir plus de 40 caractères.";
    }

    if (!preg_match('/^[a-zA-Z\s]+$/', $nom)) {
        $error = "Erreur : Le nom ne doit contenir que des lettres et des espaces.";
    }

    if (!preg_match('/^[a-zA-Z\s]+$/', $prenom)) {
        $error = "Erreur : Le prénom ne doit contenir que des lettres et des espaces.";
    }

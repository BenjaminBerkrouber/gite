<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification des données soumises
    if (isset($_POST['nom']) && isset($_POST['places']) && isset($_POST['description']) && isset($_POST['prix'])) {

        $nom = htmlspecialchars($_POST['nom']);
        $places = htmlspecialchars($_POST['places']);
        $description = htmlspecialchars($_POST['description']);
        $prix = htmlspecialchars($_POST['prix']);
        $id_gite = htmlspecialchars($_POST['id']);

        $gite = get_gite_by_id($id_gite);

        // Ajouter ici d'autres vérifications si nécessaire

        update_gite($id_gite, $nom, $places, $description, $prix);

        header("Location: /admin/gite");
        exit();
    } else {
        echo "Erreur : Veuillez remplir tous les champs requis.";
    }

} else {
    if (isset($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);

        $gite = get_gite_by_id($id);
        $gite_illustartion = get_images($id);

        if (!$gite) {
            echo "Erreur : Gite introuvable.";
            exit();
        }

    } else {
        echo "Erreur : ID du gîte non spécifié.";
        exit();
    }
}

include_once('view/admin/include/header.view.php');

include_once('view/admin/gite/update_gite.view.php');

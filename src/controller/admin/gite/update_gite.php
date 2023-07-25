<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $giteId = $_GET['id'];  // Obtenez l'ID du gite à partir de l'URL
    error_log("giteId from URL: $giteId");  // Log l'ID du gite

    if (isset($_POST['image_id'])) {
        $image_id = $_POST['image_id'];
        error_log("image_id received: $image_id");  // Log l'ID de l'image

        // Ajoutez une vérification pour vous assurer que l'image appartient bien à ce gite avant de la supprimer
//        if (check_image_belongs_to_gite($image_id, $giteId)) {
            delete_image_by_id($image_id);
//        } else {
//            error_log("Attempted to delete an image that doesn't belong to the current gite");
//        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['id']) &&
        isset($_POST['nom']) &&
        isset($_POST['places']) &&
        isset($_POST['description']) &&
        isset($_POST['prix']) &&
        isset($_FILES['imageIllustration']['name'][0])
    )
    {
        $nom = htmlspecialchars($_POST['nom']);
        $places = htmlspecialchars($_POST['places']);
        $description = htmlspecialchars($_POST['description']);
        $prix = htmlspecialchars($_POST['prix']);
        $id_gite = htmlspecialchars($_POST['id']);

        $gite = get_gite_by_id($id_gite);

        $error = '';

        include_once('controller/admin/validator/gite/create_gite_validator.php');

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
        var_dump($gite);
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

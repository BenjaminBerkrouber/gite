<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['nom']) &&
        isset($_POST['places']) &&
        isset($_POST['description']) &&
        isset($_POST['prix']) &&
        isset($_FILES['imageIllustration']['name'][0])
    )
    {
        $nom = htmlspecialchars($_POST['nom']);
        $places = intval($_POST['places']);
        $description = htmlspecialchars($_POST['description']);
        $prix = htmlspecialchars($_POST['prix']);
        $sliderImages = $_FILES['sliderImages'];
        $imageIllustration = $_FILES['imageIllustration'];

        $error = '';

        include_once('controller/admin/validator/gite/create_gite_validator.php');

        if(empty($error)){
            $id_gite = add_gite($nom, $places, $description, $prix);
            include_once('controller/admin/gite/image_management.php');

            header("Location: /admin/gite");
            exit();
        }
    } else {
        $error = "Erreur : Veuillez remplir tous les champs requis.";
    }
}

include_once('view/admin/include/header.view.php');
include_once('view/admin/gite/create_gite.view.php');

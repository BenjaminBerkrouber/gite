<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['nom']) &&
        isset($_POST['places']) &&
        isset($_POST['description']) &&
        isset($_POST['prix']) &&
        isset($_FILES['sliderImages']['name'][0]) && // modification ici
        $_FILES['sliderImages']['error'][0] === UPLOAD_ERR_OK // modification ici
    )
    {
        // Récupération des données du formulaire
        $nom = htmlspecialchars($_POST['nom']);
        $places = intval($_POST['places']);
        $description = htmlspecialchars($_POST['description']);
        $prix = htmlspecialchars($_POST['prix']);
        $sliderImages = $_FILES['sliderImages'];

        // Récupération du fichier image d'illustration
        $imageIllustration = $_FILES['imageIllustration'];

        // Vérification du fichier image d'illustration
        if (isset($imageIllustration) && $imageIllustration['error'] === UPLOAD_ERR_OK) {
            // Insertion des données du gîte dans la base de données
            $id_gite = add_gite($nom, $places, $description, $prix);

            // Création du dossier pour les images du gîte
            $giteFolder = 'public/images/gites/gite-' . $id_gite;
            if (!is_dir($giteFolder)) {
                mkdir($giteFolder, 0755, true);
            }

            // Traitement de l'image d'illustration
            $tmpFilePath = $imageIllustration['tmp_name'];
            $fileName = "illustrator.jpg";
            $uploadPath = $giteFolder . '/' . $fileName;
            move_uploaded_file($tmpFilePath, $uploadPath);
            add_gite_image($id_gite, $fileName, $uploadPath, 'illustration');

            // Traitement des images du slider
            $sliderImageCount = count($sliderImages['name']);
            for ($i = 0; $i < $sliderImageCount; $i++) {
                if ($sliderImages['error'][$i] === UPLOAD_ERR_OK) {
                    $sliderTmpFilePath = $sliderImages['tmp_name'][$i];
                    $sliderFileName = "slider-gite-{$id_gite}-{$i}.jpg";
                    $sliderUploadPath = $giteFolder . '/' . $sliderFileName;
                    move_uploaded_file($sliderTmpFilePath, $sliderUploadPath);
                    add_gite_image($id_gite, $sliderFileName, $sliderUploadPath, 'slider');
                }
            }

            // Redirection vers la liste des gîtes après la création
            header("Location: /admin/gite");
            exit();
        } else {
            echo "Erreur lors du téléchargement de l'image d'illustration.";
            exit();
        }
    } else {
        // Données manquantes, affichage d'un message d'erreur
        echo "Erreur : Veuillez remplir tous les champs requis.";
        exit();
    }
}

include_once('view/admin/include/header.view.php');
include_once('view/admin/gite/create_gite.view.php');

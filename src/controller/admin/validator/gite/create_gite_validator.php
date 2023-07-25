<?php

if (!preg_match("/^[\p{L} '-]+$/u", $nom)) {
    $error = "Le nom doit contenir uniquement des lettres, des espaces, des apostrophes et des tirets. ";
}

if ($places <= 0) {
    $error = "Le nombre de places doit être supérieur à 0. ";
}

if (strlen($description) > 1000) {
    $error = "La description ne doit pas dépasser 1000 caractères. ";
}

$prix = floatval($_POST['prix']);
if ($prix <= 0) {
    $error = "Le prix doit être supérieur à 0. ";
}

if (!in_array($imageIllustration['type'], ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'])) {
    $error = "Le type de fichier pour l'image doit être jpeg, jpg, png ou gif. ";
}

if ($imageIllustration['size'] > 10000000) { // 10MB
    $error = "La taille de l'image ne doit pas dépasser 10MB. ";
}

if (!(isset($imageIllustration) && $imageIllustration['error'] === UPLOAD_ERR_OK)) {
    $error = "Erreur lors du téléchargement de l'image d'illustration.";
}
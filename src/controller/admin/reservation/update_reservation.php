<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification des données soumises
    if (isset($_POST['id_reservation']) && isset($_POST['id_user']) && isset($_POST['id_gite']) && isset($_POST['date_debut']) && isset($_POST['date_fin']) && isset($_POST['nb_personnes']) && isset($_POST['commentaire'])) {

        $id_user = htmlspecialchars($_POST['id_user']);
        $id_gite = htmlspecialchars($_POST['id_gite']);
        $date_debut = htmlspecialchars($_POST['date_debut']);
        $date_fin = htmlspecialchars($_POST['date_fin']);
        $nb_personnes = htmlspecialchars($_POST['nb_personnes']);
        $id_reservation = htmlspecialchars($_POST['id_reservation']);
        $commentaire = htmlspecialchars($_POST['commentaire']);

        $reservation = get_reservation_by_id($id_reservation);

        // Vérification supplémentaire des données
        if (!filter_var($nb_personnes, FILTER_VALIDATE_INT) || $nb_personnes < 1) {
            echo "Erreur : Le nombre de personnes doit être un entier positif.";
            exit();
        }

        update_reservation($id_reservation, $id_user, $id_gite, $date_debut, $date_fin, $nb_personnes, $commentaire);
        echo "oui";
        header("Location: /admin/reservation");
        exit();
    } else {
        echo "Erreur : Veuillez remplir tous les champs requis.";
    }

} else {
    if (isset($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);

        $reservation = get_reservation_by_id($id);

        if (!$reservation) {
            echo "Erreur : Réservation introuvable.";
            exit();
        }

    } else {
        echo "Erreur : ID de la réservation non spécifié.";
        exit();
    }
}

include_once('view/admin/include/header.view.php');

include_once('view/admin/reservation/update_reservation.view.php');

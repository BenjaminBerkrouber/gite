<?php
$gites = get_all_gites();
$users = get_all_users();
$reservations = get_all_reservations();
$lock_time = get_all_lock_time();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_reservation']) && isset($_POST['id_user']) && isset($_POST['id_gite']) && isset($_POST['date_debut']) && isset($_POST['date_fin']) && isset($_POST['nb_personnes']) && isset($_POST['commentaire']) && isset($_POST['old_date_fin'])){

        $id_user = htmlspecialchars($_POST['id_user']);
        $id_gite = htmlspecialchars($_POST['id_gite']);
        $date_debut = htmlspecialchars($_POST['date_debut']);
        $date_fin = htmlspecialchars($_POST['date_fin']);
        $nb_personnes = htmlspecialchars($_POST['nb_personnes']);
        $id_reservation = htmlspecialchars($_POST['id_reservation']);
        $commentaire = htmlspecialchars($_POST['commentaire']);
        $old_date_fin = htmlspecialchars($_POST['old_date_fin']);

        $reservation = get_reservation_by_id($id_reservation);

        include_once('controller/admin/validator/reservation/update_reservation_validator.php');

        if(empty($error)){
            delete_cleaning_time($old_date_fin, $id_gite);
            add_cleaning_time($date_fin, $id_gite);
            update_reservation($id_reservation, $id_user, $id_gite, $date_debut, $date_fin, $nb_personnes, $commentaire);
            header('Location: /admin/reservation');
        }
    } else {
        $error = "Erreur : Veuillez remplir tous les champs requis.";
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

<?php
$gites = get_all_gites();
$users = get_all_users();
$reservations = get_all_reservations();

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_user']) && isset($_POST['id_gite']) && isset($_POST['date_debut']) && isset($_POST['date_fin']) && isset($_POST['nb_personnes'])) {
        $id_user = htmlspecialchars($_POST['id_user']);
        $id_gite = htmlspecialchars($_POST['id_gite']);
        $date_debut = htmlspecialchars($_POST['date_debut']);
        $date_fin = htmlspecialchars($_POST['date_fin']);
        $nb_personnes = htmlspecialchars($_POST['nb_personnes']);
        if(isset($_POST['commentaire'])){
            $commentaire = htmlspecialchars($_POST['commentaire']);
        }

        include_once('controller/admin/validator/reservation/create_reservation_validator.php');


        if(empty($error)){
            add_reservation($id_user,$id_gite,$date_debut,$date_fin,$nb_personnes,$commentaire);
            add_lock_reservation($date_fin);
            header('Location: /admin/reservation');
        }

    } else {
        $error = "Veuillez remplir tous les champs requis.";
    }
}

include_once('view/admin/include/header.view.php');
include_once('view/admin/reservation/create_reservation.view.php');

?>

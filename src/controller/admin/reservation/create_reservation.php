<?php
$gites = get_all_gites();
$users = get_all_users();
$reservations = get_all_reservations();

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_user']) && isset($_POST['id_gite']) && isset($_POST['date_debut']) && isset($_POST['date_fin']) && isset($_POST['nb_personnes'])) {
        $id_user = htmlspecialchars($_POST['id_user']);
        $id_gite = htmlspecialchars($_POST['id_gite']);
        if(isset($_POST['commentaire'])){
            $commentaire = htmlspecialchars($_POST['commentaire']);
        }
        $date_debut = htmlspecialchars($_POST['date_debut']);
        $date_fin = htmlspecialchars($_POST['date_fin']);
        $nb_personnes = htmlspecialchars($_POST['nb_personnes']);

        if(!user_exists($id_user)){
            $error = "L'utilisateur n'existe pas.";
        }

        if(!(0 < $nb_personnes && $nb_personnes <= get_number_places_gite($id_gite))){
            $error = "Le nombre de personnes n'est pas correct.";
        }

        // Vérifiez que les dates sont valides
        if (strtotime($date_debut) === false || strtotime($date_fin) === false) {
            $error = "Les dates fournies ne sont pas valides.";
        }

        // Vérifiez que la date de début est avant la date de fin
        if (strtotime($date_debut) >= strtotime($date_fin)) {
            $error = "La date de début doit être avant la date de fin.";
        }

        // Vérifiez que la date de début est après la date actuelle
        if (strtotime($date_debut) <= time()) {
            $error = "La date de début doit être dans le futur.";
        }

        // Vérifiez que aucun lock n'est en cours pour ce gîte pendant la période de réservation
        if (!check_reservation_availability_lock($date_debut, $date_fin)){
            $error = "Cette date est bloquée.";
        }

        //Vérifier que aucune réservation n'est en cours pour ce gîte pendant la période de réservation
        if(!check_duplicate_checking($id_gite, $date_debut, $date_fin)){
            $error = "Ce créneau est déjà réservé.";
        }

        //Vérifier si la date de fin n'est pas trop loin dans le futur
        if (strtotime($date_fin) > strtotime("+1 year")) {
            $error = "Vous ne pouvez pas réserver plus d'un an à l'avance.";
        }

        //Vérifier si la durée de la réservation est d'au moins une certaine durée
        if (strtotime($date_fin) - strtotime($date_debut) < 24*60*60) {
            $error = "La réservation doit être d'au moins une journée.";
        }

//        //Vérifier si la réservation n'est pas faite le jour même
//        if (strtotime($date_debut) < strtotime("+1 day")) {
//            $error = "La réservation ne peut pas être faite pour le jour même.";
//        }

    } else {
        $error = "Veuillez remplir tous les champs requis.";
    }
}

include_once('view/admin/include/header.view.php');
include_once('view/admin/reservation/create_reservation.view.php');

?>

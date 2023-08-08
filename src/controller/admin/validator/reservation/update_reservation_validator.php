<?php

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

if(!check_cleaning_time($id_gite, $date_debut, $date_fin)) {
    $error = "Le gîte est réservé pour le nettoyage pendant cette période. Veuillez choisir un autre créneau.";
}


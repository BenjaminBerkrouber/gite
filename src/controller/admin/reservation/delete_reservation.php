<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id_reservation'])) {
        $id_reservation = $_GET['id_reservation'];

        delete_reservation($id_reservation);

        header("Location: /admin/reservation");
        exit();
    } else {
        echo "Erreur : ID manquant.";
        exit();
    }
}

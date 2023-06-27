<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id_user = $_GET['id'];

        delete_user($id_user);

        header("Location: /admin/user");
        exit();
    } else {
        echo "Erreur : ID manquant.";
        exit();
    }
}

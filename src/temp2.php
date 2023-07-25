<?php

function add_reservation($id_user, $id_gite, $date_debut, $date_fin, $nb_personnes)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "INSERT INTO reservations (id_user, id_gite, date_debut, date_fin, nb_personnes) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_user, $id_gite, $date_debut, $date_fin, $nb_personnes]);
}

function get_all_reservations()
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT reservations.*, users.nom, users.prenom, gites.nom as nomGite, users.numero as numero
            FROM reservations
                INNER JOIN users ON reservations.id_user = users.id_user
                INNER JOIN gites ON reservations.id_gite = gites.id_gite";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_reservation_by_id($id_reservation)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT reservations.*, users.nom, users.prenom, gites.nom as nomGite, PhotosGite.nom as nomPhoto, PhotosGite.chemin, users.numero as numero, users.mail as mail
            FROM reservations
                INNER JOIN users ON reservations.id_user = users.id_user
                INNER JOIN gites ON reservations.id_gite = gites.id_gite
                LEFT JOIN PhotosGite ON gites.id_gite = PhotosGite.id_gite
            WHERE reservations.id_reservation = ?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_reservation]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function update_reservation($id_reservation, $id_user, $id_gite, $date_debut, $date_fin, $nb_personnes, $commentaire)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "UPDATE reservations SET id_user = :id_user, id_gite = :id_gite, date_debut = :date_debut, date_fin = :date_fin, nb_personnes = :nb_personnes, commentaire = :commentaire WHERE id_reservation = :id_reservation";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':id_gite', $id_gite);
    $stmt->bindParam(':date_debut', $date_debut);
    $stmt->bindParam(':date_fin', $date_fin);
    $stmt->bindParam(':nb_personnes', $nb_personnes);
    $stmt->bindParam(':id_reservation', $id_reservation);
    $stmt->bindParam(':commentaire', $commentaire);

    $stmt->execute();
}

function delete_reservation($id_reservation)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "DELETE FROM reservations WHERE id_reservation= ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_reservation]);
}

function get_all_lock_time(){
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT * FROM lock_time";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function add_lock_day_reservation($date_debut, $date_fin)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "INSERT INTO lock_time (date_debut, date_fin) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$date_debut, $date_fin]);
}

function check_lock_reservation($date_debut, $date_fin){
    $db = new DbConnect();
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT * FROM reservations WHERE (date_debut BETWEEN :date_debut AND :date_fin) OR (date_fin BETWEEN :date_debut AND :date_fin) OR (:date_debut BETWEEN date_debut AND date_fin) OR (:date_fin BETWEEN date_debut AND date_fin)");
    $stmt->bindParam(":date_debut", $date_debut);
    $stmt->bindParam(":date_fin", $date_fin);
    $stmt->execute();

    return $stmt->rowCount();
}

function check_reservation_availability_lock($date_debut, $date_fin){
    $db = new DbConnect();
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT * FROM lock_time WHERE (date_debut BETWEEN :date_debut AND :date_fin) OR (date_fin BETWEEN :date_debut AND :date_fin) OR (:date_debut BETWEEN date_debut AND date_fin) OR (:date_fin BETWEEN date_debut AND date_fin)");
    $stmt->bindParam(":date_debut", $date_debut);
    $stmt->bindParam(":date_fin", $date_fin);
    $stmt->execute();

    return $stmt->rowCount() == 0;
}

function check_duplicate_checking($id_gite, $date_debut, $date_fin){
    $db = new DbConnect();
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT * FROM reservations WHERE id_gite = :id_gite AND ((date_debut BETWEEN :date_debut AND :date_fin) OR (date_fin BETWEEN :date_debut AND :date_fin) OR (:date_debut BETWEEN date_debut AND date_fin) OR (:date_fin BETWEEN date_debut AND date_fin))");
    $stmt->bindParam(":id_gite", $id_gite);
    $stmt->bindParam(":date_debut", $date_debut);
    $stmt->bindParam(":date_fin", $date_fin);
    $stmt->execute();

    return $stmt->rowCount() == 0;
}



function remove_lock_day_reservation($date_debut, $date_fin){
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "DELETE FROM lock_time WHERE date_debut = :date_debut AND date_fin = :date_fin";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':date_debut', $date_debut);
    $stmt->bindParam(':date_fin', $date_fin);
    $stmt->execute();
}


?>



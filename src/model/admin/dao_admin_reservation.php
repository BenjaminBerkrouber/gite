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

    $sql = "SELECT reservations.*, users.nom, users.prenom, gites.nom as nomGite
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

    $sql = "SELECT reservations.*, users.nom, users.prenom, gites.nom as nomGite, PhotosGite.nom as nomPhoto, PhotosGite.chemin 
            FROM reservations
            INNER JOIN users ON reservations.id_user = users.id_user
            INNER JOIN gites ON reservations.id_gite = gites.id_gite
            LEFT JOIN PhotosGite ON gites.id_gite = PhotosGite.id_gite
            WHERE reservations.id_reservation = ?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_reservation]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function get_reservations_by_user_id($id_user)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT * FROM reservations WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_user]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_reservations_by_gite_id($id_gite)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT * FROM reservations WHERE id_gite = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_gite]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function update_reservation($id_reservation, $id_user, $id_gite, $date_debut, $date_fin, $nb_personnes)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "UPDATE reservations SET id_user = :id_user, id_gite = :id_gite, date_debut = :date_debut, date_fin = :date_fin, nb_personnes = :nb_personnes WHERE id_reservation = :id_reservation";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':id_gite', $id_gite);
    $stmt->bindParam(':date_debut', $date_debut);
    $stmt->bindParam(':date_fin', $date_fin);
    $stmt->bindParam(':nb_personnes', $nb_personnes);
    $stmt->bindParam(':id_reservation', $id_reservation);

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

function get_reservations_by_date_range($start_date, $end_date)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT reservations.*, users.nom, users.prenom, gites.nom as nomGite
            FROM reservations 
                INNER JOIN users ON reservations.id_user = users.id_user
                INNER JOIN gites ON reservations.id_gite = gites.id_gite
            WHERE date_debut >= :start_date AND date_fin <= :end_date";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_active_reservations()
{
    $db = new DbConnect();
    $conn = $db->connect();

    $current_date = date("Y-m-d");

    $sql = "SELECT * FROM reservations WHERE date_debut <= :current_date AND date_fin >= :current_date";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':current_date', $current_date);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_upcoming_reservations_by_user($id_user)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $current_date = date("Y-m-d");

    $sql = "SELECT * FROM reservations WHERE id_user = :id_user AND date_debut > :current_date";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':current_date', $current_date);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_past_reservations_by_user($id_user)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $current_date = date("Y-m-d");

    $sql = "SELECT * FROM reservations WHERE id_user = :id_user AND date_fin < :current_date";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':current_date', $current_date);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

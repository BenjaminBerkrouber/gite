<?php

/**
 * Ajoute une nouvelle réservation à la base de données.
 *
 * @param int $id_user Identifiant de l'utilisateur
 * @param int $id_gite Identifiant du gîte
 * @param string $date_debut Date de début de la réservation
 * @param string $date_fin Date de fin de la réservation
 * @param int $nb_personnes Nombre de personnes pour la réservation
 * @param string $commentaire Commentaire éventuel sur la réservation
 */
function add_reservation($id_user, $id_gite, $date_debut, $date_fin, $nb_personnes, $commentaire)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "INSERT INTO reservations (id_user, id_gite, date_debut, date_fin, nb_personnes, commentaire) VALUES (?, ?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_user, $id_gite, $date_debut, $date_fin, $nb_personnes, $commentaire]);
}

/**
 * Récupère toutes les réservations de la base de données.
 *
 * @return array Liste de toutes les réservations
 */
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

/**
 * Récupère une réservation spécifique de la base de données en utilisant son identifiant.
 *
 * @param int $id_reservation Identifiant de la réservation
 * @return array La réservation recherchée
 */
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

/**
 * Met à jour une réservation spécifique dans la base de données.
 *
 * @param int $id_reservation Identifiant de la réservation à mettre à jour
 * @param int $id_user Nouvel identifiant de l'utilisateur
 * @param int $id_gite Nouvel identifiant du gîte
 * @param string $date_debut Nouvelle date de début de la réservation
 * @param string $date_fin Nouvelle date de fin de la réservation
 * @param int $nb_personnes Nouveau nombre de personnes pour la réservation
 * @param string $commentaire Nouveau commentaire pour la réservation
 */
function update_reservation($id_reservation, $id_user, $id_gite, $date_debut, $date_fin, $nb_personnes, $commentaire) {
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "UPDATE reservations 
            SET id_user = ?, 
                id_gite = ?, 
                date_debut = ?, 
                date_fin = ?, 
                nb_personnes = ?, 
                commentaire = ? 
            WHERE id_reservation = ?";
    $stmt = $conn->prepare($sql);
    $values = [$id_user, $id_gite, $date_debut, $date_fin, $nb_personnes, $commentaire, $id_reservation];
    $stmt->execute($values);
}

/**
 * Supprime une réservation spécifique de la base de données.
 *
 * @param int $id_reservation Identifiant de la réservation à supprimer
 */
function delete_reservation($id_reservation)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "DELETE FROM reservations WHERE id_reservation= ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_reservation]);
}

/**
 * Récupère tous les blocages de temps de la base de données.
 *
 * @return array Liste de tous les blocages de temps
 */
function get_all_lock_time(){
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT * FROM lock_time";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Ajoute un blocage de jour pour une réservation à la base de données.
 *
 * @param string $date_debut Date de début du blocage
 * @param string $date_fin Date de fin du blocage
 */
function add_lock_day_reservation($date_debut, $date_fin)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "INSERT INTO lock_time (date_debut, date_fin) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$date_debut, $date_fin]);
}


/**
 * Récupère tous les blocages de temps de la base de données.
 *
 * @return array Liste de tous les blocages de temps
 */
function get_all_cleaning_time(){
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT ct.*, g.nom as nomGite FROM cleaning_time ct INNER JOIN gites g on ct.id_gite = g.id_gite";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Ajoute un blocage de jour pour une réservation à la base de données.
 *
 * @param string $date_debut Date de début du blocage
 */
/**
 * Ajoute un blocage de jour pour une réservation à la base de données.
 *
 * @param string $date_debut Date de début du blocage
 */
function add_cleaning_time($date_debut, $id_gite){
    $db = new DbConnect();
    $conn = $db->connect();

    $timestamp = strtotime($date_debut);
    $timestamp += 10 * 60;
    $date_debut = date('Y-m-d H:i:s', $timestamp);

    $timestamp += (4 * 3600) - 1200;
    $date_fin = date('Y-m-d H:i:s', $timestamp);

    $sql = "INSERT INTO cleaning_time (date_debut, date_fin,id_gite) VALUES (?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$date_debut, $date_fin,$id_gite]);
}

/**
 * Vérifie si une réservation est disponible pour les dates spécifiées.
 *
 * @param string $date_debut Date de début de la réservation
 * @param string $date_fin Date de fin de la réservation
 * @return bool true si la réservation est disponible, false sinon
 */
function check_reservation_availability_lock($date_debut, $date_fin){
    $db = new DbConnect();
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT * FROM lock_time WHERE (date_debut BETWEEN :date_debut AND :date_fin) OR (date_fin BETWEEN :date_debut AND :date_fin) OR (:date_debut BETWEEN date_debut AND date_fin) OR (:date_fin BETWEEN date_debut AND date_fin)");
    $stmt->bindParam(":date_debut", $date_debut);
    $stmt->bindParam(":date_fin", $date_fin);
    $stmt->execute();

    return $stmt->rowCount() == 0;
}

/**
 * Vérifie si une réservation est en double pour les dates spécifiées et un gîte spécifique.
 *
 * @param int $id_gite Identifiant du gîte
 * @param string $date_debut Date de début de la réservation
 * @param string $date_fin Date de fin de la réservation
 * @return bool True si la réservation est en double, false sinon
 */
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

/**
 * Vérifie si un créneau de nettoyage est prévu pour les dates spécifiées et un gîte spécifique.
 *
 * @param int $id_gite Identifiant du gîte
 * @param string $date_debut Date de début de la réservation
 * @param string $date_fin Date de fin de la réservation
 * @return bool True si un créneau de nettoyage est prévu, false sinon
 */
function check_cleaning_time($id_gite, $date_debut, $date_fin){
    $db = new DbConnect();
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT * FROM cleaning_time WHERE id_gite = :id_gite AND ((date_debut BETWEEN :date_debut AND :date_fin) OR (date_fin BETWEEN :date_debut AND :date_fin) OR (:date_debut BETWEEN date_debut AND date_fin) OR (:date_fin BETWEEN date_debut AND date_fin))");
    $stmt->bindParam(":id_gite", $id_gite);
    $stmt->bindParam(":date_debut", $date_debut);
    $stmt->bindParam(":date_fin", $date_fin);
    $stmt->execute();

    return $stmt->rowCount() == 0;
}

/**
 * Supprime un blocage de jour pour une réservation de la base de données.
 *
 * @param string $date_debut Date de début du blocage
 * @param string $date_fin Date de fin du blocage
 */
function remove_lock_day_reservation($date_debut, $date_fin){
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "DELETE FROM lock_time WHERE date_debut = :date_debut AND date_fin = :date_fin";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':date_debut', $date_debut);
    $stmt->bindParam(':date_fin', $date_fin);
    $stmt->execute();
}

/**
 * Vérifie si une réservation est verrouillée pour les dates spécifiées.
 *
 * @param string $date_debut Date de début du verrouillage
 * @param string $date_fin Date de fin du verrouillage
 * @return bool True si la réservation est verrouillée, false sinon
 */
function check_lock_reservation($date_debut, $date_fin) {
    $db = new DbConnect();
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT * FROM reservations WHERE (date_debut <= :date_fin AND date_fin >= :date_debut)");
    $stmt->bindParam(":date_debut", $date_debut);
    $stmt->bindParam(":date_fin", $date_fin);
    $stmt->execute();

    return $stmt->rowCount() > 0;
}

/**
 * Supprime l'enregistrement de nettoyage de la base de données correspondant à la date de début et à l'ID du gîte donnés.
 *
 * @param string $date_debut La date de début de la réservation
 * @param int $id_gite L'ID du gîte
 * @return void
 */
function delete_cleaning_time($date_debut, $id_gite){
    $db = new DbConnect();
    $conn = $db->connect();

    $timestamp = strtotime($date_debut);
    $timestamp += 10 * 60; // Le même délai que dans la fonction add_cleaning_time
    $date_debut = date('Y-m-d H:i:s', $timestamp);

    $sql = "DELETE FROM cleaning_time WHERE date_debut = :date_debut AND id_gite = :id_gite";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':date_debut', $date_debut, PDO::PARAM_STR);
    $stmt->bindParam(':id_gite', $id_gite, PDO::PARAM_INT);

    $stmt->execute();
}


?>



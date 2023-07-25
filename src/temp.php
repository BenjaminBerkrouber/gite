<?php

/**
 * Ajoute une nouvelle réservation à la base de données.
 *
 * @param int $id_user L'ID de l'utilisateur faisant la réservation.
 * @param int $id_gite L'ID du gite réservé.
 * @param string $date_debut La date de début de la réservation au format 'AAAA-MM-JJ'.
 * @param string $date_fin La date de fin de la réservation au format 'AAAA-MM-JJ'.
 * @param int $nb_personnes Le nombre de personnes incluses dans la réservation.
 * @return void
 */
function add_reservation($userId, $cottageId, $startDate, $endDate, $nbPeople)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "INSERT INTO reservations (user_id, cottage_id, start_date, end_date, nb_people) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId, $cottageId, $startDate, $endDate, $nbPeople]);
}

/**
 * Récupère toutes les réservations de la base de données.
 *
 * @return array Tableau associatif de toutes les réservations.
 */
function get_all_reservations()
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT reservations.*, users.name, users.surname, cottages.name as cottageName, users.phone as phoneNumber
            FROM reservations
                INNER JOIN users ON reservations.user_id = users.user_id
                INNER JOIN cottages ON reservations.cottage_id = cottages.cottage_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Récupère une réservation spécifique par ID à partir de la base de données.
 *
 * @param int $id_reservation L'ID de la réservation à récupérer.
 * @return array Tableau associatif des détails de la réservation.
 */
function get_reservation_by_id($reservationId)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT reservations.*, users.name, users.surname, cottages.name as cottageName, CottagePhotos.name as photoName, CottagePhotos.path, users.phone as phoneNumber, users.email as email
            FROM reservations
                INNER JOIN users ON reservations.user_id = users.user_id
                INNER JOIN cottages ON reservations.cottage_id = cottages.cottage_id
                LEFT JOIN CottagePhotos ON cottages.cottage_id = CottagePhotos.cottage_id
            WHERE reservations.reservation_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$reservationId]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Met à jour une réservation dans la base de données.
 *
 * @param int $id_reservation L'ID de la réservation à mettre à jour.
 * @param int $id_user Le nouvel ID de l'utilisateur.
 * @param int $id_gite Le nouvel ID du gite.
 * @param string $date_debut La nouvelle date de début de la réservation.
 * @param string $date_fin La nouvelle date de fin de la réservation.
 * @param int $nb_personnes Le nouveau nombre de personnes pour la réservation.
 * @param string $commentaire Les commentaires associés à la réservation.
 * @return void
 */
function update_reservation($reservationId, $userId, $cottageId, $startDate, $endDate, $nbPeople, $comment)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "UPDATE reservations SET user_id = :userId, cottage_id = :cottageId, start_date = :startDate, end_date = :endDate, nb_people = :nbPeople, comment = :comment WHERE reservation_id = :reservationId";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':cottageId', $cottageId);
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->bindParam(':nbPeople', $nbPeople);
    $stmt->bindParam(':reservationId', $reservationId);
    $stmt->bindParam(':comment', $comment);

    $stmt->execute();
}

/**
 * Supprime une réservation spécifique par ID à partir de la base de données.
 *
 * @param int $id_reservation L'ID de la réservation à supprimer.
 * @return void
 */
function delete_reservation($reservationId)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "DELETE FROM reservations WHERE reservation_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$reservationId]);
}

/**
 * Récupère tous les créneaux bloqués à partir de la base de données.
 *
 * @return array Tableau associatif de tous les créneaux bloqués.
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
 * Ajoute un nouveau jour de blocage pour les réservations à la base de données.
 *
 * @param string $date_debut La date de début du blocage au format 'AAAA-MM-JJ'.
 * @param string $date_fin La date de fin du blocage au format 'AAAA-MM-JJ'.
 * @return void
 */
function add_lock_day_reservation($startDate, $endDate)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "INSERT INTO lock_time (start_date, end_date) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$startDate, $endDate]);
}

/**
 * Vérifie si une réservation existe déjà pour le créneau donné.
 *
 * @param string $date_debut La date de début du créneau à vérifier.
 * @param string $date_fin La date de fin du créneau à vérifier.
 * @return bool Retourne vrai si une réservation existe déjà pour le créneau donné, faux sinon.
 */
function check_lock_reservation($startDate, $endDate){
    $db = new DbConnect();
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT * FROM reservations WHERE (start_date BETWEEN :startDate AND :endDate) OR (end_date BETWEEN :startDate AND :endDate) OR (:startDate BETWEEN start_date AND end_date) OR (:endDate BETWEEN start_date AND end_date)");
    $stmt->bindParam(":startDate", $startDate);
    $stmt->bindParam(":endDate", $endDate);
    $stmt->execute();

    return $stmt->rowCount();
}

/**
 * Vérifie la disponibilité d'une réservation en fonction d'un créneau bloqué.
 *
 * @param string $date_debut La date de début du créneau à vérifier.
 * @param string $date_fin La date de fin du créneau à vérifier.
 * @return bool Retourne vrai si le créneau est disponible, faux sinon.
 */
function check_reservation_availability_lock($startDate, $endDate){
    $db = new DbConnect();
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT * FROM lock_time WHERE (start_date BETWEEN :startDate AND :endDate) OR (end_date BETWEEN :startDate AND :endDate) OR (:startDate BETWEEN start_date AND end_date) OR (:endDate BETWEEN start_date AND end_date)");
    $stmt->bindParam(":startDate", $startDate);
    $stmt->bindParam(":endDate", $endDate);
    $stmt->execute();

    return $stmt->rowCount() == 0;
}

/**
 * Vérifie l'unicité d'une réservation pour un gite et un créneau donnés.
 *
 * @param int $id_gite L'ID du gite à vérifier.
 * @param string $date_debut La date de début du créneau à vérifier.
 * @param string $date_fin La date de fin du créneau à vérifier.
 * @return bool Retourne vrai si le créneau est disponible pour le gite donné, faux sinon.
 */
function check_duplicate_checking($cottageId, $startDate, $endDate){
    $db = new DbConnect();
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT * FROM reservations WHERE cottage_id = :cottageId AND ((start_date BETWEEN :startDate AND :endDate) OR (end_date BETWEEN :startDate AND :endDate) OR (:startDate BETWEEN start_date AND end_date) OR (:endDate BETWEEN start_date AND end_date))");
    $stmt->bindParam(":cottageId", $cottageId);
    $stmt->bindParam(":startDate", $startDate);
    $stmt->bindParam(":endDate", $endDate);
    $stmt->execute();

    return $stmt->rowCount() == 0;
}

/**
 * Supprime un jour de blocage de réservation à partir de la base de données.
 *
 * @param string $date_debut La date de début du blocage à supprimer.
 * @param string $date_fin La date de fin du blocage à supprimer.
 * @return void
 */
function remove_lock_day_reservation($startDate, $endDate){
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "DELETE FROM lock_time WHERE start_date = :startDate AND end_date = :endDate";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->execute();
}

?>

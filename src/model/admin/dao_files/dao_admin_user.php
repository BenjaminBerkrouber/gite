<?php

/**
 * Checks if a given email already exists in the database.
 *
 * @param string $email The email to check.
 * @return bool True if the email exists, false otherwise.
 */
function checkDuplicateEmail($email)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT COUNT(*) FROM users WHERE mail = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    $count = $stmt->fetchColumn();

    return $count > 0;
}

/**
 * Checks if a given phone number already exists in the database.
 *
 * @param string $numero The phone number to check.
 * @return bool True if the phone number exists, false otherwise.
 */
function checkDuplicateNumero($numero)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT COUNT(*) FROM users WHERE numero = :numero";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':numero', $numero);
    $stmt->execute();

    $count = $stmt->fetchColumn();

    return $count > 0;
}

/**
 * Adds a new user to the database.
 *
 * @param string $nom The first name of the user.
 * @param string $prenom The last name of the user.
 * @param string $numero The phone number of the user.
 * @param string $adresse The address of the user.
 * @param string $mail The email of the user.
 * @param string $role The role of the user.
 */
function add_user($nom, $prenom, $numero, $adresse, $mail, $role)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "INSERT INTO users (nom, prenom, numero, adresse, mail, role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nom, $prenom, $numero, $adresse, $mail, $role]);
}


/**
 * Retrieves all users from the database.
 *
 * @return array An array of all users.
 */
function get_all_users()
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT * FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Retrieves a user by their ID from the database.
 *
 * @param int $id_user The ID of the user.
 * @return array|null The user if found, null otherwise.
 */
function get_user_by_id($id_user)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT * FROM users WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_user]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Checks if a user exists in the database.
 *
 * @param int $id_user The ID of the user.
 * @return bool True if the user exists, false otherwise.
 */
function user_exists($id_user)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT COUNT(*) FROM users WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_user]);

    $count = $stmt->fetchColumn();

    return $count > 0;
}

/**
 * Updates a user's details in the database.
 *
 * @param int $id_user The ID of the user.
 * @param string $nom The updated first name of the user.
 * @param string $prenom The updated last name of the user.
 * @param string $numero The updated phone number of the user.
 * @param string $adresse The updated address of the user.
 * @param string $mail The updated email of the user.
 * @param string $role The updated role of the user.
 */
function update_user($id_user, $nom, $prenom, $numero, $adresse, $mail, $role)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "UPDATE users SET nom = :nom, prenom = :prenom, numero = :numero, adresse = :adresse, mail = :mail, role = :role WHERE id_user = :id_user";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':id_user', $id_user);

    $stmt->execute();
}

/**
 * Deletes a user from the database.
 *
 * @param int $id The ID of the user to delete.
 */
function delete_user($id)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "DELETE FROM users WHERE id_user= ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
}

?>

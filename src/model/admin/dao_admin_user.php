<?php

function add_user($nom, $prenom, $numero, $adresse, $mail, $role)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "INSERT INTO users (nom, prenom, numero, adresse, mail, role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nom, $prenom, $numero, $adresse, $mail, $role]);

}

function get_all_users()
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT * FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_user_by_id($id_user)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT * FROM users WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_user]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function update_user($id_user, $nom, $prenom, $numero, $adresse, $mail, $role) {
    $db = new DbConnect();
    $conn = $db->connect();

    // Préparation de la requête SQL
    $sql = "UPDATE users SET nom = :nom, prenom = :prenom, numero = :numero, adresse = :adresse, mail = :mail, role = :role WHERE id_user = :id_user";

    // Préparation de la requête avec PDO
    $stmt = $conn->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':id_user', $id_user);

    // Exécution de la requête
    $stmt->execute();

}


function delete_user($id)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "DELETE FROM users WHERE id_user= ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

}

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

?>

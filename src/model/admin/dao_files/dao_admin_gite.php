<?php

/**
 * Adds a new gite to the database.
 *
 * @param string $nom The name of the gite.
 * @param int $places The number of places in the gite.
 * @param string $description The description of the gite.
 * @param float $prix The price of the gite.
 * @return int The last inserted ID.
 */
function add_gite($nom, $places, $description, $prix)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "INSERT INTO gites (nom, places, description, prix) VALUES (:nom, :places, :description, :prix)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':places', $places);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':prix', $prix);
    $stmt->execute();
    return $conn->lastInsertId();
}

/**
 * Adds an image to a gite.
 *
 * @param int $id_gite The ID of the gite.
 * @param string $fileName The name of the image file.
 * @param string $uploadPath The upload path of the image file.
 * @param string $utilite The utility of the image.
 */
function add_gite_image($id_gite, $fileName, $uploadPath, $utilite)
{
    $db = new DbConnect();
    $conn = $db->connect();

    echo "Id Gite : " . $id_gite . "<br>";
    echo "File Name : " . $fileName . "<br>";
    echo "Upload Path : " . $uploadPath . "<br>";
    echo "Utilité : " . $utilite . "<br>";

    $sql = "INSERT INTO PhotosGite (id_gite, nom, chemin, utilite) VALUES (:id_gite, :nom, :chemin, :utilite)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_gite', $id_gite);
    $stmt->bindParam(':nom', $fileName);
    $stmt->bindParam(':chemin', $uploadPath);
    $stmt->bindParam(':utilite', $utilite);
    $stmt->execute();
}

/**
 * Gets the number of places in a gite.
 *
 * @param int $id_gite The ID of the gite.
 * @return int The number of places in the gite.
 */
function get_number_places_gite($id_gite) {
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT places FROM gites WHERE id_gite = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_gite]);

    return $stmt->fetch(PDO::FETCH_ASSOC)['places'];
}

/**
 * Gets all gites from the database.
 *
 * @return array A list of all gites.
 */
function get_all_gites()
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT g.*, pg.chemin as path, pg.nom as nomImg
            FROM gites g
                LEFT JOIN PhotosGite pg ON g.id_gite = pg.id_gite
            GROUP BY g.id_gite";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Gets a gite by its ID.
 *
 * @param int $id_gite The ID of the gite.
 * @return array|null The gite or null if it does not exist.
 */
function get_gite_by_id($id_gite)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT g.*
            FROM gites g
            WHERE g.id_gite = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_gite]);

    $gite = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($gite) {
        $sql = "SELECT pg.chemin as path, pg.nom as nomImg, pg.id_photo as id_photo
                FROM PhotosGite pg
                WHERE pg.id_gite = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_gite]);

        $gite['images'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $gite;
    } else {
        return null;
    }
}


/**
 * Gets the images of a gite.
 *
 * @param int $id_gite The ID of the gite.
 * @return array A list of images of the gite.
 */
function get_images($id_gite)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT * FROM PhotosGite WHERE id_gite = :id_gite";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_gite', $id_gite);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Update a gite in the database.
 *
 * @param int $id_gite The id of the gite.
 * @param string $nom The name of the gite.
 * @param int $places The number of places in the gite.
 * @param string $description The description of the gite.
 * @param float $prix The price of the gite.
 *
 * @throws \PDOException on database error.
 */
function update_gite($id_gite, $nom, $places, $description, $prix)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "UPDATE gites SET nom = :nom, places = :places, description = :description, prix = :prix WHERE id_gite = :id_gite";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':places', $places);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':id_gite', $id_gite);

    $stmt->execute();
}

/**
 * Updates the price of a gite.
 *
 * @param int $id_gite The ID of the gite.
 * @param float $prix The new price of the gite.
 */
function update_gite_price($id_gite, $prix) {
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "UPDATE gites SET prix = :prix WHERE id_gite = :id_gite";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':id_gite', $id_gite);
    $stmt->execute();
}

/**
 * Deletes a gite.
 *
 * @param int $id_gite The ID of the gite.
 */
function delete_gite($id_gite)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "DELETE FROM PhotosGite WHERE id_gite = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_gite]);

    $sql = "DELETE FROM gites WHERE id_gite = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_gite]);
}

/**
 * Checks if a gite exists.
 *
 * @param int $id_gite The ID of the gite.
 * @return bool True if the gite exists, false otherwise.
 */
function gite_exists($id_gite){
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "SELECT * FROM gites WHERE id_gite = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_gite]);

    return $stmt->rowCount() > 0;
}

/**
 * Deletes an image.
 *
 * @param int $id_image The ID of the image.
 */
function delete_image_by_id($id_image)
{
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "DELETE FROM PhotosGite WHERE id_photo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_image]);
}


?>




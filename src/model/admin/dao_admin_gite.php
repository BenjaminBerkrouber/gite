<?php

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
        // Fetch all the images
        $sql = "SELECT pg.chemin as path, pg.nom as nomImg
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



function get_images($id_gite)
{
    // Connect to the database
    $db = new DbConnect();
    $conn = $db->connect();

    // Prepare the SQL query
    $sql = "SELECT * FROM PhotosGite WHERE id_gite = :id_gite";
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bindParam(':id_gite', $id_gite);

    // Execute the query
    $stmt->execute();

    // Fetch all the results
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function update_gite_price($id_gite, $prix) {
    $db = new DbConnect();
    $conn = $db->connect();

    $sql = "UPDATE gites SET prix = :prix WHERE id_gite = :id_gite";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':id_gite', $id_gite);
    $stmt->execute();
}
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

?>

<?php
session_start();

// Créer une nouvelle connexion à la base de données
$db = new DbConnect();
$conn = $db->connect();

if (isset($_POST['uname']) && isset($_POST['psw'])) {
    $username = $_POST['uname'];
    $password = $_POST['psw']; // le mot de passe saisi par l'utilisateur

    // récupérez le mot de passe hashé depuis la base de données
    $stmt = $conn->prepare('SELECT password FROM owner WHERE name = :name');
    $stmt->bindParam(':name', $username);
    $stmt->execute();
    $hash = $stmt->fetchColumn();

    // vérifiez si le mot de passe saisi par l'utilisateur correspond au hash
    // note : le hash est calculé en utilisant SHA-256, pas SHA-5
    if ($hash !== false && hash('sha256', $password) === $hash) {
        // si le mot de passe est correct, enregistrez le nom d'utilisateur dans la session
        $_SESSION['username'] = $username;
        // redirection vers le tableau de bord admin
        header('Location: /admin/dashboard');
    } else {
        // gestion de l'erreur de connexion
        echo 'Invalid username or password.';
    }
}


include('adminLogin.view.php');

?>

<?php
include('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

    $sql = "SELECT 1 FROM abonne WHERE email = '$email'";
    $stmt = $conn->query($sql);

    if ($stmt->fetch()) {
        $error = "L'email est déjà utilisé.";
    } else {
        $sql = "INSERT INTO abonne (prenom, nom, email, mot_de_passe) VALUES ('$prenom', '$nom', '$email', '$mot_de_passe')";
        $conn->exec($sql);
        header('Location: user_login.php');
        exit();
    }
}
?>

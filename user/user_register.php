<?php
include('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT * FROM abonne WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $error = "L'email est déjà utilisé.";
    } else {
        $stmt = $conn->prepare("INSERT INTO abonne (prenom, nom, email, mot_de_passe) VALUES (:prenom, :nom, :email, :mot_de_passe)");
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe);
        $stmt->execute();
        header('Location: user_login.php');
        exit();
    }
}
?>


<?php
session_start();
include('../includes/navbar_user.php');
include('../includes/config.php');

if (!isset($_SESSION['abonne_id'])) {
    header('Location: user_login.php');
    exit();
}

$abonne_id = $_SESSION['abonne_id'];
$sql = "SELECT * FROM abonne WHERE id = $abonne_id";
$user = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Utilisateur non trouvé.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur - Bibliothèque</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body style="background-color: #f0f2f5;">

    <div class="container mt-5">
        <h1 class="text-center mb-4">Bienvenue sur votre profil utilisateur</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg rounded">
                    <div class="card-header text-center bg-primary text-white">
                        <h2 class="mb-0">Informations de votre Profil</h2>
                    </div>
                    <div class="card-body text-center bg-white">
                        <img src="https://via.placeholder.com/120" class="rounded-circle mb-3" style="width: 120px; height: 120px;" alt="Profile Image">
                        <p><strong>Nom:</strong> <?php echo htmlspecialchars($user['nom']); ?></p>
                        <p><strong>Prénom:</strong> <?php echo htmlspecialchars($user['prenom']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                        <p class="mt-4">Pour améliorer votre expérience, assurez-vous que vos informations sont à jour. Vous pouvez modifier votre profil à tout moment.</p>
                        <a href="user_modify_profile.php" class="btn btn-primary">Modifier le Profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>

</body>
</html>

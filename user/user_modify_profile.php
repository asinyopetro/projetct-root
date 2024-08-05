<?php
session_start();
include('../includes/navbar_user.php');
include('../includes/config.php');

if (!isset($_SESSION['abonne_id'])) {
    header('Location: user_login.php');
    exit();
}

$abonne_id = $_SESSION['abonne_id'];
$stmt = $conn->prepare("SELECT * FROM abonne WHERE id = :id");
$stmt->bindParam(':id', $abonne_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Utilisateur non trouvé.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = !empty($_POST['mot_de_passe']) ? password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT) : $user['mot_de_passe'];

    $stmt = $conn->prepare("UPDATE abonne SET nom = :nom, email = :email, mot_de_passe = :mot_de_passe WHERE id = :id");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe);
    $stmt->bindParam(':id', $abonne_id);
    $stmt->execute();

    header('Location: user_profile.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Profil - Bibliothèque</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>


    <div class="container" style="margin-top: 150px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="text-center">Modifier Profil</h2>
                    </div>
                    <div class="card-body">
                        <form method="post" action="user_modify_profile.php">
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="mot_de_passe">Mot de Passe</label>
                                <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" placeholder="Laissez le vide pour ne pas modifier">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Enregistrer les modifications</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>



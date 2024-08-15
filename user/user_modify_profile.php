<?php
session_start();
include('../includes/config.php');

if (!isset($_SESSION['abonne_id'])) {
    header('Location: user_login.php');
    exit();
}

$abonne_id = $_SESSION['abonne_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = !empty($_POST['mot_de_passe']) ? password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT) : null;

    $sql = "UPDATE abonne SET nom = ?, email = ?" . ($mot_de_passe ? ", mot_de_passe = ?" : "") . " WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($mot_de_passe) {
        $stmt->execute([$nom, $email, $mot_de_passe, $abonne_id]);
    } else {
        $stmt->execute([$nom, $email, $abonne_id]);
    }

    header('Location: user_profile.php');
    exit();
}

$stmt = $conn->prepare("SELECT * FROM abonne WHERE id = ?");
$stmt->execute([$abonne_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

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
    <title>Modifier Profil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="margin-top: 150px;">
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

    <?php include('../includes/footer.php'); ?>
</body>
</html>

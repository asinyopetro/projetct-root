<?php
session_start();
include('../includes/navbar_user.php');
include('../includes/config.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['abonne_id'])) {
    header('Location: abonne_connexion.php');
    exit();
}

$abonne_id = $_SESSION['abonne_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = !empty($_POST['mot_de_passe']) ? password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT) : null;

    $sql = "UPDATE abonne SET nom = :nom, prenom = :prenom, email = :email";
    if ($mot_de_passe) {
        $sql .= ", mot_de_passe = :mot_de_passe";
    }
    $sql .= " WHERE id = :id";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        if ($mot_de_passe) {
            $stmt->bindParam(':mot_de_passe', $mot_de_passe);
        }
        $stmt->bindParam(':id', $abonne_id);
        $stmt->execute();
        $success_message = "Profil mis à jour avec succès.";
    } catch (PDOException $e) {
        $error_message = "Erreur lors de la mise à jour : " . htmlspecialchars($e->getMessage());
    }
}

// Récupération des informations actuelles
$stmt = $conn->prepare("SELECT * FROM abonne WHERE id = :id");
$stmt->bindParam(':id', $abonne_id);
$stmt->execute();
$abonne = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Profil Abonné</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Modifier Profil Abonné</h2>
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php elseif (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form id="abonneModifierProfilForm" method="post" action="abonne_modifier_profil.php">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($abonne['nom']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars($abonne['prenom']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($abonne['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Nouveau Mot de Passe (laisser vide si aucun changement)</label>
                <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
    <script>
    document.getElementById('abonneModifierProfilForm').addEventListener('submit', function(event) {
        let nom = document.getElementById('nom').value;
        let prenom = document.getElementById('prenom').value;
        let email = document.getElementById('email').value;
        let mot_de_passe = document.getElementById('mot_de_passe').value;

        if (nom.trim() === '' || prenom.trim() === '' || email.trim() === '') {
            event.preventDefault();
            alert('Tous les champs sauf le mot de passe sont requis.');
        } else if (!/^[\w-]+@([\w-]+\.)+[a-zA-Z]{2,7}$/.test(email)) {
            event.preventDefault();
            alert('Veuillez entrer un email valide.');
        }
    });
    </script>

    <?php include('../includes/footer.php'); ?>

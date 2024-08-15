<?php
include('../includes/config.php');
include('../includes/navbar_admin.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $statut = $_POST['statut'] ?? '';

    if ($nom && $prenom && $email && $statut) {
        $query = "INSERT INTO abonne (nom, prenom, email, statut) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->execute([$nom, $prenom, $email, $statut]);
        header('Location: abonne_liste.php');
        exit();
    } else {
        echo "Tous les champs sont requis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Abonné - Interface Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin-top: 130px;">
    <h2 class="text-center mb-4">Ajouter un Abonné</h2>
    <div class="form-container" style="max-width: 600px; margin: auto;">
        <div class="card shadow-sm">
            <div class="card-body">
                <form method="post" action="abonne_ajouter.php">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="statut">Statut</label>
                        <select class="form-control" id="statut" name="statut" required>
                            <option value="actif">Actif</option>
                            <option value="suspendu">Suspendu</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
</body>
</html>

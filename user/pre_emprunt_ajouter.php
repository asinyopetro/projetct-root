<?php
session_start();
include('../includes/navbar_user.php');
include('../includes/config.php');

if (!isset($_SESSION['abonne_id'])) {
    header('Location: index1.php');
    exit();
}

$abonne_id = $_SESSION['abonne_id'];
$stmt = $conn->prepare("SELECT statut FROM abonne WHERE id = ?");
$stmt->execute([$abonne_id]);
$abonne = $stmt->fetch(PDO::FETCH_ASSOC);

if ($abonne['statut'] === 'suspendu') {
    $error = "Vous êtes suspendu et ne pouvez pas faire d'emprunt.";
} else {

    $titre = isset($_GET['titre']) ? urldecode($_GET['titre']) : '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $isbn = $_POST['isbn'];
        $date_recuperation = $_POST['date_recuperation'];
        $date_retour = $_POST['date_retour']; 

        $stmt = $conn->prepare("SELECT isbn FROM livre WHERE titre = ?");
        $stmt->execute([$titre]);
        $livre = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($livre && $livre['isbn'] === $isbn) {
           
            $stmt = $conn->prepare("
                INSERT INTO emprunt (abonne_id, isbn, titre, date_emprunt, date_recuperation, date_retour) 
                VALUES (?, ?, ?, NOW(), ?, ?)
            ");
            $stmt->execute([$abonne_id, $isbn, $titre, $date_recuperation, $date_retour]);
            $success_message = "Emprunt ajouté avec succès.";
            header('Refresh:2; url=emprunt_en_cours.php');
        } else {
            $error = "Erreur lors de l'ajout de l'emprunt. Veuillez vérifier les informations.";
        }
    } else {
        
        $stmt = $conn->prepare("SELECT isbn FROM livre WHERE titre = ?");
        $stmt->execute([$titre]);
        $livre = $stmt->fetch(PDO::FETCH_ASSOC);

        $isbn = $livre['isbn'] ?? '';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Emprunt</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .alert { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container" style="max-width: 600px; margin-top: 150px;">
        <div class="card" style="padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="card-header" style="background-color: #007bff; color: #fff; border-bottom: 1px solid #0069d9;">
                <h2 class="text-center">Ajouter Emprunt</h2>
            </div>
            <div class="card-body">
                <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                <?php if (isset($success_message)) echo "<div class='alert alert-success'>$success_message</div>"; ?>

                <form id="empruntForm" method="post" action="emprunt_ajouter.php">
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN du Livre</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo htmlspecialchars($isbn); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre du Livre</label>
                        <input type="text" class="form-control" id="titre" name="titre" value="<?php echo htmlspecialchars($titre); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="date_recuperation" class="form-label">Date de Récupération</label>
                        <input type="date" class="form-control" id="date_recuperation" name="date_recuperation" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_retour" class="form-label">Date de Retour</label>
                        <input type="date" class="form-control" id="date_retour" name="date_retour" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Emprunter</button>
                </form>
            </div>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>

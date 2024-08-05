<?php
session_start();
include('../includes/navbar_user.php');
include('../includes/config.php');

if (!isset($_SESSION['abonne_id'])) {
    header('Location: abonne_connexion.php');
    exit();
}

$abonne_id = $_SESSION['abonne_id'];
$stmt = $conn->prepare("SELECT statut FROM abonne WHERE id = :id");
$stmt->bindParam(':id', $abonne_id);
$stmt->execute();
$abonne = $stmt->fetch(PDO::FETCH_ASSOC);

if ($abonne['statut'] === 'suspendu') {
    $error = "Vous êtes suspendu et ne pouvez pas faire d'emprunt.";
} else {
    $livres_disponibles = [];
    $stmt = $conn->prepare("
        SELECT l.isbn, l.titre 
        FROM livre l
        LEFT JOIN emprunt e ON l.isbn = e.isbn AND e.retourne = 0
        WHERE e.isbn IS NULL
    ");
    $stmt->execute();
    $livres_disponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $isbn = $_POST['isbn'];
        $date_recuperation = $_POST['date_recuperation'];
        $date_retour = $_POST['date_retour'];
        $date_emprunt = date('Y-m-d');

        $stmt = $conn->prepare("
            SELECT * FROM emprunt 
            WHERE isbn = :isbn 
            AND retourne = FALSE 
            AND (date_recuperation BETWEEN :date_recuperation AND :date_retour 
            OR date_retour BETWEEN :date_recuperation AND :date_retour
            OR :date_recuperation BETWEEN date_recuperation AND IFNULL(date_retour, :date_retour))
        ");
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':date_recuperation', $date_recuperation);
        $stmt->bindParam(':date_retour', $date_retour);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $error = "Le livre est déjà emprunté durant cette période.";
        } elseif ($date_recuperation > $date_retour) {
            $error = "La date de retour doit être après la date de récupération.";
        } else {
            $stmt = $conn->prepare("
                INSERT INTO emprunt (abonne_id, isbn, date_emprunt, date_recuperation, date_retour) 
                VALUES (:abonne_id, :isbn, :date_emprunt, :date_recuperation, :date_retour)
            ");
            $stmt->bindParam(':abonne_id', $abonne_id);
            $stmt->bindParam(':isbn', $isbn);
            $stmt->bindParam(':date_emprunt', $date_emprunt);
            $stmt->bindParam(':date_recuperation', $date_recuperation);
            $stmt->bindParam(':date_retour', $date_retour);
            $stmt->execute();
            $success_message = "Emprunt ajouté avec succès.";
            header('Refresh:2; url=emprunt_en_cours.php');
        }
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
        body {
            background-color: #f8f9fa;
        }
     
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container" style="max-width: 600px;
            margin-top: 150px;">
        <div class="card" style="padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="card-header" style="background-color: #007bff;
            color: #fff;
            border-bottom: 1px solid #0069d9;">
                <h2 class="text-center">Ajouter Emprunt</h2>
            </div>
            <div class="card-body">
                <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                <?php if (isset($success_message)) { echo "<div class='alert alert-success'>$success_message</div>"; } ?>
                <form id="empruntForm" method="post" action="emprunt_ajouter.php">
                    <div class="mb-3">
                        <label for="isbn" class="form-label" >Choisir un Livre</label>
                        <select class="form-select" style="border-radius: 10px; height:40px; width:120px;"  id="isbn" name="isbn" required>
                            <?php foreach ($livres_disponibles as $livre) { ?>
                                <option value="<?php echo htmlspecialchars($livre['isbn']); ?>"><?php echo htmlspecialchars($livre['titre']); ?></option>
                            <?php } ?>
                        </select>
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

    <script>
    document.getElementById('empruntForm').addEventListener('submit', function(event) {
        let dateRecuperation = new Date(document.getElementById('date_recuperation').value);
        let dateRetour = new Date(document.getElementById('date_retour').value);

        if (dateRecuperation > dateRetour) {
            event.preventDefault();
            alert('La date de retour doit être après la date de récupération.');
        }
    });
    </script>
    
    <?php include('../includes/footer.php'); ?>


<?php
include('../includes/navbar_admin.php');
include('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $abonne_id = $_POST['abonne_id'];
    $isbn = $_POST['isbn'];
    $date_emprunt = $_POST['date_emprunt'];
    $date_retour = $_POST['date_retour'];
    $retourne = isset($_POST['retourne']) ? 1 : 0;

    try {
        $stmt = $conn->prepare("UPDATE emprunt SET abonne_id = :abonne_id, isbn = :isbn, date_emprunt = :date_emprunt, date_retour = :date_retour, retourne = :retourne WHERE id = :id");
        $stmt->bindParam(':abonne_id', $abonne_id);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':date_emprunt', $date_emprunt);
        $stmt->bindParam(':date_retour', $date_retour);
        $stmt->bindParam(':retourne', $retourne);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('Location: emprunt_liste.php');
        exit();
    } catch (Exception $e) {
        $error_message = "Erreur lors de la mise à jour de l'emprunt : " . htmlspecialchars($e->getMessage());
    }
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM emprunt WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$emprunt = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt_abonne = $conn->prepare("SELECT * FROM abonne");
$stmt_abonne->execute();
$abonnes = $stmt_abonne->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Emprunt - Bibliothèque</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Modifier un Emprunt</h2>

        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php } ?>

        <form id="empruntForm" method="post" action="emprunt_modifier.php?id=<?php echo htmlspecialchars($emprunt['id']); ?>">
            <div class="form-group">
                <label for="abonne_id">Abonné</label>
                <select class="form-control" id="abonne_id" name="abonne_id" required>
                    <?php foreach($abonnes as $abonne) {
                        $selected = $emprunt['abonne_id'] == $abonne['id'] ? 'selected' : '';
                        echo "<option value='".htmlspecialchars($abonne['id'])."' $selected>".htmlspecialchars($abonne['nom']." ".$abonne['prenom'])."</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN du Livre</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo htmlspecialchars($emprunt['isbn']); ?>" required>
            </div>
            <div class="form-group">
                <label for="date_emprunt">Date d'Emprunt</label>
                <input type="date" class="form-control" id="date_emprunt" name="date_emprunt" value="<?php echo htmlspecialchars($emprunt['date_emprunt']); ?>" required>
            </div>
            <div class="form-group">
                <label for="date_retour">Date de Retour</label>
                <input type="date" class="form-control" id="date_retour" name="date_retour" value="<?php echo htmlspecialchars($emprunt['date_retour']); ?>">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="retourne" name="retourne" <?php echo $emprunt['retourne'] ? 'checked' : ''; ?>>
                <label class="form-check-label" for="retourne">Retourné</label>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Modifier</button>
        </form>

        <script>
        document.getElementById('empruntForm').addEventListener('submit', function(event) {
            let abonne_id = document.getElementById('abonne_id').value;
            let isbn = document.getElementById('isbn').value;
            let date_emprunt = document.getElementById('date_emprunt').value;

            if (abonne_id === '' || isbn === '' || date_emprunt === '') {
                event.preventDefault();
                alert('Tous les champs sont requis.');
            }
        });
        </script>
    </div>

    <?php include('../includes/footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/

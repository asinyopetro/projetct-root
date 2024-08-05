<?php
include('../includes/navbar_admin.php');
include('../includes/config.php');

if (isset($_GET['id'])) {
    $emprunt_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM emprunt WHERE id = :id");
    $stmt->bindParam(':id', $emprunt_id);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $stmt = $conn->prepare("UPDATE emprunt SET retourne = 1 WHERE id = :id");
        $stmt->bindParam(':id', $emprunt_id);
        $stmt->execute();
        $success = "Le retour du livre a été validé avec succès.";
    } else {
        $error = "L'emprunt spécifié n'existe pas.";
    }
} else {
    $error = "Aucun ID d'emprunt spécifié.";
}
?>

<h2>Validation du Retour d'Emprunt</h2>
<?php if (isset($success)) { echo "<p class='text-success'>$success</p>"; } ?>
<?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>
<a href="emprunt_liste.php" class="btn btn-primary">Retour à la Liste des Emprunts</a>

<?php include('../includes/footer.php'); ?>

<?php
include('../includes/navbar_admin.php');
include('../includes/config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $date_retour = date('Y-m-d');
    $stmt = $conn->prepare("UPDATE emprunt SET date_retour = :date_retour, retourne = TRUE WHERE id = :id");
    $stmt->bindParam(':date_retour', $date_retour);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header('Location: emprunt_liste.php');
}
?>

<h2>Retour enregistré avec succès.</h2>
<a href="emprunt_liste.php" class="btn btn-primary">Retourner à la liste</a>

<?php include('../includes/footer.php'); ?>
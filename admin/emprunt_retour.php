<?php
include('../includes/config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $date_retour = date('Y-m-d');
    $stmt = $conn->prepare("UPDATE emprunt SET date_retour = ?, retourne = TRUE WHERE id = ?");
    $stmt->execute([$date_retour, $id]);
    header('Location: emprunt_liste.php');
    exit();
}
?>

<h2>Retour enregistré avec succès.</h2>
<a href="emprunt_liste.php" class="btn btn-primary">Retourner à la liste</a>

<?php include('../includes/footer.php'); ?>

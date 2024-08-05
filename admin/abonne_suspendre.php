<?php
include('../includes/navbar_admin.php');
include('../includes/config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("UPDATE abonne SET statut = 'suspendu' WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header('Location: abonne_liste.php');
}
?>

<h2>Abonné suspendu avec succès.</h2>
<a href="abonne_liste.php" class="btn btn-primary">Retourner à la liste</a>

<?php include('../includes/footer.php'); ?>

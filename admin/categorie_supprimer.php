<?php
include('../includes/config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM categorie WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header('Location: categorie_liste.php');
}
?>

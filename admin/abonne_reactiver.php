<?php
include('../includes/config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("UPDATE abonne SET statut = 'actif' WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: abonne_liste.php');
    exit(); 
}


?>



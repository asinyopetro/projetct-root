<?php
include('../includes/config.php');

if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];

    
    $stmt = $conn->prepare("DELETE FROM emprunt WHERE isbn = ?");
    $stmt->execute([$isbn]);

    $stmt = $conn->prepare("DELETE FROM livre WHERE isbn = ?");
    $stmt->execute([$isbn]);

    header('Location: livre_liste.php');
    exit();
}
?>

<?php

include('../includes/config.php');

if (isset($_GET['id'])) {
    $emprunt_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM emprunt WHERE id = ?");
    $stmt->execute([$emprunt_id]);

    if ($stmt->rowCount() == 1) {
        $stmt = $conn->prepare("UPDATE emprunt SET retourne = 1 WHERE id = ?");
        $stmt->execute([$emprunt_id]);
        $success = "Le retour du livre a été validé avec succès.";
    } else {
        $error = "L'emprunt spécifié n'existe pas.";
    }
} else {
    $error = "Aucun ID d'emprunt spécifié.";
}
?>
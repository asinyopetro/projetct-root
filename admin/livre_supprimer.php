<?php
include('../includes/config.php');

if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];
    $stmt = $conn->prepare("DELETE FROM livre WHERE isbn = :isbn");
    $stmt->bindParam(':isbn', $isbn);
    $stmt->execute();
    header('Location: livre_liste.php');
}
?>

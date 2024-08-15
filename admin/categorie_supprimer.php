<?php
include('../includes/config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT isbn FROM livre WHERE categorie_id = ?");
    $stmt->execute([$id]);
    $isbns = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if (!empty($isbns)) {
        $inQuery = implode(',', array_fill(0, count($isbns), '?'));
        $stmt = $conn->prepare("DELETE FROM emprunt WHERE isbn IN ($inQuery)");
        $stmt->execute($isbns);
    }

    $stmt = $conn->prepare("DELETE FROM livre WHERE categorie_id = ?");
    $stmt->execute([$id]);

    $stmt = $conn->prepare("DELETE FROM categorie WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: categorie_liste.php');
    exit();
}
?>

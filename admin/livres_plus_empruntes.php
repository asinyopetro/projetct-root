<?php
session_start();
include('../includes/navbar_admin.php');
include('../includes/config.php');

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: admin_login.php');
    exit();
}

$query = "
    SELECT l.isbn, l.titre, l.auteur, COUNT(e.isbn) AS nombre_emprunts
    FROM livre l
    JOIN emprunt e ON l.isbn = e.isbn
    WHERE e.retourne = 0
    GROUP BY l.isbn
    ORDER BY nombre_emprunts DESC
";

try {
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . htmlspecialchars($e->getMessage());
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livres les Plus Empruntés - Bibliothèque</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container" style="margin-top: 80px;">
    <h1 class="text-center">Livres les Plus Empruntés</h1>
    <table class="table table-striped">
        <thead>
            <tr class="" style=" background-color: #343a40;
            color: #fff;">
                <th>ISBN</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Nombre d'Emprunts</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($livres)): ?>
                <tr>
                    <td colspan="4" class="text-center">Aucun livre emprunté actuellement.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($livres as $livre): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($livre['isbn']); ?></td>
                        <td><?php echo htmlspecialchars($livre['titre']); ?></td>
                        <td><?php echo htmlspecialchars($livre['auteur']); ?></td>
                        <td><?php echo htmlspecialchars($livre['nombre_emprunts']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include('../includes/footer.php'); ?>


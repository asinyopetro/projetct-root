<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: admin_login.php');
    exit();
}

include('../includes/navbar_admin.php');
include('../includes/config.php');

$query = "
    SELECT l.*, c.nom AS categorie_nom 
    FROM livre l
    LEFT JOIN categorie c ON l.categorie_id = c.id
";
$stmt = $conn->query($query);
$livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Admin - Gestion des Livres</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 60px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Interface Admin</h1>
        
        <div class="mb-4">
            <a href="categorie_liste.php" class="btn btn-primary btn-lg">Liste des Catégories</a>
            <a href="abonne_liste.php" class="btn btn-secondary btn-lg"> liste des abonnés</a>
            <a href="emprunt_liste.php" class="btn btn-danger btn-lg">Liste des Emprunts</a>
        </div>

        <h2 class="mb-4">Liste des Livres</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Catégorie</th>
                        <th>Année de Publication</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livres as $livre): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($livre['isbn']); ?></td>
                            <td><?php echo htmlspecialchars($livre['titre']); ?></td>
                            <td><?php echo htmlspecialchars($livre['auteur']); ?></td>
                            <td><?php echo htmlspecialchars($livre['categorie_nom']); ?></td>
                            <td><?php echo htmlspecialchars($livre['annee_publication']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
    </div>

    <?php include('../includes/footer.php'); ?>

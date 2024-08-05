<?php
include('../includes/navbar_admin.php');
include('../includes/config.php');
$stmt = $conn->prepare("SELECT l.*, c.nom AS categorie_nom FROM livre l JOIN categorie c ON l.categorie_id = c.id");
$stmt->execute();
$livres = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Livres - Interface Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
    function confirmDelete(event) {
        if (!confirm("Êtes-vous sûr de vouloir supprimer ce livre ?")) {
            event.preventDefault();
        }
    }
    </script>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Liste des Livres</h2>
    <a href="livre_ajouter.php" class="btn btn-primary mb-4">Ajouter un Livre</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ISBN</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Catégorie</th>
                <th>Année de Publication</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($livres as $livre) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($livre['isbn']); ?></td>
                    <td><?php echo htmlspecialchars($livre['titre']); ?></td>
                    <td><?php echo htmlspecialchars($livre['auteur']); ?></td>
                    <td><?php echo htmlspecialchars($livre['categorie_nom']); ?></td>
                    <td><?php echo htmlspecialchars($livre['annee_publication']); ?></td>
                    <td>
                        <a href="livre_modifier.php?isbn=<?php echo htmlspecialchars($livre['isbn']); ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="livre_supprimer.php?isbn=<?php echo htmlspecialchars($livre['isbn']); ?>" class="btn btn-danger btn-sm" onclick="confirmDelete(event)">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('../includes/footer.php'); ?>

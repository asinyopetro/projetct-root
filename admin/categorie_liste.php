<?php
include('../includes/navbar_admin.php');
include('../includes/config.php');

$stmt = $conn->prepare("SELECT * FROM categorie");
$stmt->execute();
$categories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Catégories - Interface Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
    <div class="container" style=" margin-top: 50px;">
        <h2 class="text-center mb-4">Liste des Catégories</h2>
        <a href="categorie_ajouter.php" class="btn btn-primary mb-3">Ajouter une Catégorie</a>
        <div class="table-responsive">
            <table class="table table-striped" style="">
                <thead class="" style=" background-color: #343a40;
            color: #fff;">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($categories as $categorie) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($categorie['id']); ?></td>
                            <td><?php echo htmlspecialchars($categorie['nom']); ?></td>
                            <td>
                                <a href="categorie_modifier.php?id=<?php echo $categorie['id']; ?>" class="btn btn-warning btn-sm" style=" margin-right: 5px;" >Modifier</a>
                                <a href="categorie_supprimer.php?id=<?php echo $categorie['id']; ?>" class="btn btn-danger btn-sm" style=" margin-right: 5px;">Supprimer</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>



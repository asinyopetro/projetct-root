<?php
include('../includes/navbar_admin.php');
include('../includes/config.php');
$stmt = $conn->prepare("SELECT * FROM abonne");
$stmt->execute();
$abonnes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Abonnés - Interface Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Liste des Abonnés</h2>
    <a href="abonne_ajouter.php" class="btn btn-primary mb-4">Ajouter un Abonné</a>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr class="" style="vertical-align: middle;">
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($abonnes as $abonne) { ?>
                    <tr class="" style="vertical-align: middle;">
                        <td><?php echo htmlspecialchars($abonne['id']); ?></td>
                        <td><?php echo htmlspecialchars($abonne['nom']); ?></td>
                        <td><?php echo htmlspecialchars($abonne['prenom']); ?></td>
                        <td><?php echo htmlspecialchars($abonne['email']); ?></td>
                        <td><?php echo htmlspecialchars($abonne['statut']); ?></td>
                        <td class="btn-actions" style="display: flex;
            gap: 0.5rem;">
                            <a href="abonne_modifier.php?id=<?php echo htmlspecialchars($abonne['id']); ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <?php if ($abonne['statut'] == 'actif') { ?>
                                <a href="abonne_suspendre.php?id=<?php echo htmlspecialchars($abonne['id']); ?>" class="btn btn-danger btn-sm">Suspendre</a>
                            <?php } else { ?>
                                <a href="abonne_reactiver.php?id=<?php echo htmlspecialchars($abonne['id']); ?>" class="btn btn-success btn-sm">Réactiver</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>



<?php include('../includes/footer.php'); ?>


<?php
include('../includes/navbar_user.php');
include('../includes/config.php');


try {
    $stmt = $conn->query("SELECT * FROM livre LIMIT 9");
    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p class='text-danger'>Erreur de requête : " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Liste de Livres</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="margin-top: 50px;">
        <h2 class="text-center">Liste des Livres</h2>
        <div class="row">
            <?php if (!empty($livres)) { ?>
                <?php foreach ($livres as $livre) { ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($livre['titre']); ?></h5>
                                <p class="card-text">Auteur: <?php echo htmlspecialchars($livre['auteur']); ?></p>
                                <p class="card-text">ISBN: <?php echo htmlspecialchars($livre['isbn']); ?></p>
                                <a href="pre_emprunt_ajouter.php?isbn=<?php echo htmlspecialchars($livre['isbn']); ?>&titre=<?php echo urlencode($livre['titre']); ?>" class="btn btn-primary">Emprunt</a>
                                </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p class="text-danger">Aucun livre disponible pour le moment.</p>
            <?php } ?>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>

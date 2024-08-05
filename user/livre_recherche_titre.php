<?php
include('../includes/navbar_user.php');
include('../includes/config.php');

$livres = [];
$titre = '';

if (isset($_GET['titre']) && !empty(trim($_GET['titre']))) {
    $titre = trim($_GET['titre']);
    try {
        $stmt = $conn->prepare("SELECT * FROM livre WHERE titre LIKE :titre");
        $stmt->bindValue(':titre', '%' . $titre . '%');
        $stmt->execute();
        $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<p class='text-danger'>Erreur de recherche : " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de Livres par Titre</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
     
        .card {
            margin-top: 20px;
            padding: 20px;
        }
       
    </style>
</head>
<body>
    <div class="container" style="margin-top: 80px;">
        <div class="card">
            <div class="card-header" style="background-color: #007bff; color: #fff;">
                <h2 class="text-center">Recherche de Livres par Titre</h2>
            </div>
            <div class="card-body">
                <form method="get" action="livre_recherche_titre.php">
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" value="<?php echo htmlspecialchars($titre); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>

                <?php if (!empty($livres)) { ?>
                    <h3 class="mt-4">Résultats de la Recherche</h3>
                    <table class="table table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>ISBN</th>
                                <th>Titre</th>
                                <th>Auteur</th>
                                <th>Année de Publication</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($livres as $livre) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($livre['isbn']); ?></td>
                                    <td><?php echo htmlspecialchars($livre['titre']); ?></td>
                                    <td><?php echo htmlspecialchars($livre['auteur']); ?></td>
                                    <td><?php echo htmlspecialchars($livre['annee_publication']); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>


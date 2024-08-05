<?php
include('../includes/navbar_user.php');
include('../includes/config.php');

$livres = [];
$categorie_id = null;

// Validation et récupération de la catégorie
if (isset($_GET['categorie_id']) && is_numeric($_GET['categorie_id'])) {
    $categorie_id = intval($_GET['categorie_id']);
    try {
        $stmt = $conn->prepare("SELECT * FROM livre WHERE categorie_id = :categorie_id");
        $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);
        $stmt->execute();
        $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<p class='text-danger'>Erreur de requête : " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de Livres par Catégorie</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
       
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container" style="max-width: 800px;
            margin-top: 50px;">
        <div class="card" style=" padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="card-header" style="   background-color: #007bff;
            color: #fff;
            border-bottom: 1px solid #0069d9;">
                <h2 class="text-center">Recherche de Livres par Catégorie</h2>
            </div>
            <div class="card-body">
            <form method="get" action="livre_recherche_categorie.php">
                <div class="mb-3">
                    <label for="categorie_id" class="form-label">Catégorie</label>
                    <select class="form-select" id="categorie_id" name="categorie_id" required>
                        <option value="" disabled selected>Sélectionner une catégorie</option>
                        <?php
                        try {
                            $stmt = $conn->query("SELECT * FROM categorie");
                            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($categories as $categorie) {
                                echo '<option value="' . htmlspecialchars($categorie['id']) . '">' . htmlspecialchars($categorie['nom']) . '</option>';
                            }
                        } catch (PDOException $e) {
                            echo "<p class='text-danger'>Erreur de récupération des catégories : " . htmlspecialchars($e->getMessage()) . "</p>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
                <?php if (!empty($livres)) { ?>
                    <h3 class="mt-4">Résultats de la Recherche</h3>
                    <table class="table table-striped mt-3">
                        <thead>
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


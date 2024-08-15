<?php
session_start();
include('../includes/navbar_admin.php');
include('../includes/config.php');

$stmt = $conn->query("SELECT id, abonne_id, isbn, date_emprunt, date_retour, retourne FROM emprunt WHERE date_retour < CURDATE() AND (retourne IS NULL OR retourne = 0)");
$emprunts_echus = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprunts Échus - Bibliothèque</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Emprunts Échus</h1>
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Abonné ID</th>
                            <th>ISBN</th>
                            <th>Date d'Emprunt</th>
                            <th>Date de Retour</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($emprunts_echus as $emprunt): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($emprunt['id']); ?></td>
                            <td><?php echo htmlspecialchars($emprunt['abonne_id']); ?></td>
                            <td><?php echo htmlspecialchars($emprunt['isbn']); ?></td>
                            <td><?php echo htmlspecialchars($emprunt['date_emprunt']); ?></td>
                            <td><?php echo htmlspecialchars($emprunt['date_retour']); ?></td>
                            
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>

</body>
</html>

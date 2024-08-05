<?php
session_start();
include('../includes/navbar_admin.php');
include('../includes/config.php');


$query = "SELECT e.id, e.abonne_id, e.isbn, e.date_emprunt, e.date_retour
          FROM emprunt e
          WHERE e.date_retour < CURDATE() AND (e.retourne IS NULL OR e.retourne = 0)";

$stmt = $conn->prepare($query);
$stmt->execute();
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
<body style="background-color: #f8f9fa;">
    <div class="container" style="margin-top: 50px;">
        <h1 class="text-center mb-4">Emprunts Échus</h1>
        <div class="card" style="border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <div class="card-body">
                <table class="table table-bordered" style="border-radius: 8px; overflow: hidden;">
                    <thead>
                        <tr>
                            <th style="background-color: #007bff; color: #ffffff;">ID</th>
                            <th style="background-color: #007bff; color: #ffffff;">Abonné ID</th>
                            <th style="background-color: #007bff; color: #ffffff;">ISBN</th>
                            <th style="background-color: #007bff; color: #ffffff;">Date d'Emprunt</th>
                            <th style="background-color: #007bff; color: #ffffff;">Date de Retour</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($emprunts_echus as $emprunt): ?>
                        <tr style="background-color: #f2f2f2;">
                            <td style="vertical-align: middle;"><?php echo htmlspecialchars($emprunt['id']); ?></td>
                            <td style="vertical-align: middle;"><?php echo htmlspecialchars($emprunt['abonne_id']); ?></td>
                            <td style="vertical-align: middle;"><?php echo htmlspecialchars($emprunt['isbn']); ?></td>
                            <td style="vertical-align: middle;"><?php echo htmlspecialchars($emprunt['date_emprunt']); ?></td>
                            <td style="vertical-align: middle;"><?php echo htmlspecialchars($emprunt['date_retour']); ?></td>
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

<?php
include('../includes/navbar_admin.php');
include('../includes/config.php');

if (isset($_GET['action']) && isset($_GET['id'])) {
    $emprunt_id = $_GET['id'];
    if ($_GET['action'] === 'valider_emprunt') {
        $stmt = $conn->prepare("UPDATE emprunt SET valide = 1 WHERE id = :id");
        $stmt->bindParam(':id', $emprunt_id);
        $stmt->execute();
        $message = "L'emprunt a été validé pour récupération.";
    } elseif ($_GET['action'] === 'retourner') {
        $stmt = $conn->prepare("UPDATE emprunt SET retourne = 1, date_retour = CURDATE() WHERE id = :id");
        $stmt->bindParam(':id', $emprunt_id);
        $stmt->execute();
        $message = "Le retour du livre a été validé avec succès.";
    } else {
        $message = "Action non reconnue.";
    }
}

$stmt = $conn->prepare("
    SELECT e.*, a.nom AS abonne_nom, a.prenom AS abonne_prenom, l.titre AS livre_titre 
    FROM emprunt e 
    JOIN abonne a ON e.abonne_id = a.id 
    JOIN livre l ON e.isbn = l.isbn
");
$stmt->execute();
$emprunts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Emprunts - Bibliothèque</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: #f8f9fa;">
    <div class="container" style="margin-top: 50px;">
        <h2 class="text-center mb-4">Liste des Emprunts</h2>
        <a href="emprunt_ajouter.php" class="btn btn-primary mb-3" style="background-color: #007bff; border-color: #007bff;">Ajouter un Emprunt</a>
        <table class="table table-striped" style="border-radius: 8px; overflow: hidden;">
            <thead>
                <tr>
                    <th style="background-color: #007bff; color: #ffffff;">ID</th>
                    <th style="background-color: #007bff; color: #ffffff;">Abonné</th>
                    <th style="background-color: #007bff; color: #ffffff;">Livre</th>
                    <th style="background-color: #007bff; color: #ffffff;">Date d'Emprunt</th>
                    <th style="background-color: #007bff; color: #ffffff;">Date de Retour</th>
                    <th style="background-color: #007bff; color: #ffffff;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($emprunts as $emprunt) { ?>
                    <tr style="background-color: #f2f2f2;">
                        <td style="vertical-align: middle;"><?php echo htmlspecialchars($emprunt['id']); ?></td>
                        <td style="vertical-align: middle;"><?php echo htmlspecialchars($emprunt['abonne_nom']." ".$emprunt['abonne_prenom']); ?></td>
                        <td style="vertical-align: middle;"><?php echo htmlspecialchars($emprunt['livre_titre']); ?></td>
                        <td style="vertical-align: middle;"><?php echo htmlspecialchars($emprunt['date_emprunt']); ?></td>
                        <td style="vertical-align: middle;"><?php echo $emprunt['date_retour'] ? htmlspecialchars($emprunt['date_retour']) : 'Non retourné'; ?></td>
                        <td>
                            <?php if (!$emprunt['valide']) { ?>
                                <a href="?action=valider_emprunt&id=<?php echo htmlspecialchars($emprunt['id']); ?>" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff;" onclick="return confirm('Confirmez-vous que cet emprunt est validé pour récupération ?');">Valider</a>
                            <?php } ?>
                            <?php if ($emprunt['valide'] && !$emprunt['retourne']) { ?>
                                <a href="?action=retourner&id=<?php echo htmlspecialchars($emprunt['id']); ?>" class="btn btn-success" style="background-color: #28a745; border-color: #28a745;" onclick="return confirm('Confirmez-vous la validation du retour de ce livre ?');">Retour</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php if (isset($message)) { echo "<p class='text-success' style='margin-top: 20px;'>$message</p>"; } ?>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>

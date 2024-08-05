<?php
include('../includes/navbar_user.php');
include('../includes/config.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['abonne_id'])) {
    header('Location: abonne_connexion.php');
    exit();
}

$abonne_id = $_SESSION['abonne_id'];
$stmt = $conn->prepare("
    SELECT e.*, l.titre AS livre_titre 
    FROM emprunt e 
    JOIN livre l ON e.isbn = l.isbn 
    WHERE e.abonne_id = :abonne_id 
    AND e.retourne = 0
");
$stmt->bindParam(':abonne_id', $abonne_id);
$stmt->execute();
$emprunts_en_cours = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprunts en Cours</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 56px;
        }
        .container {
            margin-top: 20px;
        }
        table th, table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include('../includes/navbar_user.php'); ?>
    
    <div class="container" style="margin-top: 80px;">
        <h2 class="mb-4">Emprunts en Cours</h2>
        <?php if (empty($emprunts_en_cours)) { ?>
            <div class="alert alert-info" role="alert">
                Vous n'avez aucun emprunt en cours.
            </div>
        <?php } else { ?>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Livre</th>
                        <th scope="col">Date d'Emprunt</th>
                        <th scope="col">Date de Retour</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($emprunts_en_cours as $emprunt) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($emprunt['id']); ?></td>
                            <td><?php echo htmlspecialchars($emprunt['livre_titre']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($emprunt['date_emprunt'])); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($emprunt['date_retour'])); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
  
    <?php include('../includes/footer.php'); ?>


<?php
include('../includes/navbar_admin.php');
include('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $statut = $_POST['statut'];
    $stmt = $conn->prepare("UPDATE abonne SET nom = :nom, prenom = :prenom, email = :email, statut = :statut WHERE id = :id");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':statut', $statut);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header('Location: abonne_liste.php');
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM abonne WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$abonne = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Abonné - Interface Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>

<div class="container " style="margin-top: 130px;">
    <h2 class="text-center mb-4">Modifier un Abonné</h2>
    <div class="form-container" style=" max-width: 600px;
            margin: auto;">
        <div class="card shadow-sm">
            <div class="card-body">
                <form id="abonneForm" method="post" action="abonne_modifier.php?id=<?php echo htmlspecialchars($abonne['id']); ?>">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($abonne['nom']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars($abonne['prenom']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($abonne['email']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="statut">Statut</label>
                        <select class="form-control" id="statut" name="statut" required>
                            <option value="actif" <?php echo $abonne['statut'] == 'actif' ? 'selected' : ''; ?>>Actif</option>
                            <option value="suspendu" <?php echo $abonne['statut'] == 'suspendu' ? 'selected' : ''; ?>>Suspendu</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
document.getElementById('abonneForm').addEventListener('submit', function(event) {
    let nom = document.getElementById('nom').value;
    let prenom = document.getElementById('prenom').value;
    let email = document.getElementById('email').value;
    let statut = document.getElementById('statut').value;

    if (nom === '' || prenom === '' || email === '' || statut === '') {
        event.preventDefault();
        alert('Tous les champs sont requis.');
    }
});
</script>

<?php include('../includes/footer.php'); ?>



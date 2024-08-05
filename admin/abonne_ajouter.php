<?php
include('../includes/navbar_admin.php');
include('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO abonne (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe);
    $stmt->execute();
    header('Location: abonne_liste.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Abonné - Interface Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<div class="container" style="margin-top: 150px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-light">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0"><i class="fas fa-user-plus"></i> Ajouter un Abonné</h4>
                </div>
                <div class="card-body">
                    <form id="abonneForm" method="post" action="abonne_ajouter.php">
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom" required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez le prénom" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez l'email" required>
                        </div>
                        <div class="form-group">
                            <label for="mot_de_passe">Mot de Passe</label>
                            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" placeholder="Entrez le mot de passe" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Ajouter <i class="fas fa-plus"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
document.getElementById('abonneForm').addEventListener('submit', function(event) {
    let nom = document.getElementById('nom').value;
    let prenom = document.getElementById('prenom').value;
    let email = document.getElementById('email').value;
    let mot_de_passe = document.getElementById('mot_de_passe').value;

    if (nom === '' || prenom === '' || email === '' || mot_de_passe === '') {
        event.preventDefault();
        alert('Tous les champs sont requis.');
    }
});
</script>

<?php include('../includes/footer.php'); ?>


<?php
include('../includes/navbar_admin.php');
include('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $stmt = $conn->prepare("INSERT INTO categorie (nom) VALUES (:nom)");
    $stmt->bindParam(':nom', $nom);
    $stmt->execute();
    header('Location: categorie_liste.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Catégorie - Interface Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div class="container " style="margin-top: 200PX;">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-light">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="card-title"><i class="fas fa-tags"></i> Ajouter une Catégorie</h3>
                </div>
                <div class="card-body">
                    <form id="categorieForm" method="post" action="categorie_ajouter.php">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control form-control-lg" id="nom" name="nom" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">Ajouter <i class="fas fa-plus"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

<script>
document.getElementById('categorieForm').addEventListener('submit', function(event) {
    let nom = document.getElementById('nom').value;
    if (nom === '') {
        event.preventDefault();
        alert('Le nom est requis.');
    }
});
</script>

<?php include('../includes/footer.php'); ?>


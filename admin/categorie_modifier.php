<?php
include('../includes/navbar_admin.php');
include('../includes/config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM categorie WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $categorie = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $stmt = $conn->prepare("UPDATE categorie SET nom = :nom WHERE id = :id");
    $stmt->bindParam(':id', $id);
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
    <title>Modifier une Catégorie - Interface Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
</head>
<body>
    <div class="container" style="    margin-top: 250px;">
        <h2 class="text-center mb-4">Modifier une Catégorie</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="    border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <div class="card-body">
                        <form id="categorieForm" method="post" action="categorie_modifier.php">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($categorie['id']); ?>">
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($categorie['nom']); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" style="  background-color: #007bff;
            border-color: #007bff;  ">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
 

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


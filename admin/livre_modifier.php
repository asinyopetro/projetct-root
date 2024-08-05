<?php
include('../includes/navbar_admin.php');
include('../includes/config.php');
if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];
    $stmt = $conn->prepare("SELECT * FROM livre WHERE isbn = :isbn");
    $stmt->bindParam(':isbn', $isbn);
    $stmt->execute();
    $livre = $stmt->fetch();

    $stmt = $conn->prepare("SELECT * FROM categorie");
    $stmt->execute();
    $categories = $stmt->fetchAll();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isbn = $_POST['isbn'];
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $categorie_id = $_POST['categorie_id'];
    $annee_publication = $_POST['annee_publication'];

    if (empty($titre) || empty($auteur) || empty($categorie_id) || empty($annee_publication)) {
        $error = "Tous les champs sont requis.";
    } else {
        $stmt = $conn->prepare("UPDATE livre SET titre = :titre, auteur = :auteur, categorie_id = :categorie_id, annee_publication = :annee_publication WHERE isbn = :isbn");
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':auteur', $auteur);
        $stmt->bindParam(':categorie_id', $categorie_id);
        $stmt->bindParam(':annee_publication', $annee_publication);
        if ($stmt->execute()) {
            header('Location: livre_liste.php');
            exit();
        } else {
            $error = "Une erreur est survenue lors de la modification du livre.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Livre - Interface Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Modifier un Livre</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form id="livreForm" method="post" action="livre_modifier.php">
                        <input type="hidden" name="isbn" value="<?php echo htmlspecialchars($livre['isbn']); ?>">
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" class="form-control" id="titre" name="titre" value="<?php echo htmlspecialchars($livre['titre']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="auteur">Auteur</label>
                            <input type="text" class="form-control" id="auteur" name="auteur" value="<?php echo htmlspecialchars($livre['auteur']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="categorie_id">Catégorie</label>
                            <select class="form-control" id="categorie_id" name="categorie_id" required>
                                <?php foreach($categories as $categorie) { ?>
                                    <option value="<?php echo htmlspecialchars($categorie['id']); ?>" <?php if($categorie['id'] == $livre['categorie_id']) echo 'selected'; ?>>
                                        <?php echo htmlspecialchars($categorie['nom']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="annee_publication">Année de Publication</label>
                            <input type="number" class="form-control" id="annee_publication" name="annee_publication" value="<?php echo htmlspecialchars($livre['annee_publication']); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
document.getElementById('livreForm').addEventListener('submit', function(event) {
    let titre = document.getElementById('titre').value;
    let auteur = document.getElementById('auteur').value;
    let categorie_id = document.getElementById('categorie_id').value;
    let annee_publication = document.getElementById('annee_publication').value;

    if (titre === '' || auteur === '' || categorie_id === '' || annee_publication === '') {
        event.preventDefault();
        alert('Tous les champs sont requis.');
    }
});
</script>

<?php include('../includes/footer.php'); ?>


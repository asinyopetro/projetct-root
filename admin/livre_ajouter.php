<?php
include('../includes/navbar_admin.php');
include('../includes/config.php');

$stmt = $conn->prepare("SELECT * FROM categorie");
$stmt->execute();
$categories = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isbn = $_POST['isbn'];
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $categorie_id = $_POST['categorie_id'];
    $annee_publication = $_POST['annee_publication'];

    if (!empty($isbn) && !empty($titre) && !empty($auteur) && !empty($categorie_id) && !empty($annee_publication)) {
        $stmt = $conn->prepare("INSERT INTO livre (isbn, titre, auteur, categorie_id, annee_publication) VALUES (:isbn, :titre, :auteur, :categorie_id, :annee_publication)");
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':auteur', $auteur);
        $stmt->bindParam(':categorie_id', $categorie_id);
        $stmt->bindParam(':annee_publication', $annee_publication);
        
        if ($stmt->execute()) {
            $message = "Le livre a été ajouté avec succès.";
            $message_type = "success";
        } else {
            $message = "Une erreur est survenue lors de l'ajout du livre.";
            $message_type = "danger";
        }
    } else {
        $message = "Tous les champs sont requis.";
        $message_type = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Livre - Interface Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container" style="margin-top: 80px;">
    <h2 class="text-center mb-4">Ajouter un Livre</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <?php if (isset($message)): ?>
                        <div class="alert alert-<?php echo htmlspecialchars($message_type); ?>" role="alert">
                            <?php echo htmlspecialchars($message); ?>
                        </div>
                    <?php endif; ?>
                    
                    <form id="livreForm" method="post" action="livre_ajouter.php">
                        <div class="form-group">
                            <label for="isbn">ISBN</label>
                            <input type="text" class="form-control" id="isbn" name="isbn" required>
                        </div>
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" class="form-control" id="titre" name="titre" required>
                        </div>
                        <div class="form-group">
                            <label for="auteur">Auteur</label>
                            <input type="text" class="form-control" id="auteur" name="auteur" required>
                        </div>
                        <div class="form-group">
                            <label for="categorie_id">Catégorie</label>
                            <select class="form-control" id="categorie_id" name="categorie_id" required>
                                <?php foreach($categories as $categorie) { ?>
                                    <option value="<?php echo htmlspecialchars($categorie['id']); ?>"><?php echo htmlspecialchars($categorie['nom']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="annee_publication">Année de Publication</label>
                            <input type="number" class="form-control" id="annee_publication" name="annee_publication" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
document.getElementById('livreForm').addEventListener('submit', function(event) {
    let isbn = document.getElementById('isbn').value;
    let titre = document.getElementById('titre').value;
    let auteur = document.getElementById('auteur').value;
    let categorie_id = document.getElementById('categorie_id').value;
    let annee_publication = document.getElementById('annee_publication').value;

    if (isbn === '' || titre === '' || auteur === '' || categorie_id === '' || annee_publication === '') {
        event.preventDefault();
        alert('Tous les champs sont requis.');
    }
});
</script>

<?php include('../includes/footer.php'); ?>


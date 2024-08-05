<?php
include('../includes/navbar_admin.php');
include('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $abonne_id = $_POST['abonne_id'];
    $isbn = $_POST['isbn'];
    $date_emprunt = $_POST['date_emprunt'];

    
    $stmt = $conn->prepare("SELECT * FROM livre WHERE isbn = :isbn");
    $stmt->bindParam(':isbn', $isbn);
    $stmt->execute();
    $livre = $stmt->fetch();

    if ($livre) {
        
        $stmt = $conn->prepare("INSERT INTO emprunt (abonne_id, isbn, date_emprunt) VALUES (:abonne_id, :isbn, :date_emprunt)");
        $stmt->bindParam(':abonne_id', $abonne_id);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':date_emprunt', $date_emprunt);
        $stmt->execute();
        header('Location: emprunt_liste.php');
    } else {
        echo "Erreur : Le livre avec l'ISBN $isbn n'existe pas.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Emprunt - Interface Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004080;
        }
    </style>
</head>
<body>
    <div class="container" style="margin-top: 150px;">
        <h2 class="text-center mb-4">Ajouter un Emprunt</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <div class="card-body">
                        <form id="empruntForm" method="post" action="emprunt_ajouter.php">
                            <div class="form-group">
                                <label for="abonne_id">Abonné</label>
                                <select class="form-control" id="abonne_id" name="abonne_id" required>
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM abonne");
                                    $stmt->execute();
                                    $abonnes = $stmt->fetchAll();
                                    foreach($abonnes as $abonne) {
                                        echo "<option value='".$abonne['id']."'>".$abonne['nom']." ".$abonne['prenom']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="isbn">ISBN du Livre</label>
                                <input type="text" class="form-control" id="isbn" name="isbn" required>
                            </div>
                            <div class="form-group">
                                <label for="date_emprunt">Date d'Emprunt</label>
                                <input type="date" class="form-control" id="date_emprunt" name="date_emprunt" required>
                            </div>
                            <div class="form-group">
                                <label for="date_retour">Date de Retour</label>
                                <input type="date" class="form-control" id="date_retour" name="date_retour" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('empruntForm').addEventListener('submit', function(event) {
            let abonne_id = document.getElementById('abonne_id').value;
            let isbn = document.getElementById('isbn').value;
            let date_emprunt = document.getElementById('date_emprunt').value;

            if (abonne_id === '' || isbn === '' || date_emprunt === '') {
                event.preventDefault();
                alert('Tous les champs sont requis.');
            }
        });
    </script>
    <?php include('../includes/footer.php'); ?>
</body>
</html>

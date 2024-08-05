<?php
session_start();
include('../includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: user_login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Utilisateur</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Interface Utilisateur</h1>
          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userLivresDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Livres
                            </a>
                            <div class="dropdown-menu" aria-labelledby="userLivresDropdown">
                                <a class="dropdown-item" href="../user/livre_recherche_titre.php">Recherche par Titre</a>
                                <a class="dropdown-item" href="../user/livre_recherche_categorie.php">Recherche par Catégorie</a>
                                <!-- <a class="dropdown-item" href="../user/livre_liste.php">Liste des Livres</a> -->
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userEmpruntsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Emprunts
                            </a>
                            <div class="dropdown-menu" aria-labelledby="userEmpruntsDropdown">
                                <a class="dropdown-item" href="../user/emprunt_en_cours.php">Emprunts en cours</a>
                                <a class="dropdown-item" href="../user/emprunt_echus.php">Emprunts échus</a>
                                <a class="dropdown-item" href="../user/emprunt_ajouter.php">Emprunter un livre</a>
                                <a class="dropdown-item" href="../user/emprunt_retour.php">Retourner un livre</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../user/abonne_modifier_profil.php">Modifier profil</a>
                        </li>
        <a href="user_logout.php" class="btn btn-secondary">Déconnexion</a>
    </div>
</body>
</html>

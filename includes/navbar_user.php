<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateur - Bibliothèque</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="../index.php">Bibliothèque</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="userLivresDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Livres
                    </a>
                    <div class="dropdown-menu text-white" aria-labelledby="userLivresDropdown">
                        <a class="dropdown-item" href="../user/livre_recherche_titre.php">Recherche par Titre</a>
                        <a class="dropdown-item" href="../user/livre_recherche_categorie.php">Recherche par Catégorie</a>
                    </div>
                </li>
                <li class="nav-item dropdown text-white">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="userEmpruntsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Emprunts
                    </a>
                    <div class="dropdown-menu text-white" aria-labelledby="userEmpruntsDropdown">
                        <a class="dropdown-item" href="../user/emprunt_en_cours.php">Emprunts en cours</a>
                        <a class="dropdown-item" href="../user/emprunt_echus.php">Emprunts échus</a>
                        <a class="dropdown-item" href="../user/emprunt_ajouter.php">Emprunter un livre</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="user_profile.php">Mon Profil</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['abonne_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../user/user_logout.php">Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../user/user_register.php">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../user/user_login.php">Connexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

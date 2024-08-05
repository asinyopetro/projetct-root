<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Bibliothèque</title>
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
                <li class="nav-item">
                    <a class="nav-link text-white" href="../admin/index.php">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="adminLivresDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Livres
                    </a>
                    <div class="dropdown-menu" aria-labelledby="adminLivresDropdown">
                        <a class="dropdown-item" href="../admin/livre_liste.php">Liste des Livres</a>
                        <a class="dropdown-item" href="../admin/livre_ajouter.php">Ajouter un Livre</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="adminAbonnesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Abonnés
                    </a>
                    <div class="dropdown-menu" aria-labelledby="adminAbonnesDropdown">
                        <a class="dropdown-item" href="../admin/abonne_liste.php">Liste des Abonnés</a>
                        <a class="dropdown-item" href="../admin/abonne_ajouter.php">Ajouter un Abonné</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="adminEmpruntsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Emprunts
                    </a>
                    <div class="dropdown-menu" aria-labelledby="adminEmpruntsDropdown">
                        <a class="dropdown-item" href="../admin/emprunt_liste.php">Liste des Emprunts</a>
                        <a class="dropdown-item" href="../admin/emprunt_echus_liste.php">Emprunts Échus</a>
                        <a class="dropdown-item" href="../admin/livres_plus_empruntes.php">Livres les Plus Empruntés</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="adminCategoriesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Catégories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="adminCategoriesDropdown">
                        <a class="dropdown-item" href="../admin/categorie_liste.php">Liste des Catégories</a>
                        <a class="dropdown-item" href="../admin/categorie_ajouter.php">Ajouter une Catégorie</a>
                    </div>
                </li>
            </ul>
            <a href="admin_logout.php" class="btn btn-secondary mt-1">Déconnexion</a>

        </div>
    </div>
</nav>

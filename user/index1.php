<?php
session_start();
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../index2.php">Bibliothèque</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php if (!isset($_SESSION['abonne_id'])): ?>
                    <li class="nav-item">
                        <button class="nav-link btn btn-link" data-toggle="modal" data-target="#registerModal">Inscription</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn btn-link" data-toggle="modal" data-target="#loginModal">Connexion</button>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="user_profile.php">Mon Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_logout.php">Déconnexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container text-center" style="margin-top: 140px;">
        <?php if (!isset($_SESSION['abonne_id'])): ?>
            <div class="jumbotron">
                <h1 class="display-4">Interface Utilisateur</h1>
                <p class="lead">Vous devez vous inscrire ou vous connecter pour accéder à l'interface utilisateur.</p>
                <div class="mt-4">
                    <!-- Boutons pour ouvrir les modals -->
                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#registerModal">Inscription</button>
                    <button class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#loginModal">Connexion</button>
                </div>
            </div>
        <?php else: ?>
            <div class="jumbotron">
                <h1 class="display-4">Bienvenue sur l'interface Utilisateur</h1>
                <p class="lead">Vous pouvez maintenant accéder à toutes les fonctionnalités disponibles.</p>
                <!-- Ajoutez ici le contenu spécifique à l'interface utilisateur -->
            </div>
        <?php endif; ?>
    </div>

<div class="modal fade" style="margin-top: 100px;" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Inscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="user_register.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="mot_de_passe">Mot de Passe</label>
                        <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <div class="modal fade" style="margin-top: 200px;" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Connexion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="user_login.php">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="mot_de_passe">Mot de Passe</label>
                            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                        <?php if (isset($error)) { echo "<p class='text-danger mt-3'>$error</p>"; } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

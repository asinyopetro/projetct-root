<?php
include('includes/head.php');

$redirectTo = isset($_GET['role']) ? $_GET['role'] : '';

if ($redirectTo === 'admin') {
    $showModal = true;
} elseif ($redirectTo === 'user') {
    header('Location: user/index1.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Gestion Bibliothèque</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container text-center" style="margin-top: 300px;">
        <h1>Bienvenue sur l'application de gestion de bibliothèque</h1>
        <div class="mt-5">
            <a href="index.php?role=admin" class="btn btn-primary btn-lg">Accéder à l'interface Admin</a>
            <a href="index.php?role=user" class="btn btn-secondary btn-lg">Accéder à l'interface Utilisateur</a>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Connexion Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModalButton">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" method="post" action="admin/admin_login.php">
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div id="passwordError" class="text-danger mt-2" style="display: none;">Ce champ est requis.</div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                        <?php if (isset($error)) { echo "<p class='text-danger mt-3'>$error</p>"; } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('./includes/footer.php'); ?>

    <script>
        $(document).ready(function(){
            <?php if (isset($showModal) && $showModal): ?>
                $('#loginModal').modal('show');
            <?php endif; ?>

            document.getElementById('closeModalButton').addEventListener('click', function() {
                window.location.href = 'index.php';
            });

            $('#loginModal').on('hidden.bs.modal', function () {
                window.location.href = 'index.php';
            });
        });
    </script>
</body>
</html>

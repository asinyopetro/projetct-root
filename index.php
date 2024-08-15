<?php
include('includes/head.php');

$admin_password = '96233902';
$error = '';
$show_password = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $show_password = isset($_POST['show_password']) ? true : false;

    if ($password === $admin_password) {
        header('Location: admin/index.php');
        exit();
    } else {
        $error = "Mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Gestion Bibliothèque</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container text-center" style="margin-top: 300px;">
        <h1>Bienvenue sur l'application de gestion de bibliothèque</h1>
        <div class="mt-5">
            <a href="#loginModal" data-toggle="modal" class="btn btn-primary btn-lg">Accéder à l'interface Admin</a>
            <a href="user/index1.php" class="btn btn-secondary btn-lg">Accéder à l'interface Utilisateur</a>
        </div>
    </div>

  
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Connexion Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" method="post" action="">
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="<?php echo $show_password ? 'text' : 'password'; ?>" class="form-control" id="password" name="password" required value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="show_password">
                                <input type="checkbox" id="show_password" name="show_password" <?php echo $show_password ? 'checked' : ''; ?>> Afficher le mot de passe
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                        <?php if ($error) { echo "<p class='text-danger mt-3'>$error</p>"; } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('./includes/footer.php'); ?>
</body>
</html>

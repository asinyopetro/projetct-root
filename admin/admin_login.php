<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];

    if ($password === '96233902') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: index.php');
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
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .modal-content {
            border-radius: 0.5rem;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }
        .modal-header {
            border-bottom: none;
        }
    </style>
</head>
<body>

  
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
                    <form method="post" action="admin_login.php">
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                        <?php if (isset($error)) { echo "<p class='text-danger mt-3'>$error</p>"; } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function(){
            $('#loginModal').modal('show');
        });
    </script>

<?php include('../includes/footer.php'); ?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['submit'])) {
    require_once 'class/Form.php';
    
    if (Form::areAllPostsFilled()) {
        require_once 'class/User.php';
        require_once 'class/DbConnection.php';

        $input_login = htmlspecialchars(trim($_POST['login']), ENT_QUOTES, 'UTF-8');
        $input_password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8');

        require_once 'elements/dbconnect.php'; // require $pdo variable

        $log_user = new User($pdo, $input_login, $input_password);

        try {
            if ($log_user->signIn()) {
                header('Location: index.php');
            }
        } catch (Exception $e) {
            $signin_error = $e->getMessage();
        }
    }
}

var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | Réservation Salle</title>
</head>
<body>
    <?php require_once 'elements/header.php' ?>

    <main>
        <h2>Connexion</h2>
        <form action="" method="post">
            <?php if (isset($signin_error)): ?>
                <p><?= $signin_error ?></p>
            <?php endif ?>
            <input type="text" name="login" id="login">
            <input type="password" name="password" id="password">
            <input type="submit" name="submit" value="Connexion">
        </form>
    </main>

    <?php require_once 'elements/footer.php' ?>
</body>
</html>

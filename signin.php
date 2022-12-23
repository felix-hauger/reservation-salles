<?php
if (session_status() === PHP_SESSION_NONE) {
session_start();
}

if (isset($_POST['submit'])) {
    require_once 'class/Form.php';
    require_once 'class/User.php';

    if (Form::areAllPostsFilled()) {
        
    }
}

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
            <input type="text" name="login" id="login">
            <input type="password" name="password" id="password">>
            <input type="submit" name="submit" value="Connexion">
        </form>
    </main>

    <?php require_once 'elements/footer.php' ?>
</body>
</html>

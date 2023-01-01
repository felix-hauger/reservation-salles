<?php
session_start();
var_dump($_SESSION);
require_once 'class/DbConnection.php';
require_once 'class/Form.php';
require_once 'class/User.php';

// $connect = new DbConnection('mysql', 'reservationsalles', 'localhost', 'root', '');

// $pdo = $connect->pdo();

require_once 'elements/dbconnect.php';


// $logged_user = new User($);

if (isset($_POST['submit'])) {
    var_dump($_POST);
    if (isset($_POST['new-password'])) {
        $input_current_password = htmlspecialchars(trim($_POST['current-password']));
        $input_new_password = htmlspecialchars(trim($_POST['new-password']));
        $input_password_confirm = htmlspecialchars(trim($_POST['password-confirmation']));

        // $logged_user = new User()
        
        if (Form::passConfirm($input_new_password, $input_password_confirm)) {
            // $logged_user = new User($)

        }
    } else {
        
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil | Réservation Salles</title>
</head>
<body>
    <?php require_once 'elements/header.php' ?>

    <main>
        <h2>Modifier vos informations de profil</h2>
        <form action="" method="post">
            <input type="text" name="login" id="login" value="<?= $_SESSION['logged_user_login'] ?>" placeholder="Nouveau login">
            <input type="submit" name="submit" value="Modifier login">
        </form>
        <form action="" method="post">
            <input type="password" name="current-password" id="current-password" placeholder="Mot de Passe actuel">
            <input type="password" name="new-password" id="new-password" placeholder="Nouveau Mot de Passe">
            <input type="password" name="password-confirmation" id="password-confirmation" placeholder="Confirmer Mot de Passe">
            <input type="submit" name="submit" value="Modifier Mot de Passe">
        </form>
    </main>

    <?php require_once 'elements/footer.php' ?>
</body>
</html>
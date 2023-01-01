<?php
session_start();
var_dump($_SESSION);
require_once 'class/DbConnection.php';
require_once 'class/Form.php';
require_once 'class/User.php';

// $connect = new DbConnection('mysql', 'reservationsalles', 'localhost', 'root', '');

// $pdo = $connect->pdo();

require_once 'elements/dbconnect.php'; // require $pdo variable

$errors = [];

// $logged_user = new User($);

if (isset($_POST['submit'])) {
    // $password = '';
    var_dump($_POST);
    if (isset($_POST['new-password']) ) {
        $input_current_password = htmlspecialchars(trim($_POST['current-password']));
        $input_new_password = htmlspecialchars(trim($_POST['new-password']));
        $input_password_confirm = htmlspecialchars(trim($_POST['password-confirmation']));

        $logged_user = $_SESSION['logged_user_login'];

        $update_user = new User($pdo, $logged_user, $input_current_password);

        $current_pw_ok = $update_user->checkCredentials();

        if (Form::areAllPostsFilled()) {
            if (Form::passConfirm($input_new_password, $input_password_confirm)) {
                $new_pw_ok = true;
            } else {
                $new_pw_ok = false;
                $errors['passwords-differents'] = 'Champs des Mots de Passe différents.';
            }
    
            var_dump($current_pw_ok, $new_pw_ok);
    
            var_dump($update_user->_errors);
    
            if ($update_user->checkCredentials() && $current_pw_ok) {
                $options = ['cost' => 10];
                $hashed_password = password_hash($input_new_password, PASSWORD_DEFAULT, $options);
                $update_user->setPassword($hashed_password);
                $update_user->updateInfo('password');
            }
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
    <link rel="stylesheet" href="css/style.css">
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
            <?php if (isset($update_user->_errors['credentials'])): ?>
                <p class="error"><?= $update_user->_errors['credentials'] ?></p>
            <?php endif ?>
            <input type="password" name="new-password" id="new-password" placeholder="Nouveau Mot de Passe">
            <input type="password" name="password-confirmation" id="password-confirmation" placeholder="Confirmer Mot de Passe">
            <?php if (isset(Form::$_errors['password'])): ?>
                <p class="error"><?= Form::$_errors['password'] ?></p>
            <?php endif ?>
            <input type="submit" name="submit" value="Modifier Mot de Passe">
            <?php if (isset(Form::$_errors['unfilled'])): ?>
                <p class="error"><?= Form::$_errors['unfilled'] ?></p>
            <?php endif ?>
        </form>
    </main>

    <?php require_once 'elements/footer.php' ?>
</body>
</html>
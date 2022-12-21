<?php

if (isset($_POST['submit'])) {
    require_once 'functions/form_functions.php';
    require_once 'class/Form.php';
    require_once 'class/User.php';

    $all_inputs_filled = Form::areAllPostsFilled();

    var_dump($all_inputs_filled);

    if ($all_inputs_filled) {

        // ENT_QUOTES to convert simple & double quotes
        $input_login = htmlspecialchars(trim($_POST['login']), ENT_QUOTES, 'UTF-8');
        $input_password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8');
        $input_password_confirmation = htmlspecialchars(trim($_POST['password-confirmation']), ENT_QUOTES, 'UTF-8');

        require_once 'class/DbConnection.php';
        
        // construct($type, $db_name, $host, $login, $password)
        $conn = new DbConnection('mysql', 'reservationsalles', 'localhost', 'root', '');

        $pdo = $conn->pdo();

        $user_is_in_db = User::isLoginInDb($input_login, $pdo);

        $passwords_are_equals = Form::passConfirm($input_password, $input_password_confirmation);
        
        var_dump($user_is_in_db, $passwords_are_equals);

        var_dump($pdo);
        


        if (!$user_is_in_db['bool'] && $passwords_are_equals['bool']) {

            $options = ['cost' => 10];

            $hashed_password = password_hash($input_password, PASSWORD_DEFAULT, $options);

            $sql = 'INSERT INTO users (login, password) VALUES (:login, :password)';

            $insert = $pdo->prepare($sql);
            
            $insert->bindParam(':login', $input_login);
            $insert->bindParam(':password', $hashed_password);

            $insert->execute();

            // header('Location: signin.php');
        }



    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | Réservation Salle</title>
</head>
<body>
    <?php require_once 'elements/header.php' ?>

    <main>
        <h2>Inscription</h2>
        <form action="" method="post">
            <input type="text" name="login" id="login" placeholder="Identifiant">

            <?php
            if (isset($user_is_in_db)) {
                if ($user_is_in_db['bool'] === true) {
                    echo '<p class="error-msg">' . $user_is_in_db['err'] . '</p>';
                }
            }
            ?>

            <input type="password" name="password" id="password" placeholder="Mot de Passe">
            <input type="password" name="password-confirmation" id="password-confirmation" placeholder="Mot de Passe">
            <?php
            if (isset($passwords_are_equals)) {
                if ($passwords_are_equals['bool'] === false) {
                    echo '<p class="error-msg">' . $passwords_are_equals['err'] . '</p>';
                }
            }
            ?>

            <input type="submit" name="submit" value="Inscription">
        </form>
    </main>

    <?php require_once 'elements/footer.php' ?>
</body>
</html>
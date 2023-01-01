<?php
// require_once 'class/DbConnection.php';
// require_once 'class/User.php';
// $conn = new DbConnection('mysql', 'reservationsalles', 'localhost', 'root', '');
// $pdo = $conn->pdo();
// $test = new User($pdo, 'test', 'test');
// var_dump($test->{'_errors'});
$errors = [];
$form_error = null;
if (isset($_POST['submit'])) {
    require_once 'class/Form.php';
    
    // $all_inputs_filled = Form::areAllPostsFilled();
    
    // var_dump($all_inputs_filled);
    
    if (Form::areAllPostsFilled()) {
        
        // ENT_QUOTES to convert simple & double quotes
        $input_login = htmlspecialchars(trim($_POST['login']), ENT_QUOTES, 'UTF-8');
        $input_password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8');
        $input_password_confirm = htmlspecialchars(trim($_POST['password-confirmation']), ENT_QUOTES, 'UTF-8');
        
        require_once 'class/User.php';
        require_once 'class/DbConnection.php';

        require_once 'elements/dbconnect.php'; // require $pdo variable

        $create_user = new User($pdo, $input_login, $input_password);

        
        // if (!User::isLoginInDb($input_login, $pdo)) {
        //     $login_ok = true;
        // } else {
        //     $login_ok = false;
        //     $errors['login-taken'] = 'Login déjà pris.';
        // }

        
        // $passwords_are_equals = Form::passConfirm($input_password, $input_password_confirm);
        
        // var_dump($user_is_in_db, $passwords_are_equals);

        if (Form::passConfirm($input_password, $input_password_confirm)) {
            $password_ok = true;
        } else {
            $password_ok = false;
            $errors['passwords-differents'] = 'Champs des Mots de Passe différents.';
        }
        
        if ($password_ok) {
            try {
                $create_user->register();
                // header('Location: signin.php');
            } catch (Exception $e) {
                $register_error = $e->getMessage();
            }
        }

        // // test if error array in instanciated User object is not empty
        // if ($create_user->getErrors()) {

        //     // store errors in temp variable
        //     $user_errors = $create_user->getErrors();

        //     // then store them in errors var of the current page
        //     foreach ($user_errors as $id => $err) {
        //         $errors[$id] = $err;
        //     }
        //     // var_dump($errors);
        // }

    } else {
        $errors['unfilled-inputs'] = 'Veuillez remplir tous les champs.';
    }

    // if (Form::getErrors() || $create_user->getErrors()) {
    //     var_dump(Form::getErrors(), $create_user->getErrors());
    // }

    // // test if error array in instanciated User object is not empty
    // if (Form::getErrors()) {

    //     // store errors in temp variable
    //     $form_errors = Form::getErrors();

    //     // then store them in errors var of the current page
    //     foreach ($form_errors as $id => $err) {
    //         $errors[$id] = $err;
    //     }
    // }
    // var_dump($errors);
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
            <?php if (isset($register_error)): ?>
                <p class="error-msg"><?= $register_error ?></p>
            <?php endif ?>
            
            <input type="password" name="password" id="password" placeholder="Mot de Passe">
            <input type="password" name="password-confirmation" id="password-confirmation" placeholder="Mot de Passe">
            <?php if (isset($errors['passwords-differents'])): ?>
                <p class="error-msg"><?= $errors['passwords-differents'] ?></p>
            <?php endif ?>
            
            <input type="submit" name="submit" value="Inscription">
            <?php if (isset($errors['unfilled-inputs'])): ?>
                <p class="error-msg"><?= $errors['unfilled-inputs'] ?></p>
            <?php endif ?>
        </form>
    </main>

    <?php require_once 'elements/footer.php' ?>
</body>
</html>
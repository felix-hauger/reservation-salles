<?php

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
        <form action="post">
            <input type="text" name="login" id="login" placeholder="Identifiant">
            <input type="password" name="password" id="password" placeholder="Mot de Passe">
            <input type="submit" name="submit" value="Inscription">
        </form>
    </main>

    <?php require_once 'elements/footer.php' ?>
</body>
</html>
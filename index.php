<?php
if (session_status() === PHP_SESSION_NONE) {
session_start();
}
var_dump($_SESSION);

function test() {
    return false || false || true;
}

$test = test();
var_dump($test);

// $test_array = [];
// $test_array[] = ['a' => 1];
// var_dump($test_array);
$test_array2 = [];
$test_array2['a'] = 1;
var_dump($test_array2);


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Salle | Accueil</title>
</head>
<body>
    <?php require_once 'elements/header.php' ?>
    
    <main>

    </main>
    
    <?php require_once 'elements/footer.php' ?>
</body>
</html>
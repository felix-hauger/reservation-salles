<?php

session_start();

if (!isset($_SESSION['is_logged'])) {
    header('Location: signin.php');
    die();
}

require_once 'functions/booking_functions.php';

// assign result of get_booking, an assoc array or false, and redirect if false at the same time
if (!$booking = get_booking()) {
    header('Location: planning.php');
    die();
}

// var_dump($booking);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $booking['title'] ?> | Réservation Salle</title>
</head>

<body>
    <?php require_once 'elements/header.php' ?>

    <main>
        <div id="booking">
            <p>Nom de l'évènement : <?= $booking['title'] ?></p>
            <p>Réservé par : <?= $booking['login'] ?></p>
            <p>Description : <?= $booking['description'] ?></p>
            <p>Début de la réservation : <?= $booking['start'] ?></p>
            <p>Fin de la réservation : <?= $booking['end'] ?></p>
        </div>
    </main>

    <?php require_once 'elements/footer.php' ?>
</body>

</html>
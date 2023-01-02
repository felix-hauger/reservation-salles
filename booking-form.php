<?php
session_start();

var_dump($_SESSION);

if (!isset($_SESSION['is_logged'])) {
    header('Location: signin.php');
    die();
}
$min_date_time = new DateTime('now');
$min_date = $min_date_time->format('Y-m-d');
var_dump($min_date);
// $min_date = $min_date . ':00';
// var_dump($min_date);

function create_booking($title, $description, $start, $end) {
    require_once 'class/DbConnection.php';
    require_once 'elements/dbconnect.php';

    // $sql = 'SELECT start, end FROM bookings';

    // if ()

    $sql = 'INSERT INTO bookings (title, description, start, end) VALUES (:title, :description, :start, :end)';

    $insert = $pdo->prepare($sql);

    $insert->bindParam(':title', $title);
    $insert->bindParam(':description', $description);
    $insert->bindParam(':start', $start);
    $insert->bindParam(':end', $end);

    $insert->execute();
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Réservation | Réservation de Salle</title>
</head>
<body>
    <?php require_once 'elements/header.php'; ?>

    <h2>Formulaire de réservation</h2>
    <form action="" method="post">
        <input type="text" name="title" placeholder="Titre de l'évènement">

        <label for="date">Début de la réservation</label>
        <input type="date" name="date" id="date" min="<?= $min_date_time->format('Y-m-d') ?>">

        <label for="start-hour">Heure de début</label>
        <select name="start-hour" id="start-hour">
            <?php for ($i = 8; $i <= 18; $i++): ?>
                <option value="<?= $i ?>"><?= $i . 'h' ?></option>
            <?php endfor ?>
        </select>

        <label for="end-hour">Heure de fin</label>
        <select name="end-hour" id="end-hour">
            <?php for ($i = 8; $i <= 18; $i++): ?>
                <option value="<?= $i ?>"><?= $i . 'h' ?></option>
            <?php endfor ?>
        </select>

        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10" placeholder="description..."></textarea>

        <input type="submit" name="submit" value="Réserver">
    </form>

    <?php require_once 'elements/footer.php'; ?>
</body>
</html>

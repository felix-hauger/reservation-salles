<?php

$week_days = [
    'monday',
    'tuesday',
    'wednesday',
    'thursday',
    'friday',
    'saturday',
    'sunday'
];

// will contains dates of the current week
$week_dates = [];

// convert week days to unix timestamp of the current week, format it then append it to the $week_dates array
foreach ($week_days as $day) {
    $day_ts = strtotime($day . ' this week');
    $day_date = date('d/m/Y', $day_ts);
    $week_dates[] = $day_date;
}

// $monday_ts = strtotime('monday this week');

// $monday = date('d/m/Y', $monday_ts);

// var_dump($monday);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning | Réservation Salle</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require_once 'elements/header.php' ?>

    <table>
        <thead>
            <tr>
                <th></th>
                <?php foreach ($week_dates as $date): ?>
                    <th><?= $date ?></th>
                <?php endforeach ?>
            </tr>
        </thead>
        <tbody>
            <?php /* Hours */ for ($i = 8; $i <= 18; $i++): ?>
                <tr>
                    <td><?= $i . 'h - ' . $i+1 . 'h' ?></td>
                    <?php foreach ($week_dates as $date): ?>
                        <td>-</td>
                    <?php endforeach ?>
                </tr>
            <?php endfor ?>
        </tbody>
    </table>

    <?php require_once 'elements/footer.php' ?>
</body>
</html>
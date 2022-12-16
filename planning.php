<?php

require_once 'class/DbConnection.php';

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

// convert week days using datetime for the current week, format it then append it to the $week_dates array
foreach ($week_days as $day) {
    $day_date_time = new DateTime($day . ' this week');
    $day_date = $day_date_time->format('d/m/Y');
    $week_dates[] = $day_date;
}

// $monday_ts = strtotime('monday this week');

// $monday = date('d/m/Y', $monday_ts);

// var_dump($monday);

// Planning

$connect = new DbConnection('mysql', 'reservationsalles', 'localhost', 'root', '');

$pdo = $connect->pdo();

$sql = 'SELECT bookings.id, title, description, start, end, login as user FROM bookings INNER JOIN users ON bookings.user_id = users.id';

$select = $pdo->prepare($sql);

$select->execute();

$bookings = $select->fetchAll(PDO::FETCH_OBJ);

// var_dump($bookings);
// $start = new DateTime($bookings[0]->{'start'});
// var_dump($start);
// $start_hour = $start->format('H');
// var_dump($start_hour);
// var_dump($bookings[0]->{'start'}->format('H'));

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
                        <td>-
                            <?php
                            foreach ($bookings as $booking) {
                                $start = new DateTime($booking->{'start'});
                                $start_day = $start->format('d/m/Y');
                                $start_hour = $start->format('H');
                                // var_dump($start_hour);
                                // var_dump($i);
                                // var_dump($start);
                                if ($start_day == $date && $start_hour == $i) {
                                    echo $booking->{'title'};

                                }
                            }
                            ?>
                        </td>
                    <?php endforeach ?>
                </tr>
            <?php endfor ?>
        </tbody>
    </table>

    <?php require_once 'elements/footer.php' ?>
</body>
</html>
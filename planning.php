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

// convert week days using datetime for the current week, set min hour -1 & timezone then append it to $week_dates array
foreach ($week_days as $day) {
    $day_datetime = new DateTime($day . ' this week 7am');
    $timezone = new DateTimeZone('Europe/Paris');
    $day_datetime->setTimezone($timezone);
    $week_dates[] = $day_datetime;
}

// Planning

$connect = new DbConnection('mysql', 'reservationsalles', 'localhost', 'root', '');

$pdo = $connect->pdo();

$sql = 'SELECT bookings.id, title, description, start, end, login as user FROM bookings INNER JOIN users ON bookings.user_id = users.id';

$select = $pdo->prepare($sql);

$select->execute();

$bookings = $select->fetchAll(PDO::FETCH_OBJ);


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
                <?php foreach ($week_dates as $date) : ?>
                    <th><?= $date->format('d/m/Y') // display formated date from array ?></th>
                <?php endforeach ?>
            </tr>
        </thead>
        <tbody>
            <?php /* Hours */ for ($i = 8; $i <= 18; $i++) : ?>

                <tr>
                    <td><?= $i . 'h - ' . $i + 1 . 'h' // display hours on the left column ?></td>
                    <?php foreach ($week_dates as $date) : ?>
                        <td>
                            <?php

                            $date_compare = $date->modify('+ 1 hours');

                            foreach ($bookings as $booking) {
                                $start = new DateTime($booking->{'start'});
                                $end = new DateTime($booking->{'end'});

                                if ($date_compare >= $start && $date_compare <= $end) {
                                    $html = '<a href="booking.php?id=' . $booking->{'id'} . '">' . $booking->{'user'} . '<br />' . $booking->{'title'} . '</a>';
                                    break;
                                } else {
                                    $html = '<a href="booking-form.php">Réserver un créneau</a>';
                                }
                            }
                            echo $html;
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
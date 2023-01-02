<?php

session_start();

function get_booking() {
    if (isset($_GET['id'])) {
        var_dump($_SESSION, $_GET);
    
        echo $_GET['id'] . '<br />';
        echo gettype($_GET['id']) . '<br />';
        echo (int) $_GET['id'] . '<br />';
        echo gettype( (int) $_GET['id']) . '<br />';
        
        var_dump(is_numeric($_GET['id']));
    
        $id = $_GET['id'];
        
        var_dump(preg_match('/^[0-9]$/', $_GET['id']));

        // test if id is a number
        if (preg_match('/^[0-9]$/', $_GET['id'])) {
            require_once 'class/DbConnection.php';
            require_once 'elements/dbconnect.php'; // this require $pdo variable
            
            $sql = 'SELECT bookings.id, title, description, start, end, users.login FROM bookings INNER JOIN users ON bookings.user_id = users.id WHERE bookings.id = :id';
            
            $select = $pdo->prepare($sql);
            
            // $id = htmlspecialchars(trim($_GET['id']), ENT_QUOTES);
            
            $select->bindParam(':id', $id);
            
            $select->execute();
            
            $booking = $select->fetch(PDO::FETCH_ASSOC);
    
            return $booking;
        }
        
    }
}

// assign result of get_booking, an assoc array or false, and redirect if false at the same time
if (!$booking = get_booking()) {
    header('Location: planning.php');
    die();
}

var_dump($booking);
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
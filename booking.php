<?php


if (!empty($_GET)) {
    session_start();
    
    var_dump($_SESSION, $_GET);
    
    require_once 'class/DbConnection.php';
    require_once 'elements/dbconnect.php'; // this require $pdo variable
    
    $sql = 'SELECT bookings.id, title, description, start, end, users.login FROM bookings INNER JOIN users ON bookings.user_id = users.id WHERE bookings.id = :id';
    
    $select = $pdo->prepare($sql);
    
    $id = $_GET['id'];
    
    $select->bindParam(':id', $id);
    
    $select->execute();
    
    $event = $select->fetch(PDO::FETCH_ASSOC);
} else {
    header('Location: planning.php');
    die();
}

var_dump($event);
// foreach ($events as $event) {
// }
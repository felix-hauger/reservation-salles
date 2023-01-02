<?php

function get_booking()
{
    if (isset($_GET['id'])) {

        $id = $_GET['id'];

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
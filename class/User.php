<?php

// construct($type, $db_name, $host, $login, $password)
require_once 'DbConnection.php';

class User
{

    private $login;

    private $password;

    public static function isLoginInDb($login, $pdo): array
    {
        // count number of rows
        $sql = 'SELECT COUNT(id) from users WHERE login LIKE :login';

        $select = $pdo->prepare($sql);

        $select->execute([
            ':login' => $login
        ]);

        // get the COUNT(id) property with fetched object format
        $num = $select->fetch(PDO::FETCH_OBJ)->{'COUNT(id)'};

        // if $num of rows is 0 login is not in db
        if ($num === 0) {
            // $result = false;
            $result = [
                'bool' => false,
                'err'  => 'L\'utilisateur n\'existe pas.'
            ];
        } else {
            // $result = true;
            $result = [
                'bool' => true,
                'err'  => 'L\'utilisateur existe déjà.'
            ];
        }

        return $result;
    }
}

// EXEMPLE

// $conn = new DbConnection('mysql', 'reservationsalles', 'localhost', 'root', '');

// $pdo = $conn->pdo();

// $test = User::isUserInDb('admin', $pdo);

// var_dump($test); // will return true or false


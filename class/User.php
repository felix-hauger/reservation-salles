<?php

// construct($type, $db_name, $host, $login, $password)
require_once 'DbConnection.php';

class User// extends DbConnection
{

    private $_db;
    private $_id;
    private $_login;
    private $_password;

    public function __construct(PDO $db, $login, $password)
    {
        $this->_db = $db;
        $this->_login = $login;
        $this->_password = $password;
    }

    public function register()
    {
        
    }
    
    public function signIn()
    {

    }

    public function checkCredentials()
    {
        $sql = 'SELECT login, password FROM users WHERE login = :login';
        $select = $this->_db->prepare($sql);
        $select->bindParam(':login', $this->_login);
        $select->execute();

        if ($select->rowCount() > 0) {
            $user_infos = $select->fetch(PDO::FETCH_OBJ);
            $submitted_pass = $this->_password;
            if ($submitted_pass === $user_infos->{'password'} || password_verify($this->_password, $user_infos->{'password'})) {
                return $user_infos;
            }
        }
        return false;
    }

    public function getLogin() {
        return $this->_login;
    }
    
    public function setLogin($login) {
        $this->_login = $login;
    }

    public function getPassword() {
        return $this->_password;
    }
    
    public function setPassword($password) {
        $this->_password = $password;
    }


    public static function isLoginInDb($login, $pdo): array
    {
        // count number of rows
        $sql = 'SELECT COUNT(id) FROM users WHERE login LIKE :login';

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


<?php

// construct($type, $db_name, $host, $login, $password)

require_once 'DbConnection.php';
/**
 * Class User
 * 
 * Handles User service including register & login functions
 */

class User // extends DbConnection
{
    /**
     * @var PDO used to init connection to database
     */
    private $_db;

    /**
     * @var int used to get users infos from db
     */
    private $_id;

    /**
     * @var string used to register, log in and modify user informations
     */
    private $_login;

    /**
     * @var string used to register, log in and modify user informations
     */
    private $_password;

    /**
     * @var array used to store errors from class methods
     */
    public array $_errors = [];

    /**
     * @var object to store user infos (not yet used)
     */
    private $_infos;

    public function __construct(PDO $db, $login, $password)
    {
        $this->_db = $db;
        $this->_login = $login;
        $this->_password = $password;
    }

    /**
     * to register a new user to the database
     */
    public function register(): void
    {
        if (self::isLoginInDb($this->_login, $this->_db) === false) {
            $sql = 'INSERT INTO users (login, password) VALUES (:login, :password)';
            $select = $this->_db->prepare($sql);

            $options = ['cost' => 10];
            $hashed_password = password_hash($this->_password, PASSWORD_DEFAULT, $options);

            $select->bindParam(':login', $this->_login);
            $select->bindParam(':password', $hashed_password);

            $select->execute();
        } else {
            // $this->_errors['login-taken'] = 'Login déjà pris';
            throw new Exception('Login déjà pris');
        }
    }

    /**
     * for user to log in
     * @return int $this->{'id'} or boolean false
     */
    public function signIn()
    {
        $user = $this->checkCredentials();

        if ($user) {
            $_SESSION['logged_user_id'] = $user->{'id'};
            $_SESSION['logged_user_login'] = $user->{'login'};
            return $user->{'id'};
        } else {
            throw new Exception('Erreur : identifiants incorrects');
            return false;
        }
    }

    /**
     * used to check if user credentials are correct
     * @return object or boolean 
     */
    public function checkCredentials()
    {

        if (self::isLoginInDb($this->_login, $this->_db)) {
            $sql = 'SELECT id, login, password FROM users WHERE login = :login';
            $select = $this->_db->prepare($sql);

            $select->bindParam(':login', $this->_login);

            $select->execute();

            $user_infos = $select->fetch(PDO::FETCH_OBJ);
            $submitted_pass = $this->_password;
            if ($submitted_pass === $user_infos->{'password'} || password_verify($this->_password, $user_infos->{'password'})) {
                return $user_infos;
            }
        }

        // throw new Exception('Erreur : id incorrects');

        $this->_errors['credentials'] = 'Identifiants incorrects.'; 
        return false;
    }

    public function getID()
    {
        return $this->_id;
    }

    public function setID($id)
    {
        $this->_id = $id;
    }

    public function getLogin()
    {
        return $this->_login;
    }

    public function setLogin($login)
    {
        $this->_login = $login;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function getErrors()
    {
        return $this->_errors;
    }

    /**
     * to update info in db
     * @param $info the info column to update
     */
    public function updateInfo($info)
    {
        $this->_id = $_SESSION['logged_user_id'];

        $sql = 'UPDATE users SET ' . $info . ' = :' . $info . ' WHERE id = :id';

        $update = $this->_db->prepare($sql);

        $param = '_' . $info;

        $update->bindParam(':' . $info, $this->$param);
        $update->bindParam(':id', $this->_id);

        $update->execute();
    }


    /**
     * used to check if login already exists in database
     * @param $login string 
     * @param $pdo PDO
     */
    public static function isLoginInDb($login, $pdo): bool
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
            $result = false;
            // $result = [
            //     'bool' => false,
            //     'err'  => 'L\'utilisateur n\'existe pas.'
            // ];
        } else {
            $result = true;
            // $result = [
            //     'bool' => true,
            //     'err'  => 'L\'utilisateur existe déjà.'
            // ];
        }

        return $result;
    }


    public function logOut()
    {
        unset($_SESSION['logged_user_id']);
        unset($_SESSION['logged_user_login']);
        header('Location: index.php');
    }
}

// EXEMPLE

// $conn = new DbConnection('mysql', 'reservationsalles', 'localhost', 'root', '');

// $pdo = $conn->pdo();

// $user = new User($pdo, 'admin', 'admin');

// $user->register() return void

// $user->signIn() return logged user id

// $test = $user->isUserInDb('admin', $pdo); // method run in register() & checkCredentials() methods, will return true or false

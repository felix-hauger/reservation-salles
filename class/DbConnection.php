<?php

class DbConnection {

    private $type;
    private $db_name;
    private $host;
    private $login;
    private $password;
    private $pdo;

    public function __construct($type, $db_name, $host, $login, $password)
    {
        $this->type = $type;
        $this->db_name = $db_name;
        $this->host = $host;
        $this->login = $login;
        $this->password = $password;
    }

    public function pdo()
    {
         $this->pdo = new PDO ($this->type . ':dbname=' . $this->db_name . ';host=' . $this->host . ';charset=utf8mb4', $this->login, $this->password);

         return $this->pdo;
    }
}

<?php

class DbConnect {
    private $servername = "localhost";
    private $username = "benjamin";
    private $password = "1605";
    private $dbname = "BDD_mh";
    public $conn;

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}


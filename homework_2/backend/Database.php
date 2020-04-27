<?php

class Database {
    
    private $connection;

    public function __construct() {
        $host = "localhost";
	    $dbname = "homework_2_db";
	    $username = "root";
	    $password = "";
        
        $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    }
    
    public function getConnection() {
        return $this->connection;
    }
}

?>
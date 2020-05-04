<?php

class Database {
    
    private $connection;

    public function __construct() {
        $host = "localhost";
	    $dbname = "62120_Aleksandar_Stefanov";
	    $username = "root";
	    $password = "";
        
        $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    }
    
    public function getConnection() {
        return $this->connection;
    }
}

?>
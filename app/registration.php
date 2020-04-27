<?php

	class User {
		public $email;
		public $name;
		public $password;

		function __construct($email, $name, $password) {
			$this->email = $email;
			$this->name = $name;
			$this->password = $password;
		}
	}

	/*$registration = $_REQUEST["registration"];

	$log = fopen("log.txt", "w") or die("Unable to open file!");
	fwrite($log, $registration);

	$regForm = json_decode($registration);

	$response = json_encode($regForm);*/

	echo "{\"message\":\"World\"}";

	/*function insertInDB() {
		
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "db_students";

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$conn->close();
	}*/

?>
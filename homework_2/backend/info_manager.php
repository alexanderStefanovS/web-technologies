<?php

require_once "./Database.php";
require_once "./user_model.php";

function getRequestData() {
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$user = new UserModel($values['firstName'], $values['lastName']);
	return $user;
}

$database = new Database();
$connection = $database->getConnection();

$user = getRequestData();
	
$insertStatement = $connection->prepare("INSERT INTO `users` (first_name, last_name) VALUES (?, ?)");
$insertResult = $insertStatement->execute([$user->firstName, $user->lastName]);

$sql = "SELECT * FROM `users`";
$query = $connection->prepare($sql);
$query->execute([]);

$response = "";

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	$response .= $row['first_name'] . " " . $row['last_name'] . "\n";
}

echo $response;

/*$json = file_get_contents('php://input');
$values = json_decode($json, true);
echo var_dump($values);*/

?>
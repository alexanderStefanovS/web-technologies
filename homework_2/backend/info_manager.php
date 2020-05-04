<?php

require_once "./Database.php";
require_once "./user_model.php";

function saveFile($fileName) {
	$target = '../images' . $fileName;

	move_uploaded_file($_FILES['image']['tmp_name'], $target);
}

function getRequestData() {
	$json = $_POST['userData'];
	$values = json_decode($json, true);

	$file = $_FILES['image'];
	$fileName = $file['name'];

	saveFile($fileName);

	$user = new UserModel($values['firstName'], $values['lastName'], 
						$values['courseYear'], $values['speciality'],
						$values['fn'], $values['groupNumber'],
						$values['birthdate'], $values['zodiacSign'],
						$values['link'], $fileName, $values['motivation']);
	return $user;
}

function getSQLQuery() {
	return "INSERT INTO `users` (firstname, lastname, course_year, speciality,
					fn, group_number, birthdate, zodiac_sign, link, image, motivation) 
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
}

function insert($sql, $user, $connection) {
	$insertStatement = $connection->prepare($sql);
	$insertResult = $insertStatement->execute([$user->firstName, $user->lastName, 
					$user->courseYear, $user->speciality, $user->fn, $user->groupNumber,
					$user->birdthdate, $user->zodiacSign, $user->link, $user->image,
					$user->motivation]);
}

function selectAllUsers($connection) {
	$sql = "SELECT * FROM `users`";
	$query = $connection->prepare($sql);
	$query->execute([]);

	$users = "";

	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$users .= $row['firstname'] . " " . $row['lastname'] . " " . $row['course_year']
						. " " . $row['speciality'] . " " . $row['fn']
						. " " . $row['group_number'] . " " . $row['birthdate'] . " " . 
						$row['zodiac_sign'] . " " . $row['link'] . " " . $row['image'] . " "
						 . $row['motivation'] . "\n";
	}
	return $users;
}

$database = new Database();
$connection = $database->getConnection();

$user = getRequestData();
$sql = getSQLQuery();
insert($sql, $user, $connection);

$response = selectAllUsers($connection);

echo $response;


/**  
 * TEST
*/

/*$json = $_POST['userData'];
$values = json_decode($json, true);

echo var_dump($_POST['userData']);
echo var_dump($json);
echo var_dump($values);
echo var_dump($_FILES);

$file = $_FILES['image'];
$fileName = $file['name'];
$target = '../images' . $fileName;

echo var_dump($target);
echo var_dump($file['tmp_name']);

move_uploaded_file($_FILES['image']['tmp_name'], $target);*/

?>
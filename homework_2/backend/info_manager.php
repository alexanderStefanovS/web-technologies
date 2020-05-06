<?php

require_once "./Database.php";
require_once "./user_model.php";

function areSet() {
	if (!isset($_POST['userData']) || !isset($_FILES['image'])) {
		return false;
	}
	return true;
}

function validate() {
	if (!areSet()) {
		return false;
	}

	$json = $_POST['userData'];
	$values = json_decode($json, true);

	if (empty($values['firstName']) || empty($values['lastName']) || empty($values['courseYear'])
		|| empty($values['speciality']) || empty($values['fn']) || empty($values['groupNumber']) 
		|| empty($values['birthdate']) || empty($values['zodiacSign']) || empty($values['link']) 
		|| empty($values['motivation'])) {
		return false;
	}

	return true;
}

function saveFile($fileName) {
	$target = '../images/' . $fileName;

	move_uploaded_file($_FILES['image']['tmp_name'], $target);
}

function getRequestData() {
	$json = $_POST['userData'];
	$values = json_decode($json, true);

	$file = $_FILES['image'];
	$info = pathinfo($file['name']);
	$ext = $info['extension']; 
	$fn = $values['fn'];
	$fileName = $fn . "." . $ext; 
	saveFile($fileName);

	$user = new UserModel($values['firstName'], $values['lastName'], 
						$values['courseYear'], $values['speciality'],
						$values['fn'], $values['groupNumber'],
						$values['birthdate'], $values['zodiacSign'],
						$values['link'], $fileName, $values['motivation']);
	
	return $user;
}

if (!validate()) {
	echo "Данните са некоректни";
	throw new Exception();
}

try {
	$database = new Database();
	$connection = $database->getConnection();
} catch (PDOException $e) {
	echo json_encode([
		'success' => true,
		'message' => "Неуспешно свързване с базата данни",
	]);
}

$user = getRequestData();

try {
	$user->insert($connection);

	$response = [
		'success' => true,
		'message' => "Данните са записани успешно"
	];
} catch (Exception $exc) {

	$message = $exc->getMessage();

	$response = [
		'success' => false,
		'message' => $message
	];
}

echo json_encode($response);

?>
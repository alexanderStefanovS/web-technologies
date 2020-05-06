<?php

class UserModel {
    private $firstName;
    private $lastName;
    private $courseYear;
    private $speciality;
    private $fn;
    private $groupNumber;
    private $birdthdate;
    private $zodiacSign;
    private $link;
    private $image;
    private $motivation;

    public function __construct($firstName, $lastName, $courseYear, $speciality, 
                    $fn, $groupNumber, $birdthdate, $zodiacSign, $link, $image, $motivation) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->courseYear = $courseYear;
        $this->speciality = $speciality;
        $this->fn = $fn;
        $this->groupNumber = $groupNumber;
        $this->birdthdate = $birdthdate;
        $this->zodiacSign = $zodiacSign;
        $this->link = $link;
        $this->image = $image;
        $this->motivation = $motivation;
    }

    private function getSQLQuery() {
        return "INSERT INTO `users` (firstname, lastname, course_year, speciality,
                        fn, group_number, birthdate, zodiac_sign, link, image, motivation) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    }
    
    public function insert($connection) {

        $sql = $this->getSQLQuery();

        $insertStatement = $connection->prepare($sql);
        $insertResult = $insertStatement->execute([$this->firstName, $this->lastName, 
                        $this->courseYear, $this->speciality, $this->fn, $this->groupNumber,
                        $this->birdthdate, $this->zodiacSign, $this->link, $this->image,
                        $this->motivation]);
        
        
        
        if (!$insertResult) {
            $error = $insertStatement->errorInfo();
            $message = "";
            
            if ($error[1] == 1062) {
                $message = "Съществува потребител с такъв факултетен номер";
            } else {
                $message = "Грешка при запис на данните";
            }
            
            throw new Exception($message);
        }
    }
}


?>
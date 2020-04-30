<?php

class UserModel {
    public $firstName;
    public $lastName;
    public $courseYear;
    public $speciality;
    public $birdthdate;
    public $zodiacSign;
    public $link;
    public $image;
    public $motivation;

    public function __construct($firstName, $lastName, $courseYear, 
                    $speciality, $birdthdate, $zodiacSign, $link, $image, $motivation) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->courseYear = $courseYear;
        $this->speciality = $speciality;
        $this->birdthdate = $birdthdate;
        $this->zodiacSign = $zodiacSign;
        $this->link = $link;
        $this->image = $image;
        $this->motivation = $motivation;
    }
}


?>
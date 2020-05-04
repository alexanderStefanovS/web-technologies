<?php

class UserModel {
    public $firstName;
    public $lastName;
    public $courseYear;
    public $speciality;
    public $fn;
    public $groupNumber;
    public $birdthdate;
    public $zodiacSign;
    public $link;
    public $image;
    public $motivation;

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
}


?>
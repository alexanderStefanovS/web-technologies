CREATE DATABASE `62120_Aleksandar_Stefanov`;

CREATE TABLE `62120_Aleksandar_Stefanov`.`users` 
(
    `id` INT NOT NULL AUTO_INCREMENT ,
    `firstname` VARCHAR(50)  ,
    `lastname` VARCHAR(50)  , 
    `course_year` INT  , 
    `speciality` VARCHAR(100)  , 
    `fn` VARCHAR(10)  , 
    `group_number` INT(5) , 
    `birthdate` DATE  , 
    `zodiacSign` VARCHAR(20)  , 
    `link` VARCHAR(200)  , 
    `image` VARCHAR(100)  , 
    `motivation` TEXT , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB;
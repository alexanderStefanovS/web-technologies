CREATE DATABASE `62120_Aleksandar_Stefanov`;

CREATE TABLE `62120_Aleksandar_Stefanov`.`users` 
(
    `id` INT NOT NULL AUTO_INCREMENT,
    `firstname` VARCHAR(50) NOT NULL,
    `lastname` VARCHAR(50) NOT NULL, 
    `course_year` INT NOT NULL, 
    `speciality` VARCHAR(100) NOT NULL, 
    `fn` VARCHAR(10) NOT NULL, 
    `group_number` INT(5) NOT NULL, 
    `birthdate` DATE NOT NULL, 
    `zodiac_sign` VARCHAR(20) NOT NULL, 
    `link` VARCHAR(200) NOT NULL,
    `image` VARCHAR(100) NOT NULL, 
    `motivation` TEXT NOT NULL, 
    PRIMARY KEY (`id`), UNIQUE ('fn')
);
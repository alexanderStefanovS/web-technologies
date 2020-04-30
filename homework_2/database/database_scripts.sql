CREATE DATABASE homework_2_db;

CREATE TABLE homework_2_db.users (   
    id INT NOT NULL AUTO_INCREMENT, 
    first_name VARCHAR(50) NOT NULL, 
    last_name VARCHAR(50) NOT NULL, 
    PRIMARY KEY (id)
);

ALTER TABLE `users` 
    ADD `course_year` INT NOT NULL AFTER `last_name`, 
    ADD `speciality` VARCHAR(50) NOT NULL AFTER `course_year`, 
    ADD `birdthdate` DATE NOT NULL AFTER `speciality`, 
    ADD `zodiac_sign` VARCHAR(15) NOT NULL AFTER `birdthdate`;
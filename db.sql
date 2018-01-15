CREATE DATABASE `rekrutacja` CHARACTER SET `utf8` COLLATE `utf8_general_ci`;
USE `rekrutacja`;

CREATE TABLE `user` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`fname` VARCHAR(20) NOT NULL,
	`lname` VARCHAR(40) NOT NULL,
	`created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id`)
)ENGINE=InnoDB;


CREATE TABLE `driverlicense` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`category` VARCHAR(5) NOT NULL,
	`description` TEXT NOT NULL,
	`created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id`)
)ENGINE=InnoDB;


CREATE TABLE `user-driverlicense` (
	`user_id` INT(11) UNSIGNED NOT NULL,
	`driverlicense_id` INT(11) UNSIGNED NOT NULL,
	PRIMARY KEY(`user_id`, `driverlicense_id`),
	CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `fk_driverlicense_id` FOREIGN KEY (`driverlicense_id`) REFERENCES `driverlicense` (`id`)
)ENGINE=InnoDB;
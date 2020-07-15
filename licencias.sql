-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema licencias
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `licencias` ;

-- -----------------------------------------------------
-- Schema licencias
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `licencias` DEFAULT CHARACTER SET utf8 ;
USE `licencias` ;

-- -----------------------------------------------------
-- Table `licencias`.`DEPARTMENTS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `licencias`.`DEPARTMENTS` ;

CREATE TABLE IF NOT EXISTS `licencias`.`DEPARTMENTS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `licencias`.`LEVELS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `licencias`.`LEVELS` ;

CREATE TABLE IF NOT EXISTS `licencias`.`LEVELS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `licencias`.`USERS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `licencias`.`USERS` ;

CREATE TABLE IF NOT EXISTS `licencias`.`USERS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NULL,
  `user` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(255) NOT NULL,
  `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIME,
  `update_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIME,
  `DEPARTMENTS_id` INT NOT NULL,
  `LEVELS_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `user_UNIQUE` (`user` ASC),
  UNIQUE INDEX `password_UNIQUE` (`password` ASC),
  INDEX `fk_USERS_DEPARTMENTS_idx` (`DEPARTMENTS_id` ASC),
  INDEX `fk_USERS_ROLES1_idx` (`LEVELS_id` ASC),
  CONSTRAINT `fk_USERS_DEPARTMENTS`
    FOREIGN KEY (`DEPARTMENTS_id`)
    REFERENCES `licencias`.`DEPARTMENTS` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_USERS_ROLES1`
    FOREIGN KEY (`LEVELS_id`)
    REFERENCES `licencias`.`LEVELS` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `licencias`.`TYPES_OF_USERS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `licencias`.`TYPES_OF_USERS` ;

CREATE TABLE IF NOT EXISTS `licencias`.`TYPES_OF_USERS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `licencias`.`SYSTEMS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `licencias`.`SYSTEMS` ;

CREATE TABLE IF NOT EXISTS `licencias`.`SYSTEMS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `licencias`.`APPROVALS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `licencias`.`APPROVALS` ;

CREATE TABLE IF NOT EXISTS `licencias`.`APPROVALS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `status` INT NOT NULL,
  `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIME,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `licencias`.`REQUESTS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `licencias`.`REQUESTS` ;

CREATE TABLE IF NOT EXISTS `licencias`.`REQUESTS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIME,
  `update_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIME,
  `justification` VARCHAR(500) NOT NULL,
  `observation` VARCHAR(500) NULL,
  `status` INT NOT NULL,
  `release_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIME,
  `user_copy` VARCHAR(255) NULL,
  `authorization` VARCHAR(500) NOT NULL,
  `USERS_id` INT NOT NULL,
  `TYPES_OF_USERS_id` INT NOT NULL,
  `SYSTEMS_id` INT NOT NULL,
  `APPROVALS_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_REQUESTS_USERS1_idx` (`USERS_id` ASC),
  INDEX `fk_REQUESTS_TYPES_OF_USERS1_idx` (`TYPES_OF_USERS_id` ASC),
  INDEX `fk_REQUESTS_SYSTEMS1_idx` (`SYSTEMS_id` ASC),
  INDEX `fk_REQUESTS_APPROVALS1_idx` (`APPROVALS_id` ASC),
  CONSTRAINT `fk_REQUESTS_USERS1`
    FOREIGN KEY (`USERS_id`)
    REFERENCES `licencias`.`USERS` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_REQUESTS_TYPES_OF_USERS1`
    FOREIGN KEY (`TYPES_OF_USERS_id`)
    REFERENCES `licencias`.`TYPES_OF_USERS` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_REQUESTS_SYSTEMS1`
    FOREIGN KEY (`SYSTEMS_id`)
    REFERENCES `licencias`.`SYSTEMS` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_REQUESTS_APPROVALS1`
    FOREIGN KEY (`APPROVALS_id`)
    REFERENCES `licencias`.`APPROVALS` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

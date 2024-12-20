-- MySQL Script generated by MySQL Workbench
-- 11/28/16 17:57:49
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `orionlogin_prava`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `orionlogin_prava` ;

CREATE TABLE IF NOT EXISTS `orionlogin_prava` (
  `idprava` INT NOT NULL AUTO_INCREMENT,
  `nazev` VARCHAR(20) NOT NULL,
  `vaha` INT(2) NOT NULL,
  PRIMARY KEY (`idprava`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `orionlogin_uzivatele`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `orionlogin_uzivatele` ;

CREATE TABLE IF NOT EXISTS `orionlogin_uzivatele` (
  `iduzivatel` INT NOT NULL AUTO_INCREMENT,
  `jmeno` VARCHAR(60) NOT NULL,
  `login` VARCHAR(30) NOT NULL,
  `heslo` VARCHAR(40) NOT NULL,
  `email` VARCHAR(35) NOT NULL,
  `idprava` INT NOT NULL DEFAULT 3,
  PRIMARY KEY (`iduzivatel`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `orionlogin_kniha`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `orionlogin_kniha` ;

CREATE TABLE IF NOT EXISTS `orionlogin_kniha` (
  `idkniha` INT NOT NULL AUTO_INCREMENT,
  `clovek` VARCHAR(100) NOT NULL,
  `text` TEXT NOT NULL,
  PRIMARY KEY (`idkniha`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `orionlogin_prava`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `orionlogin_prava` (`idprava`, `nazev`, `vaha`) VALUES (1, 'Administrator', 10);
INSERT INTO `orionlogin_prava` (`idprava`, `nazev`, `vaha`) VALUES (2, 'Recenzent', 5);
INSERT INTO `orionlogin_prava` (`idprava`, `nazev`, `vaha`) VALUES (3, 'Autor', 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `orionlogin_uzivatele`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `orionlogin_uzivatele` (`iduzivatel`, `jmeno`, `login`, `heslo`, `email`, `idprava`) VALUES (1, 'Neznamý autor', 'neznamy', 'hesloneznamy', 'pokus0@kiv.zcu.cz', 3);
INSERT INTO `orionlogin_uzivatele` (`iduzivatel`, `jmeno`, `login`, `heslo`, `email`, `idprava`) VALUES (2, 'Pokusný administrátor', 'admin', 'hesloadmin', 'pokus1@kiv.zcu.cz', 1);
INSERT INTO `orionlogin_uzivatele` (`iduzivatel`, `jmeno`, `login`, `heslo`, `email`, `idprava`) VALUES (3, 'Pokusný recenzent', 'recenzent', 'heslorecenzent', 'pokus2@kiv.zcu.cz', 2);
INSERT INTO `orionlogin_uzivatele` (`iduzivatel`, `jmeno`, `login`, `heslo`, `email`, `idprava`) VALUES (4, 'Pokusný autor', 'autor', 'hesloautor', 'pokus3@kiv.zcu.cz', 3);
INSERT INTO `orionlogin_uzivatele` (`iduzivatel`, `jmeno`, `login`, `heslo`, `email`, `idprava`) VALUES (5, 'Emil Pokus', 'emil', 'heslotajne', 'pokus3@kiv.zcu.cz', 3);
COMMIT; 


-- -----------------------------------------------------
-- Data for table `orionlogin_kniha`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `orionlogin_kniha` (`idkniha`, `clovek`, `text`) VALUES (1, 'František Novák', 'Čekal jsem, že na webu naleznu více informací, proto příliš spokojený nejsem.');
INSERT INTO `orionlogin_kniha` (`idkniha`, `clovek`, `text`) VALUES (2, 'Jana Tůmová', 'Váš web se mi velice líbí, děkuji.');

COMMIT;


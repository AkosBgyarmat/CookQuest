CREATE DATABASE cookquest;
USE cookquest;

CREATE TABLE IF NOT EXISTS `recept` (
    `ReceptID` INT NOT NULL AUTO_INCREMENT,
    `Nev` VARCHAR(150) NOT NULL,
    `Kep` VARCHAR(255) NOT NULL,
    `ElkeszitesiIdo` TIME NOT NULL,
    `NehezsegiSzintID` INT NOT NULL,
    `BegyujthetoPontok` INT NOT NULL,
    `Adag` INT NOT NULL,
    `Elkeszitesi_leiras` TEXT NOT NULL,
    `ElkeszitesiModID` INT NOT NULL,
    `Koltseg` INT NOT NULL,
    `AlkategoriaID` INT NOT NULL,
    `Kaloria` DECIMAL(6,2) NOT NULL,
    PRIMARY KEY (`ReceptID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `hozzavalo` (
    `HozzavaloID` INT NOT NULL AUTO_INCREMENT,
    `Elnevezes` VARCHAR(50) NOT NULL,
    `Kep` VARCHAR(255),
    PRIMARY KEY (`HozzavaloID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `recept_hozzavalo` (
    `ReceptID` INT NOT NULL,
    `HozzavaloID` INT NOT NULL,
    `Mennyiseg` DECIMAL(10,2) NOT NULL,
    `MertekegysegID` INT NOT NULL,
    PRIMARY KEY (`ReceptID`, `HozzavaloID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `konyhaifelszereles` (
    `KonyhaiFelszerelesID` INT NOT NULL AUTO_INCREMENT,
    `Nev` VARCHAR(100) NOT NULL,
    `Kep` VARCHAR(255),
    `BesorolasID` INT NOT NULL,
    `Leiras` TEXT NOT NULL,
    PRIMARY KEY (`KonyhaiFelszerelesID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `recept_konyhaifelszereles` (
    `ReceptID` INT NOT NULL,
    `KonyhaiFelszerelesID` INT NOT NULL,
    PRIMARY KEY (`ReceptID`, `KonyhaiFelszerelesID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `felhasznalo` (
    `FelhasznaloID` INT NOT NULL AUTO_INCREMENT,
    `Vezeteknev` VARCHAR(50) NOT NULL,
    `Keresztnev` VARCHAR(50) NOT NULL,
    `Felhasznalonev` VARCHAR(30) NOT NULL,
    `Emailcim` VARCHAR(254) NOT NULL,
    `Jelszo` VARCHAR(255) NOT NULL,
    `SzuletesiEv` YEAR NOT NULL,
    `Profilkep` VARCHAR(255) NOT NULL,
    `OrszagID` INT NOT NULL,
    `RegisztracioEve` YEAR NOT NULL,
    `MegszerzettPontok` INT NOT NULL,
    `SzerepID` INT,
    PRIMARY KEY (`FelhasznaloID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `felhasznalo_recept` (
    `FelhasznaloID` INT NOT NULL,
    `ReceptID` INT NOT NULL,
    `Elkeszitette` BOOLEAN,
    `KedvencReceptek` BOOLEAN,
    PRIMARY KEY (`FelhasznaloID`, `ReceptID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `felhasznalo_hozzavalo` (
    `FelhasznaloID` INT NOT NULL,
    `HozzavaloID` INT NOT NULL,
    `Mennyiseg` DECIMAL(10,2) NOT NULL,
    `MertekegysegID` INT NOT NULL,
    PRIMARY KEY (`FelhasznaloID`, `HozzavaloID`)
) ENGINE=InnoDB COMMENT='Hűtő';

CREATE TABLE IF NOT EXISTS `nehezsegiszint` (
    `NehezsegiSzintID` INT NOT NULL AUTO_INCREMENT,
    `Szint` INT NOT NULL,
    PRIMARY KEY (`NehezsegiSzintID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `kategoria` (
    `KategoriaID` INT NOT NULL AUTO_INCREMENT,
    `Kategoria` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`KategoriaID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `alkategoria` (
    `AlkategoriaID` INT NOT NULL AUTO_INCREMENT,
    `KategoriaID` INT NOT NULL,
    `Alkategoria` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`AlkategoriaID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `mertekegyseg` (
    `MertekegysegID` INT NOT NULL AUTO_INCREMENT,
    `Elnevezes` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`MertekegysegID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `orszag` (
    `OrszagID` INT NOT NULL AUTO_INCREMENT,
    `Elnevezes` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`OrszagID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `elkeszitesimod` (
    `ElkeszitesiModID` INT NOT NULL AUTO_INCREMENT,
    `ElkeszitesiMod` VARCHAR(255) NOT NULL,
    `Hofok` INT,
    `Funkcio` VARCHAR(50),
    PRIMARY KEY (`ElkeszitesiModID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `besorolas` (
    `BesorolasID` INT NOT NULL AUTO_INCREMENT,
    `Elnevezes` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`BesorolasID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Szerep` (
    `SzerepID` INT NOT NULL AUTO_INCREMENT,
    `Szerep` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`SzerepID`)
) ENGINE=InnoDB;

-- =========================
-- IDEGEN KULCSOK
-- =========================

ALTER TABLE `Recept`
ADD FOREIGN KEY (`NehezsegiSzintID`) REFERENCES `NehezsegiSzint`(`NehezsegiSzintID`);

ALTER TABLE `Recept`
ADD FOREIGN KEY (`ElkeszitesiModID`) REFERENCES `ElkeszitesiMod`(`ElkeszitesiModID`);

ALTER TABLE `Recept`
ADD FOREIGN KEY (`AlkategoriaID`) REFERENCES `Alkategoria`(`AlkategoriaID`);

ALTER TABLE `Alkategoria`
ADD FOREIGN KEY (`KategoriaID`) REFERENCES `Kategoria`(`KategoriaID`);

ALTER TABLE `KonyhaiFelszereles`
ADD FOREIGN KEY (`BesorolasID`) REFERENCES `Besorolas`(`BesorolasID`);

ALTER TABLE `Felhasznalo`
ADD FOREIGN KEY (`OrszagID`) REFERENCES `Orszag`(`OrszagID`);

ALTER TABLE `Felhasznalo`
ADD FOREIGN KEY (`SzerepID`) REFERENCES `Szerep`(`SzerepID`);

ALTER TABLE `Recept_Hozzavalo`
ADD FOREIGN KEY (`ReceptID`) REFERENCES `Recept`(`ReceptID`) ON DELETE CASCADE;

ALTER TABLE `Recept_Hozzavalo`
ADD FOREIGN KEY (`HozzavaloID`) REFERENCES `Hozzavalo`(`HozzavaloID`) ON DELETE CASCADE;

ALTER TABLE `Recept_Hozzavalo`
ADD FOREIGN KEY (`MertekegysegID`) REFERENCES `Mertekegyseg`(`MertekegysegID`);

ALTER TABLE `Recept_KonyhaiFelszereles`
ADD FOREIGN KEY (`ReceptID`) REFERENCES `Recept`(`ReceptID`) ON DELETE CASCADE;

ALTER TABLE `Recept_KonyhaiFelszereles`
ADD FOREIGN KEY (`KonyhaiFelszerelesID`) REFERENCES `KonyhaiFelszereles`(`KonyhaiFelszerelesID`) ON DELETE CASCADE;

ALTER TABLE `Felhasznalo_Recept`
ADD FOREIGN KEY (`FelhasznaloID`) REFERENCES `Felhasznalo`(`FelhasznaloID`) ON DELETE CASCADE;

ALTER TABLE `Felhasznalo_Recept`
ADD FOREIGN KEY (`ReceptID`) REFERENCES `Recept`(`ReceptID`) ON DELETE CASCADE;

ALTER TABLE `Felhasznalo_Hozzavalo`
ADD FOREIGN KEY (`FelhasznaloID`) REFERENCES `Felhasznalo`(`FelhasznaloID`) ON DELETE CASCADE;

ALTER TABLE `Felhasznalo_Hozzavalo`
ADD FOREIGN KEY (`HozzavaloID`) REFERENCES `Hozzavalo`(`HozzavaloID`) ON DELETE CASCADE;

ALTER TABLE `Felhasznalo_Hozzavalo`
ADD FOREIGN KEY (`MertekegysegID`) REFERENCES `Mertekegyseg`(`MertekegysegID`);

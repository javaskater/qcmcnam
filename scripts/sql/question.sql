CREATE TABLE `qcmcnam`.`question` ( `id` INT NOT NULL AUTO_INCREMENT , `idTheme` INT NOT NULL , `idAuteur` INT NOT NULL , `texte` VARCHAR(200) NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;
CREATE TABLE `qcmcnam`.`Reponse` ( `id` INT NOT NULL AUTO_INCREMENT , `idQuestion` INT NOT NULL , `texte` VARCHAR(100) NOT NULL , `bonneReponse` TINYINT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 
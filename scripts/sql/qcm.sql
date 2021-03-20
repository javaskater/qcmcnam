CREATE TABLE `qcmcnam`.`qcm` ( `id` INT NOT NULL AUTO_INCREMENT , `libelle` VARCHAR(200) NOT NULL , `publie` TINYINT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 
CREATE TABLE `qcmcnam`.`questionqcm` ( `id` INT NOT NULL AUTO_INCREMENT , `idQuestion` INT NOT NULL , `idQcm` INT NOT NULL , `ordre` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 

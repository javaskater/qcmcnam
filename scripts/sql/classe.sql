CREATE TABLE `qcmcnam`.`classe` ( `id` INT NOT NULL AUTO_INCREMENT , `nom` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 
INSERT INTO `classe` (`id`, `nom`) VALUES (NULL, 'IGPDE');
INSERT INTO `classe` (`id`, `nom`) VALUES (NULL, 'NOISIEL');

CREATE TABLE `qcmcnam`.`qcmclasse` ( `idClasse` INT NOT NULL, `idQcm` INT NOT NULL) ENGINE = InnoDB; 
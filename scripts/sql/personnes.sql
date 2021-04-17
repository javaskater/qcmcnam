CREATE TABLE `qcmcnam`.`personne` ( `id` INT NOT NULL AUTO_INCREMENT , 
`nom` VARCHAR(100) NOT NULL , `motdepasse` VARCHAR(100) NOT NULL , 
`email` VARCHAR(200) NOT NULL , `statut` VARCHAR(20) NOT NULL ,  `urlImage` VARCHAR(255), PRIMARY KEY (`id`)) 
ENGINE = InnoDB;

INSERT INTO `personne` (`id`, `nom`, `motdepasse`, `email`, `statut`) VALUES (NULL, 'Mena', 'research', 'jpm@jpmena.eu', 'professeur');
INSERT INTO `personne` (`id`, `nom`, `motdepasse`, `email`, `statut`) VALUES (NULL, 'Hily', 'Alain', 'ahily@free.fr', 'professeur');
INSERT INTO `personne` (`id`, `nom`, `motdepasse`, `email`, `statut`) VALUES (NULL, 'Anne', 'medecine', 'anne.mena@gmail.com', 'eleve');
INSERT INTO `personne` (`id`, `nom`, `motdepasse`, `email`, `statut`) VALUES  (NULL, 'Querre', 'brest', 'liliane@gmail.com', 'eleve');

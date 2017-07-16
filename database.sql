CREATE SCHEMA `sincloud-db` DEFAULT CHARACTER SET utf8 ;

use `sincloud-db`;

CREATE TABLE `estado_civil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(40) COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `estado_civil` VALUES (1,'Solteiro'),(2,'Casado'),(3,'Viúvo'),(4,'Divorciado');

CREATE TABLE `genero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(40) COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `genero` VALUES (1,'Masculino'),(2,'Feminino');


CREATE TABLE `pessoas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `estado_civil_id` int(11) DEFAULT NULL,
  `genero_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `pessoas` VALUES (1,'Marcos',1,1),(2,'Rui Barbosa',1,1),(46,'Maria Paula',1,2),(47,'Clarice Lispector',4,2),(48,'Machado de Assis',2,1),(49,'Monteiro Lobato',2,1),(51,'novo teste com mvc',4,2);


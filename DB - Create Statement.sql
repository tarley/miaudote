
CREATE DATABASE `adote`;

USE `adote`;

CREATE TABLE `tb_adocao` (
  `COD_ADOCAO` int(11) NOT NULL AUTO_INCREMENT,
  `COD_USUARIO` int(11) NOT NULL,
  `DT_ADOCAO` datetime NOT NULL,
  `COD_ANIMAL_ADT` int(11) NOT NULL,
  PRIMARY KEY (`COD_ADOCAO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `tb_animal` (
  `COD_ANIMAL` int(11) NOT NULL AUTO_INCREMENT,
  `COD_USUARIO` int(11) DEFAULT NULL,
  `NOM_ANIMAL` varchar(100) DEFAULT NULL,
  `DESC_ANIMAL` varchar(50) DEFAULT NULL,
  `DESC_PERFIL` varchar(2000) NOT NULL,
  `IND_SEXO` smallint(6) DEFAULT NULL,
  `IDADE` int(11) DEFAULT NULL,
  `COR` varchar(50) DEFAULT NULL,
  `IND_PORTE` int(11) DEFAULT NULL,
  `DT_CADASTRO` date DEFAULT NULL,
  `DT_ADOCAO` date DEFAULT NULL,
  `COD_ESPECIE` int(11) NOT NULL,
  PRIMARY KEY (`COD_ANIMAL`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


CREATE TABLE `tb_especie` (
  `COD_ESPECIE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_ESPECIE` varchar(100) NOT NULL,
  PRIMARY KEY (`COD_ESPECIE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `tb_foto` (
  `COD_FOTO` int(11) NOT NULL AUTO_INCREMENT,
  `COD_ANIMAL` int(11) NOT NULL,
  `URL` varchar(200) DEFAULT NULL,
  `ID_FOTO_PRI` char(1) DEFAULT 'N',
  `NOM_FOTO` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`COD_FOTO`,`COD_ANIMAL`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;


CREATE TABLE `tb_usuario` (
  `COD_USUARIO` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` char(50) DEFAULT NULL,
  `NOM_USUARIO` varchar(100) DEFAULT NULL,
  `TELEFONE` varchar(15) DEFAULT NULL,
  `PERFIL` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`COD_USUARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO `tb_usuario` (`COD_USUARIO`,`EMAIL`,`NOM_USUARIO`,`TELEFONE`,`PERFIL`) VALUES (1,'ong@email.com','ONG','31',"Uma ong que ama os animais");
INSERT INTO `tb_usuario` (`COD_USUARIO`,`EMAIL`,`NOM_USUARIO`,`TELEFONE`,`PERFIL`) VALUES (2,'ong@ong,com','CAO CARINHO','32',"Especializada em tratamento de animais");




INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (1,1,NULL,'S','FOTO1');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (1,2,NULL,'S','FOTO1');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (1,3,NULL,'S','FOTO1');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (1,4,NULL,'S','FOTO1');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (1,5,NULL,'S','FOTO1');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (1,6,NULL,'S','FOTO1');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (2,1,NULL,'N','FOTO2');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (2,2,NULL,'N','FOTO2');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (2,3,NULL,'N','FOTO2');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (2,4,NULL,'N','FOTO2');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (2,5,NULL,'N','FOTO2');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (2,6,NULL,'N','FOTO2');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (3,1,NULL,'N','FOTO3');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (3,2,'','N','FOTO3');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (3,3,NULL,'N','FOTO3');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (3,5,NULL,'N','FOTO3');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (3,6,NULL,'N','FOTO3');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (4,1,NULL,'N','FOTO4');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (5,1,NULL,'N','FOTO5');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (6,1,NULL,'N','FOTO6');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (7,1,NULL,'N','FOTO7');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (8,1,NULL,'N','FOTO8');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (9,1,NULL,'N','FOTO9');
INSERT INTO `tb_foto` (`COD_FOTO`,`COD_ANIMAL`,`URL`,`ID_FOTO_PRI`,`NOM_FOTO`) VALUES (10,1,NULL,'N','FOTO10');


INSERT INTO `tb_animal` (`COD_ANIMAL`,`COD_USUARIO`,`NOM_ANIMAL`,`DESC_ANIMAL`,`DESC_PERFIL`,`IND_SEXO`,`IDADE`,`COR`,`IND_PORTE`,`DT_CADASTRO`,`DT_ADOCAO`,`COD_ESPECIE`) VALUES (1,1,'DI CAPRIO','ZUIUDI DA MAMAE','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',1,2,'MARROM',0,'0000-00-00',NULL,1);
INSERT INTO `tb_animal` (`COD_ANIMAL`,`COD_USUARIO`,`NOM_ANIMAL`,`DESC_ANIMAL`,`DESC_PERFIL`,`IND_SEXO`,`IDADE`,`COR`,`IND_PORTE`,`DT_CADASTRO`,`DT_ADOCAO`,`COD_ESPECIE`) VALUES (2,1,'TOM CRUISE','SEU NOVO AMOR','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',1,1,'BRANCO',1,NULL,NULL,2);
INSERT INTO `tb_animal` (`COD_ANIMAL`,`COD_USUARIO`,`NOM_ANIMAL`,`DESC_ANIMAL`,`DESC_PERFIL`,`IND_SEXO`,`IDADE`,`COR`,`IND_PORTE`,`DT_CADASTRO`,`DT_ADOCAO`,`COD_ESPECIE`) VALUES (3,1,'BORIS','DE BOAS','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',1,3,'BRANCO',1,NULL,NULL,3);
INSERT INTO `tb_animal` (`COD_ANIMAL`,`COD_USUARIO`,`NOM_ANIMAL`,`DESC_ANIMAL`,`DESC_PERFIL`,`IND_SEXO`,`IDADE`,`COR`,`IND_PORTE`,`DT_CADASTRO`,`DT_ADOCAO`,`COD_ESPECIE`) VALUES (4,1,'TOTO','VIDA MANSA','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',2,2,'MARROM',0,NULL,NULL,4);
INSERT INTO `tb_animal` (`COD_ANIMAL`,`COD_USUARIO`,`NOM_ANIMAL`,`DESC_ANIMAL`,`DESC_PERFIL`,`IND_SEXO`,`IDADE`,`COR`,`IND_PORTE`,`DT_CADASTRO`,`DT_ADOCAO`,`COD_ESPECIE`) VALUES (5,1,'REX','OH LINDO','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',1,1,'BRANCO',2,NULL,NULL,5);
INSERT INTO `tb_animal` (`COD_ANIMAL`,`COD_USUARIO`,`NOM_ANIMAL`,`DESC_ANIMAL`,`DESC_PERFIL`,`IND_SEXO`,`IDADE`,`COR`,`IND_PORTE`,`DT_CADASTRO`,`DT_ADOCAO`,`COD_ESPECIE`) VALUES (6,1,'FRANK','SORRISO FACIL','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',1,3,'BRANCO',2,NULL,NULL,6);











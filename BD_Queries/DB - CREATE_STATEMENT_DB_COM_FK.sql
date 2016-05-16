-- MySQL dump 10.16  Distrib 10.1.10-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: adote
-- ------------------------------------------------------
-- Server version	10.1.10-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `adote`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `adote` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `adote`;


--
-- Table structure for table `tb_estado`
--

DROP TABLE IF EXISTS `tb_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_estado` (
  `COD_ESTADO` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_ESTADO` varchar(75) DEFAULT NULL,
  `SG_UF` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`COD_ESTADO`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tb_cidade`
--

DROP TABLE IF EXISTS `tb_cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_cidade` (
  `COD_CIDADE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_CIDADE` varchar(120) DEFAULT NULL,
  `COD_ESTADO` int(5) DEFAULT NULL,
  PRIMARY KEY (`COD_CIDADE`),
  KEY `FK_CIDADE_ESTADO` (`COD_ESTADO`),
  CONSTRAINT `tb_cidade_ibfk_1` FOREIGN KEY (`COD_ESTADO`) REFERENCES `tb_estado` (`COD_ESTADO`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5565 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tb_especie`
--

DROP TABLE IF EXISTS `tb_especie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_especie` (
  `COD_ESPECIE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_ESPECIE` varchar(100) NOT NULL,
  PRIMARY KEY (`COD_ESPECIE`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `tb_raca`
--

DROP TABLE IF EXISTS `tb_raca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_raca` (
  `COD_RACA` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_RACA` varchar(100) DEFAULT NULL,
  `COD_ESPECIE` int(11) DEFAULT NULL,
  PRIMARY KEY (`COD_RACA`),
  KEY `FK_TB_RACA_ESPECIE` (`COD_ESPECIE`),
  CONSTRAINT `FK_TB_RACA_ESPECIE` FOREIGN KEY (`COD_ESPECIE`) REFERENCES `tb_especie` (`COD_ESPECIE`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tb_usuario`
--

DROP TABLE IF EXISTS `tb_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_usuario` (
  `COD_USUARIO` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` char(50) DEFAULT NULL,
  `NOM_USUARIO` varchar(100) DEFAULT NULL,
  `TELEFONE` varchar(15) DEFAULT NULL,
  `PERFIL` varchar(100) DEFAULT NULL,
  `SENHA` varchar(30) NOT NULL,
  PRIMARY KEY (`COD_USUARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tb_animal`
--

DROP TABLE IF EXISTS `tb_animal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `COD_CIDADE` int(11) NOT NULL,
  PRIMARY KEY (`COD_ANIMAL`),
  KEY `IX_TB_ANIMAL_COD_ESPECIE` (`COD_ESPECIE`),
  KEY `IX_TB_ANIMAL_COD_USUARIO` (`COD_USUARIO`),
  KEY `IX_TB_ANIMAL_COD_CIDADE` (`COD_CIDADE`),
  CONSTRAINT `tb_animal_ibfk_1` FOREIGN KEY (`COD_ESPECIE`) REFERENCES `tb_especie` (`COD_ESPECIE`) ON UPDATE CASCADE,
  CONSTRAINT `tb_animal_ibfk_2` FOREIGN KEY (`COD_USUARIO`) REFERENCES `tb_usuario` (`COD_USUARIO`) ON UPDATE CASCADE,
  CONSTRAINT `tb_animal_ibfk_3` FOREIGN KEY (`COD_CIDADE`) REFERENCES `tb_cidade` (`COD_CIDADE`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tb_foto`
--

DROP TABLE IF EXISTS `tb_foto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_foto` (
  `COD_FOTO` int(11) NOT NULL AUTO_INCREMENT,
  `COD_ANIMAL` int(11) NOT NULL,
  `URL` varchar(200) DEFAULT NULL,
  `ID_FOTO_PRI` char(1) DEFAULT 'N',
  `NOM_FOTO` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`COD_FOTO`,`COD_ANIMAL`),
  KEY `COD_ANIMAL` (`COD_ANIMAL`),
  CONSTRAINT `tb_foto_ibfk_1` FOREIGN KEY (`COD_ANIMAL`) REFERENCES `tb_animal` (`COD_ANIMAL`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;



--
-- Table structure for table `tb_adocao`
--

DROP TABLE IF EXISTS `tb_adocao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_adocao` (
  `COD_ADOCAO` int(11) NOT NULL AUTO_INCREMENT,
  `COD_USUARIO` int(11) NOT NULL,
  `DT_ADOCAO` datetime NOT NULL,
  `COD_ANIMAL_ADT` int(11) NOT NULL,
  PRIMARY KEY (`COD_ADOCAO`),
  UNIQUE KEY `IX_COD_ANIMAL_ADOCAO` (`COD_ANIMAL_ADT`,`COD_USUARIO`),
  CONSTRAINT `tb_adocao_ibfk_1` FOREIGN KEY (`COD_ANIMAL_ADT`) REFERENCES `tb_animal` (`COD_ANIMAL`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-15 14:48:18

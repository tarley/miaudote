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
  PRIMARY KEY (`COD_ADOCAO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_adocao`
--

LOCK TABLES `tb_adocao` WRITE;
/*!40000 ALTER TABLE `tb_adocao` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_adocao` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`COD_ANIMAL`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_animal`
--

LOCK TABLES `tb_animal` WRITE;
/*!40000 ALTER TABLE `tb_animal` DISABLE KEYS */;
INSERT INTO `tb_animal` VALUES (1,1,'DI CAPRIO','ZUIUDI DA MAMAE','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',1,2,'MARROM',0,'0000-00-00',NULL,1),(2,1,'TOM CRUISE','SEU NOVO AMOR','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',1,1,'BRANCO',1,NULL,NULL,2),(3,1,'BORIS','DE BOAS','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',1,3,'BRANCO',1,NULL,NULL,3),(4,1,'TOTO','VIDA MANSA','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',2,2,'MARROM',0,NULL,NULL,4),(5,1,'REX','OH LINDO','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',1,1,'BRANCO',2,NULL,NULL,5),(6,1,'FRANK','SORRISO FACIL','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',1,3,'BRANCO',2,NULL,NULL,6);
/*!40000 ALTER TABLE `tb_animal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_cidade`
--

DROP TABLE IF EXISTS `tb_cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_cidade` (
  `COD_CIDADE` int(11) NOT NULL AUTO_INCREMENT,
  `CIDADE` varchar(255) NOT NULL,
  PRIMARY KEY (`COD_CIDADE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_cidade`
--

LOCK TABLES `tb_cidade` WRITE;
/*!40000 ALTER TABLE `tb_cidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_cidade` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_especie`
--

LOCK TABLES `tb_especie` WRITE;
/*!40000 ALTER TABLE `tb_especie` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_especie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_estado`
--

DROP TABLE IF EXISTS `tb_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_estado` (
  `COD_ESTADO` int(11) NOT NULL AUTO_INCREMENT,
  `ESTADO` char(2) NOT NULL,
  PRIMARY KEY (`COD_ESTADO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_estado`
--

LOCK TABLES `tb_estado` WRITE;
/*!40000 ALTER TABLE `tb_estado` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_estado` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`COD_FOTO`,`COD_ANIMAL`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_foto`
--

LOCK TABLES `tb_foto` WRITE;
/*!40000 ALTER TABLE `tb_foto` DISABLE KEYS */;
INSERT INTO `tb_foto` VALUES (1,1,NULL,'S','FOTO1'),(1,2,NULL,'S','FOTO1'),(1,3,NULL,'S','FOTO1'),(1,4,NULL,'S','FOTO1'),(1,5,NULL,'S','FOTO1'),(1,6,NULL,'S','FOTO1'),(2,1,NULL,'N','FOTO2'),(2,2,NULL,'N','FOTO2'),(2,3,NULL,'N','FOTO2'),(2,4,NULL,'N','FOTO2'),(2,5,NULL,'N','FOTO2'),(2,6,NULL,'N','FOTO2'),(3,1,NULL,'N','FOTO3'),(3,2,'','N','FOTO3'),(3,3,NULL,'N','FOTO3'),(3,5,NULL,'N','FOTO3'),(3,6,NULL,'N','FOTO3'),(4,1,NULL,'N','FOTO4'),(5,1,NULL,'N','FOTO5'),(6,1,NULL,'N','FOTO6'),(7,1,NULL,'N','FOTO7'),(8,1,NULL,'N','FOTO8'),(9,1,NULL,'N','FOTO9'),(10,1,NULL,'N','FOTO10');
/*!40000 ALTER TABLE `tb_foto` ENABLE KEYS */;
UNLOCK TABLES;

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
  `PERFIL` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`COD_USUARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_usuario`
--

LOCK TABLES `tb_usuario` WRITE;
/*!40000 ALTER TABLE `tb_usuario` DISABLE KEYS */;
INSERT INTO `tb_usuario` VALUES (1,'ong@email.com','ONG','31','Uma ong que ama os animais'),(2,'ong@ong,com','CAO CARINHO','32','Especializada em tratamento de animais');
/*!40000 ALTER TABLE `tb_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-03 21:50:48

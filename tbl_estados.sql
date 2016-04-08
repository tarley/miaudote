/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : sis_recantodopoeta

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2016-04-08 11:20:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_estados
-- ----------------------------
DROP TABLE IF EXISTS `tbl_estados`;
CREATE TABLE `tbl_estados` (
  `id` int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `uf` varchar(10) NOT NULL DEFAULT '',
  `nome` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_estados
-- ----------------------------
INSERT INTO `tbl_estados` VALUES ('01', 'AC', 'Acre');
INSERT INTO `tbl_estados` VALUES ('02', 'AL', 'Alagoas');
INSERT INTO `tbl_estados` VALUES ('03', 'AM', 'Amazonas');
INSERT INTO `tbl_estados` VALUES ('04', 'AP', 'Amapá');
INSERT INTO `tbl_estados` VALUES ('05', 'BA', 'Bahia');
INSERT INTO `tbl_estados` VALUES ('06', 'CE', 'Ceará');
INSERT INTO `tbl_estados` VALUES ('07', 'DF', 'Distrito Federal');
INSERT INTO `tbl_estados` VALUES ('08', 'ES', 'Espírito Santo');
INSERT INTO `tbl_estados` VALUES ('09', 'GO', 'Goiás');
INSERT INTO `tbl_estados` VALUES ('10', 'MA', 'Maranhão');
INSERT INTO `tbl_estados` VALUES ('11', 'MG', 'Minas Gerais');
INSERT INTO `tbl_estados` VALUES ('12', 'MS', 'Mato Grosso do Sul');
INSERT INTO `tbl_estados` VALUES ('13', 'MT', 'Mato Grosso');
INSERT INTO `tbl_estados` VALUES ('14', 'PA', 'Pará');
INSERT INTO `tbl_estados` VALUES ('15', 'PB', 'Paraíba');
INSERT INTO `tbl_estados` VALUES ('16', 'PE', 'Pernambuco');
INSERT INTO `tbl_estados` VALUES ('17', 'PI', 'Piauí');
INSERT INTO `tbl_estados` VALUES ('18', 'PR', 'Paraná');
INSERT INTO `tbl_estados` VALUES ('19', 'RJ', 'Rio de Janeiro');
INSERT INTO `tbl_estados` VALUES ('20', 'RN', 'Rio Grande do Norte');
INSERT INTO `tbl_estados` VALUES ('21', 'RO', 'Rondônia');
INSERT INTO `tbl_estados` VALUES ('22', 'RR', 'Roraima');
INSERT INTO `tbl_estados` VALUES ('23', 'RS', 'Rio Grande do Sul');
INSERT INTO `tbl_estados` VALUES ('24', 'SC', 'Santa Catarina');
INSERT INTO `tbl_estados` VALUES ('25', 'SE', 'Sergipe');
INSERT INTO `tbl_estados` VALUES ('26', 'SP', 'São Paulo');
INSERT INTO `tbl_estados` VALUES ('27', 'TO', 'Tocantins');

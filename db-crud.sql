/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100130
 Source Host           : localhost:3306
 Source Schema         : sincloud-crud

 Target Server Type    : MySQL
 Target Server Version : 100130
 File Encoding         : 65001

 Date: 26/01/2018 02:55:08
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for enderecos
-- ----------------------------
DROP TABLE IF EXISTS `enderecos`;
CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(255) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `localidade` varchar(255) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of enderecos
-- ----------------------------
BEGIN;
INSERT INTO `enderecos` VALUES (1, 'Rua Messias', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (2, 'Rua Messias', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (3, 'Rua Messias', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (4, 'Rua Messias', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (5, 'Rua Messias', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (6, 'Avenida Acapulco', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585050');
INSERT INTO `enderecos` VALUES (7, 'Rua Messias', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (8, 'Rua Messias', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (9, 'Rua Messias', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (10, 'Rua Messias', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (11, 'Rua Messias', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (12, 'Rua Messias', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (13, 'Rua Messias', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (14, 'Rua Messias', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (15, 'Rua Messias', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (16, 'Rua Messias', 'teste complemento', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (17, 'Rua Messias', 'teste complemento', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (18, 'Rua Messias', 'teste complemento', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (19, 'Rua Messias', 'teste complemento', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (20, 'Rua Messias', 'teste complemento', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (21, 'Rua Messias', 'teste complemento', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (22, 'Rua Messias', 'teste complemento', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (23, 'Rua Messias', 'teste complemento', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (24, 'Rua Messias', 'teste complemento', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (25, 'Rua Messias', 'teste complemento', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (26, 'Rua Messias', 'teste complemento', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (27, 'Rua Messias', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (28, '', '', '', '', '', '');
INSERT INTO `enderecos` VALUES (29, 'Rua Messias', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (30, 'Rua Messias', 'frente', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
INSERT INTO `enderecos` VALUES (31, 'Rua Messias', '', 'Paciencia', 'Rio de Janeiro', 'RJ', '23585056');
COMMIT;

-- ----------------------------
-- Table structure for formacao_academicas
-- ----------------------------
DROP TABLE IF EXISTS `formacao_academicas`;
CREATE TABLE `formacao_academicas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of formacao_academicas
-- ----------------------------
BEGIN;
INSERT INTO `formacao_academicas` VALUES (1, 'Tecnologia da Informacao');
INSERT INTO `formacao_academicas` VALUES (2, 'Administracao');
INSERT INTO `formacao_academicas` VALUES (3, 'Agronomia');
INSERT INTO `formacao_academicas` VALUES (4, 'Agropecuaria');
INSERT INTO `formacao_academicas` VALUES (5, 'Telecomunicacao');
COMMIT;

-- ----------------------------
-- Table structure for pessoas
-- ----------------------------
DROP TABLE IF EXISTS `pessoas`;
CREATE TABLE `pessoas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `endereco_id` int(11) DEFAULT NULL,
  `idade` int(11) DEFAULT NULL,
  `telefone` int(11) DEFAULT NULL,
  `formacao_academica_id` int(11) DEFAULT NULL,
  `pretensao_salarial` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pessoas
-- ----------------------------
BEGIN;
INSERT INTO `pessoas` VALUES (1, 'Marcos Remar', 27, 6545664, 4000, 1, 30);
INSERT INTO `pessoas` VALUES (2, 'Rui Barbosa', 1, 19, NULL, 1, NULL);
INSERT INTO `pessoas` VALUES (46, 'Maria Paula', 2, 18, NULL, 1, NULL);
INSERT INTO `pessoas` VALUES (47, 'Clarice Lispector', 2, 30, NULL, 2, NULL);
INSERT INTO `pessoas` VALUES (48, 'Machado de Assis', 1, 28, NULL, 2, NULL);
INSERT INTO `pessoas` VALUES (49, 'Monteiro Lobato', 1, 38, NULL, 3, NULL);
INSERT INTO `pessoas` VALUES (51, 'novo teste com mvc', 2, 27, NULL, 3, NULL);
INSERT INTO `pessoas` VALUES (100, '12', NULL, 43, 4500, 4, 25);
INSERT INTO `pessoas` VALUES (101, '12', NULL, 18, 4500, 5, 26);

COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

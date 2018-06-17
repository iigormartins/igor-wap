
CREATE DATABASE `mundowap`;

USE `mundowap`;
-- ----------------------------
-- Table structure for tab01001
-- ----------------------------
DROP TABLE IF EXISTS `tab01001`;
CREATE TABLE `tab01001`  (
  `T1001_Cod_Usuario` int(6) NOT NULL,
  `T1001_Email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `T1001_Usuario` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `T1001_Senha` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `T1001_Nome_Usuario` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`T1001_Cod_Usuario`, `T1001_Email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tab01001
-- ----------------------------
INSERT INTO `tab01001` VALUES (1, 'admin@email.com', 'DWEB', '12345', 'Desenvolvimento WEB');

-- ----------------------------
-- Table structure for tab01002
-- ----------------------------
DROP TABLE IF EXISTS `tab01002`;
CREATE TABLE `tab01002`  (
  `T1002_Ean` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `T1002_Nome_Produto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `T1002_Preco` decimal(10, 2) NOT NULL,
  `T1002_Estoque` int(6) NOT NULL,
  `T1002_Data_Fabricacao` date NULL DEFAULT NULL,
  PRIMARY KEY (`T1002_Ean`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tab01002
-- ----------------------------
INSERT INTO `tab01002` VALUES ('124935', 'ARROZ', 10.15, 200, '1970-01-01');
INSERT INTO `tab01002` VALUES ('157846', 'MARGARINA', 4.50, 500, '2018-04-15');
INSERT INTO `tab01002` VALUES ('250860', 'REQUEIJÃƒO', 7.20, 75, '2018-01-14');
INSERT INTO `tab01002` VALUES ('300058', 'FEIJÃƒO', 8.00, 350, '1970-01-01');
INSERT INTO `tab01002` VALUES ('749635', 'LEITE UHT', 2.45, 1000, '2017-12-20');
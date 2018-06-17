
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


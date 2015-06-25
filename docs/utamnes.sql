/*
Navicat MySQL Data Transfer

Source Server         : MySqlConneccion
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : utamnes

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2015-06-21 21:04:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `Concepto`
-- ----------------------------
DROP TABLE IF EXISTS `Concepto`;
CREATE TABLE `Concepto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `numero` int(11) NOT NULL,
  `descripcion` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_corta` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `obligatorio` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `formula` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9DF5EA86F55AE19E` (`numero`),
  KEY `IDX_9DF5EA86DB38439E` (`usuario_id`),
  CONSTRAINT `FK_9DF5EA86DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `fos_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of concepto
-- ----------------------------
INSERT INTO `Concepto` VALUES ('1', null, '401', 'Cuota Gremial', 'Cuota Grem.', '1', '1', '[TR] * 0.12', '2015-06-17 16:15:38', '2015-06-17 16:15:38');
INSERT INTO `Concepto` VALUES ('2', null, '412', 'Seguro Funerario', 'Seg. Fun.', '1', '1', '([TR]+[IMP1]) * 0.20', '2015-06-17 16:15:38', '2015-06-17 16:15:38');

-- ----------------------------
-- Table structure for `Ctacte`
-- ----------------------------
DROP TABLE IF EXISTS `Ctacte`;
CREATE TABLE `Ctacte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empleador_id` int(11) DEFAULT NULL,
  `periodo_id` int(11) DEFAULT NULL,
  `concepto_id` int(11) DEFAULT NULL,
  `rectificado_id` int(11) DEFAULT NULL,
  `importe` decimal(10,0) NOT NULL,
  `pago` decimal(10,0) NOT NULL,
  `comprobante` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaPago` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8BDC53547981C10B` (`empleador_id`),
  KEY `IDX_8BDC53549C3921AB` (`periodo_id`),
  KEY `IDX_8BDC53546C2330BD` (`concepto_id`),
  KEY `IDX_8BDC5354FA7F3492` (`rectificado_id`),
  CONSTRAINT `FK_8BDC53546C2330BD` FOREIGN KEY (`concepto_id`) REFERENCES `Concepto` (`id`),
  CONSTRAINT `FK_8BDC53547981C10B` FOREIGN KEY (`empleador_id`) REFERENCES `Empleador` (`id`),
  CONSTRAINT `FK_8BDC53549C3921AB` FOREIGN KEY (`periodo_id`) REFERENCES `Periodo` (`id`),
  CONSTRAINT `FK_8BDC5354FA7F3492` FOREIGN KEY (`rectificado_id`) REFERENCES `Periodo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ctacte
-- ----------------------------
INSERT INTO `Ctacte` VALUES ('7', '101', '1', '1', null, '3300', '0', null, null);
INSERT INTO `Ctacte` VALUES ('8', '101', '1', '2', null, '5580', '0', null, null);
INSERT INTO `Ctacte` VALUES ('9', '101', '2', '1', null, '2160', '0', null, null);
INSERT INTO `Ctacte` VALUES ('10', '101', '2', '2', null, '3600', '0', null, null);

-- ----------------------------
-- Table structure for `Datoliquidacion`
-- ----------------------------
DROP TABLE IF EXISTS `Datoliquidacion`;
CREATE TABLE `Datoliquidacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo_id` int(11) DEFAULT NULL,
  `trabajador_id` int(11) DEFAULT NULL,
  `tr` decimal(10,0) NOT NULL,
  `imp1` decimal(10,0) NOT NULL,
  `imp2` decimal(10,0) NOT NULL,
  `imp3` decimal(10,0) NOT NULL,
  `imp4` decimal(10,0) NOT NULL,
  `imp5` decimal(10,0) NOT NULL,
  `imp6` decimal(10,0) NOT NULL,
  `imp7` decimal(10,0) NOT NULL,
  `imp8` decimal(10,0) NOT NULL,
  `imp9` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5B26F3CF9C3921AB` (`periodo_id`),
  KEY `IDX_5B26F3CFEC3656E` (`trabajador_id`),
  CONSTRAINT `FK_5B26F3CF9C3921AB` FOREIGN KEY (`periodo_id`) REFERENCES `Periodo` (`id`),
  CONSTRAINT `FK_5B26F3CFEC3656E` FOREIGN KEY (`trabajador_id`) REFERENCES `Trabajador` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of datoliquidacion
-- ----------------------------
INSERT INTO `Datoliquidacion` VALUES ('1', '1', '1', '14500', '200', '0', '500', '0', '0', '0', '0', '0', '0');
INSERT INTO `Datoliquidacion` VALUES ('2', '1', '2', '13000', '200', '0', '500', '0', '0', '0', '0', '0', '0');
INSERT INTO `Datoliquidacion` VALUES ('5', null, null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `Datoliquidacion` VALUES ('6', '2', '1', '8500', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `Datoliquidacion` VALUES ('7', '2', '2', '9500', '0', '0', '0', '0', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `Empleador`
-- ----------------------------
DROP TABLE IF EXISTS `Empleador`;
CREATE TABLE `Empleador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `usuario_actualizador_id` int(11) DEFAULT NULL,
  `razon` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `cuit` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `localidad` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6B449459521E1991` (`empresa_id`),
  KEY `IDX_6B449459DB38439E` (`usuario_id`),
  KEY `IDX_6B449459959B7DBC` (`usuario_actualizador_id`),
  CONSTRAINT `FK_6B449459521E1991` FOREIGN KEY (`empresa_id`) REFERENCES `Empresa` (`id`),
  CONSTRAINT `FK_6B449459959B7DBC` FOREIGN KEY (`usuario_actualizador_id`) REFERENCES `fos_user` (`id`),
  CONSTRAINT `FK_6B449459DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `fos_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of empleador
-- ----------------------------
INSERT INTO `Empleador` VALUES ('1', null, null, null, 'Acosta y Puga', '93255736', 'Zúñiga  91 18 A\nFabiana del Este, AR-V 8463', '(31)6327-3512', 'justus87@runolfsson.org', 'Puerto Isidora', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('2', null, null, null, 'Jaime y Mojica', '86486143', 'Mario  68230 Hab. 692\nSamantha del Mirador, AR-S 16783', '(2730)1544-9977', 'carter.stephanie@jast.com', 'Don Juana', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('3', null, null, null, 'Dueñas de Delao', '68094319', 'Hugo  24460\nFlorencia del Oeste, AR-J 44613', '(2221)42-4548', 'lockman.annabell@hotmail.com', 'San Ana Paula', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('4', null, null, null, 'Martínez e Hijo', '8362300', 'Daniela  584 Hab. 565\nGral. Violeta, AR-Q 30353', '(89)154315-0103', 'marta.kulas@yahoo.com', 'Maximiliano del Sur', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('5', null, null, null, 'Pacheco, Solorzano y Manzanares', '79240357', 'Ballesteros  865 1 D\nSan Mariangel del Sur, AR-S 9275', '(347)15476-5859', 'nienow.sarai@hotmail.com', 'Gral. Nicole', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('6', null, null, null, 'Figueroa de Chávez', '26992789', 'Montañez  0 49 B\nSan Miguel Ángel, AR-K 4499', '(41)155611-8475', 'odell.ruecker@bradtke.com', 'Ximena del Norte', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('7', null, null, null, 'Briones-Palomo', '57863393', 'Delarosa  085\nNúñez del Este, AR-T 07605', '(3058)40-8317', 'weber.katherine@gmail.com', 'Nahuel del Oeste', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('8', null, null, null, 'Vallejo y Cepeda', '24978519', 'Valdivia  47\nSan Mariangel del Mar, AR-G 48469', '(102)15513-5232', 'deion.king@barton.com', 'Maximiliano del Norte', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('9', null, null, null, 'Mora y Flia.', '96959574', 'Ariana  23 18 C\nIgnacio del Mirador, AR-W 4278', '(575)515-8289', 'breanne12@bernhard.com', 'Toro del Norte', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('10', null, null, null, 'Nevárez-Posada', '3599943', 'Batista  03\nVilla Daniel, AR-K 84530', '(842)15589-9208', 'jerde.alba@hotmail.com', 'Coronado del Oeste', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('11', null, null, null, 'Lucero de Carrion', '37552643', 'Matías  9354 Depto. 508\nGral. Juan Diego del Sur, AR-P 0137', '(4179)1543-4668', 'judd78@hotmail.com', 'Estévez del Este', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('12', null, null, null, 'Beltrán de Vallejo', '76424161', 'Camila  1622\nFrías del Norte, AR-G 85246', '(9310)41-2928', 'rosalee92@yahoo.com', 'Valeria del Oeste', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('13', null, null, null, 'Marroquín-Cepeda', '73681146', 'Adrián  26\nGral. Horacio, AR-V 43785', '(08)4182-9515', 'gillian.greenholt@yahoo.com', 'Puerto Josefa del Sur', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('14', null, null, null, 'Sáenz, Valdés y Gálvez', '60744449', 'María Camila  13507\nVilla Sara Sofía, AR-N 9613', '(33)4418-5220', 'shyann67@yahoo.com', 'Don Juana del Este', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('15', null, null, null, 'Vargas de Ontiveros', '41566535', 'Bravo  0 4 D\nGral. Ignacio, AR-J 4902', '(5991)1541-0308', 'kbechtelar@gmail.com', 'Nahuel del Mirador', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('16', null, null, null, 'Rico-Toledo', '18062682', 'Miguel Ángel  94 97 8\nMaría Paula del Este, AR-K 9943', '(01)4799-0696', 'alfonso92@yahoo.com', 'Don Juan José del Este', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('17', null, null, null, 'Figueroa de Delacrúz', '30365677', 'Valladares  75508\nGral. Samuel del Mirador, AR-A 67078', '(554)461-9999', 'gust.wunsch@yahoo.com', 'Puerto Irene', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('18', null, null, null, 'Herrera y Cadena', '3071577', 'Delfina  3\nGral. Ana Paula del Mirador, AR-H 3408', '(270)520-8265', 'rupert54@yahoo.com', 'Carrillo del Norte', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('19', null, null, null, 'Armenta y Cortez', '95999950', 'Villegas  46570 34 E\nDon Martina, AR-J 7594', '(0444)1551-7941', 'betsy.swift@walker.biz', 'Villa Christian', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('20', null, null, null, 'Leiva y Ayala', '34517204', 'Carlos  91630 9 F\nJuan del Mar, AR-P 99646', '(58)154083-6554', 'nola.abbott@cruickshank.com', 'Simón del Mirador', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('21', null, null, null, 'Robledo-Mireles', '36747120', 'Quintero  71\nParra del Norte, AR-Y 0285', '(238)15456-1874', 'vanessa73@yahoo.com', 'Sara Sofía del Norte', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('22', null, null, null, 'Gómez-Beltrán', '83321502', 'Samuel  0476 14 B\nDon Julia, AR-U 05673', '+15(0)9898933416', 'igulgowski@kunze.com', 'Díaz del Sur', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('23', null, null, null, 'Lucio, Corona y Baeza', '32241754', 'Corona  30288\nVicente del Mirador, AR-T 6351', '(69)4777-3779', 'violet.howe@lesch.com', 'Mena del Sur', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('24', null, null, null, 'Angulo de Munguía', '54636447', 'Prieto  745\nAlcaraz del Sur, AR-H 13411', '(44)4020-0395', 'raul.bogisich@gmail.com', 'Esquibel del Oeste', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('25', null, null, null, 'Alcaraz y Ibarra', '27584589', 'Luana  5\nOrdóñez del Sur, AR-J 27758', '+96(5)1948505546', 'schiller.ernesto@turner.com', 'Dylan del Mirador', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('26', null, null, null, 'Olivo y Flia.', '21952408', 'Zoe  8\nJosé del Norte, AR-D 00132', '(567)515-0220', 'lonie67@gmail.com', 'Villa Alan del Sur', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('27', null, null, null, 'Cedillo e Hijo', '16110784', 'Fernando  76173 5 C\nJorge del Mar, AR-K 93966', '(11)4334-1924', 'schamberger.dixie@mohr.biz', 'Carla del Oeste', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('28', null, null, null, 'Guzmán-Marín', '58090896', 'Samantha  52 3 A\nPérez del Mar, AR-N 6881', '(3524)1552-4989', 'mertie.donnelly@yahoo.com', 'Tijerina del Mirador', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('29', null, null, null, 'Huerta SA', '62446153', 'Emma  3651 2 D\nDon Elías, AR-M 73426', '(91)155254-0997', 'ondricka.sean@hotmail.com', 'Gral. Sebastián', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('30', null, null, null, 'Barrera-Valles', '81983057', 'León  95266 Depto. 914\nPantoja del Mirador, AR-G 68402', '(026)558-3112', 'norma.will@lesch.info', 'Bermúdez del Norte', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('31', null, null, null, 'Quintana, Almaraz y Henríquez', '34989570', 'Córdova  55264\nBaca del Este, AR-N 98808', '(08)4712-7532', 'waters.rosa@gmail.com', 'Puerto Aarón', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('32', null, null, null, 'Gamez de Angulo', '82022400', 'Trujillo  1\nChristian del Mar, AR-M 5687', '(34)155279-0940', 'brakus.antwon@hotmail.com', 'Espino del Mirador', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('33', null, null, null, 'Saucedo e Hijo', '39447496', 'Bañuelos  500 06 E\nDon Daniela del Este, AR-Z 15828', '(2452)1544-7907', 'emmerich.lois@sanford.com', 'Mateo del Este', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('34', null, null, null, 'Meraz-Vela', '9357709', 'Samuel  26244\nVioleta del Mirador, AR-P 5340', '(3202)1545-9502', 'mike.larkin@yahoo.com', 'San Clara del Mirador', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('35', null, null, null, 'Reyna-Saldivar', '46862834', 'Muro  8835 Depto. 835\nReséndez del Oeste, AR-V 19741', '(90)6126-5244', 'agleason@koepp.com', 'Solorzano del Sur', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('36', null, null, null, 'Cervantes y Pelayo', '57795895', 'Oquendo  597 8 E\nSan Bautista, AR-L 68680', '+21(4)9928106742', 'pink.romaguera@yahoo.com', 'San Micaela del Sur', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('37', null, null, null, 'Fierro de Menchaca', '32373935', 'Juan Diego  93\nDaniela del Este, AR-J 99544', '+24(9)8696632896', 'helmer.lebsack@welch.com', 'Josefina del Mirador', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('38', null, null, null, 'Alejandro e Hijo', '21913163', 'Saucedo  782\nSan María Alejandra, AR-B 27130', '(32)154886-4151', 'upton.kaycee@macejkovic.com', 'Robles del Norte', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('39', null, null, null, 'Gómez-Valadez', '59716468', 'Vicente  510 3 D\nDon Carla, AR-T 39171', '(262)15472-6221', 'jon.weber@pfannerstill.org', 'Villagómez del Sur', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('40', null, null, null, 'Marrero-Balderas', '80771554', 'Fuentes  67486\nPuerto Sara Sofía del Mirador, AR-D 4935', '(2769)1555-4919', 'tyrese91@yahoo.com', 'Gral. Bruno', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('41', null, null, null, 'Valladares-Villarreal', '50283377', 'Ochoa  93 Depto. 284\nSan Olivia, AR-W 3422', '(0114)1541-5918', 'cwiza@orn.biz', 'Gabriel del Mar', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('42', null, null, null, 'Adorno-Laureano', '52275460', 'Salinas  2738 Depto. 129\nDylan del Este, AR-J 77767', '(9025)46-1545', 'kjohnston@gmail.com', 'Lerma del Este', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('43', null, null, null, 'Gaytán-Dueñas', '53694688', 'Ramón  344\nVilla Sofía del Mirador, AR-N 76115', '(12)5318-1774', 'srippin@gmail.com', 'Peña del Este', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('44', null, null, null, 'Alcala, Bueno y Espinosa', '86607115', 'Guerrero  384 86 B\nEspinal del Mar, AR-H 5792', '(742)524-6123', 'kiehn.joelle@wolf.com', 'Soto del Mirador', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('45', null, null, null, 'Trejo, Longoria y Osorio', '14682583', 'Villaseñor  2 58 A\nVilla Violeta del Mirador, AR-J 8655', '(2470)1546-9696', 'jaiden84@reichel.com', 'Mena del Mar', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('46', null, null, null, 'Menchaca, Pérez y Soto', '25238569', 'Emmanuel  96\nRafael del Norte, AR-Z 9232', '232-551-8019', 'ywolf@crona.com', 'Vicente del Norte', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('47', null, null, null, 'Collazo, Angulo y Cardona', '53476241', 'Juan Esteban  341\nPuerto Simón del Este, AR-G 17409', '(44)154706-8952', 'lucious08@stokes.com', 'Díaz del Mar', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('48', null, null, null, 'Morales, Chávez y Tirado', '6959143', 'Valentino  57\nVilla Juan Martín del Oeste, AR-V 0290', '(902)15564-2914', 'schneider.melvina@hessel.com', 'Juan Martín del Oeste', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('49', null, null, null, 'Pelayo-Henríquez', '53217266', 'Muro  69 0 D\nGral. Felipe, AR-U 1613', '(1797)49-4299', 'alberto.reichert@leuschke.com', 'Villa Violeta del Oeste', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('50', null, null, null, 'Delvalle S. de H.', '71439182', 'Roybal  58150\nSan Agustina, AR-J 52484', '+51(9)8703341938', 'ahane@prohaska.com', 'San Samantha del Oeste', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('51', null, null, null, 'Negrón SRL', '28536454', 'Rafaela  71835\nJosefa del Oeste, AR-G 91290', '(485)15486-6890', 'leuschke.okey@wyman.com', 'Alexa del Mar', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('52', null, null, null, 'Delarosa y Fernández', '25722384', 'Medina  35\nPuerto Juana del Sur, AR-Q 6483', '(73)154040-1166', 'caesar91@hotmail.com', 'Puerto Valentina del Sur', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('53', null, null, null, 'Aranda y Asoc.', '72863169', 'Jorge  45264\nMaría del Norte, AR-Y 1436', '(241)587-3383', 'cathy.ortiz@hotmail.com', 'Olivia del Este', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('54', null, null, null, 'Concepción y Suárez', '68181726', 'Diego Alejandro  7617 0 E\nMuñoz del Este, AR-K 27618', '(49)154394-5993', 'judah.kuhn@yahoo.com', 'Don Ignacio del Mar', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('55', null, null, null, 'Arriaga y Peña', '75808568', 'Sarabia  979\nAgustín del Norte, AR-Q 53312', '+66(2)2591093687', 'mclaughlin.rhiannon@hotmail.com', 'Victoria del Este', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('56', null, null, null, 'Valle y Mena', '26131495', 'Barela  82167 4 9\nRosario del Norte, AR-X 68958', '(18)4020-3616', 'waelchi.maybell@blick.com', 'Manuela del Norte', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('57', null, null, null, 'Casanova, Roybal y Olivárez', '78070178', 'Silvana   0926 91 F\nDon Alejandro del Oeste, AR-B 2773', '(3369)47-3232', 'tierra50@yahoo.com', 'Varela del Mar', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('58', null, null, null, 'Reyes y Gurule', '49915263', 'Diego Alejandro  97725\nGral. Francisco, AR-Y 78972', '(330)425-2238', 'betty84@hotmail.com', 'Montalvo del Sur', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('59', null, null, null, 'Rodríguez SA', '99498145', 'Romero  017\nLoya del Mar, AR-X 9351', '(378)15594-2325', 'cziemann@gmail.com', 'Jazmín del Norte', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('60', null, null, null, 'Ortiz y Bonilla', '8325939', 'Natalia  3\nLuis del Norte, AR-D 00806', '(1645)49-6849', 'hansen.llewellyn@yahoo.com', 'Ricardo del Este', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('61', null, null, null, 'Ocasio y Negrón', '28132827', 'Clara  6451 Piso 83\nDon Luciano del Mar, AR-G 07535', '(68)155991-4922', 'carolina95@yahoo.com', 'Don Constanza', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('62', null, null, null, 'Salas S. de H.', '58415688', 'Niño  149\nVilla Santino, AR-H 4950', '(78)6049-3780', 'xkuhic@hotmail.com', 'San María Fernanda', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('63', null, null, null, 'Jáquez y Salinas', '10671944', 'Cristóbal  8\nJerónimo del Sur, AR-X 1288', '(43)154676-4428', 'abshire.buster@tromp.biz', 'Villa Gabriel', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('64', null, null, null, 'Márquez SRL', '42557952', 'Elena   5\nGral. Alan, AR-W 14456', '+40(6)4419394938', 'jaden71@hotmail.com', 'Puerto Gabriela', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('65', null, null, null, 'Rojo SA', '41950163', 'Carmona  668\nBueno del Norte, AR-L 09958', '(4743)1545-2948', 'upaucek@hotmail.com', 'Núñez del Mar', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('66', null, null, null, 'Palomo y Asoc.', '61431499', 'Centeno  30\nUreña del Sur, AR-N 36953', '(64)154465-6041', 'hadley.durgan@koepp.com', 'Elías del Sur', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('67', null, null, null, 'Ibarra y Alfaro', '95225841', 'Cadena  74\nGral. Maite del Oeste, AR-B 6026', '(28)4312-6830', 'armstrong.emile@gmail.com', 'Don Magdalena', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('68', null, null, null, 'Ávila, Ramos y Saucedo', '79829820', 'Montenegro  01352\nVerduzco del Mirador, AR-D 0002', '(682)497-7459', 'kadams@hotmail.com', 'Alex del Norte', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('69', null, null, null, 'Muñoz e Hijo', '98425774', 'Alessandra  3068 6 E\nJuan Martín del Oeste, AR-E 4322', '(5549)1548-5477', 'othompson@yahoo.com', 'San Alex del Oeste', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('70', null, null, null, 'Mesa, Guevara y Sanabria', '75270546', 'Mía  8\nAnthony del Sur, AR-R 7494', '(94)5782-4012', 'cloyd22@rippin.com', 'Zapata del Mar', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('71', null, null, null, 'Polanco y Jaimes', '10138911', 'Montserrat  0569\nGracia del Este, AR-L 26291', '(500)15520-1642', 'muhammad.mann@boyle.com', 'San Santiago del Este', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('72', null, null, null, 'Guevara de Bonilla', '17481966', 'Carlos  1470 Piso 11\nGral. Felipe del Sur, AR-V 45318', '(3166)1542-8393', 'koch.briana@gmail.com', 'Puerto Juan Esteban del Este', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('73', null, null, null, 'Rael-Rolón', '94281140', 'Madrid  5\nGabriela del Norte, AR-L 8200', '(18)4245-6092', 'brooklyn41@gmail.com', 'Villa Aarón del Este', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('74', null, null, null, 'Espinoza de Arias', '71247269', 'Melgar  53567\nSan Josué, AR-V 97049', '784-041-2800', 'uschneider@gmail.com', 'Cabán del Mirador', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('75', null, null, null, 'Negrón y Flia.', '15023623', 'Serna  48601\nJulián del Este, AR-D 0360', '(831)433-8770', 'emilio43@gmail.com', 'Maestas del Norte', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('76', null, null, null, 'Calvillo y Montes', '62038133', 'Emiliano  0 2 F\nPuerto Nadia del Norte, AR-H 6940', '(883)15513-7376', 'lstehr@blanda.com', 'Joshua del Oeste', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('77', null, null, null, 'Ponce SA', '86990764', 'Posada  08851\nElizabeth del Mar, AR-P 86647', '(40)4849-2300', 'hoppe.rhea@hotmail.com', 'Cano del Oeste', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('78', null, null, null, 'Mendoza y Valles', '8713917', 'Orozco  769 27 D\nVilla Sara Sofía, AR-R 52368', '(7710)1550-8721', 'angie90@yahoo.com', 'Don Bruno', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('79', null, null, null, 'Quintana, Mota y Delafuente', '51507203', 'Bonilla  3 8 B\nDon Luciano del Mar, AR-D 38642', '(175)15514-6371', 'loren84@hotmail.com', 'Don Nicole del Mirador', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('80', null, null, null, 'Espinal e Hijo', '88738897', 'Pelayo  35484 Depto. 141\nPuerto Silvana  del Este, AR-J 07420', '(002)481-8028', 'lindgren.kenyon@hotmail.com', 'San Lola', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('81', null, null, null, 'Quintanilla, Velásquez y Ulloa', '3228735', 'Otero  81\nSan Juan José del Mar, AR-M 9728', '(30)5843-0946', 'quitzon.orpha@johnson.com', 'Gral. Valentino', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('82', null, null, null, 'Berríos y Asoc.', '28098660', 'Roque  71\nGral. Hidalgo, AR-U 3270', '(900)580-1116', 'jerrell25@gmail.com', 'Don Emilio', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('83', null, null, null, 'Mesa-Salcedo', '1510911', 'Christian  669 Depto. 911\nHipólito del Mirador, AR-W 5647', '(46)155327-5700', 'lwill@little.info', 'Juan del Oeste', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('84', null, null, null, 'Olvera y Orosco', '56766829', 'Dávila  022\nVilla Paula del Oeste, AR-E 52467', '(25)6994-5310', 'roberta.parker@walter.biz', 'Gral. Violeta del Oeste', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('85', null, null, null, 'Moreno y Ledesma', '93272740', 'Montoya  0650\nGral. Juan Esteban del Norte, AR-Q 5549', '650-941-8060', 'dlegros@connelly.info', 'Velásquez del Mar', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('86', null, null, null, 'Orosco, Jasso y Sotelo', '80234488', 'Isabella  62368\nGral. Luna, AR-K 6064', '055-631-8387', 'jhudson@gmail.com', 'Villa Josefa', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('87', null, null, null, 'Delapaz, Alarcón y Ochoa', '49999328', 'Palomino  7070\nRivera del Mirador, AR-Y 8455', '(36)4501-2163', 'windler.mekhi@hickle.com', 'Villalpando del Norte', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('88', null, null, null, 'Becerra-Delagarza', '68606607', 'Emmanuel  4043\nPuerto Ashley del Mar, AR-Y 9853', '(45)4413-4338', 'lsanford@dickens.org', 'Villa Tomas del Sur', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('89', null, null, null, 'Santillán, Vergara y Orosco', '19655891', 'Thiago  2004 37 C\nEmily del Sur, AR-R 9268', '(36)155563-9622', 'josefina.beier@bradtke.com', 'Barrera del Mirador', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('90', null, null, null, 'Angulo, Negrete y Villareal', '36429606', 'Maximiliano  08 Piso 2\nAlba del Mirador, AR-V 06505', '(3040)1558-8903', 'anya.okon@gmail.com', 'Puerto Lautaro del Mirador', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('91', null, null, null, 'Nevárez, Narváez y Aguayo', '99409339', 'Ana Sofía  0083\nVillarreal del Mar, AR-V 35447', '(7732)49-4961', 'paul54@gmail.com', 'Puerto Constanza', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('92', null, null, null, 'Arias y Asoc.', '88953151', 'Alexa  92 3 C\nPuerto Tomas del Este, AR-H 12450', '(5235)1548-2468', 'ansley75@marquardt.info', 'Juan Sebastián del Mirador', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('93', null, null, null, 'de Anda de Covarrubias', '60045892', 'Irene  98 1 D\nVilla Carolina, AR-Z 0011', '(4170)1546-3698', 'wilmer.bergnaum@yahoo.com', 'Puerto Paulina', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('94', null, null, null, 'Luevano, Meraz y Pelayo', '86770700', 'Tomas  255 06 D\nDon Diego, AR-P 3240', '(78)4925-8043', 'keon.willms@crona.com', 'Puerto Hugo', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('95', null, null, null, 'Sedillo SA', '54040871', 'Natalia  5 PB A\nHenríquez del Este, AR-K 22627', '(00)4943-5206', 'orval.skiles@gmail.com', 'Villa Miranda del Sur', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('96', null, null, null, 'Madrigal y Reséndez', '46671520', 'Amador  884\nGral. Hipólito del Mar, AR-D 27399', '(308)534-1601', 'oliver95@hotmail.com', 'Don Damián', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('97', null, null, null, 'Orta y Godínez', '58967804', 'Victoria  30 57 B\nVilla Julieta del Este, AR-U 5812', '(9032)1547-8816', 'lexus60@shields.com', 'San Ana Paula del Mar', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('98', null, null, null, 'Mares y Beltrán', '40309058', 'Montemayor  14\nJuan Sebastián del Sur, AR-S 43147', '(145)15575-7444', 'llittel@yahoo.com', 'Puerto María Fernanda del Este', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('99', null, null, null, 'Muñiz y Valladares', '27282023', 'Gaona  0\nPuerto Lucía, AR-P 02828', '(62)5715-2493', 'jlakin@yahoo.com', 'San Pedro del Mirador', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('100', null, null, null, 'Oquendo-Aparicio', '85883161', 'Montes  81265 Piso 87\nNájera del Oeste, AR-G 29556', '(122)15485-6923', 'melvin61@robel.com', 'Puerto Emilio', '2015-06-17 16:15:37', '2015-06-17 16:15:37');
INSERT INTO `Empleador` VALUES ('101', null, '2', '1', 'El Topo Trans', '2020', 'ch. 125', '4751254', 'cachitorios@hotmail.com', 'Posadas. Misiones', '2015-06-17 17:00:22', '2015-06-17 17:00:22');

-- ----------------------------
-- Table structure for `Empresa`
-- ----------------------------
DROP TABLE IF EXISTS `Empresa`;
CREATE TABLE `Empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Razon` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `cuit` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `localidad` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `telefonos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of empresa
-- ----------------------------

-- ----------------------------
-- Table structure for `fos_user`
-- ----------------------------
DROP TABLE IF EXISTS `fos_user`;
CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `nombre` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `movil` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of fos_user
-- ----------------------------
INSERT INTO `fos_user` VALUES ('1', 'cachorios', 'cachorios', 'cachorios@gmail.com', 'cachorios@gmail.com', '1', '4h3tosw5eha80c04gk04c8ow08co4gg', '0ZzmQiXMb2emEoVhFris0DscMklPNsY0ZvExxhz66azRBv8fZQfeFviKQ8B3q8RubjZCtXYtSQe2jykgC3nQGg==', '2015-06-17 17:28:01', '0', '0', null, null, null, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', '0', null, null, null, null, 'user55819211cbd75.jpg');
INSERT INTO `fos_user` VALUES ('2', '2020', '2020', 'cachitorios@hotmail.com', 'cachitorios@hotmail.com', '1', 'dpgnx5f0m0owk48880os8cw4wssgc0s', '28/fyGo/8N5JdSfY6E37dsUCCJCr/ssA7m4gI3B51fLj/GY2ir+GyHZDQLqNIEApLFRQrimGJHs36YGdRszqJA==', '2015-06-21 22:31:05', '0', '0', null, null, null, 'a:1:{i:0;s:14:\"ROLE_EMPLEADOR\";}', '0', null, 'El Topo Trans', null, null, 'user5581980613866.JPG');

-- ----------------------------
-- Table structure for `Liquidacion`
-- ----------------------------
DROP TABLE IF EXISTS `Liquidacion`;
CREATE TABLE `Liquidacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trabajador_id` int(11) DEFAULT NULL,
  `periodo_id` int(11) DEFAULT NULL,
  `concepto_id` int(11) DEFAULT NULL,
  `importe` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_96ACD4EEEC3656E` (`trabajador_id`),
  KEY `IDX_96ACD4EE9C3921AB` (`periodo_id`),
  KEY `IDX_96ACD4EE6C2330BD` (`concepto_id`),
  CONSTRAINT `FK_96ACD4EE6C2330BD` FOREIGN KEY (`concepto_id`) REFERENCES `Concepto` (`id`),
  CONSTRAINT `FK_96ACD4EE9C3921AB` FOREIGN KEY (`periodo_id`) REFERENCES `Periodo` (`id`),
  CONSTRAINT `FK_96ACD4EEEC3656E` FOREIGN KEY (`trabajador_id`) REFERENCES `Trabajador` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of liquidacion
-- ----------------------------
INSERT INTO `Liquidacion` VALUES ('17', '1', '1', '1', '1740');
INSERT INTO `Liquidacion` VALUES ('18', '1', '1', '2', '2940');
INSERT INTO `Liquidacion` VALUES ('19', '2', '1', '1', '1560');
INSERT INTO `Liquidacion` VALUES ('20', '2', '1', '2', '2640');
INSERT INTO `Liquidacion` VALUES ('25', '1', '2', '1', '1020');
INSERT INTO `Liquidacion` VALUES ('26', '1', '2', '2', '1700');
INSERT INTO `Liquidacion` VALUES ('27', '2', '2', '1', '1140');
INSERT INTO `Liquidacion` VALUES ('28', '2', '2', '2', '1900');

-- ----------------------------
-- Table structure for `Periodo`
-- ----------------------------
DROP TABLE IF EXISTS `Periodo`;
CREATE TABLE `Periodo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vencimiento_id` int(11) DEFAULT NULL,
  `empleador_id` int(11) DEFAULT NULL,
  `Liquidacion` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `descripcion` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_presentacion` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BCABFD718A82E59F` (`vencimiento_id`),
  KEY `IDX_BCABFD717981C10B` (`empleador_id`),
  CONSTRAINT `FK_BCABFD717981C10B` FOREIGN KEY (`empleador_id`) REFERENCES `Empleador` (`id`),
  CONSTRAINT `FK_BCABFD718A82E59F` FOREIGN KEY (`vencimiento_id`) REFERENCES `Vencimiento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of periodo
-- ----------------------------
INSERT INTO `Periodo` VALUES ('1', '2', '101', '0', '0', '0', null, null);
INSERT INTO `Periodo` VALUES ('2', '2', '101', '1', '0', '1', 'Otra liq', null);

-- ----------------------------
-- Table structure for `Trabajador`
-- ----------------------------
DROP TABLE IF EXISTS `Trabajador`;
CREATE TABLE `Trabajador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empleador_id` int(11) NOT NULL,
  `cuil` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `estado_civil` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `localidad` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `legajo` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `trabajadorLejajoUk` (`empleador_id`,`legajo`),
  UNIQUE KEY `trabajadorCuitUk` (`empleador_id`,`cuil`),
  KEY `IDX_D487F0F7981C10B` (`empleador_id`),
  CONSTRAINT `FK_D487F0F7981C10B` FOREIGN KEY (`empleador_id`) REFERENCES `Empleador` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of trabajador
-- ----------------------------
INSERT INTO `Trabajador` VALUES ('1', '101', '20145445109', 'Facundo Cabrera', 'M', 'S', 'facu@gmail.com', '12', '12', 'Posadas', '1001', '1999-05-01 00:00:00', null, '2015-06-17 17:02:56', '2015-06-17 17:02:56');
INSERT INTO `Trabajador` VALUES ('2', '101', '20000000001', 'Falero Nikolas', 'M', 'S', 'nikofa@gmail.com', '15', '121', 'Posadas', '12', '2013-05-01 00:00:00', null, '2015-06-19 04:48:56', '2015-06-19 04:48:56');

-- ----------------------------
-- Table structure for `Vencimiento`
-- ----------------------------
DROP TABLE IF EXISTS `Vencimiento`;
CREATE TABLE `Vencimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) DEFAULT NULL,
  `anio` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `Vencimiento` date NOT NULL,
  `prorroga` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E00EB57F521E1991` (`empresa_id`),
  CONSTRAINT `FK_E00EB57F521E1991` FOREIGN KEY (`empresa_id`) REFERENCES `Empresa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of vencimiento
-- ----------------------------
INSERT INTO `Vencimiento` VALUES ('1', null, '2015', '5', '2015-06-10', null);
INSERT INTO `Vencimiento` VALUES ('2', null, '2015', '4', '2015-05-10', null);

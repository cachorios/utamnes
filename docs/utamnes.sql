/*
Navicat MySQL Data Transfer

Source Server         : MySqlConneccion
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : utamnes

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2015-04-09 15:25:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `concepto`
-- ----------------------------
DROP TABLE IF EXISTS `concepto`;
CREATE TABLE `concepto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `numero` int(11) NOT NULL,
  `descripcion` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_corta` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `obligatorio` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9DF5EA86F55AE19E` (`numero`),
  KEY `IDX_9DF5EA86DB38439E` (`usuario_id`),
  CONSTRAINT `FK_9DF5EA86DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `fos_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of concepto
-- ----------------------------
INSERT INTO `concepto` VALUES ('1', null, '401', 'Cuota Gremial', 'Cta Gremial', '1', '1', '1901-12-13 09:45:52');
INSERT INTO `concepto` VALUES ('2', null, '412', 'Seguro Funerario', 'Seguro Funerario', '1', '1', '1901-12-13 09:45:52');
INSERT INTO `concepto` VALUES ('3', null, '437', 'Seguro de Vida', 'Seguro Vida', '1', '0', '2015-03-18 20:34:44');
INSERT INTO `concepto` VALUES ('4', null, '451', 'Seguro Familiar Colectivo', 'Seg. col', '0', '1', '2015-03-18 20:34:44');
INSERT INTO `concepto` VALUES ('5', null, '480', 'Complemento OB. Social', 'Comp.Ob.Soc.', '0', '1', '2015-03-18 20:34:44');
INSERT INTO `concepto` VALUES ('6', null, '485', 'Prestamo mutual UTA', 'Prestamo UTA', '0', '1', '2015-03-18 20:34:44');

-- ----------------------------
-- Table structure for `conceptototrabajador`
-- ----------------------------
DROP TABLE IF EXISTS `conceptototrabajador`;
CREATE TABLE `conceptototrabajador` (
  `trabajador_id` int(11) NOT NULL,
  `concepto_id` int(11) NOT NULL,
  PRIMARY KEY (`trabajador_id`,`concepto_id`),
  KEY `IDX_EE99010CEC3656E` (`trabajador_id`),
  KEY `IDX_EE99010C6C2330BD` (`concepto_id`),
  CONSTRAINT `FK_EE99010C6C2330BD` FOREIGN KEY (`concepto_id`) REFERENCES `concepto` (`id`),
  CONSTRAINT `FK_EE99010CEC3656E` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajador` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conceptototrabajador
-- ----------------------------
INSERT INTO `conceptototrabajador` VALUES ('53', '1');
INSERT INTO `conceptototrabajador` VALUES ('53', '2');

-- ----------------------------
-- Table structure for `ctacte`
-- ----------------------------
DROP TABLE IF EXISTS `ctacte`;
CREATE TABLE `ctacte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `concepto_id` int(11) DEFAULT NULL,
  `obligacion_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8BDC53546C2330BD` (`concepto_id`),
  KEY `IDX_8BDC53547DDFA817` (`obligacion_id`),
  CONSTRAINT `FK_8BDC53546C2330BD` FOREIGN KEY (`concepto_id`) REFERENCES `concepto` (`id`),
  CONSTRAINT `FK_8BDC53547DDFA817` FOREIGN KEY (`obligacion_id`) REFERENCES `obligacion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ctacte
-- ----------------------------

-- ----------------------------
-- Table structure for `empleador`
-- ----------------------------
DROP TABLE IF EXISTS `empleador`;
CREATE TABLE `empleador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `empresa_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6B449459DB38439E` (`usuario_id`),
  KEY `IDX_6B449459959B7DBC` (`usuario_actualizador_id`),
  KEY `IDX_6B449459521E1991` (`empresa_id`),
  CONSTRAINT `FK_6B449459521E1991` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`),
  CONSTRAINT `FK_6B449459959B7DBC` FOREIGN KEY (`usuario_actualizador_id`) REFERENCES `fos_user` (`id`),
  CONSTRAINT `FK_6B449459DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `fos_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=267 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of empleador
-- ----------------------------
INSERT INTO `empleador` VALUES ('1', null, null, 'Acosta y Puga', '93255736', '99 Rincón  18 A\nFabianadel Este, AR-V 8463', '(31)6327-3512', 'justus87@runolfsson.org', 'Puerto Isidora', null, null, null);
INSERT INTO `empleador` VALUES ('2', null, null, 'Mojica y Solorzano', '93912779', '71597 Carrera \nGral. Saradel Mirador, AR-G 91922', '(96)4643-9507', 'beier.marc@ullrich.com', 'Valentíndel Sur', null, null, null);
INSERT INTO `empleador` VALUES ('3', null, null, 'Dueñas de Delao', '68094319', '1689 Agustina \nFlorenciadel Oeste, AR-J 44613', '(2221)42-4548', 'lockman.annabell@hotmail.com', 'San Ana Paula', null, null, null);
INSERT INTO `empleador` VALUES ('4', null, null, 'Aguirre y Armenta', '32567982', '2 Lozano \nVilla Juan Sebastiándel Mirador, AR-T 73572', '(23)155101-5421', 'ubaldo69@yahoo.com', 'Alessandradel Oeste', null, null, null);
INSERT INTO `empleador` VALUES ('5', null, null, 'Pacheco, Solorzano y Manzanares', '79240357', '111 Samuel  Piso 1\nGral. Lucíadel Oeste, AR-P 63642', '(57)155100-8562', 'sarai88@gutmann.biz', 'María Camiladel Este', null, null, null);
INSERT INTO `empleador` VALUES ('6', null, null, 'Frías-Torres', '75278834', '0 Lugo \nSan Alessandradel Mar, AR-F 4161', '408-136-8043', 'fbradtke@yahoo.com', 'Carolinadel Este', null, null, null);
INSERT INTO `empleador` VALUES ('7', null, null, 'Montenegro de León', '900799', '47 María \nQuiñónezdel Mar, AR-S 5513', '+93(5)1686568224', 'roberts.reagan@hotmail.com', 'Carolinadel Norte', null, null, null);
INSERT INTO `empleador` VALUES ('8', null, null, 'Rosas-Valdivia', '4930424', '17227 Navarro \nVillarrealdel Este, AR-D 1356', '(46)5641-9205', 'christophe.reinger@casper.info', 'San Maite', null, null, null);
INSERT INTO `empleador` VALUES ('9', null, null, 'Miramontes y Gálvez', '97781344', '23 Carbajal  4 C\nColladodel Norte, AR-L 57515', '(63)4357-8297', 'cartwright.andres@hotmail.com', 'Casillasdel Norte', null, null, null);
INSERT INTO `empleador` VALUES ('10', null, null, 'Alicea de Meza', '34799442', '71015 Juan Diego \nSan Rominadel Oeste, AR-S 05799', '(63)6118-4304', 'gstamm@runolfsson.biz', 'Puerto Juan Esteban', null, null, null);
INSERT INTO `empleador` VALUES ('11', null, null, 'Bueno SA', '1857619', '50816 Catalina  3 F\nSan Ivanna, AR-S 48693', '(787)564-6393', 'mhartmann@hotmail.com', 'Don Maríadel Norte', null, null, null);
INSERT INTO `empleador` VALUES ('12', null, null, 'Casárez, Atencio y Cintrón', '16220551', '9021 Serrato \nOlmosdel Sur, AR-N 92480', '(741)15495-0999', 'grempel@yahoo.com', 'Gral. Christiandel Mar', null, null, null);
INSERT INTO `empleador` VALUES ('13', null, null, 'Hernandes SA', '26595057', '39761 Valentín  Piso 08\nFrancodel Mar, AR-Y 4859', '(39)4117-4163', 'thea.schowalter@hotmail.com', 'Gral. Alan', null, null, null);
INSERT INTO `empleador` VALUES ('14', null, null, 'Ontiveros, Soto y Arias', '13507915', '9 Alva \nPuerto Lucianadel Oeste, AR-G 50307', '(88)4568-9860', 'mitchell.weimann@yahoo.com', 'Don Oliva', null, null, null);
INSERT INTO `empleador` VALUES ('15', null, null, 'Ulibarri e Hijo', '45988026', '19 Ana Sofía \nMurillodel Oeste, AR-T 4120', '(56)154864-1852', 'istracke@rowe.net', 'Villa Arianadel Norte', null, null, null);
INSERT INTO `empleador` VALUES ('16', null, null, 'Negrete y Velasco', '95060857', '6 Ignacio  Piso 0\nNiñodel Norte, AR-B 39198', '(82)4884-5809', 'lenny34@graham.com', 'Puerto Valeria', null, null, null);
INSERT INTO `empleador` VALUES ('17', null, null, 'Reyes e Hija', '69805724', '6 Pagan  6 F\nPuerto Juan Esteban, AR-L 3173', '(3813)47-7307', 'alfonso.johnston@hand.com', 'Crespodel Sur', null, null, null);
INSERT INTO `empleador` VALUES ('18', null, null, 'Castro-Rosas', '96377006', '21339 Daniela  29 D\nMejíadel Sur, AR-S 1851', '(083)554-6346', 'olarson@russel.org', 'Javierdel Oeste', null, null, null);
INSERT INTO `empleador` VALUES ('19', null, null, 'Vanegas-Robles', '61780222', '98 Emiliano \nDon Micaeladel Este, AR-F 1609', '(466)488-0022', 'nyasia.cormier@jast.com', 'Simóndel Sur', null, null, null);
INSERT INTO `empleador` VALUES ('20', null, null, 'Centeno de Menéndez', '11089130', '2 Collazo  77 C\nSan Manueldel Este, AR-G 39257', '(5638)48-9272', 'goldner.mireya@gulgowski.biz', 'Micaeladel Norte', null, null, null);
INSERT INTO `empleador` VALUES ('21', null, null, 'Alcántar y Flia.', '23856187', '948 Negrón  98 C\nPuerto Bruno, AR-S 8742', '(00)4101-3279', 'angus65@gmail.com', 'Don Julia', null, null, null);
INSERT INTO `empleador` VALUES ('22', null, null, 'Anguiano de Aguayo', '15098989', '3 David \nVilla Julieta, AR-W 3224', '(02)155546-4545', 'antonina.gutkowski@hotmail.com', 'Don Zoedel Mar', null, null, null);
INSERT INTO `empleador` VALUES ('23', null, null, 'Peres e Hija', '41135440', '5366 Luna  05 D\nMariangeldel Este, AR-J 42589', '(745)563-7187', 'mante.muhammad@gmail.com', 'Villa Josefadel Norte', null, null, null);
INSERT INTO `empleador` VALUES ('24', null, null, 'Almaraz SA', '33206053', '43840 Constanza  51 F\nDon Rafaeladel Sur, AR-M 55024', '(05)5302-3903', 'alexie79@yahoo.com', 'Don Juan Sebastián', null, null, null);
INSERT INTO `empleador` VALUES ('25', null, null, 'Vigil-Alcala', '63809792', '4 Zoe \nSuárezdel Sur, AR-Y 31735', '(7422)43-3662', 'phoebe67@stark.biz', 'Danieldel Sur', null, null, null);
INSERT INTO `empleador` VALUES ('26', null, null, 'Menchaca e Hijo', '22539205', '7249 Fernando \nGral. Jorgedel Sur, AR-H 08023', '664-217-2299', 'herzog.pierce@rempel.com', 'Lauradel Oeste', null, null, null);
INSERT INTO `empleador` VALUES ('27', null, null, 'Castañeda de Guzmán', '51936527', '464 Soria \nEmiliadel Este, AR-T 12564', '(143)569-3704', 'yheller@yahoo.com', 'Biancadel Sur', null, null, null);
INSERT INTO `empleador` VALUES ('28', null, null, 'Venegas, Alcántar y Huerta', '79792713', '3 Espinal \nPuerto Diegodel Este, AR-Z 2724', '(577)407-4110', 'michele.corwin@yahoo.com', 'Don Fabianadel Sur', null, null, null);
INSERT INTO `empleador` VALUES ('29', null, null, 'Cavazos, Barrera y Valles', '81983057', '46 Amador  Depto. 914\nPantojadel Mirador, AR-G 68402', '(026)558-3112', 'norma.will@lesch.info', 'Bermúdezdel Norte', null, null, null);
INSERT INTO `empleador` VALUES ('30', null, null, 'Almaraz de Henríquez', '34989570', '257 Abeyta \nBacadel Este, AR-N 98808', '(08)4712-7532', 'waters.rosa@gmail.com', 'Puerto Aarón', null, null, null);
INSERT INTO `empleador` VALUES ('31', null, null, 'Angulo-Salgado', '40274207', '1 Beltrán  1 C\nVilla Juan Diegodel Este, AR-P 13265', '(41)4358-6412', 'ivonrueden@williamson.com', 'Adornodel Este', null, null, null);
INSERT INTO `empleador` VALUES ('32', null, null, 'Soliz de Bañuelos', '29146057', '0 Lola  8 C\nThiagodel Norte, AR-Y 2183', '(615)15400-3831', 'stark.gwendolyn@yahoo.com', 'Amandadel Mar', null, null, null);
INSERT INTO `empleador` VALUES ('33', null, null, 'Jiménez-Sosa', '89831190', '56 Villanueva \nVilla Emily, AR-G 1830', '(517)15562-5754', 'auer.darby@hotmail.com', 'Gral. Julia', null, null, null);
INSERT INTO `empleador` VALUES ('34', null, null, 'Olivas y Muro', '43209681', '83511 Reséndez  7 4\nVilla Juliadel Oeste, AR-E 4638', '(88)4042-7612', 'corine68@yahoo.com', 'Don María Camila', null, null, null);
INSERT INTO `empleador` VALUES ('35', null, null, 'Muñoz y Lira', '81976554', '9749 Micaela \nGral. Florenciadel Mirador, AR-Z 62158', '+07(0)0073468593', 'ethyl54@gmail.com', 'San Elíasdel Sur', null, null, null);
INSERT INTO `empleador` VALUES ('36', null, null, 'Varela de Pichardo', '87432000', '81 Alaniz \nPuerto Eduardo, AR-L 94410', '(64)4097-0719', 'aisha.bartoletti@gmail.com', 'Don Bautistadel Mirador', null, null, null);
INSERT INTO `empleador` VALUES ('37', null, null, 'Rojas y Jimínez', '5313111', '85192 Felipe  Piso 90\nMagdalenadel Norte, AR-S 31680', '(39)4294-7394', 'noe45@gmail.com', 'Crespodel Este', null, null, null);
INSERT INTO `empleador` VALUES ('38', null, null, 'Garay y Farías', '84441309', '5 Daniela \nPuerto Valery , AR-A 88504', '(6213)1541-4683', 'rasheed80@gulgowski.info', 'San Lucas', null, null, null);
INSERT INTO `empleador` VALUES ('39', null, null, 'Valladares-Zamudio', '92975867', '970 María Alejandra \nUreñadel Este, AR-Y 45756', '(30)4980-9681', 'ckutch@hotmail.com', 'Ochoadel Sur', null, null, null);
INSERT INTO `empleador` VALUES ('40', null, null, 'Alaniz, de Jesús y Dueñas', '4441095', '0930 Abril  9 7\nGral. María Pauladel Mar, AR-Y 3949', '+46(1)6086195227', 'vlemke@hotmail.com', 'Puerto Bruno', null, null, null);
INSERT INTO `empleador` VALUES ('41', null, null, 'Concepción y Asoc.', '70903926', '9 Suárez  2 C\nLermadel Este, AR-W 3100', '(199)554-3789', 'nritchie@mcclure.com', 'Villa Sofíadel Mirador', null, null, null);
INSERT INTO `empleador` VALUES ('42', null, null, 'Rincón y Coronado', '12318177', '71 Michelle  0 2\nPuerto Anadel Sur, AR-T 3276', '(384)446-8202', 'iskiles@gmail.com', 'Puerto Malenadel Oeste', null, null, null);
INSERT INTO `empleador` VALUES ('43', null, null, 'Irizarry y Flia.', '48538247', '87 Velázquez  6 E\nPuerto Sofíadel Mirador, AR-G 21470', '(581)582-0255', 'verda.williamson@prosacco.com', 'Terrazasdel Norte', null, null, null);
INSERT INTO `empleador` VALUES ('44', null, null, 'Arias de Leiva', '84711363', '5 Luna \nConcepcióndel Mirador, AR-U 4128', '(67)5440-5059', 'dmoen@hotmail.com', 'Don Thiagodel Mar', null, null, null);
INSERT INTO `empleador` VALUES ('45', null, null, 'Frías, Sotelo y Villarreal', '93758575', '11 Delrío \nSan Josédel Mirador, AR-P 3858', '(8237)1557-4771', 'douglas.dickinson@von.com', 'Rosadodel Norte', null, null, null);
INSERT INTO `empleador` VALUES ('46', null, null, 'Ibarra y Ocampo', '8074950', '5 Díaz \nMoralesdel Norte, AR-G 4501', '+47(3)0889030072', 'murray.clotilde@yahoo.com', 'Villa Valentina', null, null, null);
INSERT INTO `empleador` VALUES ('47', null, null, 'Rendón S. de H.', '41383526', '69924 Lucas  74 A\nGral. Josué, AR-Z 99293', '(042)589-6901', 'boyd45@hotmail.com', 'Puerto Emiliano', null, null, null);
INSERT INTO `empleador` VALUES ('48', null, null, 'Canales de Bétancourt', '42612525', '53 Juan José \nSalasdel Mar, AR-E 71439', '(0275)1541-5815', 'cdamore@yahoo.com', 'San Agustina', null, null, null);
INSERT INTO `empleador` VALUES ('49', null, null, 'Martínez, Alfaro y Márquez', '19381703', '0237 Carrillo  Piso 5\nSalazardel Mar, AR-R 28536', '(439)582-4032', 'alana12@raynor.info', 'Jaimesdel Oeste', null, null, null);
INSERT INTO `empleador` VALUES ('50', null, null, 'Uribe de Navarro', '48586689', '171 Zambrano \nAlexadel Mar, AR-M 3442', '(21)5362-8872', 'chloe61@heller.com', 'Gral. Josué', null, null, null);
INSERT INTO `empleador` VALUES ('51', null, null, 'Ornelas e Hija', '73040116', '1276 Valle  8 A\nNazariodel Norte, AR-K 7286', '(43)155568-6891', 'lakin.adonis@klein.info', 'Ocampodel Norte', null, null, null);
INSERT INTO `empleador` VALUES ('52', null, null, 'Bétancourt y Flia.', '24187338', '195 Saldivar \nRoblesdel Este, AR-L 8727', '(254)15565-6014', 'bernier.everett@gmail.com', 'Longoriadel Mar', null, null, null);
INSERT INTO `empleador` VALUES ('53', null, null, 'Jáquez y Apodaca', '99053627', '893 Juan \nSebastiándel Mar, AR-L 4136', '690-427-1557', 'robyn.bradtke@mcclure.org', 'Agustíndel Norte', null, null, null);
INSERT INTO `empleador` VALUES ('54', null, null, 'Matos, Alonso y Pabón', '36877041', '064 Porras \nIsabeldel Sur, AR-V 26131', '(69)5223-1006', 'langworth.reymundo@hotmail.com', 'Don Catalina', null, null, null);
INSERT INTO `empleador` VALUES ('55', null, null, 'Pelayo de Bétancourt', '18020361', '5 Arguello \nManueladel Norte, AR-G 7994', '(780)15470-1784', 'zane88@runolfsdottir.com', 'Don Anadel Mirador', null, null, null);
INSERT INTO `empleador` VALUES ('56', null, null, 'Padrón e Hijo', '44807532', '7371 Ybarra  4 E\nVareladel Mar, AR-Q 41496', '(717)416-6220', 'deonte.prohaska@cronin.org', 'Gral. Francisco', null, null, null);
INSERT INTO `empleador` VALUES ('57', null, null, 'Romo, Juárez y Espinoza', '98395979', '84940 Vélez  00 B\nRosariodel Mirador, AR-Y 6258', '(1283)42-6570', 'trantow.bennie@gmail.com', 'Don Irenedel Oeste', null, null, null);
INSERT INTO `empleador` VALUES ('58', null, null, 'Armenta, Caballero y Peres', '74265750', '656 Camilo \nDon Abrildel Mirador, AR-Y 34424', '(242)15572-7768', 'vadams@gmail.com', 'Felipedel Este', null, null, null);
INSERT INTO `empleador` VALUES ('59', null, null, 'Nevárez y Bustos', '84780054', '61 Juan Sebastián \nAxeldel Norte, AR-R 8317', '898-690-4903', 'treutel.andreanne@yahoo.com', 'María Fernandadel Oeste', null, null, null);
INSERT INTO `empleador` VALUES ('60', null, null, 'Lira, Gamboa y Tamayo', '80057060', '8 Caldera \nNiñodel Sur, AR-M 3895', '(485)463-0707', 'dach.graham@hotmail.com', 'Salgadodel Este', null, null, null);
INSERT INTO `empleador` VALUES ('61', null, null, 'Lozada, Barreto y Zelaya', '65593072', '1 Alex \nGral. Samanthadel Sur, AR-Y 5110', '(49)4092-9142', 'kerluke.august@abshire.com', 'Don Danieladel Sur', null, null, null);
INSERT INTO `empleador` VALUES ('62', null, null, 'Arroyo-Márquez', '68899695', '35103 Delafuente \nMorenodel Este, AR-R 0301', '(69)154010-9424', 'jakubowski.vernon@reynolds.com', 'Gral. Daniela', null, null, null);
INSERT INTO `empleador` VALUES ('63', null, null, 'Gálvez, Alonso y Rojo', '84201108', '92688 Hugo  1 5\nVilla Ameliadel Mirador, AR-F 82805', '(800)15510-7128', 'cmueller@gmail.com', 'Juan Sebastiándel Mar', null, null, null);
INSERT INTO `empleador` VALUES ('64', null, null, 'Centeno, Alemán y Pacheco', '30670661', '538 Gamboa  33 B\nSan Daniel, AR-F 5003', '(27)155255-2245', 'allen95@hotmail.com', 'Gral. Alejandrodel Oeste', null, null, null);
INSERT INTO `empleador` VALUES ('65', null, null, 'Olivera SA', '56647653', '602 Nahuel \nVilla Carlosdel Norte, AR-S 55375', '(0970)44-9230', 'hschmeler@gmail.com', 'Juliadel Mar', null, null, null);
INSERT INTO `empleador` VALUES ('66', null, null, 'Verduzco de Sosa', '78136870', '682 Zelaya \nGral. Isabel, AR-K 1281', '(038)533-0470', 'dakota52@gmail.com', 'Delarosadel Norte', null, null, null);
INSERT INTO `empleador` VALUES ('67', null, null, 'Montes de Leal', '59470532', '43223 Mercado \nTejadadel Sur, AR-M 0859', '(052)455-8633', 'klynch@hotmail.com', 'Suárezdel Norte', null, null, null);
INSERT INTO `empleador` VALUES ('68', null, null, 'Pulido, Griego y Sauceda', '83519360', '63939 Aranda \nDon Mateo, AR-F 2275', '(392)15503-0912', 'nabshire@hotmail.com', 'San Daniel', null, null, null);
INSERT INTO `empleador` VALUES ('69', null, null, 'Portillo de Griego', '39248379', '3830 Daniela  0 E\nSan Maite, AR-H 1029', '(07)4528-2217', 'heaven.corkery@gmail.com', 'Guadalupedel Mar', null, null, null);
INSERT INTO `empleador` VALUES ('70', null, null, 'Carrillo, Bonilla y Cabán', '11359912', '331 Valdés  9 D\nGral. Jacobo, AR-V 0758', '(28)4436-1401', 'khettinger@rippin.info', 'Guardadodel Mar', null, null, null);
INSERT INTO `empleador` VALUES ('71', null, null, 'Marín y Sarabia', '58077405', '2958 Pablo  Piso 69\nAntoniadel Este, AR-K 5538', '+00(5)5208584219', 'mitchel.abbott@gmail.com', 'Julietadel Mar', null, null, null);
INSERT INTO `empleador` VALUES ('72', null, null, 'Alcaraz-Lomeli', '52768540', '0 Alcántar  8 0\nCastillodel Oeste, AR-U 05165', '(579)15464-8711', 'connelly.rosie@nikolaus.com', 'Gral. Julián', null, null, null);
INSERT INTO `empleador` VALUES ('73', null, null, 'Fierro de Alicea', '46366873', '109 Alejandro  3 E\nJuan Josédel Sur, AR-Q 42183', '+28(1)6242883959', 'lind.chester@gmail.com', 'Elena del Mar', null, null, null);
INSERT INTO `empleador` VALUES ('74', null, null, 'Quintero de Téllez', '35936943', '074 Delfina  08 B\nSamanthadel Mirador, AR-Y 71344', '(03)154278-1335', 'elenora13@hegmann.com', 'Borregodel Este', null, null, null);
INSERT INTO `empleador` VALUES ('75', null, null, 'Gaytán SRL', '83298502', '77417 Mendoza  Hab. 378\nMéndezdel Sur, AR-X 76907', '(2725)42-0994', 'winnifred63@mitchell.com', 'Robledodel Mirador', null, null, null);
INSERT INTO `empleador` VALUES ('76', null, null, 'Arias de Trejo', '57894140', '13017 Quintana  5 A\nGral. Antonella, AR-E 36840', '(89)155395-9441', 'rcrona@bartoletti.info', 'Gaytándel Oeste', null, null, null);
INSERT INTO `empleador` VALUES ('77', null, null, 'Pineda de Robles', '61973767', '95633 Reyna  Depto. 325\nDon Míadel Mirador, AR-A 00242', '(00)155590-8065', 'feest.shayna@king.info', 'Arenasdel Este', null, null, null);
INSERT INTO `empleador` VALUES ('78', null, null, 'Almanza y Meléndez', '23358658', '1516 Madrigal  94 C\nAlejandrodel Oeste, AR-E 66034', '(762)506-4069', 'braun.kelley@gmail.com', 'Villa Daniela', null, null, null);
INSERT INTO `empleador` VALUES ('79', null, null, 'Armendáriz-Ponce', '93283010', '45747 Lovato \nSan Emilianodel Sur, AR-P 79176', '(686)514-9950', 'everette.ziemann@gmail.com', 'Puerto Sofía', null, null, null);
INSERT INTO `empleador` VALUES ('80', null, null, 'Barragán de Maldonado', '25048104', '4 Juan David \nSan Alejandradel Norte, AR-U 5994', '(016)15597-0743', 'gillian95@gmail.com', 'Villa Jacobo', null, null, null);
INSERT INTO `empleador` VALUES ('81', null, null, 'Vera de Holguín', '54597173', '5477 Jasso  56 B\nLeonardodel Norte, AR-H 0224', '+51(3)9311586792', 'vgoldner@yahoo.com', 'Puerto Esteban', null, null, null);
INSERT INTO `empleador` VALUES ('82', null, null, 'Patiño, Valenzuela y Pérez', '18911644', '8 Moreno  2 5\nDon Alma, AR-P 0958', '(157)15506-5863', 'mcglynn.julius@gmail.com', 'Javierdel Oeste', null, null, null);
INSERT INTO `empleador` VALUES ('83', null, null, 'Bernal SA', '89100428', '6 Paulina \nVilla Isabelladel Mirador, AR-U 37704', '(546)15505-0870', 'braun.anabel@gmail.com', 'Olivodel Mirador', null, null, null);
INSERT INTO `empleador` VALUES ('84', null, null, 'Bahena-Esparza', '48595433', '2 Laura \nGral. Alessandra, AR-E 93907', '(8824)46-0698', 'antonette.hettinger@koelpin.com', 'Casasdel Oeste', null, null, null);
INSERT INTO `empleador` VALUES ('85', null, null, 'Villa y Villalpando', '18519379', '6860 Holguín \nPuerto Dantedel Este, AR-K 8434', '(07)4650-1425', 'yost.isadore@hyatt.net', 'Juradodel Norte', null, null, null);
INSERT INTO `empleador` VALUES ('86', null, null, 'Martínez y Asoc.', '93625850', '9 Carrasquillo  08 D\nDon Franco, AR-X 37490', '(538)549-9022', 'elouise92@haley.com', 'Puerto Julieta', null, null, null);
INSERT INTO `empleador` VALUES ('87', null, null, 'Caballero S. de H.', '12263377', '61197 Gallardo  0 5\nGral. Mateodel Mar, AR-H 7783', '+94(7)6676189432', 'witting.tre@gmail.com', 'Ávalosdel Sur', null, null, null);
INSERT INTO `empleador` VALUES ('88', null, null, 'Delagarza-Acuña', '64498723', '60 Martina  6 D\nVilla Aaróndel Mirador, AR-T 9329', '(3544)47-5191', 'pmante@gmail.com', 'Menadel Mar', null, null, null);
INSERT INTO `empleador` VALUES ('89', null, null, 'Mendoza-Cornejo', '3074361', '7 Aranda \nSan Valentinadel Este, AR-P 3956', '(93)5913-7715', 'wintheiser.tanner@lebsack.com', 'Alexdel Oeste', null, null, null);
INSERT INTO `empleador` VALUES ('90', null, null, 'Mendoza de Figueroa', '61653922', '2735 Hernádez  7 E\nPuerto Sara Sofía, AR-F 3353', '(821)576-4794', 'aklein@wehner.com', 'Benjamíndel Mirador', null, null, null);
INSERT INTO `empleador` VALUES ('91', null, null, 'Flórez y Centeno', '74883679', '553 Sosa  28 A\nDon Juana, AR-W 06905', '(80)155009-4581', 'hahn.ervin@cassin.info', 'Villa Juan Manueldel Mirador', null, null, null);
INSERT INTO `empleador` VALUES ('92', null, null, 'Lerma y Castellanos', '46595923', '7 Colón \nDon Malena, AR-S 23556', '(4224)40-4047', 'rodriguez.dante@altenwerth.org', 'Villa Regina', null, null, null);
INSERT INTO `empleador` VALUES ('93', null, null, 'Mendoza S. de H.', '70152581', '753 Julia \nDon Silvana del Mar, AR-R 3887', '+75(7)9402217017', 'zack51@botsford.info', 'Valenciadel Norte', null, null, null);
INSERT INTO `empleador` VALUES ('94', null, null, 'Carreón y Luna', '65357639', '5 Victoria  30 D\nAndreadel Sur, AR-V 4568', '(31)4492-7951', 'jturner@yahoo.com', 'Gral. Regina', null, null, null);
INSERT INTO `empleador` VALUES ('95', null, null, 'Caraballo SRL', '11717934', '132 Benjamín  6 F\nBorregodel Sur, AR-B 60165', '(7585)49-7652', 'max89@littel.com', 'San Juan Esteban', null, null, null);
INSERT INTO `empleador` VALUES ('96', null, null, 'Mondragón y Muñiz', '92803161', '704 Juan Esteban \nPuerto Lucía, AR-P 02828', '(62)5715-2493', 'jlakin@yahoo.com', 'San Pedrodel Mirador', null, null, null);
INSERT INTO `empleador` VALUES ('97', null, null, 'Aparicio de Solano', '60075436', '397 Ashley  60 1\nZoedel Norte, AR-R 2733', '(235)469-4945', 'kellie44@yahoo.com', 'Puerto Sebastiándel Este', null, null, null);
INSERT INTO `empleador` VALUES ('98', null, null, 'Bustos e Hijos', '21369175', '04842 Martínez  8 F\nGaeldel Este, AR-W 1287', '(0383)48-6533', 'haylee.kreiger@gmail.com', 'Britodel Oeste', null, null, null);
INSERT INTO `empleador` VALUES ('99', null, null, 'Magaña-Valdez', '86014453', '9017 Valeria  PB A\nSantacruzdel Mar, AR-V 33494', '(34)5084-3078', 'ellen04@yahoo.com', 'Don Lucía', null, null, null);
INSERT INTO `empleador` VALUES ('100', null, null, 'Prado, Nava y Vela', '42258886', '73841 Agustín  15 F\nBareladel Este, AR-H 75229', '(5315)1544-0303', 'lmclaughlin@jacobs.com', 'Carbajaldel Sur', null, null, null);
INSERT INTO `empleador` VALUES ('120', '24', '1', 'Luis Rios', '20204894532', 'Ch. 113 Sector 120 Casa 99', '154720300', 'cachitorios@hotmail.com', 'Posadas', null, null, null);
INSERT INTO `empleador` VALUES ('266', '171', '24', 'Nico', '151589', 'aa', '111', 'nicobc@gmail.com', 'Posadas', '2015-03-26 22:55:52', '2015-03-26 22:55:52', null);

-- ----------------------------
-- Table structure for `empresa`
-- ----------------------------
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa` (
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
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of fos_user
-- ----------------------------
INSERT INTO `fos_user` VALUES ('1', 'cachorios', 'cachorios', 'cachorios@gmail.com', 'cachorios@gmail.com', '1', 'h1jmfu358f4k0os48csco8wckso4oo0', '/LdtHQAI79OBrPv9+Yf1A03/tI6IReNBrKbNv2icfR7tFUJFeWbMvoxAJOQczTKZpes/hLIiE8Id9ia8piE23w==', '2015-04-09 19:50:29', '0', '0', null, null, null, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', '0', null, 'Luis', '4475646', '154720300', 'user5509d5da09d03.jpg');
INSERT INTO `fos_user` VALUES ('24', '20204894532', '20204894532', 'cachitorios@hotmail.com', 'cachitorios@hotmail.com', '1', '21bhbl90khfogg4wo4kg4w40kcww08w', 'Et451LV2vuyC5SUUkT77he+wrJoW8SVd+KMNi1/DRQt6HFX2FZljbDDEazv0PeXKG+ZfYkdvT95BAKuiigpF1A==', '2015-04-09 19:52:16', '0', '0', null, null, null, 'a:1:{i:0;s:14:\"ROLE_EMPLEADOR\";}', '0', null, 'Luis Rios', null, null, 'user5511f463547e6.jpg');
INSERT INTO `fos_user` VALUES ('170', 'Alberto', 'alberto', 'albertovoeffray@gmail.com', 'albertovoeffray@gmail.com', '1', '1a6febg4awkgcg00cww080gwo80wcg4', 'S1J4Mnz4ceQg5Wef5RrynsOUUvLu4umFDmO+a4Y5IWRc7nppyIjs7mvAc7zDPC9CQ1QdwY7gj0161UKSGYE9yw==', '2015-03-26 22:27:54', '0', '0', null, null, null, 'a:1:{i:0;s:8:\"ROLE_UTA\";}', '0', null, 'Alberto Voeffray', '4444', null, 'user551479767b9dd.jpg');
INSERT INTO `fos_user` VALUES ('171', '151589', '151589', 'nicobc@gmail.com', 'nicobc@gmail.com', '0', 'documszk57kgcwosk0owo8c08ookoc0', 'OhYEKF4esaD75HJtte93bGsO8gtl27PiIPoaupNBkx6hYQOMtEDS6i/aQzKxhYnsoWSthAtTrBziQnqQhm5Smw==', null, '0', '0', null, 'gd9k18vNk6n1G4YStxnQmil7j_IOfOE2clYXvjqB2W4', null, 'a:1:{i:0;s:14:\"ROLE_EMPLEADOR\";}', '0', null, 'Nico', null, null, null);

-- ----------------------------
-- Table structure for `liquidacion`
-- ----------------------------
DROP TABLE IF EXISTS `liquidacion`;
CREATE TABLE `liquidacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trabajador_periodo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_96ACD4EE24F6A16` (`trabajador_periodo_id`),
  CONSTRAINT `FK_96ACD4EE24F6A16` FOREIGN KEY (`trabajador_periodo_id`) REFERENCES `trabajadorperiodo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of liquidacion
-- ----------------------------

-- ----------------------------
-- Table structure for `obligacion`
-- ----------------------------
DROP TABLE IF EXISTS `obligacion`;
CREATE TABLE `obligacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F09DD3D19C3921AB` (`periodo_id`),
  CONSTRAINT `FK_F09DD3D19C3921AB` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of obligacion
-- ----------------------------

-- ----------------------------
-- Table structure for `periodo`
-- ----------------------------
DROP TABLE IF EXISTS `periodo`;
CREATE TABLE `periodo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vencimiento_id` int(11) DEFAULT NULL,
  `liquidacion` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BCABFD718A82E59F` (`vencimiento_id`),
  CONSTRAINT `FK_BCABFD718A82E59F` FOREIGN KEY (`vencimiento_id`) REFERENCES `vencimiento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of periodo
-- ----------------------------
INSERT INTO `periodo` VALUES ('1', '1', '0', '0');
INSERT INTO `periodo` VALUES ('2', '2', '0', '0');

-- ----------------------------
-- Table structure for `trabajador`
-- ----------------------------
DROP TABLE IF EXISTS `trabajador`;
CREATE TABLE `trabajador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `empleador_id` int(11) NOT NULL,
  `estado_civil` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `localidad` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `cuil` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `legajo` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `sexo` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `trabajadorLejajoUk` (`empleador_id`,`legajo`),
  UNIQUE KEY `trabajadorCuitUk` (`empleador_id`,`cuil`),
  KEY `IDX_D487F0FDB38439E` (`usuario_id`),
  KEY `IDX_D487F0F7981C10B` (`empleador_id`),
  CONSTRAINT `FK_D487F0F7981C10B` FOREIGN KEY (`empleador_id`) REFERENCES `empleador` (`id`),
  CONSTRAINT `FK_D487F0FDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `fos_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of trabajador
-- ----------------------------
INSERT INTO `trabajador` VALUES ('53', '24', '120', 'S', 'Posadas', null, '4475646', 'Ch 113', 'Cabrera Facundo', '20145445109', '3279', '2012-01-10 00:00:00', null, '2015-03-26 22:55:52', '2015-03-27 18:14:08', 'M');

-- ----------------------------
-- Table structure for `trabajadorperiodo`
-- ----------------------------
DROP TABLE IF EXISTS `trabajadorperiodo`;
CREATE TABLE `trabajadorperiodo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2A7EF9D99C3921AB` (`periodo_id`),
  CONSTRAINT `FK_2A7EF9D99C3921AB` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of trabajadorperiodo
-- ----------------------------

-- ----------------------------
-- Table structure for `vencimiento`
-- ----------------------------
DROP TABLE IF EXISTS `vencimiento`;
CREATE TABLE `vencimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) DEFAULT NULL,
  `anio` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `vencimiento` date NOT NULL,
  `prorroga` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E00EB57F521E1991` (`empresa_id`),
  CONSTRAINT `FK_E00EB57F521E1991` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of vencimiento
-- ----------------------------
INSERT INTO `vencimiento` VALUES ('1', null, '2015', '1', '2015-03-19', null);
INSERT INTO `vencimiento` VALUES ('2', null, '2015', '2', '2015-03-12', null);

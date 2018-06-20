/*
SQLyog Ultimate v9.63 
MySQL - 5.5.5-10.1.21-MariaDB : Database - viajes
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `viajes`;

/*Table structure for table `calificacion` */

DROP TABLE IF EXISTS `calificacion`;

CREATE TABLE `calificacion` (
  `calificacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `viaje_id` int(11) NOT NULL,
  `usuario_evalua_id` int(11) DEFAULT NULL,
  `usuario_evaluado_id` int(11) NOT NULL,
  `puntaje` int(11) NOT NULL,
  `comentario` varchar(500) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`calificacion_id`),
  KEY `calificacion_fk1` (`viaje_id`),
  KEY `calificacion_fk2` (`usuario_evalua_id`),
  KEY `calificacion_fk3` (`usuario_evaluado_id`),
  CONSTRAINT `calificacion_fk1` FOREIGN KEY (`viaje_id`) REFERENCES `viaje` (`viaje_id`),
  CONSTRAINT `calificacion_fk2` FOREIGN KEY (`usuario_evalua_id`) REFERENCES `usuario` (`usuario_id`),
  CONSTRAINT `calificacion_fk3` FOREIGN KEY (`usuario_evaluado_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `calificacion` */

/*Table structure for table `compra_tarjeta` */

DROP TABLE IF EXISTS `compra_tarjeta`;

CREATE TABLE `compra_tarjeta` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `id_pasajero` int(11) DEFAULT NULL,
  `id_tarjeta_credito` int(11) NOT NULL,
  `i_compra` decimal(15,0) NOT NULL DEFAULT '2',
  `f_compra` date NOT NULL,
  `m_baja` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_compra`),
  KEY `compra_tarjeta_fk1` (`id_pasajero`),
  KEY `compra_tarjeta_fk2` (`id_tarjeta_credito`),
  CONSTRAINT `compra_tarjeta_fk1` FOREIGN KEY (`id_pasajero`) REFERENCES `pasajero` (`pasajero_id`),
  CONSTRAINT `compra_tarjeta_fk2` FOREIGN KEY (`id_tarjeta_credito`) REFERENCES `tarjeta_credito` (`id_tarjeta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `compra_tarjeta` */

/*Table structure for table `dia_semana` */

DROP TABLE IF EXISTS `dia_semana`;

CREATE TABLE `dia_semana` (
  `dia_semana_id` int(11) NOT NULL,
  `dia_semana_nombre` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`dia_semana_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `dia_semana` */

insert  into `dia_semana`(`dia_semana_id`,`dia_semana_nombre`) values (1,'LUNES');
insert  into `dia_semana`(`dia_semana_id`,`dia_semana_nombre`) values (2,'MARTES');
insert  into `dia_semana`(`dia_semana_id`,`dia_semana_nombre`) values (3,'MIERCOLES');
insert  into `dia_semana`(`dia_semana_id`,`dia_semana_nombre`) values (4,'JUEVES');
insert  into `dia_semana`(`dia_semana_id`,`dia_semana_nombre`) values (5,'VIERNES');
insert  into `dia_semana`(`dia_semana_id`,`dia_semana_nombre`) values (6,'SABADO');
insert  into `dia_semana`(`dia_semana_id`,`dia_semana_nombre`) values (7,'DOMINGO');

/*Table structure for table `empresa_tarjetas_credito` */

DROP TABLE IF EXISTS `empresa_tarjetas_credito`;

CREATE TABLE `empresa_tarjetas_credito` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `d_nombre_empresa` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `empresa_tarjetas_credito` */

insert  into `empresa_tarjetas_credito`(`id_empresa`,`d_nombre_empresa`) values (1,'VISA');
insert  into `empresa_tarjetas_credito`(`id_empresa`,`d_nombre_empresa`) values (2,'MASTERCARD');

/*Table structure for table `estado` */

DROP TABLE IF EXISTS `estado`;

CREATE TABLE `estado` (
  `estado_id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_estado` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`estado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `estado` */

insert  into `estado`(`estado_id`,`descripcion_estado`) values (1,'PENDIENTE');
insert  into `estado`(`estado_id`,`descripcion_estado`) values (2,'APROBADO');

/*Table structure for table `localidad` */

DROP TABLE IF EXISTS `localidad`;

CREATE TABLE `localidad` (
  `localidad_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_localidad` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`localidad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=330 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `localidad` */

insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (1,'25 de Mayo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (2,'3 de febrero');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (3,'A. Alsina');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (4,'A. Gonzales Chaves');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (5,'Aguas Verdes');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (6,'Alberti');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (7,'Arrecifes');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (8,'Ayacucho');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (9,'Azul');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (10,'Bahia Blanca');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (11,'Balcarce');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (12,'Baradero');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (13,'Benito Juarez');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (14,'Berisso');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (15,'Bolivar');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (16,'Bragado');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (17,'Brandsen');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (18,'Campana');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (19,'Canuelas');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (20,'Capilla del Senor');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (21,'Capitan Sarmiento');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (22,'Carapachay');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (23,'Carhue');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (24,'Carilo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (25,'Carlos Casares');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (26,'Carlos Tejedor');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (27,'Carmen de Areco');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (28,'Carmen de Patagones');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (29,'Castelli');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (30,'Chacabuco');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (31,'Chascomus');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (32,'Chivilcoy');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (33,'Colon');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (34,'Coronel Dorrego');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (35,'Coronel Pringles');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (36,'Coronel Rosales');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (37,'Coronel Suarez');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (38,'Costa Azul');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (39,'Costa Chica');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (40,'Costa del Este');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (41,'Costa Esmeralda');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (42,'Daireaux');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (43,'Darregueira');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (44,'Del Viso');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (45,'Dolores');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (46,'Don Torcuato');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (47,'Ensenada');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (48,'Escobar');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (49,'Exaltacion de la Cruz');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (50,'Florentino Ameghino');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (51,'Garin');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (52,'Gral. Alvarado');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (53,'Gral. Alvear');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (54,'Gral. Arenales');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (55,'Gral. Belgrano');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (56,'Gral. Guido');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (57,'Gral. Lamadrid');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (58,'Gral. Las Heras');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (59,'Gral. Lavalle');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (60,'Gral. Madariaga');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (61,'Gral. Pacheco');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (62,'Gral. Paz');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (63,'Gral. Pinto');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (64,'Gral. Pueyrredon');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (65,'Gral. Rodriguez');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (66,'Gral. Viamonte');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (67,'Gral. Villegas');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (68,'Guamini');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (69,'Guernica');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (70,'Hipolito Yrigoyen');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (71,'Ing. Maschwitz');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (72,'Junin');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (73,'La Plata');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (74,'Laprida');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (75,'Las Flores');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (76,'Las Toninas');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (77,'Leandro N. Alem');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (78,'Lincoln');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (79,'Loberia');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (80,'Lobos');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (81,'Los Cardales');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (82,'Los Toldos');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (83,'Lucila del Mar');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (84,'Lujan');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (85,'Magdalena');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (86,'Maipu');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (87,'Mar Chiquita');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (88,'Mar de Ajo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (89,'Mar de las Pampas');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (90,'Mar del Plata');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (91,'Mar del Tuyu');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (92,'Marcos Paz');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (93,'Mercedes');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (94,'Miramar');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (95,'Monte');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (96,'Monte Hermoso');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (97,'Munro');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (98,'Navarro');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (99,'Necochea');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (100,'Olavarria');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (101,'Partido de la Costa');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (102,'Pehuajo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (103,'Pellegrini');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (104,'Pergamino');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (105,'Pigue');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (106,'Pila');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (107,'Pilar');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (108,'Pinamar');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (109,'Pinar del Sol');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (110,'Polvorines');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (111,'Pte. Peron');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (112,'Puan');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (113,'Punta Indio');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (114,'Ramallo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (115,'Rauch');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (116,'Rivadavia');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (117,'Rojas');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (118,'Roque Perez');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (119,'Saavedra');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (120,'Saladillo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (121,'Salliquelo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (122,'Salto');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (123,'San Andres de Giles');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (124,'San Antonio de Areco');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (125,'San Antonio de Padua');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (126,'San Bernardo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (127,'San Cayetano');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (128,'San Clemente del Tuyu');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (129,'San Nicolas');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (130,'San Pedro');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (131,'San Vicente');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (132,'Santa Teresita');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (133,'Suipacha');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (134,'Tandil');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (135,'Tapalque');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (136,'Tordillo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (137,'Tornquist');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (138,'Trenque Lauquen');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (139,'Tres Lomas');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (140,'Villa Gesell');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (141,'Villarino');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (142,'Zarate');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (143,'11 de Septiembre');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (144,'20 de Junio');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (145,'25 de Mayo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (146,'Acassuso');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (147,'Adrogue');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (148,'Aldo Bonzi');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (149,'Area Reserva Cinturon Ecologico');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (150,'Avellaneda');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (151,'Banfield');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (152,'Barrio Parque');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (153,'Barrio Santa Teresita');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (154,'Beccar');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (155,'Bella Vista');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (156,'Berazategui');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (157,'Bernal Este');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (158,'Bernal Oeste');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (159,'Billinghurst');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (160,'Boulogne');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (161,'Burzaco');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (162,'Carapachay');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (163,'Caseros');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (164,'Castelar');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (165,'Churruca');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (166,'Ciudad Evita');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (167,'Ciudad Madero');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (168,'Ciudadela');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (169,'Claypole');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (170,'Crucecita');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (171,'Dock Sud');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (172,'Don Bosco');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (173,'Don Orione');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (174,'El Jaguel');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (175,'El Libertador');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (176,'El Palomar');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (177,'El Tala');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (178,'El Trebol');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (179,'Ezeiza');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (180,'Ezpeleta');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (181,'Florencio Varela');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (182,'Florida');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (183,'Francisco Alvarez');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (184,'Gerli');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (185,'Glew');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (186,'Gonzalez Catan');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (187,'Gral. Lamadrid');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (188,'Grand Bourg');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (189,'Gregorio de Laferrere');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (190,'Guillermo Enrique Hudson');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (191,'Haedo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (192,'Hurlingham');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (193,'Ing. Sourdeaux');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (194,'Isidro Casanova');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (195,'Ituzaingo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (196,'Jose C. Paz');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (197,'Jose Ingenieros');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (198,'Jose Marmol');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (199,'La Lucila');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (200,'La Reja');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (201,'La Tablada');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (202,'Lanus');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (203,'Llavallol');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (204,'Loma Hermosa');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (205,'Lomas de Zamora');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (206,'Lomas del Millon');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (207,'Lomas del Mirador');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (208,'Longchamps');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (209,'Los Polvorines');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (210,'Luis Guillon');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (211,'Malvinas Argentinas');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (212,'Martin Coronado');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (213,'Martinez');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (214,'Merlo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (215,'Ministro Rivadavia');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (216,'Monte Chingolo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (217,'Monte Grande');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (218,'Moreno');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (219,'Moron');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (220,'Muniz');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (221,'Olivos');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (222,'Pablo Nogues');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (223,'Pablo Podesta');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (224,'Paso del Rey');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (225,'Pereyra');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (226,'Pineiro');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (227,'Platanos');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (228,'Pontevedra');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (229,'Quilmes');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (230,'Rafael Calzada');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (231,'Rafael Castillo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (232,'Ramos Mejia');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (233,'Ranelagh');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (234,'Remedios de Escalada');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (235,'Saenz Pena');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (236,'San Antonio de Padua');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (237,'San Fernando');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (238,'San Francisco Solano');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (239,'San Isidro');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (240,'San Jose');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (241,'San Justo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (242,'San Martin');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (243,'San Miguel');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (244,'Santos Lugares');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (245,'Sarandi');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (246,'Sourigues');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (247,'Tapiales');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (248,'Temperley');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (249,'Tigre');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (250,'Tortuguitas');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (251,'Tristan Suarez');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (252,'Trujui');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (253,'Turdera');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (254,'Valentin Alsina');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (255,'Vicente Lopez');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (256,'Villa Adelina');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (257,'Villa Ballester');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (258,'Villa Bosch');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (259,'Villa Caraza');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (260,'Villa Celina');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (261,'Villa Centenario');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (262,'Villa de Mayo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (263,'Villa Diamante');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (264,'Villa Dominico');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (265,'Villa Espana');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (266,'Villa Fiorito');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (267,'Villa Guillermina');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (268,'Villa Insuperable');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (269,'Villa Jose Leon Suarez');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (270,'Villa La Florida');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (271,'Villa Luzuriaga');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (272,'Villa Martelli');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (273,'Villa Obrera');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (274,'Villa Progreso');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (275,'Villa Raffo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (276,'Villa Sarmiento');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (277,'Villa Tesei');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (278,'Villa Udaondo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (279,'Virrey del Pino');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (280,'Wilde');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (281,'William Morris');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (282,'Agronomia');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (283,'Almagro');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (284,'Balvanera');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (285,'Barracas');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (286,'Belgrano');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (287,'Boca');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (288,'Boedo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (289,'Caballito');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (290,'Chacarita');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (291,'Coghlan');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (292,'Colegiales');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (293,'Constitucion');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (294,'Flores');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (295,'Floresta');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (296,'La Paternal');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (297,'Liniers');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (298,'Mataderos');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (299,'Monserrat');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (300,'Monte Castro');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (301,'Nueva Pompeya');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (302,'Nunez');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (303,'Palermo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (304,'Parque Avellaneda');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (305,'Parque Chacabuco');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (306,'Parque Chas');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (307,'Parque Patricios');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (308,'Puerto Madero');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (309,'Recoleta');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (310,'Retiro');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (311,'Saavedra');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (312,'San Cristobal');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (313,'San Nicolas');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (314,'San Telmo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (315,'Velez Sarsfield');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (316,'Versalles');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (317,'Villa Crespo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (318,'Villa del Parque');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (319,'Villa Devoto');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (320,'Villa Gral. Mitre');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (321,'Villa Lugano');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (322,'Villa Luro');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (323,'Villa Ortuzar');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (324,'Villa Pueyrredon');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (325,'Villa Real');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (326,'Villa Riachuelo');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (327,'Villa Santa Rita');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (328,'Villa Soldati');
insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (329,'Villa Urquiza');

/*Table structure for table `marca` */

DROP TABLE IF EXISTS `marca`;

CREATE TABLE `marca` (
  `marca_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_marca` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`marca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `marca` */

insert  into `marca`(`marca_id`,`nombre_marca`) values (1,' MARCA');
insert  into `marca`(`marca_id`,`nombre_marca`) values (2,'AGRALE');
insert  into `marca`(`marca_id`,`nombre_marca`) values (3,'ALFA ROMEO');
insert  into `marca`(`marca_id`,`nombre_marca`) values (4,'AUDI');
insert  into `marca`(`marca_id`,`nombre_marca`) values (5,'BMW');
insert  into `marca`(`marca_id`,`nombre_marca`) values (6,'CHERY');
insert  into `marca`(`marca_id`,`nombre_marca`) values (7,'CHEVROLET');
insert  into `marca`(`marca_id`,`nombre_marca`) values (8,'CHRYSLER');
insert  into `marca`(`marca_id`,`nombre_marca`) values (9,'CITROEN');
insert  into `marca`(`marca_id`,`nombre_marca`) values (10,'DACIA');
insert  into `marca`(`marca_id`,`nombre_marca`) values (11,'DAEWO');
insert  into `marca`(`marca_id`,`nombre_marca`) values (12,'DAIHATSU');
insert  into `marca`(`marca_id`,`nombre_marca`) values (13,'DODGE');
insert  into `marca`(`marca_id`,`nombre_marca`) values (14,'FERRARI');
insert  into `marca`(`marca_id`,`nombre_marca`) values (15,'FIAT');
insert  into `marca`(`marca_id`,`nombre_marca`) values (16,'FORD');
insert  into `marca`(`marca_id`,`nombre_marca`) values (17,'GALLOPER');
insert  into `marca`(`marca_id`,`nombre_marca`) values (18,'HEIBAO');
insert  into `marca`(`marca_id`,`nombre_marca`) values (19,'HONDA');
insert  into `marca`(`marca_id`,`nombre_marca`) values (20,'HYUNDAI');
insert  into `marca`(`marca_id`,`nombre_marca`) values (21,'ISUZU');
insert  into `marca`(`marca_id`,`nombre_marca`) values (22,'JAGUAR');
insert  into `marca`(`marca_id`,`nombre_marca`) values (23,'JEEP');
insert  into `marca`(`marca_id`,`nombre_marca`) values (24,'KIA');
insert  into `marca`(`marca_id`,`nombre_marca`) values (25,'LADA');
insert  into `marca`(`marca_id`,`nombre_marca`) values (26,'LAND ROVER');
insert  into `marca`(`marca_id`,`nombre_marca`) values (27,'LEXUS');
insert  into `marca`(`marca_id`,`nombre_marca`) values (28,'MASERATI');
insert  into `marca`(`marca_id`,`nombre_marca`) values (29,'MAZDA');
insert  into `marca`(`marca_id`,`nombre_marca`) values (30,'MERCEDES BENZ');
insert  into `marca`(`marca_id`,`nombre_marca`) values (31,'MG');
insert  into `marca`(`marca_id`,`nombre_marca`) values (32,'MINI');
insert  into `marca`(`marca_id`,`nombre_marca`) values (33,'MITSUBISHI');
insert  into `marca`(`marca_id`,`nombre_marca`) values (34,'NISSAN');
insert  into `marca`(`marca_id`,`nombre_marca`) values (35,'PEUGEOT');
insert  into `marca`(`marca_id`,`nombre_marca`) values (36,'PORSCHE');
insert  into `marca`(`marca_id`,`nombre_marca`) values (37,'RAM');
insert  into `marca`(`marca_id`,`nombre_marca`) values (38,'RENAULT');
insert  into `marca`(`marca_id`,`nombre_marca`) values (39,'ROVER');
insert  into `marca`(`marca_id`,`nombre_marca`) values (40,'SAAB');
insert  into `marca`(`marca_id`,`nombre_marca`) values (41,'SEAT');
insert  into `marca`(`marca_id`,`nombre_marca`) values (42,'SMART');
insert  into `marca`(`marca_id`,`nombre_marca`) values (43,'SSANGYONG');
insert  into `marca`(`marca_id`,`nombre_marca`) values (44,'SUBARU');
insert  into `marca`(`marca_id`,`nombre_marca`) values (45,'SUZUKI');
insert  into `marca`(`marca_id`,`nombre_marca`) values (46,'TATA');
insert  into `marca`(`marca_id`,`nombre_marca`) values (47,'TOYOTA');
insert  into `marca`(`marca_id`,`nombre_marca`) values (48,'VOLKSWAGEN');
insert  into `marca`(`marca_id`,`nombre_marca`) values (49,'VOLVO');

/*Table structure for table `modelo` */

DROP TABLE IF EXISTS `modelo`;

CREATE TABLE `modelo` (
  `modelo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_modelo` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `marca_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`modelo_id`),
  KEY `modelo_fk` (`marca_id`),
  CONSTRAINT `modelo_fk` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`marca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=398 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `modelo` */

insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (1,' MODELO',1);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (2,'MARRUA',2);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (3,'147',3);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (4,'156',3);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (5,'159',3);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (6,'166',3);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (7,'BRERA',3);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (8,'GIULIETTA',3);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (9,'GT',3);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (10,'GTV',3);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (11,'MITO',3);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (12,'SPIDER',3);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (13,'A1',4);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (14,'A3',4);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (15,'A4',4);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (16,'A5',4);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (17,'A6',4);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (18,'A7',4);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (19,'A8',4);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (20,'ALLROAD',4);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (21,'Q3',4);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (22,'Q5',4);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (23,'Q7',4);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (24,'R8',4);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (25,'TT',4);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (26,'SERIE1',5);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (27,'SERIE3',5);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (28,'SERIE5',5);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (29,'SERIE6',5);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (30,'SERIE7',5);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (31,'X1',5);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (32,'X3',5);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (33,'X5',5);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (34,'X6',5);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (35,'Z3',5);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (36,'Z4',5);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (37,'FACE',6);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (38,'FULWIN',6);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (39,'QQ',6);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (40,'SKIN',6);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (41,'TIGGO',6);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (42,'AGILE',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (43,'ASTRA',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (44,'ASTRA II',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (45,'AVALANCHE',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (46,'AVEO',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (47,'BLAZER',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (48,'CAMARO',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (49,'CAPTIVA',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (50,'CELTA',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (51,'CLASSIC',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (52,'COBALT',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (53,'CORSA',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (54,'CORSA CLASSIC',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (55,'CORSA II',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (56,'CORVETTE',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (57,'CRUZE',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (58,'MERIVA',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (59,'MONTANA',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (60,'ONIX',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (61,'PRISMA',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (62,'VECTRA',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (63,'S-10',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (64,'SILVERADO',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (65,'SONIC',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (66,'SPARK',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (67,'SPIN',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (68,'TRACKER',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (69,'TRAILBLAZER',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (70,'ZAFIRA',7);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (71,'300',8);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (72,'CARAVAN',8);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (73,'TOWN & COUNTRY',8);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (74,'GRAND CARAVAN',8);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (75,'CROSSFIRE',8);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (76,'NEON',8);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (77,'PT CRUISER',8);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (78,'SEBRIG',8);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (79,'BERLINGO',9);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (80,'C3',9);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (81,'C3 AIRCROSS',9);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (82,'C3 PICASSO',9);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (83,'C4 AIRCROSS',9);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (84,'C4 LOUNGE',9);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (85,'C4 PICASSO',9);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (86,'C4 GRAND PICASSO',9);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (87,'C5',9);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (88,'C6',9);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (89,'DS3',9);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (90,'DS4',9);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (91,'C15',9);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (92,'JUMPER',9);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (93,'SAXO',9);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (94,'XSARA',9);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (95,'XSARA PICASSO',9);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (96,'PICK-UP',10);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (97,'LANOS',11);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (98,'LEGANZA',11);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (99,'NUBIRA',11);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (100,'MATIZ',11);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (101,'TACUMA',11);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (102,'DAMAS',11);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (103,'LABO',11);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (104,'MOVE',12);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (105,'ROCKY',12);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (106,'SIRION',12);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (107,'TERIOS',12);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (108,'MIRA',12);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (109,'JOURNEY',13);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (110,'RAM',13);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (111,'360',14);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (112,'430',14);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (113,'456',14);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (114,'575',14);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (115,'599',14);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (116,'612',14);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (117,'CALIFORNIA',14);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (118,'SUPERAMERICA',14);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (119,'500',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (120,'BRAVA',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (121,'BRAVO',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (122,'DOBLO',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (123,'DUCATO',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (124,'FIORINO',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (125,'FIORINO QUBO',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (126,'IDEA',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (127,'LINEA',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (128,'MAREA',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (129,'PALIO',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (130,'PALIO ADVENTURE',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (131,'PUNTO',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (132,'QUBO',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (133,'SIENA',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (134,'GRAND SIENA',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (135,'STILO',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (136,'STRADA',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (137,'UNO',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (138,'UNO EVO',15);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (139,'COURIER',16);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (140,'ECOSPORT',16);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (141,'ECOSPORT KD',16);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (142,'ESCAPE',16);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (143,'F100',16);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (144,'FIESTA KD',16);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (145,'FIESTA',16);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (146,'FOCUS',16);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (147,'FOCUS III',16);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (148,'KA',16);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (149,'KUGA',16);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (150,'MONDEO',16);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (151,'RANGER',16);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (152,'S-MAX',16);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (153,'TRANSIT',16);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (154,'EXCEED',17);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (155,'HB',18);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (156,'ACCORD',19);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (157,'CITY',19);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (158,'CIVIC',19);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (159,'CRV',19);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (160,'FIT',19);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (161,'HRV',19);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (162,'LEGEND',19);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (163,'PILOT',19);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (164,'STREAM',19);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (165,'ACCENT',20);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (166,'ATOS PRIME',20);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (167,'COUPE',20);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (168,'ELANTRA',20);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (169,'I 10',20);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (170,'I 30',20);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (171,'MATRIX',20);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (172,'SANTA FE',20);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (173,'SONATA',20);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (174,'TERRACAN',20);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (175,'TRAJET',20);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (176,'TUCSON',20);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (177,'VELOSTER',20);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (178,'VERACRUZ',20);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (179,'AMIGO',21);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (180,'PICK-UP CABIAN SIMPL',21);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (181,'PICK-UP SPACE CAB',21);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (182,'PICK-UP CABINA DOBLE',21);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (183,'TROOPER',21);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (184,'X-TYPE',22);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (185,'XF',22);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (186,'F-TYPE',22);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (187,'S-TYPE',22);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (188,'XJ',22);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (189,'XK',22);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (190,'CHEROKEE',23);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (191,'COMPASS',23);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (192,'GRAND CHEROKEE',23);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (193,'PATRIOT',23);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (194,'WRANGLER',23);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (195,'CARENS',24);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (196,'CARNIVAL',24);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (197,'CERATO',24);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (198,'MAGENTIS',24);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (199,'MOHAVE',24);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (200,'OPIRUS',24);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (201,'PICANTO',24);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (202,'RIO',24);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (203,'RONDO',24);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (204,'SPORTAGE',24);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (205,'GRAND SPORTAGE',24);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (206,'SORENTO',24);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (207,'SOUL',24);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (208,'PREGIO',24);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (209,'AFALINA',25);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (210,'SAMARA',25);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (211,'DEFENDER',26);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (212,'DISCOVERY',26);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (213,'FREELANDER',26);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (214,'RANGE ROVER',26);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (215,'LS',27);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (216,'GS',27);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (217,'IS',27);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (218,'QUATTROPORTE',28);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (219,'COUPE',28);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (220,'GRAND TURISMO',28);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (221,'SPYDER',28);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (222,'323',29);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (223,'626',29);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (224,'MPV',29);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (225,'B 2500',29);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (226,'B 2900',29);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (227,'AMG',30);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (228,'CLASE A',30);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (229,'CLASE B',30);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (230,'CLASE C',30);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (231,'CLASE CL',30);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (232,'CLASE CLA',30);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (233,'CLASE CLC',30);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (234,'CLASE CLK',30);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (235,'CLASE CLS',30);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (236,'CLASE E',30);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (237,'CLASE G',30);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (238,'CLASE GL',30);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (239,'CLASE ML',30);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (240,'CLASE S',30);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (241,'CLASE SL',30);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (242,'CLASE SLK',30);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (243,'VIANO',30);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (244,'MGF',31);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (245,'COOPER',32);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (246,'CANTER',33);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (247,'L-200',33);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (248,'LANCER',33);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (249,'MONTERO',33);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (250,'NATIVA',33);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (251,'OUTLANDER',33);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (252,'350',34);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (253,'370Z',34);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (254,'PATHFINDER',34);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (255,'FRONTIER',34);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (256,'MARCH',34);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (257,'MURANO',34);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (258,'NP300',34);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (259,'PICK-UP',34);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (260,'SENTRA',34);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (261,'TEANA',34);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (262,'TERRANO II',34);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (263,'TIIDA',34);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (264,'VERSA',34);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (265,'X-TERRA',34);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (266,'X-TRAIL',34);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (267,'106',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (268,'206',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (269,'207',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (270,'208',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (271,'306',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (272,'307',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (273,'308',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (274,'3008',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (275,'405',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (276,'406',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (277,'407',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (278,'408',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (279,'4008',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (280,'508',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (281,'5008',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (282,'607',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (283,'806',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (284,'807',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (285,'RCZ',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (286,'EXPERT',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (287,'HOGGAR',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (288,'PARTNER',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (289,'BOXER',35);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (290,'911',36);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (291,'BOXSTER',36);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (292,'CAYENNE',36);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (293,'CAYMAN',36);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (294,'PANAMERA',36);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (295,'1500',37);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (296,'2500',37);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (297,'CLIO MIO',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (298,'CLIO L/NUEVA',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (299,'CLIO 2',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (300,'DUSTER',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (301,'FLUENCE',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (302,'KANGOO',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (303,'KANGOO FURGON',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (304,'KOLEOS',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (305,'LAGUNA',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (306,'LATITUDE',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (307,'LOGAN',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (308,'MEGANE',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (309,'MEGANE II',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (310,'MEGANE III',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (311,'SANDERO',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (312,'SANDERO STEPWAY',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (313,'SCENIC',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (314,'SYMBOL',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (315,'TWINGO',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (316,'TRAFIC',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (317,'MASTER',38);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (318,'LINEA 25',39);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (319,'LINEA 45',39);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (320,'LINEA 75',39);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (321,'LINEA 9.3',39);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (322,'LINEA 9.5',39);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (323,'ALHAMBRA',40);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (324,'ALTEA',40);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (325,'CORDOBA',40);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (326,'IBIZA',40);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (327,'INCA FURGON',40);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (328,'LEON',40);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (329,'TOLEDO',40);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (330,'FORTWO',41);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (331,'ACTYON',42);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (332,'KORANDO',42);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (333,'KYRON',42);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (334,'ISTANA',42);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (335,'MUSSO',42);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (336,'REXTON',42);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (337,'STAVIC',42);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (338,'IMPREZA',43);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (339,'LEGACY',43);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (340,'OUTBACK',43);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (341,'TRIBECA',43);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (342,'XV',43);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (343,'FORESTER',43);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (344,'FUN',44);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (345,'GRAND VITARA',44);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (346,'SWIFT',44);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (347,'JIMNY',44);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (348,'207 TELCOLINE',45);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (349,'SUMO',46);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (350,'86',47);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (351,'AVENSIS',47);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (352,'CAMRY',47);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (353,'COROLLA',47);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (354,'CORONA',47);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (355,'ETIOS',47);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (356,'ETIOS CROSS',47);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (357,'HILUX',47);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (358,'LAND CRUISER',47);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (359,'PRIUS',47);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (360,'RAV 4',47);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (361,'AMAROK',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (362,'BORA',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (363,'CADDY',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (364,'CROSSFOX',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (365,'FOX',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (366,'GOL',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (367,'GOL TREND',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (368,'GOLF',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (369,'MULTIVAN',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (370,'THE BEETLE',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (371,'NEW BEETLE',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (372,'PASSAT',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (373,'CC',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (374,'POLO',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (375,'SANTANA',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (376,'SAVEIRO',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (377,'SCIROCCO',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (378,'SHARAN',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (379,'SURAN',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (380,'TIGUAN',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (381,'TOUAREG',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (382,'TRANSPORTER',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (383,'UP',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (384,'VENTO',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (385,'VOYAGE',48);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (386,'C30',49);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (387,'C70',49);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (388,'S40',49);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (389,'S60',49);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (390,'S80',49);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (391,'V40',49);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (392,'V50',49);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (393,'V60',49);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (394,'V70',49);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (395,'XC60',49);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (396,'XC70',49);
insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (397,'XC90',49);

/*Table structure for table `ocupacion_usuario` */

DROP TABLE IF EXISTS `ocupacion_usuario`;

CREATE TABLE `ocupacion_usuario` (
  `viaje_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `desde` datetime DEFAULT NULL,
  `hasta` datetime DEFAULT NULL,
  KEY `ocupacion_usuario_fk1` (`viaje_id`),
  KEY `ocupacion_usuario_fk2` (`usuario_id`),
  CONSTRAINT `ocupacion_usuario_fk1` FOREIGN KEY (`viaje_id`) REFERENCES `viaje` (`viaje_id`),
  CONSTRAINT `ocupacion_usuario_fk2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ocupacion_usuario` */

/*Table structure for table `pasajero` */

DROP TABLE IF EXISTS `pasajero`;

CREATE TABLE `pasajero` (
  `pasajero_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_pasajero_id` int(11) NOT NULL,
  `viaje_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `monto_pagado` decimal(15,2) DEFAULT NULL,
  `tarjeta_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pasajero_id`),
  KEY `pasajero_fk1` (`tipo_pasajero_id`),
  KEY `pasajero_fk2` (`viaje_id`),
  KEY `pasajero_fk3` (`usuario_id`),
  KEY `pasakero_fk4` (`estado_id`),
  KEY `pasakero_fk5` (`tarjeta_id`),
  CONSTRAINT `pasajero_fk1` FOREIGN KEY (`tipo_pasajero_id`) REFERENCES `tipo_pasajero` (`tipo_pasajero_id`),
  CONSTRAINT `pasajero_fk2` FOREIGN KEY (`viaje_id`) REFERENCES `viaje` (`viaje_id`),
  CONSTRAINT `pasajero_fk3` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  CONSTRAINT `pasakero_fk4` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`estado_id`),
  CONSTRAINT `pasakero_fk5` FOREIGN KEY (`tarjeta_id`) REFERENCES `tarjeta_credito` (`id_tarjeta`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `pasajero` */

/*Table structure for table `pregunta_respuesta` */

DROP TABLE IF EXISTS `pregunta_respuesta`;

CREATE TABLE `pregunta_respuesta` (
  `pregunta_respuesta_id` int(11) NOT NULL AUTO_INCREMENT,
  `viaje_id` int(11) NOT NULL,
  `d_tipo` varchar(1) COLLATE latin1_spanish_ci DEFAULT 'P',
  `usuario_id` int(11) NOT NULL,
  `anotacion` varchar(500) COLLATE latin1_spanish_ci NOT NULL,
  `pregunta_original_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pregunta_respuesta_id`),
  KEY `pregunta_fk1` (`viaje_id`),
  KEY `pregunta_fk2` (`usuario_id`),
  KEY `pregunta_fk3` (`pregunta_original_id`),
  CONSTRAINT `pregunta_fk1` FOREIGN KEY (`viaje_id`) REFERENCES `viaje` (`viaje_id`),
  CONSTRAINT `pregunta_fk2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  CONSTRAINT `pregunta_fk3` FOREIGN KEY (`pregunta_original_id`) REFERENCES `pregunta_respuesta` (`pregunta_respuesta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `pregunta_respuesta` */

/*Table structure for table `tarjeta_credito` */

DROP TABLE IF EXISTS `tarjeta_credito`;

CREATE TABLE `tarjeta_credito` (
  `id_tarjeta` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `n_tarjeta` varchar(16) COLLATE latin1_spanish_ci NOT NULL,
  `d_nombre_titular` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `n_mes_vence` int(2) NOT NULL,
  `n_anio_vence` int(4) DEFAULT NULL,
  `n_codigo_verificador` varchar(3) COLLATE latin1_spanish_ci NOT NULL,
  `m_baja` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_tarjeta`),
  KEY `tarjeta_credito_fk` (`id_empresa`),
  CONSTRAINT `tarjeta_credito_fk` FOREIGN KEY (`id_empresa`) REFERENCES `empresa_tarjetas_credito` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `tarjeta_credito` */

insert  into `tarjeta_credito`(`id_tarjeta`,`usuario_id`,`id_empresa`,`n_tarjeta`,`d_nombre_titular`,`n_mes_vence`,`n_anio_vence`,`n_codigo_verificador`,`m_baja`) values (1,9,1,'2147483647','Nasdfkjabnf asfa',10,2018,'111',0);
insert  into `tarjeta_credito`(`id_tarjeta`,`usuario_id`,`id_empresa`,`n_tarjeta`,`d_nombre_titular`,`n_mes_vence`,`n_anio_vence`,`n_codigo_verificador`,`m_baja`) values (2,8,1,'2147483647','qwerty asfa',11,2019,'222',0);
insert  into `tarjeta_credito`(`id_tarjeta`,`usuario_id`,`id_empresa`,`n_tarjeta`,`d_nombre_titular`,`n_mes_vence`,`n_anio_vence`,`n_codigo_verificador`,`m_baja`) values (3,0,2,'2147483647','dsafdas',1,2018,'123',0);
insert  into `tarjeta_credito`(`id_tarjeta`,`usuario_id`,`id_empresa`,`n_tarjeta`,`d_nombre_titular`,`n_mes_vence`,`n_anio_vence`,`n_codigo_verificador`,`m_baja`) values (4,9,2,'2147483647','PP',1,2020,'123',0);
insert  into `tarjeta_credito`(`id_tarjeta`,`usuario_id`,`id_empresa`,`n_tarjeta`,`d_nombre_titular`,`n_mes_vence`,`n_anio_vence`,`n_codigo_verificador`,`m_baja`) values (5,9,2,'2147483647','PP2',3,2019,'123',0);
insert  into `tarjeta_credito`(`id_tarjeta`,`usuario_id`,`id_empresa`,`n_tarjeta`,`d_nombre_titular`,`n_mes_vence`,`n_anio_vence`,`n_codigo_verificador`,`m_baja`) values (6,9,2,'2147483647','PP3',3,2019,'123',0);
insert  into `tarjeta_credito`(`id_tarjeta`,`usuario_id`,`id_empresa`,`n_tarjeta`,`d_nombre_titular`,`n_mes_vence`,`n_anio_vence`,`n_codigo_verificador`,`m_baja`) values (7,9,2,'1234567891223456','PP5',2,2021,'123',0);
insert  into `tarjeta_credito`(`id_tarjeta`,`usuario_id`,`id_empresa`,`n_tarjeta`,`d_nombre_titular`,`n_mes_vence`,`n_anio_vence`,`n_codigo_verificador`,`m_baja`) values (8,9,1,'5646564656465646','FF',1,2019,'445',0);
insert  into `tarjeta_credito`(`id_tarjeta`,`usuario_id`,`id_empresa`,`n_tarjeta`,`d_nombre_titular`,`n_mes_vence`,`n_anio_vence`,`n_codigo_verificador`,`m_baja`) values (9,2,1,'1234567891234566','FF',1,2018,'123',0);
insert  into `tarjeta_credito`(`id_tarjeta`,`usuario_id`,`id_empresa`,`n_tarjeta`,`d_nombre_titular`,`n_mes_vence`,`n_anio_vence`,`n_codigo_verificador`,`m_baja`) values (10,4,2,'1234567891234566','FF',0,0,'555',0);

/*Table structure for table `tipo_de_viaje` */

DROP TABLE IF EXISTS `tipo_de_viaje`;

CREATE TABLE `tipo_de_viaje` (
  `tipo_viaje_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`tipo_viaje_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `tipo_de_viaje` */

insert  into `tipo_de_viaje`(`tipo_viaje_id`,`nombre`) values (1,'DIARIO');
insert  into `tipo_de_viaje`(`tipo_viaje_id`,`nombre`) values (2,'SEMANAL');
insert  into `tipo_de_viaje`(`tipo_viaje_id`,`nombre`) values (3,'OCASIONAL');

/*Table structure for table `tipo_pasajero` */

DROP TABLE IF EXISTS `tipo_pasajero`;

CREATE TABLE `tipo_pasajero` (
  `tipo_pasajero_id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_tipo` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`tipo_pasajero_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `tipo_pasajero` */

insert  into `tipo_pasajero`(`tipo_pasajero_id`,`descripcion_tipo`) values (1,'PILOTO');
insert  into `tipo_pasajero`(`tipo_pasajero_id`,`descripcion_tipo`) values (2,'COPILOTO');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `apellido` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `correo_electronico` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `clave` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `foto` blob,
  `m_baja` int(1) NOT NULL DEFAULT '0',
  `f_baja` date DEFAULT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `usuario` */

insert  into `usuario`(`usuario_id`,`nombre`,`apellido`,`fecha_nacimiento`,`correo_electronico`,`clave`,`foto`,`m_baja`,`f_baja`) values (-1,'TODOS','TODOS',NULL,'TODOS','tlccae2018',NULL,0,NULL);
insert  into `usuario`(`usuario_id`,`nombre`,`apellido`,`fecha_nacimiento`,`correo_electronico`,`clave`,`foto`,`m_baja`,`f_baja`) values (1,'registro','registro',NULL,'registro','tlccae2018',NULL,0,NULL);
insert  into `usuario`(`usuario_id`,`nombre`,`apellido`,`fecha_nacimiento`,`correo_electronico`,`clave`,`foto`,`m_baja`,`f_baja`) values (2,'Usu1','usu1','1973-11-11','1@1.com','1',NULL,0,NULL);
insert  into `usuario`(`usuario_id`,`nombre`,`apellido`,`fecha_nacimiento`,`correo_electronico`,`clave`,`foto`,`m_baja`,`f_baja`) values (3,'usu2','usu2','1973-11-11','2@2.com','2',NULL,0,NULL);
insert  into `usuario`(`usuario_id`,`nombre`,`apellido`,`fecha_nacimiento`,`correo_electronico`,`clave`,`foto`,`m_baja`,`f_baja`) values (4,'usu3','usu3','1973-11-11','3@3.com','3',NULL,0,NULL);

/*Table structure for table `vehiculo` */

DROP TABLE IF EXISTS `vehiculo`;

CREATE TABLE `vehiculo` (
  `vehiculo_id` int(11) NOT NULL AUTO_INCREMENT,
  `modelo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `cantidad_asientos` int(11) NOT NULL,
  `patente` varchar(7) COLLATE latin1_spanish_ci NOT NULL,
  `m_baja` int(1) NOT NULL DEFAULT '0',
  `f_baja` date DEFAULT NULL,
  PRIMARY KEY (`vehiculo_id`),
  KEY `vehiculo_fk1` (`modelo_id`),
  KEY `vehiculo_fk2` (`usuario_id`),
  CONSTRAINT `vehiculo_fk1` FOREIGN KEY (`modelo_id`) REFERENCES `modelo` (`modelo_id`),
  CONSTRAINT `vehiculo_fk2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `vehiculo` */

insert  into `vehiculo`(`vehiculo_id`,`modelo_id`,`usuario_id`,`cantidad_asientos`,`patente`,`m_baja`,`f_baja`) values (1,46,2,4,'AA',0,NULL);
insert  into `vehiculo`(`vehiculo_id`,`modelo_id`,`usuario_id`,`cantidad_asientos`,`patente`,`m_baja`,`f_baja`) values (2,100,4,4,'BB',0,NULL);
insert  into `vehiculo`(`vehiculo_id`,`modelo_id`,`usuario_id`,`cantidad_asientos`,`patente`,`m_baja`,`f_baja`) values (3,286,4,8,'CC',0,NULL);

/*Table structure for table `viaje` */

DROP TABLE IF EXISTS `viaje`;

CREATE TABLE `viaje` (
  `viaje_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `vehiculo_id` int(11) NOT NULL,
  `localidad_origen_id` int(11) NOT NULL,
  `localidad_destino_id` int(11) NOT NULL,
  `tipo_viaje_id` int(11) NOT NULL,
  `dia_semana` int(11) DEFAULT NULL,
  `fecha_salida` datetime DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `costo` decimal(15,2) NOT NULL,
  `m_baja` int(1) NOT NULL DEFAULT '0',
  `f_baja` date DEFAULT NULL,
  `m_cerrado` int(1) NOT NULL DEFAULT '0',
  `m_terminado` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`viaje_id`),
  KEY `viaje_fk1` (`vehiculo_id`),
  KEY `viaje_fk2` (`localidad_origen_id`),
  KEY `viaje_fk3` (`localidad_destino_id`),
  KEY `viaje_fk4` (`tipo_viaje_id`),
  KEY `viaje_fk5` (`usuario_id`),
  CONSTRAINT `viaje_fk1` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculo` (`vehiculo_id`),
  CONSTRAINT `viaje_fk2` FOREIGN KEY (`localidad_origen_id`) REFERENCES `localidad` (`localidad_id`),
  CONSTRAINT `viaje_fk3` FOREIGN KEY (`localidad_destino_id`) REFERENCES `localidad` (`localidad_id`),
  CONSTRAINT `viaje_fk4` FOREIGN KEY (`tipo_viaje_id`) REFERENCES `tipo_de_viaje` (`tipo_viaje_id`),
  CONSTRAINT `viaje_fk5` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `viaje` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

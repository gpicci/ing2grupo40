/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.21-MariaDB : Database - viajes
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`viajes` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci */;

USE `viajes`;

/*Table structure for table `calificacion` */

DROP TABLE IF EXISTS `calificacion`;

CREATE TABLE `calificacion` (
  `calificacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `viaje_id` int(11) NOT NULL,
  `usuario_evalua_id` int(11) NOT NULL,
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

/*Table structure for table `estado` */

DROP TABLE IF EXISTS `estado`;

CREATE TABLE `estado` (
  `estado_id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_estado` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`estado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `estado` */

insert  into `estado`(`estado_id`,`descripcion_estado`) values (1,'PENDIENTE'),(2,'APROBADO');

/*Table structure for table `localidad` */

DROP TABLE IF EXISTS `localidad`;

CREATE TABLE `localidad` (
  `localidad_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_localidad` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`localidad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=330 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `localidad` */

insert  into `localidad`(`localidad_id`,`nombre_localidad`) values (1,'25 de Mayo'),(2,'3 de febrero'),(3,'A. Alsina'),(4,'A. Gonzáles Cháves'),(5,'Aguas Verdes'),(6,'Alberti'),(7,'Arrecifes'),(8,'Ayacucho'),(9,'Azul'),(10,'Bahía Blanca'),(11,'Balcarce'),(12,'Baradero'),(13,'Benito Juárez'),(14,'Berisso'),(15,'Bolívar'),(16,'Bragado'),(17,'Brandsen'),(18,'Campana'),(19,'Cañuelas'),(20,'Capilla del Señor'),(21,'Capitán Sarmiento'),(22,'Carapachay'),(23,'Carhue'),(24,'Cariló'),(25,'Carlos Casares'),(26,'Carlos Tejedor'),(27,'Carmen de Areco'),(28,'Carmen de Patagones'),(29,'Castelli'),(30,'Chacabuco'),(31,'Chascomús'),(32,'Chivilcoy'),(33,'Colón'),(34,'Coronel Dorrego'),(35,'Coronel Pringles'),(36,'Coronel Rosales'),(37,'Coronel Suarez'),(38,'Costa Azul'),(39,'Costa Chica'),(40,'Costa del Este'),(41,'Costa Esmeralda'),(42,'Daireaux'),(43,'Darregueira'),(44,'Del Viso'),(45,'Dolores'),(46,'Don Torcuato'),(47,'Ensenada'),(48,'Escobar'),(49,'Exaltación de la Cruz'),(50,'Florentino Ameghino'),(51,'Garín'),(52,'Gral. Alvarado'),(53,'Gral. Alvear'),(54,'Gral. Arenales'),(55,'Gral. Belgrano'),(56,'Gral. Guido'),(57,'Gral. Lamadrid'),(58,'Gral. Las Heras'),(59,'Gral. Lavalle'),(60,'Gral. Madariaga'),(61,'Gral. Pacheco'),(62,'Gral. Paz'),(63,'Gral. Pinto'),(64,'Gral. Pueyrredón'),(65,'Gral. Rodríguez'),(66,'Gral. Viamonte'),(67,'Gral. Villegas'),(68,'Guaminí'),(69,'Guernica'),(70,'Hipólito Yrigoyen'),(71,'Ing. Maschwitz'),(72,'Junín'),(73,'La Plata'),(74,'Laprida'),(75,'Las Flores'),(76,'Las Toninas'),(77,'Leandro N. Alem'),(78,'Lincoln'),(79,'Loberia'),(80,'Lobos'),(81,'Los Cardales'),(82,'Los Toldos'),(83,'Lucila del Mar'),(84,'Luján'),(85,'Magdalena'),(86,'Maipú'),(87,'Mar Chiquita'),(88,'Mar de Ajó'),(89,'Mar de las Pampas'),(90,'Mar del Plata'),(91,'Mar del Tuyú'),(92,'Marcos Paz'),(93,'Mercedes'),(94,'Miramar'),(95,'Monte'),(96,'Monte Hermoso'),(97,'Munro'),(98,'Navarro'),(99,'Necochea'),(100,'Olavarría'),(101,'Partido de la Costa'),(102,'Pehuajó'),(103,'Pellegrini'),(104,'Pergamino'),(105,'Pigüé'),(106,'Pila'),(107,'Pilar'),(108,'Pinamar'),(109,'Pinar del Sol'),(110,'Polvorines'),(111,'Pte. Perón'),(112,'Puán'),(113,'Punta Indio'),(114,'Ramallo'),(115,'Rauch'),(116,'Rivadavia'),(117,'Rojas'),(118,'Roque Pérez'),(119,'Saavedra'),(120,'Saladillo'),(121,'Salliqueló'),(122,'Salto'),(123,'San Andrés de Giles'),(124,'San Antonio de Areco'),(125,'San Antonio de Padua'),(126,'San Bernardo'),(127,'San Cayetano'),(128,'San Clemente del Tuyú'),(129,'San Nicolás'),(130,'San Pedro'),(131,'San Vicente'),(132,'Santa Teresita'),(133,'Suipacha'),(134,'Tandil'),(135,'Tapalqué'),(136,'Tordillo'),(137,'Tornquist'),(138,'Trenque Lauquen'),(139,'Tres Lomas'),(140,'Villa Gesell'),(141,'Villarino'),(142,'Zárate'),(143,'11 de Septiembre'),(144,'20 de Junio'),(145,'25 de Mayo'),(146,'Acassuso'),(147,'Adrogué'),(148,'Aldo Bonzi'),(149,'Área Reserva Cinturón Ecológico'),(150,'Avellaneda'),(151,'Banfield'),(152,'Barrio Parque'),(153,'Barrio Santa Teresita'),(154,'Beccar'),(155,'Bella Vista'),(156,'Berazategui'),(157,'Bernal Este'),(158,'Bernal Oeste'),(159,'Billinghurst'),(160,'Boulogne'),(161,'Burzaco'),(162,'Carapachay'),(163,'Caseros'),(164,'Castelar'),(165,'Churruca'),(166,'Ciudad Evita'),(167,'Ciudad Madero'),(168,'Ciudadela'),(169,'Claypole'),(170,'Crucecita'),(171,'Dock Sud'),(172,'Don Bosco'),(173,'Don Orione'),(174,'El Jagüel'),(175,'El Libertador'),(176,'El Palomar'),(177,'El Tala'),(178,'El Trébol'),(179,'Ezeiza'),(180,'Ezpeleta'),(181,'Florencio Varela'),(182,'Florida'),(183,'Francisco Álvarez'),(184,'Gerli'),(185,'Glew'),(186,'González Catán'),(187,'Gral. Lamadrid'),(188,'Grand Bourg'),(189,'Gregorio de Laferrere'),(190,'Guillermo Enrique Hudson'),(191,'Haedo'),(192,'Hurlingham'),(193,'Ing. Sourdeaux'),(194,'Isidro Casanova'),(195,'Ituzaingó'),(196,'José C. Paz'),(197,'José Ingenieros'),(198,'José Marmol'),(199,'La Lucila'),(200,'La Reja'),(201,'La Tablada'),(202,'Lanús'),(203,'Llavallol'),(204,'Loma Hermosa'),(205,'Lomas de Zamora'),(206,'Lomas del Millón'),(207,'Lomas del Mirador'),(208,'Longchamps'),(209,'Los Polvorines'),(210,'Luis Guillón'),(211,'Malvinas Argentinas'),(212,'Martín Coronado'),(213,'Martínez'),(214,'Merlo'),(215,'Ministro Rivadavia'),(216,'Monte Chingolo'),(217,'Monte Grande'),(218,'Moreno'),(219,'Morón'),(220,'Muñiz'),(221,'Olivos'),(222,'Pablo Nogués'),(223,'Pablo Podestá'),(224,'Paso del Rey'),(225,'Pereyra'),(226,'Piñeiro'),(227,'Plátanos'),(228,'Pontevedra'),(229,'Quilmes'),(230,'Rafael Calzada'),(231,'Rafael Castillo'),(232,'Ramos Mejía'),(233,'Ranelagh'),(234,'Remedios de Escalada'),(235,'Sáenz Peña'),(236,'San Antonio de Padua'),(237,'San Fernando'),(238,'San Francisco Solano'),(239,'San Isidro'),(240,'San José'),(241,'San Justo'),(242,'San Martín'),(243,'San Miguel'),(244,'Santos Lugares'),(245,'Sarandí'),(246,'Sourigues'),(247,'Tapiales'),(248,'Temperley'),(249,'Tigre'),(250,'Tortuguitas'),(251,'Tristán Suárez'),(252,'Trujui'),(253,'Turdera'),(254,'Valentín Alsina'),(255,'Vicente López'),(256,'Villa Adelina'),(257,'Villa Ballester'),(258,'Villa Bosch'),(259,'Villa Caraza'),(260,'Villa Celina'),(261,'Villa Centenario'),(262,'Villa de Mayo'),(263,'Villa Diamante'),(264,'Villa Domínico'),(265,'Villa España'),(266,'Villa Fiorito'),(267,'Villa Guillermina'),(268,'Villa Insuperable'),(269,'Villa José León Suárez'),(270,'Villa La Florida'),(271,'Villa Luzuriaga'),(272,'Villa Martelli'),(273,'Villa Obrera'),(274,'Villa Progreso'),(275,'Villa Raffo'),(276,'Villa Sarmiento'),(277,'Villa Tesei'),(278,'Villa Udaondo'),(279,'Virrey del Pino'),(280,'Wilde'),(281,'William Morris'),(282,'Agronomía'),(283,'Almagro'),(284,'Balvanera'),(285,'Barracas'),(286,'Belgrano'),(287,'Boca'),(288,'Boedo'),(289,'Caballito'),(290,'Chacarita'),(291,'Coghlan'),(292,'Colegiales'),(293,'Constitución'),(294,'Flores'),(295,'Floresta'),(296,'La Paternal'),(297,'Liniers'),(298,'Mataderos'),(299,'Monserrat'),(300,'Monte Castro'),(301,'Nueva Pompeya'),(302,'Núñez'),(303,'Palermo'),(304,'Parque Avellaneda'),(305,'Parque Chacabuco'),(306,'Parque Chas'),(307,'Parque Patricios'),(308,'Puerto Madero'),(309,'Recoleta'),(310,'Retiro'),(311,'Saavedra'),(312,'San Cristóbal'),(313,'San Nicolás'),(314,'San Telmo'),(315,'Vélez Sársfield'),(316,'Versalles'),(317,'Villa Crespo'),(318,'Villa del Parque'),(319,'Villa Devoto'),(320,'Villa Gral. Mitre'),(321,'Villa Lugano'),(322,'Villa Luro'),(323,'Villa Ortúzar'),(324,'Villa Pueyrredón'),(325,'Villa Real'),(326,'Villa Riachuelo'),(327,'Villa Santa Rita'),(328,'Villa Soldati'),(329,'Villa Urquiza');

/*Table structure for table `marca` */

DROP TABLE IF EXISTS `marca`;

CREATE TABLE `marca` (
  `marca_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_marca` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`marca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `marca` */

insert  into `marca`(`marca_id`,`nombre_marca`) values (1,' MARCA'),(2,'AGRALE'),(3,'ALFA ROMEO'),(4,'AUDI'),(5,'BMW'),(6,'CHERY'),(7,'CHEVROLET'),(8,'CHRYSLER'),(9,'CITROEN'),(10,'DACIA'),(11,'DAEWO'),(12,'DAIHATSU'),(13,'DODGE'),(14,'FERRARI'),(15,'FIAT'),(16,'FORD'),(17,'GALLOPER'),(18,'HEIBAO'),(19,'HONDA'),(20,'HYUNDAI'),(21,'ISUZU'),(22,'JAGUAR'),(23,'JEEP'),(24,'KIA'),(25,'LADA'),(26,'LAND ROVER'),(27,'LEXUS'),(28,'MASERATI'),(29,'MAZDA'),(30,'MERCEDES BENZ'),(31,'MG'),(32,'MINI'),(33,'MITSUBISHI'),(34,'NISSAN'),(35,'PEUGEOT'),(36,'PORSCHE'),(37,'RAM'),(38,'RENAULT'),(39,'ROVER'),(40,'SAAB'),(41,'SEAT'),(42,'SMART'),(43,'SSANGYONG'),(44,'SUBARU'),(45,'SUZUKI'),(46,'TATA'),(47,'TOYOTA'),(48,'VOLKSWAGEN'),(49,'VOLVO');

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

insert  into `modelo`(`modelo_id`,`nombre_modelo`,`marca_id`) values (1,' MODELO',1),(2,'MARRUA',2),(3,'147',3),(4,'156',3),(5,'159',3),(6,'166',3),(7,'BRERA',3),(8,'GIULIETTA',3),(9,'GT',3),(10,'GTV',3),(11,'MITO',3),(12,'SPIDER',3),(13,'A1',4),(14,'A3',4),(15,'A4',4),(16,'A5',4),(17,'A6',4),(18,'A7',4),(19,'A8',4),(20,'ALLROAD',4),(21,'Q3',4),(22,'Q5',4),(23,'Q7',4),(24,'R8',4),(25,'TT',4),(26,'SERIE1',5),(27,'SERIE3',5),(28,'SERIE5',5),(29,'SERIE6',5),(30,'SERIE7',5),(31,'X1',5),(32,'X3',5),(33,'X5',5),(34,'X6',5),(35,'Z3',5),(36,'Z4',5),(37,'FACE',6),(38,'FULWIN',6),(39,'QQ',6),(40,'SKIN',6),(41,'TIGGO',6),(42,'AGILE',7),(43,'ASTRA',7),(44,'ASTRA II',7),(45,'AVALANCHE',7),(46,'AVEO',7),(47,'BLAZER',7),(48,'CAMARO',7),(49,'CAPTIVA',7),(50,'CELTA',7),(51,'CLASSIC',7),(52,'COBALT',7),(53,'CORSA',7),(54,'CORSA CLASSIC',7),(55,'CORSA II',7),(56,'CORVETTE',7),(57,'CRUZE',7),(58,'MERIVA',7),(59,'MONTANA',7),(60,'ONIX',7),(61,'PRISMA',7),(62,'VECTRA',7),(63,'S-10',7),(64,'SILVERADO',7),(65,'SONIC',7),(66,'SPARK',7),(67,'SPIN',7),(68,'TRACKER',7),(69,'TRAILBLAZER',7),(70,'ZAFIRA',7),(71,'300',8),(72,'CARAVAN',8),(73,'TOWN & COUNTRY',8),(74,'GRAND CARAVAN',8),(75,'CROSSFIRE',8),(76,'NEON',8),(77,'PT CRUISER',8),(78,'SEBRIG',8),(79,'BERLINGO',9),(80,'C3',9),(81,'C3 AIRCROSS',9),(82,'C3 PICASSO',9),(83,'C4 AIRCROSS',9),(84,'C4 LOUNGE',9),(85,'C4 PICASSO',9),(86,'C4 GRAND PICASSO',9),(87,'C5',9),(88,'C6',9),(89,'DS3',9),(90,'DS4',9),(91,'C15',9),(92,'JUMPER',9),(93,'SAXO',9),(94,'XSARA',9),(95,'XSARA PICASSO',9),(96,'PICK-UP',10),(97,'LANOS',11),(98,'LEGANZA',11),(99,'NUBIRA',11),(100,'MATIZ',11),(101,'TACUMA',11),(102,'DAMAS',11),(103,'LABO',11),(104,'MOVE',12),(105,'ROCKY',12),(106,'SIRION',12),(107,'TERIOS',12),(108,'MIRA',12),(109,'JOURNEY',13),(110,'RAM',13),(111,'360',14),(112,'430',14),(113,'456',14),(114,'575',14),(115,'599',14),(116,'612',14),(117,'CALIFORNIA',14),(118,'SUPERAMERICA',14),(119,'500',15),(120,'BRAVA',15),(121,'BRAVO',15),(122,'DOBLO',15),(123,'DUCATO',15),(124,'FIORINO',15),(125,'FIORINO QUBO',15),(126,'IDEA',15),(127,'LINEA',15),(128,'MAREA',15),(129,'PALIO',15),(130,'PALIO ADVENTURE',15),(131,'PUNTO',15),(132,'QUBO',15),(133,'SIENA',15),(134,'GRAND SIENA',15),(135,'STILO',15),(136,'STRADA',15),(137,'UNO',15),(138,'UNO EVO',15),(139,'COURIER',16),(140,'ECOSPORT',16),(141,'ECOSPORT KD',16),(142,'ESCAPE',16),(143,'F100',16),(144,'FIESTA KD',16),(145,'FIESTA',16),(146,'FOCUS',16),(147,'FOCUS III',16),(148,'KA',16),(149,'KUGA',16),(150,'MONDEO',16),(151,'RANGER',16),(152,'S-MAX',16),(153,'TRANSIT',16),(154,'EXCEED',17),(155,'HB',18),(156,'ACCORD',19),(157,'CITY',19),(158,'CIVIC',19),(159,'CRV',19),(160,'FIT',19),(161,'HRV',19),(162,'LEGEND',19),(163,'PILOT',19),(164,'STREAM',19),(165,'ACCENT',20),(166,'ATOS PRIME',20),(167,'COUPE',20),(168,'ELANTRA',20),(169,'I 10',20),(170,'I 30',20),(171,'MATRIX',20),(172,'SANTA FE',20),(173,'SONATA',20),(174,'TERRACAN',20),(175,'TRAJET',20),(176,'TUCSON',20),(177,'VELOSTER',20),(178,'VERACRUZ',20),(179,'AMIGO',21),(180,'PICK-UP CABIAN SIMPL',21),(181,'PICK-UP SPACE CAB',21),(182,'PICK-UP CABINA DOBLE',21),(183,'TROOPER',21),(184,'X-TYPE',22),(185,'XF',22),(186,'F-TYPE',22),(187,'S-TYPE',22),(188,'XJ',22),(189,'XK',22),(190,'CHEROKEE',23),(191,'COMPASS',23),(192,'GRAND CHEROKEE',23),(193,'PATRIOT',23),(194,'WRANGLER',23),(195,'CARENS',24),(196,'CARNIVAL',24),(197,'CERATO',24),(198,'MAGENTIS',24),(199,'MOHAVE',24),(200,'OPIRUS',24),(201,'PICANTO',24),(202,'RIO',24),(203,'RONDO',24),(204,'SPORTAGE',24),(205,'GRAND SPORTAGE',24),(206,'SORENTO',24),(207,'SOUL',24),(208,'PREGIO',24),(209,'AFALINA',25),(210,'SAMARA',25),(211,'DEFENDER',26),(212,'DISCOVERY',26),(213,'FREELANDER',26),(214,'RANGE ROVER',26),(215,'LS',27),(216,'GS',27),(217,'IS',27),(218,'QUATTROPORTE',28),(219,'COUPE',28),(220,'GRAND TURISMO',28),(221,'SPYDER',28),(222,'323',29),(223,'626',29),(224,'MPV',29),(225,'B 2500',29),(226,'B 2900',29),(227,'AMG',30),(228,'CLASE A',30),(229,'CLASE B',30),(230,'CLASE C',30),(231,'CLASE CL',30),(232,'CLASE CLA',30),(233,'CLASE CLC',30),(234,'CLASE CLK',30),(235,'CLASE CLS',30),(236,'CLASE E',30),(237,'CLASE G',30),(238,'CLASE GL',30),(239,'CLASE ML',30),(240,'CLASE S',30),(241,'CLASE SL',30),(242,'CLASE SLK',30),(243,'VIANO',30),(244,'MGF',31),(245,'COOPER',32),(246,'CANTER',33),(247,'L-200',33),(248,'LANCER',33),(249,'MONTERO',33),(250,'NATIVA',33),(251,'OUTLANDER',33),(252,'350',34),(253,'370Z',34),(254,'PATHFINDER',34),(255,'FRONTIER',34),(256,'MARCH',34),(257,'MURANO',34),(258,'NP300',34),(259,'PICK-UP',34),(260,'SENTRA',34),(261,'TEANA',34),(262,'TERRANO II',34),(263,'TIIDA',34),(264,'VERSA',34),(265,'X-TERRA',34),(266,'X-TRAIL',34),(267,'106',35),(268,'206',35),(269,'207',35),(270,'208',35),(271,'306',35),(272,'307',35),(273,'308',35),(274,'3008',35),(275,'405',35),(276,'406',35),(277,'407',35),(278,'408',35),(279,'4008',35),(280,'508',35),(281,'5008',35),(282,'607',35),(283,'806',35),(284,'807',35),(285,'RCZ',35),(286,'EXPERT',35),(287,'HOGGAR',35),(288,'PARTNER',35),(289,'BOXER',35),(290,'911',36),(291,'BOXSTER',36),(292,'CAYENNE',36),(293,'CAYMAN',36),(294,'PANAMERA',36),(295,'1500',37),(296,'2500',37),(297,'CLIO MIO',38),(298,'CLIO L/NUEVA',38),(299,'CLIO 2',38),(300,'DUSTER',38),(301,'FLUENCE',38),(302,'KANGOO',38),(303,'KANGOO FURGON',38),(304,'KOLEOS',38),(305,'LAGUNA',38),(306,'LATITUDE',38),(307,'LOGAN',38),(308,'MEGANE',38),(309,'MEGANE II',38),(310,'MEGANE III',38),(311,'SANDERO',38),(312,'SANDERO STEPWAY',38),(313,'SCENIC',38),(314,'SYMBOL',38),(315,'TWINGO',38),(316,'TRAFIC',38),(317,'MASTER',38),(318,'LINEA 25',39),(319,'LINEA 45',39),(320,'LINEA 75',39),(321,'LINEA 9.3',39),(322,'LINEA 9.5',39),(323,'ALHAMBRA',40),(324,'ALTEA',40),(325,'CORDOBA',40),(326,'IBIZA',40),(327,'INCA FURGON',40),(328,'LEON',40),(329,'TOLEDO',40),(330,'FORTWO',41),(331,'ACTYON',42),(332,'KORANDO',42),(333,'KYRON',42),(334,'ISTANA',42),(335,'MUSSO',42),(336,'REXTON',42),(337,'STAVIC',42),(338,'IMPREZA',43),(339,'LEGACY',43),(340,'OUTBACK',43),(341,'TRIBECA',43),(342,'XV',43),(343,'FORESTER',43),(344,'FUN',44),(345,'GRAND VITARA',44),(346,'SWIFT',44),(347,'JIMNY',44),(348,'207 TELCOLINE',45),(349,'SUMO',46),(350,'86',47),(351,'AVENSIS',47),(352,'CAMRY',47),(353,'COROLLA',47),(354,'CORONA',47),(355,'ETIOS',47),(356,'ETIOS CROSS',47),(357,'HILUX',47),(358,'LAND CRUISER',47),(359,'PRIUS',47),(360,'RAV 4',47),(361,'AMAROK',48),(362,'BORA',48),(363,'CADDY',48),(364,'CROSSFOX',48),(365,'FOX',48),(366,'GOL',48),(367,'GOL TREND',48),(368,'GOLF',48),(369,'MULTIVAN',48),(370,'THE BEETLE',48),(371,'NEW BEETLE',48),(372,'PASSAT',48),(373,'CC',48),(374,'POLO',48),(375,'SANTANA',48),(376,'SAVEIRO',48),(377,'SCIROCCO',48),(378,'SHARAN',48),(379,'SURAN',48),(380,'TIGUAN',48),(381,'TOUAREG',48),(382,'TRANSPORTER',48),(383,'UP',48),(384,'VENTO',48),(385,'VOYAGE',48),(386,'C30',49),(387,'C70',49),(388,'S40',49),(389,'S60',49),(390,'S80',49),(391,'V40',49),(392,'V50',49),(393,'V60',49),(394,'V70',49),(395,'XC60',49),(396,'XC70',49),(397,'XC90',49);

/*Table structure for table `pasajero` */

DROP TABLE IF EXISTS `pasajero`;

CREATE TABLE `pasajero` (
  `pasajero_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_pasajero_id` int(11) NOT NULL,
  `viaje_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `monto_pagado` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`pasajero_id`),
  KEY `pasajero_fk1` (`tipo_pasajero_id`),
  KEY `pasajero_fk2` (`viaje_id`),
  KEY `pasajero_fk3` (`usuario_id`),
  KEY `pasakero_fk4` (`estado_id`),
  CONSTRAINT `pasajero_fk1` FOREIGN KEY (`tipo_pasajero_id`) REFERENCES `tipo_pasajero` (`tipo_pasajero_id`),
  CONSTRAINT `pasajero_fk2` FOREIGN KEY (`viaje_id`) REFERENCES `viaje` (`viaje_id`),
  CONSTRAINT `pasajero_fk3` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  CONSTRAINT `pasakero_fk4` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`estado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `pasajero` */

/*Table structure for table `pregunta` */

DROP TABLE IF EXISTS `pregunta`;

CREATE TABLE `pregunta` (
  `pregunta_id` int(11) NOT NULL AUTO_INCREMENT,
  `viaje_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `pregunta` varchar(500) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`pregunta_id`),
  KEY `pregunta_fk1` (`viaje_id`),
  KEY `pregunta_fk2` (`usuario_id`),
  CONSTRAINT `pregunta_fk1` FOREIGN KEY (`viaje_id`) REFERENCES `viaje` (`viaje_id`),
  CONSTRAINT `pregunta_fk2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `pregunta` */

/*Table structure for table `tipo_de_viaje` */

DROP TABLE IF EXISTS `tipo_de_viaje`;

CREATE TABLE `tipo_de_viaje` (
  `tipo_viaje_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`tipo_viaje_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `tipo_de_viaje` */

insert  into `tipo_de_viaje`(`tipo_viaje_id`,`nombre`) values (1,'DIARIO'),(2,'SEMANAL'),(3,'OCASIONAL');

/*Table structure for table `tipo_pasajero` */

DROP TABLE IF EXISTS `tipo_pasajero`;

CREATE TABLE `tipo_pasajero` (
  `tipo_pasajero_id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_tipo` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`tipo_pasajero_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `tipo_pasajero` */

insert  into `tipo_pasajero`(`tipo_pasajero_id`,`descripcion_tipo`) values (1,'PILOTO'),(2,'COPILOTO');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `usuario` */

insert  into `usuario`(`usuario_id`,`nombre`,`apellido`,`fecha_nacimiento`,`correo_electronico`,`clave`,`foto`,`m_baja`,`f_baja`) values (1,'Registro','Registro','0000-00-00','registro','tlccae2018',NULL,0,NULL),(3,'Federico','Guillemet','0000-00-00','1','1',NULL,0,NULL),(4,'Federico','Guillemet','2000-11-11','2','2',NULL,0,NULL),(6,'Federico','Guillemet','2000-11-11','3','3',NULL,0,NULL),(7,'Federico','Guillemet','2018-05-20','4','4',NULL,0,NULL),(8,'5','5','2007-05-20','5','5',NULL,0,NULL),(9,'6','6','2015-05-03','6','6',NULL,0,NULL),(10,'','','0000-00-00','','',NULL,0,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `vehiculo` */

insert  into `vehiculo`(`vehiculo_id`,`modelo_id`,`usuario_id`,`cantidad_asientos`,`patente`,`m_baja`,`f_baja`) values (1,5,9,4,'AA',0,'0000-00-00'),(2,14,9,3,'BB',0,NULL);

/*Table structure for table `viaje` */

DROP TABLE IF EXISTS `viaje`;

CREATE TABLE `viaje` (
  `viaje_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `vechiculo_id` int(11) NOT NULL,
  `localidad_origen_id` int(11) NOT NULL,
  `localidad_destino_id` int(11) NOT NULL,
  `tipo_viaje_id` int(11) NOT NULL,
  `dia_semana` int(11) DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `costo` decimal(15,2) NOT NULL,
  `m_baja` int(1) NOT NULL DEFAULT '0',
  `f_baja` date DEFAULT NULL,
  PRIMARY KEY (`viaje_id`),
  KEY `viaje_fk1` (`vechiculo_id`),
  KEY `viaje_fk2` (`localidad_origen_id`),
  KEY `viaje_fk3` (`localidad_destino_id`),
  KEY `viaje_fk4` (`tipo_viaje_id`),
  KEY `viaje_fk5` (`usuario_id`),
  CONSTRAINT `viaje_fk1` FOREIGN KEY (`vechiculo_id`) REFERENCES `vehiculo` (`vehiculo_id`),
  CONSTRAINT `viaje_fk2` FOREIGN KEY (`localidad_origen_id`) REFERENCES `localidad` (`localidad_id`),
  CONSTRAINT `viaje_fk3` FOREIGN KEY (`localidad_destino_id`) REFERENCES `localidad` (`localidad_id`),
  CONSTRAINT `viaje_fk4` FOREIGN KEY (`tipo_viaje_id`) REFERENCES `tipo_de_viaje` (`tipo_viaje_id`),
  CONSTRAINT `viaje_fk5` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `viaje` */

insert  into `viaje`(`viaje_id`,`usuario_id`,`vechiculo_id`,`localidad_origen_id`,`localidad_destino_id`,`tipo_viaje_id`,`dia_semana`,`fecha_salida`,`duracion`,`costo`,`m_baja`,`f_baja`) values (1,9,1,1,2,1,1,NULL,30,'159.00',0,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

CREATE TABLE tipo_pasajero (
  tipo_pasajero_id INT NOT NULL AUTO_INCREMENT,
  descripcion_tipo VARCHAR(20) NOT NULL,
  PRIMARY KEY (tipo_pasajero_id)  
) ENGINE=INNODB;


CREATE TABLE localidad (
  localidad_id INT NOT NULL AUTO_INCREMENT,
  nombre_localidad VARCHAR(50) NOT NULL,
  PRIMARY KEY (localidad_id)  
) ENGINE=INNODB;

CREATE TABLE tipo_de_viaje (
  tipo_viaje_id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(20) NOT NULL,
  PRIMARY KEY (tipo_viaje_id)  
) ENGINE=INNODB;

CREATE TABLE estado (
  estado_id INT NOT NULL AUTO_INCREMENT,
  descripcion_estado VARCHAR(20) NOT NULL,
  PRIMARY KEY (estado_id)  
) ENGINE=INNODB;

CREATE TABLE marca (
  marca_id INT NOT NULL AUTO_INCREMENT,
  nombre_marca VARCHAR(20) NOT NULL,
  PRIMARY KEY (marca_id)  
) ENGINE=INNODB;

CREATE TABLE modelo (
  modelo_id INT NOT NULL AUTO_INCREMENT,
  marca_id INT,
  nombre_modelo VARCHAR(50) NOT NULL,
  PRIMARY KEY (modelo_id)  
) ENGINE=INNODB;

ALTER TABLE modelo
  ADD CONSTRAINT modelo_fk FOREIGN KEY (marca_id) REFERENCES marca(marca_id);
  
CREATE TABLE usuario (
  usuario_id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(30) NOT NULL,
  apellido VARCHAR(30) NOT NULL,
  fecha_nacimiento DATE,
  correo_electronico VARCHAR(50) NOT NULL,
  clave VARCHAR(10) NOT NULL,
  foto BLOB,
  PRIMARY KEY (usuario_id)  
) ENGINE=INNODB;
  
CREATE TABLE vehiculo (
  vehiculo_id INT NOT NULL AUTO_INCREMENT,
  modelo_id INT NOT NULL,
  usuario_id INT NOT NULL,
  cantidad_asientos INT NOT NULL,
  patente VARCHAR(7) NOT NULL,
  PRIMARY KEY (vehiculo_id)  
) ENGINE=INNODB;
  
ALTER TABLE vehiculo  
  ADD CONSTRAINT vehiculo_fk1 FOREIGN KEY (modelo_id) REFERENCES modelo(modelo_id),
  ADD CONSTRAINT vehiculo_fk2 FOREIGN KEY (usuario_id) REFERENCES usuario(usuario_id);
  

CREATE TABLE viaje (
  viaje_id INT NOT NULL AUTO_INCREMENT,
  vechiculo_id INT NOT NULL,
  localidad_origen_id INT NOT NULL,
  localidad_destino_id INT NOT NULL,
  tipo_viaje_id INT NOT NULL,
  dia_semana INT,
  fecha_salida DATE,
  duracion INT,
  costo DECIMAL(15,2) NOT NULL,
  PRIMARY KEY (viaje_id)  
) ENGINE=INNODB;

ALTER TABLE viaje  
  ADD CONSTRAINT viaje_fk1 FOREIGN KEY (vechiculo_id) REFERENCES vehiculo(vehiculo_id),
  ADD CONSTRAINT viaje_fk2 FOREIGN KEY (localidad_origen_id) REFERENCES localidad(localidad_id),
  ADD CONSTRAINT viaje_fk3 FOREIGN KEY (localidad_destino_id) REFERENCES localidad(localidad_id),
  ADD CONSTRAINT viaje_fk4 FOREIGN KEY (tipo_viaje_id) REFERENCES tipo_de_viaje(tipo_viaje_id);

CREATE TABLE pasajero (
  pasajero_id INT NOT NULL AUTO_INCREMENT,
  viaje_id INT NOT NULL,
  usuario_id INT NOT NULL,
  estado_id INT NOT NULL,
  monto_pagado DECIMAL(15,2),
  tipo_pasajero_id INT NOT NULL,
  PRIMARY KEY (pasajero_id)  
) ENGINE=INNODB;

ALTER TABLE pasajero   
  CHANGE tipo_pasajero_id tipo_pasajero_id INT(11) NOT NULL  AFTER pasajero_id,
  CHANGE viaje_id viaje_id INT(11) NOT NULL  AFTER tipo_pasajero_id;

ALTER TABLE pasajero  
  ADD CONSTRAINT pasajero_fk1 FOREIGN KEY (tipo_pasajero_id) REFERENCES tipo_pasajero(tipo_pasajero_id),
  ADD CONSTRAINT pasajero_fk2 FOREIGN KEY (viaje_id) REFERENCES viaje(viaje_id),
  ADD CONSTRAINT pasajero_fk3 FOREIGN KEY (usuario_id) REFERENCES usuario(usuario_id),
  ADD CONSTRAINT pasakero_fk4 FOREIGN KEY (estado_id) REFERENCES estado(estado_id);

CREATE TABLE pregunta (
  pregunta_id INT NOT NULL AUTO_INCREMENT,
  viaje_id INT NOT NULL,
  usuario_id INT NOT NULL,
  pregunta VARCHAR(500) NOT NULL,
  PRIMARY KEY (pregunta_id)  
) ENGINE=INNODB;

ALTER TABLE pregunta  
  ADD CONSTRAINT pregunta_fk1 FOREIGN KEY (viaje_id) REFERENCES viaje(viaje_id),
  ADD CONSTRAINT pregunta_fk2 FOREIGN KEY (usuario_id) REFERENCES usuario(usuario_id);


CREATE TABLE calificacion (
  calificacion_id INT NOT NULL AUTO_INCREMENT,
  viaje_id INT NOT NULL,
  usuario_evalua_id INT NOT NULL,
  usuario_evaluado_id INT NOT NULL,
  puntaje INT NOT NULL,
  comentario VARCHAR(500) NOT NULL,
  PRIMARY KEY (calificacion_id)  
) ENGINE=INNODB;

ALTER TABLE calificacion  
  ADD CONSTRAINT calificacion_fk1 FOREIGN KEY (viaje_id) REFERENCES viaje(viaje_id),
  ADD CONSTRAINT calificacion_fk2 FOREIGN KEY (usuario_evalua_id) REFERENCES usuario(usuario_id),
  ADD CONSTRAINT calificacion_fk3 FOREIGN KEY (usuario_evaluado_id) REFERENCES usuario(usuario_id);
  
INSERT INTO estado (descripcion_estado) VALUES ('PENDIENTE');  
INSERT INTO estado (descripcion_estado) VALUES ('APROBADO');  

INSERT INTO tipo_de_viaje (nombre) VALUES ('DIARIO');
INSERT INTO tipo_de_viaje (nombre) VALUES ('SEMANAL');
INSERT INTO tipo_de_viaje (nombre) VALUES ('OCASIONAL');

INSERT INTO tipo_pasajero (descripcion_tipo) VALUES ('PILOTO');
INSERT INTO tipo_pasajero (descripcion_tipo) VALUES ('COPILOTO');

ALTER TABLE modelo   
  CHANGE nombre_modelo nombre_modelo VARCHAR(20) CHARSET latin1 COLLATE latin1_spanish_ci NOT NULL  AFTER modelo_id,
  CHANGE marca_id marca_id INT(11) NULL  AFTER nombre_modelo;

INSERT INTO marca (marca_id,nombre_marca) VALUES 
 (1,' MARCA'),
 (2,'AGRALE'),
 (3,'ALFA ROMEO'),
 (4,'AUDI'),
 (5,'BMW'),
 (6,'CHERY'),
 (7,'CHEVROLET'),
 (8,'CHRYSLER'),
 (9,'CITROEN'),
 (10,'DACIA'),
 (11,'DAEWO'),
 (12,'DAIHATSU'),
 (13,'DODGE'),
 (14,'FERRARI'),
 (15,'FIAT'),
 (16,'FORD'),
 (17,'GALLOPER'),
 (18,'HEIBAO'),
 (19,'HONDA'),
 (20,'HYUNDAI'),
 (21,'ISUZU'),
 (22,'JAGUAR'),
 (23,'JEEP'),
 (24,'KIA'),
 (25,'LADA'),
 (26,'LAND ROVER'),
 (27,'LEXUS'),
 (28,'MASERATI'),
 (29,'MAZDA'),
 (30,'MERCEDES BENZ'),
 (31,'MG'),
 (32,'MINI'),
 (33,'MITSUBISHI'),
 (34,'NISSAN'),
 (35,'PEUGEOT'),
 (36,'PORSCHE'),
 (37,'RAM'),
 (38,'RENAULT'),
 (39,'ROVER'),
 (40,'SAAB'),
 (41,'SEAT'),
 (42,'SMART'),
 (43,'SSANGYONG'),
 (44,'SUBARU'),
 (45,'SUZUKI'),
 (46,'TATA'),
 (47,'TOYOTA'),
 (48,'VOLKSWAGEN'),
 (49,'VOLVO');

INSERT INTO modelo (modelo_id,nombre_modelo,marca_id) VALUES 
 (1,' MODELO',1),
 (2,'MARRUA',2),
 (3,'147',3),
 (4,'156',3),
 (5,'159',3),
 (6,'166',3),
 (7,'BRERA',3),
 (8,'GIULIETTA',3),
 (9,'GT',3),
 (10,'GTV',3),
 (11,'MITO',3),
 (12,'SPIDER',3),
 (13,'A1',4),
 (14,'A3',4),
 (15,'A4',4),
 (16,'A5',4),
 (17,'A6',4),
 (18,'A7',4),
 (19,'A8',4),
 (20,'ALLROAD',4),
 (21,'Q3',4),
 (22,'Q5',4),
 (23,'Q7',4),
 (24,'R8',4),
 (25,'TT',4),
 (26,'SERIE1',5),
 (27,'SERIE3',5),
 (28,'SERIE5',5),
 (29,'SERIE6',5),
 (30,'SERIE7',5),
 (31,'X1',5),
 (32,'X3',5),
 (33,'X5',5),
 (34,'X6',5),
 (35,'Z3',5),
 (36,'Z4',5),
 (37,'FACE',6),
 (38,'FULWIN',6),
 (39,'QQ',6),
 (40,'SKIN',6),
 (41,'TIGGO',6),
 (42,'AGILE',7),
 (43,'ASTRA',7),
 (44,'ASTRA II',7),
 (45,'AVALANCHE',7),
 (46,'AVEO',7),
 (47,'BLAZER',7),
 (48,'CAMARO',7),
 (49,'CAPTIVA',7),
 (50,'CELTA',7),
 (51,'CLASSIC',7),
 (52,'COBALT',7),
 (53,'CORSA',7),
 (54,'CORSA CLASSIC',7),
 (55,'CORSA II',7),
 (56,'CORVETTE',7),
 (57,'CRUZE',7),
 (58,'MERIVA',7),
 (59,'MONTANA',7),
 (60,'ONIX',7),
 (61,'PRISMA',7),
 (62,'VECTRA',7),
 (63,'S-10',7),
 (64,'SILVERADO',7),
 (65,'SONIC',7),
 (66,'SPARK',7),
 (67,'SPIN',7),
 (68,'TRACKER',7),
 (69,'TRAILBLAZER',7),
 (70,'ZAFIRA',7),
 (71,'300',8),
 (72,'CARAVAN',8),
 (73,'TOWN & COUNTRY',8),
 (74,'GRAND CARAVAN',8),
 (75,'CROSSFIRE',8),
 (76,'NEON',8),
 (77,'PT CRUISER',8),
 (78,'SEBRIG',8),
 (79,'BERLINGO',9),
 (80,'C3',9),
 (81,'C3 AIRCROSS',9),
 (82,'C3 PICASSO',9),
 (83,'C4 AIRCROSS',9),
 (84,'C4 LOUNGE',9),
 (85,'C4 PICASSO',9),
 (86,'C4 GRAND PICASSO',9),
 (87,'C5',9),
 (88,'C6',9),
 (89,'DS3',9),
 (90,'DS4',9),
 (91,'C15',9),
 (92,'JUMPER',9),
 (93,'SAXO',9),
 (94,'XSARA',9),
 (95,'XSARA PICASSO',9),
 (96,'PICK-UP',10),
 (97,'LANOS',11),
 (98,'LEGANZA',11),
 (99,'NUBIRA',11),
 (100,'MATIZ',11),
 (101,'TACUMA',11),
 (102,'DAMAS',11),
 (103,'LABO',11),
 (104,'MOVE',12),
 (105,'ROCKY',12),
 (106,'SIRION',12),
 (107,'TERIOS',12),
 (108,'MIRA',12),
 (109,'JOURNEY',13),
 (110,'RAM',13),
 (111,'360',14),
 (112,'430',14),
 (113,'456',14),
 (114,'575',14),
 (115,'599',14),
 (116,'612',14),
 (117,'CALIFORNIA',14),
 (118,'SUPERAMERICA',14),
 (119,'500',15),
 (120,'BRAVA',15),
 (121,'BRAVO',15),
 (122,'DOBLO',15),
 (123,'DUCATO',15),
 (124,'FIORINO',15),
 (125,'FIORINO QUBO',15),
 (126,'IDEA',15),
 (127,'LINEA',15),
 (128,'MAREA',15),
 (129,'PALIO',15),
 (130,'PALIO ADVENTURE',15),
 (131,'PUNTO',15),
 (132,'QUBO',15),
 (133,'SIENA',15),
 (134,'GRAND SIENA',15),
 (135,'STILO',15),
 (136,'STRADA',15),
 (137,'UNO',15),
 (138,'UNO EVO',15),
 (139,'COURIER',16),
 (140,'ECOSPORT',16),
 (141,'ECOSPORT KD',16),
 (142,'ESCAPE',16),
 (143,'F100',16),
 (144,'FIESTA KD',16),
 (145,'FIESTA',16),
 (146,'FOCUS',16),
 (147,'FOCUS III',16),
 (148,'KA',16),
 (149,'KUGA',16),
 (150,'MONDEO',16),
 (151,'RANGER',16),
 (152,'S-MAX',16),
 (153,'TRANSIT',16),
 (154,'EXCEED',17),
 (155,'HB',18),
 (156,'ACCORD',19),
 (157,'CITY',19),
 (158,'CIVIC',19),
 (159,'CRV',19),
 (160,'FIT',19),
 (161,'HRV',19),
 (162,'LEGEND',19),
 (163,'PILOT',19),
 (164,'STREAM',19),
 (165,'ACCENT',20),
 (166,'ATOS PRIME',20),
 (167,'COUPE',20),
 (168,'ELANTRA',20),
 (169,'I 10',20),
 (170,'I 30',20),
 (171,'MATRIX',20),
 (172,'SANTA FE',20),
 (173,'SONATA',20),
 (174,'TERRACAN',20),
 (175,'TRAJET',20),
 (176,'TUCSON',20),
 (177,'VELOSTER',20),
 (178,'VERACRUZ',20),
 (179,'AMIGO',21),
 (180,'PICK-UP CABIAN SIMPLE',21),
 (181,'PICK-UP SPACE CAB',21),
 (182,'PICK-UP CABINA DOBLE',21),
 (183,'TROOPER',21),
 (184,'X-TYPE',22),
 (185,'XF',22),
 (186,'F-TYPE',22),
 (187,'S-TYPE',22),
 (188,'XJ',22),
 (189,'XK',22),
 (190,'CHEROKEE',23),
 (191,'COMPASS',23),
 (192,'GRAND CHEROKEE',23),
 (193,'PATRIOT',23),
 (194,'WRANGLER',23),
 (195,'CARENS',24),
 (196,'CARNIVAL',24),
 (197,'CERATO',24),
 (198,'MAGENTIS',24),
 (199,'MOHAVE',24),
 (200,'OPIRUS',24),
 (201,'PICANTO',24),
 (202,'RIO',24),
 (203,'RONDO',24),
 (204,'SPORTAGE',24),
 (205,'GRAND SPORTAGE',24),
 (206,'SORENTO',24),
 (207,'SOUL',24),
 (208,'PREGIO',24),
 (209,'AFALINA',25),
 (210,'SAMARA',25),
 (211,'DEFENDER',26),
 (212,'DISCOVERY',26),
 (213,'FREELANDER',26),
 (214,'RANGE ROVER',26),
 (215,'LS',27),
 (216,'GS',27),
 (217,'IS',27),
 (218,'QUATTROPORTE',28),
 (219,'COUPE',28),
 (220,'GRAND TURISMO',28),
 (221,'SPYDER',28),
 (222,'323',29),
 (223,'626',29),
 (224,'MPV',29),
 (225,'B 2500',29),
 (226,'B 2900',29),
 (227,'AMG',30),
 (228,'CLASE A',30),
 (229,'CLASE B',30),
 (230,'CLASE C',30),
 (231,'CLASE CL',30),
 (232,'CLASE CLA',30),
 (233,'CLASE CLC',30),
 (234,'CLASE CLK',30),
 (235,'CLASE CLS',30),
 (236,'CLASE E',30),
 (237,'CLASE G',30),
 (238,'CLASE GL',30),
 (239,'CLASE ML',30),
 (240,'CLASE S',30),
 (241,'CLASE SL',30),
 (242,'CLASE SLK',30),
 (243,'VIANO',30),
 (244,'MGF',31),
 (245,'COOPER',32),
 (246,'CANTER',33),
 (247,'L-200',33),
 (248,'LANCER',33),
 (249,'MONTERO',33),
 (250,'NATIVA',33),
 (251,'OUTLANDER',33),
 (252,'350',34),
 (253,'370Z',34),
 (254,'PATHFINDER',34),
 (255,'FRONTIER',34),
 (256,'MARCH',34),
 (257,'MURANO',34),
 (258,'NP300',34),
 (259,'PICK-UP',34),
 (260,'SENTRA',34),
 (261,'TEANA',34),
 (262,'TERRANO II',34),
 (263,'TIIDA',34),
 (264,'VERSA',34),
 (265,'X-TERRA',34),
 (266,'X-TRAIL',34),
 (267,'106',35),
 (268,'206',35),
 (269,'207',35),
 (270,'208',35),
 (271,'306',35),
 (272,'307',35),
 (273,'308',35),
 (274,'3008',35),
 (275,'405',35),
 (276,'406',35),
 (277,'407',35),
 (278,'408',35),
 (279,'4008',35),
 (280,'508',35),
 (281,'5008',35),
 (282,'607',35),
 (283,'806',35),
 (284,'807',35),
 (285,'RCZ',35),
 (286,'EXPERT',35),
 (287,'HOGGAR',35),
 (288,'PARTNER',35),
 (289,'BOXER',35),
 (290,'911',36),
 (291,'BOXSTER',36),
 (292,'CAYENNE',36),
 (293,'CAYMAN',36),
 (294,'PANAMERA',36),
 (295,'1500',37),
 (296,'2500',37),
 (297,'CLIO MIO',38),
 (298,'CLIO L/NUEVA',38),
 (299,'CLIO 2',38),
 (300,'DUSTER',38),
 (301,'FLUENCE',38),
 (302,'KANGOO',38),
 (303,'KANGOO FURGON',38),
 (304,'KOLEOS',38),
 (305,'LAGUNA',38),
 (306,'LATITUDE',38),
 (307,'LOGAN',38),
 (308,'MEGANE',38),
 (309,'MEGANE II',38),
 (310,'MEGANE III',38),
 (311,'SANDERO',38),
 (312,'SANDERO STEPWAY',38),
 (313,'SCENIC',38),
 (314,'SYMBOL',38),
 (315,'TWINGO',38),
 (316,'TRAFIC',38),
 (317,'MASTER',38),
 (318,'LINEA 25',39),
 (319,'LINEA 45',39),
 (320,'LINEA 75',39),
 (321,'LINEA 9.3',39),
 (322,'LINEA 9.5',39),
 (323,'ALHAMBRA',40),
 (324,'ALTEA',40),
 (325,'CORDOBA',40),
 (326,'IBIZA',40),
 (327,'INCA FURGON',40),
 (328,'LEON',40),
 (329,'TOLEDO',40),
 (330,'FORTWO',41),
 (331,'ACTYON',42),
 (332,'KORANDO',42),
 (333,'KYRON',42),
 (334,'ISTANA',42),
 (335,'MUSSO',42),
 (336,'REXTON',42),
 (337,'STAVIC',42),
 (338,'IMPREZA',43),
 (339,'LEGACY',43),
 (340,'OUTBACK',43),
 (341,'TRIBECA',43),
 (342,'XV',43),
 (343,'FORESTER',43),
 (344,'FUN',44),
 (345,'GRAND VITARA',44),
 (346,'SWIFT',44),
 (347,'JIMNY',44),
 (348,'207 TELCOLINE',45),
 (349,'SUMO',46),
 (350,'86',47),
 (351,'AVENSIS',47),
 (352,'CAMRY',47),
 (353,'COROLLA',47),
 (354,'CORONA',47),
 (355,'ETIOS',47),
 (356,'ETIOS CROSS',47),
 (357,'HILUX',47),
 (358,'LAND CRUISER',47),
 (359,'PRIUS',47),
 (360,'RAV 4',47),
 (361,'AMAROK',48),
 (362,'BORA',48),
 (363,'CADDY',48),
 (364,'CROSSFOX',48),
 (365,'FOX',48),
 (366,'GOL',48),
 (367,'GOL TREND',48),
 (368,'GOLF',48),
 (369,'MULTIVAN',48),
 (370,'THE BEETLE',48),
 (371,'NEW BEETLE',48),
 (372,'PASSAT',48),
 (373,'CC',48),
 (374,'POLO',48),
 (375,'SANTANA',48),
 (376,'SAVEIRO',48),
 (377,'SCIROCCO',48),
 (378,'SHARAN',48),
 (379,'SURAN',48),
 (380,'TIGUAN',48),
 (381,'TOUAREG',48),
 (382,'TRANSPORTER',48),
 (383,'UP',48),
 (384,'VENTO',48),
 (385,'VOYAGE',48),
 (386,'C30',49),
 (387,'C70',49),
 (388,'S40',49),
 (389,'S60',49),
 (390,'S80',49),
 (391,'V40',49),
 (392,'V50',49),
 (393,'V60',49),
 (394,'V70',49),
 (395,'XC60',49),
 (396,'XC70',49),
 (397,'XC90',49);
 
INSERT INTO localidad (nombre_localidad) VALUES ('25 de Mayo');
INSERT INTO localidad (nombre_localidad) VALUES ('3 de febrero');
INSERT INTO localidad (nombre_localidad) VALUES ('A. Alsina');
INSERT INTO localidad (nombre_localidad) VALUES ('A. Gonzáles Cháves');
INSERT INTO localidad (nombre_localidad) VALUES ('Aguas Verdes');
INSERT INTO localidad (nombre_localidad) VALUES ('Alberti');
INSERT INTO localidad (nombre_localidad) VALUES ('Arrecifes');
INSERT INTO localidad (nombre_localidad) VALUES ('Ayacucho');
INSERT INTO localidad (nombre_localidad) VALUES ('Azul');
INSERT INTO localidad (nombre_localidad) VALUES ('Bahía Blanca');
INSERT INTO localidad (nombre_localidad) VALUES ('Balcarce');
INSERT INTO localidad (nombre_localidad) VALUES ('Baradero');
INSERT INTO localidad (nombre_localidad) VALUES ('Benito Juárez');
INSERT INTO localidad (nombre_localidad) VALUES ('Berisso');
INSERT INTO localidad (nombre_localidad) VALUES ('Bolívar');
INSERT INTO localidad (nombre_localidad) VALUES ('Bragado');
INSERT INTO localidad (nombre_localidad) VALUES ('Brandsen');
INSERT INTO localidad (nombre_localidad) VALUES ('Campana');
INSERT INTO localidad (nombre_localidad) VALUES ('Cañuelas');
INSERT INTO localidad (nombre_localidad) VALUES ('Capilla del Señor');
INSERT INTO localidad (nombre_localidad) VALUES ('Capitán Sarmiento');
INSERT INTO localidad (nombre_localidad) VALUES ('Carapachay');
INSERT INTO localidad (nombre_localidad) VALUES ('Carhue');
INSERT INTO localidad (nombre_localidad) VALUES ('Cariló');
INSERT INTO localidad (nombre_localidad) VALUES ('Carlos Casares');
INSERT INTO localidad (nombre_localidad) VALUES ('Carlos Tejedor');
INSERT INTO localidad (nombre_localidad) VALUES ('Carmen de Areco');
INSERT INTO localidad (nombre_localidad) VALUES ('Carmen de Patagones');
INSERT INTO localidad (nombre_localidad) VALUES ('Castelli');
INSERT INTO localidad (nombre_localidad) VALUES ('Chacabuco');
INSERT INTO localidad (nombre_localidad) VALUES ('Chascomús');
INSERT INTO localidad (nombre_localidad) VALUES ('Chivilcoy');
INSERT INTO localidad (nombre_localidad) VALUES ('Colón');
INSERT INTO localidad (nombre_localidad) VALUES ('Coronel Dorrego');
INSERT INTO localidad (nombre_localidad) VALUES ('Coronel Pringles');
INSERT INTO localidad (nombre_localidad) VALUES ('Coronel Rosales');
INSERT INTO localidad (nombre_localidad) VALUES ('Coronel Suarez');
INSERT INTO localidad (nombre_localidad) VALUES ('Costa Azul');
INSERT INTO localidad (nombre_localidad) VALUES ('Costa Chica');
INSERT INTO localidad (nombre_localidad) VALUES ('Costa del Este');
INSERT INTO localidad (nombre_localidad) VALUES ('Costa Esmeralda');
INSERT INTO localidad (nombre_localidad) VALUES ('Daireaux');
INSERT INTO localidad (nombre_localidad) VALUES ('Darregueira');
INSERT INTO localidad (nombre_localidad) VALUES ('Del Viso');
INSERT INTO localidad (nombre_localidad) VALUES ('Dolores');
INSERT INTO localidad (nombre_localidad) VALUES ('Don Torcuato');
INSERT INTO localidad (nombre_localidad) VALUES ('Ensenada');
INSERT INTO localidad (nombre_localidad) VALUES ('Escobar');
INSERT INTO localidad (nombre_localidad) VALUES ('Exaltación de la Cruz');
INSERT INTO localidad (nombre_localidad) VALUES ('Florentino Ameghino');
INSERT INTO localidad (nombre_localidad) VALUES ('Garín');
INSERT INTO localidad (nombre_localidad) VALUES ('Gral. Alvarado');
INSERT INTO localidad (nombre_localidad) VALUES ('Gral. Alvear');
INSERT INTO localidad (nombre_localidad) VALUES ('Gral. Arenales');
INSERT INTO localidad (nombre_localidad) VALUES ('Gral. Belgrano');
INSERT INTO localidad (nombre_localidad) VALUES ('Gral. Guido');
INSERT INTO localidad (nombre_localidad) VALUES ('Gral. Lamadrid');
INSERT INTO localidad (nombre_localidad) VALUES ('Gral. Las Heras');
INSERT INTO localidad (nombre_localidad) VALUES ('Gral. Lavalle');
INSERT INTO localidad (nombre_localidad) VALUES ('Gral. Madariaga');
INSERT INTO localidad (nombre_localidad) VALUES ('Gral. Pacheco');
INSERT INTO localidad (nombre_localidad) VALUES ('Gral. Paz');
INSERT INTO localidad (nombre_localidad) VALUES ('Gral. Pinto');
INSERT INTO localidad (nombre_localidad) VALUES ('Gral. Pueyrredón');
INSERT INTO localidad (nombre_localidad) VALUES ('Gral. Rodríguez');
INSERT INTO localidad (nombre_localidad) VALUES ('Gral. Viamonte');
INSERT INTO localidad (nombre_localidad) VALUES ('Gral. Villegas');
INSERT INTO localidad (nombre_localidad) VALUES ('Guaminí');
INSERT INTO localidad (nombre_localidad) VALUES ('Guernica');
INSERT INTO localidad (nombre_localidad) VALUES ('Hipólito Yrigoyen');
INSERT INTO localidad (nombre_localidad) VALUES ('Ing. Maschwitz');
INSERT INTO localidad (nombre_localidad) VALUES ('Junín');
INSERT INTO localidad (nombre_localidad) VALUES ('La Plata');
INSERT INTO localidad (nombre_localidad) VALUES ('Laprida');
INSERT INTO localidad (nombre_localidad) VALUES ('Las Flores');
INSERT INTO localidad (nombre_localidad) VALUES ('Las Toninas');
INSERT INTO localidad (nombre_localidad) VALUES ('Leandro N. Alem');
INSERT INTO localidad (nombre_localidad) VALUES ('Lincoln');
INSERT INTO localidad (nombre_localidad) VALUES ('Loberia');
INSERT INTO localidad (nombre_localidad) VALUES ('Lobos');
INSERT INTO localidad (nombre_localidad) VALUES ('Los Cardales');
INSERT INTO localidad (nombre_localidad) VALUES ('Los Toldos');
INSERT INTO localidad (nombre_localidad) VALUES ('Lucila del Mar');
INSERT INTO localidad (nombre_localidad) VALUES ('Luján');
INSERT INTO localidad (nombre_localidad) VALUES ('Magdalena');
INSERT INTO localidad (nombre_localidad) VALUES ('Maipú');
INSERT INTO localidad (nombre_localidad) VALUES ('Mar Chiquita');
INSERT INTO localidad (nombre_localidad) VALUES ('Mar de Ajó');
INSERT INTO localidad (nombre_localidad) VALUES ('Mar de las Pampas');
INSERT INTO localidad (nombre_localidad) VALUES ('Mar del Plata');
INSERT INTO localidad (nombre_localidad) VALUES ('Mar del Tuyú');
INSERT INTO localidad (nombre_localidad) VALUES ('Marcos Paz');
INSERT INTO localidad (nombre_localidad) VALUES ('Mercedes');
INSERT INTO localidad (nombre_localidad) VALUES ('Miramar');
INSERT INTO localidad (nombre_localidad) VALUES ('Monte');
INSERT INTO localidad (nombre_localidad) VALUES ('Monte Hermoso');
INSERT INTO localidad (nombre_localidad) VALUES ('Munro');
INSERT INTO localidad (nombre_localidad) VALUES ('Navarro');
INSERT INTO localidad (nombre_localidad) VALUES ('Necochea');
INSERT INTO localidad (nombre_localidad) VALUES ('Olavarría');
INSERT INTO localidad (nombre_localidad) VALUES ('Partido de la Costa');
INSERT INTO localidad (nombre_localidad) VALUES ('Pehuajó');
INSERT INTO localidad (nombre_localidad) VALUES ('Pellegrini');
INSERT INTO localidad (nombre_localidad) VALUES ('Pergamino');
INSERT INTO localidad (nombre_localidad) VALUES ('Pigüé');
INSERT INTO localidad (nombre_localidad) VALUES ('Pila');
INSERT INTO localidad (nombre_localidad) VALUES ('Pilar');
INSERT INTO localidad (nombre_localidad) VALUES ('Pinamar');
INSERT INTO localidad (nombre_localidad) VALUES ('Pinar del Sol');
INSERT INTO localidad (nombre_localidad) VALUES ('Polvorines');
INSERT INTO localidad (nombre_localidad) VALUES ('Pte. Perón');
INSERT INTO localidad (nombre_localidad) VALUES ('Puán');
INSERT INTO localidad (nombre_localidad) VALUES ('Punta Indio');
INSERT INTO localidad (nombre_localidad) VALUES ('Ramallo');
INSERT INTO localidad (nombre_localidad) VALUES ('Rauch');
INSERT INTO localidad (nombre_localidad) VALUES ('Rivadavia');
INSERT INTO localidad (nombre_localidad) VALUES ('Rojas');
INSERT INTO localidad (nombre_localidad) VALUES ('Roque Pérez');
INSERT INTO localidad (nombre_localidad) VALUES ('Saavedra');
INSERT INTO localidad (nombre_localidad) VALUES ('Saladillo');
INSERT INTO localidad (nombre_localidad) VALUES ('Salliqueló');
INSERT INTO localidad (nombre_localidad) VALUES ('Salto');
INSERT INTO localidad (nombre_localidad) VALUES ('San Andrés de Giles');
INSERT INTO localidad (nombre_localidad) VALUES ('San Antonio de Areco');
INSERT INTO localidad (nombre_localidad) VALUES ('San Antonio de Padua');
INSERT INTO localidad (nombre_localidad) VALUES ('San Bernardo');
INSERT INTO localidad (nombre_localidad) VALUES ('San Cayetano');
INSERT INTO localidad (nombre_localidad) VALUES ('San Clemente del Tuyú');
INSERT INTO localidad (nombre_localidad) VALUES ('San Nicolás');
INSERT INTO localidad (nombre_localidad) VALUES ('San Pedro');
INSERT INTO localidad (nombre_localidad) VALUES ('San Vicente');
INSERT INTO localidad (nombre_localidad) VALUES ('Santa Teresita');
INSERT INTO localidad (nombre_localidad) VALUES ('Suipacha');
INSERT INTO localidad (nombre_localidad) VALUES ('Tandil');
INSERT INTO localidad (nombre_localidad) VALUES ('Tapalqué');
INSERT INTO localidad (nombre_localidad) VALUES ('Tordillo');
INSERT INTO localidad (nombre_localidad) VALUES ('Tornquist');
INSERT INTO localidad (nombre_localidad) VALUES ('Trenque Lauquen');
INSERT INTO localidad (nombre_localidad) VALUES ('Tres Lomas');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Gesell');
INSERT INTO localidad (nombre_localidad) VALUES ('Villarino');
INSERT INTO localidad (nombre_localidad) VALUES ('Zárate');
INSERT INTO localidad (nombre_localidad) VALUES ('11 de Septiembre');
INSERT INTO localidad (nombre_localidad) VALUES ('20 de Junio');
INSERT INTO localidad (nombre_localidad) VALUES ('25 de Mayo');
INSERT INTO localidad (nombre_localidad) VALUES ('Acassuso');
INSERT INTO localidad (nombre_localidad) VALUES ('Adrogué');
INSERT INTO localidad (nombre_localidad) VALUES ('Aldo Bonzi');
INSERT INTO localidad (nombre_localidad) VALUES ('Área Reserva Cinturón Ecológico');
INSERT INTO localidad (nombre_localidad) VALUES ('Avellaneda');
INSERT INTO localidad (nombre_localidad) VALUES ('Banfield');
INSERT INTO localidad (nombre_localidad) VALUES ('Barrio Parque');
INSERT INTO localidad (nombre_localidad) VALUES ('Barrio Santa Teresita');
INSERT INTO localidad (nombre_localidad) VALUES ('Beccar');
INSERT INTO localidad (nombre_localidad) VALUES ('Bella Vista');
INSERT INTO localidad (nombre_localidad) VALUES ('Berazategui');
INSERT INTO localidad (nombre_localidad) VALUES ('Bernal Este');
INSERT INTO localidad (nombre_localidad) VALUES ('Bernal Oeste');
INSERT INTO localidad (nombre_localidad) VALUES ('Billinghurst');
INSERT INTO localidad (nombre_localidad) VALUES ('Boulogne');
INSERT INTO localidad (nombre_localidad) VALUES ('Burzaco');
INSERT INTO localidad (nombre_localidad) VALUES ('Carapachay');
INSERT INTO localidad (nombre_localidad) VALUES ('Caseros');
INSERT INTO localidad (nombre_localidad) VALUES ('Castelar');
INSERT INTO localidad (nombre_localidad) VALUES ('Churruca');
INSERT INTO localidad (nombre_localidad) VALUES ('Ciudad Evita');
INSERT INTO localidad (nombre_localidad) VALUES ('Ciudad Madero');
INSERT INTO localidad (nombre_localidad) VALUES ('Ciudadela');
INSERT INTO localidad (nombre_localidad) VALUES ('Claypole');
INSERT INTO localidad (nombre_localidad) VALUES ('Crucecita');
INSERT INTO localidad (nombre_localidad) VALUES ('Dock Sud');
INSERT INTO localidad (nombre_localidad) VALUES ('Don Bosco');
INSERT INTO localidad (nombre_localidad) VALUES ('Don Orione');
INSERT INTO localidad (nombre_localidad) VALUES ('El Jagüel');
INSERT INTO localidad (nombre_localidad) VALUES ('El Libertador');
INSERT INTO localidad (nombre_localidad) VALUES ('El Palomar');
INSERT INTO localidad (nombre_localidad) VALUES ('El Tala');
INSERT INTO localidad (nombre_localidad) VALUES ('El Trébol');
INSERT INTO localidad (nombre_localidad) VALUES ('Ezeiza');
INSERT INTO localidad (nombre_localidad) VALUES ('Ezpeleta');
INSERT INTO localidad (nombre_localidad) VALUES ('Florencio Varela');
INSERT INTO localidad (nombre_localidad) VALUES ('Florida');
INSERT INTO localidad (nombre_localidad) VALUES ('Francisco Álvarez');
INSERT INTO localidad (nombre_localidad) VALUES ('Gerli');
INSERT INTO localidad (nombre_localidad) VALUES ('Glew');
INSERT INTO localidad (nombre_localidad) VALUES ('González Catán');
INSERT INTO localidad (nombre_localidad) VALUES ('Gral. Lamadrid');
INSERT INTO localidad (nombre_localidad) VALUES ('Grand Bourg');
INSERT INTO localidad (nombre_localidad) VALUES ('Gregorio de Laferrere');
INSERT INTO localidad (nombre_localidad) VALUES ('Guillermo Enrique Hudson');
INSERT INTO localidad (nombre_localidad) VALUES ('Haedo');
INSERT INTO localidad (nombre_localidad) VALUES ('Hurlingham');
INSERT INTO localidad (nombre_localidad) VALUES ('Ing. Sourdeaux');
INSERT INTO localidad (nombre_localidad) VALUES ('Isidro Casanova');
INSERT INTO localidad (nombre_localidad) VALUES ('Ituzaingó');
INSERT INTO localidad (nombre_localidad) VALUES ('José C. Paz');
INSERT INTO localidad (nombre_localidad) VALUES ('José Ingenieros');
INSERT INTO localidad (nombre_localidad) VALUES ('José Marmol');
INSERT INTO localidad (nombre_localidad) VALUES ('La Lucila');
INSERT INTO localidad (nombre_localidad) VALUES ('La Reja');
INSERT INTO localidad (nombre_localidad) VALUES ('La Tablada');
INSERT INTO localidad (nombre_localidad) VALUES ('Lanús');
INSERT INTO localidad (nombre_localidad) VALUES ('Llavallol');
INSERT INTO localidad (nombre_localidad) VALUES ('Loma Hermosa');
INSERT INTO localidad (nombre_localidad) VALUES ('Lomas de Zamora');
INSERT INTO localidad (nombre_localidad) VALUES ('Lomas del Millón');
INSERT INTO localidad (nombre_localidad) VALUES ('Lomas del Mirador');
INSERT INTO localidad (nombre_localidad) VALUES ('Longchamps');
INSERT INTO localidad (nombre_localidad) VALUES ('Los Polvorines');
INSERT INTO localidad (nombre_localidad) VALUES ('Luis Guillón');
INSERT INTO localidad (nombre_localidad) VALUES ('Malvinas Argentinas');
INSERT INTO localidad (nombre_localidad) VALUES ('Martín Coronado');
INSERT INTO localidad (nombre_localidad) VALUES ('Martínez');
INSERT INTO localidad (nombre_localidad) VALUES ('Merlo');
INSERT INTO localidad (nombre_localidad) VALUES ('Ministro Rivadavia');
INSERT INTO localidad (nombre_localidad) VALUES ('Monte Chingolo');
INSERT INTO localidad (nombre_localidad) VALUES ('Monte Grande');
INSERT INTO localidad (nombre_localidad) VALUES ('Moreno');
INSERT INTO localidad (nombre_localidad) VALUES ('Morón');
INSERT INTO localidad (nombre_localidad) VALUES ('Muñiz');
INSERT INTO localidad (nombre_localidad) VALUES ('Olivos');
INSERT INTO localidad (nombre_localidad) VALUES ('Pablo Nogués');
INSERT INTO localidad (nombre_localidad) VALUES ('Pablo Podestá');
INSERT INTO localidad (nombre_localidad) VALUES ('Paso del Rey');
INSERT INTO localidad (nombre_localidad) VALUES ('Pereyra');
INSERT INTO localidad (nombre_localidad) VALUES ('Piñeiro');
INSERT INTO localidad (nombre_localidad) VALUES ('Plátanos');
INSERT INTO localidad (nombre_localidad) VALUES ('Pontevedra');
INSERT INTO localidad (nombre_localidad) VALUES ('Quilmes');
INSERT INTO localidad (nombre_localidad) VALUES ('Rafael Calzada');
INSERT INTO localidad (nombre_localidad) VALUES ('Rafael Castillo');
INSERT INTO localidad (nombre_localidad) VALUES ('Ramos Mejía');
INSERT INTO localidad (nombre_localidad) VALUES ('Ranelagh');
INSERT INTO localidad (nombre_localidad) VALUES ('Remedios de Escalada');
INSERT INTO localidad (nombre_localidad) VALUES ('Sáenz Peña');
INSERT INTO localidad (nombre_localidad) VALUES ('San Antonio de Padua');
INSERT INTO localidad (nombre_localidad) VALUES ('San Fernando');
INSERT INTO localidad (nombre_localidad) VALUES ('San Francisco Solano');
INSERT INTO localidad (nombre_localidad) VALUES ('San Isidro');
INSERT INTO localidad (nombre_localidad) VALUES ('San José');
INSERT INTO localidad (nombre_localidad) VALUES ('San Justo');
INSERT INTO localidad (nombre_localidad) VALUES ('San Martín');
INSERT INTO localidad (nombre_localidad) VALUES ('San Miguel');
INSERT INTO localidad (nombre_localidad) VALUES ('Santos Lugares');
INSERT INTO localidad (nombre_localidad) VALUES ('Sarandí');
INSERT INTO localidad (nombre_localidad) VALUES ('Sourigues');
INSERT INTO localidad (nombre_localidad) VALUES ('Tapiales');
INSERT INTO localidad (nombre_localidad) VALUES ('Temperley');
INSERT INTO localidad (nombre_localidad) VALUES ('Tigre');
INSERT INTO localidad (nombre_localidad) VALUES ('Tortuguitas');
INSERT INTO localidad (nombre_localidad) VALUES ('Tristán Suárez');
INSERT INTO localidad (nombre_localidad) VALUES ('Trujui');
INSERT INTO localidad (nombre_localidad) VALUES ('Turdera');
INSERT INTO localidad (nombre_localidad) VALUES ('Valentín Alsina');
INSERT INTO localidad (nombre_localidad) VALUES ('Vicente López');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Adelina');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Ballester');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Bosch');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Caraza');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Celina');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Centenario');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa de Mayo');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Diamante');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Domínico');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa España');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Fiorito');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Guillermina');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Insuperable');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa José León Suárez');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa La Florida');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Luzuriaga');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Martelli');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Obrera');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Progreso');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Raffo');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Sarmiento');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Tesei');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Udaondo');
INSERT INTO localidad (nombre_localidad) VALUES ('Virrey del Pino');
INSERT INTO localidad (nombre_localidad) VALUES ('Wilde');
INSERT INTO localidad (nombre_localidad) VALUES ('William Morris');
INSERT INTO localidad (nombre_localidad) VALUES ('Agronomía');
INSERT INTO localidad (nombre_localidad) VALUES ('Almagro');
INSERT INTO localidad (nombre_localidad) VALUES ('Balvanera');
INSERT INTO localidad (nombre_localidad) VALUES ('Barracas');
INSERT INTO localidad (nombre_localidad) VALUES ('Belgrano');
INSERT INTO localidad (nombre_localidad) VALUES ('Boca');
INSERT INTO localidad (nombre_localidad) VALUES ('Boedo');
INSERT INTO localidad (nombre_localidad) VALUES ('Caballito');
INSERT INTO localidad (nombre_localidad) VALUES ('Chacarita');
INSERT INTO localidad (nombre_localidad) VALUES ('Coghlan');
INSERT INTO localidad (nombre_localidad) VALUES ('Colegiales');
INSERT INTO localidad (nombre_localidad) VALUES ('Constitución');
INSERT INTO localidad (nombre_localidad) VALUES ('Flores');
INSERT INTO localidad (nombre_localidad) VALUES ('Floresta');
INSERT INTO localidad (nombre_localidad) VALUES ('La Paternal');
INSERT INTO localidad (nombre_localidad) VALUES ('Liniers');
INSERT INTO localidad (nombre_localidad) VALUES ('Mataderos');
INSERT INTO localidad (nombre_localidad) VALUES ('Monserrat');
INSERT INTO localidad (nombre_localidad) VALUES ('Monte Castro');
INSERT INTO localidad (nombre_localidad) VALUES ('Nueva Pompeya');
INSERT INTO localidad (nombre_localidad) VALUES ('Núñez');
INSERT INTO localidad (nombre_localidad) VALUES ('Palermo');
INSERT INTO localidad (nombre_localidad) VALUES ('Parque Avellaneda');
INSERT INTO localidad (nombre_localidad) VALUES ('Parque Chacabuco');
INSERT INTO localidad (nombre_localidad) VALUES ('Parque Chas');
INSERT INTO localidad (nombre_localidad) VALUES ('Parque Patricios');
INSERT INTO localidad (nombre_localidad) VALUES ('Puerto Madero');
INSERT INTO localidad (nombre_localidad) VALUES ('Recoleta');
INSERT INTO localidad (nombre_localidad) VALUES ('Retiro');
INSERT INTO localidad (nombre_localidad) VALUES ('Saavedra');
INSERT INTO localidad (nombre_localidad) VALUES ('San Cristóbal');
INSERT INTO localidad (nombre_localidad) VALUES ('San Nicolás');
INSERT INTO localidad (nombre_localidad) VALUES ('San Telmo');
INSERT INTO localidad (nombre_localidad) VALUES ('Vélez Sársfield');
INSERT INTO localidad (nombre_localidad) VALUES ('Versalles');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Crespo');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa del Parque');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Devoto');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Gral. Mitre');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Lugano');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Luro');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Ortúzar');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Pueyrredón');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Real');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Riachuelo');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Santa Rita');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Soldati');
INSERT INTO localidad (nombre_localidad) VALUES ('Villa Urquiza');
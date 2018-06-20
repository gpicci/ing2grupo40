-- NO CREAR vehiculo_ocupacion
CREATE TABLE vehiculo_ocupacion(
vehiculo_id INT(11),
desde DATETIME,
hasta DATETIME);

CREATE TABLE ocupacion_usuario(
usuario_id INT(11),
viaje_id INT(11),
desde DATETIME,
hasta DATETIME);

ALTER TABLE calificacion ADD tipo_pasajero_id INT(11)

ALTER TABLE viaje ADD f_terminado DATETIME
<?php
require_once('db.php');
require_once('./common/log.php');

function getViajesPorUsuario(
  $usuario_id) {
	
  $db = DB::singleton();

  $query = "
	SELECT
	  v.viaje_id,
	  v.vechiculo_id,
	  m.nombre_marca,
	  mm.nombre_modelo,
	  vv.patente,
	  vv.cantidad_asientos,
	  lo.nombre_localidad AS localidad_id_origen,  
	  ld.nombre_localidad AS localidad_id_destino,  
	  t.nombre AS d_tipo_viaje,
	  v.duracion,
	  v.costo
	FROM
	  viaje v,
	  vehiculo vv,
	  modelo mm,
	  marca m,
	  localidad lo,
	  localidad ld,
	  tipo_de_viaje t
	WHERE v.vechiculo_id = vv.vehiculo_id
	AND   vv.modelo_id = mm.modelo_id
	AND   mm.marca_id = m.marca_id
	AND   v.localidad_origen_id = lo.localidad_id
	AND   v.localidad_destino_id = ld.localidad_id
	AND   v.tipo_viaje_id = t.tipo_viaje_id
	AND   v.usuario_id = ".$usuario_id;

  $rs = $db->executeQuery($query);

  if (!$rs) {
	applog($db->db_error(), 1);
  }

  return $rs;
}

function getViajePorId(
		$viaje_id) {
			
			$db = DB::singleton();
			
			$query = "
	SELECT
	  v.viaje_id,
	  v.vechiculo_id,
	  m.nombre_marca,
	  mm.nombre_modelo,
	  vv.patente,
	  vv.cantidad_asientos,
	  lo.nombre_localidad AS localidad_id_origen,
	  ld.nombre_localidad AS localidad_id_destino,
	  t.nombre AS d_tipo_viaje,
	  v.duracion,
	  v.costo
	FROM
	  viaje v,
	  vehiculo vv,
	  modelo mm,
	  marca m,
	  localidad lo,
	  localidad ld,
	  tipo_de_viaje t
	WHERE v.vechiculo_id = vv.vehiculo_id
	AND   vv.modelo_id = mm.modelo_id
	AND   mm.marca_id = m.marca_id
	AND   v.localidad_origen_id = lo.localidad_id
	AND   v.localidad_destino_id = ld.localidad_id
	AND   v.tipo_viaje_id = t.tipo_viaje_id
	AND   v.viaje_id = ".$viaje_id;
			
			$rs = $db->executeQuery($query);
			
			if (!$rs) {
				applog($db->db_error(), 1);
			}
			
			return $rs;
}

function getTiposDeViaje() {
			
  $db = DB::singleton();
			
  $query = "
  SELECT
	tipo_viaje_id,
	nombre
  FROM
	tipo_de_viaje t";
			
  $rs = $db->executeQuery($query);
			
  if (!$rs) {
	applog($db->db_error(), 1);
  }
			
  return $rs;
}

function getDiasSemana() {
	
	$db = DB::singleton();
	
	$query = "
  SELECT
	dia_semana_id,
	dia_semana_nombre
  FROM
	dia_semana d";
	
	$rs = $db->executeQuery($query);
	
	if (!$rs) {
		applog($db->db_error(), 1);
	}
	
	return $rs;
}

function getLocalidad() {
	
	$db = DB::singleton();
	
	$query = "
  SELECT
	localidad_id,
	nombre_localidad
  FROM
	localidad l";
	
	$rs = $db->executeQuery($query);
	
	if (!$rs) {
		applog($db->db_error(), 1);
	}
	
	return $rs;
}

function viajeAlta(
  $usuario_id,			
  $vehiculo_id,
  $localidad_origen_id,
  $localidad_destino_id,
  $duracion,
  $costo,
  $tipo_viaje_id,
  $fecha_salida,
  $dia_semana) {
			
  $db = DB::singleton();					
			
  $query = "INSERT INTO viajes (
	usuario_id,
    vehiculo_id,
	localidad_origen_id,
	localidad_destino_id,
	tipo_viaje_id,
	dia_semana,
	fecha_salida,
	duracion,
	costo)
  VALUES (".
  	$usuario_id.",".
  	$vehiculo_id.",".
  	$localidad_origen_id.",".
  	$localidad_destino_id.",".
  	$duracion.",".
  	$costo.",".
  	$tipo_viaje_id.",
  	str_to_date('".$fecha_salida."','%d-%m-%Y'),".
  	$dia_semana.")";
			
  $rs = $db->executeQuery($query);
			
  if (!$rs) {
	applog($db->db_error(), 1);
  }
			
  return $rs;
}

?>
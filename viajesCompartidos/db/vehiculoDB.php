<?php
include_once($_SERVER['DOCUMENT_ROOT']."/viajes/db/db.php");
//drequire_once('./common/log.php');

function getMarcas() {
  $db = DB::singleton();

  $query = "SELECT
	marca_id,
	nombre_marca
  FROM
    marca";

  $rs = $db->executeQuery($query);

  if (!$rs) {
	applog($db->db_error(), 1);
  }

  return $rs;
}

function getModelosPorMarca($idMarca) {
  $db = DB::singleton();

  $query = "SELECT
	modelo_id,
	nombre_modelo
  FROM
    modelo
  WHERE marca_id = ".$idMarca;

  $rs = $db->executeQuery($query);

  if (!$rs) {
	applog($db->db_error(), 1);
  }

  return $rs;
}

function getVehiculosPorUsuario(
	$usuario_id) {
	$db = DB::singleton();

	$query = "
	SELECT
	  v.vehiculo_id,
	  v.patente,
	  v.cantidad_asientos,
	  mm.nombre_marca,
	  m.nombre_modelo
    FROM
	  vehiculo v,
	  modelo m,
	  marca mm
  	WHERE v.m_baja = 0
  	AND	v.modelo_id = m.modelo_id
  	AND	m.marca_id = mm.marca_id
  	and	v.usuario_id = ".$usuario_id;

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function getVehiculoPorId(
		$vehiculo_id) {
			$db = DB::singleton();

			$query = "
	SELECT
	  v.vehiculo_id,
	  v.patente,
	  v.cantidad_asientos,
	  v.usuario_id,
	  mm.nombre_marca,
	  m.nombre_modelo,
	  mm.marca_id,
	  m.modelo_id
    FROM
	  vehiculo v,
	  modelo m,
	  marca mm
  	WHERE v.m_baja = 0
  	AND	v.modelo_id = m.modelo_id
  	AND	m.marca_id = mm.marca_id
  	and	v.vehiculo_id = ".$vehiculo_id;

			$rs = $db->executeQuery($query);

			if (!$rs) {
				applog($db->db_error(), 1);
			}

			return $rs;
}

function vehiculoBaja($id) {
	$db = DB::singleton();

	$str_f_baja = "'".formatPHPFecha(date("d-m-Y"))."'";

	$query = "UPDATE vehiculo
	          SET 	 m_baja = 1,
					f_baja = str_to_date(".$str_f_baja.",'%Y%m%d') ".
					" WHERE vehiculo_id = ".$id;

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function vehiculoAlta(
	$modelo_id,
	$n_cantidad_aisentos,
	$patente) {
	$db = DB::singleton();
	
	$str_f_baja = "'".formatPHPFecha(date("d-m-Y"))."'";
	
	$query = "UPDATE vehiculo
	          SET 	 m_baja = 1,
					f_baja = str_to_date(".$str_f_baja.",'%Y%m%d') ".
					" WHERE vehiculo_id = ".$id;
	
	$rs = $db->executeQuery($query);
	
	if (!$rs) {
		applog($db->db_error(), 1);
	}
	
	return $rs;
}

?>
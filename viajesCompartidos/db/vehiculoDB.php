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
	  m.nombre_modelo,
	  CONCAT(nombre_marca,'-',nombre_modelo,': ',patente) as nombre_vehiculo
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
	$usuario_id,
	$n_cantidad_asientos,
	$patente) {
	$db = DB::singleton();	
	
	$query = "INSERT INTO vehiculo (
			modelo_id,
			usuario_id,
			cantidad_asientos,
			patente)
			VALUES (".
			$modelo_id.",".
			$usuario_id.",".
			$n_cantidad_asientos.",upper('".
			$patente."'))";
	        
	
	$rs = $db->executeQuery($query);
	
	if (!$rs) {
		applog($db->db_error(), 1);
	}
	
	return $rs;
}

function vehiculoModifica(
  $vehiculo_id,
  $modelo_id,
  $cantidad_asientos,
  $patente) {

  $db = DB::singleton();	
	
  $query = "UPDATE vehiculo
	        SET 	 modelo_id = ".$modelo_id.",
					 cantidad_asientos = ".$cantidad_asientos.",
					 patente = '".$patente."'
	        WHERE	 vehiculo_id = ".$vehiculo_id;
	
	$rs = $db->executeQuery($query);
	
	if (!$rs) {
		applog($db->db_error(), 1);
	}
	
	return $rs;
}

function GetCantViajePorVehiculo($vehiculo_id = 0) {
    $db = DB::singleton();
    
    $query = "SELECT count(1) as cant FROM viaje WHERE vehiculo_id = $vehiculo_id ";
    
    $rs = $db->executeQuery($query);
    $row = $db->fetch_assoc($rs);
    
    $result = $row['cant'];
    
    return $result;
}

function cantAsientosPorVehiculo($vehiculo_id = 0) {
    $db = DB::singleton();
    
    $query = "SELECT cantidad_asientos as cant FROM viaje WHERE vehiculo_id = $vehiculo_id ";
    
    $rs = $db->executeQuery($query);
    $row = $db->fetch_assoc($rs);
    
    $result = $row['cant'];
    
    return $result;
}


?>
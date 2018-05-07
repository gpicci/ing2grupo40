<?php
require_once('db.php');
require_once('./common/log.php');

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
	
	$query = "SELECT
	modelo_id,
	nombre_modelo,
	cantidad_asientos,
	patente,
    m.d_descripcion as d_modelo,
    mm.d_descripcion as d_marca
  FROM
    vehiculo v,
	modelo m,
	marca mm
  WHERE m_baja = 0
  and	v.modelo_id = m.modelo_id
  and	m.marca_id = mm.marca_id
  and	usuario_id = ".$usuario_id;
	
	$rs = $db->executeQuery($query);
	
	if (!$rs) {
		applog($db->db_error(), 1);
	}
	
	return $rs;
}

?>
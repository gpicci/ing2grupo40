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

?>
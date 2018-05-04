<?php
require_once("./db/db.php");

function getCountRecs($tabla, $campoFiltro, $filtro = '%') {
	$db = DB::singleton();
	$query = "SELECT count(1) as cant FROM ".$tabla." WHERE ".$campoFiltro." LIKE '".$filtro."%'";
	
	$rs = $db->executeQuery($query);
	$row = $db->fetch_assoc($rs);
	$result = $row['cant'];
	
	return $result;
}

function getCountRecsFM($tabla, $filtros = array() ) {
	//soporte para filtros multiples
	$db = DB::singleton();
	$query = "SELECT count(1) as cant FROM (".$tabla;

	foreach ($filtros as &$filtro) {
   	if ($filtro->tipoDato=="S") {
			$query .= " and ( " . $filtro->campo . " LIKE '". $filtro->valor."%' ) ";
		} elseif ($filtro->tipoDato=="FI") {
			$query .= " and ( " . $filtro->campo . " >= '". formatear_fecha($filtro->valor)."' ) ";
		} elseif ($filtro->tipoDato=="FF") {
			$query .= " and ( " . $filtro->campo . " <= '". formatear_fecha($filtro->valor)."' ) ";
   	} else {
     		$query .= " and ( " . $filtro->campo . " = ". $filtro->valor." ) ";
    	}
  	};

	$query .= ") sq";
	
	$rs = $db->executeQuery($query);
	$row = $db->fetch_assoc($rs);
	$result = $row['cant'];
	
	return $result;
}

function formatViewFecha($fechaView) {
	if (!$fechaView) {
		$fecha = null;
	} else {
		$dia = substr($fechaView, 0, 2);
		$mes = substr($fechaView, 3, 2);
		$anio = substr($fechaView, 6, 4);
		$fecha = $anio.$mes.$dia;
	}

	return $fecha;
}


<?php
require_once('db.php');
require_once('./common/log.php');

function usuarioGetCantidad($filter = '%') {
	$db = DB::singleton();

	$query = "SELECT count(1) as cant FROM usuario WHERE correo LIKE '".$filter."'";

	$rs = $db->executeQuery($query);
	$row = $db->fetch_assoc($rs);

	$result = $row['cant'];

	return $result;
}

function getUsuarios($start = 0, $cant = 0, $filter = '%', $orderBy = 'c_id') {

	$db = DB::singleton();
	$query = "SELECT *
			FROM usuario u
			WHERE u.nombre LIKE '".$filter."%' ".
           "ORDER BY ".$orderBy;

	if ($cant != 0) {
		$query .= " LIMIT ".$start.",".$cant;
	}
	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function getUsuario($id) {

	$db = DB::singleton();
	$query =
          	"SELECT
			  usuario_id,
			  nombre,
			  apellido,
			  fecha_nacimiento,
			  correo_electronico,
			  clave,
			  foto
            FROM usuario
			WHERE usuario_id = ".$id;

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function usuarioAlta(
		$nombre,
		$apellido,
		$fecha_nacimiento,
		$correo,
		$clave) {

	$db = DB::singleton();
	$query =
	"INSERT INTO usuario (
	  nombre,
	  apellido,
	  fecha_nacimiento,
	  correo_electronico,
	  clave) ".
	"VALUES (
			'".$nombre."',
			'".$apellido."',
			str_to_date('".$fecha_nacimiento."','%Y-%m-%d'),
			'".$correo."',
			'".$clave."')";

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function usuarioModifica(
  $id,
  $nombre,
  $apellido,
  $fecha_nacimiento,
  $correo,
  $clave) {
	
	$db = DB::singleton();
	$query = "UPDATE usuario ".
				"SET nombre = '".$nombre."',".
				"    apellido = '".$apellido."',".
				"    fecha_nacimiento = str_to_date('".$fecha_nacimiento."','%Y-%m-%d'),".
				"    correo_electronico = '".$correo."',".
				"    clave = '".$clave."' ".
				"WHERE usuario_id = ".$id;
applog($query);
	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;

}

function usuarioBaja($id) {
	$db = DB::singleton();
	
	$str_f_baja = "'".formatPHPFecha(date("d/m/Y"))."'";	
	
	$query = "UPDATE usuario
	          SET 	 m_baja = 1,
					f_baja = ".$str_f_baja.
            "WHERE c_id = ".$id;

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

?>
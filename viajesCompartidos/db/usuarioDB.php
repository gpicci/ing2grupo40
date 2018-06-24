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
			str_to_date('".$fecha_nacimiento."','%d-%m-%Y'),
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
  $clave,
  $foto) {
  	$sqlfoto='';
  	if($_FILES['myimage']['size']>0){
  		$image = addslashes (file_get_contents($_FILES['myimage']['tmp_name']));
		$sqlfoto=" , foto= '".$image."'";
	}
	$db = DB::singleton();
	$query = "UPDATE usuario ".
				"SET nombre = '".$nombre."',".
				"    apellido = '".$apellido."',".
				"    fecha_nacimiento = str_to_date('".$fecha_nacimiento."','%d-%m-%Y'),".
				"    correo_electronico = '".$correo."',".
				"    clave = '".$clave."' ".
				$sqlfoto.
				"WHERE usuario_id = ".$id;

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

function existeUsuario($correo)  {
	$db = DB::singleton();

	$query = "SELECT count(1) as cant
			FROM usuario u
			WHERE u.m_baja = 0
			AND	  u.correo_electronico = '".$correo."'";

	$rs = $db->executeQuery($query);

	$row = $db->fetch_assoc($rs);

	if ($row['cant']>0) {
		return true;
	} else {
		return false;
	}

}

function getCalificacionUsuario($usuario_id, $tipo_pasajero_id) {
    $db = DB::singleton();
  $query = "
            SELECT SUM(puntaje) AS value_sum
            FROM calificacion
            WHERE usuario_evaluado_id= $usuario_id and tipo_pasajero_id= $tipo_pasajero_id";
  $rs = $db->executeQuery($query);
  $row = $db->fetch_assoc($rs);
  $sum = $row['value_sum'];
  if ($sum <= 0) {
      return 0;
  } else {
      return $sum;
  }

} 

function yaExisteCorreo($correo, $user_id){
  $db = DB::singleton();
  $query = "
            SELECT COUNT(*) AS cant
            FROM usuario
            WHERE usuario_id <> $user_id and  correo_electronico = '$correo'";
  $rs = $db->executeQuery($query);
  $row = $db->fetch_assoc($rs);
  $sum = $row['cant'];
  #creo que no anda
  if ($sum != 0) {
      return true;
  } else {
      return false;
  }

} 
?>
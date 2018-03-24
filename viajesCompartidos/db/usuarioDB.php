<?php
require_once('db.php');
require_once('log.php');

function usuarioGetCantidad($filter = '%') {
	$db = DB::singleton();
	 
	$query = "SELECT count(1) as cant FROM isp_usuario WHERE c_id_estado = 1 and d_nombre_usuario LIKE '".$filter."'";
  	
	$rs = $db->executeQuery($query);
	$row = $db->fetch_assoc($rs);
	
	$result = $row['cant'];
	 
	return $result;
}

function getUsuarios($start = 0, $cant = 0, $filter = '%', $orderBy = 'c_id') {

	$db = DB::singleton();
	$query = "SELECT ".
              "u.c_id, u.d_nombre, ".
              "u.d_direccion, ".
              "u.d_telefono1, ".
              "u.d_telefono2, ".
			  "u.d_mail1, ".
              "u.d_mail2, ".
              "u.c_id_estado, ".
              "u.m_externo, ".
              "u.d_nombre_usuario, ".
			  "u.d_pass, ".
			  "u.c_id_rol, ".
			  "u.c_id_tipo_documento, ".
			  "u.n_documento, ".
			  "u.m_permiso, ".
              "u.d_numero_sms, ".
              "r.d_descripcion as d_descripcion_rol ".
              "FROM isp_usuario u, isp_rol_usuario r ".
			  "WHERE u.d_nombre LIKE '".$filter."%' ".
			  " AND u.c_id_estado =1 ".
			  " AND u.c_id_rol = r.c_id " .
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
          	"SELECT c_id, d_nombre, ".
              "d_direccion, ".
              "d_telefono1, ".
              "d_telefono2, ".
				  "d_mail1, ".
              "d_mail2, ".
              "c_id_estado, ".
              "m_externo, ".
              "d_nombre_usuario, ".
				  "d_pass, ".
				  "c_id_rol, ".
				  "c_id_tipo_documento, ".
				  "n_documento, ".
				  "m_permiso, ".
              "d_numero_sms ".
            "FROM isp_usuario ".
            "WHERE c_id = ".$id;

	$rs = $db->executeQuery($query);
   
	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function usuarioAlta(
		$nombre, 
		$direccion, 
		$telefono1, 
		$telefono2, 
		$mail1, 
		$mail2, 
		$estado, 
		$externo, 
		$nombreUsuario, 
		$password, 
		$rol, 
		$tipoDoc, 
		$nroDoc, 
		$permiso, 
		$numeroSMS) {
			
	$db = DB::singleton();
	$query = 
	"INSERT INTO isp_usuario (
			d_nombre, 
			d_direccion, 
			d_telefono1, 
			d_telefono2, 
			d_mail1, 
			d_mail2, 
			c_id_estado, 
			m_externo, 
			d_nombre_usuario, 
			d_pass, 
			c_id_rol, 
			c_id_tipo_documento, 
			n_documento, 
			m_permiso, 
			d_numero_sms) ".
	"VALUES (
			'".$nombre."', 
			'".$direccion."', 
			'".$telefono1."', 
			'".$telefono2."', 
			'".$mail1."', 
			'".$mail2."', 
			".$estado.", 
			".$externo.", 
			'".$nombreUsuario."', 
			'".$password."', 
			".$rol.", 
			".$tipoDoc.", 
			".$nroDoc.", 
			".$permiso.", 
			'".$numeroSMS."')";

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function usuarioModifica($id, $nombre, $direccion, $telefono1, $telefono2, $mail1, $mail2, $estado, $externo, $nombreUsuario, $password, $rol, $tipoDoc, $nroDoc, $permiso, $numeroSMS) {
	$db = DB::singleton();
	$query = "UPDATE isp_usuario ".
				"SET d_nombre = '".$nombre."',".
				"    d_direccion = '".$direccion."',".
				"    d_telefono1 = '".$telefono1."',".
				"    d_telefono2 = '".$telefono2."',".
				"    d_mail1 = '".$mail1."',".
				"    d_mail2 = '".$mail2."',".
				"    c_id_estado = ".$estado.",".
				"    m_externo = ".$externo.",".
				"    d_nombre_usuario = '".$nombreUsuario."',".
				"    d_pass = '".$password."',".
				"    c_id_rol = ".$rol.",".
				"    c_id_tipo_documento = ".$tipoDoc.",".
				"    n_documento = ".$nroDoc.",".
				"    m_permiso = ".$permiso.",".
				"    d_numero_sms = '".$numeroSMS."' ".
				"WHERE c_id = ".$id;
		
	$rs = $db->executeQuery($query);	
	 
	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;

}

function usuarioBaja($id) {
	$db = DB::singleton();
	$query = "UPDATE isp_usuario 
	          SET 	 c_id_estado = 2 ".
            "WHERE c_id = ".$id;
	 
	$rs = $db->executeQuery($query);
	 
	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function rolUsuarioAccesoMenu(
  $c_id_rol,
  $d_codigo_menu){

  $db = DB::singleton();
	
  $query = "SELECT
		    COUNT(1) as cant
		FROM isp_rol_menu rm, isp_opcion_menu m
		WHERE rm.c_id_opcion_menu = m.c_id AND
		      rm.c_id_rol = ".$c_id_rol." AND
		      m.d_codigo = '".$d_codigo_menu."'";
  
  $rs = $db->executeQuery($query);

  $row = $db->fetch_assoc($rs);
	
  if ($row['cant'] == 1) {
  	return true;
  } else {
  	return false;
  }

	
}

function rolUsuarioAccesoOpcion(
	$c_id_rol,
	$d_codigo_sistema){

	$db = DB::singleton();

	$query = "SELECT
		    COUNT(1) as cant
		FROM isp_rol_sistema rm, isp_opcion_sistema m
		WHERE rm.c_id_opcion_sistema = m.c_id AND
		      rm.c_id_rol = ".$c_id_rol." AND
		      m.d_codigo = '".$d_codigo_sistema."'";

	$rs = $db->executeQuery($query);

	$row = $db->fetch_assoc($rs);

	if ($row['cant'] == 1) {
		return true;
	} else {
		return false;
	}
}

function getUsuariosAll($start = 0, $cant = 0, $filter = '%', $orderBy = 'c_id') {

	$db = DB::singleton();
	$query = "SELECT ".
              "u.c_id, u.d_nombre, ".
              "u.d_direccion, ".
              "u.d_telefono1, ".
              "u.d_telefono2, ".
			  "u.d_mail1, ".
              "u.d_mail2, ".
              "u.c_id_estado, ".
              "u.m_externo, ".
              "u.d_nombre_usuario, ".
			  "u.d_pass, ".
			  "u.c_id_rol, ".
			  "u.c_id_tipo_documento, ".
			  "u.n_documento, ".
			  "u.m_permiso, ".
              "u.d_numero_sms, ".
              "r.d_descripcion as d_descripcion_rol ".
              "FROM isp_usuario u, isp_rol_usuario r ".
			  "WHERE ".
			  " u.d_nombre LIKE '".$filter."%' ".		
			  " AND u.c_id_rol = r.c_id " .
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

function getSumIncidenciasUsuarios($start = 0, $cant = 0, $filter = '%', $fIni, $fFin, $orderBy = 'c_id') {
	
	$db = DB::singleton();
	
	$query = "SELECT 
	            u.c_id, 
				u.d_nombre, 
				u.d_nombre_usuario, 
				SUM(IF(c_id_tema = 11, 1, 0)) AS 'instalaciones', 
				SUM(IF(c_id_tema = 6, 1, 0)) AS 'bajasTemp', 
				SUM(IF(c_id_tema = 7, 1, 0)) AS 'bajasEfectivas', 
				SUM(IF(c_id_tema = 12, 1, 0)) AS 'reactivaciones' 
              FROM 
               isp_usuario u 
					LEFT OUTER JOIN isp_incidencia i 
					ON u.c_id = i.c_id_usuario_cierre AND m_cerrada=1 
						AND f_cierre >=  STR_TO_DATE('".$fIni."','%d-%m-%Y') 
						AND f_cierre <=  STR_TO_DATE('".$fFin."','%d-%m-%Y') 
				  WHERE 	  
				   u.d_nombre LIKE '".$filter."%' 
				   and u.c_id_estado = 1 	
				GROUP BY u.d_nombre, u.d_nombre_usuario 
			ORDER BY ".$orderBy;

	if ($cant != 0) {
		$query .= " LIMIT ".$start.",".$cant;
	}
	
	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function getIncidenciasUsuario($start = 0, $cant = 0, $idUsuario = -1, $fIni, $fFin, $orderBy = 'c_id') {

	$db = DB::singleton();

	$query = "SELECT f_cierre, t.d_descripcion AS tema, d_observaciones, d_anotacion_cierre ".
			"FROM isp_incidencia i ".
			"	INNER JOIN isp_tema t ".
			"	ON i.c_id_tema = t.c_id ".
			"WHERE ".
				" m_cerrada=1 ".
					"	AND f_cierre >=  STR_TO_DATE('".$fIni."','%d-%m-%Y') ".
					"	AND f_cierre <=  STR_TO_DATE('".$fFin."','%d-%m-%Y') ".
					"	AND i.c_id_tema IN (6,7,11,12) ".
				" AND i.c_id_usuario_cierre = $idUsuario ";
	
	if ($cant != 0) {
		$query .= " LIMIT ".$start.",".$cant;
	}
	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
	}

	function detIncidenciasUsrGetCantidad($idUsuario = -1, $fIni, $fFin) {
		$db = DB::singleton();
	
		$query = "SELECT count(1) as cant ".
				"FROM isp_incidencia i ".
				"WHERE ".
					" m_cerrada=1 ".
						"	AND f_cierre >=  STR_TO_DATE('".$fIni."','%d-%m-%Y') ".
						"	AND f_cierre <=  STR_TO_DATE('".$fFin."','%d-%m-%Y') ".
						" AND i.c_id_tema IN (6,7,11,12) ".
					" AND i.c_id_usuario_cierre = $idUsuario ";
			
		$rs = $db->executeQuery($query);
		$row = $db->fetch_assoc($rs);
		
		$result = $row['cant'];
		return $result;
	}

?>
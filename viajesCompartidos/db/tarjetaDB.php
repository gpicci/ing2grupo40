<?php
include_once($_SERVER['DOCUMENT_ROOT']."/viajes/db/db.php");
//drequire_once('./common/log.php');

function getTarjetasUsuario($idUsuario) {
  $db = DB::singleton();

  $query = "
            SELECT
            	t.id_tarjeta,
            	t.id_empresa,
            	et.d_nombre_empresa empresa,
                CONCAT(et.d_nombre_empresa, ' ', t.n_tarjeta) as tarjeta,
            	t.n_tarjeta,
            	t.d_nombre_titular,
            	t.n_mes_vence,
	  			t.n_anio_vence,
				concat(t.n_mes_vence,'-',t.n_anio_vence) d_vencimiento,
            	t.n_codigo_verificador,
            	t.m_baja,
            	t.usuario_id
            FROM
                tarjeta_credito T
                 INNER JOIN empresa_tarjetas_credito ET
                 ON t.id_empresa = ET.id_empresa
            WHERE m_baja = 0
            AND	usuario_id = $idUsuario
                ";
  $rs = $db->executeQuery($query);

  if (!$rs) {
	applog($db->db_error(), 1);
  }

  return $rs;
}

function getTarjetaPorId($idTarjeta) {
	$db = DB::singleton();

	$query = "
	SELECT
	  t.id_tarjeta,
	  t.id_empresa,
	  t.n_tarjeta,
	  t.d_nombre_titular,
	  t.n_mes_vence,
	  t.n_anio_vence,
	  t.n_codigo_verificador,
	  t.m_baja,
	  t.usuario_id
	FROM
	  tarjeta_credito t
	WHERE  id_tarjeta = ".$idTarjeta;

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function getEmpresaTarjeta() {
	$db = DB::singleton();

	$query = "
	SELECT
	  t.id_empresa,
	  t.d_nombre_empresa
	FROM
	  empresa_tarjetas_credito t";

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function tarjetaBaja($id) {
	$db = DB::singleton();

	$query = "UPDATE tarjeta_credito
	          SET 	 m_baja = 1
			WHERE id_tarjeta = ".$id;

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function tarjetaAlta(
		$id_empresa,
		$usuario_id,
		$n_tarjeta,
		$d_nombre_titular,
		$n_mes_vence,
		$n_anio_vence,
		$n_codigo_verificador) {

	$db = DB::singleton();

	$query = "INSERT INTO tarjeta_credito (
			id_empresa,
			usuario_id,
			n_tarjeta,
			d_nombre_titular,
			n_mes_vence,
			n_anio_vence,
			n_codigo_verificador)
		VALUES (".
			$id_empresa.",".
			$usuario_id.",'".
			$n_tarjeta."','".
			$d_nombre_titular."',".
			$n_mes_vence.",".
			$n_anio_vence.",'".
			$n_codigo_verificador."')";

			$rs = $db->executeQuery($query);

			if (!$rs) {
				applog($db->db_error(), 1);
			}

			return $rs;
}


?>
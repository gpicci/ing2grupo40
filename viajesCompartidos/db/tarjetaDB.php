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
            	t.n_codigo_verificador, 
            	t.m_baja, 
            	t.usuario_id
            FROM 
                tarjeta_credito T
                 INNER JOIN empresa_tarjetas_credito ET
                 ON t.id_empresa = ET.id_empresa
            WHERE
            	usuario_id = $idUsuario
                ";
  $rs = $db->executeQuery($query);

  if (!$rs) {
	applog($db->db_error(), 1);
  }

  return $rs;
}

function getTarjetasPorId($idTarjeta) {
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
	WHERE  id_tajeta = ".$idTarjeta;
	
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
	  t.nombre_empresa
	FROM
	  empresa_tarjetas_credito t";
	
	$rs = $db->executeQuery($query);
	
	if (!$rs) {
		applog($db->db_error(), 1);
	}
	
	return $rs;
}



?>
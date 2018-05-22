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
            	t.f_vencimiento, 
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



?>
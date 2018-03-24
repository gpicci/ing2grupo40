<?php

function getEstadoUsuario() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_descripcion ".
          "FROM isp_estado_usuario p; ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getRolUsuario() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_descripcion ".
          "FROM isp_rol_usuario p
			WHERE c_id <> 5; ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getTipoDocumento() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_descripcion ".
          "FROM isp_tipo_documento p; ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getEstadoCliente() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_descripcion ".
          "FROM isp_estado_cliente p; ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getTipoCliente() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_descripcion ".
          "FROM isp_tipo_cliente p; ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getLocalidad() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_descripcion ".
          "FROM isp_localidad p
		   WHERE m_baja = 0
		    ORDER BY d_descripcion ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getLocalidadById($id) {
	$db = DB::singleton();
	$query =
		"SELECT ".
      	"c_id, ".
			"d_descripcion ".
		"FROM isp_localidad ".
		"WHERE c_id = ".$id;

	$rs = $db->executeQuery($query);
	return $rs;
}

function getCalleByLocalidad($id_localidad) {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c.c_id, ".
            "c.d_descripcion ".
          "FROM isp_localidad l,
          			isp_calle c,
          			isp_calle_localidad lc
          WHERE l.m_baja = 0 AND
          		c.m_baja = 0 AND
          		lc.c_id_calle = c.c_id and
          			lc.c_id_localidad = l.c_id and
          			lc.c_id_localidad = ".$id_localidad."
			ORDER BY c.d_descripcion";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getCalleById($id) {
	$db = DB::singleton();
	$query =
		"SELECT ".
			"c_id, ".
			"d_descripcion ".
		"FROM isp_calle ".
		"WHERE c_id = ".$id;

	$rs = $db->executeQuery($query);
	return $rs;
}

function getEstadoById($id) {
	$db = DB::singleton();
	$query =
		"SELECT ".
			"c_id, ".
			"d_descripcion ".
		"FROM isp_estado_cliente ".
		"WHERE c_id = ".$id;

	$rs = $db->executeQuery($query);
	return $rs;
}

function getTipoDispositivo() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_descripcion ".
          "FROM isp_tipo_dispositivo p
		   WHERE m_oculto = 0; ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getEstadoDispositivo($fuera_de_uso) {
	$db = DB::singleton();
	$query =
          "SELECT 
            c_id, 
            d_descripcion 
			 FROM isp_estado_dispositivo
			 WHERE c_id <> 7
			 OR 1 = ".$fuera_de_uso;

	$rs = $db->executeQuery($query);
	return $rs;
}

function getTipoAP() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_descripcion ".
          "FROM isp_tipo_ap p; ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getEstadosPosiblesClientes() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_descripcion ".
          "FROM isp_estado_posible_cliente; ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getProveedor() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_nombre ".
          "FROM isp_proveedor p
		   WHERE m_baja = 0";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getTipoServicios() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_descripcion ".
          "FROM isp_tipo_servicio";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getTipoDispositivoById($id) {
	$db = DB::singleton();
	$query =
		"SELECT ".
			"c_id, ".
			"d_descripcion ".
		"FROM isp_tipo_dispositivo ".
		"WHERE c_id = ".$id;

	$rs = $db->executeQuery($query);
	return $rs;
}

function getNodo() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_nombre,
            d_ubicacion,
            d_comentario ".
          "FROM isp_nodo p
         where m_baja = 0
			order by d_nombre; ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getTemaIncById($id) {
	$db = DB::singleton();
	$query =
		"SELECT ".
			"c_id, ".
			"d_descripcion ".
		"FROM isp_tema ".
		"WHERE c_id = ".$id;

	$rs = $db->executeQuery($query);
	return $rs;
}


function getPrioridad() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_descripcion ".
          "FROM isp_prioridad p; ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getTemaInc() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_descripcion ".
          "FROM isp_tema 
		   WHERE m_baja = 0
	       ORDER BY 
	         d_descripcion; ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getUbicacion() {

	$db = DB::singleton();
	$query = "SELECT ".
              "c_id, d_descripcion ".              
              "FROM isp_ubicacion ".
				  "WHERE ifNull(m_baja,0)=0 ".
              "ORDER BY d_descripcion ";
	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function getUsuariosLookup() {

	$db = DB::singleton();
	$query = "SELECT ".
              "c_id, d_nombre ".              
              "FROM isp_usuario ".
			  "WHERE c_id_estado = 1 ".
              "ORDER BY d_nombre ";
	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function getTiposIdFiscalLookup() {

	$db = DB::singleton();
	$query = "SELECT ".
              "c_id, d_descripcion ".              
              "FROM isp_tipo_identificacion_fiscal ".			  
              "ORDER BY d_descripcion ";
	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}
/*
function getAñosPeriodosLookup(){
	$db = DB::singleton();
	$query = "
	SELECT 
		DISTINCT 
		DATE_FORMAT(f_inicio_periodo,'%Y') c_id,
		DATE_FORMAT(f_inicio_periodo,'%Y') d_descripcion
	FROM 
		isp_periodo_calendario c
	ORDER BY 1";
	
	$rs = $db->executeQuery($query);
	
	if (!$rs) {
		applog($db->db_error(), 1);
	}
	
	return $rs;
}
*/

function getPeriodosLookup($sort=""){
	$db = DB::singleton();
	$query = "
	SELECT 
		c_id,d_descripcion,d_descripcion_corta
	FROM 
		isp_periodo_calendario c
	WHERE c.f_inicio_periodo <= '".date('Y-m-d')."'".
	" ORDER BY 1 ".$sort;

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function getPeriodoByDescCorta($d_descripcion_corta){
	$db = DB::singleton();
	$query = "
	SELECT 
		c_id,d_descripcion
	FROM 
		isp_periodo_calendario c
	WHERE c.d_descripcion_corta = ".$d_descripcion_corta;

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function getFormasPago() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_descripcion ".
          "FROM isp_forma_pago ".
			 "WHERE m_baja = 0; ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getTemaIncAll() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_descripcion ".
          "FROM isp_tema 
	       ORDER BY 
	         d_descripcion; ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getLetrasComprobantes() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_letra_comprobante ".
          "FROM isp_letras_comprobantes 
	       ORDER BY 
	         d_letra_comprobante; ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getTemaIncSinCambioHijo() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_descripcion ".
          "FROM isp_tema 
		   WHERE m_baja = 0
		   AND	c_id not in (10,12,20)
	       ORDER BY 
	         d_descripcion; ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getTemaIncSinCambioPadre() {
	$db = DB::singleton();
	$query =
	"SELECT ".
	"c_id, ".
	"d_descripcion ".
	"FROM isp_tema
		   WHERE m_baja = 0
		   AND	c_id not in (10)
	       ORDER BY
	         d_descripcion; ";
	
	$rs = $db->executeQuery($query);
	return $rs;
}

function getTipoTelefono() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_descripcion ".
          "FROM isp_tipo_telefono p; ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getEmpresaCelular() {
	$db = DB::singleton();
	$query =
          "SELECT ".
            "c_id, ".
            "d_descripcion ".
          "FROM isp_empresa_celular p; ";

	$rs = $db->executeQuery($query);
	return $rs;
}

function getLocalidadPayU() {
	$db = DB::singleton();
	$query =
	"SELECT
		DISTINCT l.c_id,l.d_descripcion
	FROM 
		isp_cliente c,
		isp_localidad l
	WHERE c.c_id_localidad = l.c_id
	AND	c.c_id_estado = 1
	AND	IFNULL(c.d_email,' ') <> ' '
	ORDER BY
		l.d_descripcion";

	$rs = $db->executeQuery($query);
	return $rs;
}


function getNombreMesByPeriodo($idPeriodo){
	$db = DB::singleton();

	$db->executeQuery("SET lc_time_names = 'es_ES'");
	
	$query = "
	SELECT
		c_id,
		d_descripcion,
		UPPER(MID(d_descripcion,1,INSTR(d_descripcion,' ')-1)) nombre_mes
	FROM
	  isp_periodo_calendario c 
	WHERE c.c_id = ".$idPeriodo;

	$rs = $db->executeQuery($query);
	
	if (!$rs) {
		applog($db->db_error(), 1);
		$result = "";
	} else {
		$row = $db->fetch_assoc($rs);
	
		$result = $row['nombre_mes'];
	}
	
	return $result;
}

function getPeriodosLookupNoIncomunicados($sort=""){
	$db = DB::singleton();
	$query = "
	SELECT 
		c_id,d_descripcion,d_descripcion_corta
	FROM 
		isp_periodo_calendario c
	WHERE c.f_incomunicados > '".date('Y-m-d')."'".
	"AND	'".date('Y-m-d')."'". "< (
		SELECT c1.f_inicio_periodo
		FROM isp_periodo_calendario c1
		WHERE c1.c_id = c.c_id+1
	)
	ORDER BY 1 ".$sort;

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function getPeriodoFechaActual(){
	$db = DB::singleton();
	$query = "
	SELECT 
		c_id,d_descripcion,d_descripcion_corta,f_inicio_periodo,f_incomunicados
	FROM 
		isp_periodo_calendario c
	WHERE DATE_FORMAT(c.f_inicio_periodo,'%m-%Y') = '".date('m-Y')."'";

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function getPeriodoPayU(){
	$db = DB::singleton();
	$query = "
	SELECT 
		c_id,d_descripcion,d_descripcion_corta
	FROM 
		isp_periodo_calendario c
	WHERE c.f_inicio_periodo >= str_to_date('01-".date('m-Y')."','%d-%m-%Y')";

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function getPeriodoDesdeMes(
  $idPeriodoDesde){
	$db = DB::singleton();
	$query = "
	SELECT 
		c_id,d_descripcion,d_descripcion_corta
	FROM 
		isp_periodo_calendario c
	WHERE c.c_id >= ".$idPeriodoDesde;

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function getArticulosClientesActivos(){
	$db = DB::singleton();
	$query = "
	SELECT
		DISTINCT 
		a.c_id,
		a.d_descripcion
	FROM 
	  isp_cliente c,
	  isp_cliente_servicio s,
	  isp_articulo a
	WHERE c.c_id_estado = 1
	AND	c.c_id = s.c_id_cliente
	AND	s.c_id_articulo= a.c_id
	ORDER BY 
		a.c_id
	";

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function getMailsSistema(){
	
	$db = DB::singleton();
	
	$query = "
	SELECT
		c_id,
		d_usuario_mail,
		d_password,
		d_from_mail,
		d_nombre_from
	FROM
		isp_mail_sistema";
			
	$rs = $db->executeQuery($query);
			
	if (!$rs) {
		applog($db->db_error(), 1);
	}
			
	return $rs;
}

?>
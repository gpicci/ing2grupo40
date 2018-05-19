<?php
require_once('db.php');
require_once('./common/log.php');

function getViajesPorUsuario(
  $usuario_id) {
	
  $db = DB::singleton();

  $query = "
	SELECT
	  v.viaje_id,
	  v.vehiculo_id,
	  m.nombre_marca,
	  mm.nombre_modelo,
	  vv.patente,
	  vv.cantidad_asientos,
	  lo.nombre_localidad AS localidad_origen,  
	  ld.nombre_localidad AS localidad_destino,  
	  t.nombre AS d_tipo_viaje,
	  v.duracion,
	  v.costo,
	  CONCAT(nombre_marca,'-',nombre_modelo,': ',patente) as nombre_vehiculo,
	  d.dia_semana_nombre dia_semana,
	  fecha_salida
	FROM
	  viaje v,
	  vehiculo vv,
	  modelo mm,
	  marca m,
	  localidad lo,
	  localidad ld,
	  tipo_de_viaje t,
	  dia_semana d
	WHERE v.m_baja = 0
	AND	  v.vehiculo_id = vv.vehiculo_id
	AND   vv.modelo_id = mm.modelo_id
	AND   mm.marca_id = m.marca_id
	AND   v.localidad_origen_id = lo.localidad_id
	AND   v.localidad_destino_id = ld.localidad_id
	AND   v.tipo_viaje_id = t.tipo_viaje_id
	AND   v.dia_semana = d.dia_semana_id
	AND   v.usuario_id = ".$usuario_id;

  $rs = $db->executeQuery($query);

  if (!$rs) {
	applog($db->db_error(), 1);
  }

  return $rs;
}

function getViajePorId(
		$viaje_id) {
			
			$db = DB::singleton();
			
			$query = "
	SELECT
	  v.viaje_id,
	  v.vehiculo_id,
	  v.duracion,
	  v.costo,
	  v.localidad_origen_id,
	  v.localidad_destino_id,
	  v.tipo_viaje_id,
	  v.dia_semana,
	  v.fecha_salida,
	  m.nombre_marca,
	  mm.nombre_modelo,
	  vv.patente,
	  vv.cantidad_asientos,
	  lo.nombre_localidad AS localidad_id_origen,
	  ld.nombre_localidad AS localidad_id_destino,
	  t.nombre AS d_tipo_viaje	  
	FROM
	  viaje v,
	  vehiculo vv,
	  modelo mm,
	  marca m,
	  localidad lo,
	  localidad ld,
	  tipo_de_viaje t
	WHERE v.m_baja = 0
	AND	  v.vehiculo_id = vv.vehiculo_id
	AND   vv.modelo_id = mm.modelo_id
	AND   mm.marca_id = m.marca_id
	AND   v.localidad_origen_id = lo.localidad_id
	AND   v.localidad_destino_id = ld.localidad_id
	AND   v.tipo_viaje_id = t.tipo_viaje_id
	AND   v.viaje_id = ".$viaje_id;
			
			$rs = $db->executeQuery($query);
			
			if (!$rs) {
				applog($db->db_error(), 1);
			}
			
			return $rs;
}

function getTiposDeViaje() {
			
  $db = DB::singleton();
			
  $query = "
  SELECT
	tipo_viaje_id,
	nombre
  FROM
	tipo_de_viaje t";
			
  $rs = $db->executeQuery($query);
			
  if (!$rs) {
	applog($db->db_error(), 1);
  }
			
  return $rs;
}

function getDiasSemana() {
	
	$db = DB::singleton();
	
	$query = "
  SELECT
	dia_semana_id,
	dia_semana_nombre
  FROM
	dia_semana d";
	
	$rs = $db->executeQuery($query);
	
	if (!$rs) {
		applog($db->db_error(), 1);
	}
	
	return $rs;
}

function getLocalidad() {
	
	$db = DB::singleton();
	
	$query = "
  SELECT
	localidad_id,
	nombre_localidad
  FROM
	localidad l";
	
	$rs = $db->executeQuery($query);
	
	if (!$rs) {
		applog($db->db_error(), 1);
	}
	
	return $rs;
}

function viajeAlta(
  $usuario_id,			
  $vehiculo_id,
  $localidad_origen_id,
  $localidad_destino_id,
  $duracion,
  $costo,
  $tipo_viaje_id,
  $fecha_salida,
  $dia_semana) {
			
  $db = DB::singleton();					
			
  $query = "INSERT INTO viaje (
	usuario_id,
    vehiculo_id,
	localidad_origen_id,
	localidad_destino_id,
	tipo_viaje_id,
	dia_semana,
	fecha_salida,
	duracion,
	costo)
  VALUES (".
  	$usuario_id.",".
  	$vehiculo_id.",".
  	$localidad_origen_id.",".
  	$localidad_destino_id.",".
  	$tipo_viaje_id.",".
  	$dia_semana.",".
  	"str_to_date('".$fecha_salida."','%d-%m-%Y'),".
	$duracion.",".
  	$costo.")";
		
  $rs = $db->executeQuery($query);
			
  if (!$rs) {
	applog($db->db_error(), 1);
  }
			
  return $rs;
}


function viajeModifica(
	$viaje_id,	
	$vehiculo_id,
	$localidad_origen_id,
	$localidad_destino_id,
	$duracion,
	$costo,
	$tipo_viaje_id,
	$fecha_salida,
	$dia_semana) {
	$db = DB::singleton();
	
	$str_f_baja = "'".formatPHPFecha(date("d-m-Y"))."'";
	
	$query = "UPDATE viaje
	          SET 	vehiculo_id = ".$vehiculo_id.",
					localidad_origen_id = ".$localidad_origen_id.",
					localidad_destino_id = ".$localidad_destino_id.",
					duracion = ".$duracion.",
					costo = ".$costo.",
					tipo_viaje_id = ".$tipo_viaje_id.",
					dia_semana = ".$dia_semana.",
					fecha_salida = str_to_date('".$fecha_salida."','%Y-%m-%d') ".
					" WHERE viaje_id = ".$viaje_id;
	
	$rs = $db->executeQuery($query);
	
	if (!$rs) {
		applog($db->db_error(), 1);
	}
	
	return $rs;
}

function GetCantPaxPorViaje($viaje_id = 0, $estado_id=0 ) {
    $db = DB::singleton();

    //en la tabla de estados el id=2 corresponde a pasajero aprobado para viaje
    $query = "SELECT COUNT(1) cant FROM pasajero WHERE viaje_id = $viaje_id ";
    if ($estado_id!=0) {
        $query.="AND estado_id= $estado_id ";
    }
    
    $rs = $db->executeQuery($query);
    $row = $db->fetch_assoc($rs);
    
    $result = $row['cant'];
    
    return $result;
}

function GetUsuarioPorViaje($viaje_id = 0 ) {
    $db = DB::singleton();
    
    //en la tabla de estados el id=2 corresponde a pasajero aprobado para viaje
    $query = "SELECT usuario_id FROM viaje WHERE viaje_id = $viaje_id ";
    
    $rs = $db->executeQuery($query);
    $row = $db->fetch_assoc($rs);
    
    $result = $row['usuario_id'];
    
    return $result;
}

function getPaxPorViaje($viaje_id=0, $estado_id=0) {
        //$estado_id es el filtro por estado, si está en 0 devuelve todo
        $db = DB::singleton();
        
        $query = "
                SELECT 
                	p.usuario_id, u.apellido, u.nombre, e.descripcion_estado estado
                FROM
                pasajero p
                	INNER JOIN usuario u
                	ON p.usuario_id = u.usuario_id
                	INNER JOIN estado e
                	ON p.estado_id = e.estado_id
                WHERE
                	viaje_id = $viaje_id
                ";
        
        if ($estado_id!=0) {
            $query.="AND p.estado_id=2 ";
        }
        
        $query.="Order by u.apellido, u.nombre ";
        
        $rs = $db->executeQuery($query);
        
        if (!$rs) {
            applog($db->db_error(), 1);
        }
        
        return $rs;
      
}

function viajeBaja($id) {
    $db = DB::singleton();
    
    $str_f_baja = "'".formatPHPFecha(date("d-m-Y"))."'";
 
    $query = "DELETE from pasajero ".
             " WHERE viaje_id = ".$id;
    
    $rs = $db->executeQuery($query);
    if (!$rs) {
        applog($db->db_error(), 1);
        return ;
    }
    
    $cantAprob = getPaxPorViaje($id, 2);
    if ($cantAprob>0) {
        $idUsuario = GetUsuarioPorViaje($id);
        $id_usuario_evaluador = 0;  //id de un usuario que haría de avaluador 
                                    //para las calificaciones generadas por el sistema
        $puntaje = -1;
        
        $query = "INSERT INTO calificacion(viaje_id, usuario_evalua_id, usuario_evaluado_id, puntaje, comentario) ".
            "VALUES ($id,  $id_usuario_evaluador, $idUsuario, $puntaje, 'Baja de viaje con postulantes aprobados') ";
        $rs = $db->executeQuery($query);
        
        if (!$rs) {
            applog($db->db_error(), 1);
            return;
        }
    }
    
    $query = "UPDATE viaje
	          SET 	 m_baja = 1,
					f_baja = str_to_date(".$str_f_baja.",'%Y%m%d') ".
					" WHERE viaje_id = ".$id;
    
    $rs = $db->executeQuery($query);
    
    if (!$rs) {
        applog($db->db_error(), 1);
    }
    
    return $rs;
}

?>
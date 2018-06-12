<?php
require_once('db.php');
require_once('./common/log.php');

function getViajesPorUsuario(
  $usuario_id,
  $propios=1,
  $filtros = array(),
  $f_desde,
  $f_hasta,
  $pendientesPuntuacion=false  ) {

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
	  fecha_salida,
      v.m_cerrado cerrado,
      IfNull(v.m_terminado,0) terminado,
	  CONCAT(u.nombre,' ',u.apellido) piloto
	FROM
	  viaje v,
	  vehiculo vv,
	  modelo mm,
	  marca m,
	  localidad lo,
	  localidad ld,
	  tipo_de_viaje t,
	  dia_semana d,
	  usuario u
	WHERE v.m_baja = 0
	AND	  v.vehiculo_id = vv.vehiculo_id
	AND   vv.modelo_id = mm.modelo_id
	AND   mm.marca_id = m.marca_id
	AND   v.localidad_origen_id = lo.localidad_id
	AND   v.localidad_destino_id = ld.localidad_id
	AND   v.tipo_viaje_id = t.tipo_viaje_id
	AND   v.dia_semana = d.dia_semana_id
	AND	  v.usuario_id = u.usuario_id
	AND	  v.fecha_salida BETWEEN str_to_date('".$f_desde."','%d-%m-%Y') AND str_to_date('".$f_hasta."','%d-%m-%Y')";


    if ($propios==1) {
	   $query .= " AND   v.usuario_id = ".$usuario_id;
    } else {
       $query .= " AND   v.usuario_id <> ".$usuario_id;
    }

    foreach ($filtros as &$filtro) {
    	if ($filtro->tipoDato=="S") {
    		$query .= " and ( " . $filtro->campo . " LIKE '%". $filtro->valor."%' ) ";
    	} elseif ($filtro->tipoDato=="NS") {
    		$query .= " and ( " . $filtro->campo . " NOT LIKE '". $filtro->valor."' ) ";
    	}else {
    		$query .= " and ( " . $filtro->campo . " = ". $filtro->valor." ) ";
    	}
    };

    if ($pendientesPuntuacion) {
        $query .= " AND IFNULL(m_terminado,0) = 1 ";
        $query .= " AND viaje_id NOT IN (SELECT viaje_id FROM calificacion WHERE usuario_evalua_id=$usuario_id) ";
    };
    
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
	  t.nombre AS d_tipo_viaje,
      v.m_cerrado cerrado,
      IfNull(v.m_terminado,0) terminado
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
  $dia_semana,
  $tarjeta_id  ) {

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
  	"str_to_date('".$fecha_salida."','%d-%m-%Y %H:%i:%s'),".
	$duracion.",".
  	$costo.")";

  $rs = $db->executeQuery($query);

  if (!$rs) {
	applog($db->db_error(), 1);
	return $rs;
  }

  $query = "SELECT LAST_INSERT_ID() id";
  $rs = $db->executeQuery($query);
  if (!$rs) {
      applog($db->db_error(), 1);
      return $rs;
  }
  $row = $db->fetch_assoc($rs);
  $viaje_id = $row["id"];

  $query = "INSERT INTO pasajero (tipo_pasajero_id, viaje_id, usuario_id, estado_id, tarjeta_id)
              VALUES (".TIPO_PILOTO.",$viaje_id, $usuario_id, ".ID_APROBADO.", $tarjeta_id) ";

  $rs = $db->executeQuery($query);

  if (!$rs) {
      applog($db->db_error(), 1);
      return $rs;
  }

  $cant = 1;
  $intervalo = 0;
  switch ($tipo_viaje_id) {
      case VIAJE_OCASIONAL:
          $cant = 1;
          $intervalo = 0;
          break;
      case VIAJE_SEMANAL:
          $cant = 4;
          $intervalo = 7;
          break;
      case VIAJE_DIARIO:
          $cant = 30;
          $intervalo = 1;
          break;
  }

  $fechaHora = formatPHPFechaHora($fecha_salida, $f, $h, $m, $s);
  return viajeAgregaOcupacionMultiple($viaje_id, $usuario_id, $fechaHora, $duracion, $cant, $intervalo);

}


function viajeModifica(
	$viaje_id,
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

	$str_f_baja = "'".formatPHPFecha(date("d-m-Y"))."'";

	$query = "UPDATE viaje
	          SET 	vehiculo_id = ".$vehiculo_id.",
					localidad_origen_id = ".$localidad_origen_id.",
					localidad_destino_id = ".$localidad_destino_id.",
					duracion = ".$duracion.",
					costo = ".$costo.",
					tipo_viaje_id = ".$tipo_viaje_id.",
					dia_semana = ".$dia_semana.",
					fecha_salida = str_to_date('".$fecha_salida."','%d-%m-%Y  %H:%i:%s') ".
					" WHERE viaje_id = ".$viaje_id;

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
		return $rs;
	}


	$cant = 1;
	$intervalo = 0;
	switch ($tipo_viaje_id) {
	    case VIAJE_OCASIONAL:
	        $cant = 1;
	        $intervalo = 0;
	        break;
	    case VIAJE_SEMANAL:
	        $cant = 4;
	        $intervalo = 7;
	        break;
	    case VIAJE_DIARIO:
	        $cant = 30;
	        $intervalo = 1;
	        break;
	}

	$fechaHora = formatPHPFechaHora($fecha_salida, $f, $h, $m, $s);

	viajeLimpiaOcupacion($viaje_id);
	return viajeAgregaOcupacionMultiple($viaje_id, $usuario_id, $fechaHora, $duracion, $cant, $intervalo);

}

function GetCantPaxPorViaje($viaje_id = 0, $estado_id=0 ) {
    $db = DB::singleton();

    //en la tabla de estados el id=2 corresponde a pasajero aprobado para viaje
    $query = "SELECT COUNT(1) cant FROM pasajero WHERE viaje_id = $viaje_id AND tipo_pasajero_id=".TIPO_COPILOTO;
    if ($estado_id!=0) {
        $query.=" AND estado_id= $estado_id ";
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
                	and tipo_pasajero_id = ".TIPO_COPILOTO." ";

        if ($estado_id!=0) {
            $query.="AND p.estado_id= ".$estado_id." ";
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

    getPaxPorEstado($id, $cantAprob, $p, $r, $t);
    if ($cantAprob>0) {
        $idUsuario = GetUsuarioPorViaje($id);
        $id_usuario_evaluador = 0;  //id de un usuario que haría de avaluador
                                    //para las calificaciones generadas por el sistema
        $puntaje = -1;

        agregarCalificacion($id, ID_VALIDADOR_APLICACION, $idUsuario, $puntaje, 'Baja de viaje con postulantes aprobados');

        /*
        $query = "INSERT INTO calificacion(viaje_id, usuario_evalua_id, usuario_evaluado_id, puntaje, comentario) ".
            "VALUES ($id,  ".ID_VALIDADOR_APLICACION.", $idUsuario, $puntaje, 'Baja de viaje con postulantes aprobados') ";
        $rs = $db->executeQuery($query);

        if (!$rs) {
            applog($db->db_error(), 1);
            return;
        }
        */
    }

        viajeLimpiaOcupacion($id);

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

function viajePostulaCopiloto($viaje_id, $usuario_id, $tarjeta_id) {
    $db = DB::singleton();

    $str_f_baja = "'".formatPHPFecha(date("d-m-Y"))."'";

    $query = "INSERT INTO pasajero (tipo_pasajero_id, viaje_id, usuario_id, estado_id, tarjeta_id)
              VALUES (".TIPO_COPILOTO.",$viaje_id, $usuario_id, ".ID_APROBACION_PENDIENTE.", $tarjeta_id) ";
    $rs = $db->executeQuery($query);

    if (!$rs) {
        applog($db->db_error(), 1);
    }

    return $rs;
}

function viajeAnulaPostulacion($viaje_id, $usuario_id) {
    $db = DB::singleton();

    $str_f_baja = "'".formatPHPFecha(date("d-m-Y"))."'";

    viajeEstadoCopiloto($viaje_id, $usuario_id, $estado_id, $descripcion );
    if ($estado_id == ID_APROBADO) {
        agregarCalificacion($viaje_id, ID_VALIDADOR_APLICACION, $usuario_id, -1, "Anula postulacion aprobada");
    }

    $query = "DELETE FROM pasajero WHERE viaje_id=$viaje_id and usuario_id=$usuario_id";

    $rs = $db->executeQuery($query);

    if (!$rs) {
        applog($db->db_error(), 1);
    }

    return $rs;
}

function viajeSetEstadoCopiloto($viaje_id, $idUsuarioPax, $idEstado) {
    $db = DB::singleton();

    $str_f_baja = "'".formatPHPFecha(date("d-m-Y"))."'";

    $query = "UPDATE pasajero ".
        "   SET  estado_id = $idEstado ".
        "WHERE viaje_id = $viaje_id and usuario_id = " . $idUsuarioPax;

    $rs = $db->executeQuery($query);

    if (!$rs) {
        applog($db->db_error(), 1);
    }

    return $rs;
}

function viajeRechazarPostulacion($viaje_id, $idUsuarioPax, $idUsuarioRechaza) {

    viajeEstadoCopiloto($viaje_id, $idUsuarioPax, $estado_id, $descripcion_estado);

    if  ($estado_id==ID_APROBADO) {
        agregarCalificacion($viaje_id, ID_VALIDADOR_APLICACION, $idUsuarioRechaza, -1, "Rechaza usuario aprobado");
    }
    viajeSetEstadoCopiloto($viaje_id, $idUsuarioPax, ID_RECHAZADO);
}

function viajeEstadoCopiloto($viaje_id, $idUsuarioPax, &$estado_id, &$descripcion ) {
    $db = DB::singleton();

    $query = "
                SELECT e.estado_id, e.descripcion_estado
                FROM
                pasajero p
                INNER JOIN estado e
                ON p.estado_id = e.estado_id
                WHERE
                p.viaje_id = $viaje_id
                AND p.usuario_id = $idUsuarioPax ";

    $rs = $db->executeQuery($query);

    if($db->num_rows($rs) == 0) {
        $descripcion = "Sin postularse";
        $estado_id=-1;
    } else {
        $row = $db->fetch_assoc($rs);
        $descripcion =  $row["descripcion_estado"];
        $estado_id =  $row["estado_id"];
    }

    if (!$rs) {
        applog($db->db_error(), 1);
    }

    return $estado_id;
}

function existePostulacion($viaje_id = 0, $usuario_id=0 ) {
    $db = DB::singleton();

    //en la tabla de estados el id=2 corresponde a pasajero aprobado para viaje
    $query = "SELECT COUNT(1) cant FROM pasajero
              WHERE viaje_id = $viaje_id and usuario_id = $usuario_id ";

    $rs = $db->executeQuery($query);
    $row = $db->fetch_assoc($rs);

    $result = $row['cant'];

    return $result;
}

function getPaxPorEstado($viaje_id=0, &$aprobados, &$pendientes, &$rechazados, &$total) {
    //$estado_id es el filtro por estado, si está en 0 devuelve todo
    //NO se incluye el pasajero-piloto
    $db = DB::singleton();

    $query = "
            SELECT IFNULL(SUM(IF(estado_id=2, 1, 0)),0) aprobados,
                    IFNULL(SUM(IF(estado_id=1, 1, 0)),0)  pendientes,
                    IFNULL(SUM(IF(estado_id=3, 1, 0)),0)  rechazados,
                    IFNULL(COUNT(1),0) total
            FROM pasajero
            WHERE
            viaje_id = $viaje_id
            and tipo_pasajero_id=".TIPO_COPILOTO;


    $rs = $db->executeQuery($query);
    $row = $db->fetch_assoc($rs);

    $aprobados = $row['aprobados'];
    $pendientes = $row['pendientes'];
    $rechazados = $row['rechazados'];
    $total = $row['total'];


    return $total;
}

function costosViaje($viaje_id, &$costoPax, &$comision) {
    $db = DB::singleton();

    $pendientes = 0;
    $aprobados = 0;
    $postulados = 0;

    // la funcion getPaxPorEstado no incluye al piloto para los calculos
    getPaxPorEstado($viaje_id, $aprobados, $pendientes, $rechazados, $postulados);

    $rsViaje = getViajePorId($_REQUEST["viaje_id"]);
    $rowViaje = $db->fetch_assoc($rsViaje);

    $importeViaje = $rowViaje["costo"];
    $costoPax = $importeViaje / ($aprobados + 1);  //es +1 si en pasajero no incluimos al piloto

    $comision = round( (COMISION * $importeViaje / 100), 2);

    return $importeViaje;
}

function viajeCierre($id) {
    $db = DB::singleton();

    $str_f_baja = "'".formatPHPFecha(date("d-m-Y"))."'";

    $pendientes = 0;
    $aprobados = 0;
    $postulados = 0;

    // la funcion getPaxPorEstado no incluye al piloto para los calculos
    getPaxPorEstado($id, $aprobados, $pendientes, $rechazados, $postulados);

    $rsViaje = getViajePorId($_REQUEST["viaje_id"]);
    $rowViaje = $db->fetch_assoc($rsViaje);

    $importeViaje = $rowViaje["costo"];
    $importeUnitario = round($importeViaje / ($aprobados + 1),2);  //es +1 si en pasajero no incluimos al piloto
    $comision = round( (COMISION * $importeViaje / 100), 2);

    // cargo pago de los pasajero aprobados
    $query = "UPDATE pasajero set monto_pagado = ".$importeUnitario." ".
             " WHERE viaje_id = $id and estado_id = ".ID_APROBADO.
             " and tipo_pasajero_id = ".TIPO_COPILOTO;
    $rs = $db->executeQuery($query);
    if (!$rs) {
        applog($db->db_error(), 1);
        return;
    }

    // cargo pago del piloto
    $query = "UPDATE pasajero set monto_pagado = ".($importeUnitario + $comision)." ".
        " WHERE viaje_id = $id ".
        " and tipo_pasajero_id = ".TIPO_PILOTO;

    applog($query, 8);

    $rs = $db->executeQuery($query);
    if (!$rs) {
        applog($db->db_error(), 1);
        return;
    }

    // elimino postulaciones de pasajeros pendientes de aprobacion
    $query = "DELETE FROM pasajero ".
        " WHERE viaje_id = $id and estado_id = ".ID_APROBACION_PENDIENTE;
    $rs = $db->executeQuery($query);
    if (!$rs) {
        applog($db->db_error(), 1);
        return;
    }

    $query = "UPDATE viaje set m_cerrado = 1 WHERE viaje_id = $id ";
    $rs = $db->executeQuery($query);

    if (!$rs) {
        applog($db->db_error(), 1);
    }

    return $rs;
}

function viajeCerrado($viaje_id) {
    $db = DB::singleton();

    $rsViaje = getViajePorId($_REQUEST["viaje_id"]);
    $rowViaje = $db->fetch_assoc($rsViaje);

    $cerrado = ($rowViaje["cerrado"]==VIAJE_CERRADO);

    return $cerrado;
}

function viajeTerminado($viaje_id) {
    $db = DB::singleton();

    $rsViaje = getViajePorId($_REQUEST["viaje_id"]);
    $rowViaje = $db->fetch_assoc($rsViaje);

    $result = $rowViaje["terminado"];

    return $result;
}

function GetTarjetaIdPilotoViaje($viaje_id = 0 ) {
    $db = DB::singleton();

    //en la tabla de estados el id=2 corresponde a pasajero aprobado para viaje
    $query = "
                SELECT ifNull(tarjeta_id,0) tarjeta_id
                FROM
                pasajero
                WHERE
                viaje_id = $viaje_id
                AND tipo_pasajero_id = ".TIPO_PILOTO;

    $rs = $db->executeQuery($query);
    if ($db->num_rows($rs)>0) {
        $row = $db->fetch_assoc($rs);
        $result = $row['tarjeta_id'];
    } else {
        $result = 0;
    }

    return $result;
}

function viajeLimpiaOcupacion($viaje_id) {
    $db = DB::singleton();

    $query = "DELETE FROM ocupacion_usuario where viaje_id= $viaje_id ";
    $rs = $db->executeQuery($query);

    if (!$rs) {
        applog($db->db_error(), 1);
    }

    return $rs;
}


function viajeAgregaOcupacion($viaje_id, $usuario_id, $fechaHora, $duracion) {
    $db = DB::singleton();

    $query = "
                INSERT INTO OCUPACION_USUARIO(viaje_id, usuario_id, desde, hasta)
                VALUES ($viaje_id, $usuario_id, '$fechaHora', ('$fechaHora' + INTERVAL $duracion HOUR) )
                ";

    $rs = $db->executeQuery($query);

    if (!$rs) {
        applog($db->db_error(), 1);
    }

    return $rs;
}

function viajeAgregaOcupacionMultiple($viaje_id, $usuario_id, $fechaHora, $duracion, $cant, $intervalo, $table_name="OCUPACION_USUARIO") {
    //intervalo: cada cuantos dias se genera la ocupacion
    //cant: cantidad de ocuapciones a generar

    $db = DB::singleton();

    for($i = 0; $i < $cant; ++$i) {
        $dias = ($i*$intervalo);
        $query = "
                    INSERT INTO $table_name(viaje_id, usuario_id, desde, hasta)
                    VALUES ($viaje_id, $usuario_id, '$fechaHora' + INTERVAL $dias DAY, ('$fechaHora' + INTERVAL $dias DAY + INTERVAL $duracion HOUR) )
                    ";

        $rs = $db->executeQuery($query);

        if (!$rs) {
            applog($db->db_error(), 1);
        }
        echo $i;
    }

    return $rs;
}

function validaOcupacion($viaje_id, $usuario_id, $fechaHora, $tipo_viaje_id, $duracion ) {
    //para viajes que no existen (es decir para el momento del alta) utilizar algun id inexistente
    //por ejemplo 0 o -1

    $db = DB::singleton();

    $cant = 1;
    $intervalo = 0;
    switch ($tipo_viaje_id) {
        case VIAJE_OCASIONAL:
            $cant = 1;
            $intervalo = 0;
            break;
        case VIAJE_SEMANAL:
            $cant = 4;
            $intervalo = 7;
            break;
        case VIAJE_DIARIO:
            $cant = 30;
            $intervalo = 1;
            break;
    }


    $query = "CREATE TEMPORARY TABLE IF NOT EXISTS OCUPACION_USUARIO_TMP AS (SELECT * FROM OCUPACION_USUARIO WHERE 1=0)";
    $rs = $db->executeQuery($query);
    if (!$rs) {
        applog($db->db_error(), 1);
        return $rs;
    }

    $query = "TRUNCATE TABLE OCUPACION_USUARIO_TMP ";
    $rs = $db->executeQuery($query);
    if (!$rs) {
        applog($db->db_error(), 1);
        return $rs;
    }

    viajeAgregaOcupacionMultiple($viaje_id, $usuario_id, $fechaHora, $duracion, $cant, $intervalo, "OCUPACION_USUARIO_TMP");

    $query = "
                SELECT COUNT(1) cant
                FROM OCUPACION_USUARIO_TMP OU
                WHERE
                (OU.usuario_id=$usuario_id) AND
                EXISTS (SELECT * FROM OCUPACION_USUARIO OU2
                	WHERE (OU2.viaje_id<>$viaje_id) AND (OU2.usuario_id=$usuario_id) AND
                	( ((OU.desde>=OU2.desde) AND (OU.desde<=OU2.hasta)) OR
                	  ((OU.hasta>=OU2.desde) AND (OU.hasta<=OU2.hasta))
                	 )
                	)
                ";

    $rs = $db->executeQuery($query);
    if (!$rs) {
        applog($db->db_error(), 1);
        return $rs;
    }

    $row = $db->fetch_assoc($rs);

    if ($row['cant']!=0) {
        $result = false;
    } else {
        $result = true;
    }

    return $result;
}

function agregarCalificacion($viaje_id, $usuario_evalua_id, $usuario_evaluado_id, $puntaje, $comentario) {
    $db = DB::singleton();

    $query = "INSERT INTO calificacion(viaje_id, usuario_evalua_id, usuario_evaluado_id, puntaje, comentario) ".
        "VALUES ($viaje_id,  $usuario_evalua_id, $usuario_evaluado_id, $puntaje, '$comentario') ";
    $rs = $db->executeQuery($query);

    if (!$rs) {
        applog($db->db_error(), 1);
    }

    return $rs;
}

function viajeFinalizar($id) {
    $db = DB::singleton();

    $str_f_baja = "'".formatPHPFecha(date("d-m-Y"))."'";

    $query = "UPDATE viaje set m_terminado = 1 WHERE viaje_id = $id ";
    $rs = $db->executeQuery($query);

    if (!$rs) {
        applog($db->db_error(), 1);
    }

    return $rs;


}

function getPilotosViajesActuales($usuario_id, $propios ) {
	$db = DB::singleton();

	$query = "
	SELECT
	  -1 usuario_id,
 	  'TODOS' piloto
	union
	SELECT DISTINCT
      v.usuario_id,
	  CONCAT(u.nombre,' ',u.apellido) piloto
	FROM
	  viaje v,
	  usuario u
	WHERE v.m_baja = 0
	AND   v.usuario_id = u.usuario_id
	AND	  v.m_terminado =0
	AND	  v.m_cerrado = 0 ";

	if ($propios==1) {
		$query .= "AND   v.usuario_id = ".$usuario_id;
	} else {
		$query .= "AND   v.usuario_id <> ".$usuario_id;
	}

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function getLocOrigenViajesActuales($usuario_id, $propios ) {
	$db = DB::singleton();

	$query = "
	SELECT
	  -1 localidad_origen_id,
 	  'TODOS' localidad_origen
	union
	SELECT DISTINCT
      l.localidad_id localidad_origen_id,
	  l.nombre_localidad localidad_origen
	FROM
	  viaje v,
	  localidad l
	WHERE v.m_baja = 0
	AND   v.localidad_origen_id = l.localidad_id
	AND	  v.m_terminado =0
	AND	  v.m_cerrado = 0  ";

	if ($propios==1) {
		$query .= "AND   v.usuario_id = ".$usuario_id;
	} else {
		$query .= "AND   v.usuario_id <> ".$usuario_id;
	}

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function getLocDestinoViajesActuales($usuario_id, $propios ) {
	$db = DB::singleton();

	$query = "
	SELECT
	  -1 localidad_destino_id,
 	  'TODOS' localidad_destino
	union
	SELECT DISTINCT
      l.localidad_id localidad_destino_id,
	  l.nombre_localidad localidad_destino
	FROM
	  viaje v,
	  localidad l
	WHERE v.m_baja = 0
	AND   v.localidad_destino_id = l.localidad_id
	AND	  v.m_terminado =0
	AND	  v.m_cerrado = 0 ";

	if ($propios==1) {
		$query .= "AND   v.usuario_id = ".$usuario_id;
	} else {
		$query .= "AND   v.usuario_id <> ".$usuario_id;
	}

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}

function getTipoViajeViajesActuales($usuario_id, $propios ) {
	$db = DB::singleton();

	$query = "
	SELECT
	  -1 tipo_viaje_id,
 	  'TODOS' tipo_viaje
	union
	SELECT DISTINCT
      t.tipo_viaje_id,
	  t.nombre tipo_viaje
	FROM
	  viaje v,
	  tipo_de_viaje t
	WHERE v.m_baja = 0
	AND   v.tipo_viaje_id = t.tipo_viaje_id
	AND	  v.m_terminado =0
	AND	  v.m_cerrado = 0  ";

	if ($propios==1) {
		$query .= "AND   v.usuario_id = ".$usuario_id;
	} else {
		$query .= "AND   v.usuario_id <> ".$usuario_id;
	}

	$rs = $db->executeQuery($query);

	if (!$rs) {
		applog($db->db_error(), 1);
	}

	return $rs;
}


?>
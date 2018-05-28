<?php
require_once(DB_DIR.'/viajeDB.php');
require_once(DB_DIR.'/vehiculoDB.php');

function validaFecha($fecha) {
	$result = true;
	$partes = explode('-',$fecha);
	
	$dia = $partes[0];
	$mes = $partes[1];
	$anio = $partes[2];
	
	if (checkdate ( $mes , $dia , $anio) ){
		$today = date("Y-m-d H:i:s");
		$fechaViaje = "$anio-$mes-$dia 00:00:00";
		
		return ($fechaViaje > $today);
	} else {
		return false;
	}
	
}

if ($_REQUEST['op'] == 'a') {
	if (!validaFecha($_REQUEST['fecha_salida'])) {
		$_SESSION['mensajesPendientes'][]="Fecha invalida.";
		header('Location: main.php?accion=viajes&folder='.BROWSE_DIR);
	} else {
		
		viajeAlta(
				$_SESSION['user_id'],
				$_REQUEST['vehiculo_id'],
				$_REQUEST['localidad_origen_id'],
				$_REQUEST['localidad_destino_id'],
				$_REQUEST['duracion'],
				$_REQUEST['costo'],
				$_REQUEST['tipo_viaje_id'],
				$_REQUEST['fecha_salida'],
				$_REQUEST['dia_semana_id']);
	}
} elseif ($_REQUEST['op'] == 'm') {
	if (!validaFecha($_REQUEST['fecha_salida'])) {
		$_SESSION['mensajesPendientes'][]="Fecha invalida.";
		header('Location: main.php?accion=viajes&folder='.BROWSE_DIR);
	} else {
		
		viajeModifica(
				$_REQUEST['viaje_id'],
				$_REQUEST['vehiculo_id'],
				$_REQUEST['localidad_origen_id'],
				$_REQUEST['localidad_destino_id'],
				$_REQUEST['duracion'],
				$_REQUEST['costo'],
				$_REQUEST['tipo_viaje_id'],
				$_REQUEST['fecha_salida'],
				$_REQUEST['dia_semana_id']);
	}
} elseif ($_REQUEST['op'] == 'b') {
	viajeBaja($_REQUEST['viaje_id']);
	
} elseif ($_REQUEST['op'] == 'p') {
	//postulacion para copiloto
	viajePostulaCopiloto($_REQUEST['viaje_id'], $_REQUEST['usuario_id'], $_REQUEST["tarjeta_id"]);
} elseif ($_REQUEST['op'] == 'v') {
	//aprobacion de postulacion
	$asientos = cantAsientosPorVehiculo($_REQUEST['vehiculo_id']);
	getPaxPorEstado($viaje_id=0, $aprobados, $pendientes, $rechazados, $total);
	
	if (($aprobados + 1) >= $asientos) {
		$_SESSION['mensajesPendientes'][]="No hay asientos disponibles para nuevos pasajeros";
	} else {
		viajeSetEstadoCopiloto($_REQUEST['viaje_id'], $_REQUEST['idUsuarioPax'], ID_APROBADO);
	}
} elseif ($_REQUEST['op'] == 'z') {
	//rechazo postulacion
	viajeSetEstadoCopiloto($_REQUEST['viaje_id'], $_REQUEST['idUsuarioPax'], ID_RECHAZADO);
} elseif ($_REQUEST['op'] == 'c') {
	viajeCierre($_REQUEST['viaje_id']);
}


if ($_REQUEST['op'] == 'p') {
	header('Location: main.php?accion=viajes&propios=0&folder='.BROWSE_DIR);
} elseif (($_REQUEST['op'] == 'v') || ($_REQUEST['op'] == 'z')){
	header('Location: main.php?accion=viajeView&folder=views&op=m&viaje_id='.$_REQUEST['viaje_id']);
} else {
	header('Location: main.php?accion=viajes&folder='.BROWSE_DIR);
}


?>
<?php
require_once(DB_DIR.'/viajeDB.php');

if ($_REQUEST['op'] == 'a') {
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
  
} elseif ($_REQUEST['op'] == 'm') {
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
	
} elseif ($_REQUEST['op'] == 'b') {
	viajeBaja($_REQUEST['viaje_id']);
	
} elseif ($_REQUEST['op'] == 'p') {
    viajePostulaCopiloto($_REQUEST['viaje_id'], $_REQUEST['usuario_id']);
} elseif ($_REQUEST['op'] == 'v') {
    viajeEstadoCopiloto($_REQUEST['viaje_id'], $_REQUEST['idUsuarioPax'], ID_APROBADO);
} elseif ($_REQUEST['op'] == 'z') {
    viajeEstadoCopiloto($_REQUEST['viaje_id'], $_REQUEST['idUsuarioPax'], ID_APROBACION_PENDIENTE);
}


if ($_REQUEST['op'] == 'p') {
    header('Location: main.php?accion=viajes&propios=0&folder='.BROWSE_DIR);
} elseif (($_REQUEST['op'] == 'v') || ($_REQUEST['op'] == 'z')){
    header('Location: main.php?accion=viajeView&folder=views&op=m&viaje_id='.$_REQUEST['viaje_id']);
} else {
    header('Location: main.php?accion=viajes&folder='.BROWSE_DIR);
}


?>
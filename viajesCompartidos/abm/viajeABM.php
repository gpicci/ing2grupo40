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
}

header('Location: main.php?accion=viajes&folder='.BROWSE_DIR);

?>
<?php
require_once(DB_DIR.'/viajeDB.php');

if ($_REQUEST['op'] == 'a') {
  viajeAlta(
  	$_SESSION['user_id'],
    $_REQUEST['vehiculo_id'], 
  	$_SESSION['localidad_origen_id'],
  	$_REQUEST['localidad_destino_id'],
  	$_REQUEST['duracion'],
  	$_REQUEST['costo'],
  	$_REQUEST['tipo_viaje_id'], 
  	$_REQUEST['fecha_salida'],
  	$_REQUEST['dia_semana']);
  
} elseif ($_REQUEST['op'] == 'm') {
	vehiculoModifica(
	  $_REQUEST['vehiculo_id'],
	  $_REQUEST['modelo_id'],
	  $_REQUEST['cantidad_asientos'],
	  $_REQUEST['patente']);
	
} elseif ($_REQUEST['op'] == 'b') {
	vehiculoBaja($_REQUEST['vehiculo_id']);
}

header('Location: main.php?accion=viajes&folder='.BROWSE_DIR);

?>
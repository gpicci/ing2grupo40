<?php
require_once(DB_DIR.'/vehiculoDB.php');

if ($_REQUEST['op'] == 'a') {
  vehiculoAlta(
    $_REQUEST['modelo_id'], 
  	$_SESSION['user_id'],
  	$_REQUEST['cantidad_asientos'], 
  	$_REQUEST['patente']);
  
} elseif ($_REQUEST['op'] == 'm') {
	vehiculoModifica(
	  $_REQUEST['vehiculo_id'],
	  $_REQUEST['modelo_id'],
	  $_REQUEST['cantidad_asientos'],
	  $_REQUEST['patente']);
	
} elseif ($_REQUEST['op'] == 'b') {
	vehiculoBaja($_REQUEST['vehiculo_id']);
}

header('Location: main.php?accion=vehiculos&folder='.BROWSE_DIR);

?>
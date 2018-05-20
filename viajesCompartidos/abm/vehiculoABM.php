<?php
require_once(DB_DIR.'/vehiculoDB.php');

function validarBaja($id, &$mensajes) {
    if (GetCantViajePorVehiculo($id) != 0) {
        $mensajes[]="El vehiculo tiene viajes asignados";
        return false;
    } else {
        return true;
    }
}

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
    $mensajes=array();
    
    if (validarBaja($_REQUEST['vehiculo_id'], $mensajes)) {
        vehiculoBaja($_REQUEST['vehiculo_id']);
    } else {
        $_SESSION['mensajesPendientes'] = $mensajes;
    }
    
}

header('Location: main.php?accion=vehiculos&folder='.BROWSE_DIR);

?>
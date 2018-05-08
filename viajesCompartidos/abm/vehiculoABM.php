<?php
require_once(DB_DIR.'/vehiculoDB.php');

if ($_REQUEST['op'] == 'a') {
  vehiculoAlta(
    $_REQUEST['nombre'], 
  	$_REQUEST['apellido'], 
  	$_REQUEST['fecha_nacimiento'], 
  	$_REQUEST['correo_electronico'], 
  	$_REQUEST['clave']);
  
  header('Location: login.php');
} elseif ($_REQUEST['op'] == 'm') {
	vehiculoModifica(
	$_REQUEST['idUsuario'],
	$_REQUEST['nombre'],
	$_REQUEST['apellido'],
	$_REQUEST['fecha_nacimiento'],
	$_REQUEST['correo_electronico'],
	$_REQUEST['clave']);
	
	header('Location: main.php?accion=inicio');
} elseif ($_REQUEST['op'] == 'b') {
	vehiculoBaja($_REQUEST['vehiculo_id']);
}

header('Location: main.php?accion=vehiculos&folder='.BROWSE_DIR);

?>
<?php
require_once(DB_DIR.'/usuarioDB.php');

if ($_REQUEST['op'] == 'a') {
  usuarioAlta(
    $_REQUEST['nombre'], 
  	$_REQUEST['apellido'], 
  	$_REQUEST['fecha_nacimiento'], 
  	$_REQUEST['correo_electronico'], 
  	$_REQUEST['clave']);
  
  header('Location: login.php');
} elseif ($_REQUEST['op'] == 'm') {
	usuarioModifica(
	$_REQUEST['idUsuario'],
	$_REQUEST['nombre'],
	$_REQUEST['apellido'],
	$_REQUEST['fecha_nacimiento'],
	$_REQUEST['correo_electronico'],
	$_REQUEST['clave']);
	
	header('Location: main.php?accion=inicio');
} elseif ($_REQUEST['op'] == 'b') {
	usuarioBaja($_REQUEST['idUsuario']);
}


?>
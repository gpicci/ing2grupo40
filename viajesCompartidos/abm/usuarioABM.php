<?php
require_once(DB_DIR.'/usuarioDB.php');

$mensajes=array();

if ($_REQUEST['op'] == 'a') {
	if (existeUsuario($_REQUEST['correo_electronico']))  {
  	$mensajes[]="El correo electronico ya se encuentra registrado";
  	$_SESSION['mensajesPendientes'] = $mensajes;
  	header("Location: main.php?accion=usuarioView&folder=views&op=a");
  } else  {
  	usuarioAlta(
  			$_REQUEST['nombre'],
  			$_REQUEST['apellido'],
  			$_REQUEST['fecha_nacimiento'],
  			$_REQUEST['correo_electronico'],
  			$_REQUEST['clave']);
  	header('Location: login.php');
  }  
  
} elseif ($_REQUEST['op'] == 'm') {
	if (existeUsuario($_REQUEST['correo_electronico']))  {
  		$mensajes[]="El correo electronico ya se encuentra registrado";
  		$_SESSION['mensajesPendientes'] = $mensajes;
  		header("Location: main.php?accion=usuarioView&folder=views&op=m");
  	}else{
		usuarioModifica(
			$_REQUEST['idUsuario'],
			$_REQUEST['nombre'],
			$_REQUEST['apellido'],
			$_REQUEST['fecha_nacimiento'],
			$_REQUEST['correo_electronico'],
			$_REQUEST['clave'],
			$_REQUEST['foto']
		);
		header('Location: main.php?accion=inicio');
	}
} elseif ($_REQUEST['op'] == 'b') {
	usuarioBaja($_REQUEST['idUsuario']);
}


?>
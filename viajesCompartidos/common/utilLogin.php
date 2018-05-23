<?php
require_once('./db/db.php');
require_once('log.php');
require_once("./db/usuarioDB.php");

function validarUsuario($correo, $clave) {
	$db = DB::singleton();

	$query = "SELECT usuario_id as numero
			FROM usuario
			WHERE correo_electronico = '".$correo."' ".
   			"AND   clave = '".$clave."'";

	$rs = $db->executeQuery($query);


   if (!$rs) {
   	$res = null;
   } else {
   	$row = $db->fetch_assoc($rs);
   	$res = $row['numero'];
   }
   
   return $res;
}

function realizarLogin($correo, $clave,$accion){
  session_start();
  $error = null;
  
  $userID = validarUsuario($correo, $clave);

  if($userID) {
	$_SESSION['logged_in'] = TRUE;
	$_SESSION['username'] = $correo;
	$_SESSION['user_id'] = $userID;
	$_SESSION['sess_time'] = time();

	$db = DB::singleton();
	$rs = getUsuario($_SESSION["user_id"]);

	$row = $db->fetch_assoc($rs);

	$_SESSION['nombre_usuario'] = $row["nombre"].' '.$row["apellido"];

	header("Location: main.php?accion=".$accion);

  } else {
    $error = 'Datos incorrectos, por favor controle su usuario y clave.';
  }

  return $error;
}

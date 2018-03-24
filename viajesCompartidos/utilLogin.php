<?php
require_once('db.php');
require_once('log.php');
require_once("db/usuarioDB.php");

function validarUsuario($usuario, $password) {
	$db = DB::singleton();
   
	$query = "SELECT c_id as numero ".
   			"FROM isp_usuario ".
   			"WHERE c_id_estado = 1 ".
   			"AND    d_nombre_usuario = '".$usuario."' ".
   			"AND   d_pass = '".$password."'"; 
	
   $rs = $db->executeQuery($query);
   $row = $db->fetch_assoc($rs);
   
   if (!$rs) {
   	applog($db->db_error(), 1);
   	$res = null;
   } else {
   	$res = $row['numero'];
   }

   return $res;          
}

function realizarLogin($usuario, $password,$accion){

	$error=null;
	$userID = validarUsuario($usuario, $password);
	if($userID) {
		session_start();
		 
		$_SESSION['logged_in'] = TRUE;
		$_SESSION['username'] = $usuario;
		$_SESSION['user_id'] = $userID;
		$_SESSION['sess_time'] = time();
		
		$db = DB::singleton();
		$rs = getUsuario($_SESSION["user_id"]);
		 
		$row = $db->fetch_assoc($rs);
		 
		$_SESSION['id_rol'] = $row["c_id_rol"];
	
		$_SESSION['nombre_usuario'] = $row["d_nombre"];
		
		header("Location: main.php?accion=".$accion);		

	} else {
		$error = 'Datos incorrectos, por favor controle su usuario y clave.';
	}	
	
	return $error;
}

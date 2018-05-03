<?php
require_once('../db/db.php');
require_once('log.php');
require_once("../db/usuarioDB.php");
  session_start();
  
  $_SESSION['logged_in'] = TRUE;
  $_SESSION['username'] = 'automati';
  $_SESSION['user_id'] = USUARIO_PROCESO_AUTOMATICO;
  $_SESSION['sess_time'] = time();
    	
  $db = DB::singleton();
  $rs = getUsuario($_SESSION["user_id"]);
    	
	$row = $db->fetch_assoc($rs);
    	
	$_SESSION['id_rol'] = $row["c_id_rol"];
		
	$_SESSION['nombre_usuario'] = $row["d_nombre"];
	
?>
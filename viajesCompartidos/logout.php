<?php
	require_once("db/db.php");
	
	$db = DB::singleton();
	
	$db->close();

	if (!isset($_SESSION)) {
		session_start();
	}
	$_SESSION = array();
	session_destroy();
	
	header('Location: login.php');	
?>
<?php
require_once('./config.php');
if (!isset($_SESSION)) {
	session_start();
}

if (isset($_SESSION['sess_time'])) {
	if ((time()  - $_SESSION['sess_time']) > SESSION_INACTIVE_TIME_LIMIT) {
		unset($_SESSION['sess_time']);
		$_SESSION['logged_in'] = FALSE;
		header("Location: sessionEnd.php");
		exit; // Necesario para que se corte la ejecucion en los archivos que incluyen a este
	} else {
		$_SESSION['sess_time'] = time();
	}
} else {
	if(!isset($_SESSION['logged_in']) OR ($_SESSION['logged_in'] == FALSE)) {
		unset($_SESSION['sess_time']);
		header("Location: login.php");
		exit; // Necesario para que se corte la ejecucion en los archivos que incluyen a este
	} else {
		$_SESSION['sess_time'] = time();
	}
}
?>
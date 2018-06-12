<?php
require_once(DB_DIR.'/tarjetaDB.php');
require_once(COM_DIR.'/util.php');

if ($_REQUEST['op'] == 'a') {
	if (getUltimoDiaMes($_REQUEST['n_anio_vence'],$_REQUEST['n_mes_vence']) > getUltimoDiaMes(date('Y'),date('m'))) {
	  $mensajes[]="El mes de vencimiento es menor al mes corriente";
	  $_SESSION['mensajesPendientes'] = $mensajes;
	  header("Location: main.php?accion=tarjetaView&folder=views&op=a");
	} else {
		tarjetaAlta(
				$_REQUEST['id_empresa'],
				$_SESSION['user_id'],
				$_REQUEST['n_tarjeta'],
				$_REQUEST['d_nombre_titular'],
				$_REQUEST['n_mes_vence'],
				$_REQUEST['n_anio_vence'],
				$_REQUEST['n_codigo_verificador']);
		header('Location: main.php?accion=tarjetas&folder='.BROWSE_DIR);
	}
} elseif ($_REQUEST['op'] == 'b') {
	tarjetaBaja($_REQUEST['id_tarjeta']);
	header('Location: main.php?accion=tarjetas&folder='.BROWSE_DIR);
}



?>
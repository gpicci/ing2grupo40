<?php
require_once(DB_DIR.'/tarjetaDB.php');

if ($_REQUEST['op'] == 'a') {
  tarjetaAlta(
    $_REQUEST['id_empresa'],
  	$_SESSION['user_id'],
  	$_REQUEST['n_tarjeta'],
  	$_REQUEST['d_nombre_titular'],
  	$_REQUEST['n_mes_vence'],
  	$_REQUEST['n_anio_vence'],
  	$_REQUEST['n_codigo_verificador']);

} elseif ($_REQUEST['op'] == 'b') {
	tarjetaBaja($_REQUEST['id_tarjeta']);
}

header('Location: main.php?accion=tarjetas&folder='.BROWSE_DIR);

?>
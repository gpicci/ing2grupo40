<?php
require_once(DB_DIR.'/usuarioDB.php');

if ($_REQUEST['op'] == 'a') {
	usuarioAlta($_REQUEST['nombre'], $_REQUEST['direccion'], $_REQUEST['telefono1'], $_REQUEST['telefono2'], $_REQUEST['mail1'], $_POST['mail2'], $_POST['estado'], $_POST['externo'], $_REQUEST['nombreUsuario'], $_REQUEST['password'], $_REQUEST['rol'], $_REQUEST['c_id_tipo_documento'], $_REQUEST['nroDoc'], $_REQUEST['permiso'], $_REQUEST['numeroSMS']);
} elseif ($_REQUEST['op'] == 'm') {
	usuarioModifica($_REQUEST['idUsuario'], $_REQUEST['nombre'], $_REQUEST['direccion'], $_REQUEST['telefono1'], $_REQUEST['telefono2'], $_REQUEST['mail1'], $_POST['mail2'], $_POST['estado'], $_POST['externo'], $_REQUEST['nombreUsuario'], $_REQUEST['password'], $_REQUEST['rol'], $_REQUEST['c_id_tipo_documento'], $_REQUEST['nroDoc'], $_REQUEST['permiso'], $_REQUEST['numeroSMS']);
} elseif ($_REQUEST['op'] == 'b') {
	usuarioBaja($_REQUEST['idUsuario']);
}

header('Location: main.php?accion=usuarios&folder='.ABM_BROWSE_DIR);
?>
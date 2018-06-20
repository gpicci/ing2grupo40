<?php
require_once(DB_DIR.'/preguntaRespuestaDB.php');
require_once(COM_DIR.'/util.php');

if ($_REQUEST['op'] == 'p') {
  altaPregunta(
  	$_REQUEST['viaje_id'],
  	$_SESSION['user_id'],
  	$_REQUEST['pregunta']);

} elseif ($_REQUEST['op'] == 'r') {
	altaRespuesta(
	  $_REQUEST['pregunta_respuesta_id'],
	  $_REQUEST['viaje_id'],
	  $_SESSION['user_id'],
	  $_REQUEST['respuesta']);
}

header('Location: main.php?accion=preguntaRespuestaViaje&viaje_id='.$_REQUEST['viaje_id'].'&propios='.$_REQUEST['propios'].'&folder='.BROWSE_DIR);

?>
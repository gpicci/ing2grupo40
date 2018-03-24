<?php
/*
 * Funcion para realizar log de aplicación.
 * Se loguea al archivo que indica la variable LOGFILE definida en config.php 
 *
 * Ejemplo de salida generada
 * [16:36:14 22/04/09] [7] [1240428974] logging in 	 at C:\Apache2.2\htdocs\login\login.php (line 7) user: ruso  
 * 
 * @return void
 *   
 * @param   string  mensaje a loguear 
 * @param   integer prioridad del mensaje de log
 * @param   string  usuario que ejecuto la operacion de log
 *
 * Niveles de prioridad (Pear Log class)
 * 0 System is unusable 
 * 1 Immediate action required
 * 2 Critical conditions
 * 3 Error conditions
 * 4 Warning conditions
 * 5 Normal but significant
 * 6 Informational
 * 7 Debug-level messages
 * 8 Ignorar llamado a pagina de Error
 *   
 */

require_once ("common/util.php");

function applog($msg, $priority = 7, $user = "") {
   $dbgMsg = null;   
   $dbgTrace = debug_backtrace();

   foreach($dbgTrace as $dbgIndex => $dbgInfo) {
      $dbgMsg .= "\tat " . $dbgInfo['file'] . " (line ". $dbgInfo['line'] . ")";
    }

   error_log("[".date("H:i:s d/m/y", time())."] ".
             "[".$priority."] ".
             "[".time()."] ".
   			 "[".browserDetect()."] ".
             $msg." ".$dbgMsg." user: ".$user."\n", 3, LOGFILE);
   
   if ($priority != 8) {
   	header('Location:main.php?accion=errorAplicacion');
   }
}

function mktlog($msg, $priority = 7, $user = "") {
	$dbgMsg = null;

	error_log("[".date("H:i:s d/m/y", time())."] ".
             "[".$priority."] ".
             "[".time()."] ".
	$msg." ".$dbgMsg." user: ".$user."\n", 3, LOGFILEMKT);
}

function confirmationPayULog($msg, $priority = 7, $user = "") {
	$dbgMsg = null;

	error_log("[".date("H:i:s d/m/y", time())."] ".
             "[".$priority."] ".
             "[".time()."] ".
	$msg." ".$dbgMsg." user: ".$user."\n", 3, LOGCONFPAYU);
}

?>
<?php
$conectadoOK = FALSE;

function setConectado(){
	global $conectadoOK;

	$conectadoOK=TRUE;
}

function setDesconectado(){
	global $conectadoOK;

	$conectadoOK=FALSE;
}

function estaConectado(){
	global $conectadoOK;

	return $conectadoOK;
}


function connectFW() {
	$ip_mikrotik = '190.220.23.1';
	$user_mikrotik = 'sistema';
	$pass_mikrotik = 'MVocl487';

	if ((isset($ip_mikrotik)) && (isset($user_mikrotik))&& (isset($pass_mikrotik))) {
		 
		$API = new routeros_api();
		 
		$API->debug = false;

		if ($API->connect($ip_mikrotik, $user_mikrotik, $pass_mikrotik)) {
			setConectado();
			return $API;
		}
		else {
			setDesconectado();
		}
	} else {
		setDesconectado();
	}

}

function disconnectFW($apiFW) {
	$apiFW->disconnect();
}


function deshabilitaFW(){
	$error=0;
	
	if (APLICACION_EN_MODO_DEBUG) {
		$error = 0;		
	} else {
		$conn=connectFW();
		
		if (estaConectado()){	
			$ARRAY=$conn->comm("/ip/firewall/filter/disable",array(
				  	  	   "numbers"     => "10"));
			
			
			$error=0;
		} else {
			$error=-1;
		}
		
	  if (estaConectado()) {
		  disconnectFW($conn);
	  }
	}
		
	return $error;
	
}

function habilitaFW(){

	$error=0;
	
	if (APLICACION_EN_MODO_DEBUG) {
		$error = 0;
	} else {
		$conn=connectFW();
		
		if (estaConectado()){	
			
			$ARRAY=$conn->comm("/ip/firewall/filter/enable",array(
				  	  	   "numbers"     => "10"));
			
			
			$error=0;
		} else {
			$error=-1;
		}
		
		disconnectFW($conn);
	}
		
	return $error;
	
}

?>

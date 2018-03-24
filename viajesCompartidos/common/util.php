<?php
function getLpad($numero,$digitos) {
    return str_pad($numero,$digitos,"0",STR_PAD_LEFT);
}

function formatPHPFecha($fechaPHP) {
	if (!$fechaPHP) {
	   $fecha = null;
	} else {
	   $dia = substr($fechaPHP, 0, 2);
	   $mes = substr($fechaPHP, 3, 2);
	   $anio = substr($fechaPHP, 6, 4);
	   $fecha = $anio.$mes.$dia;
	}
	return $fecha;
}

function formatMSSQLFecha($fechaMSSQL) {
	if (!$fechaMSSQL) {
	   	$fecha = null;
	} else {
	   	$anio = substr($fechaMSSQL, 0, 4);
	   	$mes = substr($fechaMSSQL, 5, 2);
	   	$dia = substr($fechaMSSQL, 8, 2);
		$fecha = $dia.'/'.$mes.'/'.$anio;
	}
	
	return $fecha;
}

function generarPassword(){
	$password=""; 
    //$ptrn1=$ptrn2=$ptrn3="aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ1234567890";
	$ptrn1=$ptrn2=$ptrn3="abcdefghijklmnopqrstuvwxyz1234567890";
     $length=strlen($ptrn3); 
    $contador=0; 
    $lenght_p3 = strlen($ptrn3); 
    while($contador<$lenght_p3){ 
        $largo = strlen($ptrn1); 
        $matriz[$contador]=substr($ptrn1,0,1); 
        $ptrn1=substr($ptrn1,1,$largo-1); 
        $contador++; 
    } 
    $lenght_p3 = strlen($ptrn3); 
    $i=0; 
    while($i<6){ 
        $largo=strlen($ptrn2); 
        $contador=0; 
        $value= substr($ptrn2,rand(0,$largo-1),1); 
        while($contador<$lenght_p3){ 
            if($value == $matriz[$contador]) 
                $nro=$contador; 
            $contador++; 
        } 
        $valor=$largo-($nro); 
        $ptrn2=substr($ptrn2,0,$nro).substr($ptrn2,$nro+1,$valor); 
        $ptrn4=$ptrn2; 
        $password.=$value; 
        $c=0; 
        while($c<$largo){ 
            $matriz[$c]=substr($ptrn4,0,1); 
            $ptrn4=substr($ptrn4,1,$largo-1); 
            $c++; 
        } 
        $i++; 
    }
    return $password; 
}

function formatear_fecha ($fecha) {
	$a = explode ("-", $fecha);
	$fecha_formateada = $a[2]."-".$a[1]."-".$a[0];
	return $fecha_formateada;
}

function formatPHPFecha2($fechaPHP) {
	if (!$fechaPHP) {
		$fecha = null;
	} else {
		$anio = substr($fechaPHP, 0, 4);
		$mes = substr($fechaPHP, 5, 2);
		$dia = substr($fechaPHP, 8, 2);
		$fecha = $dia.'-'.$mes.'-'.$anio;
	}
	return $fecha;
}

function quitar_tildes($cadena) {
$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù");
$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
$texto = str_replace($no_permitidas, $permitidas ,$cadena);
return $texto;
}

function mailValido($mail){
	return preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $mail);
}

/**

* Funcion que devuelve un array con los valores:

*	os => sistema operativo

*	browser => navegador

*	version => version del navegador

*/

function browserDetect() {

	$browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
	$os=array("WIN","MAC","LINUX");

	# definimos unos valores por defecto para el navegador y el sistema operativo
	$info['browser'] = "OTHER";

	# buscamos el navegador con su sistema operativo
	foreach($browser as $parent){
		$userAgent='OTHER';
		
		if (isset($_SERVER['HTTP_USER_AGENT'])) {
			$userAgent=$_SERVER['HTTP_USER_AGENT'];
		}

		$s = strpos(strtoupper($userAgent), $parent);
		$f = $s + strlen($parent);
	
		$version = substr($userAgent, $f, 15);
		$version = preg_replace('/[^0-9,.]/','',$version);
	
		if ($s){
			$info['browser'] = $parent;
		}
	}

	# devolvemos el valor del browser
	return $info['browser'];

}

?>

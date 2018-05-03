<?php
  require_once("config.php"); 

  if (isset($_REQUEST["popup"])) {
  	require_once("./common/sessionSetPopup.php");
  	$popup = $_REQUEST["popup"];
  } else {  	
  	require_once("./common/sessionSet.php");
  	$popup = 0;
  }
  

  if (isset($_REQUEST["accion"])) {
  	$accion = $_REQUEST["accion"];
  	$_SESSION["accion_actual"] = $accion;
  } else {
  	//si no paso una nueva accion, mantengo la accion anterior.
  	if (isset($_SESSION["accion_actual"])) {
  		$accion = $_SESSION["accion_actual"];
  	} else {
  		//accion por defecto
  		$accion = "inicio";
  	}
  };
  
  
  if (isset($_REQUEST["folder"])) {
  	$folder_accion = $_REQUEST["folder"] . "/";
  	$_SESSION["folder_actual"] = $_REQUEST["folder"] . "/";
  } else {
  	$folder_accion = "";
  }
  
?>
<?php

	//acciones que requieren tratamientos particulares
	if ($accion=="vehiculoView") {
		include("./views/vehiculoViewHeader.php");
	}

   // incluimos el header de la pagina si no es un popup
   if ($popup<>1) {
   	if ($accion == 'usuarioView') {
   		include("./common/headerRegistro.php");
   	} else{
   		include("./common/header.php");
   	}
   } else {   	
   	//hay que hacer echo del tag body
     echo "<body>";
   }   
  
  	include($folder_accion.$accion.".php");


?>
<script language="javascript" type="text/javascript">
  var excluidos = new Array(
		  "d_observaciones_ap",
		  "d_comentario",
		  "d_area_cobertura",
		  "d_comentario_pc",
		  "observaciones",
		  "d_texto",
		  "anotacionCierre",
		  "d_observacion",
		  "d_observaciones",
		  "d_visibilidad_nodo",
		  "d_observacion_altura",
		  "d_dificultad_acceso",
		  "d_tiempo_instalacion",
		  "d_permiso_acceso",
		  "d_observaciones_generales",
		  "d_comentario",
		  "d_comentario_pc",
		  "d_area_cobertura");
</script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
	<meta http-equiv="content-type" content="Mime-Type; charset=ISO-8859-1" />
	<link rel="stylesheet" type="text/css" href="./css/general.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="./css/menu.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="./css/table.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="./css/form.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="./css/jquery-ui.css" media="screen" />

	<script type='text/javascript' src='js/isp.js'></script>
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type='text/javascript' src='js/DropCalendar.js'></script>
	<script type="text/javascript" src="editor/source.js" ></script>

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
  	<script type="text/javascript" src="js/filtroCombo.js"></script>

</head>

</html>
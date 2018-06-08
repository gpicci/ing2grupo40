<?php
	require_once(DB_DIR.'/viajeDB.php');

	$db = DB::singleton();

	// Obtener el id actual, por defecto es el primero
	$idUsuario = (isset($_SESSION['user_id'])) ? $_SESSION['user_id']: -1;
	$viaje_id = -1;
	$cant = 0;

	if ( (isSet($_REQUEST['propios'])) && ($_REQUEST['propios']==0) )  {
	    $propios = 0;
	    $rs = getViajesPorUsuario($idUsuario, $propios);
	} else {
	    $propios = 1;
	    $rs = getViajesPorUsuario($idUsuario, $propios);
	}
	
?>
	<form name='formViajes' id='formViajes' method='post' action='' >
	<input type='hidden' name='op' id='op' value='' />
	<input type='hidden' name='usuario_id' id='usuario_id' value='<?php print ($idUsuario)?>' />
	<input type='hidden' name='propios' id='propios' value='<?php print ($propios)?>' />
	<div id="content">
		<div id="right">
<?php

	if($db->num_rows($rs) == 0) {
		print('No hay viajes ingresados.');
	} else {
		// Table header
?>
	<table>
		<tr>
      		<td align="center"><b>SEL</b></td>
      		<td align="center"><b>TIPO DE VIAJE</b></td>
         	<td align="center"><b>DIA</b></td>
         	<td align="center"><b>FECHA SALIDA</b></td>
         	<td align="center"><b>ORIGEN</b></td>
         	<td align="center"><b>DESTINO</b></td>
         	<td align="center"><b>VEHICULO</b></td>
         	<td align="center"><b>ASIENTOS</b></td>
<?php
            if ($propios!=1) {
                print ('<td align="center"><b>APROBACION</b></td>');
            }
?>         	
			<td align="center"><b>Postulados</b></td>
			<td align="center"><b>Aprobados</b></td>
   	</tr>
<?php
	while ($row = $db->fetch_assoc($rs)) {
		$cant = $cant+1;
		print('<tr>');
		if ($viaje_id == -1) {
			$viaje_id= $row['viaje_id'];
		 	print('<td align="center"><input type="radio" name="viaje_id" id="viaje_id" value="'.$row['viaje_id'].'" checked="checked" /></td>');
		} else {
			if ($viaje_id== $row['viaje_id']) {
		 		print('<td align="center"><input type="radio" name="viaje_id" id="viaje_id" value="'.$row['viaje_id'].'" checked="checked" /></td>');
		 	} else {
		 		print('<td align="center"><input type="radio" name="viaje_id" id="viaje_id" value="'.$row['viaje_id'].'" /></td>');
		 	}
		}
		
		//la columna de cant. de asientos la voy a utilizar para
		//cant. de asientos si el viaje esta abierto
		//y para mostrar que esta cerrado si es este el caso
		if ($row["terminado"]==1) {
		    $asientos = "<div style=\"color: #FF0000;\"><b> Viaje Finalizado</div>";
		} elseif ($row["cerrado"]==1) {
		    $asientos = "<div style=\"color: #FF0000;\"><b> Viaje Cerrado</div>";
		} else {
		    $asientos = $row['cantidad_asientos'];
		}
		
		print('
         <td align="center">' . $row['d_tipo_viaje'] . '</td>
         <td align="center">' . $row['dia_semana'] . '</td>
         <td align="center">' . formatMSSQLFechaHora($row['fecha_salida'],$f,$h,$m,$s) . '</td>
         <td align="center">' . $row['localidad_origen'] . '</td>
		 <td align="center">' . $row['localidad_destino'] . '</td>
         <td align="center">' . $row['nombre_vehiculo'] . '</td>
		 <td align="center">' . $asientos . '</td>');
                        if ($propios!=1) {
                            viajeEstadoCopiloto($row['viaje_id'], $idUsuario, $estado_id, $estadoPostulacion );
                            print ('<td align="center"> '. $estadoPostulacion . '</td>');
                        }
                        
        $pendientes = 0;
        $aprobados = 0;
        $postulados = 0;
        $rechazados = 0;
        getPaxPorEstado($row['viaje_id'], $aprobados, $pendientes, $rechazados, $postulados);
        print('
        <td align="center">' . $postulados . '</td>
        <td align="center">' . $aprobados . '</td>');
        
		print ('</tr>');
	}
	print("</table>");
}

?>
		</div>
	</div>
	<div id="left">
		<div class="box">
			<div>Total viajes: <?php print($cant); ?></div>
			<div><hr/></div>
			<?php if ($propios==1) { ?>
			<div><a href="javascript:performAltaViaje('formViajes');">Nuevo Viaje</a></div>
			<div><hr/></div>
				<?php if ($cant>0) { ?>
					<div><a href="javascript:performModViaje('formViajes');">Detalles del Viaje</a></div>
					<div><hr/></div>
					<div><a href="javascript:performBajaViaje('formViajes');">Eliminar Viaje</a></div>
					<div><hr/></div>
					<div><a href="javascript:performCerrarViaje('formViajes');">Cerrar Viaje</a></div>
					<div><hr/></div>
					<div><hr/></div>
					<div><a href="javascript:performTerminarViaje('formViajes');">Marcar Viaje Terminado</a></div>
					<div><hr/></div>
				<?php }
				} elseif ($cant>0) { ?>
				<div><a href="javascript:performPostulacion('formViajes');">Postularse a un Viaje</a></div>
				<div><hr/></div>
				<div><a href="javascript:performBajaPostulacion('formViajes');">Anular postulacion</a></div>
				<div><hr/></div>
				<div><a href="javascript:performVerViaje('formViajes');">Ver Detalle</a></div>
				<div><hr/></div>
			<?php }; ?>
			<div><p><br/></p></div>
			<div><hr/></div>
		</div>
	</div>
	</form>
</body>
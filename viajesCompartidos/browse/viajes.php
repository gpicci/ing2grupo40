<?php	
	require_once(DB_DIR.'/viajeDB.php');

	$db = DB::singleton();

	// Obtener el id actual, por defecto es el primero
	$idUsuario = (isset($_SESSION['user_id'])) ? $_SESSION['user_id']: -1;	
	$viaje_id = -1;
	$cant = 0;
	
?>
	<form name='formViajes' id='formViajes' method='post' action='' >	
	<input type='hidden' name='op' id='op' value='' />
	<input type='hidden' name='usuario_id' id='op' value='<?php print ($idUsuario)?>' />
	<div id="content">
		<div id="right">
<?php
    if ( (isSet($_REQUEST['propios'])) && ($_REQUEST['propios']==0) )  {
        $propios = 0;
        $rs = getViajesPorUsuario($idUsuario, $propios);
    } else {
        $propios = 1;
        $rs = getViajesPorUsuario($idUsuario, $propios);
    }
	
	
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
		print('
         <td align="center">' . $row['d_tipo_viaje'] . '</td>
         <td align="center">' . $row['dia_semana'] . '</td>
         <td align="center">' . $row['fecha_salida'] . '</td>
         <td align="center">' . $row['localidad_origen'] . '</td>
		 <td align="center">' . $row['localidad_destino'] . '</td>
		 <td align="center">' . $row['nombre_vehiculo'] . '</td>
		</tr>');
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
			<div><a href="javascript:performModViaje('formViajes');">Modifica Viaje</a></div>
			<div><hr/></div>
			<div><a href="javascript:performBajaViaje('formViajes');">Elimina Viaje</a></div>
			<div><hr/></div>
			<?php } else { ?>
				<div><a href="javascript:performPostulacion('formViajes');">Postularse a Viaje</a></div>
				<div><hr/></div>
			<?php }; ?>
			<div><p><br/></p></div>        
			<div><hr/></div>			
		</div>
	</div>
	</form>
</body>
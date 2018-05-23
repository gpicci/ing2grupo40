<?php	
	require_once(DB_DIR.'/tarjetaDB.php');

	$db = DB::singleton();

	// Obtener el id actual, por defecto es el primero
	$idUsuario = (isset($_SESSION['user_id'])) ? $_SESSION['user_id']: -1;	
	$vehiculo_id = -1;
	$cant = 0;
	
?>
	<form name='formTarjetas' id='formTarjetas' method='post' action='' >	
	<input type='hidden' name='op' id='op' value='' />
	<div id="content">
		<div id="right">
<?php
	$rs = getVehiculosPorUsuario($idUsuario);
	
	if($db->num_rows($rs) == 0) {
		print('No hay vehiculos ingresados.');
	} else {
		// Table header
?>
	<table>
		<tr>
      	<td align="center"><b>SEL</b></td>
         <td align="center"><b>EMPRESA</b></td>
         <td align="center"><b>NUMERO</b></td>
         <td align="center"><b>VENCIMIENTO</b></td>         
   	</tr>
<?php 
	while ($row = $db->fetch_assoc($rs)) {
		$cant = $cant+1;
		print('<tr>');
		if ($vehiculo_id == -1) {
			$vehiculo_id= $row['vehiculo_id'];
		 	print('<td align="center"><input type="radio" name="vehiculo_id" id="vehiculo_id" value="'.$row['vehiculo_id'].'" checked="checked" /></td>');
		} else {
			if ($vehiculo_id== $row['vehiculo_id']) {
		 		print('<td align="center"><input type="radio" name="vehiculo_id" id="vehiculo_id" value="'.$row['vehiculo_id'].'" checked="checked" /></td>');
		 	} else {
		 		print('<td align="center"><input type="radio" name="vehiculo_id" id="vehiculo_id" value="'.$row['vehiculo_id'].'" /></td>');
		 	}
		} 
		print('
         <td align="center">' . $row['nombre_marca'] . '</td>
         <td align="center">' . $row['nombre_modelo'] . '</td>
         <td align="center">' . $row['patente'] . '</td>
         <td align="center">' . $row['cantidad_asientos'] . '</td>
		</tr>');
	}
	print("</table>");
}

?>
		</div>
	</div>
	<div id="left">
		<div class="box">
			<div>Total vehiculos: <?php print($cant); ?></div>
			<div><hr/></div>
			<div><a href="javascript:performAltaVehiculo('formTarjetas');">Nuevo Vehiculo</a></div>
			<div><hr/></div>
			<div><a href="javascript:performModVehiculo('formTarjetas');">Modifica Vehiculo</a></div>
			<div><hr/></div>
			<div><a href="javascript:performBajaVehiculo('formTarjetas');">Elimina Vehiculo</a></div>
			<div><hr/></div>
			<div><p><br/></p></div>        
			<div><hr/></div>			
		</div>
	</div>
	</form>
</body>
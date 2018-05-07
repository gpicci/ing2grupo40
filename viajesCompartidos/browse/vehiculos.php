<?php	
	require_once(DB_DIR.'/vehiculoDB.php');

	$db = DB::singleton();

	// Obtener el id actual, por defecto es el primero
	$idUsuario = (isset($_SESSION['user_id'])) ? $_SESSION['user_id']: -1;	
	
?>
	<form name='formVehiculos' id='formVehiculos' method='post' action='' >	
	<div id="content">
		<div id="right">
<?php
	$rs = getVehiculosPorUsuario($idUsuario);
	
	if($db->num_rows($rs) == 0) {
		print('No hay usuarios ingresados.');
	} else {
		// Table header
?>
	<table>
		<tr>
      	<td><b>Sel</b></td>
         <td><b>Marca</b></td>
         <td><b>Modelo</b></td>
         <td><b>Patente</b></td>
         <td><b>Cantidad de Aisentos</b></td>
   	</tr>
<?php 
	while ($row = $db->fetch_assoc($rs)) {
		print('<tr>');
		if ($idUsuario == -1) {
			$idUsuario = $row['c_id'];
		 	print('<td><input type="radio" name="idUsuario" id="idUsuario" value="'.$row['c_id'].'" checked="checked" /></td>');
		} else {
		 	if ($idUsuario == $row['c_id']) {
		 		print('<td><input type="radio" name="idUsuario" id="idUsuario" value="'.$row['c_id'].'" checked="checked" /></td>');
		 	} else {
		 		print('<td><input type="radio" name="idUsuario" id="idUsuario" value="'.$row['c_id'].'" /></td>');
		 	}
		} 
		print('<td>' . $row['d_nombre'] . '</td>
         <td>' . $row['d_direccion'] . '</td>
         <td>' . $row['d_telefono1'] . '</td>
         <td>' . $row['d_mail1'] . '</td>
         <td>' . $row['d_nombre_usuario'] . '</td>
         <td>' . $row['d_descripcion_rol'] . '</td>
		</tr>');
	}
	print("</table>");
}

//getPageFooter('formVehiculos', $pagsTotal, $pagActual, $sort, $filtro, 'Usuario');
getPageFooter('formVehiculos', $pagsTotal, $pagActual, $sort, 'Usuario');
?>
		</div>
	</div>
	<div id="left">
		<div class="box">
			<div>Total usuarios: <?php print(usuarioGetCantidad()); ?></div>
			<div><hr/></div>
			<div><a href="javascript:performAltaUsuario('formVehiculos');">Nuevo Usuario</a></div>
			<div><hr/></div>
			<div><a href="javascript:performModUsuario('formVehiculos');">Modifica Usuario</a></div>
			<div><hr/></div>
			<div><a href="javascript:performBajaUsuario('formVehiculos');">Elimina Usuario</a></div>
			<div><hr/></div>
			<div><p><br/></p></div>        
			<div><hr/></div>
			<fieldset>
				<legend>Filtro (por nombre)</legend>
					<input type="text" name="filtro" id="filtro" value="<?php print(($filtro != '%') ? $filtro : ''); ?>" />
					<p>
						<a href="javascript:changePageUsuario('formVehiculos', '<?php print($sort); ?>', -1, -1, document.formVehiculos.filtro.value);">Aplicar</a>
						<a href="javascript:clearFilter('formVehiculos', '<?php print($sort); ?>', -1, -1, 'filtro', '%')">Quitar</a>
					</p>
			</fieldset>
		</div>
	</div>
	</form>
</body>
<?php
	require_once('config.php');
	require_once('common/pages.php');
	require_once(DB_DIR.'/usuarioDB.php');

	$db = DB::singleton();

	// Determinar el orden, por defecto es por apellido de usuario
	$sort = (isset($_POST['sort'])) ? $_POST['sort'] : 'c_id';
	// Aplicar filtro, si existe
	$filtro = (isset($_POST['filtro'])) ? $_POST['filtro'] : '%';
	// Obtener el id actual, por defecto es el primero
	//$idUsuario = (isset($_POST['idUsuario'])) ? $_POST['idUsuario'] : -1;
	$idUsuario = -1;
	
	$pagsTotal = getPageCount('isp_usuario', 'd_nombre_usuario', $filtro);
	$pagActual = getActualPage();
?>
	<form name='formUsuarios' id='formUsuarios' method='post' action='' >
	<input type='hidden' name='op' id='op' value='' />
	<input type='hidden' name='sort' id='sort' value='<?php print($sort); ?>' />
	<input type='hidden' name='pagsTotal' id='pagsTotal' value='<?php print($pagsTotal); ?>' />
	<input type='hidden' name='pagActual' id='pagActual' value='<?php print($pagActual); ?>' />
	<div id="content">
		<div id="right">
<?php
	$rs = getUsuarios($pagActual, RECS_PER_PAGE, $filtro, $sort);
	
	if($db->num_rows($rs) == 0) {
		print('No hay usuarios ingresados.');
	} else {
		// Table header
?>
	<table>
		<tr>
      	<td><b>Sel</b></td>
         <td><b><a href="javascript:submitForm('formUsuarios', 'd_nombre', <?php print($pagsTotal); ?>, <?php print($pagActual); ?>, '<?php print($filtro); ?>')">Nombre</a></b></td>
         <td><b>Direcci&oacute;n</b></td>
         <td><b>Tel&eacute;fono 1</b></td>
         <td><b>Mail 1</b></td>
         <td><b><a href="javascript:submitForm('formUsuarios', 'd_nombre_usuario', <?php print($pagsTotal); ?>, <?php print($pagActual); ?>, '<?php print($filtro); ?>')">Nombre usuario</a></b></td>
         <td><b>Rol</b></td>
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

//getPageFooter('formUsuarios', $pagsTotal, $pagActual, $sort, $filtro, 'Usuario');
getPageFooter('formUsuarios', $pagsTotal, $pagActual, $sort, 'Usuario');
?>
		</div>
	</div>
	<div id="left">
		<div class="box">
			<div>Total usuarios: <?php print(usuarioGetCantidad()); ?></div>
			<div><hr/></div>
			<div><a href="javascript:performAltaUsuario('formUsuarios');">Nuevo Usuario</a></div>
			<div><hr/></div>
			<div><a href="javascript:performModUsuario('formUsuarios');">Modifica Usuario</a></div>
			<div><hr/></div>
			<div><a href="javascript:performBajaUsuario('formUsuarios');">Elimina Usuario</a></div>
			<div><hr/></div>
			<div><p><br/></p></div>        
			<div><hr/></div>
			<fieldset>
				<legend>Filtro (por nombre)</legend>
					<input type="text" name="filtro" id="filtro" value="<?php print(($filtro != '%') ? $filtro : ''); ?>" />
					<p>
						<a href="javascript:changePageUsuario('formUsuarios', '<?php print($sort); ?>', -1, -1, document.formUsuarios.filtro.value);">Aplicar</a>
						<a href="javascript:clearFilter('formUsuarios', '<?php print($sort); ?>', -1, -1, 'filtro', '%')">Quitar</a>
					</p>
			</fieldset>
		</div>
	</div>
	</form>
</body>
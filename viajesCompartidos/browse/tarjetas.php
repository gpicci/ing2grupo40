<?php
	require_once(DB_DIR.'/tarjetaDB.php');

	$db = DB::singleton();

	// Obtener el id actual, por defecto es el primero
	$idUsuario = (isset($_SESSION['user_id'])) ? $_SESSION['user_id']: -1;
	$id_tarjeta = -1;
	$cant = 0;

?>
	<form name='formTarjetas' id='formTarjetas' method='post' action='' >
	<input type='hidden' name='op' id='op' value='' />
	<div id="content">
		<div id="right">
<?php
	$rs = getTarjetasUsuario($idUsuario);

	if($db->num_rows($rs) == 0) {
		print('No hay tarjetas ingresadas.');
	} else {
		// Table header
?>
	<table>
		<tr>
      	<td align="center"><b>SEL</b></td>
         <td align="center"><b>EMPRESA</b></td>
         <td align="center"><b>NUMERO</b></td>
         <td align="center"><b>VENCIMIENTO</b></td>
         <td align="center"><b>TITULAR</b></td>
   	</tr>
<?php
	while ($row = $db->fetch_assoc($rs)) {
		$cant = $cant+1;
		print('<tr>');
		if ($id_tarjeta == -1) {
			$id_tarjeta= $row['id_tarjeta'];
		 	print('<td align="center"><input type="radio" name="id_tarjeta" id="id_tarjeta" value="'.$row['id_tarjeta'].'" checked="checked" /></td>');
		} else {
			if ($id_tarjeta== $row['id_tarjeta']) {
		 		print('<td align="center"><input type="radio" name="id_tarjeta" id="id_tarjeta" value="'.$row['id_tarjeta'].'" checked="checked" /></td>');
		 	} else {
		 		print('<td align="center"><input type="radio" name="id_tarjeta" id="id_tarjeta" value="'.$row['id_tarjeta'].'" /></td>');
		 	}
		}
		print('
         <td align="center">' . $row['empresa'] . '</td>
         <td align="center">' . $row['n_tarjeta'] . '</td>
         <td align="center">' . $row['d_vencimiento'] . '</td>
         <td align="center">' . $row['d_nombre_titular'] . '</td>
		</tr>');
	}
	print("</table>");
}

?>
		</div>
	</div>
	<div id="left">
		<div class="box">
			<div>Total tarjetas: <?php print($cant); ?></div>
			<div><hr/></div>
			<div><p><br/></p></div>
			<div><a href="main.php?accion=usuarioView&op=m&folder=<?php print(VIEWS_DIR); ?>">Volver</a></div>
			<div><hr/></div>
			<div><a href="javascript:performAltaTarjeta('formTarjetas');">Nueva Tarjeta</a></div>
			<div><hr/></div>
			<div><a href="javascript:performBajaTarjeta('formTarjetas');">Elimina Tarjeta</a></div>
			<div><hr/></div>
			<div><p><br/></p></div>
			<div><hr/></div>
		</div>
	</div>
	</form>
</body>
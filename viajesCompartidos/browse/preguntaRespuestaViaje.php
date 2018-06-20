<?php
	require_once('config.php');
	require_once('common/pages.php');
	require_once(DB_DIR.'/viajeDB.php');
	require_once(DB_DIR.'/preguntaRespuestaDB.php');

	$db = DB::singleton();

	$idViaje = (isset($_REQUEST['viaje_id'])) ? $_REQUEST['viaje_id']: -1;
	$propios = (isset($_REQUEST['propios'])) ? $_REQUEST['propios']: -1;

	$rsViaje = getViajePorId($idViaje);

	$rowViaje = $db->fetch_assoc($rsViaje);

	$pregunta_respuesta_id=-1;
?>
	<form name='formPregResp' id='formPregResp' method='post' action='' >
	<input type="hidden"	name="viaje_id" value="<?php print($_REQUEST["viaje_id"]); ?>">
	<input type="hidden"	name="propios" value="<?php print($_REQUEST["propios"]); ?>">
		<div id="content">
			<div id="right">
				<div class="form-container">
					<fieldset>
						<legend><b>Datos del Viaje</b></legend>
						<div><label><b>Origen</b></label><label><?php print($rowViaje['localidad_id_origen']); ?></label></div>
						<div><label><b>Destino</b></label><label><?php print($rowViaje['localidad_id_destino']); ?></label></div>
						<div><label><b>Fecha Salida</b></label><label><?php print($rowViaje['fecha_salida']); ?></label></div>
					</fieldset>
				</div>
				<div><p></p></div>

	<input type='hidden' name='idViaje' id='idViaje' value='<?php print($idViaje); ?>' />
<?php
	$rs = getPreguntasRespuestasViajeID($idViaje);

	if($db->num_rows($rs) == 0) {
		print('No hay preguntas para el viaje.');
	} else {
		// Table header
?>
<table>
<?php
	while ($row = $db->fetch_assoc($rs)) {

		$rowColor = "";
		if ($row["d_tipo"]=='R') {
			$rowColor = " style=\"background: #AA7474;\"";
		}

		print("<tr".$rowColor.">");

		if ($propios == 1)  {
			if (($row['d_tipo'] == 'R')||($row['n_tiene_respuesta']==1)) {
			  $disabled = 'disabled="disabled"';
			  $salto = ' ';
			} else {
			  $disabled = ' ';
			}

			if (($pregunta_respuesta_id== -1)&($disabled==' ')) {
				$pregunta_respuesta_id= $row['pregunta_respuesta_id'];
				print('<td align="center"><input type="radio" name="pregunta_respuesta_id" id="pregunta_respuesta_id" value="'.$row['pregunta_respuesta_id'].'" checked="checked" '.$disabled.' /></td>');
			} else {
				if ($pregunta_respuesta_id== $row['pregunta_respuesta_id']) {
					print('<td align="center"><input type="radio" name="pregunta_respuesta_id" id="pregunta_respuesta_id" value="'.$row['pregunta_respuesta_id'].'" checked="checked" '.$disabled.'/></td>');
				} else {
					print('<td align="center"><input type="radio" name="pregunta_respuesta_id" id="pregunta_respuesta_id" value="'.$row['pregunta_respuesta_id'].'" '.$disabled.'/></td>');
				}
			}
		}

		print('
		<td>' . $row['anotacion'] . '</td>
		</tr>');

		if (($row['d_tipo'] == 'R')||($row['n_tiene_respuesta']==0)){

		print( '<tr>
						<td><br></br></td>
						<td><br></br></td>
						</tr>');
		}


	}
	print("</table>");
}

?>


		</div>
	</div>
	<div id="left">
		<div class="box">
			<?php if ($propios == 1) { ?>
				<div><a href="javascript:performRespuesta('formPregResp');">Responder</a></div>
				<div><hr/></div>
			<?php } else { ?>
				<div><a href="javascript:performPregunta('formPregResp');">Nueva Pregunta</a></div>
				<div><hr/></div>
			<?php }?>
			<?php echo "<div><a href=\"main.php?accion=viajes&propios=$propios&folder=browse\">Volver</a></div>"; ?>
			<div><hr/></div>
		</div>
	</div>
	</form>
</body>

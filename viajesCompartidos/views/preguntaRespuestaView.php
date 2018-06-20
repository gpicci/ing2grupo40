<?php
  require_once(DB_DIR.'/preguntaRespuestaDB.php');

  if ($_REQUEST["op"] == 'r') {
	$rs = getPreguntaById($_REQUEST["pregunta_respuesta_id"]);
	$row = $db->fetch_assoc($rs);

	$preguntaRespuesta = array();
	$preguntaRespuesta["pregunta_respuesta_id"] = $_REQUEST["pregunta_respuesta_id"];
	$preguntaRespuesta["anotacion"] = $row["anotacion"];
	$disabled = 'disabled="disabled"';
  } else {
	$preguntaRespuesta = array();
	$preguntaRespuesta["pregunta_respuesta_id"] = 0;
	$preguntaRespuesta["anotacion"] = '';
	$disabled = ' ';
  }
?>
	<div id="content">
		<div id="right">
			<div class="form-container">
<?php
echo "<form id=\"formPreguntaRespuestaView\" method=\"post\" action=\"main.php?accion=preguntaRespuestaABM&op=".$_REQUEST["op"]."&folder=".ABM_DIR."\">";
?>
				<input type="hidden"	name="pregunta_respuesta_id" value="<?php print($preguntaRespuesta["pregunta_respuesta_id"]); ?>">
				<input type="hidden"	name="viaje_id" value="<?php print($_REQUEST["viaje_id"]); ?>">
				<input type="hidden"	name="propios" value="<?php print($_REQUEST["propios"]); ?>">
					<fieldset>
						<legend>Pregunta</legend>
						<div><input id="pregunta" type="text" size="130" <?php print($disabled);?> maxlength="500" name="pregunta" value="<?php print($preguntaRespuesta['anotacion']); ?>" /></div>
					</fieldset>
				<?php if ($_REQUEST["op"]=='r') { ?>
					<fieldset>
						<legend>Respuesta</legend>
						<div><input id="respuesta" type="text" size="130" maxlength="500" name="respuesta" value="" /></div>
					</fieldset>
				<?php } ?>
				<div class="buttonrow">
					<?php if ($_REQUEST['op'] == 'r') { ?>
						<input type="button" name="agregar" value="Responder" class="button" onClick="checkRespuesta('formPreguntaRespuestaView');">
					<?php } else { ?>
						<input type="button" name="modificar" value="Preguntar" class="button" onClick="checkPregunta('formPreguntaRespuestaView');">
					<?php } ?>
					<input type="reset" value="Borrar cambios" class="button">
				</div>
			</form>
			</div>
		</div>
	</div>
	<div id="left">
		<div class="box">
			<?php echo "<div><a href=\"main.php?accion=preguntaRespuestaViaje&propios=".$_REQUEST['propios']."&viaje_id=".$_REQUEST['viaje_id']."&folder=browse\">Volver</a></div>"; ?>
			<div><hr/></div>
			<div><p><br/></p></div>
			<div><hr/></div>
			<div>* Datos obligatorios</div>
		</div>
	</div>
</body>
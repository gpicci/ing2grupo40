<?php

require_once("./config.php");
require_once("./db/tarjetaDB.php");
require_once("./db/viajeDB.php");
require_once("./common/combo.php");

if ($_REQUEST["op"] == "p") {
  $viaje_id = $_REQUEST["viaje_id"];
  $usuario_id = $_REQUEST["usuario_id"];
  $op = $_REQUEST["op"];
  
  if (existePostulacion($viaje_id, $usuario_id)) {
      $mensajes[]="Ya se ha postulado al viaje";
      header('Location: main.php?accion=viajes&propios=0&folder='.BROWSE_DIR);
  }

}
?>
	<div id="content">
		<div id="right">
			<div class="form-container">
<?php
			echo "<form id=\"formPostulacionView\" method=\"post\" action=\"main.php?accion=viajeABM&folder=".ABM_DIR."\">";
?>
				<input type="hidden" name="viaje_id" id="viaje_id" value="<?php print($_REQUEST["viaje_id"]); ?>">
				<input type="hidden" name="usuario_id" id="usuario_id" value="<?php print($_REQUEST["usuario_id"]); ?>">
				<input type="hidden" name="op" id="op" value="<?php print($_REQUEST["op"]); ?>">
				<fieldset>
					<legend>Seleccione la tarjeta a la que se le imputará el costo en caso de confirmarse el viaje</legend>
					<div><label for=tarjeta_id">Tarjeta <em>*</em></label>
						<?php
						    $rs = getTarjetasUsuario($usuario_id);
							comboBox("tarjeta_id", $rs, "id_tarjeta", "tarjeta", "--", 1, "");
						?>
					</div>
				</fieldset>
				<div class="buttonrow">
					<?php if ($_REQUEST['op'] == 'p') { ?>
						<input type="button" name="postularse" value="postularse" class="button" onClick="checkPostulacion('formPostulacionView');">
					<?php } else { ?>
						<input type="button" name="modificar" value="Modificar" class="button" onClick="checkPostulacion('formPostulacionView');">
					<?php } ?>
					<input type="reset" value="Borrar cambios" class="button">
				</div>
			</form>
			</div>
		</div>
	</div>
	<div id="left">
		<div class="box">
			<?php
			echo "<div><a href=\"main.php?accion=viajes&propios=0&folder=".BROWSE_DIR."\">Volver</a></div>";
			?>
<?php
		print('<div><hr/></div>');
		print('<div><p><br/></p></div>');
		print('<div><hr/></div>');
?>
			<div>* Datos obligatorios</div>
		</div>
	</div>
</body>
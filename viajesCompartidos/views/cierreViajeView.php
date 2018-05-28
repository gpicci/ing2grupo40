<?php

require_once("./config.php");
require_once("./db/tarjetaDB.php");
require_once("./db/viajeDB.php");
require_once("./common/combo.php");

if ($_REQUEST["op"] == "c") {
  $viaje_id = $_REQUEST["viaje_id"];
  $usuario_id = $_REQUEST["usuario_id"];
  $op = $_REQUEST["op"];
  
  if (existePostulacion($viaje_id, $usuario_id)) {
      $mensajes[]="Ya se ha postulado al viaje";
      header('Location: main.php?accion=viajes&propios=0&folder='.BROWSE_DIR);
  }

  $montoPax = 0;
  $comision = 0;
  $importeViaje = costosViaje($viaje_id, $montoPax, $comision);
  
}
?>
	<div id="content">
		<div id="right">
			<div class="form-container">
<?php
			echo "<form id=\"formPostulacionView\" method=\"post\" action=\"main.php?accion=viajeABM&folder=".ABM_DIR."\">";
?>
			<fieldset>
				Importe del viaje: <?php echo $importeViaje; ?><br>
				Importe por pasajero (incluido el piloto): <?php echo $montoPax; ?><br>
				Comision del viaje (a cargo del dueño del viaje): <?php echo $comision; ?><br>
				
				<input type="hidden" name="viaje_id" id="viaje_id" value="<?php print($_REQUEST["viaje_id"]); ?>">
				<input type="hidden" name="usuario_id" id="usuario_id" value="<?php print($_REQUEST["usuario_id"]); ?>">
				<input type="hidden" name="op" id="op" value="<?php print($_REQUEST["op"]); ?>">
				<br><br>
			</fieldset>
				<div class="buttonrow">
					<?php if ($_REQUEST['op'] == 'c') { ?>
						<input type="submit" name="cerrarViaje" value="Cerrar Viaje" class="button" ">
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
			echo "<div><a href=\"main.php?accion=viajes&folder=".BROWSE_DIR."\">Volver</a></div>";
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
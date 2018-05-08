<?php

require_once("./config.php");
require_once("./db/vehiculoDB.php");
require_once("./common/combo.php");

$idUsuario = (isset($_SESSION['user_id'])) ? $_SESSION['user_id']: -1;
$vehiculo_id = -1;
$cant = 0;

if ($_REQUEST["op"] == "m") {
  $rs = getViajesPorUsuario($_REQUEST["vehiculo_id"]);
  $row = $db->fetch_assoc($rs);

  $viaje = array();
  $viaje["vehiculo_id"] = $_REQUEST["vehiculo_id"];
  $viaje["marca_id"] = $row["marca_id"];
  $viaje["modelo_id"] = $row["modelo_id"];
  $viaje["usuario_id"] = $row["usuario_id"];
  $viaje["cantidad_asientos"] = $row['cantidad_asientos'];
  $viaje["patente"] = $row['patente'];
  $marca_id = $row["marca_id"];

} else {
	$viaje = array();
	$marca_id= 1;
	$viaje["vehiculo_id"] = null;
	$viaje["modelo_id"] = null;
	$viaje["usuario_id"] = null;
	$viaje["cantidad_asientos"] = null;
	$viaje["patente"] = '';
}
?>
	<div id="content">
		<div id="right">
			<div class="form-container">
<?php
if ($_REQUEST['op'] == 'm') {

			echo "<form id=\"formViajePropioView\" method=\"post\" action=\"main.php?accion=usuarioABM&op=m&folder=".ABM_DIR."\">";
?>
				<input type="hidden"	name="idVehiculo" value="<?php print($_REQUEST["idVehiculo"]); ?>">
<?php } else {
			echo "<form id=\"formViajePropioView\" method=\"post\" action=\"main.php?accion=usuarioABM&op=a&folder=".ABM_DIR."\">";
			?> 
<?php } ?>
				<fieldset>
					<legend>Datos del vehiculo</legend>
					<div><label for="marca_id">Marca </label>
						<?php
							$rs = getMarcas();
							comboBox("marca_id", $rs, "marca_id", "nombre_marca", "", $marca_id, "onchange=\"getModelos(this)\""); 
						?>
					</div>
					<div><label>Modelo <em>*</em></label>
						<?php
							$rs1 = getModelosPorMarca($marca_id);
							comboBox("modelo_id", $rs1, "modelo_id", "nombre_modelo", "NINGUNA", $viaje["modelo_id"], "");
						?>
					</div>
					<div><label for="cantidad_asientos">Cantidad de Asientos</label><input id="cantidad_asientos" type="text" size="20" maxlength="20" name="cantidad_asientos" value="<?php print($viaje['cantidad_asientos']); ?>" /></div>
					<div><label for="patente">Patente</label><input id="patente" type="text" size="20" maxlength="20" name="patente" value="<?php print($viaje['patente']); ?>" /></div>
				</fieldset>
				<div class="buttonrow">
					<?php if ($_REQUEST['op'] == 'a') { ?>
						<input type="button" name="agregar" value="Agregar" class="button" onClick="checkUsuario('formViajePropioView');">
					<?php } else { ?>
						<input type="button" name="modificar" value="Modificar" class="button" onClick="checkUsuario('formViajePropioView');">
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
			echo "<div><a href=\"main.php?accion=vehiculos&folder=".BROWSE_DIR."\">Volver</a></div>";
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
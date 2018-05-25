<?php

require_once("./config.php");
require_once("./db/vehiculoDB.php");
require_once("./common/combo.php");

if ($_REQUEST["op"] == "m") {
    $cantViajes = GetCantViajePorVehiculo($_REQUEST["vehiculo_id"]);
    if ($cantViajes>0) {
        $_SESSION['mensajesPendientes'][] = "El vehiculo está asignado a un viaje, no puede modificarse";
        header('Location: main.php?accion=vehiculos&folder='.BROWSE_DIR);
    }
    
  $rs = getVehiculoPorId($_REQUEST["vehiculo_id"]);
  $row = $db->fetch_assoc($rs);
  
  $vehiculo = array();
  $vehiculo["vehiculo_id"] = $_REQUEST["vehiculo_id"];
  $vehiculo["marca_id"] = $row["marca_id"];
  $vehiculo["modelo_id"] = $row["modelo_id"];
  $vehiculo["usuario_id"] = $row["usuario_id"];
  $vehiculo["cantidad_asientos"] = $row['cantidad_asientos'];
  $vehiculo["patente"] = $row['patente'];
  $marca_id = $row["marca_id"];

} else {
	$vehiculo = array();
	$marca_id= 1;
	$vehiculo["vehiculo_id"] = null;
	$vehiculo["modelo_id"] = null;
	$vehiculo["usuario_id"] = null;
	$vehiculo["cantidad_asientos"] = null;
	$vehiculo["patente"] = '';
}
?>
	<div id="content">
		<div id="right">
			<div class="form-container">
<?php
if ($_REQUEST['op'] == 'm') {

			echo "<form id=\"formVehiculoView\" method=\"post\" action=\"main.php?accion=vehiculoABM&op=m&folder=".ABM_DIR."\">";
?>
				<input type="hidden"	name="vehiculo_id" value="<?php print($_REQUEST["vehiculo_id"]); ?>">
<?php } else {
			echo "<form id=\"formVehiculoView\" method=\"post\" action=\"main.php?accion=vehiculoABM&op=a&folder=".ABM_DIR."\">";
			?>
<?php } ?>
				<fieldset>
					<legend>Datos del vehiculo</legend>
					<div><label for="marca_id">Marca <em>*</em></label>
						<?php
							$rs = getMarcas();
							comboBox("marca_id", $rs, "marca_id", "nombre_marca", "", $marca_id, "onchange=\"getModelos(this)\"");
						?>
					</div>
					<div><label>Modelo <em>*</em></label>
						<?php
							$rs1 = getModelosPorMarca($marca_id);
							comboBox("modelo_id", $rs1, "modelo_id", "nombre_modelo", "NINGUNA", $vehiculo["modelo_id"], "");
						?>
					</div>
					<div><label for="cantidad_asientos">Cantidad de Asientos<em>*</em></label><input id="cantidad_asientos" type="text" size="20" maxlength="20" name="cantidad_asientos" value="<?php print($vehiculo['cantidad_asientos']); ?>" /></div>
					<div><label for="patente">Patente<em>*</em></label><input id="patente" type="text" size="20" maxlength="20" name="patente" value="<?php print($vehiculo['patente']); ?>" /></div>
				</fieldset>
				<div class="buttonrow">
					<?php if ($_REQUEST['op'] == 'a') { ?>
						<input type="button" name="agregar" value="Agregar" class="button" onClick="checkVehiculo('formVehiculoView');">
					<?php } else { ?>
						<input type="button" name="modificar" value="Modificar" class="button" onClick="checkVehiculo('formVehiculoView');">
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
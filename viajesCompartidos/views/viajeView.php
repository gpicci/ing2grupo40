<?php
require_once(DB_DIR.'/viajeDB.php');
require_once(DB_DIR.'/vehiculoDB.php');
require_once("./common/combo.php");


if ($_REQUEST["op"] == "m") {
	
  $db = DB::singleton();
  $rs = getViajePorId($_REQUEST["viaje_id"]);
  $row = $db->fetch_assoc($rs);

  $viaje = array();
  $viaje["viaje_id"] = $_REQUEST["viaje_id"];
  $viaje["vehiculo_id"] = $row["vehiculo_id"];
  $viaje["localidad_origen_id"] = $row["localidad_origen_id"];
  $viaje["localidad_destino_id"] = $row['localidad_destino_id'];
  $viaje["tipo_viaje_id"] = $row['tipo_viaje_id'];
  $viaje["dia_semana"] = $row['dia_semana'];
  $viaje["fecha_salida"] = $row["fecha_salida"];
  $viaje["duracion"] = $row["duracion"];
  $viaje["costo"] = $row["costo"];

  $_SESSION["usuario_actual"] = $viaje;
} else {
	$viaje = array();
	$viaje["viaje_id"] = 0;
	$viaje["vehiculo_id"] = 0;
	$viaje["localidad_origen_id"] = 0;
	$viaje["localidad_destino_id"] = 0;
	$viaje["tipo_viaje_id"] = 0;
	$viaje["dia_semana"] = 0;
	$viaje["fecha_salida"] = '';
	$viaje["duracion"] = 0;
	$viaje["costo"] = 0;
}
?>
	<div id="content">
		<div id="right">
			<div class="form-container">
<?php
if ($_REQUEST['op'] == 'm') {

			echo "<form id=\"formViajeView\" method=\"post\" action=\"main.php?accion=viajeABM&op=m&folder=".ABM_DIR."\">";
?>
				<input type="hidden"	name="viaje_id" value="<?php print($viaje["viaje_id"]); ?>">
<?php } else {
			echo "<form id=\"formViajeView\" method=\"post\" action=\"main.php?accion=viajeABM&op=a&folder=".ABM_DIR."\">";
			?>
<?php } ?>
				<fieldset>
					<legend>Datos del Viaje</legend>
					<div><label for="tipo_viaje_id">Tipo de Viaje<em>*</em></label>
						<?php
							$rs = getTiposDeViaje();
							comboBox("tipo_viaje_id", $rs, "tipo_viaje_id", "nombre", "", $viaje["tipo_viaje_id"], "");
						?>
					</div>
					<div><label for="dia_semana">Dia de Salida<em>*</em></label>
						<?php
							$rs = getDiasSemana();
							comboBox("dia_semana_id", $rs, "dia_semana_id", "dia_semana_nombre", "", $viaje["dia_semana"], "");
						?>
					</div>					
					<div><label for="fecha_salida">Fecha de Salida<em>*</em></label><input type="text" name="fecha_salida" id="fecha_salida" value="<?php print(($viaje["fecha_salida"]!= '%') ? $viaje["fecha_salida"]: ''); ?>" />
        			<a id="calendarFechaSalida" href="javascript:OpenCal('fecha_salida');" style="width:16px"><img class="calendar" src="./img/calendar.png" width="16" height="16" /></a>											
					<div><label for="localidad_origen_id">Localidad Origen<em>*</em></label>
						<?php
							$rs = getLocalidad();
							comboBox("localidad_origen_id", $rs, "localidad_id", "nombre_localidad", "", $viaje["localidad_origen_id"], "");
						?>
					</div>	
					<div><label for="localidad_destino_id">Localidad Destino<em>*</em></label>
						<?php
							$rs = getLocalidad();
							comboBox("localidad_destino_id", $rs, "localidad_id", "nombre_localidad", "", $viaje["localidad_destino_id"], "");
						?>
					</div>	
					<div><label for="vehiculo_id">Vehiculo<em>*</em></label>
						<?php
							$rs = getVehiculosPorUsuario($_SESSION["user_id"]);
							comboBox("vehiculo_id", $rs, "vehiculo_id", "nombre_vehiculo", "", $viaje["vehiculo_id"], "");
						?>
					</div>								
					<div><label for="duracion">Duracion (en horas)<em>*</em></label><input id="duracion" type="text" name="duracion" size="10" maxlength="50" value="<?php print($viaje['duracion']); ?>" /></div>					
					<div><label for="costo">Costo total del viaje<em>*</em></label><input id="costo" type="text" name="costo" size="10" maxlength="50" value="<?php print($viaje['costo']); ?>" /></div>					
 					</fieldset>
				<div class="buttonrow">
					<?php if ($_REQUEST['op'] == 'a') { ?>
						<input type="button" name="agregar" value="Agregar" class="button" onClick="checkViaje('formViajeView');">
					<?php } else { ?>
						<input type="button" name="modificar" value="Modificar" class="button" onClick="checkViaje('formViajeView');">
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
			if ($_REQUEST['op'] == 'a') {
				echo "<div><a href=\"login.php\">Volver</a></div>";
			} else {
				echo "<div><a href=\"main.php?accion=inicio\">Volver</a></div>";
			}
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

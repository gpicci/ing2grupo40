<?php

require_once("./config.php");
require_once("./db/tarjetaDB.php");
require_once("./common/combo.php");

if ($_REQUEST["op"] == "m") {
  $rs = getTarjetaPorId($_REQUEST["id_tarjeta"]);
  $row = $db->fetch_assoc($rs);

  $tarjeta = array();
  $tarjeta["id_tarjeta"] = $_REQUEST["id_tarjeta"];
  $tarjeta["id_empresa"] = $row["id_empresa"];
  $tarjeta["n_tarjeta"] = $row["n_tarjeta"];
  $tarjeta["d_nombre_titular"] = $row["d_nombre_titular"];
  $tarjeta["n_mes_vence"] = $row['n_mes_vence'];
  $tarjeta["n_anio_vence"] = $row['n_anio_vence'];
  $tarjeta["n_codigo_verificador"] = $row['n_codigo_verificador'];

} else {
	$tarjeta = array();
	$tarjeta["id_tarjeta"] = null;
	$tarjeta["id_empresa"] = null;
	$tarjeta["n_tarjeta"] = '';
	$tarjeta["d_nombre_titular"] = '';
	$tarjeta["n_mes_vence"] = null;
	$tarjeta["n_anio_vence"] = null;
	$tarjeta["n_codigo_verificador"] = null;

}
?>
	<div id="content">
		<div id="right">
			<div class="form-container">
<?php
if ($_REQUEST['op'] == 'm') {

			echo "<form id=\"formTarjetaView\" method=\"post\" action=\"main.php?accion=tarjetaABM&op=m&folder=".ABM_DIR."\">";
?>
				<input type="hidden"	name="id_tarjeta" value="<?php print($_REQUEST["id_tarjeta"]); ?>">
<?php } else {
			echo "<form id=\"formTarjetaView\" method=\"post\" action=\"main.php?accion=tarjetaABM&op=a&folder=".ABM_DIR."\">";
			?>
<?php } ?>
				<fieldset>
					<legend>Datos de tarjeta</legend>
					<div><label for="id_empresa">Empresa <em>*</em></label>
						<?php
							$rs = getEmpresaTarjeta();
							comboBox("id_empresa", $rs, "id_empresa", "d_nombre_empresa", "", $tarjeta["id_empresa"], "");
						?>
					</div>
					<div><label for="n_tarjeta">Numero<em>*</em></label><input id="n_tarjeta" type="text" size="16" maxlength="16" name="n_tarjeta" onkeypress="return isNumberKey(event)" value="<?php print($tarjeta['n_tarjeta']); ?>" /></div>
					<div><label for="n_codigo_verificador">Codigo Verificador<em>*</em></label><input id="n_codigo_verificador" type="text" size="3" maxlength="3" name="n_codigo_verificador" onkeypress="return isNumberKey(event)" value="<?php print($tarjeta['n_codigo_verificador']); ?>" /></div>
					<div><label for="d_nombre_titular">Nombre Titular<em>*</em></label><input id="d_nombre_titular" type="text" size="20" maxlength="20" name="d_nombre_titular" value="<?php print($tarjeta['d_nombre_titular']); ?>" /></div>
					<legend>Vencimiento</legend>
					<div>
						<select name="n_mes_vence" id="n_mes_vence">
						<option value="0">Mes</option>
                      		<?php  for($i=1;$i<=12;$i++) { echo "<option value='".$i."'>".$i."</option>"; } ?>
                    	</select>
						<select name="n_anio_vence" id="n_anio_vence">
						<option value="0">A&ntildeo</option>
                      		<?php  for($i=2018;$i<=2028;$i++) { echo "<option value='".$i."'>".$i."</option>"; } ?>
                    	</select>
					</div>

				</fieldset>
				<div class="buttonrow">
					<?php if ($_REQUEST['op'] == 'a') { ?>
						<input type="button" name="agregar" value="Agregar" class="button" onClick="checkTarjeta('formTarjetaView');">
					<?php } else { ?>
						<input type="button" name="modificar" value="Modificar" class="button" onClick="checkTarjeta('formTarjetaView');">
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
			echo "<div><a href=\"main.php?accion=tarjetas&folder=".BROWSE_DIR."\">Volver</a></div>";
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
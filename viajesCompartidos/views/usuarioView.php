<?php
require_once(DB_DIR.'/usuarioDB.php');

if ($_REQUEST["op"] == "m") {
	
  $db = DB::singleton();
  $rs = getUsuario($_SESSION["user_id"]);
  $row = $db->fetch_assoc($rs);

  $usuario = array();
  $usuario["usuario_id"] = $_SESSION["user_id"];
  $usuario["nombre"] = $row["nombre"];
  $usuario["apellido"] = $row["apellido"];
  $usuario["fecha_nacimiento"] = $row['fecha_nacimiento'];
  $usuario["correo_electronico"] = $row['correo_electronico'];
  $usuario["clave"] = $row['clave'];
  $usuario["foto"] = $row["foto"];

  $_SESSION["usuario_actual"] = $usuario;
} else {
	$usuario = array();
	$usuario["usuario_id"] = 0;
	$usuario["nombre"] = '';
	$usuario["apellido"] = '';
	$usuario["fecha_nacimiento"] = '';
	$usuario["correo_electronico"] = '';
	$usuario["clave"] = '';
	$usuario["foto"] = '';
}
?>
	<div id="content">
		<div id="right">
			<div class="form-container">
<?php
if ($_REQUEST['op'] == 'm') {

			echo "<form id=\"formUsuarioView\" method=\"post\" action=\"main.php?accion=usuarioABM&op=m&folder=".ABM_DIR."\">";
?>
				<input type="hidden"	name="idUsuario" value="<?php print($usuario["usuario_id"]); ?>">
<?php } else {
			echo "<form id=\"formUsuarioView\" method=\"post\" action=\"main.php?accion=usuarioABM&op=a&folder=".ABM_DIR."\">";
			?>
<?php } ?>
				<fieldset>
					<legend>Datos del usuario</legend>
					<div><label for="nombre">Nombre<em>*</em></label><input id="nombre" type="text" size="80" maxlength="100" onBlur="caps(this)" name="nombre" value="<?php print($usuario['nombre']); ?>" /></div>
					<div><label for="direccion">Apellido<em>*</em></label><input id="apellido" type="text" size="80" maxlength="100" onBlur="caps(this)" name="apellido" value="<?php print($usuario['apellido']); ?>" /></div>					
					<div><label for="direccion">Fecha de Nacimiento<em>*</em></label><input type="text" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php print(($usuario["fecha_nacimiento"]!= '%') ? $usuario["fecha_nacimiento"]: ''); ?>" />
        			<a id="calendarFechaNacimiento" href="javascript:OpenCal('fecha_nacimiento');" style="width:16px"><img class="calendar" src="./img/calendar.png" width="16" height="16" /></a>											
					<div><label for="correo_electronico">Correo Electronico<em>*</em></label><input id="correo_electronico" type="text" size="20" maxlength="20" name="correo_electronico" value="<?php print($usuario['correo_electronico']); ?>" /></div>
					<div><label for="clave">Clave<em>*</em></label><input id="clave" type="text" name="clave" size="50" maxlength="50" value="<?php print($usuario['clave']); ?>" /></div>					
 					</fieldset>
				<div class="buttonrow">
					<?php if ($_REQUEST['op'] == 'a') { ?>
						<input type="button" name="agregar" value="Agregar" class="button" onClick="checkUsuario('formUsuarioView');">
					<?php } else { ?>
						<input type="button" name="modificar" value="Modificar" class="button" onClick="checkUsuario('formUsuarioView');">
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
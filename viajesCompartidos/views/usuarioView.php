<?php
//valores requeridos (por post o get)
//idUsuario
//op : a,b,m 

require_once("config.php");
require_once(DB_DIR."/usuarioDB.php");
require_once("lookupData.php");	
require_once("common/combo.php");	  

$db = DB::singleton();
?>

<?php
if ($_REQUEST["op"] == "m") {
	$rs = getUsuario($_REQUEST["idUsuario"]);
	$row = $db->fetch_assoc($rs);

	$usuario = array();
   $usuario["c_id"] = $_REQUEST["idUsuario"];
   $usuario["d_nombre"] = $row["d_nombre"];
   $usuario["d_direccion"] = $row["d_direccion"];
   $usuario["d_telefono1"] = $row['d_telefono1'];
   $usuario["d_telefono2"] = $row['d_telefono2'];
   $usuario["d_mail1"] = $row['d_mail1'];
   $usuario["d_mail2"] = $row["d_mail2"];
   $usuario["c_id_estado"] = $row["c_id_estado"];
   $usuario["m_externo"] = $row["m_externo"];
   $usuario["d_nombre_usuario"] = $row["d_nombre_usuario"];
   $usuario["d_pass"] = $row["d_pass"];
   $usuario["c_id_rol"] = $row["c_id_rol"];
   $usuario["c_id_tipo_documento"] = $row["c_id_tipo_documento"];
   $usuario["n_documento"] = $row["n_documento"];
   $usuario["m_permiso"] = $row["m_permiso"];
   $usuario["d_numero_sms"] = $row["d_numero_sms"];
    
	$_SESSION["usuario_actual"] = $usuario;
} else {
	$usuario = array();
   $usuario["c_id"] = 0;
   $usuario["d_nombre"] = '';
   $usuario["d_direccion"] = '';
   $usuario["d_telefono1"] = '';
   $usuario["d_telefono2"] = '';
   $usuario["d_mail1"] = '';
   $usuario["d_mail2"] = '';
   $usuario["c_id_estado"] = 0;
   $usuario["m_externo"] = 0;
   $usuario["d_nombre_usuario"] = '';
   $usuario["d_pass"] = '';
   $usuario["c_id_rol"] = 0;
   $usuario["c_id_tipo_documento"] = 0;
   $usuario["n_documento"] = 0;
   $usuario["m_permiso"] = 0;
   $usuario["d_numero_sms"] = '';
}
?>
	<div id="content">
		<div id="right">
			<div class="form-container">
<?php
if ($_REQUEST['op'] == 'm') {
 
			echo "<form id=\"formUsuarioView\" method=\"post\" action=\"main.php?accion=usuarioABM&op=m&folder=".ABM_DIR."\">";
?>			
				<input type="hidden"	name="idUsuario" value="<?php print($_REQUEST["idUsuario"]); ?>"> 
<?php } else { 
			echo "<form id=\"formUsuarioView\" method=\"post\" action=\"main.php?accion=usuarioABM&op=a&folder=".ABM_DIR."\">";
			?>
<?php } ?>
				<fieldset>
					<legend>Datos del usuario</legend>
					<div><label for="nombre">Nombre <em>*</em></label><input id="nombre" type="text" size="80" maxlength="100" onBlur="caps(this)" name="nombre" value="<?php print($usuario['d_nombre']); ?>" /></div>
					<div><label for="direccion">Direccion <em>*</em></label><input id="direccion" type="text" size="80" maxlength="100" onBlur="caps(this)" name="direccion" value="<?php print($usuario['d_direccion']); ?>" /></div>
					<div><label for="telefono1">Telefono 1 </label><input id="telefono1" type="text" size="20" maxlength="20" name="telefono1" value="<?php print($usuario['d_telefono1']); ?>" /></div>
					<div><label for="telefono2">Telefono 2 </label><input id="telefono2" type="text" size="20" maxlength="20" name="telefono2" value="<?php print($usuario['d_telefono2']); ?>" /></div>
					<div><label for="mail1">Mail 1 </label><input id="mail1" type="text" name="mail1" size="50" maxlength="50" value="<?php print($usuario['d_mail1']); ?>" /></div>
					<div><label for="mail2">Mail 2 </label><input id="mail2" type="text" name="mail2" size="50" maxlength="50" value="<?php print($usuario['d_mail2']); ?>" /></div>
 					<div><label for="estado">Estado <em>*</em></label>
						<?php
							$rs = getEstadoUsuario();
						  	comboBox("estado", $rs, "c_id", "d_descripcion", "", $usuario["c_id_estado"], ""); 
						?>
					</div>
					<div><label for="externo">Externo <em>*</em></label><input id="externo" type="text" name="externo" value="<?php print($usuario['m_externo']); ?>" /></div>
					<div><label for="nombreUsuario">Nombre Usuario <em>*</em></label><input id="nombreUsuario" type="text" size="8" maxlength="8" name="nombreUsuario" value="<?php print($usuario['d_nombre_usuario']); ?>" /></div>
					<div><label for="password">Password <em>*</em></label><input id="password" onkeypress="return isValidKey(event)" type="text" size="8" maxlength="8" name="password" value="<?php print($usuario['d_pass']); ?>" /></div>
 					<div><label for="rol">Rol <em>*</em></label>
						<?php
							$rs = getRolUsuario();
						  	comboBox("rol", $rs, "c_id", "d_descripcion", "", $usuario["c_id_rol"], ""); 
						?>
					</div>
					<div><label for="c_id_tipo_documento">Tipo Documento <em>*</em></label>
						<?php
							$rs = getTipoDocumento();
						  	comboBox("c_id_tipo_documento", $rs, "c_id", "d_descripcion", "", $usuario["c_id_tipo_documento"], ""); 
						?>
					</div>
					<div><label for="nroDoc">Nro. documento </label><input type="text" id="nroDoc" name="nroDoc" size="8" maxlength="8" value="<?php print($usuario['n_documento']); ?>" /></div>
					<div><label for="permiso">Permiso </label><input type="text" id="permiso" name="permiso" value="<?php print($usuario['m_permiso']); ?>" /></div>
					<div><label for="nroSMS">Nro. SMS </label><input type="text" id="numeroSMS" name="numeroSMS" size="20" maxlength="20" value="<?php print($usuario['d_numero_sms']); ?>" /></div>
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
			echo "<div><a href=\"main.php?accion=usuarios&folder=".ABM_BROWSE_DIR."\">Volver</a></div>";
			?>			
<?php
	//if ($_REQUEST['op'] == 'm') {
		print('<div><hr/></div>');        
		print('<div><p><br/></p></div>');        
		print('<div><hr/></div>');        
	//}
?>
			<div>* Datos obligatorios</div>        
		</div>
	</div>
</body>
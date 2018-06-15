<?php

require_once("./config.php");
require_once("./db/viajeDB.php");
require_once("./db/usuarioDB.php");
require_once("./common/combo.php");

$validaCalif = true;
if (!viajeTerminado($_REQUEST["viaje_id"])) {
    $validaCalif = false;
    $_SESSION["mensajesPendientes"][] = "El viaje no se ha realizado";
    header('Location: main.php?accion=viajes&propios='.$_REQUEST["propios"].'&folder='.BROWSE_DIR);
}

if (!usuarioEsPasajero($_REQUEST["usuario_id"], $_REQUEST["viaje_id"])) {
    $validaCalif = false;
    $_SESSION["mensajesPendientes"][] = "No es pasajero del viaje";
    header('Location: main.php?accion=viajes&propios='.$_REQUEST["propios"].'&folder='.BROWSE_DIR);
}

if ( ($validaCalif) && ($_REQUEST["op"] == "califica") )  {
    $viaje_id = $_REQUEST["viaje_id"];
    $usuario_id = $_REQUEST["usuario_id"];
    $op = $_REQUEST["op"];
    $propios = $_REQUEST["propios"];
    
    if ($propios) {
        $rsUsuarioPax = getPaxPorViaje($viaje_id, ID_APROBADO);
    } else {
        $id_usuario_piloto = GetUsuarioPorViaje($viaje_id);
        $rsUsuarioPax = getUsuario($id_usuario_piloto);
    }
    
    
}
?>
	<div id="content">
		<div id="right">
			<div class="form-container">
<?php
			echo "<form id=\"formCalificacionView\" method=\"post\" action=\"main.php?accion=viajeABM&folder=".ABM_DIR."\">";
?>
				<input type="hidden" name="viaje_id" id="viaje_id" value="<?php print($_REQUEST["viaje_id"]); ?>">
				<input type="hidden" name="usuario_id" id="usuario_id" value="<?php print($_REQUEST["usuario_id"]); ?>">
				<input type="hidden" name="op" id="op" value="<?php print($_REQUEST["op"]); ?>">
				<input type="hidden" name="propios" id="propios" value="<?php print($_REQUEST["propios"]); ?>">
				<fieldset>
					<div><label for=usuario_pax_id">Usuario Calificado <em>*</em></label>
						<?php
							comboBox("usuario_pax_id", $rsUsuarioPax, "usuario_id", "correo_electronico", "--", 0, "");
						?>
					</div>
				
					<legend>Seleccion la calificación para el usuario </legend>
					<div><label for=calificacion">Calificacion <em>*</em></label>
							<select name="calificacion" id=calificacion>
    							<option value="1" selected>Bien</option>
    							<option value="-1" >Mal</option>
    							<option value="0" >Neutro</option>
							</select>
					</div>
					<div><label for="comentario">Comentarios <em>*</em></label><textarea id="comentario" name="comentario" maxlength="2000" ></textarea></div>
				</fieldset>
				<div class="buttonrow">
					<input type="submit" name="calificar" value="Calificar" class="button" >
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
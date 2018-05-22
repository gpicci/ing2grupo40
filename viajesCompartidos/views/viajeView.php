<?php
require_once(DB_DIR.'/viajeDB.php');
require_once(DB_DIR.'/vehiculoDB.php');
require_once("./common/combo.php");
//id de estado correspondiente a los pasajero aprobados
$aprobado_id = 2;
if (($_REQUEST["op"] == "m") || ($_REQUEST["op"] == "b")) {
	
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
if (($_REQUEST['op'] == 'm') || ($_REQUEST['op'] == 'b')) {
    echo "<form id=\"formViajeView\" method=\"post\" action=\"main.php?accion=viajeABM&op=".$_REQUEST['op']."&folder=".ABM_DIR."\">";
?>
				<input type="hidden"	name="viaje_id" value="<?php print($viaje["viaje_id"]); ?>">
				<input type="hidden" name="op" id="op" value="<?php print($_REQUEST["op"]); ?>">
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
   					<br><br>
    					<?php
    					   if (($_REQUEST["op"] == "m") || ($_REQUEST["op"] == "b")) {
    					    $rs = getPaxPorViaje($_REQUEST["viaje_id"]);
    					       $rowCount = $db->num_rows($rs);
    					   } else {
    					       $rowCount = 0;
    					   }
    					if( $rowCount == 0) {
    					    if ($_REQUEST["op"] != "a") {
    					       print('El viaje no tiene copilotos aprobados ni pendientes');
    					    }
    					} else {
    					    // Table header
    					    ?>     					<table>
    					<tr>
    					<td><b>Sel</b></td>
    					<td><b>Nombre</a></b></td>
    					<td><b>Estado</b></td>
    					</tr>
    					<?php
    					   while ($row = $db->fetch_assoc($rs)) {
    					    print('<tr>');
    					    $idUsuario=-1;
    					    if ($idUsuario == -1) {
    					        $idUsuario = $row['usuario_id'];
    					        print('<td><input type="radio" name="idUsuarioPax" id="idUsuarioPax" value="'.$row['usuario_id'].'" checked="checked" /></td>');
    					    } else {
    					        if ($idUsuario == $row['usuario_id']) {
    					            print('<td><input type="radio" name="idUsuarioPax" id="idUsuarioPax" value="'.$row['usuario_id'].'" checked="checked" /></td>');
    					        } else {
    					            print('<td><input type="radio" name="idUsuarioPax" id="idUsuarioPax" value="'.$row['usuario_id'].'" /></td>');
    					        }
    					    }
    					    print('<td>' . $row['apellido'] . ", ". $row['nombre'] . '</td>');
                            print('<td>' . $row['estado'] . '</td>');
                    		print ('</tr>');
                        					}
    					print("</table>");
    					}

    					$cantPax = GetCantPaxPorViaje($_REQUEST["viaje_id"]);
    					if ( ($_REQUEST["op"] == "m") && ($cantPax>0)) {
    					    print("<input type=\"button\" name=\"aprobar\" value=\"Aprobar postulacion\" class=\"button\" onClick=\"apruebaPostulacion('formViajeView');\">");
    					    print("<input type=\"button\" name=\"aprobar\" value=\"Desaprobar postulacion\" class=\"button\" onClick=\"desapruebaPostulacion('formViajeView');\">");
    					}
    					
    					
    					if ($_REQUEST["op"] != "a") {
    					    $cantAprob = GetCantPaxPorViaje($_REQUEST["viaje_id"], ID_APROBADO );
    					} else {
    					    $cantAprob = 0;
    					}

    					echo "<br><br>";
    					
    					if (($cantAprob>0) && ($_REQUEST['op'] == 'b')) {
    					    echo "<fieldset><div style=\"color: #FF0000;\"><b>";
    					    echo "Atencion: el viaje tiene pasajeros aprobados, eliminarlo bajara su puntuacion";
    					    echo "</div></fieldset>";
        				}
					?>
 					</fieldset>
				<div class="buttonrow">
					<?php if ($_REQUEST['op'] == 'a') { ?>
						<input type="button" name="agregar" value="Agregar" class="button" onClick="checkViaje('formViajeView');">
					<?php  } else if ($_REQUEST['op'] == 'm') { ?>
						<input type="button" name="modificar" value="Modificar" class="button" onClick="checkViaje('formViajeView');">
					<?php  } else if ($_REQUEST['op'] == 'b') { ?>
						<input type="button" name="modificar" value="Eliminar" class="button" onClick="checkViaje('formViajeView');">
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
				echo "<div><a href=\"main.php?accion=viajes&folder=browse\">Volver</a></div>";
			} else {
				echo "<div><a href=\"main.php?accion=viajes&folder=browse\">Volver</a></div>";
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

<?php
require_once(DB_DIR.'/viajeDB.php');
require_once(DB_DIR.'/vehiculoDB.php');
require_once(DB_DIR.'/usuarioDB.php');
require_once(DB_DIR."/tarjetaDB.php");
require_once("./common/combo.php");
//id de estado correspondiente a los pasajero aprobados

if ( (isSet($_REQUEST['propios'])) && ($_REQUEST['propios']==0) )  {
    $propios = 0;
} else {
    $propios = 1;
}

if (($_REQUEST["op"] == "m") || ($_REQUEST["op"] == "b") || ($_REQUEST["op"] == "d")) {
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
  
  
  formatMSSQLFechaHora($row["fecha_salida"], $fechaSalida, $horaSalida, $minutosSalida, $segundosSalida);
  
  $viaje["fecha_salida"] = $fechaSalida;
  $viaje["hora_salida"] = $horaSalida;
  $viaje["min_salida"] = $minutosSalida;
  
  $viaje["duracion"] = $row["duracion"];
  $viaje["costo"] = $row["costo"];
  $viaje["cerrado"] = $row["cerrado"];

  $viaje["tarjeta_id"] = GetTarjetaIdPilotoViaje($_REQUEST["viaje_id"]);

  $_SESSION["usuario_actual"] = $viaje;

  if ($viaje["cerrado"]==1) {
      $_SESSION['mensajesPendientes'][]="El viaje ha sido cerrado y no puede modificarse";
      header('Location: main.php?accion=viajes&folder='.BROWSE_DIR);
  }

} else {
	$viaje = array();
	$viaje["viaje_id"] = 0;
	$viaje["vehiculo_id"] = 0;
	$viaje["localidad_origen_id"] = 0;
	$viaje["localidad_destino_id"] = 0;
	$viaje["tipo_viaje_id"] = 0;
	$viaje["dia_semana"] = 0;
	$viaje["fecha_salida"] = '';
	$viaje["hora_salida"] = "08";
	$viaje["min_salida"] = "00";
	$viaje["duracion"] = 0;
	$viaje["costo"] = 0;
	$viaje["tarjeta_id"] = 1;
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
					<input type="hidden" name="dia_semana_id" id="dia_semana_id" value="1">					
					<div><label for="fecha_salida">Fecha de Salida<em>*</em></label><input type="text" name="fecha_salida" id="fecha_salida" onchange="esfechavalida(this.value);" value="<?php print(($viaje["fecha_salida"]!= '%') ? $viaje["fecha_salida"]: ''); ?>" />
        			<a id="calendarFechaSalida" href="javascript:OpenCal('fecha_salida');" style="width:16px"><img class="calendar" src="./img/calendar.png" width="16" height="16" /></a>
					<?php
					/*
					hh.<input type="number" min="0" max="24" step="1" name=hora_salida id=hora_salida style="width: 30px;" value=<?php print($viaje["hora_salida"]); ?> ></input>
					mm.<input type="number" min="0" max="60" step="1" name=min_salida id=min_salida style="width: 30px;"  value=<?php print($viaje["min_salida"]); ?> ></input>
					*/
					   echo "hh.";
					   comboNumerico("hora_salida", 0, 23, 1, $viaje["hora_salida"]);
					   echo "mm.";
					   comboNumerico("min_salida", 0, 45, 15, $viaje["min_salida"]);
					?>
					</div>
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
					<div><label for="tarjeta">Tarjeta de credito<em>*</em></label>
						<?php
						    $rs = getTarjetasUsuario($_SESSION["user_id"]);
                            // la tarjeta solo se puede elegir al crear el viaje
						    $disabled = "";
						    if ( ($_REQUEST["op"] != "a") ) {
						        $disabled = " disabled ";
						    }
						    comboBox("tarjeta_id", $rs, "id_tarjeta", "tarjeta", "--", $viaje["tarjeta_id"], "$disabled");
						?>
					</div>				
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
    					    ?>  <div><label >Postulaciones al viaje</label>
    					    	<table>
    					<tr>
    					<td><b>Sel</b></td>
    					<td><b>Nombre</a></b></td>
    					<td><b>Estado</b></td>
    					<td><b>Calificacion Copiloto</b></td>
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
                            print('<td>' . getCalificacionUsuario($row['usuario_id'], TIPO_COPILOTO) . '</td>');
                    		print ('</tr>');
                        					}
    					print("</table>");
    					}

    					if ($_REQUEST["op"] != "a") {
        					$cantPax = GetCantPaxPorViaje($_REQUEST["viaje_id"]);
        					if ( ($_REQUEST["op"] == "m") && ($cantPax>0)) {
        					    print("<input type=\"button\" name=\"aprobar\" value=\"Aprobar\" class=\"button\" onClick=\"apruebaPostulacion('formViajeView');\">");
        					    print("<input type=\"button\" name=\"rechazar\" value=\"Rechazar\" class=\"button\" onClick=\"desapruebaPostulacion('formViajeView');\">");
        					}
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
				echo "<div><a href=\"main.php?accion=viajes&propios=$propios&folder=browse\">Volver</a></div>";
			} else {
				echo "<div><a href=\"main.php?accion=viajes&propios=$propios&folder=browse\">Volver</a></div>";
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
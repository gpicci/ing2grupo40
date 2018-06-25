<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript">
$(function() {
    $( "#localidad_origen_id" ).combobox();
    $( "#localidad_destino_id" ).combobox();
  });
</script>
<?php
	require_once(DB_DIR.'/viajeDB.php');
	require_once("./db/vehiculoDB.php");
	require_once("./common/combo.php");
	require_once("./common/filtroDB.php");

	$db = DB::singleton();

	// Obtener el id actual, por defecto es el primero
	$idUsuario = (isset($_SESSION['user_id'])) ? $_SESSION['user_id']: -1;
	$f_desde = (isset($_REQUEST['f_desde'])) ? $_REQUEST['f_desde']:date('d-m-Y', mktime(0,0,0, date('m'), 1, date('Y')));
	$f_hasta = (isset($_REQUEST['f_hasta'])) ? $_REQUEST['f_hasta']: date('d-m-Y',strtotime(date('d-m-Y')."+ 30 days"));
	$piloto = (isset($_REQUEST['piloto'])) ? $_REQUEST['piloto']: -1;
	$localidad_origen_id= (isset($_REQUEST['localidad_origen_id'])) ? $_REQUEST['localidad_origen_id']: -1;
	$localidad_destino_id= (isset($_REQUEST['localidad_destino_id'])) ? $_REQUEST['localidad_destino_id']: -1;
	$tipo_viaje_id= (isset($_REQUEST['tipo_viaje_id'])) ? $_REQUEST['tipo_viaje_id']: -1;
	$viaje_id = -1;
	$cant = 0;

	$filtros = array();

	if ($piloto<>-1) {
		$filtro = new FiltroDB();
		$filtro->campo = "v.usuario_id";
		$filtro->valor = $piloto;
		$filtro->tipoDato = "N";
		$filtros [] = $filtro;
	}

	if ($localidad_origen_id<>-1) {
		$filtro = new FiltroDB();
		$filtro->campo = "v.localidad_origen_id";
		$filtro->valor = $localidad_origen_id;
		$filtro->tipoDato = "N";
		$filtros [] = $filtro;
	}

	if ($localidad_destino_id<>-1) {
		$filtro = new FiltroDB();
		$filtro->campo = "v.localidad_destino_id";
		$filtro->valor = $localidad_destino_id;
		$filtro->tipoDato = "N";
		$filtros [] = $filtro;
	}

	if ($tipo_viaje_id<>-1) {
		$filtro = new FiltroDB();
		$filtro->campo = "v.tipo_viaje_id";
		$filtro->valor = $tipo_viaje_id;
		$filtro->tipoDato = "N";
		$filtros [] = $filtro;
	}

	if ( (isSet($_REQUEST['propios'])) && ($_REQUEST['propios']==0) )  {
	    $propios = 0;
	} else {
	    $propios = 1;
	}


	if ( (isSet($_REQUEST['soloPendientes'])) && ($_REQUEST['soloPendientes']==1) )  {
	    $soloPendientes = 1;
	} else {
	    $soloPendientes = 0;
	}

	if ( (isSet($_REQUEST['soloPostulados'])) && ($_REQUEST['soloPostulados']==1) )  {
	    $soloPostulados = 1;
	} else {
	    $soloPostulados = 0;
	}

	$rs = getViajesPorUsuario($idUsuario, $propios,$filtros,$f_desde,$f_hasta, $soloPendientes, $soloPostulados);

	$cantRespuestas = getCantRespuestas($_SESSION['user_id']);

	$respuestas = "";

	if ($cantRespuestas>0) {
		$respuestas="($cantRespuestas)";
	}

?>
	<form name='formViajes' id='formViajes' method='post' action='' >
	<input type='hidden' name='op' id='op' value='' />
	<input type='hidden' name='usuario_id' id='usuario_id' value='<?php print ($idUsuario)?>' />
	<input type='hidden' name='propios' id='propios' value='<?php print ($propios)?>' />
	<input type='hidden' name='soloPostulados' id='soloPostulados' value='<?php print ($soloPostulados)?>' />
	<input type='hidden' name='soloPendientes' id='soloPendientes' value='<?php print ($soloPendientes)?>' />
	<div id="content">
		<div id="right">
<?php

	if($db->num_rows($rs) == 0) {
		print('No se han encontrado viajes.');
	} else {
		// Table header
?>
	<table>
		<tr>
      		<td align="center"><b>SEL</b></td>
      		<td align="center"><b>CODIGO</b></td>
      		<td align="center"><b>TIPO DE VIAJE</b></td>
         	<td align="center"><b>FECHA SALIDA</b></td>
         	<td align="center"><b>ORIGEN</b></td>
         	<td align="center"><b>DESTINO</b></td>
         	<td align="center"><b>PILOTO</b></td>
         	<td align="center"><b>VEHICULO</b></td>
         	<td align="center"><b>ASIENTOS</b></td>
<?php
            if ($propios!=1) {
                print ('<td align="center"><b>APROBACION</b></td>');
            }
?>
			<td align="center"><b>Postulados</b></td>
			<td align="center"><b>Aprobados</b></td>
			<td align="center"><b>PREG. / RTAS.</b></td>
   	</tr>
<?php
	while ($row = $db->fetch_assoc($rs)) {
		$cant = $cant+1;
		print('<tr>');
		if ($viaje_id == -1) {
			$viaje_id= $row['viaje_id'];
		 	print('<td align="center"><input type="radio" name="viaje_id" id="viaje_id" value="'.$row['viaje_id'].'" checked="checked" /></td>');
		} else {
			if ($viaje_id== $row['viaje_id']) {
		 		print('<td align="center"><input type="radio" name="viaje_id" id="viaje_id" value="'.$row['viaje_id'].'" checked="checked" /></td>');
		 	} else {
		 		print('<td align="center"><input type="radio" name="viaje_id" id="viaje_id" value="'.$row['viaje_id'].'" /></td>');
		 	}
		}

		//la columna de cant. de asientos la voy a utilizar para
		//cant. de asientos si el viaje esta abierto
		//y para mostrar que esta cerrado si es este el caso
		if ($row["terminado"]==1) {
		    $asientos = "<div style=\"color: #FF0000;\"><b> Viaje Finalizado</div>";
		} elseif ($row["cerrado"]==1) {
		    $asientos = "<div style=\"color: #FF0000;\"><b> Viaje Cerrado</div>";
		} else {
		    $asientos = $row['cantidad_asientos'];
		}

		print('
		 <td align="center">' . $row['viaje_id'] . '</td>
         <td align="center">' . $row['d_tipo_viaje'] . '</td>
         <td align="center">' . formatMSSQLFechaHora($row['fecha_salida'],$f,$h,$m,$s) . '</td>
         <td align="center">' . $row['localidad_origen'] . '</td>
		 <td align="center">' . $row['localidad_destino'] . '</td>
 		 <td align="center">' . $row['piloto'].'('.getCalificacionUsuario($row['piloto_id'], TIPO_PILOTO).')'. '</td>
         <td align="center">' . $row['nombre_vehiculo'] . '</td>
		 <td align="center">' . $asientos . '</td>');
                        if ($propios!=1) {
                            viajeEstadoCopiloto($row['viaje_id'], $idUsuario, $estado_id, $estadoPostulacion );
                            print ('<td align="center"> '. $estadoPostulacion . '</td>');
                        }

        $pendientes = 0;
        $aprobados = 0;
        $postulados = 0;
        $rechazados = 0;
        getPaxPorEstado($row['viaje_id'], $aprobados, $pendientes, $rechazados, $postulados);

        if ($row['cant_preguntas'] <> $row['cant_respuestas']) {
        	$preguntas = "<div style=\"color: #FF0000;\"><b> ".$row['cant_preguntas'].' / '. $row['cant_respuestas']."</div>";
        } else {
        	$preguntas = $row['cant_preguntas'].' / '. $row['cant_respuestas'];
        }

        print('
        <td align="center">' . $postulados . '</td>
        <td align="center">' . $aprobados . '</td>
		<td align="center">'.$preguntas. '</td>');

		print ('</tr>');
	}
	print("</table>");
}

?>
		</div>
	</div>
	<div id="left">
		<div class="box">
			<div>Total viajes: <?php print($cant); ?></div>
			<div><hr/></div>
			<?php if ($propios==1) { ?>
			<div><a href="javascript:performAltaViaje('formViajes');">Nuevo Viaje</a></div>
			<div><hr/></div>
				<?php if ($cant>0) { ?>
					<div><a href="javascript:performModViaje('formViajes');">Detalles del Viaje</a></div>
					<div><hr/></div>
					<div><a href="javascript:performBajaViaje('formViajes');">Eliminar Viaje</a></div>
					<div><hr/></div>
					<div><a href="javascript:performCerrarViaje('formViajes');">Cerrar Viaje</a></div>
					<div><hr/></div>
					<?php if (!$soloPendientes) { ?>
					<div><a href="javascript:performSoloPendientes('formViajes',1);">Mostrar Pendientes de Puntuacion</a></div>
					<div><hr/></div>
					<div><a href="javascript:performVerPreguntas('formViajes');">Responder Preguntas</a></div>
					<div><hr/></div>
					<?php } else {?>
					<div><a href="javascript:performSoloPendientes('formViajes',0);">Mostrar Todos</a></div>
					<div><hr/></div>
					<?php } ?>
					<div><a href="javascript:performTerminarViaje('formViajes');">Marcar Viaje Terminado</a></div>
					<div><hr/></div>
					<div><a href="javascript:performCalificarViaje('formViajes');">Calificar Viaje</a></div>
					<div><hr/></div>
				<?php }
				} elseif ($cant>0) { ?>
				<div><a href="javascript:performPostulacion('formViajes');">Postularme a este Viaje</a></div>
				<div><hr/></div>
				<div><a href="javascript:performBajaPostulacion('formViajes');">Anular postulacion</a></div>
				<div><hr/></div>
				<div><a href="javascript:performVerViaje('formViajes');">Ver Detalle</a></div>
				<div><hr/></div>
				<div><a href="javascript:performVerPreguntas('formViajes');">Preguntas/Respuestas</a></div>
				<div><hr/></div>
				<div><a href="javascript:performCalificarViaje('formViajes');">Calificar Viaje</a></div>
				<div><hr/></div>
			<?php }; ?>
				<?php if (!$soloPostulados) { ?>
				<div><a href="javascript:performSoloPostulados('formViajes',1);">Mis Postulaciones</a></div>
				<div><hr/></div>
				<?php } else {?>
				<div><a href="javascript:performSoloPostulados('formViajes',0);">Mostrar Todos</a></div>
				<div><hr/></div>
				<?php } ?>
				<?php if (!$soloPendientes) { ?>
				<div><a href="javascript:performSoloPendientes('formViajes',1);">Mostrar Pendientes de Puntuacion</a></div>
				<div><hr/></div>
				<?php } else {?>
				<div><a href="javascript:performSoloPendientes('formViajes',0);">Mostrar Todos</a></div>
				<div><hr/></div>
				<?php } ?>
			<div><p><br/></p></div>
			<div><hr/></div>
			<fieldset>
			<legend>BUSCAR</legend>
				<fieldset>
				<legend>Por Tipo de Viaje</legend>
					<div><p></p></div>
					<div>
						<?php
						$rs = getTipoViajeFiltro();
						comboBox("tipo_viaje_id", $rs, "tipo_viaje_id", "nombre", "", $tipo_viaje_id, "");
						?>
					</div>
				</fieldset>
				<div><p></p></div>
				<fieldset>
				<legend>Por Fecha de Salida</legend>
					<div><p></p></div>
					<div>
						<label for="f_desde">Desde</label>
	        			<input size="12" type="text" id="f_desde" name="f_desde" style="width:80px" value="<?php print $f_desde; ?>"/>
	        			<span id="f_desde"></span>
	        			<?php echo'<a id="calendarDesde" href="javascript:OpenCal('."'f_desde'".');" style="width:16px"><img class="calendar" src="./img/calendar.png" width="16" height="16" />';?></a>
					</div>
					<div><p></p></div>
					<div>
						<label for="f_hasta">Hasta</label>
	        			<input size="12" type="text" id="f_hasta" name="f_hasta" style="width:80px" value="<?php print $f_hasta; ?>"/>
	        			<span id="f_hasta"></span>
	        			<?php echo'<a id="calendarHasta" href="javascript:OpenCal('."'f_hasta'".');" style="width:16px"><img class="calendar" src="./img/calendar.png" width="16" height="16" />';?></a>
					</div>
				</fieldset>
				<div><p></p></div>
				<?php if ($propios == 0){ ?>
				<fieldset>
				<legend>Por Piloto</legend>
					<div><p></p></div>
					<div><label for="piloto">Piloto </label>
					<?php 	$rs = getPilotosViajesActuales($idUsuario,$propios);
						comboBox("piloto", $rs, "usuario_id", "piloto", "", $piloto, "");

				echo ('</fieldset>');
				}?>
				<div><p></p></div>
				<fieldset>
				<legend>Por Origen</legend>
					<div><p></p></div>
					<div>
						<?php

						$rs = getLocalidadFiltroViajes();
							comboBox("localidad_origen_id", $rs, "localidad_id", "nombre_localidad", "", $localidad_origen_id, "");
						?>
					</div>
				</fieldset>
				<div><p></p></div>
				<fieldset>
				<legend>Por Destino</legend>
					<div><p></p></div>
					<div>
						<?php
						$rs = getLocalidadFiltroViajes();
						comboBox("localidad_destino_id", $rs, "localidad_id", "nombre_localidad", "", $localidad_destino_id, "");
						?>
					</div>
				</fieldset>
				<p>
					<a href="javascript:performFiltrosViajes('formViajes');">Aplicar Filtros</a>
				</p>
			</fieldset>
		</div>
	</div>
	</form>
</body>
<?php
require_once dirname( __DIR__ ).'/config.php';
require_once dirname( __DIR__ ).'/'.COM_DIR.'/pages.php';
require_once dirname( __DIR__ ).'/lookupData.php';
require_once dirname( __DIR__ ).'/filtroDB.php';
require_once dirname( __DIR__ ).'/'.DB_DIR. '/listaPagosRptDB.php';
require_once dirname( __DIR__ ).'/'.COM_DIR.'/combo.php';
require_once dirname( __DIR__ ).'/'.COM_DIR.'/util.php';

	$db = DB::singleton();

	// Determinar el orden, por defecto es c_id
	$sort = (isset($_POST['sort'])) ? $_POST['sort'] : 'f_pago';


  // Aplicar filtro x localidad, si existe
  $filtroLoc = (isset($_POST['c_id_localidad'])) ? $_POST['c_id_localidad'] : -1;

  // Aplicar filtro x estado, si existe
  $filtroUsuario = (isset($_POST['c_id_usuario'])) ? $_POST['c_id_usuario'] : -1;
  
  $f_primer_dia = date('d-m-Y', mktime(0,0,0, date('m'), 1, date('Y')));

  $f_desde = (isset($_POST['f_desde'])) ? $_POST['f_desde'] : $f_primer_dia;
  $f_hasta = (isset($_POST['f_hasta'])) ? $_POST['f_hasta'] : date('d-m-Y');

  if (isset($_POST['order']) and $_POST['order'] == 'ASC') {
  	$order = 'DESC';
  } elseif (isset($_POST['order']) and $_POST['order'] == 'DESC') {
  	$order = 'ASC';
  } else {
  	$order = 'DESC';
  }

	//$pagsTotal = getPageCount('isp_cliente', 'd_nombre', $filtro);
	$filtros = array();

	if ($filtroUsuario<>-1) {
		$filtro = new FiltroDB();
		$filtro->campo = "c_id_usuario";
		$filtro->valor = $filtroUsuario;
		$filtro->tipoDato = "N";
		$filtros [] = $filtro;
	}

	if ($filtroLoc<>-1) {
  		$filtro = new FiltroDB();
  		$filtro->campo = "c_id_localidad";
  		$filtro->valor = $filtroLoc;
  		$filtro->tipoDato = "N";
  		$filtros [] = $filtro;
  	}

  	if (($f_desde<>"")&&($f_hasta<>"")){
  		$filtro = new FiltroDB();
  		$filtro->campo = "f_pago";
  		$filtro->valor1 = str_replace("-","/",$f_desde);
  		$filtro->valor2 = str_replace("-","/",$f_hasta);
  		$filtro->tipoDato = "B";
  		$filtros [] = $filtro;
  	}

	//seteo con Magdalena
	$idLocalidad=ID_LOCALIDAD_DEFAULT;

	$cantPagos = pagosGetCantidad($filtros);

	$montoPagos = 0;

	$pagsTotal=0;
	$pagActual=1;

?>

	<form name='formListaPagos' id='formListaPagos' method='post' action='' >
	<input type='hidden' name='op' id='op' value='' />
	<input type='hidden' name='sort' id='sort' value='<?php print($sort); ?>' />
	<input type='hidden' name='pagsTotal' id='pagsTotal' value='<?php print($pagsTotal); ?>' />
	<input type='hidden' name='pagActual' id='pagActual' value='<?php print($pagActual); ?>' />
	<input type='hidden' name='order' id='order' value='<?php print($order); ?>' />
	<div id="content" >
		<div id="right" style="display: block; height: 400px; overflow: auto;">
<?php
	$rs = getPagos($pagActual, RECS_PER_PAGE, $filtros, $sort, $order);

	if($db->num_rows($rs) == 0) {
		print('No hay pagos seleccionados.');
	} else {
		// Table header
?>
	<table >
	<tr>
		<tr>
      	<td><b>Codigo</b></td>
      	<td><b><a href="javascript:submitForm('formListaPagos', 'nombreCliente', <?php print($pagsTotal); ?>, <?php print($pagActual); ?>)">Nombre Cliente</a></b></td>
        <td><b>Nro. recibo</b></td>
        <td><b>Período</b></td>
        <td><b><a href="javascript:submitForm('formListaPagos', 'f_pago', <?php print($pagsTotal); ?>, <?php print($pagActual); ?>)">Fecha Pago</a></b></td>
		<td><b><a href="javascript:submitForm('formListaPagos', 'nombreUsuario', <?php print($pagsTotal); ?>, <?php print($pagActual); ?>)">Usuario</a></b></td>
        <td><b>Total</b></td>
        <td><b>Localidad</b></td>
        <td><b>Comprobante Pago</b></td>
   	</tr>
<?php
	while ($row = $db->fetch_assoc($rs)) {
		$montoPagos = $montoPagos + $row['i_total'];
		print('<tr>');
		$pagoChecked = "";
		print(
		'<td>' . $row['c_id'] . '</td>
		<td>' . $row['nombreCliente'] . '</td>
         <td>' . $row['n_recibo'] . '</td>
         <td>' . $row['nombrePeriodo'] . '</td>
         <td>' . $row['f_pago'] . '</td>
         <td>' . $row['nombreUsuario'] . '</td>
         <td>'. $row['i_total'] . '</td>
         <td>' . $row['nombreLocalidad'] . '</td>');
			if (isset($row['d_letra_comprobante'])){
				print('<td>' . $row['d_letra_comprobante'].' '.getLpad($row['n_comprobante_1'],4).'-'.getLpad($row['n_comprobante_2'],8).'</td>');
			} else {
				print('<td></td>');
			}
		print('</tr>');
	}
	print("</table>");
}

?>
		</div>
	</div>
	<div id="left" style="position: fixed; right: 0px; " >
		<div class="box">
			<div>Total Pagos listados: <?php print($cantPagos); ?></div>
			<div><br></div>
			<div>Monto Total: <?php print($montoPagos); ?></div>
			<div><br></div>
			<div><a href="javascript:exportListadoPagos('formListaPagos');">Exportar a Excel</a></div>
			<div><br></div>
			<div><hr/></div>
      		<fieldset>
				<legend>Filtro (por usuario)</legend>
					<p>
						<?php
							$rs = getUsuariosLookup();
						  	comboBox("c_id_usuario", $rs, "c_id", "d_nombre", "Todos", $filtroUsuario, "");
						?>
					</p>
					<p>
						<a href="javascript:changePageConfirmaPagos('formListaPagos', '<?php print($sort); ?>', -1, -1);">Aplicar</a>
					</p>
			</fieldset>
      		<fieldset>
				<legend>Filtro (por localidad)</legend>
					<p>
						<?php
							$rs = getLocalidad();
						  	comboBox("c_id_localidad", $rs, "c_id", "d_descripcion", "TODAS", $filtroLoc, "");
						?>
					</p>
					<p>
						<a href="javascript:changePageConfirmaPagos('formListaPagos', '<?php print($sort); ?>', -1, -1);">Aplicar</a>
					</p>
			</fieldset>
			<fieldset>
				<legend>Filtro (por fecha de pago)</legend>
					<label>Desde:</label>
					<input type="text" name="f_desde" id="f_desde" value="<?php print(($f_desde != '%') ? $f_desde : ''); ?>" />
        			<a id="calendarFDesde" href="javascript:OpenCal('f_desde');" style="width:16px"><img class="calendar" src="./img/calendar.png" width="16" height="16" /></a>
					<div><br></div>
					<label>Hasta:</label>
					<input type="text" name="f_hasta" id="f_hasta" value="<?php print(($f_hasta!= '%') ? $f_hasta: ''); ?>" />
        			<a id="calendarFHasta" href="javascript:OpenCal('f_hasta');" style="width:16px"><img class="calendar" src="./img/calendar.png" width="16" height="16" /></a>
					<p>
						<a href="javascript:changePageConfirmaPagos('formListaPagos', '<?php print($sort); ?>', -1, -1);">Aplicar</a>
						<a href="javascript:clearFilter('formListaPagos', '<?php print($sort); ?>', -1, -1, 'f_hasta', '')">Quitar</a>
					</p>
			</fieldset>
		</div>
	</div>
	</form>
</body>
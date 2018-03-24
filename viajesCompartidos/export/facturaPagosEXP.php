<?php
  ob_start();

  require_once('../PHPExcel-1.8/Classes/PHPExcel.php');
  require_once('../common/util.php');
  require_once('../db/facturaPagosRptDB.php');

  $sort = (isset($_POST['sort'])) ? $_POST['sort'] : 'f_pago';

  // Aplicar filtro x localidad, si existe
  $filtroLoc = (isset($_POST['c_id_localidad'])) ? $_POST['c_id_localidad'] : $idLocalidad;

  // Aplicar filtro x estado, si existe
  $filtroUsuario = (isset($_POST['c_id_usuario'])) ? $_POST['c_id_usuario'] : -1;
  $filtroFecha = (isset($_POST['filtroFecha'])) ? $_POST['filtroFecha'] : "";
  $filtroNom = (isset($_POST['filtroNom'])) ? $_POST['filtroNom'] : '%';
  $filtroPeriodo = (isset($_POST['c_id_periodo'])) ? $_POST['c_id_periodo'] : -1;

  $filtros = array();

  if (($filtroNom != '%')&&($filtroNom !='')){
	$filtroEst = -1;
  }

  $filtro = new FiltroDB();
  $filtro->campo = "c.d_nombre";
  $filtro->valor = $filtroNom;
  $filtros [] = $filtro;

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

  if ($filtroFecha<>"") {
    $filtro = new FiltroDB();
  	$filtro->campo = "f_emision";
  	$filtro->valor = str_replace("-","/",$filtroFecha);
  	$filtro->tipoDato = "D";
  	$filtros [] = $filtro;
  }

  if ($filtroPeriodo<>-1) {
  	$filtro = new FiltroDB();
  	$filtro->campo = "c_id_periodo";
  	$filtro->valor = $filtroPeriodo;
  	$filtro->tipoDato = "N";
  	$filtros [] = $filtro;
  }

  if (isset($_POST['order']) and $_POST['order'] == 'DESC') {
  	$order = 'ASC';
  } elseif (isset($_POST['order']) and $_POST['order'] == 'ASC') {
  	$order = 'DESC';
  } else {
  	$order = 'ASC';
  }

  $pagActual=0;

  // Se crea el objeto PHPExcel
  $objPHPExcel = new PHPExcel();

  // Se asignan las propiedades del libro
  $objPHPExcel->getProperties()->setCreator("administrador") // Nombre del autor
  ->setLastModifiedBy("administrador") //Ultimo usuario que lo modificó
  ->setTitle("Listado de Pagos a Facturar") // Titulo
  ->setSubject("Listado de Pagos a Facturar") //Asunto
  ->setDescription("Listado de Pagos a Facturar") //Descripción
  ->setKeywords("listado pago factura") //Etiquetas
  ->setCategory("Reporte excel"); //Categorias

  $tituloReporte = "Listado de Pagos a Facturar";
  $titulosColumnas = array('CLIENTE', 'RECIBO', 'FECHA DE PAGO', 'IMPORTE');

  // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
  $objPHPExcel->setActiveSheetIndex(0)
  ->mergeCells('A1:D1');

  // Se agregan los titulos del reporte
  $objPHPExcel->setActiveSheetIndex(0)
  ->setCellValue('A1',$tituloReporte) // Titulo del reporte
  ->setCellValue('A3',  $titulosColumnas[0])  //Titulo de las columnas
  ->setCellValue('B3',  $titulosColumnas[1])
  ->setCellValue('C3',  $titulosColumnas[2])
  ->setCellValue('D3',  $titulosColumnas[3]);

  //Se agregan los datos
  $db = DB::singleton();

  $rs = getPagosAFacturarRPT($pagActual, 10, $filtros, $sort,$order);

  $i = 4; //Numero de fila donde se va a comenzar a rellenar

  while($row = $db->fetch_assoc($rs)) {
  	$objPHPExcel->setActiveSheetIndex(0)
  	->setCellValue('A'.$i, utf8_encode($row['nombreCliente']))
  	->setCellValue('B'.$i, $row['n_recibo'])
  	->setCellValue('C'.$i, $row['f_pago'])
  	->setCellValue('D'.$i, $row['d_total']);

  	$i++;
  }

  $estiloTituloReporte = array(
  		'font' => array(
  				'name'      => 'Verdana',
  				'bold'      => true,
  				'italic'    => false,
  				'strike'    => false,
  				'size' =>16,
  				'color'     => array('rgb' => 'FFFFFF')
  				),
		'fill' => array(
  				'type'  => PHPExcel_Style_Fill::FILL_SOLID,
  				'color' => array('argb' => 'FF220835')
  				),
  		'borders' => array(
  				'allborders' => array('style' => PHPExcel_Style_Border::BORDER_NONE)
  				),
  		'alignment' => array(
  				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
  				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
  				'rotation' => 0,
  				'wrap' => TRUE
  				)

  		);

  $estiloTituloColumnas = array(
  		'font' => array(
  				'name'  => 'Arial',
  				'bold'  => true,
  				'color' => array('rgb' => '000000')
  				),
  		'fill' => array(
  				'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
  				'rotation'   => 90,
  				'startcolor' => array('rgb' => '00ccff'),
  				'endcolor' => array('argb' => 'FF431a5d')
				),
  		'borders' => array(
  				'top' => array(
  						'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
  						'color' => array('rgb' => '3a2a47')
						),
  				'bottom' => array(
  						'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
  						'color' => array('rgb' => '3a2a47')
  						),
  				'left' => array(
  						'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
  						'color' => array('rgb' => '3a2a47')
  						),
  				'right' => array(
  						'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
  						'color' => array('rgb' => '3a2a47')
  						)

  				),
  		'alignment' =>  array(
  				'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
  				'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
  				'wrap'      => TRUE
  				)

  	);

  $estiloInformacion = new PHPExcel_Style();

  $estiloInformacion->applyFromArray( array(
  		'font' => array(
  				'name'  => 'Arial',
  				'color' => array('rgb' => '000000')
				),
  		'fill' => array(
  				'type'  => PHPExcel_Style_Fill::FILL_SOLID,
  				'color' => array('argb' => 'ffffff')
		  		),
  		'borders' => array(
  				'left' => array(
  						'style' => PHPExcel_Style_Border::BORDER_THIN ,
  						'color' => array('rgb' => '3a2a47')
	  					),
  				'right' => array(
  						'style' => PHPExcel_Style_Border::BORDER_THIN ,
  						'color' => array('rgb' => '3a2a47')
  						),
  				'bottom' => array(
  						'style' => PHPExcel_Style_Border::BORDER_THIN ,
  						'color' => array('rgb' => '3a2a47')
  				)

  		)

  ));


  $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estiloTituloReporte);

  $objPHPExcel->getActiveSheet()->getStyle('A3:D3')->applyFromArray($estiloTituloColumnas);

  $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:D".($i-1));

  /*
   Ahora procedemos a asignar el ancho de las columnas de forma automática en base al contenido de cada una de ellas y
   lo hacemos con un ciclo de la siguiente forma.*/
  for($i = 'A'; $i <= 'D'; $i++){
  	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
  }

  // Se asigna el nombre a la hoja
  $objPHPExcel->getActiveSheet()->setTitle('Facturas');

  // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
  $objPHPExcel->setActiveSheetIndex(0);

  // Inmovilizar paneles
  //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
  $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

  // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="ListadoPagosFacturar.xls"');
  header('Cache-Control: max-age=0');

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  ob_end_clean();
  $objWriter->save('php://output');
?>
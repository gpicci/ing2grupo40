<?php
  ob_start();
  require_once dirname( __DIR__ ).'/config.php';
  require_once dirname( __DIR__ ).'/PHPExcel-1.8/Classes/PHPExcel.php';
  require_once dirname( __DIR__ ).'/'.COM_DIR.'/util.php';
  require_once dirname( __DIR__ ).'/'.DB_DIR.'/listaPagosRptDB.php';
  require_once dirname( __DIR__ ).'/filtroDB.php';


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
  

  // Se crea el objeto PHPExcel
  $objPHPExcel = new PHPExcel();

  // Se asignan las propiedades del libro
  $objPHPExcel->getProperties()->setCreator("administrador") // Nombre del autor
  ->setLastModifiedBy("administrador") //Ultimo usuario que lo modificó
  ->setTitle("Listado de Pagos") // Titulo
  ->setSubject("Listado de Pagos") //Asunto
  ->setDescription("Listado de Pagos") //Descripción
  ->setKeywords("listado pago") //Etiquetas
  ->setCategory("Reporte excel"); //Categorias

  $tituloReporte = "Listado de Pagos entre fechas";
  $titulosColumnas = array('CODIGO', 'CLIENTE','PERIODO','FECHA PAGO','IMPORTE','LOCALIDAD','COMPROBANTE');

  // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
  $objPHPExcel->setActiveSheetIndex(0)
  ->mergeCells('A1:G1');

  // Se agregan los titulos del reporte
  $objPHPExcel->setActiveSheetIndex(0)
  ->setCellValue('A1',$tituloReporte) // Titulo del reporte
  ->setCellValue('A3',  $titulosColumnas[0])  //Titulo de las columnas
  ->setCellValue('B3',  $titulosColumnas[1])
  ->setCellValue('C3',  $titulosColumnas[2])
  ->setCellValue('D3',  $titulosColumnas[3])
  ->setCellValue('E3',  $titulosColumnas[4])
  ->setCellValue('F3',  $titulosColumnas[5])
  ->setCellValue('G3',  $titulosColumnas[6]);

  //Se agregan los datos
  $db = DB::singleton();
  
  $pagsTotal=0;
  $pagActual=1;

  $rs = getPagos($pagActual, RECS_PER_PAGE, $filtros, $sort, $order);
  
  $i = 4; //Numero de fila donde se va a comenzar a rellenar

  while($row = $db->fetch_assoc($rs)) {
  	
  	if (isset($row['d_letra_comprobante'])){
  		$comprobante = $row['d_letra_comprobante'].' '.getLpad($row['n_comprobante_1'],4).'-'.getLpad($row['n_comprobante_2'],8);
  	} else {
  		$comprobante = '';
  	}
  	
  	
  	$objPHPExcel->setActiveSheetIndex(0)
  	->setCellValue('A'.$i, $row['c_id'])
  	->setCellValue('B'.$i, utf8_encode($row['nombreCliente']))
  	->setCellValue('C'.$i, $row['nombrePeriodo'])
  	->setCellValue('D'.$i, $row['f_pago'])
  	->setCellValue('E'.$i, $row['i_total'])
  	->setCellValue('F'.$i, $row['nombreLocalidad'])  	
  	->setCellValue('G'.$i, $comprobante);

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


  $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($estiloTituloReporte);

  $objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($estiloTituloColumnas);

  $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:G".($i-1));

  /*
   Ahora procedemos a asignar el ancho de las columnas de forma automática en base al contenido de cada una de ellas y
   lo hacemos con un ciclo de la siguiente forma.*/
  for($i = 'A'; $i <= 'G'; $i++){
  	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
  }

  // Se asigna el nombre a la hoja
  $objPHPExcel->getActiveSheet()->setTitle('Listado');

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
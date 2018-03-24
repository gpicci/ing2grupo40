<?php
require_once('../tcpdf/config/lang/spa.php');
require_once('../tcpdf/tcpdf.php');
require_once('../common/util.php');
require_once("../filtroDB.php");

ob_clean();

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
  	
  	
// extend TCPF with custom functions
class MYPDF extends TCPDF {
	// Load table data from file
	public function LoadData($filtros, $sort,$order,$pagActual) {
		require_once('../db/facturaPagosRptDB.php');
		
		$db = DB::singleton();
		
	   $rs = getPagosAFacturarRPT($pagActual, 10, $filtros, $sort,$order);
		
		// Read file lines
		$data = array();

		while($row = $db->fetch_assoc($rs)) {	
			$data[] = explode(';', $row['nombreCliente'].
							  ';'.$row['n_recibo'].
							';'.$row['f_pago'].
							';'.$row['i_total'].
							';'.$row['nombreUsuario']
									);
		}
		return $data;
	}
	
	// Colored table
	public function ColoredTable($header,$data) {
		// Colors, line width and bold font
		$this->SetFillColor(106, 106, 106);
		$this->SetTextColor(255);
		$this->SetDrawColor(128, 0, 0);
		$this->SetLineWidth(0.3);
		$this->SetFont('', 'B','7');
		// Header
		$w = array(50,15,20,15,50);
		$num_headers = count($header);
		for($i = 0; $i < $num_headers; ++$i) {
			$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
		}
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(224, 235, 255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = 0;
		$rowCount = 0;
		
		foreach($data as $row) {
			$this->Cell($w[0], 5, $row[0], 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 5, $row[1], 'LR', 0, 'C', $fill);
			$this->Cell($w[2], 5, $row[2], 'LR', 0, 'C', $fill);
			$this->Cell($w[3], 5, $row[3], 'LR', 0, 'C', $fill);
			$this->Cell($w[4], 5, $row[4], 'LR', 0, 'L', $fill);
			$this->Ln();
			$fill=!$fill;
			$rowCount++;
		}
		
		$this->Ln();
		
		$this->writeHTML('Cantidad Total de recibos: '.$rowCount, true, false, true, false, '');

	}
	
	
}


// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Metler');
$pdf->SetTitle('Listado de recibos pendientes de facturacion');
$pdf->SetSubject('Reporte');
$pdf->SetKeywords('facturas, pendientes, Metler');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Listado de recibos pendientes de facturacion', date('d-m-Y'));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 8);

// add a page
$pdf->AddPage();

//Column titles

$header = array('Cliente', 'Recibo','Fecha de Pago','Importe','Usuario');

//Data loading
$data = $pdf->LoadData($filtros, $sort,$order,$pagActual);

// print colored table
$pdf->ColoredTable($header, $data);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('recibosPendientes.pdf', 'I');
?>
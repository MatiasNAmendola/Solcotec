<?
require('fpdf.php');

class MyPDF extends FPDF{
	}

class TablePDF extends FPDF {

// Pie de Pagina
function footer() {
//LINEA INFERIOR
$this->setY(26.3);// posicion de la linea desde arriba. 
$this->cell(0.001, 0.1,"", 0, 0, 'L'); // espacio izquierdo antes de linea
$this->cell(19.5, 0.01,"", 1, 0, 'L');// linea

$this->setY(21.35);// posicion texto desde arriba
$this->setFont("Helvetica", 'B', 8);
$this->ln(0.35);


$this->cell(1, 10,"", 0, 0, 'L');
$this->cell(4.3, 10,utf8_decode("Teléfonos:"), 0, 0, 'L');
$this->cell(5.7, 10,utf8_decode("Dirección:"), 0, 0, '');
$this->cell(3.9, 10,"Web:", 0, 0, '');
$this->cell(1.3, 10,"Mail:", 0, 0, '');

$this->ln(0.35);
$this->setFont("Helvetica", '', 7.8);

$this->cell(1, 10,"", 0, 0, 'L');
$this->cell(4.3, 10,"2 7785155 | 2 779 5630", 0, 0, 'L');
$this->cell(5.7, 10,utf8_decode("Ruiz Tagle #714 | Estación Central."), 0, 0, '');
$this->setTextColor(0,0,255);
$this->setFont("Helvetica", 'UB', 7.8);
$this->cell(3.9, 10,"www.solcotec.cl", 0, 0, '','',"http://www.solcotec.cl");
$this->setTextColor(0);
$this->setFont("Helvetica", '', 7.8);
$this->cell(1.3, 10,"ventas@solcotec.cl", 0, 0, '');
}

function buildTable($header, $data) {
$this->setFillColor(0, 0, 83);
$this->setTextColor(255);
$this->setDrawColor(0, 0, 0);
$this->setLineWidth(0);
$this->setFont('Helvetica', 'B',8);

// Anchos de columna
$widths = array(3, 13,3);

// envia los headers al documento PDF 
for($i = 0; $i < count($header); $i++) {
$this->cell($widths[$i], 0.55, $header[$i], 0.1, 0, 'C', 1); }
$this->ln();

// Color and font restoration
$this->setFillColor(239,239,239);
$this->setTextColor(0);
$this->SetFont('Helvetica','B',7.8);

// ahora saca la informacion desde el  $data arreglo
$fill = 0;
foreach($data as $row) {
$this->cell($widths[0], 0.5, '   '.$row[0], 'LR', 0, 'L', $fill);
$this->cell($widths[1], 0.5, $row[1], 'LR', 0, 'L', $fill);
$this->cell($widths[2], 0.5, $row[2], 'LR', 0, 'C', $fill);
$this->ln();
$fill = ($fill) ? 0 : 1;
}
$this->cell(array_sum($widths), 0, '', 'T'); }
}

include "php/conexion.php";
$resultado=mysql_query("select codigo_producto, nombre, p_venta  from producto ;") or die (mysql_error());

// build the data array from the database records.
while ($row=mysql_fetch_array($resultado)) {
$data[] = array(utf8_decode($row['codigo_producto']), utf8_decode($row['nombre']), $row['p_venta']);
}
// start and build the PDF document
$pdf = new TablePDF('P', 'cm', 'Letter');

// Titulos  de las Columnas.
$header = array(utf8_decode("Código"), utf8_decode("Descripción"), "Precio Venta");

$pdf->setFont("Helvetica", 'BU', 10);
$pdf->addPage();
$pdf->image("logo.png",1,1,5,2);
$pdf->Cell(7,1.8,'',0,0,'');// Espacio izquierdo de la linea.
$pdf->Cell(0.01,1.9,'',1,0,'');// Linea.
$pdf->Cell(0.8,1.8,'',0,0,'');// Espacio derecho de la linea.
$pdf->Cell(2,1.2,'COMERCIALIZADORA SOLCOTEC - Lista de precios.',0,1,'');

// LINEA HORIZONTAL SUPERIOR
$pdf->setY(3.2);// posicion de la linea desde arriba. 
$pdf->cell(0.001, 0.1,"", 0, 0, 'L'); // espacio izquierdo antes de linea
$pdf->cell(19.5, 0.01,"", 1, 0, 'L');// linea
$pdf->ln(0.4); 
$pdf->buildTable($header, $data);
$pdf->output();


/*

$pdf = new FPDF('P', 'cm', 'Letter');
$pdf->AddPage();
$pdf->SetFont('Helvetica','B',11);

$pdf->image("logo.png",1,0.6,5,2);
$pdf->Cell(23,1.7,'COMERCIALIZADORA SOLCOTEC - LISTA DE PRECIOS',0,1,'C');
$pdf->ln(0.3);


while($fila=mysql_fetch_array($resultado)){
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(10,0.5,$fila["nombre"],1,1);
$pdf->Cell(10,0.5,$fila["stock"],1,1);
}
$pdf->Output();*/

//$pdf->Cell(10,0.5,$fila["stock"],1,1);
?>
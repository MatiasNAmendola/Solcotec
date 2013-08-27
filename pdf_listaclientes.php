<?
include"php/valida.php";
require('fpdf.php');

$id_vendedor=$_SESSION['id_usuario'];
$nombre_vendedor=$_GET['nombre_vendedor'];

class PDF_Mc_Table extends FPDF {

var $widths;
var $aligns;

function footer(){
	$fecha=date('d/m/Y');
	if($this->PageNo()!=1){
	$this->SetY(26.5);
	$this->Cell(0,0.001,'',1,0,'','','');
	$this->SetFont('Helvetica','B', 8);
	$this->Cell(0,0.5,utf8_decode('Fecha: '.$fecha.' - [ Página '.$this->PageNo().' ]'),0,1,'R');
	}
	}
	
function header(){
	if($this->PageNo()!=1){
		$this->SetTextColor(255);
$this->SetFillColor(0,0,90);

$this->Cell(3,0.5,utf8_decode('   NOMBRE'),1,0,'L',1);
$this->Cell(13.6,0.5,utf8_decode('   RUT'),1,0,'L',1);
$this->Cell(3,0.5,'   TELEFONO',1,1,'L',1);
$this->SetTextColor(0);
$this->Cell(0,0.1,'',1,1,'');


		}
	
	}

function SetWidths($w)
{
//Set the array of column widths
$this->widths=$w;
}

function SetAligns($a)
{
//Set the array of column alignments
$this->aligns=$a;
}

function fill($f)
{
//juego de arreglos de relleno
$this->fill=$f;
}

function Row($data)
{
//Calculate the height of the row
$nb=0;
for($i=0;$i<count($data);$i++)
$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
$h=0.45*$nb;

//Issue a page break first if needed
$this->CheckPageBreak($h);

//Draw the cells of the row

for($i=0;$i<count($data);$i++)

{

$w=$this->widths[$i];

$a=isset($this->aligns[$i]) ? $this->aligns[$i] : ‘L’;

//Save the current position

$x=$this->GetX();

$y=$this->GetY();

//Draw the border

$this->Rect($x,$y,$w,$h,DF);
//Print the text
//$this->SetFillColor(0,100,250);

$this->MultiCell($w,0.45,$data[$i],’LTR’,$a,1);

//Put the position to the right of the cell
$this->SetXY($x+$w,$y);

}

//Go to the next line

$this->Ln($h);

}

function CheckPageBreak($h)

{

//If the height h would cause an overflow, add a new page immediately

if($this->GetY()+$h>$this->PageBreakTrigger)

$this->AddPage($this->CurOrientation);

}

function NbLines($w,$txt)

{

//Computes the number of lines a MultiCell of width w will take

$cw=&$this->CurrentFont['cw'];

if($w==0)

$w=$this->w-$this->rMargin-$this->x;

$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;

$s=str_replace('\r','',$txt);

$nb=strlen($s);

if($nb>0 and $s[$nb-1]=='\n')

$nb–;

$sep=-1;

$i=0;

$j=0;

$l=0;

$nl=1;

while($i<$nb)

{

$c=$s[$i];

if($c=='\n')

{

$i++;

$sep=-1;

$j=$i;

$l=0;

$nl++;

continue;

}

if($c=='')

$sep=$i;

$l+=$cw[$c];

if($l>$wmax)

{

if($sep==-1)

{

if($i==$j)

$i++;

}

else

$i=$sep+1;

$sep=-1;

$j=$i;

$l=0;

$nl++;

}

else

$i++;

}

return $nl;

}

}// fin class table pdf

// start and build the PDF document
$pdf = new PDF_Mc_Table('P', 'cm', 'Letter');
$pdf->addPage();
$pdf->SetAutoPageBreak(true,1.5);  
$pdf->SetTitle('Listado de Precios',true);
$pdf->image("logo.png",1.2,1.5,5.7,2.3);


include "php/conexion.php";

// LINEA VERTICAL SUPERIOR
$pdf->ln(0.5);
$pdf->Cell(6.5,0.1,'',0,0,'');// Espacio izquierdo de la linea.

$pdf->Cell(0.01,2.1,'',1,0,'');// Linea.
$pdf->Cell(0.45,0,'',0,0,'');// Espacio izquierdo del SUB TITULO.

$pdf->setFont("Helvetica", 'B', 11);
$pdf->Cell(9.2,0.4,'COMERCIALIZADORA SOLCOTEC LTDA.',0,1,'');



//SUBTITULO
$pdf->setFont("Helvetica", '', 9);

$pdf->Cell(6.97,0.35,'',0,0,'');// Espacio izquierdo del SUB TITULO.
$pdf->Cell(8.6,0.35,utf8_decode('Importadora de máquinas y soldadoras, repuestos'),0,1,'');

$pdf->Cell(6.97,0.35,'',0,0,'');// Espacio izquierdo del SUB TITULO.
$pdf->Cell(7.7,0.35,utf8_decode('e Insumos. Artículos de ferretería industrial.'),0,1,'');
$pdf->setFont("Helvetica", 'B', 9);


$pdf->ln(0.1);//---------------------------------

$pdf->Cell(6.97,0.5,'',0,0,'');
$pdf->Cell(12.6,0.08,'',1,1,'','true');// ESPACIO EN BLANCO COMPLETOO

$pdf->Cell(6.97,0.5,'',0,0,'');
$fecha=date('d - m - Y');
$pdf->Cell(11,0.5,'LISTADO DE CLIENTES '.$nombre_vendedor.'  /  Fecha: '.$fecha.'.',1,1,'');

$pdf->ln(0.3);//---------------------------------




$pdf->Cell(0,0.8,'',0,1,'');


////////////////////////////////////////////////////////////////////

if($_SESSION['tipo_usuario']!=1){
	

$consulta_sql="SELECT nombre_cliente, rut, telefono, direccion FROM cliente  ORDER BY  nombre_cliente ;";

$resultado=mysql_query($consulta_sql, $conexion) or die (mysql_error());

}

else{
	
	$consulta_sql="SELECT nombre_cliente, rut, telefono, direccion FROM cliente WHERE id_vendedor='$id_vendedor' ORDER BY  nombre_cliente ;";

$resultado=mysql_query($consulta_sql, $conexion) or die (mysql_error());
	
	}

$pdf->SetFont('Helvetica','B', 8);

//un arreglo con su medida  a lo ancho

$pdf->SetWidths(array(9.6,3,3,4));

//un arreglo con alineacion de cada celda

$pdf->SetAligns(array('L','C','C','L'));
//utf8_decode es para que escriba bien
//los acentos.

$pdf->SetTextColor(255);
$pdf->SetFillColor(0,0,90);

$pdf->Cell(9.6,0.5,utf8_decode('Nombre'),1,0,'L',1);
$pdf->Cell(3,0.5,utf8_decode('RUT'),1,0,'C',1);
$pdf->Cell(3,0.5,utf8_decode('Teléfono'),1,0,'C',1);
$pdf->Cell(4,0.5,utf8_decode('Dirección'),1,1,'C',1);
$pdf->SetTextColor(0);
$pdf->Cell(0,0.1,'',1,1,'');// LINEA EN BLANCO
$i=0;


while($datos_producto=mysql_fetch_array($resultado)){
	if($i%2==0){
$pdf->SetFillColor(255);
}else{
$pdf->SetFillColor(235,235,235);

}
$pdf->Row(array(utf8_decode($datos_producto['nombre_cliente']),utf8_decode($datos_producto['rut']),utf8_decode($datos_producto['telefono']),utf8_decode($datos_producto['direccion'])));
$i++;
}
$pdf->ln();


$pdf->output('Listado de Precios', 'I');


?>
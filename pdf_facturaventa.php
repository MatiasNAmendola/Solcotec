<?
sleep(1);
require('fpdf.php');
$id_factura=$_GET["id"];

class PDF_Mc_Table extends FPDF {

var $widths;
var $aligns;

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
$h=0.5*$nb;

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

$this->MultiCell($w,0.5,$data[$i],’LTR’,$a,1);

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
$pdf->setFont("Helvetica", 'B', 10.4);
$pdf->addPage();
$pdf->SetAutoPageBreak(true,0.4);  
$pdf->SetTitle('Factura de Venta',true);
$pdf->image("logo.png",1,1.55,5.5,2.3);


include "php/conexion.php";


$consulta_sql="SELECT factura_venta.tipo_factura,factura_venta.porcent_fact,factura_venta.plazo_dias, factura_venta.no_pago, factura_venta.folio,factura_venta.fecha,factura_venta.documento_rel,factura_venta.tipo_documento,factura_venta.rut_contacto,factura_venta.nombre_contacto, factura_venta.comentario_factura, factura_venta.total_neto, factura_venta.total_iva,factura_venta.total_final, cliente.nombre_cliente, cliente.rut, cliente.giro, cliente.direccion, cliente.mail, cliente.telefono, vendedor.nombre FROM cliente, factura_venta, vendedor  WHERE cliente.id_cliente = factura_venta.id_cliente AND factura_venta.id_fv='$id_factura' AND vendedor.id_vendedor=cliente.id_vendedor;" ;

$resultado=mysql_query($consulta_sql, $conexion) or die (mysql_error());

$datos_factura=mysql_fetch_array($resultado);

$folio=$datos_factura["folio"];
$tipo_factura=$datos_factura["tipo_factura"];

// LINEA VERTICAL SUPERIOR
$pdf->ln(0.4);
$pdf->Cell(6,0.1,'',0,0,'');// Espacio izquierdo de la linea.

$pdf->Cell(0.002,2.59,'',1,0,'');// Linea.

// TITULO
$pdf->Cell(0.4,0.3,'',0,0,'');// Espacio izquierdo del SUB TITULO.
$pdf->Cell(9.2,0.3,'COMERCIALIZADORA SOLCOTEC LTDA.',0,1,'');


$pdf->setFont("Helvetica", 'B', 9.7);
$pdf->Cell(15.2,0.09,'',0,0,'');//IZQUIERDO
$pdf->Cell(0.9,0.09,'RUT:',0,0,'');
$pdf->setFont("Helvetica", '', 9.7);
$pdf->Cell(2.5,0.09,'76.462.540 - 4',0,0,'');
$pdf->setFont("Helvetica", 'BU', 10);


//SUBTITULO
$pdf->setY(1.5);// posicion de la linea desde arriba.
$pdf->setTextColor(0); 
$pdf->setFont("Helvetica", '', 8.8);

$pdf->ln(0.27);//---------------------------------

$pdf->Cell(6.4,0.345,'',0,0,'');// Espacio izquierdo del SUB TITULO.
$pdf->Cell(8.6,0.345,utf8_decode('Importadora de máquinas y soldadoras, repuestos'),0,1,'');

$pdf->Cell(6.4,0.345,'',0,0,'');// Espacio izquierdo del SUB TITULO.
$pdf->Cell(7.7,0.345,utf8_decode('e Insumos. Artículos de ferretería industrial.'),0,0,'');
$pdf->setFont("Helvetica", 'B', 10.5);
$pdf->SetLineWidth(0.03);
$pdf->Cell(5.5,0.46,utf8_decode('FACTURA ELECTRÓNICA'),0,1,'C');
$pdf->SetLineWidth(0);
$pdf->Cell(0,0.08,'',0,1,'');// ESPACIO EN BLANCO COMPLETOO


$pdf->setFont("Helvetica", '', 8.8);



//$pdf->ln(0.17);

$pdf->setFont("Helvetica", 'B', 8.5);
$pdf->Cell(6.4,0.35,'',0,0,'');// Espacio izquierdo del SUB TITULO.
$pdf->Cell(8.1,0.35,utf8_decode('Dirección: Ruiz Tagle #714, Estacion Central'),0,1,'');
$pdf->Cell(6.4,0.35,'',0,0,'');// Espacio izquierdo del SUB TITULO.
$pdf->Cell(7.7,0.35,utf8_decode('Teléfonos: 2 778 51 55 - 2 779 56 30'),0,1,'');
$pdf->Cell(14.1,0,'',0,0,'C');
$pdf->setFont("Helvetica", 'B', 32);
$pdf->Cell(5.5,0,utf8_decode($folio),0,1,'C');
$pdf->SetDrawColor(0,0,0);
$pdf->setFont("Helvetica", 'B', 8.5);
$pdf->Cell(6.4,0.35,'',0,0,'');// Espacio izquierdo del SUB TITULO.
$pdf->Cell(8.1,0.35,'Correo: ventas@solcotec.cl',0,1,'');

$pdf->Cell(6.4,0.35,'',0,0,'');// Espacio izquierdo del SUB TITULO.
$pdf->Cell(7.7,0.35,'Web: www.solcotec.cl',0,1,'');
$pdf->Cell(14.1,0.35,'',0,0,'');
$pdf->Cell(5.5,0.6,'S.I.I - SANTIAGO PONIENTE',0,0,'C');

$pdf->setFont("Helvetica", 'B', 9.8);


// CAJA MEMBRETE. LADO IZQUIERDO DE LA LINEA SEPARADORA
$pdf->SetLineWidth(0.08);
$pdf->setY(1.3);// posicion en y
$pdf->setX(15.1);// posicion en y
$pdf->Cell(5.5,2.75,'',1,1,'C');//CUADRANTE
$pdf->SetLineWidth(0);

$pdf->ln(0.6);
$pdf->Cell(0,0.01,"",1,1,'L','');
$pdf->ln(0.2);//SEPARACION ENTRE LINEA ENCABEZADO Y DATOS DEL CLIENTE.



//H2
//COORDENADAS PREVIAS A LA IMPRESION DE LA MULTICELDA.
$y1 = $pdf->GetY();
$x1 = $pdf->GetX();
$pdf->setFont("Helvetica", 'B', 9);
$pdf->Cell(1.5,0.32,'Nombre:',0,0,'');


$pdf->setFont("Helvetica", '', 8);
$pdf->SetX(1);
$pdf->MultiCell(9,0.32,utf8_decode('                  '.$datos_factura["nombre_cliente"]),0,'','');
$y2 = $pdf->GetY();
$posicionX = $x1 + 9.8; //  VALOR EN ROJO ES EL ANCHO DEL INPUT ANTERIOR.

$pdf->SetXY($posicionX,$y1);


$pdf->setFont("Helvetica", 'B', 9);
$pdf->Cell(1.7,0.32,'Direccion: ',0,0,'');
$pdf->setFont("Helvetica", '', 8);
$pdf->SetX(10.8);
$pdf->MultiCell(9.7,0.32,'                     '.utf8_decode($datos_factura["direccion"]),0,'','');

////////////////////////////////////////////////////////////////////

$pdf->SetY($y2);
$pdf->Cell(0,0.1,'',0,1,'');
$pdf->setFont("Helvetica", 'B', 9);
$pdf->Cell(0.9,0.32,'RUT:',0,0,'l');
$pdf->setFont("Helvetica", '', 9);
$pdf->Cell(2.5,0.32,utf8_decode($datos_factura["rut"]),0	,0);

$pdf->Cell(6.4,0.3,'',0,0);//SEPARADOR

$pdf->setFont("Helvetica", 'B', 9);

$pdf->Cell(1.1,0.32,utf8_decode('Email:'),0,0,'l');
$pdf->setFont("Helvetica", '', 8);
$pdf->SetX(10.8);

$pdf->MultiCell(9.7,0.32,'              '.utf8_decode($datos_factura["mail"]),0,'','');
$y2 = $pdf->GetY();
$pdf->SetY($y2);
$pdf->Cell(0,0.1,'',0,1,'');//SEPARADOR HORIZONTAL.

////////////////////////////////////////////////////////////////////

//H1
$pdf->setFont("Helvetica", 'B', 9);
$pdf->Cell(1,0.32,'Giro:',0,0);
$pdf->setFont("Helvetica", '', 8);
//COORDENADAS PREVIAS A LA IMPRESION DE LA MULTICELDA.
$y1 = $pdf->GetY();
$x1 = $pdf->GetX();
$pdf->SetX(1);
$pdf->MultiCell(9,0.32,'            '.utf8_decode($datos_factura["giro"]),0);
$y2 = $pdf->GetY();
$posicionX = $x1 + 8; //  VALOR EN ROJO ES EL ANCHO DEL INPUT ANTERIOR.
$pdf->SetXY($posicionX,$y1);
$pdf->setFont("Helvetica", 'B', 9);
$pdf->SetX(10.8);
$pdf->Cell(1.6,0.32,utf8_decode('Teléfono:'),0,0,'l');


//H2

$pdf->setFont("Helvetica", '', 8.5);
$pdf->Cell(9.5,0.32,utf8_decode($datos_factura["telefono"]),0,1);

$pdf->SetY($y2);
$pdf->Cell(0,0.25,'',0,1,'');//SEPARADOR HORIZONTAL.


////////////////////////////////////////////////////////////////////


//DETERMINA DONDE PONER EL NUMERO DEL DOC REL , SI ES 1 ES ORDEN DE COMPRA, SINO ES GUIA DE DESP. 
if($datos_factura["tipo_documento"]==1){
	$ndocrel_1=utf8_decode($datos_factura["documento_rel"]);
	}else{
		$ndocrel_2=utf8_decode($datos_factura["documento_rel"]);
		}
//H1
$pdf->setFont("Helvetica", 'B', 9);
$pdf->Cell(2.5,0.32,'Orden Compra:',0,0,'');
$pdf->setFont("Helvetica", '', 8.5);
$pdf->Cell(4.05,0.32,$ndocrel_1,0,0,'');//
$pdf->setFont("Helvetica", 'B', 9);
$pdf->Cell(2.5,0.32,utf8_decode('Guía Despacho:'),0,0,'C');
$pdf->setFont("Helvetica", '', 8.5);
$pdf->Cell(4,0.32,$ndocrel_2,0,0,'');//separador
$pdf->setFont("Helvetica", 'B', 9);
$pdf->Cell(1.7,0.32,utf8_decode('Vendedor:'),0,0,'');
$pdf->setFont("Helvetica", '', 8);
$pdf->Cell(4.9,0.32,$datos_factura["nombre"],0,1,'');
$pdf->Cell(0,0.1,'',0,1,'');//SEPARADOR HORIZONTAL.

//H2
$pdf->setFont("Helvetica", 'B', 9);
$pdf->Cell(3,0.32,utf8_decode('Fecha de Emisión:'),0,0,'');
$pdf->setFont("Helvetica", '', 8.5);
$fecha= $datos_factura["fecha"];
$fecha = date('d-m-Y', strtotime($fecha));// da vuelta la fecha para ser valida BD 
$pdf->Cell(3.5,0.32,utf8_decode($fecha),0,0,'');//
$pdf->setFont("Helvetica", 'B', 9);

if($datos_factura["no_pago"]==1){
$dias=$datos_factura["plazo_dias"];

$fecha_vencimiento=date("d-m-Y", strtotime("$fecha +$dias day"));
$pdf->Cell(3.6,0.32,utf8_decode('Fecha de Vencimiento:'),0,0,'');
$pdf->setFont("Helvetica", '', 8.5);
$pdf->Cell(1.8,0.32,$fecha_vencimiento,0,1,'C');//separador

	}else{
		$pdf->Cell(1.8,0.32,'',0,1,'C');//separador
		}
	
mysql_free_result($resultado);


if($tipo_factura==1){
	$consulta_sql="SELECT  factura_x_producto.cantidad, factura_x_producto.detalle, factura_x_producto.precio_venta, factura_x_producto.precio_final, factura_x_producto.descuento FROM factura_x_producto WHERE factura_x_producto.id_fv='$id_factura';";

$resultado=mysql_query($consulta_sql, $conexion) or die (mysql_error());
	}
else{
$consulta_sql="SELECT producto.codigo_producto, factura_x_producto.cantidad, factura_x_producto.detalle, factura_x_producto.precio_venta, factura_x_producto.precio_final, factura_x_producto.descuento FROM factura_x_producto, producto WHERE factura_x_producto.id_fv='$id_factura' AND producto.id_producto=factura_x_producto.id_producto;";

$resultado=mysql_query($consulta_sql, $conexion) or die (mysql_error());

	}



$pdf->ln(0.25);


$pdf->SetFont('Helvetica','B', 8);

//un arreglo con su medida  a lo ancho

$pdf->SetWidths(array(1.1,2.7,9.99,1,2.4,2.4));

//un arreglo con alineacion de cada celda

$pdf->SetAligns(array('C','C','L','C','C','C'));
//utf8_decode es para que escriba bien
//los acentos.

$pdf->SetTextColor(255);
$pdf->SetFillColor(0,0,90);
$pdf->Cell(1.1,0.5,'Cant.',1,0,'C',1);
$pdf->Cell(2.7,0.5,utf8_decode('Código'),1,0,'C',1);
$pdf->Cell(9.99,0.5,utf8_decode('Descripción'),1,0,'C',1);
$pdf->Cell(1,0.5,'Desc.',1,0,'C',1);
$pdf->Cell(2.4,0.5,'$ Unitario',1,0,'C',1);
$pdf->Cell(2.4,0.5,'$ Final',1,1,'C',1);
$pdf->Cell(0,0.1,'',1,1,'C');
$pdf->SetTextColor(0);
$i=0;


while($datos_producto=mysql_fetch_array($resultado)){
	if($i%2==0){
$pdf->SetFillColor(255);
}else{
$pdf->SetFillColor(239,239,239);

}
$pdf->Row(array(utf8_decode($datos_producto['cantidad']),$datos_producto['codigo_producto'],utf8_decode($datos_producto['detalle']), $datos_producto['descuento'], $datos_producto['precio_venta'], $datos_producto['precio_final']));
$i++;
}
$pdf->ln(1.5);
$pdf->setFont("Helvetica", 'B',9);
$pdf->Cell(4.4,0.32,'COMENTARIO DE FACTURA',0,1,'','');
$pdf->setFont("Helvetica", '',8);
$pdf->MultiCell(0,0.5,utf8_decode($datos_factura["comentario_factura"]),1,'','');
$pdf->ln(0.4);


$pdf->setY(20);// posicion en y del TIMBRE
$pdf->Cell(0,0.01,'',1,1,'','');//linea sobre el timbre

$pdf->setFont("Helvetica", 'BI',8.5);


$consulta_sql="SELECT forma_pago, n_documento, comentario_pago, fecha_documento, banco_documento  FROM pago WHERE id_factura='$id_factura'";

$resultado=mysql_query($consulta_sql, $conexion) or die ('en 3 '.mysql_error());
$datos_pago=mysql_fetch_array($resultado);

$pdf->Cell(0,0.3,"",0,1,'','');//separacion izquierda desde el timbre
$pdf->Cell(9,0.5,"",0,0,'','');//separacion izquierda desde el timbre
$pdf->Cell(2.7,0.5,"Forma de Pago:",1,0,'','');

switch($datos_pago['forma_pago']){
	case 0:
	$forma_pago='PENDIENTE'.' - PLAZO: '.$datos_factura["plazo_dias"].' DIAS.';
	break;
	
	case 1:
	$forma_pago='EFECTIVO';
	break;
	
	case 2:
	$forma_pago='CHEQUE';
	break;
	
	case 3:
	$forma_pago='VALE VISTA';
	break;
	
	case 4:
	$forma_pago='TRASFERENCIA';
	break;
	
	default:
	$forma_pago='Desconocido';
	}

$pdf->Cell(4.7,0.5,$forma_pago,1,1,'','');
$pdf->Cell(9,0.1,"",0,1,'','');
$pdf->Cell(9,0.5,"",0,0,'','');//separacion izquierda desde el timbre


if($forma_pago == 'PENDIENTE'.' - PLAZO: '.$datos_factura["plazo_dias"].' DIAS.'){
		$pdf->setFont("Helvetica", '',8);

$pdf->MultiCell(10.6,0.4,utf8_decode($datos_pago['comentario_pago']),1,'','');
$pdf->Cell(9,0.2,"",0,1,'','');
}else{
	$pdf->setFont("Arial", '',8);

	$pdf->MultiCell(10.6,0.4,utf8_decode($datos_pago['banco_documento'].',  Nº del Documento: '.$datos_pago['n_documento'].',  El Doc. vence el: '.$datos_pago['fecha_documento'].',  Comentario : '.$datos_pago['comentario_pago']).'.',1,'','');
$pdf->Cell(9,0.2,"",0,1,'','');
}


$pdf->Cell(9,0.6,"",0,0,'','');//separacion izquierda desde el timbre
$pdf->setFont("Helvetica", 'BI',8.5);
$pdf->Cell(2.5,0.5,"MONTO NETO:",1,0,'','');
$pdf->setFont("Helvetica", 'B');
$pdf->Cell(2.5,0.5,utf8_decode($datos_factura["total_neto"]),1,0,'','');
$pdf->setFont("Helvetica", 'BI');
$pdf->Cell(2.5,0.5,'DESCUENTO:',1,0,'','');
$pdf->setFont("Helvetica", 'B');
$pdf->Cell(1,0.5,$datos_factura['porcent_fact'],1,1,'','');
$pdf->Cell(9,0.5,"",0,0,'','');
$pdf->setFont("Helvetica", 'BI');

$pdf->Cell(2,0.5,"IVA 19%",1,0,'','');
$pdf->setFont("Helvetica", 'B');
$pdf->Cell(2.5,0.5,utf8_decode($datos_factura["total_iva"]),1,0,'','');



$pdf->setFont("Helvetica", 'BI',11);

$pdf->SetLineWidth(0.04);
$pdf->Cell(2,0.7,"TOTAL",1,0,'C','');
$pdf->setFont("Helvetica", 'B',12);

$pdf->Cell(4,0.7,utf8_decode($datos_factura["total_final"]),1,1,'C','');
$pdf->SetLineWidth(0);

$pdf->ln(0.2);

$pdf->image("bar_code.gif",2,20.3,7,3);// TIMBRE ELECTRONICO SII
$pdf->setY(23.38);// posicion en y del origen del membrete.
$pdf->setFont("Helvetica", 'B',7);

$pdf->Cell(1,0.35,'',0,0,'','');// MARGEN IZQUIERDO
$pdf->Cell(7,0.35,utf8_decode('Timbre Electrónico SII'),0,1,'C','');
$pdf->Cell(1,0.3,'',0,0,'','');// MARGEN IZQUIERDO
$pdf->Cell(7,0.3,utf8_decode('Res.86 de 2005, Verifique documento: www.sii.cl'),0,1,'C','');
$pdf->ln(0.2);



$pdf->setY(24.4);// posicion en y del PIE DE PAGINA.
$pdf->setFont("Helvetica", 'B', 8.5);
$pdf->Cell(1.5,0.6,"RECIBE:",1,0,'','');
$pdf->Cell(6,0.6,utf8_decode($datos_factura["nombre_contacto"]),1,0,'','');//linea
$pdf->Cell(1.5,0.6,"FECHA:",1,0,'','');
$pdf->Cell(4,0.6,"",1,1,'','');


$pdf->Cell(1,0.6,"RUT:",1,0,'','');
$pdf->setFont("Helvetica", 'B', 9);
$pdf->Cell(6.5,0.6,utf8_decode($datos_factura["rut_contacto"]),1,0,'','');//linea
$pdf->setFont("Helvetica", 'B', 8.5);

$pdf->Cell(1.75,0.6,"RECINTO:",1,0,'','');
$pdf->Cell(3.75,0.6,"",1,0,'','');//cuadrante recinto
$pdf->Cell(0.4,0.01,"",0,0,'','');//espacio entre reciento y firma
$pdf->Cell(6,0.01,"",1,1,'','');//linea firma
$pdf->SetXY(14.3,25.2);
$pdf->setFont("Helvetica", 'B', 8);
$pdf->Cell(0.4,0.01,"Firma Receptor.",0,0,'','');//espacio entre reciento y firma


$pdf->setFont("Helvetica", 'B', 8.5);

$pdf->ln(0.65);

$pdf->setFont("Helvetica", 'BI', 7);
$pdf->Cell(0,0.3,utf8_decode('"El acuse de recibo que se declara en este acto, de acuerdo a lo dispuesto en la letra b) del Art. 4º, y la letra c) del Art. 5º de la Ley 19.983, acredita que la entrega de'),0,1,'','');
$pdf->Cell(0,0.3,utf8_decode('mercaderías o servicio(s) prestado(s) ha(n) sido recibido(s)."'),0,1,'','');
$pdf->Cell(0,0.2,'',0,1,'','');//LINEA SEPARADORA TRASPARENTE

$pdf->Cell(0,0.01,'',1,1,'','');//LINEA SEPARADORA

$pdf->Cell(17.3,0.35,'',0,0,'','');// MARGEN IZQUIERDO
$pdf->setFont("Arial", 'B', 10);
$pdf->Cell(3,0.5,'CEDIBLE',0,1,'C','');

$pdf->output('factura_venta/factura_venta:'.$id_factura.'.pdf');
$pdf->output();


?>
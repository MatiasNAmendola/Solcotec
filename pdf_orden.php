<?
sleep(1);
require('fpdf.php');
$id_orden=$_GET["id"];

class TablePDF extends FPDF {
// Pie de Pagina
}
// start and build the PDF document
$pdf = new TablePDF('P', 'cm', 'Letter');
$pdf->setFont("Helvetica", 'BU', 10);
$pdf->addPage();
$pdf->SetAutoPageBreak(true,0.4);  
$pdf->SetTitle('Orden de Trabajo',true);
$pdf->image("logo.png",1.3,1.5,5,2);

include "php/conexion.php";


$consulta_sql="SELECT orden_trabajo.folio_ot, orden_trabajo.fecha, orden_trabajo.observaciones,orden_trabajo.nombre_contacto,orden_trabajo.rut_contacto, cliente.nombre_cliente, cliente.rut, cliente.giro, cliente.direccion, cliente.mail, cliente.telefono FROM orden_trabajo,cliente WHERE orden_trabajo.id_ot='$id_orden' and orden_trabajo.id_cliente = cliente.id_cliente ; ";

$resultado=mysql_query($consulta_sql, $conexion) or die (mysql_error());

$datos_orden=mysql_fetch_array($resultado);


// LINEA VERTICAL SUPERIOR
$pdf->Cell(5.9,1.8,'',0,0,'');// Espacio izquierdo de la linea.
$pdf->Cell(0.5,1.8,'',0,0,'');// Espacio derecho de la linea.

// TITULO
$pdf->Cell(0,0.1,'',0,1,'');// espacio arriba
$pdf->Cell(6.4,0,'',0,0,'');// espacio izquierdo
$pdf->Cell(8.7,0.9,'COMERCIALIZADORA SOLCOTEC LTDA.',0,0,'');
$pdf->setFont("Helvetica", 'BU', 10);
$pdf->Cell(4,0.19,'',0,1,'');//margen top
$pdf->Cell(15,0.9,'',0,0,'');//margen izquierdo
$pdf->Cell(4,0.9,utf8_decode('ORDEN DE TRABAJO'),0,0,'');
$pdf->setFont("Helvetica", 'BU', 10);
//CUADRANTE QUE RODEA AL MEMBRETE
$pdf->setY(1);// posicion en y del origen del membrete.
$pdf->Cell(0,3.6,'',1,1,'');


//SUBTITULO
$pdf->setY(1.55);// posicion de la linea desde arriba.
$pdf->setTextColor(0); 
$pdf->setFont("Helvetica", 'B', 8.5);
$pdf->Cell(6.4,1.8,'',0,0,'');// Espacio izquierdo del SUB TITULO.

$pdf->ln(0.25);//---------------------------------

$pdf->Cell(6.4,0.3,'',0,0,'');// Espacio izquierdo del SUB TITULO.
$pdf->Cell(7,0.33,utf8_decode('Importadora de máquinas soldadoras, repuestos'),0,1,'');

$pdf->Cell(6.4,1.8,'',0,0,'');// Espacio izquierdo del SUB TITULO.
$pdf->Cell(7,0.33,utf8_decode('e Insumos. Artículos de ferretería industrial.'),0,1,'');

$pdf->ln(0.2);
$pdf->Cell(6.4,1.8,'',0,0,'');// Espacio izquierdo del SUB TITULO.
$pdf->Cell(7,0.33,'RUT: 76.462.540 - 4',0,0,'');
$pdf->setFont("Helvetica", 'B', 45);// tamaño fuente folio

$pdf->Cell(1,0.33,"",0,0,'');//espaciado a la derecha de la fila importadora
$pdf->Cell(5,0.33,$id_orden,0,1,'C');// numero del folio
$pdf->setFont("Helvetica", 'B', 8.5);
$pdf->Cell(6.4,1.8,'',0,0,'');// Espacio izquierdo del SUB TITULO.
$pdf->Cell(7,0.33,utf8_decode('Dirección: Ruiz Tagle #714, Estacion Central'),0,1,'');
$pdf->Cell(6.4,1.8,'',0,0,'');// Espacio izquierdo del SUB TITULO.
$pdf->Cell(7,0.33,utf8_decode('Teléfono: 2 778 51 55'),0,1,'');
$pdf->Cell(6.4,1.8,'',0,0,'');// Espacio izquierdo del SUB TITULO.
$pdf->Cell(9.1,0.33,'Correo: ventas@solcotec.cl',0,0,'');
$pdf->setTextColor(255);
$pdf->Cell(3,0.33,'Fecha de Ingreso:',1,1,'C',true);
$pdf->setTextColor(0);
$pdf->Cell(6.4,1.8,'',0,0,'');// Espacio izquierdo del SUB TITULO.
$pdf->Cell(9.1,0.33,'Web: www.solcotec.cl',0,0,'');
$pdf->Cell(3,0.04,'',0,1,'','');// linea negra debajo de fecha de ingreso
$pdf->Cell(15.5,0.34,'',0,0,'');

$fecha=$datos_orden["fecha"];
$fecha = date('d-m-Y', strtotime($fecha));// da vuelta la fecha para ser valida BD 
$pdf->setFont("Helvetica", 'B', 10);

$pdf->Cell(3,0.34,utf8_decode($fecha),0,1,'C');//

//TITULO DEL DOCUMENTO
$pdf->setFillColor(10,70,140);
$pdf->setTextColor(259);
$pdf->setFont("Helvetica", 'B', 9.5);
$pdf->setY(4.8);// posicion en y de la caja que contiene al titulo


$pdf->Cell(0,0.45,' DATOS CLIENTE',0,1,'','true');
$pdf->ln(0.1);
$pdf->Cell(0,0.01,"",1,1,'l','');



$pdf->ln(0.2);
$pdf->setTextColor(0);
// TITULO INFO
$pdf->setFont("Helvetica", 'BU', 10);
$pdf->Cell(1,0.3,'Nombre:',0,0,'l');

$pdf->Cell(9.5,0.3,'',0,0,'');// Espacio entre cliente y direccion.

// TITULO INFO
$pdf->Cell(6,0.3,utf8_decode('Dirección:'),0,0,'l');
$pdf->ln(0.33);
// SUB TITULO INFO
$pdf->setFont("Helvetica", '', 9);

//COORDENADAS PREVIAS A LA IMPRESION DE LA MULTICELDA.
$y1 = $pdf->GetY();
$x1 = $pdf->GetX();

$pdf->MultiCell(10.5,0.49,utf8_decode($datos_orden["nombre_cliente"]),0,'','');
$y2 = $pdf->GetY();
$posicionX = $x1 + 10.5; //  VALOR EN ROJO ES EL ANCHO DEL INPUT ANTERIOR.

$pdf->SetXY($posicionX,$y1);
// SUB TITULO INFO
$pdf->MultiCell(9,0.49,utf8_decode($datos_orden["direccion"]),0,'','');


$pdf->ln(0.1);
////////////////////////////////////////////////////////////////////
// TITULO INFO
$pdf->setFont("Helvetica", 'BU', 10);
$pdf->Cell(1,0.3,'RUT:',0,0,'l');

$pdf->Cell(9.5,0.3,'',0,0,'');// Espacio entre cliente y direccion.

// TITULO INFO
$pdf->Cell(6,0.3,utf8_decode('Email:'),0,0,'l');
$pdf->ln(0.33);




// SUB TITULO INFO
$pdf->setFont("Helvetica", '', 10);
$pdf->Cell(1,0.5,utf8_decode($datos_orden["rut"]),0,0);

$pdf->Cell(9.5,0.3,'',0,0,'');// Espacio entre cliente y direccion.
// SUB TITULO INFO
$pdf->setFont("Helvetica", '', 9);
$pdf->MultiCell(9,0.49,utf8_decode($datos_orden["mail"]),0,'','');


$pdf->ln(0.1);
////////////////////////////////////////////////////////////////////
// TITULO INFO
$pdf->setFont("Helvetica", 'BU', 10);
$pdf->Cell(1,0.3,'Giro:',0,0,'l');

$pdf->Cell(9.5,0.3,'',0,0,'');// Espacio entre cliente y direccion.

// TITULO INFO
$pdf->Cell(6,0.3,utf8_decode('Teléfono:'),0,0,'l');
$pdf->ln(0.33);


// SUB TITULO INFO
$pdf->setFont("Helvetica", '', 9);
//COORDENADAS PREVIAS A LA IMPRESION DE LA MULTICELDA.
$y1 = $pdf->GetY();
$x1 = $pdf->GetX();
$pdf->MultiCell(10,0.4,utf8_decode($datos_orden["giro"]),0,'','');
$y2 = $pdf->GetY();
$posicionX = $x1 + 10.5; //  VALOR EN ROJO ES EL ANCHO DEL INPUT ANTERIOR.

$pdf->SetXY($posicionX,$y1);

// SUB TITULO INFO
$pdf->setFont("Helvetica", '', 10);
$pdf->Cell(9.5,0.5,utf8_decode($datos_orden["telefono"]),0,1);

mysql_free_result($resultado);

$consulta_sql="SELECT maquina.nombre, maquina.n_serie, maquina.descripcion FROM maquina WHERE maquina.tipo=1 AND maquina.id_ot='$id_orden';";

$resultado=mysql_query($consulta_sql, $conexion) or die (mysql_error());



$pdf->ln(0.2);
$pdf->Cell(0,0.00001,'',1,1);
$pdf->setTextColor(255);
$pdf->setFont("Helvetica", 'B', 9.5);
$pdf->Cell(0,0.45,utf8_decode(' IDENTIFICACION DE MAQUINAS & EQUIPOS'),0,1,'l','true');
$pdf->ln(0.1);
$pdf->Cell(0,0.01,"",1,1,'l','');
$pdf->setFillColor(259);
$pdf->setTextColor(0);



while($datos_maquina=mysql_fetch_array($resultado)){
	$i=1;
$pdf->setFont("Helvetica", 'B', 9.5);
$pdf->ln(0.2);	
$pdf->Cell(7,0.5,utf8_decode('Número de Serie:'),0,0,'l','');
$pdf->Cell(7,0.5,utf8_decode('Nombre Máquina:'),0,0,'l','');
$pdf->ln(0.36);
$pdf->setFont("Helvetica", '', 9.5);
$pdf->Cell(7,0.5,utf8_decode($datos_maquina["n_serie"]),0,0,'l','');
$pdf->Cell(7,0.5,utf8_decode($datos_maquina["nombre"]),0,1,'l','');
$pdf->ln(0.01);
$pdf->setFont("Helvetica", 'B', 9.5);
$pdf->Cell(7,0.5,utf8_decode('Observaciones:'),0,0,'l','');
$pdf->ln(0.41);
$pdf->setFont("Helvetica", '', 9.5);

//$pdf->Cell(7,0.5,utf8_decode($datos_maquina["descripcion"]),0,1,'l','');
$pdf->MultiCell(0,0.4,utf8_decode($datos_maquina["descripcion"]),0,'','');


$pdf->ln(0.2);
$pdf->Cell(0,0.01,"",1,1,'l','');//linea


}
$pdf->ln(1.5);
$pdf->setFont("Helvetica", 'B');
$pdf->Cell(4.3,0.5,'COMENTARIOS ORDEN',1,1,'','');
$pdf->setFont("Helvetica", '');
$pdf->MultiCell(0,0.49,utf8_decode($datos_orden["observaciones"]),1,'','');
$pdf->ln(0.4);
$pdf->setFont("Helvetica", 'BI');

$pdf->Cell(10,0.5,utf8_decode('* VALOR POR EMISIÓN DE PRESUPUESTO: $12.500 NETO. (solo en caso de rechazo).'),0,1,'','');
$pdf->Cell(0,0.01,'',1,1,'','');

$pdf->setY(23.5);// posicion en y del origen del membrete.
$pdf->setFont("Helvetica", 'B', 9.5);



$pdf->Cell(13,0.5,"ADVERTENCIA",0,0,'','');//linea
$pdf->Cell(3,0.5,"Entregado por:",1,1,'','');//linea
$pdf->ln(0.1);
$pdf->setFont("Helvetica", 'I', 9);
$pdf->Cell(13,0.5,utf8_decode("Una vez aceptado el presupuesto de reparación, las máquinas deben ser"),0,0,'','');//linea
$pdf->setFont("Helvetica", 'B', 9);
$pdf->Cell(5,0.5,utf8_decode($datos_orden["nombre_contacto"]),0,0,'','');//linea
$pdf->setFont("Helvetica", 'I', 9);
$pdf->ln(0.4);
$pdf->Cell(13,0.5,utf8_decode("retiradas en un plazo máximo de 15 días. De lo contrario se facturará,"),0,0,'','');//linea
$pdf->setFont("Helvetica", 'B', 9);
$pdf->Cell(5,0.5,utf8_decode($datos_orden["rut_contacto"]),0,0,'','');//linea
$pdf->setFont("Helvetica", 'I', 9);
$pdf->ln(0.4);
$pdf->Cell(9,0.5,utf8_decode("tanto los repuestos como la mano de obra, con los valores vigentes al"),0,0,'','');//linea
$pdf->ln(0.4);
$pdf->Cell(9,0.5,utf8_decode("día de retiro de las máquinas. No se entregará ningún equipo sin pre-"),0,0,'','');//linea
$pdf->ln(0.4);
$pdf->Cell(9,0.5,utf8_decode("via presentación de su correspondiente orden de trabajo."),0,1,'','');//linea
$pdf->Cell(13,0.01,'',0,0,'','');//linea
$pdf->Cell(6.5,0.01,'',1,0,'','');//linea

$pdf->output('orden_trabajo/ot'.$id_orden.'.pdf');
$pdf->output();


?>
<?
include "conexion.php";


// capturar el ultimo id de factura de venta
$sql = "select max(id_fv) as max_id from factura_venta ;";
$blue=mysql_query ($sql, $conexion) or die ("1" .mysql_error());
$white=mysql_fetch_array($blue);
$id_fv=$white['max_id']+1;
mysql_free_result($sql);

//POR LOS REINICIOS DE INDICES BD. MIGRACIONES
if($id_fv==0){
	$id_fv=1;
	}

////////////////TRASFORMO LAS VARIABLES DE LOS PRODUCTOS INGRESADOS A ARREGLOS

$cantidad = array();
$codigo = array();
$n_serie = array();
$detalle = array();
$precio_unitario = array();
$descuento = array();
$precio_final = array();
$id_producto = array();
$n_ot = array();


//recoge datos del cliente.
$nombre_cliente=strtoupper($_POST['nombre_cliente']);
$rut=strtoupper($_POST['rut']);
$telefono=$_POST['telefono'];
$direccion=strtoupper($_POST['direccion']);
$giro=strtoupper($_POST['giro']);
$comuna=strtoupper($_POST['comuna']);
$cod_vendedor=$_POST['cod_vendedor'];
$comentario_cliente=strtoupper($_POST['comentario_cliente']);
$mail=strtoupper($_POST['mail']);
  

///////////////// CAPTURO LAS VARIABLES PROPIAS DE LA FACTURA DE VENTA


$tipo_documento=$_POST['tipo_documento'];
switch($tipo_documento){
case 'Orden de Compra':
$tipo_documento=1;
break;

case 'Guía de Despacho':
$tipo_documento=2;
break;
}
	
	
$folio=$_POST['folio'];
$documento_rel=$_POST['documento_rel'];



if($_POST['fecha_ingreso']!=''){
$fecha_ingreso=$_POST['fecha_ingreso'];
$fecha_ingreso=date('Y-m-d', strtotime($fecha_ingreso));// da vuelta la fecha para ser valida BD
}else{
$fecha_ingreso='';
}

$total_iva=$_POST['total_iva'];
$total_neto=$_POST['total_neto'];
$porcentaje_descuento=$_POST['porcentaje_descuento'];
$total_descuento=$_POST['total_descuento'];
$total_final=$_POST['total_final'];
$comentario_factura= strtoupper($_POST['comentario_factura']);
$nombre_contacto = strtoupper($_POST['nombre_contacto']);
$rut_contacto = strtoupper($_POST['rut_contacto']);

  


// VARIABLES DE PAGO
$comentario_pago=strtoupper($_POST['comentario_pago']);
$n_documento=$_POST['n_documento'];


if($_POST['fecha_documento']!=''){
$fecha_documento=$_POST['fecha_documento'];
$fecha_documento=date('Y-m-d', strtotime($fecha_documento));// da vuelta la fecha para ser valida BD
}else{
$fecha_documento='';
}


$banco_documento=strtoupper($_POST['banco_documento']);
$condiciones=$_POST['condiciones'];

switch($condiciones){
case 'Efectivo': // el estado define el estado de factura , si es 1 la factura queda pagada.
$estado_factura=1;
$forma_pago=1;
break;

case 'Cheque':  // el estado define el estado de factura , si es 1 la factura queda pagada.
$estado_factura=1;
$forma_pago=2;
break;

case 'Vale Vista':  // el estado define el estado de factura , si es 1 la factura queda pagada.
$estado_factura=1;
$forma_pago=3;
break;

case 'Trasferencia Electrónica':  // el estado define el estado de factura , si es 1 la factura queda pagada.
$estado_factura=1;
$forma_pago=4;
break;
}// fin switch condiciones.

// No Pago:
$no_pago=$_POST['no_pago'];

if($no_pago==1){
	$estado_factura=2;
	$plazo_dias=$_POST['plazo_dias'];
	$comentario_pago=strtoupper($_POST['comentario_pago']);
	}

// Capturo las variables de la tabla factura x producto

$cantidad =array_filter($_POST['cantidad']); // capturo con esta funcion la cantidad de productos ingresados no incluyendo los elementos vacios
$codigo= $_POST['codigo'];
$n_serie= $_POST['n_serie'];
$detalle= $_POST['detalle'];
$precio_unitario= $_POST['precio_unitario'];
$descuento= $_POST['descuento'];
$precio_final= $_POST['precio_final'];
$n_ot= $_POST['n_ot'];
$id_producto=$_POST['id_producto'];

for($i=0;$i<10;$i++){
	
	if($n_ot[$i]!=''){
	$tipo_factura=1;// determina si la factura es por reparación o es una venta.
	}
	
	}



// capturar id vendedor:

$con = "select id_vendedor from vendedor where nombre like '$cod_vendedor';";

$resul=mysql_query ($con, $conexion) or die (mysql_error());

$fi=mysql_fetch_array($resul);

$id_vendedor=$fi['id_vendedor'];

mysql_free_result($con);// libera variable que contenia la consulta.



// ver si el rut --> el cliente existe en la base de datos o no

$consulta = "select id_cliente from cliente where rut like '$rut';";
$resultado=mysql_query ($consulta, $conexion) or die (mysql_error());
$fila=mysql_fetch_array($resultado);
$id_cliente=$fila['id_cliente'];
mysql_free_result($resultado);

//////////////////////////////////////////////////////

if($id_cliente != NULL){ // si el rut fue encontrado...

$sql="UPDATE `cliente` SET
`id_cliente`='$id_cliente',
`nombre_cliente`='$nombre_cliente',
`rut`='$rut',
`telefono`='$telefono',
`direccion`='$direccion',
`giro`='$giro',
`comuna`='$comuna',
`id_vendedor`='$id_vendedor',
`comentario_cliente`='$comentario_cliente',
`mail`='$mail' WHERE `cliente`.`id_cliente` ='$id_cliente';";

mysql_query ($sql, $conexion) or die ("1" .mysql_error());
mysql_free_result($sql);


$sql = "INSERT INTO `factura_venta`(`id_fv`,`tipo_factura`, `tipo_documento`, `documento_rel`, `folio`, `total_descuento`, `fecha`, `total_neto`, `total_iva`, `total_final`, `id_cliente`, `id_vendedor`, `comentario_factura`, `estado`, `porcent_fact`,`no_pago`,`plazo_dias`,`nombre_contacto`,`rut_contacto`)
VALUES(NULL,'$tipo_factura','$tipo_documento','$documento_rel','$folio','$total_descuento','$fecha_ingreso','$total_neto','$total_iva','$total_final','$id_cliente','$id_vendedor','$comentario_factura','$estado_factura','$porcentaje_descuento','$no_pago','$plazo_dias','$nombre_contacto','$rut_contacto')";

mysql_query ($sql, $conexion) or die ("2" .mysql_error());
mysql_free_result($sql);
}

else{
$consulta = "INSERT INTO `bodega`.`cliente` (`id_cliente`, `nombre_cliente`, `rut`, `telefono`, `direccion`, `giro`, `comuna`, `id_vendedor`, `comentario_cliente`,`mail`) VALUES (NULL, '$nombre_cliente', '$rut', '$telefono', '$direccion', '$giro', '$comuna', '$id_vendedor', '$comentario_cliente','$mail');";
mysql_query ($consulta, $conexion) or die ("3" .mysql_error());
mysql_free_result($consulta);

$consulta="SELECT max(id_cliente) as idmaximo FROM cliente";
$max_id = mysql_query ($consulta, $conexion) or die ('3.5'.mysql_error());
$madero = mysql_fetch_array($max_id);
$id_cliente= $madero["idmaximo"];
mysql_free_result($consulta);

$sql = "INSERT INTO `factura_venta`(`id_fv`,`tipo_factura`, `tipo_documento`, `documento_rel`, `folio`, `total_descuento`, `fecha`, `total_neto`, `total_iva`, `total_final`, `id_cliente`, `id_vendedor`, `comentario_factura`, `estado`, `porcent_fact`,`no_pago`,`plazo_dias`,`nombre_contacto`,`rut_contacto`)
VALUES(NULL,'$tipo_factura','$tipo_documento','$documento_rel','$folio','$total_descuento','$fecha_ingreso','$total_neto','$total_iva','$total_final','$id_cliente','$id_vendedor','$comentario_factura','$estado_factura','$porcentaje_descuento','$no_pago','$plazo_dias','$nombre_contacto','$rut_contacto')";

mysql_query ($sql, $conexion) or die ("4" .mysql_error());
mysql_free_result($sql);
}



if($no_pago==1){

// VARIABLES YA INICIALIZADAS.

if($comentario_pago !=''){
// PAGO INSERT ... 
$pago = "INSERT INTO `bodega`.`pago` (`comentario_pago`, `fecha_recepcion`, `id_cliente`, `id_factura`) VALUES ('$comentario_pago', '$fecha_ingreso', '$id_cliente', '$id_fv');";
mysql_query ($pago, $conexion) or die ("10.4 ".mysql_error());	
mysql_free_result($pago);
}// fin if si hay comentario
}// fin if $no_pago==1
else{


// PAGO INSERT ... 

$pago = "INSERT INTO `bodega`.`pago` (`id_pago`, `forma_pago`, `comentario_pago`, `n_documento`, `fecha_documento`, `banco_documento`, `fecha_recepcion`, `id_cliente`, `id_factura`) VALUES (NULL, '$forma_pago', '$comentario_pago', '$n_documento', '$fecha_documento', '$banco_documento', '$fecha_ingreso', '$id_cliente', '$id_fv');";

mysql_query ($pago, $conexion) or die ("10 ".mysql_error());
mysql_free_result($pago);
}// fin else



///// veo cuantos productos fueron ingresados
$tope=count($cantidad);
for($i=0;$i<$tope;$i++){
if($n_ot[$i] !='' && $n_serie[$i]!=''){


//Actualizo estado (5 -> máquina entregada) y dias de garantía de la máquina (90 días por reparación).

$update_maquina = "UPDATE `maquina` SET `estado`=5, `dias_garantia`=90 WHERE `n_serie`='$n_serie[$i]' and `id_ot`=(SELECT `id_ot` FROM `orden_trabajo` WHERE `folio_ot`='$n_ot[$i]');";
mysql_query ($update_maquina, $conexion) or die ("ERROR UPDATE MAQUINA REPARACIÓN : " .mysql_error());
mysql_free_result($update_maquina);
}

if($n_serie[$i]!=''){


//Actualizo estado (5 -> máquina vendida) y dias de garantía de la máquina (365 días por venta).

$update_maquina = "UPDATE `maquina` SET `estado`=5,
`dias_garantia`=365
 WHERE `n_serie`='$n_serie[$i]';";
mysql_query ($update_maquina, $conexion) or die ("ERROR UPDATE MAQUINA VENTA : " .mysql_error());
mysql_free_result($update_maquina);
}


	

// SI EL PRODUCTO NO TIENE CODIGO O ES NUEVO...
if($id_producto[$i]==0 && $n_ot[$i] ==''){
	
	echo "<h1>Hay productos ingresados que no estan creados en el sistema, por favor , antes de ingresar estos por factura venta, tiene que crearlos en la seccion Productos.</h1>";
	echo "<br/>";
	echo "<br/>";
	echo "<a href='../ingreso_producto.php'><h1>Ir a Seccion Productos</h1></a>";
	die();
	}


//INSERT DE CADA PRODUCTO
$sql1 = "INSERT INTO `bodega`.`factura_x_producto` (`id_facturaxproducto`, `cantidad`, `precio_venta`, `precio_final`, `descuento`, `id_producto`, `detalle`, `id_fv`,`n_serie`) VALUES (NULL, '$cantidad[$i]', '$precio_unitario[$i]', '$precio_final[$i]', '$descuento[$i]', '$id_producto[$i]', '$detalle[$i]', '$id_fv','$n_serie[$i]');";


mysql_query($sql1, $conexion) or die ("8" .mysql_error());

//DESCUENTA EL STOCK POR PRODUCTO
$update="UPDATE `producto` SET `stock`=`stock`- $cantidad[$i] where `id_producto` = '$id_producto[$i]'";
 
mysql_query ($update, $conexion) or die ("9" .mysql_error());
}

mysql_free_result($update);


include "../cerrar_conexion.php";
header("Location: ../factura_venta.php"); 


?>
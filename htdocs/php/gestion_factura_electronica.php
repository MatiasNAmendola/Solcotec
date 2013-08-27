<?
include "conexion.php";
//recoge datos del cliente.
   $nombre_cliente=$_POST['nombre_cliente'];
   $rut=$_POST['rut'];
   $telefono=$_POST['telefono'];
   $direccion=$_POST['direccion'];
   $giro=$_POST['giro'];
   $comuna=$_POST['comuna'];
   $cod_vendedor=$_POST['cod_vendedor'];
   $comentario_cliente=$_POST['comentario_cliente'];
   $mail=$_POST['mail'];
   
   
   
// recoge las variables de el pago.
$comentario_pago=$_POST['comentario_pago'];
$n_documento=$_POST['n_documento'];
$fecha_documento=$_POST['fecha_documento'];

$nuevafecha_documento = date('Y-m-d', strtotime($fecha_documento));// da vuelta la fecha para ser valida BD 

$banco_documento=$_POST['banco_documento'];
$linea_credito=$_POST['linea_credito'];


///////////////// CAPTURO LAS VARIABLES PROPIAS DE LA FACURA DE VENTA
$condiciones=$_POST['condiciones'];

switch($condiciones){
	case 'Efectivo': // el estado define el estado de factura , si es 1 la factura queda pagada.
	$estado=1;
	break;
	
	case 'Cheque': // el estado define el estado de factura , si es 1 la factura queda pagada.
	$estado=2;
	break;
	
	case 'Vale Vista': // el estado define el estado de factura , si es 2 la factura queda como pendiente de pago.
	$estado=3;
	break;
	}

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
$fecha=$_POST['fecha_ingreso'];
$nuevafecha = date('Y-m-d', strtotime($fecha));// da vuelta la fecha para ser valida BD 
$total_iva=$_POST['total_iva'];
$total_neto=$_POST['total_neto'];
$porcentaje_descuento=$_POST['porcentaje_descuento'];
$total_descuento=$_POST['total_descuento'];
$total_final=$_POST['total_final'];
$comentario_factura=$_POST['comentario_factura'];



// capturar id vendedor:

$con = "select id_vendedor from vendedor where nombre like '$cod_vendedor';";

$resul=mysql_query ($con, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis (captura id vendedor). </p>");

$fi=mysql_fetch_array($resul);

$id_vendedor=$fi['id_vendedor'];

mysql_free_result($con);// libera variable que contenia la consulta.


////////////////TRASFORMO LAS VARIABLES DE LOS PRODUCTOS INGRESADOS A ARREGLOS


$cantidad = array();
$codigo = array();
$detalle = array();
$precio_unitario = array();
$descuento = array();
$precio_final = array();
$id_producto = array();


// Capturo las variables de la tabla factura x producto

$cantidad =array_filter($_POST['cantidad']); // capturo con esta funcion la cantidad de productos ingresados no incluyendo los elementos vacios
$codigo= $_POST['codigo'];
$detalle= $_POST['detalle'];
$precio_unitario= $_POST['precio_unitario'];
$descuento= $_POST['descuento'];
$precio_final= $_POST['precio_final'];

// ver si el rut --> el cliente existe en la base de datos o no

$consulta = "select id_cliente from cliente where rut like '$rut';";

$resultado=mysql_query ($consulta, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis 3</p>");

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
`mail`='$mail',
`linea_credito`='$linea_credito' WHERE `cliente`.`id_cliente` ='$id_cliente';";

mysql_query ($sql, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis update datos cliente </p>");
mysql_free_result($sql);


$sql = "INSERT INTO `factura_venta`(`id_fv`, `tipo_documento`, `documento_rel`, `folio`, `condiciones`, `total_descuento`, `fecha`, `total_neto`, `total_iva`, `total_final`, `id_cliente`, `id_vendedor`, `comentario_factura`, `estado`, `porcent_fact`)
VALUES(NULL,'$tipo_documento','$documento_rel','$folio','$condiciones','$total_descuento','$nuevafecha','$total_neto','$total_iva','$total_final','$id_cliente','$id_vendedor','$comentario_factura','$estado','$porcentaje_descuento')";


mysql_query ($sql, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis insert datos factura venta </p>");
mysql_free_result($sql);
}




else{
$consulta = "INSERT INTO `bodega`.`cliente` (`id_cliente`, `nombre_cliente`, `rut`, `telefono`, `direccion`, `giro`, `comuna`, `id_vendedor`, `comentario_cliente`,`mail`) VALUES (NULL, '$nombre_cliente', '$rut', '$telefono', '$direccion', '$giro', '$comuna', '$id_vendedor', '$comentario_cliente','$mail');";
  mysql_query ($consulta, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis</p>");
mysql_free_result($consulta);


$sql = "INSERT INTO `bodega`.`factura_venta` (`condiciones`, `descuento`, `fecha`, `total_neto`, `total_iva`, `total_final`, `id_cliente`, `id_vendedor`) VALUES ('$condiciones', '$total_descuento', '$nuevafecha', '$total_neto', '$total_iva', '$total_final', '$id_cliente', '$id_vendedor');";

mysql_query ($sql, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis insert datos factura venta (else) </p>");
mysql_free_result($sql);

}

// capturar el ultimo id de factura de venta


$sql = "select max(id_fv) as memo from factura_venta ;";

$blue=mysql_query ($sql, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis captura id factura venta</p>");

$white=mysql_fetch_array($blue);

$id_fv=$white['memo'];

mysql_free_result($sql);
///// veo cuantos productos fueron ingresados

$tope=count($cantidad);


for($i=0;$i<$tope;$i++){
	
// capturar id producto según código de producto.

$consulta = "select id_producto from producto where codigo_producto like '$codigo[$i]';";

$resultado=mysql_query ($consulta, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis multi consulta</p>");

$fila=mysql_fetch_array($resultado);

$id_producto[$i]=$fila['id_producto'];

mysql_free_result($consulta);


	
	$sql1 = "INSERT INTO `bodega`.`factura_x_producto` (`id_facturaxproducto`, `cantidad`, `precio_venta`, `precio_final`, `descuento`, `id_producto`, `detalle`, `id_fv`) VALUES (NULL, '$cantidad[$i]', '$precio_unitario[$i]', '$precio_final[$i]', '$descuento[$i]', '$id_producto[$i]', '$detalle[$i]', '$id_fv');";
	

mysql_query($sql1, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis INSERT TABLA Factura x Producto</p>");

$update="UPDATE `producto` SET `stock`=`stock`- $cantidad[$i] where `id_producto` like '%".$id_producto[$i]."%'";
 
mysql_query ($update, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis update cambio de cant de producto</p>");
}

mysql_free_result($update);

// PAGO INSERT ... 

$pago = "INSERT INTO `bodega`.`pago` (`id_pago`, `forma_pago`, `comentario_pago`, `n_documento`, `fecha_documento`, `banco_documento`, `fecha_recepcion`, `id_cliente`, `id_factura`) VALUES (NULL, '$estado', '$comentario_pago', '$n_documento', '$nuevafecha_documento', '$banco_documento', '$nuevafecha', '$id_cliente', '$id_fv');";

mysql_query ($pago, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis insert pago de factura.</p>");

mysql_free_result($pago);



include "../cerrar_conexion.php";
header("Location: ../factura_venta.php"); 


?>
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


///////////////// CAPTURO LAS VARIABLES PROPIAS DE LA FACTURA DE VENTA
$condiciones=$_POST['condiciones'];

switch($condiciones){
	case 'Efectivo': // el estado define el estado de factura , si es 1 la factura queda pagada.
	$forma_pago=1;
	break;
	
	case 'Cheque': // el estado define el estado de factura , si es 1 la factura queda pagada.
	$forma_pago=2;
	break;
	
	case 'Vale Vista': // el estado define el estado de factura , si es 2 la factura queda como pendiente de pago.
	$forma_pago=3;
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


//variables propias de nota de creedito que ahorrar 2 consultas a diferencia de factura de venta

$id_vendedor=$_POST['id_vendedor'];
$id_fv=$_POST['id_factura'];
$comentario_notacredito=$_POST['comentario_notacredito'];

////////////////TRASFORMO LAS VARIABLES DE LOS PRODUCTOS INGRESADOS A ARREGLOS

$cantidad = array();
$codigo = array();
$detalle = array();
$precio_unitario = array();
$descuento = array();
$precio_final = array();
$id_producto = array();
$cantidad_v= array();
$n_serie=array();


// Capturo las variables de la tabla factura x producto

$cantidad =array_filter($_POST['cantidad']); // capturo con esta funcion la cantidad de productos ingresados no incluyendo los elementos vacios
$codigo= $_POST['codigo'];
$detalle= $_POST['detalle'];
$precio_unitario= $_POST['precio_unitario'];
$descuento= $_POST['descuento'];
$precio_final= $_POST['precio_final'];
$cantidad_v=$_POST['cantidad_v'];
$n_serie=$_POST['n_serie'];

// ver si el rut --> el cliente existe en la base de datos o no

$consulta = "select id_cliente from cliente where rut like '$rut';";

$resultado=mysql_query ($consulta, $conexion) or die ("1 ".mysql_error());

$fila=mysql_fetch_array($resultado);

$id_cliente=$fila['id_cliente'];

mysql_free_result($consulta);

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

mysql_query ($sql, $conexion) or die ("2 ".mysql_error());
mysql_free_result($sql);


$sql = "INSERT INTO `bodega`.`nota_credito` (`id_notacredito`, `comentario_notacredito`, `id_fv`,`tipo_documento`,`documento_rel`, `folio`, `condiciones`, `descuento`, `fecha`, `total_neto`, `total_iva`, `total_final`, `id_cliente`, `id_vendedor`, `comentario_factura`,`porcent_fact`) VALUES (NULL, '$comentario_notacredito', '$id_fv','$tipo_documento','$documento_rel', '$folio', '$condiciones', '$total_descuento', '$nuevafecha', '$total_neto', '$total_iva', '$total_final', '$id_cliente', '$id_vendedor', '$comentario_factura','$porcentaje_descuento');";

mysql_query ($sql, $conexion) or die ("3 ".mysql_error());
mysql_free_result($sql);
}



else{
	
$consulta = "INSERT INTO `bodega`.`cliente` (`id_cliente`, `nombre_cliente`, `rut`, `telefono`, `direccion`, `giro`, `comuna`, `id_vendedor`, `comentario_cliente`,`mail`) VALUES (NULL, '$nombre_cliente', '$rut', '$telefono', '$direccion', '$giro', '$comuna', '$id_vendedor', '$comentario_cliente','$mail');";
mysql_query ($consulta, $conexion) or die ("4 ".mysql_error());
mysql_free_result($consulta);

$sql = "INSERT INTO `bodega`.`nota_credito` (`id_notacredito`, `comentario_notacredito`, `id_fv`,`tipo_documento`,`documento_rel`, `folio`, `condiciones`, `descuento`, `fecha`, `total_neto`, `total_iva`, `total_final`, `id_cliente`, `id_vendedor`, `comentario_factura`,`porcent_fact`) VALUES (NULL, '$comentario_notacredito', '$id_fv','$tipo_documento','$documento_rel', '$folio', '$condiciones', '$total_descuento', '$nuevafecha', '$total_neto', '$total_iva', '$total_final', '$id_cliente', '$id_vendedor', '$comentario_factura','$porcentaje_descuento');";

mysql_query ($sql, $conexion) or die ("5 ".mysql_error());
mysql_free_result($sql);

}



///// veo cuantos productos fueron ingresados

$tope=count($cantidad);


for($i=0;$i<$tope;$i++){

if($n_serie[$i]!='' && $cantidad_v[$i]==1 && $cantidad[$i]==0){
$estado=4;
//UPDATE PARA CAMBIAR EL ESTADO DE MAQUINA DE VENDIDA(5) A STOCK(4)	
$update_estado = "UPDATE `maquina` SET `estado`='$estado' WHERE `n_serie`='$n_serie[$i]';";
mysql_query($update_estado, $conexion) or die ("6 ".mysql_error());
mysql_free_result($update_estado);
} 	
	
// capturar id producto según código de producto.

$consulta = "select id_producto from producto where codigo_producto like '$codigo[$i]';";

$resultado=mysql_query ($consulta, $conexion) or die ("7 ".mysql_error());

$fila=mysql_fetch_array($resultado);

$id_producto[$i]=$fila['id_producto'];

if($cantidad_v[$i]>$cantidad[$i]){
$devuelvo=$cantidad_v[$i]-$cantidad[$i];

$cambio_stock="UPDATE `producto` SET `stock`= `stock`+ '$devuelvo'  where `id_producto`='$id_producto[$i]';";
mysql_query ($cambio_stock, $conexion) or die ("8 ".mysql_error());}
	
$sql1 = "INSERT INTO `bodega`.`notacredito_x_producto` (`id_ncxp`, `cantidad`, `precio_venta`, `precio_final`, `descuento`, `id_producto`, `detalle`, `id_fv`,`n_serie`) VALUES (NULL, '$devuelvo', '$precio_unitario[$i]', '$precio_final[$i]', '$descuento[$i]', '$id_producto[$i]', '$detalle[$i]', '$id_fv', '$n_serie[$i]');";

mysql_query($sql1, $conexion) or die ("9 ".mysql_error());


$update="UPDATE `factura_venta` SET `estado`= 0  where `id_fv`='$id_fv' ";
 
mysql_query($update, $conexion) or die ("10 ".mysql_error());

}

mysql_free_result($cambio_stock);
mysql_free_result($consulta);
mysql_free_result($sql1);
mysql_free_result($update);
include "../cerrar_conexion.php";
header("Location: ../consulta_factura_venta.php"); 

?>
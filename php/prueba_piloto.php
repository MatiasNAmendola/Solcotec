<?

include "conexion.php";
//recoge datos del proveedor.
$nombre_proveedor=$_POST['nombre_proveedor'];
$rut=$_POST['rut'];
$direccion=$_POST['direccion'];
$giro=$_POST['giro'];
$comuna=$_POST['comuna'];
$telefono=$_POST['telefono'];
$mail=$_POST['mail'];
$comentario_proveedor=$_POST['comentario_proveedor'];
$vendedor_asignado=$_POST['vendedor_asignado'];

////////////////TRASFORMO LAS VARIABLES DE LOS PRODUCTOS INGRESADOS A ARREGLOS


$cantidad = array();
$codigo = array();
$n_serie = array();
$detalle = array();
$precio_unitario = array();
$descuento = array();
$precio_final = array();
$id_producto = array();


// Capturo las variables de la tabla factura x producto

$cantidad =array_filter($_POST['cantidad']); // capturo con esta funcion la cantidad de productos ingresados no incluyendo los elementos vacios
$codigo= $_POST['codigo'];
$n_serie= $_POST['n_serie'];
$detalle= $_POST['detalle'];
$precio_unitario= $_POST['precio_unitario'];
$descuento= $_POST['descuento'];
$precio_final= $_POST['precio_final'];


// No Pago:

$no_pago=$_POST['no_pago'];
if($no_pago==1){
$plazo_dias=$_POST['plazo_dias'];
$estado=4; // el estado define el estado de factura , si es 4 la factura queda Pendiente.
}else{
// recoge las variables de el pago.
$comentario_pago=$_POST['comentario_pago'];
$n_documento=$_POST['n_documento'];
$fecha_documento=$_POST['fecha_documento'];
$nuevafecha_documento = date('Y-m-d', strtotime($fecha_documento));// da vuelta la fecha para ser valida BD 
$banco_documento=$_POST['banco_documento'];
$condiciones=$_POST['condiciones'];
switch($condiciones){
	case 'Efectivo': // el estado define el estado de factura , si es 1 la factura queda pagada.
	$estado=1;
	break;
	
	case 'Cheque':  // el estado define el estado de factura , si es 1 la factura queda pagada.
	$estado=2;
	break;
	
	case 'Vale Vista':  // el estado define el estado de factura , si es 1 la factura queda pagada.
	$estado=3;
	break;
	}

}

///////////////// CAPTURO LAS VARIABLES PROPIAS DE LA FACTURA DE COMPRA


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





// ver si el rut --> el proveedor existe en la base de datos o no

$consulta = "select id_proveedor from proveedor where rut = '$rut';";

$resultado=mysql_query ($consulta, $conexion) or die (mysql_error());

$fila=mysql_fetch_array($resultado);

$id_proveedor=$fila['id_proveedor'];

mysql_free_result($resultado);



//////////////////////////////////////////////////////

if($id_proveedor != NULL){ // si el rut fue encontrado...

$sql="UPDATE `proveedor` SET
`id_proveedor`='$id_proveedor',
`nombre`='$nombre_proveedor',
`rut`='$rut',
`direccion`='$direccion',
`giro`='$giro',
`comuna`='$comuna',
`telefono`='$telefono',
`mail`='$mail',
`comentario`='$comentario_proveedor',
`vendedor_asignado`='$comentario_proveedor' WHERE `proveedor`.`id_proveedor` ='$id_proveedor';";

mysql_query ($sql, $conexion) or die ("1".mysql_error());
mysql_free_result($sql);


$sql = "INSERT INTO `factura_compra`(`id_fc`, `tipo_documento`, `documento_rel`, `folio`, `condiciones`, `total_descuento`, `fecha`, `total_neto`, `total_iva`, `total_final`, `id_proveedor`,`comentario_factura`, `estado`, `porcent_fact`,`no_pago`,`plazo_dias`)
VALUES(NULL,'$tipo_documento','$documento_rel','$folio','$condiciones','$total_descuento','$nuevafecha','$total_neto','$total_iva','$total_final','$id_proveedor','$comentario_factura','$estado','$porcentaje_descuento','$no_pago','$plazo_dias')";


mysql_query ($sql, $conexion) or die ("2".mysql_error());
mysql_free_result($sql);
}




else{
$consulta = "INSERT INTO `bodega`.`proveedor` (`id_proveedor`, `nombre`, `rut`, `direccion`, `giro`, `comuna`, `telefono`, `mail`, `comentario`,`vendedor_asignado`) VALUES (NULL, '$nombre','$rut', '$direccion', '$giro', '$comuna', '$telefono', '$mail', '$comentario','$vendedor_asignado');";
  mysql_query ($consulta, $conexion) or die ("3".mysql_error());
mysql_free_result($consulta);

$sql = "INSERT INTO `factura_compra`(`id_fc`, `tipo_documento`, `documento_rel`, `folio`, `condiciones`, `total_descuento`, `fecha`, `total_neto`, `total_iva`, `total_final`, `id_proveedor`,`comentario_factura`, `estado`, `porcent_fact`,`no_pago`,`plazo_dias`)
VALUES(NULL,'$tipo_documento','$documento_rel','$folio','$condiciones','$total_descuento','$nuevafecha','$total_neto','$total_iva','$total_final','$id_proveedor','$comentario_factura','$estado','$porcentaje_descuento','$no_pago','$plazo_dias')";

mysql_query ($sql, $conexion) or die ("4".mysql_error());
mysql_free_result($sql);

}

// capturar el ultimo id de factura de venta


$sql = "select max(id_fc) as memo from factura_compra ;";

$blue=mysql_query ($sql, $conexion) or die ("5".mysql_error());

$white=mysql_fetch_array($blue);

$id_fc=$white['memo'];

mysql_free_result($sql);
///// veo cuantos productos fueron ingresados

$tope=count($cantidad);


for($i=0;$i<$tope;$i++){
	$tipo=1;// tipo de maquina ingresada, 0 significa maquina ingresada para reparacion, 1 significa maquina ingresada para venta
	
	if($n_serie[$i]!=''){
		
$sql = "INSERT INTO `bodega`.`maquina` (`id_maquina`, `tipo`, `n_serie`, `modelo`, `marca`, `estado`, `descripcion`, `id_ot`,`id_fc`) VALUES (NULL, '$tipo', '$n_serie[$i]', '', '', '', '$detalle[$i]', '','$id_fc');";


mysql_query($sql, $conexion) or die ("6".mysql_error());
		}
	
// capturar id producto según código de producto.

$consulta = "select id_producto from producto where codigo_producto = '$codigo[$i]';";

$resultado=mysql_query ($consulta, $conexion) or die ("7".mysql_error());

$fila=mysql_fetch_array($resultado);

$id_producto[$i]=$fila['id_producto'];

mysql_free_result($consulta);

// SI EL PRODUCTO NO TIENE CODIGO O ES NUEVO...
if($id_producto[$i]==0){
	
	echo "<h1>Hay productos ingresados que no estan creados en el sistema, por favor , antes de ingresar estos por factura compra, tiene que crearlos en la seccion Productos.</h1>";
	echo "<br/>";
	echo "<br/>";
	echo "<a href='../ingreso_producto.php'><h1>Ir a Seccion Productos</h1></a>";
	die();
	}


//INSERT DE CADA PRODUCTO
	$sql1 = "INSERT INTO `bodega`.`facturac_x_producto` (`id_facturaxproducto`, `cantidad`, `precio_venta`, `precio_final`, `descuento`, `id_producto`, `detalle`, `id_fc`) VALUES (NULL, '$cantidad[$i]', '$precio_unitario[$i]', '$precio_final[$i]', '$descuento[$i]', '$id_producto[$i]', '$detalle[$i]', '$id_fc');";
	

mysql_query($sql1, $conexion) or die ("8".mysql_error());

//AGREGA EL STOCK POR PRODUCTO
$update="UPDATE `producto` SET `stock`=`stock`+ $cantidad[$i] where `id_producto`='$id_producto[$i]'";
 
mysql_query ($update, $conexion) or die ("9".mysql_error());
}

mysql_free_result($update);

// PAGO INSERT ... 

$pago = "INSERT INTO `bodega`.`pago_efectuado` (`id_pago`, `forma_pago`, `comentario_pago`, `n_documento`, `fecha_documento`, `banco_documento`, `fecha_emision`, `id_proveedor`, `id_factura`) VALUES (NULL, '$estado', '$comentario_pago', '$n_documento', '$nuevafecha_documento', '$banco_documento', '$nuevafecha', '$id_proveedor', '$id_fc');";

mysql_query ($pago, $conexion) or die ("10".mysql_error());

mysql_free_result($pago);

include "../cerrar_conexion.php";
header("Location: ../factura_compra.php"); 

?>
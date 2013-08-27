<?
include "conexion.php";

//DEFINO VARIABLES DE LA TABLA COMO ARREGLOS
$cantidad = array();
$codigo = array();
$n_serie = array();
$detalle = array();
$precio_unitario = array();
$descuento = array();
$precio_final = array();
$id_producto = array();


//OBTIENE DATOS PROVEEDOR.
$nombre_proveedor=strtoupper($_POST['nombre_proveedor']);
$rut=strtoupper($_POST['rut']);
$direccion=strtoupper($_POST['direccion']);
$giro=strtoupper($_POST['giro']);
$comuna=strtoupper($_POST['comuna']);
$telefono=strtoupper($_POST['telefono']);
$mail=strtoupper($_POST['mail']);
$comentario_proveedor=strtoupper($_POST['comentario_proveedor']);
$vendedor_asignado=strtoupper($_POST['vendedor_asignado']);

// CAPTURO LAS VARIABLES DE LA FACTURA DE COMPRA
$gasto=$_POST['gasto'];
$tipo_documento=$_POST['tipo_documento'];
$folio_factura=$_POST['folio_factura']; // folio externo , de la factura ingresada en papel.
$folio=$_POST['folio'];
$documento_rel=$_POST['documento_rel'];
$fecha_emision=$_POST['fecha_emision'];
$fecha_emision=date('Y-m-d', strtotime($fecha_emision));// da vuelta la fecha para ser valida BD
$fecha=$_POST['fecha_ingreso'];
$nuevafecha = date('Y-m-d', strtotime($fecha));// da vuelta la fecha para ser valida BD 
$total_iva=$_POST['total_iva'];
$total_neto=$_POST['total_neto'];
$porcentaje_descuento=$_POST['porcentaje_descuento'];
$total_descuento=$_POST['total_descuento'];
$total_final=$_POST['total_final'];
$comentario_factura=strtoupper($_POST['comentario_factura']);

switch($tipo_documento){
	case 'Orden de Compra':
	$tipo_documento=1;
	break;
	
	case 'Guía de Despacho':
	$tipo_documento=2;
	break;
}// fin del switch

// CAPTURO DATOS DE LA TABLA facturac_x_producto

$id_producto=$_POST['id_producto'];
$cantidad =array_filter($_POST['cantidad']); // capturo con esta funcion la cantidad de productos ingresados no incluyendo los elementos vacios
$codigo= $_POST['codigo'];
$n_serie= $_POST['n_serie'];
$detalle= $_POST['detalle'];
$precio_unitario= $_POST['precio_unitario'];
$descuento= $_POST['descuento'];
$precio_final= $_POST['precio_final'];

// CHECKBOX NO PAGO:
$no_pago=$_POST['no_pago'];

// VARIABLES DE PAGO
$comentario_pago=strtoupper($_POST['comentario_pago']);
$n_documento=$_POST['n_documento'];
$fecha_documento=$_POST['fecha_documento'];
$nuevafecha_documento = date('Y-m-d', strtotime($fecha_documento));// da vuelta la fecha para ser valida BD 
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


// CAPTURA EL ULTIMO ID GENERADO , ESTE SERA EL ID DE ESTA NUEVA FACTURA DE COMPRA
$sql = "select max(id_fc) as memo from factura_compra ;";
$blue=mysql_query ($sql, $conexion) or die ("5 ".mysql_error());
$white=mysql_fetch_array($blue);
$id_fc=$white['memo']+1;
mysql_free_result($sql);

// VER SI EL RUT EXISTE EN LA BASE DE DATOS
$consulta = "select id_proveedor from proveedor where rut = '$rut';";
$resultado=mysql_query ($consulta, $conexion) or die (mysql_error());
$fila=mysql_fetch_array($resultado);
$id_proveedor=$fila['id_proveedor'];
mysql_free_result($resultado);


// SI EXISTE EL RUT ACTUALIZAR LOS DATOS DEL PROVEEDOR
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
	mysql_query ($sql, $conexion) or die ("1 ".mysql_error());
	mysql_free_result($sql);
	
	// INGRESO DATOS FACTURA BASE DE DATOS
	$sql = "INSERT INTO `factura_compra`(`id_fc`, `tipo_documento`, `documento_rel`, `folio`, `total_descuento`, `fecha`,`fecha_emision`, `total_neto`, `total_iva`, `total_final`, `id_proveedor`,`comentario_factura`, `estado`, `porcent_fact`,`no_pago`,`plazo_dias`,`folio_factura`,`gasto`)VALUES(NULL,'$tipo_documento','$documento_rel','$folio','$total_descuento','$nuevafecha', '$fecha_emision','$total_neto','$total_iva','$total_final','$id_proveedor','$comentario_factura','$estado_factura','$porcentaje_descuento','$no_pago','$plazo_dias','$folio_factura','$gasto')";
	
	mysql_query ($sql, $conexion) or die ("2 ".mysql_error());
	mysql_free_result($sql);
}// fin if id proveedor null


// SI NO EXISTE CREA UN NUEVO PROVEEDOR Y INGRESA DATOS FACTURA.
else{
	$consulta = "INSERT INTO `bodega`.`proveedor` (`id_proveedor`, `nombre`, `rut`, `direccion`, `giro`, `comuna`, `telefono`, `mail`, `comentario`,`vendedor_asignado`) VALUES (NULL, '$nombre_proveedor','$rut', '$direccion', '$giro', '$comuna', '$telefono', '$mail', '$comentario','$vendedor_asignado');";
	mysql_query ($consulta, $conexion) or die ("3 ".mysql_error());
	mysql_free_result($consulta);
	
	
	$consulta="SELECT max(id_proveedor) as idmaximo FROM proveedor";
	$max_id = mysql_query ($consulta, $conexion) or die ('3.5'.mysql_error());
	$madero = mysql_fetch_array($max_id);
	$id_proveedor= $madero["idmaximo"];
	mysql_free_result($consulta);

	
	$sql = "INSERT INTO `factura_compra`(`id_fc`, `tipo_documento`, `documento_rel`, `folio`, `total_descuento`, `fecha`,`fecha_emision`, `total_neto`, `total_iva`, `total_final`, `id_proveedor`,`comentario_factura`, `estado`, `porcent_fact`,`no_pago`,`plazo_dias`,`folio_factura`,`gasto`)VALUES(NULL,'$tipo_documento','$documento_rel','$folio','$total_descuento','$nuevafecha', '$fecha_emision','$total_neto','$total_iva','$total_final','$id_proveedor','$comentario_factura','$estado_factura','$porcentaje_descuento','$no_pago','$plazo_dias','$folio_factura','$gasto')";
	mysql_query ($sql, $conexion) or die ("4 ".mysql_error());
	mysql_free_result($sql);
}// fin else


if($no_pago==1){
	$plazo_dias=$_POST['plazo_dias'];
	$comentario_pago=strtoupper($_POST['comentario_pago']);
	$estado_factura=2; // el estado define el estado de factura.

	if($comentario_pago !=''){
		// PAGO INSERT ... 
		$pago = "INSERT INTO `bodega`.`pago_efectuado` (`comentario_pago`, `fecha_emision`, `id_proveedor`, `id_factura`) VALUES ('$comentario_pago', '$nuevafecha', '$id_proveedor', '$id_fc');";
		mysql_query ($pago, $conexion) or die ("10.4 ".mysql_error());	
		mysql_free_result($pago);
	 }// fin if si hay comentario
}// fin if $no_pago==1
else{


// PAGO INSERT ... 

$pago = "INSERT INTO `bodega`.`pago_efectuado` (`id_pago`, `forma_pago`, `comentario_pago`, `n_documento`, `fecha_documento`, `banco_documento`, `fecha_emision`, `id_proveedor`, `id_factura`) VALUES (NULL, '$forma_pago', '$comentario_pago', '$n_documento', '$nuevafecha_documento', '$banco_documento', '$nuevafecha', '$id_proveedor', '$id_fc');";

mysql_query ($pago, $conexion) or die ("10 ".mysql_error());
mysql_free_result($pago);
}// fin else

//POR LOS REINICIOS DE BD.
if($id_fc==0){
	$id_fc=1;
}
//CUENTA LA CANTIDAD DE ELEMENTOS DEL ARREGLO CANTIDAD PARA DETERMINAR LA CANTIDAD DE FILAS PARA EL FOR.
$tope=count($cantidad);

for($i=0;$i<$tope;$i++){
	$tipo=0;// tipo de maquina ingresada, 1 significa maquina ingresada para reparacion, 0 significa maquina ingresada para venta
	
	if($n_serie[$i]!=''){
		// INGRESO DE MAQUINA SI HAY ALGUN PRODUCTO CON NUMERO DE SERIE.
		$estado_maquina=4; // en stock
		$sql = "INSERT INTO `bodega`.`maquina` (`id_maquina`, `tipo`,`nombre`, `n_serie`, `estado`, `descripcion`, `id_ot`,`id_fc`,`id_producto`,`dias_garantia`) VALUES (NULL, '$tipo', '$detalle[$i]', '$n_serie[$i]', '$estado_maquina', '', '', '$id_fc','$id_producto[$i]','')";
		mysql_query($sql, $conexion) or die ("6 ".mysql_error());
	}// fin $n_serie[$i]!=''


//INSERT DE CADA PRODUCTO
	$sql1 = "INSERT INTO `bodega`.`facturac_x_producto` (`id_facturaxproducto`, `cantidad`, `precio_venta`, `precio_final`, `descuento`, `id_producto`, `detalle`, `id_fc`,`n_serie`) VALUES (NULL, '$cantidad[$i]', '$precio_unitario[$i]', '$precio_final[$i]', '$descuento[$i]', '$id_producto[$i]', '$detalle[$i]', '$id_fc','$n_serie[$i]');";
	mysql_query($sql1, $conexion) or die ("8 ".mysql_error());

/*	if($gasto==0){
		//AGREGA EL STOCK POR PRODUCTO
		$update="UPDATE `producto` SET `stock`=`stock`+ $cantidad[$i] where `id_producto`='$id_producto[$i]'";
		mysql_query ($update, $conexion) or die ("9 ".mysql_error());
		mysql_free_result($update);
	}// fin if $gasto==0*/



}// fin for gigante

include "../cerrar_conexion.php";
header("Location: ../factura_compra.php"); 
?>
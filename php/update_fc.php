<?
include "conexion.php";

//DEFINO VARIABLES DE LA TABLA COMO ARREGLOS
$cantidad = array();
$cantidad_antigua = array();
$codigo = array();
$n_serie = array();
$detalle = array();
$precio_unitario = array();
$descuento = array();
$precio_final = array();
$id_producto = array();
$id_facturaxproducto = array();


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



// VER SI EL RUT EXISTE EN LA BASE DE DATOS
$consulta = "select id_proveedor from proveedor where rut = '$rut';";
$resultado=mysql_query ($consulta, $conexion) or die (mysql_error());
$fila=mysql_fetch_array($resultado);
$id_proveedor=$fila['id_proveedor'];
mysql_free_result($resultado);

// CAPTURO LAS VARIABLES DE LA FACTURA DE COMPRA
$no_pago_antiguo=$_POST['no_pago_antiguo'];
$id_factura=$_POST['id_factura'];
$id_pago=$_POST['id_pago'];

$gasto=$_POST['gasto'];
$tipo_documento=$_POST['tipo_documento'];

switch($tipo_documento){
case 'Orden de Compra':
$tipo_documento=1;
break;

case 'Guía de Despacho':
$tipo_documento=2;
break;
}//fin switch

$folio_factura=$_POST['folio_factura']; // folio externo , de la factura ingresada en papel.
$documento_rel=$_POST['documento_rel'];

if($_POST['fecha_emision']!=''){
$fecha_emision=$_POST['fecha_emision'];
$fecha_emision=date('Y-m-d', strtotime($fecha_emision));// da vuelta la fecha para ser valida BD
}else{
$fecha_emision='';
}

if($_POST['fecha_ingreso']!=''){
$fecha=$_POST['fecha_ingreso'];
$nuevafecha=date('Y-m-d', strtotime($fecha));// da vuelta la fecha para ser valida BD
}else{
$nuevafecha='';
}

$total_iva=$_POST['total_iva'];
$total_neto=$_POST['total_neto'];
$porcentaje_descuento=$_POST['porcentaje_descuento'];
$total_descuento=$_POST['total_descuento'];
$total_final=$_POST['total_final'];
$comentario_factura=strtoupper($_POST['comentario_factura']);

// CAPTURO DATOS DE LA TABLA facturac_x_producto

$id_producto=$_POST['id_producto'];// identificador e la ficha del producto para modificar stock
$id_facturaxproducto=$_POST['id_facturaxproducto'];// identificador del registro del producto
$cantidad =array_filter($_POST['cantidad']); // capturo con esta funcion la cantidad de productos ingresados no incluyendo los elementos vacios
$cantidad_antigua=$_POST['cantidad_antigua'];
$codigo= $_POST['codigo'];
$n_serie= $_POST['n_serie'];
$detalle= $_POST['detalle'];
$precio_unitario= $_POST['precio_unitario'];
$descuento= $_POST['descuento'];
$precio_final= $_POST['precio_final'];


// CHECKBOX NO PAGO:

$no_pago=$_POST['no_pago'];
// recoge las variables de el pago.
$plazo_dias=$_POST['plazo_dias'];
$comentario_pago=strtoupper($_POST['comentario_pago']);
$n_documento=$_POST['n_documento'];


if($_POST['fecha_documento']!=''){
$fecha_documento=$_POST['fecha_emision'];
$nuevafecha_documento=date('Y-m-d', strtotime($fecha_documento));// da vuelta la fecha para ser valida BD
}else{
$nuevafecha_documento='';
}

$banco_documento=strtoupper($_POST['banco_documento']);
$forma_pago=$_POST['forma_pago'];
switch($forma_pago){
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
}

//-------------------------------------------------------------------------
// IF NUMERO 1 -------------
if($no_pago==0 && $no_pago_antiguo==1){
$estado_factura=1; // el estado define el estado de factura.
$delete_pago="DELETE FROM `pago_efectuado` WHERE `id_pago`='$id_pago'";
mysql_query ($delete_pago, $conexion) or die ("11 ".mysql_error());
mysql_free_result($delete_pago);

// PAGO INSERT ... 
$pago = "INSERT INTO `bodega`.`pago_efectuado` (`comentario_pago`, `fecha_emision`, `id_proveedor`, `id_factura`) VALUES ('$comentario_pago', '$nuevafecha', '$id_proveedor', '$id_fc');";
mysql_query ($pago, $conexion) or die ("12 ".mysql_error());
mysql_free_result($pago);

}//fin if 1.

//-------------------------------------------------------------------------
// IF NUMERO 2 -------------
if($no_pago==1 && $no_pago_antiguo==1){
$estado_factura=2; // el estado define el estado de factura.

if($comentario_pago !=''){
// PAGO UPDATE ... 
$update_pago = "UPDATE `pago_efectuado` SET `comentario_pago`='$comentario_pago',`fecha_emision`='$nuevafecha',`id_proveedor`=$id_proveedor,`id_factura`='$id_factura' WHERE id_pago='$id_pago';";

mysql_query ($update_pago, $conexion) or die ("13 ".mysql_error());

mysql_free_result($update_pago);
}// fin if comentario
	
}//fin if 2.

//-------------------------------------------------------------------------
// IF NUMERO 3 -------------
if($no_pago==1 && $no_pago_antiguo==0){
$estado_factura=2; // el estado define el estado de factura.
if($comentario_pago !=''){
// PAGO UPDATE ... 
$update_pago = "UPDATE `pago_efectuado` SET `comentario_pago`='$comentario_pago',`fecha_emision`='$nuevafecha',`id_proveedor`=$id_proveedor,`id_factura`='$id_factura' WHERE id_pago='$id_pago';";
mysql_query ($update_pago, $conexion) or die ("14 ".mysql_error());
mysql_free_result($update_pago);	
}//fin if comentario
$delete_pago="DELETE FROM `pago_efectuado` WHERE `id_pago`='$id_pago'";
mysql_query ($delete_pago, $conexion) or die ("15 ".mysql_error());
mysql_free_result($delete_pago);
}// fin if 3.
	
// IF NUMERO 3 -------------
if($no_pago==0 && $no_pago_antiguo==0){
	// PAGO UPDATE ... 
$update_pago = "UPDATE `pago_efectuado` SET `forma_pago`='$forma_pago',`comentario_pago`='$comentario_pago',`n_documento`='$n_documento',`fecha_documento`='$nuevafecha_documento',`banco_documento`='$banco_documento',`fecha_emision`='$nuevafecha',`id_proveedor`='$id_proveedor',`id_factura`='$id_factura' WHERE id_pago='$id_pago';";

mysql_query ($update_pago, $conexion) or die ("16 ".mysql_error());
mysql_free_result($update_pago);
	}

//CUENTA LA CANTIDAD DE ELEMENTOS DEL ARREGLO CANTIDAD PARA DETERMINAR LA CANTIDAD DE FILAS PARA EL FOR.
$tope=count($cantidad);

for($i=0;$i<$tope;$i++){
	$tipo=0;// tipo de maquina ingresada, 1 significa maquina ingresada para reparacion, 0 significa maquina ingresada para venta
	
if($n_serie[$i]!=''){

// INGRESO DE MAQUINA SI HAY ALGUN PRODUCTO CON NUMERO DE SERIE.
$estado_maquina=4; // en stock

$sql="UPDATE `maquina` SET `tipo`='$tipo',`nombre`='$detalle[$i]',`n_serie`='$n_serie[$i]',`estado`='$estado_maquina', `id_fc`='$id_factura',`id_producto`='$id_producto[$i]' WHERE `id_facturaxproducto`='$id_producto[$i]' ;";
mysql_query($sql, $conexion) or die ("3 ".mysql_error());

}

 
$sql1="UPDATE `facturac_x_producto` SET `cantidad`='$cantidad[$i]',`precio_venta`='$precio_unitario[$i]',`precio_final`='$precio_final[$i]',`descuento`='$descuento[$i]',`id_producto`='$id_producto[$i]',`detalle`='$detalle[$i]',`n_serie`='$n_serie[$i]' WHERE `id_facturaxproducto`='$id_facturaxproducto[$i]'";

mysql_query($sql1, $conexion) or die ("4 ".mysql_error());

if($gasto==0){
	
	
		if($cantidad[$i]>$cantidad_antigua[$i]){
		
		$resto=$cantidad[$i]-$cantidad_antigua[$i];
		
		//AGREGA EL STOCK POR PRODUCTO
		$update="UPDATE `producto` SET `stock`=`stock`+ $resto WHERE `id_producto`='$id_producto[$i]'";
		mysql_query ($update, $conexion) or die ("5.1 ".mysql_error());
		}
		
		
		if($cantidad_antigua[$i]>$cantidad[$i]){
		
		$resto=$cantidad_antigua[$i]-$cantidad[$i];
		//AGREGA EL STOCK POR PRODUCTO
		$update="UPDATE `producto` SET `stock`=`stock`- $resto WHERE `id_producto`='$id_producto[$i]'";
		mysql_query ($update, $conexion) or die ("5.2 ".mysql_error());
		}
		
	
}

}
mysql_free_result($update);



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
`vendedor_asignado`='$vendedor_asignado' WHERE `proveedor`.`id_proveedor` ='$id_proveedor';";

mysql_query ($sql, $conexion) or die ("6 ".mysql_error());
mysql_free_result($sql);

// INGRESO DATOS FACTURA BASE DE DATOS
$sql ="UPDATE `factura_compra` SET `tipo_documento`='$tipo_documento',`documento_rel`='$documento_rel',`total_descuento`='$total_descuento',`fecha`='$nuevafecha',`fecha_emision`='$fecha_emision',`total_neto`='$total_neto',`total_iva`='$total_iva',`total_final`='$total_final',`id_proveedor`='$id_proveedor',`comentario_factura`='$comentario_factura',`estado`='$estado_factura',`porcent_fact`='$porcentaje_descuento',`no_pago`='$no_pago',`plazo_dias`='$plazo_dias',`folio_factura`='$folio_factura',`gasto`='$gasto' WHERE `id_fc`='$id_factura';";

mysql_query ($sql, $conexion) or die ("7 ".mysql_error());
mysql_free_result($sql);
}


// SI NO EXISTE CREA UN NUEVO PROVEEDOR Y INGRESA DATOS FACTURA.
else{
$consulta = "INSERT INTO `bodega`.`proveedor` (`id_proveedor`, `nombre`, `rut`, `direccion`, `giro`, `comuna`, `telefono`, `mail`, `comentario`,`vendedor_asignado`) VALUES (NULL, '$nombre_proveedor','$rut', '$direccion', '$giro', '$comuna', '$telefono', '$mail', '$comentario','$vendedor_asignado');";
  mysql_query ($consulta, $conexion) or die ("8 ".mysql_error());
mysql_free_result($consulta);


$consulta="SELECT max(id_proveedor) as idmaximo FROM proveedor";
$max_id = mysql_query ($consulta, $conexion) or die ('8.5'.mysql_error());
$madero = mysql_fetch_array($max_id);
$id_proveedor_max= $madero["idmaximo"];


$sql ="UPDATE `factura_compra` SET `tipo_documento`='$tipo_documento',`documento_rel`='$documento_rel',`total_descuento`='$total_descuento',`fecha`='$nuevafecha',`fecha_emision`='$fecha_emision',`total_neto`='$total_neto',`total_iva`='$total_iva',`total_final`='$total_final',`id_proveedor`='$id_proveedor',`comentario_factura`='$comentario_factura',`estado`='$estado_factura',`porcent_fact`='$porcentaje_descuento',`no_pago`='$no_pago',`plazo_dias`='$plazo_dias',`folio_factura`='$folio_factura',`gasto`='$gasto' WHERE `id_fc`='$id_factura';";
mysql_query ($sql, $conexion) or die ("9 ".mysql_error());
mysql_free_result($sql);
mysql_free_result($consulta);

}



include "../cerrar_conexion.php";
header("Location: ../consulta_factura_compra.php"); 

?>
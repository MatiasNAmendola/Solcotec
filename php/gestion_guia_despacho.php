<?
include "conexion.php";

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
  



///////////////// CAPTURO LAS VARIABLES PROPIAS DE LA GUIA DE DESPACHO

	
	
$folio=$_POST['folio'];
$fecha=$_POST['fecha_ingreso'];
$nuevafecha = date('Y-m-d', strtotime($fecha));// da vuelta la fecha para ser valida BD 
$total_iva=$_POST['total_iva'];
$total_neto=$_POST['total_neto'];
$porcentaje_descuento=$_POST['porcentaje_descuento'];
$total_descuento=$_POST['total_descuento'];
$total_final=$_POST['total_final'];
$comentario_guia = strtoupper($_POST['comentario_guia']);
$nombre_contacto = strtoupper($_POST['nombre_contacto']);
$rut_contacto = strtoupper($_POST['rut_contacto']);
$tipo_traslado=	strtoupper($_POST['tipo_traslado']);
$id_factura=strtoupper($_POST['factura_rel']);

// capturar id vendedor:

$con = "select id_vendedor from vendedor where nombre like '$cod_vendedor';";

$resul=mysql_query ($con, $conexion) or die (mysql_error());

$fi=mysql_fetch_array($resul);

$id_vendedor=$fi['id_vendedor'];

mysql_free_result($con);// libera variable que contenia la consulta.


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



// Capturo las variables de la tabla factura x producto

$cantidad =array_filter($_POST['cantidad']); // capturo con esta funcion la cantidad de productos ingresados no incluyendo los elementos vacios
$codigo= $_POST['codigo'];
$n_serie= $_POST['n_serie'];
$detalle= $_POST['detalle'];
$precio_unitario= $_POST['precio_unitario'];
$descuento= $_POST['descuento'];
$precio_final= $_POST['precio_final'];
$n_ot= $_POST['n_ot'];


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


$sql = "INSERT INTO `guia_despacho`(`id_guia`, `id_factura`, `folio`, `total_descuento`, `fecha`, `total_neto`, `total_iva`, `total_final`, `id_cliente`, `id_vendedor`, `comentario_guia`, `estado_guia`, `porcent_fact`,`nombre_contacto`,`rut_contacto`,`tipo_traslado`)VALUES(NULL,'$id_factura','$folio','$total_descuento','$nuevafecha','$total_neto','$total_iva','$total_final','$id_cliente','$id_vendedor','$comentario_guia','$estado_guia','$porcentaje_descuento','$nombre_contacto','$rut_contacto','$tipo_traslado')";

mysql_query ($sql, $conexion) or die ("2".mysql_error());
mysql_free_result($sql);
}else{
$consulta = "INSERT INTO `bodega`.`cliente` (`id_cliente`, `nombre_cliente`, `rut`, `telefono`, `direccion`, `giro`, `comuna`, `id_vendedor`, `comentario_cliente`,`mail`) VALUES (NULL, '$nombre_cliente', '$rut', '$telefono', '$direccion', '$giro', '$comuna', '$id_vendedor', '$comentario_cliente','$mail');";
mysql_query ($consulta, $conexion) or die ("3" .mysql_error());
mysql_free_result($consulta);

$consulta="SELECT max(id_cliente) as idmaximo FROM cliente";
$max_id = mysql_query ($consulta, $conexion) or die ('3.5'.mysql_error());
$madero = mysql_fetch_array($max_id);
$id_cliente_max= $madero["idmaximo"];

$sql = "INSERT INTO `guia_despacho`(`id_guia`, `id_factura`, `folio`, `total_descuento`, `fecha`, `total_neto`, `total_iva`, `total_final`, `id_cliente`, `id_vendedor`, `comentario_guia`, `estado_guia`, `porcent_fact`,`nombre_contacto`,`rut_contacto`,`tipo_traslado`)VALUES(NULL,'$id_factura','$folio','$total_descuento','$nuevafecha','$total_neto','$total_iva','$total_final','$id_cliente','$id_vendedor','$comentario_guia','$estado_guia','$porcentaje_descuento','$nombre_contacto','$rut_contacto','$tipo_traslado')";

mysql_query ($sql, $conexion) or die ("4" .mysql_error());
mysql_free_result($sql);
mysql_free_result($consulta);
}

// capturar el ultimo id de factura de venta


$sql = "select max(id_guia) as memo from guia_despacho ;";

$blue=mysql_query ($sql, $conexion) or die ("5" .mysql_error());

$white=mysql_fetch_array($blue);

$id_fv=$white['memo'];

mysql_free_result($sql);


//POR LOS REINICIOS DE INDICES BD. MIGRACIONES
if($id_guia==0){
	$id_guia=1;
	}
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

$update_maquina = "UPDATE `maquina` SET `estado`=5,`dias_garantia`=365 WHERE `n_serie`='$n_serie[$i]';";
mysql_query ($update_maquina, $conexion) or die ("ERROR UPDATE MAQUINA VENTA : " .mysql_error());
mysql_free_result($update_maquina);
}

// capturar id producto según código de producto.

$consulta = "select id_producto from producto where codigo_producto like '$codigo[$i]';";

$resultado=mysql_query ($consulta, $conexion) or die ("6 " .mysql_error());

$fila=mysql_fetch_array($resultado);

$id_producto[$i]=$fila['id_producto'];

mysql_free_result($consulta);
	

// SI EL PRODUCTO NO TIENE CODIGO O ES NUEVO...
if($id_producto[$i]==0){
	
	echo "<h1>Hay productos ingresados que no estan creados en el sistema, por favor , antes de ingresar estos por guia de despacho tiene que crearlos en la seccion Productos.</h1>";
	echo "<br/>";
	echo "<br/>";
	echo "<a href='../ingreso_producto.php'><h1>Ir a Seccion Productos</h1></a>";
	die();
	}

$tipo_docrel=1; // id_docurel determina: 1 es factura de venta, 2 es factura de compra, 3 es nota de credito y 4 es guia de despacho.

//INSERT DE CADA PRODUCTO
$sql1 = "INSERT INTO `bodega`.`reg_producto` (`id_regproducto`,`id_docrel`,`tipo_docrel`, `cantidad`, `precio_venta`, `precio_final`, `descuento`, `id_producto`, `detalle`,`n_serie`) VALUES (NULL, $id_fv,'$tipo_docrel', '$cantidad[$i]', '$precio_unitario[$i]', '$precio_final[$i]', '$descuento[$i]', '$id_producto[$i]', '$detalle[$i]', '$n_serie[$i]');";
mysql_query($sql1, $conexion) or die ("8" .mysql_error());

}
include "../cerrar_conexion.php";
header("Location: ../guia_despacho.php");

?>
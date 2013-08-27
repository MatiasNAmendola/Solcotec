<?

include "conexion.php";
$id_cliente=$_POST["id_cliente"];
$id_fv=$_POST["id_factura"];
$condiciones=$_POST['condiciones'];

switch($condiciones){
case 'Efectivo': // el estado define el estado de pago , si es 1 la factura queda pagada.
$estado_factura=1;
$forma_pago=1;
break;

case 'Cheque': // el estado define el estado de pago , si es 1 la factura queda pagada.
$estado_factura=1;
$forma_pago=2;
break;

case 'Vale Vista': // el estado define el estado de pago , si es 2 la factura queda como pendiente de pago.
$estado_factura=1;
$forma_pago=3;
break;
}



// recoge las variables de el pago.
$comentario_pago=$_POST['comentario_pago'];
$n_documento=$_POST['n_documento'];
$fecha_documento=$_POST['fecha_documento'];
$fecha_documento = date('Y-m-d', strtotime($fecha_documento));// da vuelta la fecha para ser valida BD 
$fecha_recepcion=date('Y-m-d');// da vuelta la fecha para ser valida BD
$banco_documento=$_POST['banco_documento'];



$pago = "INSERT INTO `bodega`.`pago` (`id_pago`, `forma_pago`, `comentario_pago`, `n_documento`, `fecha_documento`, `banco_documento`, `fecha_recepcion`, `id_cliente`, `id_factura`) VALUES (NULL, '$estado', '$comentario_pago', '$n_documento', '$fecha_documento', '$banco_documento', '$fecha_recepcion', '$id_cliente', '$id_fv');";


mysql_query ($pago, $conexion) or die (mysql_error());

mysql_free_result($pago);


$update_estadofactura ="UPDATE `factura_venta` SET  
`estado` =  '$estado_factura'
WHERE `id_fv` ='$id_fv' AND `id_cliente` ='$id_cliente';
";

mysql_query ($update_estadofactura, $conexion) or die (mysql_error());

mysql_free_result($update_estadofactura);


include "../cerrar_conexion.php";
header("Location: ../consulta_factura_venta.php"); 




?>
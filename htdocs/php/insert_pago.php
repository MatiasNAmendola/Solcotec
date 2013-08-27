<?

include "conexion.php";
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
	
	
	
// recoge las variables de el pago.
$comentario_pago=$_POST['comentario_pago'];
$n_documento=$_POST['n_documento'];
$fecha_documento=$_POST['fecha_documento'];

$nuevafecha_documento = date('Y-m-d', strtotime($fecha_documento));// da vuelta la fecha para ser valida BD 

$banco_documento=$_POST['banco_documento'];
$linea_credito=$_POST['linea_credito'];


if($estado==1 || $estado==2){
$pago = "INSERT INTO `bodega`.`pago` (`id_pago`, `forma_pago`, `comentario_pago`, `n_documento`, `fecha_documento`, `banco_documento`, `fecha_recepcion`, `id_cliente`, `id_factura`) VALUES (NULL, '$estado', '$comentario_pago', '$n_documento', '$nuevafecha_documento', '$banco_documento', '$nuevafecha', '$id_cliente', '$id_fv');";

mysql_query ($pago, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis insert pago de factura.</p>");

mysql_free_result($pago);
}

include "../cerrar_conexion.php";
//header("Location: ../consulta_factura_venta.php"); 




?>
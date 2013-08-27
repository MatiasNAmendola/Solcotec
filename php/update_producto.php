<? 
include "conexion.php";
   $id_producto=$_POST['id'];
   $codigo=strtoupper($_POST['codigo_producto']);
   $nombre_producto=strtoupper($_POST['nombre_producto']);
   $cantidad=$_POST['cantidad'];
   $precio_venta=$_POST['precio_venta'];
   $precio_compra=$_POST['precio_compra'];
   $proveedor=strtoupper($_POST['proveedor']);
   $fecha=$_POST['fecha_ingreso'];
   $nuevafecha = date('Y-m-d', strtotime($fecha));// da vuelta la fecha para ser valida BD 
   $posicion=strtoupper($_POST['posicion']);
   $marca=strtoupper($_POST["marca"]);
   
   $compatible=array();
   $compatible=array_filter(strtoupper($_POST["compatible"]));
   
   


   
   
$consulta="UPDATE producto SET 
codigo_producto = '$codigo',
stock = '$cantidad',
neto = '$precio_compra',
p_venta = '$precio_venta',
fecha_ingreso = '$nuevafecha',
posicion = '$posicion',
nombre = '$nombre_producto',
proveedor='$proveedor',
marca='$marca'
WHERE id_producto = '$id_producto';";

mysql_query ($consulta, $conexion) or die (mysql_error());

mysql_free_result($consulta);
include "cerrar_conexion.php";


header("Location: ../consulta_producto.php");

?>

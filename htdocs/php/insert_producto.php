<?
include "conexion.php";

   $codigo=$_POST['codigo'];
   $nombre_producto=$_POST['nombre_producto'];
   $stock=$_POST['cantidad'];
   $p_venta=$_POST['precio_venta'];
   $neto=$_POST['precio_compra'];
   $marca=$_POST['marca'];
   $numero_serie=$_POST['numero_serie'];
   $proveedor=$_POST['proveedor'];
   $fecha=$_POST['fecha_ingreso'];
   $nuevafecha = date('Y-m-d', strtotime($fecha));// da vuelta la fecha para ser valida BD 
   $posicion=$_POST['posicion'];
   
   
   //cambio nombre de
   
$consulta = "select id_proveedor from proveedor where nombre like '$proveedor';";

$resultado = mysql_query ($consulta, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis cambio nombre x id</p>");

$fila = mysql_fetch_array($resultado);

$id_proveedor = $fila['id_proveedor'];

$sql = "INSERT INTO `bodega`.`producto` (`id_producto`, `codigo_producto`, `nombre`, `posicion`, `marca`, `n_serie`, `stock`, `neto`, `p_venta`, `id_proveedor`, `fecha_ingreso`) VALUES (NULL, '$codigo', '$nombre_producto', '$posicion', '$marca', '$numero_serie', '$stock', '$neto', '$p_venta', '$id_proveedor', '$nuevafecha');";



mysql_query ($sql, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis</p>");
mysql_free_result($sql);

header("Location: ../ingreso_producto.php");
include "cerrar_conexion.php";

?>

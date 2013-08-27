<?

include "conexion.php";
$id_product=$_POST['id'];

$consulta="DELETE FROM `bodega`.`producto` WHERE `producto`.`id_producto` = '$id_product';";

 mysql_query ($consulta, $conexion) or die (mysql_error());
 mysql_free_result($consulta);
 
 $consulta="DELETE FROM compatible WHERE id_producto = '$id_product';";

 mysql_query ($consulta, $conexion) or die (mysql_error());
 mysql_free_result($consulta);
 include "cerrar_conexion.php";

 header("Location: ../consulta_producto.php"); 

?>

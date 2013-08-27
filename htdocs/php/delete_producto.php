<?

include "conexion.php";
$id_product=$_POST['id'];

$consulta="DELETE FROM `bodega`.`producto` WHERE `producto`.`id_producto` = '$id_product';";

 mysql_query ($consulta, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis (o llaves foraneas)</p>");
 mysql_free_result($consulta);
 header("Location: ../consulta_producto.php"); 

  include "cerrar_conexion.php";
?>

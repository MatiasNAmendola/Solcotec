<? 
include "conexion.php";
$id_cliente=$_POST['ID'];
   
$consulta="DELETE FROM `bodega`.`cliente` WHERE `cliente`.`id_cliente` = '$id_cliente'";
mysql_query ($consulta, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis error delete cliente.</p>");
mysql_free_result($consulta);
header("Location: ../consulta_cliente.php"); 
include "cerrar_conexion.php";

?>

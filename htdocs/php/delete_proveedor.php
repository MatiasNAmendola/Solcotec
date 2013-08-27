<? 
include "conexion.php";
$id_proveedor=$_POST['id'];
   
$consulta="DELETE FROM `bodega`.`proveedor` WHERE `proveedor`.`id_proveedor` = '$id_proveedor';";

 mysql_query ($consulta, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis o llaves foraneas</p>");
 mysql_free_result($consulta);
 header("Location: ../consulta_proveedor.php"); 

  include "cerrar_conexion.php";
?>

<?

include "conexion.php";
$id_vendedor=$_POST['ID'];

$consulta="DELETE FROM vendedor WHERE id_vendedor = '$id_vendedor';";

 mysql_query ($consulta, $conexion) or die (mysql_error());
 mysql_free_result($consulta);
 
include "cerrar_conexion.php";

 header("Location: ../consulta_vendedor.php"); 

?>

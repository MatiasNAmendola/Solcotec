<? 
include "conexion.php";
$id_cliente=$_POST["ID"];
   
$consulta="DELETE FROM cliente WHERE id_cliente = '$id_cliente'";
mysql_query ($consulta, $conexion) or die (mysql_error());
include "cerrar_conexion.php";
header("Location: ../consulta_cliente.php"); 

?>

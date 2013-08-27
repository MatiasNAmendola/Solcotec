<?
include("conexion.php");
$id_compatible=$_POST["id_compatible"];

$sql="DELETE FROM compatible WHERE id_compatible='$id_compatible'";
mysql_query($sql, $conexion) or die ('error: '.mysql_error());
mysql_free_result($sql);
include "cerrar_conexion.php";

?>
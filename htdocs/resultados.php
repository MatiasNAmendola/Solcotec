<?
include "php/conexion.php";
$term = $_REQUEST['q'];
$consulta="SELECT nombre_cliente, rut FROM cliente WHERE nombre_cliente LIKE '%$term%'";
$resultado = mysql_query($consulta, $conexion);
while ($fila = mysql_fetch_assoc($resultado)) {
    echo $fila['nombre_cliente']." [".$fila['rut']."]<br />\n ";
}
include "php/cerrar_conexion.php";
?> 
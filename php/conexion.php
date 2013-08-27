<?
$root="localhost";
$user= "root";
$pass= "neurocx123";
$bd="bodega";

// Se establece conexion con el servidor:
$conexion=mysql_connect($root,$user,$pass);
mysql_select_db($bd, $conexion);
if(!$conexion){
die ('No se ha podido conectar: '.mysql_error()); 
}
?>
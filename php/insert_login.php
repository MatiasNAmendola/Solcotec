<?
include "conexion.php";
session_start();
//Comprobacion del envio del nombre de usuario y password
$usuario=$_POST['usuario'];
$password=$_POST['password'];

if ($password==NULL|$usuario==NULL) {
	echo"<h1>No ha ingresado nada</h1>";
}
else{
$consulta = mysql_query("SELECT usuario,password FROM usuario WHERE usuario = '$usuario'") or die(mysql_error());
$dato = mysql_fetch_array($consulta);
if($dato['password'] != $password || $dato['usuario'] != $usuario) {
echo utf8_decode("<h1>* Usuario o contraseña ingresados son incorrectos</h1>");
}else{
$consulta = mysql_query("SELECT id_usuario, usuario,password, tipo_usuario FROM usuario WHERE usuario = '$usuario'") or die(mysql_error());
$fila = mysql_fetch_array($consulta);
$_SESSION["tipo_usuario"] = $fila['tipo_usuario'];
$_SESSION["s_username"] = $fila['usuario'];
$_SESSION["id_usuario"] = $fila['id_usuario'];
header("Location: ../consulta_producto.php");
}
}

include "cerrar_conexion.php";
?>
<?
include "conexion.php";
session_start();
//Comprobacion del envio del nombre de usuario y password
$usuario=$_POST['usuario'];
$password=$_POST['password'];

if ($password==NULL|$usuario==NULL) {
	echo"no se ha ingresado nada";
}
else{
$consulta = mysql_query("SELECT usuario,password FROM usuario WHERE usuario = '$usuario'") or die(mysql_error());
$dato = mysql_fetch_array($consulta);
if($dato['password'] != $password) {
echo "Usuario o contraseña ingresados son incorrectos";
}else{
$consulta = mysql_query("SELECT usuario,password FROM usuario WHERE usuario = '$usuario'") or die(mysql_error());
$fila = mysql_fetch_array($consulta);
$_SESSION["s_username"] = $fila['usuario'];
header("Location: ../consulta_producto.php");
}
}

include "cerrar_conexion.php";
?>
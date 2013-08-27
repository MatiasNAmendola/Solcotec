<?
session_start();
if (isset($_SESSION['s_username'])) {
$mensaje1="Bienvenido ".$_SESSION['s_username'].", has ingresado a Miller";
}else{
header("Location: ../login.php");
}
?>
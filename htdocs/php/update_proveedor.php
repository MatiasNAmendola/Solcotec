<? 
include "conexion.php";

$id_proveedor=$_POST['id'];
  $nombre=$_POST['nombre'];
   $direccion=$_POST['direccion'];
   $telefono=$_POST['telefono'];
   $mail=$_POST['mail'];
   $comentario=$_POST['comentario'];


// prueba de variables:
   
   
   
/*   echo "<br />";
   echo $nombre;
   echo "<br />";
   echo "<br />";
   
   echo "<br />";
   echo $direccion;
   echo "<br />";
   echo "<br />";
   
   echo "<br />";
   echo $telefono;
   echo "<br />";
   echo "<br />";
   
   echo "<br />";
   echo $mail;
   echo "<br />";
   echo "<br />";
   
   echo "<br />";
   echo $comentario;
   echo "<br />";
   echo "<br />";*/
   
   	

   
   
$consulta="UPDATE proveedor SET nombre = '$nombre', direccion = '$direccion', telefono = '$telefono', mail = '$mail', comentario = '$comentario' WHERE id_proveedor = '$id_proveedor';";
 
mysql_query ($consulta, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis</p>");
 

  
  header("Location: ../consulta_proveedor.php");
  mysql_free_result($consulta);
  include "cerrar_conexion.php";

?>

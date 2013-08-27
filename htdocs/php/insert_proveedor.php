<? 
include "conexion.php";

   $nombre=$_POST['nombre'];
   $direccion=$_POST['direccion'];
   $telefono=$_POST['telefono'];
   $mail=$_POST['mail'];
   $comentario=$_POST['comentario'];
   
   // prueba e variables:
   
   
   
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
   
   
$sql = "INSERT INTO `bodega`.`proveedor` (`id_proveedor`, `nombre`, `direccion`, `telefono`, `mail`, `comentario`) VALUES (NULL, '$nombre', '$direccion', '$telefono', '$mail', '$comentario');";



 mysql_query ($sql, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis</p>");
 mysql_free_result($sql);
 
 header("Location: ../ingreso_proveedor.php");

 include "cerrar_conexion.php";
?>

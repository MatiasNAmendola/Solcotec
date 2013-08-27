<? 
include "conexion.php";

   $nombre=$_POST['nombre'];
   $rut=$_POST['rut'];
   $telefono=$_POST['telefono'];
   $mail=$_POST['mail'];
   $direccion=$_POST['direccion'];
   $giro=$_POST['giro'];
   $comuna=$_POST['comuna'];
   $comentario=$_POST['comentario'];
   $vendedor_asignado=$_POST['vendedor_asignado'];
  
   
   
$sql = "INSERT INTO `bodega`.`proveedor` (`id_proveedor`, `nombre`, `rut`, `direccion`, `giro`, `comuna`, `telefono`, `mail`, `comentario`,`vendedor_asignado`) VALUES (NULL, '$nombre','$rut', '$direccion', '$giro', '$comuna', '$telefono', '$mail', '$comentario','$vendedor_asignado');";



 mysql_query ($sql, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis</p>");
 mysql_free_result($sql);
 
 header("Location: ../ingreso_proveedor.php");

 include "cerrar_conexion.php";
?>

<? 
include "conexion.php";

   $nombre=$_POST['nombre'];
   $rut=$_POST['rut'];
   $telefono=$_POST['telefono'];
   $direccion=$_POST['direccion'];
   
 $consulta= "INSERT INTO `bodega`.`vendedor` (`nombre`, `rut`, `telefono`, `direccion`) VALUES ('$nombre', '$rut', '$telefono', '$direccion');";

 mysql_query ($consulta, $conexion) or die (mysql_error());
 mysql_free_result($consulta);
 include "cerrar_conexion.php";
    
header("Location: ../consulta_vendedor.php");


?>

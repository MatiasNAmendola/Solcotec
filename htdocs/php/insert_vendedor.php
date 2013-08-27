<? 
include "conexion.php";

   $nombre=$_POST['nombre_vendedor'];
   $rut=$_POST['rut'];
   $telefono=$_POST['telefono_vendedor'];
   $direccion=$_POST['direccion_vendedor'];
   
 $consulta= "INSERT INTO `bodega`.`vendedor` (`nombre`, `rut`, `telefono`, `direccion`) VALUES ('$nombre', '$rut', '$telefono', '$direccion');";
  
 /*$consulta= "INSERT INTO `solcote1_miller`.`vendedor` (`nombre`, `rut`, `telefono`, `direccion`) VALUES ('$nombre', '$rut', '$telefono', '$direccion');";*/
 
header("Location: ../ingreso_vendedor.php");

 mysql_query ($consulta, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis</p>");
 mysql_free_result($consulta);
 include "cerrar_conexion.php";
?>

<? 
include "conexion.php";

$id_proveedor=$_POST['id'];
$nombre=$_POST['nombre'];
$rut=$_POST['rut'];
$telefono=$_POST['telefono'];
$mail=$_POST['mail'];
$direccion=$_POST['direccion'];
$giro=$_POST['giro'];
$comuna=$_POST['comuna'];
$comentario=$_POST['comentario'];
$vendedor_asignado=$_POST['vendedor_asignado'];
   
$consulta="UPDATE proveedor 
SET nombre = '$nombre',
rut = '$rut',
telefono = '$telefono',
mail = '$mail',
direccion = '$direccion',
giro = '$giro',
comuna = '$comuna',
comentario = '$comentario',
vendedor_asignado = '$vendedor_asignado'
WHERE id_proveedor = '$id_proveedor';";
 
mysql_query ($consulta, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis</p>");
 

  
  header("Location: ../consulta_proveedor.php");
  mysql_free_result($consulta);
  include "cerrar_conexion.php";

?>

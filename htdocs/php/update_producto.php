<? 
include "conexion.php";
   $id_producto=$_POST['id'];
   $codigo=$_POST['codigo_producto'];
   $nombre_producto=$_POST['nombre_producto'];
   $stock=$_POST['stock'];
   $precio_venta=$_POST['precio_venta'];
   $neto=$_POST['neto'];
   $marca=$_POST['marca'];
   $numero_serie=$_POST['numero_serie'];
   $proveedor=$_POST['proveedor'];
   $fecha=$_POST['fecha_ingreso'];
   $nuevafecha = date('Y-m-d', strtotime($fecha));// da vuelta la fecha para ser valida BD 
   $posicion=$_POST['posicion'];
   
   //echo $posicion;
 
   
   $cap_id="SELECT id_proveedor FROM proveedor WHERE nombre LIKE '$proveedor';";
     
   $resultado=mysql_query ($cap_id, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis</p>");
   $fila=mysql_fetch_assoc($resultado);
   $id_proveedor=$fila['id_proveedor'];

   
   
$consulta="UPDATE producto SET 
codigo_producto = '$codigo',
stock = '$stock',
marca = '$marca',
n_serie = '$numero_serie',
neto = '$neto',
p_venta = '$precio_venta',
fecha_ingreso = '$nuevafecha',
posicion = '$posicion',
nombre = '$nombre_producto',
id_proveedor='$id_proveedor'
    WHERE id_producto = '$id_producto';";
 
mysql_query ($consulta, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis 2</p>");
 

  
  header("Location: ../consulta_producto.php");
  mysql_free_result($consulta);
  include "cerrar_conexion.php";

?>

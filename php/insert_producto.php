<?
include "conexion.php";

   $codigo=strtoupper($_POST['codigo']);
   $nombre_producto=strtoupper($_POST['nombre_producto']);
   $stock=$_POST['cantidad'];
   $p_venta=$_POST['precio_venta'];
   $neto=$_POST['precio_compra'];
   $proveedor=strtoupper($_POST['proveedor']);
   $posicion=strtoupper($_POST['posicion']);
   $marca=strtoupper($_POST['marca']);
   $fecha=$_POST['fecha_ingreso'];
   $nuevafecha = date('Y-m-d', strtotime($fecha));// da vuelta la fecha para ser valida BD 
   $compatible = array();
   $compatible = strtoupper($_POST["compatible"]);
   
   

// en caso que la base de datos sea reseteada.
if($id_producto==0){
$id_producto=1;
}
mysql_free_result($resultado);



   
$sql = "INSERT INTO `bodega`.`producto` (`id_producto`, `codigo_producto`, `nombre`, `posicion`, `stock`, `neto`, `p_venta`, `proveedor`, `marca`, `fecha_ingreso`) VALUES (NULL, '$codigo', '$nombre_producto', '$posicion', '$stock', '$neto', '$p_venta', '$proveedor', '$marca', '$nuevafecha');";

mysql_query ($sql, $conexion) or die ("Fallo insert producto".mysql_error());
mysql_free_result($sql);


// Consulta para obtener id_producto que es igual a la cantidad de ids existentes.   
$consulta = "select max(id_producto) as nproductos from producto;";
$resultado=mysql_query ($consulta, $conexion) or die ("Fallo el nproductos :".mysql_error());
$fila=mysql_fetch_array($resultado);
$id_producto=$fila['nproductos'];

// insert compatibles con  id_producto asociado.

for($i=0;$i<4;$i++){
	
	
$insert_compatible="INSERT INTO `bodega`.`compatible`(`id_compatible`,`id_producto`,`nombre`) VALUES (NULL, '$id_producto', '$compatible[$i]') ;";
mysql_query($insert_compatible,$conexion) or die ("Fallo el insert compatible :".mysql_error());
}
include "cerrar_conexion.php";

header("Location: ../ingreso_producto.php");

?>

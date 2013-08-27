<? 
include "conexion.php";

   $nombre_cliente=strtoupper($_POST['nombre_cliente']);
   $rut=strtoupper($_POST['rut']);
   $telefono=$_POST['telefono'];
   $direccion=strtoupper($_POST['direccion']);
   $giro=strtoupper($_POST['giro']);
   $comuna=strtoupper($_POST['comuna']);
   $cod_vendedor=$_POST['nombre_vendedor'];
   $comentario_cliente=strtoupper($_POST['comentario_cliente']);
   $mail=strtoupper($_POST['mail']);   
   
       
   $cap_id="SELECT id_vendedor FROM vendedor WHERE nombre LIKE '$cod_vendedor';";
     
   $resultado=mysql_query ($cap_id, $conexion) or die (mysql_error());
   $fila=mysql_fetch_assoc($resultado);
   $id_vendedor=$fila['id_vendedor'];
	mysql_free_result($cap_id);   
   
   $verifica="SELECT nombre_cliente FROM cliente WHERE 	rut='$rut';";
   $respuesta=mysql_query($verifica,$conexion) or die (mysql_error());
   $fila=mysql_fetch_array($respuesta);

   
   
   
   
if(!$fila["nombre_cliente"]){


$consulta = "INSERT INTO `bodega`.`cliente` (`id_cliente`, `nombre_cliente`, `rut`, `telefono`, `direccion`, `giro`, `comuna`, `id_vendedor`, `comentario_cliente`,`mail`,`bloqueado`) VALUES (NULL, '$nombre_cliente', '$rut', '$telefono', '$direccion', '$giro', '$comuna', '$id_vendedor', '$comentario_cliente','$mail','0');";
mysql_query ($consulta, $conexion) or die (mysql_error());

mysql_free_result($consulta);
include "cerrar_conexion.php";
header("Location: ../ingreso_cliente.php"); 

}
   
   
   else{
	   echo "<h1>ya existe un cliente con el rut ingresado</h1>";
	   }

 
?>

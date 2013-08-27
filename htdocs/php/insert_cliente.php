<? 
include "conexion.php";

   $nombre_cliente=$_POST['nombre_cliente'];
   $rut=$_POST['rut'];
   $telefono=$_POST['telefono'];
   $direccion=$_POST['direccion'];
   $giro=$_POST['giro'];
   $comuna=$_POST['comuna'];
   $cod_vendedor=$_POST['nombre_vendedor'];
   $comentario_cliente=$_POST['comentario_cliente'];
   $mail=$_POST['mail'];
   
   
       
   $cap_id="SELECT id_vendedor FROM vendedor WHERE nombre LIKE '$cod_vendedor';";
     
   $resultado=mysql_query ($cap_id, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis 1</p>");
   $fila=mysql_fetch_assoc($resultado);
   $id_vendedor=$fila['id_vendedor'];
	mysql_free_result($cap_id);   
   
   $verifica="SELECT nombre_cliente FROM cliente WHERE 	rut='$rut';";
   $respuesta=mysql_query($verifica,$conexion) or die ("problemas sintaxis verifica rut");
   $fila=mysql_fetch_array($respuesta);
   echo $fila;
   echo '<br/>';
   echo $rut;
   
   
   /*
   
   if($respuesta!=NULL){
	   
	   
$consulta = "INSERT INTO `bodega`.`cliente` (`id_cliente`, `nombre_cliente`, `rut`, `telefono`, `direccion`, `giro`, `comuna`, `id_vendedor`, `comentario_cliente`,`mail`) VALUES (NULL, '$nombre_cliente', '$rut', '$telefono', '$direccion', '$giro', '$comuna', '$id_vendedor', '$comentario_cliente','$mail');";
  mysql_query ($consulta, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis</p>");

mysql_free_result($consulta);
  include "cerrar_conexion.php";
   }else{
	   echo "ya existe un cliente con el rut ingresado";
	   }*/
//header("Location: ../ingreso_cliente.php"); 

 
?>

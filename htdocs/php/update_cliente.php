<? 
include "conexion.php";
   $id_cliente=$_POST['ID'];
   $nombre_cliente=$_POST['nombre_cliente'];
   $rut=$_POST['rut'];
   $telefono=$_POST['telefono'];
   $direccion=$_POST['direccion'];
   $giro=$_POST['giro'];
   $comuna=$_POST['comuna'];
   $cod_vendedor=$_POST['cod_vendedor'];
   $comentario_cliente=$_POST['comentario_cliente'];
   $mail=$_POST['mail'];

   
   
   
   
   
      
   $cap_id="SELECT id_vendedor FROM vendedor WHERE nombre LIKE '$cod_vendedor';";
     
   $resultado=mysql_query ($cap_id, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis 1</p>");
   $fila=mysql_fetch_assoc($resultado);
   $id_vendedor=$fila['id_vendedor'];
   
   //echo $id_vendedor;
    $consulta="UPDATE  `bodega`.`cliente` SET  
`nombre_cliente` =  '$nombre_cliente',
`telefono` =  '$telefono',
`direccion` =  '$direccion',
`giro` =  '$giro',
`comuna` =  '$comuna',
`id_vendedor` =  '$id_vendedor',
`comentario_cliente` = '$comentario_cliente',
`mail` = '$mail' WHERE  `cliente`.`id_cliente` ='$id_cliente';
";

  mysql_query ($consulta, $conexion) or die ("<p> No se ha realizado la consulta, compruebe sintaxis 2</p>");
  header("Location: ../consulta_cliente.php");
  mysql_free_result($consulta);
  include "cerrar_conexion.php";

?>

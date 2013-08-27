<?
include "conexion.php";
// id de la orden a actualizar
$id_orden=$_POST["id_orden"];

//recoge datos del cliente.
$nombre_cliente=strtoupper($_POST['nombre_cliente']);
$rut=strtoupper($_POST['rut']);
$telefono=strtoupper($_POST['telefono']);
$direccion=strtoupper($_POST['direccion']);
$giro=strtoupper($_POST['giro']);
$comuna=strtoupper($_POST['comuna']);
$cod_vendedor=$_POST['cod_vendedor'];
$comentario_cliente=strtoupper($_POST['comentario_cliente']);
$mail=strtoupper($_POST['mail']);
   
///////////////// CAPTURO LAS VARIABLES PROPIAS DE LA ORDEN DE TRABAJO

$folio=$_POST['folio'];
$fecha=$_POST['fecha_ingreso'];
$nuevafecha = date('Y-m-d', strtotime($fecha));// da vuelta la fecha para ser valida BD 
$comentario_orden=strtoupper($_POST['comentario_orden']);
$nombre_contacto=strtoupper($_POST['nombre_contacto']);
$rut_contacto=strtoupper($_POST['rut_contacto']);
$id_vendedor=$_POST['id_vendedor'];


////////////////TRASFORMO LAS VARIABLES DE LOS PRODUCTOS INGRESADOS A ARREGLOS

$nombre = array();
$n_serie = array();
$n_serie_antiguo = array(); // necesario para hacer la busqueda de id de la maquina.
$estado = array();
$observaciones = array();
$id_maquina= array();


// Capturo las variables de la tabla factura x producto

$observaciones =array_filter($_POST['observaciones']); // capturo con esta funcion la descripcion_reparacion de las máquinas ingresadas no incluyendo los elementos vacios
$nombre= $_POST['nombre'];
$n_serie= $_POST['n_serie'];
$estado= $_POST['estado'];
$id_maquina= $_POST['id_maquina'];



// ver si el rut --> el cliente existe en la base de datos o no

$consulta = "select id_cliente from cliente where rut like '$rut';";
$resultado=mysql_query ($consulta, $conexion) or die (mysql_error());
$fila=mysql_fetch_array($resultado);
$id_cliente=$fila['id_cliente'];
mysql_free_result($resultado);



//////////////////////////////////////////////////////

if($id_cliente != NULL){ // si el rut fue encontrado...

$sql="UPDATE `cliente` SET
`nombre_cliente`='$nombre_cliente',
`rut`='$rut',
`telefono`='$telefono',
`direccion`='$direccion',
`giro`='$giro',
`comuna`='$comuna',
`id_vendedor`='$id_vendedor',
`comentario_cliente`='$comentario_cliente',
`mail`='$mail' WHERE `cliente`.`id_cliente` ='$id_cliente';";

mysql_query ($sql, $conexion) or die (mysql_error());
mysql_free_result($sql);



$sql="UPDATE `orden_trabajo` SET
`id_cliente` = '$id_cliente',
`fecha` = '$nuevafecha',
`observaciones` = '$comentario_orden',
`id_vendedor` = '$id_vendedor',
`nombre_contacto` = '$nombre_contacto',
`rut_contacto` = '$rut_contacto' 
 WHERE `id_ot` = '$id_orden';";

mysql_query ($sql, $conexion) or die (mysql_error());
mysql_free_result($sql);
}




else{
$consulta = "INSERT INTO `bodega`.`cliente` (`id_cliente`, `nombre_cliente`, `rut`, `telefono`, `direccion`, `giro`, `comuna`, `id_vendedor`, `comentario_cliente`,`mail`) VALUES (NULL, '$nombre_cliente', '$rut', '$telefono', '$direccion', '$giro', '$comuna', '$id_vendedor', '$comentario_cliente','$mail');";
  mysql_query ($consulta, $conexion) or die (mysql_error());
mysql_free_result($consulta);

$sql="UPDATE `orden_trabajo` SET
`id_cliente` = '$id_cliente',
`fecha` = '$nuevafecha',
`observaciones` = '$comentario_orden',
`id_vendedor` = '$id_vendedor',
`nombre_contacto` = '$nombre_contacto',
`rut_contacto` = '$rut_contacto' 
 WHERE `id_ot` = '$id_orden';";


mysql_query ($sql, $conexion) or die (mysql_error());
mysql_free_result($sql);

}


///// veo cuantos productos fueron ingresados

$tope=count($id_maquina);
$tipo=0; // tipo de maquina ingresada, 0 significa maquina ingresada para reparacion, 1 significa maquina ingresada para venta


for($i=0;$i<$tope;$i++){

switch($estado[$i]){
case 'COTIZANDO':
$estado[$i]=1;
break;

case 'ACEPTADA':
$estado[$i]=2;
break;

case 'REPARADA':
$estado[$i]=3;
break;

case 'RECHAZADA':
$estado[$i]=0;
break;
}

//CONSULTA MAQUINA EXISTENTE:


$sql = "select `id_maquina` FROM maquina WHERE `id_maquina`='$id_maquina[$i]';";
$encontrado_idmaquina=mysql_query ($sql, $conexion) or die (mysql_error().' CONSULTA ID MAQUINA EXISTENTE.');
$fila2=mysql_fetch_array($encontrado_idmaquina);
$id_encontrado=$fila2['id_maquina'];
mysql_free_result($encontrado_idmaquina);

if($encontrado_idmaquina!=NULL){ // SI LA MAQUINA EXISTE
echo 'aca toy';
//UPDATE DE CADA MÁQUINA
$sql="UPDATE `maquina` SET
`estado`= UPPER('$estado[$i]'),
`nombre`= UPPER('$nombre[$i]'),
`n_serie`= UPPER('$n_serie[$i]'),
`descripcion`= UPPER('$observaciones[$i]')
WHERE `id_maquina`='$id_maquina[$i]';";

mysql_query($sql, $conexion) or die ('(ERROR UPDATE MAQUINA )'.mysql_error());
mysql_free_result($sql);
}
	
else{

//INSERT DE CADA MÁQUINA
$sql1 = "INSERT INTO `bodega`.`maquina` (`id_maquina`, `tipo`,`nombre`, `n_serie`, `estado`, `descripcion`,`id_ot`,`id_fc`,`id_producto`,`dias_garantia`) VALUES (NULL,'$tipo','$descripcion_maquina[$i]','$n_serie[$i]','$estado_maquina', '$observaciones[$i]','$id_ot','','','');";


mysql_query($sql1, $conexion) or die ('error insert maquina nueva'.mysql_error());
mysql_free_result($sql1);
}

}// fin for

include "../cerrar_conexion.php";
header("Location: ../consulta_maquinas_reparacion.php"); 

?>
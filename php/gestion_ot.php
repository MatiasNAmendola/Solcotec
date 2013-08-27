<?
include "conexion.php";
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
///////////////// CAPTURO LAS VARIABLES PROPIAS DE LA OT

$folio=$_POST['folio'];

$fecha=$_POST['fecha_ingreso'];
$nuevafecha = date('Y-m-d', strtotime($fecha));// da vuelta la fecha para ser valida BD 
$comentario_orden=strtoupper($_POST['comentario_orden']);
$nombre_contacto=strtoupper($_POST['nombre_contacto']);
$rut_contacto=strtoupper($_POST['rut_contacto']);
// capturar id vendedor:

$con = "select id_vendedor from vendedor where nombre like '$cod_vendedor';";

$resul=mysql_query ($con, $conexion) or die ('1'.mysql_error());

$fi=mysql_fetch_array($resul);
$id_vendedor=$fi['id_vendedor'];
mysql_free_result($con);// libera variable que contenia la consulta.


////////////////TRASFORMO LAS VARIABLES DE LOS PRODUCTOS INGRESADOS A ARREGLOS



$n_serie = array();
$descripcion_maquina = array();
$observaciones= array();

// Capturo las variables de la tabla factura x producto

$descripcion_maquina = array_filter($_POST['descripcion_maquina'])	; // la descripcion_reparacion de las máquinas no incluyendo elementos vacios
$n_serie=$_POST['n_serie'];
$observaciones=$_POST['observaciones'];

// ver si el rut --> el cliente existe en la base de datos o no

$consulta = "select id_cliente from cliente where rut like '$rut';";

$resultado=mysql_query ($consulta, $conexion) or die ('2'.mysql_error());

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

mysql_query ($sql, $conexion) or die ('3'.mysql_error());
mysql_free_result($sql);


$sql = "INSERT INTO `orden_trabajo`(`id_ot`, `folio_ot`, `id_cliente`,`fecha`,`observaciones`,`id_vendedor`,`nombre_contacto`,`rut_contacto`) VALUES (NULL,'$folio','$id_cliente','$nuevafecha','$comentario_orden','$id_vendedor','$nombre_contacto','$rut_contacto');";
mysql_query ($sql, $conexion) or die ('4 '.mysql_error());
mysql_free_result($sql);
}




else{
$sql = "INSERT INTO `bodega`.`cliente` (`id_cliente`, `nombre_cliente`, `rut`, `telefono`, `direccion`, `giro`, `comuna`, `id_vendedor`, `comentario_cliente`,`mail`) VALUES (NULL, '$nombre_cliente', '$rut', '$telefono', '$direccion', '$giro', '$comuna', '$id_vendedor', '$comentario_cliente','$mail');";
mysql_query ($sql, $conexion) or die ('5'.mysql_error());
mysql_free_result($sql);


$consulta="SELECT max(id_cliente) as idmaximo FROM cliente";
$max_id = mysql_query ($consulta, $conexion) or die ('5.5'.mysql_error());
$madero = mysql_fetch_array($max_id);
$id_cliente_max= $madero["idmaximo"];

$sql = "INSERT INTO `orden_trabajo`(`id_ot`, `folio_ot`, `id_cliente`,`fecha`, `observaciones`,`id_vendedor`,`nombre_contacto`,`rut_contacto`)
VALUES(NULL,'$folio','$id_cliente_max','$nuevafecha','$comentario_orden','$id_vendedor','$nombre_contacto','$rut_contacto')";


mysql_query ($sql, $conexion) or die ('6'.mysql_error());
mysql_free_result($sql);

}




// capturar el ultimo id de orden de compra


$sql = "select max(id_ot) as memo from orden_trabajo ;";

$blue=mysql_query ($sql, $conexion) or die ('7'.mysql_error());

$white=mysql_fetch_array($blue);

$id_ot=$white['memo'];

mysql_free_result($sql);
///// veo cuantos productos fueron ingresados

$tope=count($n_serie);
$tipo=1; // tipo de maquina ingresada, 0 significa maquina ingresada para reparacion, 1 significa maquina ingresada para venta
$estado_maquina=1;// estado de la maquina , por defecto será 1 que significa ingresada y cotizando, 2 significa aceptado presupuesto- reparando y 3 significa reparada, 0 significa rechazada.
for($i=0;$i<$tope;$i++){
	
	$descripcion_maquina[$i]=strtoupper($descripcion_maquina[$i]);
	$n_serie[$i]=strtoupper($n_serie[$i]);
	$observaciones[$i]=strtoupper($observaciones[$i]);
	
	
//INSERT DE CADA MÁQUINA
	$sql1 = "INSERT INTO `bodega`.`maquina` (`id_maquina`, `tipo`,`nombre`, `n_serie`, `estado`, `descripcion`,`id_ot`,`id_fc`,`id_producto`,`dias_garantia`) VALUES (NULL,'$tipo','$descripcion_maquina[$i]','$n_serie[$i]','$estado_maquina', '$observaciones[$i]','$id_ot','','','');";
	

mysql_query($sql1, $conexion) or die ('8'.mysql_error());
mysql_free_result($sql1);
}

include "../cerrar_conexion.php";

header("Location: ../orden_trabajo.php"); 

?>
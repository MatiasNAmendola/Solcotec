<?
include"php/valida.php";
?>
<!DOCTYPE HTML>
<html lang="es"> <!--la indexacion es mas rapida-->
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/estructura.css" />
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.9.2.custom.css" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<title>Visualizacion Documento</title>

</head>

<body>    

<div id="contenido">

<? echo $nav;?>

<header>  
<a id="cerrar" href="php/logout.php">Cerrar Sesión</a>
 <? echo $logo;?>


<a class="ninguno" href="../consulta_orden_trabajo.php"><div id="boton_gigante"><div id="interrogacion">?</div><div id="texto_botongrande">Ordenes<br/>Emitidas</div></div></a>
<a class="ninguno" href="orden_trabajo.php"><div id="boton_gigante" style="width:9em; margin-right:1em"><div id="asterisco">*</div><div id="texto_botongrande">Nueva<br/>Orden</div></div></a>

 </header>

<?
include "php/conexion.php";
$id_orden=$_POST['id'];

$resultado=mysql_query("select orden_trabajo.folio_ot,orden_trabajo.id_ot,orden_trabajo.fecha,orden_trabajo.observaciones,cliente.nombre_cliente,cliente.rut,cliente.telefono,cliente.direccion,cliente.giro,cliente.comuna,cliente.comentario_cliente,cliente.mail,vendedor.nombre from orden_trabajo,cliente,vendedor where orden_trabajo.id_ot='$id_orden' AND cliente.id_cliente=orden_trabajo.id_cliente AND vendedor.id_vendedor=cliente.id_vendedor;") or die (mysql_error()); //captura todos los datos de la orden.
$datos_orden=mysql_fetch_array($resultado);
$id_vendedor=$datos_orden["id_vendedor"];
$id_orden=$datos_orden["id_ot"];
?>

<h1>Orden de Trabajo Emitida [ <span style="color: #E1001D">FOLIO Nº <? echo $datos_orden["folio_ot"]; ?></span> ]</h1>
<h2>Aquí podrá modificar un registro del ingreso de máquinas a reparar.</h2>

<form>

<div id="formulario">

<div class="columna">

<div class="ingreso">
<p>Nombre Cliente:</p> 
<label for="nombre_cliente"></label>
<textarea name="nombre_cliente" id="nombre_cliente" cols="45" rows="5" readonly/><? echo $datos_orden["nombre_cliente"] ?></textarea>
</div>

<div class="ingreso">
<p>Rut:</p> 
<label for="rut"></label>
<input name="rut" type="text" class="campo" id="rut" value="<? echo $datos_orden["rut"] ?>" readonly />
</div>

<div class="ingreso">
<p>Teléfono:</p> 
<label for="telefono"></label>
<input name="telefono" type="text" class="campo" id="telefono" value="<? echo $datos_orden["telefono"] ?>" readonly/>
</div>


<div class="ingreso">
<p>Email:</p> 
<label for="mail"></label>
<input type="email" id="mail" name="mail" placeholder="usuario@ejemplo.com" class="campo" value="<? echo $datos_orden["mail"] ?>" readonly/>
</div>

</div> <!--termina div columna 1-->


<div class="columna">


<div class="ingreso">
<p>Dirección:</p> 
<label for="direccion"></label>
<textarea name="direccion" id="direccion" cols="45" rows="5" readonly><? echo $datos_orden["direccion"] ?></textarea>
</div>
<div class="ingreso">
<p>Comúna:</p> 
<label for="comuna"></label>
<input name="comuna" type="text" class="campo" id="comuna" placeholder="Santiago" value="<? echo $datos_orden["comuna"] ?>" readonly/>
</div>

<div class="ingreso">
<p>Giro Empresa:</p> 
<label for="giro"></label>
<textarea name="giro" id="giro" cols="45" rows="5" readonly><? echo $datos_orden["giro"] ?></textarea>
</div>



</div> <!--termina div columna 2-->


   <div class="ingreso">
    <p>Vendedor Asignado:</p> 
	<label for="cod_vendedor"></label>
	<select name="cod_vendedor" id="cod_vendedor" disabled>

	<?
	$nombre_vendedor=$datos_orden["nombre"];
	$resultado=mysql_query("select nombre from vendedor where nombre != '$nombre_vendedor'") or die(mysql_error());
	echo '<option>'.$nombre_vendedor.'</option>';
	while ($fila=mysql_fetch_array($resultado)){	
	echo '<option>'.$fila["nombre"].'</option>'; 
	}
	echo '</select>';
	mysql_free_result($resultado);
	?>
	</div>
    

<div class="ingreso">
<p>Comentarios Cliente:</p> 
<label for="comentario_cliente"></label>
<textarea name="comentario_cliente" id="comentario_cliente" cols="45" rows="5" readonly><? echo $datos_orden["comentario_cliente"] ?></textarea>
</div>

<? //  DA VUELTA LA FECHA QUE VIENE DE LA BD.
$fecha=$datos_orden["fecha"];
$fecha= date('d-m-Y', strtotime($fecha));// da vuelta la fecha para ser valida BD 
?>
<div class="ingreso">
<p>Fecha de Emision Orden:</p><input type="text" class="campo" name="fecha_ingreso" id="fecha_ingreso" value="<? echo $fecha ?>" readonly/>
</div>



 
</div><!--fin div formulario-->

<h1>Identificación de Máquinas y Observaciónes</h1>
<div id="linea"></div>

<table id="tabla_productos">


<tbody>
  <?
  
  	$resultado=mysql_query("select n_serie,nombre, estado,descripcion from maquina where id_ot='$id_orden' ") or die(mysql_error());
while ($datos_maquina=mysql_fetch_array($resultado))
{
  ?>
           
<tr class="tr_sinfondo fila_descripcion">
<td class="td_maquina">Nº Serie</td><td class="td_maquina">Descripción Máquina</td><td class="td_maquina">Estado</td>
</tr>

<tr class="tr_sinfondo"> 
<td class="tabla" id="td_cantidad"><input id="n_serie" name="n_serie[]" type="text" class="tabla campo cantidad" value="<? echo $datos_maquina["n_serie"]?>"   readonly/>
</td>

<td class="tabla"><input id="nombre" name="nombre[]" type="text" class="tabla campo codigo" value="<? echo $datos_maquina["nombre"]?>" readonly/></td>
<?
$estado=$datos_maquina["estado"];
switch($estado){
case 1:
$estado='COTIZANDO';
break;

case 2:
$estado='ACEPTADA';
break;

case 3:
$estado='REPARADA';
break;

case 5:
$estado='EN GARANTÍA';
break;

case 0:
$estado='RECHAZADA';
break;
}

$estados=array('COTIZANDO','ACEPTADA','REPARADA','RECHAZADA');

?>

<td id="td_estado" class="tabla" ><select id="estado" name="estado[]" class="tabla campo estado" disabled><option><? echo $estado?></option>
<?
for($i=0;$i<4;$i++){
if($estado!=$estados[$i]){
echo '<option>'.$estados[$i].'</option>';
}

}
?>
</select></td>

</tr>
<tr class="tr_sinfondo fila_descripcion">
<td class="td_maquina td_detalle">Observaciones</td>
<td colspan="4"><textarea id="observaciones" name="observaciones[]" type="text" class="tabla descripcion_maquina" placeholder="Detalle de problemas de la máquina, si trae accesorios, daños visibles, observaciónes en general." readonly><? echo $datos_maquina["descripcion"]?></textarea></td>

</tr>
<?
}
?> 
</tbody>
</table>

<div class="linea_superior"></div>
<h1>Comentarios</h1>
<textarea id="comentario_orden" name="comentario_orden" class="supertextarea" placeholder="Persona que entrega la maquina, telefono de contacto, direcciones, observaciones en general." readonly><? echo $datos_orden["observaciones"] ?></textarea>
</form>
<?
mysql_free_result($resultado);
include"php/cerrar_conexion.php";
?>
    
</div><!--fin CONTENIDO-->
<div id="pie"></div>
</html>
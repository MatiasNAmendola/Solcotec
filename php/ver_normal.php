
<h1>Factura de Venta Emitida [ <strong style="color:#CC0000">FOLIO Nº <? echo $datos_factura["folio"] ?></strong> ]</h1>
<h2>A continuación se muestra el detalle de la factura emitida.</h2>

<div id="formulario">

<?
$resultado2=mysql_query("select nombre from vendedor where id_vendedor='$id_vendedor'; ") or die (mysql_error()); //
$fila2=mysql_fetch_array($resultado2);
$nombre_vendedor=$fila2["nombre"];
mysql_free_result($resultado2);

$id_cliente=$datos_factura["id_cliente"];
$resultado3=mysql_query("select * from cliente where id_cliente='$id_cliente'; ") or die (mysql_error());
$fila3=mysql_fetch_array($resultado3);



$resultado4=mysql_query("select producto.codigo_producto,factura_x_producto.detalle, factura_x_producto.cantidad, factura_x_producto.precio_venta, factura_x_producto.precio_final, factura_x_producto.descuento, factura_x_producto.id_producto, factura_x_producto.detalle, factura_x_producto.id_fv, factura_x_producto.n_serie from factura_x_producto, producto where factura_x_producto.id_fv='$id_factura' AND producto.id_producto=factura_x_producto.id_producto;") or die (mysql_error());

$resultado5=mysql_query("SELECT * FROM pago WHERE id_factura='$id_factura';") or die (mysql_error());
$datos_pago=mysql_fetch_array($resultado5);
?>

<div class="columna">

<div class="ingreso">
<p>Nombre Cliente:</p> 
<textarea name="nombre_cliente" id="nombre_cliente" cols="45" rows="5" readonly="readonly"/><? echo $fila3["nombre_cliente"] ?></textarea>
</div>

<div class="ingreso">
<p>Rut:</p> 
<input name="rut" type="text" class="campo" id="rut" value="<? echo $fila3["rut"] ?>" readonly="readonly"/>
</div>

<div class="ingreso">
<p>Teléfono:</p> 
<input name="telefono" type="text" class="campo" id="telefono"  value="<? echo $fila3["telefono"] ?>"readonly="readonly"/>
</div>


<div class="ingreso">
<p>Email:</p> 
<input type="email" id="mail" name="mail" placeholder="usuario@ejemplo.com" class="campo" value="<? echo $fila3["mail"] ?>"readonly="readonly"/>
</div>





</div> <!--termina div columna 1-->


<div class="columna">

<div class="ingreso">
<div class="ingreso">
<p>Dirección:</p> 
<textarea name="direccion" id="direccion" cols="45" rows="5" readonly="readonly"><? echo $fila3["direccion"] ?></textarea>
</div>

<p>Comúna:</p> 
<input name="comuna" type="text" class="campo" id="comuna" placeholder="Santiago" value="<? echo $fila3["comuna"] ?>" readonly="readonly"/>
</div>

<div class="ingreso">
<p>Giro Empresa:</p> 
<textarea name="giro" id="giro" cols="45" rows="5" readonly="readonly"><? echo $fila3["giro"] ?></textarea>
</div>

<div class="ingreso">
<p>Vendedor Asignado:</p> 
<select name="nombre_vendedor" id="nombre_vendedor" disabled="disabled">
<option><? echo $nombre_vendedor;?></option>
</select>
</div>




</div> <!--termina div columna 2-->

<div class="ingreso">
<p>Comentarios Cliente:</p> 
<textarea name="comentario_cliente" id="comentario_cliente" cols="45" rows="5" readonly="readonly"><? echo $fila3["comentario_cliente"] ?></textarea>
</div>	

<? //  DA VUELTA LA FECHA QUE VIENE DE LA BD.
$fecha=$datos_factura["fecha"];
$nuevafecha = date('d-m-Y', strtotime($fecha));// da vuelta la fecha para ser valida BD 
?>

<div class="ingreso">
<p>Fecha de Emisión Factura:</p> 
<input name="fecha_ingreso" type="text" id="fecha_ingreso" class="campo" value="<? echo $nuevafecha?>" readonly="readonly"/>
</div>


<? $tipo_documento=$datos_factura["tipo_documento"];
switch($tipo_documento){

case "1":
$tipo_documento="Orden de Compra";
$otro="Guía de Despacho";
break;

case "2":
$tipo_documento="Guía de Despacho";
$otro="Orden de Compra";
break;
} ?>

<div class="ingreso">
<p>Documento Relacionado:</p> 
<select id="tipo_documento" name="tipo_documento" disabled="disabled">
<option selected><? echo $tipo_documento?></option>
<option><? echo $otro?></option>
</select>
</div> 
<div class="ingreso">
<input type="text" id="doc" name="documento_rel" placeholder="# del documento" class="campo" value="<? echo $datos_factura["documento_rel"]?>" readonly="readonly"/>
</div>



</div><!--fin div formulario-->


<table id="tabla_productos">
<tbody>
<?
while ($fila4=mysql_fetch_array($resultado4))
{
?>

<tr class="tr_sinfondo fila_descripcion">
<td class="td_maquina td_detalle">Detalle</td>
<td colspan="5"><textarea id="detalle" name="detalle[]" type="text" class="tabla descripcion_maquina" placeholder="busca aquí..." readonly="readonly"><? echo $fila4['detalle']?></textarea></td>
</tr>

<tr class="tr_sinfondo fila_descripcion">
<td class="td_maquina">Cant.</td><td class="td_maquina">Código</td><td class="td_maquina">Nº Serie</td><td class="td_maquina">V.Unitario</td><td class="td_maquina">Desc.</td><td class="td_maquina">Final</td>
</tr>

<tr class="tr_sinfondo"> 
<td class="tabla" id="td_cantidad"><input id="cantidad" name="cantidad[]" type="number" class="tabla campo cantidad" onChange="subtotal_fila(),calculo_neto()" value="<? echo $fila4['cantidad']?>" readonly="readonly"/></td>

<td class="tabla"><input id="codigo" name="codigo[]" type="text" class="tabla campo codigo" value="<? echo $fila4['codigo_producto']?>" readonly="readonly"/></td>

<td class="tabla"><input name="n_serie[]" type="text" class="tabla campo" value="<? echo $fila4['n_serie']?>" readonly="readonly"/></td>


<td class="tabla"><input id="precio_unitario" name="precio_unitario[]"    type="text"   class="tabla campo precio_unitario" onChange="subtotal_fila(),calculo_neto()" value="<? echo $fila4['precio_venta']?>" readonly="readonly"/></td>

<td class="tabla"><input id="descuento" name="descuento[]" type="text" class="tabla campo" onChange="subtotal_fila(),calculo_neto()" value="<? echo $fila4['descuento']?>" readonly="readonly"/></td> 

<td class="tabla"><input id="sub_total" name="precio_final[]"  type="text" class="tabla campo final" value="<? echo $fila4['precio_final']?>" readonly="readonly"/></td> 
</tr>
<?
}
?> 

</tbody>
</table>
<p>COMENTARIO FACTURA:</p>
<textarea id="comentario_factura" name="comentario_factura" class="supertextarea" placeholder="ingrese un comentario sobre la factura." readonly="readonly"><? echo $datos_factura["comentario_factura"]?></textarea>

<div id="linea" style="width:100%; border:0.1em solid grey; font-size:10px;"></div>




<div id="pago_factura">
<h1>PAGO FACTURA</h1>
<h2 style="color:#006; margin-bottom:0.7em;">Estos son los detalles del pago realizado.</h2>

<?
if($datos_factura['no_pago']==1){
$no_pago='&#x2713';
$fecha_emision=floor(strtotime($datos_factura['fecha'])/86400);
$fecha_actual=floor(strtotime(date("d-m-Y"))/86400);
$dias_trascurridos=$fecha_actual-$fecha_emision;
$plazo_dias=$datos_factura['plazo_dias'];
$plazo_actual=$plazo_dias-$dias_trascurridos;

echo'
<div id="div_nopago">

<div id="checkbox_nopago" class="float_left" onClick="checkbox_verde(), habilitar()">'.$no_pago.'</div>
<input id="no_pago" type="hidden" name="no_pago" value="0"/>
<p class="float_left" id="text_nopago">NO Pago</p>

<input type="number" name="plazo_dias" id="dias_plazo" class="campo float_left " placeholder="(en dias)" value="'.$plazo_actual.'" class="float_left" disabled/>
<p id="text_nopago2" style="line-height:1.1em;">Días de Plazo Restantes</p> 

</div><!--fin div no pago-->';
}

if($datos_factura['no_pago']==0){


$fecha_documento=date("d-m-Y",strtotime($datos_pago["fecha_documento"]));

switch($datos_pago["forma_pago"]){
case 1:
$forma_pago='Efectivo';
break;

case 2:
$forma_pago='Cheque';
break;

case 3:
$forma_pago='Vale Vista';
break;
}	
echo '
<div class="columna">
<div class="ingreso">
<p class="des">Forma de Pago:</p>
<select id="condiciones" name="condiciones"  class="campo des" disabled="disabled">
<option>'.$forma_pago.'</option>

</select>
</div>

<div class="ingreso">
<p class="p_pagar des">Nº Serial del Documento:</p>
<input id="n_documento" name="n_documento" type="text" class="campo pago des" value="'.$datos_pago["n_documento"].'" readonly="readonly"/>
</div><!--fin ingreso-->

</div><!--fin columna-->        

<div class="ingreso">
<p class="p_pagar des">Fecha Pago del Documento:</p>
<input id="fecha_documento" name="fecha_documento" type="text" class="campo pago des" value="'.$fecha_documento.'" readonly="readonly"/>
</div><!--fin ingreso-->

<div class="ingreso">
<p class="p_pagar des">Banco del Documento:</p>
<input id="banco_documento" name="banco_documento" type="text" class="campo pago des" value="'.$datos_pago["banco_documento"].'" readonly="readonly"/>
</div>

<div class="ingreso">
<p class="p_pagar des">Detalle Pago:</p>
<textarea id="comentario_pago" name="comentario_pago" style="margin-bottom:0.5em" class="des" readonly="readonly" >'.$datos_pago["comentario_pago"].'</textarea>
</div><!--fin ingreso-->';}

?>
</div><!--fin pago_factura-->

<div id="totales">
<span id="titulo_totales">TOTALES</span>
<div class="ingreso">
<p>SUB TOTAL :</p><input id="total_neto" name="total_neto" class="campo" value="<? echo $datos_factura['total_neto']?>"readonly/>
</div>

<div class="ingreso">
<p>DESCUENTO X FACTURA :</p><input id="porcentaje_descuento" name="porcentaje_descuento" class="campo" value="<? echo $datos_factura['porcent_fact']?>"/>
</div>

<div class="ingreso">
<p>NETO:</p><input id="total_descuento"  name="total_descuento" class="campo" value="<? echo $datos_factura['total_descuento']?>" readonly/>
</div>

<div class="ingreso">
<p>IVA (19%) :</p><input id="total_iva" name="total_iva" class="campo" value="<? echo $datos_factura['total_iva']?>" readonly/>
</div>

<div class="ingreso">
<p>TOTAL FINAL :</p><input id="total_final" name="total_final" class="campo" style="font-weight:bolder" readonly onChange="compara()" value="<? echo $datos_factura['total_final']?>"/>
</div>


</div><!--fin totales-->
<?
mysql_free_result($resultado3);
mysql_free_result($resultado4);
mysql_free_result($resultado);
include"php/cerrar_conexion.php";
?>
</div><!--fin contenido-->

<div id="pie"></div>
</body>
</html>
<table>

<thead>

<tr>
<th>Vendedor</th>
<th>Cliente</th>
<th>Tipo</th>
<th>Folio</th>
<th>$ Final</th>

</tr>
</thead>

<tbody>
<? while($datos_listado=mysql_fetch_array($resultado_2)){ ?>

<tr>
<td><? echo $datos_listado["nombre"] ?></td>
<td><? echo $datos_listado["nombre_cliente"] ?></td>
<td class="center"><? echo $datos_listado["tipo_factura"] ?></td>
<td class="center"><? echo $datos_listado["folio"] ?></td>
<td class="center"><? echo $datos_listado["total_final"] ?></td>

</tr>
</tbody>
<?


}// fin while?>
</table>

<?

//defino una clase que voy a utilizar para generar los elementos sugeridos en autocompletar
class ElementoAutocompletar {
	var $value;
	var $label;
	var $nombre;
	var $codigo_producto;
	var $p_venta;
	
	
	   
   function __construct($label, $value, $nombre, $codigo_producto, $p_venta){
      $this->label = $label;
      $this->value = $value;
	  $this->nombre = $nombre;
	  $this->codigo_producto = $codigo_producto;
	  $this->p_venta = $p_venta;
   }
}

//recibo el dato que deseo buscar sugerencias
$datoBuscar = trim(strip_tags($_GET['term']));

//conecto con una base de datos
$conexion = mysql_connect("localhost", "root", "root");
mysql_select_db("bodega");

//busco un valor aproximado al dato escrito
$ssql = "select nombre, codigo_producto, p_venta, stock, marca  from producto where nombre like '%" . $datoBuscar . "%'";
$rs = mysql_query($ssql);

//creo el array de los elementos sugeridos
$arrayElementos = array();

//bucle para meter todas las sugerencias de autocompletar en el array
while ($fila = mysql_fetch_array($rs)){
	
   array_push($arrayElementos, new ElementoAutocompletar($fila["nombre"]." - Stock: [".$fila["stock"]."]"." - Marca: [".$fila["marca"]."]", $fila["nombre"]." , Marca: ".$fila["marca"],$fila["codigo_producto"],$fila["p_venta"]));
}

print_r(json_encode($arrayElementos));

?>
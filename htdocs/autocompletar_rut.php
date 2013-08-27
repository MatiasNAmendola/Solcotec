<?

//defino una clase que voy a utilizar para generar los elementos sugeridos en autocompletar
class ElementoAutocompletar {
	var $value;
	var $label;
	var $nombre_cliente;
	var $telefono;
	var $direccion;
	var $giro;
	var $comuna;
	var $cod_vendedor;
   
   function __construct($label, $value, $nombre_cliente, $telefono, $direccion, $giro, $comuna, $cod_vendedor){
      $this->label = $label;
      $this->value = $value;
	  $this->nombre_cliente = $nombre_cliente;
	  $this->telefono = $telefono;
	  $this->direccion = $direccion;
	  $this->giro = $giro;
	  $this->comuna = $comuna;
	  $this->cod_vendedor = $cod_vendedor;

   }
}

//recibo el dato que deseo buscar sugerencias
$datoBuscar = trim(strip_tags($_GET['term']));

//conecto con una base de datos
$conexion = mysql_connect("localhost", "root", "root");
mysql_select_db("bodega");

//busco un valor aproximado al dato escrito
$ssql = "select rut, nombre_cliente, telefono, direccion, giro, comuna, id_vendedor  from cliente where rut like '" . $datoBuscar . "%'";
$rs = mysql_query($ssql);

//creo el array de los elementos sugeridos
$arrayElementos = array();

//bucle para meter todas las sugerencias de autocompletar en el array
while ($fila = mysql_fetch_array($rs)){
	
   array_push($arrayElementos, new ElementoAutocompletar($fila["rut"], $fila["rut"],$fila["nombre_cliente"],$fila["telefono"],$fila["direccion"],$fila["giro"],$fila["comuna"],$fila["id_vendedor"]));
}

print_r(json_encode($arrayElementos));

?>
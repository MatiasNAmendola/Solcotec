<?

//defino una clase que voy a utilizar para generar los elementos sugeridos en autocompletar
class ElementoAutocompletar {
	var $value;
	var $label;
	var $nombre;
	var $n_serie;
	var $id_maquina;
	
   function __construct($label, $value, $nombre, $n_serie, $id_maquina){
      $this->label = $label;
      $this->value = $value;
	  $this->nombre = $nombre;
	  $this->n_serie = $n_serie;
	  $this->id_maquina = $id_maquina;
   }
}

//recibo el dato que deseo buscar sugerencias
$datoBuscar = trim(strip_tags($_GET['term']));

include "php/conexion.php";

//busco un valor aproximado al dato escrito
$ssql = "SELECT orden_trabajo.folio_ot, maquina.nombre, maquina.n_serie, maquina.id_maquina FROM orden_trabajo, maquina WHERE orden_trabajo.folio_ot like '%" .$datoBuscar. "%' AND maquina.id_ot = orden_trabajo.id_ot ;";
$rs = mysql_query($ssql);


//creo el array de los elementos sugeridos
$arrayElementos = array();

//bucle para meter todas las sugerencias de autocompletar en el array
while ($fila = mysql_fetch_array($rs)){
	
   array_push($arrayElementos, new ElementoAutocompletar('['.$fila["n_serie"].'] - '.$fila["nombre"], 'Nº OT: '.$fila["folio_ot"],'REPARACIÓN '.$fila["nombre"],$fila["n_serie"],$fila["id_maquina"]));
}

print_r(json_encode($arrayElementos));
include "php/cerrar_conexion.php";
?>
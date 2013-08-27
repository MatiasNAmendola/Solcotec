<?
// Data could be pulled from a DB or other source
$cities = mysql_query("select nombre_cliente, comuna, telefono from cliente where nombre_cliente like '%" . $datoBuscar . "%'");	
 
// Cleaning up the term
$term = trim(strip_tags($_GET['term']));
 
// Rudimentary search
$matches = array();
foreach($cities as $city){
	if(stripos($city['city'], $term) !== false){
		// Add the necessary "value" and "label" fields and append to result set
		$city['value'] = $city['city'];
		$city['label'] = "{$city['city']}, {$city['state']} {$city['zip']}";
		$matches[] = $city;
	}
}
 
// Truncate, encode and return the results
$matches = array_slice($matches, 0, 5);
print json_encode($matches);

?>
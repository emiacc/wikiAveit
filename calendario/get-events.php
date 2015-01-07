<?php
require dirname(__FILE__) . '/utils.php';
if (!isset($_GET['start']) || !isset($_GET['end'])) {
	die("Please provide a date range.");
}
$grupo = $_GET['grupo'];
$sub = $_GET['sub'];
$range_start = parseDateTime($_GET['start']);
$range_end = parseDateTime($_GET['end']);
$timezone = null;
if (isset($_GET['timezone'])) {
	$timezone = new DateTimeZone($_GET['timezone']);
}
$json = '[';
$conexion=mysql_connect("localhost","root","");
mysql_query("SET NAMES 'utf8'");
mysql_select_db("calendario",$conexion);
//$conexion=mysql_connect("mysql.tuars.com","u601393476_calen","35578261emi");
//mysql_query("SET NAMES 'utf8'");
//mysql_select_db("u601393476_calen",$conexion);
//$registros=mysql_query("SELECT e.id,e.titulo,e.fecha_inicio,e.hora_inicio,e.fecha_fin,e.hora_fin,e.descripcion,c.hexa FROM Eventos e LEFT JOIN Colores c ON e.color = c.id",$conexion);
$registros=mysql_query("SELECT e.id, e.titulo, e.fecha_inicio, e.hora_inicio, e.fecha_fin, e.hora_fin, e.descripcion, c.hexa
FROM eventos e
LEFT JOIN colores c ON e.color = c.id
LEFT JOIN destinatariosxevento d ON d.idEvento = e.id
WHERE idDestino =1 
OR ( idDestino =2 AND idSubGrupo = $grupo )
OR ( idDestino =3 AND idSubgrupo = $sub )",$conexion);

while($reg=mysql_fetch_array($registros))
{
	$json .= '{';
	$json .= '"id": "'.$reg['id'].'",';
	$json .= '"title": "'.$reg['titulo'].'",';	
	$json .= '"desc": "'.$reg['descripcion'].'",';	
	if($reg['hora_inicio'] == 'NULL')
		$json .= '"start": "'.$reg['fecha_inicio'].'",';
	else
		$json .= '"start": "'.$reg['fecha_inicio'].'T'.$reg['hora_inicio'].'",';
	if($reg['fecha_fin'] == 'NULL'){
		if($reg['hora_fin'] == 'NULL')
			$json .= '"end": "'.$reg['fecha_fin'].'"';
		else
			$json .= '"end": "'.$reg['fecha_fin'].'T'.$reg['hora_fin'].'"';
	}
	else if($reg['hora_fin'] != 'NULL')
		$json .= '"end": "'.$reg['fecha_inicio'].'T'.$reg['hora_fin'].'"';
	else
		$json = substr($json, 0, -1);
	if($reg['hexa'] != 'NULL')
		$json .= ',"color": "#'.$reg['hexa'].'"';
	$json .= '},';
}
$json = substr($json, 0, -1);
$json .= ']';
mysql_close($conexion);
$input_arrays = json_decode($json, true);
$output_arrays = array();
foreach ($input_arrays as $array) {
	$event = new Event($array, $timezone);
	if ($event->isWithinDayRange($range_start, $range_end)) {
		$output_arrays[] = $event->toArray();
	}
}
echo json_encode($output_arrays);
?>
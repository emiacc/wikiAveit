<?php
if($_POST['pass'] != 'calendarioaveit2015'){
	header('Location: nuevo.html?status=0');
}else{
$titulo = $_POST['titulo'];
$fecha = $_POST['fecha_inicio'];
$descripcion = $_POST['descripcion'];

$cadena1= "titulo,fecha_inicio,descripcion";
$cadena2= "'".$titulo."','".$fecha."','".$descripcion."'";

if(isset($_POST['hora_inicio'])){
	$cadena1 = $cadena1.",hora_inicio";
	$cadena2 = $cadena2.",'".$_POST['hora_inicio']."'";
}
if(isset($_POST['hora_fin'])){
	if($_POST['hora_fin'] != ''){
		$cadena1 = $cadena1.",hora_fin";
		$cadena2 = $cadena2.",'".$_POST['hora_fin']."'";
	}
}

if(isset($_POST['destinatario'])){
	$destinatario = $_POST['destinatario'];

	$color=4;
	if($destinatario == 1) $color=0;
	if($destinatario == 3) $color=7;
	if($destinatario == 2){ 
		$color = 2;
		if(isset($_POST['48']) && isset($_POST['49']) && isset($_POST['50']))
			$color = 6;
	}
	$cadena1 = $cadena1.",color";
	$cadena2 = $cadena2.",".$color;

	$conexion=mysql_connect("localhost","root","") or die("Problemas en la conexion");
	mysql_select_db("calendario",$conexion) or die("Problemas en la seleccion de la base de datos");
	mysql_query("SET NAMES 'utf8'");
	mysql_query("INSERT INTO eventos (".$cadena1.") VALUES (".$cadena2.")", $conexion) or die("Problemas en el insert ".mysql_error());
	$id_evento = mysql_insert_id();
	if($destinatario == 1){
		mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,1,0)", $conexion) or die("Problemas en el insert ".mysql_error());
		mysql_close($conexion);
		header('Location: nuevo.html?status=4');
	}	
	elseif($destinatario == 2){
		$grupo = FALSE;
		if(isset($_POST['48'])){
			mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,2,48)", $conexion) or die("Problemas en el insert ".mysql_error());
			$grupo = TRUE;
		}
		if(isset($_POST['49'])){
			mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,2,49)", $conexion) or die("Problemas en el insert ".mysql_error());
			$grupo = TRUE;
		}
		if(isset($_POST['50'])){
			mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,2,50)", $conexion) or die("Problemas en el insert ".mysql_error());
			$grupo = TRUE;
		}
		if(isset($_POST['51'])){
			mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,2,51)", $conexion) or die("Problemas en el insert ".mysql_error());
			$grupo = TRUE;
		}
		if(isset($_POST['52'])){
			mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,2,52)", $conexion) or die("Problemas en el insert ".mysql_error());
			$grupo = TRUE;
		}
		if(isset($_POST['53'])){
			mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,2,53)", $conexion) or die("Problemas en el insert ".mysql_error());
			$grupo = TRUE;
		}
		if($grupo == FALSE){
			mysql_query("DELETE FROM eventos WHERE id=$id_evento", $conexion) or die("Problemas en el insert ".mysql_error());
			mysql_close($conexion);
			header('Location: nuevo.html?status=2');
		}
		else{
			mysql_close($conexion);
			header('Location: nuevo.html?status=4');			
		}
	}
	elseif($destinatario == 3){
		$subcom = FALSE;
		if(isset($_POST['1'])){
			mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,3,1)", $conexion) or die("Problemas en el insert ".mysql_error());
			$subcom = TRUE;
		}
		if(isset($_POST['2'])){
			mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,3,2)", $conexion) or die("Problemas en el insert ".mysql_error());
			$subcom = TRUE;
		}
		if(isset($_POST['3'])){
			mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,3,3)", $conexion) or die("Problemas en el insert ".mysql_error());
			$subcom = TRUE;
		}
		if(isset($_POST['4'])){
			mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,3,4)", $conexion) or die("Problemas en el insert ".mysql_error());
			$subcom = TRUE;
		}
		if(isset($_POST['5'])){
			mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,3,5)", $conexion) or die("Problemas en el insert ".mysql_error());
			$subcom = TRUE;
		}
		if(isset($_POST['6'])){
			mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,3,6)", $conexion) or die("Problemas en el insert ".mysql_error());
			$subcom = TRUE;
		}
		if(isset($_POST['7'])){
			mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,3,7)", $conexion) or die("Problemas en el insert ".mysql_error());
			$subcom = TRUE;
		}
		if(isset($_POST['8'])){
			mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,3,8)", $conexion) or die("Problemas en el insert ".mysql_error());
			$subcom = TRUE;
		}
		if(isset($_POST['9'])){
			mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,3,9)", $conexion) or die("Problemas en el insert ".mysql_error());
			$subcom = TRUE;
		}
		if(isset($_POST['10'])){
			mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,3,10)", $conexion) or die("Problemas en el insert ".mysql_error());
			$subcom = TRUE;
		}
		if(isset($_POST['11'])){
			mysql_query("INSERT INTO destinatariosxevento VALUES ($id_evento,3,11)", $conexion) or die("Problemas en el insert ".mysql_error());
			$subcom = TRUE;
		}
		if($subcom == FALSE){
			mysql_query("DELETE FROM eventos WHERE id=$id_evento", $conexion) or die("Problemas en el insert ".mysql_error());
			mysql_close($conexion);
			header('Location: nuevo.html?status=3');
		}
		else{
			mysql_close($conexion);
			header('Location: nuevo.html?status=4');			
		}
	}	
}
else{
	header('Location: nuevo.html?status=1');	
}
}

?>
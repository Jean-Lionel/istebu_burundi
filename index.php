<?php 
require "app/config.php";

 cors();

header('Content-Type: application/json');

if($_SERVER['REQUEST_URI'] =='/'){
	echo json_encode(
		[
			'/communes' => "NOMBRE D'HABITATANT PAR COMMUNES",
			'/menages' => "NOMBRE TOTAL DES MENAGES",
			'/provinces' => "NOMBRE D'HABITATANT PAR PROVINCES",
			'/menage_province' => "NOMBRE DE MENAGE PAR PROVINCES",
			'/femmes' => "NOMBRE DES FEMMES",
			'/hommes' => "NOMBRE DES FEMMES",
	    ]

	);
}

if($_SERVER['REQUEST_URI'] =='/communes'){
	$data = nombre_population_commune();
	echo json_encode($data);
}
if($_SERVER['REQUEST_URI'] =='/menages'){
	$data = total_number_of_menage();
	echo json_encode($data);
}
if($_SERVER['REQUEST_URI'] =='/provinces'){
	$data = nombre_population_province();
	echo json_encode($data);
}
if($_SERVER['REQUEST_URI'] =='/menage_province'){
	$data = menage_province();
	echo json_encode($data);
}
if($_SERVER['REQUEST_URI'] =='/femmes'){
	$data = total_number_of_women();
	echo json_encode($data);
}
if($_SERVER['REQUEST_URI'] =='/hommes'){
	$data = total_number_of_man();
	echo json_encode($data);
}

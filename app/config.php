<?php 
require "app/db.php";

// NOMBRE TOTAL DE MENAGE 
function executeQuery($sql = ""){

	$db = getConnection();
	$result = $db->query($sql);

	if($result){
		return $result->fetchAll();
	}else{
		return ["error" => "PAS DE RESULT"];
	}	
}
function  total_number_of_menage(){
	// $sql = "select sum(sid5a) as menage_total from `str_menage` left join other_infos on str_menage_id = other_infos.level_1_id ";
	$sql = "SELECT sum(`qs06`) as menage_total FROM `str_menage`";
	return executeQuery($sql);
}

// HOMME
function  total_number_of_man(){
	$sql = "SELECT sum(`qs07`) as menage_total FROM `str_menage` ";
	return executeQuery($sql);
}

//FEMME
function  total_number_of_women(){
	$sql = "SELECT sum(`qs08`) as menage_total FROM `str_menage`";
	return executeQuery($sql);
}



#NOMBRE DE POPULATION PAR COMMUNE

function nombre_population_commune(){
	$sql = "select level_1.sid2 as COMMUNE , SUM(qs06) as NOMBRETOTAL from `str_menage` left join level_1 on str_menage_id = level_1.level_1_id GROUP BY level_1.sid2";
	return executeQuery($sql);

}



#NOMBRE DE MENAGE PAR PROVINCE

function menage_province(){
	$sql = "SELECT level_1.sid1 as PROVINCE, SUM(str_menage.qs06) as nombre_total FROM `str_menage` LEFT JOIN level_1 ON str_menage_id = level_1.level_1_id GROUP BY level_1.sid1";
		$result = executeQuery($sql);
		$provinces = burundiProvince();
		$data = [];
		foreach($result as $v){
			$v['nom_province'] = $provinces[$v['PROVINCE'] ?? 0];
			$data[] = $v;
		}
	return $data;

}



## NOMBRE DE POPULATION PAR PROVINCE

function nombre_population_province(){
	$sql = "select level_1.sid1 as PROVINCE , SUM(qs06) as NOMBRETOTAL from `str_menage` left join level_1 on str_menage_id = level_1.level_1_id GROUP BY level_1.sid1";

	$result = executeQuery($sql);
	$provinces = burundiProvince();
	$data = [];
	foreach($result as $v){
		$v['nom_province'] = $provinces[$v['PROVINCE'] ?? 0];
		$data[] = $v;
	}
	return $data;

}
## PROVINCE DU BURUNDI
function burundiProvince(){
	return ["","Bubanza","Bujumbura Mairie","Bujumbura ","Bururi","Cankuzo","Cibitoke","Gitega","Karuzi","Kayanza","Kirundo","Makamba","Muramvya","Muyinga","Mwaro","Ngozi","Rumonge","Rutana","Ruyigi"];
}

## DEBUG 

function debug($v = null){

	echo "<pre>";
	var_dump($v);
	echo "</pre>";

}



/**
 *  An example CORS-compliant method.  It will allow any GET, POST, or OPTIONS requests from any
 *  origin.
 *
 *  In a production environment, you probably want to be more restrictive, but this gives you
 *  the general idea of what is involved.  For the nitty-gritty low-down, read:
 *
 *  - https://developer.mozilla.org/en/HTTP_access_control
 *  - https://fetch.spec.whatwg.org/#http-cors-protocol
 *
 */
function cors() {
    
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    
        exit(0);
    }
    
    //echo "You have CORS!";
}

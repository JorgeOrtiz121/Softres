<?php

//******************************************************************************************
//***********funcion para obtener los datos directamente de laravel (archivo .env)**********
//******************************************************************************************
function obtener_datos(){

	//extraemos el contenido del archivo
	$archivo = file_get_contents(__DIR__ . "/.env");

	$result = [];//Declaro un array

	//Recorro todo el contenido del archivo y cada enter lo pongo como una linea
	foreach (explode("\n", $archivo) as $line)
	{
		if (strpos($line, '=') === false) //identifico si tiene el simbbolo igual cada linea, sino la tiene, paso a la siguiente
		{
			continue;
		}

		$line = str_replace("'","",$line);
	
		list($key, $value) = explode('=', $line);//paso las variables separadas por el = a la variable $key y $value
		$result[trim($key,'\' ')] = trim(trim($value), '\','); //Paso la $key y $value al array $result
	}
	
	return $result;
}

//******************************************************************************************
//*************************ABRIR CONEXIÓN CON MYSQL*****************************************
//******************************************************************************************
function abrirconexion($bd=''){
	$datos = obtener_datos();
	
    $user = $datos["DB_USERNAME"];
    $host = $datos["DB_HOST"];
    $password = $datos["DB_PASSWORD"];
    $bd = ($bd=='') ? $datos["DB_DATABASE"]:$bd;
    $port = $datos["DB_PORT"];

	$mysqli=new mysqli($host,$user,$password,$bd,$port);
	if ($mysqli->connect_errno) {
		echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	$mysqli->set_charset("utf8");
	return $mysqli;
}
//******************************************************************************************
//******************************CERRAR CONEXIÓN CON MYSQL***********************************
//******************************************************************************************
function cerrarconexion($mysqli){
	$mysqli->close();
}

function guardar($query,$bd=''){
	$mysqli=abrirconexion($bd);
	if($mysqli->query($query))
	{
		cerrarconexion($mysqli);
		return "OK";
	}else{		
        cerrarconexion($mysqli);
		return $mysqli->error;
	}
}

//******************************************************************************************
//*****************************CONSULTAS****************************************************
//******************************************************************************************
function consultas($query){
	$mysqli=abrirconexion();
	$datos=$mysqli->query($query);
	cerrarconexion($mysqli);
	return $datos;
}


// echo $argv[1];

$options = getopt("q:");

$query = $options['q'];

if(empty($query)){
    echo 'Usage:
            -q: query a usar';
}else{

    abrirconexion();

    $queryEmpresas ='SELECT *FROM empresas';
    
    $empresas = consultas($queryEmpresas);
    
    foreach ($empresas as $key => $empresa) {
        $database = $empresa["database"];
        // echo $database.'
		
		// ';
        echo guardar($query,$database);
    }
}

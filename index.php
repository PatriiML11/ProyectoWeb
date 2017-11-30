<?php
	error_reporting(E_ALL);
	ini_set('error_reporting', E_ALL);
	require_once 'model/Usuario.php';
	require_once 'config/config.php';
	session_start();
	// Fichero con la configuración de la navegacion de la página
	$controlador = 'controller/cInicio.php';
	if (isset($_SESSION['usuario'])) {
	    if (isset($_GET['location']) && isset($controladores[$_GET['location']])) {
	        $controlador = $controladores[$_GET['location']];
	    }
	} else {
		if(isset($_GET['location'])){
			$controlador = $controladores[$_GET['location']];
		}else{
			$_GET['location'] = 'inicio';
		}
	   $controlador = $controladores[$_GET['location']];
	}
include $controlador;
?>
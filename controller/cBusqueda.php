<?php
/*
 * CONTROLADOR DE LA PÁGINA DE BÚSQUEDA.
 * MUESTRA UNA TABLA CON LAS BÚSQUEDAS REALIZADAS.
 *
 * @author PATRICIA MARTÍNEZ LUCENA
 * @version 1.0.0
 */
//INCLUIR LA CLASE BÚSQUEDA.
require_once 'model/Busqueda.php';
//SI SE HA INICIADO LA SESIÓN DEL USUARIO.
if(isset($_SESSION['usuario'])){
	//INCLUIR LA VISTA GENERAL DE LAS PÁGINAS.
	include 'view/layout.php';
}else{
	//REDIRIGIR A LA PÁGINA DE INICIO.
	header('Location:index.php?location=inicio');
}

?>

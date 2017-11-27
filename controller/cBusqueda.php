<?php
/*
 * CONTROLADOR DE LA PÁGINA DE BÚSQUEDA.
 * MUESTRA UNA TABLA CON LAS BÚSQUEDAS REALIZADAS.
 *
 * @author PATRICIA MARTÍNEZ LUCENA
 * @version 1.0.0
 */
require_once 'model/Busqueda.php';
if(isset($_SESSION['usuario'])){
	//INCLUIR LA VISTA GENERAL DE LAS PÁGINAS.
	include 'view/layout.php';
}else{
	header('Location:index.php?location=inicio');
}

?>

<?php 
/* 
* CONTROLADOR DE PERFIL DE USUARIO.
* REALIZA LAS ACCIONES DEL PERFIL DEL USUARIO.
* 
* @author PATRICIA MARTÍNEZ LUCENA
* @version 1.0.0 
*/ 
//SI SE HA INICIADO LA SESIÓN DEL USUARIO.
if(isset($_SESSION['usuario'])){
	//INCLUIR LA CLASE BÚSQUEDA.
	require_once 'model/Busqueda.php';
	//INCLUIR LA VISTA GENERAL.
	include 'view/layout.php';
	//SI SE HA PULSADO EL BOTÓN DE EDITAR, REDIRIGE A LA PÁGINA DE EDITAR USUARIO.
	if(isset($_POST['editar'])){
		header('Location:index.php?location=editarusuario');
	}
//SI NO SE HA INICIADO SESIÓN REDIRIGE A LA PÁGINA DE INICIO.
}else{
	header('Location:index.php?location=inicio');
}
?> 
</div>
	<footer>           
		<p>Autor: Patricia Martínez</p>
		<a href=""><div><img src="./webroot/css/images/github.png" width="50px"></div></a>
	</footer> 
</div>
<?php 
/* 
* CONTROLADOR DE BORRAR USUARIO.
* REALIZA EL BORRADO DEL USUARIO QUE INICIÓ SESIÓN.
* 
* @author PATRICIA MARTÍNEZ LUCENA
* @version 1.0.0 
*/ 
//SI SE HA INICIADO LA SESIÓN DEL USUARIO.
if(isset($_SESSION['usuario'])){
	require_once 'model/Usuario.php';
	//RECUPERAR CÓDIGO SELECCIONADO EN LA PÁGINA ANTERIOR.
	//ALMACENAR EN UNA VARIABLE EL USUARIO RECIBIDO.
	$usuario=Usuario::buscarUsuario($_SESSION['usuario']->getCodUsuario());
	//ALMACENAR EN VARIABLES LOS DISTINTOS VALORES RECIBIDOS.
	$codUsuario=$usuario->getCodUsuario();
	$_SESSION['usuarioBorr']=$usuario;
	include 'view/layout.php';
	//ACCIÓN SI SE HA PULSADO EL BOTÓN DE BORRAR.
	if(isset($_POST['borrar'])){
		//ALMACENAR EN UNA VARIABLE EL RESULTADO DE BORRAR EL USUARIO.
		$resul=Usuario::borrarUsuario($_SESSION['usuarioBorr']->getCodUsuario());
		//SI SE HA BORRADO DESTRUYE LA SESIÓN, MUESTRA UN MENSAJE Y REDIRIGE A LA PÁGINA DE INICIO.
		if ($resul) { 
			print '<span id="varError" style="display:none;">Usuario eliminado con éxito</span>';
			session_destroy();
			header('Refresh: 2;url=index.php?location=inicio'); 
		//SI NO SE HA BORRADO, MUESTRA UN MENSAJE Y REDIRIGE A LA PÁGINA DE INICIO.
		}else{ 
			print '<span id="varError" style="display:none;">No se ha podido eliminar el usuario</span>';
			header('Refresh: 2;url=index.php?location=inicio'); 
		} 
	}
//SI NO SE HA INICIADO SESIÓN REDIRIGE A LA PÁGINA DE INICIO.
}else{
	header('Location:index.php?location=inicio');
}
?> 
</div>
	<footer>           
		<p>Autor: Patricia Martínez</p>
		<a href="https://github.com/PatriiML11/ProyectoWeb/tree/ProyectoWeb-Version3"><div><img src="./webroot/css/images/github.png" width="50px"></div></a>
	</footer> 
</div>
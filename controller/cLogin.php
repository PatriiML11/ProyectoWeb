<?php
/*
 * CONTROLADOR DE LA PÁGINA DE LOGIN.
 * INICIA LA SESIÓN DEL USUARIO.
 *
 * @author PATRICIA MARTÍNEZ LUCENA
 * @version 1.0.0
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
//Utiliza la clase Usuario
require_once 'model/Usuario.php';
//SI YA SE HA INICIADO LA SESIÓN DEL USUARIO REDIRIGE A LA PÁGINA DE INICIO.
if (isset($_SESSION['usuario'])) {
  	header("Location: index.php?location=inicio");
}else {
	//SI SE PULSA EL BOTÓN REGISTRO REDIRIGE A LA PÁGINA DE REGISTRO.
	if(isset($_POST['registro'])){
		header('Location:index.php?location=registro');
	}
	//INICIALIZAR VARIABLES.
	$entradaOK=false;
	$fechaOK=false;
	$contadorOK=false;
	$error='';
	$span="";
	//SI SE PULSA EL BOTÓN ENVIAR.
	if(isset($_POST['enviar'])){
		//ENTRADA CORRECTA.
		$entradaOK=true;
		//SI ALGUNO DE LOS CAMPOS ESTÁ VACÍO.
		if (empty($_POST['usuario']) || empty($_POST['password'])) { 	
			//LA ENTRADA SERÁ FALSA.
			$entradaOK=false;
			//INTRODUCIR VALORES EN LAS VARIABLES DE ERROR.
			$error = "DATOS INCOMPLETOS"; 
			$span="<span class='error' name='error'>".$error."</span>";
		//ACCIÓN SI LOS CAMPOS ESTÁN ESCRITOS.
		}else { 
			//COMPROBAR SI EXISTE EL USUARIO LLAMANDO A LA FUNCIÓN DE LA CLASE USUARIO Y ALMACENARLO EN LA VARIABLE.
			$usuario=Usuario::validarUsuario($_POST['usuario'],hash('sha256', $_POST['password']));
			//SI NO SE HA ENCONTRADO EL USUARIO.
			if($usuario==null){
				//LA ENTRADA SERÁ FALSA.
				$entradaOK=false;
				//INTRODUCIR VALORES EN LAS VARIABLES DE ERROR.
				$error = "Debes introducir un nombre de usuario y una contraseña válidos";
				$span="<span class='error' name='error'>".$error."</span>";
			}
		}
	}
	//SI NO SE HA ENCONTRADO NINGÚN ERROR.
	if($entradaOK){
		//INICIAR LA SESIÓN
		session_start();
		//ALMACENAR EL USUARIO EN LA SESIÓN.
		$_SESSION['usuario']=$usuario;
		//REDIRIGIR A LA PÁGINA DE INICIO.
		header('Location: index.php?location=inicio');
	}
	//EL ERROR LANZADO SERÁ UN CAMPO EN BLANCO O UN ERROR, SI LO HA ENCONTRADO.
	$_SESSION['error']=$span;
}
//INCLUIR LA VISTA GENERAL.
include 'view/layout.php';
?>
</div>
	<footer>           
		<p>Autor: Patricia Martínez</p>
		<a href=""><div><img src="./webroot/css/images/github.png" width="50px"></div></a>
	</footer> 

</div>
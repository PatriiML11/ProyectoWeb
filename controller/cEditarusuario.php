<?php
/* 
* CONTROLADOR DE MODIFICACIÓN DE UN USUARIO.
* REALIZA LA MODIFICACIÓN DEL USUARIO SELECCIONADO.
* 
* @author PATRICIA MARTÍNEZ LUCENA
* @version 1.0.0
*/ 
if(isset($_SESSION['usuario'])){
require_once 'model/Usuario.php';
$_SESSION['editado']='';
$_SESSION['usuarioModific']=$_SESSION['usuario'];
//ALMACENAR EN VARIABLES LOS DISTINTOS VALORES RECIBIDOS. 
$codUsuario=$_SESSION['usuarioModific']->getCodUsuario();
$nomUsuario=$_SESSION['usuarioModific']->getNomUsuario();
$email=$_SESSION['usuarioModific']->getEmail();
//INICIALIZAR ENTRADA A FALSA.
$entradaOK=false;
$datosOK=false;
$editado=false;
//INICIALIZAR ARRAY DE ALMACENAMIENTO DE ERRORES.
$errores=[
	'codUsuario'=>'',
	'nomUsuario'=>'',
	'email'=>'',
	'password'=>'',
	'passwordnuevo'=>''
];
//INICIALIZAR ARRAY DE ALMACENAMIENTO DE LOS DATOS DE LOS CAMPOS DEL FORMULARIO.
$campos=[
	'codUsuario'=>'',
	'nomUsuario'=>'',
	'email'=>'',
	'password'=>'',
	'passwordnuevo'=>''
];
//ACCIÓN SI SE HA PULSADO EL BOTÓN.
if(isset($_POST['editar'])){
//NECESITA MI LIBRERÍA DE FUNCIONES.
include 'core/funciones.php';
	//INICIALIZAR LA ENTRADA A CORRECTA.
	$entradaOK=true;
	//OBTENER VALORES DE LOS CAMPOS.
	$campos=[
		'codUsuario'=>$_POST['codUsuario'],
		'nomUsuario'=>$_POST['nomUsuario'],
		'email'=>$_POST['email'],
		'password'=>$_POST['password'],
		'passwordnuevo'=>$_POST['passwordnuevo']
	];
	if($campos['nomUsuario']==$nomUsuario && empty(trim($campos['password'])) && empty(trim($campos['passwordnuevo'])) && $campos['codUsuario']==$codUsuario && $campos['email']==$email){
			$entradaOK=false;
			print 'No has cambiado nada';
	}else{
		//COMPRUEBA SI ES VÁLIDO EL TEXTO ESCRITO EN EL CAMPO DE CÓDIGO.
		if(validartextonumero($campos['codUsuario'])){
			$entradaOK=false;
			//ALMACENA EN UN ARRAY EL ERROR RECIBIDO.
			$errores['codUsuario']=validartextonumero($campos['codUsuario']);
		}
		if(!empty(trim($campos['nomUsuario']))){
			//COMPRUEBA SI ES VÁLIDO EL TEXTO ESCRITO EN EL CAMPO DE DESCRIPCIÓN.
			if(validartextovacio($campos['nomUsuario'])){
				$entradaOK=false;
				//ALMACENA EN UN ARRAY EL ERROR RECIBIDO.
				$errores['nomUsuario']=validartextovacio($campos['nomUsuario']);
			}
		}else{
			$campos['nomUsuario']=$_SESSION['usuarioModific']->getNomUsuario();
		}
		if(!empty(trim($campos['email']))){
			//COMPRUEBA SI ES VÁLIDO EL TEXTO ESCRITO EN EL CAMPO DE DESCRIPCIÓN.
			if(validaremail($campos['email'])){
				$entradaOK=false;
				//ALMACENA EN UN ARRAY EL ERROR RECIBIDO.
				$errores['email']=validaremail($campos['email']);
			}
		}else{
			$campos['email']=$_SESSION['usuarioModific']->getEmail();
		}
		if(!empty(trim($campos['password']))){
			if(validarpassword($campos['password'])){
				$entradaOK=false;
				//ALMACENA EN UN ARRAY EL ERROR RECIBIDO.
				$errores['password']=validarpassword($campos['password']);
			}
		}else{
			$entradaOK=false;
			$errores['password']='Debes introducir la contraseña';
		}
		if(!empty(trim($campos['passwordnuevo']))){
			if(validarpasswordvacio($campos['passwordnuevo'])){
				$entradaOK=false;
				//ALMACENA EN UN ARRAY EL ERROR RECIBIDO.
				$errores['passwordnuevo']=validarpasswordvacio($campos['passwordnuevo']);
			}
		}
	}	
//COMPRUEBA SI ES VÁLIDO EL TEXTO ESCRITO EN EL CAMPO DE FECHA.
}
//SI SE PULSA EL BOTÓN LOGOFF REDIRIGE A LA PÁGINA D EINICIO.
if(isset($_POST['logoff'])){
	header('Location: index.php?location=inicio');
}
//INCLUIR LA VISTA GENERAL.
include 'view/layout.php';
//SI NO SE HA ENCONTRADO NINGÚN ERROR.
if($entradaOK){
		//ALMACENA EN LA VARIABLE EL USUARIO RECIBIDO
		$usuario=Usuario::validarUsuario($_SESSION['usuarioModific']->getCodUsuario(),hash('sha256',$campos['password']));
		//SI HA DEVUELTO UN USUARIO, UTILIZAMOS EL MÉTODO editarUsuario de la clase Usuario.
		if($usuario!=null){
			if(!empty($campos['passwordnuevo'])){
				$usuario=Usuario::editarUsuario($campos['nomUsuario'],$campos['email'],hash('sha256',$campos['passwordnuevo']),$_SESSION['usuarioModific']->getCodUsuario());
			}else{
				$usuario=Usuario::editarUsuario($campos['nomUsuario'],$campos['email'],hash('sha256',$campos['password']),$_SESSION['usuarioModific']->getCodUsuario());
			}
			//SI SE HA EDITADO EL USUARIO.
			if($usuario!=null){
				$_SESSION['editado']="EDITADO CORRECTAMENTE";
				$datosOK=true;
			//SI NO SE HA EDITADO, ALMACENO EL ERROR EN UNA VARIABLE DE SESIÓN PARA MOSTRAR.
			}else{
				$_SESSION['editado']="NO SE HA PODIDO MODIFICAR";
			}
		}else{
			$_SESSION['editado']="La contraseña no coincide";
		}
	print_r($_SESSION['editado']);
	//SI SE HA EDITADO REDIRIGE A LA PÁGINA DE EDITAR USUARIO.
	if($datosOK){
		header('Refresh: 0.5; url=index.php?location=editarusuario');
	}
}
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
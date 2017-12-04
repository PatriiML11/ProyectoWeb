<?php
/* 
* CONTROLADOR DE MODIFICACIÓN DE UN USUARIO.
* REALIZA LA MODIFICACIÓN DEL USUARIO SELECCIONADO.
* 
* @author PATRICIA MARTÍNEZ LUCENA
* @version 1.0.0
*/ 
//SI SE HA INICIADO LA SESIÓN DEL USUARIO.
if(isset($_SESSION['usuario'])){
	//INCLUIR LA CLASE BÚSQUEDA.
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
		//SI NO SE HA CAMBIADO NINGÚN CAMPO, MUESTRA UN MENSAJE.
		if($campos['nomUsuario']==$nomUsuario && empty(trim($campos['password'])) && empty(trim($campos['passwordnuevo'])) && $campos['codUsuario']==$codUsuario && $campos['email']==$email){
			$entradaOK=false;
			print '<span id="varError" style="display:none;">No has cambiado nada</span>';
		}else{
			//COMPRUEBA SI ES VÁLIDO EL TEXTO ESCRITO EN EL CAMPO.
			if(validartextonumero($campos['codUsuario'])){
				$entradaOK=false;
				//ALMACENA EN UN ARRAY EL ERROR RECIBIDO.
				$errores['codUsuario']=validartextonumero($campos['codUsuario']);
			}
			//SI SE HA ESCRITO ALGO EN EL CAMPO.
			if(!empty(trim($campos['nomUsuario']))){
				//COMPRUEBA SI ES VÁLIDO EL TEXTO ESCRITO EN EL CAMPO.
				if(validartextovacio($campos['nomUsuario'])){
					$entradaOK=false;
					//ALMACENA EN UN ARRAY EL ERROR RECIBIDO.
					$errores['nomUsuario']=validartextovacio($campos['nomUsuario']);
				}
			}else{
				//SI NO SE HA ESCRITO NADA, COGE EL VALOR ANTERIOR.
				$campos['nomUsuario']=$_SESSION['usuarioModific']->getNomUsuario();
			}
			//SI SE HA ESCRITO ALGO EN EL CAMPO.
			if(!empty(trim($campos['email']))){
				//COMPRUEBA SI ES VÁLIDO EL TEXTO ESCRITO EN EL CAMPO.
				if(validaremail($campos['email'])){
					$entradaOK=false;
					//ALMACENA EN UN ARRAY EL ERROR RECIBIDO.
					$errores['email']=validaremail($campos['email']);
				}
			}else{
				//SI NO SE HA ESCRITO NADA, COGE EL VALOR ANTERIOR.
				$campos['email']=$_SESSION['usuarioModific']->getEmail();
			}
			//SI SE HA ESCRITO ALGO EN EL CAMPO.
			if(!empty(trim($campos['password']))){
				//COMPRUEBA SI ES VÁLIDO EL TEXTO ESCRITO EN EL CAMPO.
				if(validarpassword($campos['password'])){
					$entradaOK=false;
					//ALMACENA EN UN ARRAY EL ERROR RECIBIDO.
					$errores['password']=validarpassword($campos['password']);
				}
			}else{
				//SI NO SE HA INTRODUCIDO LA CONTRASEÑA, MUESTRA UN MENSAJE DE ERROR.
				$entradaOK=false;
				print '<span id="varError" style="display:none;">Debes introducir la contraseña</span>';
			}
			//SI SE HA ESCRITO ALGO EN EL CAMPO.
			if(!empty(trim($campos['passwordnuevo']))){
				//COMPRUEBA SI ES VÁLIDO EL TEXTO ESCRITO EN EL CAMPO.
				if(validarpasswordvacio($campos['passwordnuevo'])){
					$entradaOK=false;
					//ALMACENA EN UN ARRAY EL ERROR RECIBIDO.
					$errores['passwordnuevo']=validarpasswordvacio($campos['passwordnuevo']);
				}
			}
		}	
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
				print '<span id="varError" style="display:none;">Editado correctamente</span>';
				$_SESSION['usuario']=$usuario;
				$datosOK=true;
			//SI NO SE HA EDITADO, MUESTRA EL ERROR.
			}else{
				print '<span id="varError" style="display:none;">No se ha podido modificar</span>';
			}
		//SI NO HA DEVUELTO NINGÚN USUARIO, MUESTRA EL ERROR.
		}else{
			print '<span id="varError" style="display:none;">La contraseña no es correcta</span>';
		}
		//SI SE HA EDITADO REDIRIGE A LA PÁGINA DE EDITAR USUARIO.
		if($datosOK){
			header('Location:index.php?location=editarusuario');
		}
	}
//SI NO SE HA INICIADO SESIÓN REDIRIGE A LA PÁGINA DE INICIO.
}else{
	header('Location:index.php?location=inicio');
}
?>
<script>/*
//SI EXISTEN ERRORES, LOS MUESTRA.
if(document.getElementById("varError").innerHTML.length!=0){
	document.getElementById("error").innerHTML=document.getElementById("varError").innerHTML;
}
if(document.getElementById("error").innerHTML.length!=0 || document.getElementById("errorcampos").innerHTML.length!=0){
	document.getElementById("div1").style.marginTop="10px";
	document.getElementById("contError").style.display="flex";
}
*/
$(document).ready(function(){
	var varerror=$("#varError").html();
	if($("#varError").html().length!=0){
		$("#error").text(varerror);
	}
	//SI EXISTEN ERRORES, LOS MUESTRA.
	if($("#error").html().length!=0 || $("#errorcampos").html().length!=0){
		$("#div1").css("marginTop","10px");
		$("#contError").css("display","flex");
	}
});

</script>
</div>
	<footer>           
		<p>Autor: Patricia Martínez</p>
		<a href="https://github.com/PatriiML11/ProyectoWeb/tree/ProyectoWeb-Version3"><div><img src="./webroot/css/images/github.png" width="50px"></div></a>
	</footer> 
</div>
<?php
/* 
* CONTROLADOR DEL ALTA DE UN USUARIO.
* REALIZA EL ALTA DE UN USUARIO.
* 
* @author PATRICIA MARTÍNEZ LUCENA
* @version 1.0.0 
*/ 
//INCLUIR LA CLASE USUARIO
require_once 'model/Usuario.php';
//INICIALIZAR LAS VARIABLES.
$entradaOK=false;
//INICIALIZAR EL ARRAY DE ALMACENAMIENTO DE ERRORES.
$errores=[
	'codUsuario'=>'',
	'nomUsuario'=>'',
	'email'=>'',
	'password'=>''
];
//INICIALIZAR EL ARRAY DE ALMACENAMIENTO DE LOS DATOS DEL FORMULARIO.
$campos=[
	'codUsuario'=>'',
	'nomUsuario'=>'',
	'email'=>'',
	'password'=>''
];
//SI SE HA PULSADO EL BOTÓN DE REGISTRO.
if(isset($_POST['registro'])){
//INCLUIR LA LIBRERÍA DE FUNCIONES.
include 'core/funciones.php';
	$entradaOK=true;
	//OBTENER LOS VALORES DE LOS CAMPOS DEL FORMULARIO.
	$campos=[
		'codUsuario'=>$_POST['codUsuario'],
		'nomUsuario'=>$_POST['nomUsuario'],
		'email'=>$_POST['email'],
		'password'=>$_POST['password']
	];
	//COMPRUEBA SI ES VÁLIDO EL TEXTO ESCRITO EN EL CAMPO DE USUARIO
	if(validartextonumero($campos['codUsuario'])){
		$entradaOK=false;
		//ALMACENAR EN EL ARRAY EL ERROR RECIBIDO.
		$errores['codUsuario']=validartextonumero($campos['codUsuario']);
	}
	//COMPRUEBA SI ES VÁLIDO EL TEXTO ESCRITO EN EL CAMPO DE NOMBRE DE USUARIO
	if(validartexto($campos['nomUsuario'])){
		$entradaOK=false;
		//ALMACENAR EN EL ARRAY EL ERROR RECIBIDO.
		$errores['nomUsuario']=validartexto($campos['nomUsuario']);
	}
	//COMPRUEBA SI ES VÁLIDO EL TEXTO ESCRITO EN EL CAMPO DE EMAIL
	if(validaremail($campos['email'])){
		$entradaOK=false;
		//ALMACENAR EN EL ARRAY EL ERROR RECIBIDO.
		$errores['email']=validaremail($campos['email']);
	}
	//COMPRUEBA SI ES VÁLIDO EL TEXTO ESCRITO EN EL CAMPO DE PASSWORD
	if(validarpassword($campos['password'])){
		$entradaOK=false;
		//ALMACENAR EN EL ARRAY EL ERROR RECIBIDO.
		$errores['password']=validarpassword($campos['password']);
	}
}
//SI SE HA PULSADO EL BOTÓN DE VOLVER REDIRIGE A LA PÁGINA DE INICIO.
if(isset($_POST['volver'])){
	header('Location: index.php?location=inicio');
}
//INCLUIR LA VISTA GENERAL.
include 'view/layout.php';
//SI NO SE HA ENCONTRADO NINGÚN ERROR INTENTA BUSCAR EL USUARIO.
if($entradaOK){
	$usuario=Usuario::buscarUsuario($campos['codUsuario']);
	//SI NO EXISTE, LO CREA.
	if($usuario==null){
		//RECOGER EL RESULTADO DEVUELTO POR LA CONSULTA DE LA CLASE USUARIO: INSERTAR USUARIO.
		$creado=Usuario::crearUsuario($campos['codUsuario'],$campos['nomUsuario'],$campos['email'],hash('sha256',$campos['password']));
		//ACCIÓN SI NO HA DEVUELTO NINGÚN USUARIO.
		if($creado){
			print '<span id="varError" style="display:none;">USUARIO CREADO CORRECTAMENTE</span>';
			//ALMACENAR EN LA SESIÓN EL MENSAJE QUE SE VA A MOSTRAR.
			$_SESSION['creado']="USUARIO CREADO CORRECTAMENTE";
			//ALMACENAR EN UNA VARIABLE EL USUARIO CREADO.
			$usuario=Usuario::buscarUsuario($campos['codUsuario']);
			//ALMACENAR EN LA SESIÓN EL USUARIO CREADO (INICIO DE SESIÓN AUTOMÁTICO).
			$_SESSION['usuario']=$usuario;
			//REDIRIGIR A LA PÁGINA DE INICIO CON UNA ESPERA DE 2 SEGUNDOS.
			header("Location:index.php?location=inicio");
		}else{
			print '<span id="varError" style="display:none;">NO SE HA PODIDO CREAR</span>';
			//ALMACENAR EN LA SESIÓN EL MENSAJE QUE SE VA A MOSTRAR.
			$_SESSION['creado']="NO SE HA PODIDO CREAR";
		}
	//SI EXISTE EL USUARIO MUESTRA UN MENSAJE.
	}else{
		print '<span id="varError" style="display:none;">EL USUARIO YA EXISTE</span>';
	}
}
?>
<script>
//SI EXISTEN ERRORES, LOS MUESTRA.
$(document).ready(function(){
	//RECOGER EL ERROR CAPTURADO CON PHP.
	var varerror=$("#varError").html();
	if(jQuery.type($("#varError").html())!=='undefined' && $("#varError").html().length!=0){
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
		<a href="https://github.com/PatriiML11/ProyectoWeb/tree/ProyectoWeb-VersionFinal" target="_blank"><div><img src="./webroot/css/images/github.png" width="50px"></div></a>
	</footer> 
</div>
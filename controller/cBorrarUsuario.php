<?php 
/* 
* CONTROLADOR DE BORRAR USUARIO.
* REALIZA EL BORRADO DEL USUARIO QUE INICIÓ SESIÓN.
* 
* @author PATRICIA MARTÍNEZ LUCENA
* @version 1.0.0 
*/ 
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
    //SI SE HA BORRADO DESTRUYE LA SESIÓN Y REDIRIGE A LA PÁGINA DE INICIO.
    if ($resul) { 
        echo '<p>Usuario eliminado con éxito</p>'; 
        session_destroy();
        echo '<p><a href="index.php?location=inicio">Inicio</a>';
        header('Refresh: 2;url=index.php?location=inicio'); 
    }else{ 
        echo 'No se ha podido eliminar el usuario'; 
        echo '<p><a href="index.php?location=inicio"">Inicio</a>';
        header('Refresh: 2;url=index.php?location=inicio'); 
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
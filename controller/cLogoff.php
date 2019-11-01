<?php
/* 
* CONTROLADOR DE LA PÁGINA DE CERRAR SESIÓN.
* REALIZA EL CIERRE DE SESIÓN DEL USUARIO.
* 
* @author PATRICIA MARTÍNEZ LUCENA
* @version 1.0.0 
*/ 
//SI YA SE HA INICIADO LA SESIÓN DEL USUARIO
if(isset($_SESSION['usuario'])){
	//CERRAR LA SESIÓN DEL USUARIO
    unset($_SESSION['usuario']);
    //DESTRUIR LA SESIÓN DEL USUARIO
    session_destroy();
    //REDIRIGIR A LA PÁGINA DE INICIO.
    header('Location: index.php');
//SI NO SE HA INICIADO SESIÓN, REDIGIGE A LA PÁGINA DE LOGIN
}else{
	header('Location: index.php');
}

?>
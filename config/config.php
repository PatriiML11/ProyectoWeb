<?php
/*
 * PÁGINA QUE ALMACENA LOS CONTROLADORES Y LAS VISTAS.
 * ARRAY QUE CONTIENE LAS RUTAS DE LAS PÁGINAS.
 *
 * @author Patricia Martínez Lucena
 * @version 1.0.0
 */
$controladores =[
    'inicio' => 'controller/cInicio.php',
    'busqueda'=> 'controller/cBusqueda.php',
    'login' => 'controller/cLogin.php',
    'registro'=> 'controller/cRegistro.php',
    'perfil'=>'controller/cPerfil.php',
    'logoff'=>'controller/cLogoff.php',
    'editarusuario' => 'controller/cEditarusuario.php',
    'borrarusuario' => 'controller/cBorrarUsuario.php',
    'borrarbusqueda' => 'controller/cBorrarBusqueda.php',
	'limpiarhistorial' => 'controller/cLimpiarHistorial.php'
];

$vistas = [
    'inicio' => 'view/vInicio.php',
    'busqueda'=> 'view/vBusqueda.php',
    'login' => 'view/vLogin.php',
    'registro'=> 'view/vRegistro.php',
    'perfil'=>'view/vPerfil.php',
    'editarusuario' => 'view/vEditarusuario.php',
    'borrarusuario' => 'view/vBorrarUsuario.php',
    'borrarbusqueda' => 'view/vBorrarBusqueda.php',
	'limpiarhistorial' => 'view/vLimpiarHistorial.php'
];

?>
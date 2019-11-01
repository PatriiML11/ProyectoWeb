<?php 
/* 
* CONTROLADOR DE BORRAR LA BÚSQUEDA SELECCIONADA.
* REALIZA EL BORRADO DE LA BÚSQUEDA SELECCIONADA.
* 
* @author PATRICIA MARTÍNEZ LUCENA
* @version 1.0.0 
*/ 
//SI SE HA INICIADO LA SESIÓN DEL USUARIO.
if(isset($_SESSION['usuario'])){
	//INCLUIR LA CLASE BÚSQUEDA.
	require_once 'model/Busqueda.php';
	//RECUPERAR LA BÚSQUEDA SELECCIONADA EN LA PÁGINA ANTERIOR.
	$codBusqueda=$_GET['id'];
	$busqueda=Busqueda::getBusqueda($codBusqueda);
	//ALMACENAR LA BÚSQUEDA EN LA SESIÓN.
	$_SESSION['busquedaborr']=$busqueda;
	//INCLUIR LA VISTA GENERAL DE TODAS LAS PÁGINAS.
	include 'view/layout.php';
	//SI SE HA PULSADO EL BOTÓN DE BORRAR.
	if(isset($_POST['borrar'])){
		//RECOGER EL RESULTADO DEVUELTO POR LA CONSULTA DE LA CLASE BÚSQUEDA: LIMPIAR HISTORIAL.
		$resul=Busqueda::borrarBusqueda($_SESSION['busquedaborr']->getCodBusqueda());
		//ACCIÓN SI EL RESULTADO DEVUELTO ES VERDADERO Y SE HA LIMPIADO EL HISTORIAL.
		if ($resul) { 
			print '<span id="varError" style="display:none;">Búsqueda eliminada con éxito</span>';
			//REDIRIGIR A LA PÁGINA DE INICIO.
			header('Location:index.php?location=busqueda'); 
		//ACCIÓN SI EL RESULTADO DEVUELTO ES FALSO.
		}else{ 
		   print '<span id="varError" style="display:none;">No se ha podido eliminar la búsqueda</span>';
			//REDIRIGIR A LA PÁGINA DE INICIO.
			header('Location:index.php?location=busqueda?id='.$codBusqueda); 
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
		<a href=""><div><img src="./webroot/css/images/github.png" width="50px"></div></a>
	</footer> 
</div>
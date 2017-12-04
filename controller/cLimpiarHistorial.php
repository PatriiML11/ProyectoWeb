<?php 
/* 
* CONTROLADOR DE LA PÁGINA DE LIMPIAR EL HISTORIAL.
* REALIZA LA LIMPIEZA DEL HISTORIAL DE BÚSQUEDAS.
* 
* @author PATRICIA MARTÍNEZ LUCENA
* @version 1.0.0 
*/ 
//SI SE HA INICIADO LA SESIÓN DEL USUARIO.
if(isset($_SESSION['usuario'])){
	//INCLUIR LA CLASE BÚSQUEDA.
	require_once 'model/Busqueda.php';
	//INCLUIR LA VISTA GENERAL DE TODAS LAS PÁGINAS.
	include 'view/layout.php';
	//SI SE HA PULSADO EL BOTÓN DE LIMPIAR HISTORIAL RECOGE EL RESULTADO DEVUELTO POR LA CONSULTA DE LA CLASE BÚSQUEDA: LIMPIAR HISTORIAL.
	if(isset($_POST['limpiarhistorial'])){
		$resul=Busqueda::limpiarHistorial("");
		//SI EL RESULTADO DEVUELTO ES VERDADERO Y SE HA BORRADO EL HISTORIAL.
		if ($resul) { 
			//MOSTRAR UN MENSAJE.
			print '<span id="varError" style="display:none;">Historial eliminado con éxito</span>';
			//REDIRIGIR A LA PÁGINA DEL HISTORIAL.
			header('Refresh: 1;url=index.php?location=busqueda'); 
		}else{ 
			//MOSTRAR UN MENSAJE.
			print '<span id="varError" style="display:none;">No se ha podido eliminar el historial</span>';
			//REDIRIGIR A LA PÁGINA DEL HISTORIAL.
			header('Refresh: 1;url=index.php?location=busqueda'); 
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
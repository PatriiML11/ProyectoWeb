<?php 
/* 
* CONTROLADOR DE LA PÁGINA DE LIMPIAR EL HISTORIAL.
* REALIZA LA LIMPIEZA DEL HISTORIAL DE BÚSQUEDAS.
* 
* @author PATRICIA MARTÍNEZ LUCENA
* @version 1.0.0 
*/ 
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
        echo '<p>Historial eliminado con éxito</p>'; 
		//REDIRIGIR A LA PÁGINA DEL HISTORIAL.
        header('Refresh: 1;url=index.php?location=busqueda'); 
    }else{ 
        echo 'No se ha podido eliminar el historial'; 
		//REDIRIGIR A LA PÁGINA DEL HISTORIAL.
        header('Refresh: 1;url=index.php?location=busqueda'); 
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
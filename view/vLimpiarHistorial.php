<?php 
/* 
* Vista Borrar.
* Interface de borrado de departamento.
* 
* @author Patricia Martínez Lucena
* @version 1.0.0
*/ 
require_once 'model/Busqueda.php';
?> 
<div class="cabecera">
	<h1>TRAYECTOS EN ESPAÑA</h1>
	<?php
		if(isset($_SESSION['usuario'])){
			print '<div class="botonesinicio"><a href="index.php?location=logoff"><input type="button" id="logoff" name="logoff" value="Cerrar Sesión"></a><a href="index.php?location=perfil"><input type="button" id="perfil" name="perfil" value="Ver Perfil"></a><a href="index.php?location=busqueda"><input type="button" id="busqueda" name="busqueda" value="Ver Historial"></a></div>';
		}else{
			print '<div class="botonesinicio"><a href="index.php?location=login"><input type="button" id="login" name="login" value="login"></a><a href="index.php?location=registro"><input type="button" id="registro" name="registro" value="registro"></a></div>';	
		}
	?>
</div>
<div id="borrar">
	<div class="formularios formborrarbusqueda">
		<form class="formulario" method="post" name="formu1" class="formu1">
		<div class="datos">
			<div class="titulo">
				<h2>LIMPIAR HISTORIAL</h2>
			</div>
		</div>
			<div class="botones">
				<a href="./index.php?location=limpiarhistorial"><input type="submit" name="limpiarhistorial" value="Limpiar Historial"/></a>
				<a href="index.php?location=busqueda"> <input type="button" name="volver" value="Volver"/></a>
			</div>
		</form>
	</div>
</div>


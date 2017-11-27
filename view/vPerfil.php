<?php
/*
 * Vista del Perfil del Usuario.
 *
 * @author Patricia Martínez Lucena
 * @version 1.0.0
 */
	require_once 'model/Usuario.php';
	$codUsuario=$_SESSION['usuario']->getCodUsuario();
	$_SESSION['usulista']=Usuario::buscarUsuario($codUsuario);
?>
<div class="cabecera">
	<h1>TRAYECTOS EN ESPAÑA</h1>
	<?php
		if(isset($_SESSION['usuario'])){
			print '<div class="botonesinicio"><a href="index.php?location=logoff"><input type="button" id="logoff" name="logoff" value="Cerrar Sesión"></a><a href="index.php?location=busqueda"><input type="button" id="busqueda" name="busqueda" value="Ver Historial"></a><a href="index.php?location=inicio"> <input type="button" name="volver" value="Volver"/></a></div>';
		}
	?>
</div>
<div class="formulario">
	<div class="datos">
		<div class="titulo">
			<h2>DATOS DEL USUARIO</h2>
		</div>
		<div>
			<label>USUARIO</label>
			<?php
				$codUsuario=$_SESSION['usulista']->getCodUsuario();
				print "<p>".$codUsuario."</p>";
			?>
		</div>
		<div>
			<label>NOMBRE DE USUARIO</label>
			<?php
				$nomUsuario=$_SESSION['usulista']->getNomUsuario();
				print "<p>".$nomUsuario."</p>";
			?>
		</div>
		<div>
			<label>EMAIL</label>
			<?php
				$email=$_SESSION['usulista']->getEmail();
				print "<p>".$email."</p>";
			?>
		</div>
		<div id="logosusuario">
			<?php
				print "<a href='index.php?location=editarusuario' name='editarusuario'><img src='./webroot/css/images/editarusuario.png' alt='editarUsuario' /></a>";
			?>
			<?php
				print '<a href="index.php?location=borrarusuario&id=$codUsuario"><img src="./webroot/css/images/eliminarusuario.png" alt="eliminarUsuario" /></a>';
			?>
		</div>
	</div>
</div>
</div> 

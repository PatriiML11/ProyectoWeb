<?php
/*
 * VISTA DE LA VENTANA DE REGISTRO DE USUARIO.
 *
 * @author Patricia Martínez Lucena
 * @version 1.0.0
 */
//UTILIZA LA CLASE USUARIO.
require_once 'model/Usuario.php';
?>
<div class="cabecera">
	<h1>TRAYECTOS EN ESPAÑA</h1>
</div>
<div id='login'> 
	<form class="formulario" action='index.php?location=registro' method="post" name="formu1" class="formu1">
		<div class="datos">	
			<div class="titulo">
				<h2>CREAR USUARIO</h2>
			</div>
			<div id="contError">
				<span id="error"></span>
				<span id="errorcampos"></span>
			</div>
			<div id="div1">
				<span class="error"><?php if(!empty($errores['codUsuario'])){echo $errores['codUsuario'];} ?></span>
				<p>Usuario <br/><input type="text" name="codUsuario" />
			</div>
			<div>
				<span class="error"><?php if(!empty($errores['nomUsuario'])){echo $errores['nomUsuario'];} ?></span>
				<p>Nombre de Usuario <br/><input type="text" name="nomUsuario"/>
			</div>	
			<div>
				<span class="error"><?php if(!empty($errores['email'])){echo $errores['email'];} ?></span> 
				<p>Email <br/><input type="text" name="email" />
			</div>
			<div>
				<span class="error"><?php if(!empty($errores['password'])){echo $errores['password'];} ?></span>
				<p>Password <br/><input type="password" name="password"/>
			</div>
		</div>
		<div class="botones">
			<a href="./index.php?location=registro"><input type="submit" name="registro" value="Aceptar"/></a>
			<a href="index.php?location=inicio"> <input type="button" name="volver" value="Cancelar"/></a>
		</div>
	</form>
</div> 
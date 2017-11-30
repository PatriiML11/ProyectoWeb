<?php 
/* 
* VISTA BORRAR.
* INTERFACE DE BORRADO DE DEPARTAMENTO.
* 
* @author Patricia Martínez Lucena
* @version 1.0.0
*/ 
//INCLUIR LA CLASE USUARIO.
require_once 'model/Usuario.php';
//ALMACENAR EN UNA VARIABLE EL USUARIO.
$usuario=Usuario::buscarUsuario($_SESSION['usuario']->getCodUsuario());
$codUsuario=$usuario->getCodUsuario();
//ALMACENAR EL USUARIO EN LA SESIÓN
$_SESSION['usuarioBorr']=$usuario;
?> 
<div class="cabecera">
	<h1>TRAYECTOS EN ESPAÑA</h1>
	<?php
		//SI SE HA INICIADO SESIÓN MUESTRA UNOS BOTONES. SI NO, MUESTRA OTROS.
		if(isset($_SESSION['usuario'])){
			print '<div class="botonesinicio"><a href="index.php?location=logoff"><input type="button" id="logoff" name="logoff" value="Cerrar Sesión"></a><a href="index.php?location=perfil"><input type="button" id="perfil" name="perfil" value="Ver Perfil"></a><a href="index.php?location=busqueda"><input type="button" id="busqueda" name="busqueda" value="Ver Historial"></a></div>';
		}else{
			print '<div class="botonesinicio"><a href="index.php?location=login"><input type="button" id="login" name="login" value="login"></a><a href="index.php?location=registro"><input type="button" id="registro" name="registro" value="registro"></a></div>';	
		}
	?>
</div>
<div id="borrar">
	<div class="formularios">
		<form class="formulario" method="post" name="formu1" class="formu1">
			<div class="datos">
				<div class="titulo">
					<h2>ELIMINAR USUARIO</h2>
				</div>
				<div id="contError">
					<span id="error"></span>
					<span id="errorcampos"></span>
				</div>
				<div id="div1">
					<label>Usuario</label><br/>
					<input type="text" name="codUsuario" value="<?php print $_SESSION['usuarioBorr']->getCodUsuario(); ?>" readonly/><br/>
				</div>
				<div>
					<label>Nombre de usuario</label><br/>
					<input type="text" name="nomUsuario" value="<?php print $_SESSION['usuarioBorr']->getNomUsuario(); ?>"  readonly/><br/>
				</div>
				<div>
					<label>Email</label><br/>
					<input type="text" name="email" value="<?php print $_SESSION['usuarioBorr']->getEmail(); ?>" readonly/><br/>
				</div>
			</div>
			<div class="botones">
				<a href="./index.php?location=borrarusuario"><input type="submit" name="borrar" value="Aceptar"/></a>
				<a href="index.php?location=perfil"> <input type="button" name="volver" value="Cancelar"/></a>
			</div>
		</form>
	</div>
</div>

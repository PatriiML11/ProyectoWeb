<?php 
/* 
* VISTA MODIFICACIÓN DE USUARIO.
* INTERFACE DE LA MODIFICACIÓN DE UN USUARIO.
* 
* @author Patricia Martínez Lucena
* @version 1.0.0
*/ 
//INCLUIR LA CLASE USUARIO.
require_once 'model/Usuario.php';
//RECUPERAR CODIGO SELECCIONADO EN LA PÁGINA ANTERIOR.
$codUsuario=$_SESSION['usuario']->getCodUsuario();
//ALMACENAR EN UNA VARIABLE EL DEPARTAMENTO RECIBIDO.
$usuario=Usuario::buscarUsuario($codUsuario);
//ALMACENAR EN VARIABLES LOS DISTINTOS VALORES RECIBIDOS. 
$codUsuario=$usuario->getCodUsuario();
$nomUsuario=$usuario->getNomUsuario();
$email=$usuario->getEmail();
$password=$usuario->getPassword();
//ALMACENAR EN UNA SESIÓN EL DEPARTAMENTO A MODIFICAR.
$_SESSION['usuarioModific']=$usuario;
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
<div class="formularios">
	<form class="formulario" action="./index.php?location=editarusuario" method="post" name="formu1" class="formu1">
		<div class="datos">
			<div class="titulo">
				<h2>EDITAR USUARIO</h2>
			</div>
			<div id="contError">
				<span id="error"><?php if(!empty($errores['codUsuario'])){echo $errores['codUsuario'];} ?></span>
				<span id="errorcampos"></span>
			</div>
			<div id="div1">
				<span class="error"><?php if(!empty($errores['codUsuario'])){echo $errores['codUsuario'];} ?></span> <br/>
				<label>Usuario </label><br/>
				<input type="text" name="codUsuario" value="<?php print $_SESSION['usuarioModific']->getCodUsuario(); 
				?>" readonly/>
			</div>
			<div>
				<span class="error"><?php if(!empty($errores['nomUsuario'])){echo $errores['nomUsuario'];} ?></span> <br/>
				<label>Nombre de Usuario </label><br/>
				<input type="text" name="nomUsuario" value="<?php print $_SESSION['usuarioModific']->getNomUsuario(); 
				?>"/>
			</div>	
			<div>
				<span class="error"><?php if(!empty($errores['password'])){echo $errores['password'];} ?></span> <br/>
				<label>Password antigua </label><br/>
				<input type="password" name="password"/>
			</div>	
			<div>
				<span class="error"><?php if(!empty($errores['passwordnuevo'])){echo $errores['passwordnuevo'];} ?></span> <br/>
				<label>Nueva password </label><br/>
				<input type="password" name="passwordnuevo"/>
			</div>	
			<div>
				<span class="error"><?php if(!empty($errores['email'])){echo $errores['email'];} ?></span> <br/>
				<label>Email </label><br/>
				<input type="text" name="email" value="<?php print $_SESSION['usuarioModific']->getEmail(); 
				?>" />
			</div>
		</div>
		<div class="botones botoneseditar">
			<a href="./index.php?location=editarusuario"><input type="submit" name="editar" value="Aceptar"/></a>
			<a href="index.php?location=perfil"> <input type="button" name="volver" value="Cancelar"/></a>
		</div>
		<span><?php print($_SESSION['editado']); ?></span>
	</form>
</div>
 
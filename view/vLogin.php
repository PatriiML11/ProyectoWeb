<?php
/*
 * Comprueba si el usuario introducido coincide con el de la base de datos.
 *
 * @author Patricia Martínez Lucena
 * @version 1.0.0
 */
require_once 'model/Usuario.php';
?><div class="cabecera">
	<h1>TRAYECTOS EN ESPAÑA</h1>
</div>
<div id='login'> 
    <form class="formulario" action='index.php?location=login' method='post'> 

            
            <div class='datos'> 
                <div class="titulo">
                    <h2>INICIAR SESIÓN</h2>
                </div>
				<br/>
				<span class="error"><?php if(!empty($_SESSION['error'])){print $_SESSION['error'];} ?></span> 
                <div>
                    <label for='usuario' >Usuario</label><br/> 
                    <input type='text' name='usuario' id='usuario' maxlength="50" /><br/> 
                </div>
                <div>   
                    <label for='password' >Contrase&ntilde;a</label><br/> 
                    <input type='password' name='password' id='password' maxlength="50" /><br/> 
                </div>
            </div> 
                <div class='botones'> 
                    <input type='submit' name='enviar' value='Aceptar' /> 
                    <a href="index.php"> <input type='button' name='volver' value='Cancelar' /></a><br/>
                    <a href="index.php?location=registro"> <p>¿No te has registrado?</p></a>
                </div> 

    </form>   
</div> 


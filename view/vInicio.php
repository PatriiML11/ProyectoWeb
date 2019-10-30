<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIVILtTPgoNNwy5aHiZdkrUjm0ia1LtxM" type="text/javascript"></script>
<script>
	function sesion(){
		salida=document.getElementById('desde').value;
		llegada=document.getElementById('address').value;
		autopista=document.getElementById('autopista').checked;
		if(document.getElementById('desde').value.length !=0 && document.getElementById('address').value.length !=0){
			sessionStorage.setItem("salida",salida+",spain");
			sessionStorage.setItem("llegada",llegada+",spain");
			sessionStorage.setItem("autopista",autopista);
			return true;  
		}
	}
	var patron=/^[a-zA-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇ\s,\/]+$/;
	function validacionsalida(){  
		var camposalida = document.getElementById("desde");  
		//SI EL CAMPO ESTÁ VACÍO  
		if(camposalida.value.length < 1){  
			sessionStorage.setItem("errorsalida","Campo vacío");
			return false;  
		}  
		//SI NO COINCIDE CON EL PATRÓN
		else if(!camposalida.value.match(patron)){  
			sessionStorage.setItem("errorsalida","Introduce solo letras");
			return false;  
		}  
		//SI COINCIDE CON EL PATRÓN 
		else{  
			sessionStorage.setItem("errorsalida",""); 
			return true;  
		}  
	}  
	function validacionllegada(){  
        var campollegada = document.getElementById("address");  
		//SI EL CAMPO ESTÁ VACÍO  
		if(campollegada.value.length < 1){  
			sessionStorage.setItem("errorllegada","Campo vacío");
			return false;  
		}  
		//SI NO COINCIDE CON EL PATRÓN 
		else if(!campollegada.value.match(patron)){  
			sessionStorage.setItem("errorllegada","Introduce solo letras"); 
			return false;  
		}  
		//SI COINCIDE CON EL PATRÓN  
		else{  
			sessionStorage.setItem("errorllegada","");
			return true;  
		}  
	}  
	var map;
	var marker;
	var directionsDisplay;
	var directionsDisplay=new google.maps.DirectionsRenderer();
	var directionsService = new google.maps.DirectionsService();
	if (window.outerWidth>1000){
		var map = new google.maps.Map(document.getElementById('map'), {
		  zoom: 6,
		  center: {lat: 39.6693985, lng: -4.0645625}
		});
		directionsDisplay.setMap(map);
	}
	if (window.outerWidth<1000){
		var map2 = new google.maps.Map(document.getElementById('map'), {
	  zoom: 5,
	  center: {lat: 39.6693985, lng: -4.0645625}
	});
		directionsDisplay.setMap(map2);
	}
</script>
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
<div id="contenidoinicio">
	<form name="formu" class="formularioinicio" action="index.php?location=inicio" method="POST">
		<div class="datos">
			<div class="titulo">
				<h2>REALIZAR BÚSQUEDA</h2>
			</div>
			<div>
				<span id="errorsalida"><?php if(!empty($errores['salida'])){print $errores['salida'];} ?></span><br/>
				<label>Lugar de salida</label><br/>
				<input type="text" name="salida" id="desde"><br/>
			</div>
			<div>
				<span id="errorllegada"><?php if(!empty($errores['llegada'])){print $errores['llegada'];} ?></span><br/>
				<label>Lugar de llegada</label><br/>
				<input type="text" name="llegada" id="address"><br/>
			</div>
			<div>
				<label><input type="checkbox" name="autopista" id="autopista"> Evitar Autopistas</label><br/>
			</div>
		</div>
		<div class="botones">
			<a href="index.php?location=inicio"><input type="submit" id="submit" name="aceptar" value="Aceptar" onclick="sesion();validacionsalida();validacionllegada();"></a>
			<div id="botonvolver"></div>
		</div>
		
	</form>
	<div id="map"></div>
</div>

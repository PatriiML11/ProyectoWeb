﻿<?php
/* 
* CONTROLADOR DE LA PÁGINA DE INICIO.
* REALIZA LAS BÚSQUEDAS.
* 
* @author PATRICIA MARTÍNEZ LUCENA
* @version 1.0.0
*/ 
//INCLUIR LA CLASE BÚSQUEDA.
require_once 'model/Busqueda.php';	
//INCLUIR LA VISTA GENERAL DE LAS PÁGINAS.
include 'view/layout.php';
$entradaOK=false;
//INICIALIZAR ARRAY PARA ALMACENAR LOS VALORES DE LOS CAMPOS.
$campos=[
	'salida'=>'',
	'llegada'=>''
];
//INICIALIZAR ARRAY DE ALMACENAMIENTO DE ERRORES.
$errores=[
	'salida'=>'',
	'llegada'=>''
];
//ACCIÓN SI SE PULSA EL BOTÓN ACEPTAR.
if(isset($_POST['aceptar'])){
	$entradaOK=true;
	$fraseimg="";
	//RECOGER EN UN ARRAY LOS VALORES DE LOS CAMPOS DEL FORMULARIO.
	$campos['salida']=$_POST['salida'];
	$campos['llegada']=$_POST['llegada'];
	//INCLUIR LA LIBRERÍA DE FUNCIONES
	include "core/funciones.php";
	if(validardireccion($campos['salida'])){
		$entradaOK=false;
		//ALMACENAR EN EL ARRAY EL ERROR RECIBIDO.
		$errores['salida']=validardireccion($campos['salida']);
		$campos['salida']="";
	}
	if(validardireccion($campos['llegada'])){
		$entradaOK=false;
		//ALMACENAR EN EL ARRAY EL ERROR RECIBIDO.
		$errores['llegada']=validardireccion($campos['llegada']);
		$campos['llegada']="";
	}
}
if($entradaOK){
	//URL DEL SERVICIO REST DE LA API DE GOOGLE (DISTANCIA Y DURACIÓN).
	if(isset($_POST['autopista'])){
		$gmUrl="https://maps.googleapis.com/maps/api/distancematrix/json?region=es?country=spain?language=es?units=imperial&avoid=tolls&origins=".urlencode($campos['salida']).urlencode(", españa")."&destinations=".urlencode($campos['llegada']).urlencode(", españa")."&key=AIzaSyBOTmJGCrDskI_CD6DePfvmP-SCsKLRRT0";
	}else{
		$gmUrl="https://maps.googleapis.com/maps/api/distancematrix/json?region=es?country=spain?language=es?units=imperial&origins=".urlencode($campos['salida']).urlencode(", españa")."&destinations=".urlencode($campos['llegada']).urlencode(", españa")."&key=AIzaSyBOTmJGCrDskI_CD6DePfvmP-SCsKLRRT0";
	}
	//ARCHIVO JSON QUE RECIBE LA URL.
	$gmJson = @file_get_contents($gmUrl);
	if ($gmJson === false) {
	   print("<span class='errorphp'>NO SE PUEDE ACCEDER A LA URL GMAPS</span>");
	}else{
		//ARRAY QUE DEVUELVE EL JSON DE LA API.
		$gmArray=json_decode($gmJson,true);
		//print "<pre>";
		//print_r($gmArray);
		//print "</pre>";
		//CONTROLES DE ERRORES.
		$destino=$gmArray['destination_addresses'][0];
		$origen=$gmArray['origin_addresses'][0];
		if(strpos($destino,"Balear")!==false||strpos($destino,"Canary Islands")!==false||strpos($destino,"Las Palmas")!==false||strpos($destino,"Tenerife")!==false||strpos($destino,"Ceuta")!==false||strpos($destino,"Melilla")!==false||strpos($origen,"Balear")!==false||strpos($origen,"Canary Islands")!==false||strpos($origen,"Las Palmas")!==false||strpos($origen,"Tenerife")!==false||strpos($origen,"Ceuta")!==false||strpos($origen,"Melilla")!==false){
			print '<span id="varError" style="display:none;">El trayecto solo se realiza en coche</span>';
			?>
			<script>
				sessionStorage.setItem("salida","");
				sessionStorage.setItem("llegada","");
				document.getElementById("error").innerHTML=document.getElementById("varError").innerHTML;
			</script>	
			<?php
		}elseif($gmArray['rows'][0]['elements'][0]['status'] == "OVER_QUERY_LIMIT" || $gmArray['rows'][0]['elements'][0]['status'] == "REQUEST_DENIED"){
			print '<span id="varError" style="display:none;">Hay un problema con el servicio REST</span>';
			?>
			<script>
				sessionStorage.setItem("salida","");
				sessionStorage.setItem("llegada","");
				document.getElementById("error").innerHTML=document.getElementById("varError").innerHTML;
			</script>	
			<?php
		}elseif($gmArray['rows'][0]['elements'][0]['status'] == "UNKNOWN_ERROR"){
			print '<span id="varError" style="display:none;">Hay un problema desconocido</span>';
			?>
			<script>
				sessionStorage.setItem("salida","");
				sessionStorage.setItem("llegada","");
				document.getElementById("error").innerHTML=document.getElementById("varError").innerHTML;
			</script>	
			<?php
		}elseif($gmArray['rows'][0]['elements'][0]['status'] == "INVALID_REQUEST"){
			print '<span id="varError" style="display:none;">La solicitud no es válida</span>';
			?>
			<script>
				sessionStorage.setItem("salida","");
				sessionStorage.setItem("llegada","");
				document.getElementById("error").innerHTML=document.getElementById("varError").innerHTML;
			</script>	
			<?php
		}elseif($gmArray['rows'][0]['elements'][0]['status'] == "NOT_FOUND" || $gmArray['rows'][0]['elements'][0]['status'] == "ZERO_RESULTS"){
			print '<span id="varError" style="display:none;">No se ha encontrado la búsqueda</span>';
			?>
			<script>
				sessionStorage.setItem("salida","");
				sessionStorage.setItem("llegada","");
				document.getElementById("error").innerHTML=document.getElementById("varError").innerHTML;
			</script>	
			<?php
		}elseif(!strpos($gmArray['destination_addresses'][0],"Spain") || !strpos($gmArray['origin_addresses'][0],"Spain")){
			print '<span id="varError" style="display:none;">Trayecto no válido</span>';
			?>
			<script>
				sessionStorage.setItem("salida","");
				sessionStorage.setItem("llegada","");
				document.getElementById("error").innerHTML=document.getElementById("varError").innerHTML;
			</script>
			<?php
		}else{
			//ALMACENAR VALORES PARA QUE JAVASCRIPT LOS INTERPRETE.
			$salida=$gmArray['origin_addresses'][0];
			$llegada=$gmArray['destination_addresses'][0];
			print '<p id="sal" style="display:none;">'.$salida.'</p>';
			print '<p id="lleg" style="display:none;">'.$llegada.'</p>';
			?>
			<script>
				sessionStorage.setItem("salida",document.getElementById("sal").innerHTML);
				sessionStorage.setItem("llegada",document.getElementById("lleg").innerHTML);
			</script>
			<?php
			//ALMACENAR EN VARIABLES LOS DATOS DEVUELTOS POR EL ARRAY.
			$distancia=$gmArray['rows'][0]['elements'][0]['distance']['value'];
			$duracion=$gmArray['rows'][0]['elements'][0]['duration']['text'];
			$distancia=(int)$distancia;
			//SI LA DISTANCIA EN METROS ES MAYOR QUE 1000, SE PASA A KM.
			if($distancia>1000){
				$distancia=$distancia/1000;
				$distancia=$distancia.' Km';
			}else{
				$distancia=$distancia.' m';
			}
			//CAMBIAR LA INFORMACIÓN DEVUELTA AL ESPAÑOL.
			$duracion=str_replace('min', 'minuto', $duracion);
			$duracion=str_replace('hour', 'hora', $duracion);
			//SACAR EL VALOR DE LAS HORAS QUE DURA EL TRAYECTO.
			$trayecto=trim(substr($duracion,0,2));
			if($trayecto==0){
				$trayecto=trim(substr($duracion,0,1));
			}
			//REDONDEAMOS SI NO LLEGA A UNA HORA.
			if(strpos($duracion,'minuto') && !strpos($duracion,'hora')){
				if($trayecto>=30){
					$trayecto=1;
				}else{
					$trayecto=0;
				}
			}
			//SI EL LUGAR DE SALIDA Y EL DE LLEGADA ES EL MISMO, LA DISTANCIA Y LA DURACIÓN ES 0.
			if($gmArray['destination_addresses'][0] == $gmArray['origin_addresses'][0]){
				$distancia='0';
				$duracion='0';
			}
			//CONVERTIR EN ARRAY LAS DIRECCIONES.
			$postalsalida = explode(',',$gmArray['origin_addresses'][0]); 
			$postalllegada = explode(',',$gmArray['destination_addresses'][0]); 
			print_r($postalllegada);
			
			//EXTRAER EL CÓDIGO POSTAL.
			$codpostal = preg_replace('/[^0-9]+/', '', $postalllegada[0]); 
			print $codpostal;
			if($codpostal == "" || $codpostal == 0 || strlen($codpostal)!=5){
				$codpostal = preg_replace('/[^0-9]+/', '', $postalllegada[1]);
				print "<br/>".$codpostal;
				if($codpostal == "" || $codpostal == 0 || strlen($codpostal)!=5){
					//UTILIZO EL OPERADOR DE CONTROL DE ERRORES POR SI NO EXISTE EL ÍNDICE 2.
					$codpostal = @preg_replace('/[^0-9]+/', '', $postalllegada[2]);
					print "<br/>".$codpostal;
				}
			}
			print "<br/> Codigo Postal ".$codpostal;
			//SI EL CAMPO DE LUGAR DE LLEGADA TIENE CÓDIGO POSTAL, LA API DEL TIEMPO COGERÁ LOS DATOS DEL CÓDIGO POSTAL.
			if($codpostal != "" || $codpostal != 0){
				//URL DE LA API REST DE LA PÁGINA DEL TIEMPO WEATHERBIT.IO UTILIZANDO EL CÓDIGO POSTAL.
				$tiempoUrl='https://api.weatherbit.io/v2.0/forecast/hourly?postal_code='.$codpostal.'&lang=es&key=9d1b4156f1cb4c7295d5d203d68969d9';
			//SI NO HAY CODIGO POSTAL, LA API DEL TIEMPO COGERÁ LOS DATOS DEL LUGAR DE LLEGADA.
			}else{
				//URL DE LA API REST DE LA PÁGINA DEL TIEMPO WEATHERBIT.IO UTILIZANDO EL VALOR ESCRITO EN EL CAMPO.
				$tiempoUrl='https://api.weatherbit.io/v2.0/forecast/hourly?city='.urlencode($campos['llegada']).'&lang=es&key=9d1b4156f1cb4c7295d5d203d68969d9';
			}
			//FORMATO JSON QUE DEVUELVE LA URL.
			$tiempoJson = @file_get_contents($tiempoUrl);
			//SI NO DEVUELVE NADA MUESTRA UN ERROR.
			if ($tiempoJson === false) {
			   print("NO SE PUEDE ACCEDER A LA URL TIEMPO <br/>");
			}
			//ARRAY QUE DEVUELVE EL JSON DE LA URL.
			$tiempoArray=json_decode($tiempoJson,true);
			if(empty($tiempoArray['data'][1])){
				//ALMACENAR LOS DATOS RECIBIDOS EN LAS VARIABLES.
				$temperatura="";
				$viento="";
				$humedad="";
				$frase="";
				$precipitacion="";
				$fecha=date("d-m-Y H:i:s");
				$fechaDB=date("Y-m-d H:i:s");
				$nubes="";
			}else{
				//ALMACENAR LOS DATOS RECIBIDOS EN LAS VARIABLES.
				$fecha=date("d-m-Y H:i:s");
				$fechaDB=date("Y-m-d H:i:s");
				//SACAR LA HORA ACTUAL.
				$hora=substr($fecha,-8,2);
				//CALCULAR LA HORA DE LLEGADA.
				$duraciontotal=$hora+$trayecto;
				//CONVERTIR LA HORA A LOS DATOS DEL ARRAY.
				if($duraciontotal>=24){
					$horaarray=$duraciontotal-24;
				}else{
					$horaarray=$duraciontotal;
				}
				//print "<pre>";
				//print_r($tiempoArray);
				//print "</pre>";
				//OBTENER LOS VALORES DEL ARRAY DEL SERVICIO REST.
				$temperatura=$tiempoArray['data'][$trayecto]['temp']." ºC";
				$viento=$tiempoArray['data'][$trayecto]['wind_spd']." m/s";
				$humedad=$tiempoArray['data'][$trayecto]['rh']." %";
				$frase=$tiempoArray['data'][$trayecto]['weather']['description'];
				$precipitacion=$tiempoArray['data'][$trayecto]['pop']." %";
				$nubes=$tiempoArray['data'][$trayecto]['clouds']." %";
				//MOSTRAR UNA IMAGEN EN LUGAR DEL TEXTO DESCRIPTIVO.
				if($frase=="Cielo despejado"){
					$fraseimg='<abbr title="Cielo Despejado"><img src="./webroot/css/images/3/sol.png" alt="cielo despejado" /></abbr>';
				}
				if($frase=="Cubierto"){
					$fraseimg='<abbr title="Cubierto"><img src="./webroot/css/images/3/nubes.png" alt="cubierto" /></abbr>';
				}
				if($frase=="Poco nuboso"){
					$fraseimg='<abbr title="Poco Nuboso"><img src="./webroot/css/images/3/poconublado.png" alt="poco nuboso" /></abbr>';
				}
				if($frase=="Nubes dispersas"){
					$fraseimg='<abbr title="Nubes Dispersas"><img src="./webroot/css/images/3/dispersas.png" alt="nubes dispersas" /></abbr>';
				}
				if($frase=="Lluvia ligera"){
					$fraseimg='<abbr title="Lluvia Ligera"><img src="./webroot/css/images/3/lluvia2.png" alt="lluvia ligera" /></abbr>';
				}
				if($frase=="Lluvia moderada"){
					$fraseimg='<abbr title="Lluvia Moderada"><img src="./webroot/css/images/3/lluvia3.png" alt="lluvia moderada" /></abbr>';
				}
				if($frase=="Lluvia"){
					$fraseimg='<abbr title="Lluvia"><img src="./webroot/css/images/3/lluvia3.png" alt="lluvia" /></abbr>';
				}
				if($frase=="Lluvia intensa"){
					$fraseimg='<abbr title="Lluvia Intensa"><img src="./webroot/css/images/3/lluvia3.png" alt="lluvia" /></abbr>';
				}
				if($frase=="Nevada ligera"){
					$fraseimg='<abbr title="Nevada Ligera"><img src="./webroot/css/images/3/nieveligera.png" alt="nevada ligera" /></abbr>';
				}
				if($frase=="Nevada" || $frase=="Nebada"){
					$fraseimg='<abbr title="Nevada"><img src="./webroot/css/images/3/nieve2.png" alt="nevada" /></abbr>';
				}
				if($frase=="Niebla"){
					$fraseimg='<abbr title="Niebla"><img src="./webroot/css/images/3/niebla.png" alt="niebla" /></abbr>';
				}
				if($frase=="Tormenta"){
					$fraseimg='<abbr title="Tormenta"><img src="./webroot/css/images/3/tormenta.png" alt="tormenta ligera" /></abbr>';
				}
				if($frase=="Viento"){
					$fraseimg='<abbr title="Viento"><img src="./webroot/css/images/3/viento.png" alt="viento" /></abbr>';
				}
				if($frase=="Calima"){
					$fraseimg='<abbr title="Calima"><img src="./webroot/css/images/3/calima.png" alt="calima" /></abbr>';
				}
			}
			//MOSTRAR LOS DATOS RECIBIDOS A TRAVÉS DE LAS VARIABLES.
			print '
			<form class="formubusqueda">
			<table id="resultado">
			<thead>
				<tr>
					<th><abbr title="fecha"><img src="./webroot/css/images/calendario.png" alt="fecha"/></abbr></th>
					<th><abbr title="salida"><img src="./webroot/css/images/salida.png" alt="salida"/></abbr></th>
					<th><abbr title="llegada"><img src="./webroot/css/images/llegada.png" alt="llegada"/></abbr></th>
					<th><abbr title="duracion"><img src="./webroot/css/images/tiempo.png" alt="tiempo"/></abbr></th>
					<th><abbr title="distancia"><img src="./webroot/css/images/distancia.png" alt="distancia"/></abbr></th>
					<th><abbr title="temperatura"><img src="./webroot/css/images/3/termometro.png" alt="temperatura"/></abbr></th>
					<th><abbr title="nubes"><img src="./webroot/css/images/3/nubes.png" alt="nubes"/></abbr></th>
					<th><abbr title="probabilidad de lluvia"><img src="./webroot/css/images/3/lluvia.png" alt="lluvia"/></abbr></th>
					<th><abbr title="humedad"><img src="./webroot/css/images/3/soltar.png" alt="nieve"/></abbr></th>
					<th><abbr title="viento"><img src="./webroot/css/images/3/viento.png" alt="nieve"/></abbr></th>
					<th><abbr title="tiempo a la hora de llegada"><img src="./webroot/css/images/info.png" alt="info"/></abbr></th>
				</tr>
			</thead>
			<tbody><tr>';
			print "<td>".$fecha."</td>";
			print "<td>".$campos['salida'].".<br/> ".$salida."</td>";
			print "<td>".$campos['llegada'].".<br/> ".$llegada."</td>";
			print "<td>".$duracion."</td>";
			print "<td>".$distancia."</td>";
			print "<td>".$temperatura."</td>";
			print "<td>".$nubes."</td>";
			print "<td>".$precipitacion."</td>";
			print "<td>".$humedad."</td>";
			print "<td>".$viento."</td>";
			print "<td>".$fraseimg."</td>";
			print "</tr/></tbody></table></form>";
			//SI SE HA INICIADO SESIÓN GUARDA LA BÚSQUEDA EN LA BASE DE DATOS.
			if(isset($_SESSION['usuario'])){
				$resul=Busqueda::insertarBusqueda($_SESSION['usuario']->getCodUsuario(),$fechaDB,$campos['salida'].", ".$salida,$campos['llegada'].", ".$llegada,$duracion,$distancia,$temperatura,$nubes,$precipitacion,$humedad,$viento,$frase);
				if(!$resul){
					print '<span id="varError" style="display:none;">No se ha podido guardar en la BBDD</span>';
					?>
					<script>
						document.getElementById("error").innerHTML=document.getElementById("varError").innerHTML;
					</script>
					<?php
				}
			}
		}
	}
}	
//SI SE PULSA EL BOTÓN LOGIN REDIRIGE A LA PÁGINA DE LOGIN.
if(isset($_POST['login'])){
	header('Location: index.php?location=login');
}
//SI SE PULSA EL BOTÓN REGISTRO REDIRIGE A LA PÁGINA DE REGISTRO.
if(isset($_POST['regiro'])){
	header('Location: index.php?location=registro');
}			
?>
<script>
	//SI EXISTEN ERRORES, LOS MUESTRA.
	$(document).ready(function(){
		//SI EXISTEN ERRORES, LOS MUESTRA.
		if($("#error").html().length!=0 || $("#errorcampos").html().length!=0){
			$("#div1").css("marginTop","10px");
			$("#contError").css("display","flex");
		}
	});
	//DEFINIR VARIABLES.
	var map;
	var marker;
	var directionsDisplay;
	//CREAR ALMACENAMIENTO LOCAL PARA LOS DOS CAMPOS.
	var salida = sessionStorage.getItem('salida');
	var llegada = sessionStorage.getItem('llegada');
	var autopista = sessionStorage.getItem('autopista');
	if(autopista === "true"){
		autopista=true;
	}else{
		autopista=false;
	}
	//CREAR ALMACENAMIENTO LOCAL PARA LOS DOS CAMPOS DE ERRORES.
	var errorcampos = sessionStorage.getItem('errorcampos');
	//DEFINIR VARIABLES PARA CREAR WAYPOINTS EN EL MAPA.
	var directionsDisplay=new google.maps.DirectionsRenderer();
	var directionsService = new google.maps.DirectionsService();
	function mapa(){
		//SI EL TAMAÑO DE LA VENTANA DEL NAVEGADOR O DISPOSITIVO ES MAYOR, SE MOSTRARÁ UN MAPA CON MÁS ZOOM
		if (window.outerWidth>1000 || screen.width>1000){
			//DEFINIR EL MAPA EN EL DIV CON ID=MAP, CON ZOOM 6 Y CENTRADO EN ESPAÑA.
			var map = new google.maps.Map(document.getElementById('map'), {
			  zoom: 6,
			  center: {lat:39.6693985 , lng:-4.0645625 }
			});
			directionsDisplay.setMap(map);
		}
		//SI EL TAMAÑO DE LA VENTANA DEL NAVEGADOR O DISPOSITIVO ES MENOR, SE MOSTRARÁ UN MAPA CON MENOS ZOOM
		if (window.outerWidth<=1000 || screen.width<=1000){
			//DEFINIR EL MAPA EN EL DIV CON ID=MAP, CON ZOOM 5 Y CENTRADO EN ESPAÑA.
			var map2 = new google.maps.Map(document.getElementById('map'), {
			  zoom: 5,
			  center: {lat: 39.6693985, lng: -4.0645625}
			});
			directionsDisplay.setMap(map2);
		}
	}
	mapa();
	if(errorcampos!==null){
		mostrarerrores();
	}
	//FUNCIÓN PARA CALCULAR EL WAYPOINT CON LOS DATOS ALMACENADOS.
	function calculaRuta(){
		//ALMACENAR LOS PARÁMETROS QUE NECESITA PARA CALCULAR LA RUTA.
		var datos={
			origin: salida,
			destination: llegada,
			travelMode:'DRIVING',
			avoidTolls: autopista,
			region:'es'
		};
		//INTENTAR CALCULAR LA RUTA CON LOS PARÁMETROS ANTERIORES.
		directionsService.route(datos, function(result,status){
			//SI EL ESTADO ES CORRECTO SIGNIFICA QUE HA PODIDO CALCULAR LA RUTA.
			if(status === "OK"){
				//INSERTAR LA RUTA CALCULADA EN EL MAPA.
				directionsDisplay.setDirections(result);
				return true;
			}else{
				return false;
			}
		}); 	
	}
	//FUNCIÓN PARA MOSTRAR LOS ERRORES DE LOS CAMPOS DE BÚSQUEDA.
	function mostrarerrores(){
		if(errorcampos.length>0){
			document.getElementById("errorcampos").innerHTML=errorcampos;
			document.getElementById("div1").style.marginTop="10px";
			document.getElementById("contError").style.display="flex";
			sessionStorage.setItem("errorcampos","");
		}
		if(errorcampos.length<1 && errorcampos.length<1){
			calculaRuta();
		}
	}
	//VACIAR LOS VALORES DE LA SESIÓN.
	sessionStorage.setItem("salida","");
	sessionStorage.setItem("llegada","");
</script>
</div>
	<footer>           
		<p>Autor: Patricia Martínez</p>
		<a href="https://github.com/PatriiML11/ProyectoWeb/tree/ProyectoWeb-VersionFinal" target="_blank"><div><img src="./webroot/css/images/github.png" width="50px"></div></a>
	</footer> 
</div>
<?php 
/*
 * VISTA DEL HISTORIAL DE BÚSQUEDAS DEL USUARIO.
 *
 * @author Patricia Martínez Lucena
 * @version 1.0.0
 */
 //INCLUIR LA CLASE BÚSQUEDA.
require_once 'model/Busqueda.php';
//ALMACENAR EN UNA VARIABLE EL CÓDIGO DEL USUARIO.
$codUsuario=$_SESSION['usuario']->getCodUsuario();
//CONTAR EL NÚMERO DE BÚSQUEDAS QUE TIENE.
$cuenta=Busqueda::contarBusquedas($codUsuario);
//SI NO ESTÁ VACÍO, LAS LISTA.
if($cuenta!=0){
	$_SESSION['lista']=Busqueda::listarBusquedas($codUsuario,$cuenta);
}else{
	$_SESSION['lista']="";
}
?>
<div class="cabecera">
	<h1>TRAYECTOS EN ESPAÑA</h1>
	<?php
		//SI SE HA INICIADO SESIÓN MUESTRA UNOS BOTONES. SI NO, MUESTRA OTROS.
		if(isset($_SESSION['usuario'])){
			print '<div class="botonesinicio"><a href="index.php?location=logoff"><input type="button" id="logoff" name="logoff" value="Cerrar Sesión"></a><a href="index.php?location=perfil"><input type="button" id="perfil" name="perfil" value="Ver Perfil"></a><a href="index.php?location=inicio"> <input type="button" name="volver" value="Volver"/></a></div>';
		}else{
			print '<div class="botonesinicio"><a href="index.php?location=login"><input type="button" id="login" name="login" value="login"></a><a href="index.php?location=registro"><input type="button" id="registro" name="registro" value="registro"></a><a href="index.php?location=inicio"> <input type="button" name="volver" value="Volver"/></a></div>';	
		}
	?>
</div>
	<form class="formubusqueda">	
<div class="botonesinicio">
	
</div>
<br/>
<?php
$fraseimg="";
if(!empty($_SESSION['lista'])){
	/*SALDRÍA UN ERROR AL INTENTAR ACCEDER A LA VARIABLE PÁGINA. 
	ANTEPONEMOS @ PARA QUE NO SUCEDA. 
	SOLO QUEREMOS SABER SI PUEDE ACCEDER O NO.*/
	@$pagina=$_GET['pagina'];
	if (!$pagina) {
	   $inicio=0;
	   $pagina=1;
	}
	$url='index.php?location=busqueda';
	$img1='<img src="./webroot/css/images/anterior.png" alt="anterior" width="30px" />';
	$img2='<img src="./webroot/css/images/siguiente.png" alt="siguiente" width="30px" />';
	$tamano=10;
	//CALCULAR EL TOTAL DE PÁGINAS
	$total_paginas=ceil($cuenta/$tamano);
	print '<table><thead>
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
					<th><img src="./webroot/css/images/info.png" alt="info"/></th>
					<th><a href="index.php?location=limpiarhistorial" name="limpiarhistorial">Limpiar Historial</a></td></a></th>
				</tr>
			</thead>
			<tbody>';
	//RECORRER LA SESIÓN DE BÚSQUEDA, LLAMANDO A CADA FILA DEVUELTA BÚSQUEDA.
	foreach($_SESSION['lista'] as $busqueda){
		//RECOGER CADA VALOR DE LA FILA DEVUELTA.
		$codBusqueda=$busqueda->getCodBusqueda();
		$codUsuario=$busqueda->getCodUsuario();
		$fecha=$busqueda->getFecha();
		$salida=$busqueda->getSalida();
		$llegada=$busqueda->getLlegada();
		$duracion=$busqueda->getDuracion();
		$distancia=$busqueda->getDistancia();
		$temperatura=$busqueda->getTemperatura();
		$nubes=$busqueda->getNubes();
		$precipitacion=$busqueda->getPrecipitacion();
		$humedad=$busqueda->getHumedad();
		$viento=$busqueda->getViento();
		$frase=$busqueda->getFrase();
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
		if($frase=="Lluvia"){
			$fraseimg='<abbr title="Lluvia"><img src="./webroot/css/images/3/lluvia3.png" alt="lluvia" /></abbr>';
		}
		if($frase=="Lluvia intensa"){
			$fraseimg='<abbr title="Lluvia Intensa"><img src="./webroot/css/images/3/lluvia3.png" alt="lluvia" /></abbr>';
		}
		if($frase=="Nevada ligera"){
			$fraseimg='<abbr title="Nevada Ligera"><img src="./webroot/css/images/3/nieveligera.png" alt="nevada ligera" /></abbr>';
		}
		if($frase=="Nieve"){
			$fraseimg='<abbr title="Nieve"><img src="./webroot/css/images/3/nieve2.png" alt="nevada ligera" /></abbr>';
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
		print "<tr>";
		print "<td>".$fecha."</td>";
		print "<td>".$salida."</td>";
		print "<td>".$llegada."</td>";
		print "<td>".$duracion."</td>";
		print "<td>".$distancia."</td>";
		print "<td>".$temperatura."</td>";
		print "<td>".$nubes."</td>";
		print "<td>".$precipitacion."</td>";
		print "<td>".$humedad."</td>";
		print "<td>".$viento."</td>";
		print "<td>".$fraseimg."</td>";
		print "<td>";
		echo "<a href='index.php?location=borrarbusqueda&id=$codBusqueda' name='borrar'><img src='webroot/css/images/borrar.png' alt='borrarbusqueda' width='30px' height='30px'/></a></td></a>";
		print "</td>";
		print "</tr></tbody>";
	}
	print "</table>";
	//SI HAY MAS DE 1 PÁGINA, SE MOSTRARÁ LA PAGINACIÓN.
	if ($total_paginas > 1) {
		echo '<div id="paginacion">';
		if ($pagina > 1){
			echo '<p><a href="'.$url.'&pagina='.($pagina-1).'">'.$img1.'</a></p>';
		}
		//CALCULAR EL NÚMERO TOTAL DE PÁGINAS.
		for ($i=1;$i<=$total_paginas;$i++) {
			//SI ES LA PÁGINA MOSTRADA, MUESTRA EL NÚMERO DE LA PÁGINA ACTUAL SIN ENLACE
			if ($pagina == $i){
				echo '<p>'.$pagina.'</p>';
			}else{
				//SI NO, MUESTRA EL NÚMERO CON ENLACE.
				echo '  <p><a href="'.$url.'&pagina='.$i.'">'.$i.'</a></p>  ';
			}	
		}
		//SI NO ES LA ÚLTIMA PÁGINA, MUESTRA UN ENLACE A LA SIGUIENTE PÁGINA.
		if ($pagina < $total_paginas){
			 echo '<p><a href="'.$url.'&pagina='.($pagina+1).'">'.$img2.'</a></p>';
		}
		echo '</div>';
	}
//SI NO HAY DATOS, MUESTRA UN MENSAJE.
}else{
	print '<span id="varError" style="display:none;">HISTORIAL VACÍO</span>';
}
?>
</form>
<!--
</div>
	<footer id="piehistorial">           
		<p>Autor: Patricia Martínez</p>
		<a href=""><div><img src="./webroot/css/images/github.png" width="50px"></div></a>
	</footer> 
</div>-->
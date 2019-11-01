<?php
/*
 * CLASE BUSQUEDAPDO.
 * SE DEFINEN MÉTODOS QUE UTILIZAN LA CLASE DBPDO.
 *
 * @author Patricia Martínez Lucena
 * @version 1.0.0
 */
//INCLUIR LA CLASE DBPDO.
require_once 'DBPDO.php';
class BusquedaPDO{   
	 /**
	 * OBTIENE UNA BÚSQUEDA
	 *
	 * @param int $codBusqueda CÓDIGO DE LA BÚSQUEDA
	 */
	public static function getBusqueda($codBusqueda){
		//CREAR ARRAY PARA ALMACENAR LA BÚSQUEDA
		$arrayBus=[];
		$sql="select * from Busqueda where codBusqueda like CONCAT('%', ?, '%')";
		$resul=DBPDO::ejecutaConsulta($sql,[$codBusqueda]);
		//ACCIÓN SI HA ENCONTRADO UN RESULTADO
		if($resul->rowCount()){
			//RECORRER CADA CAMPO DE LA FILA OBTENIDA
			$fila=$resul->fetchObject();
			//AÑADIR AL ARRAY LOS CAMPOS OBTENIDOS
			$arrayBus['codBusqueda']=$fila->codBusqueda;
			$arrayBus['codUsuario']=$fila->codUsuario;
			$arrayBus['fecha']=$fila->fecha;
			$arrayBus['salida']=$fila->salida;
			$arrayBus['llegada']=$fila->llegada;
			$arrayBus['distancia']=$fila->distancia;
			$arrayBus['duracion']=$fila->duracion;
			$arrayBus['temperatura']=$fila->temperatura;
			$arrayBus['nubes']=$fila->nubes;
			$arrayBus['precipitacion']=$fila->precipitacion;
			$arrayBus['humedad']=$fila->humedad;
			$arrayBus['viento']=$fila->viento;
			$arrayBus['frase']=$fila->frase;
		}
		return $arrayBus;
	}
	 /**
	 * CONTAR BÚSQUEDAS
	 * 
	 *	@param string $codUsuario CÓDIGO DEL USUARIO
	 */
	public static function contarBusquedas($codUsuario){
		//CREAR ARRAY PARA ALMACENAR LA BÚSQUEDA
		$cuenta=null;
		$sql="select * from Busqueda where codUsuario=?";
		$resul=DBPDO::ejecutaConsulta($sql,[$codUsuario]);	
		if($resul->rowCount()){ 
			$cuenta=$resul->rowCount();
		}
		return $cuenta;
	}
	/**
	 * LISTAR UN NÚMERO DETERMINADO DE BÚSQUEDAS BÚSQUEDAS.
	 * @param string $codUsuario CÓDIGO DEL USUARIO.
	 * @param int $cuenta NÚMERO DE BÚSQUEDAS QUE SE QUIERE RECOGER.
	 *
	 */
	public static function listarBusquedas($codUsuario,$cuenta){
		//CREAR ARRAY PARA ALMACENAR LA BÚSQUEDA
		$arrayBus=[];
		//LIMITO LA BUSQUEDA
		$tamano=10;
		//EXAMINO LA PÁGINA A MOSTRAR Y EL INICIO DEL REGISTRO A MOSTRAR
		$pagina = $_GET["pagina"];
		if (!$pagina) {
		   $inicio=0;
		   $pagina=1;
		}
		else {
		   $inicio=($pagina-1)*$tamano;
		}
		$sql="select * from Busqueda where codUsuario=?LIMIT ".$inicio.",".$tamano;
		$resul=DBPDO::ejecutaConsulta($sql,[$codUsuario]);	
		if($resul->rowCount()){ 
			$arrayBus=$resul->fetchAll();
		}
		return $arrayBus;
	}
	/**
	 * INSERTAR UNA BÚSQUEDA.
	 *
	 * @param int $codBusqueda CÓDIGO DE LA BÚSQUEDA
	 * @param string $codUsuario CÓDIGO DEL USUARIO
	 * @param date $fecha FECHA DE BÚSQUEDA
	 * @param string $salida LUGAR DE SALIDA
	 * @param string $llegada LUGAR DE LLEGADA
	 * @param string $distancia DISTANCIA ENTRE LOS DOS LUGARES
	 * @param string $duracion DURACIÓN DEL TRAYECTO
	 * @param string $temperatura TEMPERATURA EN EL LUGAR DE LLEGADA
	 * @param string $nubes PROBABILIDAD DE NUBES EN EL LUGAR DE LLEGADA
	 * @param string $precipitacion PROBABILIDAD DE PRECIPITACIÓN EN EL LUGAR DE LLEGADA
	 * @param string $humedad HUMEDAD RELATIVA EN EL LUGAR DE LLEGADA
	 * @param string $viento VELOCIDAD DEL VIENTO EN EL LUGAR DE LLEGADA
	 * @param string $frase FRASE DESCRIPTIVA DEL TIEMPO DEL LUGAR DE LLEGADA
	 */
	public static function insertarBusqueda($codUsuario,$fecha,$salida,$llegada,$distancia,$duracion,$temperatura,$nubes,$precipitacion,$humedad,$viento,$frase){
		$insertado=false;
		$sql='insert into Busqueda(codUsuario,fecha,salida,llegada,distancia,duracion,temperatura,nubes,precipitacion,humedad,viento,frase) values(?,?,?,?,?,?,?,?,?,?,?,?)';
		$resul=DBPDO::ejecutaConsulta($sql,[$codUsuario,$fecha,$salida,$llegada,$distancia,$duracion,$temperatura,$nubes,$precipitacion,$humedad,$viento,$frase]);
		if($resul->rowCount()){
			$insertado=true;
		}
		return $insertado;
	}
	/*
	 * ELIMINAR UNA BUSQUEDA.
	 *
	 * @param string $codBusqueda CÓDIGO DE LA BÚSQUEDA
	 */
	public static function borrarBusqueda($codBusqueda){
		$borrado=false;
		$sql='delete from Busqueda where codBusqueda=?';
		$resul=DBPDO::ejecutaConsulta($sql,[$codBusqueda]);
		if($resul->rowCount()){
			$borrado=true;
		}
		return $borrado;
	}
	/**
	 * LIMPIAR HISTORIAL DE BÚSQUEDAS.
	 *
	 */
	public static function limpiarHistorial(){
		$borrado=false;
		$sql='delete from Busqueda';
		$resul=DBPDO::ejecutaConsulta($sql,[""]);
		if($resul->rowCount()){
			$borrado=true;
		}
		return $borrado;
	}
}	
?>
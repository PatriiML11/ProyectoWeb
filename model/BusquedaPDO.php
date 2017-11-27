<?php
/*
 * Clase BusquedaPDO.
 * Se definen métodos que utilizan la clase DBPDO.
 *
 * @author Patricia Martínez Lucena
 * @version 1.0.0
 */
	require_once 'DBPDO.php';
	/*
	 * Definir clase.
	 */
	class BusquedaPDO{   
		 /**
	     * OBTIENE UNA BÚSQUEDA
	     *
	     * @param int $codBusqueda código de la búsqueda
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
	     * Listar un número determinado de búsquedas Búsquedas.
	     * @param string $codUsuario Código del usuario.
		 * @param int $cuenta Número de búsquedas que se quiere recoger.
	     *
	     */
		public static function listarBusquedas($codUsuario,$cuenta){
			//CREAR ARRAY PARA ALMACENAR LA BÚSQUEDA
	  		$arrayBus=[];
			//Limito la busqueda
			$tamano=10;
			//examino la página a mostrar y el inicio del registro a mostrar
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
 	     * @param int $codBusqueda Código de la búsqueda
	     * @param string $codUsuario Código del usuario
 	     * @param date $fecha Fecha de búsqueda
	     * @param string $salida Lugar de salida
	     * @param string $llegada Lugar de llegada
	     * @param string $distancia Distancia entre los dos lugares
	     * @param string $duracion Duración del trayecto
	     * @param string $temperatura Temperatura en el lugar de llegada
	     * @param string $nubes Probabilidad de nubes en el lugar de llegada
	     * @param string $precipitacion Probabilidad de precipitación en el lugar de llegada
	     * @param string $humedad Humedad relativa en el lugar de llegada
		 * @param string $viento Velocidad del viento en el lugar de llegada
	     * @param string $frase Frase descriptiva del tiempo del lugar de llegada
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
	     * @param string $codBusqueda Código de la búsqueda
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
	     * Limpiar historial de búsquedas.
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
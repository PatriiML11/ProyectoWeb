<?php
/*
 * Clase Búsqueda.
 * Se definen atributos y métodos de la clase.
 * Utiliza la clase BúsquedaPDO.
 *
 * @author Patricia Martínez Lucena
 * @version 1.0.0
 */
	/*
	 * Utiliza la clase UsuarioPDO.
	 */
	require_once 'BusquedaPDO.php';
	/*
	 * Definir clase.
	 */
	class Busqueda{
		/*
		 * Definir atributos de la clase.
		 */
		protected $codBusqueda;
		protected $codUsuario;
		protected $fecha;
		protected $salida;
		protected $llegada;
		protected $distancia;
		protected $duracion;
		protected $temperatura;
		protected $nubes;
		protected $precipitacion;
		protected $humedad;
		protected $viento;
		protected $frase;
		 /**
	     * Constructor del objeto.
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
		public function __construct($codBusqueda,$codUsuario,$fecha,$salida,$llegada,$distancia,$duracion,$temperatura,$nubes,$precipitacion,$humedad,$viento,$frase){
			$this->codBusqueda=$codBusqueda;
			$this->codUsuario=$codUsuario;
			$this->fecha=$fecha;
			$this->salida=$salida;
			$this->llegada=$llegada;
			$this->distancia=$distancia;
			$this->duracion=$duracion;
			$this->temperatura=$temperatura;
			$this->nubes=$nubes;
			$this->precipitacion=$precipitacion;
			$this->humedad=$humedad;
			$this->viento=$viento;
			$this->frase=$frase;
		}
		/**
	     * Obtener objeto busqueda.
	     *
	     * @param string $codBusqueda Código de la búsqueda
	     */
		public static function getBusqueda($codBusqueda){
			$busqueda=null;
			if($arrayBus=BusquedaPDO::getBusqueda($codBusqueda)){
				$busqueda=new Busqueda($arrayBus['codBusqueda'],$arrayBus['codUsuario'],$arrayBus['fecha'],$arrayBus['salida'],$arrayBus['llegada'],$arrayBus['distancia'],$arrayBus['duracion'],$arrayBus['temperatura'],$arrayBus['nubes'],$arrayBus['precipitacion'],$arrayBus['humedad'],$arrayBus['viento'],$arrayBus['frase']);
			}
			return $busqueda;
		}
	    
	  	/**
	     * Listar un número determinado de búsquedas Búsquedas.
	     * @param string $codUsuario Código del usuario.
		 * @param int $cuenta Número de búsquedas que se quiere recoger.
	     *
	     */
		public static function listarBusquedas($codUsuario,$cuenta){
	  		$lista=[];
	  		$arrayBus=BusquedaPDO::listarBusquedas($codUsuario,$cuenta);
			foreach($arrayBus as $fila){
				$busqueda=new Busqueda($fila['codBusqueda'],$fila['codUsuario'],$fila['fecha'],$fila['salida'],$fila['llegada'],$fila['distancia'],$fila['duracion'],$fila['temperatura'],$fila['nubes'],$fila['precipitacion'],$fila['humedad'],$fila['viento'],$fila['frase']);
				array_push($lista,$busqueda);
			}
			return $lista;
	  	}
		/**
	     * Contar todos los registros de una búsqueda.
		 * @param string $codUsuario Código del usuario.
	     *
	     */
		public static function contarBusquedas($codUsuario){
	  		return BusquedaPDO::contarBusquedas($codUsuario);
	  	}
	  	/**
	     * Insertar búsqueda.
	     *
	     * @param int $codBusqueda Código de la búsqueda
	     * @param string $codUsuario Código del usuario
 	     * @param date $fecha Fecha de búsqueda
	     * @param string $salida Lugar de salida
	     * @param string $llegada Lugar de llegada
	     * @param string $distancia Distancia entre los dos lugares
	     * @param string $duracion Duración del trayecto
	     * @param string $temperatura Temperatura en el lugar de llegada
	     * @param string $frase Frase descriptiva del tiempo del lugar de llegada
	     */
	  	public static function insertarBusqueda($codUsuario,$fecha,$salida,$llegada,$distancia,$duracion,$temperatura,$nubes,$precipitacion,$humedad,$viento,$frase){
	  		$insertado=false;
	  		$insertado=BusquedaPDO::insertarBusqueda($codUsuario,$fecha,$salida,$llegada,$distancia,$duracion,$temperatura,$nubes,$precipitacion,$humedad,$viento,$frase);
	  		return $insertado;
	  	}
	  	/**
	     * Borrar busqueda.
	     *
	     * @param string $codBusqueda Código de la búsqueda
	     */
	  	public static function borrarBusqueda($codBusqueda){
	  		return BusquedaPDO::borrarBusqueda($codBusqueda);
	  	}
		/**
	     * Limpiar historial de búsquedas.
	     *
	     */
	  	public static function limpiarHistorial(){
	  		return BusquedaPDO::limpiarHistorial();
	  	}
	    public function getCodBusqueda(){
			return $this->codBusqueda;
		}
		public function getCodUsuario(){
			return $this->codUsuario;
		}
		public function getFecha(){
			return $this->fecha;
		}
		public function getSalida(){
			return $this->salida;
		}
		public function getLlegada(){
			return $this->llegada;
		}
		public function getDistancia(){
			return $this->distancia;
		}
		public function getDuracion(){
			return $this->duracion;
		}
		public function getTemperatura(){
			return $this->temperatura;
		}
		public function getNubes(){
			return $this->nubes;
		}
		public function getPrecipitacion(){
			return $this->precipitacion;
		}
		public function getHumedad(){
			return $this->humedad;
		}
		public function getViento(){
			return $this->viento;
		}
		public function getFrase(){
			return $this->frase;
		}
	}
?>
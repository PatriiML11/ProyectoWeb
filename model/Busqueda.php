<?php
/*
 * CLASE BÚSQUEDA.
 * SE DEFINEN ATRIBUTOS Y MÉTODOS DE LA CLASE.
 * UTILIZA LA CLASE BÚSQUEDAPDO.
 *
 * @author Patricia Martínez Lucena
 * @version 1.0.0
 */
//INCLUIR LA CLASE DBPDO.
require_once 'BusquedaPDO.php';
class Busqueda{
	//DEFINIR ATRIBUTOS DE LA CLASE.
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
	 * CONSTRUCTOR DEL OBJETO.
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
	 * @param string $precipitacion PROBABILIDAD DE PRECIPITACIÓN EN EL LUGAR de llegada
	 * @param string $humedad HUMEDAD RELATIVA EN EL LUGAR DE LLEGADA
	 * @param string $viento VELOCIDAD DEL VIENTO EN EL LUGAR DE LLEGADA
	 * @param string $frase FRASE DESCRIPTIVA DEL TIEMPO DEL LUGAR DE LLEGADA
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
	 * OBTENER OBJETO BUSQUEDA.
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
	 * LISTAR UN NÚMERO DETERMINADO DE BÚSQUEDAS BÚSQUEDAS.
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
	 * CONTAR TODOS LOS REGISTROS DE UNA BÚSQUEDA.
	 * @param string $codUsuario Código del usuario.
	 *
	 */
	public static function contarBusquedas($codUsuario){
		return BusquedaPDO::contarBusquedas($codUsuario);
	}
	/**
	 * Insertar búsqueda.
	 *
	 * @param int $codBusqueda CÓDIGO DE LA BÚSQUEDA
	 * @param string $codUsuario CÓDIGO DEL USUARIO
	 * @param date $fecha FECHA DE BÚSQUEDA
	 * @param string $salida LUGAR DE SALIDA
	 * @param string $llegada LUGAR DE LLEGADA
	 * @param string $distancia DISTANCIA ENTRE LOS DOS LUGARES
	 * @param string $duracion DURACIÓN DEL TRAYECTO
	 * @param string $temperatura TEMPERATURA EN EL LUGAR DE LLEGADA
	 * @param string $frase FRASE DESCRIPTIVA DEL TIEMPO DEL LUGAR DE LLEGADA
	 */
	public static function insertarBusqueda($codUsuario,$fecha,$salida,$llegada,$distancia,$duracion,$temperatura,$nubes,$precipitacion,$humedad,$viento,$frase){
		$insertado=false;
		$insertado=BusquedaPDO::insertarBusqueda($codUsuario,$fecha,$salida,$llegada,$distancia,$duracion,$temperatura,$nubes,$precipitacion,$humedad,$viento,$frase);
		return $insertado;
	}
	/**
	 * BORRAR BUSQUEDA.
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
<?php
/*
 * CLASE DBPDO.
 * REALIZA LA CONEXIÓN Y LAS CONSULTAS CON LA BASE DE DATOS.
 *
 * @author Patricia Martínez Lucena
 * @version 1.0.0
 */
class DBPDO{
	//EJECUTA UNA CONSULTA CON LOS PARÁMETROS QUE SE PASEN.
	public static function ejecutaConsulta($sql,$parametros) {
		$host='localhost';
		$db='PML-Mapa';
		$user = 'root'; 
		$password = ''; 
		//INTENTA REALIZAR LA CONSULTA.    
		try{
			$conexion = new PDO('mysql:host='.$host.';dbname='.$db, $user, $password); 
			//REALIZA LA CONSULTA PREPARADA.
			$resultado = $conexion->prepare($sql); 
			//EJECUTA LA CONSULTA PREPARADA.
			$resultado->execute($parametros);
		//SI NO HA PODIDO REALIZAR LA CONSULTA, CAPTURA EL ERROR Y LO MUESTRA.
		}catch(PDOException $e){
			$resul=null;
			die("Error: " . $e->getMessage()); 
		}
		return $resultado; 
	} 
}
?>
	
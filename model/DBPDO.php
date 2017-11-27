<?php
/*
 * Clase DBPDO.
 * Realiza la conexión y las consultas con la base de datos.
 *
 * @author Patricia Martínez Lucena
 * @version 1.0.0
 */
	class DBPDO{   
	  	public static function ejecutaConsulta($sql,$parametros) {
		   	$host='localhost';
		   	$db='PML-Mapa';
		    $user = 'root'; 
			$password = ''; 
		         
		    try{
		    	$conexion = new PDO('mysql:host='.$host.';dbname='.$db, $user, $password); 
		 
		    	$resultado = $conexion->prepare($sql); 
		    	$resultado->execute($parametros);
		    }catch(PDOException $e){
		    	$resul=null;
		    	die("Error: " . $e->getMessage()); 
		    }
			return $resultado; 
		} 
	}
		
?>
	

<?php
/*
 * Clase UsuarioPDO.
 * Se definen métodos que utilizan la clase DBPDO.
 *
 * @author Patricia Martínez Lucena
 * @version 1.0.0
 */
	require_once 'DBPDO.php';
	/*
	 * Definir clase.
	 */
	class UsuarioPDO{   
		/**
	     * Función de validación de Usuario.
	     *
	     * @param string $codUsuario Código del usuario
	     * @param string $password Contraseña del usuario
	     */
	  	public static function validarUsuario($codUsuario,$password){
	  		//CREAR ARRAY PARA ALMACENAR EL USUARIO
	  		$user=[];
	  		$sql="select * from Usuario where codUsuario=? and password=?";
	  		$resul=DBPDO::ejecutaConsulta($sql,[$codUsuario, $password]);	
	 		//ACCIÓN SI HA ENCONTRADO UN RESULTADO
	  		if($resul->rowCount()){
	  			//RECORRER CADA CAMPO DE LA FILA OBTENIDA
	  			$usuario=$resul->fetchObject();
	  			//AÑADIR AL ARRAY LOS CAMPOS OBTENIDOS
	  			$user['codUsuario']=$usuario->codUsuario;
	  			$user['nomUsuario']=$usuario->nomUsuario;
				$user['email']=$usuario->email;
	  			$user['password']=$usuario->password;
	  		}
	  		return $user;
	  	}
	  	public static function buscarUsuario($codUsuario){
	  		//CREAR ARRAY PARA ALMACENAR EL USUARIO
	  		$user=[];
	  		$sql="select * from Usuario where codUsuario=?";
	  		$resul=DBPDO::ejecutaConsulta($sql,[$codUsuario]);	
	 		//ACCIÓN SI HA ENCONTRADO UN RESULTADO
	  		if($resul->rowCount()){
	  			//RECORRER CADA CAMPO DE LA FILA OBTENIDA
	  			$usuario=$resul->fetchObject();
	  			//AÑADIR AL ARRAY LOS CAMPOS OBTENIDOS
	  			$user['codUsuario']=$usuario->codUsuario;
	  			$user['nomUsuario']=$usuario->nomUsuario;
	  			$user['email']=$usuario->email;
				$user['password']=$usuario->password;
	  		}
	  		return $user;
	  	}
	  	public static function crearUsuario($codUsuario,$nomUsuario,$email,$password){
	  		$insertado=false;
	  		$sql="insert into Usuario(codUsuario,nomUsuario,email,password) values(?,?,?,?)";
	  		$resul=DBPDO::ejecutaConsulta($sql,[$codUsuario,$nomUsuario,$email,$password]);	
	  		if($resul->rowCount()){
	  			$insertado=true;
	  		}
	  		return $insertado;
	  	}
	  	public static function editarUsuario($nomUsuario,$email,$password,$codUsuario){
	  		//CREAR ARRAY PARA ALMACENAR EL USUARIO
	  		$user=[];
	  		$sql="update Usuario set nomUsuario=?, email=?, password=? where codUsuario=?";
	  		$resul=DBPDO::ejecutaConsulta($sql,[$nomUsuario,$email,$password,$codUsuario]);	
	 		//ACCIÓN SI HA ENCONTRADO UN RESULTADO
	  		if($resul->rowCount()){
	  			$sql2="select * from Usuario where codUsuario=?";
	  			$resul=DBPDO::ejecutaConsulta($sql2,[$codUsuario]);
	  			if($resul->rowCount()){
		  			//RECORRER CADA CAMPO DE LA FILA OBTENIDA
		  			$usuario=$resul->fetchObject();
		  			//AÑADIR AL ARRAY LOS CAMPOS OBTENIDOS
		  			$user['codUsuario']=$usuario->codUsuario;
	  				$user['nomUsuario']=$usuario->nomUsuario;
	  				$user['email']=$usuario->email;
					$user['password']=$usuario->password;
		  		}

	  		}
	  		return $user;
	  	}
	  	public static function borrarUsuario($codUsuario){
	  		$borrado=false;
	  		$sql="delete from Usuario where codUsuario=?";
	  		$resul=DBPDO::ejecutaConsulta($sql,[$codUsuario]);	
	  		//ACCIÓN SI HA ENCONTRADO UN RESULTADO
			if($resul->rowCount()){
	  			$borrado=true;
	  		}
	  		return $borrado;
	  	}
	  	
	}
		
?>

<?php
/*
 * CLASE USUARIO.
 * SE DEFINEN ATRIBUTOS Y MÉTODOS DE LA CLASE.
 * UTILIZA LA CLASE USUARIOPDO.
 *
 * @author Patricia Martínez Lucena
 * @version 1.0.0
 */
//INCLUIR LA CLASE USUARIOPDO.
require_once 'UsuarioPDO.php';
class Usuario{
	//ATRIBUTOS DE LA CLASE
	protected $codUsuario;
	protected $nomUsuario;
	protected $email;
	protected $password;
	 /**
	 * CONSTRUCTOR DEL OBJETO.
	 *
	 * @param string $codUsuario CÓDIGO DEL USUARIO
	 * @param string $nomUsuario NOMBRE DEL USUARIO
	 * @param string $email EMAIL DEL USUARIO
	 * @param string $password CONTRASEÑA DEL USUARIO
	 */
	public function __construct($codUsuario, $nomUsuario, $email, $password){
		$this->codUsuario=$codUsuario;
		$this->nomUsuario=$nomUsuario;
		$this->email=$email;
		$this->password=$password;
	}
	 /**
	 * VALIDACIÓN DE USUARIO.
	 *
	 * @param string $codUsuario CÓDIGO DEL USUARIO
	 * @param string $password CONTRASEÑA DEL USUARIO
	 */
	public static function validarUsuario($codUsuario,$password){
		$usuario=null;
		$user=UsuarioPDO::validarUsuario($codUsuario,$password);
		if($user){
			$usuario=new Usuario($codUsuario,$user['nomUsuario'],$user['email'],$password);
		}
		return $usuario;
	}
	 /**
	 * BUSCAR UN USUARIO.
	 *
	 * @param string $codUsuario CÓDIGO DEL USUARIO
	 */
	public static function buscarUsuario($codUsuario){
		$usuario=null;
		$user=UsuarioPDO::buscarUsuario($codUsuario);
		if($user){
			$usuario=new Usuario($codUsuario,$user['nomUsuario'],$user['email'],$user['password']);
		}
		return $usuario;
	}
	 /**
	 * CREAR USUARIO.
	 *
	 * @param string $codUsuario CÓDIGO DEL USUARIO
	 * @param string $nomUsuario NOMBRE DEL USUARIO
	 * @param string $email EMAIL DEL USUARIO
	 * @param string $password CONTRASEÑA DEL USUARIO
	 */
	public static function crearUsuario($codUsuario,$nomUsuario,$email,$password){
		return UsuarioPDO::crearUsuario($codUsuario,$nomUsuario,$email,$password);
	}
	/**
	 * EDITAR UN USUARIO.
	 *
	 * @param string $nomUsuario NOMBRE DEL USUARIO
	 * @param string $email EMAIL DEL USUARIO
	 * @param string $password CONTRASEÑA DEL USUARIO
	 * @param string $codUsuario CÓDIGO DEL USUARIO
	 */
	public static function editarUsuario($nomUsuario,$email,$password,$codUsuario){
		$usuario=null;
		$user=UsuarioPDO::editarUsuario($nomUsuario,$email,$password,$codUsuario);
		if($user){
			$usuario=new Usuario($codUsuario,$user['nomUsuario'],$user['email'],$user['password']);
		}
		return $usuario;
	}
	/**
	 * BORRAR UN USUARIO.
	 *
	 * @param string $codUsuario CÓDIGO DEL USUARIO
	 */
	public static function borrarUsuario($codUsuario){
		$borrado=false;
		if(UsuarioPDO::borrarUsuario($codUsuario)){
			$borrado=true;
		}
		return $borrado;
	}
	public function getCodUsuario(){
		return $this->codUsuario;
	}
	public function getNomUsuario(){
		return $this->nomUsuario;
	}
	public function getEmail(){
		return $this->email;
	}
	public function getPassword(){
		return $this->password;
	}
			
}	
?>
	
<?php
/*
 * Clase Usuario.
 * Se definen atributos y métodos de la clase.
 * Utiliza la clase UsuarioPDO.
 *
 * @author Patricia Martínez Lucena
 * @version 1.0.0
 */
	/*
	 * Utiliza la clase UsuarioPDO.
	 */
	require_once 'UsuarioPDO.php';
	/*
	 * Definir clase.
	 */
	class Usuario{
		/*
		 * Definir atributos de la clase.
		 */
		protected $codUsuario;
		protected $nomUsuario;
		protected $email;
		protected $password;
		 /**
	     * Constructor del objeto.
	     *
	     * @param string $codUsuario Código del usuario
	     * @param string $nomUsuario Nombre del usuario
	     * @param string $email Email del usuario
	     * @param string $password Contraseña del usuario
	     */
		public function __construct($codUsuario, $nomUsuario, $email, $password){
			$this->codUsuario=$codUsuario;
			$this->nomUsuario=$nomUsuario;
			$this->email=$email;
			$this->password=$password;
		}
		 /**
	     * Función de validación de Usuario.
	     *
	     * @param string $codUsuario Código del usuario
	     * @param string $password Contraseña del usuario
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
	     * Buscar un usuario.
	     *
	     * @param string $codUsuario Código del usuario
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
	     * Función de crear Usuario.
	     *
	     * @param string $codUsuario Código del usuario
	     * @param string $nomUsuario Nombre del usuario
	     * @param string $email Email del usuario
	     * @param string $password Contraseña del usuario
	     */
		public static function crearUsuario($codUsuario,$nomUsuario,$email,$password){
			return UsuarioPDO::crearUsuario($codUsuario,$nomUsuario,$email,$password);
		}
		/**
	     * Función de editar un Usuario.
	     *
	     * @param string $codUsuario Código del usuario
	     * @param string $nomUsuario Nombre del usuario
	     * @param string $email Email del usuario
	     * @param string $password Contraseña del usuario
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
	     * Función de borrar un Usuario.
	     *
	     * @param string $codUsuario Código del usuario
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
	
		
<?php 
	/* 
	* LIBRERÍA DE VALIDACIÓN DE FUNCIONES.
	* 
	* @author PATRICIA MARTÍNEZ LUCENA
	* @version 1.0.0
	*/ 
	//VALIDA CARACTERES ALFABÉTICOS CON ACENTOS Y PUEDE ESTAR VACÍO.
	function validartextovacio($texto){
		//DEFINIR EL PATRÓN.
		$patrontexto="/^[a-z A-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇ]+$/";
		$error="";
		//SI NO COINCIDE EL TEXTO CON EL PATRÓN ALMACENA EL ERROR.
		if(!preg_match($patrontexto, $texto)){
			$error="Introduce solo letras";
		}
		return $error;
	}
	//VALIDA CARACTERES ALFABÉTICOS CON ACENTOS.
	function validartexto($texto){
		//DEFINIR EL PATRÓN.
		$patrontexto="/^[a-z A-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇ]+$/";
		$error="";
		//SI EL CAMPO ESTÁ VACÍO ALMACENA EL ERROR.
		if(empty(trim($texto))){
			$error = "Campo vacío"; 
		//SI NO COINCIDE EL TEXTO CON EL PATRÓN ALMACENA EL ERROR.
		}else{
			if(!preg_match($patrontexto, $texto)){
				$error="Introduce solo letras";
			}
		}
		return $error;
	}
	//VALIDA UNA DIRECCIÓN SIN NÚMEROS.
	function validardireccion($direccion){
		//DEFINIR EL PATRÓN.
		$patrontexto="/^[a-z A-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇ,\/]+$/";
		$error="";
		//SI EL CAMPO ESTÁ VACÍO ALMACENA EL ERROR.
		if(empty(trim($direccion))){
			$error = "Campo vacío"; 
		//SI NO COINCIDE EL TEXTO CON EL PATRÓN ALMACENA EL ERROR.
		}else{
			if(!preg_match($patrontexto, $direccion)){
				$error="Introduce solo caracteres de direcciones";
			}
		}
		return $error;
	}
	//VALIDA CARACTERES ALFABÉTICOS CON ACENTOS Y CON UNA LONGITUD DETERMINADA.
	function validartextolongitud($texto, $longitud){
		//DEFINIR EL PATRÓN.
		$patrontexto="/^[a-zA-Z]{".$longitud."}+$/";
		$error="";
		//SI EL CAMPO ESTÁ VACÍO ALMACENA EL ERROR.
		if(empty(trim($texto))){
			$error = "Campo vacío"; 
		//SI NO COINCIDE EL TEXTO CON EL PATRÓN ALMACENA EL ERROR.
		} else {	
			if(!preg_match($patrontexto, $texto)){
				$error=$longitud." letras únicamente";
			}
		}
		return $error;
	}
	//VALIDA CARACTERES ALFANUMÉRICOS.
	function validartextonumero($textonumero){
		//DEFINIR EL PATRÓN.
		$patrontextonumero="/^[a-zA-Z0-9]+$/";	
		$error="";
		//SI EL CAMPO ESTÁ VACÍO ALMACENA EL ERROR.
		if (empty(trim($textonumero))) {
			$error = "Campo vacío"; 
		//SI NO COINCIDE EL TEXTO CON EL PATRÓN ALMACENA EL ERROR.
		} else 	if(!preg_match($patrontextonumero, $textonumero)){
			$error="Formato incorrecto";
		}
		return $error;
	}
	//VALIDA NÚMEROS ENTEROS.
	function validarentero($entero){
		//DEFINIR EL PATRÓN.
		$patronentero="/^[0-9]+$/";	
		$error="";
		//SI EL CAMPO ESTÁ VACÍO ALMACENA EL ERROR.
		if (empty(trim($entero))) {
			$error = "Campo vacío"; 
		//SI NO COINCIDE EL TEXTO CON EL PATRÓN ALMACENA EL ERROR.
		} else 	if(!preg_match($patronentero, $entero)){
			$error="Formato incorrecto";
		}
		return $error;
	}
	//VALIDA UN PASSWORD Y PUEDE ESTAR VACÍO.
	function validarpasswordvacio($password){
		//DEFINIR EL PATRÓN.
		$patronpassword="/^[a-zA-Z][a-zA-Z0-9_!@#$%^&*().]+$/";	
		$error="";
		//SI NO COINCIDE EL TEXTO CON EL PATRÓN ALMACENA EL ERROR.
		if(!preg_match($patronpassword, $password)){
			$error="Formato incorrecto";
		}
		return $error;
	}
	//VALIDA UN PASSWORD.
	function validarpassword($password){
		//DEFINIR EL PATRÓN.
		$patronpassword="/^[a-zA-Z]+$/";	
		$error="";
		//SI EL CAMPO ESTÁ VACÍO ALMACENA EL ERROR.
		if (empty(trim($password))) {
			$error = "Campo vacío"; 
		//SI NO COINCIDE EL TEXTO CON EL PATRÓN ALMACENA EL ERROR.
		} else 	if(!preg_match($patronpassword, $password)){
			$error="Formato incorrecto";
		}
		return $error;
	}
	//VALIDAR UNA FECHA EN VARIOS FORMATOS.
	function validarfecha($fecha){
		//DEFINIR EL PATRÓN.
		$patronfecha1="/^((0?[1-9]|[1-2][0-9]|3[0-1])(\-)(0?[1-9]|1[0-2])(\-)([0-9]{4}))$/";
		$patronfecha2="/^((0?[1-9]|[1-2][0-9]|3[0-1])(\/)(0?[1-9]|1[0-2])(\/)([0-9]{4}))$/";
		$patronfecha3="/^(([0-9]{4})(\/)(0?[1-9]|1[0-2])(\/)(0?[1-9]|[1-2][0-9]|3[0-1]))$/";
		$patronfecha4="/^(([0-9]{4})(\-)(0?[1-9]|1[0-2])(\-)(0?[1-9]|[1-2][0-9]|3[0-1]))$/";
		$error="";
		//SI EL CAMPO ESTÁ VACÍO ALMACENA EL ERROR.
		if (empty(trim($fecha))) {
			$error = "Campo vacío"; 
		//SI NO COINCIDE EL TEXTO CON EL PATRÓN ALMACENA EL ERROR.
		} else 	if(!preg_match($patronfecha1, $fecha)){
			if(!preg_match($patronfecha2, $fecha)){
				if(!preg_match($patronfecha3, $fecha)){
					if(!preg_match($patronfecha4, $fecha)){
						$error="Formato incorrecto";
					}
				}
			}
		}
		return $error;
	}
	//VALIDAR UNA HORA.	
	function validarhora($hora){
		//DEFINIR EL PATRÓN.
		$patronhora="/^[0-2][0-3]:[0-5][0-9]$/";	
		$error="";
		//SI EL CAMPO ESTÁ VACÍO ALMACENA EL ERROR.
		if (empty(trim($hora))) { //Se genera error si el campo está vacío 
			$error = "Campo vacío"; 
		//SI NO COINCIDE EL TEXTO CON EL PATRÓN ALMACENA EL ERROR.
		} else 	if(!preg_match($patronhora, $hora)){
			$error="Formato incorrecto";
		}
		return $error;
	}	
	//VALIDA UN EMAIL.
	function validaremail($email){
		//DEFINIR EL PATRÓN.
		$patronemail="/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/";	
		$error="";
		//SI EL CAMPO ESTÁ VACÍO ALMACENA EL ERROR.
		if (empty(trim($email))) { //Se genera error si el campo está vacío 
			$error = "Campo vacío"; 
		//SI NO COINCIDE EL TEXTO CON EL PATRÓN ALMACENA EL ERROR.
		} else 	if(!preg_match($patronemail, $email)){
			$error="Formato de Email incorrecto";
		}
		return $error;
	}					
	//VALIDA UN DECIMAL
	function validardecimal($decimal){
		//DEFINIR EL PATRÓN.
		$patrondecimal="/^([0-9]+)(([.|,])([0-9]+))?$/";	
		$error = ""; 
		//SI EL CAMPO ESTÁ VACÍO ALMACENA EL ERROR.
		if (empty(trim($decimal))) { //Se genera error si el campo está vacío 
			$error = "Campo vacío"; 
		} else 	if(!preg_match($patrondecimal, $decimal)){
			$error="Numero decimal incorrecto";
		}
		return $error;
	}			
	//VALIDA UN DNI.
	function validardni($dni) { 
		//DEFINIR LOS CARACTERES DEL DNI GENERALES.
		$caracteresDNI = "TRWAGMYFPDXBNJZSQVHLCKE";
		$error = ""; 
		//DEFINIR EL PATRÓN.
		$patron = "/([0-9]{8})([a-zA-Z]{1})/";
		//SI EL CAMPO ESTÁ VACÍO ALMACENA EL ERROR.
		if (empty(trim($dni))) {
			$error = "Campo vacío"; 
		//SI EL CAMPO ESTÁ VACÍO ALMACENA EL ERROR.
		}else if (preg_match($patron, $dni)) {
			$numerosDNI = $dni . substr($dni, 0, -1); 
			$valor = ($numerosDNI % 23); 
			$letraIntroducida = $dni[8]; 
			$letraDNI = substr($caracteresDNI, $valor, 1); 
			if ($letraDNI !== $letraIntroducida) {//Se genera error si no se ha introducido bien la letra 
				$error = "Letra mal introducida"; 
			} 
		} else {//Se genera error si el dni no coincide con el patrón 
			$error = "Formato DNI incorrecto"; 
		} 
		return $error; 
	}	
?>
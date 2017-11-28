		
<?php 
	
	/*Librería de validación de funciones
	* Autor: Patricia Martínez Lucena
	* Fecha de última modificación: 22/11/17
	*/
	function validartextovacio($texto){
		$patrontexto="/^[a-z A-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇ]+$/";
		$error="";
		if(!preg_match($patrontexto, $texto)){
			$error="Introduce solo letras";
		}
		return $error;
	}
	function validarpasswordvacio($password){
		$patronpassword="/^[a-zA-Z][a-zA-Z0-9_!@#$%^&*().]+$/";	
		$error="";
		if(!preg_match($patronpassword, $password)){
			$error="Formato incorrecto";
		}
		return $error;
	}
	function validartexto($texto){
		$patrontexto="/^[a-z A-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇ]+$/";
		$error="";
		if(empty(trim($texto))){ //Se genera error si el campo está vacío 
			$error = "Campo vacío"; 
		}else{
			if(!preg_match($patrontexto, $texto)){
				$error="Introduce solo letras";
			}
		}
		return $error;
	}
	function validartextocoma($texto){
		$patrontexto="/^[a-z A-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇ,\/]+$/";
		$error="";
		if(empty(trim($texto))){ //Se genera error si el campo está vacío 
			$error = "Campo vacío"; 
		}else{
			if(!preg_match($patrontexto, $texto)){
				$error="Introduce solo caracteres de direcciones";
			}
		}
		return $error;
	}
	function validartextolongitud($texto, $longitud){
		$patrontexto="/^[a-zA-Z]{".$longitud."}+$/";
		$error="";
		if(empty(trim($texto))){ //Se genera error si el campo está vacío 
			$error = "Campo vacío"; 
		} else {	
			if(!preg_match($patrontexto, $texto)){
				$error="3 LETRAS únicamente";
			}
		}
		return $error;
	}
	
	function validartextonumero($textonumero){
		$patrontextonumero="/^[a-zA-Z0-9]+$/";	
		$error="";
		if (empty(trim($textonumero))) { //Se genera error si el campo está vacío 
			$error = "Campo vacío"; 
		} else 	if(!preg_match($patrontextonumero, $textonumero)){
			$error="Formato incorrecto";
		}
		return $error;
	}
	
	function validarentero($entero){
		$patronentero="/^[0-9]+$/";	
		$error="";
		if (empty(trim($entero))) { //Se genera error si el campo está vacío 
			$error = "Campo vacío"; 
		} else 	if(!preg_match($patronentero, $entero)){
			$error="Formato incorrecto";
			
		}
		return $error;
	}
	
	function validarpassword($password){
		$patronpassword="/^[a-zA-Z]+$/";	
		$error="";
		if (empty(trim($password))) { //Se genera error si el campo está vacío 
			$error = "Campo vacío"; 
		} else 	if(!preg_match($patronpassword, $password)){
			$error="Formato incorrecto";
		}
		return $error;
	}

		
		
	function validarfecha($fecha){
		//$patronfecha="/^((0[1-9]|[1-2][0-9]|3[0-1])(-)(0[1-9]|1[0-2])(-)([1800-2050]))|(([1800-2050])(-)(0[1-9]|1[0-2])(-)(0[1-9]|[1-2][0-9]|3[0-1]))|((0[1-9]|[1-2][0-9]|3[0-1])(\/)(0[1-9]|1[0-2])(\/)([1800-2050]))|(([1800-2050])(\/)(0[1-9]|1[0-2])(\/)(0[1-9]|[1-2][0-9]|3[0-1]))$/";
		//$patronfecha="/^((0[1-9]|[1-2][0-9]|3[0-1])(\-)(0[1-9]|1[0-2])(\-)([0-9]{4}))|((0[1-9]|[1-2][0-9]|3[0-1])(\/)(0[1-9]|1[0-2])(\/)([0-9]{4}))$/";
		$patronfecha1="/^((0?[1-9]|[1-2][0-9]|3[0-1])(\-)(0?[1-9]|1[0-2])(\-)([0-9]{4}))$/";
		$patronfecha2="/^((0?[1-9]|[1-2][0-9]|3[0-1])(\/)(0?[1-9]|1[0-2])(\/)([0-9]{4}))$/";
		$patronfecha3="/^(([0-9]{4})(\/)(0?[1-9]|1[0-2])(\/)(0?[1-9]|[1-2][0-9]|3[0-1]))$/";
		$patronfecha4="/^(([0-9]{4})(\-)(0?[1-9]|1[0-2])(\-)(0?[1-9]|[1-2][0-9]|3[0-1]))$/";
		$error="";
		if (empty(trim($fecha))) { //Se genera error si el campo está vacío 
			$error = "Campo vacío"; 
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
		
		
	function validarhora($hora){
		$patronhora="/^[0-2][0-3]:[0-5][0-9]$/";	
		$error="";
		if (empty(trim($hora))) { //Se genera error si el campo está vacío 
			$error = "Campo vacío"; 
		} else 	if(!preg_match($patronhora, $hora)){
			$error="Formato incorrecto";
		}
		return $error;
	}	
		

	function validaremail($email){
		$patronemail="/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/";	
		$error="";
		if (empty(trim($email))) { //Se genera error si el campo está vacío 
			$error = "Campo vacío"; 
		} else 	if(!preg_match($patronemail, $email)){
			$error="Formato de Email incorrecto";
		}
		return $error;
	}					
	

	function validardecimal($decimal){
		$patrondecimal="/^([0-9]+)(([.|,])([0-9]+))?$/";	
		$error = ""; 
		if (empty(trim($decimal))) { //Se genera error si el campo está vacío 
			$error = "Campo vacío"; 
		} else 	if(!preg_match($patrondecimal, $decimal)){
			$error="Numero decimal incorrecto";
		}
		return $error;
	}			
		
	function validardni($dni) { 
		$error = ""; 
		$caracteresDNI = "TRWAGMYFPDXBNJZSQVHLCKE"; //Cadena de caracteres que sirve para comprobar si se ha introducido bien la letra del DNI 
		$patron = "/([0-9]{8})([a-zA-Z]{1})/"; //Patrón del DNI en España. 8 números + una letra. 
		if (empty(trim($dni))) { //Se genera error si el campo está vacío 
			$error = "Campo vacío"; 
		} else if (preg_match($patron, $dni)) { //Si el DNI coincide con el patrón, se comprueba que se haya introducido bien la letra 
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

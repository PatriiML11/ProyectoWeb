<?php
/*
 * VISTA GENERAL DE TODAS LAS PÁGINAS.
 *
 * @author Patricia Martínez Lucena
 * @version 1.0.0
 */
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0">
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="./webroot/css/styles.css">
<title>PROYECTO</title>
</head>
<body>  
<div id="conte">
    <div id="contenido">
	<?php
         /*
         * CONTROLA QUÉ VISTA SE VA A MOSTRAR EN BASE A LA LOCALIZACIÓN (PÁGINA ACTUAL) DEL USUARIO.
         *
         * NOTA: LA LOCALIZACIÓN SE EMPIEZA A ENVIAR A PARTIR DEL PRIMER INTENTO DE INICIO DE SESIÓN DEL USUARIO.
         *
         * Autor: Patricia Martínez Lucena.
         * Fecha de última modificación: 30/09/2017
         */
        $layout = "view/vInicio.php"; //POR DEFECTO, SE MARCA COMO LAYOUT LA VISTA DE INICIO.
        /*
         * SI SE HA INDICADO LOCALIZACIÓN Y SI ÉSTA EXISTE EN EL ARRAY $VISTAS DE CONFIG.PHP, SE ESTABLECERÁ LA VISTA
         * CORRESPONDIENTE A ESA LOCALIZACIÓN
         */
        if (isset($_GET['location']) && isset($vistas[$_GET['location']])) {
            $layout = $vistas[$_GET['location']];
        }
        //FINALMENTE, SE MUESTRA LA VISTA ELEGIDA
        include $layout;
	?>
    </body>
</html>
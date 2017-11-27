<?php
/*
 * Vista general de todas las páginas.
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
         * Controla qué vista se va a mostrar en base a la localización (página actual) del usuario.
         *
         * NOTA: La localización se empieza a enviar a partir del primer intento de inicio de sesión del usuario.
         *
         * Autor: Patricia Martínez Lucena.
         * Fecha de última modificación: 30/09/2017
         */
        $layout = "view/vInicio.php"; //Por defecto, se marca como layout la vista de inicio.

        /*
         * Si se ha indicado localización y si ésta existe en el array $vistas de config.php, se establecerá la vista
         * correspondiente a esa localización
         */
        if (isset($_GET['location']) && isset($vistas[$_GET['location']])) {
            $layout = $vistas[$_GET['location']];
        }

        //FInalmente, se muestra la vista elegida
        include $layout;
?>
    </body>
</html>
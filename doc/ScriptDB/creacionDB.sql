--
-- Base de datos: `PML-Mapa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Busqueda`
--

CREATE TABLE `Busqueda` (
  `codBusqueda` int(11) PRIMARY KEY AUTO_INCREMENT,
  `codUsuario` varchar(20),
  `fecha` varchar(30),
  `salida` varchar(200),
  `llegada` varchar(200),
  `duracion` varchar(50),
  `distancia` varchar(50),
  `temperatura` varchar(50),
  `nubes` varchar(50),
  `precipitacion` varchar(50),
  `humedad` varchar(50),
  `viento` varchar(50),
  `frase` varchar(50)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Usuario` (
  `codUsuario` varchar(50) PRIMARY KEY,
  `nomUsuario` varchar(50),
  `email` varchar(50),
  `password` varchar(200)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
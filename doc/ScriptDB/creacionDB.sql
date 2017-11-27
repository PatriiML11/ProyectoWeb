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
  `salida` varchar(50),
  `llegada` varchar(50),
  `duracion` varchar(20),
  `distancia` varchar(10),
  `temperatura` varchar(10),
  `nubes` varchar(10),
  `precipitacion` varchar(10),
  `humedad` varchar(10),
  `viento` varchar(10),
  `frase` varchar(50)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Usuario` (
  `codUsuario` varchar(50) PRIMARY KEY,
  `nomUsuario` varchar(50),
  `email` varchar(50),
  `password` varchar(200)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
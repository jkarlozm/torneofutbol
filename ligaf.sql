-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-03-2016 a las 01:54:11
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ligaf`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arbitros`
--

CREATE TABLE `arbitros` (
  `idArbitro` int(11) NOT NULL,
  `nombreArbitro` varchar(50) NOT NULL,
  `ap_arbitro` varchar(30) NOT NULL,
  `am_arbitro` varchar(30) NOT NULL,
  `rol` varchar(30) NOT NULL,
  `fotoArbitro` varchar(50) NOT NULL,
  `estado` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `arbitros`
--

INSERT INTO `arbitros` (`idArbitro`, `nombreArbitro`, `ap_arbitro`, `am_arbitro`, `rol`, `fotoArbitro`, `estado`) VALUES
(1, 'Armando', 'Archundia', 'Archundia', 'Central', '22:52:21armando-archundia.jpg', 1),
(2, 'Edgardo', 'Codesal', 'Méndez', 'Suplente', '22:54:52Edgardo-Codesal-M-8-7-902.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campos`
--

CREATE TABLE `campos` (
  `idCampo` int(11) NOT NULL,
  `nombreCampo` varchar(50) NOT NULL,
  `direccionCampo` varchar(100) NOT NULL,
  `latitud` varchar(50) NOT NULL,
  `longitud` varchar(50) NOT NULL,
  `fotoCampo` varchar(50) NOT NULL,
  `estado` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `campos`
--

INSERT INTO `campos` (`idCampo`, `nombreCampo`, `direccionCampo`, `latitud`, `longitud`, `fotoCampo`, `estado`) VALUES
(1, 'Estadio Cuauhtemoc', 'Autopista México - Puebla 645, Corredor Industrial la Ciénega, Puebla, Pue., México', '19.078402760108258', '-98.16437602043152', '22:19:17cuautemoc.jpg', 1),
(2, 'Estadio Azteca', 'Calz. de Tlalpan 3665, Exejido de Sta Úrsula Coapa, 04730 Ci', '19.30304299778644', '-99.1505491733551', '22:32:13azteca.jpeg', 1),
(3, 'Nemesio Diez', 'Avenida José María Morelos y Pavón 1205, Barrio de San Berna', '19.28746893415061', '-99.66653645038605', '17:22:26neme.jpg', 1),
(4, 'Estadio Hidalgo', 'Acceso Al Estadio, Los Jales, Ex Hacienda de Coscotitlán, 42', '20.105478049937844', '-98.75588357448578', '17:26:25hidalgo.jpg', 1),
(5, 'loreto', 'loreto', '43.4396423', '13.606566799999996', '19:46:38imgpsh_fullsize.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `idEquipo` int(11) NOT NULL,
  `nombreEquipo` varchar(50) NOT NULL,
  `logotipoEquipo` varchar(50) NOT NULL,
  `idCampoEquipo` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `estado` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`idEquipo`, `nombreEquipo`, `logotipoEquipo`, `idCampoEquipo`, `idGrupo`, `estado`) VALUES
(1, 'Puebla F. C.', '23:22:45pueblafc.png', 1, 0, 1),
(2, 'Aguilas del america', '23:40:18aguilas.png', 2, 0, 1),
(3, 'Deportivo Toluca', '17:23:40Deportivo_Toluca_F.C.svg.png', 3, 0, 1),
(4, 'Pachuca', '17:27:0311.png', 4, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `goles`
--

CREATE TABLE `goles` (
  `idGoles` int(11) NOT NULL,
  `cantidadGoles` int(11) NOT NULL,
  `numeroJugador` int(11) NOT NULL,
  `idEquipo` int(11) NOT NULL,
  `minuto` int(3) NOT NULL,
  `jornada` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `idGrupo` int(11) NOT NULL,
  `nombreGrupo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informaciongeneral`
--

CREATE TABLE `informaciongeneral` (
  `idInformacionGeneral` int(11) NOT NULL,
  `idEquipoInformacion` int(11) NOT NULL,
  `numeroGolesEquipo` int(11) NOT NULL,
  `numTarjetasAmarillasEquipo` int(11) NOT NULL,
  `numTarjetasRojasEquipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacionindividual`
--

CREATE TABLE `informacionindividual` (
  `idInformacionIndividual` int(11) NOT NULL,
  `idJugadorInformacion` int(11) NOT NULL,
  `numeroGolesIndividual` int(11) NOT NULL,
  `numTarjetasAmarillasIndividual` int(11) NOT NULL,
  `numTarjetasRojasIndividual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `idJugador` int(11) NOT NULL,
  `nombreJugador` varchar(50) NOT NULL,
  `ap_jugador` varchar(30) NOT NULL,
  `am_jugador` varchar(30) NOT NULL,
  `estado` int(11) NOT NULL,
  `edad` int(11) NOT NULL,
  `idEquipoJugador` int(11) NOT NULL,
  `playera` int(3) NOT NULL,
  `tarjeta_roja` int(3) NOT NULL,
  `tarjeta_amarilla` int(3) NOT NULL,
  `goles` int(3) NOT NULL,
  `autogoles` int(3) NOT NULL,
  `posicionJugador` varchar(15) NOT NULL,
  `fotoJugador` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`idJugador`, `nombreJugador`, `ap_jugador`, `am_jugador`, `estado`, `edad`, `idEquipoJugador`, `playera`, `tarjeta_roja`, `tarjeta_amarilla`, `goles`, `autogoles`, `posicionJugador`, `fotoJugador`) VALUES
(1, 'Oscar', 'Rojas', 'Castillón', 1, 25, 1, 17, 0, 0, 0, 0, 'Defensa', '00:38:1517g.jpg'),
(2, 'Alberto', 'Gutierrez', 'Gutierrez', 1, 32, 1, 4, 0, 0, 0, 0, 'Medio', '00:39:27gutierrez.jpg'),
(3, 'Cuauhtemoc', 'Blanco', 'Blanco', 1, 56, 2, 10, 3, 3, 10, 0, 'Delantero', '00:55:18blanco.jpg'),
(4, 'Daniel', 'Guerrero', 'Guerrero', 1, 32, 2, 4, 0, 0, 0, 0, 'Defensa', '00:56:16Guerrero.jpg'),
(5, 'David', 'Toledo', 'Toledo', 1, 20, 1, 16, 0, 0, 0, 0, 'Medio', '17:05:5259g.jpg'),
(6, 'Luis Enrique', 'Robles', 'Robles', 1, 25, 1, 8, 0, 0, 0, 0, 'Medio', '17:07:2156g.jpg'),
(7, 'Rubens', 'Sambueza', 'Sambueza', 1, 33, 2, 14, 0, 0, 0, 0, 'Medio', '17:13:03sambueza_241012.jpg'),
(8, 'Oribe', 'Peralta', 'Peralta', 1, 42, 2, 24, 0, 0, 0, 1, 'Delantero', '17:14:59Peralta.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultadoPartido`
--

CREATE TABLE `resultadoPartido` (
  `idResultadosp` int(11) NOT NULL,
  `equipoLocal` int(2) NOT NULL,
  `equipoVisitante` int(2) NOT NULL,
  `marcadorLocal` int(2) NOT NULL,
  `marcadorVisitante` int(2) NOT NULL,
  `tarjetaAmarilla` int(2) NOT NULL,
  `tarjetaRoja` int(2) NOT NULL,
  `insidente` text COLLATE latin1_spanish_ci NOT NULL,
  `jornada` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetasAmarillas`
--

CREATE TABLE `tarjetasAmarillas` (
  `idTarjetaamarilla` int(11) NOT NULL,
  `cantidad` int(2) NOT NULL,
  `numeroJugador` int(3) NOT NULL,
  `idEquipo` int(3) NOT NULL,
  `jornada` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tarjetasAmarillas`
--

INSERT INTO `tarjetasAmarillas` (`idTarjetaamarilla`, `cantidad`, `numeroJugador`, `idEquipo`, `jornada`) VALUES
(8, 1, 10, 2, 1),
(9, 2, 10, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetasRojas`
--

CREATE TABLE `tarjetasRojas` (
  `idTarjetaRoja` int(11) NOT NULL,
  `numeroJugador` int(11) NOT NULL,
  `idEquipo` int(11) NOT NULL,
  `jornada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tarjetasRojas`
--

INSERT INTO `tarjetasRojas` (`idTarjetaRoja`, `numeroJugador`, `idEquipo`, `jornada`) VALUES
(5, 4, 2, 1),
(6, 14, 2, 1),
(7, 24, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_lf_calendario`
--

CREATE TABLE `tb_lf_calendario` (
  `id_calendario` int(11) NOT NULL,
  `equipo_local` int(2) NOT NULL,
  `equipo_visitante` int(2) NOT NULL,
  `campo` int(2) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `jornada` int(2) NOT NULL,
  `arbitro` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_lf_calendario`
--

INSERT INTO `tb_lf_calendario` (`id_calendario`, `equipo_local`, `equipo_visitante`, `campo`, `fecha`, `hora`, `jornada`, `arbitro`) VALUES
(1, 1, 2, 2, '2016-02-24', '16:00:00', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_lf_jornada`
--

CREATE TABLE `tb_lf_jornada` (
  `id_jornada` int(11) NOT NULL,
  `jornada` varchar(20) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_lf_jornada`
--

INSERT INTO `tb_lf_jornada` (`id_jornada`, `jornada`, `fecha`) VALUES
(1, 'Jornada 1', '2016-02-24'),
(2, 'Jornada 2', '2016-02-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_lf_resultados`
--

CREATE TABLE `tb_lf_resultados` (
  `id_resultado` int(11) NOT NULL,
  `equipo` int(10) NOT NULL,
  `pj` int(5) NOT NULL,
  `g` int(5) NOT NULL,
  `e` int(5) NOT NULL,
  `p` int(5) NOT NULL,
  `gf` int(5) NOT NULL,
  `gc` int(5) NOT NULL,
  `gd` int(5) NOT NULL,
  `pts` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_lf_resultados`
--

INSERT INTO `tb_lf_resultados` (`id_resultado`, `equipo`, `pj`, `g`, `e`, `p`, `gf`, `gc`, `gd`, `pts`) VALUES
(1, 1, 1, 1, 0, 0, 1, 0, 0, 1),
(2, 2, 1, 0, 0, 1, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `usuario` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `equipo` int(11) NOT NULL,
  `contrasena` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `privilegio` varchar(50) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `usuario`, `equipo`, `contrasena`, `privilegio`) VALUES
(1, 'juan carlos', 'karloz', 1, '827ccb0eea8a706c4c34a16891f84e7b', '1'),
(7, 'Patricio Perez Ramirez', 'patriciopuebla', 1, '1ce927f875864094e3906a4a0b5ece68', '2'),
(8, 'Ruben Nolasco Coral', 'rubenamerica', 2, '2e65f2f2fdaf6c699b223c61b1b5ab89', '2'),
(9, 'Armando Archundia Archundia', 'armandoarbitro', 0, '22ac3c5a5bf0b520d281c122d1490650', '3');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `arbitros`
--
ALTER TABLE `arbitros`
  ADD PRIMARY KEY (`idArbitro`);

--
-- Indices de la tabla `campos`
--
ALTER TABLE `campos`
  ADD PRIMARY KEY (`idCampo`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`idEquipo`);

--
-- Indices de la tabla `goles`
--
ALTER TABLE `goles`
  ADD PRIMARY KEY (`idGoles`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`idJugador`);

--
-- Indices de la tabla `resultadoPartido`
--
ALTER TABLE `resultadoPartido`
  ADD PRIMARY KEY (`idResultadosp`);

--
-- Indices de la tabla `tarjetasAmarillas`
--
ALTER TABLE `tarjetasAmarillas`
  ADD PRIMARY KEY (`idTarjetaamarilla`);

--
-- Indices de la tabla `tarjetasRojas`
--
ALTER TABLE `tarjetasRojas`
  ADD PRIMARY KEY (`idTarjetaRoja`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `arbitros`
--
ALTER TABLE `arbitros`
  MODIFY `idArbitro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `campos`
--
ALTER TABLE `campos`
  MODIFY `idCampo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `idEquipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `goles`
--
ALTER TABLE `goles`
  MODIFY `idGoles` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `idJugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `resultadoPartido`
--
ALTER TABLE `resultadoPartido`
  MODIFY `idResultadosp` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tarjetasAmarillas`
--
ALTER TABLE `tarjetasAmarillas`
  MODIFY `idTarjetaamarilla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tarjetasRojas`
--
ALTER TABLE `tarjetasRojas`
  MODIFY `idTarjetaRoja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 12-04-2024 a las 00:33:14
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rc_electoral`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casilla`
--

CREATE TABLE `casilla` (
  `id` int(11) NOT NULL,
  `casilla` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `seccion` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_casilla` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id` int(11) NOT NULL,
  `incidencia` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `idRC` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `seccion` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `casilla` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `horafecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id`, `incidencia`, `idRC`, `nombre`, `seccion`, `casilla`, `horafecha`) VALUES
(1, '', 1, 'Uno', '1', '1', '2024-04-11 16:50:43'),
(2, '', 1, 'Uno', '1', '1', '2024-04-11 16:51:21'),
(3, 'adsfsafdsaf', 1, 'Uno', '1', '1', '2024-04-11 16:52:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listado`
--

CREATE TABLE `listado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `curp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nominal` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `seccion` int(11) NOT NULL,
  `municipio` int(11) NOT NULL,
  `direccion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `si_no` int(11) NOT NULL COMMENT 'Si pertenece o no al listado',
  `voto` int(11) DEFAULT NULL COMMENT '0 - no\r\n1 - si',
  `hora_voto` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `listado`
--

INSERT INTO `listado` (`id`, `nombre`, `curp`, `nominal`, `seccion`, `municipio`, `direccion`, `si_no`, `voto`, `hora_voto`) VALUES
(1, 'xzczcz', '22222', '210', 2, 2, 'sadadsfdsaf', 1, NULL, '0000-00-00 00:00:00'),
(2, 'dfsafsdf', '3', '332', 3, 3, 'dsfzdfsd', 1, 1, '0000-00-00 00:00:00'),
(3, 'dssdfsdf', '4', '432', 4, 4, 'fgdgdg', 0, 1, '0000-00-00 00:00:00'),
(4, 'cvxcvxcv', '5', '5678', 5, 5, 'fdgdfg', 1, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `id` int(11) NOT NULL,
  `seccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usr`
--

CREATE TABLE `usr` (
  `id` int(11) NOT NULL,
  `nombre` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `usr` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `perfil` int(11) NOT NULL,
  `seccion` int(11) NOT NULL,
  `casilla` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usr`
--

INSERT INTO `usr` (`id`, `nombre`, `usr`, `pwd`, `perfil`, `seccion`, `casilla`) VALUES
(1, 'Uno', 'uno', '123456789', 1, 1, '1'),
(2, 'Dos', 'dos', '123456789', 2, 2, '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votacion_casilla`
--

CREATE TABLE `votacion_casilla` (
  `id` int(11) NOT NULL,
  `pri` int(11) NOT NULL,
  `pan` int(11) NOT NULL,
  `prd` int(11) NOT NULL,
  `morena` int(11) NOT NULL,
  `pt` int(11) NOT NULL,
  `mc` int(11) NOT NULL,
  `otro` int(11) NOT NULL,
  `anulados` int(11) NOT NULL,
  `rc_captura` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `seccion` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `casilla` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `votacion_casilla`
--

INSERT INTO `votacion_casilla` (`id`, `pri`, `pan`, `prd`, `morena`, `pt`, `mc`, `otro`, `anulados`, `rc_captura`, `fecha_hora`, `seccion`, `casilla`) VALUES
(1, 12, 12, 1, 2, 2, 34, 4, 5, 1, '2024-04-11 17:17:52', '1', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `casilla`
--
ALTER TABLE `casilla`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `listado`
--
ALTER TABLE `listado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usr`
--
ALTER TABLE `usr`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `votacion_casilla`
--
ALTER TABLE `votacion_casilla`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `casilla`
--
ALTER TABLE `casilla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `listado`
--
ALTER TABLE `listado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usr`
--
ALTER TABLE `usr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `votacion_casilla`
--
ALTER TABLE `votacion_casilla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

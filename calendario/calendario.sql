-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2015 a las 15:50:35
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `calendario`
--
CREATE DATABASE IF NOT EXISTS `calendario` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `calendario`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE IF NOT EXISTS `colores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(20) NOT NULL,
  `hexa` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`id`, `descripcion`, `hexa`) VALUES
(0, 'Azul', '3A87AD'),
(1, 'Amarillo', 'FFDA00'),
(2, 'Naranja', 'FF9B00'),
(3, 'Gris', 'B8C4C9'),
(4, 'Celeste', '3FC3FF'),
(5, 'Esmeralda', '1CE8B5'),
(6, 'Verde', '95D641'),
(7, 'Rojo', 'FF6D3F'),
(8, 'Blanco', 'FFFFFF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinatarios`
--

CREATE TABLE IF NOT EXISTS `destinatarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `destinatarios`
--

INSERT INTO `destinatarios` (`id`, `descripcion`) VALUES
(1, 'AVEIT'),
(2, 'Grupo'),
(3, 'Subcomision');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinatariosxevento`
--

CREATE TABLE IF NOT EXISTS `destinatariosxevento` (
  `idEvento` int(11) NOT NULL,
  `idDestino` int(11) NOT NULL,
  `idSubGrupo` int(11) NOT NULL,
  PRIMARY KEY (`idEvento`,`idDestino`,`idSubGrupo`),
  KEY `idDestino` (`idDestino`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='dest=1 subg=0, dest=2 subg=nroGrupo, dest=3 subg=idsubcomis';

--
-- Volcado de datos para la tabla `destinatariosxevento`
--

INSERT INTO `destinatariosxevento` (`idEvento`, `idDestino`, `idSubGrupo`) VALUES
(3, 1, 0),
(1, 2, 48),
(2, 3, 1),
(2, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `hora_inicio` time DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `descripcion` varchar(200) NOT NULL,
  `color` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `color` (`color`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `titulo`, `fecha_inicio`, `hora_inicio`, `fecha_fin`, `hora_fin`, `descripcion`, `color`) VALUES
(1, 'Rendición', '2014-12-04', '09:00:00', NULL, '20:00:00', 'Rendición de rifas sede AVEIT', 2),
(2, 'Fiesta Devolucion Grupo 49', '2014-12-13', '23:20:00', NULL, NULL, 'Fiesta en kristal', 7),
(3, 'Painball', '2014-12-23', '15:00:00', NULL, NULL, 'Paintball en carloz paz', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcomisiones`
--

CREATE TABLE IF NOT EXISTS `subcomisiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `subcomisiones`
--

INSERT INTO `subcomisiones` (`id`, `nombre`) VALUES
(1, 'Comisión Directiva'),
(2, 'Computos'),
(3, 'Gestión Social y Ambiental'),
(4, 'Mantenimiento'),
(5, 'Prensa'),
(6, 'Recursos Humanos'),
(7, 'Relaciones Institucionales'),
(8, 'Rifas'),
(9, 'Organización y Eventos');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `destinatariosxevento`
--
ALTER TABLE `destinatariosxevento`
  ADD CONSTRAINT `destinatariosxevento_ibfk_1` FOREIGN KEY (`idEvento`) REFERENCES `eventos` (`id`),
  ADD CONSTRAINT `destinatariosxevento_ibfk_2` FOREIGN KEY (`idDestino`) REFERENCES `destinatarios` (`id`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`color`) REFERENCES `colores` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

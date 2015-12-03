-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-11-2015 a las 17:48:21
-- Versión del servidor: 5.6.27-log
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pefbicom_pef`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Administrador`
--

CREATE TABLE IF NOT EXISTS `Administrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `apellido_paterno` text NOT NULL,
  `apellido_materno` text NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `Administrador`
--

INSERT INTO `Administrador` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `idUser`) VALUES
(1, 'Erick', 'Castillo', 'de la Garza', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cliente`
--

CREATE TABLE IF NOT EXISTS `Cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `rfc` text NOT NULL,
  `calle` text NOT NULL,
  `num_exterior` text NOT NULL,
  `num_interior` text NOT NULL,
  `colonia` text NOT NULL,
  `cp` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `Cliente`
--

INSERT INTO `Cliente` (`id`, `nombre`, `rfc`, `calle`, `num_exterior`, `num_interior`, `colonia`, `cp`) VALUES
(1, 'Hagane Software', 'HSO140224998', '', '', '', '', ''),
(2, 'Caji', 'fghjkl', 'ghjkl', 'nm', 'bnm', 'villahermosa', '56789');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Responsable`
--

CREATE TABLE IF NOT EXISTS `Responsable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `apellido_paterno` text NOT NULL,
  `apellido_materno` text NOT NULL,
  `idUser` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `Responsable`
--

INSERT INTO `Responsable` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `idUser`, `idCliente`) VALUES
(1, 'ErickCE', 'Castillo', 'de la Garza', 7, 1),
(2, 'Rodrigo', 'Cabal', 'jimenez', 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `sessionid` varchar(60) DEFAULT NULL,
  `user_type` enum('Administrador','Cliente','Doctor') NOT NULL,
  `imgPath` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`),
  UNIQUE KEY `sessionid` (`sessionid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `User`
--

INSERT INTO `User` (`id`, `user`, `password`, `sessionid`, `user_type`, `imgPath`) VALUES
(1, 'erick', 'hola', 'mIg8b9jWPNBnPbvUKASO5zSGWnHTrBj4TkIiQIHIhLXm0SqdkAwKF9UA8pCQ', 'Administrador', 'userImages/erick2.jpg'),
(7, 'erickc', '', NULL, 'Cliente', ''),
(8, 'rodrigo', 'hola', NULL, 'Cliente', ''),
(5, 'cliente', 'hola', 'A7TzE7jcqak3sDIMJ0AONmYsq8HpvycoPVigEja7gP5uLIl8umsuA2SuLdrV', 'Cliente', 'userImages/pizza.jpg'),
(3, 'roberto', 'hola', NULL, 'Administrador', 'userImages/mashiro_enojada.jpg'),
(4, 'nacho', 'hola', 'HbUSLMhrGoYwkzw4dR8byuALbWEUIVCiaBDrDQXv8R4umUMHRUCHUSzsafeG', 'Administrador', 'userImages/pizza.jpg'),
(6, 'cliente2', 'hola', NULL, 'Cliente', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-10-2015 a las 00:59:52
-- Versión del servidor: 5.6.23-log
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `User`
--

INSERT INTO `User` (`id`, `user`, `password`, `sessionid`, `user_type`, `imgPath`) VALUES
(1, 'erick', 'hola', 'BUjtJqDaGpnzXupDkInex3oL1BViPjkam517DYaZs2aO3UAiGcs5KXoEFEBA', 'Administrador', 'userImages/erick2.jpg'),
(2, 'dr', 'hola', '4rE1Wn18G8M1vjORPRfVYYiU5C2vCcGDxDgUf9axWP3kYDJgkqerg5cEND8b', 'Doctor', ''),
(5, 'cliente', 'hola', 'bfVd7R7ScYimbWYBx3VCQmZTK9swF2FA9PdR22fPFFq7W26EUPe9LY5seV9m', 'Cliente', ''),
(3, 'roberto', 'hola', NULL, 'Administrador', 'userImages/mashiro_enojada.jpg'),
(4, 'nacho', 'hola', 'HbUSLMhrGoYwkzw4dR8byuALbWEUIVCiaBDrDQXv8R4umUMHRUCHUSzsafeG', 'Administrador', 'userImages/pizza.jpg'),
(6, 'cliente2', 'hola', NULL, 'Cliente', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

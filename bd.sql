-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-06-2018 a las 10:25:37
-- Versión del servidor: 5.7.22
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `web`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` bigint(6) NOT NULL AUTO_INCREMENT,
  `genericActivity` bigint(6) NOT NULL,
  `student` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `rightAnswer` bigint(6) NOT NULL DEFAULT '0',
  `wrongAnswer` bigint(6) NOT NULL DEFAULT '0',
  `startTime` date NOT NULL,
  `endTime` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student` (`student`),
  KEY `genericActivity` (`genericActivity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assign`
--

CREATE TABLE IF NOT EXISTS `assign` (
  `student` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `rfid` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `pictogram` bigint(6) NOT NULL,
  PRIMARY KEY (`student`,`rfid`,`pictogram`),
  KEY `rfid` (`rfid`),
  KEY `pictogram` (`pictogram`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `card`
--

CREATE TABLE IF NOT EXISTS `card` (
  `pictogram` bigint(6) NOT NULL,
  `rfid` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`pictogram`,`rfid`),
  KEY `rfid` (`rfid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genericActivity`
--

CREATE TABLE IF NOT EXISTS `genericActivity` (
  `id` bigint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `type` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `email` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `surname` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `passwd` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `rfid` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `alias` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `rfid` (`rfid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `person`
--

INSERT INTO `person` (`email`, `name`, `surname`, `passwd`, `rfid`, `alias`, `type`) VALUES
('', '', '', '', NULL, '', ''),
('maiky14rmd@gmail.com', 'htyhyh', 'tyhty', '', NULL, 'tyht', 'alumno'),
('miguellbolsa@gmail.com', 'nhjhjyj', 'ynjyj', '', NULL, '', 'alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pictogram`
--

CREATE TABLE IF NOT EXISTS `pictogram` (
  `id` bigint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `picture` longblob,
  `sound` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supervise`
--

CREATE TABLE IF NOT EXISTS `supervise` (
  `activity` bigint(6) NOT NULL,
  `teacher` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`activity`,`teacher`),
  KEY `teacher` (`teacher`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teach`
--

CREATE TABLE IF NOT EXISTS `teach` (
  `teacher` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `student` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`teacher`,`student`),
  KEY `student` (`student`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `use`
--

CREATE TABLE IF NOT EXISTS `use` (
  `id` bigint(6) NOT NULL,
  `rfid` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `pictogram` bigint(20) NOT NULL,
  PRIMARY KEY (`id`,`rfid`,`pictogram`),
  KEY `rfid` (`rfid`),
  KEY `pictogram` (`pictogram`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `surname` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `surname`, `password`) VALUES
(1, 'jorge@aguaron.com', 'Jorge', 'Aguarón', 'd67326a22642a324aa1b0745f2f17abb');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`genericActivity`) REFERENCES `genericActivity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_ibfk_2` FOREIGN KEY (`student`) REFERENCES `person` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `assign`
--
ALTER TABLE `assign`
  ADD CONSTRAINT `assign_ibfk_1` FOREIGN KEY (`student`) REFERENCES `person` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assign_ibfk_2` FOREIGN KEY (`rfid`) REFERENCES `card` (`rfid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assign_ibfk_3` FOREIGN KEY (`pictogram`) REFERENCES `pictogram` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `card_ibfk_1` FOREIGN KEY (`pictogram`) REFERENCES `pictogram` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`rfid`) REFERENCES `card` (`rfid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`rfid`) REFERENCES `card` (`rfid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `supervise`
--
ALTER TABLE `supervise`
  ADD CONSTRAINT `supervise_ibfk_1` FOREIGN KEY (`activity`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supervise_ibfk_2` FOREIGN KEY (`teacher`) REFERENCES `person` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `teach`
--
ALTER TABLE `teach`
  ADD CONSTRAINT `teach_ibfk_1` FOREIGN KEY (`teacher`) REFERENCES `person` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teach_ibfk_2` FOREIGN KEY (`student`) REFERENCES `person` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `use`
--
ALTER TABLE `use`
  ADD CONSTRAINT `use_ibfk_1` FOREIGN KEY (`id`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `use_ibfk_2` FOREIGN KEY (`rfid`) REFERENCES `card` (`rfid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `use_ibfk_3` FOREIGN KEY (`pictogram`) REFERENCES `card` (`pictogram`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-02-2018 a las 04:55:21
-- Versión del servidor: 10.1.28-MariaDB-cll-lve
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `panchotv_demo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `episodios`
--

CREATE TABLE `episodios` (
  `idEpisodios` int(11) NOT NULL,
  `sinopsis` longtext COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date DEFAULT NULL,
  `numeroepi` int(11) DEFAULT NULL,
  `tituloepi` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Temporada_idTemporada` int(11) NOT NULL,
  `Temporada_Series_idSeries` int(11) NOT NULL,
  `imgepi` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `episodios`
--

INSERT INTO `episodios` (`idEpisodios`, `sinopsis`, `fecha`, `numeroepi`, `tituloepi`, `Temporada_idTemporada`, `Temporada_Series_idSeries`, `imgepi`) VALUES
(24, 'El Dr. Heywood Nate (Nick Zano), un historiador encantador y nada convencional, se ve inmerso en la acciÃ³n. DespuÃ©s de hacer un descubrimiento sorprendente, Nate busca a Oliver Queen (Stephen Amell) para obtener ayuda en su bÃºsqueda de las leyendas dispersas. Una vez reunidos, el equipo de leyendas continÃºa con su nueva misiÃ³n de proteger a la lÃ­nea de tiempo frente a las aberraciones temporales, cambios inusuales en la historia que generan consecuencias potencialmente catastrÃ³ficas. Su primera parada es en 1942 para proteger a Albert Einstein de ser secuestrado, antes de que los nazis destruyan la ciudad de Nueva York con una bomba nuclear. Mientras tanto, Ray (Brandon Routh) nota que Sara (Caity Lotz) tiene su propia misiÃ³n, lo que lleva a ambos a enfrentarse a su nÃ©mesis, Damien Darhk (Neal McDonough). Dermot Downs dirige el episodio escrito por Marc Guggenheim ,Phil Klemmer, Greg Berlanti y Chris Fedak', NULL, 1, 'Out of time', 20, 20, ''),
(30, 'TRABAJO DE EQUIPOâ€“ Las Leyendas viajan a la ParÃ­s ocupada por los Nazis para encontrarse a sÃ­ mismos rodeados por la Sociedad de la Justicia de AmÃ©rica (JSA por sus siglas en inglÃ©s). Las Leyendas descubren una aberraciÃ³n temporal que amenaza a la JSA, pero la JSA no quiere tener nada que ver con ellos o su ayuda. Pese a todo, las Leyendas fuerzan su camino hacia la misiÃ³n de la JSA de interceptar y hacerse con un misterioso paquete. Nate (Nick Zano) estÃ¡ desesperado por probar que Ã©l deberÃ­a ser parte del equipo, pero tiene un secreto que comparte con su abuelo, Commander Steel (Matthew MacCaull) que quizÃ¡s lo haga difÃ­cil. Ray (Brandon Routh) estÃ¡ tan centrado en impresionar a la JSA, que se pone a sÃ­ mismo y a Vixen (Maisie Richardson-Sellers) en peligro. Mientras tanto, Stein (Victor Garber) ha dado un paso como el lÃ­der mientras Rip (Arthur Darvill) estÃ¡ desaparecido, pero cuando las decisiones no se estÃ¡n tomando, Sara (Caity Lotz) parece ser la que tendrÃ¡ que tomarlas.', NULL, 2, 'Justice Society of America', 20, 20, ''),
(31, 'SECRETOS Y PODERES RECIÃ‰N DESCUBIERTOS â€“ Nate (Nick Zano) se sorprende al enterarse que tiene poderes cuando accidentalmente Ã©l y Ray (Brandon Routh) aterrizan en el JapÃ³n Feudal. DespuÃ©s de que Sara (Caity Lotz) convenza a su polizÃ³n Amaya (Maisie Richardson-Sellers), alias Vixen, de que Rory (Dominic Purcell) no es un asesino, todos estÃ¡n de acuerdo en encontrar a Nate y ayudarlo a dominar sus poderes para poder defender la villa japonesa del Shogun y su ejÃ©rcito de guerreros sumarais. Mientras tanto, Jax (Franz Drameh) y Stein (Victor Garber) deciden quedarse para ayudar a reparar la nave y encontrar un compartimento secreto, pero deciden no contarle al resto del equipo lo que encontraron.', NULL, 3, 'Shogun', 20, 20, ''),
(32, 'SUPERVIVENCIA - Cuando las Leyendas descubren una aberraciÃ³n temporal en 1863, se encuentran luchando por su supervivencia durante la Guerra Civil con los soldados confederados que se han convertido en zombies. Con el resultado de la Guerra Civil en la cuerda floja, Jax (Franz Drameh) debe participar en una misiÃ³n audaz por ir a una plantaciÃ³n de esclavos con Amaya (Maisie Richardson-Sellers). Mientras tanto, Sara (Caity Lotz) comienza a sentir el peso de las decisiones que tiene que tomar como lÃ­der, y Ray (Brandon Routh) lucha por encontrar su objetivo en el equipo.', NULL, 3, 'Abominations', 20, 20, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `links`
--

CREATE TABLE `links` (
  `idLinks` int(11) NOT NULL,
  `etiqueta` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `enlace` longtext COLLATE utf8_spanish_ci NOT NULL,
  `tipo` int(11) DEFAULT '2',
  `activo` int(11) DEFAULT '0',
  `Episodios_idEpisodios` int(11) NOT NULL,
  `Episodios_Temporada_idTemporada` int(11) NOT NULL,
  `Episodios_Temporada_Series_idSeries` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `links`
--

INSERT INTO `links` (`idLinks`, `etiqueta`, `enlace`, `tipo`, `activo`, `Episodios_idEpisodios`, `Episodios_Temporada_idTemporada`, `Episodios_Temporada_Series_idSeries`) VALUES
(17, 'Latino SD', 'https://openload.co/f/qvDzvr0k0_s/dcle201lathd.mkv.mp4', 3, 0, 24, 20, 20),
(23, 'Subtitulado SD', 'https://openload.co/f/PpcnlAFu6UM/dcs.legends.of.tomorrow.202.hdtv-lol.mkv.mp4', 1, 0, 30, 20, 20),
(24, 'Latino SD', 'https://openload.co/f/HmVnczTxATY/Dcs.legends.of.tomorrow.s02e03.m720p.Latino.mkv.mp4', 3, 0, 31, 20, 20),
(25, 'Subtitulado SD', 'https://openload.co/f/18vH8tKz32U/dcs.legends.of.tomorrow.204.hdtv-lol.mkv.mp4', 1, 0, 32, 20, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series`
--

CREATE TABLE `series` (
  `idSeries` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `anioserie` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `series`
--

INSERT INTO `series` (`idSeries`, `nombre`, `anioserie`) VALUES
(18, 'The Flash', 2014),
(19, 'SuperGirl', 2015),
(20, 'Legends Of Tomorrow', 2016),
(21, 'Arrow', 2012);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporada`
--

CREATE TABLE `temporada` (
  `idTemporada` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8_spanish_ci,
  `numeroepi` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `numtemp` int(11) DEFAULT NULL,
  `imagentemp` text COLLATE utf8_spanish_ci,
  `Series_idSeries` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `temporada`
--

INSERT INTO `temporada` (`idTemporada`, `descripcion`, `numeroepi`, `anio`, `numtemp`, `imagentemp`, `Series_idSeries`) VALUES
(19, 'DespuÃ©s de haber visto el futuro, el viajero del tiempo Rip Hunter tratarÃ¡ desesperadamente de evitarlo logrando la tarea de reunir a un dispar grupo de hÃ©roes y villanos para enfrentar una amenaza imparable, en la que no solo la seguridad del planeta estÃ¡ en juego sino el tiempo mismo.', NULL, 2016, 1, 'Legends Of Tomorrow_t1.jpg', 20),
(20, 'DespuÃ©s de la derrota del villano inmortal VÃ¡ndalo Salvaje y los corruptos Amos del Tiempo que actuaron en connivencia con Ã©l, surge una nueva amenaza. El Dr. Nate Heywood (Nick Zano), un historiador no convencional y encantador, se ve inmerso en la acciÃ³n al momento de realizar un descubrimiento sorprendente - los Legends se encuentran dispersos en el tiempo ', NULL, 2016, 2, 'Legends Of Tomorrow_t2.jpg', 20);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `episodios`
--
ALTER TABLE `episodios`
  ADD PRIMARY KEY (`idEpisodios`,`Temporada_idTemporada`,`Temporada_Series_idSeries`),
  ADD KEY `fk_Episodios_Temporada1_idx` (`Temporada_idTemporada`,`Temporada_Series_idSeries`);

--
-- Indices de la tabla `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`idLinks`,`Episodios_idEpisodios`,`Episodios_Temporada_idTemporada`,`Episodios_Temporada_Series_idSeries`),
  ADD KEY `fk_Links_Episodios1_idx` (`Episodios_idEpisodios`,`Episodios_Temporada_idTemporada`,`Episodios_Temporada_Series_idSeries`);

--
-- Indices de la tabla `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`idSeries`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `temporada`
--
ALTER TABLE `temporada`
  ADD PRIMARY KEY (`idTemporada`,`Series_idSeries`),
  ADD KEY `fk_Temporada_Series_idx` (`Series_idSeries`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `episodios`
--
ALTER TABLE `episodios`
  MODIFY `idEpisodios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `links`
--
ALTER TABLE `links`
  MODIFY `idLinks` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `series`
--
ALTER TABLE `series`
  MODIFY `idSeries` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `temporada`
--
ALTER TABLE `temporada`
  MODIFY `idTemporada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `episodios`
--
ALTER TABLE `episodios`
  ADD CONSTRAINT `fk_Episodios_Temporada1` FOREIGN KEY (`Temporada_idTemporada`,`Temporada_Series_idSeries`) REFERENCES `temporada` (`idTemporada`, `Series_idSeries`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `fk_Links_Episodios1` FOREIGN KEY (`Episodios_idEpisodios`,`Episodios_Temporada_idTemporada`,`Episodios_Temporada_Series_idSeries`) REFERENCES `episodios` (`idEpisodios`, `Temporada_idTemporada`, `Temporada_Series_idSeries`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `temporada`
--
ALTER TABLE `temporada`
  ADD CONSTRAINT `fk_Temporada_Series` FOREIGN KEY (`Series_idSeries`) REFERENCES `series` (`idSeries`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

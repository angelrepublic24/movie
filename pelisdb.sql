-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 22-04-2020 a las 15:47:12
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pelisdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `titulo_goo` varchar(250) DEFAULT NULL,
  `descripcion` text,
  `link` varchar(250) DEFAULT NULL,
  `imagen` text,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`codigo`, `nombre`, `titulo_goo`, `descripcion`, `link`, `imagen`) VALUES
(1, 'AcciÃ³n', 'PelÃ­culas de AcciÃ³n Para Ver en Casa', '<p>Mira ahora las mejores peliculas de acci&oacute;n</p>\r\n', 'accion', 'https://static.cinepolis.com/resources/mx/movies/posters/414x603/31183-315571-20190329114400.jpg'),
(2, 'Humor', 'Pelis de Hurmor', '<p>Que mas quieres que te diga</p>\r\n', 'humor', 'https://www.ecartelera.com/carteles/9800/9812/002_m.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `megusta`
--

DROP TABLE IF EXISTS `megusta`;
CREATE TABLE IF NOT EXISTS `megusta` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `post` text NOT NULL,
  `ip` varchar(50) NOT NULL,
  `megustas` varchar(10) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL DEFAULT '2020-01-01',
  `titulo` varchar(250) NOT NULL,
  `url_post` varchar(255) NOT NULL DEFAULT '',
  `tituolo_original` varchar(250) NOT NULL,
  `descripcion` text NOT NULL,
  `ano` int(11) NOT NULL,
  `escritor` varchar(250) NOT NULL,
  `trailer` varchar(250) NOT NULL,
  `duracion` varchar(250) NOT NULL,
  `valoracion` varchar(250) NOT NULL DEFAULT 'NULL',
  `idiomas` varchar(250) NOT NULL,
  `repartos` text NOT NULL,
  `etiquetas` varchar(250) NOT NULL,
  `url_peli_info` varchar(250) NOT NULL,
  `fuente` varchar(250) NOT NULL,
  `opcion1` varchar(250) NOT NULL,
  `opcion2` varchar(250) NOT NULL,
  `opcion3` varchar(250) NOT NULL,
  `categorias` text,
  `etiqueta_url` text,
  `me_gusta` int(11) NOT NULL DEFAULT '0',
  `no_me_gusta` int(11) NOT NULL DEFAULT '0',
  `visualizacion` int(11) NOT NULL DEFAULT '0',
  `url_imagen` text NOT NULL,
  `publicado` varchar(20) NOT NULL DEFAULT 'true',
  `repartos_url` text NOT NULL,
  `director` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`codigo`, `fecha`, `titulo`, `url_post`, `tituolo_original`, `descripcion`, `ano`, `escritor`, `trailer`, `duracion`, `valoracion`, `idiomas`, `repartos`, `etiquetas`, `url_peli_info`, `fuente`, `opcion1`, `opcion2`, `opcion3`, `categorias`, `etiqueta_url`, `me_gusta`, `no_me_gusta`, `visualizacion`, `url_imagen`, `publicado`, `repartos_url`, `director`) VALUES
(1, '2020-04-18', 'Mortal Kombat Legends: La venganza de Scorpion', 'mortal-kombat-legends-la-venganza-de-scorpion', 'Mortal Kombat Legends: Scorpions Revenge', '<p>Hanzo Hasashi pierde su clan, su familia y su vida durante un ataque por un clan ninja rival. Pero recibe la oportunidad de competir en un torneo interdimensional para salvar a sus seres queridos mientras otros luchadores intentan salvar el reino de la Tierra de la aniquilaci&oacute;n.</p>\r\n', 2020, 'Jeremy Adams / Ed Boon', 'https://www.youtube.com/watch?v=jSi2LDkyKmI', 'n/A', '2,560', 'English', 'Joel McHale / Grey Griffin / Jennifer Carpenter / Kevin Michael Richardson / Steve Blum / Fred Tatasciore / Robin Atkin Downes / Jordan Rodrigues / Darin De Paul / Patrick Seitz / Ike Amadi / Dave B. Mitchell / Artt Butler', 'Pelea,Nintendo,drama', 'https://www.imdb.com/title/tt9580138/?ref_=nv_sr_srsg_0', 'https://www.imdb.com/', 'https://mega.nz/file/wQ8BgTqS#FGK0AV7SfPoJRwJHv_gTeY7Qx-jgorVvKknrn_Cqa8g', '', '', 'AcciÃ³n, Humor', 'pelea nintendo drama', 18, 5, 125, 'subida/Rf46Vjeruv.jpg', 'true', '<a href=\"https://www.imdb.com/name/nm0570364/\">Joel McHale</a> / <a href=\"https://www.imdb.com/name/nm0217221/\">Grey Griffin</a> / <a href=\"https://www.imdb.com/name/nm1358539/\">Jennifer Carpenter</a> / <a href=\"https://www.imdb.com/name/nm0724656/\">Kevin Michael Richardson</a> / <a href=\"https://www.imdb.com/name/nm0089710/\">Steve Blum</a> / <a href=\"https://www.imdb.com/name/nm0851317/\">Fred Tatasciore</a> / <a href=\"https://www.imdb.com/name/nm0235960/\">Robin Atkin Downes</a> / <a href=\"https://www.imdb.com/name/nm0735366/\">Jordan Rodrigues</a> / <a href=\"https://www.imdb.com/name/nm0210875/\">Darin De Paul</a> / <a href=\"https://www.imdb.com/name/nm1365137/\">Patrick Seitz</a> / <a href=\"https://www.imdb.com/name/nm2941559/\">Ike Amadi</a> / <a href=\"https://www.imdb.com/name/nm2022559/\">Dave B. Mitchell</a> / <a href=\"https://www.imdb.com/name/nm2995162/\">Artt Butler</a>â€¦', 'Jeremy Adams / Ed Boon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_categoria`
--

DROP TABLE IF EXISTS `post_categoria`;
CREATE TABLE IF NOT EXISTS `post_categoria` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `cod_post` int(11) NOT NULL DEFAULT '0',
  `seleccionado` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `post_categoria`
--

INSERT INTO `post_categoria` (`codigo`, `nombre`, `cod_post`, `seleccionado`) VALUES
(3, 'AcciÃ³n', 1, 'true'),
(4, 'Humor', 1, 'false');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_post` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tag`
--

INSERT INTO `tag` (`codigo`, `cod_post`, `nombre`, `url`) VALUES
(4, 1, 'Pelea', 'pelea'),
(5, 1, 'Nintendo', 'nintendo'),
(6, 1, 'drama', 'drama');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

DROP TABLE IF EXISTS `visitas`;
CREATE TABLE IF NOT EXISTS `visitas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `vistas_unicas` int(11) NOT NULL,
  `vistas` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

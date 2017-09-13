SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `openrs_2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

DROP TABLE IF EXISTS `articulos`;
CREATE TABLE `articulos` (
  `id` int(10) UNSIGNED NOT NULL,
  `creado` datetime NOT NULL,
  `modificado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_estado` tinyint(3) UNSIGNED NOT NULL,
  `visitas` int(11) NOT NULL DEFAULT '0',
  `id_autor` int(10) UNSIGNED NOT NULL,
  `comentario` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `creado`, `modificado`, `id_estado`, `visitas`, `id_autor`, `comentario`) VALUES
(1, '2017-08-30 17:11:48', '2017-08-30 15:11:48', 1, 30, 1, 0),
(2, '2017-08-31 20:13:45', '2017-08-31 18:13:45', 1, 54, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos_idiomas`
--

DROP TABLE IF EXISTS `articulos_idiomas`;
CREATE TABLE `articulos_idiomas` (
  `id_articulo` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(200) CHARACTER SET latin1 NOT NULL,
  `descripcion` text CHARACTER SET latin1 NOT NULL,
  `contenido` text CHARACTER SET latin1 NOT NULL,
  `img_articulo` varchar(200) CHARACTER SET latin1 NOT NULL,
  `img_articulo_mini` varchar(250) CHARACTER SET latin1 NOT NULL,
  `id_articulo_idioma` int(11) NOT NULL,
  `id_idioma` int(11) NOT NULL,
  `url_seo_articulo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `articulos_idiomas`
--

INSERT INTO `articulos_idiomas` (`id_articulo`, `titulo`, `descripcion`, `contenido`, `img_articulo`, `img_articulo_mini`, `id_articulo_idioma`, `id_idioma`, `url_seo_articulo`) VALUES
(1, 'Hola mundo', 'hola mundo', '<p>\r\n <p> hola mundo</p></p>', 'hola-mundo_es.jpg', 'hola-mundo_es_thumb.jpg', 1, 1, 'hola_mundo'),
(1, 'hello world', 'hello world', '<p>\r\n	&lt;p&gt; hello world&lt;/p&gt;</p>\r\n', 'hola_mundo.jpg', 'hola_mundo_thumb.jpg', 2, 53, 'hello_world'),
(2, 'Mapa por provincias para saber dónde se vendieron más y menos viviendas nuevas y usadas', 'Descripción de Mapa por provincias para saber dónde se vendieron más y menos viviendas nuevas y usadas', '<p xss=removed>\r\n El pasado mes de junio se vendieron 44.135 viviendas, un 19,3% más que hace un año, pero un 1,4% menos que el mes anterior, según datos del INE. Aunque la venta de casas de segunda mano es el líder indiscutible, se vendieron 7.899 casas nuevas, niveles que no se veían desde enero de 2015. Y<strong> Madrid se lleva la palma al acaparar un 23% del total de viviendas nuevas transmitidas</strong>. Por su parte, se transmitieron 36.236 casas usadas, un 19,2% más interanual y Madrid volvió a ser líder.</p>\r\n<p xss=removed>\r\n Para ver de cerca cómo se han repartido las compraventas de viviendas y qué provincias han sido las más activas hemos preparado dos mapas interactivos con las transmisiones de casas usadas y nuevas.</p>\r\n<p xss=removed>\r\n Cabe destacar el papel de la provincia de Madrid, que ha sido la protagonista en junio: en compraventa de vivienda nueva ha acaparado el 23% del total de operaciones, al registrar 1.815 ventas de obra nueva. Le siguen, pero de lejos, Barcelona, con 589 compraventas, y Málaga con 521 operaciones.</p>\r\n<p xss=removed>\r\n En cambio, en el lado contrario, se sitúan Melilla con una vivienda nueva vendida, Zamora, con 6 casas a estrenar transmitidas, y Cuenca, con 8 operaciones.</p>\r\n<p>\r\n <strong>En cuanto a la venta de viviendas usadas, Madrid volvió a liderar las operaciones con 5.483 unidades, un 15%</strong> de las 36.236 casas traspasadas. Le siguen, de nuevo, Barcelona, con 4.327 ventas y Málaga con 2.305 operaciones. En el otro lado de la balanza, se encuentran Ceuta con 17 ventas, Melilla, con 44, y Soria, con 46 casas vendidas.</p>', 'mapa_provincias.png', 'mapa_provincias_thumb.png', 3, 1, 'mapa_provincias'),
(2, 'Map by provinces to know where more and less new and used homes were sold', 'Description of Map by provinces to know where more and less new and used homes were sold', '<p>\r\n	Last June, 44,135 homes were sold, 19.3% more than a year ago, but 1.4% less than the previous month, according to INE data. Although the sale of second-hand homes is the undisputed leader, 7,899 new homes were sold, levels that were not seen since January 2015.</p>\r\n<p>\r\n	And Madrid takes the palm by hogging 23% of the total new homes transmitted. On the other hand, 36,236 used homes were transmitted, 19.2% more interanual and Madrid returned to be leader. To see how the housing sales have been distributed and which provinces have been the most active we have prepared two interactive maps with the transmissions of used and new homes.</p>\r\n<p>\r\n	Of note is the role of the province of Madrid, which was the main player in June: in the purchase of new housing, it accounted for 23% of total operations, recording 1,815 new building sales. Next, but from afar, Barcelona, ??with 589 sales and Malaga with 521 operations. On the other hand, on the opposite side, Melilla is located with a new house sold, Zamora, with 6 new houses transmitted, and Cuenca, with 8 operations.</p>\r\n<p>\r\n	As for the sale of used homes, Madrid returned to lead operations with 5,483 units, 15% of the 36,236 homes transferred. Next, again, Barcelona, ??with 4,327 sales and Malaga with 2,305 operations. On the other side of the balance, are Ceuta with 17 sales, Melilla, with 44, and Soria, with 46 houses sold.</p>\r\n', 'mapa_provincias.png', 'mapa_provincias_thumb.png', 4, 53, 'province_map');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo_categorias`
--

DROP TABLE IF EXISTS `articulo_categorias`;
CREATE TABLE `articulo_categorias` (
  `id` int(10) NOT NULL,
  `id_articulo` int(10) NOT NULL,
  `id_categoria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo_etiquetas`
--

DROP TABLE IF EXISTS `articulo_etiquetas`;
CREATE TABLE `articulo_etiquetas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_articulo` int(10) UNSIGNED NOT NULL,
  `id_etiqueta` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `backup`
--

DROP TABLE IF EXISTS `backup`;
CREATE TABLE `backup` (
  `backup_id` int(11) UNSIGNED NOT NULL,
  `backup_name` varchar(255) NOT NULL,
  `backup_location` varchar(255) NOT NULL,
  `backup_type` int(1) NOT NULL DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `backup`
--

INSERT INTO `backup` (`backup_id`, `backup_name`, `backup_location`, `backup_type`, `created_date`, `admin_id`) VALUES
(9, '9f7b7590dce40c89acb3c0be4d3bc791_09_08_2017_15_51_43_db.zip', 'backups/databases/', 1, '2017-08-09 07:51:47', 2),
(10, '805eb4690b16f01af2a8d76b66c4e90d_site.zip', 'backups/sites/', 2, '2017-08-09 07:51:47', 2),
(11, '1fd3a68be2f1d07454aeec94265f9933_23_08_2017_15_54_57_db.zip', 'backups/databases/', 1, '2017-08-23 11:54:57', 2),
(12, '380cd8894cf2373ab17e493bb80f6639_site.zip', 'backups/sites/', 2, '2017-08-23 11:55:01', 2),
(14, '986134d957e24fe9334107fc2fb8b582_31_08_2017_18_52_28_db.zip', 'backups/databases/', 1, '2017-08-31 16:52:29', 2),
(15, '03a1c0cb2c3f7abb97811b9b70eaacbf_site.zip', 'backups/sites/', 2, '2017-08-31 16:52:32', 2),
(16, 'f7a9cf9a3c17dd55e78a0932d7e48451_05_09_2017_20_47_46_db.zip', 'backups/databases/', 1, '2017-09-05 18:47:46', 2),
(17, '5f543c2c8d845b2bc79dd2e399c599ca_site.zip', 'backups/sites/', 2, '2017-09-05 18:47:50', 2),
(18, 'bdefa7e341661a47aae45be9ee282c13_13_09_2017_10_52_35_db.zip', 'backups/databases/', 1, '2017-09-13 08:52:36', 2),
(19, 'f737c5472b7a2408c6e87bdb83e85548_site.zip', 'backups/sites/', 2, '2017-09-13 08:52:38', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloque`
--

DROP TABLE IF EXISTS `bloque`;
CREATE TABLE `bloque` (
  `id_bloque` int(4) UNSIGNED NOT NULL,
  `prioridad` int(2) UNSIGNED NOT NULL,
  `background` varchar(10) DEFAULT NULL,
  `c_titulo` varchar(10) DEFAULT NULL,
  `id_tipo_bloque` int(10) UNSIGNED NOT NULL,
  `id_seccion` int(10) UNSIGNED NOT NULL,
  `id_estado` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `ancho` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bloque`
--

INSERT INTO `bloque` (`id_bloque`, `prioridad`, `background`, `c_titulo`, `id_tipo_bloque`, `id_seccion`, `id_estado`, `ancho`) VALUES
(82, 1, '#ffffff', '#000000', 4, 5, 1, 1),
(88, 1, '#ffffff', '', 1, 13, 1, 1),
(122, 1, '#000000', '#000000', 1, 23, 1, 1),
(150, 2, '#ffffff', '#000000', 1, 3, 1, 2),
(151, 4, '#8000ff', '#ff8000', 1, 1, 1, 1),
(152, 5, '#8000ff', '#ff8000', 1, 1, 1, 1),
(153, 6, '#8000ff', '#ff8000', 1, 1, 1, 1),
(154, 7, '#ffd7ff', '#000000', 1, 1, 1, 1),
(155, 8, '#ffd7ff', '#000000', 1, 1, 1, 1),
(156, 9, '#ffd7ff', '#000000', 1, 1, 1, 1),
(159, 10, '#ffffff', '#000000', 1, 1, 1, 2),
(163, 11, '#ffffff', '#000000', 2, 1, 1, 1),
(164, 12, '#c41e1e', '#ffffff', 7, 1, 1, 1),
(165, 13, '#ffffff', '#000000', 5, 1, 1, 2),
(166, 14, '#ffffff', '#000000', 5, 1, 1, 2),
(167, 1, '#ffffff', '#000000', 3, 7, 1, 1),
(168, 1, '#ffffff', '#c10000', 1, 6, 1, 2),
(169, 1, '#ffffff', '#000000', 1, 8, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloque_idiomas`
--

DROP TABLE IF EXISTS `bloque_idiomas`;
CREATE TABLE `bloque_idiomas` (
  `id_bloque` int(4) UNSIGNED NOT NULL,
  `titulo_bloque` varchar(100) NOT NULL,
  `id_idioma` int(11) UNSIGNED NOT NULL,
  `id_bloque_idiomas` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bloque_idiomas`
--

INSERT INTO `bloque_idiomas` (`id_bloque`, `titulo_bloque`, `id_idioma`, `id_bloque_idiomas`) VALUES
(82, 'Mapa', 1, 96),
(88, 'Aviso legal', 1, 98),
(122, 'contenido', 1, 150),
(150, 'NOSOTROS', 1, 174),
(163, 'slider', 1, 187),
(163, 'slidere', 53, 188),
(164, 'Buscador', 1, 189),
(164, 'Search', 53, 190),
(165, 'Oportunidades', 1, 191),
(165, 'Opportunities', 53, 192),
(166, 'Destacados', 1, 193),
(166, 'Featured', 53, 194),
(167, 'noticias', 1, 195),
(167, 'news', 53, 196),
(150, 'NOSOTROS', 53, 197),
(168, 'Servicios', 1, 198),
(168, 'Services', 53, 199),
(169, 'Aviso Legal - Descripción', 1, 200),
(169, 'Legal Warning - Description', 53, 201),
(82, 'Map', 53, 202);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloque_inmuebles`
--

DROP TABLE IF EXISTS `bloque_inmuebles`;
CREATE TABLE `bloque_inmuebles` (
  `idbloque_inmuebles` int(11) NOT NULL,
  `tipo` int(2) DEFAULT NULL,
  `num_inmuebles` int(2) DEFAULT NULL,
  `id_bloque` int(11) NOT NULL,
  `muestra_resumen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bloque_inmuebles`
--

INSERT INTO `bloque_inmuebles` (`idbloque_inmuebles`, `tipo`, `num_inmuebles`, `id_bloque`, `muestra_resumen`) VALUES
(1, 2, 3, 165, 1),
(2, 1, 3, 166, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrusel`
--

DROP TABLE IF EXISTS `carrusel`;
CREATE TABLE `carrusel` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_bloque` int(10) UNSIGNED NOT NULL,
  `tipo_carrusel` int(10) UNSIGNED NOT NULL,
  `por_pagina` int(10) NOT NULL DEFAULT '9',
  `maximo` int(10) NOT NULL DEFAULT '0',
  `columnas` int(10) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carrusel`
--

INSERT INTO `carrusel` (`id`, `id_bloque`, `tipo_carrusel`, `por_pagina`, `maximo`, `columnas`) VALUES
(1, 163, 1, 9, 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_informacion_documentacion`
--

DROP TABLE IF EXISTS `categorias_informacion_documentacion`;
CREATE TABLE `categorias_informacion_documentacion` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `referencia` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias_informacion_documentacion`
--

INSERT INTO `categorias_informacion_documentacion` (`id`, `nombre`, `referencia`, `descripcion`) VALUES
(1, 'General', 'general', '-'),
(2, 'Clientes', 'clientes', '-'),
(3, 'Inmuebles', 'inmuebles', '-'),
(4, 'Agentes Inmobiliarios', 'agentes', '-'),
(5, 'Fichas de visita', 'fichas_visita', '-'),
(6, 'Carteles', 'carteles', 'Carteles del inmueble'),
(7, 'Demandas', 'demandas', '-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_blog`
--

DROP TABLE IF EXISTS `categoria_blog`;
CREATE TABLE `categoria_blog` (
  `id` int(3) NOT NULL,
  `creada` datetime NOT NULL,
  `modificada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_creador` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_blog_idiomas`
--

DROP TABLE IF EXISTS `categoria_blog_idiomas`;
CREATE TABLE `categoria_blog_idiomas` (
  `id_categoria_idioma` int(11) NOT NULL,
  `id_categoria` int(3) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `id_idioma` int(11) NOT NULL,
  `url_seo_categoria_blog` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_carrusel`
--

DROP TABLE IF EXISTS `categoria_carrusel`;
CREATE TABLE `categoria_carrusel` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_carrusel` int(10) UNSIGNED NOT NULL,
  `prioridad` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_carrusel_idiomas`
--

DROP TABLE IF EXISTS `categoria_carrusel_idiomas`;
CREATE TABLE `categoria_carrusel_idiomas` (
  `id_categoria_carrusel_idiomas` int(10) UNSIGNED NOT NULL,
  `nombre_cat` varchar(25) NOT NULL,
  `descripcion_cat` text NOT NULL,
  `id_categoria_carrusel` int(10) UNSIGNED NOT NULL,
  `id_idioma` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `fecha_nac` date DEFAULT NULL,
  `direccion` varchar(200) NOT NULL,
  `pais_id` int(11) UNSIGNED NOT NULL,
  `poblacion_id` int(11) UNSIGNED DEFAULT NULL,
  `telefonos` varchar(70) NOT NULL,
  `nif` varchar(11) NOT NULL,
  `observaciones` text NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `correo` varchar(250) NOT NULL,
  `estado_id` int(11) UNSIGNED NOT NULL DEFAULT '5',
  `agente_asignado_id` int(11) UNSIGNED DEFAULT NULL,
  `medio_captacion_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `fecha_nac`, `direccion`, `pais_id`, `poblacion_id`, `telefonos`, `nif`, `observaciones`, `fecha_alta`, `fecha_actualizacion`, `correo`, `estado_id`, `agente_asignado_id`, `medio_captacion_id`) VALUES
(1, 'Ángel', 'Berasuain Ruiz', '1982-05-19', 'Calle pinito del Oro, número 4, 6 C', 64, 292, '956078391-659163979', '36412640Y', 'Cliente inicial\r\n', '2017-05-26 14:15:01', '2017-09-03 13:07:46', 'angel.berasuain@gmail.com', 12, 4, 6),
(2, 'Diego', 'Guerrero', NULL, 'Calle mar del norte', 64, 1788, '', '14837410H', '', '2017-05-26 14:15:01', '2017-09-03 13:08:03', 'diego@fac.com', 12, 2, 6),
(4, 'Jose', 'Perez', '2000-10-20', 'Calle Obispo Orberá', 64, 3, '121212', '63053238A', 'uuuuuuuuuu', '2017-05-26 14:15:01', '2017-07-25 18:23:19', 'pepito@perez.com', 5, 3, 6),
(7, 'Jonh', 'Dahl', '1981-01-01', 'copenhague', 55, NULL, '(+65) 152645789', 'X3763473Y', '', '2017-05-25 12:05:48', '2017-09-03 13:08:28', 'pepito2@perez.com', 6, 3, 1),
(8, 'David', 'Morato', '1975-02-01', 'Calle flamenco', 64, 329, '-', '14526680H', 'sdsdsd', '2017-05-26 14:15:01', '2017-07-25 18:22:24', 'cuniao@hotmail.com', 5, 3, 6),
(10, 'Antonio', 'Sánchez Rodríguez', '1975-10-10', 'Calle Rosa', 64, 1780, '', '46300568G', '', '2017-05-31 19:23:21', '2017-08-29 14:01:30', 'test@test.com', 5, 4, 5),
(21, 'Antonio', 'Escalante Pérez', '1982-05-19', 'Avenida marconi, 1', 64, 1780, '', '21017477P', 'Test fecha nac', '2017-06-02 12:00:12', '2017-07-25 18:23:44', 'test@fechanac.com', 5, NULL, 2),
(22, 'Antonio', 'Calvante Díaz', '1982-05-19', 'Calle Obispo Orberá', 64, 292, '-', '00346592M', '', '2017-06-02 12:00:12', '2017-07-25 18:22:47', 'sdasd@asasd.com', 5, NULL, 2),
(23, 'GUILLERMO', 'LEON SANCHEZ', NULL, 'Calle benjumeda, 10', 64, 1780, '956112233', '52357246T', '', '2017-06-11 13:58:29', '2017-06-11 13:59:11', 'guillermo.leon@test.com', 6, NULL, 2),
(25, 'Raúl', 'López García', '1982-05-19', 'ecuador', 64, 1780, '', '72163238W', '', '2017-06-26 18:59:45', '2017-08-18 19:29:36', 'raul.lopez@test.com', 13, NULL, 2),
(27, 'Rosa', 'De Benito Díaz', '1952-05-19', 'Iglesia', 64, 1770, '', '15092216F', '', '2017-07-08 14:32:40', '2017-08-18 19:29:09', 'rosa.benito@test.com', 13, 2, 2),
(28, 'Antonio', 'Borrell Sánchez', '1981-01-01', 'Calle Huerta del obispo', 64, 1780, '956010203', '88406917T', '-', '2017-07-25 19:50:26', NULL, 'antonio.borrell@correo.com', 5, 2, 3),
(30, 'Manuel', 'Losantos Gómez', '1975-12-01', 'Calle García de Sola, 2', 64, 1780, '956010259', '01125672Y', 'Pendiente llamar al cliente para recoger llaves', '2017-08-18 13:10:36', '2017-08-18 19:29:23', 'manuel.losantos@prueba.com', 13, 2, 7),
(31, 'Jose Maria', 'Gazquez Hernandez', '1975-10-15', 'C/Tortola, 7', 64, 329, '950871562', '42616828J', '', '2017-08-22 11:16:20', NULL, 'agazquez@inventado.com', 11, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_fichas`
--

DROP TABLE IF EXISTS `clientes_fichas`;
CREATE TABLE `clientes_fichas` (
  `id` int(11) UNSIGNED NOT NULL,
  `plantilla_id` int(11) UNSIGNED NOT NULL,
  `agente_id` int(11) UNSIGNED NOT NULL,
  `html` text NOT NULL,
  `fecha` date NOT NULL,
  `cliente_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes_fichas`
--

INSERT INTO `clientes_fichas` (`id`, `plantilla_id`, `agente_id`, `html`, `fecha`, `cliente_id`) VALUES
(4, 4, 2, '<p>\r\n	<small class=\"col-sm-4\"><strong>Datos General:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">20/07/2017: Fecha actual en formato num&eacute;rico</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">20 de julio del 2017: Fecha actual en formato texto</small></li>\r\n</ul>\r\n<p>\r\n	<small class=\"col-sm-4\"><strong>Datos Clientes:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">33446605M: NIF/NIE/CIF del cliente</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">aaaaaaa: Nombre del cliente</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">asdad: Apellidos del cliente</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">: Fecha de nacimiento</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Dinamarca: Nombre del pa&iacute;s donde reside</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">: Nombre de la provincia</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">: Nombre del municipio</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">copenhague: Domicilio donde reside el cliente</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">pepito2@perez.com: Correo electr&oacute;nico</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">956078391-659163979: Tel&eacute;fonos de contacto</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Activo: Estado</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Empleado1,Nombre: Nombre del agente asignado</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\"><p>\r\n	assssssssss</p>\r\n: Observaciones</small></li>\r\n</ul>\r\n<p>\r\n	<small class=\"col-sm-4\"><strong>Datos Agentes Inmobiliarios:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">Ángel Luis : Nombre del agente</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Berasuain Ruiz: Apellidos del agente</small></li>\r\n</ul>\r\n', '2017-07-20', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_ficheros`
--

DROP TABLE IF EXISTS `clientes_ficheros`;
CREATE TABLE `clientes_ficheros` (
  `id` int(11) UNSIGNED NOT NULL,
  `cliente_id` int(11) UNSIGNED NOT NULL,
  `texto_fichero` text,
  `fichero` varchar(255) NOT NULL,
  `tipo_fichero_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes_ficheros`
--

INSERT INTO `clientes_ficheros` (`id`, `cliente_id`, `texto_fichero`, `fichero`, `tipo_fichero_id`) VALUES
(2, 1, 'Fichero de prueba', 'uploads/clientes/1/38a20926acec5eb01c9f5cf038b64140.pdf', 5),
(3, 1, 'Pasaporte', 'uploads/clientes/1/cdc2c317d027aa74f27bb5a3942fd819.png', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_inmuebles`
--

DROP TABLE IF EXISTS `clientes_inmuebles`;
CREATE TABLE `clientes_inmuebles` (
  `id` int(11) UNSIGNED NOT NULL,
  `cliente_id` int(11) UNSIGNED NOT NULL,
  `inmueble_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes_inmuebles`
--

INSERT INTO `clientes_inmuebles` (`id`, `cliente_id`, `inmueble_id`) VALUES
(1, 1, 1),
(7, 1, 3),
(2, 1, 4),
(13, 1, 26),
(6, 2, 4),
(11, 7, 15),
(14, 8, 5),
(15, 31, 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios_blog`
--

DROP TABLE IF EXISTS `comentarios_blog`;
CREATE TABLE `comentarios_blog` (
  `id` int(10) UNSIGNED NOT NULL,
  `contenido` text CHARACTER SET latin1 NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `id_articulo` int(10) UNSIGNED NOT NULL,
  `num_mensaje_articulo` int(11) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nick` varchar(150) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentarios_blog`
--

INSERT INTO `comentarios_blog` (`id`, `contenido`, `visible`, `id_articulo`, `num_mensaje_articulo`, `creado`, `nick`) VALUES
(1, 'asdf', 1, 1, 1, '2017-08-30 16:36:19', 'asdf'),
(2, 'Bonito mapa¡¡', 1, 2, 1, '2017-09-06 10:58:15', 'antonio_lopez'),
(3, 'Vaya con madrid llevándoselo todo :D', 1, 2, 2, '2017-09-06 11:15:31', 'klaimir');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidades_autonomas`
--

DROP TABLE IF EXISTS `comunidades_autonomas`;
CREATE TABLE `comunidades_autonomas` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre_comunidad_autonoma` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comunidades_autonomas`
--

INSERT INTO `comunidades_autonomas` (`id`, `nombre_comunidad_autonoma`) VALUES
(1, 'Andalucía'),
(2, 'Aragón'),
(3, 'Cantabria'),
(4, 'Castilla y León'),
(5, 'Castilla-La Mancha'),
(6, 'Cataluña'),
(7, 'Ceuta'),
(8, 'Comunidad de Madrid'),
(9, 'Comunidad Valenciana'),
(10, 'Extremadura'),
(11, 'Galicia'),
(12, 'Illes Balears'),
(13, 'Islas Canarias'),
(14, 'La Rioja'),
(15, 'Melilla'),
(16, 'Navarra'),
(17, 'País Vasco'),
(18, 'Principado de Asturias'),
(19, 'Región de Murcia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id_config` int(9) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `webseo` varchar(100) NOT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `cabecera_fija` tinyint(1) NOT NULL,
  `ccabecera` varchar(7) NOT NULL DEFAULT '#cbbddb',
  `cfuentecabecera` varchar(7) NOT NULL DEFAULT '#000000',
  `cbordecabecera` varchar(7) NOT NULL DEFAULT '#cccccc',
  `cfondo` varchar(7) NOT NULL DEFAULT '#5247cf',
  `cfuentefondo` varchar(7) NOT NULL,
  `cpie` varchar(7) NOT NULL DEFAULT '#be540e',
  `cfuentepie` varchar(7) NOT NULL DEFAULT '#000000',
  `imagen_thumb` varchar(60) DEFAULT NULL,
  `idioma_defecto` int(11) NOT NULL DEFAULT '1',
  `facebook` varchar(150) DEFAULT NULL,
  `twitter` varchar(150) DEFAULT NULL,
  `google` varchar(150) DEFAULT NULL,
  `vimeo` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id_config`, `nombre`, `webseo`, `imagen`, `cabecera_fija`, `ccabecera`, `cfuentecabecera`, `cbordecabecera`, `cfondo`, `cfuentefondo`, `cpie`, `cfuentepie`, `imagen_thumb`, `idioma_defecto`, `facebook`, `twitter`, `google`, `vimeo`) VALUES
(1, 'OPENRS (Open Real Estate Software)', 'openrs', 'gesticadiz.jpg', 0, '#ffffff', '#2e5f87', '#2e5f87', '#ffffff', '#2e5f87', '#c41e1e', '#ffffff', 'gesticadiz_thumb.jpg', 1, 'https://www.facebook.com/Gesticadiz-1614434595489839/', 'http://twitter.com', 'http://google.com', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_admin`
--

DROP TABLE IF EXISTS `config_admin`;
CREATE TABLE `config_admin` (
  `id` int(11) NOT NULL,
  `email_contacto` varchar(120) NOT NULL,
  `google_api_key` varchar(50) NOT NULL,
  `google_analytics_ID` varchar(20) NOT NULL,
  `recaptcha_secret_key` varchar(60) NOT NULL,
  `recaptcha_site_key` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `demandas`
--

DROP TABLE IF EXISTS `demandas`;
CREATE TABLE `demandas` (
  `id` int(11) UNSIGNED NOT NULL,
  `referencia` varchar(40) NOT NULL,
  `metros_desde` int(4) NOT NULL,
  `metros_hasta` int(4) NOT NULL,
  `habitaciones_desde` int(2) NOT NULL,
  `habitaciones_hasta` int(2) NOT NULL,
  `banios_desde` int(2) NOT NULL,
  `banios_hasta` int(2) NOT NULL,
  `precio_desde` int(10) UNSIGNED NOT NULL,
  `precio_hasta` int(10) UNSIGNED NOT NULL,
  `provincia_id` int(11) UNSIGNED DEFAULT NULL,
  `poblacion_id` int(11) UNSIGNED DEFAULT NULL,
  `observaciones` text,
  `estado_id` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `certificacion_energetica_id` int(11) UNSIGNED DEFAULT NULL,
  `anio_construccion_desde` int(4) NOT NULL,
  `anio_construccion_hasta` int(4) NOT NULL,
  `agente_asignado_id` int(11) UNSIGNED DEFAULT NULL,
  `oferta_id` int(2) NOT NULL DEFAULT '0',
  `tipo_demanda_id` int(2) NOT NULL DEFAULT '1',
  `cliente_id` int(11) UNSIGNED NOT NULL,
  `fecha_alta` date NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `demandas`
--

INSERT INTO `demandas` (`id`, `referencia`, `metros_desde`, `metros_hasta`, `habitaciones_desde`, `habitaciones_hasta`, `banios_desde`, `banios_hasta`, `precio_desde`, `precio_hasta`, `provincia_id`, `poblacion_id`, `observaciones`, `estado_id`, `certificacion_energetica_id`, `anio_construccion_desde`, `anio_construccion_hasta`, `agente_asignado_id`, `oferta_id`, `tipo_demanda_id`, `cliente_id`, `fecha_alta`, `fecha_actualizacion`) VALUES
(1, 'DEM0001', 50, 120, 1, 2, 1, 1, 50000, 150000, 11, 1780, 'Desea un inmueble bonito y amplio', 7, 6, 1980, 2017, 4, 1, 2, 1, '2017-06-20', NULL),
(3, 'DEM0002', 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 'Oficina en el centro', 7, NULL, 0, 0, 2, 2, 1, 2, '2017-06-19', NULL),
(8, 'DEM0003', 0, 0, 0, 0, 0, 0, 60000, 120000, NULL, NULL, 'uuuuuuuuuuuu', 7, NULL, 0, 0, 2, 1, 2, 8, '2017-06-21', NULL),
(12, 'DEMCADIZDUPLEX', 0, 0, 0, 0, 0, 0, 0, 0, 11, 1780, '-', 7, NULL, 0, 0, 2, 1, 2, 10, '2017-06-21', '2017-08-27 14:35:26'),
(13, 'DEMINMUEBLE', 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '-', 9, NULL, 0, 0, 2, 1, 1, 21, '2017-06-26', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `demandas_fichas`
--

DROP TABLE IF EXISTS `demandas_fichas`;
CREATE TABLE `demandas_fichas` (
  `id` int(11) UNSIGNED NOT NULL,
  `plantilla_id` int(11) UNSIGNED NOT NULL,
  `agente_id` int(11) UNSIGNED NOT NULL,
  `html` text NOT NULL,
  `fecha` date NOT NULL,
  `demanda_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `demandas_fichas`
--

INSERT INTO `demandas_fichas` (`id`, `plantilla_id`, `agente_id`, `html`, `fecha`, `demanda_id`) VALUES
(5, 8, 2, '<p>\r\n	<small class=\"col-sm-4\"><strong>Datos General:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">04/07/2017: Fecha actual en formato num&eacute;rico</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">4 de julio del 2017: Fecha actual en formato texto</small></li>\r\n</ul>\r\n<p>\r\n	<small class=\"col-sm-4\"><strong>Datos Agentes Inmobiliarios:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">Ángel Luis : Nombre del agente</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Berasuain Ruiz: Apellidos del agente</small></li>\r\n</ul>\r\n<p>\r\n	<small class=\"col-sm-4\"><strong>Datos Demandas:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">DEM0001: Referencia de la demanda</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">20/06/2017: Fecha de alta de la demanda</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Venta: Oferta demandada</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Con filtros de búsqueda: Tipo de demanda</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Berasuain Ruiz, Angel: Nombre completo del cliente demandante</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Casa Grande, Garaje, Local comercial: Listado de tipos de inmuebles separados por comas</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Cádiz: Nombre de la provincia</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Cádiz: Nombre del municipio</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Centro: Listado de zonas separados por comas</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">50: Metros totales (desde)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">60: Metros totales (hasta)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">1: N&uacute;mero de habitaciones (desde)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">2: N&uacute;mero de habitaciones (hasta)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">1: N&uacute;mero de ba&ntilde;os (desde)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">1: N&uacute;mero de ba&ntilde;os (hasta)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">50.000: Precio (desde)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">100.000: Precio (hasta)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">1990: A&ntilde;o construcci&oacute;n (desde)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">2012: A&ntilde;o construcci&oacute;n (hasta)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">D: Certificaci&oacute;n energ&eacute;tica m&iacute;nima</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Sin atender: Estado</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Berasuain Ruiz, Ángel Luis : Nombre completo del agente asignado</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Desea un inmueble bonito y amplio: Observaciones</small></li>\r\n</ul>\r\n', '2017-07-04', 1),
(6, 8, 2, '<p>\r\n	<small class=\"col-sm-4\"><strong>Datos General:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">27/08/2017: Fecha actual en formato num&eacute;rico</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">27 de August del 2017: Fecha actual en formato texto</small></li>\r\n</ul>\r\n<p>\r\n	<small class=\"col-sm-4\"><strong>Datos Agentes Inmobiliarios:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">Ángel Luis : Nombre del agente</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Berasuain Ruiz: Apellidos del agente</small></li>\r\n</ul>\r\n<p>\r\n	<small class=\"col-sm-4\"><strong>Datos Demandas:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">DEMALMERIA0001: Referencia de la demanda</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">21/06/2017: Fecha de alta de la demanda</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Venta: Oferta demandada</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Con filtros de búsqueda: Tipo de demanda</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Hombre, ULTIMO: Nombre completo del cliente demandante</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Duplex: Listado de tipos de inmuebles separados por comas</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Almería: Nombre de la provincia</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Almería: Nombre del municipio</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Zapillo, Piedras Redondas: Listado de zonas separados por comas</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">0: Metros totales (desde)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">0: Metros totales (hasta)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">0: N&uacute;mero de habitaciones (desde)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">0: N&uacute;mero de habitaciones (hasta)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">0: N&uacute;mero de ba&ntilde;os (desde)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">0: N&uacute;mero de ba&ntilde;os (hasta)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">0: Precio (desde)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">0: Precio (hasta)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">0: A&ntilde;o construcci&oacute;n (desde)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">0: A&ntilde;o construcci&oacute;n (hasta)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">: Certificaci&oacute;n energ&eacute;tica m&iacute;nima</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Sin valorar: Estado</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">Berasuain Ruiz, Ángel Luis : Nombre completo del agente asignado</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">-: Observaciones</small></li>\r\n</ul>\r\n', '2017-08-27', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `demandas_ficheros`
--

DROP TABLE IF EXISTS `demandas_ficheros`;
CREATE TABLE `demandas_ficheros` (
  `id` int(11) UNSIGNED NOT NULL,
  `demanda_id` int(11) UNSIGNED NOT NULL,
  `texto_fichero` text,
  `fichero` varchar(255) NOT NULL,
  `tipo_fichero_id` int(11) UNSIGNED NOT NULL DEFAULT '7'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `demandas_ficheros`
--

INSERT INTO `demandas_ficheros` (`id`, `demanda_id`, `texto_fichero`, `fichero`, `tipo_fichero_id`) VALUES
(1, 6, 'Primera visita', 'uploads/demandas/6/7df73b7cbaae64128a6c565b8dedf986.jpg', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `demandas_poblaciones_zonas`
--

DROP TABLE IF EXISTS `demandas_poblaciones_zonas`;
CREATE TABLE `demandas_poblaciones_zonas` (
  `id` int(11) UNSIGNED NOT NULL,
  `demanda_id` int(11) UNSIGNED NOT NULL,
  `zona_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `demandas_poblaciones_zonas`
--

INSERT INTO `demandas_poblaciones_zonas` (`id`, `demanda_id`, `zona_id`) VALUES
(16, 1, 6),
(19, 12, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `demandas_tipos_inmueble`
--

DROP TABLE IF EXISTS `demandas_tipos_inmueble`;
CREATE TABLE `demandas_tipos_inmueble` (
  `id` int(11) UNSIGNED NOT NULL,
  `demanda_id` int(11) UNSIGNED NOT NULL,
  `tipo_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `demandas_tipos_inmueble`
--

INSERT INTO `demandas_tipos_inmueble` (`id`, `demanda_id`, `tipo_id`) VALUES
(48, 1, 1),
(49, 1, 2),
(47, 1, 9),
(7, 8, 1),
(6, 8, 3),
(52, 12, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE `estados` (
  `id` int(11) UNSIGNED NOT NULL,
  `ambito_id` tinyint(1) NOT NULL COMMENT '1 para clientes, 2 para inmuebles y 3 para demandas',
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(120) NOT NULL,
  `historico` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `ambito_id`, `nombre`, `descripcion`, `historico`) VALUES
(1, 2, 'Captación', 'Buscando demandantes', 0),
(2, 2, 'Vendido', 'El inmueble está vendido', 1),
(3, 2, 'En construcción', 'Aún se está construyendo', 0),
(4, 2, 'Alquilado', 'El inmueble está alquilado', 0),
(5, 1, 'Buscando oferta', 'Se estan realizando acciones para encontrar oferta', 0),
(6, 1, 'Inactivo', 'El cliente ya no está activo, forma parte del histórico', 1),
(7, 3, 'Sin valorar', 'Aún no se ha comenzado con el proceso de la demanda', 0),
(8, 3, 'Buscando inmuebles', 'Buscando inmuebles que cumplan las expectativas', 0),
(9, 3, 'Visitando inmuebles', 'Proceso de visitas de inmuebles de interés', 0),
(10, 3, 'Cerrada con éxito', 'La demanda ha concluido con éxito', 1),
(11, 1, 'Buscando demanda', 'Se estan realizando acciones para encontrar demanda', 0),
(12, 1, 'Buscando oferta y demanda', 'Buscando oferta y demanda', 0),
(13, 1, 'Sin atender', 'Pendiente de revisar la situación del cliente', 0),
(14, 3, 'Pendiente de ficha de visita', 'Pendiente de ficha de visita', 0),
(15, 3, 'Cerrada con fracaso', 'La demanda ha concluido con fracaso', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

DROP TABLE IF EXISTS `etiquetas`;
CREATE TABLE `etiquetas` (
  `id` int(10) UNSIGNED NOT NULL,
  `etiqueta` varchar(100) CHARACTER SET latin1 NOT NULL,
  `id_idioma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `footer_opciones`
--

DROP TABLE IF EXISTS `footer_opciones`;
CREATE TABLE `footer_opciones` (
  `id_opc` int(2) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `id_idioma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `footer_opciones`
--

INSERT INTO `footer_opciones` (`id_opc`, `nombre`, `id_idioma`) VALUES
(1, 'menu footer', 1),
(2, 'redes sociales', 1),
(3, 'editor de texto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `footer_opciones_cliente`
--

DROP TABLE IF EXISTS `footer_opciones_cliente`;
CREATE TABLE `footer_opciones_cliente` (
  `id` int(2) NOT NULL,
  `id_opc` int(2) NOT NULL,
  `iduser` int(11) NOT NULL,
  `columna` int(2) NOT NULL,
  `num_articulos` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `footer_opciones_cliente`
--

INSERT INTO `footer_opciones_cliente` (`id`, `id_opc`, `iduser`, `columna`, `num_articulos`) VALUES
(7, 2, 1, 2, 0),
(8, 1, 1, 3, 0),
(10, 3, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `footer_texto_idiomas`
--

DROP TABLE IF EXISTS `footer_texto_idiomas`;
CREATE TABLE `footer_texto_idiomas` (
  `id` int(2) NOT NULL,
  `id_opc_cliente` int(2) NOT NULL,
  `contenido` text NOT NULL,
  `columna` int(2) NOT NULL,
  `id_idioma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `footer_texto_idiomas`
--

INSERT INTO `footer_texto_idiomas` (`id`, `id_opc_cliente`, `contenido`, `columna`, `id_idioma`) VALUES
(1, 1, 'telefono: 600 300 900', 2, 1),
(4, 10, '<p style=\"text-align: left;\">\r\n	Gesticadiz -&nbsp;Avda. Ana de Viya 3, 11009 C&aacute;diz. &nbsp;Tfno: 956 26 24 25 / 659 944 007<br />\r\n	De Lunes a Viernes de 10 a 14h y de 17:30 a 20:30h. S&aacute;bados concertar cita.</p>\r\n<p style=\"text-align: left;\">\r\n	GESTICADIZ&nbsp;cumple con la&nbsp;Ley Org&aacute;nica 15/1999&nbsp;de 13 de diciembre de&nbsp;Protecci&oacute;n de Datos de Car&aacute;cter Personal (LOPD)</p>\r\n', 1, 1),
(5, 10, '<p style=\"text-align: left;\">\r\n	Gesticadiz - Avda. Ana de Viya 3, 11009 C&aacute;diz. Tel: 956 26 24 25/659 944 007<br />\r\n	From Monday to Friday from 10 a.m. to 2 p.m. and from 5:30 a.m. to 8:30 p.m. Saturdays make an appointment.</p>\r\n<p style=\"text-align: left;\">\r\n	GESTICADIZ complies with Organic Law 15/1999 of 13 December on the Protection of Personal Data (LOPD)</p>\r\n', 1, 53);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `geocoding`
--

DROP TABLE IF EXISTS `geocoding`;
CREATE TABLE `geocoding` (
  `address` varchar(255) NOT NULL DEFAULT '',
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `geocoding`
--

INSERT INTO `geocoding` (`address`, `latitude`, `longitude`) VALUES
(', almeria, almeria, spain', 36.834, -2.46371),
(', cadiz, cadiz, spain', 36.5271, -6.2886),
(', san fernando, cadiz, spain', 36.4719, -6.19659),
('almeria, almeria, spain', 36.834, -2.46371),
('almeria, spain', 36.834, -2.46371),
('avenida amilcar barca, 2, cadiz, cadiz, spain', 36.5147, -6.28406),
('avenida del mediterraneo, 20, almeria, almeria, spain', 36.8261, -2.44624),
('avenida del mediterraneo, almeria, almeria, spain', 36.8411, -2.44728),
('avenida marconi, 10, cadiz, cadiz, spain', 36.5083, -6.27665),
('avenida marconi, cadiz, cadiz, spain', 36.5077, -6.27339),
('benjumeda, cadiz, cadiz, spain', 36.5336, -6.30003),
('c/tortola, 7, huercal de almeria, almeria, spain', 36.8904, -2.4427),
('cadiz, cadiz, spain', 36.5271, -6.2886),
('cadiz, spain', 36.5271, -6.2886),
('calle benjumeda, cadiz, cadiz, spain', 36.5336, -6.30003),
('calle chile, 2, cadiz, cadiz, spain', 36.5334, -6.30328),
('calle costa rica, 1, cadiz, cadiz, spain', 36.5365, -6.29342),
('calle doctor flemming, 11, cadiz, cadiz, spain', 36.5087, -6.27877),
('calle garcia de sola, 1, cadiz, cadiz, spain', 36.5199, -6.28231),
('calle garcia de sola, cadiz, cadiz, spain', 36.5175, -6.27998),
('calle granada, almeria, almeria, spain', 36.8474, -2.45767),
('calle huerta del obispo, cadiz, cadiz, spain', 36.5162, -6.28138),
('calle mar del norte, jerez de la frontera, cadiz, spain', 36.7056, -6.14804),
('calle obispo orbera, 4, almeria, almeria, spain', 36.8412, -2.46339),
('calle obispo orbera, 5, almeria, almeria, spain', 36.8413, -2.46311),
('calle obispo orbera, almeria, almeria, spain', 36.8402, -2.46145),
('calle obispo orbera,1, bajo, almeria, almeria, spain', 36.8415, -2.46339),
('calle pinito del oro, numero 4, 6 c, almeria, almeria, spain', 36.8566, -2.45344),
('calle real, 1, san fernando, cadiz, spain', 36.4676, -6.19175),
('calle real, 2, san fernando, cadiz, spain', 36.4675, -6.19279),
('calle real, san fernando, cadiz, spain', 36.4605, -6.20103),
('calle rosa, cadiz, cadiz, spain', 36.5313, -6.30239),
('carretera granada, 20, almeria, almeria, spain', 36.8539, -2.45065),
('carretera granada, almeria, almeria, spain', 36.8577, -2.44819),
('catedral, cadiz, cadiz, spain', 36.5291, -6.29509),
('centro comercial mediterraneo, almeria, almeria, spain', 36.8531, -2.44715),
('copenhague, denmark', 55.6761, 12.5683),
('hospital, cadiz, cadiz, spain', 36.5089, -6.27827),
('mercado, almeria, almeria, spain', 36.8403, -2.46264),
('mercado, cadiz, cadiz, spain', 36.5304, -6.2982),
('mercadona, cadiz, cadiz, spain', 36.5075, -6.26865),
('monumento constitucion, cadiz, cadiz, spain', 36.5351, -6.29307),
('pablo ruiz picasso, 4, 4 j, cadiz, cadiz, spain', 36.5091, -6.27633),
('sercodi, huercal de almeria, almeria, spain', 36.8909, -2.44595),
('torre tavira, cadiz, cadiz, spain', 36.532, -6.29833);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrador'),
(2, 'agente', 'Agente Inmobiliario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idiomas`
--

DROP TABLE IF EXISTS `idiomas`;
CREATE TABLE `idiomas` (
  `id_idioma` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nombre_seo` varchar(3) NOT NULL,
  `nombre_seo2` varchar(10) NOT NULL,
  `activo` int(1) UNSIGNED NOT NULL DEFAULT '0',
  `subido` int(1) UNSIGNED NOT NULL DEFAULT '0',
  `carpeta_idioma` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `idiomas`
--

INSERT INTO `idiomas` (`id_idioma`, `nombre`, `nombre_seo`, `nombre_seo2`, `activo`, `subido`, `carpeta_idioma`) VALUES
(1, 'Español', 'es', 'es', 1, 1, 'spanish'),
(2, 'Afrikaans', 'af', 'af', 0, 0, 'Afrikaans'),
(3, 'Albanian', 'sq', 'sq', 0, 0, 'Albanian'),
(4, 'Arabic (Algeria)', 'ar', 'ar-dz', 0, 0, 'Arabic_Algeria'),
(5, 'Arabic (Bahrain)', 'ar', 'ar-bh', 0, 0, 'Arabic_Bahrain'),
(6, 'Arabic (Egypt)', 'ar', 'ar-eg', 0, 0, 'Arabic_Egypt'),
(7, 'Arabic (Iraq)', 'ar', 'ar-iq', 0, 0, 'Arabic_Iraq'),
(8, 'Arabic (Jordan)', 'ar', 'ar-jo', 0, 0, 'Arabic_Jordan'),
(9, 'Arabic (Kuwait)', 'ar', 'ar-kw', 0, 0, 'Arabic_Kuwait'),
(10, 'Arabic (Lebanon)', 'ar', 'ar-lb', 0, 0, 'Arabic_Lebanon'),
(11, 'Arabic (libya)', 'ar', 'ar-ly', 0, 0, 'Arabic_libya'),
(12, 'Arabic (Morocco)', 'ar', 'ar-ma', 0, 0, 'Arabic_Morocco'),
(13, 'Arabic (Oman)', 'ar', 'ar-om', 0, 0, 'Arabic_Oman'),
(14, 'Arabic (Qatar)', 'ar', 'ar-qa', 0, 0, 'Arabic_Qatar'),
(15, 'Arabic (Saudi Arabia)', 'ar', 'ar-sa', 0, 0, 'Arabic_Saudi_Arabia'),
(16, 'Arabic (Syria)', 'ar', 'ar-sy', 0, 0, 'Arabic_Syria'),
(17, 'Arabic (Tunisia)', 'ar', 'ar-tn', 0, 0, 'Arabic_Tunisia'),
(18, 'Arabic (U.A.E.)', 'ar', 'ar-ae', 0, 0, 'Arabic_U_A_E'),
(19, 'Arabic (Yemen)', 'ar', 'ar-ye', 0, 0, 'Arabic_Yemen'),
(20, 'Arabic', 'ar', 'ar', 0, 0, 'Arabic'),
(21, 'Armenian', 'hy', 'hy', 0, 0, 'Armenian'),
(22, 'Assamese', 'as', 'as', 0, 0, 'Assamese'),
(23, 'Azeri', 'az', 'az', 0, 0, 'Azeri'),
(24, 'Basque', 'eu', 'eu', 0, 0, 'Basque'),
(25, 'Belarusian', 'be', 'be', 0, 0, 'Belarusian'),
(26, 'Bengali', 'bn', 'bn', 0, 0, 'Bengali'),
(27, 'Bulgarian', 'bg', 'bg', 0, 0, 'Bulgarian'),
(28, 'Catalan', 'ca', 'ca', 0, 0, 'Catalan'),
(29, 'Chinese (China)', 'zh', 'zh-cn', 0, 0, 'Chinese_China'),
(30, 'Chinese (Hong Kong SAR)', 'zh', 'zh-hk', 0, 0, 'Chinese_Hong_Kong'),
(31, 'Chinese (Macau SAR)', 'zh', 'zh-mo', 0, 0, 'Chinese_Macau'),
(32, 'Chinese (Singapore)', 'zh', 'zh-sg', 0, 0, 'Chinese_Singapore'),
(33, 'Chinese (Taiwan)', 'zh', 'zh-tw', 0, 0, 'Chinese_Taiwan'),
(34, 'Chinese', 'zh', 'zh', 0, 0, 'Chinese'),
(35, 'Croatian', 'hr', 'hr', 0, 0, 'Croatian'),
(36, 'Czech', 'cs', 'cs', 0, 0, 'Czech'),
(37, 'Danish', 'da', 'da', 0, 0, 'Danish'),
(38, 'Divehi', 'div', 'div', 0, 0, 'Divehi'),
(39, 'Dutch (Belgium)', 'nl', 'nl-be', 0, 0, 'Dutch_Belgium'),
(40, 'Dutch (Netherlands)', 'nl', 'nl', 0, 0, 'Dutch_Netherlands'),
(41, 'English (Australia)', 'en', 'en-au', 0, 0, 'English_Australia'),
(42, 'English (Belize)', 'en', 'en-bz', 0, 0, 'English_Belize'),
(43, 'English (Canada)', 'en', 'en-ca', 0, 0, 'English_Canada'),
(44, 'English (Ireland)', 'en', 'en-ie', 0, 0, 'English_Ireland'),
(45, 'English (Jamaica)', 'en', 'en-jm', 0, 0, 'English_Jamaica'),
(46, 'English (New Zealand)', 'en', 'en-nz', 0, 0, 'English_New_Zealand'),
(47, 'English (Philippines)', 'en', 'en-ph', 0, 0, 'English_Philippines'),
(48, 'English (South Africa)', 'en', 'en-za', 0, 0, 'English_South_Africa'),
(49, 'English (Trinidad)', 'en', 'en-tt', 0, 0, 'English_Trinidad'),
(50, 'English (United Kingdom)', 'en', 'en-gb', 0, 0, 'English_United_Kingdom'),
(51, 'English (United States)', 'en', 'en-us', 0, 0, 'English_Zimbabwe'),
(52, 'English (Zimbabwe)', 'en', 'en-zw', 0, 0, 'English_United_states'),
(53, 'english', 'en', 'en', 1, 1, 'english'),
(54, 'English (United States)', 'us', 'us', 0, 0, 'English_United_States_general'),
(55, 'Estonian', 'et', 'et', 0, 0, 'Estonian'),
(56, 'Faeroese', 'fo', 'fo', 0, 0, 'Faeroese'),
(57, 'Farsi', 'fa', 'fa', 0, 0, 'Farsi'),
(58, 'Finnish', 'fi', 'fi', 0, 0, 'Finnish'),
(59, 'French (Belgium)', 'fr', 'fr-be', 0, 0, 'French_Belgium'),
(60, 'French (Canada)', 'fr', 'fr-ca', 0, 0, 'French_Canada'),
(61, 'French (Luxembourg)', 'fr', 'fr-lu', 0, 0, 'French_Luxembourg'),
(62, 'French (Monaco)', 'fr', 'fr-mc', 0, 0, 'French_Monaco'),
(63, 'French (Switzerland)', 'fr', 'fr-ch', 0, 0, 'French_Switzerland'),
(64, 'French (France)', 'fr', 'fr', 0, 0, 'French'),
(65, 'FYRO Macedonian', 'mk', 'mk', 0, 0, 'FYRO_Macedonian'),
(66, 'Gaelic', 'gd', 'gd', 0, 0, 'Gaelic'),
(67, 'Georgian', 'ka', 'ka', 0, 0, 'Georgian'),
(68, 'German (Austria)', 'de', 'de-at', 0, 0, 'German_Austria'),
(69, 'German (Liechtenstein)', 'de', 'de-li', 0, 0, 'German_Liechtenstein'),
(70, 'German (Luxembourg)', 'de', 'de-lu', 0, 0, 'German_Luxembourg'),
(71, 'German (Switzerland)', 'de', 'de-ch', 0, 0, 'German_Switzerland'),
(72, 'German (Germany)', 'de', 'de', 0, 0, 'German'),
(73, 'Greek', 'el', 'el', 0, 0, 'Greek'),
(74, 'Gujarati', 'gu', 'gu', 0, 0, 'Gujarati'),
(75, 'Hebrew', 'he', 'he', 0, 0, 'Hebrew'),
(76, 'Hindi', 'hi', 'hi', 0, 0, 'Hindi'),
(77, 'Hungarian', 'hu', 'hu', 0, 0, 'Hungarian'),
(78, 'Icelandic', 'is', 'is', 0, 0, 'Icelandic'),
(79, 'Indonesian', 'id', 'id', 0, 0, 'Indonesian'),
(80, 'Italian (Switzerland)', 'it', 'it-ch', 0, 0, 'Italian_Switzerland'),
(81, 'Italian (Italy)', 'it', 'it', 0, 0, 'Italian'),
(82, 'Japanese', 'ja', 'ja', 0, 0, 'Japanese'),
(83, 'Kannada', 'kn', 'kn', 0, 0, 'Kannada'),
(84, 'Kazakh', 'kk', 'kk', 0, 0, 'Kazakh'),
(85, 'Konkani', 'kok', 'kok', 0, 0, 'Konkani'),
(86, 'Korean', 'ko', 'ko', 0, 0, 'Korean'),
(87, 'Kyrgyz', 'kz', 'kz', 0, 0, 'Kyrgyz'),
(88, 'Latvian', 'lv', 'lv', 0, 0, 'Latvian'),
(89, 'Lithuanian', 'lt', 'lt', 0, 0, 'Lithuanian'),
(90, 'Malay', 'ms', 'ms', 0, 0, 'Malay'),
(91, 'Malayalam', 'ml', 'ml', 0, 0, 'Malayalam'),
(92, 'Maltese', 'mt', 'mt', 0, 0, 'Maltese'),
(93, 'Marathi', 'mr', 'mr', 0, 0, 'Marathi'),
(94, 'Mongolian (Cyrillic)', 'mn', 'mn', 0, 0, 'Mongolian_Cyrillic'),
(95, 'Nepali (India)', 'ne', 'ne', 0, 0, 'Nepali_India'),
(96, 'Norwegian (Bokmal)', 'nb', 'nb-no', 0, 0, 'Norwegian_Bokmal'),
(97, 'Norwegian (Nynorsk)', 'nn', 'nn-no', 0, 0, 'Norwegian_Nynorsk'),
(98, 'Norwegian (Bokmal)', 'no', 'no', 0, 0, 'Norwegian_Bokmal'),
(99, 'Oriya', 'or', 'or', 0, 0, 'Oriya'),
(100, 'Polish', 'pl', 'pl', 0, 0, 'Polish'),
(101, 'Portuguese (Brazil)', 'pt', 'pt-br', 0, 0, 'Portuguese_Brazil'),
(102, 'Portuguese (Portugal)', 'pt', 'pt', 0, 0, 'Portuguese'),
(103, 'Punjabi', 'pa', 'pa', 0, 0, 'Punjabi'),
(104, 'Rhaeto-Romanic', 'rm', 'rm', 0, 0, 'Rhaeto-Romanic'),
(105, 'Romanian (Moldova)', 'ro', 'ro-md', 0, 0, 'Romanian_Moldova'),
(106, 'Romanian', 'ro', 'ro', 0, 0, 'Romanian'),
(107, 'Russian (Moldova)', 'ru', 'ru-md', 0, 0, 'Russian_Moldova'),
(108, 'Russian', 'ru', 'ru', 0, 0, 'Russian'),
(109, 'Sanskrit', 'sa', 'sa', 0, 0, 'Sanskrit'),
(110, 'Serbian', 'sr', 'sr', 0, 0, 'Serbian'),
(111, 'Slovak', 'sk', 'sk', 0, 0, 'Slovak'),
(112, 'Slovenian', 'ls', 'ls', 0, 0, 'Slovenian'),
(113, 'Sorbian', 'sb', 'sb', 0, 0, 'Sorbian'),
(114, 'Spanish (Argentina)', 'es', 'es-ar', 0, 0, 'Spanish_Argentina'),
(115, 'Spanish (Bolivia)', 'es', 'es-bo', 0, 0, 'Spanish_Bolivia'),
(116, 'Spanish (Chile)', 'es', 'es-cl', 0, 0, 'Spanish_Chile'),
(117, 'Spanish (Colombia)', 'es', 'es-co', 0, 0, 'Spanish_Colombia'),
(118, 'Spanish (Costa Rica)', 'es', 'es-cr', 0, 0, 'Spanish_Costa_Rica'),
(119, 'Spanish (Dominican Republic)', 'es', 'es-do', 0, 0, 'Spanish_Dominican_Republic'),
(120, 'Spanish (Ecuador)', 'es', 'es-ec', 0, 0, 'Spanish_Ecuador'),
(121, 'Spanish (El Salvador)', 'es', 'es-sv', 0, 0, 'Spanish_El_Salvador'),
(122, 'Spanish (Guatemala)', 'es', 'es-gt', 0, 0, 'Spanish_Guatemala'),
(123, 'Spanish (Honduras)', 'es', 'es-hn', 0, 0, 'Spanish_Honduras'),
(124, 'Spanish (Mexico)', 'es', 'es-mx', 0, 0, 'Spanish_Mexico'),
(125, 'Spanish (Nicaragua)', 'es', 'es-ni', 0, 0, 'Spanish_Nicaragua'),
(126, 'Spanish (Panama)', 'es', 'es-pa', 0, 0, 'Spanish_Panama'),
(127, 'Spanish (Paraguay)', 'es', 'es-py', 0, 0, 'Spanish_Paraguay'),
(128, 'Spanish (Peru)', 'es', 'es-pe', 0, 0, 'Spanish_Peru'),
(129, 'Spanish (Puerto Rico)', 'es', 'es-pr', 0, 0, 'Spanish_Puerto_Rico'),
(130, 'Spanish (United States)', 'es', 'es-us', 0, 0, 'Spanish_United_States'),
(131, 'Spanish (Uruguay)', 'es', 'es-uy', 0, 0, 'Spanish_Uruguay'),
(132, 'Spanish (Venezuela)', 'es', 'es-ve', 0, 0, 'Spanish_Venezuela'),
(134, 'Sutu', 'sx', 'sx', 0, 0, 'Sutu'),
(135, 'Swahili', 'sw', 'sw', 0, 0, 'Swahili'),
(136, 'Swedish (Finland)', 'sv', 'sv-fi', 0, 0, 'Swedish_Finland'),
(137, 'Swedish', 'sv', 'sv', 0, 0, 'Swedish'),
(138, 'Syriac', 'syr', 'syr', 0, 0, 'Syriac'),
(139, 'Tamil', 'ta', 'ta', 0, 0, 'Tamil'),
(140, 'Tatar', 'tt', 'tt', 0, 0, 'Tatar'),
(141, 'Telugu', 'te', 'te', 0, 0, 'Telugu'),
(142, 'Thai', 'th', 'th', 0, 0, 'Thai'),
(143, 'Tsonga', 'ts', 'ts', 0, 0, 'Tsonga'),
(144, 'Tswana', 'tn', 'tn', 0, 0, 'Tswana'),
(145, 'Turkish', 'tr', 'tr', 0, 0, 'Turkish'),
(146, 'Ukrainian', 'uk', 'uk', 0, 0, 'Ukrainian'),
(147, 'Urdu', 'ur', 'ur', 0, 0, 'Urdu'),
(148, 'Uzbek', 'uz', 'uz', 0, 0, 'Uzbek'),
(149, 'Vietnamese', 'vi', 'vi', 0, 0, 'Vietnamese'),
(150, 'Xhosa', 'xh', 'xh', 0, 0, 'Xhosa'),
(151, 'Yiddish', 'yi', 'yi', 0, 0, 'Yiddish'),
(152, 'Zulu', 'zu', 'zu', 0, 0, 'Zulu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_carrusel`
--

DROP TABLE IF EXISTS `imagen_carrusel`;
CREATE TABLE `imagen_carrusel` (
  `id_imagen_carrusel` int(10) UNSIGNED NOT NULL,
  `prioridad` int(2) UNSIGNED NOT NULL,
  `id_carrusel` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imagen_carrusel`
--

INSERT INTO `imagen_carrusel` (`id_imagen_carrusel`, `prioridad`, `id_carrusel`, `id_categoria`) VALUES
(1, 2, 1, 0),
(2, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_carrusel_idiomas`
--

DROP TABLE IF EXISTS `imagen_carrusel_idiomas`;
CREATE TABLE `imagen_carrusel_idiomas` (
  `id_imagen_carrusel_idiomas` int(10) UNSIGNED NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `imagen_mini` varchar(220) NOT NULL,
  `texto_carrusel` text,
  `titulo_carrusel` text,
  `titulo_seo` text NOT NULL,
  `id_idioma` int(11) UNSIGNED NOT NULL,
  `id_imagen_carrusel` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imagen_carrusel_idiomas`
--

INSERT INTO `imagen_carrusel_idiomas` (`id_imagen_carrusel_idiomas`, `imagen`, `imagen_mini`, `texto_carrusel`, `titulo_carrusel`, `titulo_seo`, `id_idioma`, `id_imagen_carrusel`) VALUES
(1, 'luxury_house_interior-wallpaper.jpg', 'luxury_house_interior-wallpaper_thumb.jpg', '', '', 'slider1', 1, 1),
(2, 'luxury_house_interior-wallpaper.jpg', 'luxury_house_interior-wallpaper_thumb.jpg', '', '', 'slider', 53, 1),
(3, 'vacation_house_interior-wallpaper.jpg', 'vacation_house_interior-wallpaper_thumb.jpg', '', '', 'slider2', 1, 2),
(4, 'vacation_house_interior-wallpaper.jpg', 'vacation_house_interior-wallpaper_thumb.jpg', '', '', 'slider2', 53, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles`
--

DROP TABLE IF EXISTS `inmuebles`;
CREATE TABLE `inmuebles` (
  `id` int(11) UNSIGNED NOT NULL,
  `referencia` varchar(40) NOT NULL,
  `metros` int(4) NOT NULL,
  `metros_utiles` int(4) NOT NULL,
  `habitaciones` int(2) NOT NULL DEFAULT '0',
  `banios` int(2) NOT NULL DEFAULT '0',
  `precio_compra` int(10) UNSIGNED NOT NULL,
  `precio_compra_anterior` int(10) UNSIGNED NOT NULL,
  `precio_alquiler` int(7) UNSIGNED NOT NULL,
  `precio_alquiler_anterior` int(10) UNSIGNED NOT NULL,
  `poblacion_id` int(11) UNSIGNED NOT NULL,
  `zona_id` int(11) UNSIGNED DEFAULT NULL,
  `tipo_id` int(11) UNSIGNED NOT NULL,
  `observaciones` text,
  `direccion` varchar(100) NOT NULL,
  `direccion_publica` varchar(100) NOT NULL,
  `publicado` tinyint(1) NOT NULL DEFAULT '0',
  `estado_id` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `certificacion_energetica_id` int(11) UNSIGNED NOT NULL DEFAULT '8',
  `kwh_m2_anio` int(5) NOT NULL,
  `captador_id` int(11) UNSIGNED DEFAULT NULL,
  `fecha_alta` date NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `anio_construccion` int(4) DEFAULT NULL,
  `oportunidad` tinyint(1) NOT NULL DEFAULT '0',
  `destacado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inmuebles`
--

INSERT INTO `inmuebles` (`id`, `referencia`, `metros`, `metros_utiles`, `habitaciones`, `banios`, `precio_compra`, `precio_compra_anterior`, `precio_alquiler`, `precio_alquiler_anterior`, `poblacion_id`, `zona_id`, `tipo_id`, `observaciones`, `direccion`, `direccion_publica`, `publicado`, `estado_id`, `certificacion_energetica_id`, `kwh_m2_anio`, `captador_id`, `fecha_alta`, `fecha_actualizacion`, `anio_construccion`, `oportunidad`, `destacado`) VALUES
(1, 'REF0001', 50, 50, 2, 1, 200000, 0, 0, 0, 292, NULL, 1, '', 'calle granada', '', 0, 4, 8, 0, 2, '2017-07-01', NULL, 0, 0, 0),
(2, 'REF0002', 70, 70, 3, 2, 300000, 0, 0, 0, 292, NULL, 1, '', 'carretera granada', 'centro comercial mediterraneo', 0, 1, 8, 0, 2, '2017-06-02', NULL, 0, 0, 0),
(3, 'REF0003', 100, 100, 4, 3, 400000, 0, 0, 0, 292, NULL, 1, NULL, 'avenida del mediterraneo', '', 0, 1, 8, 0, 2, '2017-06-03', NULL, 0, 0, 0),
(4, 'REF0004', 90, 84, 2, 1, 50000, 0, 0, 0, 1780, 6, 9, '', 'Calle Benjumeda', 'mercado', 1, 3, 9, 0, 4, '2017-06-05', '2017-09-12 14:34:26', 2009, 1, 0),
(5, 'REF0005', 300, 220, 4, 3, 285000, 300000, 1000, 1525, 292, 3, 12, 'Esta es una oficina en el centro', 'Calle Obispo Orberá, 4', 'Calle Obispo Orberá', 1, 1, 5, 84, 2, '2017-06-09', '2017-09-12 14:12:22', 2010, 0, 1),
(6, 'REF0006', 60, 50, 1, 1, 125000, 150000, 0, 0, 1780, 23, 2, 'jur jur', 'Avenida marconi, 10', 'mercadona', 1, 1, 9, 0, 2, '2017-06-12', '2017-08-28 14:14:44', 1995, 0, 1),
(7, 'REF0010', 60, 50, 1, 1, 40000, 0, 0, 0, 1780, 6, 9, 'Correcto', 'Calle Rosa', 'mercado', 1, 1, 4, 100, 4, '2017-06-15', '2017-08-25 20:37:47', 1990, 0, 0),
(10, '5944ea26a1ab8', 160, 110, 2, 2, 0, 0, 600, 0, 1799, NULL, 2, '', 'Calle real, 1', 'Calle real', 1, 1, 9, 0, 2, '2016-06-17', '2017-08-28 14:09:22', 0, 1, 0),
(15, 'DEM0200', 100, 90, 3, 2, 450000, 0, 0, 0, 1780, NULL, 9, '', 'Calle Doctor Flemming, 11', '', 0, 2, 3, 0, 4, '2017-06-26', NULL, 2009, 0, 0),
(16, '59515d52a7091', 400, 350, 4, 1, 135000, 140000, 500, 0, 292, 3, 4, 'Esta es una oficina en el centro', 'Calle Obispo Orberá,1, bajo', 'mercado', 1, 1, 8, 0, 2, '2017-06-26', '2017-08-31 19:59:03', 1982, 0, 0),
(17, '59515d6d021ea', 400, 350, 4, 2, 135000, 0, 0, 0, 292, 9, 4, 'Esta es una oficina en el centro', 'Calle Obispo Orberá,1, bajo', 'Calle Obispo Orberá', 1, 2, 8, 0, 2, '2017-06-26', '2017-09-13 10:37:33', 1982, 1, 0),
(19, 'REF0019', 60, 50, 1, 1, 100000, 90000, 0, 0, 1780, 6, 9, 'Correcto', 'avenida amilcar barca, 2', 'avenida amilcar barca, 2', 1, 1, 4, 19, 2, '2017-08-15', '2017-09-01 17:33:48', 1990, 0, 0),
(23, '595f8dec1f807', 60, 50, 1, 1, 100000, 90000, 0, 0, 1780, 6, 9, 'Correcto', 'Calle Chile, 2', 'torre tavira', 1, 1, 4, 500, 4, '2017-07-07', '2017-09-13 10:39:40', 1990, 1, 1),
(26, '595225d56466d', 60, 50, 1, 1, 40000, 0, 0, 0, 1780, 6, 9, 'Correcto', 'Calle Rosa', 'calle Rosa', 1, 1, 4, 10, 4, '2017-06-27', '2017-09-13 10:38:18', 1990, 1, 0),
(29, 'REF0012', 80, 70, 2, 1, 150000, 0, 0, 0, 1780, 21, 1, '', 'Calle García de Sola, 1', 'Calle García de Sola', 1, 1, 8, 0, 2, '2017-08-17', '2017-09-13 10:45:54', 1950, 0, 1),
(30, 'REF0011', 120, 105, 4, 2, 360000, 0, 0, 0, 1780, NULL, 1, '', 'Pablo Ruiz Picasso, 4, 4 J', 'Hospital', 1, 1, 2, 200, 2, '2017-08-17', '2017-09-13 10:31:53', 1981, 1, 1),
(31, 'HUERCAL-0001', 500, 210, 4, 2, 600000, 0, 0, 0, 329, NULL, 12, '', 'C/Tortola, 7', 'sercodi', 1, 1, 9, 0, 6, '2017-08-22', '2017-09-13 10:40:27', 1981, 0, 1),
(32, '599d8c6668ff8', 400, 350, 4, 1, 135000, 140000, 500, 525, 292, 3, 4, 'Esta es una oficina en el centro', 'Calle Obispo Orberá, 5', 'Calle Obispo Orberá', 0, 1, 8, 0, 2, '2017-08-23', '2017-08-30 15:00:59', 1982, 1, 1),
(33, 'REF0015', 75, 70, 2, 1, 250000, 0, 0, 0, 1780, 18, 11, '', 'Calle costa rica, 1', '', 0, 1, 9, 0, 2, '2017-08-29', NULL, 1970, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles_carteles`
--

DROP TABLE IF EXISTS `inmuebles_carteles`;
CREATE TABLE `inmuebles_carteles` (
  `id` int(11) UNSIGNED NOT NULL,
  `plantilla_id` int(11) UNSIGNED NOT NULL,
  `agente_id` int(11) UNSIGNED NOT NULL,
  `html` text NOT NULL,
  `fecha` date NOT NULL,
  `inmueble_id` int(11) UNSIGNED DEFAULT NULL,
  `idioma_id` int(11) UNSIGNED DEFAULT NULL,
  `impreso` tinyint(1) NOT NULL DEFAULT '0',
  `hash_qr_image` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inmuebles_carteles`
--

INSERT INTO `inmuebles_carteles` (`id`, `plantilla_id`, `agente_id`, `html`, `fecha`, `inmueble_id`, `idioma_id`, `impreso`, `hash_qr_image`) VALUES
(21, 6, 2, '<p>\r\n	<span style=\"float: left;\"><img height=\"80\" src=\"%base_url%uploads/inmuebles/16/59943fef5b6a4.png\" width=\"80\" /></span><img alt=\"\" src=\"%base_url%uploads/logo.jpg\" style=\"width: 200px; height: 60px; float: right;\" /></p>\r\n<p style=\"text-align: center;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: center;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: center;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: center;\">\r\n	<strong><span style=\"font-size:20px;\"><span style=\"font-family: lucida sans unicode,lucida grande,sans-serif;\">Oficina en obispo orber&aacute;</span></span></strong></p>\r\n<div>\r\n	<p style=\"text-align: center;\">\r\n		<span style=\"font-size:16px;\">4 habitaciones, 1 ba&ntilde;os, 135.000 &euro;</span></p>\r\n	<p style=\"text-align: center;\">\r\n		<img height=\"449.42084942085\" src=\"%base_url%uploads/inmuebles/16/imagenes/1_entrada.jpg\" width=\"600\" /></p>\r\n	<p style=\"text-align: justify;\">\r\n		&nbsp;</p>\r\n	<p>\r\n		Oficina en obispo orber&aacute;, y algunos detalles m&aacute;s interesantes.</p>\r\n	<p>\r\n		&nbsp;</p>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', '2017-08-16', 16, 1, 1, '59943fef5b6a4'),
(24, 6, 6, '<p>\r\n	<span style=\"float: left;\"><img width=\"80\" height=\"80\" src=\"%base_url%uploads/inmuebles/31/599c1c50a2743.png\" /></span><img alt=\"\" src=\"%base_url%uploads/logo.jpg\" style=\"width: 200px; height: 60px; float: right;\" /></p>\r\n<p style=\"text-align: center;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: center;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: center;\">\r\n	<strong><span style=\"font-size:20px;\"><span style=\"font-family: lucida sans unicode,lucida grande,sans-serif;\">PRECIOSO CHALET CON PISCINA EN HUERCAL DE ALMERIA</span></span></strong></p>\r\n<div>\r\n	<p style=\"text-align: center;\">\r\n		<span style=\"font-size:16px;\">4 habitaciones, 2 ba&ntilde;os, 600.000 &euro;</span></p>\r\n	<p style=\"text-align: center;\">\r\n		<img width=\"600\" height=\"400.3125\" src=\"%base_url%uploads/inmuebles/31/imagenes/CASA-PISCINA.jpg\" /></p>\r\n	<p style=\"text-align: justify;\">\r\n		<span style=\"font-size:16px;\"><p>\r\n	CHALET CON 4 DORMITORIOS, 2 BA&Ntilde;OS, SALON CON CHIMENEA, COCINA, LAVADERO, DESPENSA Y COCHERA PARA 2 COCHES. AMPLIO EXTERIOR CON JARDIN DELANTERO, PORCHE Y PISCINA CON CESPED EN LA PARTE DE ATRAS DE LA VIVIENDA.</p>\r\n</span></p>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', '2017-08-22', 31, 1, 0, '599c1c50a2743'),
(25, 6, 2, '<p>\r\n	<span style=\"float: left;\"><img width=\"80\" height=\"80\" src=\"%base_url%uploads/inmuebles/19/599d865d4004f.png\" /></span><img alt=\"\" src=\"%base_url%uploads/logo.jpg\" style=\"width: 200px; height: 60px; float: right;\" /></p>\r\n<p style=\"text-align: center;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: center;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: center;\">\r\n	<strong><span style=\"font-size:20px;\"><span style=\"font-family: lucida sans unicode,lucida grande,sans-serif;\">VENTA DE UNIFAMILIAR EN ZONA PLAYA</span></span></strong></p>\r\n<div>\r\n	<p style=\"text-align: center;\">\r\n		<span style=\"font-size:16px;\">1 habitaciones, 1 ba&ntilde;os, 100.000 &euro;</span></p>\r\n	<p style=\"text-align: center;\">\r\n		<img width=\"600\" height=\"450\" src=\"%base_url%uploads/inmuebles/19/imagenes/12.JPG\" /></p>\r\n	<p style=\"text-align: justify;\">\r\n		<span style=\"font-size:16px;\"><p>\r\n	dos dormitorios, dos ba&ntilde;os, frontal al mar</p>\r\n</span></p>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', '2017-08-23', 19, 1, 0, '599d865d4004f'),
(26, 6, 2, '<p>\r\n	<span style=\"float: left;\"><img width=\"80\" height=\"80\" src=\"%base_url%uploads/inmuebles/30/59a2ad52e6e93.png\" /></span><img alt=\"\" src=\"%base_url%uploads/logo.jpg\" style=\"width: 200px; height: 60px; float: right;\" /></p>\r\n<p style=\"text-align: center;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: center;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: center;\">\r\n	<strong><span style=\"font-size:20px;\"><span style=\"font-family: lucida sans unicode,lucida grande,sans-serif;\">piso gran oportunidad frente al hospital</span></span></strong></p>\r\n<div>\r\n	<p style=\"text-align: center;\">\r\n		<span style=\"font-size:16px;\">4 habitaciones, 2 ba&ntilde;os, 360.000 &euro;</span></p>\r\n	<p style=\"text-align: center;\">\r\n		<img width=\"600\" height=\"460.95238095238\" src=\"%base_url%uploads/inmuebles/30/imagenes/d0791ccb15180cd7d93555536d3c4ed1.jpg\" /></p>\r\n	<p style=\"text-align: justify;\">\r\n		<span style=\"font-size:16px;\"><p>\r\n	<strong>Piso gran oportunidad frente al hospital</strong>, 4 dormitorios, 2 cuartos de ba&ntilde;o, totalmente reformado, y con garaje.</p>\r\n</span></p>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', '2017-08-27', 30, 1, 0, '59a2ad52e6e93'),
(30, 6, 2, '<p>\r\n	<span style=\"float: left;\"><img width=\"80\" height=\"80\" src=\"%base_url%uploads/inmuebles/5/59b01538d0f36.png\" /></span><img alt=\"\" src=\"http://openrs.es/demo/uploads/general/img/preferencias/logo-openrs-new.jpg\" style=\"width: 200px; height: 60px; float: right;\" /></p>\r\n<p style=\"text-align: center;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: center;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: center;\">\r\n	<strong><span style=\"font-size:20px;\"><span style=\"font-family: lucida sans unicode,lucida grande,sans-serif;\">CHALET EN PLENO CENTRO DE ALMERIA</span></span></strong></p>\r\n<div>\r\n	<p style=\"text-align: center;\">\r\n		<span style=\"font-size:16px;\">4 habitaciones, 3 ba&ntilde;os, 285.000 &euro;</span></p>\r\n	<p style=\"text-align: center;\">\r\n		<img width=\"600\" height=\"400\" src=\"%base_url%uploads/inmuebles/5/imagenes/002-armadale-house-mitsuori-architects-1050x700.jpg\" /></p>\r\n	<p style=\"text-align: justify;\">\r\n		<span style=\"font-size:16px;\"><p>\r\n	Este <strong>amplio &aacute;tico</strong> nos recibe con un amplio sal&oacute;n comedor, una espaciosa cocina, y una amplia terraza con orientaci&oacute;n sur y oeste, desde esta terraza se tienen vistas al mar Mediterr&aacute;neo. La cocina es amplia, con un dise&ntilde;o abierto hacia el sal&oacute;n, y el &aacute;rea de comedor tiene grandes ventanas y acceso a la terraza. Las habitaciones est&aacute;n en un &aacute;rea independiente, ambas con orientaci&oacute;n al sur, y con posibilidad de incluir accesos directos a la terraza desde las habitaciones. Este &aacute;rea independiente la completa un ba&ntilde;o y un espacio de lavado.<br />\r\n	<br />\r\n	El &aacute;tico tiene una terraza-solarium privada de 43 metros cuadrados, con vistas al sur y al oeste. En esta terraza se disfrutan de espectaculares vistas al mar Mediterr&aacute;neo y a las monta&ntilde;as al norte de Torrox.<br />\r\n	<br />\r\n	La ubicaci&oacute;n permite disfrutar de las playas de Torrox Costa,que se encuentran a tan s&oacute;lo 50m., con la tranquilidad de estar en la zona de El Pe&ntilde;oncillo, y a solo 5 minutos de bancos, supermercados y todos los servicios necesarios.</p>\r\n</span></p>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', '2017-09-06', 5, 1, 0, '59b01538d0f36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles_demandas`
--

DROP TABLE IF EXISTS `inmuebles_demandas`;
CREATE TABLE `inmuebles_demandas` (
  `id` int(11) UNSIGNED NOT NULL,
  `inmueble_id` int(11) UNSIGNED NOT NULL,
  `demanda_id` int(11) UNSIGNED NOT NULL,
  `origen_id` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1 para automáticos, aquellos asignados a través de un filtro de búsqueda, 2 para los propuestos por el agente',
  `evaluacion_id` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1 para pendientes de evaluar, estas se eliminarán si hay una nueva búsqueda, 2 para aquellas que propuesta para visita y 3 para las descartadas por el agente, 4 para aquellas que interesan y 5 para las que no',
  `observaciones` varchar(255) NOT NULL,
  `fecha_asignacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inmuebles_demandas`
--

INSERT INTO `inmuebles_demandas` (`id`, `inmueble_id`, `demanda_id`, `origen_id`, `evaluacion_id`, `observaciones`, `fecha_asignacion`) VALUES
(1, 5, 3, 2, 1, 'Observaciones', '2017-06-22'),
(15, 1, 3, 2, 2, '', '2017-06-24'),
(16, 7, 13, 2, 2, '', '2017-06-26'),
(20, 7, 1, 2, 2, '', '2017-07-07'),
(26, 23, 1, 1, 3, '', '2017-07-07'),
(27, 19, 1, 1, 1, '', '2017-07-31'),
(28, 5, 1, 2, 2, '', '2017-08-01'),
(31, 5, 8, 1, 1, '', '2017-08-30'),
(32, 16, 8, 1, 1, '', '2017-08-30'),
(33, 19, 8, 1, 1, '', '2017-08-30'),
(34, 23, 8, 1, 1, '', '2017-08-30'),
(35, 32, 8, 1, 1, '', '2017-08-30'),
(36, 7, 12, 1, 1, '', '2017-08-30'),
(37, 19, 12, 1, 1, '', '2017-08-30'),
(38, 23, 12, 1, 1, '', '2017-08-30'),
(39, 26, 12, 1, 1, '', '2017-08-30'),
(40, 4, 12, 1, 1, '', '2017-09-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles_enlaces`
--

DROP TABLE IF EXISTS `inmuebles_enlaces`;
CREATE TABLE `inmuebles_enlaces` (
  `id` int(11) UNSIGNED NOT NULL,
  `inmueble_id` int(11) UNSIGNED NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `url` varchar(255) NOT NULL,
  `publicado` tinyint(1) NOT NULL DEFAULT '1',
  `youtube` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inmuebles_enlaces`
--

INSERT INTO `inmuebles_enlaces` (`id`, `inmueble_id`, `titulo`, `url`, `publicado`, `youtube`) VALUES
(4, 5, 'Video youtube publicado', 'https://www.youtube.com/watch?v=hnkQNAhSZiU', 1, 1),
(5, 5, 'Video youtube NO publicado', 'https://www.youtube.com/watch?v=68ugkg9RePc&list=PL322DAB88F9A8DCC6&index=122', 0, 1),
(6, 5, 'Ver inmueble en Idealista', 'https://www.idealista.com/inmueble/36315178/', 1, 0),
(7, 5, 'Ver inmueble en Fotocasa', 'https://www.fotocasa.es/vivienda/almeria-capital/almeria-ciudad-aire-acondicionado-calefaccion-ascensor-no-amueblado-san-luis-134428213', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles_fichas`
--

DROP TABLE IF EXISTS `inmuebles_fichas`;
CREATE TABLE `inmuebles_fichas` (
  `id` int(11) UNSIGNED NOT NULL,
  `plantilla_id` int(11) UNSIGNED NOT NULL,
  `agente_id` int(11) UNSIGNED NOT NULL,
  `html` text NOT NULL,
  `fecha` date NOT NULL,
  `inmueble_id` int(11) UNSIGNED DEFAULT NULL,
  `idioma_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inmuebles_fichas`
--

INSERT INTO `inmuebles_fichas` (`id`, `plantilla_id`, `agente_id`, `html`, `fecha`, `inmueble_id`, `idioma_id`) VALUES
(2, 7, 2, '<p>\n	<small class=\"col-sm-4\"><strong>Datos General:</strong> </small></p>\n<ul>\n	<li>\n		<small class=\"col-sm-4\">01/07/2017: Fecha actual en formato num&eacute;rico</small></li>\n	<li>\n		<small class=\"col-sm-4\">1 de julio del 2017: Fecha actual en formato texto</small></li>\n</ul>\n<div>\n	<small class=\"col-sm-4\"><small class=\"col-sm-4\"><strong>Datos Inmuebles:</strong> </small></small>\n	<ul>\n		<li>\n			<small class=\"col-sm-4\">REF0005: Referencia del inmueble</small></li>\n		<li>\n			<small class=\"col-sm-4\">09/06/2017: Fecha de alta del inmueble</small></li>\n		<li>\n			<small class=\"col-sm-4\">Oficina: Tipo del inmueble</small></li>\n		<li>\n			<small class=\"col-sm-4\">Almería: Nombre de la provincia</small></li>\n		<li>\n			<small class=\"col-sm-4\">Almería: Nombre del municipio</small></li>\n		<li>\n			<small class=\"col-sm-4\">Centro: Nombre de la zona del municipio</small></li>\n		<li>\n			<small class=\"col-sm-4\">Calle Obispo Orberá, 5: Direcci&oacute;n real del inmueble</small></li>\n		<li>\n			<small class=\"col-sm-4\">400: Metros totales</small></li>\n		<li>\n			<small class=\"col-sm-4\">350: Metros &uacute;tiles</small></li>\n		<li>\n			<small class=\"col-sm-4\">4: N&uacute;mero de habitaciones</small></li>\n		<li>\n			<small class=\"col-sm-4\">1: N&uacute;mero de ba&ntilde;os</small></li>\n		<li>\n			<small class=\"col-sm-4\">135.000: Precio de compra</small></li>\n		<li>\n			<small class=\"col-sm-4\">140.000: Precio de compra anterior</small></li>\n		<li>\n			<small class=\"col-sm-4\">500: Precio alquiler</small></li>\n		<li>\n			<small class=\"col-sm-4\">525: Precio alquiler anterior</small></li>\n		<li>\n			<small class=\"col-sm-4\">Exento: Certificaci&oacute;n energ&eacute;tica</small></li>\n		<li>\n			<small class=\"col-sm-4\">Calle Obispo Orberá: Direcci&oacute;n mostrada en la zona p&uacute;blica</small></li>\n		<li>\n			<small class=\"col-sm-4\">Oficina en pleno centro de Almería: T&iacute;tulo mostrado en la zona p&uacute;blica</small></li>\n		<li>\n			<small class=\"col-sm-4\"><p>\n	Este <strong>amplio &aacute;tico</strong> nos recibe con un amplio sal&oacute;n comedor, una espaciosa cocina, y una amplia terraza con orientaci&oacute;n sur y oeste, desde esta terraza se tienen vistas al mar Mediterr&aacute;neo. La cocina es amplia, con un dise&ntilde;o abierto hacia el sal&oacute;n, y el &aacute;rea de comedor tiene grandes ventanas y acceso a la terraza. Las habitaciones est&aacute;n en un &aacute;rea independiente, ambas con orientaci&oacute;n al sur, y con posibilidad de incluir accesos directos a la terraza desde las habitaciones. Este &aacute;rea independiente la completa un ba&ntilde;o y un espacio de lavado.<br />\n	<br />\n	El &aacute;tico tiene una terraza-solarium privada de 43 metros cuadrados, con vistas al sur y al oeste. En esta terraza se disfrutan de espectaculares vistas al mar Mediterr&aacute;neo y a las monta&ntilde;as al norte de Torrox.<br />\n	<br />\n	La ubicaci&oacute;n permite disfrutar de las playas de Torrox Costa,que se encuentran a tan s&oacute;lo 50m., con la tranquilidad de estar en la zona de El Pe&ntilde;oncillo, y a solo 5 minutos de bancos, supermercados y todos los servicios necesarios.</p>\n: Descripci&oacute;n extendida mostrada en la zona p&uacute;blica</small></li>\n		<li>\n			<small class=\"col-sm-4\">oficina-en-pleno-centro-de-almeria: URL SEO</small></li>\n		<li>\n			<small class=\"col-sm-4\">Oficina en pleno centro de almería con varias dependencias: Descripci&oacute;n SEO</small></li>\n		<li>\n			<small class=\"col-sm-4\">oficina,centro,Álmería: Palabras clave para el SEO</small></li>\n		<li>\n			<small class=\"col-sm-4\">Captación: Estado</small></li>\n		<li>\n			<small class=\"col-sm-4\">Berasuain Ruiz, Ángel Luis : Nombre completo del captador</small></li>\n		<li>\n			<small class=\"col-sm-4\">Esta es una oficina en el centro: Observaciones</small></li>\n	</ul>\n	<div>\n		<small class=\"col-sm-4\"><img width=\"600\" height=\"400\" src=\"%base_url%uploads/inmuebles/5/imagenes/002-armadale-house-mitsuori-architects-1050x700.jpg\" /></small></div>\n	<div>\n		&nbsp;</div>\n</div>\n<div>\n	<small class=\"col-sm-4\"><strong>Datos Agentes Inmobiliarios:</strong> </small>\n	<ul>\n		<li>\n			<small class=\"col-sm-4\">Ángel Luis : Nombre del agente</small></li>\n		<li>\n			<small class=\"col-sm-4\">Berasuain Ruiz: Apellidos del agente</small></li>\n	</ul>\n</div>\n<div>\n	&nbsp;</div>\n', '2017-07-01', 5, 1),
(3, 7, 4, '<p>\r\n	<small class=\"col-sm-4\"><strong>Datos General:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">22/08/2017: Fecha actual en formato num&eacute;rico</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">22 de August del 2017: Fecha actual en formato texto</small></li>\r\n</ul>\r\n<div>\r\n	<small class=\"col-sm-4\"><small class=\"col-sm-4\"><strong>Datos Inmuebles:</strong> </small></small>\r\n	<ul>\r\n		<li>\r\n			<small class=\"col-sm-4\">5943f77c20f59: Referencia del inmueble</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">15/08/2017: Fecha de alta del inmueble</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">Duplex: Tipo del inmueble</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">Cádiz: Nombre de la provincia</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">Cádiz: Nombre del municipio</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">Ayuntamiento - Catedral: Nombre de la zona del municipio</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">Calle Chile, 2: Direcci&oacute;n real del inmueble</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">60: Metros totales</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">50: Metros &uacute;tiles</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">1: N&uacute;mero de habitaciones</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">1: N&uacute;mero de ba&ntilde;os</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">100.000: Precio de compra</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">90.000: Precio de compra anterior</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">0: Precio alquiler</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">0: Precio alquiler anterior</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">D: Certificaci&oacute;n energ&eacute;tica</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">: Direcci&oacute;n mostrada en la zona p&uacute;blica</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">: T&iacute;tulo mostrado en la zona p&uacute;blica</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">: Descripci&oacute;n extendida mostrada en la zona p&uacute;blica</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">: URL SEO</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">: Descripci&oacute;n SEO</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">: Palabras clave para el SEO</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">Captación: Estado</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">Berasuain Ruiz, Ángel Luis : Nombre completo del captador</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">Correcto: Observaciones</small></li>\r\n	</ul>\r\n	<div>\r\n		<small class=\"col-sm-4\"><img width=\"600\" height=\"450\" src=\"%base_url%uploads/inmuebles/19/imagenes/12.JPG\" /></small></div>\r\n	<div>\r\n		&nbsp;</div>\r\n</div>\r\n<div>\r\n	<small class=\"col-sm-4\"><strong>Datos Agentes Inmobiliarios:</strong> </small>\r\n	<ul>\r\n		<li>\r\n			<small class=\"col-sm-4\">María Eugenía: Nombre del agente</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">Berasuain Ruiz: Apellidos del agente</small></li>\r\n	</ul>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', '2017-08-22', 19, 1),
(4, 7, 6, '<p>\r\n	<small class=\"col-sm-4\"><strong>Datos General:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">22/08/2017: Fecha actual en formato num&eacute;rico</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">22 de August del 2017: Fecha actual en formato texto</small></li>\r\n</ul>\r\n<div>\r\n	<small class=\"col-sm-4\"><small class=\"col-sm-4\"><strong>Datos Inmuebles:</strong> </small></small>\r\n	<ul>\r\n		<li>\r\n			<small class=\"col-sm-4\">HUERCAL-0001: Referencia del inmueble</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">22/08/2017: Fecha de alta del inmueble</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">Chalet: Tipo del inmueble</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">Almería: Nombre de la provincia</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">Huércal de Almería: Nombre del municipio</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">: Nombre de la zona del municipio</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">C/Tortola, 7: Direcci&oacute;n real del inmueble</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">500: Metros totales</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">210: Metros &uacute;tiles</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">4: N&uacute;mero de habitaciones</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">2: N&uacute;mero de ba&ntilde;os</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">600.000: Precio de compra</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">0: Precio de compra anterior</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">0: Precio alquiler</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">0: Precio alquiler anterior</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">En trámite: Certificaci&oacute;n energ&eacute;tica</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">C/Tortola, 7: Direcci&oacute;n mostrada en la zona p&uacute;blica</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">PRECIOSO CHALET CON PISCINA EN HUERCAL DE ALMERIA: T&iacute;tulo mostrado en la zona p&uacute;blica</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\"><p>\r\n	CHALET CON 4 DORMITORIOS, 2 BA&Ntilde;OS, SALON CON CHIMENEA, COCINA, LAVADERO, DESPENSA Y COCHERA PARA 2 COCHES. AMPLIO EXTERIOR CON JARDIN DELANTERO, PORCHE Y PISCINA CON CESPED EN LA PARTE DE ATRAS DE LA VIVIENDA.</p>\r\n: Descripci&oacute;n extendida mostrada en la zona p&uacute;blica</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">precioso-chalet-con-piscina-en-huercal-de-almeria: URL SEO</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">CHALET CON 4 DORMITORIOS, GARAJE Y PISCINA: Descripci&oacute;n SEO</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">HUERCAL, CHALET, PISCINA: Palabras clave para el SEO</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">Captación: Estado</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">Cara Marqués, María de la Luz: Nombre completo del captador</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">: Observaciones</small></li>\r\n	</ul>\r\n	<div>\r\n		<small class=\"col-sm-4\"><img width=\"600\" height=\"400.3125\" src=\"%base_url%uploads/inmuebles/31/imagenes/CASA-PISCINA.jpg\" /></small></div>\r\n	<div>\r\n		&nbsp;</div>\r\n</div>\r\n<div>\r\n	<small class=\"col-sm-4\"><strong>Datos Agentes Inmobiliarios:</strong> </small>\r\n	<ul>\r\n		<li>\r\n			<small class=\"col-sm-4\">María de la Luz: Nombre del agente</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">Cara Marqués: Apellidos del agente</small></li>\r\n	</ul>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', '2017-08-22', 31, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles_ficheros`
--

DROP TABLE IF EXISTS `inmuebles_ficheros`;
CREATE TABLE `inmuebles_ficheros` (
  `id` int(11) UNSIGNED NOT NULL,
  `inmueble_id` int(11) UNSIGNED NOT NULL,
  `fichero` varchar(200) NOT NULL,
  `texto_fichero` text,
  `tipo_fichero_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inmuebles_ficheros`
--

INSERT INTO `inmuebles_ficheros` (`id`, `inmueble_id`, `fichero`, `texto_fichero`, `tipo_fichero_id`) VALUES
(1, 5, 'uploads/inmuebles/5/adjuntos/deb139b453c1945654a3b89fbf133e18.doc', 'Certificado', 3),
(2, 19, 'uploads/inmuebles/19/adjuntos/c7d075d6fdef9ab9a828453ab8953458.jpg', 'nota simple', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles_idiomas`
--

DROP TABLE IF EXISTS `inmuebles_idiomas`;
CREATE TABLE `inmuebles_idiomas` (
  `id` int(11) UNSIGNED NOT NULL,
  `titulo` varchar(70) NOT NULL,
  `descripcion` text NOT NULL,
  `url_seo` varchar(70) NOT NULL,
  `descripcion_seo` varchar(150) NOT NULL,
  `keywords_seo` varchar(255) NOT NULL,
  `inmueble_id` int(11) UNSIGNED NOT NULL,
  `idioma_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inmuebles_idiomas`
--

INSERT INTO `inmuebles_idiomas` (`id`, `titulo`, `descripcion`, `url_seo`, `descripcion_seo`, `keywords_seo`, `inmueble_id`, `idioma_id`) VALUES
(1, 'CHALET EN PLENO CENTRO DE ALMERIA', '<p>\r\n	Este <strong>amplio &aacute;tico</strong> nos recibe con un amplio sal&oacute;n comedor, una espaciosa cocina, y una amplia terraza con orientaci&oacute;n sur y oeste, desde esta terraza se tienen vistas al mar Mediterr&aacute;neo. La cocina es amplia, con un dise&ntilde;o abierto hacia el sal&oacute;n, y el &aacute;rea de comedor tiene grandes ventanas y acceso a la terraza. Las habitaciones est&aacute;n en un &aacute;rea independiente, ambas con orientaci&oacute;n al sur, y con posibilidad de incluir accesos directos a la terraza desde las habitaciones. Este &aacute;rea independiente la completa un ba&ntilde;o y un espacio de lavado.<br />\r\n	<br />\r\n	El &aacute;tico tiene una terraza-solarium privada de 43 metros cuadrados, con vistas al sur y al oeste. En esta terraza se disfrutan de espectaculares vistas al mar Mediterr&aacute;neo y a las monta&ntilde;as al norte de Torrox.<br />\r\n	<br />\r\n	La ubicaci&oacute;n permite disfrutar de las playas de Torrox Costa,que se encuentran a tan s&oacute;lo 50m., con la tranquilidad de estar en la zona de El Pe&ntilde;oncillo, y a solo 5 minutos de bancos, supermercados y todos los servicios necesarios.</p>\r\n', 'chalet-pleno-centro-almeria', 'Chalet en pleno centro de almería con varias dependencias', 'Chalet,centro,Álmería', 5, 1),
(2, 'Office in Almería centre', '<p>\r\n	This spacious penthouse welcomes you with a spacious living room, a spacious kitchen, and a large terrace facing south and west, from this terrace you have views of the Mediterranean Sea.</p>\r\n<p>\r\n	The kitchen is spacious, with an open design towards the living room, and the dining area has large windows and access to the terrace.</p>\r\n<p>\r\n	The rooms are in a separate area, both facing south, with the possibility of including direct access to the terrace from the rooms.</p>\r\n<p>\r\n	This independent area is completed by a bathroom and a washing space. The penthouse has a private terrace-solarium of 43 square meters, with views to the south and west. On this terrace you can enjoy spectacular views of the Mediterranean Sea and the mountains north of Torrox. The location allows you to enjoy the beaches of Torrox Costa, which are only 50m away, with the tranquility of being in the area of ​​El Pe&ntilde;oncillo, and only 5 minutes from banks, supermarkets and all necessary services.</p>\r\n', 'office-in-almeria-centre', 'Short description', 'office,centre,Almería', 5, 53),
(3, 'Casa grande en pleno centro de Cádiz', '<p>\r\n	En esta vivienda podr&aacute;s disfrutar de la <strong>tranquilidad </strong>de saber que tus hijos juegan sin peligro, mientras te relajas viendo una pelicula en tu cine de verano particular que podr&aacute;s montarte en la terraza cubierta de la parte trasera de la vivienda. El exterior es perfecto para que tu tiempo lo vivas con los tuyos, y no para que te pases el tiempo manteniendo el jard&iacute;n, puesto que tan solo unas pinceladas de verde decoran la <u>amplia parcela</u>.</p>\r\n', 'casa-grande-en-pleno-centro-de-cadiz', 'En esta vivienda podrás disfrutar de la tranquilidad de saber que tus hijos juegan sin peligro, mientras te relajas viendo una pelicula', 'casa,grade,cádiz', 4, 1),
(4, 'English tittle', '<p>\r\n	In this house you can enjoy the tranquility of knowing that your children play safely, while you relax watching a movie in your particular summer cinema that you can ride on the covered terrace at the back of the house. The exterior is perfect for your time to live with your own, and not to spend your time maintaining the garden, since only a few brushstrokes of green decorate the large plot.</p>\r\n', 'odonnell-bar-im-glad', 'Short description', 'asdadad', 4, 53),
(5, 'Oficina en obispo orberá', '<p>\r\n	Oficina en obispo orber&aacute;</p>\r\n', 'oficina-en-obispo-orbera', 'Oficina en obispo orberá', 'oficina,centre,Almería', 16, 1),
(6, 'Office obispo orberá', '<p>\r\n	Office obispo orber&aacute;</p>\r\n', 'office-obispo-orbera', 'Office obispo orberá', 'office,centre,Almería', 16, 53),
(7, 'PRECIOSO CHALET CON PISCINA EN HUERCAL DE ALMERIA', '<p>\r\n	CHALET CON 4 DORMITORIOS, 2 BA&Ntilde;OS, SALON CON CHIMENEA, COCINA, LAVADERO, DESPENSA Y COCHERA PARA 2 COCHES. AMPLIO EXTERIOR CON JARDIN DELANTERO, PORCHE Y PISCINA CON CESPED EN LA PARTE DE ATRAS DE LA VIVIENDA.</p>\r\n', 'precioso-chalet-con-piscina-en-huercal-de-almeria', 'CHALET CON 4 DORMITORIOS, GARAJE Y PISCINA', 'HUERCAL, CHALET, PISCINA', 31, 1),
(8, ' BEAUTIFUL VILLA WITH POOL IN HUERCAL DE ALMERIA', '<p>\r\n	CHALET WITH 4 BEDROOMS, 2 BATHROOMS, LIVING ROOM WITH FIREPLACE, KITCHEN, LAUNDRY, PANTRY AND GARAGE FOR 2 CARS. SPACIOUS EXTERIOR WITH FRONT GARDEN, PORCH AND SWIMMING POOL WITH LAWN IN THE BACK OF THE HOUSING.</p>\r\n', 'beautiful-villa-with-pool-in-huercal-de-almeria', ' VILLA WITH 4 BEDROOMS, GARAGE AND SWIMMING POOL', 'HUERCAL, VILLA, SWIMMING POOL', 31, 53),
(9, 'VENTA DE UNIFAMILIAR EN ZONA PLAYA', '<p>\r\n	dos dormitorios, dos ba&ntilde;os, frontal al mar</p>\r\n', 'venta-de-unifamiliar-en-zona-playa', 'unifamiliar playa', 'venta, unifamiliar, playa, cadiz', 19, 1),
(10, 'venta unifamiliar', '<p>\r\n	dos dormitorios, dos ba&ntilde;os, frontal al mar</p>\r\n', 'venta-unifamiliar', 'unifamiliar playa', 'venta, unifamiliar, playa, cadiz', 19, 53),
(11, 'piso gran oportunidad frente al hospital', '<p>\r\n	<strong>Piso gran oportunidad frente al hospital</strong>, 4 dormitorios, 2 cuartos de ba&ntilde;o, totalmente reformado, y con garaje.</p>\r\n', 'piso-gran-oportunidad-frente-al-hospital', 'piso gran oportunidad frente al hospital', 'piso,hospital,oportunidad', 30, 1),
(12, 'Great opportunity in front of the hospital', '<p>\r\n	<strong>Great opportunity in front of the hospital</strong>, 4 bedrooms, 2 bathrooms, fully renovated, and with garage.</p>\r\n', 'great-opportunity-in-front-of-the-hospital', 'Great opportunity in front of the hospital', 'Floor, hospital, opportunity', 30, 53),
(13, 'Duplex en pleno centro de cádiz', '<p>\r\n	Este <strong>amplio &aacute;tico</strong> nos recibe con un amplio sal&oacute;n comedor, una espaciosa cocina, y una amplia terraza con orientaci&oacute;n sur y oeste, desde esta terraza se tienen vistas al mar Mediterr&aacute;neo. La cocina es amplia, con un dise&ntilde;o abierto hacia el sal&oacute;n, y el &aacute;rea de comedor tiene grandes ventanas y acceso a la terraza. Las habitaciones est&aacute;n en un &aacute;rea independiente, ambas con orientaci&oacute;n al sur, y con posibilidad de incluir accesos directos a la terraza desde las habitaciones. Este &aacute;rea independiente la completa un ba&ntilde;o y un espacio de lavado.<br />\r\n	<br />\r\n	El &aacute;tico tiene una <u>terraza-solarium privada de 43 metros cuadrados</u>, con vistas al sur y al oeste. En esta terraza se disfrutan de espectaculares vistas al mar Mediterr&aacute;neo y a las monta&ntilde;as al norte de Torrox. La ubicaci&oacute;n permite disfrutar de las playas de Torrox Costa,que se encuentran a tan s&oacute;lo 50m., con la tranquilidad de estar en la zona de El Pe&ntilde;oncillo, y a solo 5 minutos de bancos, supermercados y todos los servicios necesarios.</p>\r\n', 'duplex-en-pleno-centro-de-cadiz', 'Duplex en pleno centro de cádiz con varias dependencias', 'Duplex,centro,cádiz ', 23, 1),
(14, 'Duplex in Cádiz centre', '<p>\r\n	This <strong>spacious penthouse</strong> welcomes you with a spacious living room, a spacious kitchen, and a large terrace facing south and west, from this terrace you have views of the Mediterranean Sea. The kitchen is spacious, with an open design towards the living room, and the dining area has large windows and access to the terrace.</p>\r\n<p>\r\n	The rooms are in a separate area, both facing south, with the possibility of including direct access to the terrace from the rooms. This independent area is completed by a bathroom and a washing space. The penthouse has a <u>private terrace-solarium of 43 square meters</u>, with views to the south and west. On this terrace you can enjoy spectacular views of the Mediterranean Sea and the mountains north of Torrox. The location allows you to enjoy the beaches of Torrox Costa, which are only 50m away, with the tranquility.</p>\r\n', 'duplex-in-cadiz-centre', 'Duplex in Cádiz centre', 'Duplex,Cádiz,centre', 23, 53),
(15, 'Duplex en pleno centro de cádiz', '<p>\r\n	Duplex en pleno centro de c&aacute;diz</p>\r\n', 'duplex-en-pleno-centro-de-cadiz', 'Duplex en pleno centro de cádiz con varias dependencias', 'Duplex,centro,cádiz', 7, 1),
(16, 'Duplex in Cádiz centre', '<p>\r\n	Duplex in C&aacute;diz centre</p>\r\n', 'duplex-in-cadiz-centre', 'Duplex in Cádiz centre', 'Duplex,Cádiz,centre', 7, 53),
(17, 'ESPECTACULAR VIVIENDA UNIFAMILIAR', '<p>\r\n	VIVIENDA UNIFAMILIAR <strong><span style=\"color:#000000;\">MODERNA&nbsp;</span></strong><span style=\"color:#000000;\">CON AMPLIO JARDIN, ACABADOS DE ALTA CALIDAD Y DOMOTICA. COCINA CON ISLA ABIERTA AL SALON COMEDOR. DOS DORMITORIOS CON VESTIDOR, UN BA&Ntilde;O Y UN ASEO. TIENE LAVADERO, DESPENSA Y GARAJE. ESTA EN UN BARRIO RESIDENCIAL, CERCA DE ESTACION DE TREN, CENTRO COMERCIAL, COLEGIO Y FARMACIA. CON BUENA CONEXION A LA AUTOVIA.</span></p>\r\n', 'espectacular-vivienda-unifamiliar', 'ESPECTACULAR VIVIENDA UNIFAMILIAR MODERNA CON JARDIN', 'VIVIENDA MODERNA, JARDIN, DOMOTICA', 10, 1),
(18, ' SPECTACULAR SINGLE-FAMILY HOUSE', '<div>\r\n	<span style=\"font-family: arial, sans-serif; font-size: 16px;\">MODERN SINGLE-FAMILY HOUSE WITH LARGE GARDEN, HIGH QUALITY AND DOMOTIC FINISHES. KITCHEN WITH OPEN ISLAND TO THE DINING ROOM. TWO BEDROOMS WITH DRESS, A BATHROOM AND A TOILET. Has laundry room, pantry and garage. IT IS IN A RESIDENTIAL NEIGHBORHOOD, CLOSE TO TRAIN STATION, COMMERCIAL CENTER, COLLEGE AND PHARMACY. WITH GOOD CONNECTION TO THE HIGHWAY.</span></div>\r\n', 'spectacular-single-family-house', ' SPECTACULAR MODERN ONE-FAMILY HOUSE WITH GARDEN', ' MODERN HOUSING, GARDEN, DOMOTIC', 10, 53),
(19, 'PISO TOTALMENTE REFORMADO ', '<p>\r\n	PISO TOTALMENTE<strong> <u>REFORMADO MUY CENTRICO</u></strong> CON EXCELENTES CALIDADES Y AMUEBLADO, CON AIRE ACONDICIONADO Y CALEFACCION. TIENE UNA COCINA MODERNA ABIERTA AL SALON Y DOS DORMITORIOS AMPLIOS. VISTAS INMEJORABLES.</p>\r\n', 'piso-totalmente-reformado', 'PISO TOTALMENTE REFORMADO MUY CENTRICO', 'PISO, REFORMADO, CENTRICO', 29, 1),
(20, ' FULLY REFORMED FLOOR', '<p>\r\n	APARTMENT FULLY RENOVATED VERY CENTRAL WITH EXCELLENT QUALITIES AND FURNISHED, WITH AIR CONDITIONING AND HEATING. HAS A MODERN KITCHEN OPEN TO THE LIVING ROOM AND TWO LARGE BEDROOMS. UNBEATABLE VIEWS.</p>\r\n', 'fully-reformed-floor', ' APARTMENT FULLY RENOVATED VERY CENTRAL', ' FLAT, REFORMED, CENTRAL', 29, 53),
(21, 'ESPECTACULAR VIVIENDA UNIFAMILIAR', '<div>\r\n	VIVIENDA UNIFAMILIAR MODERNA CON AMPLIO JARDIN, ACABADOS DE ALTA CALIDAD Y DOMOTICA. COCINA CON ISLA ABIERTA AL SALON COMEDOR. DOS DORMITORIOS CON VESTIDOR, UN BA&Ntilde;O Y UN ASEO. TIENE LAVADERO, DESPENSA Y GARAJE. ESTA EN UN BARRIO RESIDENCIAL, CERCA DE ESTACION DE TREN, CENTRO COMERCIAL, COLEGIO Y FARMACIA. CON BUENA CONEXION A LA AUTOVIA.</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'espectacular-vivienda-unifamiliar', 'ESPECTACULAR VIVIENDA UNIFAMILIAR MODERNA CON JARDIN', 'VIVIENDA MODERNA, JARDIN, DOMOTICA', 6, 1),
(22, 'SPECTACULAR SINGLE-FAMILY HOUSE', '<p>\r\n	&nbsp;MODERN SINGLE-FAMILY HOUSE WITH LARGE GARDEN, HIGH QUALITY AND DOMOTIC FINISHES. KITCHEN WITH OPEN ISLAND TO THE DINING ROOM. TWO BEDROOMS WITH DRESS, A BATHROOM AND A TOILET. Has laundry room, pantry and garage. IT IS IN A RESIDENTIAL NEIGHBORHOOD, CLOSE TO TRAIN STATION, COMMERCIAL CENTER, COLLEGE AND PHARMACY. WITH GOOD CONNECTION TO THE HIGHWAY.</p>\r\n', 'spectacular-single-family-house', 'SPECTACULAR MODERN ONE-FAMILY HOUSE WITH GARDEN', 'MODERN HOUSING, GARDEN, DOMOTIC', 6, 53),
(23, 'OFICINA MUY CENTRICA Y LUMINOSA', '<p>\r\n	OFICINA EN PLENO CENTRO DE ALMERIA NUEVA <strong>A ESTRENAR</strong>, ES MUY LUMINOSA Y ESPACIOSA, CON CUATRO DESPACHOS, DOS BA&Ntilde;OS Y SALA DE JUNTAS. GRAN ZONA DE TRABAJO PARA UNAS VEINTE PERSONAS</p>\r\n', 'oficina-muy-centrica-y-luminosa', 'OFICINA EN PLENO CENTRO DE ALMERIA NUEVA A ESTRENAR', 'OFICINA CENTRICA LUMINOSA', 17, 1),
(24, ' VERY CENTRAL AND LIGHT OFFICE', '<p>\r\n	OFFICE IN FULL CENTER OF ALMERIA NEW BRAND NEW, IS VERY LUMINOUS AND SPACIOUS, WITH FOUR OFFICES, TWO BATHROOMS AND GARDEN ROOM. GREAT WORK AREA FOR TWO PEOPLE</p>\r\n', 'very-central-and-light-office', ' OFFICE IN FULL CENTER OF ALMERIA NEW BRAND NEW', ' LUMINOUS CENTRAL OFFICE', 17, 53),
(25, 'DUPLEX CENTRICO REFORMADO', '<p>\r\n	DUPLEX TOTALMENTE REFORMADO,ESTILO MODERNO CON AMPLIO JARDIN, ACABADOS DE ALTA CALIDAD Y DOMOTICA. COCINA CON ISLA ABIERTA AL SALON COMEDOR. DOS DORMITORIOS CON VESTIDOR, UN BA&Ntilde;O Y UN ASEO. TIENE LAVADERO, DESPENSA Y GARAJE. ESTA EN UN BARRIO RESIDENCIAL, CERCA DE ESTACION DE TREN, CENTRO COMERCIAL, COLEGIO Y FARMACIA. CON BUENA CONEXION A LA AUTOVIA.</p>\r\n', 'duplex-centrico-reformado', 'DUPLEX TOTALMENTE REFORMADO,ESTILO MODERNO', 'DUPLEX REFORMADO MODERNO CENTRICO', 26, 1),
(26, 'REFORMED CENTRAL DUPLEX', '<p>\r\n	DUPLEX FULLY RENOVATED, MODERN STYLE WITH LARGE GARDEN, FINISHES OF HIGH QUALITY AND DOMOTICA. KITCHEN WITH OPEN ISLAND TO THE DINING ROOM. TWO BEDROOMS WITH DRESS, A BATHROOM AND A TOILET. Has laundry room, pantry and garage. IT IS IN A RESIDENTIAL NEIGHBORHOOD, CLOSE TO TRAIN STATION, COMMERCIAL CENTER, COLLEGE AND PHARMACY. WITH GOOD CONNECTION TO THE HIGHWAY.</p>\r\n', 'reformed-central-duplex', ' DUPLEX FULLY RENOVATED, MODERN STYLE', ' CENTRAL MODERN REFORMED DUPLEX', 26, 53);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles_imagenes`
--

DROP TABLE IF EXISTS `inmuebles_imagenes`;
CREATE TABLE `inmuebles_imagenes` (
  `id` int(11) UNSIGNED NOT NULL,
  `inmueble_id` int(11) UNSIGNED NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `portada` tinyint(1) NOT NULL DEFAULT '0',
  `publicada` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inmuebles_imagenes`
--

INSERT INTO `inmuebles_imagenes` (`id`, `inmueble_id`, `imagen`, `portada`, `publicada`) VALUES
(1, 5, 'uploads/inmuebles/5/imagenes/1_entrada.jpg', 0, 0),
(2, 5, 'uploads/inmuebles/5/imagenes/2_salon.jpg', 0, 1),
(4, 5, 'uploads/inmuebles/5/imagenes/4_cocina.jpg', 0, 1),
(7, 5, 'uploads/inmuebles/5/imagenes/5_fuera.jpg', 0, 1),
(8, 5, 'uploads/inmuebles/5/imagenes/6_piscina.jpg', 0, 1),
(9, 5, 'uploads/inmuebles/5/imagenes/001-ovd-919-saota-1050x700.jpg', 0, 1),
(10, 5, 'uploads/inmuebles/5/imagenes/002-armadale-house-mitsuori-architects-1050x700.jpg', 1, 1),
(15, 5, 'uploads/inmuebles/5/imagenes/3_despacho1.jpg', 0, 1),
(16, 16, 'uploads/inmuebles/16/imagenes/1_entrada.jpg', 1, 1),
(17, 4, 'uploads/inmuebles/4/imagenes/entrada_vertical.jpg', 1, 1),
(18, 31, 'uploads/inmuebles/31/imagenes/CHALET.jpg', 0, 1),
(19, 31, 'uploads/inmuebles/31/imagenes/chalet_3_dormitorios_3.jpg', 0, 1),
(20, 31, 'uploads/inmuebles/31/imagenes/COCINA.jpg', 0, 1),
(21, 31, 'uploads/inmuebles/31/imagenes/CASA-PISCINA.jpg', 1, 1),
(54, 7, 'uploads/inmuebles/7/imagenes/1.jpg', 0, 1),
(55, 7, 'uploads/inmuebles/7/imagenes/0-cunit6552noche.jpg', 1, 1),
(56, 7, 'uploads/inmuebles/7/imagenes/3.jpg', 0, 1),
(57, 7, 'uploads/inmuebles/7/imagenes/4.jpg', 0, 1),
(58, 7, 'uploads/inmuebles/7/imagenes/2.jpg', 0, 1),
(60, 7, 'uploads/inmuebles/7/imagenes/pisos-lujo-barcelona.png', 0, 1),
(61, 7, 'uploads/inmuebles/7/imagenes/d0791ccb15180cd7d93555536d3c4ed1.jpg', 0, 1),
(67, 30, 'uploads/inmuebles/30/imagenes/2_salon.jpg', 0, 1),
(75, 30, 'uploads/inmuebles/30/imagenes/4.jpg', 0, 1),
(76, 30, 'uploads/inmuebles/30/imagenes/2.jpg', 0, 1),
(79, 30, 'uploads/inmuebles/30/imagenes/d0791ccb15180cd7d93555536d3c4ed1.jpg', 1, 1),
(87, 23, 'uploads/inmuebles/23/imagenes/001-ovd-919-saota-1050x7001.jpg', 1, 1),
(88, 23, 'uploads/inmuebles/23/imagenes/002-armadale-house-mitsuori-architects-1050x7001.jpg', 0, 1),
(100, 5, 'uploads/inmuebles/5/imagenes/2.jpg', 0, 1),
(101, 5, 'uploads/inmuebles/5/imagenes/4.jpg', 0, 1),
(102, 5, 'uploads/inmuebles/5/imagenes/3.jpg', 0, 1),
(106, 23, 'uploads/inmuebles/23/imagenes/0-cunit6552noche.jpg', 0, 1),
(107, 23, 'uploads/inmuebles/23/imagenes/pisos-lujo-barcelona.png', 0, 1),
(108, 10, 'uploads/inmuebles/10/imagenes/diseno-de-casas-modernas-1_0.jpg', 0, 1),
(110, 10, 'uploads/inmuebles/10/imagenes/COCINA.jpg', 0, 0),
(111, 10, 'uploads/inmuebles/10/imagenes/Diseño-de-casa-moderna-de-dos-pisos.jpg', 1, 1),
(112, 29, 'uploads/inmuebles/29/imagenes/09_San-Jose_Bano-823x420.jpg', 0, 1),
(114, 29, 'uploads/inmuebles/29/imagenes/02_SALA-CUINA-680x418.jpg', 0, 1),
(115, 29, 'uploads/inmuebles/29/imagenes/06_SALA1-680x418.jpg', 0, 1),
(116, 29, 'uploads/inmuebles/29/imagenes/3-PISOS-EN-VENTA-EN-PAMPLONA-REFORMADOS-69-1200X746.jpg', 1, 1),
(117, 6, 'uploads/inmuebles/6/imagenes/122500155_4.jpg', 0, 1),
(118, 6, 'uploads/inmuebles/6/imagenes/01-salon_comedor-piso-venta-barca-barri_vell-girona.jpg', 0, 1),
(119, 6, 'uploads/inmuebles/6/imagenes/21657_13020722294289.jpg', 0, 1),
(121, 6, 'uploads/inmuebles/6/imagenes/Diseños-casas-modernas.jpg', 1, 1),
(122, 17, 'uploads/inmuebles/17/imagenes/inventario-de-oficina.jpg', 0, 1),
(123, 17, 'uploads/inmuebles/17/imagenes/Ideas_de_carteles_de_aseos_de_restaurante.jpg', 0, 1),
(124, 17, 'uploads/inmuebles/17/imagenes/limpieza-oficina.jpg', 1, 1),
(125, 17, 'uploads/inmuebles/17/imagenes/DSCN0906-768x1024.jpg', 0, 1),
(131, 26, 'uploads/inmuebles/26/imagenes/DSCN0906-768x10241.jpg', 0, 1),
(132, 26, 'uploads/inmuebles/26/imagenes/Fachada-de-moderna-casa-de-un-piso1.jpg', 1, 1),
(133, 26, 'uploads/inmuebles/26/imagenes/piso-reformado1.jpg', 0, 1),
(134, 26, 'uploads/inmuebles/26/imagenes/piso-reformado-55-metros-cocina_ampliacion1.jpg', 0, 1),
(135, 26, 'uploads/inmuebles/26/imagenes/3-PISOS-EN-VENTA-EN-PAMPLONA-REFORMADOS-69-1200X7461.jpg', 0, 1),
(136, 15, 'uploads/inmuebles/15/imagenes/1.jpg', 0, 1),
(139, 15, 'uploads/inmuebles/15/imagenes/pisos-lujo-barcelona.png', 1, 1),
(145, 19, 'uploads/inmuebles/19/imagenes/5.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles_lugares_interes`
--

DROP TABLE IF EXISTS `inmuebles_lugares_interes`;
CREATE TABLE `inmuebles_lugares_interes` (
  `id` int(11) UNSIGNED NOT NULL,
  `inmueble_id` int(11) UNSIGNED NOT NULL,
  `lugar_interes_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inmuebles_lugares_interes`
--

INSERT INTO `inmuebles_lugares_interes` (`id`, `inmueble_id`, `lugar_interes_id`) VALUES
(5, 5, 1),
(2, 5, 3),
(6, 5, 4),
(4, 5, 9),
(7, 5, 14),
(3, 5, 16),
(12, 19, 1),
(10, 19, 5),
(11, 19, 9),
(8, 31, 1),
(9, 31, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles_opciones_extras`
--

DROP TABLE IF EXISTS `inmuebles_opciones_extras`;
CREATE TABLE `inmuebles_opciones_extras` (
  `id` int(11) UNSIGNED NOT NULL,
  `inmueble_id` int(11) UNSIGNED NOT NULL,
  `opcion_extra_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inmuebles_opciones_extras`
--

INSERT INTO `inmuebles_opciones_extras` (`id`, `inmueble_id`, `opcion_extra_id`) VALUES
(1, 5, 1),
(3, 5, 2),
(54, 5, 3),
(6, 5, 5),
(4, 5, 8),
(45, 5, 12),
(7, 5, 13),
(52, 5, 16),
(8, 5, 17),
(9, 5, 18),
(53, 5, 22),
(5, 5, 24),
(49, 10, 2),
(48, 10, 6),
(50, 10, 15),
(51, 10, 16),
(47, 10, 24),
(46, 10, 25),
(25, 19, 2),
(23, 19, 8),
(27, 19, 14),
(29, 19, 18),
(28, 19, 22),
(24, 19, 24),
(22, 19, 25),
(35, 30, 1),
(32, 30, 2),
(41, 30, 5),
(31, 30, 6),
(40, 30, 7),
(33, 30, 8),
(38, 30, 10),
(43, 30, 12),
(42, 30, 13),
(34, 30, 16),
(44, 30, 19),
(39, 30, 21),
(37, 30, 22),
(30, 30, 24),
(36, 30, 25),
(13, 31, 1),
(14, 31, 3),
(12, 31, 6),
(16, 31, 7),
(10, 31, 8),
(20, 31, 9),
(21, 31, 11),
(19, 31, 13),
(18, 31, 20),
(17, 31, 21),
(15, 31, 22),
(11, 31, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares_interes`
--

DROP TABLE IF EXISTS `lugares_interes`;
CREATE TABLE `lugares_interes` (
  `id` int(11) UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lugares_interes`
--

INSERT INTO `lugares_interes` (`id`, `descripcion`) VALUES
(1, 'Colegio'),
(2, 'Universidad'),
(3, 'Hospital'),
(4, 'Farmacia'),
(5, 'Aeropuerto'),
(6, 'Policía'),
(7, 'Zona de marcha'),
(9, 'Bus'),
(10, 'Metro'),
(11, 'Tren'),
(12, 'Playa'),
(13, 'Parque'),
(14, 'Restaurantes'),
(15, 'Paseo marítimo'),
(16, 'Zonas de interés cultural');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares_interes_idiomas`
--

DROP TABLE IF EXISTS `lugares_interes_idiomas`;
CREATE TABLE `lugares_interes_idiomas` (
  `id` int(11) UNSIGNED NOT NULL,
  `idioma_id` int(11) UNSIGNED NOT NULL,
  `lugar_interes_id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lugares_interes_idiomas`
--

INSERT INTO `lugares_interes_idiomas` (`id`, `idioma_id`, `lugar_interes_id`, `nombre`) VALUES
(1, 1, 1, 'Colegio'),
(2, 1, 2, 'Universidad'),
(3, 1, 3, 'Hospital'),
(4, 1, 4, 'Farmacia'),
(5, 53, 1, 'School'),
(6, 53, 2, 'University'),
(7, 53, 3, 'Hospital'),
(8, 53, 4, 'Pharmacy'),
(9, 1, 5, 'Aeropuerto'),
(10, 53, 5, 'Airport'),
(11, 1, 6, 'Policía'),
(12, 53, 6, 'Police'),
(13, 1, 7, 'Pubs'),
(14, 53, 7, 'Pubs'),
(17, 1, 9, 'Bus'),
(18, 53, 9, 'Bus'),
(19, 1, 10, 'Metro'),
(20, 53, 10, 'Subway'),
(21, 1, 11, 'Tren'),
(22, 53, 11, 'Train'),
(23, 1, 12, 'Playa'),
(24, 53, 12, 'Beach '),
(25, 1, 13, 'Parque'),
(26, 53, 13, 'Park'),
(27, 1, 14, 'Restaurantes'),
(28, 53, 14, 'Restaurants'),
(29, 1, 15, 'Paseo marítimo'),
(30, 53, 15, 'Promenade'),
(31, 1, 16, 'Zonas de interés cultural'),
(32, 53, 16, 'Areas of cultural interest');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas_documentacion`
--

DROP TABLE IF EXISTS `marcas_documentacion`;
CREATE TABLE `marcas_documentacion` (
  `id` int(11) UNSIGNED NOT NULL,
  `referencia` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `especial` tinyint(1) NOT NULL DEFAULT '0',
  `categoria_inf_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `marcas_documentacion`
--

INSERT INTO `marcas_documentacion` (`id`, `referencia`, `descripcion`, `especial`, `categoria_inf_id`) VALUES
(1, 'f_actual_numero', 'Fecha actual en formato numérico', 0, 1),
(2, 'f_actual_texto', 'Fecha actual en formato texto', 0, 1),
(3, 'nif', 'NIF/NIE/CIF del cliente', 0, 2),
(4, 'nombre', 'Nombre del cliente', 0, 2),
(5, 'apellidos', 'Apellidos del cliente', 0, 2),
(6, 'fecha_nac', 'Fecha de nacimiento', 1, 2),
(7, 'nombre_pais', 'Nombre del país donde reside', 0, 2),
(8, 'nombre_provincia', 'Nombre de la provincia', 0, 2),
(9, 'nombre_poblacion', 'Nombre del municipio', 0, 2),
(10, 'direccion', 'Domicilio donde reside el cliente', 0, 2),
(11, 'correo', 'Correo electrónico', 0, 2),
(12, 'telefonos', 'Teléfonos de contacto', 0, 2),
(13, 'nombre_estado', 'Estado', 0, 2),
(14, 'nombre_agente_asignado', 'Nombre del agente asignado', 0, 2),
(15, 'observaciones', 'Observaciones', 0, 2),
(16, 'referencia', 'Referencia del inmueble', 0, 3),
(17, 'fecha_alta', 'Fecha de alta del inmueble', 1, 3),
(18, 'nombre_tipo', 'Tipo del inmueble', 0, 3),
(19, 'nombre_provincia', 'Nombre de la provincia', 0, 3),
(20, 'nombre_poblacion', 'Nombre del municipio', 0, 3),
(21, 'nombre_zona', 'Nombre de la zona del municipio', 0, 3),
(22, 'direccion', 'Dirección real del inmueble', 0, 3),
(23, 'metros', 'Metros totales', 0, 3),
(24, 'metros_utiles', 'Metros útiles', 0, 3),
(25, 'habitaciones', 'Número de habitaciones', 0, 3),
(26, 'banios', 'Número de baños', 0, 3),
(27, 'precio_compra', 'Precio de compra', 1, 3),
(28, 'precio_compra_anterior', 'Precio de compra anterior', 1, 3),
(29, 'precio_alquiler', 'Precio alquiler', 1, 3),
(30, 'precio_alquiler_anterior', 'Precio alquiler anterior', 1, 3),
(31, 'nombre_certificacion_energetica', 'Certificación energética', 0, 3),
(32, 'direccion_publica', 'Dirección mostrada en la zona pública', 0, 3),
(33, 'titulo_publico', 'Título mostrado en la zona pública', 1, 3),
(34, 'descripcion_publica', 'Descripción extendida mostrada en la zona pública', 1, 3),
(35, 'url_seo', 'URL SEO', 1, 3),
(36, 'descripcion_seo', 'Descripción SEO', 1, 3),
(37, 'keywords_seo', 'Palabras clave para el SEO', 1, 3),
(38, 'nombre_estado', 'Estado', 0, 3),
(39, 'nombre_captador', 'Nombre completo del captador', 0, 3),
(40, 'observaciones', 'Observaciones', 0, 3),
(41, 'imagen_portada', 'Imagen de la portada pública', 1, 3),
(42, 'codigo_qr', 'Código QR del URL SEO de la zona pública', 1, 6),
(43, 'nombre', 'Nombre del agente', 1, 4),
(44, 'apellidos', 'Apellidos del agente', 1, 4),
(45, 'referencia', 'Referencia de la demanda', 0, 7),
(46, 'fecha_alta', 'Fecha de alta de la demanda', 1, 7),
(47, 'oferta', 'Oferta demandada', 0, 7),
(48, 'tipo', 'Tipo de demanda', 0, 7),
(49, 'nombre_cliente', 'Nombre completo del cliente demandante', 0, 7),
(50, 'tipos_inmuebles', 'Listado de tipos de inmuebles separados por comas', 0, 7),
(51, 'nombre_provincia', 'Nombre de la provincia', 0, 7),
(52, 'nombre_poblacion', 'Nombre del municipio', 0, 7),
(53, 'zonas', 'Listado de zonas separados por comas', 0, 7),
(54, 'metros_desde', 'Metros totales (desde)', 0, 7),
(55, 'metros_hasta', 'Metros totales (hasta)', 0, 7),
(56, 'habitaciones_desde', 'Número de habitaciones (desde)', 0, 7),
(57, 'habitaciones_hasta', 'Número de habitaciones (hasta)', 0, 7),
(58, 'banios_desde', 'Número de baños (desde)', 0, 7),
(59, 'banios_hasta', 'Número de baños (hasta)', 0, 7),
(60, 'precio_desde', 'Precio (desde)', 1, 7),
(61, 'precio_hasta', 'Precio (hasta)', 1, 7),
(62, 'anio_construccion_desde', 'Año construcción (desde)', 0, 7),
(63, 'anio_construccion_hasta', 'Año construcción (hasta)', 0, 7),
(64, 'nombre_certificacion_energetica', 'Certificación energética mínima', 0, 7),
(65, 'nombre_estado', 'Estado', 0, 7),
(66, 'nombre_agente_asignado', 'Nombre completo del agente asignado', 0, 7),
(67, 'observaciones', 'Observaciones', 0, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medios_captacion`
--

DROP TABLE IF EXISTS `medios_captacion`;
CREATE TABLE `medios_captacion` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `medios_captacion`
--

INSERT INTO `medios_captacion` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Amigos o Conocidos', '-'),
(2, 'Facebook', '-'),
(3, 'Twitter', '-'),
(5, 'Fotocasa', '-'),
(6, 'Idealista', '-'),
(7, 'Pisos.com', '-'),
(8, 'Anuncio publicitario', '-'),
(9, 'Otros medios', '-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones_extras`
--

DROP TABLE IF EXISTS `opciones_extras`;
CREATE TABLE `opciones_extras` (
  `id` int(11) UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `opciones_extras`
--

INSERT INTO `opciones_extras` (`id`, `descripcion`) VALUES
(1, 'Cocina'),
(2, 'Mobiliario general'),
(3, 'Piscina'),
(4, 'Jacuzzi'),
(5, 'Ascensor'),
(6, 'Garaje'),
(7, 'Armarios empotrados'),
(8, 'Aire acondicionado'),
(9, 'Jardín'),
(10, 'Terraza'),
(11, 'Trastero'),
(12, 'Inmueble da a zona interior'),
(13, 'Inmueble da a zona exterior'),
(14, 'Inmueble orientado al norte'),
(15, 'Inmueble orientado al sur'),
(16, 'Inmueble orientado al este'),
(17, 'Inmueble orientado al oeste'),
(18, 'Inmueble situado en la última planta'),
(19, 'Inmueble situado en plantas intermedias'),
(20, 'Inmueble situado en planta baja'),
(21, 'Electrodomésticos'),
(22, 'Salón comedor'),
(23, 'Por reformar'),
(24, 'Listo para entrar a vivir'),
(25, 'Altas calidades');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones_extras_idiomas`
--

DROP TABLE IF EXISTS `opciones_extras_idiomas`;
CREATE TABLE `opciones_extras_idiomas` (
  `id` int(11) UNSIGNED NOT NULL,
  `idioma_id` int(11) UNSIGNED NOT NULL,
  `opcion_extra_id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `opciones_extras_idiomas`
--

INSERT INTO `opciones_extras_idiomas` (`id`, `idioma_id`, `opcion_extra_id`, `nombre`) VALUES
(1, 1, 1, 'Cocina'),
(2, 1, 2, 'Mobiliario'),
(3, 1, 3, 'Piscina'),
(4, 1, 4, 'Jacuzzi'),
(5, 53, 1, 'Kitchen'),
(6, 53, 2, 'Furniture'),
(7, 53, 3, 'Pool'),
(8, 53, 4, 'Jacuzzi'),
(9, 1, 5, 'Ascensor'),
(10, 53, 5, 'Elevator'),
(11, 1, 6, 'Garaje'),
(12, 53, 6, 'Garage'),
(13, 1, 7, 'Armarios empotrados'),
(14, 53, 7, 'Built-in wardrobes'),
(15, 1, 8, 'Aire acondicionado'),
(16, 53, 8, 'Air conditioner'),
(17, 1, 9, 'Jardín'),
(18, 53, 9, 'Garden'),
(19, 1, 10, 'Terraza'),
(20, 53, 10, 'Terrace'),
(21, 1, 11, 'Trastero'),
(22, 53, 11, 'Storage room'),
(23, 1, 12, 'Interior'),
(24, 53, 12, 'Inside'),
(25, 1, 13, 'Exterior'),
(26, 53, 13, 'Outside'),
(27, 1, 14, 'Orientación Norte'),
(28, 53, 14, 'North Orientation'),
(29, 1, 15, 'Orientación Sur'),
(30, 53, 15, 'South Orientation'),
(31, 1, 16, 'Orientación Este'),
(32, 53, 16, 'East Orientation'),
(33, 1, 17, 'Orientación Oeste'),
(34, 53, 17, 'West Orientation'),
(35, 1, 18, 'Última planta'),
(36, 53, 18, 'Last Floor'),
(37, 1, 19, 'Planta intermedia'),
(38, 53, 19, 'Mid floor'),
(39, 1, 20, 'Planta Baja'),
(40, 53, 20, 'Ground floor'),
(41, 1, 21, 'Electrodomésticos'),
(42, 53, 21, 'Home appliances'),
(43, 1, 22, 'Salón comedor'),
(44, 53, 22, 'Living room'),
(45, 1, 23, 'Por reformar'),
(46, 53, 23, 'Reforms needed'),
(47, 1, 24, 'Buen estado'),
(48, 53, 24, 'Good state'),
(49, 1, 25, 'Altas calidades'),
(50, 53, 25, 'High quality');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

DROP TABLE IF EXISTS `paises`;
CREATE TABLE `paises` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `iso2` char(2) NOT NULL,
  `iso3` char(3) NOT NULL,
  `phone_code` varchar(5) DEFAULT NULL,
  `defecto` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `nombre`, `name`, `nom`, `iso2`, `iso3`, `phone_code`, `defecto`) VALUES
(1, 'Afganistán', 'Afghanistan', 'Afghanistan', 'AF', 'AFG', '93', 0),
(2, 'Albania', 'Albania', 'Albanie', 'AL', 'ALB', '355', 0),
(3, 'Alemania', 'Germany', 'Allemagne', 'DE', 'DEU', '49', 0),
(4, 'Algeria', 'Algeria', 'Algérie', 'DZ', 'DZA', '213', 0),
(5, 'Andorra', 'Andorra', 'Andorra', 'AD', 'AND', '376', 0),
(6, 'Angola', 'Angola', 'Angola', 'AO', 'AGO', '244', 0),
(7, 'Anguila', 'Anguilla', 'Anguilla', 'AI', 'AIA', '1 264', 0),
(8, 'Antártida', 'Antarctica', 'L\'Antarctique', 'AQ', 'ATA', '672', 0),
(9, 'Antigua y Barbuda', 'Antigua and Barbuda', 'Antigua et Barbuda', 'AG', 'ATG', '1 268', 0),
(10, 'Antillas Neerlandesas', 'Netherlands Antilles', 'Antilles Néerlandaises', 'AN', 'ANT', '599', 0),
(11, 'Arabia Saudita', 'Saudi Arabia', 'Arabie Saoudite', 'SA', 'SAU', '966', 0),
(12, 'Argentina', 'Argentina', 'Argentine', 'AR', 'ARG', '54', 0),
(13, 'Armenia', 'Armenia', 'L\'Arménie', 'AM', 'ARM', '374', 0),
(14, 'Aruba', 'Aruba', 'Aruba', 'AW', 'ABW', '297', 0),
(15, 'Australia', 'Australia', 'Australie', 'AU', 'AUS', '61', 0),
(16, 'Austria', 'Austria', 'Autriche', 'AT', 'AUT', '43', 0),
(17, 'Azerbayán', 'Azerbaijan', 'L\'Azerbaïdjan', 'AZ', 'AZE', '994', 0),
(18, 'Bélgica', 'Belgium', 'Belgique', 'BE', 'BEL', '32', 0),
(19, 'Bahamas', 'Bahamas', 'Bahamas', 'BS', 'BHS', '1 242', 0),
(20, 'Bahrein', 'Bahrain', 'Bahreïn', 'BH', 'BHR', '973', 0),
(21, 'Bangladesh', 'Bangladesh', 'Bangladesh', 'BD', 'BGD', '880', 0),
(22, 'Barbados', 'Barbados', 'Barbade', 'BB', 'BRB', '1 246', 0),
(23, 'Belice', 'Belize', 'Belize', 'BZ', 'BLZ', '501', 0),
(24, 'Benín', 'Benin', 'Bénin', 'BJ', 'BEN', '229', 0),
(25, 'Bhután', 'Bhutan', 'Le Bhoutan', 'BT', 'BTN', '975', 0),
(26, 'Bielorrusia', 'Belarus', 'Biélorussie', 'BY', 'BLR', '375', 0),
(27, 'Birmania', 'Myanmar', 'Myanmar', 'MM', 'MMR', '95', 0),
(28, 'Bolivia', 'Bolivia', 'Bolivie', 'BO', 'BOL', '591', 0),
(29, 'Bosnia y Herzegovina', 'Bosnia and Herzegovina', 'Bosnie-Herzégovine', 'BA', 'BIH', '387', 0),
(30, 'Botsuana', 'Botswana', 'Botswana', 'BW', 'BWA', '267', 0),
(31, 'Brasil', 'Brazil', 'Brésil', 'BR', 'BRA', '55', 0),
(32, 'Brunéi', 'Brunei', 'Brunei', 'BN', 'BRN', '673', 0),
(33, 'Bulgaria', 'Bulgaria', 'Bulgarie', 'BG', 'BGR', '359', 0),
(34, 'Burkina Faso', 'Burkina Faso', 'Burkina Faso', 'BF', 'BFA', '226', 0),
(35, 'Burundi', 'Burundi', 'Burundi', 'BI', 'BDI', '257', 0),
(36, 'Cabo Verde', 'Cape Verde', 'Cap-Vert', 'CV', 'CPV', '238', 0),
(37, 'Camboya', 'Cambodia', 'Cambodge', 'KH', 'KHM', '855', 0),
(38, 'Camerún', 'Cameroon', 'Cameroun', 'CM', 'CMR', '237', 0),
(39, 'Canadá', 'Canada', 'Canada', 'CA', 'CAN', '1', 0),
(40, 'Chad', 'Chad', 'Tchad', 'TD', 'TCD', '235', 0),
(41, 'Chile', 'Chile', 'Chili', 'CL', 'CHL', '56', 0),
(42, 'China', 'China', 'Chine', 'CN', 'CHN', '86', 0),
(43, 'Chipre', 'Cyprus', 'Chypre', 'CY', 'CYP', '357', 0),
(44, 'Ciudad del Vaticano', 'Vatican City State', 'Cité du Vatican', 'VA', 'VAT', '39', 0),
(45, 'Colombia', 'Colombia', 'Colombie', 'CO', 'COL', '57', 0),
(46, 'Comoras', 'Comoros', 'Comores', 'KM', 'COM', '269', 0),
(47, 'Congo', 'Congo', 'Congo', 'CG', 'COG', '242', 0),
(48, 'Congo', 'Congo', 'Congo', 'CD', 'COD', '243', 0),
(49, 'Corea del Norte', 'North Korea', 'Corée du Nord', 'KP', 'PRK', '850', 0),
(50, 'Corea del Sur', 'South Korea', 'Corée du Sud', 'KR', 'KOR', '82', 0),
(51, 'Costa de Marfil', 'Ivory Coast', 'Côte-d\'Ivoire', 'CI', 'CIV', '225', 0),
(52, 'Costa Rica', 'Costa Rica', 'Costa Rica', 'CR', 'CRI', '506', 0),
(53, 'Croacia', 'Croatia', 'Croatie', 'HR', 'HRV', '385', 0),
(54, 'Cuba', 'Cuba', 'Cuba', 'CU', 'CUB', '53', 0),
(55, 'Dinamarca', 'Denmark', 'Danemark', 'DK', 'DNK', '45', 0),
(56, 'Dominica', 'Dominica', 'Dominique', 'DM', 'DMA', '1 767', 0),
(57, 'Ecuador', 'Ecuador', 'Equateur', 'EC', 'ECU', '593', 0),
(58, 'Egipto', 'Egypt', 'Egypte', 'EG', 'EGY', '20', 0),
(59, 'El Salvador', 'El Salvador', 'El Salvador', 'SV', 'SLV', '503', 0),
(60, 'Emiratos Árabes Unidos', 'United Arab Emirates', 'Emirats Arabes Unis', 'AE', 'ARE', '971', 0),
(61, 'Eritrea', 'Eritrea', 'Erythrée', 'ER', 'ERI', '291', 0),
(62, 'Eslovaquia', 'Slovakia', 'Slovaquie', 'SK', 'SVK', '421', 0),
(63, 'Eslovenia', 'Slovenia', 'Slovénie', 'SI', 'SVN', '386', 0),
(64, 'España', 'Spain', 'Espagne', 'ES', 'ESP', '34', 1),
(65, 'Estados Unidos de América', 'United States of America', 'États-Unis d\'Amérique', 'US', 'USA', '1', 0),
(66, 'Estonia', 'Estonia', 'L\'Estonie', 'EE', 'EST', '372', 0),
(67, 'Etiopía', 'Ethiopia', 'Ethiopie', 'ET', 'ETH', '251', 0),
(68, 'Filipinas', 'Philippines', 'Philippines', 'PH', 'PHL', '63', 0),
(69, 'Finlandia', 'Finland', 'Finlande', 'FI', 'FIN', '358', 0),
(70, 'Fiyi', 'Fiji', 'Fidji', 'FJ', 'FJI', '679', 0),
(71, 'Francia', 'France', 'France', 'FR', 'FRA', '33', 0),
(72, 'Gabón', 'Gabon', 'Gabon', 'GA', 'GAB', '241', 0),
(73, 'Gambia', 'Gambia', 'Gambie', 'GM', 'GMB', '220', 0),
(74, 'Georgia', 'Georgia', 'Géorgie', 'GE', 'GEO', '995', 0),
(75, 'Ghana', 'Ghana', 'Ghana', 'GH', 'GHA', '233', 0),
(76, 'Gibraltar', 'Gibraltar', 'Gibraltar', 'GI', 'GIB', '350', 0),
(77, 'Granada', 'Grenada', 'Grenade', 'GD', 'GRD', '1 473', 0),
(78, 'Grecia', 'Greece', 'Grèce', 'GR', 'GRC', '30', 0),
(79, 'Groenlandia', 'Greenland', 'Groenland', 'GL', 'GRL', '299', 0),
(80, 'Guadalupe', 'Guadeloupe', 'Guadeloupe', 'GP', 'GLP', '', 0),
(81, 'Guam', 'Guam', 'Guam', 'GU', 'GUM', '1 671', 0),
(82, 'Guatemala', 'Guatemala', 'Guatemala', 'GT', 'GTM', '502', 0),
(83, 'Guayana Francesa', 'French Guiana', 'Guyane française', 'GF', 'GUF', '', 0),
(84, 'Guernsey', 'Guernsey', 'Guernesey', 'GG', 'GGY', '', 0),
(85, 'Guinea', 'Guinea', 'Guinée', 'GN', 'GIN', '224', 0),
(86, 'Guinea Ecuatorial', 'Equatorial Guinea', 'Guinée Equatoriale', 'GQ', 'GNQ', '240', 0),
(87, 'Guinea-Bissau', 'Guinea-Bissau', 'Guinée-Bissau', 'GW', 'GNB', '245', 0),
(88, 'Guyana', 'Guyana', 'Guyane', 'GY', 'GUY', '592', 0),
(89, 'Haití', 'Haiti', 'Haïti', 'HT', 'HTI', '509', 0),
(90, 'Honduras', 'Honduras', 'Honduras', 'HN', 'HND', '504', 0),
(91, 'Hong kong', 'Hong Kong', 'Hong Kong', 'HK', 'HKG', '852', 0),
(92, 'Hungría', 'Hungary', 'Hongrie', 'HU', 'HUN', '36', 0),
(93, 'India', 'India', 'Inde', 'IN', 'IND', '91', 0),
(94, 'Indonesia', 'Indonesia', 'Indonésie', 'ID', 'IDN', '62', 0),
(95, 'Irán', 'Iran', 'Iran', 'IR', 'IRN', '98', 0),
(96, 'Irak', 'Iraq', 'Irak', 'IQ', 'IRQ', '964', 0),
(97, 'Irlanda', 'Ireland', 'Irlande', 'IE', 'IRL', '353', 0),
(98, 'Isla Bouvet', 'Bouvet Island', 'Bouvet Island', 'BV', 'BVT', '', 0),
(99, 'Isla de Man', 'Isle of Man', 'Ile de Man', 'IM', 'IMN', '44', 0),
(100, 'Isla de Navidad', 'Christmas Island', 'Christmas Island', 'CX', 'CXR', '61', 0),
(101, 'Isla Norfolk', 'Norfolk Island', 'Île de Norfolk', 'NF', 'NFK', '', 0),
(102, 'Islandia', 'Iceland', 'Islande', 'IS', 'ISL', '354', 0),
(103, 'Islas Bermudas', 'Bermuda Islands', 'Bermudes', 'BM', 'BMU', '1 441', 0),
(104, 'Islas Caimán', 'Cayman Islands', 'Iles Caïmans', 'KY', 'CYM', '1 345', 0),
(105, 'Islas Cocos (Keeling)', 'Cocos (Keeling) Islands', 'Cocos (Keeling', 'CC', 'CCK', '61', 0),
(106, 'Islas Cook', 'Cook Islands', 'Iles Cook', 'CK', 'COK', '682', 0),
(107, 'Islas de Åland', 'Åland Islands', 'Îles Åland', 'AX', 'ALA', '', 0),
(108, 'Islas Feroe', 'Faroe Islands', 'Iles Féro', 'FO', 'FRO', '298', 0),
(109, 'Islas Georgias del Sur y Sandwich del Sur', 'South Georgia and the South Sandwich Islands', 'Géorgie du Sud et les Îles Sandwich du Sud', 'GS', 'SGS', '', 0),
(110, 'Islas Heard y McDonald', 'Heard Island and McDonald Islands', 'Les îles Heard et McDonald', 'HM', 'HMD', '', 0),
(111, 'Islas Maldivas', 'Maldives', 'Maldives', 'MV', 'MDV', '960', 0),
(112, 'Islas Malvinas', 'Falkland Islands (Malvinas)', 'Iles Falkland (Malvinas', 'FK', 'FLK', '500', 0),
(113, 'Islas Marianas del Norte', 'Northern Mariana Islands', 'Iles Mariannes du Nord', 'MP', 'MNP', '1 670', 0),
(114, 'Islas Marshall', 'Marshall Islands', 'Iles Marshall', 'MH', 'MHL', '692', 0),
(115, 'Islas Pitcairn', 'Pitcairn Islands', 'Iles Pitcairn', 'PN', 'PCN', '870', 0),
(116, 'Islas Salomón', 'Solomon Islands', 'Iles Salomon', 'SB', 'SLB', '677', 0),
(117, 'Islas Turcas y Caicos', 'Turks and Caicos Islands', 'Iles Turques et Caïques', 'TC', 'TCA', '1 649', 0),
(118, 'Islas Ultramarinas Menores de Estados Unidos', 'United States Minor Outlying Islands', 'États-Unis Îles mineures éloignées', 'UM', 'UMI', '', 0),
(119, 'Islas Vírgenes Británicas', 'Virgin Islands', 'Iles Vierges', 'VG', 'VG', '1 284', 0),
(120, 'Islas Vírgenes de los Estados Unidos', 'United States Virgin Islands', 'Îles Vierges américaines', 'VI', 'VIR', '1 340', 0),
(121, 'Israel', 'Israel', 'Israël', 'IL', 'ISR', '972', 0),
(122, 'Italia', 'Italy', 'Italie', 'IT', 'ITA', '39', 0),
(123, 'Jamaica', 'Jamaica', 'Jamaïque', 'JM', 'JAM', '1 876', 0),
(124, 'Japón', 'Japan', 'Japon', 'JP', 'JPN', '81', 0),
(125, 'Jersey', 'Jersey', 'Maillot', 'JE', 'JEY', '', 0),
(126, 'Jordania', 'Jordan', 'Jordan', 'JO', 'JOR', '962', 0),
(127, 'Kazajistán', 'Kazakhstan', 'Le Kazakhstan', 'KZ', 'KAZ', '7', 0),
(128, 'Kenia', 'Kenya', 'Kenya', 'KE', 'KEN', '254', 0),
(129, 'Kirgizstán', 'Kyrgyzstan', 'Kirghizstan', 'KG', 'KGZ', '996', 0),
(130, 'Kiribati', 'Kiribati', 'Kiribati', 'KI', 'KIR', '686', 0),
(131, 'Kuwait', 'Kuwait', 'Koweït', 'KW', 'KWT', '965', 0),
(132, 'Líbano', 'Lebanon', 'Liban', 'LB', 'LBN', '961', 0),
(133, 'Laos', 'Laos', 'Laos', 'LA', 'LAO', '856', 0),
(134, 'Lesoto', 'Lesotho', 'Lesotho', 'LS', 'LSO', '266', 0),
(135, 'Letonia', 'Latvia', 'La Lettonie', 'LV', 'LVA', '371', 0),
(136, 'Liberia', 'Liberia', 'Liberia', 'LR', 'LBR', '231', 0),
(137, 'Libia', 'Libya', 'Libye', 'LY', 'LBY', '218', 0),
(138, 'Liechtenstein', 'Liechtenstein', 'Liechtenstein', 'LI', 'LIE', '423', 0),
(139, 'Lituania', 'Lithuania', 'La Lituanie', 'LT', 'LTU', '370', 0),
(140, 'Luxemburgo', 'Luxembourg', 'Luxembourg', 'LU', 'LUX', '352', 0),
(141, 'México', 'Mexico', 'Mexique', 'MX', 'MEX', '52', 0),
(142, 'Mónaco', 'Monaco', 'Monaco', 'MC', 'MCO', '377', 0),
(143, 'Macao', 'Macao', 'Macao', 'MO', 'MAC', '853', 0),
(144, 'Macedônia', 'Macedonia', 'Macédoine', 'MK', 'MKD', '389', 0),
(145, 'Madagascar', 'Madagascar', 'Madagascar', 'MG', 'MDG', '261', 0),
(146, 'Malasia', 'Malaysia', 'Malaisie', 'MY', 'MYS', '60', 0),
(147, 'Malawi', 'Malawi', 'Malawi', 'MW', 'MWI', '265', 0),
(148, 'Mali', 'Mali', 'Mali', 'ML', 'MLI', '223', 0),
(149, 'Malta', 'Malta', 'Malte', 'MT', 'MLT', '356', 0),
(150, 'Marruecos', 'Morocco', 'Maroc', 'MA', 'MAR', '212', 0),
(151, 'Martinica', 'Martinique', 'Martinique', 'MQ', 'MTQ', '', 0),
(152, 'Mauricio', 'Mauritius', 'Iles Maurice', 'MU', 'MUS', '230', 0),
(153, 'Mauritania', 'Mauritania', 'Mauritanie', 'MR', 'MRT', '222', 0),
(154, 'Mayotte', 'Mayotte', 'Mayotte', 'YT', 'MYT', '262', 0),
(155, 'Micronesia', 'Estados Federados de', 'Federados Estados de', 'FM', 'FSM', '691', 0),
(156, 'Moldavia', 'Moldova', 'Moldavie', 'MD', 'MDA', '373', 0),
(157, 'Mongolia', 'Mongolia', 'Mongolie', 'MN', 'MNG', '976', 0),
(158, 'Montenegro', 'Montenegro', 'Monténégro', 'ME', 'MNE', '382', 0),
(159, 'Montserrat', 'Montserrat', 'Montserrat', 'MS', 'MSR', '1 664', 0),
(160, 'Mozambique', 'Mozambique', 'Mozambique', 'MZ', 'MOZ', '258', 0),
(161, 'Namibia', 'Namibia', 'Namibie', 'NA', 'NAM', '264', 0),
(162, 'Nauru', 'Nauru', 'Nauru', 'NR', 'NRU', '674', 0),
(163, 'Nepal', 'Nepal', 'Népal', 'NP', 'NPL', '977', 0),
(164, 'Nicaragua', 'Nicaragua', 'Nicaragua', 'NI', 'NIC', '505', 0),
(165, 'Niger', 'Niger', 'Niger', 'NE', 'NER', '227', 0),
(166, 'Nigeria', 'Nigeria', 'Nigeria', 'NG', 'NGA', '234', 0),
(167, 'Niue', 'Niue', 'Niou', 'NU', 'NIU', '683', 0),
(168, 'Noruega', 'Norway', 'Norvège', 'NO', 'NOR', '47', 0),
(169, 'Nueva Caledonia', 'New Caledonia', 'Nouvelle-Calédonie', 'NC', 'NCL', '687', 0),
(170, 'Nueva Zelanda', 'New Zealand', 'Nouvelle-Zélande', 'NZ', 'NZL', '64', 0),
(171, 'Omán', 'Oman', 'Oman', 'OM', 'OMN', '968', 0),
(172, 'Países Bajos', 'Netherlands', 'Pays-Bas', 'NL', 'NLD', '31', 0),
(173, 'Pakistán', 'Pakistan', 'Pakistan', 'PK', 'PAK', '92', 0),
(174, 'Palau', 'Palau', 'Palau', 'PW', 'PLW', '680', 0),
(175, 'Palestina', 'Palestine', 'La Palestine', 'PS', 'PSE', '', 0),
(176, 'Panamá', 'Panama', 'Panama', 'PA', 'PAN', '507', 0),
(177, 'Papúa Nueva Guinea', 'Papua New Guinea', 'Papouasie-Nouvelle-Guinée', 'PG', 'PNG', '675', 0),
(178, 'Paraguay', 'Paraguay', 'Paraguay', 'PY', 'PRY', '595', 0),
(179, 'Perú', 'Peru', 'Pérou', 'PE', 'PER', '51', 0),
(180, 'Polinesia Francesa', 'French Polynesia', 'Polynésie française', 'PF', 'PYF', '689', 0),
(181, 'Polonia', 'Poland', 'Pologne', 'PL', 'POL', '48', 0),
(182, 'Portugal', 'Portugal', 'Portugal', 'PT', 'PRT', '351', 0),
(183, 'Puerto Rico', 'Puerto Rico', 'Porto Rico', 'PR', 'PRI', '1', 0),
(184, 'Qatar', 'Qatar', 'Qatar', 'QA', 'QAT', '974', 0),
(185, 'Reino Unido', 'United Kingdom', 'Royaume-Uni', 'GB', 'GBR', '44', 0),
(186, 'República Centroafricana', 'Central African Republic', 'République Centrafricaine', 'CF', 'CAF', '236', 0),
(187, 'República Checa', 'Czech Republic', 'République Tchèque', 'CZ', 'CZE', '420', 0),
(188, 'República Dominicana', 'Dominican Republic', 'République Dominicaine', 'DO', 'DOM', '1 809', 0),
(189, 'Reunión', 'Réunion', 'Réunion', 'RE', 'REU', '', 0),
(190, 'Ruanda', 'Rwanda', 'Rwanda', 'RW', 'RWA', '250', 0),
(191, 'Rumanía', 'Romania', 'Roumanie', 'RO', 'ROU', '40', 0),
(192, 'Rusia', 'Russia', 'La Russie', 'RU', 'RUS', '7', 0),
(193, 'Sahara Occidental', 'Western Sahara', 'Sahara Occidental', 'EH', 'ESH', '', 0),
(194, 'Samoa', 'Samoa', 'Samoa', 'WS', 'WSM', '685', 0),
(195, 'Samoa Americana', 'American Samoa', 'Les Samoa américaines', 'AS', 'ASM', '1 684', 0),
(196, 'San Bartolomé', 'Saint Barthélemy', 'Saint-Barthélemy', 'BL', 'BLM', '590', 0),
(197, 'San Cristóbal y Nieves', 'Saint Kitts and Nevis', 'Saint Kitts et Nevis', 'KN', 'KNA', '1 869', 0),
(198, 'San Marino', 'San Marino', 'San Marino', 'SM', 'SMR', '378', 0),
(199, 'San Martín (Francia)', 'Saint Martin (French part)', 'Saint-Martin (partie française)', 'MF', 'MAF', '1 599', 0),
(200, 'San Pedro y Miquelón', 'Saint Pierre and Miquelon', 'Saint-Pierre-et-Miquelon', 'PM', 'SPM', '508', 0),
(201, 'San Vicente y las Granadinas', 'Saint Vincent and the Grenadines', 'Saint-Vincent et Grenadines', 'VC', 'VCT', '1 784', 0),
(202, 'Santa Elena', 'Ascensión y Tristán de Acuña', 'Ascensión y Tristan de Acuña', 'SH', 'SHN', '290', 0),
(203, 'Santa Lucía', 'Saint Lucia', 'Sainte-Lucie', 'LC', 'LCA', '1 758', 0),
(204, 'Santo Tomé y Príncipe', 'Sao Tome and Principe', 'Sao Tomé et Principe', 'ST', 'STP', '239', 0),
(205, 'Senegal', 'Senegal', 'Sénégal', 'SN', 'SEN', '221', 0),
(206, 'Serbia', 'Serbia', 'Serbie', 'RS', 'SRB', '381', 0),
(207, 'Seychelles', 'Seychelles', 'Les Seychelles', 'SC', 'SYC', '248', 0),
(208, 'Sierra Leona', 'Sierra Leone', 'Sierra Leone', 'SL', 'SLE', '232', 0),
(209, 'Singapur', 'Singapore', 'Singapour', 'SG', 'SGP', '65', 0),
(210, 'Siria', 'Syria', 'Syrie', 'SY', 'SYR', '963', 0),
(211, 'Somalia', 'Somalia', 'Somalie', 'SO', 'SOM', '252', 0),
(212, 'Sri lanka', 'Sri Lanka', 'Sri Lanka', 'LK', 'LKA', '94', 0),
(213, 'Sudáfrica', 'South Africa', 'Afrique du Sud', 'ZA', 'ZAF', '27', 0),
(214, 'Sudán', 'Sudan', 'Soudan', 'SD', 'SDN', '249', 0),
(215, 'Suecia', 'Sweden', 'Suède', 'SE', 'SWE', '46', 0),
(216, 'Suiza', 'Switzerland', 'Suisse', 'CH', 'CHE', '41', 0),
(217, 'Surinám', 'Suriname', 'Surinam', 'SR', 'SUR', '597', 0),
(218, 'Svalbard y Jan Mayen', 'Svalbard and Jan Mayen', 'Svalbard et Jan Mayen', 'SJ', 'SJM', '', 0),
(219, 'Swazilandia', 'Swaziland', 'Swaziland', 'SZ', 'SWZ', '268', 0),
(220, 'Tadjikistán', 'Tajikistan', 'Le Tadjikistan', 'TJ', 'TJK', '992', 0),
(221, 'Tailandia', 'Thailand', 'Thaïlande', 'TH', 'THA', '66', 0),
(222, 'Taiwán', 'Taiwan', 'Taiwan', 'TW', 'TWN', '886', 0),
(223, 'Tanzania', 'Tanzania', 'Tanzanie', 'TZ', 'TZA', '255', 0),
(224, 'Territorio Británico del Océano Índico', 'British Indian Ocean Territory', 'Territoire britannique de l\'océan Indien', 'IO', 'IOT', '', 0),
(225, 'Territorios Australes y Antárticas Franceses', 'French Southern Territories', 'Terres australes françaises', 'TF', 'ATF', '', 0),
(226, 'Timor Oriental', 'East Timor', 'Timor-Oriental', 'TL', 'TLS', '670', 0),
(227, 'Togo', 'Togo', 'Togo', 'TG', 'TGO', '228', 0),
(228, 'Tokelau', 'Tokelau', 'Tokélaou', 'TK', 'TKL', '690', 0),
(229, 'Tonga', 'Tonga', 'Tonga', 'TO', 'TON', '676', 0),
(230, 'Trinidad y Tobago', 'Trinidad and Tobago', 'Trinidad et Tobago', 'TT', 'TTO', '1 868', 0),
(231, 'Tunez', 'Tunisia', 'Tunisie', 'TN', 'TUN', '216', 0),
(232, 'Turkmenistán', 'Turkmenistan', 'Le Turkménistan', 'TM', 'TKM', '993', 0),
(233, 'Turquía', 'Turkey', 'Turquie', 'TR', 'TUR', '90', 0),
(234, 'Tuvalu', 'Tuvalu', 'Tuvalu', 'TV', 'TUV', '688', 0),
(235, 'Ucrania', 'Ukraine', 'L\'Ukraine', 'UA', 'UKR', '380', 0),
(236, 'Uganda', 'Uganda', 'Ouganda', 'UG', 'UGA', '256', 0),
(237, 'Uruguay', 'Uruguay', 'Uruguay', 'UY', 'URY', '598', 0),
(238, 'Uzbekistán', 'Uzbekistan', 'L\'Ouzbékistan', 'UZ', 'UZB', '998', 0),
(239, 'Vanuatu', 'Vanuatu', 'Vanuatu', 'VU', 'VUT', '678', 0),
(240, 'Venezuela', 'Venezuela', 'Venezuela', 'VE', 'VEN', '58', 0),
(241, 'Vietnam', 'Vietnam', 'Vietnam', 'VN', 'VNM', '84', 0),
(242, 'Wallis y Futuna', 'Wallis and Futuna', 'Wallis et Futuna', 'WF', 'WLF', '681', 0),
(243, 'Yemen', 'Yemen', 'Yémen', 'YE', 'YEM', '967', 0),
(244, 'Yibuti', 'Djibouti', 'Djibouti', 'DJ', 'DJI', '253', 0),
(245, 'Zambia', 'Zambia', 'Zambie', 'ZM', 'ZMB', '260', 0),
(246, 'Zimbabue', 'Zimbabwe', 'Zimbabwe', 'ZW', 'ZWE', '263', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantillas_documentacion`
--

DROP TABLE IF EXISTS `plantillas_documentacion`;
CREATE TABLE `plantillas_documentacion` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_plantilla_id` int(11) UNSIGNED NOT NULL,
  `html` text NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `plantillas_documentacion`
--

INSERT INTO `plantillas_documentacion` (`id`, `nombre`, `tipo_plantilla_id`, `html`, `descripcion`) VALUES
(2, 'Test de Cartel', 3, '<p>\n	<small class=\"col-sm-4\"><strong>Datos General:</strong> </small></p>\n<ul>\n	<li>\n		<small class=\"col-sm-4\">%general.f_actual_numero%: Fecha actual en formato num&eacute;rico</small></li>\n	<li>\n		<small class=\"col-sm-4\">%general.f_actual_texto%: Fecha actual en formato texto</small></li>\n</ul>\n<div>\n	<small class=\"col-sm-4\"><strong><small class=\"col-sm-4\"><strong>Datos Inmuebles:</strong> </small></strong></small>\n	<ul>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.referencia%: Referencia del inmueble</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.fecha_alta%: Fecha de alta del inmueble</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.nombre_tipo%: Tipo del inmueble</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.nombre_provincia%: Nombre de la provincia</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.nombre_poblacion%: Nombre del municipio</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.nombre_zona%: Nombre de la zona del municipio</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.direccion%: Direcci&oacute;n real del inmueble</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.metros%: Metros totales</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.metros_utiles%: Metros &uacute;tiles</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.habitaciones%: N&uacute;mero de habitaciones</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.banios%: N&uacute;mero de ba&ntilde;os</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.precio_compra%: Precio de compra</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.precio_compra_anterior%: Precio de compra anterior</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.precio_alquiler%: Precio alquiler</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.precio_alquiler_anterior%: Precio alquiler anterior</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.nombre_certificacion_energetica%: Certificaci&oacute;n energ&eacute;tica</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.direccion_publica%: Direcci&oacute;n mostrada en la zona p&uacute;blica</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.titulo_publico%: T&iacute;tulo mostrado en la zona p&uacute;blica</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.descripcion_publica%: Descripci&oacute;n extendida mostrada en la zona p&uacute;blica</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.url_seo%: URL SEO</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.descripcion_seo%: Descripci&oacute;n SEO</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.keywords_seo%: Palabras clave para el SEO</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.nombre_estado%: Estado</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.nombre_captador%: Nombre completo del captador</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.observaciones%: Observaciones</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.imagen_portada%: Imagen de la portada p&uacute;blica</small></li>\n		<li>\n			<small class=\"col-sm-4\">%inmuebles.codigo_qr%: C&oacute;digo QR del URL SEO de la zona p&uacute;blica</small></li>\n	</ul>\n</div>\n<div>\n	<small class=\"col-sm-4\"><strong>Datos Agentes Inmobiliarios:</strong> </small>\n	<ul>\n		<li>\n			<small class=\"col-sm-4\">%agentes.nombre%: Nombre del agente</small></li>\n		<li>\n			<small class=\"col-sm-4\">%agentes.apellidos%: Apellidos del agente</small></li>\n	</ul>\n</div>\n<div>\n	<img alt=\"\" src=\"%base_url%uploads/general/1_entrada.jpg\" style=\"width: 259px; height: 194px;\" /></div>\n', 'Ejemplo con todos los campos posibles a aplicar en un cartel'),
(4, 'Test de ficha del cliente', 2, '<p>\r\n	<small class=\"col-sm-4\"><strong>Datos General:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">%general.f_actual_numero%: Fecha actual en formato num&eacute;rico</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%general.f_actual_texto%: Fecha actual en formato texto</small></li>\r\n</ul>\r\n<p>\r\n	<small class=\"col-sm-4\"><strong>Datos Clientes:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">%clientes.nif%: NIF/NIE/CIF del cliente</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%clientes.nombre%: Nombre del cliente</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%clientes.apellidos%: Apellidos del cliente</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%clientes.fecha_nac%: Fecha de nacimiento</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%clientes.nombre_pais%: Nombre del pa&iacute;s donde reside</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%clientes.nombre_provincia%: Nombre de la provincia</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%clientes.nombre_poblacion%: Nombre del municipio</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%clientes.direccion%: Domicilio donde reside el cliente</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%clientes.correo%: Correo electr&oacute;nico</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%clientes.telefonos%: Tel&eacute;fonos de contacto</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%clientes.nombre_estado%: Estado</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%clientes.nombre_agente_asignado%: Nombre del agente asignado</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%clientes.observaciones%: Observaciones</small></li>\r\n</ul>\r\n<p>\r\n	<small class=\"col-sm-4\"><strong>Datos Agentes Inmobiliarios:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">%agentes.nombre%: Nombre del agente</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%agentes.apellidos%: Apellidos del agente</small></li>\r\n</ul>\r\n', 'Ejemplo con todos los campos posibles a aplicar en una ficha de un cliente'),
(6, 'Cartel Ejemplo', 3, '<p>\r\n	<span style=\"float: left;\">%carteles.codigo_qr%</span><img alt=\"\" src=\"http://openrs.es/demo/uploads/general/img/preferencias/logo-openrs-new.jpg\" style=\"width: 200px; height: 60px; float: right;\" /></p>\r\n<p style=\"text-align: center;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: center;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: center;\">\r\n	<strong><span style=\"font-size:20px;\"><span style=\"font-family: lucida sans unicode,lucida grande,sans-serif;\">%inmuebles.titulo_publico%</span></span></strong></p>\r\n<div>\r\n	<p style=\"text-align: center;\">\r\n		<span style=\"font-size:16px;\">%inmuebles.habitaciones% habitaciones, %inmuebles.banios% ba&ntilde;os, %inmuebles.precio_compra% &euro;</span></p>\r\n	<p style=\"text-align: center;\">\r\n		%inmuebles.imagen_portada%</p>\r\n	<p style=\"text-align: justify;\">\r\n		<span style=\"font-size:16px;\">%inmuebles.descripcion_publica%</span></p>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'Cartel con portada y pocos datos'),
(7, 'Test de ficha de inmueble', 1, '<p>\r\n	<small class=\"col-sm-4\"><strong>Datos General:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">%general.f_actual_numero%: Fecha actual en formato num&eacute;rico</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%general.f_actual_texto%: Fecha actual en formato texto</small></li>\r\n</ul>\r\n<div>\r\n	<small class=\"col-sm-4\"><small class=\"col-sm-4\"><strong>Datos Inmuebles:</strong> </small></small>\r\n	<ul>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.referencia%: Referencia del inmueble</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.fecha_alta%: Fecha de alta del inmueble</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.nombre_tipo%: Tipo del inmueble</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.nombre_provincia%: Nombre de la provincia</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.nombre_poblacion%: Nombre del municipio</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.nombre_zona%: Nombre de la zona del municipio</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.direccion%: Direcci&oacute;n real del inmueble</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.metros%: Metros totales</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.metros_utiles%: Metros &uacute;tiles</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.habitaciones%: N&uacute;mero de habitaciones</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.banios%: N&uacute;mero de ba&ntilde;os</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.precio_compra%: Precio de compra</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.precio_compra_anterior%: Precio de compra anterior</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.precio_alquiler%: Precio alquiler</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.precio_alquiler_anterior%: Precio alquiler anterior</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.nombre_certificacion_energetica%: Certificaci&oacute;n energ&eacute;tica</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.direccion_publica%: Direcci&oacute;n mostrada en la zona p&uacute;blica</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.titulo_publico%: T&iacute;tulo mostrado en la zona p&uacute;blica</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.descripcion_publica%: Descripci&oacute;n extendida mostrada en la zona p&uacute;blica</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.url_seo%: URL SEO</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.descripcion_seo%: Descripci&oacute;n SEO</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.keywords_seo%: Palabras clave para el SEO</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.nombre_estado%: Estado</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.nombre_captador%: Nombre completo del captador</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%inmuebles.observaciones%: Observaciones</small></li>\r\n	</ul>\r\n	<div>\r\n		<small class=\"col-sm-4\">%inmuebles.imagen_portada%</small></div>\r\n	<div>\r\n		&nbsp;</div>\r\n</div>\r\n<div>\r\n	<small class=\"col-sm-4\"><strong>Datos Agentes Inmobiliarios:</strong> </small>\r\n	<ul>\r\n		<li>\r\n			<small class=\"col-sm-4\">%agentes.nombre%: Nombre del agente</small></li>\r\n		<li>\r\n			<small class=\"col-sm-4\">%agentes.apellidos%: Apellidos del agente</small></li>\r\n	</ul>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'Ejemplo con todos los campos posibles a aplicar en una ficha de un inmueble'),
(8, 'Test de ficha de demanda', 5, '<p>\r\n	<small class=\"col-sm-4\"><strong>Datos General:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">%general.f_actual_numero%: Fecha actual en formato num&eacute;rico</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%general.f_actual_texto%: Fecha actual en formato texto</small></li>\r\n</ul>\r\n<p>\r\n	<small class=\"col-sm-4\"><strong>Datos Agentes Inmobiliarios:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">%agentes.nombre%: Nombre del agente</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%agentes.apellidos%: Apellidos del agente</small></li>\r\n</ul>\r\n<p>\r\n	<small class=\"col-sm-4\"><strong>Datos Demandas:</strong> </small></p>\r\n<ul>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.referencia%: Referencia de la demanda</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.fecha_alta%: Fecha de alta de la demanda</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.oferta%: Oferta demandada</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.tipo%: Tipo de demanda</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.nombre_cliente%: Nombre completo del cliente demandante</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.tipos_inmuebles%: Listado de tipos de inmuebles separados por comas</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.nombre_provincia%: Nombre de la provincia</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.nombre_poblacion%: Nombre del municipio</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.zonas%: Listado de zonas separados por comas</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.metros_desde%: Metros totales (desde)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.metros_hasta%: Metros totales (hasta)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.habitaciones_desde%: N&uacute;mero de habitaciones (desde)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.habitaciones_hasta%: N&uacute;mero de habitaciones (hasta)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.banios_desde%: N&uacute;mero de ba&ntilde;os (desde)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.banios_hasta%: N&uacute;mero de ba&ntilde;os (hasta)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.precio_desde%: Precio (desde)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.precio_hasta%: Precio (hasta)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.anio_construccion_desde%: A&ntilde;o construcci&oacute;n (desde)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.anio_construccion_hasta%: A&ntilde;o construcci&oacute;n (hasta)</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.nombre_certificacion_energetica%: Certificaci&oacute;n energ&eacute;tica m&iacute;nima</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.nombre_estado%: Estado</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.nombre_agente_asignado%: Nombre completo del agente asignado</small></li>\r\n	<li>\r\n		<small class=\"col-sm-4\">%demandas.observaciones%: Observaciones</small></li>\r\n</ul>\r\n', 'Ejemplo con todos los campos posibles a aplicar en una ficha de demanda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poblaciones`
--

DROP TABLE IF EXISTS `poblaciones`;
CREATE TABLE `poblaciones` (
  `id` int(11) UNSIGNED NOT NULL,
  `codigo` varchar(3) DEFAULT NULL,
  `cp` varchar(5) DEFAULT NULL,
  `poblacion` varchar(100) NOT NULL,
  `provincia_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `poblaciones`
--

INSERT INTO `poblaciones` (`id`, `codigo`, `cp`, `poblacion`, `provincia_id`) VALUES
(1, '51', '3', 'Agurain/Salvatierra', 1),
(2, '1', '4', 'Alegría-Dulantzi', 1),
(3, '2', '9', 'Amurrio', 1),
(4, '49', '3', 'Añana', 1),
(5, '3', '5', 'Aramaio', 1),
(6, '6', '6', 'Armiñón', 1),
(7, '37', '6', 'Arraia-Maeztu', 1),
(8, '8', '8', 'Arratzua-Ubarrundia', 1),
(9, '4', '0', 'Artziniega', 1),
(10, '9', '1', 'Asparrena', 1),
(11, '10', '5', 'Ayala/Aiara', 1),
(12, '11', '2', 'Baños de Ebro/Mañueta', 1),
(13, '13', '3', 'Barrundia', 1),
(14, '14', '8', 'Berantevilla', 1),
(15, '16', '4', 'Bernedo', 1),
(16, '17', '0', 'Campezo/Kanpezu', 1),
(17, '21', '0', 'Elburgo/Burgelu', 1),
(18, '22', '5', 'Elciego', 1),
(19, '23', '1', 'Elvillar/Bilar', 1),
(20, '46', '8', 'Erriberagoitia/Ribera Alta', 1),
(21, '56', '5', 'Harana/Valle de Arana', 1),
(22, '901', '5', 'Iruña Oka/Iruña de Oca', 1),
(23, '27', '8', 'Iruraiz-Gauna', 1),
(24, '19', '9', 'Kripan', 1),
(25, '20', '3', 'Kuartango', 1),
(26, '28', '4', 'Labastida/Bastida', 1),
(27, '30', '1', 'Lagrán', 1),
(28, '31', '8', 'Laguardia', 1),
(29, '32', '3', 'Lanciego/Lantziego', 1),
(30, '902', '0', 'Lantarón', 1),
(31, '33', '9', 'Lapuebla de Labarca', 1),
(32, '36', '0', 'Laudio/Llodio', 1),
(33, '58', '7', 'Legutio', 1),
(34, '34', '4', 'Leza', 1),
(35, '39', '5', 'Moreda de Álava/Moreda Araba', 1),
(36, '41', '6', 'Navaridas', 1),
(37, '42', '1', 'Okondo', 1),
(38, '43', '7', 'Oyón-Oion', 1),
(39, '44', '2', 'Peñacerrada-Urizaharra', 1),
(40, '47', '4', 'Ribera Baja/Erribera Beitia', 1),
(41, '52', '8', 'Samaniego', 1),
(42, '53', '4', 'San Millán/Donemiliaga', 1),
(43, '54', '9', 'Urkabustaiz', 1),
(44, '55', '2', 'Valdegovía/Gaubea', 1),
(45, '57', '1', 'Villabuena de Álava/Eskuernaga', 1),
(46, '59', '0', 'Vitoria-Gasteiz', 1),
(47, '60', '4', 'Yécora/Iekora', 1),
(48, '61', '1', 'Zalduondo', 1),
(49, '62', '6', 'Zambrana', 1),
(50, '18', '6', 'Zigoitia', 1),
(51, '63', '2', 'Zuia', 1),
(52, '1', '9', 'Abengibre', 2),
(53, '2', '4', 'Alatoz', 2),
(54, '3', '0', 'Albacete', 2),
(55, '4', '5', 'Albatana', 2),
(56, '5', '8', 'Alborea', 2),
(57, '6', '1', 'Alcadozo', 2),
(58, '7', '7', 'Alcalá del Júcar', 2),
(59, '8', '3', 'Alcaraz', 2),
(60, '9', '6', 'Almansa', 2),
(61, '10', '0', 'Alpera', 2),
(62, '11', '7', 'Ayna', 2),
(63, '12', '2', 'Balazote', 2),
(64, '14', '3', 'Ballestero, El', 2),
(65, '13', '8', 'Balsa de Ves', 2),
(66, '15', '6', 'Barrax', 2),
(67, '16', '9', 'Bienservida', 2),
(68, '17', '5', 'Bogarra', 2),
(69, '18', '1', 'Bonete', 2),
(70, '19', '4', 'Bonillo, El', 2),
(71, '20', '8', 'Carcelén', 2),
(72, '21', '5', 'Casas de Juan Núñez', 2),
(73, '22', '0', 'Casas de Lázaro', 2),
(74, '23', '6', 'Casas de Ves', 2),
(75, '24', '1', 'Casas-Ibáñez', 2),
(76, '25', '4', 'Caudete', 2),
(77, '26', '7', 'Cenizate', 2),
(78, '29', '2', 'Chinchilla de Monte-Aragón', 2),
(79, '27', '3', 'Corral-Rubio', 2),
(80, '28', '9', 'Cotillas', 2),
(81, '30', '6', 'Elche de la Sierra', 2),
(82, '31', '3', 'Férez', 2),
(83, '32', '8', 'Fuensanta', 2),
(84, '33', '4', 'Fuente-Álamo', 2),
(85, '34', '9', 'Fuentealbilla', 2),
(86, '35', '2', 'Gineta, La', 2),
(87, '36', '5', 'Golosalvo', 2),
(88, '37', '1', 'Hellín', 2),
(89, '38', '7', 'Herrera, La', 2),
(90, '39', '0', 'Higueruela', 2),
(91, '40', '4', 'Hoya-Gonzalo', 2),
(92, '41', '1', 'Jorquera', 2),
(93, '42', '6', 'Letur', 2),
(94, '43', '2', 'Lezuza', 2),
(95, '44', '7', 'Liétor', 2),
(96, '45', '0', 'Madrigueras', 2),
(97, '46', '3', 'Mahora', 2),
(98, '47', '9', 'Masegoso', 2),
(99, '48', '5', 'Minaya', 2),
(100, '49', '8', 'Molinicos', 2),
(101, '50', '1', 'Montalvos', 2),
(102, '51', '8', 'Montealegre del Castillo', 2),
(103, '52', '3', 'Motilleja', 2),
(104, '53', '9', 'Munera', 2),
(105, '54', '4', 'Navas de Jorquera', 2),
(106, '55', '7', 'Nerpio', 2),
(107, '56', '0', 'Ontur', 2),
(108, '57', '6', 'Ossa de Montiel', 2),
(109, '58', '2', 'Paterna del Madera', 2),
(110, '60', '9', 'Peñas de San Pedro', 2),
(111, '59', '5', 'Peñascosa', 2),
(112, '61', '6', 'Pétrola', 2),
(113, '62', '1', 'Povedilla', 2),
(114, '901', '0', 'Pozo Cañada', 2),
(115, '63', '7', 'Pozohondo', 2),
(116, '64', '2', 'Pozo-Lorente', 2),
(117, '65', '5', 'Pozuelo', 2),
(118, '66', '8', 'Recueja, La', 2),
(119, '67', '4', 'Riópar', 2),
(120, '68', '0', 'Robledo', 2),
(121, '69', '3', 'Roda, La', 2),
(122, '70', '7', 'Salobre', 2),
(123, '71', '4', 'San Pedro', 2),
(124, '72', '9', 'Socovos', 2),
(125, '73', '5', 'Tarazona de la Mancha', 2),
(126, '74', '0', 'Tobarra', 2),
(127, '75', '3', 'Valdeganga', 2),
(128, '76', '6', 'Vianos', 2),
(129, '77', '2', 'Villa de Ves', 2),
(130, '78', '8', 'Villalgordo del Júcar', 2),
(131, '79', '1', 'Villamalea', 2),
(132, '80', '5', 'Villapalacios', 2),
(133, '81', '2', 'Villarrobledo', 2),
(134, '82', '7', 'Villatoya', 2),
(135, '83', '3', 'Villavaliente', 2),
(136, '84', '8', 'Villaverde de Guadalimar', 2),
(137, '85', '1', 'Viveros', 2),
(138, '86', '4', 'Yeste', 2),
(139, '2', '0', 'Agost', 3),
(140, '3', '6', 'Agres', 3),
(141, '4', '1', 'Aigües', 3),
(142, '5', '4', 'Albatera', 3),
(143, '6', '7', 'Alcalalí', 3),
(144, '7', '3', 'Alcocer de Planes', 3),
(145, '8', '9', 'Alcoleja', 3),
(146, '9', '2', 'Alcoy/Alcoi', 3),
(147, '10', '6', 'Alfafara', 3),
(148, '11', '3', 'Alfàs del Pi, l\'', 3),
(149, '12', '8', 'Algorfa', 3),
(150, '13', '4', 'Algueña', 3),
(151, '14', '9', 'Alicante/Alacant', 3),
(152, '15', '2', 'Almoradí', 3),
(153, '16', '5', 'Almudaina', 3),
(154, '17', '1', 'Alqueria d\'Asnar, l\'', 3),
(155, '18', '7', 'Altea', 3),
(156, '19', '0', 'Aspe', 3),
(157, '1', '5', 'Atzúbia, l\'', 3),
(158, '20', '4', 'Balones', 3),
(159, '21', '1', 'Banyeres de Mariola', 3),
(160, '22', '6', 'Benasau', 3),
(161, '23', '2', 'Beneixama', 3),
(162, '24', '7', 'Benejúzar', 3),
(163, '25', '0', 'Benferri', 3),
(164, '26', '3', 'Beniarbeig', 3),
(165, '27', '9', 'Beniardá', 3),
(166, '28', '5', 'Beniarrés', 3),
(167, '30', '2', 'Benidoleig', 3),
(168, '31', '9', 'Benidorm', 3),
(169, '32', '4', 'Benifallim', 3),
(170, '33', '0', 'Benifato', 3),
(171, '29', '8', 'Benigembla', 3),
(172, '34', '5', 'Benijófar', 3),
(173, '35', '8', 'Benilloba', 3),
(174, '36', '1', 'Benillup', 3),
(175, '37', '7', 'Benimantell', 3),
(176, '38', '3', 'Benimarfull', 3),
(177, '39', '6', 'Benimassot', 3),
(178, '40', '0', 'Benimeli', 3),
(179, '41', '7', 'Benissa', 3),
(180, '42', '2', 'Benitachell/Poble Nou de Benitatxell, el', 3),
(181, '43', '8', 'Biar', 3),
(182, '44', '3', 'Bigastro', 3),
(183, '45', '6', 'Bolulla', 3),
(184, '46', '9', 'Busot', 3),
(185, '49', '4', 'Callosa de Segura', 3),
(186, '48', '1', 'Callosa d\'en Sarrià', 3),
(187, '47', '5', 'Calp', 3),
(188, '50', '7', 'Campello, el', 3),
(189, '51', '4', 'Campo de Mirra/Camp de Mirra, el', 3),
(190, '52', '9', 'Cañada', 3),
(191, '53', '5', 'Castalla', 3),
(192, '54', '0', 'Castell de Castells', 3),
(193, '75', '9', 'Castell de Guadalest, el', 3),
(194, '55', '3', 'Catral', 3),
(195, '56', '6', 'Cocentaina', 3),
(196, '57', '2', 'Confrides', 3),
(197, '58', '8', 'Cox', 3),
(198, '59', '1', 'Crevillent', 3),
(199, '61', '2', 'Daya Nueva', 3),
(200, '62', '7', 'Daya Vieja', 3),
(201, '63', '3', 'Dénia', 3),
(202, '64', '8', 'Dolores', 3),
(203, '65', '1', 'Elche/Elx', 3),
(204, '66', '4', 'Elda', 3),
(205, '67', '0', 'Facheca', 3),
(206, '68', '6', 'Famorca', 3),
(207, '69', '9', 'Finestrat', 3),
(208, '77', '8', 'Fondó de les Neus, el/Hondón de las Nieves', 3),
(209, '70', '3', 'Formentera del Segura', 3),
(210, '72', '5', 'Gaianes', 3),
(211, '71', '0', 'Gata de Gorgos', 3),
(212, '73', '1', 'Gorga', 3),
(213, '74', '6', 'Granja de Rocamora', 3),
(214, '76', '2', 'Guardamar del Segura', 3),
(215, '78', '4', 'Hondón de los Frailes', 3),
(216, '79', '7', 'Ibi', 3),
(217, '80', '1', 'Jacarilla', 3),
(218, '82', '3', 'Jávea/Xàbia', 3),
(219, '83', '9', 'Jijona/Xixona', 3),
(220, '85', '7', 'Llíber', 3),
(221, '84', '4', 'Lorcha/Orxa, l\'', 3),
(222, '86', '0', 'Millena', 3),
(223, '88', '2', 'Monforte del Cid', 3),
(224, '89', '5', 'Monóvar/Monòver', 3),
(225, '903', '7', 'Montesinos, Los', 3),
(226, '91', '6', 'Murla', 3),
(227, '92', '1', 'Muro de Alcoy', 3),
(228, '90', '9', 'Mutxamel', 3),
(229, '93', '7', 'Novelda', 3),
(230, '94', '2', 'Nucia, la', 3),
(231, '95', '5', 'Ondara', 3),
(232, '96', '8', 'Onil', 3),
(233, '97', '4', 'Orba', 3),
(234, '99', '3', 'Orihuela', 3),
(235, '98', '0', 'Orxeta', 3),
(236, '100', '7', 'Parcent', 3),
(237, '101', '4', 'Pedreguer', 3),
(238, '102', '9', 'Pego', 3),
(239, '103', '5', 'Penàguila', 3),
(240, '104', '0', 'Petrer', 3),
(241, '902', '1', 'Pilar de la Horadada', 3),
(242, '105', '3', 'Pinós, el/Pinoso', 3),
(243, '106', '6', 'Planes', 3),
(244, '901', '6', 'Poblets, els', 3),
(245, '107', '2', 'Polop', 3),
(246, '60', '5', 'Quatretondeta', 3),
(247, '109', '1', 'Rafal', 3),
(248, '110', '5', 'Ràfol d\'Almúnia, el', 3),
(249, '111', '2', 'Redován', 3),
(250, '112', '7', 'Relleu', 3),
(251, '113', '3', 'Rojales', 3),
(252, '114', '8', 'Romana, la', 3),
(253, '115', '1', 'Sagra', 3),
(254, '116', '4', 'Salinas', 3),
(255, '118', '6', 'San Fulgencio', 3),
(256, '904', '2', 'San Isidro', 3),
(257, '120', '3', 'San Miguel de Salinas', 3),
(258, '122', '5', 'San Vicente del Raspeig/Sant Vicent del Raspeig', 3),
(259, '117', '0', 'Sanet y Negrals', 3),
(260, '119', '9', 'Sant Joan d\'Alacant', 3),
(261, '121', '0', 'Santa Pola', 3),
(262, '123', '1', 'Sax', 3),
(263, '124', '6', 'Sella', 3),
(264, '125', '9', 'Senija', 3),
(265, '127', '8', 'Tàrbena', 3),
(266, '128', '4', 'Teulada', 3),
(267, '129', '7', 'Tibi', 3),
(268, '130', '1', 'Tollos', 3),
(269, '131', '8', 'Tormos', 3),
(270, '132', '3', 'Torremanzanas/Torre de les Maçanes, la', 3),
(271, '133', '9', 'Torrevieja', 3),
(272, '134', '4', 'Vall d\'Alcalà, la', 3),
(273, '136', '0', 'Vall de Gallinera', 3),
(274, '137', '6', 'Vall de Laguar, la', 3),
(275, '135', '7', 'Vall d\'Ebo, la', 3),
(276, '138', '2', 'Verger, el', 3),
(277, '139', '5', 'Villajoyosa/Vila Joiosa, la', 3),
(278, '140', '9', 'Villena', 3),
(279, '81', '8', 'Xaló', 3),
(280, '1', '0', 'Abla', 4),
(281, '2', '5', 'Abrucena', 4),
(282, '3', '1', 'Adra', 4),
(283, '4', '6', 'Albánchez', 4),
(284, '5', '9', 'Alboloduy', 4),
(285, '6', '2', 'Albox', 4),
(286, '7', '8', 'Alcolea', 4),
(287, '8', '4', 'Alcóntar', 4),
(288, '9', '7', 'Alcudia de Monteagud', 4),
(289, '10', '1', 'Alhabia', 4),
(290, '11', '8', 'Alhama de Almería', 4),
(291, '12', '3', 'Alicún', 4),
(292, '13', '9', 'Almería', 4),
(293, '14', '4', 'Almócita', 4),
(294, '15', '7', 'Alsodux', 4),
(295, '16', '0', 'Antas', 4),
(296, '17', '6', 'Arboleas', 4),
(297, '18', '2', 'Armuña de Almanzora', 4),
(298, '19', '5', 'Bacares', 4),
(299, '904', '7', 'Balanegra', 4),
(300, '20', '9', 'Bayárcal', 4),
(301, '21', '6', 'Bayarque', 4),
(302, '22', '1', 'Bédar', 4),
(303, '23', '7', 'Beires', 4),
(304, '24', '2', 'Benahadux', 4),
(305, '26', '8', 'Benitagla', 4),
(306, '27', '4', 'Benizalón', 4),
(307, '28', '0', 'Bentarique', 4),
(308, '29', '3', 'Berja', 4),
(309, '30', '7', 'Canjáyar', 4),
(310, '31', '4', 'Cantoria', 4),
(311, '32', '9', 'Carboneras', 4),
(312, '33', '5', 'Castro de Filabres', 4),
(313, '36', '6', 'Chercos', 4),
(314, '37', '2', 'Chirivel', 4),
(315, '34', '0', 'Cóbdar', 4),
(316, '35', '3', 'Cuevas del Almanzora', 4),
(317, '38', '8', 'Dalías', 4),
(318, '902', '6', 'Ejido, El', 4),
(319, '41', '2', 'Enix', 4),
(320, '43', '3', 'Felix', 4),
(321, '44', '8', 'Fines', 4),
(322, '45', '1', 'Fiñana', 4),
(323, '46', '4', 'Fondón', 4),
(324, '47', '0', 'Gádor', 4),
(325, '48', '6', 'Gallardos, Los', 4),
(326, '49', '9', 'Garrucha', 4),
(327, '50', '2', 'Gérgal', 4),
(328, '51', '9', 'Huécija', 4),
(329, '52', '4', 'Huércal de Almería', 4),
(330, '53', '0', 'Huércal-Overa', 4),
(331, '54', '5', 'Íllar', 4),
(332, '55', '8', 'Instinción', 4),
(333, '56', '1', 'Laroya', 4),
(334, '57', '7', 'Láujar de Andarax', 4),
(335, '58', '3', 'Líjar', 4),
(336, '59', '6', 'Lubrín', 4),
(337, '60', '0', 'Lucainena de las Torres', 4),
(338, '61', '7', 'Lúcar', 4),
(339, '62', '2', 'Macael', 4),
(340, '63', '8', 'María', 4),
(341, '64', '3', 'Mojácar', 4),
(342, '903', '2', 'Mojonera, La', 4),
(343, '65', '6', 'Nacimiento', 4),
(344, '66', '9', 'Níjar', 4),
(345, '67', '5', 'Ohanes', 4),
(346, '68', '1', 'Olula de Castro', 4),
(347, '69', '4', 'Olula del Río', 4),
(348, '70', '8', 'Oria', 4),
(349, '71', '5', 'Padules', 4),
(350, '72', '0', 'Partaloa', 4),
(351, '73', '6', 'Paterna del Río', 4),
(352, '74', '1', 'Pechina', 4),
(353, '75', '4', 'Pulpí', 4),
(354, '76', '7', 'Purchena', 4),
(355, '77', '3', 'Rágol', 4),
(356, '78', '9', 'Rioja', 4),
(357, '79', '2', 'Roquetas de Mar', 4),
(358, '80', '6', 'Santa Cruz de Marchena', 4),
(359, '81', '3', 'Santa Fe de Mondújar', 4),
(360, '82', '8', 'Senés', 4),
(361, '83', '4', 'Serón', 4),
(362, '84', '9', 'Sierro', 4),
(363, '85', '2', 'Somontín', 4),
(364, '86', '5', 'Sorbas', 4),
(365, '87', '1', 'Suflí', 4),
(366, '88', '7', 'Tabernas', 4),
(367, '89', '0', 'Taberno', 4),
(368, '90', '4', 'Tahal', 4),
(369, '91', '1', 'Terque', 4),
(370, '92', '6', 'Tíjola', 4),
(371, '901', '1', 'Tres Villas, Las', 4),
(372, '93', '2', 'Turre', 4),
(373, '94', '7', 'Turrillas', 4),
(374, '95', '0', 'Uleila del Campo', 4),
(375, '96', '3', 'Urrácal', 4),
(376, '97', '9', 'Velefique', 4),
(377, '98', '5', 'Vélez-Blanco', 4),
(378, '99', '8', 'Vélez-Rubio', 4),
(379, '100', '2', 'Vera', 4),
(380, '101', '9', 'Viator', 4),
(381, '102', '4', 'Vícar', 4),
(382, '103', '0', 'Zurgena', 4),
(383, '1', '3', 'Adanero', 5),
(384, '2', '8', 'Adrada, La', 5),
(385, '5', '2', 'Albornos', 5),
(386, '7', '1', 'Aldeanueva de Santa Cruz', 5),
(387, '8', '7', 'Aldeaseca', 5),
(388, '10', '4', 'Aldehuela, La', 5),
(389, '12', '6', 'Amavida', 5),
(390, '13', '2', 'Arenal, El', 5),
(391, '14', '7', 'Arenas de San Pedro', 5),
(392, '15', '0', 'Arevalillo', 5),
(393, '16', '3', 'Arévalo', 5),
(394, '17', '9', 'Aveinte', 5),
(395, '18', '5', 'Avellaneda', 5),
(396, '19', '8', 'Ávila', 5),
(397, '21', '9', 'Barco de Ávila, El', 5),
(398, '22', '4', 'Barraco, El', 5),
(399, '23', '0', 'Barromán', 5),
(400, '24', '5', 'Becedas', 5),
(401, '25', '8', 'Becedillas', 5),
(402, '26', '1', 'Bercial de Zapardiel', 5),
(403, '27', '7', 'Berlanas, Las', 5),
(404, '29', '6', 'Bernuy-Zapardiel', 5),
(405, '30', '0', 'Berrocalejo de Aragona', 5),
(406, '33', '8', 'Blascomillán', 5),
(407, '34', '3', 'Blasconuño de Matacabras', 5),
(408, '35', '6', 'Blascosancho', 5),
(409, '36', '9', 'Bohodón, El', 5),
(410, '37', '5', 'Bohoyo', 5),
(411, '38', '1', 'Bonilla de la Sierra', 5),
(412, '39', '4', 'Brabos', 5),
(413, '40', '8', 'Bularros', 5),
(414, '41', '5', 'Burgohondo', 5),
(415, '42', '0', 'Cabezas de Alambre', 5),
(416, '43', '6', 'Cabezas del Pozo', 5),
(417, '44', '1', 'Cabezas del Villar', 5),
(418, '45', '4', 'Cabizuela', 5),
(419, '46', '7', 'Canales', 5),
(420, '47', '3', 'Candeleda', 5),
(421, '48', '9', 'Cantiveros', 5),
(422, '49', '2', 'Cardeñosa', 5),
(423, '51', '2', 'Carrera, La', 5),
(424, '52', '7', 'Casas del Puerto', 5),
(425, '53', '3', 'Casasola', 5),
(426, '54', '8', 'Casavieja', 5),
(427, '55', '1', 'Casillas', 5),
(428, '56', '4', 'Castellanos de Zapardiel', 5),
(429, '57', '0', 'Cebreros', 5),
(430, '58', '6', 'Cepeda la Mora', 5),
(431, '67', '8', 'Chamartín', 5),
(432, '59', '9', 'Cillán', 5),
(433, '60', '3', 'Cisla', 5),
(434, '61', '0', 'Colilla, La', 5),
(435, '62', '5', 'Collado de Contreras', 5),
(436, '63', '1', 'Collado del Mirón', 5),
(437, '64', '6', 'Constanzana', 5),
(438, '65', '9', 'Crespos', 5),
(439, '66', '2', 'Cuevas del Valle', 5),
(440, '903', '5', 'Diego del Carpio', 5),
(441, '69', '7', 'Donjimeno', 5),
(442, '70', '1', 'Donvidas', 5),
(443, '72', '3', 'Espinosa de los Caballeros', 5),
(444, '73', '9', 'Flores de Ávila', 5),
(445, '74', '4', 'Fontiveros', 5),
(446, '75', '7', 'Fresnedilla', 5),
(447, '76', '0', 'Fresno, El', 5),
(448, '77', '6', 'Fuente el Saúz', 5),
(449, '78', '2', 'Fuentes de Año', 5),
(450, '79', '5', 'Gallegos de Altamiros', 5),
(451, '80', '9', 'Gallegos de Sobrinos', 5),
(452, '81', '6', 'Garganta del Villar', 5),
(453, '82', '1', 'Gavilanes', 5),
(454, '83', '7', 'Gemuño', 5),
(455, '85', '5', 'Gil García', 5),
(456, '84', '2', 'Gilbuena', 5),
(457, '86', '8', 'Gimialcón', 5),
(458, '87', '4', 'Gotarrendura', 5),
(459, '88', '0', 'Grandes y San Martín', 5),
(460, '89', '3', 'Guisando', 5),
(461, '90', '7', 'Gutierre-Muñoz', 5),
(462, '92', '9', 'Hernansancho', 5),
(463, '93', '5', 'Herradón de Pinares', 5),
(464, '94', '0', 'Herreros de Suso', 5),
(465, '95', '3', 'Higuera de las Dueñas', 5),
(466, '96', '6', 'Hija de Dios, La', 5),
(467, '97', '2', 'Horcajada, La', 5),
(468, '99', '1', 'Horcajo de las Torres', 5),
(469, '100', '5', 'Hornillo, El', 5),
(470, '102', '7', 'Hoyo de Pinares, El', 5),
(471, '101', '2', 'Hoyocasero', 5),
(472, '103', '3', 'Hoyorredondo', 5),
(473, '106', '4', 'Hoyos de Miguel Muñoz', 5),
(474, '104', '8', 'Hoyos del Collado', 5),
(475, '105', '1', 'Hoyos del Espino', 5),
(476, '107', '0', 'Hurtumpascual', 5),
(477, '108', '6', 'Junciana', 5),
(478, '109', '9', 'Langa', 5),
(479, '110', '3', 'Lanzahíta', 5),
(480, '113', '1', 'Llanos de Tormes, Los', 5),
(481, '112', '5', 'Losar del Barco, El', 5),
(482, '114', '6', 'Madrigal de las Altas Torres', 5),
(483, '115', '9', 'Maello', 5),
(484, '116', '2', 'Malpartida de Corneja', 5),
(485, '117', '8', 'Mamblas', 5),
(486, '118', '4', 'Mancera de Arriba', 5),
(487, '119', '7', 'Manjabálago y Ortigosa de Rioalmar', 5),
(488, '120', '1', 'Marlín', 5),
(489, '121', '8', 'Martiherrero', 5),
(490, '122', '3', 'Martínez', 5),
(491, '123', '9', 'Mediana de Voltoya', 5),
(492, '124', '4', 'Medinilla', 5),
(493, '125', '7', 'Mengamuñoz', 5),
(494, '126', '0', 'Mesegar de Corneja', 5),
(495, '127', '6', 'Mijares', 5),
(496, '128', '2', 'Mingorría', 5),
(497, '129', '5', 'Mirón, El', 5),
(498, '130', '9', 'Mironcillo', 5),
(499, '131', '6', 'Mirueña de los Infanzones', 5),
(500, '132', '1', 'Mombeltrán', 5),
(501, '133', '7', 'Monsalupe', 5),
(502, '134', '2', 'Moraleja de Matacabras', 5),
(503, '135', '5', 'Muñana', 5),
(504, '136', '8', 'Muñico', 5),
(505, '138', '0', 'Muñogalindo', 5),
(506, '139', '3', 'Muñogrande', 5),
(507, '140', '7', 'Muñomer del Peco', 5),
(508, '141', '4', 'Muñopepe', 5),
(509, '142', '9', 'Muñosancho', 5),
(510, '143', '5', 'Muñotello', 5),
(511, '144', '0', 'Narrillos del Álamo', 5),
(512, '145', '3', 'Narrillos del Rebollar', 5),
(513, '149', '1', 'Narros de Saldueña', 5),
(514, '147', '2', 'Narros del Castillo', 5),
(515, '148', '8', 'Narros del Puerto', 5),
(516, '152', '6', 'Nava de Arévalo', 5),
(517, '153', '2', 'Nava del Barco', 5),
(518, '151', '1', 'Navacepedilla de Corneja', 5),
(519, '154', '7', 'Navadijos', 5),
(520, '155', '0', 'Navaescurial', 5),
(521, '156', '3', 'Navahondilla', 5),
(522, '157', '9', 'Navalacruz', 5),
(523, '158', '5', 'Navalmoral', 5),
(524, '159', '8', 'Navalonguilla', 5),
(525, '160', '2', 'Navalosa', 5),
(526, '161', '9', 'Navalperal de Pinares', 5),
(527, '162', '4', 'Navalperal de Tormes', 5),
(528, '163', '0', 'Navaluenga', 5),
(529, '164', '5', 'Navaquesera', 5),
(530, '165', '8', 'Navarredonda de Gredos', 5),
(531, '166', '1', 'Navarredondilla', 5),
(532, '167', '7', 'Navarrevisca', 5),
(533, '168', '3', 'Navas del Marqués, Las', 5),
(534, '169', '6', 'Navatalgordo', 5),
(535, '170', '0', 'Navatejares', 5),
(536, '171', '7', 'Neila de San Miguel', 5),
(537, '172', '2', 'Niharra', 5),
(538, '173', '8', 'Ojos-Albos', 5),
(539, '174', '3', 'Orbita', 5),
(540, '175', '6', 'Oso, El', 5),
(541, '176', '9', 'Padiernos', 5),
(542, '177', '5', 'Pajares de Adaja', 5),
(543, '178', '1', 'Palacios de Goda', 5),
(544, '179', '4', 'Papatrigo', 5),
(545, '180', '8', 'Parral, El', 5),
(546, '181', '5', 'Pascualcobo', 5),
(547, '182', '0', 'Pedro Bernardo', 5),
(548, '183', '6', 'Pedro-Rodríguez', 5),
(549, '184', '1', 'Peguerinos', 5),
(550, '185', '4', 'Peñalba de Ávila', 5),
(551, '186', '7', 'Piedrahíta', 5),
(552, '187', '3', 'Piedralaves', 5),
(553, '188', '9', 'Poveda', 5),
(554, '189', '2', 'Poyales del Hoyo', 5),
(555, '190', '6', 'Pozanco', 5),
(556, '191', '3', 'Pradosegar', 5),
(557, '192', '8', 'Puerto Castilla', 5),
(558, '193', '4', 'Rasueros', 5),
(559, '194', '9', 'Riocabado', 5),
(560, '195', '2', 'Riofrío', 5),
(561, '196', '5', 'Rivilla de Barajas', 5),
(562, '197', '1', 'Salobral', 5),
(563, '198', '7', 'Salvadiós', 5),
(564, '199', '0', 'San Bartolomé de Béjar', 5),
(565, '200', '4', 'San Bartolomé de Corneja', 5),
(566, '201', '1', 'San Bartolomé de Pinares', 5),
(567, '206', '3', 'San Esteban de los Patos', 5),
(568, '208', '5', 'San Esteban de Zapardiel', 5),
(569, '207', '9', 'San Esteban del Valle', 5),
(570, '209', '8', 'San García de Ingelmos', 5),
(571, '901', '4', 'San Juan de Gredos', 5),
(572, '210', '2', 'San Juan de la Encinilla', 5),
(573, '211', '9', 'San Juan de la Nava', 5),
(574, '212', '4', 'San Juan del Molinillo', 5),
(575, '213', '0', 'San Juan del Olmo', 5),
(576, '214', '5', 'San Lorenzo de Tormes', 5),
(577, '215', '8', 'San Martín de la Vega del Alberche', 5),
(578, '216', '1', 'San Martín del Pimpollar', 5),
(579, '217', '7', 'San Miguel de Corneja', 5),
(580, '218', '3', 'San Miguel de Serrezuela', 5),
(581, '219', '6', 'San Pascual', 5),
(582, '220', '0', 'San Pedro del Arroyo', 5),
(583, '231', '5', 'San Vicente de Arévalo', 5),
(584, '204', '7', 'Sanchidrián', 5),
(585, '205', '0', 'Sanchorreja', 5),
(586, '222', '2', 'Santa Cruz de Pinares', 5),
(587, '221', '7', 'Santa Cruz del Valle', 5),
(588, '226', '9', 'Santa María de los Caballeros', 5),
(589, '224', '3', 'Santa María del Arroyo', 5),
(590, '225', '6', 'Santa María del Berrocal', 5),
(591, '902', '9', 'Santa María del Cubillo', 5),
(592, '227', '5', 'Santa María del Tiétar', 5),
(593, '228', '1', 'Santiago del Collado', 5),
(594, '904', '0', 'Santiago del Tormes', 5),
(595, '229', '4', 'Santo Domingo de las Posadas', 5),
(596, '230', '8', 'Santo Tomé de Zabarcos', 5),
(597, '232', '0', 'Serrada, La', 5),
(598, '233', '6', 'Serranillos', 5),
(599, '234', '1', 'Sigeres', 5),
(600, '235', '4', 'Sinlabajos', 5),
(601, '236', '7', 'Solana de Ávila', 5),
(602, '237', '3', 'Solana de Rioalmar', 5),
(603, '238', '9', 'Solosancho', 5),
(604, '239', '2', 'Sotalbo', 5),
(605, '240', '6', 'Sotillo de la Adrada', 5),
(606, '241', '3', 'Tiemblo, El', 5),
(607, '242', '8', 'Tiñosillos', 5),
(608, '243', '4', 'Tolbaños', 5),
(609, '244', '9', 'Tormellas', 5),
(610, '245', '2', 'Tornadizos de Ávila', 5),
(611, '247', '1', 'Torre, La', 5),
(612, '246', '5', 'Tórtoles', 5),
(613, '249', '0', 'Umbrías', 5),
(614, '251', '0', 'Vadillo de la Sierra', 5),
(615, '252', '5', 'Valdecasa', 5),
(616, '253', '1', 'Vega de Santa María', 5),
(617, '254', '6', 'Velayos', 5),
(618, '256', '2', 'Villaflor', 5),
(619, '257', '8', 'Villafranca de la Sierra', 5),
(620, '905', '3', 'Villanueva de Ávila', 5),
(621, '258', '4', 'Villanueva de Gómez', 5),
(622, '259', '7', 'Villanueva del Aceral', 5),
(623, '260', '1', 'Villanueva del Campillo', 5),
(624, '261', '8', 'Villar de Corneja', 5),
(625, '262', '3', 'Villarejo del Valle', 5),
(626, '263', '9', 'Villatoro', 5),
(627, '264', '4', 'Viñegra de Moraña', 5),
(628, '265', '7', 'Vita', 5),
(629, '266', '0', 'Zapardiel de la Cañada', 5),
(630, '267', '6', 'Zapardiel de la Ribera', 5),
(631, '1', '6', 'Acedera', 6),
(632, '2', '1', 'Aceuchal', 6),
(633, '3', '7', 'Ahillones', 6),
(634, '4', '2', 'Alange', 6),
(635, '5', '5', 'Albuera, La', 6),
(636, '6', '8', 'Alburquerque', 6),
(637, '7', '4', 'Alconchel', 6),
(638, '8', '0', 'Alconera', 6),
(639, '9', '3', 'Aljucén', 6),
(640, '10', '7', 'Almendral', 6),
(641, '11', '4', 'Almendralejo', 6),
(642, '12', '9', 'Arroyo de San Serván', 6),
(643, '13', '5', 'Atalaya', 6),
(644, '14', '0', 'Azuaga', 6),
(645, '15', '3', 'Badajoz', 6),
(646, '16', '6', 'Barcarrota', 6),
(647, '17', '2', 'Baterno', 6),
(648, '18', '8', 'Benquerencia de la Serena', 6),
(649, '19', '1', 'Berlanga', 6),
(650, '20', '5', 'Bienvenida', 6),
(651, '21', '2', 'Bodonal de la Sierra', 6),
(652, '22', '7', 'Burguillos del Cerro', 6),
(653, '23', '3', 'Cabeza del Buey', 6),
(654, '24', '8', 'Cabeza la Vaca', 6),
(655, '25', '1', 'Calamonte', 6),
(656, '26', '4', 'Calera de León', 6),
(657, '27', '0', 'Calzadilla de los Barros', 6),
(658, '28', '6', 'Campanario', 6),
(659, '29', '9', 'Campillo de Llerena', 6),
(660, '30', '3', 'Capilla', 6),
(661, '31', '0', 'Carmonita', 6),
(662, '32', '5', 'Carrascalejo, El', 6),
(663, '33', '1', 'Casas de Don Pedro', 6),
(664, '34', '6', 'Casas de Reina', 6),
(665, '35', '9', 'Castilblanco', 6),
(666, '36', '2', 'Castuera', 6),
(667, '42', '3', 'Cheles', 6),
(668, '37', '8', 'Codosera, La', 6),
(669, '38', '4', 'Cordobilla de Lácara', 6),
(670, '39', '7', 'Coronada, La', 6),
(671, '40', '1', 'Corte de Peleas', 6),
(672, '41', '8', 'Cristina', 6),
(673, '43', '9', 'Don Álvaro', 6),
(674, '44', '4', 'Don Benito', 6),
(675, '45', '7', 'Entrín Bajo', 6),
(676, '46', '0', 'Esparragalejo', 6),
(677, '47', '6', 'Esparragosa de la Serena', 6),
(678, '48', '2', 'Esparragosa de Lares', 6),
(679, '49', '5', 'Feria', 6),
(680, '50', '8', 'Fregenal de la Sierra', 6),
(681, '51', '5', 'Fuenlabrada de los Montes', 6),
(682, '52', '0', 'Fuente de Cantos', 6),
(683, '53', '6', 'Fuente del Arco', 6),
(684, '54', '1', 'Fuente del Maestre', 6),
(685, '55', '4', 'Fuentes de León', 6),
(686, '56', '7', 'Garbayuela', 6),
(687, '57', '3', 'Garlitos', 6),
(688, '58', '9', 'Garrovilla, La', 6),
(689, '59', '2', 'Granja de Torrehermosa', 6),
(690, '903', '8', 'Guadiana del Caudillo', 6),
(691, '60', '6', 'Guareña', 6),
(692, '61', '3', 'Haba, La', 6),
(693, '62', '8', 'Helechosa de los Montes', 6),
(694, '63', '4', 'Herrera del Duque', 6),
(695, '64', '9', 'Higuera de la Serena', 6),
(696, '65', '2', 'Higuera de Llerena', 6),
(697, '66', '5', 'Higuera de Vargas', 6),
(698, '67', '1', 'Higuera la Real', 6),
(699, '68', '7', 'Hinojosa del Valle', 6),
(700, '69', '0', 'Hornachos', 6),
(701, '70', '4', 'Jerez de los Caballeros', 6),
(702, '71', '1', 'Lapa, La', 6),
(703, '73', '2', 'Llera', 6),
(704, '74', '7', 'Llerena', 6),
(705, '72', '6', 'Lobón', 6),
(706, '75', '0', 'Magacela', 6),
(707, '76', '3', 'Maguilla', 6),
(708, '77', '9', 'Malcocinado', 6),
(709, '78', '5', 'Malpartida de la Serena', 6),
(710, '79', '8', 'Manchita', 6),
(711, '80', '2', 'Medellín', 6),
(712, '81', '9', 'Medina de las Torres', 6),
(713, '82', '4', 'Mengabril', 6),
(714, '83', '0', 'Mérida', 6),
(715, '84', '5', 'Mirandilla', 6),
(716, '85', '8', 'Monesterio', 6),
(717, '86', '1', 'Montemolín', 6),
(718, '87', '7', 'Monterrubio de la Serena', 6),
(719, '88', '3', 'Montijo', 6),
(720, '89', '6', 'Morera, La', 6),
(721, '90', '0', 'Nava de Santiago, La', 6),
(722, '91', '7', 'Navalvillar de Pela', 6),
(723, '92', '2', 'Nogales', 6),
(724, '93', '8', 'Oliva de la Frontera', 6),
(725, '94', '3', 'Oliva de Mérida', 6),
(726, '95', '6', 'Olivenza', 6),
(727, '96', '9', 'Orellana de la Sierra', 6),
(728, '97', '5', 'Orellana la Vieja', 6),
(729, '98', '1', 'Palomas', 6),
(730, '99', '4', 'Parra, La', 6),
(731, '100', '8', 'Peñalsordo', 6),
(732, '101', '5', 'Peraleda del Zaucejo', 6),
(733, '102', '0', 'Puebla de Alcocer', 6),
(734, '103', '6', 'Puebla de la Calzada', 6),
(735, '104', '1', 'Puebla de la Reina', 6),
(736, '107', '3', 'Puebla de Obando', 6),
(737, '108', '9', 'Puebla de Sancho Pérez', 6),
(738, '105', '4', 'Puebla del Maestre', 6),
(739, '106', '7', 'Puebla del Prior', 6),
(740, '902', '2', 'Pueblonuevo del Guadiana', 6),
(741, '109', '2', 'Quintana de la Serena', 6),
(742, '110', '6', 'Reina', 6),
(743, '111', '3', 'Rena', 6),
(744, '112', '8', 'Retamal de Llerena', 6),
(745, '113', '4', 'Ribera del Fresno', 6),
(746, '114', '9', 'Risco', 6),
(747, '115', '2', 'Roca de la Sierra, La', 6),
(748, '116', '5', 'Salvaleón', 6),
(749, '117', '1', 'Salvatierra de los Barros', 6),
(750, '119', '0', 'San Pedro de Mérida', 6),
(751, '123', '2', 'San Vicente de Alcántara', 6),
(752, '118', '7', 'Sancti-Spíritus', 6),
(753, '120', '4', 'Santa Amalia', 6),
(754, '121', '1', 'Santa Marta', 6),
(755, '122', '6', 'Santos de Maimona, Los', 6),
(756, '124', '7', 'Segura de León', 6),
(757, '125', '0', 'Siruela', 6),
(758, '126', '3', 'Solana de los Barros', 6),
(759, '127', '9', 'Talarrubias', 6),
(760, '128', '5', 'Talavera la Real', 6),
(761, '129', '8', 'Táliga', 6),
(762, '130', '2', 'Tamurejo', 6),
(763, '131', '9', 'Torre de Miguel Sesmero', 6),
(764, '132', '4', 'Torremayor', 6),
(765, '133', '0', 'Torremejía', 6),
(766, '134', '5', 'Trasierra', 6),
(767, '135', '8', 'Trujillanos', 6),
(768, '136', '1', 'Usagre', 6),
(769, '137', '7', 'Valdecaballeros', 6),
(770, '901', '7', 'Valdelacalzada', 6),
(771, '138', '3', 'Valdetorres', 6),
(772, '139', '6', 'Valencia de las Torres', 6),
(773, '140', '0', 'Valencia del Mombuey', 6),
(774, '141', '7', 'Valencia del Ventoso', 6),
(775, '146', '9', 'Valle de la Serena', 6),
(776, '147', '5', 'Valle de Matamoros', 6),
(777, '148', '1', 'Valle de Santa Ana', 6),
(778, '142', '2', 'Valverde de Burguillos', 6),
(779, '143', '8', 'Valverde de Leganés', 6),
(780, '144', '3', 'Valverde de Llerena', 6),
(781, '145', '6', 'Valverde de Mérida', 6),
(782, '149', '4', 'Villafranca de los Barros', 6),
(783, '150', '7', 'Villagarcía de la Torre', 6),
(784, '151', '4', 'Villagonzalo', 6),
(785, '152', '9', 'Villalba de los Barros', 6),
(786, '153', '5', 'Villanueva de la Serena', 6),
(787, '154', '0', 'Villanueva del Fresno', 6),
(788, '156', '6', 'Villar de Rena', 6),
(789, '155', '3', 'Villar del Rey', 6),
(790, '157', '2', 'Villarta de los Montes', 6),
(791, '158', '8', 'Zafra', 6),
(792, '159', '1', 'Zahínos', 6),
(793, '160', '5', 'Zalamea de la Serena', 6),
(794, '162', '7', 'Zarza, La', 6),
(795, '161', '2', 'Zarza-Capilla', 6),
(796, '2', '7', 'Alaior', 7),
(797, '1', '2', 'Alaró', 7),
(798, '3', '3', 'Alcúdia', 7),
(799, '4', '8', 'Algaida', 7),
(800, '5', '1', 'Andratx', 7),
(801, '901', '3', 'Ariany', 7),
(802, '6', '4', 'Artà', 7),
(803, '7', '0', 'Banyalbufar', 7),
(804, '8', '6', 'Binissalem', 7),
(805, '9', '9', 'Búger', 7),
(806, '10', '3', 'Bunyola', 7),
(807, '11', '0', 'Calvià', 7),
(808, '12', '5', 'Campanet', 7),
(809, '13', '1', 'Campos', 7),
(810, '14', '6', 'Capdepera', 7),
(811, '64', '5', 'Castell, Es', 7),
(812, '15', '9', 'Ciutadella de Menorca', 7),
(813, '16', '2', 'Consell', 7),
(814, '17', '8', 'Costitx', 7),
(815, '18', '4', 'Deià', 7),
(816, '26', '0', 'Eivissa', 7),
(817, '19', '7', 'Escorca', 7),
(818, '20', '1', 'Esporles', 7),
(819, '21', '8', 'Estellencs', 7),
(820, '22', '3', 'Felanitx', 7),
(821, '23', '9', 'Ferreries', 7),
(822, '24', '4', 'Formentera', 7),
(823, '25', '7', 'Fornalutx', 7),
(824, '27', '6', 'Inca', 7),
(825, '28', '2', 'Lloret de Vistalegre', 7),
(826, '29', '5', 'Lloseta', 7),
(827, '30', '9', 'Llubí', 7),
(828, '31', '6', 'Llucmajor', 7),
(829, '33', '7', 'Manacor', 7),
(830, '34', '2', 'Mancor de la Vall', 7),
(831, '32', '1', 'Maó-Mahón', 7),
(832, '35', '5', 'Maria de la Salut', 7),
(833, '36', '8', 'Marratxí', 7),
(834, '37', '4', 'Mercadal, Es', 7),
(835, '902', '8', 'Migjorn Gran, Es', 7),
(836, '38', '0', 'Montuïri', 7),
(837, '39', '3', 'Muro', 7),
(838, '40', '7', 'Palma de Mallorca', 7),
(839, '41', '4', 'Petra', 7),
(840, '44', '0', 'Pobla, Sa', 7),
(841, '42', '9', 'Pollença', 7),
(842, '43', '5', 'Porreres', 7),
(843, '45', '3', 'Puigpunyent', 7),
(844, '59', '8', 'Salines, Ses', 7),
(845, '46', '6', 'Sant Antoni de Portmany', 7),
(846, '49', '1', 'Sant Joan', 7),
(847, '50', '4', 'Sant Joan de Labritja', 7),
(848, '48', '8', 'Sant Josep de sa Talaia', 7),
(849, '51', '1', 'Sant Llorenç des Cardassar', 7),
(850, '52', '6', 'Sant Lluís', 7),
(851, '53', '2', 'Santa Eugènia', 7),
(852, '54', '7', 'Santa Eulària des Riu', 7),
(853, '55', '0', 'Santa Margalida', 7),
(854, '56', '3', 'Santa María del Camí', 7),
(855, '57', '9', 'Santanyí', 7),
(856, '58', '5', 'Selva', 7),
(857, '47', '2', 'Sencelles', 7),
(858, '60', '2', 'Sineu', 7),
(859, '61', '9', 'Sóller', 7),
(860, '62', '4', 'Son Servera', 7),
(861, '63', '0', 'Valldemossa', 7),
(862, '65', '8', 'Vilafranca de Bonany', 7),
(863, '1', '8', 'Abrera', 8),
(864, '2', '3', 'Aguilar de Segarra', 8),
(865, '14', '2', 'Aiguafreda', 8),
(866, '3', '9', 'Alella', 8),
(867, '4', '4', 'Alpens', 8),
(868, '5', '7', 'Ametlla del Vallès, L\'', 8),
(869, '6', '0', 'Arenys de Mar', 8),
(870, '7', '6', 'Arenys de Munt', 8),
(871, '8', '2', 'Argençola', 8),
(872, '9', '5', 'Argentona', 8),
(873, '10', '9', 'Artés', 8),
(874, '11', '6', 'Avià', 8),
(875, '12', '1', 'Avinyó', 8),
(876, '13', '7', 'Avinyonet del Penedès', 8),
(877, '15', '5', 'Badalona', 8),
(878, '904', '5', 'Badia del Vallès', 8),
(879, '16', '8', 'Bagà', 8),
(880, '17', '4', 'Balenyà', 8),
(881, '18', '0', 'Balsareny', 8),
(882, '252', '0', 'Barberà del Vallès', 8),
(883, '19', '3', 'Barcelona', 8),
(884, '20', '7', 'Begues', 8),
(885, '21', '4', 'Bellprat', 8),
(886, '22', '9', 'Berga', 8),
(887, '23', '5', 'Bigues i Riells', 8),
(888, '24', '0', 'Borredà', 8),
(889, '25', '3', 'Bruc, El', 8),
(890, '26', '6', 'Brull, El', 8),
(891, '27', '2', 'Cabanyes, Les', 8),
(892, '28', '8', 'Cabrera d\'Anoia', 8),
(893, '29', '1', 'Cabrera de Mar', 8),
(894, '30', '5', 'Cabrils', 8),
(895, '31', '2', 'Calaf', 8),
(896, '34', '8', 'Calders', 8),
(897, '33', '3', 'Caldes de Montbui', 8),
(898, '32', '7', 'Caldes d\'Estrac', 8),
(899, '35', '1', 'Calella', 8),
(900, '37', '0', 'Calldetenes', 8),
(901, '38', '6', 'Callús', 8),
(902, '36', '4', 'Calonge de Segarra', 8),
(903, '39', '9', 'Campins', 8),
(904, '40', '3', 'Canet de Mar', 8),
(905, '41', '0', 'Canovelles', 8),
(906, '42', '5', 'Cànoves i Samalús', 8),
(907, '43', '1', 'Canyelles', 8),
(908, '44', '6', 'Capellades', 8),
(909, '45', '9', 'Capolat', 8),
(910, '46', '2', 'Cardedeu', 8),
(911, '47', '8', 'Cardona', 8),
(912, '48', '4', 'Carme', 8),
(913, '49', '7', 'Casserres', 8),
(914, '57', '5', 'Castell de l\'Areny', 8),
(915, '52', '2', 'Castellar de n\'Hug', 8),
(916, '50', '0', 'Castellar del Riu', 8),
(917, '51', '7', 'Castellar del Vallès', 8),
(918, '53', '8', 'Castellbell i el Vilar', 8),
(919, '54', '3', 'Castellbisbal', 8),
(920, '55', '6', 'Castellcir', 8),
(921, '56', '9', 'Castelldefels', 8),
(922, '58', '1', 'Castellet i la Gornal', 8),
(923, '60', '8', 'Castellfollit de Riubregós', 8),
(924, '59', '4', 'Castellfollit del Boix', 8),
(925, '61', '5', 'Castellgalí', 8),
(926, '62', '0', 'Castellnou de Bages', 8),
(927, '63', '6', 'Castellolí', 8),
(928, '64', '1', 'Castellterçol', 8),
(929, '65', '4', 'Castellví de la Marca', 8),
(930, '66', '7', 'Castellví de Rosanes', 8),
(931, '67', '3', 'Centelles', 8),
(932, '268', '7', 'Cercs', 8),
(933, '266', '5', 'Cerdanyola del Vallès', 8),
(934, '68', '9', 'Cervelló', 8),
(935, '69', '2', 'Collbató', 8),
(936, '70', '6', 'Collsuspina', 8),
(937, '71', '3', 'Copons', 8),
(938, '72', '8', 'Corbera de Llobregat', 8),
(939, '73', '4', 'Cornellà de Llobregat', 8),
(940, '74', '9', 'Cubelles', 8),
(941, '75', '2', 'Dosrius', 8),
(942, '76', '5', 'Esparreguera', 8),
(943, '77', '1', 'Esplugues de Llobregat', 8),
(944, '78', '7', 'Espunyola, L\'', 8),
(945, '254', '1', 'Esquirol, L\'', 8),
(946, '79', '0', 'Estany, L\'', 8),
(947, '134', '7', 'Figaró-Montmany', 8),
(948, '80', '4', 'Fígols', 8),
(949, '82', '6', 'Fogars de la Selva', 8),
(950, '81', '1', 'Fogars de Montclús', 8),
(951, '83', '2', 'Folgueroles', 8),
(952, '84', '7', 'Fonollosa', 8),
(953, '85', '0', 'Font-rubí', 8),
(954, '86', '3', 'Franqueses del Vallès, Les', 8),
(955, '90', '2', 'Gaià', 8),
(956, '87', '9', 'Gallifa', 8),
(957, '88', '5', 'Garriga, La', 8),
(958, '89', '8', 'Gavà', 8),
(959, '91', '9', 'Gelida', 8),
(960, '92', '4', 'Gironella', 8),
(961, '93', '0', 'Gisclareny', 8),
(962, '94', '5', 'Granada, La', 8),
(963, '95', '8', 'Granera', 8),
(964, '96', '1', 'Granollers', 8),
(965, '97', '7', 'Gualba', 8),
(966, '99', '6', 'Guardiola de Berguedà', 8),
(967, '100', '0', 'Gurb', 8),
(968, '101', '7', 'Hospitalet de Llobregat, L\'', 8),
(969, '162', '9', 'Hostalets de Pierola, Els', 8),
(970, '102', '2', 'Igualada', 8),
(971, '103', '8', 'Jorba', 8),
(972, '104', '3', 'Llacuna, La', 8),
(973, '105', '6', 'Llagosta, La', 8),
(974, '107', '5', 'Lliçà d\'Amunt', 8),
(975, '108', '1', 'Lliçà de Vall', 8),
(976, '106', '9', 'Llinars del Vallès', 8),
(977, '109', '4', 'Lluçà', 8),
(978, '110', '8', 'Malgrat de Mar', 8),
(979, '111', '5', 'Malla', 8),
(980, '112', '0', 'Manlleu', 8),
(981, '113', '6', 'Manresa', 8),
(982, '242', '3', 'Marganell', 8),
(983, '114', '1', 'Martorell', 8),
(984, '115', '4', 'Martorelles', 8),
(985, '116', '7', 'Masies de Roda, Les', 8),
(986, '117', '3', 'Masies de Voltregà, Les', 8),
(987, '118', '9', 'Masnou, El', 8),
(988, '119', '2', 'Masquefa', 8),
(989, '120', '6', 'Matadepera', 8),
(990, '121', '3', 'Mataró', 8),
(991, '122', '8', 'Mediona', 8),
(992, '138', '5', 'Moià', 8),
(993, '123', '4', 'Molins de Rei', 8),
(994, '124', '9', 'Mollet del Vallès', 8),
(995, '128', '7', 'Monistrol de Calders', 8),
(996, '127', '1', 'Monistrol de Montserrat', 8),
(997, '125', '2', 'Montcada i Reixac', 8),
(998, '130', '4', 'Montclar', 8),
(999, '131', '1', 'Montesquiu', 8),
(1000, '126', '5', 'Montgat', 8),
(1001, '132', '6', 'Montmajor', 8),
(1002, '133', '2', 'Montmaneu', 8),
(1003, '135', '0', 'Montmeló', 8),
(1004, '136', '3', 'Montornès del Vallès', 8),
(1005, '137', '9', 'Montseny', 8),
(1006, '129', '0', 'Muntanyola', 8),
(1007, '139', '8', 'Mura', 8),
(1008, '140', '2', 'Navarcles', 8),
(1009, '141', '9', 'Navàs', 8),
(1010, '142', '4', 'Nou de Berguedà, La', 8),
(1011, '143', '0', 'Òdena', 8),
(1012, '145', '8', 'Olèrdola', 8),
(1013, '146', '1', 'Olesa de Bonesvalls', 8),
(1014, '147', '7', 'Olesa de Montserrat', 8),
(1015, '148', '3', 'Olivella', 8),
(1016, '149', '6', 'Olost', 8),
(1017, '144', '5', 'Olvan', 8),
(1018, '150', '9', 'Orís', 8),
(1019, '151', '6', 'Oristà', 8),
(1020, '152', '1', 'Orpí', 8),
(1021, '153', '7', 'Òrrius', 8),
(1022, '154', '2', 'Pacs del Penedès', 8),
(1023, '155', '5', 'Palafolls', 8),
(1024, '156', '8', 'Palau-solità i Plegamans', 8),
(1025, '157', '4', 'Pallejà', 8),
(1026, '905', '8', 'Palma de Cervelló, La', 8),
(1027, '158', '0', 'Papiol, El', 8),
(1028, '159', '3', 'Parets del Vallès', 8),
(1029, '160', '7', 'Perafita', 8),
(1030, '161', '4', 'Piera', 8),
(1031, '163', '5', 'Pineda de Mar', 8),
(1032, '164', '0', 'Pla del Penedès, El', 8),
(1033, '165', '3', 'Pobla de Claramunt, La', 8),
(1034, '166', '6', 'Pobla de Lillet, La', 8),
(1035, '167', '2', 'Polinyà', 8),
(1036, '182', '5', 'Pont de Vilomara i Rocafort, El', 8),
(1037, '168', '8', 'Pontons', 8),
(1038, '169', '1', 'Prat de Llobregat, El', 8),
(1039, '171', '2', 'Prats de Lluçanès', 8),
(1040, '170', '5', 'Prats de Rei, Els', 8),
(1041, '230', '3', 'Premià de Dalt', 8),
(1042, '172', '7', 'Premià de Mar', 8),
(1043, '174', '8', 'Puigdàlber', 8),
(1044, '175', '1', 'Puig-reig', 8),
(1045, '176', '4', 'Pujalt', 8),
(1046, '177', '0', 'Quar, La', 8),
(1047, '178', '6', 'Rajadell', 8),
(1048, '179', '9', 'Rellinars', 8),
(1049, '180', '3', 'Ripollet', 8),
(1050, '181', '0', 'Roca del Vallès, La', 8),
(1051, '183', '1', 'Roda de Ter', 8),
(1052, '184', '6', 'Rubí', 8),
(1053, '185', '9', 'Rubió', 8),
(1054, '901', '9', 'Rupit i Pruit', 8),
(1055, '187', '8', 'Sabadell', 8),
(1056, '188', '4', 'Sagàs', 8),
(1057, '190', '1', 'Saldes', 8),
(1058, '191', '8', 'Sallent', 8),
(1059, '194', '4', 'Sant Adrià de Besòs', 8),
(1060, '195', '7', 'Sant Agustí de Lluçanès', 8),
(1061, '196', '0', 'Sant Andreu de la Barca', 8),
(1062, '197', '6', 'Sant Andreu de Llavaneres', 8),
(1063, '198', '2', 'Sant Antoni de Vilamajor', 8),
(1064, '199', '5', 'Sant Bartomeu del Grau', 8),
(1065, '200', '9', 'Sant Boi de Llobregat', 8),
(1066, '201', '6', 'Sant Boi de Lluçanès', 8),
(1067, '203', '7', 'Sant Cebrià de Vallalta', 8),
(1068, '202', '1', 'Sant Celoni', 8),
(1069, '204', '2', 'Sant Climent de Llobregat', 8),
(1070, '205', '5', 'Sant Cugat del Vallès', 8),
(1071, '206', '8', 'Sant Cugat Sesgarrigues', 8),
(1072, '207', '4', 'Sant Esteve de Palautordera', 8),
(1073, '208', '0', 'Sant Esteve Sesrovires', 8),
(1074, '210', '7', 'Sant Feliu de Codines', 8),
(1075, '211', '4', 'Sant Feliu de Llobregat', 8),
(1076, '212', '9', 'Sant Feliu Sasserra', 8),
(1077, '209', '3', 'Sant Fost de Campsentelles', 8),
(1078, '213', '5', 'Sant Fruitós de Bages', 8),
(1079, '215', '3', 'Sant Hipòlit de Voltregà', 8),
(1080, '193', '9', 'Sant Iscle de Vallalta', 8),
(1081, '216', '6', 'Sant Jaume de Frontanyà', 8),
(1082, '218', '8', 'Sant Joan de Vilatorrada', 8),
(1083, '217', '2', 'Sant Joan Despí', 8),
(1084, '903', '0', 'Sant Julià de Cerdanyola', 8),
(1085, '220', '5', 'Sant Julià de Vilatorta', 8),
(1086, '221', '2', 'Sant Just Desvern', 8),
(1087, '222', '7', 'Sant Llorenç d\'Hortons', 8),
(1088, '223', '3', 'Sant Llorenç Savall', 8),
(1089, '225', '1', 'Sant Martí d\'Albars', 8),
(1090, '224', '8', 'Sant Martí de Centelles', 8),
(1091, '226', '4', 'Sant Martí de Tous', 8),
(1092, '227', '0', 'Sant Martí Sarroca', 8),
(1093, '228', '6', 'Sant Martí Sesgueioles', 8),
(1094, '229', '9', 'Sant Mateu de Bages', 8),
(1095, '231', '0', 'Sant Pere de Ribes', 8),
(1096, '232', '5', 'Sant Pere de Riudebitlles', 8),
(1097, '233', '1', 'Sant Pere de Torelló', 8),
(1098, '234', '6', 'Sant Pere de Vilamajor', 8),
(1099, '189', '7', 'Sant Pere Sallavinera', 8),
(1100, '235', '9', 'Sant Pol de Mar', 8),
(1101, '236', '2', 'Sant Quintí de Mediona', 8),
(1102, '237', '8', 'Sant Quirze de Besora', 8),
(1103, '238', '4', 'Sant Quirze del Vallès', 8),
(1104, '239', '7', 'Sant Quirze Safaja', 8),
(1105, '240', '1', 'Sant Sadurní d\'Anoia', 8),
(1106, '241', '8', 'Sant Sadurní d\'Osormort', 8),
(1107, '98', '3', 'Sant Salvador de Guardiola', 8),
(1108, '262', '8', 'Sant Vicenç de Castellet', 8),
(1109, '264', '9', 'Sant Vicenç de Montalt', 8),
(1110, '265', '2', 'Sant Vicenç de Torelló', 8),
(1111, '263', '4', 'Sant Vicenç dels Horts', 8),
(1112, '243', '9', 'Santa Cecília de Voltregà', 8),
(1113, '244', '4', 'Santa Coloma de Cervelló', 8),
(1114, '245', '7', 'Santa Coloma de Gramenet', 8),
(1115, '246', '0', 'Santa Eugènia de Berga', 8),
(1116, '247', '6', 'Santa Eulàlia de Riuprimer', 8),
(1117, '248', '2', 'Santa Eulàlia de Ronçana', 8),
(1118, '249', '5', 'Santa Fe del Penedès', 8),
(1119, '250', '8', 'Santa Margarida de Montbui', 8),
(1120, '251', '5', 'Santa Margarida i els Monjos', 8),
(1121, '253', '6', 'Santa Maria de Besora', 8),
(1122, '256', '7', 'Santa Maria de Martorelles', 8),
(1123, '255', '4', 'Santa Maria de Merlès', 8),
(1124, '257', '3', 'Santa Maria de Miralles', 8),
(1125, '259', '2', 'Santa Maria de Palautordera', 8),
(1126, '258', '9', 'Santa Maria d\'Oló', 8),
(1127, '260', '6', 'Santa Perpètua de Mogoda', 8),
(1128, '261', '3', 'Santa Susanna', 8),
(1129, '192', '3', 'Santpedor', 8),
(1130, '267', '1', 'Sentmenat', 8),
(1131, '269', '0', 'Seva', 8),
(1132, '270', '4', 'Sitges', 8),
(1133, '271', '1', 'Sobremunt', 8),
(1134, '272', '6', 'Sora', 8),
(1135, '273', '2', 'Subirats', 8),
(1136, '274', '7', 'Súria', 8),
(1137, '276', '3', 'Tagamanent', 8),
(1138, '277', '9', 'Talamanca', 8),
(1139, '278', '5', 'Taradell', 8),
(1140, '275', '0', 'Tavèrnoles', 8),
(1141, '280', '2', 'Tavertet', 8),
(1142, '281', '9', 'Teià', 8),
(1143, '279', '8', 'Terrassa', 8),
(1144, '282', '4', 'Tiana', 8),
(1145, '283', '0', 'Tona', 8),
(1146, '284', '5', 'Tordera', 8),
(1147, '285', '8', 'Torelló', 8),
(1148, '286', '1', 'Torre de Claramunt, La', 8),
(1149, '287', '7', 'Torrelavit', 8),
(1150, '288', '3', 'Torrelles de Foix', 8),
(1151, '289', '6', 'Torrelles de Llobregat', 8),
(1152, '290', '0', 'Ullastrell', 8),
(1153, '291', '7', 'Vacarisses', 8),
(1154, '292', '2', 'Vallbona d\'Anoia', 8),
(1155, '293', '8', 'Vallcebre', 8),
(1156, '294', '3', 'Vallgorguina', 8),
(1157, '295', '6', 'Vallirana', 8),
(1158, '296', '9', 'Vallromanes', 8),
(1159, '297', '5', 'Veciana', 8),
(1160, '298', '1', 'Vic', 8),
(1161, '299', '4', 'Vilada', 8),
(1162, '301', '5', 'Viladecans', 8),
(1163, '300', '8', 'Viladecavalls', 8),
(1164, '305', '4', 'Vilafranca del Penedès', 8),
(1165, '306', '7', 'Vilalba Sasserra', 8),
(1166, '303', '6', 'Vilanova de Sau', 8),
(1167, '302', '0', 'Vilanova del Camí', 8),
(1168, '902', '4', 'Vilanova del Vallès', 8),
(1169, '307', '3', 'Vilanova i la Geltrú', 8),
(1170, '214', '0', 'Vilassar de Dalt', 8),
(1171, '219', '1', 'Vilassar de Mar', 8),
(1172, '304', '1', 'Vilobí del Penedès', 8),
(1173, '308', '9', 'Viver i Serrateix', 8),
(1174, '1', '1', 'Abajas', 9),
(1175, '3', '2', 'Adrada de Haza', 9),
(1176, '6', '3', 'Aguas Cándidas', 9),
(1177, '7', '9', 'Aguilar de Bureba', 9),
(1178, '9', '8', 'Albillos', 9),
(1179, '10', '2', 'Alcocero de Mola', 9),
(1180, '11', '9', 'Alfoz de Bricia', 9),
(1181, '907', '0', 'Alfoz de Quintanadueñas', 9),
(1182, '12', '4', 'Alfoz de Santa Gadea', 9),
(1183, '13', '0', 'Altable', 9),
(1184, '14', '5', 'Altos, Los', 9),
(1185, '16', '1', 'Ameyugo', 9),
(1186, '17', '7', 'Anguix', 9),
(1187, '18', '3', 'Aranda de Duero', 9),
(1188, '19', '6', 'Arandilla', 9),
(1189, '20', '0', 'Arauzo de Miel', 9),
(1190, '21', '7', 'Arauzo de Salce', 9),
(1191, '22', '2', 'Arauzo de Torre', 9),
(1192, '23', '8', 'Arcos', 9),
(1193, '24', '3', 'Arenillas de Riopisuerga', 9),
(1194, '25', '6', 'Arija', 9),
(1195, '26', '9', 'Arlanzón', 9),
(1196, '27', '5', 'Arraya de Oca', 9),
(1197, '29', '4', 'Atapuerca', 9),
(1198, '30', '8', 'Ausines, Los', 9),
(1199, '32', '0', 'Avellanosa de Muñó', 9),
(1200, '33', '6', 'Bahabón de Esgueva', 9),
(1201, '34', '1', 'Balbases, Los', 9),
(1202, '35', '4', 'Baños de Valdearados', 9),
(1203, '36', '7', 'Bañuelos de Bureba', 9),
(1204, '37', '3', 'Barbadillo de Herreros', 9),
(1205, '38', '9', 'Barbadillo del Mercado', 9),
(1206, '39', '2', 'Barbadillo del Pez', 9),
(1207, '41', '3', 'Barrio de Muñó', 9),
(1208, '43', '4', 'Barrios de Bureba, Los', 9),
(1209, '44', '9', 'Barrios de Colina', 9),
(1210, '45', '2', 'Basconcillos del Tozo', 9),
(1211, '46', '5', 'Bascuñana', 9),
(1212, '47', '1', 'Belbimbre', 9),
(1213, '48', '7', 'Belorado', 9),
(1214, '50', '3', 'Berberana', 9),
(1215, '51', '0', 'Berlangas de Roa', 9),
(1216, '52', '5', 'Berzosa de Bureba', 9),
(1217, '54', '6', 'Bozoó', 9),
(1218, '55', '9', 'Brazacorta', 9),
(1219, '56', '2', 'Briviesca', 9),
(1220, '57', '8', 'Bugedo', 9),
(1221, '58', '4', 'Buniel', 9),
(1222, '59', '7', 'Burgos', 9),
(1223, '60', '1', 'Busto de Bureba', 9),
(1224, '61', '8', 'Cabañes de Esgueva', 9),
(1225, '62', '3', 'Cabezón de la Sierra', 9),
(1226, '64', '4', 'Caleruega', 9),
(1227, '65', '7', 'Campillo de Aranda', 9),
(1228, '66', '0', 'Campolara', 9),
(1229, '67', '6', 'Canicosa de la Sierra', 9),
(1230, '68', '2', 'Cantabrana', 9),
(1231, '70', '9', 'Carazo', 9),
(1232, '71', '6', 'Carcedo de Bureba', 9),
(1233, '72', '1', 'Carcedo de Burgos', 9),
(1234, '73', '7', 'Cardeñadijo', 9),
(1235, '74', '2', 'Cardeñajimeno', 9),
(1236, '75', '5', 'Cardeñuela Riopico', 9),
(1237, '76', '8', 'Carrias', 9),
(1238, '77', '4', 'Cascajares de Bureba', 9),
(1239, '78', '0', 'Cascajares de la Sierra', 9),
(1240, '79', '3', 'Castellanos de Castro', 9),
(1241, '83', '5', 'Castil de Peones', 9),
(1242, '82', '9', 'Castildelgado', 9),
(1243, '84', '0', 'Castrillo de la Reina', 9),
(1244, '85', '3', 'Castrillo de la Vega', 9),
(1245, '88', '8', 'Castrillo de Riopisuerga', 9),
(1246, '86', '6', 'Castrillo del Val', 9),
(1247, '90', '5', 'Castrillo Mota de Judíos', 9),
(1248, '91', '2', 'Castrojeriz', 9),
(1249, '63', '9', 'Cavia', 9),
(1250, '93', '3', 'Cayuela', 9),
(1251, '94', '8', 'Cebrecos', 9),
(1252, '95', '1', 'Celada del Camino', 9),
(1253, '98', '6', 'Cerezo de Río Tirón', 9),
(1254, '100', '3', 'Cerratón de Juarros', 9),
(1255, '101', '0', 'Ciadoncha', 9),
(1256, '102', '5', 'Cillaperlata', 9),
(1257, '103', '1', 'Cilleruelo de Abajo', 9),
(1258, '104', '6', 'Cilleruelo de Arriba', 9),
(1259, '105', '9', 'Ciruelos de Cervera', 9),
(1260, '108', '4', 'Cogollos', 9),
(1261, '109', '7', 'Condado de Treviño', 9),
(1262, '110', '1', 'Contreras', 9),
(1263, '112', '3', 'Coruña del Conde', 9),
(1264, '113', '9', 'Covarrubias', 9),
(1265, '114', '4', 'Cubillo del Campo', 9),
(1266, '115', '7', 'Cubo de Bureba', 9),
(1267, '117', '6', 'Cueva de Roa, La', 9),
(1268, '119', '5', 'Cuevas de San Clemente', 9),
(1269, '120', '9', 'Encío', 9),
(1270, '122', '1', 'Espinosa de Cervera', 9),
(1271, '124', '2', 'Espinosa de los Monteros', 9),
(1272, '123', '7', 'Espinosa del Camino', 9),
(1273, '125', '5', 'Estépar', 9),
(1274, '127', '4', 'Fontioso', 9),
(1275, '128', '0', 'Frandovínez', 9),
(1276, '129', '3', 'Fresneda de la Sierra Tirón', 9),
(1277, '130', '7', 'Fresneña', 9),
(1278, '131', '4', 'Fresnillo de las Dueñas', 9),
(1279, '132', '9', 'Fresno de Río Tirón', 9),
(1280, '133', '5', 'Fresno de Rodilla', 9),
(1281, '134', '0', 'Frías', 9),
(1282, '135', '3', 'Fuentebureba', 9),
(1283, '136', '6', 'Fuentecén', 9),
(1284, '137', '2', 'Fuentelcésped', 9),
(1285, '138', '8', 'Fuentelisendo', 9),
(1286, '139', '1', 'Fuentemolinos', 9),
(1287, '140', '5', 'Fuentenebro', 9),
(1288, '141', '2', 'Fuentespina', 9),
(1289, '143', '3', 'Galbarros', 9),
(1290, '144', '8', 'Gallega, La', 9),
(1291, '148', '6', 'Grijalba', 9),
(1292, '149', '9', 'Grisaleña', 9),
(1293, '151', '9', 'Gumiel de Izán', 9),
(1294, '152', '4', 'Gumiel de Mercado', 9),
(1295, '154', '5', 'Hacinas', 9),
(1296, '155', '8', 'Haza', 9),
(1297, '159', '6', 'Hontanas', 9),
(1298, '160', '0', 'Hontangas', 9),
(1299, '162', '2', 'Hontoria de la Cantera', 9),
(1300, '164', '3', 'Hontoria de Valdearados', 9),
(1301, '163', '8', 'Hontoria del Pinar', 9),
(1302, '166', '9', 'Hormazas, Las', 9),
(1303, '167', '5', 'Hornillos del Camino', 9),
(1304, '168', '1', 'Horra, La', 9),
(1305, '169', '4', 'Hortigüela', 9),
(1306, '170', '8', 'Hoyales de Roa', 9),
(1307, '172', '0', 'Huérmeces', 9),
(1308, '173', '6', 'Huerta de Arriba', 9),
(1309, '174', '1', 'Huerta de Rey', 9),
(1310, '175', '4', 'Humada', 9),
(1311, '176', '7', 'Hurones', 9),
(1312, '177', '3', 'Ibeas de Juarros', 9),
(1313, '178', '9', 'Ibrillos', 9),
(1314, '179', '2', 'Iglesiarrubia', 9),
(1315, '180', '6', 'Iglesias', 9),
(1316, '181', '3', 'Isar', 9),
(1317, '182', '8', 'Itero del Castillo', 9),
(1318, '183', '4', 'Jaramillo de la Fuente', 9),
(1319, '184', '9', 'Jaramillo Quemado', 9),
(1320, '189', '0', 'Junta de Traslaloma', 9),
(1321, '190', '4', 'Junta de Villalba de Losa', 9),
(1322, '191', '1', 'Jurisdicción de Lara', 9),
(1323, '192', '6', 'Jurisdicción de San Zadornil', 9),
(1324, '194', '7', 'Lerma', 9),
(1325, '195', '0', 'Llano de Bureba', 9),
(1326, '196', '3', 'Madrigal del Monte', 9),
(1327, '197', '9', 'Madrigalejo del Monte', 9),
(1328, '198', '5', 'Mahamud', 9),
(1329, '199', '8', 'Mambrilla de Castrejón', 9),
(1330, '200', '2', 'Mambrillas de Lara', 9),
(1331, '201', '9', 'Mamolar', 9),
(1332, '202', '4', 'Manciles', 9),
(1333, '206', '1', 'Mazuela', 9),
(1334, '208', '3', 'Mecerreyes', 9),
(1335, '209', '6', 'Medina de Pomar', 9),
(1336, '211', '7', 'Melgar de Fernamental', 9),
(1337, '213', '8', 'Merindad de Cuesta-Urria', 9),
(1338, '214', '3', 'Merindad de Montija', 9),
(1339, '906', '4', 'Merindad de Río Ubierna', 9),
(1340, '215', '6', 'Merindad de Sotoscueva', 9),
(1341, '216', '9', 'Merindad de Valdeporres', 9),
(1342, '217', '5', 'Merindad de Valdivielso', 9),
(1343, '218', '1', 'Milagros', 9),
(1344, '219', '4', 'Miranda de Ebro', 9),
(1345, '220', '8', 'Miraveche', 9),
(1346, '221', '5', 'Modúbar de la Emparedada', 9),
(1347, '223', '6', 'Monasterio de la Sierra', 9),
(1348, '224', '1', 'Monasterio de Rodilla', 9),
(1349, '225', '4', 'Moncalvillo', 9),
(1350, '226', '7', 'Monterrubio de la Demanda', 9),
(1351, '227', '3', 'Montorio', 9),
(1352, '228', '9', 'Moradillo de Roa', 9),
(1353, '229', '2', 'Nava de Roa', 9),
(1354, '230', '6', 'Navas de Bureba', 9),
(1355, '231', '3', 'Nebreda', 9),
(1356, '232', '8', 'Neila', 9),
(1357, '235', '2', 'Olmedillo de Roa', 9),
(1358, '236', '5', 'Olmillos de Muñó', 9),
(1359, '238', '7', 'Oña', 9),
(1360, '239', '0', 'Oquillas', 9),
(1361, '241', '1', 'Orbaneja Riopico', 9),
(1362, '242', '6', 'Padilla de Abajo', 9),
(1363, '243', '2', 'Padilla de Arriba', 9),
(1364, '244', '7', 'Padrones de Bureba', 9),
(1365, '246', '3', 'Palacios de la Sierra', 9),
(1366, '247', '9', 'Palacios de Riopisuerga', 9),
(1367, '248', '5', 'Palazuelos de la Sierra', 9),
(1368, '249', '8', 'Palazuelos de Muñó', 9),
(1369, '250', '1', 'Pampliega', 9);
INSERT INTO `poblaciones` (`id`, `codigo`, `cp`, `poblacion`, `provincia_id`) VALUES
(1370, '251', '8', 'Pancorbo', 9),
(1371, '253', '9', 'Pardilla', 9),
(1372, '255', '7', 'Partido de la Sierra en Tobalina', 9),
(1373, '256', '0', 'Pedrosa de Duero', 9),
(1374, '259', '5', 'Pedrosa de Río Úrbel', 9),
(1375, '257', '6', 'Pedrosa del Páramo', 9),
(1376, '258', '2', 'Pedrosa del Príncipe', 9),
(1377, '261', '6', 'Peñaranda de Duero', 9),
(1378, '262', '1', 'Peral de Arlanza', 9),
(1379, '265', '5', 'Piérnigas', 9),
(1380, '266', '8', 'Pineda de la Sierra', 9),
(1381, '267', '4', 'Pineda Trasmonte', 9),
(1382, '268', '0', 'Pinilla de los Barruecos', 9),
(1383, '269', '3', 'Pinilla de los Moros', 9),
(1384, '270', '7', 'Pinilla Trasmonte', 9),
(1385, '272', '9', 'Poza de la Sal', 9),
(1386, '273', '5', 'Prádanos de Bureba', 9),
(1387, '274', '0', 'Pradoluengo', 9),
(1388, '275', '3', 'Presencio', 9),
(1389, '276', '6', 'Puebla de Arganzón, La', 9),
(1390, '277', '2', 'Puentedura', 9),
(1391, '279', '1', 'Quemada', 9),
(1392, '281', '2', 'Quintana del Pidio', 9),
(1393, '280', '5', 'Quintanabureba', 9),
(1394, '283', '3', 'Quintanaélez', 9),
(1395, '287', '0', 'Quintanaortuño', 9),
(1396, '288', '6', 'Quintanapalla', 9),
(1397, '289', '9', 'Quintanar de la Sierra', 9),
(1398, '292', '5', 'Quintanavides', 9),
(1399, '294', '6', 'Quintanilla de la Mata', 9),
(1400, '901', '2', 'Quintanilla del Agua y Tordueles', 9),
(1401, '295', '9', 'Quintanilla del Coco', 9),
(1402, '298', '4', 'Quintanilla San García', 9),
(1403, '301', '8', 'Quintanilla Vivar', 9),
(1404, '297', '8', 'Quintanillas, Las', 9),
(1405, '302', '3', 'Rabanera del Pinar', 9),
(1406, '303', '9', 'Rábanos', 9),
(1407, '304', '4', 'Rabé de las Calzadas', 9),
(1408, '306', '0', 'Rebolledo de la Torre', 9),
(1409, '307', '6', 'Redecilla del Camino', 9),
(1410, '308', '2', 'Redecilla del Campo', 9),
(1411, '309', '5', 'Regumiel de la Sierra', 9),
(1412, '310', '9', 'Reinoso', 9),
(1413, '311', '6', 'Retuerta', 9),
(1414, '314', '2', 'Revilla del Campo', 9),
(1415, '316', '8', 'Revilla Vallejera', 9),
(1416, '312', '1', 'Revilla y Ahedo, La', 9),
(1417, '315', '5', 'Revillarruz', 9),
(1418, '317', '4', 'Rezmondo', 9),
(1419, '318', '0', 'Riocavado de la Sierra', 9),
(1420, '321', '4', 'Roa', 9),
(1421, '323', '5', 'Rojas', 9),
(1422, '325', '3', 'Royuela de Río Franco', 9),
(1423, '326', '6', 'Rubena', 9),
(1424, '327', '2', 'Rublacedo de Abajo', 9),
(1425, '328', '8', 'Rucandio', 9),
(1426, '329', '1', 'Salas de Bureba', 9),
(1427, '330', '5', 'Salas de los Infantes', 9),
(1428, '332', '7', 'Saldaña de Burgos', 9),
(1429, '334', '8', 'Salinillas de Bureba', 9),
(1430, '335', '1', 'San Adrián de Juarros', 9),
(1431, '337', '0', 'San Juan del Monte', 9),
(1432, '338', '6', 'San Mamés de Burgos', 9),
(1433, '339', '9', 'San Martín de Rubiales', 9),
(1434, '340', '3', 'San Millán de Lara', 9),
(1435, '360', '8', 'San Vicente del Valle', 9),
(1436, '343', '1', 'Santa Cecilia', 9),
(1437, '345', '9', 'Santa Cruz de la Salceda', 9),
(1438, '346', '2', 'Santa Cruz del Valle Urbión', 9),
(1439, '347', '8', 'Santa Gadea del Cid', 9),
(1440, '348', '4', 'Santa Inés', 9),
(1441, '350', '0', 'Santa María del Campo', 9),
(1442, '351', '7', 'Santa María del Invierno', 9),
(1443, '352', '2', 'Santa María del Mercadillo', 9),
(1444, '353', '8', 'Santa María Rivarredonda', 9),
(1445, '354', '3', 'Santa Olalla de Bureba', 9),
(1446, '355', '6', 'Santibáñez de Esgueva', 9),
(1447, '356', '9', 'Santibáñez del Val', 9),
(1448, '358', '1', 'Santo Domingo de Silos', 9),
(1449, '361', '5', 'Sargentes de la Lora', 9),
(1450, '362', '0', 'Sarracín', 9),
(1451, '363', '6', 'Sasamón', 9),
(1452, '365', '4', 'Sequera de Haza, La', 9),
(1453, '366', '7', 'Solarana', 9),
(1454, '368', '9', 'Sordillos', 9),
(1455, '369', '2', 'Sotillo de la Ribera', 9),
(1456, '372', '8', 'Sotragero', 9),
(1457, '373', '4', 'Sotresgudo', 9),
(1458, '374', '9', 'Susinos del Páramo', 9),
(1459, '375', '2', 'Tamarón', 9),
(1460, '377', '1', 'Tardajos', 9),
(1461, '378', '7', 'Tejada', 9),
(1462, '380', '4', 'Terradillos de Esgueva', 9),
(1463, '381', '1', 'Tinieblas de la Sierra', 9),
(1464, '382', '6', 'Tobar', 9),
(1465, '384', '7', 'Tordómar', 9),
(1466, '386', '3', 'Torrecilla del Monte', 9),
(1467, '387', '9', 'Torregalindo', 9),
(1468, '388', '5', 'Torrelara', 9),
(1469, '389', '8', 'Torrepadre', 9),
(1470, '390', '2', 'Torresandino', 9),
(1471, '391', '9', 'Tórtoles de Esgueva', 9),
(1472, '392', '4', 'Tosantos', 9),
(1473, '394', '5', 'Trespaderne', 9),
(1474, '395', '8', 'Tubilla del Agua', 9),
(1475, '396', '1', 'Tubilla del Lago', 9),
(1476, '398', '3', 'Úrbel del Castillo', 9),
(1477, '400', '0', 'Vadocondes', 9),
(1478, '403', '8', 'Valdeande', 9),
(1479, '405', '6', 'Valdezate', 9),
(1480, '406', '9', 'Valdorros', 9),
(1481, '408', '1', 'Vallarta de Bureba', 9),
(1482, '904', '8', 'Valle de las Navas', 9),
(1483, '908', '6', 'Valle de Losa', 9),
(1484, '409', '4', 'Valle de Manzanedo', 9),
(1485, '410', '8', 'Valle de Mena', 9),
(1486, '411', '5', 'Valle de Oca', 9),
(1487, '902', '7', 'Valle de Santibáñez', 9),
(1488, '905', '1', 'Valle de Sedano', 9),
(1489, '412', '0', 'Valle de Tobalina', 9),
(1490, '413', '6', 'Valle de Valdebezana', 9),
(1491, '414', '1', 'Valle de Valdelaguna', 9),
(1492, '415', '4', 'Valle de Valdelucio', 9),
(1493, '416', '7', 'Valle de Zamanzas', 9),
(1494, '417', '3', 'Vallejera', 9),
(1495, '418', '9', 'Valles de Palenzuela', 9),
(1496, '419', '2', 'Valluércanes', 9),
(1497, '407', '5', 'Valmala', 9),
(1498, '422', '8', 'Vid de Bureba, La', 9),
(1499, '421', '3', 'Vid y Barrios, La', 9),
(1500, '423', '4', 'Vileña', 9),
(1501, '427', '1', 'Villadiego', 9),
(1502, '428', '7', 'Villaescusa de Roa', 9),
(1503, '429', '0', 'Villaescusa la Sombría', 9),
(1504, '430', '4', 'Villaespasa', 9),
(1505, '431', '1', 'Villafranca Montes de Oca', 9),
(1506, '432', '6', 'Villafruela', 9),
(1507, '433', '2', 'Villagalijo', 9),
(1508, '434', '7', 'Villagonzalo Pedernales', 9),
(1509, '437', '9', 'Villahoz', 9),
(1510, '438', '5', 'Villalba de Duero', 9),
(1511, '439', '8', 'Villalbilla de Burgos', 9),
(1512, '440', '2', 'Villalbilla de Gumiel', 9),
(1513, '441', '9', 'Villaldemiro', 9),
(1514, '442', '4', 'Villalmanzo', 9),
(1515, '443', '0', 'Villamayor de los Montes', 9),
(1516, '444', '5', 'Villamayor de Treviño', 9),
(1517, '445', '8', 'Villambistia', 9),
(1518, '446', '1', 'Villamedianilla', 9),
(1519, '447', '7', 'Villamiel de la Sierra', 9),
(1520, '448', '3', 'Villangómez', 9),
(1521, '449', '6', 'Villanueva de Argaño', 9),
(1522, '450', '9', 'Villanueva de Carazo', 9),
(1523, '451', '6', 'Villanueva de Gumiel', 9),
(1524, '454', '2', 'Villanueva de Teba', 9),
(1525, '455', '5', 'Villaquirán de la Puebla', 9),
(1526, '456', '8', 'Villaquirán de los Infantes', 9),
(1527, '903', '3', 'Villarcayo de Merindad de Castilla la Vieja', 9),
(1528, '458', '0', 'Villariezo', 9),
(1529, '460', '7', 'Villasandino', 9),
(1530, '463', '5', 'Villasur de Herreros', 9),
(1531, '464', '0', 'Villatuelda', 9),
(1532, '466', '6', 'Villaverde del Monte', 9),
(1533, '467', '2', 'Villaverde-Mogina', 9),
(1534, '471', '2', 'Villayerno Morquillas', 9),
(1535, '472', '7', 'Villazopeque', 9),
(1536, '473', '3', 'Villegas', 9),
(1537, '476', '4', 'Villoruebo', 9),
(1538, '424', '9', 'Viloria de Rioja', 9),
(1539, '425', '2', 'Vilviestre del Pinar', 9),
(1540, '478', '6', 'Vizcaínos', 9),
(1541, '480', '3', 'Zael', 9),
(1542, '482', '5', 'Zarzosa de Río Pisuerga', 9),
(1543, '483', '1', 'Zazuar', 9),
(1544, '485', '9', 'Zuñeda', 9),
(1545, '1', '5', 'Abadía', 10),
(1546, '2', '0', 'Abertura', 10),
(1547, '3', '6', 'Acebo', 10),
(1548, '4', '1', 'Acehúche', 10),
(1549, '5', '4', 'Aceituna', 10),
(1550, '6', '7', 'Ahigal', 10),
(1551, '903', '7', 'Alagón del Río', 10),
(1552, '7', '3', 'Albalá', 10),
(1553, '8', '9', 'Alcántara', 10),
(1554, '9', '2', 'Alcollarín', 10),
(1555, '10', '6', 'Alcuéscar', 10),
(1556, '12', '8', 'Aldea del Cano', 10),
(1557, '13', '4', 'Aldea del Obispo, La', 10),
(1558, '11', '3', 'Aldeacentenera', 10),
(1559, '14', '9', 'Aldeanueva de la Vera', 10),
(1560, '15', '2', 'Aldeanueva del Camino', 10),
(1561, '16', '5', 'Aldehuela de Jerte', 10),
(1562, '17', '1', 'Alía', 10),
(1563, '18', '7', 'Aliseda', 10),
(1564, '19', '0', 'Almaraz', 10),
(1565, '20', '4', 'Almoharín', 10),
(1566, '21', '1', 'Arroyo de la Luz', 10),
(1567, '23', '2', 'Arroyomolinos', 10),
(1568, '22', '6', 'Arroyomolinos de la Vera', 10),
(1569, '24', '7', 'Baños de Montemayor', 10),
(1570, '25', '0', 'Barrado', 10),
(1571, '26', '3', 'Belvís de Monroy', 10),
(1572, '27', '9', 'Benquerencia', 10),
(1573, '28', '5', 'Berrocalejo', 10),
(1574, '29', '8', 'Berzocana', 10),
(1575, '30', '2', 'Bohonal de Ibor', 10),
(1576, '31', '9', 'Botija', 10),
(1577, '32', '4', 'Brozas', 10),
(1578, '33', '0', 'Cabañas del Castillo', 10),
(1579, '34', '5', 'Cabezabellosa', 10),
(1580, '35', '8', 'Cabezuela del Valle', 10),
(1581, '36', '1', 'Cabrero', 10),
(1582, '37', '7', 'Cáceres', 10),
(1583, '38', '3', 'Cachorrilla', 10),
(1584, '39', '6', 'Cadalso', 10),
(1585, '40', '0', 'Calzadilla', 10),
(1586, '41', '7', 'Caminomorisco', 10),
(1587, '42', '2', 'Campillo de Deleitosa', 10),
(1588, '43', '8', 'Campo Lugar', 10),
(1589, '44', '3', 'Cañamero', 10),
(1590, '45', '6', 'Cañaveral', 10),
(1591, '46', '9', 'Carbajo', 10),
(1592, '47', '5', 'Carcaboso', 10),
(1593, '48', '1', 'Carrascalejo', 10),
(1594, '49', '4', 'Casar de Cáceres', 10),
(1595, '50', '7', 'Casar de Palomero', 10),
(1596, '51', '4', 'Casares de las Hurdes', 10),
(1597, '52', '9', 'Casas de Don Antonio', 10),
(1598, '53', '5', 'Casas de Don Gómez', 10),
(1599, '56', '6', 'Casas de Millán', 10),
(1600, '57', '2', 'Casas de Miravete', 10),
(1601, '54', '0', 'Casas del Castañar', 10),
(1602, '55', '3', 'Casas del Monte', 10),
(1603, '58', '8', 'Casatejada', 10),
(1604, '59', '1', 'Casillas de Coria', 10),
(1605, '60', '5', 'Castañar de Ibor', 10),
(1606, '61', '2', 'Ceclavín', 10),
(1607, '62', '7', 'Cedillo', 10),
(1608, '63', '3', 'Cerezo', 10),
(1609, '64', '8', 'Cilleros', 10),
(1610, '65', '1', 'Collado de la Vera', 10),
(1611, '66', '4', 'Conquista de la Sierra', 10),
(1612, '67', '0', 'Coria', 10),
(1613, '68', '6', 'Cuacos de Yuste', 10),
(1614, '69', '9', 'Cumbre, La', 10),
(1615, '70', '3', 'Deleitosa', 10),
(1616, '71', '0', 'Descargamaría', 10),
(1617, '72', '5', 'Eljas', 10),
(1618, '73', '1', 'Escurial', 10),
(1619, '75', '9', 'Fresnedoso de Ibor', 10),
(1620, '76', '2', 'Galisteo', 10),
(1621, '77', '8', 'Garciaz', 10),
(1622, '79', '7', 'Garganta la Olla', 10),
(1623, '78', '4', 'Garganta, La', 10),
(1624, '80', '1', 'Gargantilla', 10),
(1625, '81', '8', 'Gargüera', 10),
(1626, '82', '3', 'Garrovillas de Alconétar', 10),
(1627, '83', '9', 'Garvín', 10),
(1628, '84', '4', 'Gata', 10),
(1629, '85', '7', 'Gordo, El', 10),
(1630, '86', '0', 'Granja, La', 10),
(1631, '87', '6', 'Guadalupe', 10),
(1632, '88', '2', 'Guijo de Coria', 10),
(1633, '89', '5', 'Guijo de Galisteo', 10),
(1634, '90', '9', 'Guijo de Granadilla', 10),
(1635, '91', '6', 'Guijo de Santa Bárbara', 10),
(1636, '92', '1', 'Herguijuela', 10),
(1637, '93', '7', 'Hernán-Pérez', 10),
(1638, '94', '2', 'Herrera de Alcántara', 10),
(1639, '95', '5', 'Herreruela', 10),
(1640, '96', '8', 'Hervás', 10),
(1641, '97', '4', 'Higuera', 10),
(1642, '98', '0', 'Hinojal', 10),
(1643, '99', '3', 'Holguera', 10),
(1644, '100', '7', 'Hoyos', 10),
(1645, '101', '4', 'Huélaga', 10),
(1646, '102', '9', 'Ibahernando', 10),
(1647, '103', '5', 'Jaraicejo', 10),
(1648, '104', '0', 'Jaraíz de la Vera', 10),
(1649, '105', '3', 'Jarandilla de la Vera', 10),
(1650, '106', '6', 'Jarilla', 10),
(1651, '107', '2', 'Jerte', 10),
(1652, '108', '8', 'Ladrillar', 10),
(1653, '109', '1', 'Logrosán', 10),
(1654, '110', '5', 'Losar de la Vera', 10),
(1655, '111', '2', 'Madrigal de la Vera', 10),
(1656, '112', '7', 'Madrigalejo', 10),
(1657, '113', '3', 'Madroñera', 10),
(1658, '114', '8', 'Majadas', 10),
(1659, '115', '1', 'Malpartida de Cáceres', 10),
(1660, '116', '4', 'Malpartida de Plasencia', 10),
(1661, '117', '0', 'Marchagaz', 10),
(1662, '118', '6', 'Mata de Alcántara', 10),
(1663, '119', '9', 'Membrío', 10),
(1664, '120', '3', 'Mesas de Ibor', 10),
(1665, '121', '0', 'Miajadas', 10),
(1666, '122', '5', 'Millanes', 10),
(1667, '123', '1', 'Mirabel', 10),
(1668, '124', '6', 'Mohedas de Granadilla', 10),
(1669, '125', '9', 'Monroy', 10),
(1670, '126', '2', 'Montánchez', 10),
(1671, '127', '8', 'Montehermoso', 10),
(1672, '128', '4', 'Moraleja', 10),
(1673, '129', '7', 'Morcillo', 10),
(1674, '130', '1', 'Navaconcejo', 10),
(1675, '131', '8', 'Navalmoral de la Mata', 10),
(1676, '132', '3', 'Navalvillar de Ibor', 10),
(1677, '133', '9', 'Navas del Madroño', 10),
(1678, '134', '4', 'Navezuelas', 10),
(1679, '135', '7', 'Nuñomoral', 10),
(1680, '136', '0', 'Oliva de Plasencia', 10),
(1681, '137', '6', 'Palomero', 10),
(1682, '138', '2', 'Pasarón de la Vera', 10),
(1683, '139', '5', 'Pedroso de Acim', 10),
(1684, '140', '9', 'Peraleda de la Mata', 10),
(1685, '141', '6', 'Peraleda de San Román', 10),
(1686, '142', '1', 'Perales del Puerto', 10),
(1687, '143', '7', 'Pescueza', 10),
(1688, '144', '2', 'Pesga, La', 10),
(1689, '145', '5', 'Piedras Albas', 10),
(1690, '146', '8', 'Pinofranqueado', 10),
(1691, '147', '4', 'Piornal', 10),
(1692, '148', '0', 'Plasencia', 10),
(1693, '149', '3', 'Plasenzuela', 10),
(1694, '150', '6', 'Portaje', 10),
(1695, '151', '3', 'Portezuelo', 10),
(1696, '152', '8', 'Pozuelo de Zarzón', 10),
(1697, '905', '5', 'Pueblonuevo de Miramontes', 10),
(1698, '153', '4', 'Puerto de Santa Cruz', 10),
(1699, '154', '9', 'Rebollar', 10),
(1700, '155', '2', 'Riolobos', 10),
(1701, '156', '5', 'Robledillo de Gata', 10),
(1702, '157', '1', 'Robledillo de la Vera', 10),
(1703, '158', '7', 'Robledillo de Trujillo', 10),
(1704, '159', '0', 'Robledollano', 10),
(1705, '160', '4', 'Romangordo', 10),
(1706, '901', '6', 'Rosalejo', 10),
(1707, '161', '1', 'Ruanes', 10),
(1708, '162', '6', 'Salorino', 10),
(1709, '163', '2', 'Salvatierra de Santiago', 10),
(1710, '164', '7', 'San Martín de Trevejo', 10),
(1711, '165', '0', 'Santa Ana', 10),
(1712, '166', '3', 'Santa Cruz de la Sierra', 10),
(1713, '167', '9', 'Santa Cruz de Paniagua', 10),
(1714, '168', '5', 'Santa Marta de Magasca', 10),
(1715, '169', '8', 'Santiago de Alcántara', 10),
(1716, '170', '2', 'Santiago del Campo', 10),
(1717, '171', '9', 'Santibáñez el Alto', 10),
(1718, '172', '4', 'Santibáñez el Bajo', 10),
(1719, '173', '0', 'Saucedilla', 10),
(1720, '174', '5', 'Segura de Toro', 10),
(1721, '175', '8', 'Serradilla', 10),
(1722, '176', '1', 'Serrejón', 10),
(1723, '177', '7', 'Sierra de Fuentes', 10),
(1724, '178', '3', 'Talaván', 10),
(1725, '179', '6', 'Talaveruela de la Vera', 10),
(1726, '180', '0', 'Talayuela', 10),
(1727, '181', '7', 'Tejeda de Tiétar', 10),
(1728, '904', '2', 'Tiétar', 10),
(1729, '182', '2', 'Toril', 10),
(1730, '183', '8', 'Tornavacas', 10),
(1731, '184', '3', 'Torno, El', 10),
(1732, '187', '5', 'Torre de Don Miguel', 10),
(1733, '188', '1', 'Torre de Santa María', 10),
(1734, '185', '6', 'Torrecilla de los Ángeles', 10),
(1735, '186', '9', 'Torrecillas de la Tiesa', 10),
(1736, '190', '8', 'Torrejón el Rubio', 10),
(1737, '189', '4', 'Torrejoncillo', 10),
(1738, '191', '5', 'Torremenga', 10),
(1739, '192', '0', 'Torremocha', 10),
(1740, '193', '6', 'Torreorgaz', 10),
(1741, '194', '1', 'Torrequemada', 10),
(1742, '195', '4', 'Trujillo', 10),
(1743, '196', '7', 'Valdastillas', 10),
(1744, '197', '3', 'Valdecañas de Tajo', 10),
(1745, '198', '9', 'Valdefuentes', 10),
(1746, '199', '2', 'Valdehúncar', 10),
(1747, '200', '6', 'Valdelacasa de Tajo', 10),
(1748, '201', '3', 'Valdemorales', 10),
(1749, '202', '8', 'Valdeobispo', 10),
(1750, '203', '4', 'Valencia de Alcántara', 10),
(1751, '204', '9', 'Valverde de la Vera', 10),
(1752, '205', '2', 'Valverde del Fresno', 10),
(1753, '902', '1', 'Vegaviana', 10),
(1754, '206', '5', 'Viandar de la Vera', 10),
(1755, '207', '1', 'Villa del Campo', 10),
(1756, '208', '7', 'Villa del Rey', 10),
(1757, '209', '0', 'Villamesías', 10),
(1758, '210', '4', 'Villamiel', 10),
(1759, '211', '1', 'Villanueva de la Sierra', 10),
(1760, '212', '6', 'Villanueva de la Vera', 10),
(1761, '214', '7', 'Villar de Plasencia', 10),
(1762, '213', '2', 'Villar del Pedroso', 10),
(1763, '215', '0', 'Villasbuenas de Gata', 10),
(1764, '216', '3', 'Zarza de Granadilla', 10),
(1765, '217', '9', 'Zarza de Montánchez', 10),
(1766, '218', '5', 'Zarza la Mayor', 10),
(1767, '219', '8', 'Zorita', 10),
(1768, '1', '2', 'Alcalá de los Gazules', 11),
(1769, '2', '7', 'Alcalá del Valle', 11),
(1770, '3', '3', 'Algar', 11),
(1771, '4', '8', 'Algeciras', 11),
(1772, '5', '1', 'Algodonales', 11),
(1773, '6', '4', 'Arcos de la Frontera', 11),
(1774, '7', '0', 'Barbate', 11),
(1775, '8', '6', 'Barrios, Los', 11),
(1776, '901', '3', 'Benalup-Casas Viejas', 11),
(1777, '9', '9', 'Benaocaz', 11),
(1778, '10', '3', 'Bornos', 11),
(1779, '11', '0', 'Bosque, El', 11),
(1780, '12', '5', 'Cádiz', 11),
(1781, '13', '1', 'Castellar de la Frontera', 11),
(1782, '15', '9', 'Chiclana de la Frontera', 11),
(1783, '16', '2', 'Chipiona', 11),
(1784, '14', '6', 'Conil de la Frontera', 11),
(1785, '17', '8', 'Espera', 11),
(1786, '18', '4', 'Gastor, El', 11),
(1787, '19', '7', 'Grazalema', 11),
(1788, '20', '1', 'Jerez de la Frontera', 11),
(1789, '21', '8', 'Jimena de la Frontera', 11),
(1790, '22', '3', 'Línea de la Concepción, La', 11),
(1791, '23', '9', 'Medina-Sidonia', 11),
(1792, '24', '4', 'Olvera', 11),
(1793, '25', '7', 'Paterna de Rivera', 11),
(1794, '26', '0', 'Prado del Rey', 11),
(1795, '27', '6', 'Puerto de Santa María, El', 11),
(1796, '28', '2', 'Puerto Real', 11),
(1797, '29', '5', 'Puerto Serrano', 11),
(1798, '30', '9', 'Rota', 11),
(1799, '31', '6', 'San Fernando', 11),
(1800, '902', '8', 'San José del Valle', 11),
(1801, '33', '7', 'San Roque', 11),
(1802, '32', '1', 'Sanlúcar de Barrameda', 11),
(1803, '34', '2', 'Setenil de las Bodegas', 11),
(1804, '35', '5', 'Tarifa', 11),
(1805, '36', '8', 'Torre Alháquime', 11),
(1806, '37', '4', 'Trebujena', 11),
(1807, '38', '0', 'Ubrique', 11),
(1808, '39', '3', 'Vejer de la Frontera', 11),
(1809, '40', '7', 'Villaluenga del Rosario', 11),
(1810, '41', '4', 'Villamartín', 11),
(1811, '42', '9', 'Zahara', 11),
(1812, '2', '2', 'Aín', 12),
(1813, '3', '8', 'Albocàsser', 12),
(1814, '4', '3', 'Alcalà de Xivert', 12),
(1815, '5', '6', 'Alcora, l\'', 12),
(1816, '6', '9', 'Alcudia de Veo', 12),
(1817, '7', '5', 'Alfondeguilla', 12),
(1818, '8', '1', 'Algimia de Almonacid', 12),
(1819, '9', '4', 'Almazora/Almassora', 12),
(1820, '10', '8', 'Almedíjar', 12),
(1821, '11', '5', 'Almenara', 12),
(1822, '901', '8', 'Alqueries, les/Alquerías del Niño Perdido', 12),
(1823, '12', '0', 'Altura', 12),
(1824, '13', '6', 'Arañuel', 12),
(1825, '14', '1', 'Ares del Maestrat', 12),
(1826, '15', '4', 'Argelita', 12),
(1827, '16', '7', 'Artana', 12),
(1828, '1', '7', 'Atzeneta del Maestrat', 12),
(1829, '17', '3', 'Ayódar', 12),
(1830, '18', '9', 'Azuébar', 12),
(1831, '20', '6', 'Barracas', 12),
(1832, '22', '8', 'Bejís', 12),
(1833, '24', '9', 'Benafer', 12),
(1834, '25', '2', 'Benafigos', 12),
(1835, '26', '5', 'Benassal', 12),
(1836, '27', '1', 'Benicarló', 12),
(1837, '28', '7', 'Benicasim/Benicàssim', 12),
(1838, '29', '0', 'Benlloch', 12),
(1839, '21', '3', 'Betxí', 12),
(1840, '32', '6', 'Borriana/Burriana', 12),
(1841, '31', '1', 'Borriol', 12),
(1842, '33', '2', 'Cabanes', 12),
(1843, '34', '7', 'Càlig', 12),
(1844, '36', '3', 'Canet lo Roig', 12),
(1845, '37', '9', 'Castell de Cabres', 12),
(1846, '38', '5', 'Castellfort', 12),
(1847, '39', '8', 'Castellnovo', 12),
(1848, '40', '2', 'Castellón de la Plana/Castelló de la Plana', 12),
(1849, '41', '9', 'Castillo de Villamalefa', 12),
(1850, '42', '4', 'Catí', 12),
(1851, '43', '0', 'Caudiel', 12),
(1852, '44', '5', 'Cervera del Maestre', 12),
(1853, '53', '7', 'Chilches/Xilxes', 12),
(1854, '55', '5', 'Chodos/Xodos', 12),
(1855, '56', '8', 'Chóvar', 12),
(1856, '45', '8', 'Cinctorres', 12),
(1857, '46', '1', 'Cirat', 12),
(1858, '48', '3', 'Cortes de Arenoso', 12),
(1859, '49', '6', 'Costur', 12),
(1860, '50', '9', 'Coves de Vinromà, les', 12),
(1861, '51', '6', 'Culla', 12),
(1862, '57', '4', 'Eslida', 12),
(1863, '58', '0', 'Espadilla', 12),
(1864, '59', '3', 'Fanzara', 12),
(1865, '60', '7', 'Figueroles', 12),
(1866, '61', '4', 'Forcall', 12),
(1867, '63', '5', 'Fuente la Reina', 12),
(1868, '64', '0', 'Fuentes de Ayódar', 12),
(1869, '65', '3', 'Gaibiel', 12),
(1870, '67', '2', 'Geldo', 12),
(1871, '68', '8', 'Herbés', 12),
(1872, '69', '1', 'Higueras', 12),
(1873, '70', '5', 'Jana, la', 12),
(1874, '71', '2', 'Jérica', 12),
(1875, '74', '8', 'Llosa, la', 12),
(1876, '72', '7', 'Llucena/Lucena del Cid', 12),
(1877, '73', '3', 'Ludiente', 12),
(1878, '75', '1', 'Mata de Morella, la', 12),
(1879, '76', '4', 'Matet', 12),
(1880, '77', '0', 'Moncofa', 12),
(1881, '78', '6', 'Montán', 12),
(1882, '79', '9', 'Montanejos', 12),
(1883, '80', '3', 'Morella', 12),
(1884, '81', '0', 'Navajas', 12),
(1885, '82', '5', 'Nules', 12),
(1886, '83', '1', 'Olocau del Rey', 12),
(1887, '84', '6', 'Onda', 12),
(1888, '85', '9', 'Oropesa del Mar/Orpesa', 12),
(1889, '87', '8', 'Palanques', 12),
(1890, '88', '4', 'Pavías', 12),
(1891, '89', '7', 'Peníscola/Peñíscola', 12),
(1892, '90', '1', 'Pina de Montalgrao', 12),
(1893, '93', '9', 'Pobla de Benifassà, la', 12),
(1894, '94', '4', 'Pobla Tornesa, la', 12),
(1895, '91', '8', 'Portell de Morella', 12),
(1896, '92', '3', 'Puebla de Arenoso', 12),
(1897, '95', '7', 'Ribesalbes', 12),
(1898, '96', '0', 'Rossell', 12),
(1899, '97', '6', 'Sacañet', 12),
(1900, '98', '2', 'Salzadella, la', 12),
(1901, '101', '6', 'San Rafael del Río', 12),
(1902, '902', '3', 'Sant Joan de Moró', 12),
(1903, '99', '5', 'Sant Jordi/San Jorge', 12),
(1904, '100', '9', 'Sant Mateu', 12),
(1905, '102', '1', 'Santa Magdalena de Pulpis', 12),
(1906, '104', '2', 'Segorbe', 12),
(1907, '103', '7', 'Serratella, la', 12),
(1908, '105', '5', 'Sierra Engarcerán', 12),
(1909, '106', '8', 'Soneja', 12),
(1910, '107', '4', 'Sot de Ferrer', 12),
(1911, '108', '0', 'Sueras/Suera', 12),
(1912, '109', '3', 'Tales', 12),
(1913, '110', '7', 'Teresa', 12),
(1914, '111', '4', 'Tírig', 12),
(1915, '112', '9', 'Todolella', 12),
(1916, '113', '5', 'Toga', 12),
(1917, '114', '0', 'Torás', 12),
(1918, '115', '3', 'Toro, El', 12),
(1919, '116', '6', 'Torralba del Pinar', 12),
(1920, '119', '1', 'Torre d\'En Besora, la', 12),
(1921, '120', '5', 'Torre d\'en Doménec, la', 12),
(1922, '117', '2', 'Torreblanca', 12),
(1923, '118', '8', 'Torrechiva', 12),
(1924, '121', '2', 'Traiguera', 12),
(1925, '122', '7', 'Useras/Useres, les', 12),
(1926, '124', '8', 'Vall d\'Alba', 12),
(1927, '125', '1', 'Vall de Almonacid', 12),
(1928, '126', '4', 'Vall d\'Uixó, la', 12),
(1929, '123', '3', 'Vallat', 12),
(1930, '127', '0', 'Vallibona', 12),
(1931, '128', '6', 'Vilafamés', 12),
(1932, '132', '5', 'Vilanova d\'Alcolea', 12),
(1933, '134', '6', 'Vilar de Canes', 12),
(1934, '135', '9', 'Vila-real', 12),
(1935, '136', '2', 'Vilavella, la', 12),
(1936, '129', '9', 'Villafranca del Cid/Vilafranca', 12),
(1937, '130', '3', 'Villahermosa del Río', 12),
(1938, '131', '0', 'Villamalur', 12),
(1939, '133', '1', 'Villanueva de Viver', 12),
(1940, '137', '8', 'Villores', 12),
(1941, '138', '4', 'Vinaròs', 12),
(1942, '139', '7', 'Vistabella del Maestrat', 12),
(1943, '140', '1', 'Viver', 12),
(1944, '52', '1', 'Xert', 12),
(1945, '141', '8', 'Zorita del Maestrazgo', 12),
(1946, '142', '3', 'Zucaina', 12),
(1947, '1', '3', 'Abenójar', 13),
(1948, '2', '8', 'Agudo', 13),
(1949, '3', '4', 'Alamillo', 13),
(1950, '4', '9', 'Albaladejo', 13),
(1951, '5', '2', 'Alcázar de San Juan', 13),
(1952, '6', '5', 'Alcoba', 13),
(1953, '7', '1', 'Alcolea de Calatrava', 13),
(1954, '8', '7', 'Alcubillas', 13),
(1955, '9', '0', 'Aldea del Rey', 13),
(1956, '10', '4', 'Alhambra', 13),
(1957, '11', '1', 'Almadén', 13),
(1958, '12', '6', 'Almadenejos', 13),
(1959, '13', '2', 'Almagro', 13),
(1960, '14', '7', 'Almedina', 13),
(1961, '15', '0', 'Almodóvar del Campo', 13),
(1962, '16', '3', 'Almuradiel', 13),
(1963, '17', '9', 'Anchuras', 13),
(1964, '903', '5', 'Arenales de San Gregorio', 13),
(1965, '18', '5', 'Arenas de San Juan', 13),
(1966, '19', '8', 'Argamasilla de Alba', 13),
(1967, '20', '2', 'Argamasilla de Calatrava', 13),
(1968, '21', '9', 'Arroba de los Montes', 13),
(1969, '22', '4', 'Ballesteros de Calatrava', 13),
(1970, '23', '0', 'Bolaños de Calatrava', 13),
(1971, '24', '5', 'Brazatortas', 13),
(1972, '25', '8', 'Cabezarados', 13),
(1973, '26', '1', 'Cabezarrubias del Puerto', 13),
(1974, '27', '7', 'Calzada de Calatrava', 13),
(1975, '28', '3', 'Campo de Criptana', 13),
(1976, '29', '6', 'Cañada de Calatrava', 13),
(1977, '30', '0', 'Caracuel de Calatrava', 13),
(1978, '31', '7', 'Carrión de Calatrava', 13),
(1979, '32', '2', 'Carrizosa', 13),
(1980, '33', '8', 'Castellar de Santiago', 13),
(1981, '38', '1', 'Chillón', 13),
(1982, '34', '3', 'Ciudad Real', 13),
(1983, '35', '6', 'Corral de Calatrava', 13),
(1984, '36', '9', 'Cortijos, Los', 13),
(1985, '37', '5', 'Cózar', 13),
(1986, '39', '4', 'Daimiel', 13),
(1987, '40', '8', 'Fernán Caballero', 13),
(1988, '41', '5', 'Fontanarejo', 13),
(1989, '42', '0', 'Fuencaliente', 13),
(1990, '43', '6', 'Fuenllana', 13),
(1991, '44', '1', 'Fuente el Fresno', 13),
(1992, '45', '4', 'Granátula de Calatrava', 13),
(1993, '46', '7', 'Guadalmez', 13),
(1994, '47', '3', 'Herencia', 13),
(1995, '48', '9', 'Hinojosas de Calatrava', 13),
(1996, '49', '2', 'Horcajo de los Montes', 13),
(1997, '50', '5', 'Labores, Las', 13),
(1998, '904', '0', 'Llanos del Caudillo', 13),
(1999, '51', '2', 'Luciana', 13),
(2000, '52', '7', 'Malagón', 13),
(2001, '53', '3', 'Manzanares', 13),
(2002, '54', '8', 'Membrilla', 13),
(2003, '55', '1', 'Mestanza', 13),
(2004, '56', '4', 'Miguelturra', 13),
(2005, '57', '0', 'Montiel', 13),
(2006, '58', '6', 'Moral de Calatrava', 13),
(2007, '59', '9', 'Navalpino', 13),
(2008, '60', '3', 'Navas de Estena', 13),
(2009, '61', '0', 'Pedro Muñoz', 13),
(2010, '62', '5', 'Picón', 13),
(2011, '63', '1', 'Piedrabuena', 13),
(2012, '64', '6', 'Poblete', 13),
(2013, '65', '9', 'Porzuna', 13),
(2014, '66', '2', 'Pozuelo de Calatrava', 13),
(2015, '67', '8', 'Pozuelos de Calatrava, Los', 13),
(2016, '68', '4', 'Puebla de Don Rodrigo', 13),
(2017, '69', '7', 'Puebla del Príncipe', 13),
(2018, '70', '1', 'Puerto Lápice', 13),
(2019, '71', '8', 'Puertollano', 13),
(2020, '72', '3', 'Retuerta del Bullaque', 13),
(2021, '901', '4', 'Robledo, El', 13),
(2022, '902', '9', 'Ruidera', 13),
(2023, '73', '9', 'Saceruela', 13),
(2024, '74', '4', 'San Carlos del Valle', 13),
(2025, '75', '7', 'San Lorenzo de Calatrava', 13),
(2026, '76', '0', 'Santa Cruz de los Cáñamos', 13),
(2027, '77', '6', 'Santa Cruz de Mudela', 13),
(2028, '78', '2', 'Socuéllamos', 13),
(2029, '80', '9', 'Solana del Pino', 13),
(2030, '79', '5', 'Solana, La', 13),
(2031, '81', '6', 'Terrinches', 13),
(2032, '82', '1', 'Tomelloso', 13),
(2033, '83', '7', 'Torralba de Calatrava', 13),
(2034, '84', '2', 'Torre de Juan Abad', 13),
(2035, '85', '5', 'Torrenueva', 13),
(2036, '86', '8', 'Valdemanco del Esteras', 13),
(2037, '87', '4', 'Valdepeñas', 13),
(2038, '88', '0', 'Valenzuela de Calatrava', 13),
(2039, '89', '3', 'Villahermosa', 13),
(2040, '90', '7', 'Villamanrique', 13),
(2041, '91', '4', 'Villamayor de Calatrava', 13),
(2042, '92', '9', 'Villanueva de la Fuente', 13),
(2043, '93', '5', 'Villanueva de los Infantes', 13),
(2044, '94', '0', 'Villanueva de San Carlos', 13),
(2045, '95', '3', 'Villar del Pozo', 13),
(2046, '96', '6', 'Villarrubia de los Ojos', 13),
(2047, '97', '2', 'Villarta de San Juan', 13),
(2048, '98', '8', 'Viso del Marqués', 13),
(2049, '1', '8', 'Adamuz', 14),
(2050, '2', '3', 'Aguilar de la Frontera', 14),
(2051, '3', '9', 'Alcaracejos', 14),
(2052, '4', '4', 'Almedinilla', 14),
(2053, '5', '7', 'Almodóvar del Río', 14),
(2054, '6', '0', 'Añora', 14),
(2055, '7', '6', 'Baena', 14),
(2056, '8', '2', 'Belalcázar', 14),
(2057, '9', '5', 'Belmez', 14),
(2058, '10', '9', 'Benamejí', 14),
(2059, '11', '6', 'Blázquez, Los', 14),
(2060, '12', '1', 'Bujalance', 14),
(2061, '13', '7', 'Cabra', 14),
(2062, '14', '2', 'Cañete de las Torres', 14),
(2063, '15', '5', 'Carcabuey', 14),
(2064, '16', '8', 'Cardeña', 14),
(2065, '17', '4', 'Carlota, La', 14),
(2066, '18', '0', 'Carpio, El', 14),
(2067, '19', '3', 'Castro del Río', 14),
(2068, '20', '7', 'Conquista', 14),
(2069, '21', '4', 'Córdoba', 14),
(2070, '22', '9', 'Doña Mencía', 14),
(2071, '23', '5', 'Dos Torres', 14),
(2072, '24', '0', 'Encinas Reales', 14),
(2073, '25', '3', 'Espejo', 14),
(2074, '26', '6', 'Espiel', 14),
(2075, '27', '2', 'Fernán-Núñez', 14),
(2076, '28', '8', 'Fuente la Lancha', 14),
(2077, '29', '1', 'Fuente Obejuna', 14),
(2078, '30', '5', 'Fuente Palmera', 14),
(2079, '31', '2', 'Fuente-Tójar', 14),
(2080, '32', '7', 'Granjuela, La', 14),
(2081, '33', '3', 'Guadalcázar', 14),
(2082, '34', '8', 'Guijo, El', 14),
(2083, '35', '1', 'Hinojosa del Duque', 14),
(2084, '36', '4', 'Hornachuelos', 14),
(2085, '37', '0', 'Iznájar', 14),
(2086, '38', '6', 'Lucena', 14),
(2087, '39', '9', 'Luque', 14),
(2088, '40', '3', 'Montalbán de Córdoba', 14),
(2089, '41', '0', 'Montemayor', 14),
(2090, '42', '5', 'Montilla', 14),
(2091, '43', '1', 'Montoro', 14),
(2092, '44', '6', 'Monturque', 14),
(2093, '45', '9', 'Moriles', 14),
(2094, '46', '2', 'Nueva Carteya', 14),
(2095, '47', '8', 'Obejo', 14),
(2096, '48', '4', 'Palenciana', 14),
(2097, '49', '7', 'Palma del Río', 14),
(2098, '50', '0', 'Pedro Abad', 14),
(2099, '51', '7', 'Pedroche', 14),
(2100, '52', '2', 'Peñarroya-Pueblonuevo', 14),
(2101, '53', '8', 'Posadas', 14),
(2102, '54', '3', 'Pozoblanco', 14),
(2103, '55', '6', 'Priego de Córdoba', 14),
(2104, '56', '9', 'Puente Genil', 14),
(2105, '57', '5', 'Rambla, La', 14),
(2106, '58', '1', 'Rute', 14),
(2107, '59', '4', 'San Sebastián de los Ballesteros', 14),
(2108, '61', '5', 'Santa Eufemia', 14),
(2109, '60', '8', 'Santaella', 14),
(2110, '62', '0', 'Torrecampo', 14),
(2111, '63', '6', 'Valenzuela', 14),
(2112, '64', '1', 'Valsequillo', 14),
(2113, '65', '4', 'Victoria, La', 14),
(2114, '66', '7', 'Villa del Río', 14),
(2115, '67', '3', 'Villafranca de Córdoba', 14),
(2116, '68', '9', 'Villaharta', 14),
(2117, '69', '2', 'Villanueva de Córdoba', 14),
(2118, '70', '6', 'Villanueva del Duque', 14),
(2119, '71', '3', 'Villanueva del Rey', 14),
(2120, '72', '8', 'Villaralto', 14),
(2121, '73', '4', 'Villaviciosa de Córdoba', 14),
(2122, '74', '9', 'Viso, El', 14),
(2123, '75', '2', 'Zuheros', 14),
(2124, '1', '1', 'Abegondo', 15),
(2125, '2', '6', 'Ames', 15),
(2126, '3', '2', 'Aranga', 15),
(2127, '4', '7', 'Ares', 15),
(2128, '5', '0', 'Arteixo', 15),
(2129, '6', '3', 'Arzúa', 15),
(2130, '7', '9', 'Baña, A', 15),
(2131, '8', '5', 'Bergondo', 15),
(2132, '9', '8', 'Betanzos', 15),
(2133, '10', '2', 'Boimorto', 15),
(2134, '11', '9', 'Boiro', 15),
(2135, '12', '4', 'Boqueixón', 15),
(2136, '13', '0', 'Brión', 15),
(2137, '14', '5', 'Cabana de Bergantiños', 15),
(2138, '15', '8', 'Cabanas', 15),
(2139, '16', '1', 'Camariñas', 15),
(2140, '17', '7', 'Cambre', 15),
(2141, '18', '3', 'Capela, A', 15),
(2142, '19', '6', 'Carballo', 15),
(2143, '901', '2', 'Cariño', 15),
(2144, '20', '0', 'Carnota', 15),
(2145, '21', '7', 'Carral', 15),
(2146, '22', '2', 'Cedeira', 15),
(2147, '23', '8', 'Cee', 15),
(2148, '24', '3', 'Cerceda', 15),
(2149, '25', '6', 'Cerdido', 15),
(2150, '27', '5', 'Coirós', 15),
(2151, '28', '1', 'Corcubión', 15),
(2152, '29', '4', 'Coristanco', 15),
(2153, '30', '8', 'Coruña, A', 15),
(2154, '31', '5', 'Culleredo', 15),
(2155, '32', '0', 'Curtis', 15),
(2156, '33', '6', 'Dodro', 15),
(2157, '34', '1', 'Dumbría', 15),
(2158, '35', '4', 'Fene', 15),
(2159, '36', '7', 'Ferrol', 15),
(2160, '37', '3', 'Fisterra', 15),
(2161, '38', '9', 'Frades', 15),
(2162, '39', '2', 'Irixoa', 15),
(2163, '41', '3', 'Laracha, A', 15),
(2164, '40', '6', 'Laxe', 15),
(2165, '42', '8', 'Lousame', 15),
(2166, '43', '4', 'Malpica de Bergantiños', 15),
(2167, '44', '9', 'Mañón', 15),
(2168, '45', '2', 'Mazaricos', 15),
(2169, '46', '5', 'Melide', 15),
(2170, '47', '1', 'Mesía', 15),
(2171, '48', '7', 'Miño', 15),
(2172, '49', '0', 'Moeche', 15),
(2173, '50', '3', 'Monfero', 15),
(2174, '51', '0', 'Mugardos', 15),
(2175, '53', '1', 'Muros', 15),
(2176, '52', '5', 'Muxía', 15),
(2177, '54', '6', 'Narón', 15),
(2178, '55', '9', 'Neda', 15),
(2179, '56', '2', 'Negreira', 15),
(2180, '57', '8', 'Noia', 15),
(2181, '58', '4', 'Oleiros', 15),
(2182, '59', '7', 'Ordes', 15),
(2183, '60', '1', 'Oroso', 15),
(2184, '61', '8', 'Ortigueira', 15),
(2185, '62', '3', 'Outes', 15),
(2186, '902', '7', 'Oza-Cesuras', 15),
(2187, '64', '4', 'Paderne', 15),
(2188, '65', '7', 'Padrón', 15),
(2189, '66', '0', 'Pino, O', 15),
(2190, '67', '6', 'Pobra do Caramiñal, A', 15),
(2191, '68', '2', 'Ponteceso', 15),
(2192, '69', '5', 'Pontedeume', 15),
(2193, '70', '9', 'Pontes de García Rodríguez, As', 15),
(2194, '71', '6', 'Porto do Son', 15),
(2195, '72', '1', 'Rianxo', 15),
(2196, '73', '7', 'Ribeira', 15),
(2197, '74', '2', 'Rois', 15),
(2198, '75', '5', 'Sada', 15),
(2199, '76', '8', 'San Sadurniño', 15),
(2200, '77', '4', 'Santa Comba', 15),
(2201, '78', '0', 'Santiago de Compostela', 15),
(2202, '79', '3', 'Santiso', 15),
(2203, '80', '7', 'Sobrado', 15),
(2204, '81', '4', 'Somozas, As', 15),
(2205, '82', '9', 'Teo', 15),
(2206, '83', '5', 'Toques', 15),
(2207, '84', '0', 'Tordoia', 15),
(2208, '85', '3', 'Touro', 15),
(2209, '86', '6', 'Trazo', 15),
(2210, '88', '8', 'Val do Dubra', 15),
(2211, '87', '2', 'Valdoviño', 15),
(2212, '89', '1', 'Vedra', 15),
(2213, '91', '2', 'Vilarmaior', 15),
(2214, '90', '5', 'Vilasantar', 15),
(2215, '92', '7', 'Vimianzo', 15),
(2216, '93', '3', 'Zas', 15),
(2217, '1', '4', 'Abia de la Obispalía', 16),
(2218, '2', '9', 'Acebrón, El', 16),
(2219, '3', '5', 'Alarcón', 16),
(2220, '4', '0', 'Albaladejo del Cuende', 16),
(2221, '5', '3', 'Albalate de las Nogueras', 16),
(2222, '6', '6', 'Albendea', 16),
(2223, '7', '2', 'Alberca de Záncara, La', 16),
(2224, '8', '8', 'Alcalá de la Vega', 16),
(2225, '9', '1', 'Alcantud', 16),
(2226, '10', '5', 'Alcázar del Rey', 16),
(2227, '11', '2', 'Alcohujate', 16),
(2228, '12', '7', 'Alconchel de la Estrella', 16),
(2229, '13', '3', 'Algarra', 16),
(2230, '14', '8', 'Aliaguilla', 16),
(2231, '15', '1', 'Almarcha, La', 16),
(2232, '16', '4', 'Almendros', 16),
(2233, '17', '0', 'Almodóvar del Pinar', 16),
(2234, '18', '6', 'Almonacid del Marquesado', 16),
(2235, '19', '9', 'Altarejos', 16),
(2236, '20', '3', 'Arandilla del Arroyo', 16),
(2237, '905', '4', 'Arcas', 16),
(2238, '22', '5', 'Arcos de la Sierra', 16),
(2239, '24', '6', 'Arguisuelas', 16),
(2240, '25', '9', 'Arrancacepas', 16),
(2241, '26', '2', 'Atalaya del Cañavate', 16),
(2242, '27', '8', 'Barajas de Melo', 16),
(2243, '29', '7', 'Barchín del Hoyo', 16),
(2244, '30', '1', 'Bascuñana de San Pedro', 16),
(2245, '31', '8', 'Beamud', 16),
(2246, '32', '3', 'Belinchón', 16),
(2247, '33', '9', 'Belmonte', 16),
(2248, '34', '4', 'Belmontejo', 16),
(2249, '35', '7', 'Beteta', 16),
(2250, '36', '0', 'Boniches', 16),
(2251, '38', '2', 'Buciegas', 16),
(2252, '39', '5', 'Buenache de Alarcón', 16),
(2253, '40', '9', 'Buenache de la Sierra', 16),
(2254, '41', '6', 'Buendía', 16),
(2255, '42', '1', 'Campillo de Altobuey', 16),
(2256, '43', '7', 'Campillos-Paravientos', 16),
(2257, '44', '2', 'Campillos-Sierra', 16),
(2258, '901', '5', 'Campos del Paraíso', 16),
(2259, '45', '5', 'Canalejas del Arroyo', 16),
(2260, '46', '8', 'Cañada del Hoyo', 16),
(2261, '47', '4', 'Cañada Juncosa', 16),
(2262, '48', '0', 'Cañamares', 16),
(2263, '49', '3', 'Cañavate, El', 16),
(2264, '50', '6', 'Cañaveras', 16),
(2265, '51', '3', 'Cañaveruelas', 16),
(2266, '52', '8', 'Cañete', 16),
(2267, '53', '4', 'Cañizares', 16),
(2268, '55', '2', 'Carboneras de Guadazaón', 16),
(2269, '56', '5', 'Cardenete', 16),
(2270, '57', '1', 'Carrascosa', 16),
(2271, '58', '7', 'Carrascosa de Haro', 16),
(2272, '60', '4', 'Casas de Benítez', 16),
(2273, '61', '1', 'Casas de Fernando Alonso', 16),
(2274, '62', '6', 'Casas de Garcimolina', 16),
(2275, '63', '2', 'Casas de Guijarro', 16),
(2276, '64', '7', 'Casas de Haro', 16),
(2277, '65', '0', 'Casas de los Pinos', 16),
(2278, '66', '3', 'Casasimarro', 16),
(2279, '67', '9', 'Castejón', 16),
(2280, '68', '5', 'Castillejo de Iniesta', 16),
(2281, '70', '2', 'Castillejo-Sierra', 16),
(2282, '72', '4', 'Castillo de Garcimuñoz', 16),
(2283, '71', '9', 'Castillo-Albaráñez', 16),
(2284, '73', '0', 'Cervera del Llano', 16),
(2285, '23', '1', 'Chillarón de Cuenca', 16),
(2286, '81', '7', 'Chumillas', 16),
(2287, '74', '5', 'Cierva, La', 16),
(2288, '78', '3', 'Cuenca', 16),
(2289, '79', '6', 'Cueva del Hierro', 16),
(2290, '82', '2', 'Enguídanos', 16),
(2291, '83', '8', 'Fresneda de Altarejos', 16),
(2292, '84', '3', 'Fresneda de la Sierra', 16),
(2293, '85', '6', 'Frontera, La', 16),
(2294, '86', '9', 'Fuente de Pedro Naharro', 16),
(2295, '87', '5', 'Fuentelespino de Haro', 16),
(2296, '88', '1', 'Fuentelespino de Moya', 16),
(2297, '904', '1', 'Fuentenava de Jábaga', 16),
(2298, '89', '4', 'Fuentes', 16),
(2299, '91', '5', 'Fuertescusa', 16),
(2300, '92', '0', 'Gabaldón', 16),
(2301, '93', '6', 'Garaballa', 16),
(2302, '94', '1', 'Gascueña', 16),
(2303, '95', '4', 'Graja de Campalbo', 16),
(2304, '96', '7', 'Graja de Iniesta', 16),
(2305, '97', '3', 'Henarejos', 16),
(2306, '98', '9', 'Herrumblar, El', 16),
(2307, '99', '2', 'Hinojosa, La', 16),
(2308, '100', '6', 'Hinojosos, Los', 16),
(2309, '101', '3', 'Hito, El', 16),
(2310, '102', '8', 'Honrubia', 16),
(2311, '103', '4', 'Hontanaya', 16),
(2312, '104', '9', 'Hontecillas', 16),
(2313, '106', '5', 'Horcajo de Santiago', 16),
(2314, '107', '1', 'Huélamo', 16),
(2315, '108', '7', 'Huelves', 16),
(2316, '109', '0', 'Huérguina', 16),
(2317, '110', '4', 'Huerta de la Obispalía', 16),
(2318, '111', '1', 'Huerta del Marquesado', 16),
(2319, '112', '6', 'Huete', 16),
(2320, '113', '2', 'Iniesta', 16),
(2321, '115', '0', 'Laguna del Marquesado', 16),
(2322, '116', '3', 'Lagunaseca', 16),
(2323, '117', '9', 'Landete', 16),
(2324, '118', '5', 'Ledaña', 16),
(2325, '119', '8', 'Leganiel', 16),
(2326, '121', '9', 'Majadas, Las', 16),
(2327, '122', '4', 'Mariana', 16),
(2328, '123', '0', 'Masegosa', 16),
(2329, '124', '5', 'Mesas, Las', 16),
(2330, '125', '8', 'Minglanilla', 16),
(2331, '126', '1', 'Mira', 16),
(2332, '128', '3', 'Monreal del Llano', 16),
(2333, '129', '6', 'Montalbanejo', 16),
(2334, '130', '0', 'Montalbo', 16),
(2335, '131', '7', 'Monteagudo de las Salinas', 16),
(2336, '132', '2', 'Mota de Altarejos', 16),
(2337, '133', '8', 'Mota del Cuervo', 16),
(2338, '134', '3', 'Motilla del Palancar', 16),
(2339, '135', '6', 'Moya', 16),
(2340, '137', '5', 'Narboneta', 16),
(2341, '139', '4', 'Olivares de Júcar', 16),
(2342, '140', '8', 'Olmeda de la Cuesta', 16),
(2343, '141', '5', 'Olmeda del Rey', 16),
(2344, '142', '0', 'Olmedilla de Alarcón', 16),
(2345, '143', '6', 'Olmedilla de Eliz', 16),
(2346, '145', '4', 'Osa de la Vega', 16),
(2347, '146', '7', 'Pajarón', 16),
(2348, '147', '3', 'Pajaroncillo', 16),
(2349, '148', '9', 'Palomares del Campo', 16),
(2350, '149', '2', 'Palomera', 16),
(2351, '150', '5', 'Paracuellos', 16),
(2352, '151', '2', 'Paredes', 16),
(2353, '152', '7', 'Parra de las Vegas, La', 16),
(2354, '153', '3', 'Pedernoso, El', 16),
(2355, '154', '8', 'Pedroñeras, Las', 16),
(2356, '155', '1', 'Peral, El', 16),
(2357, '156', '4', 'Peraleja, La', 16),
(2358, '157', '0', 'Pesquera, La', 16),
(2359, '158', '6', 'Picazo, El', 16),
(2360, '159', '9', 'Pinarejo', 16),
(2361, '160', '3', 'Pineda de Gigüela', 16),
(2362, '161', '0', 'Piqueras del Castillo', 16),
(2363, '162', '5', 'Portalrubio de Guadamejud', 16),
(2364, '163', '1', 'Portilla', 16),
(2365, '165', '9', 'Poyatos', 16),
(2366, '166', '2', 'Pozoamargo', 16),
(2367, '908', '9', 'Pozorrubielos de la Mancha', 16),
(2368, '167', '8', 'Pozorrubio de Santiago', 16),
(2369, '169', '7', 'Pozuelo, El', 16),
(2370, '170', '1', 'Priego', 16),
(2371, '171', '8', 'Provencio, El', 16),
(2372, '172', '3', 'Puebla de Almenara', 16),
(2373, '174', '4', 'Puebla del Salvador', 16),
(2374, '175', '7', 'Quintanar del Rey', 16),
(2375, '176', '0', 'Rada de Haro', 16),
(2376, '177', '6', 'Reíllo', 16),
(2377, '181', '6', 'Rozalén del Monte', 16),
(2378, '185', '5', 'Saceda-Trasierra', 16),
(2379, '186', '8', 'Saelices', 16),
(2380, '187', '4', 'Salinas del Manzano', 16),
(2381, '188', '0', 'Salmeroncillos', 16),
(2382, '189', '3', 'Salvacañete', 16),
(2383, '190', '7', 'San Clemente', 16),
(2384, '191', '4', 'San Lorenzo de la Parrilla', 16),
(2385, '192', '9', 'San Martín de Boniches', 16),
(2386, '193', '5', 'San Pedro Palmiches', 16),
(2387, '194', '0', 'Santa Cruz de Moya', 16),
(2388, '196', '6', 'Santa María de los Llanos', 16),
(2389, '195', '3', 'Santa María del Campo Rus', 16),
(2390, '197', '2', 'Santa María del Val', 16),
(2391, '198', '8', 'Sisante', 16),
(2392, '199', '1', 'Solera de Gabaldón', 16),
(2393, '909', '2', 'Sotorribas', 16),
(2394, '202', '7', 'Talayuelas', 16),
(2395, '203', '3', 'Tarancón', 16),
(2396, '204', '8', 'Tébar', 16),
(2397, '205', '1', 'Tejadillos', 16),
(2398, '206', '4', 'Tinajas', 16),
(2399, '209', '9', 'Torralba', 16),
(2400, '211', '0', 'Torrejoncillo del Rey', 16),
(2401, '212', '5', 'Torrubia del Campo', 16),
(2402, '213', '1', 'Torrubia del Castillo', 16),
(2403, '215', '9', 'Tragacete', 16),
(2404, '216', '2', 'Tresjuncos', 16),
(2405, '217', '8', 'Tribaldos', 16),
(2406, '218', '4', 'Uclés', 16),
(2407, '219', '7', 'Uña', 16),
(2408, '906', '7', 'Valdecolmenas, Los', 16),
(2409, '224', '4', 'Valdemeca', 16),
(2410, '225', '7', 'Valdemorillo de la Sierra', 16),
(2411, '227', '6', 'Valdemoro-Sierra', 16),
(2412, '228', '2', 'Valdeolivas', 16),
(2413, '902', '0', 'Valdetórtola', 16),
(2414, '903', '6', 'Valeras, Las', 16),
(2415, '231', '6', 'Valhermoso de la Fuente', 16),
(2416, '173', '9', 'Valle de Altomira, El', 16),
(2417, '234', '2', 'Valsalobre', 16),
(2418, '236', '8', 'Valverde de Júcar', 16),
(2419, '237', '4', 'Valverdejo', 16),
(2420, '238', '0', 'Vara de Rey', 16),
(2421, '239', '3', 'Vega del Codorno', 16),
(2422, '240', '7', 'Vellisca', 16),
(2423, '242', '9', 'Villaconejos de Trabaque', 16),
(2424, '243', '5', 'Villaescusa de Haro', 16),
(2425, '244', '0', 'Villagarcía del Llano', 16),
(2426, '245', '3', 'Villalba de la Sierra', 16),
(2427, '246', '6', 'Villalba del Rey', 16),
(2428, '247', '2', 'Villalgordo del Marquesado', 16),
(2429, '248', '8', 'Villalpardo', 16),
(2430, '249', '1', 'Villamayor de Santiago', 16),
(2431, '250', '4', 'Villanueva de Guadamejud', 16),
(2432, '251', '1', 'Villanueva de la Jara', 16),
(2433, '253', '2', 'Villar de Cañas', 16),
(2434, '254', '7', 'Villar de Domingo García', 16),
(2435, '255', '0', 'Villar de la Encina', 16),
(2436, '263', '0', 'Villar de Olalla', 16),
(2437, '258', '5', 'Villar del Humo', 16),
(2438, '259', '8', 'Villar del Infantado', 16),
(2439, '910', '6', 'Villar y Velasco', 16),
(2440, '264', '5', 'Villarejo de Fuentes', 16),
(2441, '265', '8', 'Villarejo de la Peñuela', 16),
(2442, '266', '1', 'Villarejo-Periesteban', 16),
(2443, '269', '6', 'Villares del Saz', 16),
(2444, '270', '0', 'Villarrubio', 16),
(2445, '271', '7', 'Villarta', 16),
(2446, '272', '2', 'Villas de la Ventosa', 16),
(2447, '273', '8', 'Villaverde y Pasaconsol', 16),
(2448, '274', '3', 'Víllora', 16),
(2449, '275', '6', 'Vindel', 16),
(2450, '276', '9', 'Yémeda', 16),
(2451, '277', '5', 'Zafra de Záncara', 16),
(2452, '278', '1', 'Zafrilla', 16),
(2453, '279', '4', 'Zarza de Tajo', 16),
(2454, '280', '8', 'Zarzuela', 16),
(2455, '1', '0', 'Agullana', 17),
(2456, '2', '5', 'Aiguaviva', 17),
(2457, '3', '1', 'Albanyà', 17),
(2458, '4', '6', 'Albons', 17),
(2459, '6', '2', 'Alp', 17),
(2460, '7', '8', 'Amer', 17),
(2461, '8', '4', 'Anglès', 17),
(2462, '9', '7', 'Arbúcies', 17),
(2463, '10', '1', 'Argelaguer', 17),
(2464, '11', '8', 'Armentera, L\'', 17),
(2465, '12', '3', 'Avinyonet de Puigventós', 17),
(2466, '15', '7', 'Banyoles', 17),
(2467, '16', '0', 'Bàscara', 17),
(2468, '13', '9', 'Begur', 17),
(2469, '18', '2', 'Bellcaire d\'Empordà', 17),
(2470, '19', '5', 'Besalú', 17),
(2471, '20', '9', 'Bescanó', 17),
(2472, '21', '6', 'Beuda', 17),
(2473, '22', '1', 'Bisbal d\'Empordà, La', 17),
(2474, '234', '8', 'Biure', 17),
(2475, '23', '7', 'Blanes', 17),
(2476, '29', '3', 'Boadella i les Escaules', 17),
(2477, '24', '2', 'Bolvir', 17),
(2478, '25', '5', 'Bordils', 17),
(2479, '26', '8', 'Borrassà', 17),
(2480, '27', '4', 'Breda', 17),
(2481, '28', '0', 'Brunyola', 17),
(2482, '31', '4', 'Cabanelles', 17),
(2483, '30', '7', 'Cabanes', 17),
(2484, '32', '9', 'Cadaqués', 17),
(2485, '33', '5', 'Caldes de Malavella', 17),
(2486, '34', '0', 'Calonge', 17),
(2487, '35', '3', 'Camós', 17),
(2488, '36', '6', 'Campdevànol', 17),
(2489, '37', '2', 'Campelles', 17),
(2490, '38', '8', 'Campllong', 17),
(2491, '39', '1', 'Camprodon', 17),
(2492, '40', '5', 'Canet d\'Adri', 17),
(2493, '41', '2', 'Cantallops', 17),
(2494, '42', '7', 'Capmany', 17),
(2495, '44', '8', 'Cassà de la Selva', 17),
(2496, '46', '4', 'Castellfollit de la Roca', 17),
(2497, '47', '0', 'Castelló d\'Empúries', 17),
(2498, '48', '6', 'Castell-Platja d\'Aro', 17),
(2499, '189', '9', 'Cellera de Ter, La', 17),
(2500, '49', '9', 'Celrà', 17),
(2501, '50', '2', 'Cervià de Ter', 17),
(2502, '51', '9', 'Cistella', 17),
(2503, '54', '5', 'Colera', 17),
(2504, '55', '8', 'Colomers', 17),
(2505, '57', '7', 'Corçà', 17),
(2506, '56', '1', 'Cornellà del Terri', 17),
(2507, '58', '3', 'Crespià', 17),
(2508, '901', '1', 'Cruïlles, Monells i Sant Sadurní de l\'Heura', 17),
(2509, '60', '0', 'Darnius', 17),
(2510, '61', '7', 'Das', 17),
(2511, '62', '2', 'Escala, L\'', 17),
(2512, '63', '8', 'Espinelves', 17),
(2513, '64', '3', 'Espolla', 17),
(2514, '65', '6', 'Esponellà', 17),
(2515, '5', '9', 'Far d\'Empordà, El', 17),
(2516, '66', '9', 'Figueres', 17),
(2517, '67', '5', 'Flaçà', 17),
(2518, '68', '1', 'Foixà', 17),
(2519, '69', '4', 'Fontanals de Cerdanya', 17),
(2520, '70', '8', 'Fontanilles', 17),
(2521, '71', '5', 'Fontcoberta', 17),
(2522, '902', '6', 'Forallac', 17),
(2523, '73', '6', 'Fornells de la Selva', 17),
(2524, '74', '1', 'Fortià', 17),
(2525, '75', '4', 'Garrigàs', 17),
(2526, '76', '7', 'Garrigoles', 17),
(2527, '77', '3', 'Garriguella', 17),
(2528, '78', '9', 'Ger', 17),
(2529, '79', '2', 'Girona', 17),
(2530, '80', '6', 'Gombrèn', 17),
(2531, '81', '3', 'Gualta', 17),
(2532, '82', '8', 'Guils de Cerdanya', 17),
(2533, '83', '4', 'Hostalric', 17),
(2534, '84', '9', 'Isòvol', 17),
(2535, '85', '2', 'Jafre', 17),
(2536, '86', '5', 'Jonquera, La', 17),
(2537, '87', '1', 'Juià', 17),
(2538, '88', '7', 'Lladó', 17),
(2539, '89', '0', 'Llagostera', 17),
(2540, '90', '4', 'Llambilles', 17),
(2541, '91', '1', 'Llanars', 17),
(2542, '92', '6', 'Llançà', 17),
(2543, '93', '2', 'Llers', 17),
(2544, '94', '7', 'Llívia', 17),
(2545, '95', '0', 'Lloret de Mar', 17),
(2546, '96', '3', 'Llosses, Les', 17),
(2547, '102', '4', 'Maçanet de Cabrenys', 17),
(2548, '103', '0', 'Maçanet de la Selva', 17),
(2549, '97', '9', 'Madremanya', 17),
(2550, '98', '5', 'Maià de Montcal', 17),
(2551, '100', '2', 'Masarac', 17),
(2552, '101', '9', 'Massanes', 17),
(2553, '99', '8', 'Meranges', 17),
(2554, '105', '8', 'Mieres', 17),
(2555, '106', '1', 'Mollet de Peralada', 17),
(2556, '107', '7', 'Molló', 17),
(2557, '109', '6', 'Montagut i Oix', 17),
(2558, '110', '0', 'Mont-ras', 17),
(2559, '111', '7', 'Navata', 17),
(2560, '112', '2', 'Ogassa', 17),
(2561, '114', '3', 'Olot', 17),
(2562, '115', '6', 'Ordis', 17),
(2563, '116', '9', 'Osor', 17),
(2564, '117', '5', 'Palafrugell', 17),
(2565, '118', '1', 'Palamós', 17),
(2566, '119', '4', 'Palau de Santa Eulàlia', 17),
(2567, '121', '5', 'Palau-sator', 17),
(2568, '120', '8', 'Palau-saverdera', 17),
(2569, '123', '6', 'Palol de Revardit', 17),
(2570, '124', '1', 'Pals', 17),
(2571, '125', '4', 'Pardines', 17),
(2572, '126', '7', 'Parlavà', 17),
(2573, '128', '9', 'Pau', 17),
(2574, '129', '2', 'Pedret i Marzà', 17),
(2575, '130', '6', 'Pera, La', 17),
(2576, '132', '8', 'Peralada', 17),
(2577, '133', '4', 'Planes d\'Hostoles, Les', 17),
(2578, '134', '9', 'Planoles', 17),
(2579, '135', '2', 'Pont de Molins', 17),
(2580, '136', '5', 'Pontós', 17),
(2581, '137', '1', 'Porqueres', 17),
(2582, '140', '4', 'Port de la Selva, El', 17),
(2583, '138', '7', 'Portbou', 17),
(2584, '139', '0', 'Preses, Les', 17),
(2585, '141', '1', 'Puigcerdà', 17),
(2586, '142', '6', 'Quart', 17),
(2587, '43', '3', 'Queralbs', 17),
(2588, '143', '2', 'Rabós', 17),
(2589, '144', '7', 'Regencós', 17),
(2590, '145', '0', 'Ribes de Freser', 17),
(2591, '146', '3', 'Riells i Viabrea', 17),
(2592, '147', '9', 'Ripoll', 17),
(2593, '148', '5', 'Riudarenes', 17),
(2594, '149', '8', 'Riudaura', 17),
(2595, '150', '1', 'Riudellots de la Selva', 17),
(2596, '151', '8', 'Riumors', 17),
(2597, '152', '3', 'Roses', 17),
(2598, '153', '9', 'Rupià', 17),
(2599, '154', '4', 'Sales de Llierca', 17),
(2600, '155', '7', 'Salt', 17),
(2601, '157', '6', 'Sant Andreu Salou', 17),
(2602, '183', '3', 'Sant Aniol de Finestres', 17),
(2603, '158', '2', 'Sant Climent Sescebes', 17),
(2604, '159', '5', 'Sant Feliu de Buixalleu', 17),
(2605, '160', '9', 'Sant Feliu de Guíxols', 17),
(2606, '161', '6', 'Sant Feliu de Pallerols', 17),
(2607, '162', '1', 'Sant Ferriol', 17),
(2608, '163', '7', 'Sant Gregori', 17),
(2609, '164', '2', 'Sant Hilari Sacalm', 17),
(2610, '165', '5', 'Sant Jaume de Llierca', 17),
(2611, '167', '4', 'Sant Joan de les Abadesses', 17),
(2612, '168', '0', 'Sant Joan de Mollet', 17),
(2613, '185', '1', 'Sant Joan les Fonts', 17),
(2614, '166', '8', 'Sant Jordi Desvalls', 17),
(2615, '169', '3', 'Sant Julià de Ramis', 17),
(2616, '903', '2', 'Sant Julià del Llor i Bonmatí', 17),
(2617, '171', '4', 'Sant Llorenç de la Muga', 17),
(2618, '172', '9', 'Sant Martí de Llémena', 17),
(2619, '173', '5', 'Sant Martí Vell', 17),
(2620, '174', '0', 'Sant Miquel de Campmajor', 17),
(2621, '175', '3', 'Sant Miquel de Fluvià', 17),
(2622, '176', '6', 'Sant Mori', 17),
(2623, '177', '2', 'Sant Pau de Segúries', 17),
(2624, '178', '8', 'Sant Pere Pescador', 17),
(2625, '180', '5', 'Santa Coloma de Farners', 17),
(2626, '181', '2', 'Santa Cristina d\'Aro', 17),
(2627, '182', '7', 'Santa Llogaia d\'Àlguema', 17),
(2628, '184', '8', 'Santa Pau', 17),
(2629, '186', '4', 'Sarrià de Ter', 17),
(2630, '187', '0', 'Saus, Camallera i Llampaies', 17),
(2631, '188', '6', 'Selva de Mar, La', 17),
(2632, '190', '3', 'Serinyà', 17),
(2633, '191', '0', 'Serra de Daró', 17),
(2634, '192', '5', 'Setcases', 17),
(2635, '193', '1', 'Sils', 17),
(2636, '52', '4', 'Siurana', 17),
(2637, '194', '6', 'Susqueda', 17),
(2638, '195', '9', 'Tallada d\'Empordà, La', 17),
(2639, '196', '2', 'Terrades', 17),
(2640, '197', '8', 'Torrent', 17),
(2641, '198', '4', 'Torroella de Fluvià', 17),
(2642, '199', '7', 'Torroella de Montgrí', 17),
(2643, '200', '1', 'Tortellà', 17),
(2644, '201', '8', 'Toses', 17),
(2645, '202', '3', 'Tossa de Mar', 17),
(2646, '204', '4', 'Ullà', 17),
(2647, '205', '7', 'Ullastret', 17),
(2648, '203', '9', 'Ultramort', 17),
(2649, '206', '0', 'Urús', 17),
(2650, '14', '4', 'Vajol, La', 17),
(2651, '208', '2', 'Vall de Bianya, La', 17),
(2652, '207', '6', 'Vall d\'en Bas, La', 17),
(2653, '170', '7', 'Vallfogona de Ripollès', 17),
(2654, '209', '5', 'Vall-llobrega', 17),
(2655, '210', '9', 'Ventalló', 17),
(2656, '211', '6', 'Verges', 17),
(2657, '212', '1', 'Vidrà', 17),
(2658, '213', '7', 'Vidreres', 17),
(2659, '214', '2', 'Vilabertran', 17),
(2660, '215', '5', 'Vilablareix', 17),
(2661, '217', '4', 'Viladamat', 17),
(2662, '216', '8', 'Viladasens', 17),
(2663, '218', '0', 'Vilademuls', 17),
(2664, '220', '7', 'Viladrau', 17),
(2665, '221', '4', 'Vilafant', 17),
(2666, '223', '5', 'Vilajuïga', 17),
(2667, '224', '0', 'Vilallonga de Ter', 17),
(2668, '225', '3', 'Vilamacolum', 17),
(2669, '226', '6', 'Vilamalla', 17),
(2670, '227', '2', 'Vilamaniscle', 17),
(2671, '228', '8', 'Vilanant', 17),
(2672, '230', '5', 'Vila-sacra', 17),
(2673, '222', '9', 'Vilaür', 17),
(2674, '233', '3', 'Vilobí d\'Onyar', 17),
(2675, '232', '7', 'Vilopriu', 17),
(2676, '1', '6', 'Agrón', 18);
INSERT INTO `poblaciones` (`id`, `codigo`, `cp`, `poblacion`, `provincia_id`) VALUES
(2677, '2', '1', 'Alamedilla', 18),
(2678, '3', '7', 'Albolote', 18),
(2679, '4', '2', 'Albondón', 18),
(2680, '5', '5', 'Albuñán', 18),
(2681, '6', '8', 'Albuñol', 18),
(2682, '7', '4', 'Albuñuelas', 18),
(2683, '10', '7', 'Aldeire', 18),
(2684, '11', '4', 'Alfacar', 18),
(2685, '12', '9', 'Algarinejo', 18),
(2686, '13', '5', 'Alhama de Granada', 18),
(2687, '14', '0', 'Alhendín', 18),
(2688, '15', '3', 'Alicún de Ortega', 18),
(2689, '16', '6', 'Almegíjar', 18),
(2690, '17', '2', 'Almuñécar', 18),
(2691, '904', '3', 'Alpujarra de la Sierra', 18),
(2692, '18', '8', 'Alquife', 18),
(2693, '20', '5', 'Arenas del Rey', 18),
(2694, '21', '2', 'Armilla', 18),
(2695, '22', '7', 'Atarfe', 18),
(2696, '23', '3', 'Baza', 18),
(2697, '24', '8', 'Beas de Granada', 18),
(2698, '25', '1', 'Beas de Guadix', 18),
(2699, '27', '0', 'Benalúa', 18),
(2700, '28', '6', 'Benalúa de las Villas', 18),
(2701, '29', '9', 'Benamaurel', 18),
(2702, '30', '3', 'Bérchules', 18),
(2703, '32', '5', 'Bubión', 18),
(2704, '33', '1', 'Busquístar', 18),
(2705, '34', '6', 'Cacín', 18),
(2706, '35', '9', 'Cádiar', 18),
(2707, '36', '2', 'Cájar', 18),
(2708, '114', '9', 'Calahorra, La', 18),
(2709, '37', '8', 'Calicasas', 18),
(2710, '38', '4', 'Campotéjar', 18),
(2711, '39', '7', 'Caniles', 18),
(2712, '40', '1', 'Cáñar', 18),
(2713, '42', '3', 'Capileira', 18),
(2714, '43', '9', 'Carataunas', 18),
(2715, '44', '4', 'Cástaras', 18),
(2716, '45', '7', 'Castilléjar', 18),
(2717, '46', '0', 'Castril', 18),
(2718, '47', '6', 'Cenes de la Vega', 18),
(2719, '59', '2', 'Chauchina', 18),
(2720, '61', '3', 'Chimeneas', 18),
(2721, '62', '8', 'Churriana de la Vega', 18),
(2722, '48', '2', 'Cijuela', 18),
(2723, '49', '5', 'Cogollos de Guadix', 18),
(2724, '50', '8', 'Cogollos de la Vega', 18),
(2725, '51', '5', 'Colomera', 18),
(2726, '53', '6', 'Cortes de Baza', 18),
(2727, '54', '1', 'Cortes y Graena', 18),
(2728, '912', '0', 'Cuevas del Campo', 18),
(2729, '56', '7', 'Cúllar', 18),
(2730, '57', '3', 'Cúllar Vega', 18),
(2731, '63', '4', 'Darro', 18),
(2732, '64', '9', 'Dehesas de Guadix', 18),
(2733, '65', '2', 'Dehesas Viejas', 18),
(2734, '66', '5', 'Deifontes', 18),
(2735, '67', '1', 'Diezma', 18),
(2736, '68', '7', 'Dílar', 18),
(2737, '69', '0', 'Dólar', 18),
(2738, '915', '4', 'Domingo Pérez de Granada', 18),
(2739, '70', '4', 'Dúdar', 18),
(2740, '71', '1', 'Dúrcal', 18),
(2741, '72', '6', 'Escúzar', 18),
(2742, '74', '7', 'Ferreira', 18),
(2743, '76', '3', 'Fonelas', 18),
(2744, '78', '5', 'Freila', 18),
(2745, '79', '8', 'Fuente Vaqueros', 18),
(2746, '905', '6', 'Gabias, Las', 18),
(2747, '82', '4', 'Galera', 18),
(2748, '83', '0', 'Gobernador', 18),
(2749, '84', '5', 'Gójar', 18),
(2750, '85', '8', 'Gor', 18),
(2751, '86', '1', 'Gorafe', 18),
(2752, '87', '7', 'Granada', 18),
(2753, '88', '3', 'Guadahortuna', 18),
(2754, '89', '6', 'Guadix', 18),
(2755, '906', '9', 'Guájares, Los', 18),
(2756, '93', '8', 'Gualchos', 18),
(2757, '94', '3', 'Güéjar Sierra', 18),
(2758, '95', '6', 'Güevéjar', 18),
(2759, '96', '9', 'Huélago', 18),
(2760, '97', '5', 'Huéneja', 18),
(2761, '98', '1', 'Huéscar', 18),
(2762, '99', '4', 'Huétor de Santillán', 18),
(2763, '100', '8', 'Huétor Tájar', 18),
(2764, '101', '5', 'Huétor Vega', 18),
(2765, '102', '0', 'Íllora', 18),
(2766, '103', '6', 'Ítrabo', 18),
(2767, '105', '4', 'Iznalloz', 18),
(2768, '106', '7', 'Játar', 18),
(2769, '107', '3', 'Jayena', 18),
(2770, '108', '9', 'Jerez del Marquesado', 18),
(2771, '109', '2', 'Jete', 18),
(2772, '111', '3', 'Jun', 18),
(2773, '112', '8', 'Juviles', 18),
(2774, '115', '2', 'Láchar', 18),
(2775, '116', '5', 'Lanjarón', 18),
(2776, '117', '1', 'Lanteira', 18),
(2777, '119', '0', 'Lecrín', 18),
(2778, '120', '4', 'Lentegí', 18),
(2779, '121', '1', 'Lobras', 18),
(2780, '122', '6', 'Loja', 18),
(2781, '123', '2', 'Lugros', 18),
(2782, '124', '7', 'Lújar', 18),
(2783, '126', '3', 'Malahá, La', 18),
(2784, '127', '9', 'Maracena', 18),
(2785, '128', '5', 'Marchal', 18),
(2786, '132', '4', 'Moclín', 18),
(2787, '133', '0', 'Molvízar', 18),
(2788, '134', '5', 'Monachil', 18),
(2789, '135', '8', 'Montefrío', 18),
(2790, '136', '1', 'Montejícar', 18),
(2791, '137', '7', 'Montillana', 18),
(2792, '138', '3', 'Moraleda de Zafayona', 18),
(2793, '909', '4', 'Morelábor', 18),
(2794, '140', '0', 'Motril', 18),
(2795, '141', '7', 'Murtas', 18),
(2796, '903', '8', 'Nevada', 18),
(2797, '143', '8', 'Nigüelas', 18),
(2798, '144', '3', 'Nívar', 18),
(2799, '145', '6', 'Ogíjares', 18),
(2800, '146', '9', 'Orce', 18),
(2801, '147', '5', 'Órgiva', 18),
(2802, '148', '1', 'Otívar', 18),
(2803, '150', '7', 'Padul', 18),
(2804, '151', '4', 'Pampaneira', 18),
(2805, '152', '9', 'Pedro Martínez', 18),
(2806, '153', '5', 'Peligros', 18),
(2807, '154', '0', 'Peza, La', 18),
(2808, '910', '8', 'Pinar, El', 18),
(2809, '157', '2', 'Pinos Genil', 18),
(2810, '158', '8', 'Pinos Puente', 18),
(2811, '159', '1', 'Píñar', 18),
(2812, '161', '2', 'Polícar', 18),
(2813, '162', '7', 'Polopos', 18),
(2814, '163', '3', 'Pórtugos', 18),
(2815, '164', '8', 'Puebla de Don Fadrique', 18),
(2816, '165', '1', 'Pulianas', 18),
(2817, '167', '0', 'Purullena', 18),
(2818, '168', '6', 'Quéntar', 18),
(2819, '170', '3', 'Rubite', 18),
(2820, '171', '0', 'Salar', 18),
(2821, '173', '1', 'Salobreña', 18),
(2822, '174', '6', 'Santa Cruz del Comercio', 18),
(2823, '175', '9', 'Santa Fe', 18),
(2824, '176', '2', 'Soportújar', 18),
(2825, '177', '8', 'Sorvilán', 18),
(2826, '901', '7', 'Taha, La', 18),
(2827, '178', '4', 'Torre-Cardela', 18),
(2828, '179', '7', 'Torvizcón', 18),
(2829, '180', '1', 'Trevélez', 18),
(2830, '181', '8', 'Turón', 18),
(2831, '182', '3', 'Ugíjar', 18),
(2832, '914', '1', 'Valderrubio', 18),
(2833, '907', '5', 'Valle del Zalabí', 18),
(2834, '902', '2', 'Valle, El', 18),
(2835, '183', '9', 'Válor', 18),
(2836, '911', '5', 'Vegas del Genil', 18),
(2837, '184', '4', 'Vélez de Benaudalla', 18),
(2838, '185', '7', 'Ventas de Huelma', 18),
(2839, '149', '4', 'Villa de Otura', 18),
(2840, '908', '1', 'Villamena', 18),
(2841, '187', '6', 'Villanueva de las Torres', 18),
(2842, '188', '2', 'Villanueva Mesía', 18),
(2843, '189', '5', 'Víznar', 18),
(2844, '192', '1', 'Zafarraya', 18),
(2845, '913', '6', 'Zagra', 18),
(2846, '193', '7', 'Zubia, La', 18),
(2847, '194', '2', 'Zújar', 18),
(2848, '1', '9', 'Abánades', 19),
(2849, '2', '4', 'Ablanque', 19),
(2850, '3', '0', 'Adobes', 19),
(2851, '4', '5', 'Alaminos', 19),
(2852, '5', '8', 'Alarilla', 19),
(2853, '6', '1', 'Albalate de Zorita', 19),
(2854, '7', '7', 'Albares', 19),
(2855, '8', '3', 'Albendiego', 19),
(2856, '9', '6', 'Alcocer', 19),
(2857, '10', '0', 'Alcolea de las Peñas', 19),
(2858, '11', '7', 'Alcolea del Pinar', 19),
(2859, '13', '8', 'Alcoroches', 19),
(2860, '15', '6', 'Aldeanueva de Guadalajara', 19),
(2861, '16', '9', 'Algar de Mesa', 19),
(2862, '17', '5', 'Algora', 19),
(2863, '18', '1', 'Alhóndiga', 19),
(2864, '19', '4', 'Alique', 19),
(2865, '20', '8', 'Almadrones', 19),
(2866, '21', '5', 'Almoguera', 19),
(2867, '22', '0', 'Almonacid de Zorita', 19),
(2868, '23', '6', 'Alocén', 19),
(2869, '24', '1', 'Alovera', 19),
(2870, '27', '3', 'Alustante', 19),
(2871, '31', '3', 'Angón', 19),
(2872, '32', '8', 'Anguita', 19),
(2873, '33', '4', 'Anquela del Ducado', 19),
(2874, '34', '9', 'Anquela del Pedregal', 19),
(2875, '36', '5', 'Aranzueque', 19),
(2876, '37', '1', 'Arbancón', 19),
(2877, '38', '7', 'Arbeteta', 19),
(2878, '39', '0', 'Argecilla', 19),
(2879, '40', '4', 'Armallones', 19),
(2880, '41', '1', 'Armuña de Tajuña', 19),
(2881, '42', '6', 'Arroyo de las Fraguas', 19),
(2882, '43', '2', 'Atanzón', 19),
(2883, '44', '7', 'Atienza', 19),
(2884, '45', '0', 'Auñón', 19),
(2885, '46', '3', 'Azuqueca de Henares', 19),
(2886, '47', '9', 'Baides', 19),
(2887, '48', '5', 'Baños de Tajo', 19),
(2888, '49', '8', 'Bañuelos', 19),
(2889, '50', '1', 'Barriopedro', 19),
(2890, '51', '8', 'Berninches', 19),
(2891, '52', '3', 'Bodera, La', 19),
(2892, '53', '9', 'Brihuega', 19),
(2893, '54', '4', 'Budia', 19),
(2894, '55', '7', 'Bujalaro', 19),
(2895, '57', '6', 'Bustares', 19),
(2896, '58', '2', 'Cabanillas del Campo', 19),
(2897, '59', '5', 'Campillo de Dueñas', 19),
(2898, '60', '9', 'Campillo de Ranas', 19),
(2899, '61', '6', 'Campisábalos', 19),
(2900, '64', '2', 'Canredondo', 19),
(2901, '65', '5', 'Cantalojas', 19),
(2902, '66', '8', 'Cañizar', 19),
(2903, '67', '4', 'Cardoso de la Sierra, El', 19),
(2904, '70', '7', 'Casa de Uceda', 19),
(2905, '71', '4', 'Casar, El', 19),
(2906, '73', '5', 'Casas de San Galindo', 19),
(2907, '74', '0', 'Caspueñas', 19),
(2908, '75', '3', 'Castejón de Henares', 19),
(2909, '76', '6', 'Castellar de la Muela', 19),
(2910, '78', '8', 'Castilforte', 19),
(2911, '79', '1', 'Castilnuevo', 19),
(2912, '80', '5', 'Cendejas de Enmedio', 19),
(2913, '81', '2', 'Cendejas de la Torre', 19),
(2914, '82', '7', 'Centenera', 19),
(2915, '103', '9', 'Checa', 19),
(2916, '104', '4', 'Chequilla', 19),
(2917, '106', '0', 'Chillarón del Rey', 19),
(2918, '105', '7', 'Chiloeches', 19),
(2919, '86', '4', 'Cifuentes', 19),
(2920, '87', '0', 'Cincovillas', 19),
(2921, '88', '6', 'Ciruelas', 19),
(2922, '89', '9', 'Ciruelos del Pinar', 19),
(2923, '90', '3', 'Cobeta', 19),
(2924, '91', '0', 'Cogollor', 19),
(2925, '92', '5', 'Cogolludo', 19),
(2926, '95', '9', 'Condemios de Abajo', 19),
(2927, '96', '2', 'Condemios de Arriba', 19),
(2928, '97', '8', 'Congostrina', 19),
(2929, '98', '4', 'Copernal', 19),
(2930, '99', '7', 'Corduente', 19),
(2931, '102', '3', 'Cubillo de Uceda, El', 19),
(2932, '107', '6', 'Driebes', 19),
(2933, '108', '2', 'Durón', 19),
(2934, '109', '5', 'Embid', 19),
(2935, '110', '9', 'Escamilla', 19),
(2936, '111', '6', 'Escariche', 19),
(2937, '112', '1', 'Escopete', 19),
(2938, '113', '7', 'Espinosa de Henares', 19),
(2939, '114', '2', 'Esplegares', 19),
(2940, '115', '5', 'Establés', 19),
(2941, '116', '8', 'Estriégana', 19),
(2942, '117', '4', 'Fontanar', 19),
(2943, '118', '0', 'Fuembellida', 19),
(2944, '119', '3', 'Fuencemillán', 19),
(2945, '120', '7', 'Fuentelahiguera de Albatages', 19),
(2946, '121', '4', 'Fuentelencina', 19),
(2947, '122', '9', 'Fuentelsaz', 19),
(2948, '123', '5', 'Fuentelviejo', 19),
(2949, '124', '0', 'Fuentenovilla', 19),
(2950, '125', '3', 'Gajanejos', 19),
(2951, '126', '6', 'Galápagos', 19),
(2952, '127', '2', 'Galve de Sorbe', 19),
(2953, '129', '1', 'Gascueña de Bornova', 19),
(2954, '130', '5', 'Guadalajara', 19),
(2955, '132', '7', 'Henche', 19),
(2956, '133', '3', 'Heras de Ayuso', 19),
(2957, '134', '8', 'Herrería', 19),
(2958, '135', '1', 'Hiendelaencina', 19),
(2959, '136', '4', 'Hijes', 19),
(2960, '138', '6', 'Hita', 19),
(2961, '139', '9', 'Hombrados', 19),
(2962, '142', '5', 'Hontoba', 19),
(2963, '143', '1', 'Horche', 19),
(2964, '145', '9', 'Hortezuela de Océn', 19),
(2965, '146', '2', 'Huerce, La', 19),
(2966, '147', '8', 'Huérmeces del Cerro', 19),
(2967, '148', '4', 'Huertahernando', 19),
(2968, '150', '0', 'Hueva', 19),
(2969, '151', '7', 'Humanes', 19),
(2970, '152', '2', 'Illana', 19),
(2971, '153', '8', 'Iniéstola', 19),
(2972, '154', '3', 'Inviernas, Las', 19),
(2973, '155', '6', 'Irueste', 19),
(2974, '156', '9', 'Jadraque', 19),
(2975, '157', '5', 'Jirueque', 19),
(2976, '159', '4', 'Ledanca', 19),
(2977, '160', '8', 'Loranca de Tajuña', 19),
(2978, '161', '5', 'Lupiana', 19),
(2979, '162', '0', 'Luzaga', 19),
(2980, '163', '6', 'Luzón', 19),
(2981, '165', '4', 'Majaelrayo', 19),
(2982, '166', '7', 'Málaga del Fresno', 19),
(2983, '167', '3', 'Malaguilla', 19),
(2984, '168', '9', 'Mandayona', 19),
(2985, '169', '2', 'Mantiel', 19),
(2986, '170', '6', 'Maranchón', 19),
(2987, '171', '3', 'Marchamalo', 19),
(2988, '172', '8', 'Masegoso de Tajuña', 19),
(2989, '173', '4', 'Matarrubia', 19),
(2990, '174', '9', 'Matillas', 19),
(2991, '175', '2', 'Mazarete', 19),
(2992, '176', '5', 'Mazuecos', 19),
(2993, '177', '1', 'Medranda', 19),
(2994, '178', '7', 'Megina', 19),
(2995, '179', '0', 'Membrillera', 19),
(2996, '181', '1', 'Miedes de Atienza', 19),
(2997, '182', '6', 'Mierla, La', 19),
(2998, '184', '7', 'Millana', 19),
(2999, '183', '2', 'Milmarcos', 19),
(3000, '185', '0', 'Miñosa, La', 19),
(3001, '186', '3', 'Mirabueno', 19),
(3002, '187', '9', 'Miralrío', 19),
(3003, '188', '5', 'Mochales', 19),
(3004, '189', '8', 'Mohernando', 19),
(3005, '190', '2', 'Molina de Aragón', 19),
(3006, '191', '9', 'Monasterio', 19),
(3007, '192', '4', 'Mondéjar', 19),
(3008, '193', '0', 'Montarrón', 19),
(3009, '194', '5', 'Moratilla de los Meleros', 19),
(3010, '195', '8', 'Morenilla', 19),
(3011, '196', '1', 'Muduex', 19),
(3012, '197', '7', 'Navas de Jadraque, Las', 19),
(3013, '198', '3', 'Negredo', 19),
(3014, '199', '6', 'Ocentejo', 19),
(3015, '200', '0', 'Olivar, El', 19),
(3016, '201', '7', 'Olmeda de Cobeta', 19),
(3017, '202', '2', 'Olmeda de Jadraque, La', 19),
(3018, '203', '8', 'Ordial, El', 19),
(3019, '204', '3', 'Orea', 19),
(3020, '208', '1', 'Pálmaces de Jadraque', 19),
(3021, '209', '4', 'Pardos', 19),
(3022, '210', '8', 'Paredes de Sigüenza', 19),
(3023, '211', '5', 'Pareja', 19),
(3024, '212', '0', 'Pastrana', 19),
(3025, '213', '6', 'Pedregal, El', 19),
(3026, '214', '1', 'Peñalén', 19),
(3027, '215', '4', 'Peñalver', 19),
(3028, '216', '7', 'Peralejos de las Truchas', 19),
(3029, '217', '3', 'Peralveche', 19),
(3030, '218', '9', 'Pinilla de Jadraque', 19),
(3031, '219', '2', 'Pinilla de Molina', 19),
(3032, '220', '6', 'Pioz', 19),
(3033, '221', '3', 'Piqueras', 19),
(3034, '222', '8', 'Pobo de Dueñas, El', 19),
(3035, '223', '4', 'Poveda de la Sierra', 19),
(3036, '224', '9', 'Pozo de Almoguera', 19),
(3037, '225', '2', 'Pozo de Guadalajara', 19),
(3038, '226', '5', 'Prádena de Atienza', 19),
(3039, '227', '1', 'Prados Redondos', 19),
(3040, '228', '7', 'Puebla de Beleña', 19),
(3041, '229', '0', 'Puebla de Valles', 19),
(3042, '230', '4', 'Quer', 19),
(3043, '231', '1', 'Rebollosa de Jadraque', 19),
(3044, '232', '6', 'Recuenco, El', 19),
(3045, '233', '2', 'Renera', 19),
(3046, '234', '7', 'Retiendas', 19),
(3047, '235', '0', 'Riba de Saelices', 19),
(3048, '237', '9', 'Rillo de Gallo', 19),
(3049, '238', '5', 'Riofrío del Llano', 19),
(3050, '239', '8', 'Robledillo de Mohernando', 19),
(3051, '240', '2', 'Robledo de Corpes', 19),
(3052, '241', '9', 'Romanillos de Atienza', 19),
(3053, '242', '4', 'Romanones', 19),
(3054, '243', '0', 'Rueda de la Sierra', 19),
(3055, '244', '5', 'Sacecorbo', 19),
(3056, '245', '8', 'Sacedón', 19),
(3057, '246', '1', 'Saelices de la Sal', 19),
(3058, '247', '7', 'Salmerón', 19),
(3059, '248', '3', 'San Andrés del Congosto', 19),
(3060, '249', '6', 'San Andrés del Rey', 19),
(3061, '250', '9', 'Santiuste', 19),
(3062, '251', '6', 'Saúca', 19),
(3063, '252', '1', 'Sayatón', 19),
(3064, '254', '2', 'Selas', 19),
(3065, '901', '0', 'Semillas', 19),
(3066, '255', '5', 'Setiles', 19),
(3067, '256', '8', 'Sienes', 19),
(3068, '257', '4', 'Sigüenza', 19),
(3069, '258', '0', 'Solanillos del Extremo', 19),
(3070, '259', '3', 'Somolinos', 19),
(3071, '260', '7', 'Sotillo, El', 19),
(3072, '261', '4', 'Sotodosos', 19),
(3073, '262', '9', 'Tamajón', 19),
(3074, '263', '5', 'Taragudo', 19),
(3075, '264', '0', 'Taravilla', 19),
(3076, '265', '3', 'Tartanedo', 19),
(3077, '266', '6', 'Tendilla', 19),
(3078, '267', '2', 'Terzaga', 19),
(3079, '268', '8', 'Tierzo', 19),
(3080, '269', '1', 'Toba, La', 19),
(3081, '271', '2', 'Tordellego', 19),
(3082, '270', '5', 'Tordelrábano', 19),
(3083, '272', '7', 'Tordesilos', 19),
(3084, '274', '8', 'Torija', 19),
(3085, '279', '9', 'Torre del Burgo', 19),
(3086, '277', '0', 'Torrecuadrada de Molina', 19),
(3087, '278', '6', 'Torrecuadradilla', 19),
(3088, '280', '3', 'Torrejón del Rey', 19),
(3089, '281', '0', 'Torremocha de Jadraque', 19),
(3090, '282', '5', 'Torremocha del Campo', 19),
(3091, '283', '1', 'Torremocha del Pinar', 19),
(3092, '284', '6', 'Torremochuela', 19),
(3093, '285', '9', 'Torrubia', 19),
(3094, '286', '2', 'Tórtola de Henares', 19),
(3095, '287', '8', 'Tortuera', 19),
(3096, '288', '4', 'Tortuero', 19),
(3097, '289', '7', 'Traíd', 19),
(3098, '290', '1', 'Trijueque', 19),
(3099, '291', '8', 'Trillo', 19),
(3100, '293', '9', 'Uceda', 19),
(3101, '294', '4', 'Ujados', 19),
(3102, '296', '0', 'Utande', 19),
(3103, '297', '6', 'Valdarachas', 19),
(3104, '298', '2', 'Valdearenas', 19),
(3105, '299', '5', 'Valdeavellano', 19),
(3106, '300', '9', 'Valdeaveruelo', 19),
(3107, '301', '6', 'Valdeconcha', 19),
(3108, '302', '1', 'Valdegrudas', 19),
(3109, '303', '7', 'Valdelcubo', 19),
(3110, '304', '2', 'Valdenuño Fernández', 19),
(3111, '305', '5', 'Valdepeñas de la Sierra', 19),
(3112, '306', '8', 'Valderrebollo', 19),
(3113, '307', '4', 'Valdesotos', 19),
(3114, '308', '0', 'Valfermoso de Tajuña', 19),
(3115, '309', '3', 'Valhermoso', 19),
(3116, '310', '7', 'Valtablado del Río', 19),
(3117, '311', '4', 'Valverde de los Arroyos', 19),
(3118, '314', '0', 'Viana de Jadraque', 19),
(3119, '317', '2', 'Villanueva de Alcorón', 19),
(3120, '318', '8', 'Villanueva de Argecilla', 19),
(3121, '319', '1', 'Villanueva de la Torre', 19),
(3122, '321', '2', 'Villares de Jadraque', 19),
(3123, '322', '7', 'Villaseca de Henares', 19),
(3124, '323', '3', 'Villaseca de Uceda', 19),
(3125, '324', '8', 'Villel de Mesa', 19),
(3126, '325', '1', 'Viñuelas', 19),
(3127, '326', '4', 'Yebes', 19),
(3128, '327', '0', 'Yebra', 19),
(3129, '329', '9', 'Yélamos de Abajo', 19),
(3130, '330', '3', 'Yélamos de Arriba', 19),
(3131, '331', '0', 'Yunquera de Henares', 19),
(3132, '332', '5', 'Yunta, La', 19),
(3133, '333', '1', 'Zaorejas', 19),
(3134, '334', '6', 'Zarzuela de Jadraque', 19),
(3135, '335', '9', 'Zorita de los Canes', 19),
(3136, '1', '3', 'Abaltzisketa', 20),
(3137, '2', '8', 'Aduna', 20),
(3138, '16', '3', 'Aia', 20),
(3139, '3', '4', 'Aizarnazabal', 20),
(3140, '4', '9', 'Albiztur', 20),
(3141, '5', '2', 'Alegia', 20),
(3142, '6', '5', 'Alkiza', 20),
(3143, '906', '6', 'Altzaga', 20),
(3144, '7', '1', 'Altzo', 20),
(3145, '8', '7', 'Amezketa', 20),
(3146, '9', '0', 'Andoain', 20),
(3147, '10', '4', 'Anoeta', 20),
(3148, '11', '1', 'Antzuola', 20),
(3149, '12', '6', 'Arama', 20),
(3150, '13', '2', 'Aretxabaleta', 20),
(3151, '55', '1', 'Arrasate/Mondragón', 20),
(3152, '14', '7', 'Asteasu', 20),
(3153, '903', '5', 'Astigarraga', 20),
(3154, '15', '0', 'Ataun', 20),
(3155, '17', '9', 'Azkoitia', 20),
(3156, '18', '5', 'Azpeitia', 20),
(3157, '904', '0', 'Baliarrain', 20),
(3158, '19', '8', 'Beasain', 20),
(3159, '20', '2', 'Beizama', 20),
(3160, '21', '9', 'Belauntza', 20),
(3161, '22', '4', 'Berastegi', 20),
(3162, '74', '4', 'Bergara', 20),
(3163, '23', '0', 'Berrobi', 20),
(3164, '24', '5', 'Bidania-Goiatz', 20),
(3165, '29', '6', 'Deba', 20),
(3166, '69', '7', 'Donostia/San Sebastián', 20),
(3167, '30', '0', 'Eibar', 20),
(3168, '31', '7', 'Elduain', 20),
(3169, '33', '8', 'Elgeta', 20),
(3170, '32', '2', 'Elgoibar', 20),
(3171, '67', '8', 'Errenteria', 20),
(3172, '66', '2', 'Errezil', 20),
(3173, '34', '3', 'Eskoriatza', 20),
(3174, '35', '6', 'Ezkio-Itsaso', 20),
(3175, '38', '1', 'Gabiria', 20),
(3176, '37', '5', 'Gaintza', 20),
(3177, '907', '2', 'Gaztelu', 20),
(3178, '39', '4', 'Getaria', 20),
(3179, '40', '8', 'Hernani', 20),
(3180, '41', '5', 'Hernialde', 20),
(3181, '36', '9', 'Hondarribia', 20),
(3182, '42', '0', 'Ibarra', 20),
(3183, '43', '6', 'Idiazabal', 20),
(3184, '44', '1', 'Ikaztegieta', 20),
(3185, '45', '4', 'Irun', 20),
(3186, '46', '7', 'Irura', 20),
(3187, '47', '3', 'Itsasondo', 20),
(3188, '48', '9', 'Larraul', 20),
(3189, '902', '9', 'Lasarte-Oria', 20),
(3190, '49', '2', 'Lazkao', 20),
(3191, '50', '5', 'Leaburu', 20),
(3192, '51', '2', 'Legazpi', 20),
(3193, '52', '7', 'Legorreta', 20),
(3194, '68', '4', 'Leintz-Gatzaga', 20),
(3195, '53', '3', 'Lezo', 20),
(3196, '54', '8', 'Lizartza', 20),
(3197, '901', '4', 'Mendaro', 20),
(3198, '57', '0', 'Mutiloa', 20),
(3199, '56', '4', 'Mutriku', 20),
(3200, '63', '1', 'Oiartzun', 20),
(3201, '58', '6', 'Olaberria', 20),
(3202, '59', '9', 'Oñati', 20),
(3203, '76', '0', 'Ordizia', 20),
(3204, '905', '3', 'Orendain', 20),
(3205, '60', '3', 'Orexa', 20),
(3206, '61', '0', 'Orio', 20),
(3207, '62', '5', 'Ormaiztegi', 20),
(3208, '64', '6', 'Pasaia', 20),
(3209, '70', '1', 'Segura', 20),
(3210, '65', '9', 'Soraluze-Placencia de las Armas', 20),
(3211, '71', '8', 'Tolosa', 20),
(3212, '72', '3', 'Urnieta', 20),
(3213, '77', '6', 'Urretxu', 20),
(3214, '73', '9', 'Usurbil', 20),
(3215, '75', '7', 'Villabona', 20),
(3216, '78', '2', 'Zaldibia', 20),
(3217, '79', '5', 'Zarautz', 20),
(3218, '25', '8', 'Zegama', 20),
(3219, '26', '1', 'Zerain', 20),
(3220, '27', '7', 'Zestoa', 20),
(3221, '28', '3', 'Zizurkil', 20),
(3222, '81', '6', 'Zumaia', 20),
(3223, '80', '9', 'Zumarraga', 20),
(3224, '1', '0', 'Alájar', 21),
(3225, '2', '5', 'Aljaraque', 21),
(3226, '3', '1', 'Almendro, El', 21),
(3227, '4', '6', 'Almonaster la Real', 21),
(3228, '5', '9', 'Almonte', 21),
(3229, '6', '2', 'Alosno', 21),
(3230, '7', '8', 'Aracena', 21),
(3231, '8', '4', 'Aroche', 21),
(3232, '9', '7', 'Arroyomolinos de León', 21),
(3233, '10', '1', 'Ayamonte', 21),
(3234, '11', '8', 'Beas', 21),
(3235, '12', '3', 'Berrocal', 21),
(3236, '13', '9', 'Bollullos Par del Condado', 21),
(3237, '14', '4', 'Bonares', 21),
(3238, '15', '7', 'Cabezas Rubias', 21),
(3239, '16', '0', 'Cala', 21),
(3240, '17', '6', 'Calañas', 21),
(3241, '18', '2', 'Campillo, El', 21),
(3242, '19', '5', 'Campofrío', 21),
(3243, '20', '9', 'Cañaveral de León', 21),
(3244, '21', '6', 'Cartaya', 21),
(3245, '22', '1', 'Castaño del Robledo', 21),
(3246, '23', '7', 'Cerro de Andévalo, El', 21),
(3247, '30', '7', 'Chucena', 21),
(3248, '24', '2', 'Corteconcepción', 21),
(3249, '25', '5', 'Cortegana', 21),
(3250, '26', '8', 'Cortelazor', 21),
(3251, '27', '4', 'Cumbres de Enmedio', 21),
(3252, '28', '0', 'Cumbres de San Bartolomé', 21),
(3253, '29', '3', 'Cumbres Mayores', 21),
(3254, '31', '4', 'Encinasola', 21),
(3255, '32', '9', 'Escacena del Campo', 21),
(3256, '33', '5', 'Fuenteheridos', 21),
(3257, '34', '0', 'Galaroza', 21),
(3258, '35', '3', 'Gibraleón', 21),
(3259, '36', '6', 'Granada de Río-Tinto, La', 21),
(3260, '37', '2', 'Granado, El', 21),
(3261, '38', '8', 'Higuera de la Sierra', 21),
(3262, '39', '1', 'Hinojales', 21),
(3263, '40', '5', 'Hinojos', 21),
(3264, '41', '2', 'Huelva', 21),
(3265, '42', '7', 'Isla Cristina', 21),
(3266, '43', '3', 'Jabugo', 21),
(3267, '44', '8', 'Lepe', 21),
(3268, '45', '1', 'Linares de la Sierra', 21),
(3269, '46', '4', 'Lucena del Puerto', 21),
(3270, '47', '0', 'Manzanilla', 21),
(3271, '48', '6', 'Marines, Los', 21),
(3272, '49', '9', 'Minas de Riotinto', 21),
(3273, '50', '2', 'Moguer', 21),
(3274, '51', '9', 'Nava, La', 21),
(3275, '52', '4', 'Nerva', 21),
(3276, '53', '0', 'Niebla', 21),
(3277, '54', '5', 'Palma del Condado, La', 21),
(3278, '55', '8', 'Palos de la Frontera', 21),
(3279, '56', '1', 'Paterna del Campo', 21),
(3280, '57', '7', 'Paymogo', 21),
(3281, '58', '3', 'Puebla de Guzmán', 21),
(3282, '59', '6', 'Puerto Moral', 21),
(3283, '60', '0', 'Punta Umbría', 21),
(3284, '61', '7', 'Rociana del Condado', 21),
(3285, '62', '2', 'Rosal de la Frontera', 21),
(3286, '63', '8', 'San Bartolomé de la Torre', 21),
(3287, '64', '3', 'San Juan del Puerto', 21),
(3288, '66', '9', 'San Silvestre de Guzmán', 21),
(3289, '65', '6', 'Sanlúcar de Guadiana', 21),
(3290, '67', '5', 'Santa Ana la Real', 21),
(3291, '68', '1', 'Santa Bárbara de Casa', 21),
(3292, '69', '4', 'Santa Olalla del Cala', 21),
(3293, '70', '8', 'Trigueros', 21),
(3294, '71', '5', 'Valdelarco', 21),
(3295, '72', '0', 'Valverde del Camino', 21),
(3296, '73', '6', 'Villablanca', 21),
(3297, '74', '1', 'Villalba del Alcor', 21),
(3298, '75', '4', 'Villanueva de las Cruces', 21),
(3299, '76', '7', 'Villanueva de los Castillejos', 21),
(3300, '77', '3', 'Villarrasa', 21),
(3301, '78', '9', 'Zalamea la Real', 21),
(3302, '79', '2', 'Zufre', 21),
(3303, '1', '5', 'Abiego', 22),
(3304, '2', '0', 'Abizanda', 22),
(3305, '3', '6', 'Adahuesca', 22),
(3306, '4', '1', 'Agüero', 22),
(3307, '907', '4', 'Aínsa-Sobrarbe', 22),
(3308, '6', '7', 'Aisa', 22),
(3309, '7', '3', 'Albalate de Cinca', 22),
(3310, '8', '9', 'Albalatillo', 22),
(3311, '9', '2', 'Albelda', 22),
(3312, '11', '3', 'Albero Alto', 22),
(3313, '12', '8', 'Albero Bajo', 22),
(3314, '13', '4', 'Alberuela de Tubo', 22),
(3315, '14', '9', 'Alcalá de Gurrea', 22),
(3316, '15', '2', 'Alcalá del Obispo', 22),
(3317, '16', '5', 'Alcampell', 22),
(3318, '17', '1', 'Alcolea de Cinca', 22),
(3319, '18', '7', 'Alcubierre', 22),
(3320, '19', '0', 'Alerre', 22),
(3321, '20', '4', 'Alfántega', 22),
(3322, '21', '1', 'Almudévar', 22),
(3323, '22', '6', 'Almunia de San Juan', 22),
(3324, '23', '2', 'Almuniente', 22),
(3325, '24', '7', 'Alquézar', 22),
(3326, '25', '0', 'Altorricón', 22),
(3327, '27', '9', 'Angüés', 22),
(3328, '28', '5', 'Ansó', 22),
(3329, '29', '8', 'Antillón', 22),
(3330, '32', '4', 'Aragüés del Puerto', 22),
(3331, '35', '8', 'Arén', 22),
(3332, '36', '1', 'Argavieso', 22),
(3333, '37', '7', 'Arguis', 22),
(3334, '39', '6', 'Ayerbe', 22),
(3335, '40', '0', 'Azanuy-Alins', 22),
(3336, '41', '7', 'Azara', 22),
(3337, '42', '2', 'Azlor', 22),
(3338, '43', '8', 'Baélls', 22),
(3339, '44', '3', 'Bailo', 22),
(3340, '45', '6', 'Baldellou', 22),
(3341, '46', '9', 'Ballobar', 22),
(3342, '47', '5', 'Banastás', 22),
(3343, '48', '1', 'Barbastro', 22),
(3344, '49', '4', 'Barbués', 22),
(3345, '50', '7', 'Barbuñales', 22),
(3346, '51', '4', 'Bárcabo', 22),
(3347, '52', '9', 'Belver de Cinca', 22),
(3348, '53', '5', 'Benabarre', 22),
(3349, '54', '0', 'Benasque', 22),
(3350, '246', '7', 'Beranuy', 22),
(3351, '55', '3', 'Berbegal', 22),
(3352, '57', '2', 'Bielsa', 22),
(3353, '58', '8', 'Bierge', 22),
(3354, '59', '1', 'Biescas', 22),
(3355, '60', '5', 'Binaced', 22),
(3356, '61', '2', 'Binéfar', 22),
(3357, '62', '7', 'Bisaurri', 22),
(3358, '63', '3', 'Biscarrués', 22),
(3359, '64', '8', 'Blecua y Torres', 22),
(3360, '66', '4', 'Boltaña', 22),
(3361, '67', '0', 'Bonansa', 22),
(3362, '68', '6', 'Borau', 22),
(3363, '69', '9', 'Broto', 22),
(3364, '72', '5', 'Caldearenas', 22),
(3365, '74', '6', 'Campo', 22),
(3366, '75', '9', 'Camporrélls', 22),
(3367, '76', '2', 'Canal de Berdún', 22),
(3368, '77', '8', 'Candasnos', 22),
(3369, '78', '4', 'Canfranc', 22),
(3370, '79', '7', 'Capdesaso', 22),
(3371, '80', '1', 'Capella', 22),
(3372, '81', '8', 'Casbas de Huesca', 22),
(3373, '83', '9', 'Castejón de Monegros', 22),
(3374, '84', '4', 'Castejón de Sos', 22),
(3375, '82', '3', 'Castejón del Puente', 22),
(3376, '85', '7', 'Castelflorite', 22),
(3377, '86', '0', 'Castiello de Jaca', 22),
(3378, '87', '6', 'Castigaleu', 22),
(3379, '88', '2', 'Castillazuelo', 22),
(3380, '89', '5', 'Castillonroy', 22),
(3381, '94', '2', 'Chalamera', 22),
(3382, '95', '5', 'Chía', 22),
(3383, '96', '8', 'Chimillas', 22),
(3384, '90', '9', 'Colungo', 22),
(3385, '99', '3', 'Esplús', 22),
(3386, '102', '9', 'Estada', 22),
(3387, '103', '5', 'Estadilla', 22),
(3388, '105', '3', 'Estopiñán del Castillo', 22),
(3389, '106', '6', 'Fago', 22),
(3390, '107', '2', 'Fanlo', 22),
(3391, '109', '1', 'Fiscal', 22),
(3392, '110', '5', 'Fonz', 22),
(3393, '111', '2', 'Foradada del Toscar', 22),
(3394, '112', '7', 'Fraga', 22),
(3395, '113', '3', 'Fueva, La', 22),
(3396, '114', '8', 'Gistaín', 22),
(3397, '115', '1', 'Grado, El', 22),
(3398, '116', '4', 'Grañén', 22),
(3399, '117', '0', 'Graus', 22),
(3400, '119', '9', 'Gurrea de Gállego', 22),
(3401, '122', '5', 'Hoz de Jaca', 22),
(3402, '908', '0', 'Hoz y Costean', 22),
(3403, '124', '6', 'Huerto', 22),
(3404, '125', '9', 'Huesca', 22),
(3405, '126', '2', 'Ibieca', 22),
(3406, '127', '8', 'Igriés', 22),
(3407, '128', '4', 'Ilche', 22),
(3408, '129', '7', 'Isábena', 22),
(3409, '130', '1', 'Jaca', 22),
(3410, '131', '8', 'Jasa', 22),
(3411, '133', '9', 'Labuerda', 22),
(3412, '135', '7', 'Laluenga', 22),
(3413, '136', '0', 'Lalueza', 22),
(3414, '137', '6', 'Lanaja', 22),
(3415, '139', '5', 'Laperdiguera', 22),
(3416, '141', '6', 'Lascellas-Ponzano', 22),
(3417, '142', '1', 'Lascuarre', 22),
(3418, '143', '7', 'Laspaúles', 22),
(3419, '144', '2', 'Laspuña', 22),
(3420, '149', '3', 'Loarre', 22),
(3421, '150', '6', 'Loporzano', 22),
(3422, '151', '3', 'Loscorrales', 22),
(3423, '905', '5', 'Lupiñén-Ortilla', 22),
(3424, '155', '2', 'Monesma y Cajigar', 22),
(3425, '156', '5', 'Monflorite-Lascasas', 22),
(3426, '157', '1', 'Montanuy', 22),
(3427, '158', '7', 'Monzón', 22),
(3428, '160', '4', 'Naval', 22),
(3429, '162', '6', 'Novales', 22),
(3430, '163', '2', 'Nueno', 22),
(3431, '164', '7', 'Olvena', 22),
(3432, '165', '0', 'Ontiñena', 22),
(3433, '167', '9', 'Osso de Cinca', 22),
(3434, '168', '5', 'Palo', 22),
(3435, '170', '2', 'Panticosa', 22),
(3436, '172', '4', 'Peñalba', 22),
(3437, '173', '0', 'Peñas de Riglos, Las', 22),
(3438, '174', '5', 'Peralta de Alcofea', 22),
(3439, '175', '8', 'Peralta de Calasanz', 22),
(3440, '176', '1', 'Peraltilla', 22),
(3441, '177', '7', 'Perarrúa', 22),
(3442, '178', '3', 'Pertusa', 22),
(3443, '181', '7', 'Piracés', 22),
(3444, '182', '2', 'Plan', 22),
(3445, '184', '3', 'Poleñino', 22),
(3446, '186', '9', 'Pozán de Vero', 22),
(3447, '187', '5', 'Puebla de Castro, La', 22),
(3448, '188', '1', 'Puente de Montañana', 22),
(3449, '902', '1', 'Puente la Reina de Jaca', 22),
(3450, '189', '4', 'Puértolas', 22),
(3451, '190', '8', 'Pueyo de Araguás, El', 22),
(3452, '193', '6', 'Pueyo de Santa Cruz', 22),
(3453, '195', '4', 'Quicena', 22),
(3454, '197', '3', 'Robres', 22),
(3455, '199', '2', 'Sabiñánigo', 22),
(3456, '200', '6', 'Sahún', 22),
(3457, '201', '3', 'Salas Altas', 22),
(3458, '202', '8', 'Salas Bajas', 22),
(3459, '203', '4', 'Salillas', 22),
(3460, '204', '9', 'Sallent de Gállego', 22),
(3461, '205', '2', 'San Esteban de Litera', 22),
(3462, '207', '1', 'San Juan de Plan', 22),
(3463, '903', '7', 'San Miguel del Cinca', 22),
(3464, '206', '5', 'Sangarrén', 22),
(3465, '208', '7', 'Santa Cilia', 22),
(3466, '209', '0', 'Santa Cruz de la Serós', 22),
(3467, '906', '8', 'Santa María de Dulcis', 22),
(3468, '212', '6', 'Santaliestra y San Quílez', 22),
(3469, '213', '2', 'Sariñena', 22),
(3470, '214', '7', 'Secastilla', 22),
(3471, '215', '0', 'Seira', 22),
(3472, '217', '9', 'Sena', 22),
(3473, '218', '5', 'Senés de Alcubierre', 22),
(3474, '220', '2', 'Sesa', 22),
(3475, '221', '9', 'Sesué', 22),
(3476, '222', '4', 'Siétamo', 22),
(3477, '223', '0', 'Sopeira', 22),
(3478, '904', '2', 'Sotonera, La', 22),
(3479, '225', '8', 'Tamarite de Litera', 22),
(3480, '226', '1', 'Tardienta', 22),
(3481, '227', '7', 'Tella-Sin', 22),
(3482, '228', '3', 'Tierz', 22),
(3483, '229', '6', 'Tolva', 22),
(3484, '230', '0', 'Torla-Ordesa', 22),
(3485, '232', '2', 'Torralba de Aragón', 22),
(3486, '233', '8', 'Torre la Ribera', 22),
(3487, '234', '3', 'Torrente de Cinca', 22),
(3488, '235', '6', 'Torres de Alcanadre', 22),
(3489, '236', '9', 'Torres de Barbués', 22),
(3490, '239', '4', 'Tramaced', 22),
(3491, '242', '0', 'Valfarta', 22),
(3492, '243', '6', 'Valle de Bardají', 22),
(3493, '901', '6', 'Valle de Hecho', 22),
(3494, '244', '1', 'Valle de Lierp', 22),
(3495, '245', '4', 'Velilla de Cinca', 22),
(3496, '909', '3', 'Vencillón', 22),
(3497, '247', '3', 'Viacamp y Litera', 22),
(3498, '248', '9', 'Vicién', 22),
(3499, '249', '2', 'Villanova', 22),
(3500, '250', '5', 'Villanúa', 22),
(3501, '251', '2', 'Villanueva de Sigena', 22),
(3502, '252', '7', 'Yebra de Basa', 22),
(3503, '253', '3', 'Yésero', 22),
(3504, '254', '8', 'Zaidín', 22),
(3505, '1', '1', 'Albanchez de Mágina', 23),
(3506, '2', '6', 'Alcalá la Real', 23),
(3507, '3', '2', 'Alcaudete', 23),
(3508, '4', '7', 'Aldeaquemada', 23),
(3509, '5', '0', 'Andújar', 23),
(3510, '6', '3', 'Arjona', 23),
(3511, '7', '9', 'Arjonilla', 23),
(3512, '8', '5', 'Arquillos', 23),
(3513, '905', '1', 'Arroyo del Ojanco', 23),
(3514, '9', '8', 'Baeza', 23),
(3515, '10', '2', 'Bailén', 23),
(3516, '11', '9', 'Baños de la Encina', 23),
(3517, '12', '4', 'Beas de Segura', 23),
(3518, '902', '7', 'Bedmar y Garcíez', 23),
(3519, '14', '5', 'Begíjar', 23),
(3520, '15', '8', 'Bélmez de la Moraleda', 23),
(3521, '16', '1', 'Benatae', 23),
(3522, '17', '7', 'Cabra del Santo Cristo', 23),
(3523, '18', '3', 'Cambil', 23),
(3524, '19', '6', 'Campillo de Arenas', 23),
(3525, '20', '0', 'Canena', 23),
(3526, '21', '7', 'Carboneros', 23),
(3527, '901', '2', 'Cárcheles', 23),
(3528, '24', '3', 'Carolina, La', 23),
(3529, '25', '6', 'Castellar', 23),
(3530, '26', '9', 'Castillo de Locubín', 23),
(3531, '27', '5', 'Cazalilla', 23),
(3532, '28', '1', 'Cazorla', 23),
(3533, '29', '4', 'Chiclana de Segura', 23),
(3534, '30', '8', 'Chilluévar', 23),
(3535, '31', '5', 'Escañuela', 23),
(3536, '32', '0', 'Espeluy', 23),
(3537, '33', '6', 'Frailes', 23),
(3538, '34', '1', 'Fuensanta de Martos', 23),
(3539, '35', '4', 'Fuerte del Rey', 23),
(3540, '37', '3', 'Génave', 23),
(3541, '38', '9', 'Guardia de Jaén, La', 23),
(3542, '39', '2', 'Guarromán', 23),
(3543, '41', '3', 'Higuera de Calatrava', 23),
(3544, '42', '8', 'Hinojares', 23),
(3545, '43', '4', 'Hornos', 23),
(3546, '44', '9', 'Huelma', 23),
(3547, '45', '2', 'Huesa', 23),
(3548, '46', '5', 'Ibros', 23),
(3549, '47', '1', 'Iruela, La', 23),
(3550, '48', '7', 'Iznatoraf', 23),
(3551, '49', '0', 'Jabalquinto', 23),
(3552, '50', '3', 'Jaén', 23),
(3553, '51', '0', 'Jamilena', 23),
(3554, '52', '5', 'Jimena', 23),
(3555, '53', '1', 'Jódar', 23),
(3556, '40', '6', 'Lahiguera', 23),
(3557, '54', '6', 'Larva', 23),
(3558, '55', '9', 'Linares', 23),
(3559, '56', '2', 'Lopera', 23),
(3560, '57', '8', 'Lupión', 23),
(3561, '58', '4', 'Mancha Real', 23),
(3562, '59', '7', 'Marmolejo', 23),
(3563, '60', '1', 'Martos', 23),
(3564, '61', '8', 'Mengíbar', 23),
(3565, '62', '3', 'Montizón', 23),
(3566, '63', '9', 'Navas de San Juan', 23),
(3567, '64', '4', 'Noalejo', 23),
(3568, '65', '7', 'Orcera', 23),
(3569, '66', '0', 'Peal de Becerro', 23),
(3570, '67', '6', 'Pegalajar', 23),
(3571, '69', '5', 'Porcuna', 23),
(3572, '70', '9', 'Pozo Alcón', 23),
(3573, '71', '6', 'Puente de Génave', 23),
(3574, '72', '1', 'Puerta de Segura, La', 23),
(3575, '73', '7', 'Quesada', 23),
(3576, '74', '2', 'Rus', 23),
(3577, '75', '5', 'Sabiote', 23),
(3578, '76', '8', 'Santa Elena', 23),
(3579, '77', '4', 'Santiago de Calatrava', 23),
(3580, '904', '8', 'Santiago-Pontones', 23),
(3581, '79', '3', 'Santisteban del Puerto', 23),
(3582, '80', '7', 'Santo Tomé', 23),
(3583, '81', '4', 'Segura de la Sierra', 23),
(3584, '82', '9', 'Siles', 23),
(3585, '84', '0', 'Sorihuela del Guadalimar', 23),
(3586, '85', '3', 'Torreblascopedro', 23),
(3587, '86', '6', 'Torredelcampo', 23),
(3588, '87', '2', 'Torredonjimeno', 23),
(3589, '88', '8', 'Torreperogil', 23),
(3590, '90', '5', 'Torres', 23),
(3591, '91', '2', 'Torres de Albánchez', 23),
(3592, '92', '7', 'Úbeda', 23),
(3593, '93', '3', 'Valdepeñas de Jaén', 23),
(3594, '94', '8', 'Vilches', 23),
(3595, '95', '1', 'Villacarrillo', 23),
(3596, '96', '4', 'Villanueva de la Reina', 23),
(3597, '97', '0', 'Villanueva del Arzobispo', 23),
(3598, '98', '6', 'Villardompardo', 23),
(3599, '99', '9', 'Villares, Los', 23),
(3600, '101', '0', 'Villarrodrigo', 23),
(3601, '903', '3', 'Villatorres', 23),
(3602, '1', '6', 'Acebedo', 24),
(3603, '2', '1', 'Algadefe', 24),
(3604, '3', '7', 'Alija del Infantado', 24),
(3605, '4', '2', 'Almanza', 24),
(3606, '5', '5', 'Antigua, La', 24),
(3607, '6', '8', 'Ardón', 24),
(3608, '7', '4', 'Arganza', 24),
(3609, '8', '0', 'Astorga', 24),
(3610, '9', '3', 'Balboa', 24),
(3611, '10', '7', 'Bañeza, La', 24),
(3612, '11', '4', 'Barjas', 24),
(3613, '12', '9', 'Barrios de Luna, Los', 24),
(3614, '14', '0', 'Bembibre', 24),
(3615, '15', '3', 'Benavides', 24),
(3616, '16', '6', 'Benuza', 24),
(3617, '17', '2', 'Bercianos del Páramo', 24),
(3618, '18', '8', 'Bercianos del Real Camino', 24),
(3619, '19', '1', 'Berlanga del Bierzo', 24),
(3620, '20', '5', 'Boca de Huérgano', 24),
(3621, '21', '2', 'Boñar', 24),
(3622, '22', '7', 'Borrenes', 24),
(3623, '23', '3', 'Brazuelo', 24),
(3624, '24', '8', 'Burgo Ranero, El', 24),
(3625, '25', '1', 'Burón', 24),
(3626, '26', '4', 'Bustillo del Páramo', 24),
(3627, '27', '0', 'Cabañas Raras', 24),
(3628, '28', '6', 'Cabreros del Río', 24),
(3629, '29', '9', 'Cabrillanes', 24),
(3630, '30', '3', 'Cacabelos', 24),
(3631, '31', '0', 'Calzada del Coto', 24),
(3632, '32', '5', 'Campazas', 24),
(3633, '33', '1', 'Campo de Villavidel', 24),
(3634, '34', '6', 'Camponaraya', 24),
(3635, '36', '2', 'Candín', 24),
(3636, '37', '8', 'Cármenes', 24),
(3637, '38', '4', 'Carracedelo', 24),
(3638, '39', '7', 'Carrizo', 24),
(3639, '40', '1', 'Carrocera', 24),
(3640, '41', '8', 'Carucedo', 24),
(3641, '42', '3', 'Castilfalé', 24),
(3642, '43', '9', 'Castrillo de Cabrera', 24),
(3643, '44', '4', 'Castrillo de la Valduerna', 24),
(3644, '46', '0', 'Castrocalbón', 24),
(3645, '47', '6', 'Castrocontrigo', 24),
(3646, '49', '5', 'Castropodame', 24),
(3647, '50', '8', 'Castrotierra de Valmadrigal', 24),
(3648, '51', '5', 'Cea', 24),
(3649, '52', '0', 'Cebanico', 24),
(3650, '53', '6', 'Cebrones del Río', 24),
(3651, '65', '2', 'Chozas de Abajo', 24),
(3652, '54', '1', 'Cimanes de la Vega', 24),
(3653, '55', '4', 'Cimanes del Tejar', 24),
(3654, '56', '7', 'Cistierna', 24),
(3655, '57', '3', 'Congosto', 24),
(3656, '58', '9', 'Corbillos de los Oteros', 24),
(3657, '59', '2', 'Corullón', 24),
(3658, '60', '6', 'Crémenes', 24),
(3659, '61', '3', 'Cuadros', 24),
(3660, '62', '8', 'Cubillas de los Oteros', 24),
(3661, '63', '4', 'Cubillas de Rueda', 24),
(3662, '64', '9', 'Cubillos del Sil', 24),
(3663, '66', '5', 'Destriana', 24),
(3664, '67', '1', 'Encinedo', 24),
(3665, '68', '7', 'Ercina, La', 24),
(3666, '69', '0', 'Escobar de Campos', 24),
(3667, '70', '4', 'Fabero', 24),
(3668, '71', '1', 'Folgoso de la Ribera', 24),
(3669, '73', '2', 'Fresno de la Vega', 24),
(3670, '74', '7', 'Fuentes de Carbajal', 24),
(3671, '76', '3', 'Garrafe de Torío', 24),
(3672, '77', '9', 'Gordaliza del Pino', 24),
(3673, '78', '5', 'Gordoncillo', 24),
(3674, '79', '8', 'Gradefes', 24),
(3675, '80', '2', 'Grajal de Campos', 24),
(3676, '81', '9', 'Gusendos de los Oteros', 24),
(3677, '82', '4', 'Hospital de Órbigo', 24),
(3678, '83', '0', 'Igüeña', 24),
(3679, '84', '5', 'Izagre', 24),
(3680, '86', '1', 'Joarilla de las Matas', 24),
(3681, '87', '7', 'Laguna Dalga', 24),
(3682, '88', '3', 'Laguna de Negrillos', 24),
(3683, '89', '6', 'León', 24),
(3684, '92', '2', 'Llamas de la Ribera', 24),
(3685, '90', '0', 'Lucillo', 24),
(3686, '91', '7', 'Luyego', 24),
(3687, '93', '8', 'Magaz de Cepeda', 24),
(3688, '94', '3', 'Mansilla de las Mulas', 24),
(3689, '95', '6', 'Mansilla Mayor', 24),
(3690, '96', '9', 'Maraña', 24),
(3691, '97', '5', 'Matadeón de los Oteros', 24),
(3692, '98', '1', 'Matallana de Torío', 24),
(3693, '99', '4', 'Matanza', 24),
(3694, '100', '8', 'Molinaseca', 24),
(3695, '101', '5', 'Murias de Paredes', 24),
(3696, '102', '0', 'Noceda del Bierzo', 24),
(3697, '103', '6', 'Oencia', 24),
(3698, '104', '1', 'Omañas, Las', 24),
(3699, '105', '4', 'Onzonilla', 24),
(3700, '106', '7', 'Oseja de Sajambre', 24),
(3701, '107', '3', 'Pajares de los Oteros', 24),
(3702, '108', '9', 'Palacios de la Valduerna', 24),
(3703, '109', '2', 'Palacios del Sil', 24),
(3704, '110', '6', 'Páramo del Sil', 24),
(3705, '112', '8', 'Peranzanes', 24),
(3706, '113', '4', 'Pobladura de Pelayo García', 24),
(3707, '114', '9', 'Pola de Gordón, La', 24),
(3708, '115', '2', 'Ponferrada', 24),
(3709, '116', '5', 'Posada de Valdeón', 24),
(3710, '117', '1', 'Pozuelo del Páramo', 24),
(3711, '118', '7', 'Prado de la Guzpeña', 24),
(3712, '119', '0', 'Priaranza del Bierzo', 24),
(3713, '120', '4', 'Prioro', 24),
(3714, '121', '1', 'Puebla de Lillo', 24),
(3715, '122', '6', 'Puente de Domingo Flórez', 24),
(3716, '123', '2', 'Quintana del Castillo', 24),
(3717, '124', '7', 'Quintana del Marco', 24),
(3718, '125', '0', 'Quintana y Congosto', 24),
(3719, '127', '9', 'Regueras de Arriba', 24),
(3720, '129', '8', 'Reyero', 24),
(3721, '130', '2', 'Riaño', 24),
(3722, '131', '9', 'Riego de la Vega', 24),
(3723, '132', '4', 'Riello', 24),
(3724, '133', '0', 'Rioseco de Tapia', 24),
(3725, '134', '5', 'Robla, La', 24),
(3726, '136', '1', 'Roperuelos del Páramo', 24),
(3727, '137', '7', 'Sabero', 24),
(3728, '139', '6', 'Sahagún', 24),
(3729, '141', '7', 'San Adrián del Valle', 24),
(3730, '142', '2', 'San Andrés del Rabanedo', 24),
(3731, '144', '3', 'San Cristóbal de la Polantera', 24),
(3732, '145', '6', 'San Emiliano', 24),
(3733, '146', '9', 'San Esteban de Nogales', 24),
(3734, '148', '1', 'San Justo de la Vega', 24),
(3735, '149', '4', 'San Millán de los Caballeros', 24),
(3736, '150', '7', 'San Pedro Bercianos', 24),
(3737, '143', '8', 'Sancedo', 24),
(3738, '151', '4', 'Santa Colomba de Curueño', 24),
(3739, '152', '9', 'Santa Colomba de Somoza', 24),
(3740, '153', '5', 'Santa Cristina de Valmadrigal', 24),
(3741, '154', '0', 'Santa Elena de Jamuz', 24),
(3742, '155', '3', 'Santa María de la Isla', 24),
(3743, '158', '8', 'Santa María de Ordás', 24),
(3744, '156', '6', 'Santa María del Monte de Cea', 24),
(3745, '157', '2', 'Santa María del Páramo', 24),
(3746, '159', '1', 'Santa Marina del Rey', 24),
(3747, '160', '5', 'Santas Martas', 24),
(3748, '161', '2', 'Santiago Millas', 24),
(3749, '162', '7', 'Santovenia de la Valdoncina', 24),
(3750, '163', '3', 'Sariegos', 24),
(3751, '164', '8', 'Sena de Luna', 24),
(3752, '165', '1', 'Sobrado', 24),
(3753, '166', '4', 'Soto de la Vega', 24),
(3754, '167', '0', 'Soto y Amío', 24),
(3755, '168', '6', 'Toral de los Guzmanes', 24),
(3756, '206', '6', 'Toral de los Vados', 24),
(3757, '169', '9', 'Toreno', 24),
(3758, '170', '3', 'Torre del Bierzo', 24),
(3759, '171', '0', 'Trabadelo', 24),
(3760, '172', '5', 'Truchas', 24),
(3761, '173', '1', 'Turcia', 24),
(3762, '174', '6', 'Urdiales del Páramo', 24),
(3763, '185', '7', 'Val de San Lorenzo', 24),
(3764, '175', '9', 'Valdefresno', 24),
(3765, '176', '2', 'Valdefuentes del Páramo', 24),
(3766, '177', '8', 'Valdelugueros', 24),
(3767, '178', '4', 'Valdemora', 24),
(3768, '179', '7', 'Valdepiélago', 24),
(3769, '180', '1', 'Valdepolo', 24),
(3770, '181', '8', 'Valderas', 24),
(3771, '182', '3', 'Valderrey', 24),
(3772, '183', '9', 'Valderrueda', 24),
(3773, '184', '4', 'Valdesamario', 24),
(3774, '187', '6', 'Valdevimbre', 24),
(3775, '188', '2', 'Valencia de Don Juan', 24),
(3776, '191', '6', 'Vallecillo', 24),
(3777, '189', '5', 'Valverde de la Virgen', 24),
(3778, '190', '9', 'Valverde-Enrique', 24),
(3779, '193', '7', 'Vecilla, La', 24),
(3780, '196', '8', 'Vega de Espinareda', 24),
(3781, '197', '4', 'Vega de Infanzones', 24),
(3782, '198', '0', 'Vega de Valcarce', 24),
(3783, '194', '2', 'Vegacervera', 24),
(3784, '199', '3', 'Vegaquemada', 24),
(3785, '201', '4', 'Vegas del Condado', 24),
(3786, '202', '9', 'Villablino', 24),
(3787, '203', '5', 'Villabraz', 24),
(3788, '205', '3', 'Villadangos del Páramo', 24),
(3789, '207', '2', 'Villademor de la Vega', 24),
(3790, '209', '1', 'Villafranca del Bierzo', 24),
(3791, '210', '5', 'Villagatón', 24),
(3792, '211', '2', 'Villamandos', 24),
(3793, '901', '7', 'Villamanín', 24),
(3794, '212', '7', 'Villamañán', 24),
(3795, '213', '3', 'Villamartín de Don Sancho', 24),
(3796, '214', '8', 'Villamejil', 24),
(3797, '215', '1', 'Villamol', 24),
(3798, '216', '4', 'Villamontán de la Valduerna', 24),
(3799, '217', '0', 'Villamoratiel de las Matas', 24),
(3800, '218', '6', 'Villanueva de las Manzanas', 24),
(3801, '219', '9', 'Villaobispo de Otero', 24),
(3802, '902', '2', 'Villaornate y Castro', 24),
(3803, '221', '0', 'Villaquejida', 24),
(3804, '222', '5', 'Villaquilambre', 24),
(3805, '223', '1', 'Villarejo de Órbigo', 24),
(3806, '224', '6', 'Villares de Órbigo', 24),
(3807, '225', '9', 'Villasabariego', 24),
(3808, '226', '2', 'Villaselán', 24),
(3809, '227', '8', 'Villaturiel', 24),
(3810, '228', '4', 'Villazala', 24),
(3811, '229', '7', 'Villazanzo de Valderaduey', 24),
(3812, '230', '1', 'Zotes del Páramo', 24),
(3813, '1', '9', 'Abella de la Conca', 25),
(3814, '2', '4', 'Àger', 25),
(3815, '3', '0', 'Agramunt', 25),
(3816, '38', '7', 'Aitona', 25),
(3817, '4', '5', 'Alamús, Els', 25),
(3818, '5', '8', 'Alàs i Cerc', 25),
(3819, '6', '1', 'Albagés, L\'', 25),
(3820, '7', '7', 'Albatàrrec', 25),
(3821, '8', '3', 'Albesa', 25),
(3822, '9', '6', 'Albi, L\'', 25),
(3823, '10', '0', 'Alcanó', 25),
(3824, '11', '7', 'Alcarràs', 25),
(3825, '12', '2', 'Alcoletge', 25),
(3826, '13', '8', 'Alfarràs', 25),
(3827, '14', '3', 'Alfés', 25),
(3828, '15', '6', 'Algerri', 25),
(3829, '16', '9', 'Alguaire', 25),
(3830, '17', '5', 'Alins', 25),
(3831, '19', '4', 'Almacelles', 25),
(3832, '20', '8', 'Almatret', 25),
(3833, '21', '5', 'Almenar', 25),
(3834, '22', '0', 'Alòs de Balaguer', 25),
(3835, '23', '6', 'Alpicat', 25),
(3836, '24', '1', 'Alt Àneu', 25),
(3837, '27', '3', 'Anglesola', 25),
(3838, '29', '2', 'Arbeca', 25),
(3839, '31', '3', 'Arres', 25),
(3840, '32', '8', 'Arsèguel', 25),
(3841, '33', '4', 'Artesa de Lleida', 25),
(3842, '34', '9', 'Artesa de Segre', 25),
(3843, '36', '5', 'Aspa', 25),
(3844, '37', '1', 'Avellanes i Santa Linya, Les', 25),
(3845, '39', '0', 'Baix Pallars', 25),
(3846, '40', '4', 'Balaguer', 25),
(3847, '41', '1', 'Barbens', 25),
(3848, '42', '6', 'Baronia de Rialb, La', 25),
(3849, '44', '7', 'Bassella', 25),
(3850, '45', '0', 'Bausen', 25),
(3851, '46', '3', 'Belianes', 25),
(3852, '170', '6', 'Bellaguarda', 25),
(3853, '47', '9', 'Bellcaire d\'Urgell', 25),
(3854, '48', '5', 'Bell-lloc d\'Urgell', 25),
(3855, '49', '8', 'Bellmunt d\'Urgell', 25),
(3856, '50', '1', 'Bellpuig', 25),
(3857, '51', '8', 'Bellver de Cerdanya', 25),
(3858, '52', '3', 'Bellvís', 25),
(3859, '53', '9', 'Benavent de Segrià', 25),
(3860, '55', '7', 'Biosca', 25),
(3861, '57', '6', 'Bòrdes, Es', 25),
(3862, '58', '2', 'Borges Blanques, Les', 25),
(3863, '59', '5', 'Bossòst', 25),
(3864, '56', '0', 'Bovera', 25),
(3865, '60', '9', 'Cabanabona', 25),
(3866, '61', '6', 'Cabó', 25),
(3867, '62', '1', 'Camarasa', 25),
(3868, '63', '7', 'Canejan', 25),
(3869, '904', '6', 'Castell de Mur', 25),
(3870, '64', '2', 'Castellar de la Ribera', 25),
(3871, '67', '4', 'Castelldans', 25),
(3872, '68', '0', 'Castellnou de Seana', 25),
(3873, '69', '3', 'Castelló de Farfanya', 25),
(3874, '70', '7', 'Castellserà', 25),
(3875, '71', '4', 'Cava', 25),
(3876, '72', '9', 'Cervera', 25),
(3877, '73', '5', 'Cervià de les Garrigues', 25),
(3878, '74', '0', 'Ciutadilla', 25),
(3879, '75', '3', 'Clariana de Cardener', 25),
(3880, '76', '6', 'Cogul, El', 25),
(3881, '77', '2', 'Coll de Nargó', 25),
(3882, '163', '6', 'Coma i la Pedra, La', 25),
(3883, '161', '5', 'Conca de Dalt', 25),
(3884, '78', '8', 'Corbins', 25),
(3885, '79', '1', 'Cubells', 25),
(3886, '81', '2', 'Espluga Calba, L\'', 25),
(3887, '82', '7', 'Espot', 25),
(3888, '88', '6', 'Estamariu', 25),
(3889, '85', '1', 'Estaràs', 25),
(3890, '86', '4', 'Esterri d\'Àneu', 25),
(3891, '87', '0', 'Esterri de Cardós', 25),
(3892, '89', '9', 'Farrera', 25),
(3893, '908', '4', 'Fígols i Alinyà', 25),
(3894, '92', '5', 'Floresta, La', 25),
(3895, '93', '1', 'Fondarella', 25),
(3896, '94', '6', 'Foradada', 25),
(3897, '96', '2', 'Fuliola, La', 25),
(3898, '97', '8', 'Fulleda', 25),
(3899, '98', '4', 'Gavet de la Conca', 25),
(3900, '912', '3', 'Gimenells i el Pla de la Font', 25),
(3901, '99', '7', 'Golmés', 25),
(3902, '100', '1', 'Gósol', 25),
(3903, '101', '8', 'Granadella, La', 25),
(3904, '102', '3', 'Granja d\'Escarp, La', 25),
(3905, '103', '9', 'Granyanella', 25),
(3906, '105', '7', 'Granyena de les Garrigues', 25),
(3907, '104', '4', 'Granyena de Segarra', 25),
(3908, '109', '5', 'Guimerà', 25),
(3909, '903', '1', 'Guingueta d\'Àneu, La', 25),
(3910, '110', '9', 'Guissona', 25),
(3911, '111', '6', 'Guixers', 25),
(3912, '115', '5', 'Isona i Conca Dellà', 25),
(3913, '112', '1', 'Ivars de Noguera', 25),
(3914, '113', '7', 'Ivars d\'Urgell', 25),
(3915, '114', '2', 'Ivorra', 25),
(3916, '910', '1', 'Josa i Tuixén', 25),
(3917, '118', '0', 'Juncosa', 25),
(3918, '119', '3', 'Juneda', 25),
(3919, '121', '4', 'Les', 25),
(3920, '122', '9', 'Linyola', 25),
(3921, '123', '5', 'Lladorre', 25),
(3922, '124', '0', 'Lladurs', 25),
(3923, '125', '3', 'Llardecans', 25),
(3924, '126', '6', 'Llavorsí', 25),
(3925, '120', '7', 'Lleida', 25),
(3926, '127', '2', 'Lles de Cerdanya', 25),
(3927, '128', '8', 'Llimiana', 25),
(3928, '129', '1', 'Llobera', 25),
(3929, '133', '3', 'Maials', 25),
(3930, '130', '5', 'Maldà', 25),
(3931, '131', '2', 'Massalcoreig', 25),
(3932, '132', '7', 'Massoteres', 25),
(3933, '134', '8', 'Menàrguens', 25),
(3934, '135', '1', 'Miralcamp', 25),
(3935, '137', '0', 'Mollerussa', 25),
(3936, '136', '4', 'Molsosa, La', 25),
(3937, '139', '9', 'Montellà i Martinet', 25),
(3938, '140', '3', 'Montferrer i Castellbò', 25),
(3939, '138', '6', 'Montgai', 25),
(3940, '142', '5', 'Montoliu de Lleida', 25),
(3941, '141', '0', 'Montoliu de Segarra', 25),
(3942, '143', '1', 'Montornès de Segarra', 25),
(3943, '145', '9', 'Nalec', 25),
(3944, '25', '4', 'Naut Aran', 25),
(3945, '146', '2', 'Navès', 25),
(3946, '148', '4', 'Odèn', 25),
(3947, '149', '7', 'Oliana', 25),
(3948, '150', '0', 'Oliola', 25),
(3949, '151', '7', 'Olius', 25),
(3950, '152', '2', 'Oluges, Les', 25),
(3951, '153', '8', 'Omellons, Els', 25),
(3952, '154', '3', 'Omells de na Gaia, Els', 25),
(3953, '155', '6', 'Organyà', 25),
(3954, '156', '9', 'Os de Balaguer', 25),
(3955, '157', '5', 'Ossó de Sió', 25),
(3956, '158', '1', 'Palau d\'Anglesola, El', 25),
(3957, '164', '1', 'Penelles', 25),
(3958, '165', '4', 'Peramola', 25),
(3959, '166', '7', 'Pinell de Solsonès', 25),
(3960, '167', '3', 'Pinós', 25),
(3961, '911', '8', 'Plans de Sió, Els', 25),
(3962, '168', '9', 'Poal, El', 25),
(3963, '169', '2', 'Pobla de Cérvoles, La', 25),
(3964, '171', '3', 'Pobla de Segur, La', 25),
(3965, '30', '6', 'Pont de Bar, El', 25),
(3966, '173', '4', 'Pont de Suert, El', 25),
(3967, '172', '8', 'Ponts', 25),
(3968, '174', '9', 'Portella, La', 25),
(3969, '175', '2', 'Prats i Sansor', 25),
(3970, '176', '5', 'Preixana', 25),
(3971, '177', '1', 'Preixens', 25),
(3972, '179', '0', 'Prullans', 25),
(3973, '180', '4', 'Puiggròs', 25),
(3974, '181', '1', 'Puigverd d\'Agramunt', 25),
(3975, '182', '6', 'Puigverd de Lleida', 25),
(3976, '183', '2', 'Rialp', 25),
(3977, '905', '9', 'Ribera d\'Ondara', 25),
(3978, '185', '0', 'Ribera d\'Urgellet', 25),
(3979, '186', '3', 'Riner', 25),
(3980, '913', '9', 'Riu de Cerdanya', 25),
(3981, '189', '8', 'Rosselló', 25),
(3982, '190', '2', 'Salàs de Pallars', 25),
(3983, '191', '9', 'Sanaüja', 25),
(3984, '196', '1', 'Sant Esteve de la Sarga', 25),
(3985, '192', '4', 'Sant Guim de Freixenet', 25),
(3986, '197', '7', 'Sant Guim de la Plana', 25),
(3987, '193', '0', 'Sant Llorenç de Morunys', 25),
(3988, '902', '5', 'Sant Martí de Riucorb', 25),
(3989, '194', '5', 'Sant Ramon', 25),
(3990, '201', '7', 'Sarroca de Bellera', 25),
(3991, '200', '0', 'Sarroca de Lleida', 25),
(3992, '202', '2', 'Senterada', 25),
(3993, '35', '2', 'Sentiu de Sió, La', 25),
(3994, '204', '3', 'Seròs', 25),
(3995, '203', '8', 'Seu d\'Urgell, La', 25),
(3996, '205', '6', 'Sidamon', 25),
(3997, '206', '9', 'Soleràs, El', 25),
(3998, '207', '5', 'Solsona', 25),
(3999, '208', '1', 'Soriguera', 25),
(4000, '209', '4', 'Sort', 25),
(4001, '210', '8', 'Soses', 25),
(4002, '211', '5', 'Sudanell', 25),
(4003, '212', '0', 'Sunyer', 25),
(4004, '215', '4', 'Talarn', 25),
(4005, '216', '7', 'Talavera', 25),
(4006, '217', '3', 'Tàrrega', 25),
(4007, '218', '9', 'Tarrés', 25),
(4008, '219', '2', 'Tarroja de Segarra', 25),
(4009, '220', '6', 'Térmens', 25),
(4010, '221', '3', 'Tírvia', 25),
(4011, '222', '8', 'Tiurana', 25),
(4012, '223', '4', 'Torà', 25),
(4013, '224', '9', 'Torms, Els', 25),
(4014, '225', '2', 'Tornabous', 25),
(4015, '227', '1', 'Torre de Cabdella, La', 25),
(4016, '226', '5', 'Torrebesses', 25),
(4017, '228', '7', 'Torrefarrera', 25),
(4018, '907', '8', 'Torrefeta i Florejacs', 25),
(4019, '230', '4', 'Torregrossa', 25),
(4020, '231', '1', 'Torrelameu', 25),
(4021, '232', '6', 'Torres de Segre', 25),
(4022, '233', '2', 'Torre-serona', 25),
(4023, '234', '7', 'Tremp', 25),
(4024, '43', '2', 'Vall de Boí, La', 25),
(4025, '901', '0', 'Vall de Cardós', 25),
(4026, '238', '5', 'Vallbona de les Monges', 25),
(4027, '240', '2', 'Vallfogona de Balaguer', 25),
(4028, '906', '2', 'Valls d\'Aguilar, Les', 25),
(4029, '239', '8', 'Valls de Valira, Les', 25);
INSERT INTO `poblaciones` (`id`, `codigo`, `cp`, `poblacion`, `provincia_id`) VALUES
(4030, '909', '7', 'Vansa i Fórnols, La', 25),
(4031, '242', '4', 'Verdú', 25),
(4032, '243', '0', 'Vielha e Mijaran', 25),
(4033, '244', '5', 'Vilagrassa', 25),
(4034, '245', '8', 'Vilaller', 25),
(4035, '247', '7', 'Vilamòs', 25),
(4036, '248', '3', 'Vilanova de Bellpuig', 25),
(4037, '254', '2', 'Vilanova de la Barca', 25),
(4038, '249', '6', 'Vilanova de l\'Aguda', 25),
(4039, '250', '9', 'Vilanova de Meià', 25),
(4040, '251', '6', 'Vilanova de Segrià', 25),
(4041, '252', '1', 'Vila-sana', 25),
(4042, '253', '7', 'Vilosell, El', 25),
(4043, '255', '5', 'Vinaixa', 25),
(4044, '1', '2', 'Ábalos', 26),
(4045, '2', '7', 'Agoncillo', 26),
(4046, '3', '3', 'Aguilar del Río Alhama', 26),
(4047, '4', '8', 'Ajamil de Cameros', 26),
(4048, '5', '1', 'Albelda de Iregua', 26),
(4049, '6', '4', 'Alberite', 26),
(4050, '7', '0', 'Alcanadre', 26),
(4051, '8', '6', 'Aldeanueva de Ebro', 26),
(4052, '9', '9', 'Alesanco', 26),
(4053, '10', '3', 'Alesón', 26),
(4054, '11', '0', 'Alfaro', 26),
(4055, '12', '5', 'Almarza de Cameros', 26),
(4056, '13', '1', 'Anguciana', 26),
(4057, '14', '6', 'Anguiano', 26),
(4058, '15', '9', 'Arenzana de Abajo', 26),
(4059, '16', '2', 'Arenzana de Arriba', 26),
(4060, '17', '8', 'Arnedillo', 26),
(4061, '18', '4', 'Arnedo', 26),
(4062, '19', '7', 'Arrúbal', 26),
(4063, '20', '1', 'Ausejo', 26),
(4064, '21', '8', 'Autol', 26),
(4065, '22', '3', 'Azofra', 26),
(4066, '23', '9', 'Badarán', 26),
(4067, '24', '4', 'Bañares', 26),
(4068, '26', '0', 'Baños de Río Tobía', 26),
(4069, '25', '7', 'Baños de Rioja', 26),
(4070, '27', '6', 'Berceo', 26),
(4071, '28', '2', 'Bergasa', 26),
(4072, '29', '5', 'Bergasillas Bajera', 26),
(4073, '30', '9', 'Bezares', 26),
(4074, '31', '6', 'Bobadilla', 26),
(4075, '32', '1', 'Brieva de Cameros', 26),
(4076, '33', '7', 'Briñas', 26),
(4077, '34', '2', 'Briones', 26),
(4078, '35', '5', 'Cabezón de Cameros', 26),
(4079, '36', '8', 'Calahorra', 26),
(4080, '37', '4', 'Camprovín', 26),
(4081, '38', '0', 'Canales de la Sierra', 26),
(4082, '39', '3', 'Canillas de Río Tuerto', 26),
(4083, '40', '7', 'Cañas', 26),
(4084, '41', '4', 'Cárdenas', 26),
(4085, '42', '9', 'Casalarreina', 26),
(4086, '43', '5', 'Castañares de Rioja', 26),
(4087, '44', '0', 'Castroviejo', 26),
(4088, '45', '3', 'Cellorigo', 26),
(4089, '46', '6', 'Cenicero', 26),
(4090, '47', '2', 'Cervera del Río Alhama', 26),
(4091, '48', '8', 'Cidamón', 26),
(4092, '49', '1', 'Cihuri', 26),
(4093, '50', '4', 'Cirueña', 26),
(4094, '51', '1', 'Clavijo', 26),
(4095, '52', '6', 'Cordovín', 26),
(4096, '53', '2', 'Corera', 26),
(4097, '54', '7', 'Cornago', 26),
(4098, '55', '0', 'Corporales', 26),
(4099, '56', '3', 'Cuzcurrita de Río Tirón', 26),
(4100, '57', '9', 'Daroca de Rioja', 26),
(4101, '58', '5', 'Enciso', 26),
(4102, '59', '8', 'Entrena', 26),
(4103, '60', '2', 'Estollo', 26),
(4104, '61', '9', 'Ezcaray', 26),
(4105, '62', '4', 'Foncea', 26),
(4106, '63', '0', 'Fonzaleche', 26),
(4107, '64', '5', 'Fuenmayor', 26),
(4108, '65', '8', 'Galbárruli', 26),
(4109, '66', '1', 'Galilea', 26),
(4110, '67', '7', 'Gallinero de Cameros', 26),
(4111, '68', '3', 'Gimileo', 26),
(4112, '69', '6', 'Grañón', 26),
(4113, '70', '0', 'Grávalos', 26),
(4114, '71', '7', 'Haro', 26),
(4115, '72', '2', 'Herce', 26),
(4116, '73', '8', 'Herramélluri', 26),
(4117, '74', '3', 'Hervías', 26),
(4118, '75', '6', 'Hormilla', 26),
(4119, '76', '9', 'Hormilleja', 26),
(4120, '77', '5', 'Hornillos de Cameros', 26),
(4121, '78', '1', 'Hornos de Moncalvillo', 26),
(4122, '79', '4', 'Huércanos', 26),
(4123, '80', '8', 'Igea', 26),
(4124, '81', '5', 'Jalón de Cameros', 26),
(4125, '82', '0', 'Laguna de Cameros', 26),
(4126, '83', '6', 'Lagunilla del Jubera', 26),
(4127, '84', '1', 'Lardero', 26),
(4128, '86', '7', 'Ledesma de la Cogolla', 26),
(4129, '87', '3', 'Leiva', 26),
(4130, '88', '9', 'Leza de Río Leza', 26),
(4131, '89', '2', 'Logroño', 26),
(4132, '91', '3', 'Lumbreras', 26),
(4133, '92', '8', 'Manjarrés', 26),
(4134, '93', '4', 'Mansilla de la Sierra', 26),
(4135, '94', '9', 'Manzanares de Rioja', 26),
(4136, '95', '2', 'Matute', 26),
(4137, '96', '5', 'Medrano', 26),
(4138, '98', '7', 'Munilla', 26),
(4139, '99', '0', 'Murillo de Río Leza', 26),
(4140, '100', '4', 'Muro de Aguas', 26),
(4141, '101', '1', 'Muro en Cameros', 26),
(4142, '102', '6', 'Nájera', 26),
(4143, '103', '2', 'Nalda', 26),
(4144, '104', '7', 'Navajún', 26),
(4145, '105', '0', 'Navarrete', 26),
(4146, '106', '3', 'Nestares', 26),
(4147, '107', '9', 'Nieva de Cameros', 26),
(4148, '109', '8', 'Ochánduri', 26),
(4149, '108', '5', 'Ocón', 26),
(4150, '110', '2', 'Ojacastro', 26),
(4151, '111', '9', 'Ollauri', 26),
(4152, '112', '4', 'Ortigosa de Cameros', 26),
(4153, '113', '0', 'Pazuengos', 26),
(4154, '114', '5', 'Pedroso', 26),
(4155, '115', '8', 'Pinillos', 26),
(4156, '117', '7', 'Pradejón', 26),
(4157, '118', '3', 'Pradillo', 26),
(4158, '119', '6', 'Préjano', 26),
(4159, '120', '0', 'Quel', 26),
(4160, '121', '7', 'Rabanera', 26),
(4161, '122', '2', 'Rasillo de Cameros, El', 26),
(4162, '123', '8', 'Redal, El', 26),
(4163, '124', '3', 'Ribafrecha', 26),
(4164, '125', '6', 'Rincón de Soto', 26),
(4165, '126', '9', 'Robres del Castillo', 26),
(4166, '127', '5', 'Rodezno', 26),
(4167, '128', '1', 'Sajazarra', 26),
(4168, '129', '4', 'San Asensio', 26),
(4169, '130', '8', 'San Millán de la Cogolla', 26),
(4170, '131', '5', 'San Millán de Yécora', 26),
(4171, '132', '0', 'San Román de Cameros', 26),
(4172, '139', '2', 'San Torcuato', 26),
(4173, '142', '8', 'San Vicente de la Sonsierra', 26),
(4174, '134', '1', 'Santa Coloma', 26),
(4175, '135', '4', 'Santa Engracia del Jubera', 26),
(4176, '136', '7', 'Santa Eulalia Bajera', 26),
(4177, '138', '9', 'Santo Domingo de la Calzada', 26),
(4178, '140', '6', 'Santurde de Rioja', 26),
(4179, '141', '3', 'Santurdejo', 26),
(4180, '143', '4', 'Sojuela', 26),
(4181, '144', '9', 'Sorzano', 26),
(4182, '145', '2', 'Sotés', 26),
(4183, '146', '5', 'Soto en Cameros', 26),
(4184, '147', '1', 'Terroba', 26),
(4185, '148', '7', 'Tirgo', 26),
(4186, '149', '0', 'Tobía', 26),
(4187, '150', '3', 'Tormantos', 26),
(4188, '153', '1', 'Torre en Cameros', 26),
(4189, '151', '0', 'Torrecilla en Cameros', 26),
(4190, '152', '5', 'Torrecilla sobre Alesanco', 26),
(4191, '154', '6', 'Torremontalbo', 26),
(4192, '155', '9', 'Treviana', 26),
(4193, '157', '8', 'Tricio', 26),
(4194, '158', '4', 'Tudelilla', 26),
(4195, '160', '1', 'Uruñuela', 26),
(4196, '161', '8', 'Valdemadera', 26),
(4197, '162', '3', 'Valgañón', 26),
(4198, '163', '9', 'Ventosa', 26),
(4199, '164', '4', 'Ventrosa', 26),
(4200, '165', '7', 'Viguera', 26),
(4201, '166', '0', 'Villalba de Rioja', 26),
(4202, '167', '6', 'Villalobar de Rioja', 26),
(4203, '168', '2', 'Villamediana de Iregua', 26),
(4204, '169', '5', 'Villanueva de Cameros', 26),
(4205, '170', '9', 'Villar de Arnedo, El', 26),
(4206, '171', '6', 'Villar de Torre', 26),
(4207, '172', '1', 'Villarejo', 26),
(4208, '173', '7', 'Villarroya', 26),
(4209, '174', '2', 'Villarta-Quintana', 26),
(4210, '175', '5', 'Villavelayo', 26),
(4211, '176', '8', 'Villaverde de Rioja', 26),
(4212, '177', '4', 'Villoslada de Cameros', 26),
(4213, '178', '0', 'Viniegra de Abajo', 26),
(4214, '179', '3', 'Viniegra de Arriba', 26),
(4215, '180', '7', 'Zarratón', 26),
(4216, '181', '4', 'Zarzosa', 26),
(4217, '183', '5', 'Zorraquín', 26),
(4218, '1', '8', 'Abadín', 27),
(4219, '2', '3', 'Alfoz', 27),
(4220, '3', '9', 'Antas de Ulla', 27),
(4221, '4', '4', 'Baleira', 27),
(4222, '901', '9', 'Baralla', 27),
(4223, '5', '7', 'Barreiros', 27),
(4224, '6', '0', 'Becerreá', 27),
(4225, '7', '6', 'Begonte', 27),
(4226, '8', '2', 'Bóveda', 27),
(4227, '902', '4', 'Burela', 27),
(4228, '9', '5', 'Carballedo', 27),
(4229, '10', '9', 'Castro de Rei', 27),
(4230, '11', '6', 'Castroverde', 27),
(4231, '12', '1', 'Cervantes', 27),
(4232, '13', '7', 'Cervo', 27),
(4233, '16', '8', 'Chantada', 27),
(4234, '14', '2', 'Corgo, O', 27),
(4235, '15', '5', 'Cospeito', 27),
(4236, '17', '4', 'Folgoso do Courel', 27),
(4237, '18', '0', 'Fonsagrada, A', 27),
(4238, '19', '3', 'Foz', 27),
(4239, '20', '7', 'Friol', 27),
(4240, '22', '9', 'Guitiriz', 27),
(4241, '23', '5', 'Guntín', 27),
(4242, '24', '0', 'Incio, O', 27),
(4243, '26', '6', 'Láncara', 27),
(4244, '27', '2', 'Lourenzá', 27),
(4245, '28', '8', 'Lugo', 27),
(4246, '29', '1', 'Meira', 27),
(4247, '30', '5', 'Mondoñedo', 27),
(4248, '31', '2', 'Monforte de Lemos', 27),
(4249, '32', '7', 'Monterroso', 27),
(4250, '33', '3', 'Muras', 27),
(4251, '34', '8', 'Navia de Suarna', 27),
(4252, '35', '1', 'Negueira de Muñiz', 27),
(4253, '37', '0', 'Nogais, As', 27),
(4254, '38', '6', 'Ourol', 27),
(4255, '39', '9', 'Outeiro de Rei', 27),
(4256, '40', '3', 'Palas de Rei', 27),
(4257, '41', '0', 'Pantón', 27),
(4258, '42', '5', 'Paradela', 27),
(4259, '43', '1', 'Páramo, O', 27),
(4260, '44', '6', 'Pastoriza, A', 27),
(4261, '45', '9', 'Pedrafita do Cebreiro', 27),
(4262, '47', '8', 'Pobra do Brollón, A', 27),
(4263, '46', '2', 'Pol', 27),
(4264, '48', '4', 'Pontenova, A', 27),
(4265, '49', '7', 'Portomarín', 27),
(4266, '50', '0', 'Quiroga', 27),
(4267, '56', '9', 'Rábade', 27),
(4268, '51', '7', 'Ribadeo', 27),
(4269, '52', '2', 'Ribas de Sil', 27),
(4270, '53', '8', 'Ribeira de Piquín', 27),
(4271, '54', '3', 'Riotorto', 27),
(4272, '55', '6', 'Samos', 27),
(4273, '57', '5', 'Sarria', 27),
(4274, '58', '1', 'Saviñao, O', 27),
(4275, '59', '4', 'Sober', 27),
(4276, '60', '8', 'Taboada', 27),
(4277, '61', '5', 'Trabada', 27),
(4278, '62', '0', 'Triacastela', 27),
(4279, '63', '6', 'Valadouro, O', 27),
(4280, '64', '1', 'Vicedo, O', 27),
(4281, '65', '4', 'Vilalba', 27),
(4282, '66', '7', 'Viveiro', 27),
(4283, '21', '4', 'Xermade', 27),
(4284, '25', '3', 'Xove', 27),
(4285, '1', '4', 'Acebeda, La', 28),
(4286, '2', '9', 'Ajalvir', 28),
(4287, '3', '5', 'Alameda del Valle', 28),
(4288, '4', '0', 'Álamo, El', 28),
(4289, '5', '3', 'Alcalá de Henares', 28),
(4290, '6', '6', 'Alcobendas', 28),
(4291, '7', '2', 'Alcorcón', 28),
(4292, '8', '8', 'Aldea del Fresno', 28),
(4293, '9', '1', 'Algete', 28),
(4294, '10', '5', 'Alpedrete', 28),
(4295, '11', '2', 'Ambite', 28),
(4296, '12', '7', 'Anchuelo', 28),
(4297, '13', '3', 'Aranjuez', 28),
(4298, '14', '8', 'Arganda del Rey', 28),
(4299, '15', '1', 'Arroyomolinos', 28),
(4300, '16', '4', 'Atazar, El', 28),
(4301, '17', '0', 'Batres', 28),
(4302, '18', '6', 'Becerril de la Sierra', 28),
(4303, '19', '9', 'Belmonte de Tajo', 28),
(4304, '21', '0', 'Berrueco, El', 28),
(4305, '20', '3', 'Berzosa del Lozoya', 28),
(4306, '22', '5', 'Boadilla del Monte', 28),
(4307, '23', '1', 'Boalo, El', 28),
(4308, '24', '6', 'Braojos', 28),
(4309, '25', '9', 'Brea de Tajo', 28),
(4310, '26', '2', 'Brunete', 28),
(4311, '27', '8', 'Buitrago del Lozoya', 28),
(4312, '28', '4', 'Bustarviejo', 28),
(4313, '29', '7', 'Cabanillas de la Sierra', 28),
(4314, '30', '1', 'Cabrera, La', 28),
(4315, '31', '8', 'Cadalso de los Vidrios', 28),
(4316, '32', '3', 'Camarma de Esteruelas', 28),
(4317, '33', '9', 'Campo Real', 28),
(4318, '34', '4', 'Canencia', 28),
(4319, '35', '7', 'Carabaña', 28),
(4320, '36', '0', 'Casarrubuelos', 28),
(4321, '37', '6', 'Cenicientos', 28),
(4322, '38', '2', 'Cercedilla', 28),
(4323, '39', '5', 'Cervera de Buitrago', 28),
(4324, '51', '3', 'Chapinería', 28),
(4325, '52', '8', 'Chinchón', 28),
(4326, '40', '9', 'Ciempozuelos', 28),
(4327, '41', '6', 'Cobeña', 28),
(4328, '46', '8', 'Collado Mediano', 28),
(4329, '47', '4', 'Collado Villalba', 28),
(4330, '43', '7', 'Colmenar de Oreja', 28),
(4331, '42', '1', 'Colmenar del Arroyo', 28),
(4332, '45', '5', 'Colmenar Viejo', 28),
(4333, '44', '2', 'Colmenarejo', 28),
(4334, '48', '0', 'Corpa', 28),
(4335, '49', '3', 'Coslada', 28),
(4336, '50', '6', 'Cubas de la Sagra', 28),
(4337, '53', '4', 'Daganzo de Arriba', 28),
(4338, '54', '9', 'Escorial, El', 28),
(4339, '55', '2', 'Estremera', 28),
(4340, '56', '5', 'Fresnedillas de la Oliva', 28),
(4341, '57', '1', 'Fresno de Torote', 28),
(4342, '58', '7', 'Fuenlabrada', 28),
(4343, '59', '0', 'Fuente el Saz de Jarama', 28),
(4344, '60', '4', 'Fuentidueña de Tajo', 28),
(4345, '61', '1', 'Galapagar', 28),
(4346, '62', '6', 'Garganta de los Montes', 28),
(4347, '63', '2', 'Gargantilla del Lozoya y Pinilla de Buitrago', 28),
(4348, '64', '7', 'Gascones', 28),
(4349, '65', '0', 'Getafe', 28),
(4350, '66', '3', 'Griñón', 28),
(4351, '67', '9', 'Guadalix de la Sierra', 28),
(4352, '68', '5', 'Guadarrama', 28),
(4353, '69', '8', 'Hiruela, La', 28),
(4354, '70', '2', 'Horcajo de la Sierra-Aoslos', 28),
(4355, '71', '9', 'Horcajuelo de la Sierra', 28),
(4356, '72', '4', 'Hoyo de Manzanares', 28),
(4357, '73', '0', 'Humanes de Madrid', 28),
(4358, '74', '5', 'Leganés', 28),
(4359, '75', '8', 'Loeches', 28),
(4360, '76', '1', 'Lozoya', 28),
(4361, '901', '5', 'Lozoyuela-Navas-Sieteiglesias', 28),
(4362, '78', '3', 'Madarcos', 28),
(4363, '79', '6', 'Madrid', 28),
(4364, '80', '0', 'Majadahonda', 28),
(4365, '82', '2', 'Manzanares el Real', 28),
(4366, '83', '8', 'Meco', 28),
(4367, '84', '3', 'Mejorada del Campo', 28),
(4368, '85', '6', 'Miraflores de la Sierra', 28),
(4369, '86', '9', 'Molar, El', 28),
(4370, '87', '5', 'Molinos, Los', 28),
(4371, '88', '1', 'Montejo de la Sierra', 28),
(4372, '89', '4', 'Moraleja de Enmedio', 28),
(4373, '90', '8', 'Moralzarzal', 28),
(4374, '91', '5', 'Morata de Tajuña', 28),
(4375, '92', '0', 'Móstoles', 28),
(4376, '93', '6', 'Navacerrada', 28),
(4377, '94', '1', 'Navalafuente', 28),
(4378, '95', '4', 'Navalagamella', 28),
(4379, '96', '7', 'Navalcarnero', 28),
(4380, '97', '3', 'Navarredonda y San Mamés', 28),
(4381, '99', '2', 'Navas del Rey', 28),
(4382, '100', '6', 'Nuevo Baztán', 28),
(4383, '101', '3', 'Olmeda de las Fuentes', 28),
(4384, '102', '8', 'Orusco de Tajuña', 28),
(4385, '104', '9', 'Paracuellos de Jarama', 28),
(4386, '106', '5', 'Parla', 28),
(4387, '107', '1', 'Patones', 28),
(4388, '108', '7', 'Pedrezuela', 28),
(4389, '109', '0', 'Pelayos de la Presa', 28),
(4390, '110', '4', 'Perales de Tajuña', 28),
(4391, '111', '1', 'Pezuela de las Torres', 28),
(4392, '112', '6', 'Pinilla del Valle', 28),
(4393, '113', '2', 'Pinto', 28),
(4394, '114', '7', 'Piñuécar-Gandullas', 28),
(4395, '115', '0', 'Pozuelo de Alarcón', 28),
(4396, '116', '3', 'Pozuelo del Rey', 28),
(4397, '117', '9', 'Prádena del Rincón', 28),
(4398, '118', '5', 'Puebla de la Sierra', 28),
(4399, '902', '0', 'Puentes Viejas', 28),
(4400, '119', '8', 'Quijorna', 28),
(4401, '120', '2', 'Rascafría', 28),
(4402, '121', '9', 'Redueña', 28),
(4403, '122', '4', 'Ribatejada', 28),
(4404, '123', '0', 'Rivas-Vaciamadrid', 28),
(4405, '124', '5', 'Robledillo de la Jara', 28),
(4406, '125', '8', 'Robledo de Chavela', 28),
(4407, '126', '1', 'Robregordo', 28),
(4408, '127', '7', 'Rozas de Madrid, Las', 28),
(4409, '128', '3', 'Rozas de Puerto Real', 28),
(4410, '129', '6', 'San Agustín del Guadalix', 28),
(4411, '130', '0', 'San Fernando de Henares', 28),
(4412, '131', '7', 'San Lorenzo de El Escorial', 28),
(4413, '132', '2', 'San Martín de la Vega', 28),
(4414, '133', '8', 'San Martín de Valdeiglesias', 28),
(4415, '134', '3', 'San Sebastián de los Reyes', 28),
(4416, '135', '6', 'Santa María de la Alameda', 28),
(4417, '136', '9', 'Santorcaz', 28),
(4418, '137', '5', 'Santos de la Humosa, Los', 28),
(4419, '138', '1', 'Serna del Monte, La', 28),
(4420, '140', '8', 'Serranillos del Valle', 28),
(4421, '141', '5', 'Sevilla la Nueva', 28),
(4422, '143', '6', 'Somosierra', 28),
(4423, '144', '1', 'Soto del Real', 28),
(4424, '145', '4', 'Talamanca de Jarama', 28),
(4425, '146', '7', 'Tielmes', 28),
(4426, '147', '3', 'Titulcia', 28),
(4427, '148', '9', 'Torrejón de Ardoz', 28),
(4428, '149', '2', 'Torrejón de la Calzada', 28),
(4429, '150', '5', 'Torrejón de Velasco', 28),
(4430, '151', '2', 'Torrelaguna', 28),
(4431, '152', '7', 'Torrelodones', 28),
(4432, '153', '3', 'Torremocha de Jarama', 28),
(4433, '154', '8', 'Torres de la Alameda', 28),
(4434, '903', '6', 'Tres Cantos', 28),
(4435, '155', '1', 'Valdaracete', 28),
(4436, '156', '4', 'Valdeavero', 28),
(4437, '157', '0', 'Valdelaguna', 28),
(4438, '158', '6', 'Valdemanco', 28),
(4439, '159', '9', 'Valdemaqueda', 28),
(4440, '160', '3', 'Valdemorillo', 28),
(4441, '161', '0', 'Valdemoro', 28),
(4442, '162', '5', 'Valdeolmos-Alalpardo', 28),
(4443, '163', '1', 'Valdepiélagos', 28),
(4444, '164', '6', 'Valdetorres de Jarama', 28),
(4445, '165', '9', 'Valdilecha', 28),
(4446, '166', '2', 'Valverde de Alcalá', 28),
(4447, '167', '8', 'Velilla de San Antonio', 28),
(4448, '168', '4', 'Vellón, El', 28),
(4449, '169', '7', 'Venturada', 28),
(4450, '171', '8', 'Villa del Prado', 28),
(4451, '170', '1', 'Villaconejos', 28),
(4452, '172', '3', 'Villalbilla', 28),
(4453, '173', '9', 'Villamanrique de Tajo', 28),
(4454, '174', '4', 'Villamanta', 28),
(4455, '175', '7', 'Villamantilla', 28),
(4456, '176', '0', 'Villanueva de la Cañada', 28),
(4457, '178', '2', 'Villanueva de Perales', 28),
(4458, '177', '6', 'Villanueva del Pardillo', 28),
(4459, '179', '5', 'Villar del Olmo', 28),
(4460, '180', '9', 'Villarejo de Salvanés', 28),
(4461, '181', '6', 'Villaviciosa de Odón', 28),
(4462, '182', '1', 'Villavieja del Lozoya', 28),
(4463, '183', '7', 'Zarzalejo', 28),
(4464, '1', '7', 'Alameda', 29),
(4465, '2', '2', 'Alcaucín', 29),
(4466, '3', '8', 'Alfarnate', 29),
(4467, '4', '3', 'Alfarnatejo', 29),
(4468, '5', '6', 'Algarrobo', 29),
(4469, '6', '9', 'Algatocín', 29),
(4470, '7', '5', 'Alhaurín de la Torre', 29),
(4471, '8', '1', 'Alhaurín el Grande', 29),
(4472, '9', '4', 'Almáchar', 29),
(4473, '10', '8', 'Almargen', 29),
(4474, '11', '5', 'Almogía', 29),
(4475, '12', '0', 'Álora', 29),
(4476, '13', '6', 'Alozaina', 29),
(4477, '14', '1', 'Alpandeire', 29),
(4478, '15', '4', 'Antequera', 29),
(4479, '16', '7', 'Árchez', 29),
(4480, '17', '3', 'Archidona', 29),
(4481, '18', '9', 'Ardales', 29),
(4482, '19', '2', 'Arenas', 29),
(4483, '20', '6', 'Arriate', 29),
(4484, '21', '3', 'Atajate', 29),
(4485, '22', '8', 'Benadalid', 29),
(4486, '23', '4', 'Benahavís', 29),
(4487, '24', '9', 'Benalauría', 29),
(4488, '25', '2', 'Benalmádena', 29),
(4489, '26', '5', 'Benamargosa', 29),
(4490, '27', '1', 'Benamocarra', 29),
(4491, '28', '7', 'Benaoján', 29),
(4492, '29', '0', 'Benarrabá', 29),
(4493, '30', '4', 'Borge, El', 29),
(4494, '31', '1', 'Burgo, El', 29),
(4495, '32', '6', 'Campillos', 29),
(4496, '33', '2', 'Canillas de Aceituno', 29),
(4497, '34', '7', 'Canillas de Albaida', 29),
(4498, '35', '0', 'Cañete la Real', 29),
(4499, '36', '3', 'Carratraca', 29),
(4500, '37', '9', 'Cartajima', 29),
(4501, '38', '5', 'Cártama', 29),
(4502, '39', '8', 'Casabermeja', 29),
(4503, '40', '2', 'Casarabonela', 29),
(4504, '41', '9', 'Casares', 29),
(4505, '42', '4', 'Coín', 29),
(4506, '43', '0', 'Colmenar', 29),
(4507, '44', '5', 'Comares', 29),
(4508, '45', '8', 'Cómpeta', 29),
(4509, '46', '1', 'Cortes de la Frontera', 29),
(4510, '47', '7', 'Cuevas Bajas', 29),
(4511, '49', '6', 'Cuevas de San Marcos', 29),
(4512, '48', '3', 'Cuevas del Becerro', 29),
(4513, '50', '9', 'Cútar', 29),
(4514, '51', '6', 'Estepona', 29),
(4515, '52', '1', 'Faraján', 29),
(4516, '53', '7', 'Frigiliana', 29),
(4517, '54', '2', 'Fuengirola', 29),
(4518, '55', '5', 'Fuente de Piedra', 29),
(4519, '56', '8', 'Gaucín', 29),
(4520, '57', '4', 'Genalguacil', 29),
(4521, '58', '0', 'Guaro', 29),
(4522, '59', '3', 'Humilladero', 29),
(4523, '60', '7', 'Igualeja', 29),
(4524, '61', '4', 'Istán', 29),
(4525, '62', '9', 'Iznate', 29),
(4526, '63', '5', 'Jimera de Líbar', 29),
(4527, '64', '0', 'Jubrique', 29),
(4528, '65', '3', 'Júzcar', 29),
(4529, '66', '6', 'Macharaviaya', 29),
(4530, '67', '2', 'Málaga', 29),
(4531, '68', '8', 'Manilva', 29),
(4532, '69', '1', 'Marbella', 29),
(4533, '70', '5', 'Mijas', 29),
(4534, '71', '2', 'Moclinejo', 29),
(4535, '72', '7', 'Mollina', 29),
(4536, '73', '3', 'Monda', 29),
(4537, '903', '9', 'Montecorto', 29),
(4538, '74', '8', 'Montejaque', 29),
(4539, '75', '1', 'Nerja', 29),
(4540, '76', '4', 'Ojén', 29),
(4541, '77', '0', 'Parauta', 29),
(4542, '79', '9', 'Periana', 29),
(4543, '80', '3', 'Pizarra', 29),
(4544, '81', '0', 'Pujerra', 29),
(4545, '82', '5', 'Rincón de la Victoria', 29),
(4546, '83', '1', 'Riogordo', 29),
(4547, '84', '6', 'Ronda', 29),
(4548, '85', '9', 'Salares', 29),
(4549, '86', '2', 'Sayalonga', 29),
(4550, '87', '8', 'Sedella', 29),
(4551, '904', '4', 'Serrato', 29),
(4552, '88', '4', 'Sierra de Yeguas', 29),
(4553, '89', '7', 'Teba', 29),
(4554, '90', '1', 'Tolox', 29),
(4555, '901', '8', 'Torremolinos', 29),
(4556, '91', '8', 'Torrox', 29),
(4557, '92', '3', 'Totalán', 29),
(4558, '93', '9', 'Valle de Abdalajís', 29),
(4559, '94', '4', 'Vélez-Málaga', 29),
(4560, '95', '7', 'Villanueva de Algaidas', 29),
(4561, '902', '3', 'Villanueva de la Concepción', 29),
(4562, '98', '2', 'Villanueva de Tapia', 29),
(4563, '96', '0', 'Villanueva del Rosario', 29),
(4564, '97', '6', 'Villanueva del Trabuco', 29),
(4565, '99', '5', 'Viñuela', 29),
(4566, '100', '9', 'Yunquera', 29),
(4567, '1', '1', 'Abanilla', 30),
(4568, '2', '6', 'Abarán', 30),
(4569, '3', '2', 'Águilas', 30),
(4570, '4', '7', 'Albudeite', 30),
(4571, '5', '0', 'Alcantarilla', 30),
(4572, '902', '7', 'Alcázares, Los', 30),
(4573, '6', '3', 'Aledo', 30),
(4574, '7', '9', 'Alguazas', 30),
(4575, '8', '5', 'Alhama de Murcia', 30),
(4576, '9', '8', 'Archena', 30),
(4577, '10', '2', 'Beniel', 30),
(4578, '11', '9', 'Blanca', 30),
(4579, '12', '4', 'Bullas', 30),
(4580, '13', '0', 'Calasparra', 30),
(4581, '14', '5', 'Campos del Río', 30),
(4582, '15', '8', 'Caravaca de la Cruz', 30),
(4583, '16', '1', 'Cartagena', 30),
(4584, '17', '7', 'Cehegín', 30),
(4585, '18', '3', 'Ceutí', 30),
(4586, '19', '6', 'Cieza', 30),
(4587, '20', '0', 'Fortuna', 30),
(4588, '21', '7', 'Fuente Álamo de Murcia', 30),
(4589, '22', '2', 'Jumilla', 30),
(4590, '23', '8', 'Librilla', 30),
(4591, '24', '3', 'Lorca', 30),
(4592, '25', '6', 'Lorquí', 30),
(4593, '26', '9', 'Mazarrón', 30),
(4594, '27', '5', 'Molina de Segura', 30),
(4595, '28', '1', 'Moratalla', 30),
(4596, '29', '4', 'Mula', 30),
(4597, '30', '8', 'Murcia', 30),
(4598, '31', '5', 'Ojós', 30),
(4599, '32', '0', 'Pliego', 30),
(4600, '33', '6', 'Puerto Lumbreras', 30),
(4601, '34', '1', 'Ricote', 30),
(4602, '35', '4', 'San Javier', 30),
(4603, '36', '7', 'San Pedro del Pinatar', 30),
(4604, '901', '2', 'Santomera', 30),
(4605, '37', '3', 'Torre-Pacheco', 30),
(4606, '38', '9', 'Torres de Cotillas, Las', 30),
(4607, '39', '2', 'Totana', 30),
(4608, '40', '6', 'Ulea', 30),
(4609, '41', '3', 'Unión, La', 30),
(4610, '42', '8', 'Villanueva del Río Segura', 30),
(4611, '43', '4', 'Yecla', 30),
(4612, '1', '8', 'Abáigar', 31),
(4613, '2', '3', 'Abárzuza/Abartzuza', 31),
(4614, '3', '9', 'Abaurregaina/Abaurrea Alta', 31),
(4615, '4', '4', 'Abaurrepea/Abaurrea Baja', 31),
(4616, '5', '7', 'Aberin', 31),
(4617, '6', '0', 'Ablitas', 31),
(4618, '7', '6', 'Adiós', 31),
(4619, '8', '2', 'Aguilar de Codés', 31),
(4620, '9', '5', 'Aibar/Oibar', 31),
(4621, '11', '6', 'Allín/Allin', 31),
(4622, '12', '1', 'Allo', 31),
(4623, '10', '9', 'Altsasu/Alsasua', 31),
(4624, '13', '7', 'Améscoa Baja', 31),
(4625, '14', '2', 'Ancín/Antzin', 31),
(4626, '15', '5', 'Andosilla', 31),
(4627, '16', '8', 'Ansoáin/Antsoain', 31),
(4628, '17', '4', 'Anue', 31),
(4629, '18', '0', 'Añorbe', 31),
(4630, '19', '3', 'Aoiz/Agoitz', 31),
(4631, '20', '7', 'Araitz', 31),
(4632, '25', '3', 'Arakil', 31),
(4633, '21', '4', 'Aranarache/Aranaratxe', 31),
(4634, '23', '5', 'Aranguren', 31),
(4635, '24', '0', 'Arano', 31),
(4636, '22', '9', 'Arantza', 31),
(4637, '26', '6', 'Aras', 31),
(4638, '27', '2', 'Arbizu', 31),
(4639, '28', '8', 'Arce/Artzi', 31),
(4640, '29', '1', 'Arcos, Los', 31),
(4641, '30', '5', 'Arellano', 31),
(4642, '31', '2', 'Areso', 31),
(4643, '32', '7', 'Arguedas', 31),
(4644, '33', '3', 'Aria', 31),
(4645, '34', '8', 'Aribe', 31),
(4646, '35', '1', 'Armañanzas', 31),
(4647, '36', '4', 'Arróniz', 31),
(4648, '37', '0', 'Arruazu', 31),
(4649, '38', '6', 'Artajona', 31),
(4650, '39', '9', 'Artazu', 31),
(4651, '40', '3', 'Atez/Atetz', 31),
(4652, '58', '1', 'Auritz/Burguete', 31),
(4653, '41', '0', 'Ayegui/Aiegi', 31),
(4654, '42', '5', 'Azagra', 31),
(4655, '43', '1', 'Azuelo', 31),
(4656, '44', '6', 'Bakaiku', 31),
(4657, '901', '9', 'Barañáin/Barañain', 31),
(4658, '45', '9', 'Barásoain', 31),
(4659, '46', '2', 'Barbarin', 31),
(4660, '47', '8', 'Bargota', 31),
(4661, '48', '4', 'Barillas', 31),
(4662, '49', '7', 'Basaburua', 31),
(4663, '50', '0', 'Baztan', 31),
(4664, '137', '9', 'Beintza-Labaien', 31),
(4665, '51', '7', 'Beire', 31),
(4666, '52', '2', 'Belascoáin', 31),
(4667, '250', '8', 'Bera', 31),
(4668, '53', '8', 'Berbinzana', 31),
(4669, '905', '8', 'Beriáin', 31),
(4670, '902', '4', 'Berrioplano/Berriobeiti', 31),
(4671, '903', '0', 'Berriozar', 31),
(4672, '54', '3', 'Bertizarana', 31),
(4673, '55', '6', 'Betelu', 31),
(4674, '253', '6', 'Bidaurreta', 31),
(4675, '56', '9', 'Biurrun-Olcoz', 31),
(4676, '57', '5', 'Buñuel', 31),
(4677, '59', '4', 'Burgui/Burgi', 31),
(4678, '60', '8', 'Burlada/Burlata', 31),
(4679, '61', '5', 'Busto, El', 31),
(4680, '62', '0', 'Cabanillas', 31),
(4681, '63', '6', 'Cabredo', 31),
(4682, '64', '1', 'Cadreita', 31),
(4683, '65', '4', 'Caparroso', 31),
(4684, '66', '7', 'Cárcar', 31),
(4685, '67', '3', 'Carcastillo', 31),
(4686, '68', '9', 'Cascante', 31),
(4687, '69', '2', 'Cáseda', 31),
(4688, '70', '6', 'Castejón', 31),
(4689, '71', '3', 'Castillonuevo', 31),
(4690, '193', '9', 'Cendea de Olza/Oltza Zendea', 31),
(4691, '72', '8', 'Cintruénigo', 31),
(4692, '74', '9', 'Cirauqui/Zirauki', 31),
(4693, '75', '2', 'Ciriza/Ziritza', 31),
(4694, '76', '5', 'Cizur', 31),
(4695, '77', '1', 'Corella', 31),
(4696, '78', '7', 'Cortes', 31),
(4697, '79', '0', 'Desojo', 31),
(4698, '80', '4', 'Dicastillo', 31),
(4699, '81', '1', 'Donamaria', 31),
(4700, '221', '2', 'Doneztebe/Santesteban', 31),
(4701, '83', '2', 'Echarri/Etxarri', 31),
(4702, '87', '9', 'Elgorriaga', 31),
(4703, '89', '8', 'Enériz/Eneritz', 31),
(4704, '90', '2', 'Eratsun', 31),
(4705, '91', '9', 'Ergoiena', 31),
(4706, '92', '4', 'Erro', 31),
(4707, '94', '5', 'Eslava', 31),
(4708, '95', '8', 'Esparza de Salazar/Espartza Zaraitzu', 31),
(4709, '96', '1', 'Espronceda', 31),
(4710, '97', '7', 'Estella-Lizarra', 31),
(4711, '98', '3', 'Esteribar', 31),
(4712, '99', '6', 'Etayo', 31),
(4713, '82', '6', 'Etxalar', 31),
(4714, '84', '7', 'Etxarri Aranatz', 31),
(4715, '85', '0', 'Etxauri', 31),
(4716, '100', '0', 'Eulate', 31),
(4717, '101', '7', 'Ezcabarte', 31),
(4718, '93', '0', 'Ezcároz/Ezkaroze', 31),
(4719, '102', '2', 'Ezkurra', 31),
(4720, '103', '8', 'Ezprogui', 31),
(4721, '104', '3', 'Falces', 31),
(4722, '105', '6', 'Fitero', 31),
(4723, '106', '9', 'Fontellas', 31),
(4724, '107', '5', 'Funes', 31),
(4725, '108', '1', 'Fustiñana', 31),
(4726, '109', '4', 'Galar', 31),
(4727, '110', '8', 'Gallipienzo/Galipentzu', 31),
(4728, '111', '5', 'Gallués/Galoze', 31),
(4729, '112', '0', 'Garaioa', 31),
(4730, '113', '6', 'Garde', 31),
(4731, '114', '1', 'Garínoain', 31),
(4732, '115', '4', 'Garralda', 31),
(4733, '116', '7', 'Genevilla', 31),
(4734, '117', '3', 'Goizueta', 31),
(4735, '118', '9', 'Goñi', 31),
(4736, '119', '2', 'Güesa/Gorza', 31),
(4737, '120', '6', 'Guesálaz/Gesalatz', 31),
(4738, '121', '3', 'Guirguillano', 31),
(4739, '256', '7', 'Hiriberri/Villanueva de Aezkoa', 31),
(4740, '122', '8', 'Huarte/Uharte', 31),
(4741, '124', '9', 'Ibargoiti', 31),
(4742, '259', '2', 'Igantzi', 31),
(4743, '125', '2', 'Igúzquiza', 31),
(4744, '126', '5', 'Imotz', 31),
(4745, '127', '1', 'Irañeta', 31),
(4746, '904', '5', 'Irurtzun', 31),
(4747, '128', '7', 'Isaba/Izaba', 31),
(4748, '129', '0', 'Ituren', 31),
(4749, '130', '4', 'Iturmendi', 31),
(4750, '131', '1', 'Iza/Itza', 31),
(4751, '132', '6', 'Izagaondoa', 31),
(4752, '133', '2', 'Izalzu/Itzaltzu', 31),
(4753, '134', '7', 'Jaurrieta', 31),
(4754, '135', '0', 'Javier', 31),
(4755, '136', '3', 'Juslapeña', 31),
(4756, '138', '5', 'Lakuntza', 31),
(4757, '139', '8', 'Lana', 31),
(4758, '140', '2', 'Lantz', 31),
(4759, '141', '9', 'Lapoblación', 31),
(4760, '142', '4', 'Larraga', 31),
(4761, '143', '0', 'Larraona', 31),
(4762, '144', '5', 'Larraun', 31),
(4763, '145', '8', 'Lazagurría', 31),
(4764, '146', '1', 'Leache/Leatxe', 31),
(4765, '147', '7', 'Legarda', 31),
(4766, '148', '3', 'Legaria', 31),
(4767, '149', '6', 'Leitza', 31),
(4768, '908', '3', 'Lekunberri', 31),
(4769, '150', '9', 'Leoz/Leotz', 31),
(4770, '151', '6', 'Lerga', 31),
(4771, '152', '1', 'Lerín', 31),
(4772, '153', '7', 'Lesaka', 31),
(4773, '154', '2', 'Lezáun', 31),
(4774, '155', '5', 'Liédena', 31),
(4775, '156', '8', 'Lizoáin-Arriasgoiti', 31),
(4776, '157', '4', 'Lodosa', 31),
(4777, '158', '0', 'Lónguida/Longida', 31),
(4778, '159', '3', 'Lumbier', 31),
(4779, '160', '7', 'Luquin', 31),
(4780, '248', '2', 'Luzaide/Valcarlos', 31),
(4781, '161', '4', 'Mañeru', 31),
(4782, '162', '9', 'Marañón', 31),
(4783, '163', '5', 'Marcilla', 31),
(4784, '164', '0', 'Mélida', 31),
(4785, '165', '3', 'Mendavia', 31),
(4786, '166', '6', 'Mendaza', 31),
(4787, '167', '2', 'Mendigorría', 31),
(4788, '168', '8', 'Metauten', 31),
(4789, '169', '1', 'Milagro', 31),
(4790, '170', '5', 'Mirafuentes', 31),
(4791, '171', '2', 'Miranda de Arga', 31),
(4792, '172', '7', 'Monreal/Elo', 31),
(4793, '173', '3', 'Monteagudo', 31),
(4794, '174', '8', 'Morentin', 31),
(4795, '175', '1', 'Mues', 31),
(4796, '176', '4', 'Murchante', 31),
(4797, '177', '0', 'Murieta', 31),
(4798, '178', '6', 'Murillo el Cuende', 31),
(4799, '179', '9', 'Murillo el Fruto', 31),
(4800, '180', '3', 'Muruzábal', 31),
(4801, '181', '0', 'Navascués/Nabaskoze', 31),
(4802, '182', '5', 'Nazar', 31),
(4803, '88', '5', 'Noáin (Valle de Elorz)/Noain (Elortzibar)', 31),
(4804, '183', '1', 'Obanos', 31),
(4805, '185', '9', 'Ochagavía/Otsagabia', 31),
(4806, '184', '6', 'Oco', 31),
(4807, '186', '2', 'Odieta', 31),
(4808, '187', '8', 'Oiz', 31),
(4809, '188', '4', 'Olaibar', 31),
(4810, '189', '7', 'Olazti/Olazagutía', 31),
(4811, '190', '1', 'Olejua', 31),
(4812, '191', '8', 'Olite/Erriberri', 31),
(4813, '192', '3', 'Olóriz/Oloritz', 31),
(4814, '195', '7', 'Orbaizeta', 31),
(4815, '196', '0', 'Orbara', 31),
(4816, '197', '6', 'Orísoain', 31),
(4817, '906', '1', 'Orkoien', 31),
(4818, '198', '2', 'Oronz/Orontze', 31),
(4819, '199', '5', 'Oroz-Betelu/Orotz-Betelu', 31),
(4820, '211', '4', 'Orreaga/Roncesvalles', 31),
(4821, '200', '9', 'Oteiza', 31),
(4822, '201', '6', 'Pamplona/Iruña', 31),
(4823, '202', '1', 'Peralta/Azkoien', 31),
(4824, '203', '7', 'Petilla de Aragón', 31),
(4825, '204', '2', 'Piedramillera', 31),
(4826, '205', '5', 'Pitillas', 31),
(4827, '206', '8', 'Puente la Reina/Gares', 31),
(4828, '207', '4', 'Pueyo', 31),
(4829, '208', '0', 'Ribaforada', 31),
(4830, '209', '3', 'Romanzado', 31),
(4831, '210', '7', 'Roncal/Erronkari', 31),
(4832, '212', '9', 'Sada', 31),
(4833, '213', '5', 'Saldías', 31),
(4834, '214', '0', 'Salinas de Oro/Jaitz', 31),
(4835, '215', '3', 'San Adrián', 31),
(4836, '217', '2', 'San Martín de Unx', 31),
(4837, '216', '6', 'Sangüesa/Zangoza', 31),
(4838, '219', '1', 'Sansol', 31),
(4839, '220', '5', 'Santacara', 31),
(4840, '222', '7', 'Sarriés/Sartze', 31),
(4841, '223', '3', 'Sartaguda', 31),
(4842, '224', '8', 'Sesma', 31),
(4843, '225', '1', 'Sorlada', 31),
(4844, '226', '4', 'Sunbilla', 31),
(4845, '227', '0', 'Tafalla', 31),
(4846, '228', '6', 'Tiebas-Muruarte de Reta', 31),
(4847, '229', '9', 'Tirapu', 31),
(4848, '230', '3', 'Torralba del Río', 31),
(4849, '231', '0', 'Torres del Río', 31),
(4850, '232', '5', 'Tudela', 31),
(4851, '233', '1', 'Tulebras', 31),
(4852, '234', '6', 'Ucar', 31),
(4853, '123', '4', 'Uharte Arakil', 31),
(4854, '235', '9', 'Ujué', 31),
(4855, '236', '2', 'Ultzama', 31),
(4856, '237', '8', 'Unciti', 31),
(4857, '238', '4', 'Unzué/Untzue', 31),
(4858, '239', '7', 'Urdazubi/Urdax', 31),
(4859, '240', '1', 'Urdiain', 31),
(4860, '241', '8', 'Urraul Alto', 31),
(4861, '242', '3', 'Urraul Bajo', 31),
(4862, '244', '4', 'Urroz', 31),
(4863, '243', '9', 'Urroz-Villa', 31),
(4864, '245', '7', 'Urzainqui/Urzainki', 31),
(4865, '246', '0', 'Uterga', 31),
(4866, '247', '6', 'Uztárroz/Uztarroze', 31),
(4867, '86', '3', 'Valle de Egüés/Eguesibar', 31),
(4868, '194', '4', 'Valle de Ollo/Ollaran', 31),
(4869, '260', '6', 'Valle de Yerri/Deierri', 31),
(4870, '249', '5', 'Valtierra', 31),
(4871, '251', '5', 'Viana', 31),
(4872, '252', '0', 'Vidángoz/Bidankoze', 31),
(4873, '254', '1', 'Villafranca', 31),
(4874, '255', '4', 'Villamayor de Monjardín', 31),
(4875, '257', '3', 'Villatuerta', 31),
(4876, '258', '9', 'Villava/Atarrabia', 31),
(4877, '261', '3', 'Yesa', 31),
(4878, '262', '8', 'Zabalza/Zabaltza', 31),
(4879, '73', '4', 'Ziordia', 31),
(4880, '907', '7', 'Zizur Mayor/Zizur Nagusia', 31),
(4881, '263', '4', 'Zubieta', 31),
(4882, '264', '9', 'Zugarramurdi', 31),
(4883, '265', '2', 'Zúñiga', 31),
(4884, '1', '3', 'Allariz', 32),
(4885, '2', '8', 'Amoeiro', 32),
(4886, '3', '4', 'Arnoia, A', 32),
(4887, '4', '9', 'Avión', 32),
(4888, '5', '2', 'Baltar', 32),
(4889, '6', '5', 'Bande', 32),
(4890, '7', '1', 'Baños de Molgas', 32),
(4891, '8', '7', 'Barbadás', 32),
(4892, '9', '0', 'Barco de Valdeorras, O', 32),
(4893, '10', '4', 'Beade', 32),
(4894, '11', '1', 'Beariz', 32),
(4895, '12', '6', 'Blancos, Os', 32),
(4896, '13', '2', 'Boborás', 32),
(4897, '14', '7', 'Bola, A', 32),
(4898, '15', '0', 'Bolo, O', 32),
(4899, '16', '3', 'Calvos de Randín', 32),
(4900, '18', '5', 'Carballeda de Avia', 32),
(4901, '17', '9', 'Carballeda de Valdeorras', 32),
(4902, '19', '8', 'Carballiño, O', 32),
(4903, '20', '2', 'Cartelle', 32),
(4904, '22', '4', 'Castrelo de Miño', 32),
(4905, '21', '9', 'Castrelo do Val', 32),
(4906, '23', '0', 'Castro Caldelas', 32),
(4907, '24', '5', 'Celanova', 32),
(4908, '25', '8', 'Cenlle', 32),
(4909, '29', '6', 'Chandrexa de Queixa', 32),
(4910, '26', '1', 'Coles', 32),
(4911, '27', '7', 'Cortegada', 32),
(4912, '28', '3', 'Cualedro', 32),
(4913, '30', '0', 'Entrimo', 32),
(4914, '31', '7', 'Esgos', 32),
(4915, '33', '8', 'Gomesende', 32),
(4916, '34', '3', 'Gudiña, A', 32),
(4917, '35', '6', 'Irixo, O', 32),
(4918, '38', '1', 'Larouco', 32),
(4919, '39', '4', 'Laza', 32),
(4920, '40', '8', 'Leiro', 32),
(4921, '41', '5', 'Lobeira', 32),
(4922, '42', '0', 'Lobios', 32),
(4923, '43', '6', 'Maceda', 32),
(4924, '44', '1', 'Manzaneda', 32),
(4925, '45', '4', 'Maside', 32),
(4926, '46', '7', 'Melón', 32),
(4927, '47', '3', 'Merca, A', 32),
(4928, '48', '9', 'Mezquita, A', 32),
(4929, '49', '2', 'Montederramo', 32),
(4930, '50', '5', 'Monterrei', 32),
(4931, '51', '2', 'Muíños', 32),
(4932, '52', '7', 'Nogueira de Ramuín', 32),
(4933, '53', '3', 'Oímbra', 32),
(4934, '54', '8', 'Ourense', 32),
(4935, '55', '1', 'Paderne de Allariz', 32),
(4936, '56', '4', 'Padrenda', 32),
(4937, '57', '0', 'Parada de Sil', 32),
(4938, '58', '6', 'Pereiro de Aguiar, O', 32),
(4939, '59', '9', 'Peroxa, A', 32),
(4940, '60', '3', 'Petín', 32),
(4941, '61', '0', 'Piñor', 32),
(4942, '63', '1', 'Pobra de Trives, A', 32),
(4943, '64', '6', 'Pontedeva', 32),
(4944, '62', '5', 'Porqueira', 32),
(4945, '65', '9', 'Punxín', 32),
(4946, '66', '2', 'Quintela de Leirado', 32),
(4947, '67', '8', 'Rairiz de Veiga', 32),
(4948, '68', '4', 'Ramirás', 32),
(4949, '69', '7', 'Ribadavia', 32),
(4950, '71', '8', 'Riós', 32),
(4951, '72', '3', 'Rúa, A', 32),
(4952, '73', '9', 'Rubiá', 32),
(4953, '74', '4', 'San Amaro', 32),
(4954, '75', '7', 'San Cibrao das Viñas', 32),
(4955, '76', '0', 'San Cristovo de Cea', 32),
(4956, '70', '1', 'San Xoán de Río', 32),
(4957, '77', '6', 'Sandiás', 32),
(4958, '78', '2', 'Sarreaus', 32),
(4959, '79', '5', 'Taboadela', 32),
(4960, '80', '9', 'Teixeira, A', 32),
(4961, '81', '6', 'Toén', 32),
(4962, '82', '1', 'Trasmiras', 32),
(4963, '83', '7', 'Veiga, A', 32),
(4964, '84', '2', 'Verea', 32),
(4965, '85', '5', 'Verín', 32),
(4966, '86', '8', 'Viana do Bolo', 32),
(4967, '87', '4', 'Vilamarín', 32),
(4968, '88', '0', 'Vilamartín de Valdeorras', 32),
(4969, '89', '3', 'Vilar de Barrio', 32),
(4970, '90', '7', 'Vilar de Santos', 32),
(4971, '91', '4', 'Vilardevós', 32),
(4972, '92', '9', 'Vilariño de Conso', 32),
(4973, '32', '2', 'Xinzo de Limia', 32),
(4974, '36', '9', 'Xunqueira de Ambía', 32),
(4975, '37', '5', 'Xunqueira de Espadanedo', 32),
(4976, '1', '9', 'Allande', 33),
(4977, '2', '4', 'Aller', 33),
(4978, '3', '0', 'Amieva', 33),
(4979, '4', '5', 'Avilés', 33),
(4980, '5', '8', 'Belmonte de Miranda', 33),
(4981, '6', '1', 'Bimenes', 33),
(4982, '7', '7', 'Boal', 33),
(4983, '8', '3', 'Cabrales', 33),
(4984, '9', '6', 'Cabranes', 33),
(4985, '10', '0', 'Candamo', 33),
(4986, '12', '2', 'Cangas de Onís', 33),
(4987, '11', '7', 'Cangas del Narcea', 33),
(4988, '13', '8', 'Caravia', 33),
(4989, '14', '3', 'Carreño', 33),
(4990, '15', '6', 'Caso', 33),
(4991, '16', '9', 'Castrillón', 33),
(4992, '17', '5', 'Castropol', 33),
(4993, '18', '1', 'Coaña', 33),
(4994, '19', '4', 'Colunga', 33),
(4995, '20', '8', 'Corvera de Asturias', 33),
(4996, '21', '5', 'Cudillero', 33),
(4997, '22', '0', 'Degaña', 33),
(4998, '23', '6', 'Franco, El', 33),
(4999, '24', '1', 'Gijón', 33),
(5000, '25', '4', 'Gozón', 33),
(5001, '26', '7', 'Grado', 33),
(5002, '27', '3', 'Grandas de Salime', 33),
(5003, '28', '9', 'Ibias', 33),
(5004, '29', '2', 'Illano', 33),
(5005, '30', '6', 'Illas', 33),
(5006, '31', '3', 'Langreo', 33),
(5007, '32', '8', 'Laviana', 33),
(5008, '33', '4', 'Lena', 33),
(5009, '35', '2', 'Llanera', 33),
(5010, '36', '5', 'Llanes', 33),
(5011, '37', '1', 'Mieres', 33),
(5012, '38', '7', 'Morcín', 33),
(5013, '39', '0', 'Muros de Nalón', 33),
(5014, '40', '4', 'Nava', 33),
(5015, '41', '1', 'Navia', 33),
(5016, '42', '6', 'Noreña', 33),
(5017, '43', '2', 'Onís', 33),
(5018, '44', '7', 'Oviedo', 33),
(5019, '45', '0', 'Parres', 33),
(5020, '46', '3', 'Peñamellera Alta', 33),
(5021, '47', '9', 'Peñamellera Baja', 33),
(5022, '48', '5', 'Pesoz', 33),
(5023, '49', '8', 'Piloña', 33),
(5024, '50', '1', 'Ponga', 33),
(5025, '51', '8', 'Pravia', 33),
(5026, '52', '3', 'Proaza', 33),
(5027, '53', '9', 'Quirós', 33),
(5028, '54', '4', 'Regueras, Las', 33),
(5029, '55', '7', 'Ribadedeva', 33),
(5030, '56', '0', 'Ribadesella', 33),
(5031, '57', '6', 'Ribera de Arriba', 33),
(5032, '58', '2', 'Riosa', 33),
(5033, '59', '5', 'Salas', 33),
(5034, '61', '6', 'San Martín de Oscos', 33),
(5035, '60', '9', 'San Martín del Rey Aurelio', 33),
(5036, '63', '7', 'San Tirso de Abres', 33),
(5037, '62', '1', 'Santa Eulalia de Oscos', 33),
(5038, '64', '2', 'Santo Adriano', 33),
(5039, '65', '5', 'Sariego', 33),
(5040, '66', '8', 'Siero', 33),
(5041, '67', '4', 'Sobrescobio', 33),
(5042, '68', '0', 'Somiedo', 33),
(5043, '69', '3', 'Soto del Barco', 33),
(5044, '70', '7', 'Tapia de Casariego', 33),
(5045, '71', '4', 'Taramundi', 33),
(5046, '72', '9', 'Teverga', 33),
(5047, '73', '5', 'Tineo', 33),
(5048, '34', '9', 'Valdés', 33),
(5049, '74', '0', 'Vegadeo', 33),
(5050, '75', '3', 'Villanueva de Oscos', 33),
(5051, '76', '6', 'Villaviciosa', 33),
(5052, '77', '2', 'Villayón', 33),
(5053, '78', '8', 'Yernes y Tameza', 33),
(5054, '1', '4', 'Abarca de Campos', 34),
(5055, '3', '5', 'Abia de las Torres', 34),
(5056, '4', '0', 'Aguilar de Campoo', 34),
(5057, '5', '3', 'Alar del Rey', 34),
(5058, '6', '6', 'Alba de Cerrato', 34),
(5059, '9', '1', 'Amayuelas de Arriba', 34),
(5060, '10', '5', 'Ampudia', 34),
(5061, '11', '2', 'Amusco', 34),
(5062, '12', '7', 'Antigüedad', 34),
(5063, '15', '1', 'Arconada', 34),
(5064, '17', '0', 'Astudillo', 34),
(5065, '18', '6', 'Autilla del Pino', 34),
(5066, '19', '9', 'Autillo de Campos', 34),
(5067, '20', '3', 'Ayuela', 34),
(5068, '22', '5', 'Baltanás', 34),
(5069, '24', '6', 'Baquerín de Campos', 34),
(5070, '25', '9', 'Bárcena de Campos', 34),
(5071, '27', '8', 'Barruelo de Santullán', 34),
(5072, '28', '4', 'Báscones de Ojeda', 34),
(5073, '29', '7', 'Becerril de Campos', 34),
(5074, '31', '8', 'Belmonte de Campos', 34),
(5075, '32', '3', 'Berzosilla', 34),
(5076, '33', '9', 'Boada de Campos', 34),
(5077, '35', '7', 'Boadilla de Rioseco', 34),
(5078, '34', '4', 'Boadilla del Camino', 34),
(5079, '36', '0', 'Brañosera', 34),
(5080, '37', '6', 'Buenavista de Valdavia', 34),
(5081, '38', '2', 'Bustillo de la Vega', 34),
(5082, '39', '5', 'Bustillo del Páramo de Carrión', 34),
(5083, '41', '6', 'Calahorra de Boedo', 34),
(5084, '42', '1', 'Calzada de los Molinos', 34),
(5085, '45', '5', 'Capillas', 34),
(5086, '46', '8', 'Cardeñosa de Volpejera', 34),
(5087, '47', '4', 'Carrión de los Condes', 34),
(5088, '48', '0', 'Castil de Vela', 34),
(5089, '49', '3', 'Castrejón de la Peña', 34),
(5090, '50', '6', 'Castrillo de Don Juan', 34),
(5091, '51', '3', 'Castrillo de Onielo', 34),
(5092, '52', '8', 'Castrillo de Villavega', 34),
(5093, '53', '4', 'Castromocho', 34),
(5094, '55', '2', 'Cervatos de la Cueza', 34),
(5095, '56', '5', 'Cervera de Pisuerga', 34),
(5096, '57', '1', 'Cevico de la Torre', 34),
(5097, '58', '7', 'Cevico Navero', 34),
(5098, '59', '0', 'Cisneros', 34),
(5099, '60', '4', 'Cobos de Cerrato', 34),
(5100, '61', '1', 'Collazos de Boedo', 34),
(5101, '62', '6', 'Congosto de Valdavia', 34),
(5102, '63', '2', 'Cordovilla la Real', 34),
(5103, '66', '3', 'Cubillas de Cerrato', 34),
(5104, '67', '9', 'Dehesa de Montejo', 34),
(5105, '68', '5', 'Dehesa de Romanos', 34),
(5106, '69', '8', 'Dueñas', 34),
(5107, '70', '2', 'Espinosa de Cerrato', 34),
(5108, '71', '9', 'Espinosa de Villagonzalo', 34),
(5109, '72', '4', 'Frechilla', 34),
(5110, '73', '0', 'Fresno del Río', 34),
(5111, '74', '5', 'Frómista', 34),
(5112, '76', '1', 'Fuentes de Nava', 34),
(5113, '77', '7', 'Fuentes de Valdepero', 34),
(5114, '79', '6', 'Grijota', 34),
(5115, '80', '0', 'Guardo', 34),
(5116, '81', '7', 'Guaza de Campos', 34),
(5117, '82', '2', 'Hérmedes de Cerrato', 34),
(5118, '83', '8', 'Herrera de Pisuerga', 34),
(5119, '84', '3', 'Herrera de Valdecañas', 34),
(5120, '86', '9', 'Hontoria de Cerrato', 34),
(5121, '87', '5', 'Hornillos de Cerrato', 34),
(5122, '88', '1', 'Husillos', 34),
(5123, '89', '4', 'Itero de la Vega', 34),
(5124, '91', '5', 'Lagartos', 34),
(5125, '92', '0', 'Lantadilla', 34),
(5126, '94', '1', 'Ledigos', 34),
(5127, '903', '6', 'Loma de Ucieza', 34),
(5128, '96', '7', 'Lomas', 34),
(5129, '98', '9', 'Magaz de Pisuerga', 34),
(5130, '99', '2', 'Manquillos', 34),
(5131, '100', '6', 'Mantinos', 34),
(5132, '101', '3', 'Marcilla de Campos', 34),
(5133, '102', '8', 'Mazariegos', 34),
(5134, '103', '4', 'Mazuecos de Valdeginate', 34),
(5135, '104', '9', 'Melgar de Yuso', 34),
(5136, '106', '5', 'Meneses de Campos', 34),
(5137, '107', '1', 'Micieces de Ojeda', 34),
(5138, '108', '7', 'Monzón de Campos', 34),
(5139, '109', '0', 'Moratinos', 34),
(5140, '110', '4', 'Mudá', 34),
(5141, '112', '6', 'Nogal de las Huertas', 34),
(5142, '113', '2', 'Olea de Boedo', 34),
(5143, '114', '7', 'Olmos de Ojeda', 34),
(5144, '116', '3', 'Osornillo', 34),
(5145, '901', '5', 'Osorno la Mayor', 34),
(5146, '120', '2', 'Palencia', 34),
(5147, '121', '9', 'Palenzuela', 34),
(5148, '122', '4', 'Páramo de Boedo', 34),
(5149, '123', '0', 'Paredes de Nava', 34),
(5150, '124', '5', 'Payo de Ojeda', 34),
(5151, '125', '8', 'Pedraza de Campos', 34),
(5152, '126', '1', 'Pedrosa de la Vega', 34),
(5153, '127', '7', 'Perales', 34),
(5154, '904', '1', 'Pernía, La', 34),
(5155, '129', '6', 'Pino del Río', 34),
(5156, '130', '0', 'Piña de Campos', 34),
(5157, '131', '7', 'Población de Arroyo', 34),
(5158, '132', '2', 'Población de Campos', 34),
(5159, '133', '8', 'Población de Cerrato', 34),
(5160, '134', '3', 'Polentinos', 34),
(5161, '135', '6', 'Pomar de Valdivia', 34),
(5162, '136', '9', 'Poza de la Vega', 34),
(5163, '137', '5', 'Pozo de Urama', 34),
(5164, '139', '4', 'Prádanos de Ojeda', 34),
(5165, '140', '8', 'Puebla de Valdavia, La', 34),
(5166, '141', '5', 'Quintana del Puente', 34),
(5167, '143', '6', 'Quintanilla de Onsoña', 34),
(5168, '146', '7', 'Reinoso de Cerrato', 34),
(5169, '147', '3', 'Renedo de la Vega', 34),
(5170, '149', '2', 'Requena de Campos', 34),
(5171, '151', '2', 'Respenda de la Peña', 34),
(5172, '152', '7', 'Revenga de Campos', 34),
(5173, '154', '8', 'Revilla de Collazos', 34),
(5174, '155', '1', 'Ribas de Campos', 34),
(5175, '156', '4', 'Riberos de la Cueza', 34),
(5176, '157', '0', 'Saldaña', 34),
(5177, '158', '6', 'Salinas de Pisuerga', 34),
(5178, '159', '9', 'San Cebrián de Campos', 34),
(5179, '160', '3', 'San Cebrián de Mudá', 34),
(5180, '161', '0', 'San Cristóbal de Boedo', 34),
(5181, '163', '1', 'San Mamés de Campos', 34),
(5182, '165', '9', 'San Román de la Cuba', 34),
(5183, '167', '8', 'Santa Cecilia del Alcor', 34),
(5184, '168', '4', 'Santa Cruz de Boedo', 34),
(5185, '169', '7', 'Santervás de la Vega', 34),
(5186, '170', '1', 'Santibáñez de Ecla', 34),
(5187, '171', '8', 'Santibáñez de la Peña', 34),
(5188, '174', '4', 'Santoyo', 34),
(5189, '175', '7', 'Serna, La', 34),
(5190, '177', '6', 'Soto de Cerrato', 34),
(5191, '176', '0', 'Sotobañado y Priorato', 34),
(5192, '178', '2', 'Tabanera de Cerrato', 34),
(5193, '179', '5', 'Tabanera de Valdavia', 34),
(5194, '180', '9', 'Támara de Campos', 34),
(5195, '181', '6', 'Tariego de Cerrato', 34),
(5196, '182', '1', 'Torquemada', 34),
(5197, '184', '2', 'Torremormojón', 34),
(5198, '185', '5', 'Triollo', 34),
(5199, '186', '8', 'Valbuena de Pisuerga', 34),
(5200, '189', '3', 'Valdeolmillos', 34),
(5201, '190', '7', 'Valderrábano', 34),
(5202, '192', '9', 'Valde-Ucieza', 34),
(5203, '196', '6', 'Valle de Cerrato', 34),
(5204, '902', '0', 'Valle del Retortillo', 34),
(5205, '199', '1', 'Velilla del Río Carrión', 34),
(5206, '23', '1', 'Venta de Baños', 34),
(5207, '201', '2', 'Vertavillo', 34),
(5208, '93', '6', 'Vid de Ojeda, La', 34),
(5209, '202', '7', 'Villabasta de Valdavia', 34),
(5210, '204', '8', 'Villacidaler', 34),
(5211, '205', '1', 'Villaconancio', 34),
(5212, '206', '4', 'Villada', 34),
(5213, '208', '6', 'Villaeles de Valdavia', 34),
(5214, '210', '3', 'Villahán', 34),
(5215, '211', '0', 'Villaherreros', 34),
(5216, '213', '1', 'Villalaco', 34),
(5217, '214', '6', 'Villalba de Guardo', 34),
(5218, '215', '9', 'Villalcázar de Sirga', 34),
(5219, '216', '2', 'Villalcón', 34),
(5220, '217', '8', 'Villalobón', 34),
(5221, '218', '4', 'Villaluenga de la Vega', 34),
(5222, '220', '1', 'Villamartín de Campos', 34),
(5223, '221', '8', 'Villamediana', 34),
(5224, '222', '3', 'Villameriel', 34),
(5225, '223', '9', 'Villamoronta', 34),
(5226, '224', '4', 'Villamuera de la Cueza', 34),
(5227, '225', '7', 'Villamuriel de Cerrato', 34),
(5228, '227', '6', 'Villanueva del Rebollar', 34),
(5229, '228', '2', 'Villanuño de Valdavia', 34),
(5230, '229', '5', 'Villaprovedo', 34),
(5231, '230', '9', 'Villarmentero de Campos', 34),
(5232, '231', '6', 'Villarrabé', 34),
(5233, '232', '1', 'Villarramiel', 34),
(5234, '233', '7', 'Villasarracino', 34),
(5235, '234', '2', 'Villasila de Valdavia', 34),
(5236, '236', '8', 'Villaturde', 34),
(5237, '237', '4', 'Villaumbrales', 34),
(5238, '238', '0', 'Villaviudas', 34),
(5239, '240', '7', 'Villerías de Campos', 34),
(5240, '241', '4', 'Villodre', 34),
(5241, '242', '9', 'Villodrigo', 34),
(5242, '243', '5', 'Villoldo', 34),
(5243, '245', '3', 'Villota del Páramo', 34),
(5244, '246', '6', 'Villovieco', 34),
(5245, '1', '7', 'Agaete', 35),
(5246, '2', '2', 'Agüimes', 35),
(5247, '20', '6', 'Aldea de San Nicolás, La', 35),
(5248, '3', '8', 'Antigua', 35),
(5249, '4', '3', 'Arrecife', 35),
(5250, '5', '6', 'Artenara', 35),
(5251, '6', '9', 'Arucas', 35),
(5252, '7', '5', 'Betancuria', 35),
(5253, '8', '1', 'Firgas', 35),
(5254, '9', '4', 'Gáldar', 35),
(5255, '10', '8', 'Haría', 35),
(5256, '11', '5', 'Ingenio', 35),
(5257, '12', '0', 'Mogán', 35),
(5258, '13', '6', 'Moya', 35),
(5259, '14', '1', 'Oliva, La', 35),
(5260, '15', '4', 'Pájara', 35),
(5261, '16', '7', 'Palmas de Gran Canaria, Las', 35),
(5262, '17', '3', 'Puerto del Rosario', 35),
(5263, '18', '9', 'San Bartolomé', 35),
(5264, '19', '2', 'San Bartolomé de Tirajana', 35),
(5265, '21', '3', 'Santa Brígida', 35),
(5266, '22', '8', 'Santa Lucía de Tirajana', 35),
(5267, '23', '4', 'Santa María de Guía de Gran Canaria', 35),
(5268, '24', '9', 'Teguise', 35),
(5269, '25', '2', 'Tejeda', 35),
(5270, '26', '5', 'Telde', 35),
(5271, '27', '1', 'Teror', 35),
(5272, '28', '7', 'Tías', 35),
(5273, '29', '0', 'Tinajo', 35),
(5274, '30', '4', 'Tuineje', 35),
(5275, '32', '6', 'Valleseco', 35),
(5276, '31', '1', 'Valsequillo de Gran Canaria', 35),
(5277, '33', '2', 'Vega de San Mateo', 35),
(5278, '34', '7', 'Yaiza', 35),
(5279, '20', '9', 'Agolada', 36),
(5280, '1', '0', 'Arbo', 36),
(5281, '3', '1', 'Baiona', 36),
(5282, '2', '5', 'Barro', 36),
(5283, '4', '6', 'Bueu', 36),
(5284, '5', '9', 'Caldas de Reis', 36),
(5285, '6', '2', 'Cambados', 36),
(5286, '7', '8', 'Campo Lameiro', 36),
(5287, '8', '4', 'Cangas', 36),
(5288, '9', '7', 'Cañiza, A', 36),
(5289, '10', '1', 'Catoira', 36),
(5290, '902', '6', 'Cerdedo-Cotobade', 36),
(5291, '13', '9', 'Covelo', 36),
(5292, '14', '4', 'Crecente', 36),
(5293, '15', '7', 'Cuntis', 36),
(5294, '16', '0', 'Dozón', 36),
(5295, '17', '6', 'Estrada, A', 36),
(5296, '18', '2', 'Forcarei', 36),
(5297, '19', '5', 'Fornelos de Montes', 36),
(5298, '21', '6', 'Gondomar', 36),
(5299, '22', '1', 'Grove, O', 36),
(5300, '23', '7', 'Guarda, A', 36),
(5301, '901', '1', 'Illa de Arousa, A', 36),
(5302, '24', '2', 'Lalín', 36),
(5303, '25', '5', 'Lama, A', 36),
(5304, '26', '8', 'Marín', 36),
(5305, '27', '4', 'Meaño', 36),
(5306, '28', '0', 'Meis', 36),
(5307, '29', '3', 'Moaña', 36),
(5308, '30', '7', 'Mondariz', 36),
(5309, '31', '4', 'Mondariz-Balneario', 36),
(5310, '32', '9', 'Moraña', 36),
(5311, '33', '5', 'Mos', 36),
(5312, '34', '0', 'Neves, As', 36),
(5313, '35', '3', 'Nigrán', 36),
(5314, '36', '6', 'Oia', 36),
(5315, '37', '2', 'Pazos de Borbén', 36),
(5316, '41', '2', 'Poio', 36),
(5317, '43', '3', 'Ponte Caldelas', 36),
(5318, '42', '7', 'Ponteareas', 36),
(5319, '44', '8', 'Pontecesures', 36),
(5320, '38', '8', 'Pontevedra', 36),
(5321, '39', '1', 'Porriño, O', 36),
(5322, '40', '5', 'Portas', 36),
(5323, '45', '1', 'Redondela', 36),
(5324, '46', '4', 'Ribadumia', 36),
(5325, '47', '0', 'Rodeiro', 36),
(5326, '48', '6', 'Rosal, O', 36),
(5327, '49', '9', 'Salceda de Caselas', 36),
(5328, '50', '2', 'Salvaterra de Miño', 36),
(5329, '51', '9', 'Sanxenxo', 36),
(5330, '52', '4', 'Silleda', 36),
(5331, '53', '0', 'Soutomaior', 36),
(5332, '54', '5', 'Tomiño', 36),
(5333, '55', '8', 'Tui', 36),
(5334, '56', '1', 'Valga', 36),
(5335, '57', '7', 'Vigo', 36),
(5336, '59', '6', 'Vila de Cruces', 36),
(5337, '58', '3', 'Vilaboa', 36),
(5338, '60', '0', 'Vilagarcía de Arousa', 36),
(5339, '61', '7', 'Vilanova de Arousa', 36),
(5340, '1', '6', 'Abusejo', 37),
(5341, '2', '1', 'Agallas', 37),
(5342, '3', '7', 'Ahigal de los Aceiteros', 37),
(5343, '4', '2', 'Ahigal de Villarino', 37),
(5344, '5', '5', 'Alameda de Gardón, La', 37),
(5345, '6', '8', 'Alamedilla, La', 37),
(5346, '7', '4', 'Alaraz', 37),
(5347, '8', '0', 'Alba de Tormes', 37),
(5348, '9', '3', 'Alba de Yeltes', 37),
(5349, '10', '7', 'Alberca, La', 37),
(5350, '11', '4', 'Alberguería de Argañán, La', 37),
(5351, '12', '9', 'Alconada', 37),
(5352, '15', '3', 'Aldea del Obispo', 37),
(5353, '13', '5', 'Aldeacipreste', 37),
(5354, '14', '0', 'Aldeadávila de la Ribera', 37),
(5355, '16', '6', 'Aldealengua', 37),
(5356, '17', '2', 'Aldeanueva de Figueroa', 37),
(5357, '18', '8', 'Aldeanueva de la Sierra', 37),
(5358, '19', '1', 'Aldearrodrigo', 37),
(5359, '20', '5', 'Aldearrubia', 37),
(5360, '21', '2', 'Aldeaseca de Alba', 37),
(5361, '22', '7', 'Aldeaseca de la Frontera', 37),
(5362, '23', '3', 'Aldeatejada', 37),
(5363, '24', '8', 'Aldeavieja de Tormes', 37),
(5364, '25', '1', 'Aldehuela de la Bóveda', 37),
(5365, '26', '4', 'Aldehuela de Yeltes', 37),
(5366, '27', '0', 'Almenara de Tormes', 37),
(5367, '28', '6', 'Almendra', 37),
(5368, '29', '9', 'Anaya de Alba', 37),
(5369, '30', '3', 'Añover de Tormes', 37),
(5370, '31', '0', 'Arabayona de Mógica', 37),
(5371, '32', '5', 'Arapiles', 37),
(5372, '33', '1', 'Arcediano', 37),
(5373, '34', '6', 'Arco, El', 37),
(5374, '35', '9', 'Armenteros', 37),
(5375, '37', '8', 'Atalaya, La', 37),
(5376, '38', '4', 'Babilafuente', 37),
(5377, '39', '7', 'Bañobárez', 37),
(5378, '40', '1', 'Barbadillo', 37),
(5379, '41', '8', 'Barbalos', 37),
(5380, '42', '3', 'Barceo', 37),
(5381, '44', '4', 'Barruecopardo', 37);
INSERT INTO `poblaciones` (`id`, `codigo`, `cp`, `poblacion`, `provincia_id`) VALUES
(5382, '45', '7', 'Bastida, La', 37),
(5383, '46', '0', 'Béjar', 37),
(5384, '47', '6', 'Beleña', 37),
(5385, '49', '5', 'Bermellar', 37),
(5386, '50', '8', 'Berrocal de Huebra', 37),
(5387, '51', '5', 'Berrocal de Salvatierra', 37),
(5388, '52', '0', 'Boada', 37),
(5389, '54', '1', 'Bodón, El', 37),
(5390, '55', '4', 'Bogajo', 37),
(5391, '56', '7', 'Bouza, La', 37),
(5392, '57', '3', 'Bóveda del Río Almar', 37),
(5393, '58', '9', 'Brincones', 37),
(5394, '59', '2', 'Buenamadre', 37),
(5395, '60', '6', 'Buenavista', 37),
(5396, '61', '3', 'Cabaco, El', 37),
(5397, '63', '4', 'Cabeza de Béjar, La', 37),
(5398, '65', '2', 'Cabeza del Caballo', 37),
(5399, '62', '8', 'Cabezabellosa de la Calzada', 37),
(5400, '67', '1', 'Cabrerizos', 37),
(5401, '68', '7', 'Cabrillas', 37),
(5402, '69', '0', 'Calvarrasa de Abajo', 37),
(5403, '70', '4', 'Calvarrasa de Arriba', 37),
(5404, '71', '1', 'Calzada de Béjar, La', 37),
(5405, '72', '6', 'Calzada de Don Diego', 37),
(5406, '73', '2', 'Calzada de Valdunciel', 37),
(5407, '74', '7', 'Campillo de Azaba', 37),
(5408, '77', '9', 'Campo de Peñaranda, El', 37),
(5409, '78', '5', 'Candelario', 37),
(5410, '79', '8', 'Canillas de Abajo', 37),
(5411, '80', '2', 'Cantagallo', 37),
(5412, '81', '9', 'Cantalapiedra', 37),
(5413, '82', '4', 'Cantalpino', 37),
(5414, '83', '0', 'Cantaracillo', 37),
(5415, '85', '8', 'Carbajosa de la Sagrada', 37),
(5416, '86', '1', 'Carpio de Azaba', 37),
(5417, '87', '7', 'Carrascal de Barregas', 37),
(5418, '88', '3', 'Carrascal del Obispo', 37),
(5419, '89', '6', 'Casafranca', 37),
(5420, '90', '0', 'Casas del Conde, Las', 37),
(5421, '91', '7', 'Casillas de Flores', 37),
(5422, '92', '2', 'Castellanos de Moriscos', 37),
(5423, '185', '7', 'Castellanos de Villiquera', 37),
(5424, '96', '9', 'Castillejo de Martín Viejo', 37),
(5425, '97', '5', 'Castraz', 37),
(5426, '98', '1', 'Cepeda', 37),
(5427, '99', '4', 'Cereceda de la Sierra', 37),
(5428, '100', '8', 'Cerezal de Peñahorcada', 37),
(5429, '101', '5', 'Cerralbo', 37),
(5430, '102', '0', 'Cerro, El', 37),
(5431, '103', '6', 'Cespedosa de Tormes', 37),
(5432, '114', '9', 'Chagarcía Medianero', 37),
(5433, '104', '1', 'Cilleros de la Bastida', 37),
(5434, '106', '7', 'Cipérez', 37),
(5435, '107', '3', 'Ciudad Rodrigo', 37),
(5436, '108', '9', 'Coca de Alba', 37),
(5437, '109', '2', 'Colmenar de Montemayor', 37),
(5438, '110', '6', 'Cordovilla', 37),
(5439, '112', '8', 'Cristóbal', 37),
(5440, '113', '4', 'Cubo de Don Sancho, El', 37),
(5441, '115', '2', 'Dios le Guarde', 37),
(5442, '116', '5', 'Doñinos de Ledesma', 37),
(5443, '117', '1', 'Doñinos de Salamanca', 37),
(5444, '118', '7', 'Ejeme', 37),
(5445, '120', '4', 'Encina de San Silvestre', 37),
(5446, '119', '0', 'Encina, La', 37),
(5447, '121', '1', 'Encinas de Abajo', 37),
(5448, '122', '6', 'Encinas de Arriba', 37),
(5449, '123', '2', 'Encinasola de los Comendadores', 37),
(5450, '124', '7', 'Endrinal', 37),
(5451, '125', '0', 'Escurial de la Sierra', 37),
(5452, '126', '3', 'Espadaña', 37),
(5453, '127', '9', 'Espeja', 37),
(5454, '128', '5', 'Espino de la Orbada', 37),
(5455, '129', '8', 'Florida de Liébana', 37),
(5456, '130', '2', 'Forfoleda', 37),
(5457, '131', '9', 'Frades de la Sierra', 37),
(5458, '132', '4', 'Fregeneda, La', 37),
(5459, '133', '0', 'Fresnedoso', 37),
(5460, '134', '5', 'Fresno Alhándiga', 37),
(5461, '135', '8', 'Fuente de San Esteban, La', 37),
(5462, '136', '1', 'Fuenteguinaldo', 37),
(5463, '137', '7', 'Fuenteliante', 37),
(5464, '138', '3', 'Fuenterroble de Salvatierra', 37),
(5465, '139', '6', 'Fuentes de Béjar', 37),
(5466, '140', '0', 'Fuentes de Oñoro', 37),
(5467, '141', '7', 'Gajates', 37),
(5468, '142', '2', 'Galindo y Perahuy', 37),
(5469, '143', '8', 'Galinduste', 37),
(5470, '144', '3', 'Galisancho', 37),
(5471, '145', '6', 'Gallegos de Argañán', 37),
(5472, '146', '9', 'Gallegos de Solmirón', 37),
(5473, '147', '5', 'Garcibuey', 37),
(5474, '148', '1', 'Garcihernández', 37),
(5475, '149', '4', 'Garcirrey', 37),
(5476, '150', '7', 'Gejuelo del Barro', 37),
(5477, '151', '4', 'Golpejas', 37),
(5478, '152', '9', 'Gomecello', 37),
(5479, '154', '0', 'Guadramiro', 37),
(5480, '155', '3', 'Guijo de Ávila', 37),
(5481, '156', '6', 'Guijuelo', 37),
(5482, '157', '2', 'Herguijuela de Ciudad Rodrigo', 37),
(5483, '158', '8', 'Herguijuela de la Sierra', 37),
(5484, '159', '1', 'Herguijuela del Campo', 37),
(5485, '160', '5', 'Hinojosa de Duero', 37),
(5486, '161', '2', 'Horcajo de Montemayor', 37),
(5487, '162', '7', 'Horcajo Medianero', 37),
(5488, '163', '3', 'Hoya, La', 37),
(5489, '164', '8', 'Huerta', 37),
(5490, '165', '1', 'Iruelos', 37),
(5491, '166', '4', 'Ituero de Azaba', 37),
(5492, '167', '0', 'Juzbado', 37),
(5493, '168', '6', 'Lagunilla', 37),
(5494, '169', '9', 'Larrodrigo', 37),
(5495, '170', '3', 'Ledesma', 37),
(5496, '171', '0', 'Ledrada', 37),
(5497, '172', '5', 'Linares de Riofrío', 37),
(5498, '173', '1', 'Lumbrales', 37),
(5499, '175', '9', 'Machacón', 37),
(5500, '174', '6', 'Macotera', 37),
(5501, '176', '2', 'Madroñal', 37),
(5502, '177', '8', 'Maíllo, El', 37),
(5503, '178', '4', 'Malpartida', 37),
(5504, '179', '7', 'Mancera de Abajo', 37),
(5505, '180', '1', 'Manzano, El', 37),
(5506, '181', '8', 'Martiago', 37),
(5507, '183', '9', 'Martín de Yeltes', 37),
(5508, '182', '3', 'Martinamor', 37),
(5509, '184', '4', 'Masueco', 37),
(5510, '186', '0', 'Mata de Ledesma, La', 37),
(5511, '187', '6', 'Matilla de los Caños del Río', 37),
(5512, '188', '2', 'Maya, La', 37),
(5513, '189', '5', 'Membribe de la Sierra', 37),
(5514, '190', '9', 'Mieza', 37),
(5515, '191', '6', 'Milano, El', 37),
(5516, '192', '1', 'Miranda de Azán', 37),
(5517, '193', '7', 'Miranda del Castañar', 37),
(5518, '194', '2', 'Mogarraz', 37),
(5519, '195', '5', 'Molinillo', 37),
(5520, '196', '8', 'Monforte de la Sierra', 37),
(5521, '197', '4', 'Monleón', 37),
(5522, '198', '0', 'Monleras', 37),
(5523, '199', '3', 'Monsagro', 37),
(5524, '200', '7', 'Montejo', 37),
(5525, '201', '4', 'Montemayor del Río', 37),
(5526, '202', '9', 'Monterrubio de Armuña', 37),
(5527, '203', '5', 'Monterrubio de la Sierra', 37),
(5528, '204', '0', 'Morasverdes', 37),
(5529, '205', '3', 'Morille', 37),
(5530, '206', '6', 'Moríñigo', 37),
(5531, '207', '2', 'Moriscos', 37),
(5532, '208', '8', 'Moronta', 37),
(5533, '209', '1', 'Mozárbez', 37),
(5534, '211', '2', 'Narros de Matalayegua', 37),
(5535, '213', '3', 'Nava de Béjar', 37),
(5536, '214', '8', 'Nava de Francia', 37),
(5537, '215', '1', 'Nava de Sotrobal', 37),
(5538, '212', '7', 'Navacarros', 37),
(5539, '216', '4', 'Navales', 37),
(5540, '217', '0', 'Navalmoral de Béjar', 37),
(5541, '218', '6', 'Navamorales', 37),
(5542, '219', '9', 'Navarredonda de la Rinconada', 37),
(5543, '221', '0', 'Navasfrías', 37),
(5544, '222', '5', 'Negrilla de Palencia', 37),
(5545, '223', '1', 'Olmedo de Camaces', 37),
(5546, '224', '6', 'Orbada, La', 37),
(5547, '225', '9', 'Pajares de la Laguna', 37),
(5548, '226', '2', 'Palacios del Arzobispo', 37),
(5549, '228', '4', 'Palaciosrubios', 37),
(5550, '229', '7', 'Palencia de Negrilla', 37),
(5551, '230', '1', 'Parada de Arriba', 37),
(5552, '231', '8', 'Parada de Rubiales', 37),
(5553, '232', '3', 'Paradinas de San Juan', 37),
(5554, '233', '9', 'Pastores', 37),
(5555, '234', '4', 'Payo, El', 37),
(5556, '235', '7', 'Pedraza de Alba', 37),
(5557, '236', '0', 'Pedrosillo de Alba', 37),
(5558, '237', '6', 'Pedrosillo de los Aires', 37),
(5559, '238', '2', 'Pedrosillo el Ralo', 37),
(5560, '239', '5', 'Pedroso de la Armuña, El', 37),
(5561, '240', '9', 'Pelabravo', 37),
(5562, '241', '6', 'Pelarrodríguez', 37),
(5563, '242', '1', 'Pelayos', 37),
(5564, '243', '7', 'Peña, La', 37),
(5565, '244', '2', 'Peñacaballera', 37),
(5566, '245', '5', 'Peñaparda', 37),
(5567, '246', '8', 'Peñaranda de Bracamonte', 37),
(5568, '247', '4', 'Peñarandilla', 37),
(5569, '248', '0', 'Peralejos de Abajo', 37),
(5570, '249', '3', 'Peralejos de Arriba', 37),
(5571, '250', '6', 'Pereña de la Ribera', 37),
(5572, '251', '3', 'Peromingo', 37),
(5573, '252', '8', 'Pinedas', 37),
(5574, '253', '4', 'Pino de Tormes, El', 37),
(5575, '254', '9', 'Pitiegua', 37),
(5576, '255', '2', 'Pizarral', 37),
(5577, '256', '5', 'Poveda de las Cintas', 37),
(5578, '257', '1', 'Pozos de Hinojo', 37),
(5579, '258', '7', 'Puebla de Azaba', 37),
(5580, '259', '0', 'Puebla de San Medel', 37),
(5581, '260', '4', 'Puebla de Yeltes', 37),
(5582, '261', '1', 'Puente del Congosto', 37),
(5583, '262', '6', 'Puertas', 37),
(5584, '263', '2', 'Puerto de Béjar', 37),
(5585, '264', '7', 'Puerto Seguro', 37),
(5586, '265', '0', 'Rágama', 37),
(5587, '266', '3', 'Redonda, La', 37),
(5588, '267', '9', 'Retortillo', 37),
(5589, '268', '5', 'Rinconada de la Sierra, La', 37),
(5590, '269', '8', 'Robleda', 37),
(5591, '270', '2', 'Robliza de Cojos', 37),
(5592, '271', '9', 'Rollán', 37),
(5593, '272', '4', 'Saelices el Chico', 37),
(5594, '273', '0', 'Sagrada, La', 37),
(5595, '303', '4', 'Sahugo, El', 37),
(5596, '274', '5', 'Salamanca', 37),
(5597, '275', '8', 'Saldeana', 37),
(5598, '276', '1', 'Salmoral', 37),
(5599, '277', '7', 'Salvatierra de Tormes', 37),
(5600, '278', '3', 'San Cristóbal de la Cuesta', 37),
(5601, '284', '3', 'San Esteban de la Sierra', 37),
(5602, '285', '6', 'San Felices de los Gallegos', 37),
(5603, '286', '9', 'San Martín del Castañar', 37),
(5604, '287', '5', 'San Miguel de Valero', 37),
(5605, '36', '2', 'San Miguel del Robledo', 37),
(5606, '288', '1', 'San Morales', 37),
(5607, '289', '4', 'San Muñoz', 37),
(5608, '291', '5', 'San Pedro de Rozados', 37),
(5609, '290', '8', 'San Pedro del Valle', 37),
(5610, '292', '0', 'San Pelayo de Guareña', 37),
(5611, '280', '0', 'Sanchón de la Ribera', 37),
(5612, '281', '7', 'Sanchón de la Sagrada', 37),
(5613, '282', '2', 'Sanchotello', 37),
(5614, '279', '6', 'Sancti-Spíritus', 37),
(5615, '283', '8', 'Sando', 37),
(5616, '293', '6', 'Santa María de Sando', 37),
(5617, '294', '1', 'Santa Marta de Tormes', 37),
(5618, '296', '7', 'Santiago de la Puebla', 37),
(5619, '297', '3', 'Santibáñez de Béjar', 37),
(5620, '298', '9', 'Santibáñez de la Sierra', 37),
(5621, '299', '2', 'Santiz', 37),
(5622, '300', '6', 'Santos, Los', 37),
(5623, '301', '3', 'Sardón de los Frailes', 37),
(5624, '302', '8', 'Saucelle', 37),
(5625, '304', '9', 'Sepulcro-Hilario', 37),
(5626, '305', '2', 'Sequeros', 37),
(5627, '306', '5', 'Serradilla del Arroyo', 37),
(5628, '307', '1', 'Serradilla del Llano', 37),
(5629, '309', '0', 'Sierpe, La', 37),
(5630, '310', '4', 'Sieteiglesias de Tormes', 37),
(5631, '311', '1', 'Sobradillo', 37),
(5632, '312', '6', 'Sorihuela', 37),
(5633, '313', '2', 'Sotoserrano', 37),
(5634, '314', '7', 'Tabera de Abajo', 37),
(5635, '315', '0', 'Tala, La', 37),
(5636, '316', '3', 'Tamames', 37),
(5637, '317', '9', 'Tarazona de Guareña', 37),
(5638, '318', '5', 'Tardáguila', 37),
(5639, '319', '8', 'Tejado, El', 37),
(5640, '320', '2', 'Tejeda y Segoyuela', 37),
(5641, '321', '9', 'Tenebrón', 37),
(5642, '322', '4', 'Terradillos', 37),
(5643, '323', '0', 'Topas', 37),
(5644, '324', '5', 'Tordillos', 37),
(5645, '325', '8', 'Tornadizo, El', 37),
(5646, '327', '7', 'Torresmenudas', 37),
(5647, '328', '3', 'Trabanca', 37),
(5648, '329', '6', 'Tremedal de Tormes', 37),
(5649, '330', '0', 'Valdecarros', 37),
(5650, '331', '7', 'Valdefuentes de Sangusín', 37),
(5651, '332', '2', 'Valdehijaderos', 37),
(5652, '333', '8', 'Valdelacasa', 37),
(5653, '334', '3', 'Valdelageve', 37),
(5654, '335', '6', 'Valdelosa', 37),
(5655, '336', '9', 'Valdemierque', 37),
(5656, '337', '5', 'Valderrodrigo', 37),
(5657, '338', '1', 'Valdunciel', 37),
(5658, '339', '4', 'Valero', 37),
(5659, '343', '6', 'Vallejera de Riofrío', 37),
(5660, '340', '8', 'Valsalabroso', 37),
(5661, '341', '5', 'Valverde de Valdelacasa', 37),
(5662, '342', '0', 'Valverdón', 37),
(5663, '344', '1', 'Vecinos', 37),
(5664, '345', '4', 'Vega de Tirados', 37),
(5665, '346', '7', 'Veguillas, Las', 37),
(5666, '347', '3', 'Vellés, La', 37),
(5667, '348', '9', 'Ventosa del Río Almar', 37),
(5668, '349', '2', 'Vídola, La', 37),
(5669, '351', '2', 'Villaflores', 37),
(5670, '352', '7', 'Villagonzalo de Tormes', 37),
(5671, '353', '3', 'Villalba de los Llanos', 37),
(5672, '354', '8', 'Villamayor', 37),
(5673, '355', '1', 'Villanueva del Conde', 37),
(5674, '356', '4', 'Villar de Argañán', 37),
(5675, '357', '0', 'Villar de Ciervo', 37),
(5676, '358', '6', 'Villar de Gallimazo', 37),
(5677, '359', '9', 'Villar de la Yegua', 37),
(5678, '360', '3', 'Villar de Peralonso', 37),
(5679, '361', '0', 'Villar de Samaniego', 37),
(5680, '362', '5', 'Villares de la Reina', 37),
(5681, '363', '1', 'Villares de Yeltes', 37),
(5682, '364', '6', 'Villarino de los Aires', 37),
(5683, '365', '9', 'Villarmayor', 37),
(5684, '366', '2', 'Villarmuerto', 37),
(5685, '367', '8', 'Villasbuenas', 37),
(5686, '368', '4', 'Villasdardo', 37),
(5687, '369', '7', 'Villaseco de los Gamitos', 37),
(5688, '370', '1', 'Villaseco de los Reyes', 37),
(5689, '371', '8', 'Villasrubias', 37),
(5690, '372', '3', 'Villaverde de Guareña', 37),
(5691, '373', '9', 'Villavieja de Yeltes', 37),
(5692, '374', '4', 'Villoria', 37),
(5693, '375', '7', 'Villoruela', 37),
(5694, '350', '5', 'Vilvestre', 37),
(5695, '376', '0', 'Vitigudino', 37),
(5696, '377', '6', 'Yecla de Yeltes', 37),
(5697, '378', '2', 'Zamarra', 37),
(5698, '379', '5', 'Zamayón', 37),
(5699, '380', '9', 'Zarapicos', 37),
(5700, '381', '6', 'Zarza de Pumareda, La', 37),
(5701, '382', '1', 'Zorita de la Frontera', 37),
(5702, '1', '2', 'Adeje', 38),
(5703, '2', '7', 'Agulo', 38),
(5704, '3', '3', 'Alajeró', 38),
(5705, '4', '8', 'Arafo', 38),
(5706, '5', '1', 'Arico', 38),
(5707, '6', '4', 'Arona', 38),
(5708, '7', '0', 'Barlovento', 38),
(5709, '8', '6', 'Breña Alta', 38),
(5710, '9', '9', 'Breña Baja', 38),
(5711, '10', '3', 'Buenavista del Norte', 38),
(5712, '11', '0', 'Candelaria', 38),
(5713, '12', '5', 'Fasnia', 38),
(5714, '13', '1', 'Frontera', 38),
(5715, '14', '6', 'Fuencaliente de la Palma', 38),
(5716, '15', '9', 'Garachico', 38),
(5717, '16', '2', 'Garafía', 38),
(5718, '17', '8', 'Granadilla de Abona', 38),
(5719, '18', '4', 'Guancha, La', 38),
(5720, '19', '7', 'Guía de Isora', 38),
(5721, '20', '1', 'Güímar', 38),
(5722, '21', '8', 'Hermigua', 38),
(5723, '22', '3', 'Icod de los Vinos', 38),
(5724, '24', '4', 'Llanos de Aridane, Los', 38),
(5725, '25', '7', 'Matanza de Acentejo, La', 38),
(5726, '26', '0', 'Orotava, La', 38),
(5727, '27', '6', 'Paso, El', 38),
(5728, '901', '3', 'Pinar de El Hierro, El', 38),
(5729, '28', '2', 'Puerto de la Cruz', 38),
(5730, '29', '5', 'Puntagorda', 38),
(5731, '30', '9', 'Puntallana', 38),
(5732, '31', '6', 'Realejos, Los', 38),
(5733, '32', '1', 'Rosario, El', 38),
(5734, '33', '7', 'San Andrés y Sauces', 38),
(5735, '23', '9', 'San Cristóbal de La Laguna', 38),
(5736, '34', '2', 'San Juan de la Rambla', 38),
(5737, '35', '5', 'San Miguel de Abona', 38),
(5738, '36', '8', 'San Sebastián de la Gomera', 38),
(5739, '37', '4', 'Santa Cruz de la Palma', 38),
(5740, '38', '0', 'Santa Cruz de Tenerife', 38),
(5741, '39', '3', 'Santa Úrsula', 38),
(5742, '40', '7', 'Santiago del Teide', 38),
(5743, '41', '4', 'Sauzal, El', 38),
(5744, '42', '9', 'Silos, Los', 38),
(5745, '43', '5', 'Tacoronte', 38),
(5746, '44', '0', 'Tanque, El', 38),
(5747, '45', '3', 'Tazacorte', 38),
(5748, '46', '6', 'Tegueste', 38),
(5749, '47', '2', 'Tijarafe', 38),
(5750, '49', '1', 'Valle Gran Rey', 38),
(5751, '50', '4', 'Vallehermoso', 38),
(5752, '48', '8', 'Valverde', 38),
(5753, '51', '1', 'Victoria de Acentejo, La', 38),
(5754, '52', '6', 'Vilaflor de Chasna', 38),
(5755, '53', '2', 'Villa de Mazo', 38),
(5756, '1', '5', 'Alfoz de Lloredo', 39),
(5757, '2', '0', 'Ampuero', 39),
(5758, '3', '6', 'Anievas', 39),
(5759, '4', '1', 'Arenas de Iguña', 39),
(5760, '5', '4', 'Argoños', 39),
(5761, '6', '7', 'Arnuero', 39),
(5762, '7', '3', 'Arredondo', 39),
(5763, '8', '9', 'Astillero, El', 39),
(5764, '9', '2', 'Bárcena de Cicero', 39),
(5765, '10', '6', 'Bárcena de Pie de Concha', 39),
(5766, '11', '3', 'Bareyo', 39),
(5767, '12', '8', 'Cabezón de la Sal', 39),
(5768, '13', '4', 'Cabezón de Liébana', 39),
(5769, '14', '9', 'Cabuérniga', 39),
(5770, '15', '2', 'Camaleño', 39),
(5771, '16', '5', 'Camargo', 39),
(5772, '27', '9', 'Campoo de Enmedio', 39),
(5773, '17', '1', 'Campoo de Yuso', 39),
(5774, '18', '7', 'Cartes', 39),
(5775, '19', '0', 'Castañeda', 39),
(5776, '20', '4', 'Castro-Urdiales', 39),
(5777, '21', '1', 'Cieza', 39),
(5778, '22', '6', 'Cillorigo de Liébana', 39),
(5779, '23', '2', 'Colindres', 39),
(5780, '24', '7', 'Comillas', 39),
(5781, '25', '0', 'Corrales de Buelna, Los', 39),
(5782, '26', '3', 'Corvera de Toranzo', 39),
(5783, '28', '5', 'Entrambasaguas', 39),
(5784, '29', '8', 'Escalante', 39),
(5785, '30', '2', 'Guriezo', 39),
(5786, '31', '9', 'Hazas de Cesto', 39),
(5787, '32', '4', 'Hermandad de Campoo de Suso', 39),
(5788, '33', '0', 'Herrerías', 39),
(5789, '34', '5', 'Lamasón', 39),
(5790, '35', '8', 'Laredo', 39),
(5791, '36', '1', 'Liendo', 39),
(5792, '37', '7', 'Liérganes', 39),
(5793, '38', '3', 'Limpias', 39),
(5794, '39', '6', 'Luena', 39),
(5795, '40', '0', 'Marina de Cudeyo', 39),
(5796, '41', '7', 'Mazcuerras', 39),
(5797, '42', '2', 'Medio Cudeyo', 39),
(5798, '43', '8', 'Meruelo', 39),
(5799, '44', '3', 'Miengo', 39),
(5800, '45', '6', 'Miera', 39),
(5801, '46', '9', 'Molledo', 39),
(5802, '47', '5', 'Noja', 39),
(5803, '48', '1', 'Penagos', 39),
(5804, '49', '4', 'Peñarrubia', 39),
(5805, '50', '7', 'Pesaguero', 39),
(5806, '51', '4', 'Pesquera', 39),
(5807, '52', '9', 'Piélagos', 39),
(5808, '53', '5', 'Polaciones', 39),
(5809, '54', '0', 'Polanco', 39),
(5810, '55', '3', 'Potes', 39),
(5811, '56', '6', 'Puente Viesgo', 39),
(5812, '57', '2', 'Ramales de la Victoria', 39),
(5813, '58', '8', 'Rasines', 39),
(5814, '59', '1', 'Reinosa', 39),
(5815, '60', '5', 'Reocín', 39),
(5816, '61', '2', 'Ribamontán al Mar', 39),
(5817, '62', '7', 'Ribamontán al Monte', 39),
(5818, '63', '3', 'Rionansa', 39),
(5819, '64', '8', 'Riotuerto', 39),
(5820, '65', '1', 'Rozas de Valdearroyo, Las', 39),
(5821, '66', '4', 'Ruente', 39),
(5822, '67', '0', 'Ruesga', 39),
(5823, '68', '6', 'Ruiloba', 39),
(5824, '69', '9', 'San Felices de Buelna', 39),
(5825, '70', '3', 'San Miguel de Aguayo', 39),
(5826, '71', '0', 'San Pedro del Romeral', 39),
(5827, '72', '5', 'San Roque de Riomiera', 39),
(5828, '80', '1', 'San Vicente de la Barquera', 39),
(5829, '73', '1', 'Santa Cruz de Bezana', 39),
(5830, '74', '6', 'Santa María de Cayón', 39),
(5831, '75', '9', 'Santander', 39),
(5832, '76', '2', 'Santillana del Mar', 39),
(5833, '77', '8', 'Santiurde de Reinosa', 39),
(5834, '78', '4', 'Santiurde de Toranzo', 39),
(5835, '79', '7', 'Santoña', 39),
(5836, '81', '8', 'Saro', 39),
(5837, '82', '3', 'Selaya', 39),
(5838, '83', '9', 'Soba', 39),
(5839, '84', '4', 'Solórzano', 39),
(5840, '85', '7', 'Suances', 39),
(5841, '86', '0', 'Tojos, Los', 39),
(5842, '87', '6', 'Torrelavega', 39),
(5843, '88', '2', 'Tresviso', 39),
(5844, '89', '5', 'Tudanca', 39),
(5845, '90', '9', 'Udías', 39),
(5846, '95', '5', 'Val de San Vicente', 39),
(5847, '91', '6', 'Valdáliga', 39),
(5848, '92', '1', 'Valdeolea', 39),
(5849, '93', '7', 'Valdeprado del Río', 39),
(5850, '94', '2', 'Valderredible', 39),
(5851, '101', '4', 'Valle de Villaverde', 39),
(5852, '96', '8', 'Vega de Liébana', 39),
(5853, '97', '4', 'Vega de Pas', 39),
(5854, '98', '0', 'Villacarriedo', 39),
(5855, '99', '3', 'Villaescusa', 39),
(5856, '100', '7', 'Villafufre', 39),
(5857, '102', '9', 'Voto', 39),
(5858, '1', '9', 'Abades', 40),
(5859, '2', '4', 'Adrada de Pirón', 40),
(5860, '3', '0', 'Adrados', 40),
(5861, '4', '5', 'Aguilafuente', 40),
(5862, '5', '8', 'Alconada de Maderuelo', 40),
(5863, '12', '2', 'Aldea Real', 40),
(5864, '6', '1', 'Aldealcorvo', 40),
(5865, '7', '7', 'Aldealengua de Pedraza', 40),
(5866, '8', '3', 'Aldealengua de Santa María', 40),
(5867, '9', '6', 'Aldeanueva de la Serrezuela', 40),
(5868, '10', '0', 'Aldeanueva del Codonal', 40),
(5869, '13', '8', 'Aldeasoña', 40),
(5870, '14', '3', 'Aldehorno', 40),
(5871, '15', '6', 'Aldehuela del Codonal', 40),
(5872, '16', '9', 'Aldeonte', 40),
(5873, '17', '5', 'Anaya', 40),
(5874, '18', '1', 'Añe', 40),
(5875, '19', '4', 'Arahuetes', 40),
(5876, '20', '8', 'Arcones', 40),
(5877, '21', '5', 'Arevalillo de Cega', 40),
(5878, '22', '0', 'Armuña', 40),
(5879, '24', '1', 'Ayllón', 40),
(5880, '25', '4', 'Barbolla', 40),
(5881, '26', '7', 'Basardilla', 40),
(5882, '28', '9', 'Bercial', 40),
(5883, '29', '2', 'Bercimuel', 40),
(5884, '30', '6', 'Bernardos', 40),
(5885, '31', '3', 'Bernuy de Porreros', 40),
(5886, '32', '8', 'Boceguillas', 40),
(5887, '33', '4', 'Brieva', 40),
(5888, '34', '9', 'Caballar', 40),
(5889, '35', '2', 'Cabañas de Polendos', 40),
(5890, '36', '5', 'Cabezuela', 40),
(5891, '37', '1', 'Calabazas de Fuentidueña', 40),
(5892, '39', '0', 'Campo de San Pedro', 40),
(5893, '40', '4', 'Cantalejo', 40),
(5894, '41', '1', 'Cantimpalos', 40),
(5895, '43', '2', 'Carbonero el Mayor', 40),
(5896, '44', '7', 'Carrascal del Río', 40),
(5897, '45', '0', 'Casla', 40),
(5898, '46', '3', 'Castillejo de Mesleón', 40),
(5899, '47', '9', 'Castro de Fuentidueña', 40),
(5900, '48', '5', 'Castrojimeno', 40),
(5901, '49', '8', 'Castroserna de Abajo', 40),
(5902, '51', '8', 'Castroserracín', 40),
(5903, '52', '3', 'Cedillo de la Torre', 40),
(5904, '53', '9', 'Cerezo de Abajo', 40),
(5905, '54', '4', 'Cerezo de Arriba', 40),
(5906, '65', '5', 'Chañe', 40),
(5907, '55', '7', 'Cilleruelo de San Mamés', 40),
(5908, '56', '0', 'Cobos de Fuentidueña', 40),
(5909, '57', '6', 'Coca', 40),
(5910, '58', '2', 'Codorniz', 40),
(5911, '59', '5', 'Collado Hermoso', 40),
(5912, '60', '9', 'Condado de Castilnovo', 40),
(5913, '61', '6', 'Corral de Ayllón', 40),
(5914, '902', '5', 'Cozuelos de Fuentidueña', 40),
(5915, '62', '1', 'Cubillo', 40),
(5916, '63', '7', 'Cuéllar', 40),
(5917, '905', '9', 'Cuevas de Provanco', 40),
(5918, '68', '0', 'Domingo García', 40),
(5919, '69', '3', 'Donhierro', 40),
(5920, '70', '7', 'Duruelo', 40),
(5921, '71', '4', 'Encinas', 40),
(5922, '72', '9', 'Encinillas', 40),
(5923, '73', '5', 'Escalona del Prado', 40),
(5924, '74', '0', 'Escarabajosa de Cabezas', 40),
(5925, '75', '3', 'Escobar de Polendos', 40),
(5926, '76', '6', 'Espinar, El', 40),
(5927, '77', '2', 'Espirdo', 40),
(5928, '78', '8', 'Fresneda de Cuéllar', 40),
(5929, '79', '1', 'Fresno de Cantespino', 40),
(5930, '80', '5', 'Fresno de la Fuente', 40),
(5931, '81', '2', 'Frumales', 40),
(5932, '82', '7', 'Fuente de Santa Cruz', 40),
(5933, '83', '3', 'Fuente el Olmo de Fuentidueña', 40),
(5934, '84', '8', 'Fuente el Olmo de Íscar', 40),
(5935, '86', '4', 'Fuentepelayo', 40),
(5936, '87', '0', 'Fuentepiñel', 40),
(5937, '88', '6', 'Fuenterrebollo', 40),
(5938, '89', '9', 'Fuentesaúco de Fuentidueña', 40),
(5939, '91', '0', 'Fuentesoto', 40),
(5940, '92', '5', 'Fuentidueña', 40),
(5941, '93', '1', 'Gallegos', 40),
(5942, '94', '6', 'Garcillán', 40),
(5943, '95', '9', 'Gomezserracín', 40),
(5944, '97', '8', 'Grajera', 40),
(5945, '99', '7', 'Honrubia de la Cuesta', 40),
(5946, '100', '1', 'Hontalbilla', 40),
(5947, '101', '8', 'Hontanares de Eresma', 40),
(5948, '103', '9', 'Huertos, Los', 40),
(5949, '104', '4', 'Ituero y Lama', 40),
(5950, '105', '7', 'Juarros de Riomoros', 40),
(5951, '106', '0', 'Juarros de Voltoya', 40),
(5952, '107', '6', 'Labajos', 40),
(5953, '108', '2', 'Laguna de Contreras', 40),
(5954, '109', '5', 'Languilla', 40),
(5955, '110', '9', 'Lastras de Cuéllar', 40),
(5956, '111', '6', 'Lastras del Pozo', 40),
(5957, '112', '1', 'Lastrilla, La', 40),
(5958, '113', '7', 'Losa, La', 40),
(5959, '115', '5', 'Maderuelo', 40),
(5960, '903', '1', 'Marazoleja', 40),
(5961, '118', '0', 'Marazuela', 40),
(5962, '119', '3', 'Martín Miguel', 40),
(5963, '120', '7', 'Martín Muñoz de la Dehesa', 40),
(5964, '121', '4', 'Martín Muñoz de las Posadas', 40),
(5965, '122', '9', 'Marugán', 40),
(5966, '124', '0', 'Mata de Cuéllar', 40),
(5967, '123', '5', 'Matabuena', 40),
(5968, '125', '3', 'Matilla, La', 40),
(5969, '126', '6', 'Melque de Cercos', 40),
(5970, '127', '2', 'Membibre de la Hoz', 40),
(5971, '128', '8', 'Migueláñez', 40),
(5972, '129', '1', 'Montejo de Arévalo', 40),
(5973, '130', '5', 'Montejo de la Vega de la Serrezuela', 40),
(5974, '131', '2', 'Monterrubio', 40),
(5975, '132', '7', 'Moral de Hornuez', 40),
(5976, '134', '8', 'Mozoncillo', 40),
(5977, '135', '1', 'Muñopedro', 40),
(5978, '136', '4', 'Muñoveros', 40),
(5979, '138', '6', 'Nava de la Asunción', 40),
(5980, '139', '9', 'Navafría', 40),
(5981, '140', '3', 'Navalilla', 40),
(5982, '141', '0', 'Navalmanzano', 40),
(5983, '142', '5', 'Navares de Ayuso', 40),
(5984, '143', '1', 'Navares de Enmedio', 40),
(5985, '144', '6', 'Navares de las Cuevas', 40),
(5986, '145', '9', 'Navas de Oro', 40),
(5987, '904', '6', 'Navas de Riofrío', 40),
(5988, '146', '2', 'Navas de San Antonio', 40),
(5989, '148', '4', 'Nieva', 40),
(5990, '149', '7', 'Olombrada', 40),
(5991, '150', '0', 'Orejana', 40),
(5992, '151', '7', 'Ortigosa de Pestaño', 40),
(5993, '901', '0', 'Ortigosa del Monte', 40),
(5994, '152', '2', 'Otero de Herreros', 40),
(5995, '154', '3', 'Pajarejos', 40),
(5996, '155', '6', 'Palazuelos de Eresma', 40),
(5997, '156', '9', 'Pedraza', 40),
(5998, '157', '5', 'Pelayos del Arroyo', 40),
(5999, '158', '1', 'Perosillo', 40),
(6000, '159', '4', 'Pinarejos', 40),
(6001, '160', '8', 'Pinarnegrillo', 40),
(6002, '161', '5', 'Pradales', 40),
(6003, '162', '0', 'Prádena', 40),
(6004, '163', '6', 'Puebla de Pedraza', 40),
(6005, '164', '1', 'Rapariegos', 40),
(6006, '181', '1', 'Real Sitio de San Ildefonso', 40),
(6007, '165', '4', 'Rebollo', 40),
(6008, '166', '7', 'Remondo', 40),
(6009, '168', '9', 'Riaguas de San Bartolomé', 40),
(6010, '170', '6', 'Riaza', 40),
(6011, '171', '3', 'Ribota', 40),
(6012, '172', '8', 'Riofrío de Riaza', 40),
(6013, '173', '4', 'Roda de Eresma', 40),
(6014, '174', '9', 'Sacramenia', 40),
(6015, '176', '5', 'Samboal', 40),
(6016, '177', '1', 'San Cristóbal de Cuéllar', 40),
(6017, '178', '7', 'San Cristóbal de la Vega', 40),
(6018, '906', '2', 'San Cristóbal de Segovia', 40),
(6019, '182', '6', 'San Martín y Mudrián', 40),
(6020, '183', '2', 'San Miguel de Bernuy', 40),
(6021, '184', '7', 'San Pedro de Gaíllos', 40),
(6022, '179', '0', 'Sanchonuño', 40),
(6023, '180', '4', 'Sangarcía', 40),
(6024, '185', '0', 'Santa María la Real de Nieva', 40),
(6025, '186', '3', 'Santa Marta del Cerro', 40),
(6026, '188', '5', 'Santiuste de Pedraza', 40),
(6027, '189', '8', 'Santiuste de San Juan Bautista', 40),
(6028, '190', '2', 'Santo Domingo de Pirón', 40),
(6029, '191', '9', 'Santo Tomé del Puerto', 40),
(6030, '192', '4', 'Sauquillo de Cabezas', 40),
(6031, '193', '0', 'Sebúlcor', 40),
(6032, '194', '5', 'Segovia', 40),
(6033, '195', '8', 'Sepúlveda', 40),
(6034, '196', '1', 'Sequera de Fresno', 40),
(6035, '198', '3', 'Sotillo', 40),
(6036, '199', '6', 'Sotosalbos', 40),
(6037, '200', '0', 'Tabanera la Luenga', 40),
(6038, '201', '7', 'Tolocirio', 40),
(6039, '206', '9', 'Torre Val de San Pedro', 40),
(6040, '202', '2', 'Torreadrada', 40),
(6041, '203', '8', 'Torrecaballeros', 40),
(6042, '204', '3', 'Torrecilla del Pinar', 40),
(6043, '205', '6', 'Torreiglesias', 40),
(6044, '207', '5', 'Trescasas', 40),
(6045, '208', '1', 'Turégano', 40),
(6046, '210', '8', 'Urueñas', 40),
(6047, '211', '5', 'Valdeprados', 40),
(6048, '212', '0', 'Valdevacas de Montejo', 40),
(6049, '213', '6', 'Valdevacas y Guijar', 40),
(6050, '218', '9', 'Valle de Tabladillo', 40),
(6051, '219', '2', 'Vallelado', 40),
(6052, '220', '6', 'Valleruela de Pedraza', 40),
(6053, '221', '3', 'Valleruela de Sepúlveda', 40),
(6054, '214', '1', 'Valseca', 40),
(6055, '215', '4', 'Valtiendas', 40),
(6056, '216', '7', 'Valverde del Majano', 40),
(6057, '222', '8', 'Veganzones', 40),
(6058, '223', '4', 'Vegas de Matute', 40),
(6059, '224', '9', 'Ventosilla y Tejadilla', 40),
(6060, '225', '2', 'Villacastín', 40),
(6061, '228', '7', 'Villaverde de Íscar', 40),
(6062, '229', '0', 'Villaverde de Montejo', 40),
(6063, '230', '4', 'Villeguillo', 40),
(6064, '231', '1', 'Yanguas de Eresma', 40),
(6065, '233', '2', 'Zarzuela del Monte', 40),
(6066, '234', '7', 'Zarzuela del Pinar', 40),
(6067, '1', '6', 'Aguadulce', 41),
(6068, '2', '1', 'Alanís', 41),
(6069, '3', '7', 'Albaida del Aljarafe', 41),
(6070, '4', '2', 'Alcalá de Guadaíra', 41),
(6071, '5', '5', 'Alcalá del Río', 41),
(6072, '6', '8', 'Alcolea del Río', 41),
(6073, '7', '4', 'Algaba, La', 41),
(6074, '8', '0', 'Algámitas', 41),
(6075, '9', '3', 'Almadén de la Plata', 41),
(6076, '10', '7', 'Almensilla', 41),
(6077, '11', '4', 'Arahal', 41),
(6078, '12', '9', 'Aznalcázar', 41),
(6079, '13', '5', 'Aznalcóllar', 41),
(6080, '14', '0', 'Badolatosa', 41),
(6081, '15', '3', 'Benacazón', 41),
(6082, '16', '6', 'Bollullos de la Mitación', 41),
(6083, '17', '2', 'Bormujos', 41),
(6084, '18', '8', 'Brenes', 41),
(6085, '19', '1', 'Burguillos', 41),
(6086, '20', '5', 'Cabezas de San Juan, Las', 41),
(6087, '21', '2', 'Camas', 41),
(6088, '22', '7', 'Campana, La', 41),
(6089, '23', '3', 'Cantillana', 41),
(6090, '901', '7', 'Cañada Rosal', 41),
(6091, '24', '8', 'Carmona', 41),
(6092, '25', '1', 'Carrión de los Céspedes', 41),
(6093, '26', '4', 'Casariche', 41),
(6094, '27', '0', 'Castilblanco de los Arroyos', 41),
(6095, '28', '6', 'Castilleja de Guzmán', 41),
(6096, '29', '9', 'Castilleja de la Cuesta', 41),
(6097, '30', '3', 'Castilleja del Campo', 41),
(6098, '31', '0', 'Castillo de las Guardas, El', 41),
(6099, '32', '5', 'Cazalla de la Sierra', 41),
(6100, '33', '1', 'Constantina', 41),
(6101, '34', '6', 'Coria del Río', 41),
(6102, '35', '9', 'Coripe', 41),
(6103, '36', '2', 'Coronil, El', 41),
(6104, '37', '8', 'Corrales, Los', 41),
(6105, '903', '8', 'Cuervo de Sevilla, El', 41),
(6106, '38', '4', 'Dos Hermanas', 41),
(6107, '39', '7', 'Écija', 41),
(6108, '40', '1', 'Espartinas', 41),
(6109, '41', '8', 'Estepa', 41),
(6110, '42', '3', 'Fuentes de Andalucía', 41),
(6111, '43', '9', 'Garrobo, El', 41),
(6112, '44', '4', 'Gelves', 41),
(6113, '45', '7', 'Gerena', 41),
(6114, '46', '0', 'Gilena', 41),
(6115, '47', '6', 'Gines', 41),
(6116, '48', '2', 'Guadalcanal', 41),
(6117, '49', '5', 'Guillena', 41),
(6118, '50', '8', 'Herrera', 41),
(6119, '51', '5', 'Huévar del Aljarafe', 41),
(6120, '902', '2', 'Isla Mayor', 41),
(6121, '52', '0', 'Lantejuela', 41),
(6122, '53', '6', 'Lebrija', 41),
(6123, '54', '1', 'Lora de Estepa', 41),
(6124, '55', '4', 'Lora del Río', 41),
(6125, '56', '7', 'Luisiana, La', 41),
(6126, '57', '3', 'Madroño, El', 41),
(6127, '58', '9', 'Mairena del Alcor', 41),
(6128, '59', '2', 'Mairena del Aljarafe', 41),
(6129, '60', '6', 'Marchena', 41),
(6130, '61', '3', 'Marinaleda', 41),
(6131, '62', '8', 'Martín de la Jara', 41),
(6132, '63', '4', 'Molares, Los', 41),
(6133, '64', '9', 'Montellano', 41),
(6134, '65', '2', 'Morón de la Frontera', 41),
(6135, '66', '5', 'Navas de la Concepción, Las', 41),
(6136, '67', '1', 'Olivares', 41),
(6137, '68', '7', 'Osuna', 41),
(6138, '69', '0', 'Palacios y Villafranca, Los', 41),
(6139, '70', '4', 'Palomares del Río', 41),
(6140, '71', '1', 'Paradas', 41),
(6141, '72', '6', 'Pedrera', 41),
(6142, '73', '2', 'Pedroso, El', 41),
(6143, '74', '7', 'Peñaflor', 41),
(6144, '75', '0', 'Pilas', 41),
(6145, '76', '3', 'Pruna', 41),
(6146, '77', '9', 'Puebla de Cazalla, La', 41),
(6147, '78', '5', 'Puebla de los Infantes, La', 41),
(6148, '79', '8', 'Puebla del Río, La', 41),
(6149, '80', '2', 'Real de la Jara, El', 41),
(6150, '81', '9', 'Rinconada, La', 41),
(6151, '82', '4', 'Roda de Andalucía, La', 41),
(6152, '83', '0', 'Ronquillo, El', 41),
(6153, '84', '5', 'Rubio, El', 41),
(6154, '85', '8', 'Salteras', 41),
(6155, '86', '1', 'San Juan de Aznalfarache', 41),
(6156, '88', '3', 'San Nicolás del Puerto', 41),
(6157, '87', '7', 'Sanlúcar la Mayor', 41),
(6158, '89', '6', 'Santiponce', 41),
(6159, '90', '0', 'Saucejo, El', 41),
(6160, '91', '7', 'Sevilla', 41),
(6161, '92', '2', 'Tocina', 41),
(6162, '93', '8', 'Tomares', 41),
(6163, '94', '3', 'Umbrete', 41),
(6164, '95', '6', 'Utrera', 41),
(6165, '96', '9', 'Valencina de la Concepción', 41),
(6166, '97', '5', 'Villamanrique de la Condesa', 41),
(6167, '100', '8', 'Villanueva de San Juan', 41),
(6168, '98', '1', 'Villanueva del Ariscal', 41),
(6169, '99', '4', 'Villanueva del Río y Minas', 41),
(6170, '101', '5', 'Villaverde del Río', 41),
(6171, '102', '0', 'Viso del Alcor, El', 41),
(6172, '1', '1', 'Abejar', 42),
(6173, '3', '2', 'Adradas', 42),
(6174, '4', '7', 'Ágreda', 42),
(6175, '6', '3', 'Alconaba', 42),
(6176, '7', '9', 'Alcubilla de Avellaneda', 42),
(6177, '8', '5', 'Alcubilla de las Peñas', 42),
(6178, '9', '8', 'Aldealafuente', 42),
(6179, '10', '2', 'Aldealices', 42),
(6180, '11', '9', 'Aldealpozo', 42),
(6181, '12', '4', 'Aldealseñor', 42),
(6182, '13', '0', 'Aldehuela de Periáñez', 42),
(6183, '14', '5', 'Aldehuelas, Las', 42),
(6184, '15', '8', 'Alentisque', 42),
(6185, '16', '1', 'Aliud', 42),
(6186, '17', '7', 'Almajano', 42),
(6187, '18', '3', 'Almaluez', 42),
(6188, '19', '6', 'Almarza', 42),
(6189, '20', '0', 'Almazán', 42),
(6190, '21', '7', 'Almazul', 42),
(6191, '22', '2', 'Almenar de Soria', 42),
(6192, '23', '8', 'Alpanseque', 42),
(6193, '24', '3', 'Arancón', 42),
(6194, '25', '6', 'Arcos de Jalón', 42),
(6195, '26', '9', 'Arenillas', 42),
(6196, '27', '5', 'Arévalo de la Sierra', 42),
(6197, '28', '1', 'Ausejo de la Sierra', 42),
(6198, '29', '4', 'Baraona', 42),
(6199, '30', '8', 'Barca', 42),
(6200, '31', '5', 'Barcones', 42),
(6201, '32', '0', 'Bayubas de Abajo', 42),
(6202, '33', '6', 'Bayubas de Arriba', 42),
(6203, '34', '1', 'Beratón', 42),
(6204, '35', '4', 'Berlanga de Duero', 42),
(6205, '36', '7', 'Blacos', 42),
(6206, '37', '3', 'Bliecos', 42),
(6207, '38', '9', 'Borjabad', 42),
(6208, '39', '2', 'Borobia', 42),
(6209, '41', '3', 'Buberos', 42),
(6210, '42', '8', 'Buitrago', 42),
(6211, '43', '4', 'Burgo de Osma-Ciudad de Osma', 42),
(6212, '44', '9', 'Cabrejas del Campo', 42),
(6213, '45', '2', 'Cabrejas del Pinar', 42),
(6214, '46', '5', 'Calatañazor', 42),
(6215, '48', '7', 'Caltojar', 42),
(6216, '49', '0', 'Candilichera', 42),
(6217, '50', '3', 'Cañamaque', 42),
(6218, '51', '0', 'Carabantes', 42),
(6219, '52', '5', 'Caracena', 42),
(6220, '53', '1', 'Carrascosa de Abajo', 42),
(6221, '54', '6', 'Carrascosa de la Sierra', 42),
(6222, '55', '9', 'Casarejos', 42),
(6223, '56', '2', 'Castilfrío de la Sierra', 42),
(6224, '58', '4', 'Castillejo de Robledo', 42),
(6225, '57', '8', 'Castilruiz', 42),
(6226, '59', '7', 'Centenera de Andaluz', 42),
(6227, '60', '1', 'Cerbón', 42),
(6228, '61', '8', 'Cidones', 42),
(6229, '62', '3', 'Cigudosa', 42),
(6230, '63', '9', 'Cihuela', 42),
(6231, '64', '4', 'Ciria', 42),
(6232, '65', '7', 'Cirujales del Río', 42),
(6233, '68', '2', 'Coscurita', 42),
(6234, '69', '5', 'Covaleda', 42),
(6235, '70', '9', 'Cubilla', 42),
(6236, '71', '6', 'Cubo de la Solana', 42),
(6237, '73', '7', 'Cueva de Ágreda', 42),
(6238, '75', '5', 'Dévanos', 42),
(6239, '76', '8', 'Deza', 42),
(6240, '78', '0', 'Duruelo de la Sierra', 42),
(6241, '79', '3', 'Escobosa de Almazán', 42),
(6242, '80', '7', 'Espeja de San Marcelino', 42),
(6243, '81', '4', 'Espejón', 42),
(6244, '82', '9', 'Estepa de San Juan', 42),
(6245, '83', '5', 'Frechilla de Almazán', 42),
(6246, '84', '0', 'Fresno de Caracena', 42),
(6247, '85', '3', 'Fuentearmegil', 42),
(6248, '86', '6', 'Fuentecambrón', 42),
(6249, '87', '2', 'Fuentecantos', 42),
(6250, '88', '8', 'Fuentelmonge', 42),
(6251, '89', '1', 'Fuentelsaz de Soria', 42),
(6252, '90', '5', 'Fuentepinilla', 42),
(6253, '92', '7', 'Fuentes de Magaña', 42),
(6254, '93', '3', 'Fuentestrún', 42),
(6255, '94', '8', 'Garray', 42),
(6256, '95', '1', 'Golmayo', 42),
(6257, '96', '4', 'Gómara', 42),
(6258, '97', '0', 'Gormaz', 42),
(6259, '98', '6', 'Herrera de Soria', 42),
(6260, '100', '3', 'Hinojosa del Campo', 42),
(6261, '103', '1', 'Langa de Duero', 42),
(6262, '105', '9', 'Liceras', 42),
(6263, '106', '2', 'Losilla, La', 42),
(6264, '107', '8', 'Magaña', 42),
(6265, '108', '4', 'Maján', 42),
(6266, '110', '1', 'Matalebreras', 42),
(6267, '111', '8', 'Matamala de Almazán', 42),
(6268, '113', '9', 'Medinaceli', 42),
(6269, '115', '7', 'Miño de Medinaceli', 42),
(6270, '116', '0', 'Miño de San Esteban', 42),
(6271, '117', '6', 'Molinos de Duero', 42),
(6272, '118', '2', 'Momblona', 42),
(6273, '119', '5', 'Monteagudo de las Vicarías', 42),
(6274, '120', '9', 'Montejo de Tiermes', 42),
(6275, '121', '6', 'Montenegro de Cameros', 42),
(6276, '123', '7', 'Morón de Almazán', 42),
(6277, '124', '2', 'Muriel de la Fuente', 42),
(6278, '125', '5', 'Muriel Viejo', 42),
(6279, '127', '4', 'Nafría de Ucero', 42),
(6280, '128', '0', 'Narros', 42),
(6281, '129', '3', 'Navaleno', 42),
(6282, '130', '7', 'Nepas', 42),
(6283, '131', '4', 'Nolay', 42),
(6284, '132', '9', 'Noviercas', 42),
(6285, '134', '0', 'Ólvega', 42),
(6286, '135', '3', 'Oncala', 42),
(6287, '139', '1', 'Pinilla del Campo', 42),
(6288, '140', '5', 'Portillo de Soria', 42),
(6289, '141', '2', 'Póveda de Soria, La', 42),
(6290, '142', '7', 'Pozalmuro', 42),
(6291, '144', '8', 'Quintana Redonda', 42),
(6292, '145', '1', 'Quintanas de Gormaz', 42),
(6293, '148', '6', 'Quiñonería', 42),
(6294, '149', '9', 'Rábanos, Los', 42),
(6295, '151', '9', 'Rebollar', 42),
(6296, '152', '4', 'Recuerda', 42),
(6297, '153', '0', 'Rello', 42),
(6298, '154', '5', 'Renieblas', 42),
(6299, '155', '8', 'Retortillo de Soria', 42),
(6300, '156', '1', 'Reznos', 42),
(6301, '157', '7', 'Riba de Escalote, La', 42),
(6302, '158', '3', 'Rioseco de Soria', 42),
(6303, '159', '6', 'Rollamienta', 42),
(6304, '160', '0', 'Royo, El', 42),
(6305, '161', '7', 'Salduero', 42),
(6306, '162', '2', 'San Esteban de Gormaz', 42),
(6307, '163', '8', 'San Felices', 42),
(6308, '164', '3', 'San Leonardo de Yagüe', 42),
(6309, '165', '6', 'San Pedro Manrique', 42),
(6310, '166', '9', 'Santa Cruz de Yanguas', 42),
(6311, '167', '5', 'Santa María de Huerta', 42),
(6312, '168', '1', 'Santa María de las Hoyas', 42),
(6313, '171', '5', 'Serón de Nágima', 42),
(6314, '172', '0', 'Soliedra', 42),
(6315, '173', '6', 'Soria', 42),
(6316, '174', '1', 'Sotillo del Rincón', 42),
(6317, '175', '4', 'Suellacabras', 42),
(6318, '176', '7', 'Tajahuerce', 42),
(6319, '177', '3', 'Tajueco', 42),
(6320, '178', '9', 'Talveila', 42),
(6321, '181', '3', 'Tardelcuende', 42),
(6322, '182', '8', 'Taroda', 42),
(6323, '183', '4', 'Tejado', 42),
(6324, '184', '9', 'Torlengua', 42),
(6325, '185', '2', 'Torreblacos', 42),
(6326, '187', '1', 'Torrubia de Soria', 42),
(6327, '188', '7', 'Trévago', 42),
(6328, '189', '0', 'Ucero', 42),
(6329, '190', '4', 'Vadillo', 42),
(6330, '191', '1', 'Valdeavellano de Tera', 42),
(6331, '192', '6', 'Valdegeña', 42),
(6332, '193', '2', 'Valdelagua del Cerro', 42),
(6333, '194', '7', 'Valdemaluque', 42),
(6334, '195', '0', 'Valdenebro', 42),
(6335, '196', '3', 'Valdeprado', 42),
(6336, '197', '9', 'Valderrodilla', 42),
(6337, '198', '5', 'Valtajeros', 42),
(6338, '200', '2', 'Velamazán', 42),
(6339, '201', '9', 'Velilla de la Sierra', 42),
(6340, '202', '4', 'Velilla de los Ajos', 42),
(6341, '204', '5', 'Viana de Duero', 42),
(6342, '205', '8', 'Villaciervos', 42),
(6343, '206', '1', 'Villanueva de Gormaz', 42),
(6344, '207', '7', 'Villar del Ala', 42),
(6345, '208', '3', 'Villar del Campo', 42),
(6346, '209', '6', 'Villar del Río', 42),
(6347, '211', '7', 'Villares de Soria, Los', 42),
(6348, '212', '2', 'Villasayas', 42),
(6349, '213', '8', 'Villaseca de Arciel', 42),
(6350, '215', '6', 'Vinuesa', 42),
(6351, '216', '9', 'Vizmanos', 42),
(6352, '217', '5', 'Vozmediano', 42),
(6353, '218', '1', 'Yanguas', 42),
(6354, '219', '4', 'Yelo', 42),
(6355, '1', '7', 'Aiguamúrcia', 43),
(6356, '2', '2', 'Albinyana', 43),
(6357, '3', '8', 'Albiol, L\'', 43),
(6358, '4', '3', 'Alcanar', 43),
(6359, '5', '6', 'Alcover', 43),
(6360, '904', '4', 'Aldea, L\'', 43),
(6361, '6', '9', 'Aldover', 43),
(6362, '7', '5', 'Aleixar, L\'', 43),
(6363, '8', '1', 'Alfara de Carles', 43),
(6364, '9', '4', 'Alforja', 43),
(6365, '10', '8', 'Alió', 43),
(6366, '11', '5', 'Almoster', 43),
(6367, '12', '0', 'Altafulla', 43),
(6368, '13', '6', 'Ametlla de Mar, L\'', 43),
(6369, '906', '0', 'Ampolla, L\'', 43),
(6370, '14', '1', 'Amposta', 43),
(6371, '16', '7', 'Arboç, L\'', 43),
(6372, '15', '4', 'Arbolí', 43),
(6373, '17', '3', 'Argentera, L\'', 43),
(6374, '18', '9', 'Arnes', 43),
(6375, '19', '2', 'Ascó', 43),
(6376, '20', '6', 'Banyeres del Penedès', 43),
(6377, '21', '3', 'Barberà de la Conca', 43),
(6378, '22', '8', 'Batea', 43),
(6379, '23', '4', 'Bellmunt del Priorat', 43),
(6380, '24', '9', 'Bellvei', 43),
(6381, '25', '2', 'Benifallet', 43),
(6382, '26', '5', 'Benissanet', 43),
(6383, '27', '1', 'Bisbal de Falset, La', 43),
(6384, '28', '7', 'Bisbal del Penedès, La', 43),
(6385, '29', '0', 'Blancafort', 43),
(6386, '30', '4', 'Bonastre', 43),
(6387, '31', '1', 'Borges del Camp, Les', 43),
(6388, '32', '6', 'Bot', 43),
(6389, '33', '2', 'Botarell', 43),
(6390, '34', '7', 'Bràfim', 43),
(6391, '35', '0', 'Cabacés', 43),
(6392, '36', '3', 'Cabra del Camp', 43),
(6393, '37', '9', 'Calafell', 43),
(6394, '903', '9', 'Camarles', 43),
(6395, '38', '5', 'Cambrils', 43),
(6396, '907', '6', 'Canonja, La', 43),
(6397, '39', '8', 'Capafonts', 43),
(6398, '40', '2', 'Capçanes', 43),
(6399, '41', '9', 'Caseres', 43),
(6400, '42', '4', 'Castellvell del Camp', 43),
(6401, '43', '0', 'Catllar, El', 43),
(6402, '45', '8', 'Colldejou', 43),
(6403, '46', '1', 'Conesa', 43),
(6404, '47', '7', 'Constantí', 43),
(6405, '48', '3', 'Corbera d\'Ebre', 43),
(6406, '49', '6', 'Cornudella de Montsant', 43),
(6407, '50', '9', 'Creixell', 43),
(6408, '51', '6', 'Cunit', 43),
(6409, '901', '8', 'Deltebre', 43),
(6410, '53', '7', 'Duesaigües', 43),
(6411, '54', '2', 'Espluga de Francolí, L\'', 43),
(6412, '55', '5', 'Falset', 43),
(6413, '56', '8', 'Fatarella, La', 43),
(6414, '57', '4', 'Febró, La', 43),
(6415, '58', '0', 'Figuera, La', 43),
(6416, '59', '3', 'Figuerola del Camp', 43),
(6417, '60', '7', 'Flix', 43),
(6418, '61', '4', 'Forès', 43),
(6419, '62', '9', 'Freginals', 43),
(6420, '63', '5', 'Galera, La', 43),
(6421, '64', '0', 'Gandesa', 43),
(6422, '65', '3', 'Garcia', 43),
(6423, '66', '6', 'Garidells, Els', 43),
(6424, '67', '2', 'Ginestar', 43),
(6425, '68', '8', 'Godall', 43),
(6426, '69', '1', 'Gratallops', 43),
(6427, '70', '5', 'Guiamets, Els', 43),
(6428, '71', '2', 'Horta de Sant Joan', 43),
(6429, '72', '7', 'Lloar, El', 43),
(6430, '73', '3', 'Llorac', 43),
(6431, '74', '8', 'Llorenç del Penedès', 43),
(6432, '76', '4', 'Marçà', 43),
(6433, '75', '1', 'Margalef', 43),
(6434, '77', '0', 'Mas de Barberans', 43),
(6435, '78', '6', 'Masdenverge', 43),
(6436, '79', '9', 'Masllorenç', 43),
(6437, '80', '3', 'Masó, La', 43),
(6438, '81', '0', 'Maspujols', 43),
(6439, '82', '5', 'Masroig, El', 43),
(6440, '83', '1', 'Milà, El', 43),
(6441, '84', '6', 'Miravet', 43),
(6442, '85', '9', 'Molar, El', 43),
(6443, '86', '2', 'Montblanc', 43),
(6444, '88', '4', 'Montbrió del Camp', 43),
(6445, '89', '7', 'Montferri', 43),
(6446, '90', '1', 'Montmell, El', 43),
(6447, '91', '8', 'Mont-ral', 43),
(6448, '92', '3', 'Mont-roig del Camp', 43),
(6449, '93', '9', 'Móra d\'Ebre', 43),
(6450, '94', '4', 'Móra la Nova', 43),
(6451, '95', '7', 'Morell, El', 43),
(6452, '96', '0', 'Morera de Montsant, La', 43),
(6453, '97', '6', 'Nou de Gaià, La', 43),
(6454, '98', '2', 'Nulles', 43),
(6455, '100', '9', 'Pallaresos, Els', 43),
(6456, '99', '5', 'Palma d\'Ebre, La', 43),
(6457, '101', '6', 'Passanant i Belltall', 43),
(6458, '102', '1', 'Paüls', 43),
(6459, '103', '7', 'Perafort', 43),
(6460, '104', '2', 'Perelló, El', 43),
(6461, '105', '5', 'Piles, Les', 43),
(6462, '106', '8', 'Pinell de Brai, El', 43),
(6463, '107', '4', 'Pira', 43),
(6464, '108', '0', 'Pla de Santa Maria, El', 43),
(6465, '109', '3', 'Pobla de Mafumet, La', 43),
(6466, '110', '7', 'Pobla de Massaluca, La', 43),
(6467, '111', '4', 'Pobla de Montornès, La', 43),
(6468, '112', '9', 'Poboleda', 43),
(6469, '113', '5', 'Pont d\'Armentera, El', 43),
(6470, '141', '8', 'Pontils', 43),
(6471, '114', '0', 'Porrera', 43),
(6472, '115', '3', 'Pradell de la Teixeta', 43),
(6473, '116', '6', 'Prades', 43),
(6474, '117', '2', 'Prat de Comte', 43),
(6475, '118', '8', 'Pratdip', 43),
(6476, '119', '1', 'Puigpelat', 43),
(6477, '120', '5', 'Querol', 43),
(6478, '121', '2', 'Rasquera', 43),
(6479, '122', '7', 'Renau', 43),
(6480, '123', '3', 'Reus', 43),
(6481, '124', '8', 'Riba, La', 43),
(6482, '125', '1', 'Riba-roja d\'Ebre', 43),
(6483, '126', '4', 'Riera de Gaià, La', 43),
(6484, '127', '0', 'Riudecanyes', 43),
(6485, '128', '6', 'Riudecols', 43),
(6486, '129', '9', 'Riudoms', 43),
(6487, '130', '3', 'Rocafort de Queralt', 43),
(6488, '131', '0', 'Roda de Berà', 43),
(6489, '132', '5', 'Rodonyà', 43),
(6490, '133', '1', 'Roquetes', 43),
(6491, '134', '6', 'Rourell, El', 43),
(6492, '135', '9', 'Salomó', 43),
(6493, '905', '7', 'Salou', 43),
(6494, '136', '2', 'Sant Carles de la Ràpita', 43),
(6495, '137', '8', 'Sant Jaume dels Domenys', 43),
(6496, '902', '3', 'Sant Jaume d\'Enveja', 43),
(6497, '138', '4', 'Santa Bàrbara', 43),
(6498, '139', '7', 'Santa Coloma de Queralt', 43),
(6499, '140', '1', 'Santa Oliva', 43),
(6500, '142', '3', 'Sarral', 43),
(6501, '143', '9', 'Savallà del Comtat', 43),
(6502, '144', '4', 'Secuita, La', 43),
(6503, '145', '7', 'Selva del Camp, La', 43),
(6504, '146', '0', 'Senan', 43),
(6505, '44', '5', 'Sénia, La', 43),
(6506, '147', '6', 'Solivella', 43),
(6507, '148', '2', 'Tarragona', 43),
(6508, '149', '5', 'Tivenys', 43),
(6509, '150', '8', 'Tivissa', 43),
(6510, '151', '5', 'Torre de Fontaubella, La', 43),
(6511, '152', '0', 'Torre de l\'Espanyol, La', 43),
(6512, '153', '6', 'Torredembarra', 43),
(6513, '154', '1', 'Torroja del Priorat', 43),
(6514, '155', '4', 'Tortosa', 43),
(6515, '156', '7', 'Ulldecona', 43),
(6516, '157', '3', 'Ulldemolins', 43),
(6517, '158', '9', 'Vallclara', 43),
(6518, '159', '2', 'Vallfogona de Riucorb', 43),
(6519, '160', '6', 'Vallmoll', 43),
(6520, '161', '3', 'Valls', 43),
(6521, '162', '8', 'Vandellòs i l\'Hospitalet de l\'Infant', 43),
(6522, '163', '4', 'Vendrell, El', 43),
(6523, '164', '9', 'Vespella de Gaià', 43),
(6524, '165', '2', 'Vilabella', 43),
(6525, '175', '0', 'Vilalba dels Arcs', 43),
(6526, '166', '5', 'Vilallonga del Camp', 43),
(6527, '168', '7', 'Vilanova de Prades', 43),
(6528, '167', '1', 'Vilanova d\'Escornalbou', 43),
(6529, '169', '0', 'Vilaplana', 43),
(6530, '170', '4', 'Vila-rodona', 43),
(6531, '171', '1', 'Vila-seca', 43),
(6532, '172', '6', 'Vilaverd', 43),
(6533, '173', '2', 'Vilella Alta, La', 43),
(6534, '174', '7', 'Vilella Baixa, La', 43),
(6535, '176', '3', 'Vimbodí i Poblet', 43),
(6536, '177', '9', 'Vinebre', 43),
(6537, '178', '5', 'Vinyols i els Arcs', 43),
(6538, '52', '1', 'Xerta', 43),
(6539, '1', '2', 'Ababuj', 44),
(6540, '2', '7', 'Abejuela', 44),
(6541, '3', '3', 'Aguatón', 44),
(6542, '4', '8', 'Aguaviva', 44),
(6543, '5', '1', 'Aguilar del Alfambra', 44),
(6544, '6', '4', 'Alacón', 44),
(6545, '7', '0', 'Alba', 44),
(6546, '8', '6', 'Albalate del Arzobispo', 44),
(6547, '9', '9', 'Albarracín', 44),
(6548, '10', '3', 'Albentosa', 44),
(6549, '11', '0', 'Alcaine', 44),
(6550, '12', '5', 'Alcalá de la Selva', 44),
(6551, '13', '1', 'Alcañiz', 44),
(6552, '14', '6', 'Alcorisa', 44),
(6553, '16', '2', 'Alfambra', 44),
(6554, '17', '8', 'Aliaga', 44),
(6555, '21', '8', 'Allepuz', 44),
(6556, '22', '3', 'Alloza', 44),
(6557, '23', '9', 'Allueva', 44),
(6558, '18', '4', 'Almohaja', 44),
(6559, '19', '7', 'Alobras', 44),
(6560, '20', '1', 'Alpeñés', 44),
(6561, '24', '4', 'Anadón', 44),
(6562, '25', '7', 'Andorra', 44),
(6563, '26', '0', 'Arcos de las Salinas', 44),
(6564, '27', '6', 'Arens de Lledó', 44),
(6565, '28', '2', 'Argente', 44),
(6566, '29', '5', 'Ariño', 44),
(6567, '31', '6', 'Azaila', 44),
(6568, '32', '1', 'Bádenas', 44),
(6569, '33', '7', 'Báguena', 44),
(6570, '34', '2', 'Bañón', 44),
(6571, '35', '5', 'Barrachina', 44),
(6572, '36', '8', 'Bea', 44),
(6573, '37', '4', 'Beceite', 44),
(6574, '39', '3', 'Bello', 44),
(6575, '38', '0', 'Belmonte de San José', 44),
(6576, '40', '7', 'Berge', 44),
(6577, '41', '4', 'Bezas', 44),
(6578, '42', '9', 'Blancas', 44),
(6579, '43', '5', 'Blesa', 44),
(6580, '44', '0', 'Bordón', 44),
(6581, '45', '3', 'Bronchales', 44),
(6582, '46', '6', 'Bueña', 44),
(6583, '47', '2', 'Burbáguena', 44),
(6584, '48', '8', 'Cabra de Mora', 44),
(6585, '49', '1', 'Calaceite', 44),
(6586, '50', '4', 'Calamocha', 44),
(6587, '51', '1', 'Calanda', 44),
(6588, '52', '6', 'Calomarde', 44),
(6589, '53', '2', 'Camañas', 44),
(6590, '54', '7', 'Camarena de la Sierra', 44),
(6591, '55', '0', 'Camarillas', 44),
(6592, '56', '3', 'Caminreal', 44),
(6593, '59', '8', 'Cantavieja', 44),
(6594, '60', '2', 'Cañada de Benatanduz', 44),
(6595, '61', '9', 'Cañada de Verich, La', 44),
(6596, '62', '4', 'Cañada Vellida', 44),
(6597, '63', '0', 'Cañizar del Olivar', 44),
(6598, '64', '5', 'Cascante del Río', 44),
(6599, '65', '8', 'Castejón de Tornos', 44),
(6600, '66', '1', 'Castel de Cabra', 44),
(6601, '70', '0', 'Castellar, El', 44),
(6602, '71', '7', 'Castellote', 44),
(6603, '67', '7', 'Castelnou', 44),
(6604, '68', '3', 'Castelserás', 44),
(6605, '74', '3', 'Cedrillas', 44),
(6606, '75', '6', 'Celadas', 44),
(6607, '76', '9', 'Cella', 44),
(6608, '77', '5', 'Cerollera, La', 44),
(6609, '80', '8', 'Codoñera, La', 44),
(6610, '82', '0', 'Corbalán', 44),
(6611, '84', '1', 'Cortes de Aragón', 44),
(6612, '85', '4', 'Cosa', 44),
(6613, '86', '7', 'Cretas', 44),
(6614, '87', '3', 'Crivillén', 44),
(6615, '88', '9', 'Cuba, La', 44),
(6616, '89', '2', 'Cubla', 44),
(6617, '90', '6', 'Cucalón', 44),
(6618, '92', '8', 'Cuervo, El', 44),
(6619, '93', '4', 'Cuevas de Almudén', 44),
(6620, '94', '9', 'Cuevas Labradas', 44),
(6621, '96', '5', 'Ejulve', 44),
(6622, '97', '1', 'Escorihuela', 44),
(6623, '99', '0', 'Escucha', 44),
(6624, '100', '4', 'Estercuel', 44),
(6625, '101', '1', 'Ferreruela de Huerva', 44),
(6626, '102', '6', 'Fonfría', 44),
(6627, '103', '2', 'Formiche Alto', 44),
(6628, '105', '0', 'Fórnoles', 44),
(6629, '106', '3', 'Fortanete', 44),
(6630, '107', '9', 'Foz-Calanda', 44),
(6631, '108', '5', 'Fresneda, La', 44),
(6632, '109', '8', 'Frías de Albarracín', 44),
(6633, '110', '2', 'Fuenferrada', 44),
(6634, '111', '9', 'Fuentes Calientes', 44),
(6635, '112', '4', 'Fuentes Claras', 44),
(6636, '113', '0', 'Fuentes de Rubielos', 44),
(6637, '114', '5', 'Fuentespalda', 44),
(6638, '115', '8', 'Galve', 44),
(6639, '116', '1', 'Gargallo', 44),
(6640, '117', '7', 'Gea de Albarracín', 44),
(6641, '118', '3', 'Ginebrosa, La', 44),
(6642, '119', '6', 'Griegos', 44),
(6643, '120', '0', 'Guadalaviar', 44),
(6644, '121', '7', 'Gúdar', 44),
(6645, '122', '2', 'Híjar', 44),
(6646, '123', '8', 'Hinojosa de Jarque', 44),
(6647, '124', '3', 'Hoz de la Vieja, La', 44),
(6648, '125', '6', 'Huesa del Común', 44),
(6649, '126', '9', 'Iglesuela del Cid, La', 44),
(6650, '127', '5', 'Jabaloyas', 44),
(6651, '128', '1', 'Jarque de la Val', 44),
(6652, '129', '4', 'Jatiel', 44),
(6653, '130', '8', 'Jorcas', 44),
(6654, '131', '5', 'Josa', 44),
(6655, '132', '0', 'Lagueruela', 44),
(6656, '133', '6', 'Lanzuela', 44),
(6657, '135', '4', 'Libros', 44),
(6658, '136', '7', 'Lidón', 44),
(6659, '137', '3', 'Linares de Mora', 44),
(6660, '141', '3', 'Lledó', 44),
(6661, '138', '9', 'Loscos', 44),
(6662, '142', '8', 'Maicas', 44),
(6663, '143', '4', 'Manzanera', 44),
(6664, '144', '9', 'Martín del Río', 44),
(6665, '145', '2', 'Mas de las Matas', 44),
(6666, '146', '5', 'Mata de los Olmos, La', 44),
(6667, '147', '1', 'Mazaleón', 44),
(6668, '148', '7', 'Mezquita de Jarque', 44),
(6669, '149', '0', 'Mirambel', 44),
(6670, '150', '3', 'Miravete de la Sierra', 44),
(6671, '151', '0', 'Molinos', 44),
(6672, '152', '5', 'Monforte de Moyuela', 44),
(6673, '153', '1', 'Monreal del Campo', 44),
(6674, '154', '6', 'Monroyo', 44),
(6675, '155', '9', 'Montalbán', 44),
(6676, '156', '2', 'Monteagudo del Castillo', 44),
(6677, '157', '8', 'Monterde de Albarracín', 44),
(6678, '158', '4', 'Mora de Rubielos', 44),
(6679, '159', '7', 'Moscardón', 44),
(6680, '160', '1', 'Mosqueruela', 44),
(6681, '161', '8', 'Muniesa', 44),
(6682, '163', '9', 'Noguera de Albarracín', 44);
INSERT INTO `poblaciones` (`id`, `codigo`, `cp`, `poblacion`, `provincia_id`) VALUES
(6683, '164', '4', 'Nogueras', 44),
(6684, '165', '7', 'Nogueruelas', 44),
(6685, '167', '6', 'Obón', 44),
(6686, '168', '2', 'Odón', 44),
(6687, '169', '5', 'Ojos Negros', 44),
(6688, '171', '6', 'Olba', 44),
(6689, '172', '1', 'Oliete', 44),
(6690, '173', '7', 'Olmos, Los', 44),
(6691, '174', '2', 'Orihuela del Tremedal', 44),
(6692, '175', '5', 'Orrios', 44),
(6693, '176', '8', 'Palomar de Arroyos', 44),
(6694, '177', '4', 'Pancrudo', 44),
(6695, '178', '0', 'Parras de Castellote, Las', 44),
(6696, '179', '3', 'Peñarroya de Tastavins', 44),
(6697, '180', '7', 'Peracense', 44),
(6698, '181', '4', 'Peralejos', 44),
(6699, '182', '9', 'Perales del Alfambra', 44),
(6700, '183', '5', 'Pitarque', 44),
(6701, '184', '0', 'Plou', 44),
(6702, '185', '3', 'Pobo, El', 44),
(6703, '187', '2', 'Portellada, La', 44),
(6704, '189', '1', 'Pozondón', 44),
(6705, '190', '5', 'Pozuel del Campo', 44),
(6706, '191', '2', 'Puebla de Híjar, La', 44),
(6707, '192', '7', 'Puebla de Valverde, La', 44),
(6708, '193', '3', 'Puertomingalvo', 44),
(6709, '194', '8', 'Ráfales', 44),
(6710, '195', '1', 'Rillo', 44),
(6711, '196', '4', 'Riodeva', 44),
(6712, '197', '0', 'Ródenas', 44),
(6713, '198', '6', 'Royuela', 44),
(6714, '199', '9', 'Rubiales', 44),
(6715, '200', '3', 'Rubielos de la Cérida', 44),
(6716, '201', '0', 'Rubielos de Mora', 44),
(6717, '203', '1', 'Salcedillo', 44),
(6718, '204', '6', 'Saldón', 44),
(6719, '205', '9', 'Samper de Calanda', 44),
(6720, '206', '2', 'San Agustín', 44),
(6721, '207', '8', 'San Martín del Río', 44),
(6722, '208', '4', 'Santa Cruz de Nogueras', 44),
(6723, '209', '7', 'Santa Eulalia', 44),
(6724, '210', '1', 'Sarrión', 44),
(6725, '211', '8', 'Segura de los Baños', 44),
(6726, '212', '3', 'Seno', 44),
(6727, '213', '9', 'Singra', 44),
(6728, '215', '7', 'Terriente', 44),
(6729, '216', '0', 'Teruel', 44),
(6730, '217', '6', 'Toril y Masegoso', 44),
(6731, '218', '2', 'Tormón', 44),
(6732, '219', '5', 'Tornos', 44),
(6733, '220', '9', 'Torralba de los Sisones', 44),
(6734, '223', '7', 'Torre de Arcas', 44),
(6735, '224', '2', 'Torre de las Arcas', 44),
(6736, '225', '5', 'Torre del Compte', 44),
(6737, '227', '4', 'Torre los Negros', 44),
(6738, '221', '6', 'Torrecilla de Alcañiz', 44),
(6739, '222', '1', 'Torrecilla del Rebollar', 44),
(6740, '226', '8', 'Torrelacárcel', 44),
(6741, '228', '0', 'Torremocha de Jiloca', 44),
(6742, '229', '3', 'Torres de Albarracín', 44),
(6743, '230', '7', 'Torrevelilla', 44),
(6744, '231', '4', 'Torrijas', 44),
(6745, '232', '9', 'Torrijo del Campo', 44),
(6746, '234', '0', 'Tramacastiel', 44),
(6747, '235', '3', 'Tramacastilla', 44),
(6748, '236', '6', 'Tronchón', 44),
(6749, '237', '2', 'Urrea de Gaén', 44),
(6750, '238', '8', 'Utrillas', 44),
(6751, '239', '1', 'Valacloche', 44),
(6752, '240', '5', 'Valbona', 44),
(6753, '241', '2', 'Valdealgorfa', 44),
(6754, '243', '3', 'Valdecuenca', 44),
(6755, '244', '8', 'Valdelinares', 44),
(6756, '245', '1', 'Valdeltormo', 44),
(6757, '246', '4', 'Valderrobres', 44),
(6758, '247', '0', 'Valjunquera', 44),
(6759, '249', '9', 'Vallecillo, El', 44),
(6760, '250', '2', 'Veguillas de la Sierra', 44),
(6761, '251', '9', 'Villafranca del Campo', 44),
(6762, '252', '4', 'Villahermosa del Campo', 44),
(6763, '256', '1', 'Villanueva del Rebollar de la Sierra', 44),
(6764, '257', '7', 'Villar del Cobo', 44),
(6765, '258', '3', 'Villar del Salz', 44),
(6766, '260', '0', 'Villarluengo', 44),
(6767, '261', '7', 'Villarquemado', 44),
(6768, '262', '2', 'Villarroya de los Pinares', 44),
(6769, '263', '8', 'Villastar', 44),
(6770, '264', '3', 'Villel', 44),
(6771, '265', '6', 'Vinaceite', 44),
(6772, '266', '9', 'Visiedo', 44),
(6773, '267', '5', 'Vivel del Río Martín', 44),
(6774, '268', '1', 'Zoma, La', 44),
(6775, '1', '5', 'Ajofrín', 45),
(6776, '2', '0', 'Alameda de la Sagra', 45),
(6777, '3', '6', 'Albarreal de Tajo', 45),
(6778, '4', '1', 'Alcabón', 45),
(6779, '5', '4', 'Alcañizo', 45),
(6780, '6', '7', 'Alcaudete de la Jara', 45),
(6781, '7', '3', 'Alcolea de Tajo', 45),
(6782, '8', '9', 'Aldea en Cabo', 45),
(6783, '9', '2', 'Aldeanueva de Barbarroya', 45),
(6784, '10', '6', 'Aldeanueva de San Bartolomé', 45),
(6785, '11', '3', 'Almendral de la Cañada', 45),
(6786, '12', '8', 'Almonacid de Toledo', 45),
(6787, '13', '4', 'Almorox', 45),
(6788, '14', '9', 'Añover de Tajo', 45),
(6789, '15', '2', 'Arcicóllar', 45),
(6790, '16', '5', 'Argés', 45),
(6791, '17', '1', 'Azután', 45),
(6792, '18', '7', 'Barcience', 45),
(6793, '19', '0', 'Bargas', 45),
(6794, '20', '4', 'Belvís de la Jara', 45),
(6795, '21', '1', 'Borox', 45),
(6796, '22', '6', 'Buenaventura', 45),
(6797, '23', '2', 'Burguillos de Toledo', 45),
(6798, '24', '7', 'Burujón', 45),
(6799, '25', '0', 'Cabañas de la Sagra', 45),
(6800, '26', '3', 'Cabañas de Yepes', 45),
(6801, '27', '9', 'Cabezamesada', 45),
(6802, '28', '5', 'Calera y Chozas', 45),
(6803, '29', '8', 'Caleruela', 45),
(6804, '30', '2', 'Calzada de Oropesa', 45),
(6805, '31', '9', 'Camarena', 45),
(6806, '32', '4', 'Camarenilla', 45),
(6807, '33', '0', 'Campillo de la Jara, El', 45),
(6808, '34', '5', 'Camuñas', 45),
(6809, '35', '8', 'Cardiel de los Montes', 45),
(6810, '36', '1', 'Carmena', 45),
(6811, '37', '7', 'Carpio de Tajo, El', 45),
(6812, '38', '3', 'Carranque', 45),
(6813, '39', '6', 'Carriches', 45),
(6814, '40', '0', 'Casar de Escalona, El', 45),
(6815, '41', '7', 'Casarrubios del Monte', 45),
(6816, '42', '2', 'Casasbuenas', 45),
(6817, '43', '8', 'Castillo de Bayuela', 45),
(6818, '45', '6', 'Cazalegas', 45),
(6819, '46', '9', 'Cebolla', 45),
(6820, '47', '5', 'Cedillo del Condado', 45),
(6821, '48', '1', 'Cerralbos, Los', 45),
(6822, '49', '4', 'Cervera de los Montes', 45),
(6823, '56', '6', 'Chozas de Canales', 45),
(6824, '57', '2', 'Chueca', 45),
(6825, '50', '7', 'Ciruelos', 45),
(6826, '51', '4', 'Cobeja', 45),
(6827, '52', '9', 'Cobisa', 45),
(6828, '53', '5', 'Consuegra', 45),
(6829, '54', '0', 'Corral de Almaguer', 45),
(6830, '55', '3', 'Cuerva', 45),
(6831, '58', '8', 'Domingo Pérez', 45),
(6832, '59', '1', 'Dosbarrios', 45),
(6833, '60', '5', 'Erustes', 45),
(6834, '61', '2', 'Escalona', 45),
(6835, '62', '7', 'Escalonilla', 45),
(6836, '63', '3', 'Espinoso del Rey', 45),
(6837, '64', '8', 'Esquivias', 45),
(6838, '65', '1', 'Estrella, La', 45),
(6839, '66', '4', 'Fuensalida', 45),
(6840, '67', '0', 'Gálvez', 45),
(6841, '68', '6', 'Garciotum', 45),
(6842, '69', '9', 'Gerindote', 45),
(6843, '70', '3', 'Guadamur', 45),
(6844, '71', '0', 'Guardia, La', 45),
(6845, '72', '5', 'Herencias, Las', 45),
(6846, '73', '1', 'Herreruela de Oropesa', 45),
(6847, '74', '6', 'Hinojosa de San Vicente', 45),
(6848, '75', '9', 'Hontanar', 45),
(6849, '76', '2', 'Hormigos', 45),
(6850, '77', '8', 'Huecas', 45),
(6851, '78', '4', 'Huerta de Valdecarábanos', 45),
(6852, '79', '7', 'Iglesuela, La', 45),
(6853, '80', '1', 'Illán de Vacas', 45),
(6854, '81', '8', 'Illescas', 45),
(6855, '82', '3', 'Lagartera', 45),
(6856, '83', '9', 'Layos', 45),
(6857, '84', '4', 'Lillo', 45),
(6858, '85', '7', 'Lominchar', 45),
(6859, '86', '0', 'Lucillos', 45),
(6860, '87', '6', 'Madridejos', 45),
(6861, '88', '2', 'Magán', 45),
(6862, '89', '5', 'Malpica de Tajo', 45),
(6863, '90', '9', 'Manzaneque', 45),
(6864, '91', '6', 'Maqueda', 45),
(6865, '92', '1', 'Marjaliza', 45),
(6866, '93', '7', 'Marrupe', 45),
(6867, '94', '2', 'Mascaraque', 45),
(6868, '95', '5', 'Mata, La', 45),
(6869, '96', '8', 'Mazarambroz', 45),
(6870, '97', '4', 'Mejorada', 45),
(6871, '98', '0', 'Menasalbas', 45),
(6872, '99', '3', 'Méntrida', 45),
(6873, '100', '7', 'Mesegar de Tajo', 45),
(6874, '101', '4', 'Miguel Esteban', 45),
(6875, '102', '9', 'Mocejón', 45),
(6876, '103', '5', 'Mohedas de la Jara', 45),
(6877, '104', '0', 'Montearagón', 45),
(6878, '105', '3', 'Montesclaros', 45),
(6879, '106', '6', 'Mora', 45),
(6880, '107', '2', 'Nambroca', 45),
(6881, '108', '8', 'Nava de Ricomalillo, La', 45),
(6882, '109', '1', 'Navahermosa', 45),
(6883, '110', '5', 'Navalcán', 45),
(6884, '111', '2', 'Navalmoralejo', 45),
(6885, '112', '7', 'Navalmorales, Los', 45),
(6886, '113', '3', 'Navalucillos, Los', 45),
(6887, '114', '8', 'Navamorcuende', 45),
(6888, '115', '1', 'Noblejas', 45),
(6889, '116', '4', 'Noez', 45),
(6890, '117', '0', 'Nombela', 45),
(6891, '118', '6', 'Novés', 45),
(6892, '119', '9', 'Numancia de la Sagra', 45),
(6893, '120', '3', 'Nuño Gómez', 45),
(6894, '121', '0', 'Ocaña', 45),
(6895, '122', '5', 'Olías del Rey', 45),
(6896, '123', '1', 'Ontígola', 45),
(6897, '124', '6', 'Orgaz', 45),
(6898, '125', '9', 'Oropesa', 45),
(6899, '126', '2', 'Otero', 45),
(6900, '127', '8', 'Palomeque', 45),
(6901, '128', '4', 'Pantoja', 45),
(6902, '129', '7', 'Paredes de Escalona', 45),
(6903, '130', '1', 'Parrillas', 45),
(6904, '131', '8', 'Pelahustán', 45),
(6905, '132', '3', 'Pepino', 45),
(6906, '133', '9', 'Polán', 45),
(6907, '134', '4', 'Portillo de Toledo', 45),
(6908, '135', '7', 'Puebla de Almoradiel, La', 45),
(6909, '136', '0', 'Puebla de Montalbán, La', 45),
(6910, '137', '6', 'Pueblanueva, La', 45),
(6911, '138', '2', 'Puente del Arzobispo, El', 45),
(6912, '139', '5', 'Puerto de San Vicente', 45),
(6913, '140', '9', 'Pulgar', 45),
(6914, '141', '6', 'Quero', 45),
(6915, '142', '1', 'Quintanar de la Orden', 45),
(6916, '143', '7', 'Quismondo', 45),
(6917, '144', '2', 'Real de San Vicente, El', 45),
(6918, '145', '5', 'Recas', 45),
(6919, '146', '8', 'Retamoso de la Jara', 45),
(6920, '147', '4', 'Rielves', 45),
(6921, '148', '0', 'Robledo del Mazo', 45),
(6922, '149', '3', 'Romeral, El', 45),
(6923, '150', '6', 'San Bartolomé de las Abiertas', 45),
(6924, '151', '3', 'San Martín de Montalbán', 45),
(6925, '152', '8', 'San Martín de Pusa', 45),
(6926, '153', '4', 'San Pablo de los Montes', 45),
(6927, '154', '9', 'San Román de los Montes', 45),
(6928, '155', '2', 'Santa Ana de Pusa', 45),
(6929, '156', '5', 'Santa Cruz de la Zarza', 45),
(6930, '157', '1', 'Santa Cruz del Retamar', 45),
(6931, '158', '7', 'Santa Olalla', 45),
(6932, '901', '6', 'Santo Domingo-Caudilla', 45),
(6933, '159', '0', 'Sartajada', 45),
(6934, '160', '4', 'Segurilla', 45),
(6935, '161', '1', 'Seseña', 45),
(6936, '162', '6', 'Sevilleja de la Jara', 45),
(6937, '163', '2', 'Sonseca', 45),
(6938, '164', '7', 'Sotillo de las Palomas', 45),
(6939, '165', '0', 'Talavera de la Reina', 45),
(6940, '166', '3', 'Tembleque', 45),
(6941, '167', '9', 'Toboso, El', 45),
(6942, '168', '5', 'Toledo', 45),
(6943, '169', '8', 'Torralba de Oropesa', 45),
(6944, '171', '9', 'Torre de Esteban Hambrán, La', 45),
(6945, '170', '2', 'Torrecilla de la Jara', 45),
(6946, '172', '4', 'Torrico', 45),
(6947, '173', '0', 'Torrijos', 45),
(6948, '174', '5', 'Totanés', 45),
(6949, '175', '8', 'Turleque', 45),
(6950, '176', '1', 'Ugena', 45),
(6951, '177', '7', 'Urda', 45),
(6952, '179', '6', 'Valdeverdeja', 45),
(6953, '180', '0', 'Valmojado', 45),
(6954, '181', '7', 'Velada', 45),
(6955, '182', '2', 'Ventas con Peña Aguilera, Las', 45),
(6956, '183', '8', 'Ventas de Retamosa, Las', 45),
(6957, '184', '3', 'Ventas de San Julián, Las', 45),
(6958, '186', '9', 'Villa de Don Fadrique, La', 45),
(6959, '185', '6', 'Villacañas', 45),
(6960, '187', '5', 'Villafranca de los Caballeros', 45),
(6961, '188', '1', 'Villaluenga de la Sagra', 45),
(6962, '189', '4', 'Villamiel de Toledo', 45),
(6963, '190', '8', 'Villaminaya', 45),
(6964, '191', '5', 'Villamuelas', 45),
(6965, '192', '0', 'Villanueva de Alcardete', 45),
(6966, '193', '6', 'Villanueva de Bogas', 45),
(6967, '194', '1', 'Villarejo de Montalbán', 45),
(6968, '195', '4', 'Villarrubia de Santiago', 45),
(6969, '196', '7', 'Villaseca de la Sagra', 45),
(6970, '197', '3', 'Villasequilla', 45),
(6971, '198', '9', 'Villatobas', 45),
(6972, '199', '2', 'Viso de San Juan, El', 45),
(6973, '200', '6', 'Yébenes, Los', 45),
(6974, '201', '3', 'Yeles', 45),
(6975, '202', '8', 'Yepes', 45),
(6976, '203', '4', 'Yuncler', 45),
(6977, '204', '9', 'Yunclillos', 45),
(6978, '205', '2', 'Yuncos', 45),
(6979, '1', '8', 'Ademuz', 46),
(6980, '2', '3', 'Ador', 46),
(6981, '4', '4', 'Agullent', 46),
(6982, '42', '5', 'Aielo de Malferit', 46),
(6983, '43', '1', 'Aielo de Rugat', 46),
(6984, '5', '7', 'Alaquàs', 46),
(6985, '6', '0', 'Albaida', 46),
(6986, '7', '6', 'Albal', 46),
(6987, '8', '2', 'Albalat de la Ribera', 46),
(6988, '9', '5', 'Albalat dels Sorells', 46),
(6989, '10', '9', 'Albalat dels Tarongers', 46),
(6990, '11', '6', 'Alberic', 46),
(6991, '12', '1', 'Alborache', 46),
(6992, '13', '7', 'Alboraia/Alboraya', 46),
(6993, '14', '2', 'Albuixech', 46),
(6994, '16', '8', 'Alcàntera de Xúquer', 46),
(6995, '15', '5', 'Alcàsser', 46),
(6996, '18', '0', 'Alcublas', 46),
(6997, '20', '7', 'Alcúdia de Crespins, l\'', 46),
(6998, '19', '3', 'Alcúdia, l\'', 46),
(6999, '21', '4', 'Aldaia', 46),
(7000, '22', '9', 'Alfafar', 46),
(7001, '24', '0', 'Alfara de la Baronia', 46),
(7002, '25', '3', 'Alfara del Patriarca', 46),
(7003, '26', '6', 'Alfarp', 46),
(7004, '27', '2', 'Alfarrasí', 46),
(7005, '23', '5', 'Alfauir', 46),
(7006, '28', '8', 'Algar de Palancia', 46),
(7007, '29', '1', 'Algemesí', 46),
(7008, '30', '5', 'Algimia de Alfara', 46),
(7009, '31', '2', 'Alginet', 46),
(7010, '32', '7', 'Almàssera', 46),
(7011, '33', '3', 'Almiserà', 46),
(7012, '34', '8', 'Almoines', 46),
(7013, '35', '1', 'Almussafes', 46),
(7014, '36', '4', 'Alpuente', 46),
(7015, '37', '0', 'Alqueria de la Comtessa, l\'', 46),
(7016, '17', '4', 'Alzira', 46),
(7017, '38', '6', 'Andilla', 46),
(7018, '39', '9', 'Anna', 46),
(7019, '40', '3', 'Antella', 46),
(7020, '41', '0', 'Aras de los Olmos', 46),
(7021, '3', '9', 'Atzeneta d\'Albaida', 46),
(7022, '44', '6', 'Ayora', 46),
(7023, '46', '2', 'Barx', 46),
(7024, '45', '9', 'Barxeta', 46),
(7025, '47', '8', 'Bèlgida', 46),
(7026, '48', '4', 'Bellreguard', 46),
(7027, '49', '7', 'Bellús', 46),
(7028, '50', '0', 'Benagéber', 46),
(7029, '51', '7', 'Benaguasil', 46),
(7030, '52', '2', 'Benavites', 46),
(7031, '53', '8', 'Beneixida', 46),
(7032, '54', '3', 'Benetússer', 46),
(7033, '55', '6', 'Beniarjó', 46),
(7034, '56', '9', 'Beniatjar', 46),
(7035, '57', '5', 'Benicolet', 46),
(7036, '904', '5', 'Benicull de Xúquer', 46),
(7037, '60', '8', 'Benifaió', 46),
(7038, '59', '4', 'Benifairó de la Valldigna', 46),
(7039, '58', '1', 'Benifairó de les Valls', 46),
(7040, '61', '5', 'Beniflá', 46),
(7041, '62', '0', 'Benigànim', 46),
(7042, '63', '6', 'Benimodo', 46),
(7043, '64', '1', 'Benimuslem', 46),
(7044, '65', '4', 'Beniparrell', 46),
(7045, '66', '7', 'Benirredrà', 46),
(7046, '67', '3', 'Benissanó', 46),
(7047, '68', '9', 'Benissoda', 46),
(7048, '69', '2', 'Benissuera', 46),
(7049, '70', '6', 'Bétera', 46),
(7050, '71', '3', 'Bicorp', 46),
(7051, '72', '8', 'Bocairent', 46),
(7052, '73', '4', 'Bolbaite', 46),
(7053, '74', '9', 'Bonrepòs i Mirambell', 46),
(7054, '75', '2', 'Bufali', 46),
(7055, '76', '5', 'Bugarra', 46),
(7056, '77', '1', 'Buñol', 46),
(7057, '78', '7', 'Burjassot', 46),
(7058, '79', '0', 'Calles', 46),
(7059, '80', '4', 'Camporrobles', 46),
(7060, '81', '1', 'Canals', 46),
(7061, '82', '6', 'Canet d\'En Berenguer', 46),
(7062, '83', '2', 'Carcaixent', 46),
(7063, '84', '7', 'Càrcer', 46),
(7064, '85', '0', 'Carlet', 46),
(7065, '86', '3', 'Carrícola', 46),
(7066, '87', '9', 'Casas Altas', 46),
(7067, '88', '5', 'Casas Bajas', 46),
(7068, '89', '8', 'Casinos', 46),
(7069, '90', '2', 'Castelló de Rugat', 46),
(7070, '91', '9', 'Castellonet de la Conquesta', 46),
(7071, '92', '4', 'Castielfabib', 46),
(7072, '93', '0', 'Catadau', 46),
(7073, '94', '5', 'Catarroja', 46),
(7074, '95', '8', 'Caudete de las Fuentes', 46),
(7075, '96', '1', 'Cerdà', 46),
(7076, '107', '5', 'Chella', 46),
(7077, '106', '9', 'Chelva', 46),
(7078, '108', '1', 'Chera', 46),
(7079, '109', '4', 'Cheste', 46),
(7080, '111', '5', 'Chiva', 46),
(7081, '112', '0', 'Chulilla', 46),
(7082, '97', '7', 'Cofrentes', 46),
(7083, '98', '3', 'Corbera', 46),
(7084, '99', '6', 'Cortes de Pallás', 46),
(7085, '100', '0', 'Cotes', 46),
(7086, '105', '6', 'Cullera', 46),
(7087, '113', '6', 'Daimús', 46),
(7088, '114', '1', 'Domeño', 46),
(7089, '115', '4', 'Dos Aguas', 46),
(7090, '116', '7', 'Eliana, l\'', 46),
(7091, '117', '3', 'Emperador', 46),
(7092, '118', '9', 'Enguera', 46),
(7093, '119', '2', 'Ènova, l\'', 46),
(7094, '120', '6', 'Estivella', 46),
(7095, '121', '3', 'Estubeny', 46),
(7096, '122', '8', 'Faura', 46),
(7097, '123', '4', 'Favara', 46),
(7098, '126', '5', 'Foios', 46),
(7099, '128', '7', 'Font de la Figuera, la', 46),
(7100, '127', '1', 'Font d\'En Carròs, la', 46),
(7101, '124', '9', 'Fontanars dels Alforins', 46),
(7102, '125', '2', 'Fortaleny', 46),
(7103, '129', '0', 'Fuenterrobles', 46),
(7104, '131', '1', 'Gandia', 46),
(7105, '902', '4', 'Gátova', 46),
(7106, '130', '4', 'Gavarda', 46),
(7107, '132', '6', 'Genovés', 46),
(7108, '133', '2', 'Gestalgar', 46),
(7109, '134', '7', 'Gilet', 46),
(7110, '135', '0', 'Godella', 46),
(7111, '136', '3', 'Godelleta', 46),
(7112, '137', '9', 'Granja de la Costera, la', 46),
(7113, '138', '5', 'Guadasséquies', 46),
(7114, '139', '8', 'Guadassuar', 46),
(7115, '140', '2', 'Guardamar de la Safor', 46),
(7116, '141', '9', 'Higueruelas', 46),
(7117, '142', '4', 'Jalance', 46),
(7118, '144', '5', 'Jarafuel', 46),
(7119, '154', '2', 'Llanera de Ranes', 46),
(7120, '155', '5', 'Llaurí', 46),
(7121, '147', '7', 'Llíria', 46),
(7122, '152', '1', 'Llocnou de la Corona', 46),
(7123, '153', '7', 'Llocnou de Sant Jeroni', 46),
(7124, '151', '6', 'Llocnou d\'En Fenollet', 46),
(7125, '156', '8', 'Llombai', 46),
(7126, '157', '4', 'Llosa de Ranes, la', 46),
(7127, '150', '9', 'Llutxent', 46),
(7128, '148', '3', 'Loriguilla', 46),
(7129, '149', '6', 'Losa del Obispo', 46),
(7130, '158', '0', 'Macastre', 46),
(7131, '159', '3', 'Manises', 46),
(7132, '160', '7', 'Manuel', 46),
(7133, '161', '4', 'Marines', 46),
(7134, '162', '9', 'Massalavés', 46),
(7135, '163', '5', 'Massalfassar', 46),
(7136, '164', '0', 'Massamagrell', 46),
(7137, '165', '3', 'Massanassa', 46),
(7138, '166', '6', 'Meliana', 46),
(7139, '167', '2', 'Millares', 46),
(7140, '168', '8', 'Miramar', 46),
(7141, '169', '1', 'Mislata', 46),
(7142, '170', '5', 'Mogente/Moixent', 46),
(7143, '171', '2', 'Moncada', 46),
(7144, '173', '3', 'Montaverner', 46),
(7145, '174', '8', 'Montesa', 46),
(7146, '175', '1', 'Montitxelvo/Montichelvo', 46),
(7147, '176', '4', 'Montroi/Montroy', 46),
(7148, '172', '7', 'Montserrat', 46),
(7149, '177', '0', 'Museros', 46),
(7150, '178', '6', 'Náquera', 46),
(7151, '179', '9', 'Navarrés', 46),
(7152, '180', '3', 'Novelé/Novetlè', 46),
(7153, '181', '0', 'Oliva', 46),
(7154, '183', '1', 'Olleria, l\'', 46),
(7155, '182', '5', 'Olocau', 46),
(7156, '184', '6', 'Ontinyent', 46),
(7157, '185', '9', 'Otos', 46),
(7158, '186', '2', 'Paiporta', 46),
(7159, '187', '8', 'Palma de Gandía', 46),
(7160, '188', '4', 'Palmera', 46),
(7161, '189', '7', 'Palomar, el', 46),
(7162, '190', '1', 'Paterna', 46),
(7163, '191', '8', 'Pedralba', 46),
(7164, '192', '3', 'Petrés', 46),
(7165, '193', '9', 'Picanya', 46),
(7166, '194', '4', 'Picassent', 46),
(7167, '195', '7', 'Piles', 46),
(7168, '196', '0', 'Pinet', 46),
(7169, '199', '5', 'Pobla de Farnals, la', 46),
(7170, '202', '1', 'Pobla de Vallbona, la', 46),
(7171, '200', '9', 'Pobla del Duc, la', 46),
(7172, '203', '7', 'Pobla Llarga, la', 46),
(7173, '197', '6', 'Polinyà de Xúquer', 46),
(7174, '198', '2', 'Potries', 46),
(7175, '205', '5', 'Puçol', 46),
(7176, '201', '6', 'Puebla de San Miguel', 46),
(7177, '204', '2', 'Puig de Santa Maria, el', 46),
(7178, '101', '7', 'Quart de les Valls', 46),
(7179, '102', '2', 'Quart de Poblet', 46),
(7180, '103', '8', 'Quartell', 46),
(7181, '104', '3', 'Quatretonda', 46),
(7182, '206', '8', 'Quesa', 46),
(7183, '207', '4', 'Rafelbunyol', 46),
(7184, '208', '0', 'Rafelcofer', 46),
(7185, '209', '3', 'Rafelguaraf', 46),
(7186, '210', '7', 'Ráfol de Salem', 46),
(7187, '212', '9', 'Real', 46),
(7188, '211', '4', 'Real de Gandia, el', 46),
(7189, '213', '5', 'Requena', 46),
(7190, '214', '0', 'Riba-roja de Túria', 46),
(7191, '215', '3', 'Riola', 46),
(7192, '216', '6', 'Rocafort', 46),
(7193, '217', '2', 'Rotglà i Corberà', 46),
(7194, '218', '8', 'Rótova', 46),
(7195, '219', '1', 'Rugat', 46),
(7196, '220', '5', 'Sagunto/Sagunt', 46),
(7197, '221', '2', 'Salem', 46),
(7198, '903', '0', 'San Antonio de Benagéber', 46),
(7199, '222', '7', 'Sant Joanet', 46),
(7200, '223', '3', 'Sedaví', 46),
(7201, '224', '8', 'Segart', 46),
(7202, '225', '1', 'Sellent', 46),
(7203, '226', '4', 'Sempere', 46),
(7204, '227', '0', 'Senyera', 46),
(7205, '228', '6', 'Serra', 46),
(7206, '229', '9', 'Siete Aguas', 46),
(7207, '230', '3', 'Silla', 46),
(7208, '231', '0', 'Simat de la Valldigna', 46),
(7209, '232', '5', 'Sinarcas', 46),
(7210, '233', '1', 'Sollana', 46),
(7211, '234', '6', 'Sot de Chera', 46),
(7212, '235', '9', 'Sueca', 46),
(7213, '236', '2', 'Sumacàrcer', 46),
(7214, '237', '8', 'Tavernes Blanques', 46),
(7215, '238', '4', 'Tavernes de la Valldigna', 46),
(7216, '239', '7', 'Teresa de Cofrentes', 46),
(7217, '240', '1', 'Terrateig', 46),
(7218, '241', '8', 'Titaguas', 46),
(7219, '242', '3', 'Torrebaja', 46),
(7220, '243', '9', 'Torrella', 46),
(7221, '244', '4', 'Torrent', 46),
(7222, '245', '7', 'Torres Torres', 46),
(7223, '246', '0', 'Tous', 46),
(7224, '247', '6', 'Tuéjar', 46),
(7225, '248', '2', 'Turís', 46),
(7226, '249', '5', 'Utiel', 46),
(7227, '250', '8', 'Valencia', 46),
(7228, '251', '5', 'Vallada', 46),
(7229, '252', '0', 'Vallanca', 46),
(7230, '253', '6', 'Vallés', 46),
(7231, '254', '1', 'Venta del Moro', 46),
(7232, '255', '4', 'Vilallonga/Villalonga', 46),
(7233, '256', '7', 'Vilamarxant', 46),
(7234, '257', '3', 'Villanueva de Castellón', 46),
(7235, '258', '9', 'Villar del Arzobispo', 46),
(7236, '259', '2', 'Villargordo del Cabriel', 46),
(7237, '260', '6', 'Vinalesa', 46),
(7238, '145', '8', 'Xàtiva', 46),
(7239, '143', '0', 'Xeraco', 46),
(7240, '146', '1', 'Xeresa', 46),
(7241, '110', '8', 'Xirivella', 46),
(7242, '261', '3', 'Yátova', 46),
(7243, '262', '8', 'Yesa, La', 46),
(7244, '263', '4', 'Zarra', 46),
(7245, '1', '4', 'Adalia', 47),
(7246, '2', '9', 'Aguasal', 47),
(7247, '3', '5', 'Aguilar de Campos', 47),
(7248, '4', '0', 'Alaejos', 47),
(7249, '5', '3', 'Alcazarén', 47),
(7250, '6', '6', 'Aldea de San Miguel', 47),
(7251, '7', '2', 'Aldeamayor de San Martín', 47),
(7252, '8', '8', 'Almenara de Adaja', 47),
(7253, '9', '1', 'Amusquillo', 47),
(7254, '10', '5', 'Arroyo de la Encomienda', 47),
(7255, '11', '2', 'Ataquines', 47),
(7256, '12', '7', 'Bahabón', 47),
(7257, '13', '3', 'Barcial de la Loma', 47),
(7258, '14', '8', 'Barruelo del Valle', 47),
(7259, '15', '1', 'Becilla de Valderaduey', 47),
(7260, '16', '4', 'Benafarces', 47),
(7261, '17', '0', 'Bercero', 47),
(7262, '18', '6', 'Berceruelo', 47),
(7263, '19', '9', 'Berrueces', 47),
(7264, '20', '3', 'Bobadilla del Campo', 47),
(7265, '21', '0', 'Bocigas', 47),
(7266, '22', '5', 'Bocos de Duero', 47),
(7267, '23', '1', 'Boecillo', 47),
(7268, '24', '6', 'Bolaños de Campos', 47),
(7269, '25', '9', 'Brahojos de Medina', 47),
(7270, '26', '2', 'Bustillo de Chaves', 47),
(7271, '27', '8', 'Cabezón de Pisuerga', 47),
(7272, '28', '4', 'Cabezón de Valderaduey', 47),
(7273, '29', '7', 'Cabreros del Monte', 47),
(7274, '30', '1', 'Campaspero', 47),
(7275, '31', '8', 'Campillo, El', 47),
(7276, '32', '3', 'Camporredondo', 47),
(7277, '33', '9', 'Canalejas de Peñafiel', 47),
(7278, '34', '4', 'Canillas de Esgueva', 47),
(7279, '35', '7', 'Carpio', 47),
(7280, '36', '0', 'Casasola de Arión', 47),
(7281, '37', '6', 'Castrejón de Trabancos', 47),
(7282, '38', '2', 'Castrillo de Duero', 47),
(7283, '39', '5', 'Castrillo-Tejeriego', 47),
(7284, '40', '9', 'Castrobol', 47),
(7285, '41', '6', 'Castrodeza', 47),
(7286, '42', '1', 'Castromembibre', 47),
(7287, '43', '7', 'Castromonte', 47),
(7288, '44', '2', 'Castronuevo de Esgueva', 47),
(7289, '45', '5', 'Castronuño', 47),
(7290, '46', '8', 'Castroponce', 47),
(7291, '47', '4', 'Castroverde de Cerrato', 47),
(7292, '48', '0', 'Ceinos de Campos', 47),
(7293, '49', '3', 'Cervillego de la Cruz', 47),
(7294, '50', '6', 'Cigales', 47),
(7295, '51', '3', 'Ciguñuela', 47),
(7296, '52', '8', 'Cistérniga', 47),
(7297, '53', '4', 'Cogeces de Íscar', 47),
(7298, '54', '9', 'Cogeces del Monte', 47),
(7299, '55', '2', 'Corcos', 47),
(7300, '56', '5', 'Corrales de Duero', 47),
(7301, '57', '1', 'Cubillas de Santa Marta', 47),
(7302, '58', '7', 'Cuenca de Campos', 47),
(7303, '59', '0', 'Curiel de Duero', 47),
(7304, '60', '4', 'Encinas de Esgueva', 47),
(7305, '61', '1', 'Esguevillas de Esgueva', 47),
(7306, '62', '6', 'Fombellida', 47),
(7307, '63', '2', 'Fompedraza', 47),
(7308, '64', '7', 'Fontihoyuelo', 47),
(7309, '65', '0', 'Fresno el Viejo', 47),
(7310, '66', '3', 'Fuensaldaña', 47),
(7311, '67', '9', 'Fuente el Sol', 47),
(7312, '68', '5', 'Fuente-Olmedo', 47),
(7313, '69', '8', 'Gallegos de Hornija', 47),
(7314, '70', '2', 'Gatón de Campos', 47),
(7315, '71', '9', 'Geria', 47),
(7316, '73', '0', 'Herrín de Campos', 47),
(7317, '74', '5', 'Hornillos de Eresma', 47),
(7318, '75', '8', 'Íscar', 47),
(7319, '76', '1', 'Laguna de Duero', 47),
(7320, '77', '7', 'Langayo', 47),
(7321, '79', '6', 'Llano de Olmedo', 47),
(7322, '78', '3', 'Lomoviejo', 47),
(7323, '80', '0', 'Manzanillo', 47),
(7324, '81', '7', 'Marzales', 47),
(7325, '82', '2', 'Matapozuelos', 47),
(7326, '83', '8', 'Matilla de los Caños', 47),
(7327, '84', '3', 'Mayorga', 47),
(7328, '86', '9', 'Medina de Rioseco', 47),
(7329, '85', '6', 'Medina del Campo', 47),
(7330, '87', '5', 'Megeces', 47),
(7331, '88', '1', 'Melgar de Abajo', 47),
(7332, '89', '4', 'Melgar de Arriba', 47),
(7333, '90', '8', 'Mojados', 47),
(7334, '91', '5', 'Monasterio de Vega', 47),
(7335, '92', '0', 'Montealegre de Campos', 47),
(7336, '93', '6', 'Montemayor de Pililla', 47),
(7337, '94', '1', 'Moral de la Reina', 47),
(7338, '95', '4', 'Moraleja de las Panaderas', 47),
(7339, '96', '7', 'Morales de Campos', 47),
(7340, '97', '3', 'Mota del Marqués', 47),
(7341, '98', '9', 'Mucientes', 47),
(7342, '99', '2', 'Mudarra, La', 47),
(7343, '100', '6', 'Muriel', 47),
(7344, '101', '3', 'Nava del Rey', 47),
(7345, '102', '8', 'Nueva Villa de las Torres', 47),
(7346, '103', '4', 'Olivares de Duero', 47),
(7347, '104', '9', 'Olmedo', 47),
(7348, '105', '2', 'Olmos de Esgueva', 47),
(7349, '106', '5', 'Olmos de Peñafiel', 47),
(7350, '109', '0', 'Palazuelo de Vedija', 47),
(7351, '110', '4', 'Parrilla, La', 47),
(7352, '111', '1', 'Pedraja de Portillo, La', 47),
(7353, '112', '6', 'Pedrajas de San Esteban', 47),
(7354, '113', '2', 'Pedrosa del Rey', 47),
(7355, '114', '7', 'Peñafiel', 47),
(7356, '115', '0', 'Peñaflor de Hornija', 47),
(7357, '116', '3', 'Pesquera de Duero', 47),
(7358, '117', '9', 'Piña de Esgueva', 47),
(7359, '118', '5', 'Piñel de Abajo', 47),
(7360, '119', '8', 'Piñel de Arriba', 47),
(7361, '121', '9', 'Pollos', 47),
(7362, '122', '4', 'Portillo', 47),
(7363, '123', '0', 'Pozal de Gallinas', 47),
(7364, '124', '5', 'Pozaldez', 47),
(7365, '125', '8', 'Pozuelo de la Orden', 47),
(7366, '126', '1', 'Puras', 47),
(7367, '127', '7', 'Quintanilla de Arriba', 47),
(7368, '129', '6', 'Quintanilla de Onésimo', 47),
(7369, '130', '0', 'Quintanilla de Trigueros', 47),
(7370, '128', '3', 'Quintanilla del Molar', 47),
(7371, '131', '7', 'Rábano', 47),
(7372, '132', '2', 'Ramiro', 47),
(7373, '133', '8', 'Renedo de Esgueva', 47),
(7374, '134', '3', 'Roales de Campos', 47),
(7375, '135', '6', 'Robladillo', 47),
(7376, '137', '5', 'Roturas', 47),
(7377, '138', '1', 'Rubí de Bracamonte', 47),
(7378, '139', '4', 'Rueda', 47),
(7379, '140', '8', 'Saelices de Mayorga', 47),
(7380, '141', '5', 'Salvador de Zapardiel', 47),
(7381, '142', '0', 'San Cebrián de Mazote', 47),
(7382, '143', '6', 'San Llorente', 47),
(7383, '144', '1', 'San Martín de Valvení', 47),
(7384, '145', '4', 'San Miguel del Arroyo', 47),
(7385, '146', '7', 'San Miguel del Pino', 47),
(7386, '147', '3', 'San Pablo de la Moraleja', 47),
(7387, '148', '9', 'San Pedro de Latarce', 47),
(7388, '149', '2', 'San Pelayo', 47),
(7389, '150', '5', 'San Román de Hornija', 47),
(7390, '151', '2', 'San Salvador', 47),
(7391, '156', '4', 'San Vicente del Palacio', 47),
(7392, '152', '7', 'Santa Eufemia del Arroyo', 47),
(7393, '153', '3', 'Santervás de Campos', 47),
(7394, '154', '8', 'Santibáñez de Valcorba', 47),
(7395, '155', '1', 'Santovenia de Pisuerga', 47),
(7396, '157', '0', 'Sardón de Duero', 47),
(7397, '158', '6', 'Seca, La', 47),
(7398, '159', '9', 'Serrada', 47),
(7399, '160', '3', 'Siete Iglesias de Trabancos', 47),
(7400, '161', '0', 'Simancas', 47),
(7401, '162', '5', 'Tamariz de Campos', 47),
(7402, '163', '1', 'Tiedra', 47),
(7403, '164', '6', 'Tordehumos', 47),
(7404, '165', '9', 'Tordesillas', 47),
(7405, '169', '7', 'Torre de Esgueva', 47),
(7406, '170', '1', 'Torre de Peñafiel', 47),
(7407, '166', '2', 'Torrecilla de la Abadesa', 47),
(7408, '167', '8', 'Torrecilla de la Orden', 47),
(7409, '168', '4', 'Torrecilla de la Torre', 47),
(7410, '171', '8', 'Torrelobatón', 47),
(7411, '172', '3', 'Torrescárcela', 47),
(7412, '173', '9', 'Traspinedo', 47),
(7413, '174', '4', 'Trigueros del Valle', 47),
(7414, '175', '7', 'Tudela de Duero', 47),
(7415, '176', '0', 'Unión de Campos, La', 47),
(7416, '177', '6', 'Urones de Castroponce', 47),
(7417, '178', '2', 'Urueña', 47),
(7418, '179', '5', 'Valbuena de Duero', 47),
(7419, '180', '9', 'Valdearcos de la Vega', 47),
(7420, '181', '6', 'Valdenebro de los Valles', 47),
(7421, '182', '1', 'Valdestillas', 47),
(7422, '183', '7', 'Valdunquillo', 47),
(7423, '186', '8', 'Valladolid', 47),
(7424, '184', '2', 'Valoria la Buena', 47),
(7425, '185', '5', 'Valverde de Campos', 47),
(7426, '187', '4', 'Vega de Ruiponce', 47),
(7427, '188', '0', 'Vega de Valdetronco', 47),
(7428, '189', '3', 'Velascálvaro', 47),
(7429, '190', '7', 'Velilla', 47),
(7430, '191', '4', 'Velliza', 47),
(7431, '192', '9', 'Ventosa de la Cuesta', 47),
(7432, '193', '5', 'Viana de Cega', 47),
(7433, '195', '3', 'Villabáñez', 47),
(7434, '196', '6', 'Villabaruz de Campos', 47),
(7435, '197', '2', 'Villabrágima', 47),
(7436, '198', '8', 'Villacarralón', 47),
(7437, '199', '1', 'Villacid de Campos', 47),
(7438, '200', '5', 'Villaco', 47),
(7439, '203', '3', 'Villafrades de Campos', 47),
(7440, '204', '8', 'Villafranca de Duero', 47),
(7441, '205', '1', 'Villafrechós', 47),
(7442, '206', '4', 'Villafuerte', 47),
(7443, '207', '0', 'Villagarcía de Campos', 47),
(7444, '208', '6', 'Villagómez la Nueva', 47),
(7445, '209', '9', 'Villalán de Campos', 47),
(7446, '210', '3', 'Villalar de los Comuneros', 47),
(7447, '211', '0', 'Villalba de la Loma', 47),
(7448, '212', '5', 'Villalba de los Alcores', 47),
(7449, '213', '1', 'Villalbarba', 47),
(7450, '214', '6', 'Villalón de Campos', 47),
(7451, '215', '9', 'Villamuriel de Campos', 47),
(7452, '216', '2', 'Villán de Tordesillas', 47),
(7453, '217', '8', 'Villanubla', 47),
(7454, '218', '4', 'Villanueva de Duero', 47),
(7455, '219', '7', 'Villanueva de la Condesa', 47),
(7456, '220', '1', 'Villanueva de los Caballeros', 47),
(7457, '221', '8', 'Villanueva de los Infantes', 47),
(7458, '222', '3', 'Villanueva de San Mancio', 47),
(7459, '223', '9', 'Villardefrades', 47),
(7460, '224', '4', 'Villarmentero de Esgueva', 47),
(7461, '225', '7', 'Villasexmir', 47),
(7462, '226', '0', 'Villavaquerín', 47),
(7463, '227', '6', 'Villavellid', 47),
(7464, '228', '2', 'Villaverde de Medina', 47),
(7465, '229', '5', 'Villavicencio de los Caballeros', 47),
(7466, '194', '0', 'Viloria', 47),
(7467, '230', '9', 'Wamba', 47),
(7468, '231', '6', 'Zaratán', 47),
(7469, '232', '1', 'Zarza, La', 47),
(7470, '1', '0', 'Abadiño', 48),
(7471, '2', '5', 'Abanto y Ciérvana-Abanto Zierbena', 48),
(7472, '911', '9', 'Ajangiz', 48),
(7473, '912', '4', 'Alonsotegi', 48),
(7474, '3', '1', 'Amorebieta-Etxano', 48),
(7475, '4', '6', 'Amoroto', 48),
(7476, '5', '9', 'Arakaldo', 48),
(7477, '6', '2', 'Arantzazu', 48),
(7478, '93', '2', 'Areatza', 48),
(7479, '9', '7', 'Arrankudiaga', 48),
(7480, '914', '5', 'Arratzu', 48),
(7481, '10', '1', 'Arrieta', 48),
(7482, '11', '8', 'Arrigorriaga', 48),
(7483, '23', '7', 'Artea', 48),
(7484, '8', '4', 'Artzentales', 48),
(7485, '91', '1', 'Atxondo', 48),
(7486, '70', '8', 'Aulesti', 48),
(7487, '12', '3', 'Bakio', 48),
(7488, '90', '4', 'Balmaseda', 48),
(7489, '13', '9', 'Barakaldo', 48),
(7490, '14', '4', 'Barrika', 48),
(7491, '15', '7', 'Basauri', 48),
(7492, '92', '6', 'Bedia', 48),
(7493, '16', '0', 'Berango', 48),
(7494, '17', '6', 'Bermeo', 48),
(7495, '18', '2', 'Berriatua', 48),
(7496, '19', '5', 'Berriz', 48),
(7497, '20', '9', 'Bilbao', 48),
(7498, '21', '6', 'Busturia', 48),
(7499, '901', '1', 'Derio', 48),
(7500, '26', '8', 'Dima', 48),
(7501, '27', '4', 'Durango', 48),
(7502, '28', '0', 'Ea', 48),
(7503, '31', '4', 'Elantxobe', 48),
(7504, '32', '9', 'Elorrio', 48),
(7505, '902', '6', 'Erandio', 48),
(7506, '33', '5', 'Ereño', 48),
(7507, '34', '0', 'Ermua', 48),
(7508, '79', '2', 'Errigoiti', 48),
(7509, '29', '3', 'Etxebarri', 48),
(7510, '30', '7', 'Etxebarria', 48),
(7511, '906', '3', 'Forua', 48),
(7512, '35', '3', 'Fruiz', 48),
(7513, '36', '6', 'Galdakao', 48),
(7514, '37', '2', 'Galdames', 48),
(7515, '38', '8', 'Gamiz-Fika', 48),
(7516, '39', '1', 'Garai', 48),
(7517, '40', '5', 'Gatika', 48),
(7518, '41', '2', 'Gautegiz Arteaga', 48),
(7519, '46', '4', 'Gernika-Lumo', 48),
(7520, '44', '8', 'Getxo', 48),
(7521, '47', '0', 'Gizaburuaga', 48),
(7522, '42', '7', 'Gordexola', 48),
(7523, '43', '3', 'Gorliz', 48),
(7524, '45', '1', 'Güeñes', 48),
(7525, '48', '6', 'Ibarrangelu', 48),
(7526, '94', '7', 'Igorre', 48),
(7527, '49', '9', 'Ispaster', 48),
(7528, '910', '2', 'Iurreta', 48),
(7529, '50', '2', 'Izurtza', 48),
(7530, '22', '1', 'Karrantza Harana/Valle de Carranza', 48),
(7531, '907', '9', 'Kortezubi', 48),
(7532, '51', '9', 'Lanestosa', 48),
(7533, '52', '4', 'Larrabetzu', 48),
(7534, '53', '0', 'Laukiz', 48),
(7535, '54', '5', 'Leioa', 48),
(7536, '57', '7', 'Lekeitio', 48),
(7537, '55', '8', 'Lemoa', 48),
(7538, '56', '1', 'Lemoiz', 48),
(7539, '81', '3', 'Lezama', 48),
(7540, '903', '2', 'Loiu', 48),
(7541, '58', '3', 'Mallabia', 48),
(7542, '59', '6', 'Mañaria', 48),
(7543, '60', '0', 'Markina-Xemein', 48),
(7544, '61', '7', 'Maruri-Jatabe', 48),
(7545, '62', '2', 'Mendata', 48),
(7546, '63', '8', 'Mendexa', 48),
(7547, '64', '3', 'Meñaka', 48),
(7548, '66', '9', 'Morga', 48),
(7549, '68', '1', 'Mundaka', 48),
(7550, '69', '4', 'Mungia', 48),
(7551, '7', '8', 'Munitibar-Arbatzegi Gerrikaitz', 48),
(7552, '908', '5', 'Murueta', 48),
(7553, '71', '5', 'Muskiz', 48),
(7554, '67', '5', 'Muxika', 48),
(7555, '909', '8', 'Nabarniz', 48),
(7556, '73', '6', 'Ondarroa', 48),
(7557, '75', '4', 'Orozko', 48),
(7558, '83', '4', 'Ortuella', 48),
(7559, '72', '0', 'Otxandio', 48),
(7560, '77', '3', 'Plentzia', 48),
(7561, '78', '9', 'Portugalete', 48),
(7562, '82', '8', 'Santurtzi', 48),
(7563, '84', '9', 'Sestao', 48),
(7564, '904', '7', 'Sondika', 48),
(7565, '85', '2', 'Sopela', 48),
(7566, '86', '5', 'Sopuerta', 48),
(7567, '76', '7', 'Sukarrieta', 48),
(7568, '87', '1', 'Trucios-Turtzioz', 48),
(7569, '88', '7', 'Ubide', 48),
(7570, '65', '6', 'Ugao-Miraballes', 48),
(7571, '89', '0', 'Urduliz', 48),
(7572, '74', '1', 'Urduña/Orduña', 48),
(7573, '80', '6', 'Valle de Trápaga-Trapagaran', 48),
(7574, '95', '0', 'Zaldibar', 48),
(7575, '96', '3', 'Zalla', 48),
(7576, '905', '0', 'Zamudio', 48),
(7577, '97', '9', 'Zaratamo', 48),
(7578, '24', '2', 'Zeanuri', 48),
(7579, '25', '5', 'Zeberio', 48),
(7580, '913', '0', 'Zierbena', 48),
(7581, '915', '8', 'Ziortza-Bolibar', 48),
(7582, '2', '8', 'Abezames', 49),
(7583, '3', '4', 'Alcañices', 49),
(7584, '4', '9', 'Alcubilla de Nogales', 49),
(7585, '5', '2', 'Alfaraz de Sayago', 49),
(7586, '6', '5', 'Algodre', 49),
(7587, '7', '1', 'Almaraz de Duero', 49),
(7588, '8', '7', 'Almeida de Sayago', 49),
(7589, '9', '0', 'Andavías', 49),
(7590, '10', '4', 'Arcenillas', 49),
(7591, '11', '1', 'Arcos de la Polvorosa', 49),
(7592, '12', '6', 'Argañín', 49),
(7593, '13', '2', 'Argujillo', 49),
(7594, '14', '7', 'Arquillinos', 49),
(7595, '15', '0', 'Arrabalde', 49),
(7596, '16', '3', 'Aspariegos', 49),
(7597, '17', '9', 'Asturianos', 49),
(7598, '18', '5', 'Ayoó de Vidriales', 49),
(7599, '19', '8', 'Barcial del Barco', 49),
(7600, '20', '2', 'Belver de los Montes', 49),
(7601, '21', '9', 'Benavente', 49),
(7602, '22', '4', 'Benegiles', 49),
(7603, '23', '0', 'Bermillo de Sayago', 49),
(7604, '24', '5', 'Bóveda de Toro, La', 49),
(7605, '25', '8', 'Bretó', 49),
(7606, '26', '1', 'Bretocino', 49),
(7607, '27', '7', 'Brime de Sog', 49),
(7608, '28', '3', 'Brime de Urz', 49),
(7609, '29', '6', 'Burganes de Valverde', 49),
(7610, '30', '0', 'Bustillo del Oro', 49),
(7611, '31', '7', 'Cabañas de Sayago', 49),
(7612, '32', '2', 'Calzadilla de Tera', 49),
(7613, '33', '8', 'Camarzana de Tera', 49),
(7614, '34', '3', 'Cañizal', 49),
(7615, '35', '6', 'Cañizo', 49),
(7616, '36', '9', 'Carbajales de Alba', 49),
(7617, '37', '5', 'Carbellino', 49),
(7618, '38', '1', 'Casaseca de Campeán', 49),
(7619, '39', '4', 'Casaseca de las Chanas', 49),
(7620, '40', '8', 'Castrillo de la Guareña', 49),
(7621, '41', '5', 'Castrogonzalo', 49),
(7622, '42', '0', 'Castronuevo', 49),
(7623, '43', '6', 'Castroverde de Campos', 49),
(7624, '44', '1', 'Cazurra', 49),
(7625, '46', '7', 'Cerecinos de Campos', 49),
(7626, '47', '3', 'Cerecinos del Carrizal', 49),
(7627, '48', '9', 'Cernadilla', 49),
(7628, '50', '5', 'Cobreros', 49),
(7629, '52', '7', 'Coomonte', 49),
(7630, '53', '3', 'Coreses', 49),
(7631, '54', '8', 'Corrales del Vino', 49),
(7632, '55', '1', 'Cotanes del Monte', 49),
(7633, '56', '4', 'Cubillos', 49),
(7634, '57', '0', 'Cubo de Benavente', 49),
(7635, '58', '6', 'Cubo de Tierra del Vino, El', 49),
(7636, '59', '9', 'Cuelgamures', 49),
(7637, '61', '0', 'Entrala', 49),
(7638, '62', '5', 'Espadañedo', 49),
(7639, '63', '1', 'Faramontanos de Tábara', 49),
(7640, '64', '6', 'Fariza', 49),
(7641, '65', '9', 'Fermoselle', 49),
(7642, '66', '2', 'Ferreras de Abajo', 49),
(7643, '67', '8', 'Ferreras de Arriba', 49),
(7644, '68', '4', 'Ferreruela', 49),
(7645, '69', '7', 'Figueruela de Arriba', 49),
(7646, '71', '8', 'Fonfría', 49),
(7647, '75', '7', 'Fresno de la Polvorosa', 49),
(7648, '76', '0', 'Fresno de la Ribera', 49),
(7649, '77', '6', 'Fresno de Sayago', 49),
(7650, '78', '2', 'Friera de Valverde', 49),
(7651, '79', '5', 'Fuente Encalada', 49),
(7652, '80', '9', 'Fuentelapeña', 49),
(7653, '82', '1', 'Fuentes de Ropel', 49),
(7654, '81', '6', 'Fuentesaúco', 49),
(7655, '83', '7', 'Fuentesecas', 49),
(7656, '84', '2', 'Fuentespreadas', 49),
(7657, '85', '5', 'Galende', 49),
(7658, '86', '8', 'Gallegos del Pan', 49),
(7659, '87', '4', 'Gallegos del Río', 49),
(7660, '88', '0', 'Gamones', 49),
(7661, '90', '7', 'Gema', 49),
(7662, '91', '4', 'Granja de Moreruela', 49),
(7663, '92', '9', 'Granucillo', 49),
(7664, '93', '5', 'Guarrate', 49),
(7665, '94', '0', 'Hermisende', 49),
(7666, '95', '3', 'Hiniesta, La', 49),
(7667, '96', '6', 'Jambrina', 49),
(7668, '97', '2', 'Justel', 49),
(7669, '98', '8', 'Losacino', 49),
(7670, '99', '1', 'Losacio', 49),
(7671, '100', '5', 'Lubián', 49),
(7672, '101', '2', 'Luelmo', 49),
(7673, '102', '7', 'Maderal, El', 49),
(7674, '103', '3', 'Madridanos', 49),
(7675, '104', '8', 'Mahide', 49),
(7676, '105', '1', 'Maire de Castroponce', 49),
(7677, '107', '0', 'Malva', 49),
(7678, '108', '6', 'Manganeses de la Lampreana', 49),
(7679, '109', '9', 'Manganeses de la Polvorosa', 49),
(7680, '110', '3', 'Manzanal de Arriba', 49),
(7681, '112', '5', 'Manzanal de los Infantes', 49),
(7682, '111', '0', 'Manzanal del Barco', 49),
(7683, '113', '1', 'Matilla de Arzón', 49),
(7684, '114', '6', 'Matilla la Seca', 49),
(7685, '115', '9', 'Mayalde', 49),
(7686, '116', '2', 'Melgar de Tera', 49),
(7687, '117', '8', 'Micereces de Tera', 49),
(7688, '118', '4', 'Milles de la Polvorosa', 49),
(7689, '119', '7', 'Molacillos', 49),
(7690, '120', '1', 'Molezuelas de la Carballeda', 49),
(7691, '121', '8', 'Mombuey', 49),
(7692, '122', '3', 'Monfarracinos', 49),
(7693, '123', '9', 'Montamarta', 49),
(7694, '124', '4', 'Moral de Sayago', 49),
(7695, '126', '0', 'Moraleja de Sayago', 49),
(7696, '125', '7', 'Moraleja del Vino', 49),
(7697, '128', '2', 'Morales de Rey', 49),
(7698, '129', '5', 'Morales de Toro', 49),
(7699, '130', '9', 'Morales de Valverde', 49),
(7700, '127', '6', 'Morales del Vino', 49),
(7701, '131', '6', 'Moralina', 49),
(7702, '132', '1', 'Moreruela de los Infanzones', 49),
(7703, '133', '7', 'Moreruela de Tábara', 49),
(7704, '134', '2', 'Muelas de los Caballeros', 49),
(7705, '135', '5', 'Muelas del Pan', 49),
(7706, '136', '8', 'Muga de Sayago', 49),
(7707, '137', '4', 'Navianos de Valverde', 49),
(7708, '138', '0', 'Olmillos de Castro', 49),
(7709, '139', '3', 'Otero de Bodas', 49),
(7710, '141', '4', 'Pajares de la Lampreana', 49),
(7711, '143', '5', 'Palacios de Sanabria', 49),
(7712, '142', '9', 'Palacios del Pan', 49),
(7713, '145', '3', 'Pedralba de la Pradería', 49),
(7714, '146', '6', 'Pego, El', 49),
(7715, '147', '2', 'Peleagonzalo', 49),
(7716, '148', '8', 'Peleas de Abajo', 49),
(7717, '149', '1', 'Peñausende', 49),
(7718, '150', '4', 'Peque', 49),
(7719, '151', '1', 'Perdigón, El', 49),
(7720, '152', '6', 'Pereruela', 49),
(7721, '153', '2', 'Perilla de Castro', 49),
(7722, '154', '7', 'Pías', 49),
(7723, '155', '0', 'Piedrahita de Castro', 49),
(7724, '156', '3', 'Pinilla de Toro', 49),
(7725, '157', '9', 'Pino del Oro', 49),
(7726, '158', '5', 'Piñero, El', 49),
(7727, '160', '2', 'Pobladura de Valderaduey', 49),
(7728, '159', '8', 'Pobladura del Valle', 49),
(7729, '162', '4', 'Porto', 49),
(7730, '163', '0', 'Pozoantiguo', 49),
(7731, '164', '5', 'Pozuelo de Tábara', 49),
(7732, '165', '8', 'Prado', 49),
(7733, '166', '1', 'Puebla de Sanabria', 49),
(7734, '167', '7', 'Pueblica de Valverde', 49),
(7735, '170', '0', 'Quintanilla de Urz', 49),
(7736, '168', '3', 'Quintanilla del Monte', 49),
(7737, '169', '6', 'Quintanilla del Olmo', 49),
(7738, '171', '7', 'Quiruelas de Vidriales', 49),
(7739, '172', '2', 'Rabanales', 49),
(7740, '173', '8', 'Rábano de Aliste', 49),
(7741, '174', '3', 'Requejo', 49),
(7742, '175', '6', 'Revellinos', 49),
(7743, '176', '9', 'Riofrío de Aliste', 49),
(7744, '177', '5', 'Rionegro del Puente', 49),
(7745, '178', '1', 'Roales', 49),
(7746, '179', '4', 'Robleda-Cervantes', 49),
(7747, '180', '8', 'Roelos de Sayago', 49),
(7748, '181', '5', 'Rosinos de la Requejada', 49),
(7749, '183', '6', 'Salce', 49),
(7750, '184', '1', 'Samir de los Caños', 49),
(7751, '185', '4', 'San Agustín del Pozo', 49),
(7752, '186', '7', 'San Cebrián de Castro', 49),
(7753, '187', '3', 'San Cristóbal de Entreviñas', 49),
(7754, '188', '9', 'San Esteban del Molar', 49),
(7755, '189', '2', 'San Justo', 49),
(7756, '190', '6', 'San Martín de Valderaduey', 49),
(7757, '191', '3', 'San Miguel de la Ribera', 49),
(7758, '192', '8', 'San Miguel del Valle', 49),
(7759, '193', '4', 'San Pedro de Ceque', 49),
(7760, '194', '9', 'San Pedro de la Nave-Almendra', 49),
(7761, '208', '5', 'San Vicente de la Cabeza', 49),
(7762, '209', '8', 'San Vitero', 49),
(7763, '197', '1', 'Santa Clara de Avedillo', 49),
(7764, '199', '0', 'Santa Colomba de las Monjas', 49),
(7765, '200', '4', 'Santa Cristina de la Polvorosa', 49),
(7766, '201', '1', 'Santa Croya de Tera', 49),
(7767, '202', '6', 'Santa Eufemia del Barco', 49),
(7768, '203', '2', 'Santa María de la Vega', 49),
(7769, '204', '7', 'Santa María de Valverde', 49),
(7770, '205', '0', 'Santibáñez de Tera', 49),
(7771, '206', '3', 'Santibáñez de Vidriales', 49),
(7772, '207', '9', 'Santovenia', 49),
(7773, '210', '2', 'Sanzoles', 49),
(7774, '214', '5', 'Tábara', 49),
(7775, '216', '1', 'Tapioles', 49),
(7776, '219', '6', 'Toro', 49),
(7777, '220', '0', 'Torre del Valle, La', 49),
(7778, '221', '7', 'Torregamones', 49),
(7779, '222', '2', 'Torres del Carrizal', 49),
(7780, '223', '8', 'Trabazos', 49),
(7781, '224', '3', 'Trefacio', 49),
(7782, '225', '6', 'Uña de Quintana', 49),
(7783, '226', '9', 'Vadillo de la Guareña', 49),
(7784, '227', '5', 'Valcabado', 49),
(7785, '228', '1', 'Valdefinjas', 49),
(7786, '229', '4', 'Valdescorriel', 49),
(7787, '230', '8', 'Vallesa de la Guareña', 49),
(7788, '231', '5', 'Vega de Tera', 49),
(7789, '232', '0', 'Vega de Villalobos', 49),
(7790, '233', '6', 'Vegalatrave', 49),
(7791, '234', '1', 'Venialbo', 49),
(7792, '235', '4', 'Vezdemarbán', 49),
(7793, '236', '7', 'Vidayanes', 49),
(7794, '237', '3', 'Videmala', 49),
(7795, '238', '9', 'Villabrázaro', 49),
(7796, '239', '2', 'Villabuena del Puente', 49),
(7797, '240', '6', 'Villadepera', 49),
(7798, '241', '3', 'Villaescusa', 49),
(7799, '242', '8', 'Villafáfila', 49),
(7800, '243', '4', 'Villaferrueña', 49),
(7801, '244', '9', 'Villageriz', 49),
(7802, '245', '2', 'Villalazán', 49),
(7803, '246', '5', 'Villalba de la Lampreana', 49),
(7804, '247', '1', 'Villalcampo', 49),
(7805, '248', '7', 'Villalobos', 49),
(7806, '249', '0', 'Villalonso', 49),
(7807, '250', '3', 'Villalpando', 49),
(7808, '251', '0', 'Villalube', 49),
(7809, '252', '5', 'Villamayor de Campos', 49),
(7810, '255', '9', 'Villamor de los Escuderos', 49),
(7811, '256', '2', 'Villanázar', 49),
(7812, '257', '8', 'Villanueva de Azoague', 49),
(7813, '258', '4', 'Villanueva de Campeán', 49),
(7814, '259', '7', 'Villanueva de las Peras', 49),
(7815, '260', '1', 'Villanueva del Campo', 49),
(7816, '263', '9', 'Villar de Fallaves', 49),
(7817, '264', '4', 'Villar del Buey', 49),
(7818, '261', '8', 'Villaralbo', 49),
(7819, '262', '3', 'Villardeciervos', 49),
(7820, '265', '7', 'Villardiegua de la Ribera', 49),
(7821, '266', '0', 'Villárdiga', 49),
(7822, '267', '6', 'Villardondiego', 49),
(7823, '268', '2', 'Villarrín de Campos', 49),
(7824, '269', '5', 'Villaseco del Pan', 49),
(7825, '270', '9', 'Villavendimio', 49),
(7826, '272', '1', 'Villaveza de Valverde', 49),
(7827, '271', '6', 'Villaveza del Agua', 49),
(7828, '273', '7', 'Viñas', 49),
(7829, '275', '5', 'Zamora', 49),
(7830, '1', '6', 'Abanto', 50),
(7831, '2', '1', 'Acered', 50),
(7832, '3', '7', 'Agón', 50),
(7833, '4', '2', 'Aguarón', 50),
(7834, '5', '5', 'Aguilón', 50),
(7835, '6', '8', 'Ainzón', 50),
(7836, '7', '4', 'Aladrén', 50),
(7837, '8', '0', 'Alagón', 50),
(7838, '9', '3', 'Alarba', 50),
(7839, '10', '7', 'Alberite de San Juan', 50),
(7840, '11', '4', 'Albeta', 50),
(7841, '12', '9', 'Alborge', 50),
(7842, '13', '5', 'Alcalá de Ebro', 50),
(7843, '14', '0', 'Alcalá de Moncayo', 50),
(7844, '15', '3', 'Alconchel de Ariza', 50),
(7845, '16', '6', 'Aldehuela de Liestos', 50),
(7846, '17', '2', 'Alfajarín', 50),
(7847, '18', '8', 'Alfamén', 50),
(7848, '19', '1', 'Alforque', 50),
(7849, '20', '5', 'Alhama de Aragón', 50),
(7850, '21', '2', 'Almochuel', 50),
(7851, '22', '7', 'Almolda, La', 50),
(7852, '23', '3', 'Almonacid de la Cuba', 50),
(7853, '24', '8', 'Almonacid de la Sierra', 50),
(7854, '25', '1', 'Almunia de Doña Godina, La', 50),
(7855, '26', '4', 'Alpartir', 50),
(7856, '27', '0', 'Ambel', 50),
(7857, '28', '6', 'Anento', 50),
(7858, '29', '9', 'Aniñón', 50),
(7859, '30', '3', 'Añón de Moncayo', 50),
(7860, '31', '0', 'Aranda de Moncayo', 50),
(7861, '32', '5', 'Arándiga', 50),
(7862, '33', '1', 'Ardisa', 50),
(7863, '34', '6', 'Ariza', 50),
(7864, '35', '9', 'Artieda', 50),
(7865, '36', '2', 'Asín', 50),
(7866, '37', '8', 'Atea', 50),
(7867, '38', '4', 'Ateca', 50),
(7868, '39', '7', 'Azuara', 50),
(7869, '40', '1', 'Badules', 50),
(7870, '41', '8', 'Bagüés', 50),
(7871, '42', '3', 'Balconchán', 50),
(7872, '43', '9', 'Bárboles', 50),
(7873, '44', '4', 'Bardallur', 50),
(7874, '45', '7', 'Belchite', 50),
(7875, '46', '0', 'Belmonte de Gracián', 50),
(7876, '47', '6', 'Berdejo', 50),
(7877, '48', '2', 'Berrueco', 50),
(7878, '901', '7', 'Biel', 50),
(7879, '50', '8', 'Bijuesca', 50),
(7880, '51', '5', 'Biota', 50),
(7881, '52', '0', 'Bisimbre', 50),
(7882, '53', '6', 'Boquiñeni', 50),
(7883, '54', '1', 'Bordalba', 50),
(7884, '55', '4', 'Borja', 50),
(7885, '56', '7', 'Botorrita', 50),
(7886, '57', '3', 'Brea de Aragón', 50),
(7887, '58', '9', 'Bubierca', 50),
(7888, '59', '2', 'Bujaraloz', 50),
(7889, '60', '6', 'Bulbuente', 50),
(7890, '61', '3', 'Bureta', 50),
(7891, '62', '8', 'Burgo de Ebro, El', 50),
(7892, '63', '4', 'Buste, El', 50),
(7893, '64', '9', 'Cabañas de Ebro', 50),
(7894, '65', '2', 'Cabolafuente', 50),
(7895, '66', '5', 'Cadrete', 50),
(7896, '67', '1', 'Calatayud', 50),
(7897, '68', '7', 'Calatorao', 50),
(7898, '69', '0', 'Calcena', 50),
(7899, '70', '4', 'Calmarza', 50),
(7900, '71', '1', 'Campillo de Aragón', 50),
(7901, '72', '6', 'Carenas', 50),
(7902, '73', '2', 'Cariñena', 50),
(7903, '74', '7', 'Caspe', 50),
(7904, '75', '0', 'Castejón de Alarba', 50),
(7905, '76', '3', 'Castejón de las Armas', 50),
(7906, '77', '9', 'Castejón de Valdejasa', 50),
(7907, '78', '5', 'Castiliscar', 50),
(7908, '79', '8', 'Cervera de la Cañada', 50),
(7909, '80', '2', 'Cerveruela', 50),
(7910, '81', '9', 'Cetina', 50),
(7911, '92', '2', 'Chiprana', 50),
(7912, '93', '8', 'Chodes', 50),
(7913, '82', '4', 'Cimballa', 50),
(7914, '83', '0', 'Cinco Olivas', 50),
(7915, '84', '5', 'Clarés de Ribota', 50),
(7916, '85', '8', 'Codo', 50),
(7917, '86', '1', 'Codos', 50),
(7918, '87', '7', 'Contamina', 50),
(7919, '88', '3', 'Cosuenda', 50),
(7920, '89', '6', 'Cuarte de Huerva', 50),
(7921, '90', '0', 'Cubel', 50),
(7922, '91', '7', 'Cuerlas, Las', 50),
(7923, '94', '3', 'Daroca', 50),
(7924, '95', '6', 'Ejea de los Caballeros', 50),
(7925, '96', '9', 'Embid de Ariza', 50),
(7926, '98', '1', 'Encinacorba', 50),
(7927, '99', '4', 'Épila', 50),
(7928, '100', '8', 'Erla', 50),
(7929, '101', '5', 'Escatrón', 50),
(7930, '102', '0', 'Fabara', 50),
(7931, '104', '1', 'Farlete', 50),
(7932, '105', '4', 'Fayón', 50),
(7933, '106', '7', 'Fayos, Los', 50),
(7934, '107', '3', 'Figueruelas', 50),
(7935, '108', '9', 'Fombuena', 50),
(7936, '109', '2', 'Frago, El', 50),
(7937, '110', '6', 'Frasno, El', 50),
(7938, '111', '3', 'Fréscano', 50),
(7939, '113', '4', 'Fuendejalón', 50),
(7940, '114', '9', 'Fuendetodos', 50),
(7941, '115', '2', 'Fuentes de Ebro', 50),
(7942, '116', '5', 'Fuentes de Jiloca', 50),
(7943, '117', '1', 'Gallocanta', 50),
(7944, '118', '7', 'Gallur', 50),
(7945, '119', '0', 'Gelsa', 50),
(7946, '120', '4', 'Godojos', 50),
(7947, '121', '1', 'Gotor', 50),
(7948, '122', '6', 'Grisel', 50),
(7949, '123', '2', 'Grisén', 50),
(7950, '124', '7', 'Herrera de los Navarros', 50),
(7951, '125', '0', 'Ibdes', 50),
(7952, '126', '3', 'Illueca', 50),
(7953, '128', '5', 'Isuerre', 50),
(7954, '129', '8', 'Jaraba', 50),
(7955, '130', '2', 'Jarque', 50),
(7956, '131', '9', 'Jaulín', 50),
(7957, '132', '4', 'Joyosa, La', 50),
(7958, '133', '0', 'Lagata', 50),
(7959, '134', '5', 'Langa del Castillo', 50),
(7960, '135', '8', 'Layana', 50),
(7961, '136', '1', 'Lécera', 50),
(7962, '138', '3', 'Lechón', 50),
(7963, '137', '7', 'Leciñena', 50),
(7964, '139', '6', 'Letux', 50),
(7965, '140', '0', 'Litago', 50),
(7966, '141', '7', 'Lituénigo', 50),
(7967, '142', '2', 'Lobera de Onsella', 50),
(7968, '143', '8', 'Longares', 50),
(7969, '144', '3', 'Longás', 50),
(7970, '146', '9', 'Lucena de Jalón', 50),
(7971, '147', '5', 'Luceni', 50),
(7972, '148', '1', 'Luesia', 50),
(7973, '149', '4', 'Luesma', 50),
(7974, '150', '7', 'Lumpiaque', 50),
(7975, '151', '4', 'Luna', 50),
(7976, '152', '9', 'Maella', 50),
(7977, '153', '5', 'Magallón', 50),
(7978, '154', '0', 'Mainar', 50),
(7979, '155', '3', 'Malanquilla', 50),
(7980, '156', '6', 'Maleján', 50),
(7981, '160', '5', 'Mallén', 50),
(7982, '157', '2', 'Malón', 50),
(7983, '159', '1', 'Maluenda', 50),
(7984, '161', '2', 'Manchones', 50),
(7985, '162', '7', 'Mara', 50),
(7986, '163', '3', 'María de Huerva', 50),
(7987, '902', '2', 'Marracos', 50),
(7988, '164', '8', 'Mediana de Aragón', 50),
(7989, '165', '1', 'Mequinenza', 50),
(7990, '166', '4', 'Mesones de Isuela', 50),
(7991, '167', '0', 'Mezalocha', 50),
(7992, '168', '6', 'Mianos', 50),
(7993, '169', '9', 'Miedes de Aragón', 50),
(7994, '170', '3', 'Monegrillo', 50),
(7995, '171', '0', 'Moneva', 50),
(7996, '172', '5', 'Monreal de Ariza', 50),
(7997, '173', '1', 'Monterde', 50),
(7998, '174', '6', 'Montón', 50),
(7999, '175', '9', 'Morata de Jalón', 50),
(8000, '176', '2', 'Morata de Jiloca', 50),
(8001, '177', '8', 'Morés', 50),
(8002, '178', '4', 'Moros', 50);
INSERT INTO `poblaciones` (`id`, `codigo`, `cp`, `poblacion`, `provincia_id`) VALUES
(8003, '179', '7', 'Moyuela', 50),
(8004, '180', '1', 'Mozota', 50),
(8005, '181', '8', 'Muel', 50),
(8006, '182', '3', 'Muela, La', 50),
(8007, '183', '9', 'Munébrega', 50),
(8008, '184', '4', 'Murero', 50),
(8009, '185', '7', 'Murillo de Gállego', 50),
(8010, '186', '0', 'Navardún', 50),
(8011, '187', '6', 'Nigüella', 50),
(8012, '188', '2', 'Nombrevilla', 50),
(8013, '189', '5', 'Nonaspe', 50),
(8014, '190', '9', 'Novallas', 50),
(8015, '191', '6', 'Novillas', 50),
(8016, '192', '1', 'Nuévalos', 50),
(8017, '193', '7', 'Nuez de Ebro', 50),
(8018, '194', '2', 'Olvés', 50),
(8019, '195', '5', 'Orcajo', 50),
(8020, '196', '8', 'Orera', 50),
(8021, '197', '4', 'Orés', 50),
(8022, '198', '0', 'Oseja', 50),
(8023, '199', '3', 'Osera de Ebro', 50),
(8024, '200', '7', 'Paniza', 50),
(8025, '201', '4', 'Paracuellos de Jiloca', 50),
(8026, '202', '9', 'Paracuellos de la Ribera', 50),
(8027, '203', '5', 'Pastriz', 50),
(8028, '204', '0', 'Pedrola', 50),
(8029, '205', '3', 'Pedrosas, Las', 50),
(8030, '206', '6', 'Perdiguera', 50),
(8031, '207', '2', 'Piedratajada', 50),
(8032, '208', '8', 'Pina de Ebro', 50),
(8033, '209', '1', 'Pinseque', 50),
(8034, '210', '5', 'Pintanos, Los', 50),
(8035, '211', '2', 'Plasencia de Jalón', 50),
(8036, '212', '7', 'Pleitas', 50),
(8037, '213', '3', 'Plenas', 50),
(8038, '214', '8', 'Pomer', 50),
(8039, '215', '1', 'Pozuel de Ariza', 50),
(8040, '216', '4', 'Pozuelo de Aragón', 50),
(8041, '217', '0', 'Pradilla de Ebro', 50),
(8042, '218', '6', 'Puebla de Albortón', 50),
(8043, '219', '9', 'Puebla de Alfindén, La', 50),
(8044, '220', '3', 'Puendeluna', 50),
(8045, '221', '0', 'Purujosa', 50),
(8046, '222', '5', 'Quinto', 50),
(8047, '223', '1', 'Remolinos', 50),
(8048, '224', '6', 'Retascón', 50),
(8049, '225', '9', 'Ricla', 50),
(8050, '227', '8', 'Romanos', 50),
(8051, '228', '4', 'Rueda de Jalón', 50),
(8052, '229', '7', 'Ruesca', 50),
(8053, '241', '6', 'Sabiñán', 50),
(8054, '230', '1', 'Sádaba', 50),
(8055, '231', '8', 'Salillas de Jalón', 50),
(8056, '232', '3', 'Salvatierra de Esca', 50),
(8057, '233', '9', 'Samper del Salz', 50),
(8058, '234', '4', 'San Martín de la Virgen de Moncayo', 50),
(8059, '235', '7', 'San Mateo de Gállego', 50),
(8060, '236', '0', 'Santa Cruz de Grío', 50),
(8061, '237', '6', 'Santa Cruz de Moncayo', 50),
(8062, '238', '2', 'Santa Eulalia de Gállego', 50),
(8063, '239', '5', 'Santed', 50),
(8064, '240', '9', 'Sástago', 50),
(8065, '242', '1', 'Sediles', 50),
(8066, '243', '7', 'Sestrica', 50),
(8067, '244', '2', 'Sierra de Luna', 50),
(8068, '245', '5', 'Sigüés', 50),
(8069, '246', '8', 'Sisamón', 50),
(8070, '247', '4', 'Sobradiel', 50),
(8071, '248', '0', 'Sos del Rey Católico', 50),
(8072, '249', '3', 'Tabuenca', 50),
(8073, '250', '6', 'Talamantes', 50),
(8074, '251', '3', 'Tarazona', 50),
(8075, '252', '8', 'Tauste', 50),
(8076, '253', '4', 'Terrer', 50),
(8077, '254', '9', 'Tierga', 50),
(8078, '255', '2', 'Tobed', 50),
(8079, '256', '5', 'Torralba de los Frailes', 50),
(8080, '257', '1', 'Torralba de Ribota', 50),
(8081, '258', '7', 'Torralbilla', 50),
(8082, '259', '0', 'Torrehermosa', 50),
(8083, '260', '4', 'Torrelapaja', 50),
(8084, '261', '1', 'Torrellas', 50),
(8085, '262', '6', 'Torres de Berrellén', 50),
(8086, '263', '2', 'Torrijo de la Cañada', 50),
(8087, '264', '7', 'Tosos', 50),
(8088, '265', '0', 'Trasmoz', 50),
(8089, '266', '3', 'Trasobares', 50),
(8090, '267', '9', 'Uncastillo', 50),
(8091, '268', '5', 'Undués de Lerda', 50),
(8092, '269', '8', 'Urrea de Jalón', 50),
(8093, '270', '2', 'Urriés', 50),
(8094, '271', '9', 'Used', 50),
(8095, '272', '4', 'Utebo', 50),
(8096, '274', '5', 'Val de San Martín', 50),
(8097, '273', '0', 'Valdehorna', 50),
(8098, '275', '8', 'Valmadrid', 50),
(8099, '276', '1', 'Valpalmas', 50),
(8100, '277', '7', 'Valtorres', 50),
(8101, '278', '3', 'Velilla de Ebro', 50),
(8102, '279', '6', 'Velilla de Jiloca', 50),
(8103, '280', '0', 'Vera de Moncayo', 50),
(8104, '281', '7', 'Vierlas', 50),
(8105, '283', '8', 'Villadoz', 50),
(8106, '284', '3', 'Villafeliche', 50),
(8107, '285', '6', 'Villafranca de Ebro', 50),
(8108, '286', '9', 'Villalba de Perejil', 50),
(8109, '287', '5', 'Villalengua', 50),
(8110, '903', '8', 'Villamayor de Gállego', 50),
(8111, '288', '1', 'Villanueva de Gállego', 50),
(8112, '290', '8', 'Villanueva de Huerva', 50),
(8113, '289', '4', 'Villanueva de Jiloca', 50),
(8114, '291', '5', 'Villar de los Navarros', 50),
(8115, '292', '0', 'Villarreal de Huerva', 50),
(8116, '293', '6', 'Villarroya de la Sierra', 50),
(8117, '294', '1', 'Villarroya del Campo', 50),
(8118, '282', '2', 'Vilueña, La', 50),
(8119, '295', '4', 'Vistabella', 50),
(8120, '296', '7', 'Zaida, La', 50),
(8121, '297', '3', 'Zaragoza', 50),
(8122, '298', '9', 'Zuera', 50),
(8123, '1', '3', 'Ceuta', 51),
(8124, '1', '8', 'Melilla', 52);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poblaciones_zonas`
--

DROP TABLE IF EXISTS `poblaciones_zonas`;
CREATE TABLE `poblaciones_zonas` (
  `id` int(11) UNSIGNED NOT NULL,
  `poblacion_id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `poblaciones_zonas`
--

INSERT INTO `poblaciones_zonas` (`id`, `poblacion_id`, `nombre`) VALUES
(1, 280, 'centro'),
(2, 280, 'sur'),
(3, 292, 'Catedral'),
(4, 292, 'Zapillo'),
(5, 292, 'Piedras Redondas'),
(6, 1780, 'Ayuntamiento - Catedral'),
(7, 292, 'Estación'),
(8, 292, 'Alcazaba'),
(9, 292, 'Rambla Lorca'),
(10, 292, 'Rambla Amatisteros'),
(11, 292, 'Vega de Acá'),
(12, 292, 'Vega de Allá'),
(13, 292, 'San Luis'),
(14, 292, 'Los Molinos'),
(15, 292, 'Torrecárdenas'),
(16, 292, 'El Puche'),
(17, 292, 'Los Almendros'),
(18, 1780, 'Centro Histórico - Plaza España'),
(19, 1780, 'Cortadura - Zona Franca'),
(20, 1780, 'La Caleta - La Viña'),
(21, 1780, 'La Paz - Segunda Aguada - Loreto'),
(22, 1780, 'Mentidero - Teatro Falla - Alameda'),
(23, 1780, 'Playa Stª Mª del Mar - Playa Victoria'),
(24, 1780, 'Bahía Blanca'),
(25, 1780, 'La Laguna'),
(26, 1780, 'San José - Varela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

DROP TABLE IF EXISTS `provincias`;
CREATE TABLE `provincias` (
  `id` int(11) UNSIGNED NOT NULL,
  `provincia` varchar(255) NOT NULL,
  `comunidad_autonoma_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `provincia`, `comunidad_autonoma_id`) VALUES
(1, 'Alava', 17),
(2, 'Albacete', 5),
(3, 'Alicante', 9),
(4, 'Almería', 1),
(5, 'Avila', 4),
(6, 'Badajoz', 10),
(7, 'Baleares', 12),
(8, 'Barcelona', 6),
(9, 'Burgos', 4),
(10, 'Cáceres', 10),
(11, 'Cádiz', 1),
(12, 'Castellón', 9),
(13, 'Ciudad Real', 5),
(14, 'Córdoba', 1),
(15, 'A Coruña', 11),
(16, 'Cuenca', 5),
(17, 'Girona', 6),
(18, 'Granada', 1),
(19, 'Guadalajara', 5),
(20, 'Guipúzcoa', 17),
(21, 'Huelva', 1),
(22, 'Huesca', 2),
(23, 'Jaén', 1),
(24, 'León', 4),
(25, 'Lleida', 6),
(26, 'La Rioja', 14),
(27, 'Lugo', 11),
(28, 'Madrid', 8),
(29, 'Málaga', 1),
(30, 'Murcia', 19),
(31, 'Navarra', 16),
(32, 'Ourense', 11),
(33, 'Asturias', 18),
(34, 'Palencia', 4),
(35, 'Las Palmas', 13),
(36, 'Pontevedra', 11),
(37, 'Salamanca', 4),
(38, 'Santa Cruz de Tenerife', 13),
(39, 'Cantabria', 3),
(40, 'Segovia', 4),
(41, 'Sevilla', 1),
(42, 'Soria', 4),
(43, 'Tarragona', 6),
(44, 'Teruel', 2),
(45, 'Toledo', 5),
(46, 'Valencia', 9),
(47, 'Valladolid', 4),
(48, 'Vizcaya', 17),
(49, 'Zamora', 4),
(50, 'Zaragoza', 2),
(51, 'Ceuta', 7),
(52, 'Melilla', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

DROP TABLE IF EXISTS `seccion`;
CREATE TABLE `seccion` (
  `id` int(3) UNSIGNED NOT NULL,
  `prioridad` int(2) UNSIGNED NOT NULL,
  `background` varchar(10) DEFAULT NULL,
  `menu` tinyint(1) DEFAULT '0',
  `footer` tinyint(1) DEFAULT '0',
  `desplegable` tinyint(1) DEFAULT '0',
  `id_estado` int(10) UNSIGNED NOT NULL,
  `tipo_seccion` int(10) UNSIGNED NOT NULL DEFAULT '2' COMMENT '1 automático, 2 manual',
  `id_super_seccion` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`id`, `prioridad`, `background`, `menu`, `footer`, `desplegable`, `id_estado`, `tipo_seccion`, `id_super_seccion`) VALUES
(1, 1, NULL, 1, NULL, NULL, 1, 2, 0),
(3, 2, NULL, 1, NULL, NULL, 1, 2, 0),
(5, 5, NULL, 1, 1, NULL, 1, 4, 0),
(6, 4, NULL, 1, NULL, NULL, 1, 2, 0),
(7, 3, NULL, 1, NULL, NULL, 1, 3, 0),
(8, 6, NULL, NULL, 1, NULL, 1, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_idiomas`
--

DROP TABLE IF EXISTS `seccion_idiomas`;
CREATE TABLE `seccion_idiomas` (
  `id_seccion_idiomas` int(11) UNSIGNED NOT NULL,
  `titulo` varchar(70) NOT NULL,
  `url_seo` varchar(50) NOT NULL,
  `descripcion_seo` varchar(150) NOT NULL,
  `titulo_seo` varchar(70) NOT NULL,
  `keyword_seo` text NOT NULL,
  `id_seccion` int(3) UNSIGNED NOT NULL,
  `id_idioma` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `seccion_idiomas`
--

INSERT INTO `seccion_idiomas` (`id_seccion_idiomas`, `titulo`, `url_seo`, `descripcion_seo`, `titulo_seo`, `keyword_seo`, `id_seccion`, `id_idioma`) VALUES
(1, 'INICIO', 'inicio', 'inicio', 'Inicio', 'inicio, portada, openrs', 1, 1),
(3, 'NOSOTROS', 'nosotros', 'Conozca a los profesionales de Gesticadiz', 'Nosotros', 'quienes somos, conocenos, equipo, gesticadiz, inmobiliaria', 3, 1),
(5, 'CONTACTO', 'contacto', 'contacto con el equipo de openrs', 'Contacto - OpenRS', 'contacto, hablamos', 5, 1),
(6, 'SERVICIOS', 'servicios', 'Servicios', 'Servicios', 'servicios', 6, 1),
(31, 'HOME', 'home', 'home', 'home', 'home', 1, 53),
(32, 'NOTICIAS', 'noticias', 'Noticias OpenRS', 'Noticias - OpenRS', 'noticias', 7, 1),
(33, 'NEWS', 'news', 'News Open RS', 'News - OpenRS', 'news', 7, 53),
(34, 'CONTACT', 'contact', 'contact', 'Contact - OpenRS', 'contact', 5, 53),
(35, 'SERVICES', 'services', 'Services', 'services', 'services', 6, 53),
(36, 'BUSINESS', 'business', 'business', 'business', 'business', 3, 53),
(37, 'AVISO LEGAL', 'aviso-legal', 'Aviso legal de OPENRS', 'OPENRS - Aviso Legal', 'aviso, legal, openrs', 8, 1),
(38, 'LEGAL WARNING', 'legal-warning', 'Legal warning of OPENRS', 'OPENRS - Legal Warning', 'warning, legal, openrs', 8, 53);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `texto`
--

DROP TABLE IF EXISTS `texto`;
CREATE TABLE `texto` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_bloque` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `texto`
--

INSERT INTO `texto` (`id`, `id_bloque`) VALUES
(24, 82),
(30, 88),
(56, 122),
(70, 150),
(82, 164),
(83, 167),
(84, 168),
(85, 169);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `texto_idiomas`
--

DROP TABLE IF EXISTS `texto_idiomas`;
CREATE TABLE `texto_idiomas` (
  `id_texto_idiomas` int(11) UNSIGNED NOT NULL,
  `id_bloque` int(10) UNSIGNED NOT NULL,
  `contenido` text CHARACTER SET latin1 NOT NULL,
  `id_idioma` int(11) UNSIGNED NOT NULL,
  `id_texto` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `texto_idiomas`
--

INSERT INTO `texto_idiomas` (`id_texto_idiomas`, `id_bloque`, `contenido`, `id_idioma`, `id_texto`) VALUES
(24, 82, '<p>\r\n	<iframe allowfullscreen=\"\" frameborder=\"0\" height=\"450\" src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3206.7163841333986!2d-6.282358084368701!3d36.512707791528875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dd3cb33ccf691%3A0x8f5b4f6a55ad2a01!2sGesticadiz!5e0!3m2!1ses!2ses!4v1505287064830\" style=\"border:0\" width=\"600\"></iframe></p>', 1, 24),
(30, 88, '<h2>Datos identificativos</h2>\r\n\r\n<p>En cumplimiento con el deber de informaci&oacute;n recogido en el art&iacute;culo 10 de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Informaci&oacute;n y del Comercio Electr&oacute;nico (LSSICE), se exponen a continuaci&oacute;n los datos identificativos de la empresa: la empresa titular de www.annaisevents.com es ANNAIS EVENTS S.L.U. (en adelante ANNAIS EVENTS). Correo electr&oacute;nico de contacto: info@annaisevents.com.</p>\r\n\r\n<h3>Usuario</h3>\r\n\r\n<p>El acceso y/o uso de este portal de www.annaisevents.com atribuye la condici&oacute;n de USUARIO, que acepta, desde dicho acceso y/o uso, las Condiciones Generales de Uso aqu&iacute; reflejadas. Las citadas Condiciones ser&aacute;n de aplicaci&oacute;n independientemente de las Condiciones Generales de Contrataci&oacute;n que en su caso resulten de obligado cumplimiento.</p>\r\n\r\n<h3>Uso del portal</h3>\r\n\r\n<p>www.annaisevents.com proporciona el acceso a multitud de informaciones, servicios, programas o datos (en adelante, &quot;los contenidos&quot;) en Internet pertenecientes a ANNAIS EVENTS o a sus licenciantes a los que el USUARIO pueda tener acceso. El USUARIO asume la responsabilidad del uso del portal. Dicha responsabilidad se extiende al registro que fuese necesario para acceder a determinados servicios o contenidos. En dicho registro el USUARIO ser&aacute; responsable de aportar informaci&oacute;n veraz y l&iacute;cita. Como consecuencia de este registro, al USUARIO se le puede proporcionar una contrase&ntilde;a de la que ser&aacute; responsable, comprometi&eacute;ndose a hacer un uso diligente y confidencial de la misma. El USUARIO se compromete a hacer un uso adecuado de los contenidos y servicios (como por ejemplo servicios de chat, foros de discusi&oacute;n o grupos de noticias) que ANNAIS EVENTS ofrece a trav&eacute;s de su portal y con car&aacute;cter enunciativo pero no limitativo, a no emplearlos para (I) incurrir en actividades il&iacute;citas, ilegales o contrarias a la buena fe y al orden p&uacute;blico; (II) difundir contenidos o propaganda de car&aacute;cter racista, xen&oacute;fobo, pornogr&aacute;fico-ilegal, de apolog&iacute;a del terrorismo o atentatorio contra los derechos humanos; (III) provocar da&ntilde;os en los sistemas f&iacute;sicos y l&oacute;gicos de ANNAIS EVENTS, de sus proveedores o de terceras personas, introducir o difundir en la red virus inform&aacute;ticos o cualesquiera otros sistemas f&iacute;sicos o l&oacute;gicos que sean susceptibles de provocar los da&ntilde;os anteriormente mencionados; (IV) intentar acceder y, en su caso, utilizar las cuentas de correo electr&oacute;nico de otros usuarios y modificar o manipular sus mensajes. ANNAIS EVENTS se reserva el derecho de retirar todos aquellos comentarios y aportaciones que vulneren el respeto a la dignidad de la persona, que sean discriminatorios, xen&oacute;fobos, racistas, pornogr&aacute;ficos, que atenten contra la juventud o la infancia, el orden o la seguridad p&uacute;blica o que, a su juicio, no resultaran adecuados para su publicaci&oacute;n. En cualquier caso, ANNAIS EVENTS no ser&aacute; responsable de las opiniones vertidas por los usuarios a trav&eacute;s de los foros, chats, u otras herramientas de participaci&oacute;n.</p>\r\n\r\n<h3>Propiedad intelectual e industrial</h3>\r\n\r\n<p>ANNAIS EVENTS, por s&iacute; o como cesionaria, es titular de todos los derechos de propiedad intelectual e industrial de su p&aacute;gina web, as&iacute; como de los elementos contenidos en la misma (a t&iacute;tulo enunciativo, im&aacute;genes, sonido, audio, v&iacute;deo, software o textos; marcas o logotipos, combinaciones de colores, estructura y dise&ntilde;o, selecci&oacute;n de materiales usados, programas de ordenador necesarios para su funcionamiento, acceso y uso, etc.), titularidad de ANNAIS EVENTS o bien de sus licenciantes. Todos los derechos reservados. En virtud de lo dispuesto en los art&iacute;culos 8 y 32.1, p&aacute;rrafo segundo, de la Ley de Propiedad Intelectual, quedan expresamente prohibidas la reproducci&oacute;n, la distribuci&oacute;n y la comunicaci&oacute;n p&uacute;blica, incluida su modalidad de puesta a disposici&oacute;n, de la totalidad o parte de los contenidos de esta p&aacute;gina web, con fines comerciales, en cualquier soporte y por cualquier medio t&eacute;cnico, sin la autorizaci&oacute;n de ANNAIS EVENTS. El USUARIO se compromete a respetar los derechos de Propiedad Intelectual e Industrial titularidad de ANNAIS EVENTS. Podr&aacute; visualizar los elementos del portal e incluso imprimirlos, copiarlos y almacenarlos en el disco duro de su ordenador o en cualquier otro soporte f&iacute;sico siempre y cuando sea, &uacute;nica y exclusivamente, para su uso personal y privado. El USUARIO deber&aacute; abstenerse de suprimir, alterar, eludir o manipular cualquier dispositivo de protecci&oacute;n o sistema de seguridad que estuviera instalado en el las p&aacute;ginas de ANNAIS EVENTS.</p>\r\n\r\n<h3>Ley de protecci&oacute;n de datos</h3>\r\n\r\n<p>En cumplimiento de la Ley Org&aacute;nica 15/1999, de 13 de diciembre, de Protecci&oacute;n de Datos de Car&aacute;cter Personal y su normativa de desarrollo, ANNAIS EVENTS en calidad de propietaro de Centro Educativo Jerez, le informa que los datos personales que el usuario nos pudiera facilitar cualquiera que sea el origen de los mismos (formularios online, correo electr&oacute;nico, correo ordinario, conversaciones telef&oacute;nicas y en general cualquier tipo de documentaci&oacute;n) ser&aacute;n incorporados a un fichero cuyo responsable y titular es ANNAIS EVENTS, con la finalidad de facilitarle la informaci&oacute;n que nos pueda requerir acerca de los diferentes servicios que ofrecemos</p>\r\n\r\n<p>Asimismo le informamos que puede ejercitar sus derechos de acceso, rectificaci&oacute;n, cancelaci&oacute;n y oposici&oacute;n al mencionado fichero mediante env&iacute;o de solicitud indicando su nombre, apellidos y DNI por cualquiera de los siguientes medios:</p>\r\n\r\n<ul>\r\n <li>Correo electr&oacute;nico\r\n <ul>\r\n  <li>info@annaisevents.com</li>\r\n </ul>\r\n </li>\r\n <li>Correo ordinario\r\n <ul>\r\n  <li>Calle Ferm&iacute;n Aranda<br />\r\n  S/N, Centro empresarial, 2&ordf; planta<br />\r\n  11407, Jerez</li>\r\n </ul>\r\n </li>\r\n</ul>\r\n\r\n<h3>Aviso legal sobre el uso de cookies</h3>\r\n\r\n<p>Las cookies son ficheros enviados a un navegador por medio de un servidor web para registrar algunas actividades del usuario en el sitio web. Las cookies que instalamos nosotros, nuestros socios comerciales u otras partes cuando visitas este sitio web no te reconocen personalmente como individuo ni da&ntilde;an tu dispositivo de forma alguna; s&oacute;lo reconocen el dispositivo que utilizas, te permiten acceder a varias funciones importantes del sitio web, mantienen seguras &aacute;reas privadas del sitio web, recuerdan tus preferencias, personalizan el contenido del sitio web de forma que sea m&aacute;s pertinente para ti y nos permiten contar el n&uacute;mero de visitas que recibimos en cada p&aacute;gina y hacer an&aacute;lisis estad&iacute;sticos an&oacute;nimos para mejorar nuestro servicio.</p>\r\n\r\n<p>Aqu&iacute; te informamos del tipo de cookies que actualmente usamos en nuestro sitio web:</p>\r\n\r\n<table class=\"table table-bordered\">\r\n <thead>\r\n  <tr>\r\n   <th>Finalidad</th>\r\n   <th>Detalles</th>\r\n  </tr>\r\n </thead>\r\n <tbody>\r\n  <tr>\r\n   <td>Control de sesi&oacute;n</td>\r\n   <td>Son archivos de cookies temporales, que se borran cuando cierras el navegador. Cuando reinicias el navegador y vuelves al sitio que cre&oacute; la cookie, la p&aacute;gina web no te reconocer&aacute;. Tendr&aacute;s que volver a iniciar sesi&oacute;n (si es necesario hacerlo) o seleccionar tus preferencias y temas de nuevo si el sitio utiliza esas funciones. Una cookie de sesi&oacute;n nueva se generar&aacute; y almacenar&aacute; tu informaci&oacute;n de navegaci&oacute;n, permaneciendo activa hasta que abandones la p&aacute;gina y cierres el navegador. M&aacute;s sobre las cookies de sesi&oacute;n.</td>\r\n  </tr>\r\n  <tr>\r\n   <td>Preferencias</td>\r\n   <td>Permiten que el sitio recuerde tus preferencias de aspecto o funcionamiento, si las desactivas puede que el sitio no tenga la funcionalidad necesaria y que su experiencia sea peor, ya que tendr&aacute; que seleccionar las preferencias cada vez que acceda al sitio.</td>\r\n  </tr>\r\n  <tr>\r\n   <td>An&aacute;lisis</td>\r\n   <td>Nos permiten saber c&oacute;mo interact&uacute;a cada usuario con nuestro sitio web (Por ejemplo que apartados resultan de mayor inter&eacute;s, cuantas personas han visitado el sitio...). Esta informaci&oacute;n se trata de forma an&oacute;nima con el fin de conocer qu&eacute; interesa m&aacute;s a nuestro p&uacute;blico y c&oacute;mo podemos mejorar la oferta de productos y servicios, el funcionamiento del sitio web o tu experiencia como usuario</td>\r\n  </tr>\r\n </tbody>\r\n</table>\r\n\r\n<p>Para activar/desactivar las cookies tendr&aacute;s que hacerlo a trav&eacute;s de tu navegador de Internet. Puedes configurarlo para ser avisado en pantalla de la recepci&oacute;n de cookies y aceptarlas o no individualmente as&iacute; como para impedir por defecto su instalaci&oacute;n en tu disco duro. Aqu&iacute; tienes informaci&oacute;n sobre como activar/desactivar las cookies de tu navegador. En el caso de que tu navegador no acepte las cookies por defecto, tu experiencia en el sitio web puede ser limitada (por ejemplo, puede que no puedas realizar una compra satisfactoriamente).</p>\r\n\r\n<table class=\"table table-bordered\">\r\n <thead>\r\n  <tr>\r\n   <th>Navegador</th>\r\n   <th>Pasos a seguir</th>\r\n  </tr>\r\n </thead>\r\n <tbody>\r\n  <tr>\r\n   <td>Google Chrome</td>\r\n   <td>\r\n   <ul>\r\n    <li>En el men&uacute; de configuraci&oacute;n, en la parte superior derecha del navegador.</li>\r\n    <li>Selecciona &#39;Opciones&#39; (Configuraci&oacute;n en MAC) y haz clic en &#39;Mostrar opciones avanzadas&#39;.</li>\r\n    <li>Selecciona &#39;Configuraci&oacute;n de contenido&#39;.</li>\r\n    <li>En el apartado de cookies selecciona &#39;Permitir que se almacenen datos locales (recomendado)&#39;.</li>\r\n   </ul>\r\n   </td>\r\n  </tr>\r\n  <tr>\r\n   <td>Firefox</td>\r\n   <td>\r\n   <ul>\r\n    <li>En el men&uacute; Herramientas selecciona &#39;Opciones&#39;.</li>\r\n    <li>Selecciona la etiqueta de privacidad en la parte superior de la ventana.</li>\r\n    <li>Del men&uacute; desplegable elige &#39;usar configuraci&oacute;n personalizada para el historial&#39;. Esto mostrar&aacute; las opciones de cookies y podr&aacute;s activarlas o desactivarlas.</li>\r\n   </ul>\r\n   </td>\r\n  </tr>\r\n  <tr>\r\n   <td>Firefox para MAC</td>\r\n   <td>\r\n   <ul>\r\n    <li>En el men&uacute; de herramientas superior, haz click en Firefox y selecciona &#39;Preferencias&#39;</li>\r\n    <li>Haz click en privacidad.</li>\r\n    <li>En el apartado Historial, selecciona de la pesta&ntilde;a desplegable &#39;Usar una configuraci&oacute;n personalizada para el historial&#39;</li>\r\n    <li>Marca aceptar cookies y aceptar cookies de terceros</li>\r\n   </ul>\r\n   </td>\r\n  </tr>\r\n  <tr>\r\n   <td>IE6+</td>\r\n   <td>\r\n   <ul>\r\n    <li>En el men&uacute; de herramientas, selecciona &#39;Opciones de Internet&#39;</li>\r\n    <li>Haz clic en la pesta&ntilde;a de privacidad</li>\r\n    <li>Hay un cursor de desplazamiento para configurar la privacidad que tiene seis posiciones para controlar la cantidad de cookies que se instalar&aacute;n.</li>\r\n   </ul>\r\n   </td>\r\n  </tr>\r\n  <tr>\r\n   <td>Safari</td>\r\n   <td>\r\n   <ul>\r\n    <li>En el men&uacute; de herramientas superior, haz clic en Safari y selecciona &#39;Preferencias&#39;.</li>\r\n    <li>Abre la pesta&ntilde;a de privacidad.</li>\r\n    <li>Seleccione la opci&oacute;n que quiera de la secci&oacute;n de &#39;bloquear cookies&#39;.</li>\r\n   </ul>\r\n   </td>\r\n  </tr>\r\n </tbody>\r\n</table>\r\n\r\n<h3>Exclusi&oacute;n de garant&iacute;a y responsabilidad</h3>\r\n\r\n<p>ANNAIS EVENTS no se hace responsable, en ning&uacute;n caso, de los da&ntilde;os y perjuicios de cualquier naturaleza que pudieran ocasionar, a t&iacute;tulo enunciativo: errores u omisiones en los contenidos, falta de disponibilidad del portal o la transmisi&oacute;n de virus o programas maliciosos o lesivos en los contenidos, a pesar de haber adoptado todas las medidas tecnol&oacute;gicas necesarias para evitarlo.</p>\r\n\r\n<h3>Modificaciones</h3>\r\n\r\n<p>ANNAIS EVENTS se reserva el derecho de efectuar sin previo aviso las modificaciones que considere oportunas en su portal, pudiendo cambiar, suprimir o a&ntilde;adir tanto los contenidos y servicios que se presten a trav&eacute;s de la misma como la forma en la que &eacute;stos aparezcan presentados o localizados en su portal.</p>\r\n\r\n<h3>Enlaces</h3>\r\n\r\n<p>En el caso de que en www.annaisevents.com se dispusiesen enlaces o hiperv&iacute;nculos hac&iacute;a otros sitios de Internet, ANNAIS EVENTS no ejercer&aacute; ning&uacute;n tipo de control sobre dichos sitios y contenidos. En ning&uacute;n caso ANNAIS EVENTS asumir&aacute; responsabilidad alguna por los contenidos de alg&uacute;n enlace perteneciente a un sitio web ajeno, ni garantizar&aacute; la disponibilidad t&eacute;cnica, calidad, fiabilidad, exactitud, amplitud, veracidad, validez y constitucionalidad de cualquier material o informaci&oacute;n contenida en ninguno de dichos hiperv&iacute;nculos u otros sitios de Internet. Igualmente la inclusi&oacute;n de estas conexiones externas no implicar&aacute; ning&uacute;n tipo de asociaci&oacute;n, fusi&oacute;n o participaci&oacute;n con las entidades conectadas.</p>\r\n\r\n<h3>Derecho de exclusi&oacute;n</h3>\r\n\r\n<p>ANNAIS EVENTS se reserva el derecho a denegar o retirar el acceso al portal y/o los servicios ofrecidos sin necesidad de preaviso, a instancia propia o de un tercero, a aquellos usuarios que incumplan las presentes Condiciones Generales de Uso.</p>\r\n\r\n<h3>Generalidades</h3>\r\n\r\n<p>ANNAIS EVENTS perseguir&aacute; el incumplimiento de las presentes condiciones as&iacute; como cualquier utilizaci&oacute;n indebida de su portal ejerciendo todas las acciones civiles y penales que le puedan corresponder en derecho.</p>\r\n\r\n<h3>Modificaci&oacute;n de las presentes condiciones y duraci&oacute;n</h3>\r\n\r\n<p>ANNAIS EVENTS podr&aacute; modificar en cualquier momento las condiciones aqu&iacute; determinadas, siendo debidamente publicadas como aqu&iacute; aparecen. La vigencia de las citadas condiciones ir&aacute; en funci&oacute;n de su exposici&oacute;n y estar&aacute;n vigentes hasta que sean modificadas por otras debidamente publicadas.</p>\r\n\r\n<h3>Legislaci&oacute;n aplicable y jurisdicci&oacute;n</h3>\r\n\r\n<p>La relaci&oacute;n entre ANNAIS EVENTS y el USUARIO se regir&aacute; por la normativa espa&ntilde;ola vigente y cualquier controversia se someter&aacute; a los Juzgados y Tribunales de la ciudad de Jerez.</p>', 1, 30),
(46, 122, '<p><span style=\"font-size: 12pt; line-height: 115%; font-family: \'Times New Roman\', serif; color: rgb(34, 34, 34); background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;font-weight:700;\">MUSEO DE LA ATALAYA</span></p>\n\n<p><span style=\"font-size:14px;line-height: 1.6;\">Los Museos de la Atalaya combinan lo genuino del perfil bodeguero del SAL&Oacute;N DON JORGE y su patio, con el romanticismo de sus jardines, fuentes, y el palacete del s. XIX que preside el entorno. Adem&aacute;s, ofrece siempre alternativa si se produce climatolog&iacute;a adversa para exteriores.</span></p>\n\n<p><span style=\"font-size:14px;line-height: 1.6;\">El palacete alberga una colecci&oacute;n de relojes de &eacute;poca &uacute;nica en Europa, y puede contratarse tambi&eacute;n para que el reportaje gr&aacute;fico sea a&uacute;n m&aacute;s maravilloso, y los invitados sean realmente conscientes del lugar emblem&aacute;tico y especial donde se encuentran.</span></p>', 1, 56),
(60, 150, '<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<u><strong>Bienvenidos a Gesticadiz.es</strong></u></p>\r\n<p>\r\n	GESTICADIZ, nace en el 2001, nuestro personal se ha dedicado con firme prop&oacute;sito en dar un servicio inmobiliario integral a nuestros clientes y a mejorar d&iacute;a a d&iacute;a para dar el asesoramiento m&aacute;s comprometido.<br />\r\n	<br />\r\n	Si desea <strong>ALQUILAR o COMPRAR</strong>&nbsp; una vivienda, plaza de garaje, trastero, solar, terreno ... Venga a vernos, seguro que en nuestra cartera de inmuebles tenemos lo que le interesa. Queremos dar satisfacci&oacute;n a la demanda actual y lo que es m&aacute;s importante, queremos seguir estando al servicio de nuestros clientes. Para resolver cualquier duda env&Iacute;enos un MAIL a gesticadiz@gmail.com, con las necesidades que desean para el alquiler o compra de su inmueble: espacio, divisi&oacute;n, planta, a&ntilde;os de construcci&oacute;n, situaci&oacute;n, calidades, precio... y nos pondremos a trabajar inmediatamente para contestarle en la mayor brevedad posible y as&iacute; hacer posible su deseo.</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://openrs.es/demo/uploads/general/escaparate_gesticadiz.jpg\" style=\"width: 637px; height: 324px;\" /><br />\r\n	<br />\r\n	Tambi&eacute;n gestionamos y tramitamos toda la GESTI&Oacute;N FINANCIERA, a medida de sus necesidades. Nuestra base es la atenci&oacute;n a nuestros nuestros clientes. Registre su propiedad con GESTICADIZ para VENDER o ALQUILAR su inmueble de la manera m&aacute;s efectiva, y con el equipo m&aacute;s confiable en el sector. Adem&aacute;s disponemos de colaboraci&oacute;n profesional y emitimos certificado de eficiencia energ&eacute;tica.<br />\r\n	<br />\r\n	<u><strong>Cerfificado de eficencia energ&eacute;tica</strong></u><br />\r\n	<br />\r\n	El d&iacute;a 1 de Junio entr&oacute; en vigor el R.D. 235/2013 de 5 de Abril, que regula la certificaci&oacute;n de eficiencia energ&eacute;tica de los edificios. Este decreto obliga a que todos los inmuebles que se vendan o se arrienden dispongan de un certificado de eficiencia energ&eacute;tica.<br />\r\n	Informaci&oacute;n<br />\r\n	<br />\r\n	<br />\r\n	<strong>Denominaci&oacute;n social</strong>: GESTICADIZ (GLORIA CHAMORRO ROMERO)<br />\r\n	<br />\r\n	<strong>NIF</strong>: 31260553B<br />\r\n	<br />\r\n	<strong>Domicilio</strong>: Avenida Ana de Viya, 3. C.P: 11009 C&aacute;diz<br />\r\n	<br />\r\n	<strong>Email</strong>: gesticadiz@gmail.com<br />\r\n	<br />\r\n	<strong>Tel&eacute;fono / Fax</strong>: 956 262 425<br />\r\n	<br />\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>', 1, 70),
(65, 164, '<p>\r\n	Buscador</p>', 1, 82),
(66, 164, '<p>\r\n	Search</p>', 53, 82),
(67, 167, '<p>\r\n	blog</p>', 1, 83),
(68, 167, '<p>\r\n	blog</p>', 53, 83),
(69, 0, '<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<u><strong>Welcome to Gesticadiz.es</strong></u><br />\r\n	<br />\r\n	GESTICADIZ, born in 2001, our staff has been dedicated with a firm purpose in providing a comprehensive real estate service to our clients and improving day to day to give the most committed advice.<br />\r\n	<br />\r\n	If you want to <strong>RENT or BUY</strong> a house, garage, storage room, plot, land ... Come and see us, we are sure that in our portfolio of properties we have what interests you. We want to satisfy the current demand and what is more important, we want to continue being at the service of our customers. To solve any doubt send us a MAIL to gesticadiz@gmail.com, with the necessities you want for the rent or purchase of your property: space, division, plant, years of construction, situation, qualities, price ... and we will get to Work immediately to answer you as soon as possible and thus make possible your wish.<br />\r\n	<br />\r\n	<img alt=\"\" src=\"http://openrs.es/demo/uploads/general/escaparate_gesticadiz.jpg\" style=\"width: 637px; height: 324px;\" /><br />\r\n	<br />\r\n	<br />\r\n	We also manage and handle all the <strong>FINANCIAL MANAGEMENT</strong>, according to your needs. Our base is the attention to our our customers. Register your property with GESTICADIZ to sell or rent your property in the most effective way, and with the most reliable equipment in the sector. In addition we have professional collaboration and we issue certificate of energy efficiency.<br />\r\n	<br />\r\n	<u><strong>Certified for energy efficiency</strong></u><br />\r\n	<br />\r\n	On June 1 came into force the R.D. 235/2013 of April 5, which regulates the certification of energy efficiency of buildings. This decree obliges all properties sold or leased to have a certificate of energy efficiency.<br />\r\n	information<br />\r\n	<br />\r\n	<br />\r\n	<strong>Corporate name</strong>: GESTICADIZ (GLORIA CHAMORRO ROMERO)<br />\r\n	<br />\r\n	<strong>NIF</strong>: 31260553B<br />\r\n	<br />\r\n	<strong>Address</strong>: Avenida Ana de Viya, 3. C.P: 11009 C&aacute;diz<br />\r\n	<br />\r\n	<strong>Email</strong>: gesticadiz@gmail.com<br />\r\n	<br />\r\n	<strong>Telephone / Fax</strong>: 956 262 425</p>', 53, 70),
(70, 168, '<div class=\"col-md-6\">\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		<img alt=\"\" src=\"http://openrs.es/demo/uploads/general/barco.png\" style=\"width: 443px; height: 344px;\" /></p>\r\n	<h1>\r\n		<strong>Nuestros trabajos abarcan diversos campos:</strong></h1>\r\n	&bull; Proyectos Obra nueva.<br />\r\n	&bull; Proyectos de Rehabilitaci&oacute;n.<br />\r\n	&bull; Gesti&oacute;n y Direcci&oacute;n de obras.<br />\r\n	&bull; Adecuaci&oacute;n de locales.<br />\r\n	&bull; Delineaci&oacute;n y Dise&ntilde;o de interiores.<br />\r\n	&bull; Tasaciones y valoraciones.<br />\r\n	&bull; Certificaci&oacute;n de Eficiencia Energ&eacute;tica.<br />\r\n	&bull; Prevenci&oacute;n de Riesgos laborales, Seguridad y Salud.<br />\r\n	&bull; Asesoramiento y contactos con empresas constructoras y de reformas.\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		<img alt=\"\" src=\"http://openrs.es/demo/uploads/general/vistas.png\" style=\"width: 600px; height: 344px;\" /></p>\r\n</div>\r\n<div class=\"col-md-6\">\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		<img alt=\"\" src=\"http://openrs.es/demo/uploads/general/cuarto.png\" style=\"width: 451px; height: 349px;\" /></p>\r\n	<h1>\r\n		<strong>Alquileres o ventas:</strong></h1>\r\n	Nuestra empresa Gesticadiz es la inmobiliaria de C&aacute;diz con la mejor oferta de la provincia para comprar, alquilar o vender pisos, casas, apartamentos, oficinas, locales. etc Tenemos amplia experiencia en el asesoramiento para la venta o alquiler de su inmueble. Nuestras capacidades de negociaci&oacute;n son clave para que nos prefiera, a la hora de asegurar y maximizar sus ventajas competitivas en el negocio.\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		<img alt=\"\" src=\"http://openrs.es/demo/uploads/general/certificacion.png\" style=\"width: 200px; height: 150px;\" /></p>\r\n	<p>\r\n		Emitimos Certificados de Eficiencia Energ&eacute;tica, R.D. 235/2013, este decreto obliga a que todos los inmuebles que se vendan o se alquilen dispongan de este certificado.</p>\r\n</div>\r\n<div>\r\n	&nbsp;</div>', 1, 84),
(71, 168, '<div class=\"col-md-6\">\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		<img alt=\"\" src=\"http://openrs.es/demo/uploads/general/barco.png\" style=\"width: 443px; height: 344px;\" /></p>\r\n	<h1>\r\n		<strong>Nuestros trabajos abarcan diversos campos:</strong></h1>\r\n	&bull; Proyectos Obra nueva.<br />\r\n	&bull; Proyectos de Rehabilitaci&oacute;n.<br />\r\n	&bull; Gesti&oacute;n y Direcci&oacute;n de obras.<br />\r\n	&bull; Adecuaci&oacute;n de locales.<br />\r\n	&bull; Delineaci&oacute;n y Dise&ntilde;o de interiores.<br />\r\n	&bull; Tasaciones y valoraciones.<br />\r\n	&bull; Certificaci&oacute;n de Eficiencia Energ&eacute;tica.<br />\r\n	&bull; Prevenci&oacute;n de Riesgos laborales, Seguridad y Salud.<br />\r\n	&bull; Asesoramiento y contactos con empresas constructoras y de reformas.\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		<img alt=\"\" src=\"http://openrs.es/demo/uploads/general/vistas.png\" style=\"width: 443px; height: 344px;\" /></p>\r\n</div>\r\n<div class=\"col-md-6\">\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		<img alt=\"\" src=\"http://openrs.es/demo/uploads/general/cuarto.png\" style=\"width: 451px; height: 349px;\" /></p>\r\n	<h1>\r\n		<strong>Alquileres o ventas:</strong></h1>\r\n	Nuestra empresa Gesticadiz es la inmobiliaria de C&aacute;diz con la mejor oferta de la provincia para comprar, alquilar o vender pisos, casas, apartamentos, oficinas, locales. etc Tenemos amplia experiencia en el asesoramiento para la venta o alquiler de su inmueble. Nuestras capacidades de negociaci&oacute;n son clave para que nos prefiera, a la hora de asegurar y maximizar sus ventajas competitivas en el negocio.\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		<img alt=\"\" src=\"http://openrs.es/demo/uploads/general/certificacion.png\" style=\"width: 200px; height: 150px;\" /></p>\r\n	<p>\r\n		Emitimos Certificados de Eficiencia Energ&eacute;tica, R.D. 235/2013, este decreto obliga a que todos los inmuebles que se vendan o se alquilen dispongan de este certificado.</p>\r\n</div>\r\n<div>\r\n	&nbsp;</div>', 53, 84),
(72, 169, '<h2>\r\n	En cumplimiento del art&iacute;culo 10 de la Ley 34/2002, del 11 de julio, de servicios de la Sociedad de la Informaci&oacute;n y Comercio Electr&oacute;nico (LSSICE) se exponen a continuaci&oacute;n los datos identificativos de la empresa.</h2>\r\n<p>\r\n	<strong>Denominaci&oacute;n social: GESTICADIZ (GLORIA CHAMORRO ROMERO)</strong></p>\r\n<p>\r\n	NIF: 31260553B<br />\r\n	<br />\r\n	Domicilio: Avenida Ana de Viya, 3. C.P: 11009 C&aacute;diz<br />\r\n	<br />\r\n	Email: gesticadiz@gmail.com<br />\r\n	<br />\r\n	Tel&eacute;fono / Fax :956 26 24 25</p>\r\n<p>\r\n	C&oacute;digos de conducta a los que la empresa est&aacute; adherida:<br />\r\n	<br />\r\n	<strong>GESTICADIZ </strong>cumple con la Ley Org&aacute;nica 15/1999 de 13 de diciembre de Protecci&oacute;n de Datos de Car&aacute;cter Personal (LOPD).<br />\r\n	<br />\r\n	Este sitio web ha sido creado por la empresa GESTICADIZ con car&aacute;cter informativo y para uso personal de los usuarios.A trav&eacute;s de este Aviso legal, se pretende regular el acceso y uso de este sitio web, as&iacute; como la relaci&oacute;n entre el sitio web y sus usuarios. Accediendo a este sitio web se aceptan los siguientes t&eacute;rminos y condiciones: El acceso a este sitio web es responsabilidad exclusiva de los usuarios.<br />\r\n	<br />\r\n	El simple acceso a este sitio web no supone entablar ning&uacute;n tipo de relaci&oacute;n comercial entre GESTICADIZ y el usuario.<br />\r\n	<br />\r\n	El acceso y la navegaci&oacute;n en este sitio web supone aceptar y conocer las advertencias legales, condiciones y t&eacute;rminos de uso contenidas en ella.<br />\r\n	<br />\r\n	El titular del sitio web puede ofrecer servicios o productos que podr&aacute;n encontrarse sometidos a unas condiciones particulares propias que, seg&uacute;n los casos, sustituyan, completen y/o modifiquen las presentes condiciones, y sobre las cuales se informar&aacute; al usuario en cada caso concreto.</p>', 1, 85),
(73, 169, '<h2>\r\n	In compliance with article 10 of Law 34/2002, of July 11, on services of the Information Society and Electronic Commerce (LSSICE), the company&#39;s identification data are set out below.</h2>\r\n<p>\r\n	<strong>Corporate name: GESTICADIZ (GLORIA CHAMORRO ROMERO)</strong><br />\r\n	<br />\r\n	NIF: 31260553B<br />\r\n	<br />\r\n	Address: Avenida Ana de Viya, 3. C.P: 11009 C&aacute;diz<br />\r\n	<br />\r\n	Email: gesticadiz@gmail.com<br />\r\n	<br />\r\n	Telephone / Fax: 956 26 24 25<br />\r\n	<br />\r\n	Codes of conduct to which the company is affiliated:<br />\r\n	<br />\r\n	<strong>GESTICADIZ </strong>complies with Organic Law 15/1999 of 13 December on the Protection of Personal Data (LOPD).<br />\r\n	<br />\r\n	This website has been created by the company GESTICADIZ for information purposes and for the personal use of users. Through this Legal Notice, it is intended to regulate the access and use of this website, as well as the relationship between the website and its users. By accessing this website, the following terms and conditions are accepted: Access to this website is the sole responsibility of the users.<br />\r\n	<br />\r\n	Simple access to this website does not imply any commercial relationship between GESTICADIZ and the user.<br />\r\n	<br />\r\n	Access and navigation on this website means accepting and knowing the legal warnings, conditions and terms of use contained therein.<br />\r\n	<br />\r\n	The owner of the website may offer services or products that may be subject to particular conditions that substitute, complete and / or modify the present conditions, and on which the user will be informed in each specific case.</p>', 53, 85),
(74, 0, '<p>\r\n	<iframe allowfullscreen=\"\" frameborder=\"0\" height=\"450\" src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3206.7163841333986!2d-6.282358084368701!3d36.512707791528875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dd3cb33ccf691%3A0x8f5b4f6a55ad2a01!2sGesticadiz!5e0!3m2!1ses!2ses!4v1505287064830\" style=\"border:0\" width=\"600\"></iframe></p>', 53, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_certificacion_energetica`
--

DROP TABLE IF EXISTS `tipos_certificacion_energetica`;
CREATE TABLE `tipos_certificacion_energetica` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_certificacion_energetica`
--

INSERT INTO `tipos_certificacion_energetica` (`id`, `nombre`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'E'),
(9, 'En trámite'),
(8, 'Exento'),
(6, 'F'),
(7, 'G');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_ficheros`
--

DROP TABLE IF EXISTS `tipos_ficheros`;
CREATE TABLE `tipos_ficheros` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `ambito_id` tinyint(1) NOT NULL COMMENT '1 para clientes, 2 para inmuebles y 3 para demandas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_ficheros`
--

INSERT INTO `tipos_ficheros` (`id`, `nombre`, `descripcion`, `ambito_id`) VALUES
(1, 'Otros', 'Cualquier tipo de dato adjunto', 2),
(2, 'Planos', 'Planos del inmueble', 2),
(3, 'Certificado Energético', 'Informe de certificado energético', 2),
(5, 'NIF/CIF', 'Documento identificativo español', 1),
(6, 'Permiso residencia/NIE/Pasaporte', 'Documento identificativo extranjero', 1),
(7, 'Ficha visita firmada', 'Ficha de visita firmada por el demandante', 3),
(8, 'Nómina o pensión', 'Nómina o pensión', 1),
(9, 'Ficha de encargo', 'Ficha de encargo', 1),
(10, 'Ficha de desestimiento', 'Ficha de desestimiento', 1),
(11, 'Responsabilidad de certificación energética', 'Responsabilidad de certificación energética', 1),
(12, 'Presupuesto servicios prestados', 'Presupuesto servicios prestados', 1),
(13, 'Presupuesto', 'Presupuesto', 3),
(14, 'Factura de servicios prestados', 'Factura de servicios prestados', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_inmueble`
--

DROP TABLE IF EXISTS `tipos_inmueble`;
CREATE TABLE `tipos_inmueble` (
  `id` int(11) UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_inmueble`
--

INSERT INTO `tipos_inmueble` (`id`, `descripcion`) VALUES
(1, 'Piso'),
(2, 'Vivienda unifamiliar'),
(3, 'Local comercial'),
(4, 'Oficina'),
(5, 'Garaje'),
(6, 'Trastero'),
(9, 'Duplex'),
(10, 'Triplex'),
(11, 'Ático'),
(12, 'Chalet'),
(13, 'Casa rústica'),
(14, 'Cortijo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_inmueble_idiomas`
--

DROP TABLE IF EXISTS `tipos_inmueble_idiomas`;
CREATE TABLE `tipos_inmueble_idiomas` (
  `id` int(11) UNSIGNED NOT NULL,
  `idioma_id` int(11) UNSIGNED NOT NULL,
  `tipo_inmueble_id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_inmueble_idiomas`
--

INSERT INTO `tipos_inmueble_idiomas` (`id`, `idioma_id`, `tipo_inmueble_id`, `nombre`) VALUES
(1, 1, 1, 'Piso'),
(2, 1, 2, 'Unifamiliar'),
(3, 1, 3, 'Local comercial'),
(4, 1, 4, 'Oficina'),
(5, 1, 5, 'Garaje'),
(6, 1, 6, 'Trastero'),
(7, 53, 1, 'Flat'),
(8, 53, 2, 'Detached'),
(9, 53, 3, 'Commerce place'),
(10, 53, 4, 'Office'),
(11, 53, 5, 'Garage'),
(12, 53, 6, 'Storege Room'),
(19, 1, 9, 'Duplex'),
(20, 53, 9, 'Duplex'),
(21, 1, 10, 'Triplex'),
(22, 53, 10, 'Triplex'),
(23, 1, 11, 'Ático'),
(24, 53, 11, 'Penthouse'),
(25, 1, 12, 'Chalet'),
(26, 53, 12, 'Chalet'),
(27, 1, 13, 'Casa rústica'),
(28, 53, 13, 'Rustic house'),
(29, 1, 14, 'Cortijo'),
(30, 53, 14, 'Farmhouse');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_plantilla_documentacion`
--

DROP TABLE IF EXISTS `tipos_plantilla_documentacion`;
CREATE TABLE `tipos_plantilla_documentacion` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_plantilla_documentacion`
--

INSERT INTO `tipos_plantilla_documentacion` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Ficha del Inmueble', ''),
(2, 'Ficha del Cliente', ''),
(3, 'Cartel Publicitario', ''),
(5, 'Ficha demanda', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_plantilla_documentacion_categorias_asignadas`
--

DROP TABLE IF EXISTS `tipos_plantilla_documentacion_categorias_asignadas`;
CREATE TABLE `tipos_plantilla_documentacion_categorias_asignadas` (
  `id` int(11) UNSIGNED NOT NULL,
  `tipo_plantilla_id` int(11) UNSIGNED NOT NULL,
  `categoria_inf_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_plantilla_documentacion_categorias_asignadas`
--

INSERT INTO `tipos_plantilla_documentacion_categorias_asignadas` (`id`, `tipo_plantilla_id`, `categoria_inf_id`) VALUES
(4, 1, 1),
(5, 1, 3),
(6, 1, 4),
(1, 2, 1),
(2, 2, 2),
(3, 2, 4),
(7, 3, 1),
(9, 3, 3),
(10, 3, 4),
(14, 3, 6),
(15, 5, 1),
(16, 5, 4),
(17, 5, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_bloque`
--

DROP TABLE IF EXISTS `tipo_bloque`;
CREATE TABLE `tipo_bloque` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_bloque`
--

INSERT INTO `tipo_bloque` (`id`, `nombre`) VALUES
(2, 'Carrusel'),
(4, 'Iframe'),
(1, 'Texto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `id_idioma` int(11) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `id_idioma`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$VI5n9IWQTleuaYeCXC6GC.rwukG3pAefzyeklQHtbuCvb6QbHqG7S', '', 'admin@admin.com', '', 'Zgv-Ds800Ipv5dUJ9W5voeb24faf75ba7d384864', 1497439234, '5WVn2K8m0Nh7QSejVqpsnu', 1268889823, 1505241048, 1, 'Admin', 'istrator', 'ADMIN', '0', 1),
(2, '::1', '', '$2y$08$JyarJJAPxD9uVXWRRg2GG.zzFLlxzEVnooEjOpDDi8bmhfHH1YXta', NULL, 'angel.berasuain@gmail.com', NULL, NULL, NULL, '.4jTxnqEARSbI.cHKG57Yu', 1439033987, 1505286369, 1, 'Ángel Luis ', 'Berasuain Ruiz', 'Casa', '956787897', 1),
(3, '::1', '', '$2y$08$R1fViL1zYZ/ADEiI8Jowp.opD.M/QBEU9D9NxZCdsL.gkR8p0qv9S', NULL, 'klaimir@hotmail.com', NULL, '57gN.HY-.wzon54HAjqBHO184121eb879b1da196', 1494440437, NULL, 1439314022, NULL, 1, 'Antonio', 'López', NULL, '956080808', 1),
(4, '127.0.0.1', '', '$2y$08$fFDDw6Y9017DOY5yPWU3rOSzlO5IPNsvXMwrKEvc.b1krzRBU/Sl.', NULL, 'mberasuain@gmail.com', NULL, NULL, NULL, '.0tMWtRxPjRHtaJp44PZ7O', 1502186002, 1503398232, 1, 'María Eugenía', 'Berasuain Ruiz', NULL, '956010203', 1),
(5, '127.0.0.1', '', '$2y$08$Jx8iyshpeK1.icZQIjWikuRulyDgDstklMXCn2vkq2bVqcDUg1EBm', NULL, 'irelfita@hotmail.com', NULL, NULL, NULL, NULL, 1502974076, 1503684399, 1, 'Irene', 'Forja Barriga', NULL, '611223344', 1),
(6, '37.132.6.253', '', '$2y$08$dd1XlFN5m.g4O9tSFrd.6uDX2P5MZeWj37oGNxsYy.6B9Tvd/RgA2', NULL, 'mluz1712@gmail.com', NULL, NULL, NULL, '1FX12rCvjRGhPgF9BwsjcO', 1503392044, 1503936733, 1, 'María de la Luz', 'Cara Marqués', NULL, '950313438', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(52, 1, 1),
(53, 1, 2),
(56, 2, 1),
(57, 2, 2),
(30, 3, 2),
(46, 4, 1),
(47, 4, 2),
(28, 5, 1),
(29, 5, 2),
(42, 6, 1),
(43, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votos`
--

DROP TABLE IF EXISTS `votos`;
CREATE TABLE `votos` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip` varchar(50) CHARACTER SET latin1 NOT NULL,
  `id_articulo` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `votos`
--

INSERT INTO `votos` (`id`, `ip`, `id_articulo`) VALUES
(1, '83.46.213.236', 1),
(2, '37.132.6.253', 2);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_backups`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `v_backups`;
CREATE TABLE `v_backups` (
`backup_id` int(11) unsigned
,`backup_name` varchar(255)
,`backup_location` varchar(255)
,`backup_type` int(1)
,`created_date` timestamp
,`admin_id` int(11) unsigned
,`tipo_backup` varchar(13)
,`fecha_hora` varchar(24)
,`nombre_admin` varchar(102)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_clientes`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `v_clientes`;
CREATE TABLE `v_clientes` (
`id` int(11) unsigned
,`nombre` varchar(100)
,`apellidos` varchar(150)
,`fecha_nac` date
,`direccion` varchar(200)
,`pais_id` int(11) unsigned
,`poblacion_id` int(11) unsigned
,`telefonos` varchar(70)
,`nif` varchar(11)
,`observaciones` text
,`fecha_alta` datetime
,`fecha_actualizacion` datetime
,`correo` varchar(250)
,`estado_id` int(11) unsigned
,`agente_asignado_id` int(11) unsigned
,`medio_captacion_id` int(11) unsigned
,`nombre_poblacion` varchar(100)
,`provincia_id` int(11) unsigned
,`nombre_provincia` varchar(255)
,`nombre_pais` varchar(150)
,`nombre_estado` varchar(50)
,`historico_estado` tinyint(1)
,`nombre_medio_captacion` varchar(150)
,`nombre_agente_asignado` varchar(102)
,`mes_alta` varchar(2)
,`anio_alta` varchar(4)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_clientes_ficheros`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `v_clientes_ficheros`;
CREATE TABLE `v_clientes_ficheros` (
`id` int(11) unsigned
,`cliente_id` int(11) unsigned
,`texto_fichero` text
,`fichero` varchar(255)
,`tipo_fichero_id` int(11) unsigned
,`nombre_tipo` varchar(150)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_clientes_inmuebles`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `v_clientes_inmuebles`;
CREATE TABLE `v_clientes_inmuebles` (
`id` int(11) unsigned
,`cliente_id` int(11) unsigned
,`inmueble_id` int(11) unsigned
,`precio_compra` int(10) unsigned
,`precio_alquiler` int(7) unsigned
,`historico` tinyint(1)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_demandas`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `v_demandas`;
CREATE TABLE `v_demandas` (
`id` int(11) unsigned
,`referencia` varchar(40)
,`metros_desde` int(4)
,`metros_hasta` int(4)
,`habitaciones_desde` int(2)
,`habitaciones_hasta` int(2)
,`banios_desde` int(2)
,`banios_hasta` int(2)
,`precio_desde` int(10) unsigned
,`precio_hasta` int(10) unsigned
,`provincia_id` int(11) unsigned
,`poblacion_id` int(11) unsigned
,`observaciones` text
,`estado_id` int(11) unsigned
,`certificacion_energetica_id` int(11) unsigned
,`anio_construccion_desde` int(4)
,`anio_construccion_hasta` int(4)
,`agente_asignado_id` int(11) unsigned
,`oferta_id` int(2)
,`tipo_demanda_id` int(2)
,`cliente_id` int(11) unsigned
,`fecha_alta` date
,`fecha_actualizacion` datetime
,`nombre_poblacion` varchar(100)
,`nombre_provincia` varchar(255)
,`nombre_certificacion_energetica` varchar(10)
,`nombre_estado` varchar(50)
,`historico` tinyint(1)
,`nombre_agente_asignado` varchar(102)
,`nombre_cliente` varchar(252)
,`mes_alta` varchar(2)
,`anio_alta` varchar(4)
,`nombre_oferta` varchar(16)
,`nombre_tipo_demanda` varchar(23)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_demandas_ficheros`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `v_demandas_ficheros`;
CREATE TABLE `v_demandas_ficheros` (
`id` int(11) unsigned
,`demanda_id` int(11) unsigned
,`texto_fichero` text
,`fichero` varchar(255)
,`tipo_fichero_id` int(11) unsigned
,`nombre_tipo` varchar(150)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_demandas_tipos_inmueble`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `v_demandas_tipos_inmueble`;
CREATE TABLE `v_demandas_tipos_inmueble` (
`id` int(11) unsigned
,`demanda_id` int(11) unsigned
,`tipo_id` int(11) unsigned
,`nombre_tipo_inmueble` varchar(100)
,`idioma_id` int(11) unsigned
,`historico` tinyint(1)
,`agente_asignado_id` int(11) unsigned
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_estados`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `v_estados`;
CREATE TABLE `v_estados` (
`id` int(11) unsigned
,`ambito_id` tinyint(1)
,`nombre` varchar(50)
,`descripcion` varchar(120)
,`historico` tinyint(1)
,`nombre_ambito` varchar(9)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_inmuebles`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `v_inmuebles`;
CREATE TABLE `v_inmuebles` (
`id` int(11) unsigned
,`referencia` varchar(40)
,`metros` int(4)
,`metros_utiles` int(4)
,`habitaciones` int(2)
,`banios` int(2)
,`precio_compra` int(10) unsigned
,`precio_compra_anterior` int(10) unsigned
,`precio_alquiler` int(7) unsigned
,`precio_alquiler_anterior` int(10) unsigned
,`poblacion_id` int(11) unsigned
,`zona_id` int(11) unsigned
,`tipo_id` int(11) unsigned
,`observaciones` text
,`direccion` varchar(100)
,`direccion_publica` varchar(100)
,`publicado` tinyint(1)
,`estado_id` int(11) unsigned
,`certificacion_energetica_id` int(11) unsigned
,`kwh_m2_anio` int(5)
,`captador_id` int(11) unsigned
,`fecha_alta` date
,`fecha_actualizacion` datetime
,`anio_construccion` int(4)
,`oportunidad` tinyint(1)
,`destacado` tinyint(1)
,`nombre_poblacion` varchar(100)
,`provincia_id` int(11) unsigned
,`nombre_provincia` varchar(255)
,`nombre_zona` varchar(200)
,`nombre_tipo` varchar(100)
,`idioma_id` int(11) unsigned
,`nombre_certificacion_energetica` varchar(10)
,`nombre_estado` varchar(50)
,`historico_estado` tinyint(1)
,`nombre_captador` varchar(102)
,`cartel_id` int(11) unsigned
,`cartel_impreso` tinyint(1)
,`mes_alta` varchar(2)
,`anio_alta` varchar(4)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_inmuebles_demandas`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `v_inmuebles_demandas`;
CREATE TABLE `v_inmuebles_demandas` (
`id` int(11) unsigned
,`referencia` varchar(40)
,`metros` int(4)
,`metros_utiles` int(4)
,`habitaciones` int(2)
,`banios` int(2)
,`precio_compra` int(10) unsigned
,`precio_compra_anterior` int(10) unsigned
,`precio_alquiler` int(7) unsigned
,`precio_alquiler_anterior` int(10) unsigned
,`poblacion_id` int(11) unsigned
,`zona_id` int(11) unsigned
,`tipo_id` int(11) unsigned
,`observaciones` text
,`direccion` varchar(100)
,`direccion_publica` varchar(100)
,`publicado` tinyint(1)
,`estado_id` int(11) unsigned
,`certificacion_energetica_id` int(11) unsigned
,`kwh_m2_anio` int(5)
,`captador_id` int(11) unsigned
,`fecha_alta` date
,`fecha_actualizacion` datetime
,`anio_construccion` int(4)
,`oportunidad` tinyint(1)
,`destacado` tinyint(1)
,`nombre_poblacion` varchar(100)
,`provincia_id` int(11) unsigned
,`nombre_provincia` varchar(255)
,`nombre_zona` varchar(200)
,`nombre_tipo` varchar(100)
,`idioma_id` int(11) unsigned
,`nombre_certificacion_energetica` varchar(10)
,`nombre_estado` varchar(50)
,`historico_estado` tinyint(1)
,`nombre_captador` varchar(102)
,`cartel_id` int(11) unsigned
,`cartel_impreso` tinyint(1)
,`mes_alta` varchar(2)
,`anio_alta` varchar(4)
,`cliente_id` int(11) unsigned
,`agente_asignado_id` int(11) unsigned
,`referencia_demanda` varchar(40)
,`historico_demanda` tinyint(1)
,`demanda_id` int(11) unsigned
,`origen_id` tinyint(1)
,`evaluacion_id` tinyint(1)
,`observaciones_demanda` varchar(255)
,`fecha_asignacion` date
,`fecha_asignacion_formateada` varchar(10)
,`inmueble_demanda_id` int(11) unsigned
,`nombre_origen` varchar(6)
,`nombre_evaluacion` varchar(26)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_inmuebles_ficheros`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `v_inmuebles_ficheros`;
CREATE TABLE `v_inmuebles_ficheros` (
`id` int(11) unsigned
,`inmueble_id` int(11) unsigned
,`fichero` varchar(200)
,`texto_fichero` text
,`tipo_fichero_id` int(11) unsigned
,`nombre_tipo` varchar(150)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_tipos_ficheros`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `v_tipos_ficheros`;
CREATE TABLE `v_tipos_ficheros` (
`id` int(11) unsigned
,`nombre` varchar(150)
,`descripcion` varchar(255)
,`ambito_id` tinyint(1)
,`nombre_ambito` varchar(9)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_backups`
--
DROP TABLE IF EXISTS `v_backups`;

CREATE OR REPLACE VIEW `v_backups`  AS  select `backup`.`backup_id` AS `backup_id`,`backup`.`backup_name` AS `backup_name`,`backup`.`backup_location` AS `backup_location`,`backup`.`backup_type` AS `backup_type`,`backup`.`created_date` AS `created_date`,`backup`.`admin_id` AS `admin_id`,(case `backup`.`backup_type` when 1 then 'Base de datos' when 2 then 'Ficheros' when 3 then 'Completa' end) AS `tipo_backup`,date_format(`backup`.`created_date`,'%d/%m/%Y %H:%i:%s') AS `fecha_hora`,concat_ws(', ',`users`.`last_name`,`users`.`first_name`) AS `nombre_admin` from (`backup` join `users` on((`backup`.`admin_id` = `users`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_clientes`
--
DROP TABLE IF EXISTS `v_clientes`;

CREATE OR REPLACE VIEW `v_clientes`  AS  select `clientes`.`id` AS `id`,`clientes`.`nombre` AS `nombre`,`clientes`.`apellidos` AS `apellidos`,`clientes`.`fecha_nac` AS `fecha_nac`,`clientes`.`direccion` AS `direccion`,`clientes`.`pais_id` AS `pais_id`,`clientes`.`poblacion_id` AS `poblacion_id`,`clientes`.`telefonos` AS `telefonos`,`clientes`.`nif` AS `nif`,`clientes`.`observaciones` AS `observaciones`,`clientes`.`fecha_alta` AS `fecha_alta`,`clientes`.`fecha_actualizacion` AS `fecha_actualizacion`,`clientes`.`correo` AS `correo`,`clientes`.`estado_id` AS `estado_id`,`clientes`.`agente_asignado_id` AS `agente_asignado_id`,`clientes`.`medio_captacion_id` AS `medio_captacion_id`,`poblaciones`.`poblacion` AS `nombre_poblacion`,`poblaciones`.`provincia_id` AS `provincia_id`,`provincias`.`provincia` AS `nombre_provincia`,`paises`.`nombre` AS `nombre_pais`,`estados`.`nombre` AS `nombre_estado`,`estados`.`historico` AS `historico_estado`,`medios_captacion`.`nombre` AS `nombre_medio_captacion`,concat_ws(', ',`users`.`last_name`,`users`.`first_name`) AS `nombre_agente_asignado`,date_format(`clientes`.`fecha_alta`,'%c') AS `mes_alta`,date_format(`clientes`.`fecha_alta`,'%Y') AS `anio_alta` from ((((((`clientes` join `estados` on((`clientes`.`estado_id` = `estados`.`id`))) join `medios_captacion` on((`clientes`.`medio_captacion_id` = `medios_captacion`.`id`))) left join `poblaciones` on((`clientes`.`poblacion_id` = `poblaciones`.`id`))) left join `provincias` on((`poblaciones`.`provincia_id` = `provincias`.`id`))) join `paises` on((`clientes`.`pais_id` = `paises`.`id`))) left join `users` on((`clientes`.`agente_asignado_id` = `users`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_clientes_ficheros`
--
DROP TABLE IF EXISTS `v_clientes_ficheros`;

CREATE OR REPLACE VIEW `v_clientes_ficheros`  AS  select `clientes_ficheros`.`id` AS `id`,`clientes_ficheros`.`cliente_id` AS `cliente_id`,`clientes_ficheros`.`texto_fichero` AS `texto_fichero`,`clientes_ficheros`.`fichero` AS `fichero`,`clientes_ficheros`.`tipo_fichero_id` AS `tipo_fichero_id`,`tipos_ficheros`.`nombre` AS `nombre_tipo` from (`clientes_ficheros` join `tipos_ficheros` on((`clientes_ficheros`.`tipo_fichero_id` = `tipos_ficheros`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_clientes_inmuebles`
--
DROP TABLE IF EXISTS `v_clientes_inmuebles`;

CREATE OR REPLACE VIEW `v_clientes_inmuebles`  AS  select `clientes_inmuebles`.`id` AS `id`,`clientes_inmuebles`.`cliente_id` AS `cliente_id`,`clientes_inmuebles`.`inmueble_id` AS `inmueble_id`,`inmuebles`.`precio_compra` AS `precio_compra`,`inmuebles`.`precio_alquiler` AS `precio_alquiler`,`estados`.`historico` AS `historico` from ((`clientes_inmuebles` join `inmuebles` on((`clientes_inmuebles`.`inmueble_id` = `inmuebles`.`id`))) join `estados` on((`inmuebles`.`estado_id` = `estados`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_demandas`
--
DROP TABLE IF EXISTS `v_demandas`;

CREATE OR REPLACE VIEW `v_demandas`  AS  select `demandas`.`id` AS `id`,`demandas`.`referencia` AS `referencia`,`demandas`.`metros_desde` AS `metros_desde`,`demandas`.`metros_hasta` AS `metros_hasta`,`demandas`.`habitaciones_desde` AS `habitaciones_desde`,`demandas`.`habitaciones_hasta` AS `habitaciones_hasta`,`demandas`.`banios_desde` AS `banios_desde`,`demandas`.`banios_hasta` AS `banios_hasta`,`demandas`.`precio_desde` AS `precio_desde`,`demandas`.`precio_hasta` AS `precio_hasta`,`demandas`.`provincia_id` AS `provincia_id`,`demandas`.`poblacion_id` AS `poblacion_id`,`demandas`.`observaciones` AS `observaciones`,`demandas`.`estado_id` AS `estado_id`,`demandas`.`certificacion_energetica_id` AS `certificacion_energetica_id`,`demandas`.`anio_construccion_desde` AS `anio_construccion_desde`,`demandas`.`anio_construccion_hasta` AS `anio_construccion_hasta`,`demandas`.`agente_asignado_id` AS `agente_asignado_id`,`demandas`.`oferta_id` AS `oferta_id`,`demandas`.`tipo_demanda_id` AS `tipo_demanda_id`,`demandas`.`cliente_id` AS `cliente_id`,`demandas`.`fecha_alta` AS `fecha_alta`,`demandas`.`fecha_actualizacion` AS `fecha_actualizacion`,`poblaciones`.`poblacion` AS `nombre_poblacion`,`provincias`.`provincia` AS `nombre_provincia`,`tipos_certificacion_energetica`.`nombre` AS `nombre_certificacion_energetica`,`estados`.`nombre` AS `nombre_estado`,`estados`.`historico` AS `historico`,concat_ws(', ',`users`.`last_name`,`users`.`first_name`) AS `nombre_agente_asignado`,concat_ws(', ',`clientes`.`apellidos`,`clientes`.`nombre`) AS `nombre_cliente`,date_format(`demandas`.`fecha_alta`,'%c') AS `mes_alta`,date_format(`demandas`.`fecha_alta`,'%Y') AS `anio_alta`,(case `demandas`.`oferta_id` when 1 then 'Venta' when 2 then 'Alquiler' when 3 then 'Venta y Alquiler' end) AS `nombre_oferta`,(case `demandas`.`tipo_demanda_id` when 1 then 'Sin filtros de búsqueda' when 2 then 'Con filtros de búsqueda' end) AS `nombre_tipo_demanda` from ((((((`demandas` join `estados` on((`demandas`.`estado_id` = `estados`.`id`))) left join `poblaciones` on((`demandas`.`poblacion_id` = `poblaciones`.`id`))) left join `provincias` on((`demandas`.`provincia_id` = `provincias`.`id`))) join `clientes` on((`demandas`.`cliente_id` = `clientes`.`id`))) left join `tipos_certificacion_energetica` on((`demandas`.`certificacion_energetica_id` = `tipos_certificacion_energetica`.`id`))) left join `users` on((`demandas`.`agente_asignado_id` = `users`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_demandas_ficheros`
--
DROP TABLE IF EXISTS `v_demandas_ficheros`;

CREATE OR REPLACE VIEW `v_demandas_ficheros`  AS  select `demandas_ficheros`.`id` AS `id`,`demandas_ficheros`.`demanda_id` AS `demanda_id`,`demandas_ficheros`.`texto_fichero` AS `texto_fichero`,`demandas_ficheros`.`fichero` AS `fichero`,`demandas_ficheros`.`tipo_fichero_id` AS `tipo_fichero_id`,`tipos_ficheros`.`nombre` AS `nombre_tipo` from (`demandas_ficheros` join `tipos_ficheros` on((`demandas_ficheros`.`tipo_fichero_id` = `tipos_ficheros`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_demandas_tipos_inmueble`
--
DROP TABLE IF EXISTS `v_demandas_tipos_inmueble`;

CREATE OR REPLACE VIEW `v_demandas_tipos_inmueble`  AS  select `demandas_tipos_inmueble`.`id` AS `id`,`demandas_tipos_inmueble`.`demanda_id` AS `demanda_id`,`demandas_tipos_inmueble`.`tipo_id` AS `tipo_id`,`tipos_inmueble_idiomas`.`nombre` AS `nombre_tipo_inmueble`,`tipos_inmueble_idiomas`.`idioma_id` AS `idioma_id`,`estados`.`historico` AS `historico`,`demandas`.`agente_asignado_id` AS `agente_asignado_id` from ((((`demandas_tipos_inmueble` join `demandas` on((`demandas_tipos_inmueble`.`demanda_id` = `demandas`.`id`))) join `estados` on((`demandas`.`estado_id` = `estados`.`id`))) join `tipos_inmueble` on((`demandas_tipos_inmueble`.`tipo_id` = `tipos_inmueble`.`id`))) join `tipos_inmueble_idiomas` on((`tipos_inmueble_idiomas`.`tipo_inmueble_id` = `tipos_inmueble`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_estados`
--
DROP TABLE IF EXISTS `v_estados`;

CREATE OR REPLACE VIEW `v_estados`  AS  select `estados`.`id` AS `id`,`estados`.`ambito_id` AS `ambito_id`,`estados`.`nombre` AS `nombre`,`estados`.`descripcion` AS `descripcion`,`estados`.`historico` AS `historico`,(case `estados`.`ambito_id` when 1 then 'Clientes' when 2 then 'Inmuebles' when 3 then 'Demandas' end) AS `nombre_ambito` from `estados` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_inmuebles`
--
DROP TABLE IF EXISTS `v_inmuebles`;

CREATE OR REPLACE VIEW `v_inmuebles`  AS  select `inmuebles`.`id` AS `id`,`inmuebles`.`referencia` AS `referencia`,`inmuebles`.`metros` AS `metros`,`inmuebles`.`metros_utiles` AS `metros_utiles`,`inmuebles`.`habitaciones` AS `habitaciones`,`inmuebles`.`banios` AS `banios`,`inmuebles`.`precio_compra` AS `precio_compra`,`inmuebles`.`precio_compra_anterior` AS `precio_compra_anterior`,`inmuebles`.`precio_alquiler` AS `precio_alquiler`,`inmuebles`.`precio_alquiler_anterior` AS `precio_alquiler_anterior`,`inmuebles`.`poblacion_id` AS `poblacion_id`,`inmuebles`.`zona_id` AS `zona_id`,`inmuebles`.`tipo_id` AS `tipo_id`,`inmuebles`.`observaciones` AS `observaciones`,`inmuebles`.`direccion` AS `direccion`,`inmuebles`.`direccion_publica` AS `direccion_publica`,`inmuebles`.`publicado` AS `publicado`,`inmuebles`.`estado_id` AS `estado_id`,`inmuebles`.`certificacion_energetica_id` AS `certificacion_energetica_id`,`inmuebles`.`kwh_m2_anio` AS `kwh_m2_anio`,`inmuebles`.`captador_id` AS `captador_id`,`inmuebles`.`fecha_alta` AS `fecha_alta`,`inmuebles`.`fecha_actualizacion` AS `fecha_actualizacion`,`inmuebles`.`anio_construccion` AS `anio_construccion`,`inmuebles`.`oportunidad` AS `oportunidad`,`inmuebles`.`destacado` AS `destacado`,`poblaciones`.`poblacion` AS `nombre_poblacion`,`poblaciones`.`provincia_id` AS `provincia_id`,`provincias`.`provincia` AS `nombre_provincia`,`poblaciones_zonas`.`nombre` AS `nombre_zona`,`tipos_inmueble_idiomas`.`nombre` AS `nombre_tipo`,`tipos_inmueble_idiomas`.`idioma_id` AS `idioma_id`,`tipos_certificacion_energetica`.`nombre` AS `nombre_certificacion_energetica`,`estados`.`nombre` AS `nombre_estado`,`estados`.`historico` AS `historico_estado`,concat_ws(', ',`users`.`last_name`,`users`.`first_name`) AS `nombre_captador`,`inmuebles_carteles`.`id` AS `cartel_id`,`inmuebles_carteles`.`impreso` AS `cartel_impreso`,date_format(`inmuebles`.`fecha_alta`,'%c') AS `mes_alta`,date_format(`inmuebles`.`fecha_alta`,'%Y') AS `anio_alta` from (((((((((`inmuebles` join `estados` on((`inmuebles`.`estado_id` = `estados`.`id`))) join `poblaciones` on((`inmuebles`.`poblacion_id` = `poblaciones`.`id`))) join `provincias` on((`poblaciones`.`provincia_id` = `provincias`.`id`))) left join `poblaciones_zonas` on((`inmuebles`.`zona_id` = `poblaciones_zonas`.`id`))) join `tipos_inmueble` on((`inmuebles`.`tipo_id` = `tipos_inmueble`.`id`))) join `tipos_inmueble_idiomas` on((`tipos_inmueble_idiomas`.`tipo_inmueble_id` = `tipos_inmueble`.`id`))) left join `tipos_certificacion_energetica` on((`inmuebles`.`certificacion_energetica_id` = `tipos_certificacion_energetica`.`id`))) left join `users` on((`inmuebles`.`captador_id` = `users`.`id`))) left join `inmuebles_carteles` on((`inmuebles_carteles`.`inmueble_id` = `inmuebles`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_inmuebles_demandas`
--
DROP TABLE IF EXISTS `v_inmuebles_demandas`;

CREATE OR REPLACE VIEW `v_inmuebles_demandas`  AS  select `v_inmuebles`.`id` AS `id`,`v_inmuebles`.`referencia` AS `referencia`,`v_inmuebles`.`metros` AS `metros`,`v_inmuebles`.`metros_utiles` AS `metros_utiles`,`v_inmuebles`.`habitaciones` AS `habitaciones`,`v_inmuebles`.`banios` AS `banios`,`v_inmuebles`.`precio_compra` AS `precio_compra`,`v_inmuebles`.`precio_compra_anterior` AS `precio_compra_anterior`,`v_inmuebles`.`precio_alquiler` AS `precio_alquiler`,`v_inmuebles`.`precio_alquiler_anterior` AS `precio_alquiler_anterior`,`v_inmuebles`.`poblacion_id` AS `poblacion_id`,`v_inmuebles`.`zona_id` AS `zona_id`,`v_inmuebles`.`tipo_id` AS `tipo_id`,`v_inmuebles`.`observaciones` AS `observaciones`,`v_inmuebles`.`direccion` AS `direccion`,`v_inmuebles`.`direccion_publica` AS `direccion_publica`,`v_inmuebles`.`publicado` AS `publicado`,`v_inmuebles`.`estado_id` AS `estado_id`,`v_inmuebles`.`certificacion_energetica_id` AS `certificacion_energetica_id`,`v_inmuebles`.`kwh_m2_anio` AS `kwh_m2_anio`,`v_inmuebles`.`captador_id` AS `captador_id`,`v_inmuebles`.`fecha_alta` AS `fecha_alta`,`v_inmuebles`.`fecha_actualizacion` AS `fecha_actualizacion`,`v_inmuebles`.`anio_construccion` AS `anio_construccion`,`v_inmuebles`.`oportunidad` AS `oportunidad`,`v_inmuebles`.`destacado` AS `destacado`,`v_inmuebles`.`nombre_poblacion` AS `nombre_poblacion`,`v_inmuebles`.`provincia_id` AS `provincia_id`,`v_inmuebles`.`nombre_provincia` AS `nombre_provincia`,`v_inmuebles`.`nombre_zona` AS `nombre_zona`,`v_inmuebles`.`nombre_tipo` AS `nombre_tipo`,`v_inmuebles`.`idioma_id` AS `idioma_id`,`v_inmuebles`.`nombre_certificacion_energetica` AS `nombre_certificacion_energetica`,`v_inmuebles`.`nombre_estado` AS `nombre_estado`,`v_inmuebles`.`historico_estado` AS `historico_estado`,`v_inmuebles`.`nombre_captador` AS `nombre_captador`,`v_inmuebles`.`cartel_id` AS `cartel_id`,`v_inmuebles`.`cartel_impreso` AS `cartel_impreso`,`v_inmuebles`.`mes_alta` AS `mes_alta`,`v_inmuebles`.`anio_alta` AS `anio_alta`,`demandas`.`cliente_id` AS `cliente_id`,`demandas`.`agente_asignado_id` AS `agente_asignado_id`,`demandas`.`referencia` AS `referencia_demanda`,`estados`.`historico` AS `historico_demanda`,`inmuebles_demandas`.`demanda_id` AS `demanda_id`,`inmuebles_demandas`.`origen_id` AS `origen_id`,`inmuebles_demandas`.`evaluacion_id` AS `evaluacion_id`,`inmuebles_demandas`.`observaciones` AS `observaciones_demanda`,`inmuebles_demandas`.`fecha_asignacion` AS `fecha_asignacion`,date_format(`inmuebles_demandas`.`fecha_asignacion`,'%d/%m/%Y') AS `fecha_asignacion_formateada`,`inmuebles_demandas`.`id` AS `inmueble_demanda_id`,(case `inmuebles_demandas`.`origen_id` when 1 then 'OPENRS' when 2 then 'Agente' end) AS `nombre_origen`,(case `inmuebles_demandas`.`evaluacion_id` when 1 then 'Pendiente evaluar' when 2 then 'Propuesto para visita' when 3 then 'Pendiente decisión cliente' when 4 then 'Descartado por agente' when 5 then 'Interesa cliente' when 6 then 'No Interesa cliente' end) AS `nombre_evaluacion` from (((`v_inmuebles` join `inmuebles_demandas` on((`inmuebles_demandas`.`inmueble_id` = `v_inmuebles`.`id`))) join `demandas` on((`inmuebles_demandas`.`demanda_id` = `demandas`.`id`))) join `estados` on((`demandas`.`estado_id` = `estados`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_inmuebles_ficheros`
--
DROP TABLE IF EXISTS `v_inmuebles_ficheros`;

CREATE OR REPLACE VIEW `v_inmuebles_ficheros`  AS  select `inmuebles_ficheros`.`id` AS `id`,`inmuebles_ficheros`.`inmueble_id` AS `inmueble_id`,`inmuebles_ficheros`.`fichero` AS `fichero`,`inmuebles_ficheros`.`texto_fichero` AS `texto_fichero`,`inmuebles_ficheros`.`tipo_fichero_id` AS `tipo_fichero_id`,`tipos_ficheros`.`nombre` AS `nombre_tipo` from (`inmuebles_ficheros` join `tipos_ficheros` on((`inmuebles_ficheros`.`tipo_fichero_id` = `tipos_ficheros`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_tipos_ficheros`
--
DROP TABLE IF EXISTS `v_tipos_ficheros`;

CREATE OR REPLACE VIEW `v_tipos_ficheros`  AS  select `tipos_ficheros`.`id` AS `id`,`tipos_ficheros`.`nombre` AS `nombre`,`tipos_ficheros`.`descripcion` AS `descripcion`,`tipos_ficheros`.`ambito_id` AS `ambito_id`,(case `tipos_ficheros`.`ambito_id` when 1 then 'Clientes' when 2 then 'Inmuebles' when 3 then 'Demandas' end) AS `nombre_ambito` from `tipos_ficheros` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `articulos_idiomas`
--
ALTER TABLE `articulos_idiomas`
  ADD PRIMARY KEY (`id_articulo_idioma`);

--
-- Indices de la tabla `articulo_categorias`
--
ALTER TABLE `articulo_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `articulo_etiquetas`
--
ALTER TABLE `articulo_etiquetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `backup`
--
ALTER TABLE `backup`
  ADD PRIMARY KEY (`backup_id`),
  ADD UNIQUE KEY `backup_name_UNIQUE` (`backup_name`),
  ADD KEY `FK_backup_admin_id` (`admin_id`);

--
-- Indices de la tabla `bloque`
--
ALTER TABLE `bloque`
  ADD PRIMARY KEY (`id_bloque`);

--
-- Indices de la tabla `bloque_idiomas`
--
ALTER TABLE `bloque_idiomas`
  ADD PRIMARY KEY (`id_bloque_idiomas`);

--
-- Indices de la tabla `bloque_inmuebles`
--
ALTER TABLE `bloque_inmuebles`
  ADD PRIMARY KEY (`idbloque_inmuebles`);

--
-- Indices de la tabla `carrusel`
--
ALTER TABLE `carrusel`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias_informacion_documentacion`
--
ALTER TABLE `categorias_informacion_documentacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_cat_inf_doc_nombre` (`nombre`),
  ADD UNIQUE KEY `unique_cat_inf_doc_ref` (`referencia`);

--
-- Indices de la tabla `categoria_blog`
--
ALTER TABLE `categoria_blog`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_blog_idiomas`
--
ALTER TABLE `categoria_blog_idiomas`
  ADD PRIMARY KEY (`id_categoria_idioma`);

--
-- Indices de la tabla `categoria_carrusel`
--
ALTER TABLE `categoria_carrusel`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_carrusel_idiomas`
--
ALTER TABLE `categoria_carrusel_idiomas`
  ADD PRIMARY KEY (`id_categoria_carrusel_idiomas`);

--
-- Indices de la tabla `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_clientes_nif` (`nif`),
  ADD UNIQUE KEY `unique_clientes_correo` (`correo`),
  ADD KEY `FK_clientes_poblacion_id` (`poblacion_id`),
  ADD KEY `FK_clientes_agente_asignado_id` (`agente_asignado_id`),
  ADD KEY `FK_clientes_pais_id` (`pais_id`),
  ADD KEY `FK_clientes_estado_id` (`estado_id`),
  ADD KEY `FK_clientes_medio_captacion_id` (`medio_captacion_id`),
  ADD KEY `clientes_fecha_alta` (`fecha_alta`),
  ADD KEY `clientes_fecha_actualizacion` (`fecha_actualizacion`);

--
-- Indices de la tabla `clientes_fichas`
--
ALTER TABLE `clientes_fichas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FK_clientes_fichas_cliente_id` (`cliente_id`),
  ADD KEY `FK_clientes_fichas_agente_id` (`agente_id`),
  ADD KEY `FK_clientes_fichas_plantilla_id` (`plantilla_id`);

--
-- Indices de la tabla `clientes_ficheros`
--
ALTER TABLE `clientes_ficheros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_clientes_ficheros` (`cliente_id`,`texto_fichero`(150)),
  ADD KEY `FK_clientes_ficheros_cliente_id` (`cliente_id`),
  ADD KEY `FK_clientes_ficheros_tipo_fichero_id` (`tipo_fichero_id`);

--
-- Indices de la tabla `clientes_inmuebles`
--
ALTER TABLE `clientes_inmuebles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_clientes_inmuebles` (`cliente_id`,`inmueble_id`),
  ADD KEY `FK_clientes_inmuebles_cliente_id` (`cliente_id`),
  ADD KEY `FK_clientes_inmuebles_inmueble_id` (`inmueble_id`);

--
-- Indices de la tabla `comentarios_blog`
--
ALTER TABLE `comentarios_blog`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id` (`id`) USING BTREE;

--
-- Indices de la tabla `comunidades_autonomas`
--
ALTER TABLE `comunidades_autonomas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id_config`);

--
-- Indices de la tabla `config_admin`
--
ALTER TABLE `config_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `demandas`
--
ALTER TABLE `demandas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_demandas_ref` (`referencia`),
  ADD KEY `FK_demandas_agente_asignado_id` (`agente_asignado_id`),
  ADD KEY `FK_demandas_certificacion_energetica_id` (`certificacion_energetica_id`),
  ADD KEY `FK_demandas_provincia_id` (`provincia_id`),
  ADD KEY `FK_demandas_estado_id` (`estado_id`),
  ADD KEY `FK_demandas_poblacion_id` (`poblacion_id`),
  ADD KEY `FK_demandas_cliente_id` (`cliente_id`),
  ADD KEY `demandas_fecha_alta` (`fecha_alta`),
  ADD KEY `demandas_fecha_actualizacion` (`fecha_actualizacion`);

--
-- Indices de la tabla `demandas_fichas`
--
ALTER TABLE `demandas_fichas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FK_demandas_fichas_demanda_id` (`demanda_id`),
  ADD KEY `FK_demandas_fichas_agente_id` (`agente_id`),
  ADD KEY `FK_demandas_fichas_plantilla_id` (`plantilla_id`);

--
-- Indices de la tabla `demandas_ficheros`
--
ALTER TABLE `demandas_ficheros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_demandas_ficheros_demanda_id` (`demanda_id`),
  ADD KEY `FK_demandas_ficheros_tipo_fichero_id` (`tipo_fichero_id`);

--
-- Indices de la tabla `demandas_poblaciones_zonas`
--
ALTER TABLE `demandas_poblaciones_zonas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_demandas_poblaciones_zonas` (`demanda_id`,`zona_id`),
  ADD KEY `FK_demandas_zonas_demanda_id` (`demanda_id`),
  ADD KEY `FK_demandas_zonas_zona_id` (`zona_id`);

--
-- Indices de la tabla `demandas_tipos_inmueble`
--
ALTER TABLE `demandas_tipos_inmueble`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_demandas_tipos_inmueble` (`demanda_id`,`tipo_id`),
  ADD KEY `FK_demandas_zonas_demanda_id` (`demanda_id`),
  ADD KEY `FK_demandas_zonas_tipo_id` (`tipo_id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_estados` (`ambito_id`,`nombre`);

--
-- Indices de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `footer_opciones`
--
ALTER TABLE `footer_opciones`
  ADD PRIMARY KEY (`id_opc`),
  ADD KEY `idx_footer_opciones` (`id_opc`);

--
-- Indices de la tabla `footer_opciones_cliente`
--
ALTER TABLE `footer_opciones_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `footer_texto_idiomas`
--
ALTER TABLE `footer_texto_idiomas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `geocoding`
--
ALTER TABLE `geocoding`
  ADD PRIMARY KEY (`address`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  ADD PRIMARY KEY (`id_idioma`);

--
-- Indices de la tabla `imagen_carrusel`
--
ALTER TABLE `imagen_carrusel`
  ADD PRIMARY KEY (`id_imagen_carrusel`);

--
-- Indices de la tabla `imagen_carrusel_idiomas`
--
ALTER TABLE `imagen_carrusel_idiomas`
  ADD PRIMARY KEY (`id_imagen_carrusel_idiomas`);

--
-- Indices de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_inmuebles_ref` (`referencia`),
  ADD KEY `inmuebles_precio_compra` (`precio_compra`),
  ADD KEY `inmuebles_precio_alquiler` (`precio_alquiler`),
  ADD KEY `inmuebles_busqueda` (`habitaciones`,`banios`),
  ADD KEY `FK_inmuebles_captador_id` (`captador_id`),
  ADD KEY `FK_inmuebles_poblacion_id` (`poblacion_id`),
  ADD KEY `FK_inmuebles_tipo_id` (`tipo_id`),
  ADD KEY `FK_inmuebles_certificacion_energetica_id` (`certificacion_energetica_id`),
  ADD KEY `FK_inmuebles_zona_id` (`zona_id`),
  ADD KEY `FK_inmuebles_estado_id` (`estado_id`),
  ADD KEY `inmuebles_fecha_alta` (`fecha_alta`),
  ADD KEY `inmuebles_fecha_actualizacion` (`fecha_actualizacion`);

--
-- Indices de la tabla `inmuebles_carteles`
--
ALTER TABLE `inmuebles_carteles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FK_inmuebles_carteles_inmueble_id` (`inmueble_id`),
  ADD KEY `FK_inmuebles_carteles_agente_id` (`agente_id`),
  ADD KEY `FK_inmuebles_carteles_plantilla_id` (`plantilla_id`),
  ADD KEY `FK_inmuebles_carteles_idioma_id` (`idioma_id`);

--
-- Indices de la tabla `inmuebles_demandas`
--
ALTER TABLE `inmuebles_demandas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_inmuebles_demandas` (`inmueble_id`,`demanda_id`),
  ADD KEY `FK_inmuebles_demandas_inmueble_id` (`inmueble_id`),
  ADD KEY `FK_inmuebles_demandas_demanda_id` (`demanda_id`);

--
-- Indices de la tabla `inmuebles_enlaces`
--
ALTER TABLE `inmuebles_enlaces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_inmuebles_enlaces_inmueble_id` (`inmueble_id`);

--
-- Indices de la tabla `inmuebles_fichas`
--
ALTER TABLE `inmuebles_fichas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FK_inmuebles_fichas_inmueble_id` (`inmueble_id`),
  ADD KEY `FK_inmuebles_fichas_agente_id` (`agente_id`),
  ADD KEY `FK_inmuebles_fichas_plantilla_id` (`plantilla_id`),
  ADD KEY `FK_inmuebles_fichas_idioma_id` (`idioma_id`);

--
-- Indices de la tabla `inmuebles_ficheros`
--
ALTER TABLE `inmuebles_ficheros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_inmuebles_ficheros_inmueble_id` (`inmueble_id`),
  ADD KEY `FK_inmuebles_ficheros_tipo_fichero_id` (`tipo_fichero_id`);

--
-- Indices de la tabla `inmuebles_idiomas`
--
ALTER TABLE `inmuebles_idiomas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_inmuebles_idiomas_inmueble_id` (`inmueble_id`),
  ADD KEY `FK_inmuebles_idiomas_idioma_id` (`idioma_id`);

--
-- Indices de la tabla `inmuebles_imagenes`
--
ALTER TABLE `inmuebles_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_inmuebles_imagenes_inmueble_id` (`inmueble_id`);

--
-- Indices de la tabla `inmuebles_lugares_interes`
--
ALTER TABLE `inmuebles_lugares_interes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_inmuebles_lugares_interes` (`inmueble_id`,`lugar_interes_id`),
  ADD KEY `FK_inmuebles_lugares_interes_inmueble_id` (`inmueble_id`),
  ADD KEY `FK_inmuebles_lugares_interes_interes_id` (`lugar_interes_id`);

--
-- Indices de la tabla `inmuebles_opciones_extras`
--
ALTER TABLE `inmuebles_opciones_extras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_inmuebles_opciones_extras` (`inmueble_id`,`opcion_extra_id`),
  ADD KEY `FK_inmuebles_opciones_extras_inmueble_id` (`inmueble_id`),
  ADD KEY `FK_inmuebles_opciones_extras_extra_id` (`opcion_extra_id`);

--
-- Indices de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lugares_interes`
--
ALTER TABLE `lugares_interes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lugares_interes_idiomas`
--
ALTER TABLE `lugares_interes_idiomas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_lugares_interes_idiomas` (`idioma_id`,`lugar_interes_id`),
  ADD KEY `FK_lugares_interes_idiomas_idioma_id` (`idioma_id`),
  ADD KEY `FK_lugares_interes_idiomas_lugar_interes_id` (`lugar_interes_id`);

--
-- Indices de la tabla `marcas_documentacion`
--
ALTER TABLE `marcas_documentacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_marcas_documentacion_categoria_inf_id` (`categoria_inf_id`);

--
-- Indices de la tabla `medios_captacion`
--
ALTER TABLE `medios_captacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_medios_captacion` (`nombre`);

--
-- Indices de la tabla `opciones_extras`
--
ALTER TABLE `opciones_extras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `opciones_extras_idiomas`
--
ALTER TABLE `opciones_extras_idiomas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_marcas_documentacion` (`idioma_id`,`opcion_extra_id`),
  ADD KEY `FK_opciones_extras_idiomas_idioma_id` (`idioma_id`),
  ADD KEY `FK_opciones_extras_idiomas_opcion_extra_id` (`opcion_extra_id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iso2` (`iso2`),
  ADD UNIQUE KEY `iso3` (`iso3`);

--
-- Indices de la tabla `plantillas_documentacion`
--
ALTER TABLE `plantillas_documentacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_plantillas_nombre` (`nombre`),
  ADD KEY `FK_plantillas_documentacion_tipo_plantilla_id` (`tipo_plantilla_id`);

--
-- Indices de la tabla `poblaciones`
--
ALTER TABLE `poblaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_poblaciones_provincia_id` (`provincia_id`);

--
-- Indices de la tabla `poblaciones_zonas`
--
ALTER TABLE `poblaciones_zonas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_poblaciones_zonas_poblacion_id` (`poblacion_id`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_provincias_comunidad_autonoma_id` (`comunidad_autonoma_id`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccion_idiomas`
--
ALTER TABLE `seccion_idiomas`
  ADD PRIMARY KEY (`id_seccion_idiomas`),
  ADD UNIQUE KEY `url_seo` (`url_seo`);

--
-- Indices de la tabla `texto`
--
ALTER TABLE `texto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `texto_idiomas`
--
ALTER TABLE `texto_idiomas`
  ADD PRIMARY KEY (`id_texto_idiomas`);

--
-- Indices de la tabla `tipos_certificacion_energetica`
--
ALTER TABLE `tipos_certificacion_energetica`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_tipos_cert_energetica` (`nombre`);

--
-- Indices de la tabla `tipos_ficheros`
--
ALTER TABLE `tipos_ficheros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_inmueble`
--
ALTER TABLE `tipos_inmueble`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_inmueble_idiomas`
--
ALTER TABLE `tipos_inmueble_idiomas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_tipos_inmueble_idiomas` (`idioma_id`,`tipo_inmueble_id`),
  ADD KEY `FK_tipos_inmueble_idiomas_idioma_id` (`idioma_id`),
  ADD KEY `FK_tipos_inmueble_idiomas_tipo_inmueble_id` (`tipo_inmueble_id`);

--
-- Indices de la tabla `tipos_plantilla_documentacion`
--
ALTER TABLE `tipos_plantilla_documentacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_tipos_plantillas_doc` (`nombre`);

--
-- Indices de la tabla `tipos_plantilla_documentacion_categorias_asignadas`
--
ALTER TABLE `tipos_plantilla_documentacion_categorias_asignadas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_tip_pla_doc_cats_asig` (`tipo_plantilla_id`,`categoria_inf_id`),
  ADD KEY `FK_tip_pla_doc_cats_asig_tipo_plantilla_id` (`tipo_plantilla_id`),
  ADD KEY `FK_tip_pla_doc_cats_asig_categoria_inf_id` (`categoria_inf_id`);

--
-- Indices de la tabla `tipo_bloque`
--
ALTER TABLE `tipo_bloque`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_tipo_bloque` (`nombre`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_users_id_idioma` (`id_idioma`);

--
-- Indices de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indices de la tabla `votos`
--
ALTER TABLE `votos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `articulos_idiomas`
--
ALTER TABLE `articulos_idiomas`
  MODIFY `id_articulo_idioma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `articulo_categorias`
--
ALTER TABLE `articulo_categorias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `articulo_etiquetas`
--
ALTER TABLE `articulo_etiquetas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `backup`
--
ALTER TABLE `backup`
  MODIFY `backup_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `bloque`
--
ALTER TABLE `bloque`
  MODIFY `id_bloque` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;
--
-- AUTO_INCREMENT de la tabla `bloque_idiomas`
--
ALTER TABLE `bloque_idiomas`
  MODIFY `id_bloque_idiomas` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;
--
-- AUTO_INCREMENT de la tabla `bloque_inmuebles`
--
ALTER TABLE `bloque_inmuebles`
  MODIFY `idbloque_inmuebles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `carrusel`
--
ALTER TABLE `carrusel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `categorias_informacion_documentacion`
--
ALTER TABLE `categorias_informacion_documentacion`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `categoria_blog`
--
ALTER TABLE `categoria_blog`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categoria_blog_idiomas`
--
ALTER TABLE `categoria_blog_idiomas`
  MODIFY `id_categoria_idioma` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categoria_carrusel`
--
ALTER TABLE `categoria_carrusel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categoria_carrusel_idiomas`
--
ALTER TABLE `categoria_carrusel_idiomas`
  MODIFY `id_categoria_carrusel_idiomas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `clientes_fichas`
--
ALTER TABLE `clientes_fichas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `clientes_ficheros`
--
ALTER TABLE `clientes_ficheros`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `clientes_inmuebles`
--
ALTER TABLE `clientes_inmuebles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `comentarios_blog`
--
ALTER TABLE `comentarios_blog`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `comunidades_autonomas`
--
ALTER TABLE `comunidades_autonomas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id_config` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `config_admin`
--
ALTER TABLE `config_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `demandas`
--
ALTER TABLE `demandas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `demandas_fichas`
--
ALTER TABLE `demandas_fichas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `demandas_ficheros`
--
ALTER TABLE `demandas_ficheros`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `demandas_poblaciones_zonas`
--
ALTER TABLE `demandas_poblaciones_zonas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `demandas_tipos_inmueble`
--
ALTER TABLE `demandas_tipos_inmueble`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `footer_opciones`
--
ALTER TABLE `footer_opciones`
  MODIFY `id_opc` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `footer_opciones_cliente`
--
ALTER TABLE `footer_opciones_cliente`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `footer_texto_idiomas`
--
ALTER TABLE `footer_texto_idiomas`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  MODIFY `id_idioma` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT de la tabla `imagen_carrusel`
--
ALTER TABLE `imagen_carrusel`
  MODIFY `id_imagen_carrusel` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `imagen_carrusel_idiomas`
--
ALTER TABLE `imagen_carrusel_idiomas`
  MODIFY `id_imagen_carrusel_idiomas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `inmuebles_carteles`
--
ALTER TABLE `inmuebles_carteles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `inmuebles_demandas`
--
ALTER TABLE `inmuebles_demandas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT de la tabla `inmuebles_enlaces`
--
ALTER TABLE `inmuebles_enlaces`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `inmuebles_fichas`
--
ALTER TABLE `inmuebles_fichas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `inmuebles_ficheros`
--
ALTER TABLE `inmuebles_ficheros`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `inmuebles_idiomas`
--
ALTER TABLE `inmuebles_idiomas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `inmuebles_imagenes`
--
ALTER TABLE `inmuebles_imagenes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT de la tabla `inmuebles_lugares_interes`
--
ALTER TABLE `inmuebles_lugares_interes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `inmuebles_opciones_extras`
--
ALTER TABLE `inmuebles_opciones_extras`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `lugares_interes`
--
ALTER TABLE `lugares_interes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `lugares_interes_idiomas`
--
ALTER TABLE `lugares_interes_idiomas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `marcas_documentacion`
--
ALTER TABLE `marcas_documentacion`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT de la tabla `medios_captacion`
--
ALTER TABLE `medios_captacion`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `opciones_extras`
--
ALTER TABLE `opciones_extras`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `opciones_extras_idiomas`
--
ALTER TABLE `opciones_extras_idiomas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;
--
-- AUTO_INCREMENT de la tabla `plantillas_documentacion`
--
ALTER TABLE `plantillas_documentacion`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `poblaciones`
--
ALTER TABLE `poblaciones`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8125;
--
-- AUTO_INCREMENT de la tabla `poblaciones_zonas`
--
ALTER TABLE `poblaciones_zonas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `seccion_idiomas`
--
ALTER TABLE `seccion_idiomas`
  MODIFY `id_seccion_idiomas` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `texto`
--
ALTER TABLE `texto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT de la tabla `texto_idiomas`
--
ALTER TABLE `texto_idiomas`
  MODIFY `id_texto_idiomas` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT de la tabla `tipos_certificacion_energetica`
--
ALTER TABLE `tipos_certificacion_energetica`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tipos_ficheros`
--
ALTER TABLE `tipos_ficheros`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `tipos_inmueble`
--
ALTER TABLE `tipos_inmueble`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `tipos_inmueble_idiomas`
--
ALTER TABLE `tipos_inmueble_idiomas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `tipos_plantilla_documentacion`
--
ALTER TABLE `tipos_plantilla_documentacion`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tipos_plantilla_documentacion_categorias_asignadas`
--
ALTER TABLE `tipos_plantilla_documentacion_categorias_asignadas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `tipo_bloque`
--
ALTER TABLE `tipo_bloque`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT de la tabla `votos`
--
ALTER TABLE `votos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `backup`
--
ALTER TABLE `backup`
  ADD CONSTRAINT `FK_backup_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `FK_clientes_agente_asignado_id` FOREIGN KEY (`agente_asignado_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_clientes_estado_id` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_clientes_medio_captacion_id` FOREIGN KEY (`medio_captacion_id`) REFERENCES `medios_captacion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_clientes_pais_id` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_clientes_poblacion_id` FOREIGN KEY (`poblacion_id`) REFERENCES `poblaciones` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `clientes_fichas`
--
ALTER TABLE `clientes_fichas`
  ADD CONSTRAINT `FK_clientes_fichas_agente_id` FOREIGN KEY (`agente_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_clientes_fichas_cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_clientes_fichas_plantilla_id` FOREIGN KEY (`plantilla_id`) REFERENCES `plantillas_documentacion` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `clientes_ficheros`
--
ALTER TABLE `clientes_ficheros`
  ADD CONSTRAINT `FK_clientes_ficheros_cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_clientes_ficheros_tipo_fichero_id` FOREIGN KEY (`tipo_fichero_id`) REFERENCES `tipos_ficheros` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `clientes_inmuebles`
--
ALTER TABLE `clientes_inmuebles`
  ADD CONSTRAINT `FK_clientes_inmuebles_cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_clientes_inmuebles_inmueble_id` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `demandas`
--
ALTER TABLE `demandas`
  ADD CONSTRAINT `FK_demandas_agente_asignado_id` FOREIGN KEY (`agente_asignado_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_demandas_certificacion_energetica_id` FOREIGN KEY (`certificacion_energetica_id`) REFERENCES `tipos_certificacion_energetica` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_demandas_cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_demandas_estado_id` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_demandas_poblacion_id` FOREIGN KEY (`poblacion_id`) REFERENCES `poblaciones` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_demandas_provincia_id` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `demandas_fichas`
--
ALTER TABLE `demandas_fichas`
  ADD CONSTRAINT `FK_demandas_fichas_agente_id` FOREIGN KEY (`agente_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_demandas_fichas_demanda_id` FOREIGN KEY (`demanda_id`) REFERENCES `demandas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_demandas_fichas_plantilla_id` FOREIGN KEY (`plantilla_id`) REFERENCES `plantillas_documentacion` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `demandas_ficheros`
--
ALTER TABLE `demandas_ficheros`
  ADD CONSTRAINT `FK_demandas_ficheros_tipo_fichero_id` FOREIGN KEY (`tipo_fichero_id`) REFERENCES `tipos_ficheros` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `demandas_poblaciones_zonas`
--
ALTER TABLE `demandas_poblaciones_zonas`
  ADD CONSTRAINT `FK_demandas_zonas_demanda_id` FOREIGN KEY (`demanda_id`) REFERENCES `demandas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_demandas_zonas_zona_id` FOREIGN KEY (`zona_id`) REFERENCES `poblaciones_zonas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `demandas_tipos_inmueble`
--
ALTER TABLE `demandas_tipos_inmueble`
  ADD CONSTRAINT `FK_demandas_tipos_inmueble_demanda_id` FOREIGN KEY (`demanda_id`) REFERENCES `demandas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_demandas_tipos_inmueble_tipo_id` FOREIGN KEY (`tipo_id`) REFERENCES `tipos_inmueble` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD CONSTRAINT `FK_inmuebles_captador_id` FOREIGN KEY (`captador_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_certificacion_energetica_id` FOREIGN KEY (`certificacion_energetica_id`) REFERENCES `tipos_certificacion_energetica` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_estado_id` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_poblacion_id` FOREIGN KEY (`poblacion_id`) REFERENCES `poblaciones` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_tipo_id` FOREIGN KEY (`tipo_id`) REFERENCES `tipos_inmueble` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_zona_id` FOREIGN KEY (`zona_id`) REFERENCES `poblaciones_zonas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `inmuebles_carteles`
--
ALTER TABLE `inmuebles_carteles`
  ADD CONSTRAINT `FK_inmuebles_carteles_agente_id` FOREIGN KEY (`agente_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_carteles_idioma_id` FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`id_idioma`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_carteles_inmueble_id` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_carteles_plantilla_id` FOREIGN KEY (`plantilla_id`) REFERENCES `plantillas_documentacion` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `inmuebles_demandas`
--
ALTER TABLE `inmuebles_demandas`
  ADD CONSTRAINT `FK_inmuebles_demandas_demanda_id` FOREIGN KEY (`demanda_id`) REFERENCES `demandas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_demandas_inmueble_id` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inmuebles_enlaces`
--
ALTER TABLE `inmuebles_enlaces`
  ADD CONSTRAINT `FK_inmuebles_enlaces_inmueble_id` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inmuebles_fichas`
--
ALTER TABLE `inmuebles_fichas`
  ADD CONSTRAINT `FK_inmuebles_fichas_agente_id` FOREIGN KEY (`agente_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_fichas_idioma_id` FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`id_idioma`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_fichas_inmueble_id` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_fichas_plantilla_id` FOREIGN KEY (`plantilla_id`) REFERENCES `plantillas_documentacion` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `inmuebles_ficheros`
--
ALTER TABLE `inmuebles_ficheros`
  ADD CONSTRAINT `FK_inmuebles_ficheros_inmueble_id` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_ficheros_tipo_fichero_id` FOREIGN KEY (`tipo_fichero_id`) REFERENCES `tipos_ficheros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inmuebles_idiomas`
--
ALTER TABLE `inmuebles_idiomas`
  ADD CONSTRAINT `FK_inmuebles_idiomas_idioma_id` FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`id_idioma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_idiomas_inmueble_id` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inmuebles_imagenes`
--
ALTER TABLE `inmuebles_imagenes`
  ADD CONSTRAINT `FK_inmuebles_imagenes_inmueble_id` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inmuebles_lugares_interes`
--
ALTER TABLE `inmuebles_lugares_interes`
  ADD CONSTRAINT `FK_inmuebles_lugares_interes_inmueble_id` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_lugares_interes_interes_id` FOREIGN KEY (`lugar_interes_id`) REFERENCES `lugares_interes` (`id`);

--
-- Filtros para la tabla `inmuebles_opciones_extras`
--
ALTER TABLE `inmuebles_opciones_extras`
  ADD CONSTRAINT `FK_inmuebles_opciones_extras_inmueble_id` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_opciones_extras_opcion_extra_id` FOREIGN KEY (`opcion_extra_id`) REFERENCES `opciones_extras` (`id`);

--
-- Filtros para la tabla `lugares_interes_idiomas`
--
ALTER TABLE `lugares_interes_idiomas`
  ADD CONSTRAINT `FK_lugares_interes_idiomas_idioma_id` FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`id_idioma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_lugares_interes_idiomas_lugar_interes_id` FOREIGN KEY (`lugar_interes_id`) REFERENCES `lugares_interes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `marcas_documentacion`
--
ALTER TABLE `marcas_documentacion`
  ADD CONSTRAINT `FK_marcas_documentacion_categoria_inf_id` FOREIGN KEY (`categoria_inf_id`) REFERENCES `categorias_informacion_documentacion` (`id`);

--
-- Filtros para la tabla `opciones_extras_idiomas`
--
ALTER TABLE `opciones_extras_idiomas`
  ADD CONSTRAINT `FK_opciones_extras_idiomas_idioma_id` FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`id_idioma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_opciones_extras_idiomas_opcion_extra_id` FOREIGN KEY (`opcion_extra_id`) REFERENCES `opciones_extras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `plantillas_documentacion`
--
ALTER TABLE `plantillas_documentacion`
  ADD CONSTRAINT `FK_plantillas_documentacion_tipo_plantilla_id` FOREIGN KEY (`tipo_plantilla_id`) REFERENCES `tipos_plantilla_documentacion` (`id`);

--
-- Filtros para la tabla `poblaciones`
--
ALTER TABLE `poblaciones`
  ADD CONSTRAINT `FK_poblaciones_provincia_id` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `poblaciones_zonas`
--
ALTER TABLE `poblaciones_zonas`
  ADD CONSTRAINT `FK_poblaciones_zonas_poblacion_id` FOREIGN KEY (`poblacion_id`) REFERENCES `poblaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD CONSTRAINT `FK_provincias_comunidad_autonoma_id` FOREIGN KEY (`comunidad_autonoma_id`) REFERENCES `comunidades_autonomas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipos_inmueble_idiomas`
--
ALTER TABLE `tipos_inmueble_idiomas`
  ADD CONSTRAINT `FK_tipos_inmueble_idiomas_idioma_id` FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`id_idioma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tipos_inmueble_idiomas_tipo_inmueble_id` FOREIGN KEY (`tipo_inmueble_id`) REFERENCES `tipos_inmueble` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipos_plantilla_documentacion_categorias_asignadas`
--
ALTER TABLE `tipos_plantilla_documentacion_categorias_asignadas`
  ADD CONSTRAINT `FK_tip_pla_doc_cats_asig_categoria_inf_id` FOREIGN KEY (`categoria_inf_id`) REFERENCES `categorias_informacion_documentacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tip_pla_doc_cats_asig_tipo_plantilla_id` FOREIGN KEY (`tipo_plantilla_id`) REFERENCES `tipos_plantilla_documentacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

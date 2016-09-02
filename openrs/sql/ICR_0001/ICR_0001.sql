--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id_config` int(9) NOT NULL AUTO_INCREMENT,
  `user_id` int(9) NOT NULL,
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
  `vimeo` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_config`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Estructura de tabla para la tabla `footer_opciones`
--

CREATE TABLE IF NOT EXISTS `footer_opciones` (
	`id_opc` int(2) NOT NULL AUTO_INCREMENT,
	`nombre` varchar(25) NOT NULL,
	`id_idioma` int(11) NOT NULL,
	PRIMARY KEY (`id_opc`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Estructura de tabla para la tabla `footer_opciones_cliente`
--

CREATE TABLE IF NOT EXISTS `footer_opciones_cliente` (
	`id` int(2) NOT NULL AUTO_INCREMENT,
	`id_opc` int(2) NOT NULL,
	`iduser` int(11) NOT NULL,
	`columna` int(2) NOT NULL,
	`num_articulos` int(2) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Estructura de tabla para la tabla `footer_opciones_cliente`
--

CREATE TABLE IF NOT EXISTS `footer_texto_idiomas` (
	`id` int(2) NOT NULL AUTO_INCREMENT,
	`id_opc_cliente` int(2) NOT NULL,
	`contenido` text NOT NULL,
	`columna` int(2) NOT NULL,
	`id_idioma` int(11) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Estructura de tabla para la tabla `footer_opciones_cliente`
--

CREATE TABLE IF NOT EXISTS `idiomas` (
	`id_idioma` int(11) NOT NULL AUTO_INCREMENT,
	`nombre` varchar(50) NOT NULL,
	`nombre_seo` varchar(3) NOT NULL,
	`nombre_seo2` varchar(10) NOT NULL,
	`activo` int(1) NOT NULL,
	`subido` int(1) NOT NULL,
	`carpeta_idioma` varchar(50) NOT NULL,
	PRIMARY KEY (`id_idioma`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE  `users` ADD  `id_idioma` INT( 11 ) NOT NULL DEFAULT  '1';

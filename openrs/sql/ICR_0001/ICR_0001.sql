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

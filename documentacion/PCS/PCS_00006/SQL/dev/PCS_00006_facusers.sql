ALTER TABLE `plantillas_documentacion` ADD `descripcion` VARCHAR(255) NULL DEFAULT NULL ;

ALTER TABLE `plantillas_documentacion` CHANGE `HTML` `html` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `poblaciones` ADD `codigo` VARCHAR(3) NOT NULL DEFAULT '' AFTER `id`;

-- Importar fichero poblaciones.sql









CREATE TABLE IF NOT EXISTS `categorias_informacion_documentacion` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `referencia` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias_informacion_documentacion`
--

INSERT INTO `categorias_informacion_documentacion` (`id`, `nombre`, `referencia`, `descripcion`) VALUES
(1, 'General', 'general' , '-'),
(2, 'Clientes', 'clientes', '-'),
(3, 'Inmuebles', 'inmuebles', '-'),
(4, 'Agentes Inmobiliarios', 'agentes', '-'),
(5, 'Fichas visita', 'fichas_visita', '-');

--
-- Estructura de tabla para la tabla `tipos_plantilla_documentacion_categorias_asignadas`
--

CREATE TABLE IF NOT EXISTS `tipos_plantilla_documentacion_categorias_asignadas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_plantilla_id` int(11) unsigned NOT NULL,
  `categoria_inf_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tip_pla_doc_cats_asig_tipo_plantilla_id` (`tipo_plantilla_id`),
  KEY `FK_tip_pla_doc_cats_asig_categoria_inf_id` (`categoria_inf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_plantilla_documentacion_categorias_asignadas`
--

INSERT INTO `tipos_plantilla_documentacion_categorias_asignadas` (`tipo_plantilla_id`, `categoria_inf_id`) VALUES
(2, 1),
(2, 2),
(2, 4),
(1, 1),
(1, 3),
(1, 4),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(4, 1),
(4, 3),
(4, 4)
;

--
-- Filtros para la tabla `tipos_plantilla_documentacion_categorias_asignadas`
--
ALTER TABLE `tipos_plantilla_documentacion_categorias_asignadas`
  ADD CONSTRAINT `FK_tip_pla_doc_cats_asig_tipo_plantilla_id` FOREIGN KEY (`tipo_plantilla_id`) REFERENCES `tipos_plantilla_documentacion` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  ADD CONSTRAINT `FK_tip_pla_doc_cats_asig_categoria_inf_id` FOREIGN KEY (`categoria_inf_id`) REFERENCES `categorias_informacion_documentacion` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;


CREATE TABLE IF NOT EXISTS `marcas_documentacion` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `referencia` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `categoria_inf_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_marcas_documentacion_categoria_inf_id` (`categoria_inf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Filtros para la tabla `marcas_documentacion`
--
ALTER TABLE `marcas_documentacion`
  ADD CONSTRAINT `FK_marcas_documentacion_categoria_inf_id` FOREIGN KEY (`categoria_inf_id`) REFERENCES `categorias_informacion_documentacion` (`id`);
    
  --
-- Volcado de datos para la tabla `marcas_documentacion`
--

INSERT INTO `marcas_documentacion` (`referencia`, `descripcion`, `categoria_inf_id`) VALUES
('f_actual_numero' , 'Fecha actual en formato numérico', 1),
('f_actual_texto' , 'Fecha actual en formato texto', 1),
('nombre' , 'Nombre del cliente', 2),
('apellidos' , 'Apellidos del cliente', 2),
('direccion' , 'Dirección del cliente', 2),
('municipio' , 'Nombre del municipio del cliente', 2),
('nombre' , 'Nombre del agente', 4),
('apellidos' , 'Apellidos del agente', 4);








-- Cambios para parametrización de idioma para tipos de inmuebles

UPDATE `tipos_inmueble` SET `descripcion` = nombre;

ALTER TABLE `tipos_inmueble` DROP `nombre`;


--
-- Estructura de tabla para la tabla `tipos_inmueble_idiomas`
--

CREATE TABLE IF NOT EXISTS `tipos_inmueble_idiomas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idioma_id` int(11) unsigned NOT NULL,
  `tipo_inmueble_id` int(11) unsigned NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tipos_inmueble_idiomas_idioma_id` (`idioma_id`),
  KEY `FK_tipos_inmueble_idiomas_tipo_inmueble_id` (`tipo_inmueble_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_inmueble_idiomas`
--

INSERT INTO `tipos_inmueble_idiomas` (`idioma_id`, `tipo_inmueble_id`, `nombre`) VALUES
(1,1, 'Vivienda piso'),
(1,2, 'Vivienda unifamiliar'),
(1,3, 'Local comercial'),
(1,4, 'Oficina'),
(1,5, 'Garaje'),
(1,6, 'Trastero');

INSERT INTO `tipos_inmueble_idiomas` (`idioma_id`, `tipo_inmueble_id`, `nombre`) VALUES
(53,1, 'Flat'),
(53,2, 'Detached'),
(53,3, 'Commerce place'),
(53,4, 'Office'),
(53,5, 'Garage'),
(53,6, 'Storege Room');


ALTER TABLE `idiomas` CHANGE `id_idioma` `id_idioma` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT;


--
-- Filtros para la tabla `tipos_inmueble_idiomas`
--
ALTER TABLE `tipos_inmueble_idiomas`
  ADD CONSTRAINT `FK_tipos_inmueble_idiomas_idioma_id` FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`id_idioma`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `tipos_inmueble_idiomas`
  ADD CONSTRAINT `FK_tipos_inmueble_idiomas_tipo_inmueble_id` FOREIGN KEY (`tipo_inmueble_id`) REFERENCES `tipos_inmueble` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
  
  
  
  
  
  
  
  
  
  
  
  
-- Idioma  
  
ALTER TABLE `users` CHANGE `id_idioma` `id_idioma` INT(11) UNSIGNED NOT NULL;  

CREATE INDEX FK_users_id_idioma ON users (id_idioma);

ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_id_idioma` FOREIGN KEY (`id_idioma`) REFERENCES `idiomas` (`id_idioma`) ON DELETE CASCADE ON UPDATE CASCADE;
  
  
  
  
--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE IF NOT EXISTS `paises` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,  
  `nombre` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `iso2` char(2) NOT NULL,
  `iso3` char(3) NOT NULL,
  `phone_code` varchar(5) NULL,
  `defecto` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `iso2` (`iso2`),
  UNIQUE KEY `iso3` (`iso3`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Se importan datos desde CSV


ALTER TABLE `clientes` ADD `pais_id` INT(11) UNSIGNED NOT NULL AFTER `direccion`;

CREATE INDEX FK_clientes_pais_id ON clientes (pais_id);

ALTER TABLE `clientes`
  ADD CONSTRAINT `FK_clientes_pais_id` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`) ON UPDATE CASCADE;
  
  
  
  
  
  
-- Cambios para parametrización de idioma para tipos de opciones extras

UPDATE `opciones_extras` SET `descripcion` = nombre;

ALTER TABLE `opciones_extras` DROP `nombre`;


--
-- Estructura de tabla para la tabla `opciones_extras_idiomas`
--

CREATE TABLE IF NOT EXISTS `opciones_extras_idiomas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idioma_id` int(11) unsigned NOT NULL,
  `opcion_extra_id` int(11) unsigned NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_opciones_extras_idiomas_idioma_id` (`idioma_id`),
  KEY `FK_opciones_extras_idiomas_opcion_extra_id` (`opcion_extra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `opciones_extras_idiomas`
--

INSERT INTO `opciones_extras_idiomas` (`idioma_id`, `opcion_extra_id`, `nombre`) VALUES
(1,1, 'Cocina'),
(1,2, 'Muebles'),
(1,3, 'Piscina'),
(1,4, 'Jacuzzi');

INSERT INTO `opciones_extras_idiomas` (`idioma_id`, `opcion_extra_id`, `nombre`) VALUES
(53,1, 'Kitchen'),
(53,2, 'Furniture'),
(53,3, 'Pool'),
(53,4, 'Jacuzzi');

--
-- Filtros para la tabla `opciones_extras_idiomas`
--
ALTER TABLE `opciones_extras_idiomas`
  ADD CONSTRAINT `FK_opciones_extras_idiomas_idioma_id` FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`id_idioma`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `opciones_extras_idiomas`
  ADD CONSTRAINT `FK_opciones_extras_idiomas_opcion_extra_id` FOREIGN KEY (`opcion_extra_id`) REFERENCES `opciones_extras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
  
  

  
  
  
  
  
  
  
  
  
  
-- Cambios para parametrización de idioma para tipos de opciones extras

UPDATE `lugares_interes` SET `descripcion` = nombre;

ALTER TABLE `lugares_interes` DROP `nombre`;


--
-- Estructura de tabla para la tabla `lugares_interes_idiomas`
--

CREATE TABLE IF NOT EXISTS `lugares_interes_idiomas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idioma_id` int(11) unsigned NOT NULL,
  `lugar_interes_id` int(11) unsigned NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_lugares_interes_idiomas_idioma_id` (`idioma_id`),
  KEY `FK_lugares_interes_idiomas_lugar_interes_id` (`lugar_interes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lugares_interes_idiomas`
--

INSERT INTO `lugares_interes_idiomas` (`idioma_id`, `lugar_interes_id`, `nombre`) VALUES
(1,1, 'Colegio'),
(1,2, 'Universidad'),
(1,3, 'Hospital'),
(1,4, 'Farmacia');

INSERT INTO `lugares_interes_idiomas` (`idioma_id`, `lugar_interes_id`, `nombre`) VALUES
(53,1, 'School'),
(53,2, 'University'),
(53,3, 'Hospital'),
(53,4, 'Pharmacy');

--
-- Filtros para la tabla `lugares_interes_idiomas`
--
ALTER TABLE `lugares_interes_idiomas`
  ADD CONSTRAINT `FK_lugares_interes_idiomas_idioma_id` FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`id_idioma`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `lugares_interes_idiomas`
  ADD CONSTRAINT `FK_lugares_interes_idiomas_lugar_interes_id` FOREIGN KEY (`lugar_interes_id`) REFERENCES `lugares_interes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

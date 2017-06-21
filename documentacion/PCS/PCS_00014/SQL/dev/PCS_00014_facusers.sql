-- Indice repetido
ALTER TABLE inmuebles DROP INDEX FK_clientes_estado_id;

--
-- Estructura de tabla para la tabla `demandas`
--

CREATE TABLE IF NOT EXISTS `demandas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `referencia` varchar(40) NOT NULL,
  `metros_desde` int(4) NOT NULL,
  `metros_hasta` int(4) NOT NULL,
  `habitaciones_desde` int(2) NOT NULL,
  `habitaciones_hasta` int(2) NOT NULL,
  `banios_desde` int(2) NOT NULL,
  `banios_hasta` int(2) NOT NULL,
  `precio_desde` int(10) unsigned NOT NULL,
  `precio_hasta` int(10) unsigned NOT NULL,
  `provincia_id` int(11) unsigned DEFAULT NULL,
  `poblacion_id` int(11) unsigned DEFAULT NULL,  
  `observaciones` text,  
  `estado_id` int(11) unsigned NOT NULL DEFAULT '1',
  `certificacion_energetica_id` int(11) unsigned DEFAULT NULL,  
  `anio_construccion_desde` int(4) NOT NULL,
  `agente_asignado_id` int(11) unsigned DEFAULT NULL,
  `oferta_id` int(2) NOT NULL DEFAULT '0',
  `tipo_demanda_id` int(2) NOT NULL DEFAULT '1',
  `cliente_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_demandas_agente_asignado_id` (`agente_asignado_id`),
  KEY `FK_demandas_certificacion_energetica_id` (`certificacion_energetica_id`),
  KEY `FK_demandas_provincia_id` (`provincia_id`),
  KEY `FK_demandas_estado_id` (`estado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


--
-- Filtros para la tabla `demandas`
--
ALTER TABLE `demandas`
  ADD CONSTRAINT `FK_demandas_agente_asignado_id` FOREIGN KEY (`agente_asignado_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_demandas_certificacion_energetica_id` FOREIGN KEY (`certificacion_energetica_id`) REFERENCES `tipos_certificacion_energetica` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_demandas_estado_id` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_demandas_provincia_id` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_demandas_poblacion_id` FOREIGN KEY (`poblacion_id`) REFERENCES `poblaciones` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_demandas_cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON UPDATE CASCADE;
 
  
--
-- Estructura de tabla para la tabla `demandas_poblaciones_zonas`
--

CREATE TABLE IF NOT EXISTS `demandas_poblaciones_zonas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `demanda_id` int(11) unsigned NOT NULL,
  `zona_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_demandas_zonas_demanda_id` (`demanda_id`),
  KEY `FK_demandas_zonas_zona_id` (`zona_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Filtros para la tabla `demandas_poblaciones_zonas`
--
ALTER TABLE `demandas_poblaciones_zonas`
  ADD CONSTRAINT `FK_demandas_zonas_zona_id` FOREIGN KEY (`zona_id`) REFERENCES `poblaciones_zonas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_demandas_zonas_demanda_id` FOREIGN KEY (`demanda_id`) REFERENCES `demandas` (`id`) ON DELETE CASCADE;
  
--
-- Estructura de tabla para la tabla `demandas_tipos_inmueble`
--

CREATE TABLE IF NOT EXISTS `demandas_tipos_inmueble` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `demanda_id` int(11) unsigned NOT NULL,
  `tipo_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_demandas_zonas_demanda_id` (`demanda_id`),
  KEY `FK_demandas_zonas_tipo_id` (`tipo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Filtros para la tabla `demandas_tipos_inmueble`
--
ALTER TABLE `demandas_tipos_inmueble`
  ADD CONSTRAINT `FK_demandas_tipos_inmueble_tipo_id` FOREIGN KEY (`tipo_id`) REFERENCES `tipos_inmueble` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_demandas_tipos_inmueble_demanda_id` FOREIGN KEY (`demanda_id`) REFERENCES `demandas` (`id`) ON DELETE CASCADE;

  
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `demandas_ficheros`
--

CREATE TABLE IF NOT EXISTS `demandas_ficheros` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `demanda_id` int(11) unsigned NOT NULL,
  `texto_fichero` text,
  `fichero` varchar(255) NOT NULL,
  `tipo_fichero_id` int(11) unsigned NOT NULL DEFAULT '7',
  PRIMARY KEY (`id`),
  KEY `FK_demandas_ficheros_demanda_id` (`demanda_id`),
  KEY `FK_demandas_ficheros_tipo_fichero_id` (`tipo_fichero_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles_demandas`
--

CREATE TABLE IF NOT EXISTS `inmuebles_demandas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `inmueble_id` int(11) unsigned NOT NULL,
  `demanda_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_inmuebles_demandas_inmueble_id` (`inmueble_id`),
  KEY `FK_inmuebles_demandas_demanda_id` (`demanda_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_demandas_ficheros`
--
CREATE TABLE IF NOT EXISTS `v_demandas_ficheros` (
`id` int(11) unsigned
,`demanda_id` int(11) unsigned
,`texto_fichero` text
,`fichero` varchar(255)
,`tipo_fichero_id` int(11) unsigned
,`nombre_tipo` varchar(150)
);
-- --------------------------------------------------------

--
-- Estructura para la vista `v_demandas_ficheros`
--
DROP TABLE IF EXISTS `v_demandas_ficheros`;

CREATE OR REPLACE VIEW `v_demandas_ficheros` AS select `demandas_ficheros`.`id` AS `id`,`demandas_ficheros`.`demanda_id` AS `demanda_id`,`demandas_ficheros`.`texto_fichero` AS `texto_fichero`,`demandas_ficheros`.`fichero` AS `fichero`,`demandas_ficheros`.`tipo_fichero_id` AS `tipo_fichero_id`,`tipos_ficheros`.`nombre` AS `nombre_tipo` from (`demandas_ficheros` join `tipos_ficheros` on((`demandas_ficheros`.`tipo_fichero_id` = `tipos_ficheros`.`id`)));


--
-- Filtros para la tabla `demandas_ficheros`
--
ALTER TABLE `demandas_ficheros`
  ADD CONSTRAINT `FK_demandas_ficheros_tipo_fichero_id` FOREIGN KEY (`tipo_fichero_id`) REFERENCES `tipos_ficheros` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `inmuebles_demandas`
--
ALTER TABLE `inmuebles_demandas`
  ADD CONSTRAINT `FK_inmuebles_demandas_demanda_id` FOREIGN KEY (`demanda_id`) REFERENCES `demandas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_demandas_inmueble_id` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE;

  
  
  
ALTER TABLE `demandas` ADD `anio_construccion_hasta` INT(4) NOT NULL AFTER `anio_construccion_desde`;
ALTER TABLE `demandas` ADD `fecha_alta` date NOT NULL;
ALTER TABLE `demandas` ADD `fecha_actualizacion` datetime default null;


ALTER TABLE `inmuebles_demandas` ADD `origen_id` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '1 para automáticos, aquellos asignados a través de un filtro de búsqueda, 2 para los propuestos por el agente' ;
ALTER TABLE `inmuebles_demandas` ADD `evaluacion_id` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '1 para pendientes de evaluar, estas se eliminarán si hay una nueva búsqueda, 2 para aquellas que interesan y 0 para las que no' ;
ALTER TABLE `inmuebles_demandas` ADD `observaciones` varchar(255) NOT NULL ;
ALTER TABLE `inmuebles_demandas` ADD `fecha_asignacion` DATE NOT NULL ;


`origen_id` int(2) unsigned NOT NULL '',
  origen`
  evaluacion_id
  observaciones


  
  
CREATE 
    OR REPLACE
VIEW `v_demandas` AS
    SELECT 
        demandas.*,
        poblaciones.poblacion AS nombre_poblacion,
		provincias.provincia AS nombre_provincia,
		tipos_certificacion_energetica.nombre AS nombre_certificacion_energetica,
		estados.nombre AS nombre_estado,
		CONCAT_WS(', ',users.last_name,users.first_name) AS nombre_agente_asignado,
		CONCAT_WS(', ',clientes.apellidos,clientes.nombre) AS nombre_cliente
    FROM
        demandas
		JOIN estados ON demandas.estado_id = estados.id
        LEFT JOIN poblaciones ON demandas.poblacion_id = poblaciones.id
		LEFT JOIN provincias ON demandas.provincia_id = provincias.id
		JOIN clientes ON demandas.cliente_id = clientes.id
		LEFT JOIN tipos_certificacion_energetica ON demandas.certificacion_energetica_id = tipos_certificacion_energetica.id
		LEFT JOIN users ON demandas.agente_asignado_id = users.id;
		
		
drop table inmuebles_fichas_visita;
drop table fichas_visita;

--
-- Estructura de tabla para la tabla `fichas_visita`
--

CREATE TABLE IF NOT EXISTS `fichas_visita` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `demanda_id` int(11) unsigned NOT NULL,
  `agente_id` int(11) unsigned NOT NULL,
  `documento_generado_id` int(11) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `observaciones` text,
  PRIMARY KEY (`id`),
  KEY `FK_fichas_visita_documento_generado_id` (`documento_generado_id`),
  KEY `FK_fichas_visita_demanda_id` (`demanda_id`),
  KEY `FK_fichas_visita_agente_id` (`agente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles_fichas_visita`
--

CREATE TABLE IF NOT EXISTS `inmuebles_fichas_visita` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ficha_visita_id` int(11) unsigned NOT NULL,
  `inmueble_id` int(11) unsigned NOT NULL,
  `hora` varchar(10) NOT NULL,
  `fecha_hora` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_inmuebles_fichas_visita_ficha_visita_id` (`ficha_visita_id`),
  KEY `FK_inmuebles_fichas_visita_inmueble_id` (`inmueble_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Filtros para la tabla `fichas_visita`
--
ALTER TABLE `fichas_visita`
  ADD CONSTRAINT `FK_fichas_visita_documento_generado_id` FOREIGN KEY (`documento_generado_id`) REFERENCES `documentos_generados` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_fichas_visita_agente_id` FOREIGN KEY (`agente_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_fichas_visita_demanda_id` FOREIGN KEY (`demanda_id`) REFERENCES `demandas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inmuebles_fichas_visita`
--
ALTER TABLE `inmuebles_fichas_visita`
  ADD CONSTRAINT `FK_inmuebles_fichas_visita_ficha_visita_id` FOREIGN KEY (`ficha_visita_id`) REFERENCES `fichas_visita` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_fichas_visita_inmueble_id` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON UPDATE CASCADE;





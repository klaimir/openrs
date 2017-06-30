ALTER TABLE `inmuebles` ADD `cartel_id` INT(11) UNSIGNED DEFAULT NULL;

CREATE INDEX FK_inmuebles_cartel_id ON inmuebles (cartel_id);

--
-- Filtros para la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD CONSTRAINT `FK_inmuebles_cartel_id` FOREIGN KEY (`cartel_id`) REFERENCES `documentos_generados` (`id`) ON UPDATE CASCADE;



  CREATE 
    OR REPLACE
VIEW `v_inmuebles` AS
    SELECT 
        inmuebles.*,
        poblaciones.poblacion AS nombre_poblacion,
		poblaciones.provincia_id AS provincia_id,
		provincias.provincia AS nombre_provincia,
		tipos_inmueble_idiomas.nombre AS nombre_tipo,
		tipos_inmueble_idiomas.idioma_id AS idioma_id,
		tipos_certificacion_energetica.nombre AS nombre_certificacion_energetica,
		estados.nombre AS nombre_estado
    FROM
        inmuebles
		JOIN estados ON inmuebles.estado_id = estados.id
        JOIN poblaciones ON inmuebles.poblacion_id = poblaciones.id
		JOIN provincias ON poblaciones.provincia_id = provincias.id
		JOIN tipos_inmueble ON inmuebles.tipo_id = tipos_inmueble.id
		JOIN tipos_inmueble_idiomas ON tipos_inmueble_idiomas.tipo_inmueble_id = tipos_inmueble.id
		LEFT JOIN tipos_certificacion_energetica ON inmuebles.certificacion_energetica_id = tipos_certificacion_energetica.id
		LEFT JOIN documentos_generados ON inmuebles.cartel_id = documentos_generados.id;

  
  
  
  
  


drop table documentos_generados;

--
-- Estructura de tabla para la tabla `documentos_generados`
--

CREATE TABLE IF NOT EXISTS `documentos_generados` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `plantilla_id` int(11) unsigned NOT NULL,
  `agente_id` int(11) unsigned NOT NULL,
  `HTML` text NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_documentos_generados_agente_id` (`agente_id`),
  KEY `FK_documentos_generados_tipo_plantilla_id` (`tipo_plantilla_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Filtros para la tabla `documentos_generados`
--
ALTER TABLE `documentos_generados`
  ADD CONSTRAINT `FK_documentos_generados_agente_id` FOREIGN KEY (`agente_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_documentos_generados_plantilla_id` FOREIGN KEY (`plantilla_id`) REFERENCES `plantillas_documentacion` (`id`) ON UPDATE CASCADE;



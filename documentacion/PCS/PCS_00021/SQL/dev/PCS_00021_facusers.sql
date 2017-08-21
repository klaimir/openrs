--
-- Estructura de tabla para la tabla `medios_captacion`
--

DROP TABLE IF EXISTS `medios_captacion`;
CREATE TABLE IF NOT EXISTS `medios_captacion` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  UNIQUE KEY `unique_medios_captacion` (`nombre`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `tipos_ficheros`
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

-- Cambios para clientes

ALTER TABLE `clientes` ADD `medio_captacion_id` INT(11) UNSIGNED NOT NULL ;

UPDATE `clientes` SET `medio_captacion_id` = '6' WHERE `clientes`.`id` >= 1;
UPDATE `clientes` SET `medio_captacion_id` = '5' WHERE `clientes`.`id` >= 10;
UPDATE `clientes` SET `medio_captacion_id` = '2' WHERE `clientes`.`id` >= 20;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `FK_clientes_medio_captacion_id` FOREIGN KEY (`medio_captacion_id`) REFERENCES `medios_captacion` (`id`) ON UPDATE CASCADE;
  
-- Vista clientes
CREATE 
    OR REPLACE
VIEW `v_clientes` AS
    SELECT 
        clientes.*,
        poblaciones.poblacion AS nombre_poblacion,
		poblaciones.provincia_id AS provincia_id,
		provincias.provincia AS nombre_provincia,
        paises.nombre AS nombre_pais,
		estados.nombre AS nombre_estado,
		estados.historico AS historico_estado,
		medios_captacion.nombre AS nombre_medio_captacion,
		CONCAT_WS(', ',users.last_name,users.first_name) AS nombre_agente_asignado,
		DATE_FORMAT(clientes.fecha_alta, "%c") as mes_alta,
		DATE_FORMAT(clientes.fecha_alta, "%Y") as anio_alta
    FROM
        clientes
		JOIN estados ON clientes.estado_id = estados.id
		JOIN medios_captacion ON clientes.medio_captacion_id = medios_captacion.id
        LEFT JOIN poblaciones ON clientes.poblacion_id = poblaciones.id
		LEFT JOIN provincias ON poblaciones.provincia_id = provincias.id
		JOIN paises ON clientes.pais_id = paises.id
		LEFT JOIN users ON clientes.agente_asignado_id = users.id;


CREATE 
    OR REPLACE
VIEW `openrs`.`v_demandas` AS
    SELECT 
        `openrs`.`demandas`.`id` AS `id`,
        `openrs`.`demandas`.`referencia` AS `referencia`,
        `openrs`.`demandas`.`metros_desde` AS `metros_desde`,
        `openrs`.`demandas`.`metros_hasta` AS `metros_hasta`,
        `openrs`.`demandas`.`habitaciones_desde` AS `habitaciones_desde`,
        `openrs`.`demandas`.`habitaciones_hasta` AS `habitaciones_hasta`,
        `openrs`.`demandas`.`banios_desde` AS `banios_desde`,
        `openrs`.`demandas`.`banios_hasta` AS `banios_hasta`,
        `openrs`.`demandas`.`precio_desde` AS `precio_desde`,
        `openrs`.`demandas`.`precio_hasta` AS `precio_hasta`,
        `openrs`.`demandas`.`provincia_id` AS `provincia_id`,
        `openrs`.`demandas`.`poblacion_id` AS `poblacion_id`,
        `openrs`.`demandas`.`observaciones` AS `observaciones`,
        `openrs`.`demandas`.`estado_id` AS `estado_id`,
        `openrs`.`demandas`.`certificacion_energetica_id` AS `certificacion_energetica_id`,
        `openrs`.`demandas`.`anio_construccion_desde` AS `anio_construccion_desde`,
        `openrs`.`demandas`.`anio_construccion_hasta` AS `anio_construccion_hasta`,
        `openrs`.`demandas`.`agente_asignado_id` AS `agente_asignado_id`,
        `openrs`.`demandas`.`oferta_id` AS `oferta_id`,
        `openrs`.`demandas`.`tipo_demanda_id` AS `tipo_demanda_id`,
        `openrs`.`demandas`.`cliente_id` AS `cliente_id`,
        `openrs`.`demandas`.`fecha_alta` AS `fecha_alta`,
        `openrs`.`demandas`.`fecha_actualizacion` AS `fecha_actualizacion`,
        `openrs`.`poblaciones`.`poblacion` AS `nombre_poblacion`,
        `openrs`.`provincias`.`provincia` AS `nombre_provincia`,
        `openrs`.`tipos_certificacion_energetica`.`nombre` AS `nombre_certificacion_energetica`,
        `openrs`.`estados`.`nombre` AS `nombre_estado`,
        `openrs`.`estados`.`historico` AS `historico`,
        CONCAT_WS(', ',
                `openrs`.`users`.`last_name`,
                `openrs`.`users`.`first_name`) AS `nombre_agente_asignado`,
        CONCAT_WS(', ',
                `openrs`.`clientes`.`apellidos`,
                `openrs`.`clientes`.`nombre`) AS `nombre_cliente`,
		DATE_FORMAT(demandas.fecha_alta, "%c") as mes_alta,
		DATE_FORMAT(demandas.fecha_alta, "%Y") as anio_alta,
		CASE demandas.oferta_id
		  WHEN 1 THEN 'Venta'
		  WHEN 2 THEN 'Alquiler'
		  WHEN 3 THEN 'Venta y Alquiler'
		END as 'nombre_oferta',
		CASE demandas.tipo_demanda_id
		  WHEN 1 THEN 'Sin filtros de búsqueda'
		  WHEN 2 THEN 'Con filtros de búsqueda'
		END as 'nombre_tipo_demanda'
    FROM
        ((((((`openrs`.`demandas`
        JOIN `openrs`.`estados` ON ((`openrs`.`demandas`.`estado_id` = `openrs`.`estados`.`id`)))
        LEFT JOIN `openrs`.`poblaciones` ON ((`openrs`.`demandas`.`poblacion_id` = `openrs`.`poblaciones`.`id`)))
        LEFT JOIN `openrs`.`provincias` ON ((`openrs`.`demandas`.`provincia_id` = `openrs`.`provincias`.`id`)))
        JOIN `openrs`.`clientes` ON ((`openrs`.`demandas`.`cliente_id` = `openrs`.`clientes`.`id`)))
        LEFT JOIN `openrs`.`tipos_certificacion_energetica` ON ((`openrs`.`demandas`.`certificacion_energetica_id` = `openrs`.`tipos_certificacion_energetica`.`id`)))
        LEFT JOIN `openrs`.`users` ON ((`openrs`.`demandas`.`agente_asignado_id` = `openrs`.`users`.`id`)));
		
		
		
	
-- Vista v_demandas_tipos_inmueble
CREATE 
    OR REPLACE
VIEW `v_demandas_tipos_inmueble` AS
    SELECT 
        demandas_tipos_inmueble.*,
		tipos_inmueble_idiomas.nombre AS nombre_tipo_inmueble,
		tipos_inmueble_idiomas.idioma_id AS idioma_id,
		estados.historico,
		demandas.agente_asignado_id
    FROM
        demandas_tipos_inmueble
		JOIN demandas ON demandas_tipos_inmueble.demanda_id = demandas.id
		JOIN estados ON demandas.estado_id = estados.id
		JOIN tipos_inmueble ON demandas_tipos_inmueble.tipo_id = tipos_inmueble.id
		JOIN tipos_inmueble_idiomas ON tipos_inmueble_idiomas.tipo_inmueble_id = tipos_inmueble.id;
		
		
		
-- Inmuebles de una demanda
CREATE 
    OR REPLACE
VIEW `v_inmuebles_demandas` AS
    SELECT 
 		v_inmuebles.*, 
		demandas.cliente_id, demandas.agente_asignado_id, demandas.referencia as referencia_demanda, estados.historico as historico_demanda,
		inmuebles_demandas.demanda_id, inmuebles_demandas.origen_id, inmuebles_demandas.evaluacion_id, inmuebles_demandas.observaciones as observaciones_demanda, inmuebles_demandas.fecha_asignacion, 
		DATE_FORMAT(inmuebles_demandas.fecha_asignacion, "%d/%m/%Y") as fecha_asignacion_formateada, inmuebles_demandas.id as inmueble_demanda_id,
        CASE inmuebles_demandas.origen_id
		  WHEN 1 THEN 'OPENRS'
		  WHEN 2 THEN 'Agente'
		END as 'nombre_origen',
		CASE inmuebles_demandas.evaluacion_id
		  WHEN 1 THEN 'Pendiente evaluar'
		  WHEN 2 THEN 'Propuesto para visita'
		  WHEN 3 THEN 'Pendiente decisión cliente'
		  WHEN 4 THEN 'Descartado por agente'
		  WHEN 5 THEN 'Interesa cliente'
		  WHEN 6 THEN 'No Interesa cliente'
		END as 'nombre_evaluacion'
    FROM v_inmuebles
	JOIN inmuebles_demandas on inmuebles_demandas.inmueble_id=v_inmuebles.id
	JOIN demandas on inmuebles_demandas.demanda_id=demandas.id
	JOIN estados ON demandas.estado_id = estados.id;
--
-- Estructura de tabla para la tabla `inmuebles_carteles`
--

CREATE TABLE IF NOT EXISTS `inmuebles_carteles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `plantilla_id` int(11) unsigned NOT NULL,
  `agente_id` int(11) unsigned NOT NULL,
  `html` text NOT NULL,
  `fecha` date NOT NULL,
  `inmueble_id` int(11) unsigned DEFAULT NULL,
  `idioma_id` int(11) unsigned DEFAULT NULL,
  `impreso` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_inmuebles_carteles_agente_id` (`agente_id`),
  KEY `FK_inmuebles_carteles_plantilla_id` (`plantilla_id`),
  UNIQUE KEY `FK_inmuebles_carteles_inmueble_id` (`inmueble_id`),
  KEY `FK_inmuebles_carteles_idioma_id` (`idioma_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Filtros para la tabla `inmuebles_carteles`
--
ALTER TABLE `inmuebles_carteles`
  ADD CONSTRAINT `FK_inmuebles_carteles_agente_id` FOREIGN KEY (`agente_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_carteles_inmueble_id` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_carteles_plantilla_id` FOREIGN KEY (`plantilla_id`) REFERENCES `plantillas_documentacion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_carteles_idioma_id` FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`id_idioma`) ON UPDATE CASCADE;



-- Vista inmuebles
CREATE 
    OR REPLACE
VIEW `v_inmuebles` AS
    SELECT 
        inmuebles.*,
        poblaciones.poblacion AS nombre_poblacion,
		poblaciones.provincia_id AS provincia_id,
		provincias.provincia AS nombre_provincia,
        poblaciones_zonas.nombre AS nombre_zona,
		tipos_inmueble_idiomas.nombre AS nombre_tipo,
		tipos_inmueble_idiomas.idioma_id AS idioma_id,
		tipos_certificacion_energetica.nombre AS nombre_certificacion_energetica,
		estados.nombre AS nombre_estado,
		CONCAT_WS(', ',users.last_name,users.first_name) AS nombre_captador,
		inmuebles_carteles.id as cartel_id
		inmuebles_carteles.impreso as cartel_impreso
    FROM
        inmuebles
		JOIN estados ON inmuebles.estado_id = estados.id
        JOIN poblaciones ON inmuebles.poblacion_id = poblaciones.id
		JOIN provincias ON poblaciones.provincia_id = provincias.id
		LEFT JOIN poblaciones_zonas ON inmuebles.zona_id = poblaciones_zonas.id
		JOIN tipos_inmueble ON inmuebles.tipo_id = tipos_inmueble.id
		JOIN tipos_inmueble_idiomas ON tipos_inmueble_idiomas.tipo_inmueble_id = tipos_inmueble.id
		LEFT JOIN tipos_certificacion_energetica ON inmuebles.certificacion_energetica_id = tipos_certificacion_energetica.id
		LEFT JOIN users ON inmuebles.captador_id = users.id
		LEFT JOIN inmuebles_carteles ON inmuebles_carteles.inmueble_id = inmuebles.id;


-- Eliminamos restricción para que no de problemas al insertar usuario
ALTER TABLE `fichas_visita` DROP FOREIGN KEY `FK_fichas_visita_documento_generado_id`;

ALTER TABLE `fichas_visita` DROP `documento_generado_id`;

drop table documentos_generados;

-- Carteles del inmueble
INSERT INTO `categorias_informacion_documentacion` (`id`, `nombre`, `referencia`, `descripcion`) VALUES ('6', 'Cartel', 'carteles', 'Carteles del inmueble');

-- Ficha demanda
INSERT INTO `tipos_plantilla_documentacion` (`id`, `nombre`, `descripcion`) VALUES ('5', 'Ficha demanda', '');
INSERT INTO `categorias_informacion_documentacion` (`id`, `nombre`, `referencia`, `descripcion`) VALUES (7, 'Demandas', 'demandas', '-');

-- Añadirmos el QR sólo para el carteles
INSERT INTO `tipos_plantilla_documentacion_categorias_asignadas` (`id`, `tipo_plantilla_id`, `categoria_inf_id`) VALUES (NULL, '3', '6');

-- Añadirmos datos de la ficha de demanda
INSERT INTO `tipos_plantilla_documentacion_categorias_asignadas` (`id`, `tipo_plantilla_id`, `categoria_inf_id`) VALUES (NULL, '5', '1');
INSERT INTO `tipos_plantilla_documentacion_categorias_asignadas` (`id`, `tipo_plantilla_id`, `categoria_inf_id`) VALUES (NULL, '5', '4');
INSERT INTO `tipos_plantilla_documentacion_categorias_asignadas` (`id`, `tipo_plantilla_id`, `categoria_inf_id`) VALUES (NULL, '5', '7');

-- Marcas
truncate marcas_documentacion;

INSERT INTO `marcas_documentacion` (`referencia`, `descripcion`, `especial`, `categoria_inf_id`) VALUES
('f_actual_numero', 'Fecha actual en formato numérico', 0, 1),
('f_actual_texto', 'Fecha actual en formato texto', 0, 1),
('nif', 'NIF/NIE/CIF del cliente', 0, 2),
('nombre', 'Nombre del cliente', 0, 2),
('apellidos', 'Apellidos del cliente', 0, 2),
('fecha_nac', 'Fecha de nacimiento', 1, 2),
('nombre_pais', 'Nombre del país donde reside', 0, 2),
('nombre_provincia', 'Nombre de la provincia', 0, 2),
('nombre_poblacion', 'Nombre del municipio', 0, 2),
('direccion', 'Domicilio donde reside el cliente', 0, 2),
('correo', 'Correo electrónico', 0, 2),
('telefonos', 'Teléfonos de contacto', 0, 2),
('nombre_estado', 'Estado', 0, 2),
('nombre_agente_asignado', 'Nombre del agente asignado', 0, 2),
('observaciones', 'Observaciones', 0, 2),
('referencia', 'Referencia del inmueble', 0, 3),
('fecha_alta', 'Fecha de alta del inmueble', 1, 3),
('nombre_tipo', 'Tipo del inmueble', 0, 3),
('nombre_provincia', 'Nombre de la provincia', 0, 3),
('nombre_poblacion', 'Nombre del municipio', 0, 3),
('nombre_zona', 'Nombre de la zona del municipio', 0, 3),
('direccion', 'Dirección real del inmueble', 0, 3),
('metros', 'Metros totales', 0, 3),
('metros_utiles', 'Metros útiles', 0, 3),
('habitaciones', 'Número de habitaciones', 0, 3),
('banios', 'Número de baños', 0, 3),
('precio_compra', 'Precio de compra', 1, 3),
('precio_compra_anterior', 'Precio de compra anterior', 1, 3),
('precio_alquiler', 'Precio alquiler', 1, 3),
('precio_alquiler_anterior', 'Precio alquiler anterior', 1, 3),
('nombre_certificacion_energetica', 'Certificación energética', 0, 3),
('direccion_publica', 'Dirección mostrada en la zona pública', 0, 3),
('titulo_publico', 'Título mostrado en la zona pública', 1, 3),
('descripcion_publica', 'Descripción extendida mostrada en la zona pública', 1, 3),
('url_seo', 'URL SEO', 1, 3),
('descripcion_seo', 'Descripción SEO', 1, 3),
('keywords_seo', 'Palabras clave para el SEO', 1, 3),
('nombre_estado', 'Estado', 0, 3),
('nombre_captador', 'Nombre completo del captador', 0, 3),
('observaciones', 'Observaciones', 0, 3),
('imagen_portada', 'Imagen de la portada pública', 1, 3),
('codigo_qr', 'Código QR del URL SEO de la zona pública', 1, 6),
('nombre', 'Nombre del agente', 1, 4),
('apellidos', 'Apellidos del agente', 1, 4),
('referencia', 'Referencia de la demanda', 0, 7),
('fecha_alta', 'Fecha de alta de la demanda', 1, 7),
('oferta', 'Oferta demandada', 0, 7),
('tipo', 'Tipo de demanda', 0, 7),
('nombre_cliente', 'Nombre completo del cliente demandante', 0, 7),
('tipos_inmuebles', 'Listado de tipos de inmuebles separados por comas', 0, 7),
('nombre_provincia', 'Nombre de la provincia', 0, 7),
('nombre_poblacion', 'Nombre del municipio', 0, 7),
('zonas', 'Listado de zonas separados por comas', 0, 7),
('metros_desde', 'Metros totales (desde)', 0, 7),
('metros_hasta', 'Metros totales (hasta)', 0, 7),
('habitaciones_desde', 'Número de habitaciones (desde)', 0, 7),
('habitaciones_hasta', 'Número de habitaciones (hasta)', 0, 7),
('banios_desde', 'Número de baños (desde)', 0, 7),
('banios_hasta', 'Número de baños (hasta)', 0, 7),
('precio_desde', 'Precio (desde)', 1, 7),
('precio_hasta', 'Precio (hasta)', 1, 7),
('anio_construccion_desde', 'Año construcción (desde)', 0, 7),
('anio_construccion_hasta', 'Año construcción (hasta)', 0, 7),
('nombre_certificacion_energetica', 'Certificación energética mínima', 0, 7),
('nombre_estado', 'Estado', 0, 7),
('nombre_agente_asignado', 'Nombre completo del agente asignado', 0, 7),
('observaciones', 'Observaciones', 0, 7);  


--
-- Estructura de tabla para la tabla `inmuebles_fichas`
--

CREATE TABLE IF NOT EXISTS `inmuebles_fichas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `plantilla_id` int(11) unsigned NOT NULL,
  `agente_id` int(11) unsigned NOT NULL,
  `html` text NOT NULL,
  `fecha` date NOT NULL,
  `inmueble_id` int(11) unsigned DEFAULT NULL,
  `idioma_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_inmuebles_fichas_agente_id` (`agente_id`),
  KEY `FK_inmuebles_fichas_plantilla_id` (`plantilla_id`),
  UNIQUE KEY `FK_inmuebles_fichas_inmueble_id` (`inmueble_id`),
  KEY `FK_inmuebles_fichas_idioma_id` (`idioma_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Filtros para la tabla `inmuebles_fichas`
--
ALTER TABLE `inmuebles_fichas`
  ADD CONSTRAINT `FK_inmuebles_fichas_agente_id` FOREIGN KEY (`agente_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_fichas_inmueble_id` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_fichas_plantilla_id` FOREIGN KEY (`plantilla_id`) REFERENCES `plantillas_documentacion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inmuebles_fichas_idioma_id` FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`id_idioma`) ON UPDATE CASCADE;
  
  

--
-- Estructura de tabla para la tabla `clientes_fichas`
--

CREATE TABLE IF NOT EXISTS `clientes_fichas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `plantilla_id` int(11) unsigned NOT NULL,
  `agente_id` int(11) unsigned NOT NULL,
  `html` text NOT NULL,
  `fecha` date NOT NULL,
  `cliente_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_clientes_fichas_agente_id` (`agente_id`),
  KEY `FK_clientes_fichas_plantilla_id` (`plantilla_id`),
  UNIQUE KEY `FK_clientes_fichas_cliente_id` (`cliente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Filtros para la tabla `clientes_fichas`
--
ALTER TABLE `clientes_fichas`
  ADD CONSTRAINT `FK_clientes_fichas_agente_id` FOREIGN KEY (`agente_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_clientes_fichas_cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_clientes_fichas_plantilla_id` FOREIGN KEY (`plantilla_id`) REFERENCES `plantillas_documentacion` (`id`) ON UPDATE CASCADE;
  
  
  
--
-- Estructura de tabla para la tabla `demandas_fichas`
--

CREATE TABLE IF NOT EXISTS `demandas_fichas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `plantilla_id` int(11) unsigned NOT NULL,
  `agente_id` int(11) unsigned NOT NULL,
  `html` text NOT NULL,
  `fecha` date NOT NULL,
  `demanda_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_demandas_fichas_agente_id` (`agente_id`),
  KEY `FK_demandas_fichas_plantilla_id` (`plantilla_id`),
  UNIQUE KEY `FK_demandas_fichas_demanda_id` (`demanda_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Filtros para la tabla `demandas_fichas`
--
ALTER TABLE `demandas_fichas`
  ADD CONSTRAINT `FK_demandas_fichas_agente_id` FOREIGN KEY (`agente_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_demandas_fichas_demanda_id` FOREIGN KEY (`demanda_id`) REFERENCES `demandas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_demandas_fichas_plantilla_id` FOREIGN KEY (`plantilla_id`) REFERENCES `plantillas_documentacion` (`id`) ON UPDATE CASCADE;
  
  
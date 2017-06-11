-- Restricciones y campos para clientes
ALTER TABLE `clientes` ADD `fecha_nac` DATE NULL DEFAULT NULL AFTER `apellidos`;

CREATE 
    OR REPLACE
VIEW `v_clientes` AS
    SELECT 
        clientes.*,
        poblaciones.poblacion AS nombre_poblacion,
		poblaciones.provincia_id AS provincia_id,
		provincias.provincia AS nombre_provincia,
        paises.nombre AS nombre_pais,
		CONCAT_WS(',',users.last_name,users.first_name) AS nombre_agente_asignado
    FROM
        clientes
        LEFT JOIN poblaciones ON clientes.poblacion_id = poblaciones.id
		LEFT JOIN provincias ON poblaciones.provincia_id = provincias.id
		JOIN paises ON clientes.pais_id = paises.id
		LEFT JOIN users ON clientes.agente_asignado_id = users.id;
		

-- Restricciones y campos para documentación del cliente

ALTER TABLE `documentos_generados`
  ADD CONSTRAINT `FK_documentos_generados_agente_id` FOREIGN KEY (`agente_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
  
ALTER TABLE `documentos_generados`
  ADD CONSTRAINT `FK_documentos_generados_tipo_plantilla_id` FOREIGN KEY (`tipo_plantilla_id`) REFERENCES `tipos_plantilla_documentacion` (`id`) ON UPDATE CASCADE;
   		
ALTER TABLE `documentos_generados` ADD `cliente_id` INT(11) UNSIGNED DEFAULT NULL;

CREATE INDEX FK_documentos_generados_cliente_id ON documentos_generados (cliente_id);

ALTER TABLE `documentos_generados`
  ADD CONSTRAINT `FK_documentos_generados_cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE; 
  
  
  
  
-- Esta tabla solo albergará a los propietarios
ALTER TABLE `clientes_inmuebles` DROP `rol`;

-- Vista para inmueble
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
		CONCAT_WS(',',users.last_name,users.first_name) AS nombre_captador
    FROM
        inmuebles
        JOIN poblaciones ON inmuebles.poblacion_id = poblaciones.id
		JOIN provincias ON poblaciones.provincia_id = provincias.id
		LEFT JOIN poblaciones_zonas ON inmuebles.zona_id = poblaciones_zonas.id
		JOIN tipos_inmueble ON inmuebles.tipo_id = tipos_inmueble.id
		JOIN tipos_inmueble_idiomas ON tipos_inmueble_idiomas.tipo_inmueble_id = tipos_inmueble.id
		LEFT JOIN tipos_certificacion_energetica ON inmuebles.certificacion_energetica_id = tipos_certificacion_energetica.id
		LEFT JOIN users ON inmuebles.captador_id = users.id;
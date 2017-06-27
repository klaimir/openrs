CREATE TABLE IF NOT EXISTS `geocoding` (
`address` varchar(255) NOT NULL DEFAULT '',
`latitude` float DEFAULT NULL,
`longitude` float DEFAULT NULL,
PRIMARY KEY (`address`)
);

ALTER TABLE `inmuebles` CHANGE `precio_alquiler` `precio_alquiler` INT(7) UNSIGNED NOT NULL;

ALTER TABLE `inmuebles` ADD `precio_compra_anterior` INT(10) UNSIGNED NOT NULL AFTER `precio_compra`;
ALTER TABLE `inmuebles` ADD `precio_alquiler_anterior` INT(10) UNSIGNED NOT NULL AFTER `precio_alquiler`;

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
		CONCAT_WS(',',users.last_name,users.first_name) AS nombre_captador
    FROM
        inmuebles
		JOIN estados ON inmuebles.estado_id = estados.id
        JOIN poblaciones ON inmuebles.poblacion_id = poblaciones.id
		JOIN provincias ON poblaciones.provincia_id = provincias.id
		LEFT JOIN poblaciones_zonas ON inmuebles.zona_id = poblaciones_zonas.id
		JOIN tipos_inmueble ON inmuebles.tipo_id = tipos_inmueble.id
		JOIN tipos_inmueble_idiomas ON tipos_inmueble_idiomas.tipo_inmueble_id = tipos_inmueble.id
		LEFT JOIN tipos_certificacion_energetica ON inmuebles.certificacion_energetica_id = tipos_certificacion_energetica.id
		LEFT JOIN users ON inmuebles.captador_id = users.id;

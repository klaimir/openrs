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


-- Eliminamos restricción para que no de problemas al insertar usuario
ALTER TABLE `users` DROP FOREIGN KEY `FK_users_id_idioma`;

-- Corrección de rutas de imágenes
UPDATE `openrs`.`inmuebles_imagenes` SET `imagen` = replace(imagen,'uploads/inmuebles/REF0005','uploads/inmuebles/5');

-- Estados
ALTER TABLE `estados` CHANGE `ambito` `ambito_id` TINYINT(1) NOT NULL COMMENT '1 para clientes, 2 para inmuebles y 3 para demandas';
ALTER TABLE `estados` ADD `historico` TINYINT(1) NOT NULL DEFAULT 0;


CREATE 
    OR REPLACE
VIEW `v_estados` AS
    SELECT 
 		estados.*,
        CASE ambito_id
		  WHEN 1 THEN 'Clientes'
		  WHEN 2 THEN 'Inmuebles'
		  WHEN 3 THEN 'Demandas'
		END as 'nombre_ambito'
    FROM
        estados;
		
-- Crear estado en la demandas (aunque luego cambiaremos la tabla)

ALTER TABLE `demandas` ADD `estado_id` INT(11) UNSIGNED NOT NULL DEFAULT '1';

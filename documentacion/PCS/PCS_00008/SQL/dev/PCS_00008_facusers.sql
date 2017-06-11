
ALTER TABLE `clientes` CHANGE `correo` `correo` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `clientes` CHANGE `telefono` `telefonos` VARCHAR(70) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `clientes` CHANGE `fecha_alta` `fecha_alta` DATETIME NOT NULL;
ALTER TABLE `clientes` ADD `fecha_actualizacion` DATETIME DEFAULT NULL AFTER `fecha_alta`;


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


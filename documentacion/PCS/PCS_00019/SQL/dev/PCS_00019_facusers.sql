CREATE 
    OR REPLACE
VIEW `v_clientes_inmuebles` AS
    SELECT 
        `clientes_inmuebles`.*,
		`inmuebles`.`precio_compra`,
		`inmuebles`.`precio_alquiler`,
        `estados`.`historico`        
    FROM
        `clientes_inmuebles`
        JOIN `inmuebles` ON `clientes_inmuebles`.`inmueble_id` = `inmuebles`.`id`
        JOIN `estados` ON `inmuebles`.`estado_id` = `estados`.`id`;
		
		
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
                `openrs`.`clientes`.`nombre`) AS `nombre_cliente`
    FROM
        ((((((`openrs`.`demandas`
        JOIN `openrs`.`estados` ON ((`openrs`.`demandas`.`estado_id` = `openrs`.`estados`.`id`)))
        LEFT JOIN `openrs`.`poblaciones` ON ((`openrs`.`demandas`.`poblacion_id` = `openrs`.`poblaciones`.`id`)))
        LEFT JOIN `openrs`.`provincias` ON ((`openrs`.`demandas`.`provincia_id` = `openrs`.`provincias`.`id`)))
        JOIN `openrs`.`clientes` ON ((`openrs`.`demandas`.`cliente_id` = `openrs`.`clientes`.`id`)))
        LEFT JOIN `openrs`.`tipos_certificacion_energetica` ON ((`openrs`.`demandas`.`certificacion_energetica_id` = `openrs`.`tipos_certificacion_energetica`.`id`)))
        LEFT JOIN `openrs`.`users` ON ((`openrs`.`demandas`.`agente_asignado_id` = `openrs`.`users`.`id`)));
		

-- Campos no usados
ALTER TABLE `clientes`
  DROP `busca_vender`,
  DROP `busca_comprar`,
  DROP `busca_alquilar`,
  DROP `busca_alquiler`,
  DROP `estado_civil`;

ALTER TABLE `inmuebles`
  DROP `obra_nueva`,
  DROP `cuota_comunidad`,
  DROP `forma_pago`,
  DROP `anejos`,
  DROP `cargas_vivienda`,
  DROP `descripcion_vivienda`,
  DROP `antiguedad_edificio`;
  
  
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
		CONCAT_WS(',',users.last_name,users.first_name) AS nombre_agente_asignado
    FROM
        clientes
		JOIN estados ON clientes.estado_id = estados.id
        LEFT JOIN poblaciones ON clientes.poblacion_id = poblaciones.id
		LEFT JOIN provincias ON poblaciones.provincia_id = provincias.id
		JOIN paises ON clientes.pais_id = paises.id
		LEFT JOIN users ON clientes.agente_asignado_id = users.id;

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
		inmuebles_carteles.id as cartel_id,
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
		
-- Inmuebles de una demanda
CREATE 
    OR REPLACE
VIEW `v_inmuebles_demandas` AS
    SELECT 
 		v_inmuebles.*, 
		demandas.cliente_id, demandas.agente_asignado_id,
		inmuebles_demandas.demanda_id, inmuebles_demandas.origen_id, inmuebles_demandas.evaluacion_id, inmuebles_demandas.observaciones as observaciones_demanda, inmuebles_demandas.fecha_asignacion, 
		DATE_FORMAT(inmuebles_demandas.fecha_asignacion, "%d/%m/%Y") as fecha_asignacion_formateada, inmuebles_demandas.id as inmueble_demanda_id,
        CASE inmuebles_demandas.origen_id
		  WHEN 1 THEN 'OPENRS'
		  WHEN 2 THEN 'Agente'
		END as 'nombre_origen',
		CASE inmuebles_demandas.evaluacion_id
		  WHEN 1 THEN 'Pendiente evaluar'
		  WHEN 2 THEN 'Propuesto para visita'
		  WHEN 3 THEN 'Descartado por agente'
		  WHEN 4 THEN 'Interesa cliente'
		  WHEN 5 THEN 'No Interesa cliente'
		END as 'nombre_evaluacion',
		fichas_visita_inmuebles_demandas.ficha_visita_id, fichas_visita.visitado, 
		DATE_FORMAT(fichas_visita.fecha, "%d/%m/%Y") as fecha_visita_formateada,
		fichas_visita.fecha as fecha_visita,
		DATE_FORMAT(fichas_visita_inmuebles_demandas.fecha_hora, "%H:%i") as hora_visita_formateada,
        DATE_FORMAT(fichas_visita_inmuebles_demandas.fecha_hora, "%d/%m/%Y %H:%i") as fecha_hora_visita_formateada,
		fichas_visita_inmuebles_demandas.fecha_hora as fecha_hora_visita
    FROM v_inmuebles
	JOIN inmuebles_demandas on inmuebles_demandas.inmueble_id=v_inmuebles.id
	JOIN demandas on inmuebles_demandas.demanda_id=demandas.id
	LEFT JOIN fichas_visita_inmuebles_demandas on fichas_visita_inmuebles_demandas.inmueble_demanda_id=inmuebles_demandas.id
	LEFT JOIN fichas_visita on fichas_visita_inmuebles_demandas.ficha_visita_id=fichas_visita.id;
		
-- Backup
ALTER TABLE `backup` ADD `backup_type` INT(1) NOT NULL DEFAULT '1' AFTER `backup_location`;
		
-- Vista v_backups
CREATE 
    OR REPLACE
VIEW `v_backups` AS
    SELECT 
        backup.*,
		CASE backup.backup_type
		  WHEN 1 THEN 'Base de datos'
		  WHEN 2 THEN 'Ficheros'
		  WHEN 3 THEN 'Completa'
		END as 'tipo_backup',
		DATE_FORMAT(backup.created_date, "%d/%m/%Y %H:%i:%s") as fecha_hora,
		CONCAT_WS(', ',users.last_name,users.first_name) AS nombre_admin
    FROM
        backup
		JOIN users ON backup.admin_id = users.id;
	
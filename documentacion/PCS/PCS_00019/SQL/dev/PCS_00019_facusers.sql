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


ALTER TABLE `inmuebles` ADD `kwh_m2_anio` INT(5) NOT NULL AFTER `certificacion_energetica_id`;
ALTER TABLE `inmuebles` DROP `descripcion_edificio`;

drop table fichas_visita_inmuebles_demandas;
drop table fichas_visita;

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
		estados.historico AS historico_estado,
		CONCAT_WS(', ',users.last_name,users.first_name) AS nombre_captador,
		inmuebles_carteles.id as cartel_id,
		inmuebles_carteles.impreso as cartel_impreso,
		DATE_FORMAT(inmuebles.fecha_alta, "%c") as mes_alta,
		DATE_FORMAT(inmuebles.fecha_alta, "%Y") as anio_alta
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
		demandas.cliente_id, demandas.agente_asignado_id, demandas.referencia as referencia_demanda,
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
	JOIN demandas on inmuebles_demandas.demanda_id=demandas.id;
	
	



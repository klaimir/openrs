-- Campos para configuración
ALTER TABLE `config_admin` ADD `api_key` VARCHAR(60) NULL DEFAULT NULL , ADD `google_analytics_key` VARCHAR(30) NULL DEFAULT NULL ;

ALTER TABLE `inmuebles` CHANGE `precio_compra` `precio_compra` DOUBLE NULL DEFAULT NULL;
ALTER TABLE `inmuebles` CHANGE `precio_alquiler` `precio_alquiler` DOUBLE NULL DEFAULT NULL;

ALTER TABLE `inmuebles` CHANGE `metros_utiles` `metros_utiles` INT(4) NOT NULL;


-- Para modificar el campo antes hay que borrar el índice
ALTER TABLE `inmuebles` DROP FOREIGN KEY `FK_inmuebles_tipo_id`;
ALTER TABLE `inmuebles` CHANGE `tipo_id` `tipo_id` INT(11) UNSIGNED NOT NULL;
ALTER TABLE `inmuebles` ADD CONSTRAINT `FK_inmuebles_tipo_id` FOREIGN KEY (`tipo_id`) REFERENCES `tipos_inmueble` (`id`) ON UPDATE CASCADE;

ALTER TABLE `inmuebles` CHANGE `direccion` `direccion` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `inmuebles` CHANGE `direccion_aprox` `direccion_aprox` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;


ALTER TABLE `inmuebles` CHANGE `cuota_comunidad` `cuota_comunidad` DOUBLE NULL DEFAULT NULL;
ALTER TABLE `inmuebles` CHANGE `forma_pago` `forma_pago` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `inmuebles` CHANGE `anejos` `anejos` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `inmuebles` CHANGE `cargas_vivienda` `cargas_vivienda` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `inmuebles` CHANGE `descripcion_vivienda` `descripcion_vivienda` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `inmuebles` CHANGE `descripcion_edificio` `descripcion_edificio` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `inmuebles` CHANGE `antiguedad_edificio` `antiguedad_edificio` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `inmuebles` ADD `fecha_alta` DATE NOT NULL , ADD `fecha_actualizacion` DATETIME NULL DEFAULT NULL ;























ALTER TABLE `inmuebles` ADD `anio_construccion` int(4) NULL DEFAULT NULL ;
ALTER TABLE `inmuebles` CHANGE `estado` `estado_id` INT(11) UNSIGNED NOT NULL DEFAULT '1';
ALTER TABLE `inmuebles` ADD `referencia` VARCHAR(40) NOT NULL AFTER `id`;
ALTER TABLE `inmuebles` CHANGE `bloqueado` `publicado` INT(1) NOT NULL DEFAULT '0';
ALTER TABLE `inmuebles` CHANGE `antiguedad` `obra_nueva` INT(1) NOT NULL DEFAULT '1';
ALTER TABLE `inmuebles` CHANGE `precio_compra` `precio_compra` INT(10) UNSIGNED NOT NULL;
ALTER TABLE `inmuebles` CHANGE `precio_alquiler` `precio_alquiler` INT(7) NOT NULL;


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



-- Modificamos campo de idioma para que por defecto asigne el español a un nuevo usuario
ALTER TABLE `users` DROP FOREIGN KEY `FK_users_id_idioma`;
ALTER TABLE `users` CHANGE `id_idioma` `id_idioma` INT(11) UNSIGNED NOT NULL DEFAULT 64;
ALTER TABLE `users` ADD CONSTRAINT `FK_users_id_idioma` FOREIGN KEY (`id_idioma`) REFERENCES `users` (`id`) ON UPDATE CASCADE;





ALTER TABLE `config_admin` CHANGE `email_contacto` `email_contacto` VARCHAR(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `config_admin` CHANGE `api_key` `google_api_key` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `config_admin` CHANGE `google_analytics_key` `google_analytics_ID` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;



--
-- Estructura de tabla para la tabla `inmuebles_imagenes`
--

CREATE TABLE IF NOT EXISTS `inmuebles_imagenes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `inmueble_id` int(11) unsigned NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `portada` tinyint(1) NOT NULL default 0,
  `publicada` tinyint(1) NOT NULL default 1,
  PRIMARY KEY (`id`),
  KEY `FK_inmuebles_imagenes_inmueble_id` (`inmueble_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Filtros para la tabla `inmuebles_imagenes`
--
ALTER TABLE `inmuebles_imagenes`
  ADD CONSTRAINT `FK_inmuebles_imagenes_inmueble_id` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
  

  
-- Certificación energética
ALTER TABLE `tipos_certificacion_energetica` CHANGE `nombre` `nombre` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
INSERT INTO `openrs`.`tipos_certificacion_energetica` (`id`, `nombre`) VALUES ('8', 'Exento');
INSERT INTO `openrs`.`tipos_certificacion_energetica` (`id`, `nombre`) VALUES ('9', 'En trámite');

-- Para modificar el campo antes hay que borrar el índice
ALTER TABLE `inmuebles` DROP FOREIGN KEY `FK_inmuebles_certificacion_energetica_id`;
ALTER TABLE `inmuebles` CHANGE `certificacion_energetica_id` `certificacion_energetica_id` INT(11) UNSIGNED NOT NULL DEFAULT '9';
ALTER TABLE `inmuebles` ADD CONSTRAINT `FK_inmuebles_certificacion_energetica_id` FOREIGN KEY (`certificacion_energetica_id`) REFERENCES `tipos_certificacion_energetica` (`id`) ON UPDATE CASCADE;




--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ambito` int(1) NOT NULL comment '1 para clientes, 2 para inmuebles y 3 para demandas',
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`, `ambito`, `descripcion`) VALUES
(4, 'Alquilado', 2,'El inmueble está alquilado'),
(2, 'Vendido', 2, 'El inmueble está vendido'),
(3, 'En construcción', 2, 'Aún se está construyendo'),
(1, 'Captación', 2, 'Buscando demandantes'),
(5, 'Activo', 1,'Se estan realizando acciones para encontrar oferta o demanda'),
(6, 'Histórico', 1, 'El cliente ya no está activo');

CREATE INDEX FK_inmuebles_estado_id ON inmuebles (estado_id);
ALTER TABLE `inmuebles` ADD CONSTRAINT `FK_inmuebles_estado_id` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON UPDATE CASCADE;


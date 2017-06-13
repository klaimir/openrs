-- Cambios para el estado y otros campos de los clientes

ALTER TABLE `clientes` CHANGE `direccion` `direccion` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `clientes` CHANGE `telefonos` `telefonos` VARCHAR(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `clientes` CHANGE `nif` `nif` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `clientes` CHANGE `observaciones` `observaciones` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `clientes` CHANGE `estado` `estado_id` INT(11) UNSIGNED NOT NULL DEFAULT '1';

CREATE INDEX FK_clientes_estado_id ON inmuebles (estado_id);
ALTER TABLE `clientes` ADD CONSTRAINT `FK_clientes_estado_id` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON UPDATE CASCADE;

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
		
		
		
-- Tabla de enlaces
		
ALTER TABLE `inmuebles_enlaces` CHANGE `texto_enlace` `titulo` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `inmuebles_enlaces` ADD `publicado` TINYINT(1) NOT NULL DEFAULT '1' ;
ALTER TABLE `inmuebles_enlaces` ADD `youtube` TINYINT(1) NOT NULL DEFAULT '0' ;		



/* -- Dependientes del idioma

Título

URL SEO -> autocalculada

Descripción SEO -> descripción corta

Descripcion vivienda (HTML)

keywords

-- No dependientes del idioma

Publicado

Oportunidad

Destacado

*/

--
-- Estructura de tabla para la tabla `inmuebles_idiomas`
--

CREATE TABLE IF NOT EXISTS `inmuebles_idiomas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(70) NOT NULL,
  `descripcion` text NOT NULL,
  `url_seo` varchar(70) NOT NULL,
  `descripcion_seo` varchar(150) NOT NULL,
  `keywords_seo` varchar(255) NOT NULL,
  `inmueble_id` int(11) unsigned NOT NULL,
  `idioma_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_inmuebles_idiomas_titulo` (`titulo`),
  UNIQUE KEY `unique_inmuebles_idiomas_url_seo` (`url_seo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


CREATE INDEX FK_inmuebles_idiomas_inmueble_id ON inmuebles_idiomas (inmueble_id);
ALTER TABLE `inmuebles_idiomas` ADD CONSTRAINT `FK_inmuebles_idiomas_inmueble_id` FOREIGN KEY (`inmueble_id`) REFERENCES `inmuebles` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

CREATE INDEX FK_inmuebles_idiomas_idioma_id ON inmuebles_idiomas (idioma_id);
ALTER TABLE `inmuebles_idiomas` ADD CONSTRAINT `FK_inmuebles_idiomas_idioma_id` FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`id_idioma`) ON UPDATE CASCADE ON DELETE CASCADE;


ALTER TABLE `inmuebles` CHANGE `publicado` `publicado` TINYINT(1) NOT NULL DEFAULT '0';
ALTER TABLE `inmuebles` ADD `oportunidad` TINYINT(1) NOT NULL DEFAULT '0';
ALTER TABLE `inmuebles` ADD `destacado` TINYINT(1) NOT NULL DEFAULT '0';

ALTER TABLE `inmuebles` CHANGE `direccion_publica` `direccion_publica` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `inmuebles` CHANGE `direccion` `direccion` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `seccion_idiomas` CHANGE `titulo` `titulo` VARCHAR(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

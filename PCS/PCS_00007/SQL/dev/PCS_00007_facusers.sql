ALTER TABLE `provincias` ADD `activa` INT(1) NOT NULL DEFAULT '0';
ALTER TABLE `poblaciones` ADD `activa` INT(1) NOT NULL DEFAULT '0' , ADD `defecto` INT(1) NOT NULL DEFAULT '0' ;

UPDATE `openrs`.`provincias` SET `provincia` = 'Alava' WHERE `provincias`.`id` = 1;
UPDATE `openrs`.`provincias` SET `provincia` = 'Avila' WHERE `provincias`.`id` = 5;

ALTER TABLE `poblaciones` CHANGE `codigo` `codigo` VARCHAR(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `config` DROP `user_id`;

/*
--
-- Estructura de tabla para la tabla `config_admin`
--

CREATE TABLE IF NOT EXISTS `config_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefonos` varchar(255) NOT NULL,
  `horario` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_contacto` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `nombre`, `direccion`, `telefonos`, `horario`, `email`, `email_contacto`) VALUES
(1, 'OPEN RS', 'C\Pinito del Oro, nº 4, 6ª C, Almería (Almería)', '950010203 - 659163979', 'Lunes a Viernes de 10-14 y 18-21', 'klaimir@hotmail.com', 'angel.berasuain@gmail.com');

*/

--
-- Estructura de tabla para la tabla `config_admin`
--

CREATE TABLE IF NOT EXISTS `config_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_contacto` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `config_admin` (`id`, `email_contacto`) VALUES
(1, 'angel.berasuain@gmail.com');


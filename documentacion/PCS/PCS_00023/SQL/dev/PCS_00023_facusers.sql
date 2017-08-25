ALTER TABLE `provincias` DROP `activa`;

ALTER TABLE `poblaciones` DROP `activa`, DROP `defecto`;

ALTER TABLE `demandas` ADD INDEX `demandas_fecha_alta` (`fecha_alta`);
ALTER TABLE `demandas` ADD INDEX `demandas_fecha_actualizacion` (`fecha_actualizacion`);

ALTER TABLE `clientes` ADD INDEX `clientes_fecha_alta` (`fecha_alta`);
ALTER TABLE `clientes` ADD INDEX `clientes_fecha_actualizacion` (`fecha_actualizacion`);

ALTER TABLE `inmuebles` ADD INDEX `inmuebles_fecha_alta` (`fecha_alta`);
ALTER TABLE `inmuebles` ADD INDEX `inmuebles_fecha_actualizacion` (`fecha_actualizacion`);


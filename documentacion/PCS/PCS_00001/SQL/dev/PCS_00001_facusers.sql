
alter table inmuebles drop foreign key FK_inmuebles_tipo;

ALTER TABLE `tipos_inmueble` CHANGE `id_tipo` `id_tipo` INT(2) NOT NULL AUTO_INCREMENT;

ALTER TABLE `inmuebles`
  ADD CONSTRAINT `FK_inmuebles_tipo` FOREIGN KEY (`tipo`) REFERENCES `tipos_inmueble` (`id_tipo`) ON UPDATE CASCADE;

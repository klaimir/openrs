ALTER TABLE `users` ADD `id_idioma` INT(11) NOT NULL ;

ALTER TABLE `users` ADD FOREIGN KEY `FK_users_id_idioma` (`id_idioma`) REFERENCES `idiomas` (`id_idioma`);
  
  
  
  
  
ALTER TABLE `demandas` ADD `cliente_id` int(11) unsigned NOT NULL ;

ALTER TABLE `demandas` ADD FOREIGN KEY `FK_demandas_cliente_id` (`cliente_id`) REFERENCES `clientes` (`id`);


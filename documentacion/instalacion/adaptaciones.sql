-- IMPORTANTE: este fichero de adaptación se publica con la preinstalación inicial del software.
-- Si usted está realizando una migración de dominio, en lugar de openrs.es, deberá de indicar el dominio origen desde donde está migrando. (por ejemplo, dominioanterior.es)

UPDATE `footer_texto_idiomas` SET `contenido` =  REPLACE(contenido, 'openrs.es', 'dominioactual.es');
UPDATE `texto_idiomas` SET `contenido` =  REPLACE(contenido, 'openrs.es', 'dominioactual.es');
UPDATE `articulos_idiomas` SET `contenido` =  REPLACE(contenido, 'openrs.es', 'dominioactual.es');
UPDATE `inmuebles_idiomas` SET `contenido` =  REPLACE(contenido, 'openrs.es', 'dominioactual.es');

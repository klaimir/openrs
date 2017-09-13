-- IMPORTANTE: este fichero de adaptación se publica con la preinstalación inicial del software.
-- Si usted está realizando una migración de dominio, en lugar de openrs.es/demo, deberá de indicar el dominio y carpeta origen desde donde está migrando. (por ejemplo, dominioanterior.es)
-- Este ejemplo presupone una instalación en local en una carpeta denominada openrs

UPDATE `footer_texto_idiomas` SET `contenido` =  REPLACE(contenido, 'www.openrs.es/demo', '127.0.0.1/openrs');
UPDATE `texto_idiomas` SET `contenido` =  REPLACE(contenido, 'www.openrs.es/demo', '127.0.0.1/openrs');
UPDATE `articulos_idiomas` SET `contenido` =  REPLACE(contenido, 'www.openrs.es/demo', '127.0.0.1/openrs');
UPDATE `inmuebles_idiomas` SET `descripcion` =  REPLACE(descripcion, 'www.openrs.es/demo', '127.0.0.1/openrs');

UPDATE `footer_texto_idiomas` SET `contenido` =  REPLACE(contenido, 'openrs.es/demo', '127.0.0.1/openrs');
UPDATE `texto_idiomas` SET `contenido` =  REPLACE(contenido, 'openrs.es/demo', '127.0.0.1/openrs');
UPDATE `articulos_idiomas` SET `contenido` =  REPLACE(contenido, 'openrs.es/demo', '127.0.0.1/openrs');
UPDATE `inmuebles_idiomas` SET `descripcion` =  REPLACE(descripcion, 'openrs.es/demo', '127.0.0.1/openrs');

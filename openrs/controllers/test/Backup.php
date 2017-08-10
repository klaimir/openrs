<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Controller.php';

class Backup extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        
        // Secure the access
        $this->_security();

        $this->load->library('unit_test');
        
        $str = '
        <table border="0" cellpadding="4" cellspacing="1">
        {rows}
        <tr>
        <td>{item}</td>
        <td>{result}</td>
        </tr>
        {/rows}
        </table>';

        $this->unit->set_template($str);
        
        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_admin"));
    }
    
    /**
     *
     * db_backup
     *
     * this backs up database
     *
     * @access private
     */
    private function do_db_backup($prefs)
    {
        // Opciones para que se ignoren las restricciones y se meta todo en una transacción
        $backup='SET FOREIGN_KEY_CHECKS=0;
                SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                SET AUTOCOMMIT = 0;
                START TRANSACTION;


                /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                /*!40101 SET NAMES utf8 */;';
        echo $backup."FIN 1 <br>";
        // Copia SQL
        $backup.=$this->dbutil->backup($prefs);
        echo $backup."FIN 2 <br>";
        // Vistas
        $backup.="
        --
        -- Estructura para la vista `v_clientes`
        --
        DROP TABLE IF EXISTS `v_clientes`;

        CREATE OR REPLACE VIEW `v_clientes` AS select `clientes`.`id` AS `id`,`clientes`.`nombre` AS `nombre`,`clientes`.`apellidos` AS `apellidos`,`clientes`.`fecha_nac` AS `fecha_nac`,`clientes`.`direccion` AS `direccion`,`clientes`.`pais_id` AS `pais_id`,`clientes`.`poblacion_id` AS `poblacion_id`,`clientes`.`telefonos` AS `telefonos`,`clientes`.`nif` AS `nif`,`clientes`.`observaciones` AS `observaciones`,`clientes`.`fecha_alta` AS `fecha_alta`,`clientes`.`fecha_actualizacion` AS `fecha_actualizacion`,`clientes`.`correo` AS `correo`,`clientes`.`estado_id` AS `estado_id`,`clientes`.`agente_asignado_id` AS `agente_asignado_id`,`poblaciones`.`poblacion` AS `nombre_poblacion`,`poblaciones`.`provincia_id` AS `provincia_id`,`provincias`.`provincia` AS `nombre_provincia`,`paises`.`nombre` AS `nombre_pais`,`estados`.`nombre` AS `nombre_estado`,concat_ws(',',`users`.`last_name`,`users`.`first_name`) AS `nombre_agente_asignado` from (((((`clientes` join `estados` on((`clientes`.`estado_id` = `estados`.`id`))) left join `poblaciones` on((`clientes`.`poblacion_id` = `poblaciones`.`id`))) left join `provincias` on((`poblaciones`.`provincia_id` = `provincias`.`id`))) join `paises` on((`clientes`.`pais_id` = `paises`.`id`))) left join `users` on((`clientes`.`agente_asignado_id` = `users`.`id`)));

        -- --------------------------------------------------------

        --
        -- Estructura para la vista `v_clientes_ficheros`
        --
        DROP TABLE IF EXISTS `v_clientes_ficheros`;

        CREATE OR REPLACE VIEW `v_clientes_ficheros` AS select `clientes_ficheros`.`id` AS `id`,`clientes_ficheros`.`cliente_id` AS `cliente_id`,`clientes_ficheros`.`texto_fichero` AS `texto_fichero`,`clientes_ficheros`.`fichero` AS `fichero`,`clientes_ficheros`.`tipo_fichero_id` AS `tipo_fichero_id`,`tipos_ficheros`.`nombre` AS `nombre_tipo` from (`clientes_ficheros` join `tipos_ficheros` on((`clientes_ficheros`.`tipo_fichero_id` = `tipos_ficheros`.`id`)));

        -- --------------------------------------------------------

        --
        -- Estructura para la vista `v_clientes_inmuebles`
        --
        DROP TABLE IF EXISTS `v_clientes_inmuebles`;

        CREATE OR REPLACE VIEW `v_clientes_inmuebles` AS select `clientes_inmuebles`.`id` AS `id`,`clientes_inmuebles`.`cliente_id` AS `cliente_id`,`clientes_inmuebles`.`inmueble_id` AS `inmueble_id`,`inmuebles`.`precio_compra` AS `precio_compra`,`inmuebles`.`precio_alquiler` AS `precio_alquiler`,`estados`.`historico` AS `historico` from ((`clientes_inmuebles` join `inmuebles` on((`clientes_inmuebles`.`inmueble_id` = `inmuebles`.`id`))) join `estados` on((`inmuebles`.`estado_id` = `estados`.`id`)));

        -- --------------------------------------------------------

        --
        -- Estructura para la vista `v_demandas`
        --
        DROP TABLE IF EXISTS `v_demandas`;

        CREATE OR REPLACE VIEW `v_demandas` AS select `demandas`.`id` AS `id`,`demandas`.`referencia` AS `referencia`,`demandas`.`metros_desde` AS `metros_desde`,`demandas`.`metros_hasta` AS `metros_hasta`,`demandas`.`habitaciones_desde` AS `habitaciones_desde`,`demandas`.`habitaciones_hasta` AS `habitaciones_hasta`,`demandas`.`banios_desde` AS `banios_desde`,`demandas`.`banios_hasta` AS `banios_hasta`,`demandas`.`precio_desde` AS `precio_desde`,`demandas`.`precio_hasta` AS `precio_hasta`,`demandas`.`provincia_id` AS `provincia_id`,`demandas`.`poblacion_id` AS `poblacion_id`,`demandas`.`observaciones` AS `observaciones`,`demandas`.`estado_id` AS `estado_id`,`demandas`.`certificacion_energetica_id` AS `certificacion_energetica_id`,`demandas`.`anio_construccion_desde` AS `anio_construccion_desde`,`demandas`.`anio_construccion_hasta` AS `anio_construccion_hasta`,`demandas`.`agente_asignado_id` AS `agente_asignado_id`,`demandas`.`oferta_id` AS `oferta_id`,`demandas`.`tipo_demanda_id` AS `tipo_demanda_id`,`demandas`.`cliente_id` AS `cliente_id`,`demandas`.`fecha_alta` AS `fecha_alta`,`demandas`.`fecha_actualizacion` AS `fecha_actualizacion`,`poblaciones`.`poblacion` AS `nombre_poblacion`,`provincias`.`provincia` AS `nombre_provincia`,`tipos_certificacion_energetica`.`nombre` AS `nombre_certificacion_energetica`,`estados`.`nombre` AS `nombre_estado`,`estados`.`historico` AS `historico`,concat_ws(', ',`users`.`last_name`,`users`.`first_name`) AS `nombre_agente_asignado`,concat_ws(', ',`clientes`.`apellidos`,`clientes`.`nombre`) AS `nombre_cliente` from ((((((`demandas` join `estados` on((`demandas`.`estado_id` = `estados`.`id`))) left join `poblaciones` on((`demandas`.`poblacion_id` = `poblaciones`.`id`))) left join `provincias` on((`demandas`.`provincia_id` = `provincias`.`id`))) join `clientes` on((`demandas`.`cliente_id` = `clientes`.`id`))) left join `tipos_certificacion_energetica` on((`demandas`.`certificacion_energetica_id` = `tipos_certificacion_energetica`.`id`))) left join `users` on((`demandas`.`agente_asignado_id` = `users`.`id`)));

        -- --------------------------------------------------------

        --
        -- Estructura para la vista `v_demandas_ficheros`
        --
        DROP TABLE IF EXISTS `v_demandas_ficheros`;

        CREATE OR REPLACE VIEW `v_demandas_ficheros` AS select `demandas_ficheros`.`id` AS `id`,`demandas_ficheros`.`demanda_id` AS `demanda_id`,`demandas_ficheros`.`texto_fichero` AS `texto_fichero`,`demandas_ficheros`.`fichero` AS `fichero`,`demandas_ficheros`.`tipo_fichero_id` AS `tipo_fichero_id`,`tipos_ficheros`.`nombre` AS `nombre_tipo` from (`demandas_ficheros` join `tipos_ficheros` on((`demandas_ficheros`.`tipo_fichero_id` = `tipos_ficheros`.`id`)));

        -- --------------------------------------------------------

        --
        -- Estructura para la vista `v_estados`
        --
        DROP TABLE IF EXISTS `v_estados`;

        CREATE OR REPLACE VIEW `v_estados` AS select `estados`.`id` AS `id`,`estados`.`ambito_id` AS `ambito_id`,`estados`.`nombre` AS `nombre`,`estados`.`descripcion` AS `descripcion`,`estados`.`historico` AS `historico`,(case `estados`.`ambito_id` when 1 then 'Clientes' when 2 then 'Inmuebles' when 3 then 'Demandas' end) AS `nombre_ambito` from `estados`;

        -- --------------------------------------------------------

        --
        -- Estructura para la vista `v_inmuebles`
        --
        DROP TABLE IF EXISTS `v_inmuebles`;

        CREATE OR REPLACE VIEW `v_inmuebles` AS select `inmuebles`.`id` AS `id`,`inmuebles`.`referencia` AS `referencia`,`inmuebles`.`metros` AS `metros`,`inmuebles`.`metros_utiles` AS `metros_utiles`,`inmuebles`.`habitaciones` AS `habitaciones`,`inmuebles`.`banios` AS `banios`,`inmuebles`.`precio_compra` AS `precio_compra`,`inmuebles`.`precio_compra_anterior` AS `precio_compra_anterior`,`inmuebles`.`precio_alquiler` AS `precio_alquiler`,`inmuebles`.`precio_alquiler_anterior` AS `precio_alquiler_anterior`,`inmuebles`.`poblacion_id` AS `poblacion_id`,`inmuebles`.`zona_id` AS `zona_id`,`inmuebles`.`tipo_id` AS `tipo_id`,`inmuebles`.`observaciones` AS `observaciones`,`inmuebles`.`direccion` AS `direccion`,`inmuebles`.`direccion_publica` AS `direccion_publica`,`inmuebles`.`publicado` AS `publicado`,`inmuebles`.`estado_id` AS `estado_id`,`inmuebles`.`certificacion_energetica_id` AS `certificacion_energetica_id`,`inmuebles`.`descripcion_edificio` AS `descripcion_edificio`,`inmuebles`.`captador_id` AS `captador_id`,`inmuebles`.`fecha_alta` AS `fecha_alta`,`inmuebles`.`fecha_actualizacion` AS `fecha_actualizacion`,`inmuebles`.`anio_construccion` AS `anio_construccion`,`inmuebles`.`oportunidad` AS `oportunidad`,`inmuebles`.`destacado` AS `destacado`,`poblaciones`.`poblacion` AS `nombre_poblacion`,`poblaciones`.`provincia_id` AS `provincia_id`,`provincias`.`provincia` AS `nombre_provincia`,`poblaciones_zonas`.`nombre` AS `nombre_zona`,`tipos_inmueble_idiomas`.`nombre` AS `nombre_tipo`,`tipos_inmueble_idiomas`.`idioma_id` AS `idioma_id`,`tipos_certificacion_energetica`.`nombre` AS `nombre_certificacion_energetica`,`estados`.`nombre` AS `nombre_estado`,concat_ws(', ',`users`.`last_name`,`users`.`first_name`) AS `nombre_captador`,`inmuebles_carteles`.`id` AS `cartel_id`,`inmuebles_carteles`.`impreso` AS `cartel_impreso` from (((((((((`inmuebles` join `estados` on((`inmuebles`.`estado_id` = `estados`.`id`))) join `poblaciones` on((`inmuebles`.`poblacion_id` = `poblaciones`.`id`))) join `provincias` on((`poblaciones`.`provincia_id` = `provincias`.`id`))) left join `poblaciones_zonas` on((`inmuebles`.`zona_id` = `poblaciones_zonas`.`id`))) join `tipos_inmueble` on((`inmuebles`.`tipo_id` = `tipos_inmueble`.`id`))) join `tipos_inmueble_idiomas` on((`tipos_inmueble_idiomas`.`tipo_inmueble_id` = `tipos_inmueble`.`id`))) left join `tipos_certificacion_energetica` on((`inmuebles`.`certificacion_energetica_id` = `tipos_certificacion_energetica`.`id`))) left join `users` on((`inmuebles`.`captador_id` = `users`.`id`))) left join `inmuebles_carteles` on((`inmuebles_carteles`.`inmueble_id` = `inmuebles`.`id`)));

        -- --------------------------------------------------------

        --
        -- Estructura para la vista `v_inmuebles_demandas`
        --
        DROP TABLE IF EXISTS `v_inmuebles_demandas`;

        CREATE OR REPLACE VIEW `v_inmuebles_demandas` AS select `v_inmuebles`.`id` AS `id`,`v_inmuebles`.`referencia` AS `referencia`,`v_inmuebles`.`metros` AS `metros`,`v_inmuebles`.`metros_utiles` AS `metros_utiles`,`v_inmuebles`.`habitaciones` AS `habitaciones`,`v_inmuebles`.`banios` AS `banios`,`v_inmuebles`.`precio_compra` AS `precio_compra`,`v_inmuebles`.`precio_compra_anterior` AS `precio_compra_anterior`,`v_inmuebles`.`precio_alquiler` AS `precio_alquiler`,`v_inmuebles`.`precio_alquiler_anterior` AS `precio_alquiler_anterior`,`v_inmuebles`.`poblacion_id` AS `poblacion_id`,`v_inmuebles`.`zona_id` AS `zona_id`,`v_inmuebles`.`tipo_id` AS `tipo_id`,`v_inmuebles`.`observaciones` AS `observaciones`,`v_inmuebles`.`direccion` AS `direccion`,`v_inmuebles`.`direccion_publica` AS `direccion_publica`,`v_inmuebles`.`publicado` AS `publicado`,`v_inmuebles`.`estado_id` AS `estado_id`,`v_inmuebles`.`certificacion_energetica_id` AS `certificacion_energetica_id`,`v_inmuebles`.`descripcion_edificio` AS `descripcion_edificio`,`v_inmuebles`.`captador_id` AS `captador_id`,`v_inmuebles`.`fecha_alta` AS `fecha_alta`,`v_inmuebles`.`fecha_actualizacion` AS `fecha_actualizacion`,`v_inmuebles`.`anio_construccion` AS `anio_construccion`,`v_inmuebles`.`oportunidad` AS `oportunidad`,`v_inmuebles`.`destacado` AS `destacado`,`v_inmuebles`.`nombre_poblacion` AS `nombre_poblacion`,`v_inmuebles`.`provincia_id` AS `provincia_id`,`v_inmuebles`.`nombre_provincia` AS `nombre_provincia`,`v_inmuebles`.`nombre_zona` AS `nombre_zona`,`v_inmuebles`.`nombre_tipo` AS `nombre_tipo`,`v_inmuebles`.`idioma_id` AS `idioma_id`,`v_inmuebles`.`nombre_certificacion_energetica` AS `nombre_certificacion_energetica`,`v_inmuebles`.`nombre_estado` AS `nombre_estado`,`v_inmuebles`.`nombre_captador` AS `nombre_captador`,`v_inmuebles`.`cartel_id` AS `cartel_id`,`v_inmuebles`.`cartel_impreso` AS `cartel_impreso`,`demandas`.`cliente_id` AS `cliente_id`,`demandas`.`agente_asignado_id` AS `agente_asignado_id`,`inmuebles_demandas`.`demanda_id` AS `demanda_id`,`inmuebles_demandas`.`origen_id` AS `origen_id`,`inmuebles_demandas`.`evaluacion_id` AS `evaluacion_id`,`inmuebles_demandas`.`observaciones` AS `observaciones_demanda`,`inmuebles_demandas`.`fecha_asignacion` AS `fecha_asignacion`,date_format(`inmuebles_demandas`.`fecha_asignacion`,'%d/%m/%Y') AS `fecha_asignacion_formateada`,`inmuebles_demandas`.`id` AS `inmueble_demanda_id`,(case `inmuebles_demandas`.`origen_id` when 1 then 'OPENRS' when 2 then 'Agente' end) AS `nombre_origen`,(case `inmuebles_demandas`.`evaluacion_id` when 1 then 'Pendiente evaluar' when 2 then 'Propuesto para visita' when 3 then 'Descartado por agente' when 4 then 'Interesa cliente' when 5 then 'No Interesa cliente' end) AS `nombre_evaluacion`,`fichas_visita_inmuebles_demandas`.`ficha_visita_id` AS `ficha_visita_id`,`fichas_visita`.`visitado` AS `visitado`,date_format(`fichas_visita`.`fecha`,'%d/%m/%Y') AS `fecha_visita_formateada`,`fichas_visita`.`fecha` AS `fecha_visita`,date_format(`fichas_visita_inmuebles_demandas`.`fecha_hora`,'%H:%i') AS `hora_visita_formateada`,date_format(`fichas_visita_inmuebles_demandas`.`fecha_hora`,'%d/%m/%Y %H:%i') AS `fecha_hora_visita_formateada`,`fichas_visita_inmuebles_demandas`.`fecha_hora` AS `fecha_hora_visita` from ((((`v_inmuebles` join `inmuebles_demandas` on((`inmuebles_demandas`.`inmueble_id` = `v_inmuebles`.`id`))) join `demandas` on((`inmuebles_demandas`.`demanda_id` = `demandas`.`id`))) left join `fichas_visita_inmuebles_demandas` on((`fichas_visita_inmuebles_demandas`.`inmueble_demanda_id` = `inmuebles_demandas`.`id`))) left join `fichas_visita` on((`fichas_visita_inmuebles_demandas`.`ficha_visita_id` = `fichas_visita`.`id`)));

        -- --------------------------------------------------------

        --
        -- Estructura para la vista `v_inmuebles_ficheros`
        --
        DROP TABLE IF EXISTS `v_inmuebles_ficheros`;

        CREATE OR REPLACE VIEW `v_inmuebles_ficheros` AS select `inmuebles_ficheros`.`id` AS `id`,`inmuebles_ficheros`.`inmueble_id` AS `inmueble_id`,`inmuebles_ficheros`.`fichero` AS `fichero`,`inmuebles_ficheros`.`texto_fichero` AS `texto_fichero`,`inmuebles_ficheros`.`tipo_fichero_id` AS `tipo_fichero_id`,`tipos_ficheros`.`nombre` AS `nombre_tipo` from (`inmuebles_ficheros` join `tipos_ficheros` on((`inmuebles_ficheros`.`tipo_fichero_id` = `tipos_ficheros`.`id`)));

        -- --------------------------------------------------------

        --
        -- Estructura para la vista `v_tipos_ficheros`
        --
        DROP TABLE IF EXISTS `v_tipos_ficheros`;

        CREATE OR REPLACE VIEW `v_tipos_ficheros` AS select `tipos_ficheros`.`id` AS `id`,`tipos_ficheros`.`nombre` AS `nombre`,`tipos_ficheros`.`descripcion` AS `descripcion`,`tipos_ficheros`.`ambito_id` AS `ambito_id`,(case `tipos_ficheros`.`ambito_id` when 1 then 'Clientes' when 2 then 'Inmuebles' when 3 then 'Demandas' end) AS `nombre_ambito` from `tipos_ficheros`;
        
        -- Vista v_backups
        CREATE 
            OR REPLACE
        VIEW `v_backups` AS
            SELECT 
                backup.*,
                        CASE backup.backup_type
                          WHEN 1 THEN 'Base de datos'
                          WHEN 2 THEN 'Ficheros'
                          WHEN 3 THEN 'Completa'
                        END as 'tipo_backup',
                        DATE_FORMAT(backup.created_date, '%d/%m/%Y %H:%i') as fecha_hora,
                        CONCAT_WS(', ',users.last_name,users.first_name) AS nombre_admin
            FROM
                backup
                        JOIN users ON backup.admin_id = users.id;
        ";
        echo $backup." FIN 3<br>";
        // Commit
        $backup.='COMMIT;

                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;';
        echo $backup." FIN 4<br>";
        die();
        return $backup;
    }
    
    function write_file2()
    {        
        $this->load->dbutil();
        $this->load->library('zip');
        
        $file='backups/databases/test.zip';
        // Opciones para que se ignoren las restricciones y se meta todo en una transacción
        $backup1='SET FOREIGN_KEY_CHECKS=0;
                SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                SET AUTOCOMMIT = 0;
                START TRANSACTION;

                /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                /*!40101 SET NAMES utf8 */;
                
                ';
        
        $prefs = array(
                'format' => 'txt', // gzip, zip, txt
                'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
                'add_insert' => TRUE, // Whether to add INSERT data to backup file
                'newline' => "\n" // Newline character used in backup file
            );
        // Copia SQL
        $backup2=$this->dbutil->backup($prefs);
        
        // Commit
        $backup4='
            
                COMMIT;

                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;';
        
        
$this->zip->add_data('test.sql', $backup1.$backup2.$backup4);

// Write the zip file to a folder on your server. Name it "my_backup.zip"
$this->zip->archive($file);
        
        echo "OK";
    }
}

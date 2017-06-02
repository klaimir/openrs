<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Controller.php';

class Csv extends MY_Controller
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
        //$this->utilities->check_security_access_perfiles_or(array("session_es_admin"));
    }

    function read()
    {
        // Fichero a leer
        $filename = FCPATH . 'downloads/test/test_csv.csv';
        // Comprobación
        if (file_exists($filename))
        {
            $this->load->library('CSVReader');
            $csv = $this->csvreader->parse_file($filename, FALSE);
            var_dump($csv);
        }
        else
        {
            show_error("Fichero no existe");
        }
    }

    function export()
    {
        // Deshabilitar profiler para que no salga anidado al CSV
        $this->output->enable_profiler(FALSE);
        
        $this->load->model('Cliente_model');  
        // Aplicamos los filtros establecidos en el buscador
        $elements = $this->Cliente_model->get_by_filtros();
        // Creamos array con datos formateados
        if ($elements)
        {
            $this->load->helper('csv');
            
            foreach ($elements as $element)
            {
                $datos_formateado = array();

                $datos_formateado[] = $element->nif;
                $datos_formateado[] = $element->nombre;
                $datos_formateado[] = $element->apellidos;
                $datos_formateado[] = $this->utilities->cambiafecha_bd($element->fecha_nac);
                $datos_formateado[] = $element->direccion;
                $datos_formateado[] = $element->correo;
                $datos_formateado[] = $element->telefonos;
                $datos_formateado[] = $element->nombre_pais;
                $datos_formateado[] = $element->nombre_provincia;
                $datos_formateado[] = $element->nombre_poblacion;
                $datos_formateado[] = $element->observaciones;
                $datos_formateado[] = $element->nombre_agente_asignado;
                
                // Conversión de todos los elementos del array
                $array[] = $this->utilities->encoding_array($datos_formateado);
            }
            
            //var_dump($array);
            
            array_to_csv_binary($array, "listado_clientes.csv");
        }
    }

}

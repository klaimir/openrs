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

    function import()
    {
        // Fichero a leer
        $filename = FCPATH . 'downloads/test/test_csv.csv';
        // Comprobación
        if (file_exists($filename)) {
            $this->load->library('CSVReader');
            $csv=$this->csvreader->parse_file($filename, FALSE);
            var_dump($csv);
        }
        else
        {
            show_error("Fichero no existe");
        }
    }
    
}

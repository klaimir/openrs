<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Controller.php';

class Estadisticas extends MY_Controller
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
    
    function get_stats_by_tipo()
    { 
        $this->load->model('Inmueble_model');
        var_dump($this->Inmueble_model->get_stats_by_tipo());
    }
    
    function get_stats_by_estado()
    { 
        $this->load->model('Inmueble_model');
        var_dump($this->Inmueble_model->get_stats_by_estado());
    }
    
    function get_stats_by_oferta($personal=1,$historico=0)
    { 
        $this->load->model('Inmueble_model');
        var_dump($this->Inmueble_model->get_stats_by_oferta($personal,$historico));
    }
    
}

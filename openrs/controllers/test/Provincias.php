<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Controller.php';

class Provincias extends MY_Controller
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

    function activar($id,$activar)
    {
        // Realizamos test con todas las combinaciones porque el validation fallaba
        $this->load->model('Provincia_model');
        
        $this->Provincia_model->activar($id,$activar);
        
        $this->load->model('Poblacion_model');
        
        $poblaciones_activas=$this->Poblacion_model->where('provincia_id',$id)->where('activa',$activar)->get_all();
        $poblaciones_provincia=$this->Poblacion_model->where('provincia_id',$id)->get_all();

        // Delete
        $this->unit->run($poblaciones_activas, $poblaciones_provincia, 'Test de Poblaciones');

        // The report will be formatted in an HTML table for viewing. If you prefer the raw data you can retrieve an array using:
        var_dump($this->unit->result());
    }

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Controller.php';

class Tipos_plantilla_documentacion extends MY_Controller
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
        
        $this->load->model('Tipo_plantilla_documentacion_model');
    }
    
    function pivot($id)
    {
        $tipo_plantilla = $this->Tipo_plantilla_documentacion_model->with_categorias()->get($id);
        var_dump($tipo_plantilla);
        
        // Error que no sé pq ocurre, tenemos que comentar many pivot para que funcione, pero claro, tampoco devuelve sus categorías
    }


}

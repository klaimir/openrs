<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Controller.php';

class Documentos extends MY_Controller
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
    
    function cartel($inmueble_id,$plantilla_id,$idioma_id)
    {
        $this->load->model('Inmueble_cartel_model');
        echo $this->Inmueble_cartel_model->generar_html_cartel($inmueble_id,$plantilla_id,$idioma_id,$this->data['session_user_id']);
        //var_dump($this->Inmueble_cartel_model);
    }

    function ficha_cliente($cliente_id,$plantilla_id)
    {
        $this->load->model('Cliente_ficha_model');
        echo $this->Cliente_ficha_model->generar_html_ficha($cliente_id,$plantilla_id);
        var_dump($this->Cliente_ficha_model);
    }
    
    function get_info_demanda($demanda_id)
    {
        $this->load->model('Demanda_model');
        $info=$this->Demanda_model->get_info_documento($demanda_id);
        var_dump($info);
    }
    
    function dropdown_plantillas($tipo_plantilla_id)
    {
        $this->load->model('Plantilla_documentacion_model');
        var_dump($this->Plantilla_documentacion_model->get_dropdown($tipo_plantilla_id));
    }
    
    function dropdown_idiomas()
    {
        var_dump($this->Idioma_model->get_dropdown());
    }
    
    function qr_helper()
    {
        $this->load->helper('qr');
        create_qr('http://openrs.com/rota/casa-playa',FCPATH.'downloads/prueba.png');
        echo '<img src="'.base_url('downloads/prueba.png').'">IMAGEN</img>';
    }
    
}

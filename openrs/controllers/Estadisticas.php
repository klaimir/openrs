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
        
        // Deshabilitar profiler
        $this->output->enable_profiler(FALSE);
        // Comprobación de petición por AJAX
        if(!$this->input->is_ajax_request())
        {
            echo 'Petición no realizada a través de AJAX';
            return;
        }
    }
    
    function estados_inmuebles($personal=1,$historico=0)
    {
        $this->load->model('Inmueble_model');
        $inmuebles = $this->Inmueble_model->get_stats_by_estado($personal,$historico);
        if($inmuebles)
        {
            echo json_encode($inmuebles);
        }
        else
        {
            echo 1;
        }
    }
    
    function ofertas_inmuebles($personal=1,$historico=0)
    {
        $this->load->model('Inmueble_model');
        $inmuebles = $this->Inmueble_model->get_stats_by_oferta($personal,$historico);
        if($inmuebles)
        {
            echo json_encode($inmuebles);
        }
        else
        {
            echo 1;
        }
    }

    function tipos_inmuebles($personal=1,$historico=0)
    {
        $this->load->model('Inmueble_model');
        $inmuebles = $this->Inmueble_model->get_stats_by_tipo($personal,$historico);
        if($inmuebles)
        {
            echo json_encode($inmuebles);
        }
        else
        {
            echo 1;
        }
    }
    
    function altas_inmuebles($personal,$anio)
    {
        $this->load->model('Inmueble_model');
        $inmuebles = $this->Inmueble_model->get_stats_plot_by_alta($anio,$personal);
        if($inmuebles)
        {
            echo json_encode($inmuebles);
        }
        else
        {
            echo 1;
        }
    }
    
    function agentes_inmuebles($historico=0)
    {
        $this->load->model('Inmueble_model');
        $inmuebles = $this->Inmueble_model->get_stats_by_agente($historico);
        if($inmuebles)
        {
            echo json_encode($inmuebles);
        }
        else
        {
            echo 1;
        }
    }
    
    function publicacion_inmuebles($personal=1,$historico=0)
    {
        $this->load->model('Inmueble_model');
        $inmuebles = $this->Inmueble_model->get_stats_by_publicacion($personal,$historico);
        if($inmuebles)
        {
            echo json_encode($inmuebles);
        }
        else
        {
            echo 1;
        }
    }

}

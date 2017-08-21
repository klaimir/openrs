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
    
    /******************** INMUEBLES *****************************/
    
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
    
    function cartel_inmuebles($personal=1,$historico=0)
    {
        $this->load->model('Inmueble_model');
        $inmuebles = $this->Inmueble_model->get_stats_by_cartel($personal,$historico);
        if($inmuebles)
        {
            echo json_encode($inmuebles);
        }
        else
        {
            echo 1;
        }
    }
    
    /******************** CLIENTES *****************************/
        
    function estados_clientes($personal=1,$historico=0)
    {
        $this->load->model('Cliente_model');
        $clientes = $this->Cliente_model->get_stats_by_estado($personal,$historico);
        if($clientes)
        {
            echo json_encode($clientes);
        }
        else
        {
            echo 1;
        }
    }
    
    function intereses_clientes($personal=1,$historico=0,$tipo_interes=0)
    {
        $this->load->model('Cliente_model');
        $clientes = $this->Cliente_model->get_stats_by_interes($personal,$historico,$tipo_interes);
        if($clientes)
        {
            echo json_encode($clientes);
        }
        else
        {
            echo 1;
        }
    }

    function medios_captacion_clientes($personal=1,$historico=0)
    {
        $this->load->model('Cliente_model');
        $clientes = $this->Cliente_model->get_stats_by_medio_captacion($personal,$historico);
        if($clientes)
        {
            echo json_encode($clientes);
        }
        else
        {
            echo 1;
        }
    }
    
    function altas_clientes($personal,$anio)
    {
        $this->load->model('Cliente_model');
        $clientes = $this->Cliente_model->get_stats_plot_by_alta($anio,$personal);
        if($clientes)
        {
            echo json_encode($clientes);
        }
        else
        {
            echo 1;
        }
    }
    
    function agentes_clientes($historico=0)
    {
        $this->load->model('Cliente_model');
        $clientes = $this->Cliente_model->get_stats_by_agente($historico);
        if($clientes)
        {
            echo json_encode($clientes);
        }
        else
        {
            echo 1;
        }
    }
    
    /******************** DEMANDAS *****************************/
        
    function estados_demandas($personal=1,$historico=0)
    {
        $this->load->model('Demanda_model');
        $demandas = $this->Demanda_model->get_stats_by_estado($personal,$historico);
        if($demandas)
        {
            echo json_encode($demandas);
        }
        else
        {
            echo 1;
        }
    }
    
    function tipos_demandas_demandas($personal=1,$historico=0)
    {
        $this->load->model('Demanda_model');
        $demandas = $this->Demanda_model->get_stats_by_tipo_demanda($personal,$historico);
        if($demandas)
        {
            echo json_encode($demandas);
        }
        else
        {
            echo 1;
        }
    }

    function ofertas_demandas($personal=1,$historico=0)
    {
        $this->load->model('Demanda_model');
        $demandas = $this->Demanda_model->get_stats_by_oferta($personal,$historico);
        if($demandas)
        {
            echo json_encode($demandas);
        }
        else
        {
            echo 1;
        }
    }
    
    function tipos_inmuebles_demandas($personal=1,$historico=0)
    {
        $this->load->model('Demanda_model');
        $demandas = $this->Demanda_model->get_stats_by_tipo_inmueble($personal,$historico);
        if($demandas)
        {
            echo json_encode($demandas);
        }
        else
        {
            echo 1;
        }
    }
    
    function evaluacion_inmuebles_demandas($personal=1,$historico=0)
    {
        $this->load->model('Demanda_model');
        $demandas = $this->Demanda_model->get_stats_by_evaluacion_inmueble($personal,$historico);
        if($demandas)
        {
            echo json_encode($demandas);
        }
        else
        {
            echo 1;
        }
    }
    
    function altas_demandas($personal,$anio)
    {
        $this->load->model('Demanda_model');
        $demandas = $this->Demanda_model->get_stats_plot_by_alta($anio,$personal);
        if($demandas)
        {
            echo json_encode($demandas);
        }
        else
        {
            echo 1;
        }
    }
    
    function agentes_demandas($historico=0)
    {
        $this->load->model('Demanda_model');
        $demandas = $this->Demanda_model->get_stats_by_agente($historico);
        if($demandas)
        {
            echo json_encode($demandas);
        }
        else
        {
            echo 1;
        }
    }

}

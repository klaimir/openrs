<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Controller.php';

class Provincias extends MY_Controller
{

    function __construct()
    {        
        parent::__construct();       

        // Secure the access
        $this->_security();
        
        // Carga del modelo
        $this->load->model('Provincia_model');
        
        // Sección activa
        $this->data['_active_section']="provincias";
    }
    
    // index
    public function index()
    {
        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_admin"));
        // Listado
        $this->data['provincias'] = $this->Provincia_model->get_all();
        // Render
        $this->render_private('provincias/index', $this->data);
    }
    
    public function activar($id,$activar) {
        // Deshabilitar profiler
        $this->output->enable_profiler(FALSE);
        // Comprobación de petición por AJAX
        if($this->input->is_ajax_request())
        {
            // Datos federado
            $check_activar = $this->Provincia_model->activar($id,$activar);            
            // Actualización de datos        
            if($check_activar)
            {
                echo 1;
            }
            else
            {
                if($activar)
                {
                    echo "Error al activar la provincia. Inténtelo más tarde";
                }
                else
                {
                    echo "Error al desactivar la provincia. Inténtelo más tarde";
                }
            }
        }
    }

}

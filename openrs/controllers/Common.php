<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends MY_Controller
{

    function __construct()
    {        
        parent::__construct();
    }
    
    public function load_poblaciones($provincia_id=0, $poblacion_seleccionada = NULL)
    {
        // Deshabilitar profiler
        $this->output->enable_profiler(FALSE);
        // Comprobación de petición por AJAX
        if($this->input->is_ajax_request())
        {
            $this->load->model('Poblacion_model');        
            $this->data['poblacion_seleccionada'] = $poblacion_seleccionada;
            $this->data['poblaciones'] = $this->Poblacion_model->get_poblaciones_provincia($provincia_id);
            $this->load->view('common/poblaciones', $this->data);
        }
    }

}

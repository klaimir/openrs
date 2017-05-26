<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends MY_Controller
{

    function __construct()
    {        
        parent::__construct();
        
        // Deshabilitar profiler
        $this->output->enable_profiler(FALSE);
        // Comprobación de petición por AJAX
        if(!$this->input->is_ajax_request())
        {
            show_error('Petición no realizada a través de AJAX');
        }
    }
    
    public function load_poblaciones($provincia_id=0, $poblacion_seleccionada = NULL)
    {
        $this->load->model('Poblacion_model');        
        $this->data['poblacion_seleccionada'] = $poblacion_seleccionada;
        $this->data['poblaciones'] = $this->Poblacion_model->get_poblaciones_provincia($provincia_id);
        $this->load->view('common/poblaciones', $this->data);
    }
    
    function single_google_map()
    {
         // Load the library
        $this->load->library('googlemaps');
        
        $config=array();
        $config['loadAsynchronously'] = TRUE;
        $config['center']='Avenida Ana de Viya, 3, Cádiz, Cádiz, Spain';
        $config['zoom']=15;        
        // Initialize our map. Here you can also pass in additional parameters for customising the map (see below)
        $this->googlemaps->initialize($config);
        
        // Marker
        $marker=array();
        $marker['position']='Avenida Ana de Viya, 3, Cádiz, Cádiz, Spain';
        $this->googlemaps->add_marker($marker);
        
        // Create the map. This will return the Javascript to be included in our pages <head></head> section and the HTML code to be
        // placed where we want the map to appear.
        $this->data['map'] = $this->googlemaps->create_map();
        
        // Load our view, passing the map data that has just been created
        $this->load->view('common/google_maps', $this->data);
    }

}

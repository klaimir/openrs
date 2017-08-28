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
    
    public function load_zonas($poblacion_id=0, $zona_seleccionada = NULL)
    {
        $this->load->model('Zona_model');        
        $this->data['zona_seleccionada'] = $zona_seleccionada;
        $this->data['zonas'] = $this->Zona_model->get_zonas_poblacion($poblacion_id);
        $this->load->view('common/zonas', $this->data);
    }
    
    public function load_poblaciones($provincia_id=0, $poblacion_seleccionada = NULL)
    {
        $this->load->model('Poblacion_model');        
        $this->data['poblacion_seleccionada'] = $poblacion_seleccionada;
        $this->data['poblaciones'] = $this->Poblacion_model->get_poblaciones_provincia($provincia_id);
        $this->load->view('common/poblaciones', $this->data);
    }
    
    private function _format_google_map_path()
    {
        $this->load->model('Poblacion_model');    
        $this->load->model('Pais_model'); 
        
        $pais_id=$this->input->get('pais_id');        
        $direccion=urldecode($this->input->get('direccion'));
        
        $nombre_pais=$this->Pais_model->get_by_id($pais_id)->name;
        if($this->utilities->es_pais_extranjero($pais_id))
        {
            $direccion_formateada="$direccion, $nombre_pais";
        }
        else
        {
            $poblacion_id=$this->input->get('poblacion_id');
            $provincia_id=$this->input->get('provincia_id');
            
            $nombre_poblacion = $this->Poblacion_model->get_by_id($poblacion_id)->poblacion;
            $nombre_provincia = $this->Provincia_model->get_by_id($provincia_id)->provincia;

            $direccion_formateada="$direccion, $nombre_poblacion, $nombre_provincia, $nombre_pais";
        }
        // Al parecer hay que hacerle esto porque hay nombres con acentos y demás que no los coge bien
        return $this->utilities->cleantext(trim($direccion_formateada));
    }
    
    // Le añadimos el número de mapa para que se puedan concatenar varios en una misma página si se desea
    function single_google_map($map_number=1)
    {
         // Load the library
        $this->load->library('googlemaps');
        
        // Formateo de datos
        $direccion_formateada=$this->_format_google_map_path();
        
        if($direccion_formateada)
        {
            // Config
            $config['loadAsynchronously'] = TRUE;
            $config['center']=$direccion_formateada;
            $config['zoom']=15;      
            // Activamos geocoding para mejorar rendimiento
            $config['geocodeCaching'] = TRUE;
            // Es legacy activarlo
            $config['sensor'] = FALSE;
            // Activamos geocoding para mejorar rendimiento
            //$config['geocodeCaching'] = TRUE;
            $config['map_name'] = 'map_name_'.$map_number;
            $config['map_div_id'] = 'map_div_id_'.$map_number;
            // Initialize our map. Here you can also pass in additional parameters for customising the map (see below)
            $this->googlemaps->initialize($config);

            // Para entornos que no sean development es necesario una API-KEY
            $this->load->model('Config_model');
            $config=$this->Config_model->get_config();
            $this->googlemaps->apiKey=$config->google_api_key;

            // Marker
            $marker=array();
            $marker['position']=$direccion_formateada;
            $this->googlemaps->add_marker($marker);

            // Create the map. This will return the Javascript to be included in our pages <head></head> section and the HTML code to be
            // placed where we want the map to appear.
            $this->data['map'] = $this->googlemaps->create_map();

            // Load our view, passing the map data that has just been created
            $this->load->view('common/google_maps', $this->data);
        }
        else
        {
            echo "Debe introducir una dirección para que se pueda posicionar en Google Maps";
        }
    }

}

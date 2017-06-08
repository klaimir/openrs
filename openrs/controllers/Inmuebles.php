<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/CRUD_controller.php';

class Inmuebles extends CRUD_controller
{

    function __construct()
    {
        $this->_model = "Inmueble_model";
        $this->_controller = "inmuebles";
        $this->_view = "inmuebles";

        parent::__construct();

        // Secure the access
        $this->_security();

        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_agente"));
        
        // Idiomas activos
        // Inicializamos para que el modelo sepa sobre qué idiomas debe de realizar sus validaciones
        $this->{$this->_model}->idiomas_activos=$this->Idioma_model->get_idiomas_subidos_activos();
    }
    
    function multiple_google_map()
    {
        // Deshabilitar profiler
        $this->output->enable_profiler(FALSE);
        // Comprobación de petición por AJAX
        if(!$this->input->is_ajax_request())
        {
            echo 'Petición no realizada a través de AJAX';
            return;
        }
        
        // Valores de los filtros de búsqueda
        $filtros = $this->_generar_filtros_busqueda();
        // Búsqueda                
        $inmuebles=$this->{$this->_model}->get_by_filtros($filtros); 
        
        // Check
        if($inmuebles)
        {
            // Load the library
            $this->load->library('googlemaps');
            // Config
            $config['loadAsynchronously'] = TRUE;
            $config['center']="auto";
            $config['zoom']=12;        
            // Initialize our map. Here you can also pass in additional parameters for customising the map (see below)
            $this->googlemaps->initialize($config);

            // Añadir markers con rutas formateados
            foreach ($inmuebles as $inmueble)
            {            
                $marker=array();
                $marker['position']=$this->{$this->_model}->format_google_map_path($inmueble);
                $marker['infowindow_content']='<img class="nav-user-photo" src="'.  base_url('assets/admin/avatars/user.jpg') .'" alt="Foto del inmueble">'                    
                    . '<br>'. $inmueble->descripcion_vivienda
                    . '<br>'. $inmueble->direccion
                    . '<br><a href="'.  site_url('inmuebles/edit/'.$inmueble->id) .'">Editar</a>';
                $this->googlemaps->add_marker($marker);
            } 
            
            // Para entornos que no sean development es necesario una API-KEY
            $this->load->model('Config_model');
            $config=$this->Config_model->get_config();
            $this->googlemaps->apiKey=$config->google_api_key;

            // Create the map.
            $this->data['map'] = $this->googlemaps->create_map();

            // Load our view, passing the map data that has just been created
            $this->load->view('common/google_maps', $this->data);
        }
        else
        {
            echo "No hay inmuebles para mostrar en el mapa de Google";
        }
    }

    private function _load_filtros()
    {
        // Selector de provincias
        $this->data['provincias'] = $this->Provincia_model->get_provincias_dropdown(-1);

        // Selector de tipos_inmuebles
        $this->data['tipos_inmuebles'] = $this->Tipo_inmueble_model->get_tipos_inmuebles_dropdown(-1);

        // Selector de agentes
        $this->data['agentes'] = $this->Usuario_model->get_agentes_dropdown(-1);

        // selector de intereses
        $this->data['intereses'] = $this->Inmueble_model->get_intereses_dropdown(-1);
    }

    private function _load_filtros_session()
    {
        // Filtro provincia_id
        $this->utilities->set_value_session_filter('inmuebles_buscador', 'provincia_id');

        // Filtro poblacion_id
        $this->utilities->set_value_session_filter('inmuebles_buscador', 'poblacion_id');

        // Filtro tipo_id
        $this->utilities->set_value_session_filter('inmuebles_buscador', 'tipo_id');

        // Filtro captador_id
        $this->utilities->set_value_session_filter('inmuebles_buscador', 'captador_id');

        // Filtro interes_id
        $this->utilities->set_value_session_filter('inmuebles_buscador', 'interes_id');

        // Filtro fecha_desde
        $this->utilities->set_value_session_filter('inmuebles_buscador', 'fecha_desde');

        // Filtro fecha_hasta
        $this->utilities->set_value_session_filter('inmuebles_buscador', 'fecha_hasta');
    }

    private function _generar_filtros_busqueda()
    {
        $filtros = array();

        $filtros['tipo_id'] = $this->session->userdata('inmuebles_buscador_tipo_id');
        $filtros['provincia_id'] = $this->session->userdata('inmuebles_buscador_provincia_id');
        $filtros['poblacion_id'] = $this->session->userdata('inmuebles_buscador_poblacion_id');
        $filtros['captador_id'] = $this->session->userdata('inmuebles_buscador_captador_id');
        $filtros['interes_id'] = $this->session->userdata('inmuebles_buscador_interes_id');

        // Búsqueda por rango de fechas
        $filtros['fecha_desde'] = $this->session->userdata('inmuebles_buscador_fecha_desde');
        $filtros['fecha_hasta'] = $this->session->userdata('inmuebles_buscador_fecha_hasta');

        return $filtros;
    }

    // index
    public function index()
    {
        // Valores filtros de sesión
        $this->_load_filtros_session();
        // Valores de los filtros de búsqueda
        $this->data['filtros'] = $this->_generar_filtros_busqueda();
        // Filtros del buscador
        $this->_load_filtros();
        // Búsqueda
        $this->data['elements'] = $this->{$this->_model}->get_by_filtros($this->data['filtros']);
        // Render
        $this->render_private($this->_view . '/index', $this->data);
    }

    // insert
    public function insert()
    {
        // Validation
        if ($this->is_post())
        {
            // Inicializamos los datos de validación para reutilizar la validación del inmueble
            $this->form_validation->set_data($this->input->post()); 
            // Check
            if ($this->{$this->_model}->validation())
            {
                // Formatted datas
                $formatted_datas=$this->{$this->_model}->get_formatted_datas();                
                // Insert
                $last_id=$this->{$this->_model}->create($formatted_datas);
                // Check
                if ($last_id) {
                    $this->session->set_flashdata('message', lang('common_success_insert'));
                    $this->session->set_flashdata('message_color', 'success');
                    redirect($this->_controller, 'refresh');
                } else {
                    $this->data['message'] = $this->{$this->_model}->get_error();
                }
            }
            else
            {
                $this->data['message'] = validation_errors();
            }
        }
        // Set datas
        $this->_set_datas_html();

        // Render
        $this->render_private($this->_view . '/insert', $this->data);
    }

    public function edit($id)
    {
        $this->data['element'] = $this->{$this->_model}->get_info($id);        
        
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);

        // Validation
        if ($this->is_post())
        {
            // Inicializamos los datos de validación para reutilizar la validación del inmueble
            $this->form_validation->set_data($this->input->post()); 
            // Check
            if ($this->{$this->_model}->validation($id))
            {
                // Edit
                $updated_rows = $this->{$this->_model}->edit($id);
                // Check
                if ($updated_rows)
                {
                    $this->session->set_flashdata('message', lang('common_success_edit'));
                    $this->session->set_flashdata('message_color', 'success');
                }
                else
                {
                    $this->session->set_flashdata('message', lang('common_error_edit'));
                }
                redirect($this->_controller, 'refresh');
            }
            else
            {
                $this->data['message'] = validation_errors();
            }
        }

        // Set datas
        $this->_set_datas_html($this->data['element']);

        // Render
        $this->render_private($this->_view . '/edit', $this->data);
    }

    public function _set_datas_html($datos = NULL)
    {
        $this->data = array_merge_recursive($this->data, $this->{$this->_model}->set_datas_html($datos));

        $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."assets/admin/ckeditor/", 'outPut' => true));
    }

    public function delete($id)
    {
        $this->data['element'] = $this->{$this->_model}->get_by_id($id);
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);

        if ($this->{$this->_model}->check_delete($id))
        {
            if ($this->{$this->_model}->remove($id))
            {
                $this->session->set_flashdata('message', lang('common_success_delete'));
                $this->session->set_flashdata('message_color', 'success');
            }
            else
            {
                $this->session->set_flashdata('message', lang('common_error_delete'));
            }
        }
        else
        {
            $this->session->set_flashdata('message', lang('common_error_elemento_asociado_delete'));
        }

        redirect($this->_controller, 'refresh');
    }

    public function duplicar($id)
    {
        $this->data['element'] = $this->{$this->_model}->get_by_id($id);
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);

        $inmueble_id = $this->{$this->_model}->duplicar($this->data['element']);

        if ($inmueble_id)
        {
            $this->session->set_flashdata('message', lang('common_success_duplicate'));
            $this->session->set_flashdata('message_color', 'success');
        }
        else
        {
            $this->session->set_flashdata('message', lang('common_error_duplicate'));
        }

        redirect($this->_controller . '/edit/' . $inmueble_id, 'refresh');
    }
    
    public function asociar_inmuebles($inmueble_id)
    {
        $this->data['element'] = $this->{$this->_model}->get_by_id($inmueble_id);        
        
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);

        // Validation
        if ($this->is_post())
        {
            // Rules
            $this->form_validation->set_rules('inmuebles[]', 'Inmuebles seleccionados', 'xss_clean|required');
            // Check
            if ($this->form_validation->run())
            {
                // Asociar
                $result = $this->{$this->_model}->asociar_inmuebles($inmueble_id,$this->input->post('inmuebles'));
                // Check
                if ($result)
                {
                    $this->session->set_flashdata('message', 'Los inmuebles han sido asignados con éxito');
                    $this->session->set_flashdata('message_color', 'success');
                }
                else
                {
                    $this->session->set_flashdata('message', 'Error al asignar los inmuebles. Inténtelo más tarde');
                }
                redirect($this->_controller. '/edit/' . $inmueble_id, 'refresh');
            }
            else
            {
                $this->data['message'] = validation_errors();
            }
        }
        
        // Inmuebles disponibles
        $this->data['inmuebles_disponibles']=$this->{$this->_model}->get_inmuebles_asociar($inmueble_id);

        // Render
        $this->render_private($this->_view . '/asociar_inmuebles', $this->data);
    }
    
    public function quitar_inmueble($cliente_id, $inmueble_id)
    {
        $this->data['element'] = $this->{$this->_model}->get_by_id($inmueble_id);        
        
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);

        // Edit
        $result = $this->{$this->_model}->quitar_inmueble($cliente_id,$inmueble_id);
        // Check
        if ($result)
        {
            $this->session->set_flashdata('message', 'Se ha quitado al propietario del inmueble con éxito');
            $this->session->set_flashdata('message_color', 'success');
        }
        else
        {
            $this->session->set_flashdata('message', 'No se ha podido quitar al propietario seleccionado del inmueble actual');
        }
        redirect($this->_controller. '/edit/' . $inmueble_id, 'refresh');
    }

    public function import()
    {
        // Validation
        if ($this->is_post())
        {
            // Realizamos subida
            $import=$this->{$this->_model}->import_csv();
            // Check
            if ($import)
            {
                // Si todo fue bien mostraremos un resumen con los registros correctos y los incorrectos
                $this->data['elements'] = $import;               
                // Render del resultado
                $this->render_private($this->_view . '/import_validation', $this->data);
                return;
            }
            else
            {
                $this->data['message'] = $this->{$this->_model}->get_error();
            }
        }
        // Render
        $this->render_private($this->_view . '/import', $this->data);
    }
    
    public function do_import()
    {
        $import=$this->{$this->_model}->do_import_csv();
        if ($import)
        {
            // Si todo fue bien mostraremos un resumen con los registros correctos y los incorrectos
            $this->data['elements'] = $import;
            // Mensaje éxito
            $this->data['message_color'] = "success";
            $this->data['message'] = "Importación realizada con éxito";
        }
        else
        {
            $this->data['message'] = $this->{$this->_model}->get_error();
        }
        // Render
        $this->render_private($this->_view . '/import_result', $this->data);
    }
    
    public function export() {
        // Aplicamos los filtros establecidos en el buscador
        $elements = $this->{$this->_model}->get_by_filtros($this->_generar_filtros_busqueda());
        // Creamos array con datos formateados
        if ($elements)
        {
            // Deshabilitar profiler para que no salga anidado al CSV
            $this->output->enable_profiler(FALSE);
            
            $this->load->helper('csv');
            
            // Cabecera
            $cabecera = array('Tipo','Referencia','Nombre','Hab.','Fecha Nac.','Dirección','E-mail','Precio Compra','Precio Alquiler','Provincia','Municipio','Observaciones','Agente Asignado');
            $array[] = $this->utilities->encoding_array($cabecera);
             
            // Resto de datos
            foreach ($elements as $element)
            {
                $datos_formateado = array();

                $datos_formateado[] = $element->nombre_tipo;
                $datos_formateado[] = $element->referencia;
                $datos_formateado[] = $element->nombre;
                $datos_formateado[] = $element->habitaciones;
                $datos_formateado[] = $element->banios;
                $datos_formateado[] = $this->utilities->cambiafecha_bd($element->fecha_alta);
                $datos_formateado[] = $element->direccion;
                $datos_formateado[] = number_format($element->precio_compra, 0, "," , ".");   
                $datos_formateado[] = number_format($element->precio_alquiler, 0, "," , ".");  
                $datos_formateado[] = $element->nombre_provincia;
                $datos_formateado[] = $element->nombre_poblacion;
                $datos_formateado[] = $element->anio_construccion;
                $datos_formateado[] = $element->observaciones;
                $datos_formateado[] = $element->nombre_captador;
                
                // Conversión de todos los elementos del array
                $array[] = $this->utilities->encoding_array($datos_formateado);
            }
            
            array_to_csv_binary($array, "listado_inmuebles.csv");
        }
        else
        {
            $this->session->set_flashdata('message', 'No existen datos para exportar con la consulta realizada');
            redirect($this->_controller, 'refresh');
        }
    }
   
}
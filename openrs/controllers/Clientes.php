<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/CRUD_Controller.php';

class Clientes extends CRUD_Controller
{

    function __construct()
    {
        $this->_model = "Cliente_model";
        $this->_controller = "clientes";
        $this->_view = "clientes";
        
        parent::__construct();
        
        // Secure the access
        $this->_security();
        
        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_agente"));
    }
    
    private function _load_filtros() {        
        // Selector de provincias
        $this->data['provincias'] = $this->Cliente_model->get_provincias_buscador();
        
        // Selector de paises
        $this->data['paises'] = $this->Cliente_model->get_paises_buscador();
        
        // Selector de agentes
        $this->data['agentes'] = $this->Cliente_model->get_agentes_buscador();
        
        // selector de intereses
        $this->data['intereses'] = $this->Cliente_model->get_intereses_buscador();                      
    }    
    
    private function _load_filtros_session() {        
        // Filtro provincia_id
        $get_provincia_id = $this->input->get('provincia_id');
        $clientes_buscador_provincia_id = $this->session->userdata('clientes_buscador_provincia_id');
        if($get_provincia_id != "") {
            $this->session->set_userdata('clientes_buscador_provincia_id', $get_provincia_id);
        } else {
            if ($clientes_buscador_provincia_id == '') {
                $this->session->set_userdata('clientes_buscador_provincia_id', NULL);
            }
        }
        
        // Filtro poblacion_id
        $get_poblacion_id = $this->input->get('poblacion_id');
        $clientes_buscador_poblacion_id = $this->session->userdata('clientes_buscador_poblacion_id');
        if($get_poblacion_id != "") {
            $this->session->set_userdata('clientes_buscador_poblacion_id', $get_poblacion_id);
        } else {
            if ($clientes_buscador_poblacion_id == '') {
                $this->session->set_userdata('clientes_buscador_poblacion_id', NULL);
            }
        }
        
        // Filtro pais_id
        $get_pais_id = $this->input->get('pais_id');
        $clientes_buscador_pais_id = $this->session->userdata('clientes_buscador_pais_id');
        if($get_pais_id != "") {
            $this->session->set_userdata('clientes_buscador_pais_id', $get_pais_id);
        } else {
            if ($clientes_buscador_pais_id == '') {
                $this->session->set_userdata('clientes_buscador_pais_id', NULL);
            }
        }
        
        // Filtro agente_asignado_id
        $get_agente_asignado_id = $this->input->get('agente_asignado_id');
        $clientes_buscador_agente_asignado_id = $this->session->userdata('clientes_buscador_agente_asignado_id');
        if($get_agente_asignado_id != "") {
            $this->session->set_userdata('clientes_buscador_agente_asignado_id', $get_agente_asignado_id);
        } else {
            if ($clientes_buscador_agente_asignado_id == '') {
                $this->session->set_userdata('clientes_buscador_agente_asignado_id', NULL);
            }
        }
        
        // Filtro interes_id
        $get_interes_id = $this->input->get('interes_id');
        $clientes_buscador_interes_id = $this->session->userdata('clientes_buscador_interes_id');
        if($get_interes_id != "") {
            $this->session->set_userdata('clientes_buscador_interes_id', $get_interes_id);
        } else {
            if ($clientes_buscador_interes_id == '') {
                $this->session->set_userdata('clientes_buscador_interes_id', NULL);
            }
        }

        // Filtro fecha_desde
        $get_fecha_desde = $this->input->get('fecha_desde');
        $clientes_buscador_fecha_desde = $this->session->userdata('clientes_buscador_fecha_desde');
        if($get_fecha_desde != "") {
            $this->session->set_userdata('clientes_buscador_fecha_desde', $get_fecha_desde);
        } else {
            if ($clientes_buscador_fecha_desde == '') {
                $this->session->set_userdata('clientes_buscador_fecha_desde', NULL);
            }
        }
        
        // Filtro fecha_hasta
        $get_fecha_hasta = $this->input->get('fecha_hasta');
        $clientes_buscador_fecha_hasta = $this->session->userdata('clientes_buscador_fecha_hasta');
        if($get_fecha_hasta != "") {
            $this->session->set_userdata('clientes_buscador_fecha_hasta', $get_fecha_hasta);
        } else {
            if ($clientes_buscador_fecha_hasta == '') {
                $this->session->set_userdata('clientes_buscador_fecha_hasta', NULL);
            }
        }
    }

    private function _generar_filtros_busqueda() {
        $filtros = array();

        $filtros['pais_id'] = $this->session->userdata('clientes_buscador_pais_id');
        $filtros['provincia_id'] = $this->session->userdata('clientes_buscador_provincia_id');
        $filtros['poblacion_id'] = $this->session->userdata('clientes_buscador_poblacion_id');
        $filtros['agente_asignado_id'] = $this->session->userdata('clientes_buscador_agente_asignado_id');
        $filtros['interes_id'] = $this->session->userdata('clientes_buscador_interes_id');

        // Búsqueda por rango de fechas
        $filtros['fecha_desde'] = $this->session->userdata('clientes_buscador_fecha_desde');
        $filtros['fecha_hasta'] = $this->session->userdata('clientes_buscador_fecha_hasta');  

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
        $this->render_private($this->_view.'/index', $this->data);
    }
    
    // insert
    public function insert()
    {        
        // Validation
        if ($this->is_post())
        {
            // Check
            if ($this->{$this->_model}->validation())
            {
                // Insert
                $last_id=$this->{$this->_model}->create();
                // Check
                if ($last_id) {
                    $this->session->set_flashdata('message', lang('common_success_insert'));
                    $this->session->set_flashdata('message_color', 'success');
                } else {
                    $this->session->set_flashdata('message', lang('common_error_insert'));
                } 
                redirect( $this->_controller, 'refresh');
            }
            else
            {
                $this->data['message'] = validation_errors();
            }
        }        
        // Set datas
        $this->_set_datas_html();
        
        // Render
        $this->render_private($this->_view.'/insert', $this->data);
    }
    
    public function edit($id)
    {
        $this->data['element'] = $this->{$this->_model}->get_by_id($id);
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);
        
        // Validation
        if ($this->is_post())
        {
            // Check
            if ($this->{$this->_model}->validation($id))
            {
                // Edit
                $updated_rows=$this->{$this->_model}->edit($id);
                // Check
                if ($updated_rows) {
                    $this->session->set_flashdata('message', lang('common_success_edit'));
                    $this->session->set_flashdata('message_color', 'success');
                } else {
                    $this->session->set_flashdata('message', lang('common_error_edit'));
                } 
                redirect( $this->_controller, 'refresh');
            }
            else
            {
                $this->data['message'] = validation_errors();
            }
        }
        
        // Set datas
        $this->_set_datas_html($this->data['element']);
        
        // Render
        $this->render_private($this->_view.'/edit', $this->data);
    }
    
    public function _set_datas_html($datos=NULL)
    {
        $this->data=array_merge_recursive($this->data,$this->{$this->_model}->set_datas_html($datos));     
        
        $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."assets/admin/ckeditor/", 'outPut' => true));
    }
    
    public function delete($id)
    {
        $this->data['element'] = $this->{$this->_model}->get_by_id($id);
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);
        
        if ($this->{$this->_model}->check_delete($id))
        {
            if ($this->{$this->_model}->delete($id))
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

        if ($this->{$this->_model}->duplicar($this->data['element']))
        {
            $this->session->set_flashdata('message', lang('common_success_duplicate'));
            $this->session->set_flashdata('message_color', 'success');
        }
        else
        {
            $this->session->set_flashdata('message', lang('common_error_duplicate'));
        }

        redirect($this->_controller, 'refresh');
    }
    
    public function show_marcas($tipo_plantilla_id) {
        // Comprobación de petición por AJAX
        if($this->input->is_ajax_request())
        {
            $this->output->enable_profiler(FALSE);
            // Consultamos las 
            $this->data['categorias']=$this->Tipo_plantilla_documentacion_model->get_categorias_with_marcas($tipo_plantilla_id);
            // Cargamos la vista
            $this->load->view('plantillas_documentacion/marcas', $this->data);
        }
    }

}

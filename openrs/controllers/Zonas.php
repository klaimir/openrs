<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/CRUD_controller.php';

class Zonas extends CRUD_controller
{
    
    function __construct()
    {
        $this->_model = "Zona_model";
        $this->_controller = "zonas";
        $this->_view = "provincias/poblaciones/zonas";
        
        parent::__construct();
        
        // Sección activa
        $this->data['_active_section']="provincias";
        
        // Secure the access
        $this->_security();
        
        // Carga del modelo
        $this->load->model('Poblacion_model');
    }
    
    // index
    public function index($poblacion_id)
    {
        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_admin"));
        
        $this->data['poblacion'] = $this->Poblacion_model->get_by_id($poblacion_id);        
        // Permisos acceso
        $this->Poblacion_model->check_access($this->data['poblacion']);            
        
        // Datos de la provincia
        $this->data['provincia'] = $this->Provincia_model->get_by_id($this->data['poblacion']->provincia_id);
        
        // Elementos
        $this->data['elements'] = $this->{$this->_model}->where('poblacion_id',$poblacion_id)->get_all();
        // Render
        $this->render_private($this->_view.'/index', $this->data);
    }
    
    // insert
    public function insert($poblacion_id)
    {        
        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_admin"));
        
        $this->data['poblacion'] = $this->Poblacion_model->get_by_id($poblacion_id);
        // Permisos acceso
        $this->Poblacion_model->check_access($this->data['poblacion']);
        
        $this->{$this->_model}->poblacion_id=$poblacion_id;
        
        // Datos de la provincia
        $this->data['provincia'] = $this->Provincia_model->get_by_id($this->data['poblacion']->provincia_id);
        
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
                redirect( $this->_controller."/index/".$poblacion_id, 'refresh');
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
        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_admin"));
        
        $this->data['element'] = $this->{$this->_model}->get_by_id($id);
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);
        
        $this->data['poblacion'] = $this->Poblacion_model->get_by_id($this->data['element']->poblacion_id);
        // Permisos acceso
        $this->Poblacion_model->check_access($this->data['poblacion']);
        
        $this->{$this->_model}->poblacion_id=$this->data['element']->poblacion_id;
        
        // Datos de la provincia
        $this->data['provincia'] = $this->Provincia_model->get_by_id($this->data['poblacion']->provincia_id);
        
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
                redirect( $this->_controller."/index/".$this->data['element']->poblacion_id, 'refresh');
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
    }
    
    public function delete($id)
    {        
        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_admin"));
        
        $this->data['element'] = $this->{$this->_model}->get_by_id($id);
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);
        
        $this->data['poblacion'] = $this->Poblacion_model->get_by_id($this->data['element']->poblacion_id);
        // Permisos acceso
        $this->Poblacion_model->check_access($this->data['poblacion']);
                
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

        redirect( $this->_controller."/index/".$this->data['element']->poblacion_id, 'refresh');
    }

}

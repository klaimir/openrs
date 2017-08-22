<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/CRUD_controller.php';

class Inmuebles_enlaces extends CRUD_controller
{
    
    function __construct()
    {
        $this->_model = "Inmueble_enlace_model";
        $this->_controller = "inmuebles_enlaces";
        $this->_view = "inmuebles/enlaces";
        
        parent::__construct();
        
        // Sección activa
        $this->data['_active_section']="inmuebles";
        
        // Secure the access
        $this->_security();
        
        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_agente"));
        
        // Carga del modelo
        $this->load->model('Inmueble_model');
    }
    
    // index
    public function index($inmueble_id)
    {        
        $this->data['inmueble'] = $this->Inmueble_model->get_by_id($inmueble_id);
        // Permisos acceso
        $this->Inmueble_model->check_access($this->data['inmueble']);            
        
        // Elementos
        $this->data['elements'] = $this->{$this->_model}->where('inmueble_id',$inmueble_id)->get_all();
        // Render
        $this->render_private($this->_view.'/index', $this->data);
    }
    
    // insert
    public function insert($inmueble_id)
    {        
        $this->data['inmueble'] = $this->Inmueble_model->get_by_id($inmueble_id);
        // Permisos acceso
        $this->Inmueble_model->check_access($this->data['inmueble']);
        
        $this->{$this->_model}->inmueble_id=$inmueble_id;
        
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
                    redirect($this->_controller."/index/".$inmueble_id, 'refresh');
                } else {
                    $this->data['message'] = lang('common_error_insert');
                }
            }
            else
            {
                $this->data['message'] = $this->{$this->_model}->get_error();
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
        
        $this->{$this->_model}->inmueble_id=$this->data['element']->inmueble_id;
        
        $this->data['inmueble'] = $this->Inmueble_model->get_by_id($this->data['element']->inmueble_id);
        // Permisos acceso
        $this->Inmueble_model->check_access($this->data['inmueble']);
        
        // Validation
        if ($this->is_post())
        {            
            // Check
            if ($this->{$this->_model}->validation($id))
            {
                // Insert
                $updated_rows=$this->{$this->_model}->edit($id);
                // Check
                if ($updated_rows>=0) {
                    $this->session->set_flashdata('message', lang('common_success_edit'));
                    $this->session->set_flashdata('message_color', 'success');
                    redirect($this->_controller."/index/".$this->data['element']->inmueble_id, 'refresh');
                } else {
                    $this->data['message'] = lang('common_error_edit');
                }
            }
            else
            {
                $this->data['message'] = $this->{$this->_model}->get_error();
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
        $this->data['element'] = $this->{$this->_model}->get_by_id($id);
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);
        
        $this->data['inmueble'] = $this->Inmueble_model->get_by_id($this->data['element']->inmueble_id);
        // Permisos acceso
        $this->Inmueble_model->check_access($this->data['inmueble']);
                
        if ($this->{$this->_model}->check_delete($this->data['element']))
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
            $this->session->set_flashdata('message', $this->{$this->_model}->get_error());
        }

        redirect( $this->_controller."/index/".$this->data['element']->inmueble_id, 'refresh');
    }

}

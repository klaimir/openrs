<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/CRUD_Controller.php';

class Clientes_ficheros extends CRUD_Controller
{
    
    function __construct()
    {
        $this->_model = "Cliente_fichero_model";
        $this->_controller = "clientes_ficheros";
        $this->_view = "clientes/ficheros";
        
        parent::__construct();
        
        // Sección activa
        $this->data['_active_section']="clientes";
        
        // Secure the access
        $this->_security();
        
        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_agente"));
        
        // Carga del modelo
        $this->load->model('Cliente_model');
    }
    
    // index
    public function index($cliente_id)
    {        
        $this->data['cliente'] = $this->Cliente_model->get_by_id($cliente_id);
        // Permisos acceso
        $this->Cliente_model->check_access($this->data['cliente']);            
        
        // Elementos
        $this->data['elements'] = $this->{$this->_model}->where('cliente_id',$cliente_id)->get_all();
        // Render
        $this->render_private($this->_view.'/index', $this->data);
    }
    
    // insert
    public function insert($cliente_id)
    {        
        $this->data['cliente'] = $this->Cliente_model->get_by_id($cliente_id);
        // Permisos acceso
        $this->Cliente_model->check_access($this->data['cliente']);
        
        $this->{$this->_model}->cliente_id=$cliente_id;
        
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
                redirect("zonas/index/".$last_id, 'refresh');
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
        
        $this->data['cliente'] = $this->Cliente_model->get_by_id($this->data['element']->cliente_id);
        // Permisos acceso
        $this->Cliente_model->check_access($this->data['cliente']);
        
        $this->{$this->_model}->cliente_id=$this->data['element']->cliente_id;
        
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
                redirect( $this->_controller."/index/".$this->data['element']->cliente_id, 'refresh');
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
        $this->data['element'] = $this->{$this->_model}->get_by_id($id);
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);
        
        $this->data['cliente'] = $this->Cliente_model->get_by_id($this->data['element']->cliente_id);
        // Permisos acceso
        $this->Cliente_model->check_access($this->data['cliente']);
                
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

        redirect( $this->_controller."/index/".$this->data['element']->cliente_id, 'refresh');
    }

}

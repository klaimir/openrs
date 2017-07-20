<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/CRUD_controller.php';

class Clientes_fichas extends CRUD_controller
{
    
    function __construct()
    {
        $this->_model = "Cliente_ficha_model";
        $this->_controller = "clientes_fichas";
        $this->_view = "clientes/fichas";
        
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
        $this->data['element'] = $this->{$this->_model}->get_by_cliente($cliente_id);
        if($this->data['element'])
        {
            redirect($this->_controller."/edit/".$this->data['element']->id, 'refresh');
        }
        else
        {
            redirect($this->_controller."/insert/".$cliente_id, 'refresh');
        }
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
                    $this->session->set_flashdata('message', 'Documento creado con éxito');
                    $this->session->set_flashdata('message_color', 'success');
                    redirect($this->_controller."/edit/".$last_id, 'refresh');
                } else {
                    $this->data['message'] = lang('common_error_insert');
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
        $this->render_private($this->_view.'/insert', $this->data);
    }
    
    public function edit($id)
    {
        $this->data['element'] = $this->{$this->_model}->get_by_id($id);
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);
        
        $this->{$this->_model}->cliente_id=$this->data['element']->cliente_id;
        
        $this->data['cliente'] = $this->Cliente_model->get_by_id($this->data['element']->cliente_id);
        // Permisos acceso
        $this->Cliente_model->check_access($this->data['cliente']);
        
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
                    $this->session->set_flashdata('message', 'Documento guardado con éxito');
                    $this->session->set_flashdata('message_color', 'success');
                    redirect("clientes/edit/".$this->data['element']->cliente_id, 'refresh');
                } else {
                    $this->data['message'] = lang('common_error_edit');
                }
            }
            else
            {
                $this->data['message'] = validation_errors();
            }
        }
        
        // Set datas
        $this->_set_datas_html($this->data['element']);
        
        $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."assets/admin/ckeditor/", 'outPut' => true));
        
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
                
        if ($this->{$this->_model}->check_delete($this->data['element']))
        {
            if ($this->{$this->_model}->remove($this->data['element']))
            {
                $this->session->set_flashdata('message', 'Documento eliminado con éxito');
                $this->session->set_flashdata('message_color', 'success');
                redirect( $this->_controller."/insert/".$this->data['element']->cliente_id, 'refresh');
            }
        }
        // Error
        $this->session->set_flashdata('message', $this->{$this->_model}->get_error());
        redirect( $this->_controller."/edit/".$this->data['element']->id, 'refresh');
    }

}

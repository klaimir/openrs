<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/CRUD_Controller.php';

class Tipos_inmueble extends CRUD_Controller
{

    function __construct()
    {
        $this->_model = "Tipo_inmueble_model";
        $this->_controller = "tipos_inmueble";
        $this->_view = "admin/tipos_inmueble";
        
        parent::__construct();
        
        // Secure the access
        $this->_security();
        
        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_admin"));       
        
    }
    
    // index
    public function index()
    {
        $this->data['elements'] = $this->{$this->_model}->get_all();
        // Render
        $this->render_private($this->_view.'/index', $this->data);
    }
    
    // insert
    public function insert()
    {        
        // Validation
        if ($this->is_post())
        {
            // Rules
            $this->{$this->_model}->set_rules();           
            
            // Check
            if ($this->{$this->_model}->validation())
            {
                // do we have a valid request?
                if ($this->utilities->valid_csrf_nonce() === FALSE)
                {
                    show_error(lang('common_error_csrf'));
                }
                // Insert
                $last_id=$this->{$this->_model}->create();
                // Check
                if ($last_id) {
                    $this->session->set_flashdata('message', 'Elemento insertado');
                    $this->session->set_flashdata('message_color', 'success');
                } else {
                    $this->session->set_flashdata('message', 'Error al insertar');
                } 
                redirect( $this->_controller, 'refresh');
            }
            else
            {
                $this->data['message'] = validation_errors();
            }
        }
        // CSRF
        $this->data['csrf'] = $this->utilities->get_csrf_nonce();
        
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
            // Rules
            $this->{$this->_model}->set_rules($id);         
            
            // Check
            if ($this->{$this->_model}->validation())
            {
                // do we have a valid request?
                if ($this->utilities->valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
                {
                    show_error('Error CSRF: Petición incorrecta');
                }
                // Edit
                $updated_rows=$this->{$this->_model}->edit($id);
                // Check
                if ($updated_rows) {
                    $this->session->set_flashdata('message', 'Elemento actualizado');
                    $this->session->set_flashdata('message_color', 'success');
                } else {
                    $this->session->set_flashdata('message', 'Error al actualizar');
                } 
                redirect( $this->_controller, 'refresh');
            }
            else
            {
                $this->data['message'] = validation_errors();
            }
        }
        // CSRF
        $this->data['csrf'] = $this->utilities->get_csrf_nonce();
        
        // Set datas
        $this->_set_datas_html($id);
        
        // Render
        $this->render_private($this->_view.'/edit', $this->data);
    }
    
    public function _set_datas_html($id=0)
    {
        $this->data=array_merge_recursive($this->data,$this->{$this->_model}->set_datas_html($id));
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
                $this->session->set_flashdata('message', 'El elemento seleccionado ha sido borrado con éxito');
                $this->session->set_flashdata('color_message', 'success');
            }
            else
            {
                $this->session->set_flashdata('message', 'Error al borrar');
            }
        }
        else
        {
            $this->session->set_flashdata('message', 'El elemento seleccionado tiene datos asociados en el sistema');
        }

        redirect($this->_controller, 'refresh');
    }

}

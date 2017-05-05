<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Controller.php';

class CRUD_controller extends MY_Controller
{
    public $_model;
    public $_controller;
    public $_view;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model($this->_model);
        
        $this->lang->load($this->_controller,$this->data['session_user_language']);

        $this->data['_controller'] = $this->_controller;
        $this->data['_view'] = $this->_view;
    }
    
    /*
     * Por flexibilidad, es mejor pegar esta plantilla en los controladores hijos y adaptarla a las necesidades
     * 
    // index
    protected function index()
    {
        $this->data['elements'] = $this->{$this->_model}->get_all();
        // Render
        $this->render_private($this->_view.'/index', $this->data);
    }
    
    // insert
    protected function insert()
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
                    show_error('Error CSRF: Petición incorrecta');
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
    
    protected function edit($id)
    {
        $this->data['element'] = $this->{$this->_model}->set_datas_object($id);
        // Permisos acceso
        $this->{$this->_model}->check_access();
        
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
                $updated_rows=$this->{$this->_model}->edit();
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
    
    protected function _set_datas_html($id=0)
    {
        $this->data=array_merge_recursive($this->data,$this->{$this->_model}->set_datas_html($id));
    }
    
    protected function delete($id)
    {
        $this->{$this->_model}->set_datas_object($id);
        // Permisos acceso
        $this->{$this->_model}->check_access();
        
        if ($this->{$this->_model}->check_delete())
        {
            if ($this->{$this->_model}->remove())
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
    */
}
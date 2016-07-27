<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Controller.php';

class CRUD_controller extends MY_Controller
{
    public $s_model;
    public $m_model;
    public $_controller;
    public $_view;

    public function __construct()
    {
        parent::__construct();
        
        $this->_controller = strtolower(get_class($this));
        $this->load->model($this->s_model);
        $this->m_model = $this->{$this->s_model};
        
        $this->lang->load($this->_controller);

        $this->data['_controller'] = $this->_controller;
        $this->data['_view'] = $this->_view;
    }
    
    // index
    protected function index()
    {
        $this->data['elements'] = $this->m_model->get_all();
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
            $this->m_model->set_rules();
            
            // Rules datas
            $this->m_model->set_rules_datas();            
            
            // Check
            if ($this->form_validation->run())
            {
                // do we have a valid request?
                if ($this->utilities->valid_csrf_nonce() === FALSE)
                {
                    show_error('Error CSRF: Petición incorrecta');
                }
                
                // Formatted datas
                $formatted_datas=$this->m_model->get_formatted_datas();
                // Insert
                $last_id=$this->m_model->insert($formatted_datas);
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
        $this->data['element'] = $this->m_model->get_by_id($id);
        // Permisos acceso
        $this->m_model->_check_security_access_by_object($this->data['element']);
        
        // Validation
        if ($this->is_post())
        {
            // Rules
            $this->m_model->set_rules($id);
            
            // Rules datas
            $this->m_model->set_rules_datas();            
            
            // Check
            if ($this->form_validation->run())
            {
                // do we have a valid request?
                if ($this->utilities->valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
                {
                    show_error('Error CSRF: Petición incorrecta');
                }
                
                // Formatted datas
                $formatted_datas=$this->m_model->get_formatted_datas();
                // Insert
                $updated_rows=$this->m_model->update($formatted_datas,$id);
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
        $this->data=array_merge_recursive($this->data,$this->m_model->set_datas_html($id));
    }
    
    protected function delete($id)
    {
        // Permisos acceso
        $this->m_model->_check_security_access_by_id($id);
        
        if ($this->m_model->check_delete($id))
        {
            if ($this->m_model->delete($id))
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

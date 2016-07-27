<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_controller
{
    var $config_template = NULL;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language', 'date_helper', 'file', 'text', 'form'));
        $this->load->model('Usuarios_model');
        $this->lang->load('auth');
        // Public
        $this->initializePublic();
        // Private
        if ($this->ion_auth->logged_in())
        {
            $this->initializePrivate();
        }
    }

    protected function _security()
    {
        // Mantenimiento        
        if ($this->config->item('mantenimiento'))
        {
            redirect(site_url('auth/mantenimiento'), 'refresh');
            return;
        }

        // logged
        if (!$this->ion_auth->logged_in())
        {
            redirect(site_url('auth/logout'), 'refresh');
        }
    }

    private function initializePublic()
    {
        $this->config_template = array('menu_izquierda' => 'template', 'mostrar_copyright' => 0);
        $this->data['config_template'] = $this->config_template;
    }

    private function initializePrivate()
    {
        $this->data['session_logged_in'] = true;
        $this->data['session_user_id'] = $this->session->userdata('user_id');
        $this->data['session_user_name'] = $this->session->userdata('username');
        //$this->data['session_user_group'] = $this->ion_auth->get_users_groups()->row()->id;

        $this->data['session_es_admin'] = $this->Usuarios_model->getEsAdmin($this->data['session_user_id']);
        $this->data['session_es_gerente'] = $this->Usuarios_model->getEsGerente($this->data['session_user_id']);
        $this->data['session_es_empleado'] = $this->Usuarios_model->getEsEmpleado($this->data['session_user_id']);
    }

    protected function is_post()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST' ? TRUE : FALSE;
    }

    protected function render_private($cuerpo, $data)
    {
        $data['_view_path'] = $cuerpo;
        $this->load->view('admin/template/layout', $data);
    }

    protected function render_public($cuerpo, $data)
    {
        $data['_view_path'] = $cuerpo;
        $this->load->view('public/template/layout', $data);
    }

}

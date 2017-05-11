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
        
        // Sección activa
        $this->data['active_section']=$this->_controller;
    }
    
}
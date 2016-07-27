<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/CRUD_Controller.php';

class Tipos_inmueble extends CRUD_Controller
{

    function __construct()
    {
        $this->s_model = "Tipos_inmueble_model";
        $this->m_model = "tipos_inmueble_model";
        $this->_controller = "tipos_inmueble";
        $this->_view = "admin/tipos_inmueble";
        
        parent::__construct();
        
        // Secure the access
        $this->_security();
        
        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_admin"));
    }
    
    public function index()
    {
        parent::index();
    }
    
    public function insert()
    {
        parent::insert();
    }
    
    public function edit($id)
    {
        parent::edit($id);
    }
    
    public function delete($id)
    {
        parent::delete($id);
    }

}

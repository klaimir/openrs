<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
	}

    public function is_post()
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST' ? TRUE : FALSE;
	}
    
    public function render_private($cuerpo, $data) {
        $data['_view_path']=$cuerpo;
        $this->load->view('admin/template/layout', $data);
    }
    
    public function render_public($cuerpo, $data) {   
        $data['_view_path']=$cuerpo;
        $this->load->view('public/template/layout', $data);
    }
    
    // Devuelve en una cadena todos los errores de una interfaz
    public function get_errors() {
        $error_array = $this->form_validation->errorArray();
        $cadena='<br><br>';
        if (count($error_array) > 0) {
            foreach ($error_array as $error) {
                $cadena.='<p>' . $error. '</p>';
            }
        }
        return $cadena.validation_errors('<p>', '</p>');
    }
}
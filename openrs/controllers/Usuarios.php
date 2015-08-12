<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/BaseController.php';

class Usuarios extends BaseController {

	function __construct()
	{
		parent::__construct();
        
        // Secure the access
        $this->_security();
	}

	// dashboard
	function dashboard()
	{
        // Render
        $this->render_private('admin/index', $this->data);
	}
    
    public function delete_user($id) {
        // Otros usuario no pueden borrar cuentas
        if (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))
		{
			redirect('auth', 'refresh');
		}
        
        if ($this->Usuarios_model->comprobarDelete($id)) {
            if ($this->Usuarios_model->delete($id)) {
                $this->session->set_flashdata('message', 'El usuario ha sido borrado con éxito');
                $this->session->set_flashdata('color_message', 'success');
            } else {
                $this->session->set_flashdata('message', 'Error al borrar el usuario');
                $this->session->set_flashdata('color_message', 'danger');
            }
        } else {
            $this->session->set_flashdata('message', 'El usuario seleccionado tiene datos asociados o es un usuario especial del sistema');
            $this->session->set_flashdata('color_message', 'danger');                
        }
        
        redirect(site_url('auth'), 'refresh');
    }

}

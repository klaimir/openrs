<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Controller.php';

class Usuarios extends MY_Controller
{

    function __construct()
    {
        $this->s_model = "Usuarios_model";
        $this->m_model = "usuarios_model";
        $this->_controller = "usuarios";
        $this->_view = "admin";
        
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

    public function delete_user($id)
    {
        // Otros usuario no pueden borrar cuentas
        if (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))
        {
            redirect('auth', 'refresh');
        }

        if ($this->_model->check_delete($id))
        {
            if ($this->_model->delete_all($id))
            {
                $this->session->set_flashdata('message', 'El usuario ha sido borrado con éxito');
                $this->session->set_flashdata('color_message', 'success');
            }
            else
            {
                $this->session->set_flashdata('message', 'Error al borrar el usuario');
                $this->session->set_flashdata('color_message', 'danger');
            }
        }
        else
        {
            $this->session->set_flashdata('message', 'El usuario seleccionado tiene datos asociados o es un usuario especial del sistema');
            $this->session->set_flashdata('color_message', 'danger');
        }

        redirect(site_url('auth'), 'refresh');
    }

    // test
    function test()
    {
        if ($this->is_post())
        {
            /*             * ************* RULES ************* */
            $rules_first_name = array(
                'required',
                array('test_names', array($this->Usuarios_model, 'test_names'))
            );
            $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), $rules_first_name);
            $this->form_validation->set_rules('last_name', 'Apellidos', 'required');

            /*             * ************* DATAS ************* */
            /*
              $data = array(
              'first_name' => '',
              'last_name' => ''
              ); */
            $data = $this->input->post();
            $data['validation_datas_test_names'] = array('first_name' => $data['first_name'], 'last_name' => $data['last_name']);
            $this->form_validation->set_data($data);

            /*             * ************* CHECK ************* */
            if ($this->form_validation->run() == true)
            {
                $this->session->set_flashdata('message', 'NICEEEEEE¡¡');
                redirect("usuarios/test", 'refresh');
            }
            else
            {
                $this->data['message'] = validation_errors();
            }
        }

        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name'),
        );

        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name'),
        );

        // Render
        $this->render_private('admin/test', $this->data);
    }

    public function email()
    {
        $this->load->library('email');
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'angel.berasuain@gmail.com',
            'smtp_pass' => 'BreakbeaT2',
            'mailtype' => 'html',
            'charset' => 'UTF-8'
        );
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");


        //$message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('email_forgot_password', 'ion_auth'), $data, true);
        $message = "HOLA";
        $this->email->clear();
        $this->email->from('angel.berasuain@gmail.com', 'OPENRS');
        $this->email->to('angel.berasuain@gmail.com');
        $this->email->subject('Correo');
        $this->email->message($message);

        $this->email->send();
        echo $this->email->print_debugger();
    }
    
    public function cabecera(){
    	//Comprobamos permisos
    	if (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)){
    		redirect('auth', 'refresh');
    	}
    	//Cargamos configuración cabecera
    	$data['config'] = $this->Usuarios_model->datos_config(1);
    }

}
